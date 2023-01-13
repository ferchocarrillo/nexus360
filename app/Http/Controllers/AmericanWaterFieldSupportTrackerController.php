<?php

namespace App\Http\Controllers;

use App\AmericanWaterFieldSupportTracker;
use App\Exports\AmericanWaterFieldSupportExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AmericanWaterFieldSupportTrackerController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:americanwater.fieldsupport')->only(['create','store','index','show']);
        $this->middleware('can:americanwater.fieldsupport.leader')->only('edit','update');
        $this->middleware('can:americanwater.fieldsupport.reports.general')->only(['general','generalDownload']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (auth()->user()->can('americanwater.fieldsupport.leader')){
            $fields_lists = AmericanWaterFieldSupportTracker::orderBy('created','desc')->get();
        } elseif((auth()->user()->can('americanwater.fieldsupport'))) {
            $fields_lists = AmericanWaterFieldSupportTracker::orderBy('created','desc')->where('created_by', auth()->user()->id)->get();
        }
        return view('americanwater/fieldsupport/index', compact('fields_lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $thereshold = ['>2000'=>'>2000','<2000'=>'<2000'];
        $invoice = ['Aproved'=>'Aproved','Pending invoice'=>'Pending invoice'];
        return view('americanwater/fieldsupport.create', compact('thereshold','invoice'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AmericanWaterFieldSupportTracker::create($request->merge([
            'claim_number' => 'CLM' . $request->claim,
            'created_by' => Auth::user()->id,
        ])->all());
        return redirect('/americanwater/fieldsupport')->with('info','Record Saved Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AmericanWaterFieldSupportTracker  $americanWaterFieldSupportTracker
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $field = AmericanWaterFieldSupportTracker::findOrFail($id);
        $case_actioned = new \Carbon\Carbon($field->case_actioned);
        $case_created = new \Carbon\Carbon($field->created);
        $elapsed = gmdate("H:i:s", $case_created->diffInSeconds($case_actioned));
        return view('americanwater.fieldsupport.show', compact('field','elapsed'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AmericanWaterFieldSupportTracker  $americanWaterFieldSupportTracker
     * @return \Illuminate\Http\Response
     */
    public function edit($id)

    {
        $field = AmericanWaterFieldSupportTracker::findOrFail($id);
        $threshold = ['>2000'=>'>2000','<2000'=>'<2000'];
        $invoice = ['Aproved'=>'Aproved','Pending invoice'=>'Pending invoice'];
        return view('americanwater.fieldsupport.edit', compact('field','threshold','invoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AmericanWaterFieldSupportTracker  $americanWaterFieldSupportTracker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosField = request()->except(['_token', '_method']);
        AmericanWaterFieldSupportTracker::where('id', '=', $id)->update($datosField);
        return redirect('americanwater/fieldsupport')->with('info','Record Modify Successfully');
    }

    public function general(){
        return view('americanwater.fieldsupport.general');
    }

    public function generalDownload(Request $request){
        [$start_date, $end_date] = explode(" - ",$request->daterange);

        return Excel::download(new AmericanWaterFieldSupportExport($start_date,$end_date),"AmericanWaterFieldSupportReportGeneral".$start_date."-".$end_date.".xlsx");
    }


}
