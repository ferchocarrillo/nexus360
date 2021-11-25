<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class MasterfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:masterfile.wfh')->only(['wfhIndex','wfhStore']);
    }

    public function wfhIndex()
    {
        $hierarchy = auth()->user()->employessAllHierarchy()
            ->get()
            ->pluck('national_id');

        $employess = DB::connection('sqlsrvmasterfile')
            ->table('masterquery')
            ->leftJoinSub(
                DB::connection('sqlsrvmasterfile')
                    ->table('wfh')
                    ->whereRaw('id in (select max(id) from wfh group by employee_id)')
                    ->select('*'),
                'wfhs',
                function ($join) {
                    $join->on('masterquery.id', '=', 'wfhs.employee_id');
                }
            )
            ->whereIn('masterquery.national_id', $hierarchy)
            ->whereNull('masterquery.termination_date')
            ->select(
                "masterquery.id",
                DB::raw("masterquery.national_id + ' - ' + masterquery.full_name as text "),
                "wfhs.wfh"
            )
            ->get();
                // dd($employess);
        return view('masterfile.wfh.index', compact('employess'));
    }

    public function wfhStore(Request $request){

        $hierarchy = auth()->user()->employessAllHierarchy()
            ->get()
            ->pluck('national_id');

        $employess = DB::connection('sqlsrvmasterfile')
            ->table('masterquery')
            ->whereIn('masterquery.national_id', $hierarchy)
            ->whereNull('masterquery.termination_date')
            ->select('id')
            ->get()->pluck('id')->toArray();
        
        if(in_array($request->employee_id,$employess)){
            $lastWFH = DB::connection('sqlsrvmasterfile')
            ->table('wfh')
            ->whereRaw('id in (select max(id) from wfh group by employee_id)')
            ->first();

            if($lastWFH && $lastWFH->wfh == $request->wfh) return response()->json(['result'=>'No changes to save']);
            
            $insert = DB::connection('sqlsrvmasterfile')
            ->table('wfh')
            ->insert($request->merge(['created_by'=>auth()->user()->id])->all());
            
            return response()->json(['result' => $insert]);
        }

        return response()->json(['result' => 'Employee Not Found']);
    }
}
