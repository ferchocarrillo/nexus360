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
        $queueFields =(($request->queue)? array_keys(array_filter($lists['queues'][$request->queue]['fields'])):[]);
        if($request->status && !$lists['statuses'][$request->status]['gotoENR']){
            $queueFields = array_diff($queueFields,["enr_number","agreement_classification"]);
        }

        $request->validate([
            "queue"=>['required'],
            "started_at"=>['required'],
            "cus_id"=> [(in_array("cus_id",$queueFields)?'required':'nullable'),'max:50'],
            "customer_name"=> [(in_array("customer_name",$queueFields)?'required':'nullable'),'max:50'],
            "spreadsheet"=> [(in_array("spreadsheet",$queueFields)?'required':'nullable'),'max:50'],
            "status"=> [(in_array("status",$queueFields)?'required':'nullable'),'max:50'],
            "enr_number"=> [(in_array("enr_number",$queueFields)?'required':'nullable'),'max:200'],
            "agreement_classification"=> [(in_array("agreement_classification",$queueFields)?'required':'nullable'),'max:50'],
            "additional_notes"=> [(in_array("additional_notes",$queueFields)?'required':'nullable')],
            "view"=> [(in_array("view",$queueFields)?'required':'nullable'),'max:100'],
        ]);

        $request = $request->merge(['username'=>auth()->user()->username]);

        $botracker = $request->only(array_merge($queueFields, ['queue','started_at','username']));
        AmericanWaterBoTracker::create($botracker);

        return back()->with('info','Record Saved Successfully');
    }

    public function getLists(Request $request=null){
        return AmericanWaterBoTrackerList::get()->pluck('list','name')->toArray();
    }
    
}
