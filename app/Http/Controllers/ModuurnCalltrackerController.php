<?php

namespace App\Http\Controllers;

use App\ModuurnTracker;
use App\ModuurnTrackerList;
use Illuminate\Support\Facades\Validator;
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
        $user = auth()->user();
        if($user->can('moduurn.calltracker.leader')){
            $trackers = ModuurnTracker::get();
        }else{
            $trackers = ModuurnTracker::where('created_by',$user->id)->get();
        }
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
            'expert'
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
        $this->validate(
            $request,
            [
                'phone_number1' => ['required', 'numeric', 'digits_between:7,10'],
                'phone_number2' => ['nullable', 'numeric', 'digits_between:7,10'],
                'list_id' => ['required', 'numeric', 'digits_between:5,20'],
                'not_show' => ['required', 'max:3'],
                'is_schedule' => [($request->not_show == 'no' ? 'required' : 'nullable')],
                'reason_not_schedule' => [($request->is_schedule == 'no' ? 'required' : 'nullable')],
                'type' => [($request->is_schedule == 'yes' ? 'required' : 'nullable')],
                'transfer_call' => [($request->is_schedule == 'yes' ? 'required' : 'nullable')],
                'date_schedule' => [($request->is_schedule == 'yes' ? 'required' : 'nullable')],
            ],
            [],
            [
                'phone_number1' => 'Phone Number',
                'phone_number2' => 'Secundary Phone',
                'list_id' => 'List ID',
                'not_show' => 'Not Show',
                'is_schedule' => 'Is Schedule',
                'reason_not_schedule' => 'Reason Not Schedule',
                'type' => 'Type',
                'transfer_call' => 'Transfer Call',
                'date_schedule' => 'Date Schedule',
            ]
        );

        $mergeData= [
            'date_schedule'=>($request->date_schedule ? str_replace('T',' ',$request->date_schedule) : null),
            'created_by' => Auth::user()->id,
        ];
        ModuurnTracker::create($request->merge($mergeData)->all());
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
        
        $user = auth()->user();
        if(!$user->can('moduurn.calltracker.leader') && $trkEdit->created_by != $user->id){
            abort(403);
        }

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
        return view('moduurn/calltracker.edit', compact(
            'trkEdit',
            'Countries',
            'reason',
            'type',
            'expert'
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
        $this->validate(
            $request,
            [
                'phone_number1' => ['required', 'numeric', 'digits_between:7,10'],
                'phone_number2' => ['nullable', 'numeric', 'digits_between:7,10'],
                'list_id' => ['required', 'numeric', 'digits_between:5,20'],
                'not_show' => ['required', 'max:3'],
                'is_schedule' => [($request->not_show == 'no' ? 'required' : 'nullable')],
                'reason_not_schedule' => [($request->is_schedule == 'no' ? 'required' : 'nullable')],
                'type' => [($request->is_schedule == 'yes' ? 'required' : 'nullable')],
                'transfer_call' => [($request->is_schedule == 'yes' ? 'required' : 'nullable')],
                'date_schedule' => [($request->is_schedule == 'yes' ? 'required' : 'nullable')],
            ],
            [],
            [
                'phone_number1' => 'Phone Number',
                'phone_number2' => 'Secundary Phone',
                'list_id' => 'List ID',
                'not_show' => 'Not Show',
                'is_schedule' => 'Is Schedule',
                'reason_not_schedule' => 'Reason Not Schedule',
                'type' => 'Type',
                'transfer_call' => 'Transfer Call',
                'date_schedule' => 'Date Schedule',
            ]
        );

        $mergeData= [
            'date_schedule'=>($request->date_schedule ? str_replace('T',' ',$request->date_schedule) : null),
        ];


        $datosTrackers = request()->merge($mergeData)->except(['_token', '_method']);
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
