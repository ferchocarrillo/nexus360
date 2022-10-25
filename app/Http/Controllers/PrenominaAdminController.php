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
        $positions = PayrollAdmin::where('name','positions')->pluck('value')->first();
        return view('prenomina.admin.index', compact('positions'));
    }

    public function savePositions(Request $request){
        $payrollAdminList = PayrollAdmin::where('name','positions')->firstOrFail();
        $payrollAdminList->value = $request->positions;
        $payrollAdminList->save();
    }
}
