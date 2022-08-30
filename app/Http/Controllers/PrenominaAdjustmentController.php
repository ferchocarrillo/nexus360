<?php

namespace App\Http\Controllers;

use App\MasterFile;
use App\Payroll;
use App\PayrollActivity;
use App\PayrollAdjustment;
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
        $this->middleware('can:payroll.adjustments')->only(['index',]);
        $this->middleware('can:payroll.om')->only(['pendingForOM','approveAll']);
        $this->middleware('can:payroll.supervisor')->only(['pendingForSupervisor']);
    }
    // Get all payroll adjustments pending for OM approval
    public function pendingForOM()
    {
        // if ajax
        if (request()->ajax()) {
            $user = auth()->user();
            if($user->can('payroll.admin')){
                $employees = MasterFile::whereNull('termination_date')->get('id')->toArray();
            }else{
                $filterEmployees = auth()->user()->employessAllHierarchy(true);
                $employees = MasterFile::whereIn('national_id', $filterEmployees)->get('id')->toArray();
            }
            $employees = array_column($employees,'id');
            
            $adjustments = PayrollAdjustment::with('employee', 'payroll_activity')->where('om_approval_required', true)
                ->whereNull('om_approval_status')
                ->where('supervisor_approval_status', PayrollAdjustment::APPROVED_STATUS)
                ->leftJoin('payrolls',DB::raw('CAST(payrolls.id as varchar)'), '=', 'payroll_adjustments.activity_code')
                ->select('payroll_adjustments.*','payrolls.date as payroll_date')
                ->get();

            $adjustments = $adjustments->whereIn('employee_id',$employees)->values()->groupBy('employee_id');

            // Count all adjustments pending for OM approval
            $count = 0;
            foreach ($adjustments as $adjustment) {
                $count += count($adjustment);
            }

            return response()->json([
                'adjustments' => $adjustments,
                'count' => $count,
            ]);
        }
        abort(401);
    }

    // Get all payroll adjustments pending for Supervisor approval
    public function pendingForSupervisor()
    {
        // if ajax
        if (request()->ajax()) {
            $user = auth()->user();
            if($user->can('payroll.admin')){
                $employees = MasterFile::whereNull('termination_date')->get('id')->toArray();
            }else{
                $filterEmployees = auth()->user()->employessAllHierarchy(true);
                $employees = MasterFile::whereIn('national_id', $filterEmployees)->get('id')->toArray();
            }
            $employees = array_column($employees,'id');

            $adjustments = PayrollAdjustment::with('employee', 'payroll_activity')->where('supervisor_approval_required', true)
                ->whereNull('supervisor_approval_status')
                ->leftJoin('payrolls',DB::raw('CAST(payrolls.id as varchar)'), '=', 'payroll_adjustments.activity_code')
                ->select('payroll_adjustments.*','payrolls.date as payroll_date')
                ->get();

            $adjustments = $adjustments->whereIn('employee_id',$employees)->values()->groupBy('employee_id');

            // Count adjustments per employee
            $count = 0;
            foreach ($adjustments as $adjustment) {
                $count += count($adjustment);
            }
            return response()->json([
                'adjustments' => $adjustments,
                'count' => $count
            ]);
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
        $adjustment = PayrollAdjustment::where('payroll_adjustments.id', $adjustment)
        ->leftJoin('payrolls',DB::raw('CAST(payrolls.id as varchar)'), '=', 'payroll_adjustments.activity_code')
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
            $payroll_activity = PayrollActivity::where('code', $adjustment->activity_code)->firstOrFail();
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

        // Validar si el Employee ID logueado es igual al del PayrollActivity
        if(auth()->user()->masterfile2[0]->id != $payroll_activity->employee_id) abort(401);

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

        // Validar si el Employee ID logueado es igual al del PayrollActivity
        if(auth()->user()->masterfile2[0]->id != $payroll_activity->employee_id) abort(401);

        $adjustmentType = PayrollAdjustmentType::where('activity_type', $payroll_activity->activity_type)
            ->where('adjustment_type', $request->adjustment_type)
            ->where('justification', $request->justification)
            ->firstOrFail();

        $adjustment = PayrollAdjustment::create($request->merge([
            'activity_code' => $payroll_activity->code,
            'employee_id' => $payroll_activity->employee_id,
            'supervisor_approval_required' => 1,
            'om_approval_required' => $adjustmentType->approve_by_om
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

        $user = auth()->user();

        if (
            $user->can('payroll.om') && $adjustment->om_approval_required &&
            $adjustment->om_approval_status == null && $adjustment->supervisor_approval_status == PayrollAdjustment::APPROVED_STATUS
        ) {

            $adjustment->om_approval_status = $request->adjustment_approval_status;
            $adjustment->om_approval_date = now();
            $adjustment->om_approval_user_id = $user->id;
            $adjustment->om_approval_comment = $request->adjustment_comments;
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
            'om_approval_comment' => 'Aprobado automáticamente'
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
                    'om_approval_required' => 1
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
                'om_approval_required' => 1
            ]);
            return response()->json(['success' => true]);
        }

        abort(401);  
    }
}
