<?php

namespace App\Http\Controllers;

use App\AmericanWaterBoTracker;
use App\AmericanWaterBoTrackerList;
use Illuminate\Http\Request;

class AmericanWaterBoTrackerController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:americanwater.botracker');
    }

    public function index(){
        return view('americanwater.botracker');
    }

    public function store(Request $request){
        $lists = $this->getLists();
        $queue =(($request->queue)?!$lists['queues'][$request->queue]['endForm']:null);
        $status =(($request->status)?$lists['statuses'][$request->status]['gotoENR']:null);

        $request->validate([
            "queue"=>['required'],
            "started_at"=>['required'],
            "cus_id"=> [($queue?'required':'nullable'),'max:50'],
            "customer_name"=> [($queue?'required':'nullable'),'max:50'],
            "spreadsheet"=> [($queue?'required':'nullable'),'max:10'],
            "status"=> [($queue?'required':'nullable'),'max:50'],
            "enr_number"=> [($status?'required':'nullable'),'max:200'],
            "agreement_classification"=> [($status?'required':'nullable'),'max:50'],
            "additional_notes"=> [($queue?'required':'nullable')],

        ]);

        $request = $request->merge(['username'=>auth()->user()->username]);

        if(!$queue){
            $botracker = $request->only(['queue','started_at','username']);
        }else{
            if($status){
                $botracker = $request->only(["queue","started_at","username","cus_id","customer_name","spreadsheet","status","additional_notes","enr_number","agreement_classification"]);
            }else{
                $botracker = $request->only(["queue","started_at","username","cus_id","customer_name","spreadsheet","status","additional_notes"]);
            }
        }
        
        AmericanWaterBoTracker::create($botracker);

        return back()->with('info','Record Saved Successfully');
    }

    public function getLists(Request $request=null){
        return AmericanWaterBoTrackerList::get()->pluck('list','name')->toArray();
    }
    
}
