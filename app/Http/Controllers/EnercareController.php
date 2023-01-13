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

        $notpitchandsales = EnercareCalltrackerReasonsNotPitchAndSales::where('active', 1)->get();
        $plans = EnercareCalltrackerPlan::pluck('name');
        $allcategories = EnercareCalltrackerCategory::where('active',1)
        ->orderBy('lob')
        ->orderBy('category')
        ->orderBy('subcategory')
        ->get();
        return view('Enercare.calltracker', compact(['allcategories', 'notpitchandsales', 'plans', 'sales']));
    }

    public function calltrackerStore(Request $request)
    {
        $request->validate([
            'site_id' => ['required'],
            'lob' => ['required'],
            'service_call' => ['required'],
            'category' => ['required'],
            'subcategory' => ['required'],
            'pitch' => ['required'],
            'sales' => [($request->checkPitch ? 'required' : 'nullable')],
            'observations' => ['nullable','max:255' ]
        ]);

        $id = EnercareCalltracker::create(
            $request->merge([
                'username' => auth()->user()->username,
                'reason_not_pitch' => ($request->checkPitch ? null : $request->pitch),
                'reason_not_sale' => ($request->checkSale ? null : $request->sales)
            ])->only(['site_id','lob','service_call','username', 'category', 'subcategory', 'reason_not_pitch', 'reason_not_sale','observations'])
        )->id;


        if ($request->checkPitch) {
            foreach ($request->pitch as $plan) {
                $data[] = ['call_id' => $id, 'type' => 'Pitch', 'plan' => $plan,  'contract_id' => null,'upgrade'=> null,'rwh'=>null,'bogo'=>null,'repairplan'=>null];
            }
            if ($request->checkSale) {
                foreach ($request->sales as $sale) {
                    $data[] = ['call_id' => $id, 'type' => 'Sale', 'plan' => $sale['plan'], 'contract_id' => $sale['contract_id'],'upgrade'=> $sale['upgrade'],'rwh'=> $sale['rwh'],'bogo'=> $sale['bogo'],'repairplan'=> $sale['repairplan']];
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
        WHERE [status] = 'Active' AND campaign like 'Enercare%' AND position like 'Agent%'
        GROUP BY supervisor) a
        LEFT JOIN (SELECT * FROM master_files 
                    WHERE [status] = 'Active' )b ON b.full_name = a.supervisor
        LEFT JOIN users c ON b.national_id = c.national_id
        where B.national_id is not null AND c.username is not null");
        
        return view('Enercare.Reports.sales',compact('teamleaders'));
    }

    protected function getqueryReportSales($startDate,$endDate,$teamleader){

        $query = DB::table('enercare_calltracker_pitch_and_sales')->leftJoin('enercare_calltrackers', 'enercare_calltracker_pitch_and_sales.call_id','=','enercare_calltrackers.id')
        ->leftjoin('enercare_calltracker_plans', 'enercare_calltracker_pitch_and_sales.plan', 'enercare_calltracker_plans.name')
        ->leftJoin('enercare.dbo.VwTbrosterUnionHistorico as b',function($join){
            $join->on('enercare_calltrackers.username','=','b.UserWeb');
            $join->on(DB::raw('CONVERT(date,enercare_calltrackers.created_at,103)'),'>=','b.startdate');
            $join->on(DB::raw('CONVERT(date,enercare_calltrackers.created_at,103)'),'<',DB::raw('isnull(b.enddate,getdate())'));
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
        array_multisort(array_column($report['plan'],'total'),SORT_DESC,$report['plan']);

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

    public function downloadreportCallTracker(Request $request){

        $dates = explode(" - ",$request->daterange);

        $diff_in_days = Carbon::createFromFormat('Y-m-d',$dates[0])->diffInDays(Carbon::createFromFormat('Y-m-d',$dates[1]));

        if($diff_in_days > 31){
            return redirect()->back()->with('error', 'You cannot consult more than 30 days');
        }

        $query = DB::table('enercare_calltrackers')
        ->leftJoin('enercare_calltracker_pitch_and_sales','enercare_calltrackers.id','=','enercare_calltracker_pitch_and_sales.call_id')
        ->leftJoin('enercare.dbo.VwTbrosterUnionHistorico as b',function($join){
            $join->on('enercare_calltrackers.username','=','b.UserWeb');
            $join->on(DB::raw('CONVERT(date,enercare_calltrackers.created_at,103)'),'>=','b.startdate');
            $join->on(DB::raw('CONVERT(date,enercare_calltrackers.created_at,103)'),'<',DB::raw('isnull(b.enddate,getdate())'));
        })
        ->select('enercare_calltrackers.id'
                ,'enercare_calltrackers.site_id'
                ,'enercare_calltrackers.username'
                ,'b.teamleader AS supervisor'
                ,'enercare_calltrackers.lob'
                ,'enercare_calltrackers.service_call'
                ,'enercare_calltrackers.category'
                ,'enercare_calltrackers.subcategory'
                ,'enercare_calltrackers.reason_not_pitch'
                ,'enercare_calltrackers.reason_not_sale'
                ,'enercare_calltrackers.created_at'
                ,'enercare_calltrackers.observations'
                ,'enercare_calltracker_pitch_and_sales.type'
                ,'enercare_calltracker_pitch_and_sales.plan'
                ,'enercare_calltracker_pitch_and_sales.contract_id'
                ,'enercare_calltracker_pitch_and_sales.upgrade'
                ,'enercare_calltracker_pitch_and_sales.rwh'
                ,'enercare_calltracker_pitch_and_sales.bogo'
                ,'enercare_calltracker_pitch_and_sales.repairplan'
                ,DB::raw("CASE 
                        WHEN enercare_calltracker_pitch_and_sales.[type] = 'Sale' 
                            AND enercare_calltracker_pitch_and_sales.upgrade <> 1 
                            AND enercare_calltracker_pitch_and_sales.rwh <> 1 
                            AND enercare_calltracker_pitch_and_sales.bogo <> 1 
                            AND enercare_calltracker_pitch_and_sales.repairplan <> 1                             
                            THEN 'NEW'
                        WHEN enercare_calltracker_pitch_and_sales.[type] = 'Sale' AND enercare_calltracker_pitch_and_sales.rwh = 1 THEN 'RWH'
                        WHEN enercare_calltracker_pitch_and_sales.[type] = 'Sale' AND enercare_calltracker_pitch_and_sales.upgrade = 1 THEN 'UPGRADE'
                        WHEN enercare_calltracker_pitch_and_sales.[type] = 'Sale' AND enercare_calltracker_pitch_and_sales.bogo = 1 THEN 'BOGO'
                        WHEN enercare_calltracker_pitch_and_sales.[type] = 'Sale' AND enercare_calltracker_pitch_and_sales.repairplan = 1 THEN 'REPAIR PLAN'
                        ELSE null
                        END AS [TypeSale]
                        ")
                )
        ->whereDate('enercare_calltrackers.created_at','>=',$dates[0])
        ->whereDate('enercare_calltrackers.created_at','<=',$dates[1]);

        if(auth()->user()->hasRole('enercare-agent')){
            $query->where('enercare_calltrackers.username',auth()->user()->username);
        }
        $query = $query->get();


         if(count($query) == 0){
            return redirect()->back()->with('info', 'No results found');
         }
         
        return Excel::download(new EnercareCallTrackerReportExport($query), "ReportCallTracker_$dates[0] _ $dates[1].xlsx");
        
    }

    public function reportkpis(){

    $waves = DB::table('enercare.dbo.VwTbrosterUnionHistorico')
            ->whereNull('EndDate')
            ->whereNotNull('Wave')
            ->where('wave','<>','')
            ->select('Wave')
            ->groupBy('Wave')
        ->get();
        return view('Enercare.Reports.kpis',compact(['waves']));
    }

    public function reportkpisPOST(Request $request){



        $calculations = ",sum(num_calls_answered) [Total Calls Answered]
        ,sum([".($request->checkLOB == "true" ? "num_calls_answered_SALES" : "num_calls_answered_GeneralSales")."]) [Total Calls Answered SALES]
        ,sum([Transfers]) [Transfers]
        ,sum([Handling Time]) [Handling Time]
        ,sum(SalesTracker_TotalUsage) TotalUsage
        ,sum(SalesTracker_TotalPitch) TotalPitch
        ,sum(SalesTracker_TotalSales) TotalSales
        ,case when sum([num_calls_answered]) = 0 then null else cast(round((sum([Handling Time])*1.00/sum([num_calls_answered]) *1.00),0) as int) end AHT
        ,case when  sum([num_calls_answered]) = 0 then null else cast(cast(((sum([Transfers]) *1.00/sum([num_calls_answered])*1.00) *100)as decimal(18,2)) as varchar(10)) + '%' end [Transfers Rate]
        ,case when   sum([".($request->checkLOB == "true" ? "num_calls_answered_SALES" : "num_calls_answered_GeneralSales")."]) = 0 then null else cast(cast(((sum(SalesTracker_TotalSales) *1.00/sum([".($request->checkLOB == "true" ? "num_calls_answered_SALES" : "num_calls_answered_GeneralSales")."])*1.00) *100)as decimal(18,2)) as varchar(10)) + '%' end [Sales Conversion]
        ,case when   sum([num_calls_answered]) = 0 then null else cast(cast(((sum(SalesTracker_TotalUsage) *1.00/sum([num_calls_answered])*1.00) *100)as decimal(18,2)) as varchar(10)) + '%' end [Usage]
        ,case when   sum([".($request->checkLOB == "true" ? "num_calls_answered_SALES" : "num_calls_answered_GeneralSales")."]) = 0 then null else cast(cast(((sum(SalesTracker_TotalPitch) *1.00/sum(".($request->checkLOB == "true" ? "num_calls_answered_SALES" : "num_calls_answered_GeneralSales").")*1.00) *100)as decimal(18,2)) as varchar(10)) + '%' end [Pitch] ";
    
        $columns = "convert(varchar(10),DateCreated,23) DateCreated ";
        $group = "convert(varchar(10),DateCreated,23) ";
        $columns .= ($request->checkLOB == "true" ? ",lob as LOB " : "").($request->checkOM == "true" ? ",OM " : "").($request->checkSupervisor == "true" ? ",Teamleader " : "").($request->checkAgent == "true" ? ",username as [Username] " : "");
        $group .= ($request->checkLOB == "true" ? ",lob " : "").($request->checkOM == "true" ? ",OM " : "").($request->checkSupervisor == "true" ? ",Teamleader " : "").($request->checkAgent == "true" ? ",username " : "");


        $date = date('Y-m-d');
        // $date = date('Y-m-d',strtotime('2020-09-21'));


        $query = DB::table('enercare.dbo.TBEnercareKPIsGeneral')
        ->whereDate('DateCreated','=',$date);
        
        if($request->wave){
            $query = $query->where('Wave',$request->wave);
        }



        $query = $query->selectRaw("$columns $calculations")
                ->groupBy(DB::raw("$group"))->get() ;

        return view('Enercare.Reports.partials.resultkpis',compact(['query']));
    }

    public function uploadAgentPerformance()
    {
        return view('Enercare.Uploads.agentperformance');
    }

    public function uploadAgentPerformancePost(Request $request)
    {
        set_time_limit(300);
        $request->validate([
            'AgentPerformance' => 'required'
        ]);

        DB::connection('sqlsrvenercare')->statement("EXEC spReportKPIS ?,?",array(date('Y-m-d'),date('Y-m-d')));

        $fileName = auth()->user()->username . '_' . pathinfo(request()->AgentPerformance->getClientOriginalName(), PATHINFO_FILENAME) . '.' . request()->AgentPerformance->getClientOriginalExtension();
        request()->AgentPerformance->move(config('app.path_imports_sql').'Enercare\AgentPerformance', $fileName);
        $data = DB::connection('sqlsrvenercare')->select("SET NOCOUNT ON EXEC spImportAgentPerformanceEnercare");

        return redirect()->back()->with('data', $data);
    }
}
