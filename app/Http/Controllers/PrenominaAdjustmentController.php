<?php

namespace App\Http\Controllers;

use App\Classes\Prenomina;
use App\MasterFile;
use App\Payroll;
use App\PayrollActivity;
use App\PayrollAdjustment;
use App\PayrollAdjustmentException;
use App\PayrollAdjustmentType;
use App\PayrollDayOffDiscount;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrenominaAdjustmentController extends Controller
{
    function __construct()
    {
        $this->middleware('can:payroll')->only(['show','create','store','offsetHoliday','justifyAbsense']);
        $this->middleware('can:payroll.adjustments')->only(['index','pending','exception']);
        $this->middleware('can:payroll.om')->only(['approveAll']);
    }
        protected function pending(Request $request){
        if($request->ajax()){
            $data = [
                'OM'=>[],
                'Supervisor'=>[]
            ];

            $user = auth()->user();
            $permissionSupervisor = $user->can('payroll.supervisor');
            $permissionOM = $user->can('payroll.om');
            $permissionAdmin = $user->can('payroll.admin');

            $adjustments = PayrollAdjustment::withoutAppends()
                ->with([
                    'employee'=>function($query){
                        $query->select('id','full_name','supervisor','payroll_manager')
                        ->whereNull('termination_date');
                    }, 
                ])
                ->where('status','Pendiente')
                ->where(function($query)use($permissionSupervisor,$permissionOM,$permissionAdmin){
                    if($permissionSupervisor || $permissionAdmin){
                        $query->where(function($query){
                            $query->where('supervisor_approval_required', true)
                            ->whereNull('supervisor_approval_status');
                        });
                    }
                    if($permissionOM || $permissionAdmin){
                        $query->orWhere(function($query){
                            $query->where('om_approval_required', true)
                            ->whereNull('om_approval_status')
                            ->where('supervisor_approval_status', PayrollAdjustment::APPROVED_STATUS);
                        });
                    }
                })
                ->select(
                    'payroll_adjustments.id',
                    'payroll_adjustments.activity_code',
                    'payroll_adjustments.employee_id',
                    'payroll_adjustments.adjustment_type',
                    'payroll_adjustments.justification',
                    DB::raw("IIF([payroll_adjustments].[supervisor_approval_status] is null,'Supervisor','OM') as pending_for"),
                    'payroll_adjustments.date'
                    )
                ->get();

                if(!$permissionAdmin){
                    $filterEmployees = $user->employessAllHierarchy(true);
                    $employees = MasterFile::select('id')->whereNull('termination_date')->whereIn('national_id', $filterEmployees)->get()->pluck('id')->toArray();
                }else{
                    $employees = MasterFile::select('id')->whereNull('termination_date')->get()->pluck('id')->toArray();
                }
                $adjustments = $adjustments->whereIn('employee_id',$employees)->values();

                if($permissionSupervisor || $permissionAdmin){
                    $data['Supervisor']['adjustments'] = $adjustments->where('pending_for','Supervisor')->values();
                    $data['Supervisor']['count'] = $data['Supervisor']['adjustments']->count();
                    $data['Supervisor']['adjustments'] = $data['Supervisor']['adjustments']->groupBy('employee_id');
                }
                if($permissionOM || $permissionAdmin){
                    $data['OM']['adjustments'] = $adjustments->where('pending_for','OM')->values();
                    $data['OM']['count'] = $data['OM']['adjustments']->count();
                    $data['OM']['adjustments'] = $data['OM']['adjustments']->groupBy('employee_id');
                }

            return response()->json($data); 
        }
        abort(401);
    }


    protected function filterEmployees($user){
        // $user = auth()->user();
        $permissionSupervisor = $user->can('payroll.supervisor');
        $permissionOM = $user->can('payroll.om');
        $permissionAdmin = $user->can('payroll.admin');

        if($permissionAdmin){
            $filterEmployees = [];
        }else if($permissionSupervisor || $permissionOM){
            $filterEmployees = $user->employessAllHierarchy(true);
        }else{
            $filterEmployees = [$user->national_id];
        }

        return $filterEmployees;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        $permissionOM = $user->can('payroll.om');
        $permissionSupervisor = $user->can('payroll.supervisor');

        return view('prenomina.adjustments.index', compact('permissionOM', 'permissionSupervisor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show( $adjustment)
    {
        $adjustment = PayrollAdjustment::withoutAppends()->where('payroll_adjustments.id', $adjustment)
        ->leftJoin('payrolls','payrolls.id', '=', 'payroll_adjustments.payroll_id')
        ->select('payroll_adjustments.*','payrolls.date as payroll_date')
        ->firstOrFail();

        $user = auth()->user();

        $filterEmployees = $this->filterEmployees($user);
        
        if($adjustment->payroll_date){
            $payroll = Payroll::where('date',$adjustment->payroll_date)
                ->where('employee_id',$adjustment->employee_id)
                ->firstOrFail();
            $national_id = $payroll->national_id;
        }else{
            $payroll_activity = PayrollActivity::withoutAppends()->where('code', $adjustment->activity_code)->firstOrFail();
            $adjustment->payroll_activity = $payroll_activity;
            $national_id = $payroll_activity->payroll->national_id;
        }
        // Validar si el Employee ID logueado es igual al del PayrollActivity
        if($filterEmployees != [] && !in_array($national_id, $filterEmployees) ) abort(401);

        $approval_statuses = PayrollAdjustment::APPROVAL_STATUSES;

        $approved_status = PayrollAdjustment::APPROVED_STATUS;

        $permissionOM = $user->can('payroll.om');
        $permissionSupervisor = $user->can('payroll.supervisor');

        return view('prenomina.adjustments.show', compact('adjustment', 'approval_statuses', 'approved_status','permissionOM', 'permissionSupervisor'));
    }

    
    public function create($activity_code)
    {
        $payroll_activity = PayrollActivity::where('code', $activity_code)->firstOrFail();
        $user = auth()->user();
        $prenomina = new Prenomina();

        // Validar si el usuario logueado tiene permiso de OM o de Supervisor y es el ultimo dia de la quincena.
        $today = date('Y-m-d');
        $supervisorCanCreateAdjustments = (($user->can('payroll.om') || $user->can('payroll.supervisor')) && 
            ($today == $prenomina->endDateQ || $today == $prenomina->endDate));

        // Validar si el Employee ID logueado es igual al del PayrollActivity
        if($user->masterfile2[0]->id != $payroll_activity->employee_id && !$supervisorCanCreateAdjustments) abort(401);

        $adjustmentTypes = PayrollAdjustmentType::where('activity_type', $payroll_activity->activity_type)->get()->groupBy('adjustment_type');

        $adjustmentTypes = $adjustmentTypes->map(function ($item, $key) {
            return $item->map(function ($item, $key) {
                return $item->justification;
            });
        });

        $types = $adjustmentTypes->mapWithKeys(function ($item, $key) {
            return [$key => $key];
        });

        return view('prenomina.adjustments.create', compact('payroll_activity', 'adjustmentTypes', 'types'));
    }

    public function store(Request $request)
    {
        $payroll_activity = PayrollActivity::where('code', $request->activity_code)->firstOrFail();
        $user = auth()->user();
        $prenomina = new Prenomina();

        // Validar si el usuario logueado tiene permiso de OM o de Supervisor y es el ultimo dia de la quincena.
        $today = date('Y-m-d');
        $supervisorCanCreateAdjustments = (($user->can('payroll.om') || $user->can('payroll.supervisor')) && 
            ($today == $prenomina->endDateQ || $today == $prenomina->endDate));

        // Validar si el Employee ID logueado es igual al del PayrollActivity
        if($user->masterfile2[0]->id != $payroll_activity->employee_id && !$supervisorCanCreateAdjustments) abort(401);

        $adjustmentType = PayrollAdjustmentType::where('activity_type', $payroll_activity->activity_type)
            ->where('adjustment_type', $request->adjustment_type)
            ->where('justification', $request->justification)
            ->firstOrFail();

        $adjustment = PayrollAdjustment::create($request->merge([
            'created_by' => $user->id,
            'activity_code' => $payroll_activity->code,
            'employee_id' => $payroll_activity->employee_id,
            'supervisor_approval_required' => 1,
            'om_approval_required' => $adjustmentType->approve_by_om,
            'status' => 'Pendiente',
            'date' => $payroll_activity->date,
            ])->all()
        );

        // return success
        return response()->json(['success' => true]);
    }

    public function approve(Request $request,  $id)
    {
        // Validator
        $validator = \Validator::make($request->all(), [
            'approval_status' => 'required|in:approved,rejected',
            'approval_comment' => 'required|max:255|string',
        ]);

        $adjustment = PayrollAdjustment::findOrFail($id);
        $payroll_activity = $adjustment->payroll_activity;

        if($payroll_activity && $request->approved_time > $payroll_activity->total_time_in_seconds){
            $request->approved_time = $payroll_activity->total_time_in_seconds;
        }
        if($payroll_activity && $request->adjustment_approval_status == PayrollAdjustment::APPROVED_STATUS && !$adjustment->approved_time){
            $adjustment->approved_time = $request->approved_time;
        }
        $user = auth()->user();

        if (
            $user->can('payroll.om') && $adjustment->om_approval_required &&
            $adjustment->om_approval_status == null && $adjustment->supervisor_approval_status == PayrollAdjustment::APPROVED_STATUS
        ) {

            $adjustment->om_approval_status = $request->adjustment_approval_status;
            $adjustment->om_approval_date = now();
            $adjustment->om_approval_user_id = $user->id;
            $adjustment->om_approval_comment = $request->adjustment_comments;
            $adjustment->status = $request->adjustment_approval_status;
            $adjustment->save();
            if($adjustment->adjustment_type == "Inasistencia Justificada" && $adjustment->status == PayrollAdjustment::APPROVED_STATUS ){
                $payroll= Payroll::where('id',$adjustment->activity_code)->first();
                PayrollDayOffDiscount::where('employee_id',$payroll->employee_id)->where('date_of_absence',$payroll->date)->delete();
            }
        } else if (
            $user->can('payroll.supervisor') && $adjustment->supervisor_approval_required &&
            $adjustment->supervisor_approval_status == null
        ) {

            $adjustment->supervisor_approval_status = $request->adjustment_approval_status;
            $adjustment->supervisor_approval_date = now();
            $adjustment->supervisor_approval_user_id = $user->id;
            $adjustment->supervisor_approval_comment = $request->adjustment_comments;
            $adjustment->status = $adjustment->om_approval_required && $request->adjustment_approval_status == PayrollAdjustment::APPROVED_STATUS  ? 'Pendiente' :  $request->adjustment_approval_status;
            $adjustment->save();
        } else {
            return abort(401);
            // return response()->json(['error' => 'No tienes permiso para aprobar esta solicitud']);
        }

        return back();
    }

    public function approveAll(Request $request)
    {
        $employee_id = $request->employee_id;

        $adjustments = PayrollAdjustment::where('om_approval_required', true)
            ->whereNull('om_approval_status')
            ->where('supervisor_approval_status', PayrollAdjustment::APPROVED_STATUS)
            ->where('employee_id', $employee_id);
        
        $adjustments->get()->where('adjustment_type','Inasistencia Justificada')->each(function($adjustment){
            $payroll= Payroll::where('id',$adjustment->activity_code)->first();
            PayrollDayOffDiscount::where('employee_id',$payroll->employee_id)->where('date_of_absence',$payroll->date)->delete();
        });

        $adjustments->update([
            'om_approval_status' => PayrollAdjustment::APPROVED_STATUS,
            'om_approval_date' => now(),
            'om_approval_user_id' => auth()->user()->id,
            'om_approval_comment' => 'Aprobado automáticamente',
            'status' => PayrollAdjustment::APPROVED_STATUS,
        ]);

        return response()->json(['success' => true]);
    }

    public function offsetHoliday(Request $request)
    {
        $payroll = Payroll::where("employee_id",$request->employee_id)
            ->where("date",$request->date)
            ->firstOrFail();

        $user = auth()->user();

        // Validar si el Employee ID logueado es igual al del Payroll
        if($user->national_id == $payroll->employee_id) abort(401);

        if($payroll->is_holiday && substr($payroll->schedule['in'],0,10) == substr($payroll->schedule['out'],0,10)){

            $adjustment = PayrollAdjustment::where("employee_id",$payroll->employee_id)
            ->where("activity_code",strval($payroll->id))
            ->get();

            if($adjustment->count() === 0){
                $adjustment = PayrollAdjustment::firstOrCreate([
                    'activity_code' => $payroll->id,
                    'employee_id' => $payroll->employee_id,
                    'adjustment_type' => 'Festivo Compensado',
                    'justification' => 'Festivo Compensado',
                    'observations' => $request->observations,
                    'supervisor_approval_required' => 1,
                    'supervisor_approval_status' => PayrollAdjustment::APPROVED_STATUS,
                    'supervisor_approval_date' => now(),
                    'supervisor_approval_user_id' => $user->id,
                    'supervisor_approval_comment' => $request->observations,
                    'om_approval_required' => 1,
                    'payroll_id' => $payroll->id,
                    'date' => $payroll->date,
                    'status' => 'Pendiente',
                ]);
            }

            return response()->json(['success' => true]);
        }

        abort(401);        
    }

    public function justifyAbsense(Request $request){

        $payroll = Payroll::findOrFail($request->id);
        $user = auth()->user();

        // Validar si el Employee ID logueado es igual al del Payroll
        if($user->national_id == $payroll->national_id) abort(401);

        $adjustment = PayrollAdjustment::where("employee_id",$payroll->employee_id)
            ->where("activity_code",strval($payroll->id))
            ->get();

        if($payroll->novelty && $payroll->novelty['type'] == 'Inasistencia' && $adjustment->count() === 0){
            $adjustment = PayrollAdjustment::firstOrCreate([
                'activity_code' => $payroll->id,
                'employee_id' => $payroll->employee_id,
                'adjustment_type' => 'Inasistencia Justificada',
                'justification' => $request->justification,
                'observations' => $request->observations,
                'supervisor_approval_required' => 1,
                'supervisor_approval_status' => PayrollAdjustment::APPROVED_STATUS,
                'supervisor_approval_date' => now(),
                'supervisor_approval_user_id' => $user->id,
                'supervisor_approval_comment' => $request->observations,
                'om_approval_required' => 1,
                'payroll_id' => $payroll->id,
                'date' => $payroll->date,
                'status' => 'Pendiente',
            ]);
            return response()->json(['success' => true]);
        }

        abort(401);  
    }

    public function exception(Request $request){
        $payroll = Payroll::findOrFail($request->id);
        $user = auth()->user();

        // Validar si el Employee ID logueado es igual al del Payroll
        if($user->national_id == $payroll->national_id) abort(401);
        
        $payrollAdjustmentException =  PayrollAdjustmentException::firstOrCreate([
            "employee_id" => $payroll->employee_id,
            "payroll_id" => $payroll->id,
            "date" => $payroll->date,
            "created_by" => $user->id,
        ]);

        return response()->json($payrollAdjustmentException);
    }
}
