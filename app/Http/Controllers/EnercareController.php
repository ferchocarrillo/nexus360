<?php

namespace App\Http\Controllers;

use App\EnercareCalltracker;
use App\EnercareCalltrackerReasonsNotPitchAndSales;
use App\EnercareCalltrackerCategory;
use App\EnercareCalltrackerPitchAndSale;
use App\EnercareCalltrackerPlan;
use App\EnercareRoster;
use App\Exports\EnercareCallTrackerReportExport;
use App\MasterFile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Exports\EnercareSalesReportExport;
use Maatwebsite\Excel\Facades\Excel;

class EnercareController extends Controller
{

    public function calltracker()
    {
        $sales =  EnercareCalltrackerPitchAndSale::leftjoin('enercare_calltrackers', 'enercare_calltracker_pitch_and_sales.call_id', 'enercare_calltrackers.id')
            ->leftjoin('enercare_calltracker_plans', 'enercare_calltracker_pitch_and_sales.plan', 'enercare_calltracker_plans.name')
            ->where('enercare_calltracker_pitch_and_sales.type', 'Sale')
            ->where('enercare_calltrackers.username', auth()->user()->username)
            ->where('enercare_calltracker_plans.valid_sales', 1)
            ->whereDate('enercare_calltrackers.created_at', '>=', Carbon::now()->addMonth(-1)->firstOfMonth())
            ->selectRaw('sum(case when convert(date,enercare_calltrackers.created_at,103) = convert(date,getdate(),103) then 1 else 0 end) [Today]
        ,sum(case when datepart(month,getdate()) = datepart(month,enercare_calltrackers.created_at) then 1 else 0 end) [ThisMonth]
        ,sum(case when datepart(month,DATEADD(month,-1,getdate())) = datepart(month,enercare_calltrackers.created_at) then 1 else 0 end) [LastMonth]')
            ->first();

        $notpitchandsales = EnercareCalltrackerReasonsNotPitchAndSales::where('active', 1)->select('name', 'type')->get();
        $plans = EnercareCalltrackerPlan::select('name')->get();
        $categories = EnercareCalltrackerCategory::select('category as text')->distinct()->get()->toArray();

        foreach ($categories as $key => $category) {
            $categories[$key]['id'] =  $categories[$key]['text'];
        }


        // $categories = EnercareCalltrackerCategory::where('active', 1)->distinct()->pluck('category', 'category')->toArray();
        $allcategories = EnercareCalltrackerCategory::pluck('category', 'subcategory');
        return view('Enercare.calltracker', compact(['categories', 'allcategories', 'notpitchandsales', 'plans', 'sales']));
    }

    public function calltrackerStore(Request $request)
    {
        $request->validate([
            'site_id' => ['required'],
            'category' => ['required'],
            'subcategory' => ['required'],
            'pitch' => ['required'],
            'sales' => [($request->checkPitch ? 'required' : 'nullable')],
        ]);

        $id = EnercareCalltracker::create(
            $request->merge([
                'username' => auth()->user()->username,
                'reason_not_pitch' => ($request->checkPitch ? null : $request->pitch),
                'reason_not_sale' => ($request->checkSale ? null : $request->sales)
            ])->only(['site_id', 'username', 'category', 'subcategory', 'reason_not_pitch', 'reason_not_sale'])
        )->id;


        if ($request->checkPitch) {
            foreach ($request->pitch as $plan) {
                $data[] = ['call_id' => $id, 'type' => 'Pitch', 'plan' => $plan,  'contract_id' => null,'upgrade'=> null];
            }
            if ($request->checkSale) {
                foreach ($request->sales as $sale) {
                    $data[] = ['call_id' => $id, 'type' => 'Sale', 'plan' => $sale['plan'], 'contract_id' => $sale['contract_id'],'upgrade'=> $sale['upgrade']];
                }
            }
            EnercareCalltrackerPitchAndSale::insert($data);
        }
        return redirect()->back()->with('info', 'Record saved successfully');
    }  

    public function reportSales()
    {
        $teamleaders = DB::select("
        SELECT b.full_name teamleader, c.username userteamleader
        FROM (
        SELECT supervisor FROM master_files 
        WHERE [status] = 'Active' AND campaign = 'Enercare' AND position = 'Agent'
        GROUP BY supervisor) a
        LEFT JOIN (SELECT * FROM master_files 
                    WHERE [status] = 'Active' AND campaign = 'Enercare' )b ON b.full_name = a.supervisor
        LEFT JOIN users c ON b.national_id = c.national_id
        where B.national_id is not null AND c.username is not null");
        
        return view('Enercare.Reports.sales',compact('teamleaders'));
    }

    protected function getqueryReportSales($startDate,$endDate,$teamleader){

        $query = DB::table('enercare_calltracker_pitch_and_sales')->leftJoin('enercare_calltrackers', 'enercare_calltracker_pitch_and_sales.call_id','=','enercare_calltrackers.id')
        ->leftjoin('enercare_calltracker_plans', 'enercare_calltracker_pitch_and_sales.plan', 'enercare_calltracker_plans.name')
        ->leftJoin('enercare.dbo.tbrosterenercare as b',function($join){
            $join->on('enercare_calltrackers.username','=','b.UserWeb');
            $join->on(DB::raw('CONVERT(date,enercare_calltrackers.created_at,103)'),'>=','b.startdate');
            $join->on(DB::raw('CONVERT(date,enercare_calltrackers.created_at,103)'),'<=',DB::raw('isnull(b.enddate,getdate())'));
        })
        ->select(   DB::raw('CONVERT(date,enercare_calltrackers.created_at,103) AS created_at')
                    ,'enercare_calltrackers.username AS agent'
                    ,'b.userteamleader AS supervisor'
                    ,'enercare_calltracker_pitch_and_sales.plan'
                    ,DB::raw('count(0) AS cant')
                )
        ->where('enercare_calltracker_pitch_and_sales.type', 'Sale')
        ->where('enercare_calltracker_plans.valid_sales', 1)
        ->whereNotNull('b.userteamleader')
        ->whereRaw("CONVERT(date,enercare_calltrackers.created_at,103) between '$startDate' and '$endDate'");


        if($teamleader != 'all'){
            $query = $query->where('b.userteamleader',$teamleader);
        }
        
        return $query->groupBy(  DB::raw('CONVERT(date,enercare_calltrackers.created_at,103)')
        ,'enercare_calltrackers.username'
        ,'b.userteamleader'
        ,'enercare_calltracker_pitch_and_sales.plan')->get();
    }


   

    public function getReportSales(Request $request){

        $query = $this->getqueryReportSales($request->startDate,$request->endDate,$request->teamleader);

        $total_sales = array_sum(array_column($query->toArray(),'cant'));

        $report = [
            'plan'=>[],
            'supervisor'=>[],
            'agent'=>[],
        ];

        foreach ($query as $sale) {
            $cant = (int) $sale->cant;

            $find_plan = array_search($sale->plan, array_column($report['plan'],"name"));
            if($find_plan === false){
                $report['plan'][]= (object) [
                    "name"=>$sale->plan,
                    "total"=> $cant
                ];
            }else{
                $report['plan'][$find_plan]->total += $cant;
            }

            $find_supervisor = array_search($sale->supervisor, array_column($report['supervisor'],"name"));
            if($find_supervisor === false){
                $report['supervisor'][]= (object) [
                    "name"=>$sale->supervisor,
                    "total"=> $cant
                ];
            }else{
                $report['supervisor'][$find_supervisor]->total += $cant;
            }

            $find_agent = array_search($sale->agent, array_column($report['agent'],"name"));
            if($find_agent === false){
                $report['agent'][]= (object) [
                    "name"=>$sale->agent,
                    "total"=> $cant
                ];
            }else{
                $report['agent'][$find_agent]->total += $cant;
            }
            
        }


        array_multisort(array_column($report['supervisor'],'total'),SORT_DESC,$report['supervisor']);
        array_multisort(array_column($report['agent'],'total'),SORT_DESC,$report['agent']);

        $chart = [
            "plan"=> [
                array_column($report['plan'],'name'),
                array_column($report['plan'],'total'),
            ],
            "agent"=> [
                array_column($report['agent'],'name'),
                array_column($report['agent'],'total'),
            ],
            "supervisor"=> [
                array_column($report['supervisor'],'name'),
                array_column($report['supervisor'],'total'),
            ],
        ];


        return view('Enercare.Reports.partials.resultsales',compact(['request','total_sales','chart']));
    }

    public function downloadreportSales($startDate,$endDate,$teamleader){

        $query = $this->getqueryReportSales($startDate,$endDate,$teamleader);

        return Excel::download(new EnercareSalesReportExport($query), "ReportSales_$startDate _ $endDate.xlsx");
    }

    public function reportCallTracker(){
        return view('Enercare.Reports.calltracker');
    }

    public function downloadrepoCallTracker(Request $request){

        $dates = explode(" - ",$request->daterange);

        $query = DB::table('enercare_calltrackers')
        ->leftJoin('enercare_calltracker_pitch_and_sales','enercare_calltrackers.id','=','enercare_calltracker_pitch_and_sales.call_id')
        ->select('enercare_calltrackers.id'
                ,'enercare_calltrackers.site_id'
                ,'enercare_calltrackers.username'
                ,'enercare_calltrackers.category'
                ,'enercare_calltrackers.subcategory'
                ,'enercare_calltrackers.reason_not_pitch'
                ,'enercare_calltrackers.reason_not_sale'
                ,'enercare_calltrackers.created_at'
                ,'enercare_calltracker_pitch_and_sales.type'
                ,'enercare_calltracker_pitch_and_sales.plan'
                ,'enercare_calltracker_pitch_and_sales.contract_id'
                ,'enercare_calltracker_pitch_and_sales.upgrade'
                )
        ->whereBetween(DB::raw('CONVERT(date,enercare_calltrackers.created_at)') ,$dates)
        ->get();


         if(count($query) == 0){
            return redirect()->back()->with('info', 'No results found');
         }
         
        return Excel::download(new EnercareCallTrackerReportExport($query), "ReportCallTracker_$dates[0] _ $dates[1].xlsx");
        
    }

    public function uploadAgentPerformance()
    {
        return view('Enercare.Uploads.agentperformance');
    }

    public function uploadAgentPerformancePost(Request $request)
    {
        $request->validate([
            'AgentPerformance' => 'required'
        ]);
        $fileName = auth()->user()->username . '_' . pathinfo(request()->AgentPerformance->getClientOriginalName(), PATHINFO_FILENAME) . '.' . request()->AgentPerformance->getClientOriginalExtension();
        request()->AgentPerformance->move('c:\users\dev\documents\temp\importssql\agentperformance', $fileName);
        $data = DB::connection('sqlsrvenercare')->select("SET NOCOUNT ON EXEC spImportAgentPerformanceEnercare");
        return redirect()->back()->with('data', $data);
    }
}
