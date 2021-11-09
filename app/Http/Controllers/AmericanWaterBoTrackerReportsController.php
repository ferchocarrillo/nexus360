<?php

namespace App\Http\Controllers;

use App\Exports\AmericanWaterBoTrackerReporGeneralExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AmericanWaterBoTrackerReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:americanwater.botracker.reports.general')->only(['general','generalDownload']);
    }
    
    public function general(){
        return view('americanwater.reports.general');
    }

    public function generalDownload(Request $request){
        [$start_date, $end_date] = explode(" - ",$request->daterange);
        
        return Excel::download(new AmericanWaterBoTrackerReporGeneralExport($start_date,$end_date),"AmericanWaterBoTrackerReportGeneral".$start_date."-".$end_date.".xlsx");
    }

}
