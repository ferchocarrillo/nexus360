<?php

namespace App\Http\Controllers;

use App\EnercareBoTracker;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class EnercareBoTrackerController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:enercare.botracker')->only(['create','store','index','show']);
        $this->middleware('can:enercare.botracker.leader')->only('edit','update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obas = ['OBA Case'=>'OBA Case','OBA Audit Billing Adjustment'=>'OBA Audit Billing Adjustment'];
        $offlines = [
        'Back-Billing'=>'Back-Billing',
        'Back-BillingBack-Billing'=>'Back-BillingBack-Billing',
        'Billing Adjustment'=>'Billing Adjustment',
        'Billing Offline Emails'=>'Billing Offline Emails',
        'Callbacks'=>'Callbacks',
        'Contact Us Promo'=>'Contact Us Promo',
        'HVAC (Downgrade)'=>'HVAC (Downgrade)',
        'HVAC (Rental)'=>'HVAC (Rental)',
        'HVAC Inbox'=>'HVAC Inbox',
        'Misrepresentations'=>'Misrepresentations',
        'Moves'=>'Moves',
        'Request Inquiry'=>'Request Inquiry',
        'SME Case'=>'SME Case',
        'TGS (Report)'=>'TGS (Report)'
        ];



      // $trackers_lists = EnercareBoTracker::orderBy('id','desc')->get();
      if (auth()->user()->can('enercare.botracker.leader')){
        $trackers_lists = EnercareBoTracker::orderBy('created','desc')->get();
      } elseif((auth()->user()->can('enercare.botracker'))) {
          $trackers_lists = EnercareBoTracker::orderBy('created','desc')->where('created_by', auth()->user()->id)->get();
      } else{
        'you dont have a permission to view this page';
      }
        return view('Enercare.boTracker.index', compact('obas','offlines','trackers_lists'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            EnercareBoTracker::create($request->merge([
            'created_by' => Auth::user()->id,
            'call_centre' => 'CP BOGOTA',
        ])->all());
        return back()->with('info','Record Saved Successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\EnercareBoTracker  $EnercareBoTracker
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $trkEdit = EnercareBoTracker::findOrFail($id);

        $case_actioned = new \Carbon\Carbon($trkEdit->case_actioned);
        $case_created = new \Carbon\Carbon($trkEdit->created);
        $elapsed = gmdate("H:i:s", $case_created->diffInSeconds($case_actioned));

        return view('Enercare.boTracker.show',compact('trkEdit','elapsed'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EnercareBoTracker  $EnercareBoTracker
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trkEdit = EnercareBoTracker::findOrFail($id);
        return view('Enercare.boTracker.edit',compact('trkEdit'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EnercareBoTracker  $EnercareBoTracker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosTrackers = request()->except(['_token', '_method']);
        EnercareBoTracker::where('id', '=', $id)->update($datosTrackers);
        $trkEdit = EnercareBoTracker::findOrFail($id);
        return redirect('enercare/botracker')->with('info','Record Modify Successfully');
//        return back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EnercareBoTracker  $EnercareBoTracker
     * @return \Illuminate\Http\Response
     */
    public function destroy(EnercareBoTracker $EnercareBoTracker)
    {
        //
    }
}
