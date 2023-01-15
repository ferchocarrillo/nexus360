<?php

namespace App\Http\Controllers;

use App\PayrollAdmin;
use Illuminate\Http\Request;

class PrenominaAdminController extends Controller
{
    function __construct()
    {
        $this->middleware('can:payroll.admin');
    }

    public function index()
    {
        $payrollAdmin = PayrollAdmin::all();
        $positions = $payrollAdmin->where('name','positions')->pluck('value')->first();
        $emailsReportAdjustmentsPending = $payrollAdmin->where('name','emails_reportadjustmentspending')->pluck('value')->first();
        $configs = [
            $payrollAdmin->where('name','days_before')->first(),
        ];
        return view('prenomina.admin.index', compact('positions','configs','emailsReportAdjustmentsPending'));
    }

    public function savePositions(Request $request){
        $payrollAdminList = PayrollAdmin::where('name','positions')->firstOrFail();
        $payrollAdminList->value = $request->positions;
        $payrollAdminList->save();
    }

    public function saveEmailsReportAdjustmentsPending(Request $request){
        $payrollAdminList = PayrollAdmin::where('name','emails_reportadjustmentspending')->firstOrFail();
        $payrollAdminList->value = $request->emailsReportAdjustmentsPending;
        $payrollAdminList->save();
    }

    public function saveConfigs(Request $request){
        $configsUpdates = collect($request->configsUpdates);
        $configsUpdates->each(function($c){
            PayrollAdmin::where('id',$c['id'])->update(['value'=>$c['value']]);
        });
        return response()->json(['result'=>'success']);
    }
}
