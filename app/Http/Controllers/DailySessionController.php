<?php

namespace App\Http\Controllers;

use App\DailySession;
use App\DailySessionList;
use App\Exports\DailySessionReportExport;
use App\Jobs\DailySessionSendMailJob;
use App\MasterFile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DailySessionController extends Controller
{
    function __construct()
    {
        $this->middleware('can:dailysessions')->only(
            ['index', 'show', 'acknowledge']
        );
        $this->middleware('can:dailysessions.create')->only(
            ['create', 'store']
        );
        $this->middleware('can:dailysessions.download')->only(
            ['download']
        );
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $dailySessions = DailySession::query();
            if (auth()->user()->can('dailysessions.filters')) {
                if ($request->campaign) $dailySessions = $dailySessions->where('campaign', $request->campaign);
                if ($request->team_leader) $dailySessions = $dailySessions->where('team_leader', $request->team_leader);
                if ($request->agent) $dailySessions = $dailySessions->where('employee_id', $request->agent);
            } else {
                $dailySessions = $dailySessions->where('national_id', auth()->user()->national_id);
            }
            if ($request->start_date) $dailySessions = $dailySessions->where('created_at', '>=', $request->start_date);
            if ($request->end_date) $dailySessions = $dailySessions->where('created_at', '<=', Carbon::parse($request->end_date)->endOfDay()->format('Y-m-d H:i:s'));

            $dailySessions = $dailySessions->paginate(48);
            $lastPage = $dailySessions->lastPage();
            $html = view('DailySession.list', compact('dailySessions'))->render();
            return response()->json(['html' => $html, 'lastPage' => $lastPage]);
        }

        $employess = MasterFile::select('id', 'national_id', 'full_name', 'supervisor', 'campaign', 'lob')
            ->whereNull('termination_date')
            ->whereIn('position', ['Agent'])
            ->get();

        $campaigns = array_unique(array_column($employess->toArray(), 'campaign'));
        $campaigns = array_combine($campaigns, $campaigns);
        return view('DailySession.index', compact('campaigns', 'employess'));
    }

    public function show(DailySession $dailysession)
    {
        if (!auth()->user()->can('dailysessions.filters') && auth()->user()->national_id != $dailysession->national_id) abort(403);
        return view('DailySession.show', compact('dailysession'));
    }

    public function create(Request $request)
    {
        $agent = MasterFile::findOrFail($request->agent_id);
        $lists = DailySessionList::whereNotIn('name',['documented','root_causes'])->pluck('list', 'name');
        foreach ($lists as $key => $value) {
            $lists[$key] = array_combine($lists[$key], $lists[$key]);
        }

        return view('DailySession.create', compact('agent', 'lists'));
    }

    public function store(Request $request)
    {
        $agent = MasterFile::findOrFail($request->agent_id);

        $data = [
            "employee_id" => $agent->id,
            "national_id" => $agent->national_id,
            "agent_name" => $agent->full_name,
            "corporate_email" => $agent->corp_email,
            "lob" => $agent->lob,
            "campaign" => $agent->campaign,
            "team_leader" => $agent->supervisor,
            "type" => $request->type,
            "tactic" => $request->tactic,
            "behaviour" => $request->behaviour,
            "metric" => $request->metric,
            "score" => $request->score,
            "comments" => $request->comments,
            "created_by" => auth()->user()->id
        ];

        $dailySession = DailySession::create($data);

        DailySessionSendMailJob::dispatch($dailySession);

        return redirect('/dailysessions');
    }

    public function acknowledge(DailySession $dailySession)
    {
        if ($dailySession->acknowledge || auth()->user()->national_id != $dailySession->national_id) abort(403);
        $dailySession->acknowledge = true;
        $dailySession->save();

        DailySessionSendMailJob::dispatch($dailySession);

        return redirect('/dailysessions');
    }

    public function download(Request $request)
    {

        $dailySessions = DailySession::query();
        if (auth()->user()->can('dailysessions.filters')) {
            if ($request->campaign) $dailySessions = $dailySessions->where('campaign', $request->campaign);
            if ($request->team_leader) $dailySessions = $dailySessions->where('team_leader', $request->team_leader);
            if ($request->agent) $dailySessions = $dailySessions->where('employee_id', $request->agent);
        } else {
            $dailySessions = $dailySessions->where('national_id', auth()->user()->national_id);
        }
        if ($request->start_date) $dailySessions = $dailySessions->where('created_at', '>=', $request->start_date);
        if ($request->end_date) $dailySessions = $dailySessions->where('created_at', '<=', Carbon::parse($request->end_date)->endOfDay()->format('Y-m-d H:i:s'));

        return Excel::download(new DailySessionReportExport($dailySessions->get()), "DailySessionsReport.xlsx");
    }
}
