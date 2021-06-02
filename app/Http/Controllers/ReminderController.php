<?php

namespace App\Http\Controllers;

use App\MasterFile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReminderController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:kaizen')->only('index');
    }

    public function index(Request $request){
        if($request->ajax()){
            $arr = [];
            
            $arr = DB::table('users')->join('master_files','users.national_id','=','master_files.national_id')
            ->whereNull('master_files.termination_date')
            ->where('master_files.position','Agent')
            ->where('master_files.campaign',$request->campaign)
            ->select('users.id')
            ->get()->pluck('id');
            return $arr;

        }
        $campaigns=['Next Era Energy'];
        return view('reminder.index',compact(['campaigns']));
    }
    public function popup(){
        return view('reminder.popup');
    }
}
