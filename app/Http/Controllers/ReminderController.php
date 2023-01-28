<?php

namespace App\Http\Controllers;


use App\MasterFile;
use App\Reminder;
use App\ReminderUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReminderController extends Controller
{
    public function __construct(){
        $this->middleware('can:reminder.outbox')->only(['outbox']);
        $this->middleware('can:reminder')->only(['index','popup','acknowledge','show','edit','outbox']);
        $this->middleware('can:reminder.create')->only(['create']);
    }

    public function index(){
        $recipients =  ReminderUser::with('reminder')->where('user_id', Auth::user()->id)->orderBY('created_at','Asc' )->get();
        $reminders = Reminder::where('created_by',Auth::user()->id)
        ->orWhere('user_id',Auth::user()->id);

        return view('reminder.index', compact('recipients'));
    }

    public function create(Request $request){
        $filters = ['campaign' => 'Campaign', 'supervisor' => 'Team leader', 'national_id' => 'Employess'];
        $filterPositions = [
            "Agent", 
            "Agent Booking Specialist", 
            "Agent Outbound Sale", 
            "Bilingual Backoffice/Helpdesk support specialist", 
            "Helpdesk/backend", 
            "Onboarding specialist", 
            "Outbound Sales Agent", 
            "SFL Customer Support Specialist", 
            "SFL Failed Payments", 
            "Specialist Agent C+", 
            "Support Facilitator"
        ];
        $campaigns = MasterFile::whereIn('position', $filterPositions)->where('status', 'Active')->select('campaign')->groupBy('campaign')->pluck('campaign');
        $team_leaders = MasterFile::whereIn('position', $filterPositions)->where('status', 'Active')->select('supervisor')->groupBy('supervisor')->pluck('supervisor');
        $employess = MasterFile::whereIn('position', $filterPositions)->where('status', 'Active')->select('national_id', 'full_name')->get();
        if ($request->ajax()) {
            $arr = [];
            $arr = DB::table('users')->join('master_files', 'users.national_id', '=', 'master_files.national_id')
                ->whereNull('master_files.termination_date')
                ->whereIn(('master_files.' . $request->filter), $request->filter_data)
                ->where('master_files.position', 'Agent')
                ->select('users.id')
                ->get()->pluck('id');
            $reminder = Reminder::create([
                "reminder" => $request->reminder,
                "campaign" => $request->filter,
                "created_by" => Auth::user()->id
            ]);

            $reminders = [];
            foreach ($arr as $user_id) {
                $reminderUser = ReminderUser::create([
                    "reminder_id" =>  $reminder->id,
                    "user_id" => $user_id,
                    "acknowledge_required" =>  $request->acknowledge == 'true',
                ]);
                $reminders[] = [
                    'user' => $user_id,
                    'reminder_user_id' => $reminderUser->id
                ];
            }
            return $reminders;

        }

        return view('reminder.create', compact(['campaigns', 'employess', 'filters', 'team_leaders']));
    }

    public function popup($reminderUserId){
        $reminderUser = ReminderUser::with('reminder')
            ->where('user_id', Auth::user()->id)
            ->where('id', $reminderUserId)
            ->firstOrFail();
        return view('reminder.popup', compact('reminderUser'));
    }

    public function show($reminderUserId){
        $reminders = Reminder::with('recipients.user.masterfile2')->findOrFail($reminderUserId);
        return view('reminder.show', compact('reminders'));
    }

    public function outbox(){
        $send = Reminder::with(['recipients' => function($query){
            $query->select('reminder_id','acknowledge_required')
            ->groupBy('reminder_id','acknowledge_required');
        }])->get();
        return view('reminder.outbox', compact('send'));
    }

    public function acknowledge($reminderUserId){

        $reminderUser =  ReminderUser::findOrFail($reminderUserId);
        $reminderUser->acknowledge = 1;
        $reminderUser->save();
        return 'Acknowledge successful save';

    }

}
