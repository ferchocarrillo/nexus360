<?php

namespace App\Http\Controllers;

use App\EnercareBoTracker;
use App\EnercareBoTrackerList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EnercareBoTrackerReporGeneralExport;



class EnercareBoTrackerController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:enercare.botracker')->only(['create', 'store', 'index', 'show']);
        $this->middleware('can:enercare.botracker.leader')->only('edit', 'update');
        $this->middleware('can:enercare.botracker.reports.general')->only(['general', 'generalDownload']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $hoy = Carbon::now();
        $semana =  $hoy->subDays(7)->format('Y-m-d');
        $quincena =  $hoy->subDays(15)->format('Y-m-d');
        $meses =  $hoy->subDays(30)->format('Y-m-d');
        if (auth()->user()->can('enercare.botracker.leader')) {
            $trackers_lists = EnercareBoTracker::where('created', '>=', $semana)->orderBy('created', 'desc')->get();
        } elseif ((auth()->user()->can('enercare.botracker'))) {
            $trackers_lists = EnercareBoTracker::where('created', '>=', $meses)->orderBy('created', 'desc')->where('created_by', auth()->user()->id)->get();
        } else {
            'you dont have a permission to view this page';
        }
        return view('Enercare.boTracker.index', compact('trackers_lists'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $obas = EnercareBoTrackerList::where('name', 'OBA')->pluck('list')->first();
        $offlines = EnercareBoTrackerList::where('name', 'OFFLINE')->pluck('list')->first();



        return view('Enercare.boTracker.create', compact('obas', 'offlines'));
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
        return redirect('enercare/botracker')->with('info', 'Record Saved Successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\EnercareBoTracker  $EnercareBoTracker
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trkEdit = EnercareBoTracker::findOrFail($id);
        $case_actioned = new \Carbon\Carbon($trkEdit->case_actioned);
        $case_created = new \Carbon\Carbon($trkEdit->created);
        $elapsed = gmdate("H:i:s", $case_created->diffInSeconds($case_actioned));
        return view('Enercare.boTracker.show', compact('trkEdit', 'elapsed'));
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
        $obas = EnercareBoTrackerList::where('name', 'OBA')->pluck('list')->first();
        $offlines = EnercareBoTrackerList::where('name', 'OFFLINE')->pluck('list')->first();
        $obas = array_combine($obas, $obas);
        $offlines = array_combine($offlines, $offlines);

        return view('Enercare.boTracker.edit', compact('trkEdit', 'obas', 'offlines'));
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
        return redirect('enercare/botracker')->with('info', 'Record Modify Successfully');
    }
    public function general()
    {
        return view('enercare.botracker.general');
    }

    public function generalDownload(Request $request)
    {
        [$start_date, $end_date] = explode(" - ", $request->daterange);
        return Excel::download(new EnercareBoTrackerReporGeneralExport($start_date, $end_date), "EnercareBoTrackerReportGeneral" . $start_date . "-" . $end_date . ".xlsx");
    }
}
