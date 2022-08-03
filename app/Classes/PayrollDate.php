<?php

namespace App\Classes;

use App\PayrollDayOffDiscount;
use Carbon\Carbon;

class PayrollDate
{

    public $date;
    public $day;
    public $day_of_week;
    public $holiday;
    public $schedule;
    public $novelty;
    public $agentActivities;
    public $hrs_per_week;
    public $mandatory_res_day;
    public $id;
    public $employee_id;

    protected $count = 0;

    public $novedades_nomina;

    protected $parentClass;
    protected $employee;
    protected $timeWorkedOnHoliday = 0;
    
    protected $maxWorkingTimeForHolidays = 28800; // 8hrs 


    public function __construct($parentClass,$employee)
    {
        $this->parentClass = $parentClass;
        $this->employee = $employee;
        // $this->novedades_nomina = collect();
    }

    public function getPayroll()
    {
        $this->activity_lunch_time = $this->agentActivities->where('activity', 'Lunch')->sum('total_time');
        $this->activity_break_time = $this->agentActivities->where('activity', 'Break')->sum('total_time');
        $this->activity_total_time = $this->agentActivities->sum('total_time');

        // incapacidad = EG
        // vacaciones = VAC
        // licencia_remunerada = LR
        // licencia_no_remunerada = LNR
        // licencia_luto = LT
        // licencia_maternidad = LM
        // licencia_paternidad = LP
        // suspension = SUS

        if($this->novelty){
            switch ($this->novelty->contingency){
                case 'EG':
                    $this->novelty = ['type' => 'incapacidad', 'novelty' => $this->novelty];
                    break;
                case 'VAC':
                    $this->novelty = ['type' => 'vacaciones', 'novelty' => $this->novelty];
                    break;
                case 'LR':
                    $this->novelty = ['type' => 'licencia_remunerada', 'novelty' => $this->novelty];
                    break;
                case 'LNR':
                    $this->novelty =  ['type' => 'licencia_no_remunerada', 'novelty' => $this->novelty];
                    break;
                case 'LT':
                    $this->novelty = ['type' => 'licencia_luto', 'novelty' => $this->novelty];
                    break;
                case 'LM':
                    $this->novelty = ['type' => 'licencia_maternidad', 'novelty' => $this->novelty];
                    break;
                case 'LP':
                    $this->novelty = ['type' => 'licencia_paternidad', 'novelty' => $this->novelty];
                    break;
                case 'SUS':
                    $this->novelty = ['type' => 'suspension', 'novelty' => $this->novelty];
                    break;
                default:
                    $this->novelty = null;
                    break;
            }
        }

        $timeByActivity = [];
        $this->agentActivities->each(function ($activity) use (&$timeByActivity) {

            $start_date = $activity->start_date;
            $end_date = $activity->end_date;
            $boolBreakLunch = false;

            $dates = $this->getDates($activity);

            // Tiempo actual por actividad
            $actualTimeByActivity = $timeByActivity[$activity->activity] ?? 0;

            
            // if($activity->agent_activity_id == '785369'){
            //     dd($activity, $this->schedule,$dates, $this->agentActivities);
            // }
            for ($i = 0; $i < count($dates); $i++) {
                $this->i = $i;
                $date = [
                    "start_date" => ($i == 0 ? $start_date : $dates[$i - 1]),
                    "end_date" => $dates[$i],
                ];

                // Calcular cumplimiento de horas de Breack y Lunch
                if (in_array($activity->activity, ['Break', 'Lunch'])) {

                    $total_time = $this->diffInSeconds($date['start_date'], $date['end_date']);

                    // Sumar tiempo actual por actividad
                    $timeByActivity[$activity->activity] = $actualTimeByActivity + $total_time;

                    // Tiempo programado por actividad (Break o Lunch)
                    if ($this->schedule) {
                        $schedule_total_time = (float)($activity->activity == 'Break' ? $this->schedule->total_break_time : $this->schedule->lunch_time);
                    } else {
                        $schedule_total_time = (float)($activity->activity == 'Break' ? 1800 : 3600);
                    }

                    // Validar si el tiempo programado es menor al tiempo actual
                    if ($timeByActivity[$activity->activity] > $schedule_total_time) {
                        $diff = $schedule_total_time - $actualTimeByActivity; // Tiempo que falta para cumplir la programación
                        $end_date = date('Y-m-d H:i:s.000', strtotime("+$diff seconds", strtotime($date['start_date'])));

                        if ($actualTimeByActivity < $schedule_total_time) {
                            $this->addNovedadesNomina($activity->agent_activity_id, ($activity->activity == 'Lunch' ? 'Lunch' : 'Tiempo laborado'), $activity->activity, $date['start_date'], $end_date, $diff);
                            $this->addNovedadesNomina($activity->agent_activity_id, 'Inasistencia Hrs', $activity->activity, $end_date, $date['end_date'], $total_time - $diff);
                        } else {
                            $this->addNovedadesNomina($activity->agent_activity_id, 'Inasistencia Hrs', $activity->activity, $date['start_date'], $date['end_date'], (float) $total_time);
                        }
                        $boolBreakLunch = true;
                    }
                }

                // Si la actividad no es break ni lunch
                if (!$boolBreakLunch) {
                    if ($this->schedule) {

                        // Si la actividad es la primera del día y el start_date es mayor a la hora de entrada
                        if ($activity === $this->agentActivities->first() && $i == 0 && $date['start_date'] > $this->schedule->in) {
                            $this->addNovedadesNomina($activity->agent_activity_id, 'Inasistencia Hrs', $activity->activity, $this->schedule->in, $date['start_date']);
                            // dd($dates, $activity, $this->novedades_nomina);
                        }

                        if ($activity->activity != 'Logout' && ($date['start_date'] < $this->schedule->in ||  $date['end_date'] > $this->schedule->out)) {
                            // la actividad no es logout, y la fecha inicio es menor a la hora de entrada o la fecha de fin es mayor a la hora de salida
                            $this->addNovedadesNomina($activity->agent_activity_id, 'Tiempo pendiente aprobar', $activity->activity, $date['start_date'], $date['end_date']);
                        } else if (
                            $activity !== $this->agentActivities->last() &&
                            $activity->activity == 'Logout' &&
                            $date['end_date'] < $this->schedule->out &&
                            $date['end_date'] > $this->schedule->in
                        ) {
                            // Si la actividad es logout, no es la última y el end_date es menor a la hora de salida
                            $this->addNovedadesNomina($activity->agent_activity_id, 'Inasistencia Hrs', $activity->activity, $date['start_date'], $date['end_date']);
                        } else if ($activity->activity != 'Logout') {
                            // Si la actividad no es logout
                            $this->addNovedadesNomina($activity->agent_activity_id, 'Tiempo laborado', $activity->activity, $date['start_date'], $date['end_date']);
                        }

                        // Si la actividad es la última del día y el end_date es menor a la hora de salida
                        if (
                            $activity === $this->agentActivities->last() &&
                            $i == count($dates) - 1 &&
                            (($activity->activity == 'Logout' && $date['start_date'] < $this->schedule->out) ||
                                ($activity->activity != 'Logout' && $date['end_date'] < $this->schedule->out))
                        ) {
                            $this->addNovedadesNomina($activity->agent_activity_id, 'Inasistencia Hrs', $activity->activity, ($activity->activity == 'Logout' ?  $date['start_date'] :  $date['end_date']), $this->schedule->out);
                        }
                        // if($this->novedades_nomina->where('actividad','!=','Logout')->isEmpty()) {
                        //     $this->inasistencia = $this->date;
                        // }
                    } else {
                        if ($activity->activity != 'Logout') {
                            // Si la actividad no es logout
                            $this->addNovedadesNomina($activity->agent_activity_id, 'Tiempo laborado', $activity->activity, $date['start_date'], $date['end_date']);
                        }
                        // if (count($this->getDates($activity)) > 2 && !in_array($activity->agent_activity_id, ['597541', '600539', '603368'])) {
                        //     dd($this, $activity, $this->getDates($activity));
                        // }
                    }
                }
            }
        });

        if($this->count < 1 && $this->schedule && !$this->novelty){
            $this->novelty = ['type' => 'Inasistencia', 'novelty' => null];

            PayrollDayOffDiscount::firstOrCreate([
                'employee_id' => $this->employee_id,
                'date' => $this->getNextDateOfMandatoryResDay($this->date, $this->mandatory_res_day),
                'date_of_absence' => $this->date,
            ]);
        }


        return $this;
    }


    function getNextDateOfMandatoryResDay($date, $mandatory_res_day)
    {
        $day_of_week = date('N', strtotime($date));
        $days_to_add = $mandatory_res_day - $day_of_week;
        if ($days_to_add < 0) {
            $days_to_add = 7 + $days_to_add;
        }
        return date('Y-m-d', strtotime("+$days_to_add days", strtotime($date)));        
    }

    /**
     * @param $activity
     * return array
     */
    function getDates($activity)
    {
        $start_date = $activity->start_date;
        $end_date = $activity->end_date;
        $start_date_timestamp = strtotime($start_date);
        $end_date_timestamp = strtotime($end_date);
        $endDates = [];

        if ($activity->activity != 'Logout') {
            if ($this->schedule) {
                if ($start_date < $this->schedule->in && $end_date > $this->schedule->in) {
                    $endDates[] = $this->schedule->in;
                }
                if ($start_date < $this->schedule->out && $end_date > $this->schedule->out) {
                    $endDates[] = $this->schedule->out;
                }
            }
            if (
                $start_date < date('Y-m-d', $start_date_timestamp) . ' 21:00:00'
                && $end_date > date('Y-m-d', $start_date_timestamp) . ' 21:00:00'
                && (
                    !$this->schedule || 
                    (date('Y-m-d H:i:s', strtotime($this->schedule->out)) != date('Y-m-d', $start_date_timestamp) . ' 21:00:00' && 
                     date('Y-m-d H:i:s', strtotime($this->schedule->in)) != date('Y-m-d', $start_date_timestamp) . ' 21:00:00')
                    )
            ) {
                $endDates[] = date('Y-m-d', strtotime($start_date)) . ' 21:00:00.000';
            }
            
            if (
                $start_date < date('Y-m-d', $end_date_timestamp) . ' 06:00:00'
                && $end_date > date('Y-m-d', $end_date_timestamp) . ' 06:00:00'
                && (
                    !$this->schedule || 
                    (date('Y-m-d H:i:s', strtotime($this->schedule->out)) != date('Y-m-d', $end_date_timestamp) . ' 06:00:00' &&
                    date('Y-m-d H:i:s', strtotime($this->schedule->in)) != date('Y-m-d', $end_date_timestamp) . ' 06:00:00'
                    )
                    )
            ) {
                $endDates[] = date('Y-m-d', strtotime($end_date)) . ' 06:00:00.000';
            }
            if (date('Y-m-d', strtotime($start_date)) != date('Y-m-d', strtotime($end_date))) {
                $endDates[] = date('Y-m-d', strtotime($end_date)) . ' 00:00:00.000';
            }
        }
        $endDates[] = $end_date;

        usort($endDates, function ($a, $b) {
            return strtotime($a) - strtotime($b);
        });

        $this->endDates = $endDates;

        return $endDates;
    }

    function diffInSeconds($start, $end)
    {
        $start = strtotime($start);
        $end = strtotime($end);
        return abs($end - $start);
    }

    function addSecondsToDateTimeString($seconds, $dateTime){
        return date('Y-m-d H:i:s.000', strtotime("+$seconds seconds", strtotime($dateTime)));
    }

    private function addNovedadesNomina($activityId, $novedad, $actividad, $start_date, $end_date, $total_time = null)
    {
        if ($total_time === null) {
            $total_time = $this->diffInSeconds($start_date, $end_date);
        }

        $day_of_week = date('N', strtotime($start_date));
        $start_date_Ymd = date('Y-m-d', strtotime($start_date));
        $recargo = null;

        if($this->date == $start_date_Ymd){
            $holiday = $this->holiday;
        }else{
            $holiday = $this->parentClass->calendar->where('date',$start_date_Ymd)->where('holiday','1')->count()>0;
        }
        
        $is_holiday = $day_of_week == $this->mandatory_res_day || $holiday;
        $is_night = date('H:i:s', strtotime($start_date)) >= '21:00:00' || date('H:i:s', strtotime($start_date)) < '06:00:00';

        // Validar si es un dia festivo o son horas nocturnas
        if($is_holiday && $is_night) {
            $recargo = 'Nocturno Festivo';
        }else if($is_holiday && !$is_night) {
            $recargo = 'Festivo';
        }else if(!$is_holiday && $is_night) {
            $recargo = 'Nocturno';
        }else{
            $recargo = 'Diurno';
        }

        if($novedad == 'Tiempo laborado' && $actividad == 'Lunch') {
            $novedad = 'Lunch';
        }else if ($novedad == 'Tiempo laborado' && $actividad == 'Break' && ($this->schedule && $start_date >= $this->schedule->out)) {
            $novedad = 'Tiempo injustificado';
        }else if ($novedad == 'Inasistencia Hrs' && ($this->schedule && $start_date >= $this->schedule->out || $is_holiday)) {
            $novedad = 'Tiempo injustificado';
        }else if(!$this->schedule && $novedad == 'Tiempo laborado') {
            $novedad = 'Tiempo pendiente aprobar';
        }

        // Si es festivo, es tiempo laborado y la actividad es diferente a Break
        if($is_holiday && $novedad == 'Tiempo laborado' && $actividad != 'Break' ){
            // Si el tiempo laborado festivo + el tiempo actual es superior al maximo tiempo trabajado para los festivos
            if($this->timeWorkedOnHoliday + $total_time > $this->maxWorkingTimeForHolidays){
                if($this->timeWorkedOnHoliday < $this->maxWorkingTimeForHolidays){
                    // Tiempo que falta para completar el tiempo maximo laborado para los festivos
                    $diff = $this->maxWorkingTimeForHolidays - $this->timeWorkedOnHoliday;

                    $this->pushNovedadesNomina($activityId, $novedad, $actividad, $recargo, $start_date, $this->addSecondsToDateTimeString($diff, $start_date), $diff);
                    $this->pushNovedadesNomina($activityId, 'Hora Extra', $actividad, $recargo, $this->addSecondsToDateTimeString($diff,$start_date), $end_date, $total_time - $diff);
                }else{
                    $this->pushNovedadesNomina($activityId, 'Hora Extra', $actividad, $recargo, $start_date, $end_date, $total_time);
                }
                $this->timeWorkedOnHoliday += $total_time;
                return;
            }
            $this->timeWorkedOnHoliday += $total_time;
        }
        
        $this->pushNovedadesNomina($activityId, $novedad, $actividad, $recargo, $start_date, $end_date, $total_time);
    }

    private function pushNovedadesNomina($activityId, $novedad, $actividad, $recargo, $start_date, $end_date, $total_time)
    {
        // create hex id from start date and activity id
        $id = md5(Carbon::parse($start_date)->valueOf() . $activityId . $this->employee_id);

        $data = [
            'code' => $id,
            'payroll_id' => $this->id,
            'activity_id' => $activityId,
            'employee_id' => $this->employee_id,
            'date'=> $this->date,
            'activity_type' => $novedad,
            'activity_name' => $actividad,
            'surcharge' => $recargo,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'total_time_in_seconds' => $total_time
        ];



        $search = $this->employee->payroll_activities->where('code',$id);
        if($search->count()){
            return;
        }

        $this->employee->payroll_activities->push($data);

        $this->parentClass->payroll_activities->push($data);
        $this->count++;
    }
}
