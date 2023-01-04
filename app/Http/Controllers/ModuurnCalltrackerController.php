<?php

namespace App\Http\Controllers;

use App\ModuurnTracker;
use App\ModuurnTrackerList;
use App\Moduurn_countries;
use App\Moduurn_states;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ModuurnCalltrackerReporGeneralExport;

class ModuurnCalltrackerController extends Controller
{


    public function __construct()
    {
        $this->middleware('can:moduurn.calltracker')->only(['create', 'store', 'index', 'show']);
        $this->middleware('can:moduurn.calltracker.leader')->only('edit', 'update');
        $this->middleware('can:moduurn.calltracker.reports.general')->only(['general', 'generalDownload']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trackers = ModuurnTracker::get();
        return view('moduurn.calltracker.index', compact('trackers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $lists = ModuurnTrackerList::pluck('list', 'name');
        foreach ($lists as $key => $list) {
            if ($key != 'Country') {
                $lists[$key] = array_combine($lists[$key], $lists[$key]);
            }
        }
        $reason = $lists['ReasonNotSchedule'];
        $type = $lists['Type'];
        $expert =  $lists['Expert'];
        $Countries = $lists['Country'];
        return view('moduurn.calltracker.create', compact(
            'Countries',
            'reason',
            'type',
            'expert' //,
        ));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $not_show = $request->not_show;
        $schedule = $request->is_schedule;
        if ($not_show == "no") {
            $request->validate([
                "is_schedule" => ['required'],
            ]);
        }else{
            $request->validate([
                "is_schedule" => ['nullable'],
            ]);
        }
        if ($schedule == "no") {
            $request->validate([
                "reason_not_schedule" => ['required'],
                "type" => ['nullable'],
                "transfer_call" => ['nullable'],
                "date_schedule" => ['nullable'],
            ]);
        } else  {
            $request->validate([
                "reason_not_schedule" => ['nullable'],
                "type" => ['required'],
                "transfer_call" => ['required'],
                "date_schedule" => ['required'],
            ]);
        }
        ModuurnTracker::create($request->merge([
            'created_by' => Auth::user()->id,
        ])->all());
        return redirect('moduurn/calltracker')->with('info', 'Record Saved Successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\moduurn_calltracker  $moduurn_calltracker
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trkEdit = ModuurnTracker::findOrFail($id);

        return view('moduurn.callTracker.show', compact('trkEdit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\moduurn_calltracker  $moduurn_calltracker
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trkEdit = ModuurnTracker::findOrFail($id);
        $reason = ModuurnTrackerList::where('name', 'ReasonNotSchedule')->pluck('list', 'name')->first();
        $reason = array_combine($reason, $reason);
        $type = ModuurnTrackerList::where('name', 'Type')->pluck('list', 'name')->first();
        $type = array_combine($type, $type);
        $expert = ModuurnTrackerList::where('name', 'Expert')->pluck('list', 'name')->first();
        $expert = array_combine($expert, $expert);

        return view('moduurn/calltracker.edit', compact(
            'reason',
            'type',
            'expert',
            'trkEdit',
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\moduurn_calltracker  $moduurn_calltracker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosTrackers = request()->except(['_token', '_method']);
        ModuurnTracker::where('id', '=', $id)->update($datosTrackers);
        return redirect('moduurn/calltracker')->with('info', 'Record Modify Successfully');
    }
    public function general()
    {
        return view('moduurn.calltracker.general');
    }

    public function generalDownload(Request $request)
    {
        [$start_date, $end_date] = explode(" - ", $request->daterange);
        return Excel::download(new ModuurnCalltrackerReporGeneralExport($start_date, $end_date), "ModuurnCalltrackerReportGeneral" . $start_date . "-" . $end_date . ".xlsx");
    }
}
