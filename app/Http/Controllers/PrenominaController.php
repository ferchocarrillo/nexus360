<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Prenomina;
use App\Payroll;
use App\PayrollAdjustment;
use App\PayrollAdmin;

class PrenominaController extends Controller
{

    function __construct()
    {
        $this->middleware('can:payroll')->only(['index','getEmployees','getPayroll']);
    }

    //
    public function index()
    {
        $prenomina = new Prenomina();
        
        $periods = $prenomina->getPeriods();

        $periods = $periods->map(function($period){ 
            return (object)[
                'text'=>"$period->year-".str_pad($period->month,2,'0',STR_PAD_LEFT)."-$period->q"."Q" .($period->closed ? " (Closed)" :""),
                'value'=>"$period->year-$period->month-$period->q"
            ];
            return $period;
        });

        return view('prenomina.index', compact('periods'));
    }

    public function getEmployees(Request $request)
    {
        $user = auth()->user();
        $permissionSupervisor = $user->can('payroll.supervisor');
        $permissionOM = $user->can('payroll.om');
        $permissionAdmin = $user->can('payroll.admin');

        if($permissionAdmin){
            $filterEmployees = [];
        }else if($permissionSupervisor || $permissionOM){
            $filterEmployees = $user->employessAllHierarchy(true);
            //->get()->pluck('national_id');
        }else{
            $filterEmployees = [$user->national_id];
        }

        $prenomina = new Prenomina($request->year, $request->month, $request->q);
        $employees = $prenomina->getEmployees($filterEmployees);

        if($prenomina->endDateQ >= date("Y-m-d") || $prenomina->endDate == date("Y-m-d")){
            $time = date("H:i:s");
            $daysBefore = $time >= '07:45:00' ?1:2;
            $prenomina->endDateQ = date("Y-m-d", strtotime("-$daysBefore days"));
        }

        $calendar = $prenomina->calendar->whereBetween('date',[$prenomina->startDateQ, $prenomina->endDateQ])->map->only(['date','holiday'])->values();
        $data = [
            'employees' => $employees,
            'calendar' => $calendar,
        ];
        return response()->json($data);
    }

    public function createPrenomina(Request $request)
    {
        $prenomina = new Prenomina($request->year, $request->month, $request->q);
        $prenomina->createPrenomina();
        // return response()->json($prenomina);
    }

    public function getPayroll(Request $request)
    {
        $prenomina = new Prenomina();
        $payroll = $prenomina->getPayroll($request->employee_id, $request->date);
        // approval per day
        $adjustment = PayrollAdjustment::where("employee_id",$payroll->employee_id)
            ->where("activity_code",strval($payroll->id))
            ->get()->first();

        $payroll->adjustment = $adjustment;

        $payroll->availableOffsetHoliday =  ($payroll->is_holiday && $payroll->schedule &&
            substr($payroll->schedule['in'],0,10) == substr($payroll->schedule['out'],0,10) &&
            !$adjustment
        );

        $payroll->availableJustifyAbsence = ($payroll->novelty && $payroll->novelty['type'] == 'Inasistencia' 
            && !$adjustment && auth()->user()->national_id != $payroll->national_id  && !$payroll->calendar->closed);

        $today = date('Y-m-d');
        $payroll->supervisorCanCreateAdjustments = ($today == $prenomina->endDateQ || $today == $prenomina->endDate);
        
        $days_before = PayrollAdmin::where('name','days_before')->firstOrFail()->value;
        $payroll->enableAdjustments = $payroll->date >= date('Y-m-d', strtotime("-$days_before days")) || $payroll->adjustment_exception;
        $payroll->availableAdjustmentException = !$payroll->enableAdjustments;
        unset($payroll->adjustment_exception);

        $payroll->payroll_activities = $payroll->payroll_activities->map(function($activity)use($payroll) {
            if($payroll->adjustment && $payroll->adjustment->status == PayrollAdjustment::APPROVED_STATUS 
                && $activity->surcharge == "Festivo" && $payroll->adjustment->adjustment_type == "Festivo Compensado" ){
                $activity->surcharge = "Festivo Compensado";
            }
            $activity->activity_type = $activity->adjustment_type ?? $activity->activity_type;
            return $activity;
        });
        
        $payroll_activities = $payroll->payroll_activities;

        $payroll->summary = collect();
        $payroll_activities->groupBy('activity_type')->each(function ($item, $activity_type) use (&$payroll) {
            $item->groupBy('surcharge')->each(function ($item, $surcharge) use (&$payroll, $activity_type) {
                
                $payroll->summary->push([
                    'activity_type' => $activity_type,
                    'surcharge' => $surcharge,
                    'total_time_in_seconds' => $item->sum('total_time_in_seconds'),
                ]);
            });
        });

        $dateToTime = strtotime($payroll->date);
        $day = date('w',$dateToTime) ?: "7";
        $week_start = date('Y-m-d', strtotime('-'.($day-1).' days',$dateToTime));
        $week_end = date('Y-m-d', strtotime('+'.(7-$day).' days',$dateToTime));

        $schedules = Payroll::whereBetween('date',[$week_start,$week_end])
            ->where('national_id',$payroll->national_id)
            ->select('schedule')
            ->get()
            ->pluck('schedule');


        $payroll->hrsScheduledPerWeek = (object)[
            'week_start' => $week_start,
            'week_end' => $week_end,
            'hrs' => round(($schedules->sum('schedule_time') - $schedules->sum('lunch_time'))/3600,2)
        ];
        
        return response()->json($payroll);
    }
}