<?php

namespace App\Http\Controllers;

use App\Exports\PayrollNoveltyFlatFileExport;
use App\PayrollNovelty;
use App\PayrollNoveltyCie10;
use App\PayrollNoveltyList;
use App\PayrollNoveltySmlv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PayrollNoveltyController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:payrollnovelty')->only(['cie10s','findemployee','index','create','store','update']);
        $this->middleware('can:payrollnovelty.flatfile')->only(['downloadFlatFile','updateTags','noveltiesFlatFile']);
    }

    public function cie10s(Request $request){
        if($request->ajax()){
            $cie10 = $request->term;
            $cie10s = PayrollNoveltyCie10::where('cod','LIKE',"%{$cie10}%")->select('cod as id','description as text')->toBase()->get();
            return $cie10s;
        }
    }
    public function findemployee(Request $request){
        if($request->ajax()){
            $employee_data = DB::connection('sqlsrvmasterfile')
            ->table('masterquery')
            ->select(
                'id',
                'national_id',
                'full_name',
                'pep',
                'date_of_hire',
                'campaign',
                'eps',
                'supervisor',
                DB::raw('CONVERT(int,round(basic_salary_cop,0)) as basic_salary_cop'))
                ->where('id',$request->id)
            ->get()
            ->first();

            $novelties = PayrollNovelty::select(
                "id",
                "tag",
                "eps",
                "contingency",
                "cie10",
                "cie10_description",
                "start_date",
                "end_date",
                "days_hours",
                "extension",
                "extension_id",
                "status",
                "payroll_date",
                "days_to_recover",
                "date_of_filing",
                "recognized_value",
                "date_of_deposit",
                "observation"
            )
            ->where('national_id',$employee_data->national_id)
            ->orderBy('start_date','desc')
            ->get();

            foreach ($novelties as $key => $novelty) {
                $novelties[$key]->plansaludmas = ($novelty->eps == 'Plan Salud Mas' ? true : false );
            }

            $permission_delete = auth()->user()->hasPermissionTo('payrollnovelty.delete');

            return response()->json(['employee_data'=>$employee_data,'novelties'=>$novelties,'permission_delete'=>$permission_delete]);
            
        }
    }

    public function downloadFlatFile(){
        $novelties = $this->noveltiesFlatFile()->orderBy('start_date')->get();
        return Excel::download(new PayrollNoveltyFlatFileExport($novelties), "PayrollNoveltiesFlatFile.xlsx");
    
    }

    public function updateTags(){
        $novelties = $this->noveltiesFlatFile()->update(['tag'=>'GRABADA EN NOVA']);
        return $novelties;
    }

    protected function noveltiesFlatFile(){
        $tags = PayrollNoveltyList::where('name','tags')->firstOrFail()->list;
        $tags = array_column(array_filter($tags,function($tag){return $tag['filter'] == 1;}),'text');
        $cods_nova = PayrollNoveltyList::where('name','cods_nova')->firstOrFail()->list;
        $filter_contingency = array_column($cods_nova,'contingency');
        return PayrollNovelty::whereIn('tag',$tags)->whereIn('contingency',$filter_contingency);
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tags = PayrollNoveltyList::where('name','tags')->firstOrFail()->list;
        $tags = array_column(array_filter($tags,function($tag){return $tag['filter'] == 1;}),'text');        
        $novelties = PayrollNovelty::whereIn('tag',$tags)->orderBy('start_date')->get();

        return view('payrollnovelty.index',compact('novelties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $lists = PayrollNoveltyList::all();
        $contingencies = $lists[0]->list;
        $statuses = $lists[1]->list;
        $tags = $lists[2]->list;
        $smlvs = PayrollNoveltySmlv::get()->pluck('daily_salary','year')->toArray();

        $employess = DB::connection('sqlsrvmasterfile')->select("
        select a.id,a.national_id + ' - ' + full_name as text
        from masterquery as a 
        inner join ( 
            select national_id,
            MAX(date_of_hire) date_of_hire 
            from masterquery 
            where national_id is not null and national_id <> 'null'
            group by national_id 
        ) as b on a.national_id = b.national_id 
        and a.date_of_hire = b.date_of_hire");

        return view('payrollnovelty.create',compact('contingencies','statuses','tags','employess','smlvs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            "employee_id"=>$request->employee["id"],
            "national_id"=>$request->employee["national_id"],
            "pep"=>$request->employee["pep"],
            "full_name"=>$request->employee["full_name"],
            "date_of_hire"=>$request->employee["date_of_hire"],
            "campaign"=>$request->employee["campaign"],
            "eps"=> ($request->novelty["plansaludmas"] ? 'Plan Salud Mas' : $request->employee["eps"]),
            "supervisor"=>$request->employee["supervisor"],
            "basic_salary_cop"=>$request->employee["basic_salary_cop"],
            "tag"=>$request->novelty["tag"],
            "contingency"=>$request->novelty["contingency"],
            "cie10"=>$request->novelty["cie10"],
            "cie10_description"=>$request->novelty["cie10_description"],
            "start_date"=>$request->novelty["start_date"],
            "end_date"=>$request->novelty["end_date"],
            "days_hours"=>$request->novelty["days_hours"],
            "extension"=>$request->novelty["extension"],
            "extension_id"=>$request->novelty["extension_id"],
            "status"=>$request->novelty["status"],
            "payroll_date"=>$request->novelty["payroll_date"],
            "days_to_recover"=>$request->novelty["days_to_recover"],
            "date_of_filing"=>$request->novelty["date_of_filing"],
            "recognized_value"=>$request->novelty["recognized_value"],
            "date_of_deposit"=>$request->novelty["date_of_deposit"],
            "observation"=>$request->novelty["observation"],
            "created_by"=>auth()->user()->id
        ];
        PayrollNovelty::create($data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PayrollNovelty  $payrollNovelty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        
        $payrollNovelty = PayrollNovelty::findOrFail($id);
        $payrollNovelty->update([
            "eps"=> ($request->novelty["plansaludmas"] ? 'Plan Salud Mas' : $request->employee["eps"]),
            "tag"=>$request->novelty["tag"],
            "contingency"=>$request->novelty["contingency"],
            "cie10"=>$request->novelty["cie10"],
            "cie10_description"=>$request->novelty["cie10_description"],
            "start_date"=>$request->novelty["start_date"],
            "end_date"=>$request->novelty["end_date"],
            "days_hours"=>$request->novelty["days_hours"],
            "extension"=>$request->novelty["extension"],
            "extension_id"=>$request->novelty["extension_id"],
            "status"=>$request->novelty["status"],
            "payroll_date"=>$request->novelty["payroll_date"],
            "days_to_recover"=>$request->novelty["days_to_recover"],
            "date_of_filing"=>$request->novelty["date_of_filing"],
            "recognized_value"=>$request->novelty["recognized_value"],
            "date_of_deposit"=>$request->novelty["date_of_deposit"],
            "observation"=>$request->novelty["observation"],
        ]);

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PayrollNovelty $payrollnovelty)
    {
        $delete = $payrollnovelty->delete();
        return response()->json(['delete'=>$delete]);
        // return back()->with('info', 'Successfully removed');
    }

}
