<?php

namespace App\Http\Controllers;

use App\DearService;
use App\DearServiceList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DearServiceTrackerReporGeneralExport;

class DearServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:dearservice.tracker')->only(['create', 'store', 'index', 'show']);
        $this->middleware('can:dearservice.tracker.reports.general')->only(['general', 'generalDownload']);
        //$this->middleware('can:dearservice.tracker.leader');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hoy = Carbon::now()->format('Y-m-d');
        if (auth()->user()->can('dearservice.tracker.leader')) {
            $trackers = DearService::where('created_at', '>=', $hoy)->orderBy('created_at', 'desc')->get();
        } elseif ((auth()->user()->can('dearservice.tracker'))) {
            $trackers = DearService::where('created_at', '>=', $hoy)->orderBy('created_at', 'desc')->where('created_by', auth()->user()->id)->get();
        } else {
            'you dont have a permission to view this page';
        }
        return view('dearservice.tracker.index', compact('trackers'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lists = DearServiceList::pluck('list', 'name');
        foreach ($lists as $key => $list) {
                $lists[$key] = array_combine($lists[$key], $lists[$key]);
        }
        $disposition = $lists['disposition'];
        $call = [1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10];
        return view ('dearservice.tracker.create', compact('disposition','call'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DearService::create($request->merge([
            'created_by' => Auth::user()->id,
            ])->all());
        return redirect('dearservice/tracker')->with('info', 'Record Saved Successfully');
    }
    public function general()
    {
        return view('dearservice.tracker.general');
    }
    public function generalDownload(Request $request)
    {
        [$start_date, $end_date] = explode(" - ", $request->daterange);
        return Excel::download(new DearServiceTrackerReporGeneralExport($start_date, $end_date), "dearservicetrackerReportGeneral" . $start_date . "-" . $end_date . ".xlsx");
    }
}
