<?php

namespace App\Http\Controllers;

use App\EnercareTrackerSupportFacilitator;
use App\EnercareTrackerSupportFacilitatorList;
use App\Exports\EnercareSupportFacilitatorExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EnercareTrackerSupportFacilitatorController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:enercare.supportfacilitator')->only(['create', 'store', 'index', 'show']);
        $this->middleware('can:enercare.supportfacilitator.leader')->only(['create', 'store', 'index', 'show','general', 'generalDownload']);
        $this->middleware('can:enercare.supportfacilitator.reports.general')->only(['general', 'generalDownload']);
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hoy = Carbon::now()->format('Y-m-d');
        if (auth()->user()->can('enercare.supportfacilitator.leader')) {
            $facilitators = EnercareTrackerSupportFacilitator::where('created_at', '>=', $hoy)->orderBy('created_at', 'desc')->get();
        } elseif ((auth()->user()->can('enercare.supportfacilitator'))) {
            $facilitators = EnercareTrackerSupportFacilitator::where('created_at', '>=', $hoy)->orderBy('created_at', 'desc')->where('created_by', auth()->user()->id)->get();
        } else {
            'you dont have a permission to view this page';
        }
        return view('enercare/supportfacilitator/index',compact('facilitators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agent = DB::table('enercare.dbo.tbrostercontactpoint')

        ->select
        ('DOK-USER-CITRIX ID', 'FullName')
        ->where ('Campaign' , 'Enercare')
        ->where ('Position' , 'Agent')
        ->where('Start DateR', date('Y-m-d') )
        ->orderBy('DOK-USER-CITRIX ID', 'asc')
        ->get()
        ->pluck('FullName','DOK-USER-CITRIX ID');
        $lists = EnercareTrackerSupportFacilitatorList::pluck('list', 'name');
        foreach ($lists as $key => $list) {
            if ($key != 'Process') {
                $lists[$key] = array_combine($lists[$key], $lists[$key]);
            }
        }

        $Process = $lists['Process'];
        $behavior = $lists['Behavior_Identified'];
        $recomendations = $lists['Recommendations_to_Supervisor_,_Team_Lead_Dropdowns'];
        $interaction = [2=>2,3=>3];

        return view('enercare/supportfacilitator/create', compact(
            'agent',
            'Process',
            'behavior',
            'recomendations',
            'interaction'
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
                'agent' => ['required','max:150'],
                'process' => ['required','min:5', 'max:30'],
                'process_specific' => ['required','min:5', 'max:100'],
                'additional_details' => [($request->excepcion === "1" ? 'required' : 'nullable')],
                'behavior_identified' => [($request->supervisor_assistence != "1" ? 'required' : 'nullable')],
                'recomendations' => [($request->supervisor_assistence != "1" ? 'required' : 'nullable')],
                'observations' => ['required','min:8', 'max:150'],
                'conference_in' => ['required'],
                'supervisor_assistence' => ['nullable'],
            ],
            [],
            [
                'agent' =>'Agent',
                'process' =>'Process',
                'process_specific' =>'Process Specific',
                'additional_details' =>'Additional Details',
                'behavior_identified' =>'Behavior Identified',
                'recomendations' =>'Recomendations',
                'observations' =>'Observations',
                'conference_in' =>'Conference In',
                'supervisor_assistence' =>'Supervisor Assistence',
            ]
        );
        $mergeData= [
            'created_by' => Auth::user()->id,
        ];
        EnercareTrackerSupportFacilitator::create($request->merge($mergeData)->all());
        return redirect('enercare/supportfacilitator/create')->with('info', 'Record Saved Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EnercareTrackerSupportFacilitator  $enercareTrackerSupportFacilitator
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $facil = EnercareTrackerSupportFacilitator::findOrFail($id);
        return view('enercare/supportfacilitator/show', compact('facil'));
    }

    public function general()
    {
        return view('enercare.supportfacilitator.general');
    }

    public function generalDownload(Request $request)
    {
        [$start_date, $end_date] = explode(" - ", $request->daterange);
        return Excel::download(new EnercareSupportFacilitatorExport($start_date, $end_date), "EnercareSupportFacilitatorReportGeneral" . $start_date . "-" . $end_date . ".xlsx");
    }
}
