<?php

namespace App\Http\Controllers;

use App\PayrollNoveltySmlv;
use Illuminate\Http\Request;

class PayrollNoveltyAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:payrollnovelty.admin');
    }

    public function index(){

        $smlvs_years = range(2017,date('Y')+1);
        $smlvs =  PayrollNoveltySmlv::get();
        $smlvs_yearsAvailable = array_diff($smlvs_years,$smlvs->pluck('year')->toArray());

        return view('payrollnovelty.admin.index',compact(['smlvs','smlvs_years','smlvs_yearsAvailable']));
    }

    public function smlvSave(Request $request){

        $request->validate([
            'action' => ['required'],
            'year' => ['required',($request->action=='store'?'unique:payroll_novelty_smlvs':'')],
            'salary' => ['required'],
        ],[
            'action.required'=>'La acción obligatoria',
            'year.required'=>'El año es obligatorio',
            'year.unique'=>'El año :input ya existe',
            'salary.required'=>'El salario es obligatorio',
        ]);

        if($request->action=='store'){
            PayrollNoveltySmlv::create($request->all());
            return redirect('payrollnovelty/admin')->with('info', 'SMLV creado exitosamente');
        }else{
            $smlv =  PayrollNoveltySmlv::findOrFail($request->year);
            $smlv->salary= $request->salary;
            $smlv->save();
            return redirect('payrollnovelty/admin')->with('info', 'SMLV actualizado exitosamente');
        }
    }
}
