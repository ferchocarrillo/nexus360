<?php


namespace App\Exports;

use App\AgentActivity;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AgentActivityReportExport implements FromCollection, WithHeadings
{




    protected $dates;

    function __construct($dates)
    {
        $this->dates = $dates;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $startDate = $this->dates[0];
        $endDate = $this->dates[1];

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

        return $activities;
    }

    public function headings(): array
    {
        return ['agent', 'activity', 'start_time', 'end_time', 'duration'];
    }

}
