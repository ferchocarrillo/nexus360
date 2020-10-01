<?php

namespace App\Http\Controllers;

use App\Activity;
use App\AgentActivity;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Exports\AgentActivityReportExport;
use Maatwebsite\Excel\Facades\Excel;


class AgentActivityController extends Controller
{
    public function index(){
         
        $userActivity = auth()->user()->latestactivity()->first();

        if($userActivity){
            if($userActivity->id == 2){
                $activities = Activity::where([['isActive',1],['id',1]])->get();
            }else{
                $activities = Activity::where([['isActive',1],['id','<>',$userActivity->id],['id','<>',1]])->get();
            }
        } else{
            $activities = Activity::where([['isActive',1],['id',1]])->get();
        }

        $dataActivity = [$userActivity,$activities];

        return view('agentactivity.index',compact(['activities','userActivity','dataActivity']));
    }

    public function store(Request $request){


        $lastActivity = AgentActivity::where('user_id',auth()->user()->id)
        ->orderBy('id','desc')
        ->first();
        
        if($lastActivity){
            $lastActivity->touch();
        }

        AgentActivity::create([
            'user_id' => Auth::user()->id,
            'activity_id' => $request->idActivity
        ]);
        Auth::user()->latestactivity()->sync( $request->idActivity);

        return response()->json(['respuesta'=> 'success']);
    }

    public function supervisor(){
        
        $users = Auth::user()->employessAllHierarchy()->with('latestactivity')->get();

        /*
        if(Auth::user()->hasRole('admin')){
            $users = User::where('id','<>', Auth::user()->id)->with('latestactivity')->get()   ;
        }else {

            
            $users = Auth::user()->employess()->with('latestactivity')->get();
        }
*/

        return view('agentactivity.supervisor', compact('users'));
    }

    public function getActivities(){

        $users = Auth::user()->employessAllHierarchy()->with('latestactivity')->get();
        /*
        if(Auth::user()->hasRole('admin')){
            $users = User::where('id','<>', Auth::user()->id)->with('latestactivity')->get()   ;
        }else {
            $users = Auth::user()->employess()->with('latestactivity')->get();
        }*/
        return response()->json($users);
    }

    public function supervisor_Logout(Request $request){
        $user = User::findOrFail($request->idUser);
        
        $user->logout=  true;
        $user->save();

        $lastActivity = AgentActivity::where('user_id',$request->idUser)
        ->orderBy('id','desc')
        ->first();
        
        if($lastActivity){
            $lastActivity->touch();
        }

        AgentActivity::create([
            'user_id' => $request->idUser,
            'activity_id' => 2,
            'logout_by' => Auth::user()->id,
        ]);
        $user->latestactivity()->sync( 2);


        // return $user;
        return 'success';
    }

    public function report(){
        return view('agentactivity.reports.index');
    }

    public function reportGetData(Request $request){
        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');

        $dates = "$startDate||$endDate";

        $employess = auth()->user()->employessAllHierarchy()->get();
        $employessID = $employess->pluck('id');
        
        $activities = AgentActivity::leftJoin('users', 'user_id', '=', 'users.id')
        ->leftJoin('activities', 'activity_id', '=', 'activities.id')
        ->selectRaw(
            "users.username as Agent, 
            activities.name as Activity, 
            FORMAT(agent_activities.created_at,'yyyy-MM-dd HH:mm:ss')  as Start_Time, 
            CASE WHEN agent_activities.activity_id = '2' THEN null ELSE FORMAT(agent_activities.updated_at,'yyyy-MM-dd HH:mm:ss') END as End_Time,
            CASE WHEN agent_activities.activity_id = '2' THEN null ELSE FORMAT(DATEADD(ss,DATEDIFF(ss,agent_activities.created_at,agent_activities.updated_at),0),'HH:mm:ss') END as DIFF"
            )
        ->whereIn('user_id', $employessID)
        ->whereDate('agent_activities.created_at', '>=', $startDate)
        ->whereDate('agent_activities.created_at', '<=', $endDate)
        ->get();

        return view('agentactivity.reports.partials.result', compact(['activities', 'dates']));
    }
    
    public function reportDownloadReport($dates)
    {
        $objDate = explode('||', $dates);
        return Excel::download(new AgentActivityReportExport($objDate), "AgentActivity_$objDate[0] _ $objDate[1].xlsx");
    }
}
