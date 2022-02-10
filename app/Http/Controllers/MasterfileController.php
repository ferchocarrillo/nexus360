<?php

namespace App\Http\Controllers;

use App\MasterFile;
use App\MasterfileWfh;
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
            
        $employess = MasterFile::leftJoinSub(
            MasterfileWfh::whereRaw('id in (select max(id) from masterfile_wfhs group by employee_id)')->select('*'),
            'wfhs',
            function ($join) {
                $join->on('master_files.id', '=', 'wfhs.employee_id');
            })
            ->whereIn('master_files.national_id', $hierarchy)
            ->whereNull('master_files.termination_date')
            ->select(
                "master_files.id",
                DB::raw("master_files.national_id + ' - ' + master_files.full_name as text "),
                "wfhs.wfh"
            )->get();
            
        return view('masterfile.wfh.index', compact('employess'));
    }

    public function wfhStore(Request $request){

        $hierarchy = auth()->user()->employessAllHierarchy()
            ->get()
            ->pluck('national_id');

        $employess = MasterFile::whereIn('master_files.national_id', $hierarchy)
            ->whereNull('master_files.termination_date')
            ->select('id')
            ->get()->pluck('id')->toArray();
        
        if(in_array($request->employee_id,$employess)){
            $lastWFH = MasterfileWfh::whereRaw('id in (select max(id) from masterfile_wfhs group by employee_id)')
            ->where('employee_id',$request->employee_id)
            ->first();

            if($lastWFH && $lastWFH->wfh == $request->wfh) return response()->json(['result'=>'No changes to save']);

            $create = MasterfileWfh::create($request->merge(['created_by'=>auth()->user()->id])->all());
            
            return response()->json(['result' => $create->exists]);
        }

        return response()->json(['result' => 'Employee Not Found']);
    }
}
