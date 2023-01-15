<?php

namespace App\Classes;

use App\Payroll;
use App\PayrollAdjustment;
use App\PayrollAdmin;
use App\PayrollCalendar;
use App\PayrollDayOffDiscount;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use stdClass;


/**
 * Prenomina Class
 * @version 1.0.0 Prenomina
 * @author Juan Cuellar
 */

class Prenomina
{

    public $year;
    public $month;
    public $q;

    public $calendar;
    public $employees;
    protected $schedules;
    protected $novelties;
    protected $agentActivities;

    public $payrolls;

    /** @var string Fecha Inicio Quincena*/
    public $startDateQ;
    /** @var string Fecha Fin Quincena*/
    public $endDateQ;
    /** @var string Fecha Inicio Periodo ($startDateQ - 1 day)*/
    public $startDate;
    /** @var string Fecha Fin Periodo ($endDateQ + 1 day)*/
    public $endDate;
    
    // public $payroll_activities;

    function __construct($year = null, $month = null, $q = null)
    {

        if($year && $month && $q){
            $this->setPeriod($year,$month,$q);
        }else{
            $period = $this->getActualPeriod();
            $this->setPeriod($period->year,$period->month, $period->q);
        }
        
    }

    public function getPeriods(){
        $periods = PayrollCalendar::where('active',1)
            ->select('year','month','q','closed')
            ->groupBy('year','month','q','closed')
            ->get();
            
        return $periods;
    }

    protected function getActualPeriod()
    {
        $period = PayrollCalendar::where('active',1)->whereNull('closed')->orderBy('date')->take(1)->firstOrFail();
        return $period;
    }

    protected function setPeriod($year, $month, $q)
    {
        $this->year = $year;
        $this->month = $month;
        $this->q = $q;

        $this->startDateQ = date('Y-m-d',strtotime("$year-$month-".($q == 1 ? "01" : "16")));
        $this->endDateQ = $q==1 ? date('Y-m-d',strtotime("$year-$month-15")) : date('Y-m-t',strtotime($this->startDateQ));

        $this->startDate = date('Y-m-d', strtotime('-1 day',strtotime($this->startDateQ)));
        $this->endDate =  date('Y-m-d', strtotime('+1 day',strtotime($this->endDateQ)));
        
        $this->calendar = $this->getCalendar();
    }


    protected function refreshDatabases()
    {
        \Log::info('Prenomina -> Refreshing databases');

        \Log::info('Prenomina -> Period: '. json_encode([
            'year'=>$this->year,
            'month'=>$this->month,
            'q'=>$this->q,
            'startDate'=>$this->startDate,
            'endDate'=>$this->endDate
        ]));
        
        $nexusDB = config('database.connections.sqlsrvnexus360.database');
        $enercareDB = config('database.connections.sqlsrvenercare.database');
        if(config('database.connections.sqlsrvpayroll.host')!=config('database.connections.sqlsrvnexus360.host')){
            $nexusHost = '[10.238.68.66\CP360].';
            $nexusDB = $nexusHost. $nexusDB;
            $enercareDB = $nexusHost. $enercareDB;
        }
        
        // Validar si la nomina no está cerrada
        if($this->calendar->where('date',$this->endDateQ)->first()->closed == false){
            
            // EMPLOYEES

            // Delete Employees
            $deletedEmployees = DB::connection('sqlsrvpayroll')->table('employees')
            ->leftJoin($nexusDB.'.dbo.master_files','employees.id','=','master_files.id')
            ->where('employees.year', $this->year)
            ->where('employees.month', $this->month)
            ->where('employees.q', $this->q)
            ->whereNull('master_files.id')
            ->delete();

            \Log::info('Prenomina -> Deleted employees: '.$deletedEmployees);

            
            DB::connection('sqlsrvpayroll')->table('employees')
            ->join($nexusDB.'.dbo.master_files','employees.id','=','master_files.id')
            ->where('employees.year', $this->year)
            ->where('employees.month', $this->month)
            ->where('employees.q', $this->q)
            ->update([
                'employees.full_name'=>DB::raw('master_files.full_name'),
                'employees.campaign'=>DB::raw('master_files.campaign'),
                'employees.position'=>DB::raw('master_files.position'),
                'employees.lob'=>DB::raw('master_files.lob'),
                'employees.supervisor'=>DB::raw('master_files.supervisor'),
                'employees.payroll_manager'=>DB::raw('master_files.payroll_manager'),
                'employees.hrs_per_week'=>DB::raw('master_files.hrs_per_week'),
                'employees.mandatory_rest_day'=>DB::raw('master_files.mandatory_rest_day'),
                'employees.compensation_day'=>DB::raw('master_files.compensation_day'),
                'employees.termination_date'=>DB::raw('master_files.termination_date'),
            ]);

            // Insert into employees from masterfile
            $positions = PayrollAdmin::where('name','positions')->pluck('value')->first();
            $bindingsPosition = implode(',', array_fill(0, count($positions), '?'));
            DB::connection('sqlsrvpayroll')
            ->insert("INSERT INTO employees
            SELECT master_files.[id]
                , master_files.[national_id]
                , master_files.[full_name]
                , master_files.[campaign]
                , master_files.[position]
                , master_files.[lob]
                , master_files.[supervisor]
                , master_files.[payroll_manager]
                , master_files.[joining_date] as [date_of_hire]
                , master_files.[hrs_per_week]
                , master_files.[mandatory_rest_day]
                , master_files.[compensation_day]
                , master_files.[termination_date]
                , '$this->year' AS [year]
                , '$this->month' AS [month]
                , '$this->q' AS [q]
            FROM $nexusDB.dbo.master_files
            LEFT JOIN (SELECT id
                FROM employees
                WHERE year = ? AND month = ? AND q = ?) as employees
                ON master_files.id = employees.id
            WHERE master_files.[joining_date] <= ?
                AND (master_files.[termination_date] IS NULL OR master_files.[termination_date] >= ?)
                AND master_files.[position] IN ( $bindingsPosition )
                AND employees.id is null",
                array_merge([$this->year, $this->month, $this->q,$this->endDateQ, $this->startDateQ],$positions)
            );

            $insertedEmployees = DB::connection('sqlsrvpayroll')->select('SELECT @@ROWCOUNT AS NumOfRows')[0]->NumOfRows;

            \Log::info('Prenomina -> Inserted employees: '.$insertedEmployees);

            // SCHEDULES

            // Delete schedules
            $deletedSchedules = DB::connection('sqlsrvpayroll')->table('schedules')
            ->where('year', $this->year)
            ->where('month', $this->month)
            ->where('q', $this->q)
            ->delete();

            \Log::info('Prenomina -> Deleted schedules: '.$deletedSchedules);

            // Insert schedules
            DB::connection('sqlsrvpayroll')->insert("INSERT INTO schedules
            SELECT [date],
                NationalID as national_id, 
                [in], 
                [out], 
                start_break1, 
                end_break1, 
                break_time1, 
                start_break2, 
                end_break2, 
                break_time2, 
                start_break3, 
                end_break3, 
                break_time3, 
                total_break_time, 
                start_lunch, 
                end_lunch, 
                lunch_time, 
                schedule_time,
                '$this->year' AS [year],
                '$this->month' AS [month],
                '$this->q' AS [q]
            FROM $enercareDB.dbo.Tbschedulescontactpoint as schedules
            INNER JOIN (SELECT national_id
                FROM employees
                WHERE year = ? AND month = ? AND q = ?) as employees
                ON schedules.NationalID = employees.national_id
            WHERE schedules.[date] BETWEEN ? AND ?",
            [$this->year, $this->month, $this->q, $this->startDate, $this->endDate]
            );
            
            $insertedSchedules = DB::connection('sqlsrvpayroll')->select('SELECT @@ROWCOUNT AS NumOfRows')[0]->NumOfRows;

            \Log::info('Prenomina -> Inserted schedules: '.$insertedSchedules);

            // AGENT ACTIVITIES
        
            // Delete agent activities
            $deletedActivities = DB::connection('sqlsrvpayroll')->table('agent_activities')
            ->where('year', $this->year)
            ->where('month', $this->month)
            ->where('q', $this->q)
            ->delete();

            \Log::info('Prenomina -> Deleted agent_activities: '.$deletedActivities);


            // Insert Agent Activities
            DB::connection('sqlsrvpayroll')->insert("INSERT INTO agent_activities
            SELECT agent_activities.id as agent_activity_id, 
                users.national_id,
                activities.name AS activity ,
                agent_activities.created_at AS [start_date] ,
                agent_activities.updated_at AS [end_date] ,
                DATEDIFF(SS,agent_activities.created_at,IIF(agent_activities.activity_id = '2', agent_activities.created_at ,agent_activities.updated_at)) AS total_time ,
                '$this->year' AS [year],
                '$this->month' AS [month],
                '$this->q' AS [q]
            FROM $nexusDB.dbo.agent_activities
            INNER JOIN $nexusDB.dbo.activities ON agent_activities.activity_id = activities.id
            INNER JOIN $nexusDB.dbo.users ON agent_activities.user_id = users.id
            INNER JOIN (SELECT national_id
                FROM employees
                WHERE year = ? AND month = ? AND q = ?) as employees
                ON  users.national_id = employees.national_id
            WHERE convert(date,agent_activities.created_at) BETWEEN ? AND ?",
            [$this->year, $this->month, $this->q, $this->startDate, $this->endDate]);

            $insertedActivities = DB::connection('sqlsrvpayroll')->select('SELECT @@ROWCOUNT AS NumOfRows')[0]->NumOfRows;

            \Log::info('Prenomina -> Inserted agent_activities: '.$insertedActivities);

        }

        // NOVELTIES

        // Delete novelties
        $deletedNovelties = DB::connection('sqlsrvpayroll')->table('novelties')
        ->where('year', $this->year)
        ->where('month', $this->month)
        ->where('q', $this->q)
        ->delete();

        \Log::info('Prenomina -> Deleted novelties: '.$deletedNovelties);

        // Insert Novelties
        DB::connection('sqlsrvpayroll')->insert("INSERT INTO novelties
        SELECT novelties.[id] as novelty_id,
            employee_id,
            contingency ,
            [start_date],
            [end_date],
            days_hours,
            '$this->year' AS [year],
            '$this->month' AS [month],
            '$this->q' AS [q]
        FROM $nexusDB.dbo.payroll_novelties as novelties
        INNER JOIN (SELECT id
            FROM employees
            WHERE year = ? AND month = ? AND q = ?) as employees
            ON employee_id = employees.id
        WHERE ([start_date] BETWEEN ? AND ?
            OR [end_date] BETWEEN ? AND ?
            OR([start_date] < ? AND [end_date] >?))",
        [$this->year, $this->month, $this->q, $this->startDate, $this->endDate, $this->startDate, $this->endDate, $this->startDate, $this->endDate]);
        
        $insertedNovelties = DB::connection('sqlsrvpayroll')->select('SELECT @@ROWCOUNT AS NumOfRows')[0]->NumOfRows;

        \Log::info('Prenomina -> Inserted novelties: '.$insertedNovelties);        

    }

    public function createPrenomina($refreshData = true, $onlyMergeData = false, $closePayroll = true, $filterEmployees = [] ){
        $this->payrolls = collect();
        $this->payroll_activities = collect();

        if($refreshData)  $this->refreshDatabases();
        $this->getData($filterEmployees);
        $this->validateData();

        if(!$onlyMergeData) PayrollDayOffDiscount::whereBetween('date_of_absence',[$this->startDate,$this->endDate])->delete();

        $this->mergeData($filterEmployees);

        if(!$onlyMergeData){
            $this->deletePayrolls();
            $this->deletePayrollActivities();       
            $this->savePayrolls();
            $this->savePayrollActivities();
            $this->deleteInvalidAdjustments();
            $this->sendEmailPayrollAdjustmentPending();
        }

        if($closePayroll &&  $this->endDateQ < date("Y-m-d") && date('Y-m-d H:i:s') >= $this->endDate.' 10:00:00'){
            $this->closedPayrollActual();
        }
    }

    protected function deleteInvalidAdjustments(){
        //Eliminar ajustes no validos
        PayrollAdjustment::doesntHave('payroll_activity')
        ->where('status','Pendiente')
        ->whereNull('payroll_id')
        ->delete();
    }

    protected function sendEmailPayrollAdjustmentPending(){
        Mail::send(new \App\Mail\PayrollAdjustmentPendingMail());
    }

    protected function closedPayrollActual(){
        // Closed actual period active
        PayrollCalendar::whereBetween('date',[$this->startDateQ, $this->endDateQ])
            ->update(['closed'=>1]);

        // Active next period
        $dataEndDate = PayrollCalendar::where('date',$this->endDate)->get()->first();
        PayrollCalendar::where('year',$dataEndDate->year)
            ->where('month',$dataEndDate->month)
            ->where('q',$dataEndDate->q)
            ->update(['active'=>1]);

        // Rechazar los ajustes que los supervisores no dieron respuesta
        PayrollAdjustment::where('date','<',$dataEndDate->date)
        ->where('status','Pendiente')
        ->where('supervisor_approval_required',1)
        ->whereNull('supervisor_approval_status')
        ->update([
            'supervisor_approval_status' => 'Rechazado',
            'supervisor_approval_date' => date('Y-m-d H:i:s'),
            'supervisor_approval_comment' => 'Rechazo automático. No cuenta con flujo de aprobacion/rechazo'
        ]);

        // Rechazar los ajustes que los oms no dieron respuesta
        PayrollAdjustment::where('date','<',$dataEndDate->date)
            ->where('status','Pendiente')
            ->whereNotNull('supervisor_approval_status')
            ->where('supervisor_approval_status','Aprobado')
            ->where('om_approval_required',1)
            ->whereNull('om_approval_status')
            ->update([
                'om_approval_status' => 'Rechazado',
                'om_approval_date' => date('Y-m-d H:i:s'),
                'om_approval_comment' => 'Rechazo automático. No cuenta con flujo de aprobacion/rechazo'
            ]);
        
    }

    protected function savePayrolls()
    {
        $this->payrolls->chunk(230)->each(function ($payrolls) {
            Payroll::insert($payrolls->toArray());
        });
    }

    protected function savePayrollActivities()
    {
        // dd($this->payroll_activities[0]);
        $this->payroll_activities->chunk(190)->each(function ($payroll_activities) {
            $min = $payroll_activities->min('date');
            $max = $payroll_activities->max('date');
            try{
                DB::connection('sqlsrvpayroll')->table('payroll_activities')->insert($payroll_activities->toArray());
            } catch (\Exception $e){
                DB::connection('sqlsrvpayroll')->table('payroll_activities')->whereIn('code',$payroll_activities->pluck('code')->toArray())->delete();
                DB::connection('sqlsrvpayroll')->table('payroll_activities')->insert($payroll_activities->toArray());
            }

        });
    }

    protected function deletePayrolls()
    {
        // Delete payrolls from database where date between start and end date of the calendar
        Payroll::whereBetween('date',[$this->startDate,$this->endDate])->delete();
    }

    protected function deletePayrollActivities()
    {
        // Delete payroll_activities from database where date between start and end date of the calendar
        DB::connection('sqlsrvpayroll')->table('payroll_activities')->whereBetween('date',[$this->startDate ,$this->endDate])->delete();
    }

    public function getPayroll($employee_id, $date)
    {
        $payroll = Payroll::with('calendar','payroll_activities','payroll_activities.adjustments')
        ->where('employee_id', $employee_id)->where('date', $date)->firstOrFail();
        
        return $payroll;
    }

    public function getPayrolls(){
        $payrolls = Payroll::with('payroll_activities')
        ->whereBetween('date',[$this->startDate, $this->endDate])
        ->get();
        return $payrolls;        
    }

    protected function getData($filterEmployees = [])
    {
        
        $this->employees = $this->getEmployees($filterEmployees);
        $this->schedules = $this->getSchedules();
        $this->novelties = $this->getNovelties();
        $this->agentActivities = $this->getAgentActivities();
    }

    protected function getCalendar()
    {
        return PayrollCalendar::whereBetween('date',[$this->startDate, $this->endDate])
            ->select('date','day','day_of_week','holiday', 'closed')
            ->orderBy('date')
            ->get();  
    }

    public function getEmployees($filterEmployees = [])
    {
        $query = DB::connection('sqlsrvpayroll')->table('employees')
        ->where('year', $this->year)
        ->where('month', $this->month)
        ->where('q', $this->q);

        if(count($filterEmployees)){
            $query->whereIn('national_id',$filterEmployees);
        }

        return $query->orderBy('national_id')->get();
    }

    protected function getSchedules()
    {
        return DB::connection('sqlsrvpayroll')->table('schedules')
            ->where('year', $this->year)
            ->where('month', $this->month)
            ->where('q', $this->q)
            ->whereIn('national_id', $this->employees->pluck('national_id'))
            ->orderBy('national_id')
            ->orderBy('date')
            ->get()
            ->groupBy('national_id');
    }

    protected function getNovelties()
    {
        return DB::connection('sqlsrvpayroll')->table('novelties')
            ->where('year', $this->year)
            ->where('month', $this->month)
            ->where('q', $this->q)
            ->whereIn('employee_id', $this->employees->pluck('id'))
            ->orderBy('employee_id')
            ->orderBy('start_date')
            ->get()
            ->groupBy('employee_id');
    }

    protected function getAgentActivities()
    {
        return DB::connection('sqlsrvpayroll')->table('agent_activities')
            ->where('year', $this->year)
            ->where('month', $this->month)
            ->where('q', $this->q)
            ->whereIn('national_id', $this->employees->pluck('national_id'))
            ->orderBy('national_id')
            ->orderBy('start_date')
            ->get()
            ->groupBy('national_id');
    }

    protected function validateData()
    {
        $schedulesDuplicate = $this->schedules->map(function ($schedule, $key) {
            return collect($schedule)->duplicates('date');
        })->filter(function ($schedule, $key) {
            return $schedule->count() >= 1;
        });

        if ($schedulesDuplicate->count() > 0) {
            throw new \Exception("Schedules have duplicates\n" . $schedulesDuplicate);
        }
    }

    protected function mergeData($filterEmployees = [])
    {
        $this->employees = $this->employees->values();
        if(count($filterEmployees)){
            $this->employees = $this->employees->whereIn('national_id',$filterEmployees);
        }

        $this->absenceJustifications = PayrollAdjustment::leftJoin('payrolls',DB::raw('CAST(payrolls.id as varchar)'), '=', 'payroll_adjustments.activity_code')
        ->select('payrolls.employee_id','payrolls.date as payroll_date')
        ->whereBetween('payrolls.date',[$this->startDate,$this->endDate])
        ->where('payroll_adjustments.adjustment_type','Inasistencia Justificada')
        ->where('payroll_adjustments.om_approval_status',PayrollAdjustment::APPROVED_STATUS)
        ->get();

        $this->employees = $this->employees->map(function ($employee){
            $employee->payroll = collect();
            $employee->schedules = collect($this->schedules->get($employee->national_id, collect()));
            $employee->novelties = collect($this->novelties->get($employee->id, collect()));
            $employee->agentActivities = collect($this->agentActivities->get($employee->national_id, collect()));
            $employee->payroll_activities = collect();
            $employee->absenceJustifications = $this->absenceJustifications->where('employee_id',$employee->id);

            $this->calendar->each(function ($date) use ($employee) {
                // validar si la fecha es igual al termination_date
                if($date->date == $employee->termination_date){
                    return false;
                }
                // create id with date to YYYYMMDD and employee id
                $id = Carbon::createFromFormat('Y-m-d', $date->date)->format('Ymd') .  $employee->id;

                $payroll = new PayrollDate($this, $employee);
                $payroll->hrs_per_week = $employee->hrs_per_week;
                $payroll->mandatory_res_day = $employee->mandatory_rest_day;
                $payroll->date = $date->date;
                $payroll->day = $date->day;
                $payroll->day_of_week = $date->day_of_week;
                $payroll->holiday = $date->holiday;
                $payroll->schedule = $employee->schedules->where('date', $date->date)->first();
                $payroll->novelty = $employee->novelties->where('start_date', '<=', $date->date)->where('end_date', '>=', $date->date)->first();
                $payroll->absenceJustification = $employee->absenceJustifications->where('payroll_date',$date->date)->first();
                $payroll->agentActivities = null;
                $payroll->id = $id;
                $payroll->employee_id = $employee->id;


                if ($payroll->schedule) {
                    $in = date('Y-m-d H:i:s', strtotime('-5 hour', strtotime($payroll->schedule->in)));
                    $out = date('Y-m-d H:i:s', strtotime('+8 hour', strtotime($payroll->schedule->out)));
                }else{
                    $in = date('Y-m-d H:i:s', strtotime($date->date));
                    $out = date('Y-m-d H:i:s', strtotime('+24 hour',strtotime($date->date)));
                }
                $payroll->agentActivities = $employee->agentActivities->whereBetween('start_date', [$in, $out])->values();

                $dataPayroll = $payroll->getPayroll();
                $employee->payroll->push($dataPayroll);

                $date->is_holiday = $date->day_of_week == $employee->mandatory_rest_day || $date->holiday;


                $this->payrolls->push([
                        'id'=> $id,
                        'employee_id' => $employee->id,
                        'national_id' => $employee->national_id,
                        'date' => $date->date,
                        'day' => $date->day,
                        'day_of_week' => $date->day_of_week,
                        'is_holiday' => $date->is_holiday,
                        'schedule' => $payroll->schedule ? json_encode($payroll->schedule) : null,
                        'novelty' => $payroll->novelty ? json_encode($payroll->novelty) : null
                    ]);
            });

            // delete novelties, schedules and agent activities
            $employee->novelties = collect();
            $employee->schedules = collect();
            $employee->agentActivities = collect();

            return $employee;
        });
    }
}
