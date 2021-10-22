<?php

namespace App\Http\Controllers;

use App\Exports\PayrollNoveltyReportExport;
use App\Exports\PayrollNoveltyReportGeneralExport;
use App\PayrollNovelty;
use App\PayrollNoveltySmlv;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PayrollNoveltyReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:payrollnovelty.reports.novelties')->only(['novelties','noveltiesDownload']);
        $this->middleware('can:payrollnovelty.reports.general')->only(['general','generalDownload']);
    }

    public function novelties(){
        return view('payrollnovelty.reports.novelties');
    }

    public function noveltiesDownload(Request $request){

        $request->validate([
            'start_date'=>['required']
        ]);
        return Excel::download(new PayrollNoveltyReportExport($request->start_date), "PayrollNoveltiesReport".date('YmdHis').".xlsx");
    }

    public function general(){
        return view('payrollnovelty.reports.general');
    }

    public function generalDownload(){

        return Excel::download(new PayrollNoveltyReportGeneralExport(), "PayrollNoveltiesReportGeneral".date('YmdHis').".xlsx");
        
    }
}
