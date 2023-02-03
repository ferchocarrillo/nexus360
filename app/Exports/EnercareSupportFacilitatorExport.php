<?php

namespace App\Exports;

use App\EnercareTrackerSupportFacilitator;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
class EnercareSupportFacilitatorExport implements FromCollection, WithHeadings
{
    protected $start_date;
    protected $end_date;
    function __construct($start_date,$end_date){
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return EnercareTrackerSupportFacilitator::whereDate('enercare_tracker_support_facilitators.created_at','>=',$this->start_date)
        ->leftJoin("enercare.dbo.tbrostercontactpoint", function($join){
            $join->on("tbrostercontactpoint.DOK-USER-CITRIX ID", "=", "enercare_tracker_support_facilitators.agent");
            $join->on("Start DateR", "=", DB::raw('CAST(enercare_tracker_support_facilitators.created_at as date)'));
        })
        ->whereDate('enercare_tracker_support_facilitators.created_at','<=',$this->end_date)
        ->leftJoin("users", "users.id", "=", "enercare_tracker_support_facilitators.created_by")
        ->selectraw("
            enercare_tracker_support_facilitators.id,
            enercare_tracker_support_facilitators.agent,
            tbrostercontactpoint.FullName,
            tbrostercontactpoint.lob,
            tbrostercontactpoint.TeamLeader,
            tbrostercontactpoint.OM,
            tbrostercontactpoint.Campaign,
            tbrostercontactpoint.Position,
            enercare_tracker_support_facilitators.process,
            enercare_tracker_support_facilitators.process_specific,
            enercare_tracker_support_facilitators.additional_details,
            enercare_tracker_support_facilitators.behavior_identified,
            enercare_tracker_support_facilitators.recomendations,
            enercare_tracker_support_facilitators.repeated_interaction,
            enercare_tracker_support_facilitators.observations,
            enercare_tracker_support_facilitators.conference_in,
            enercare_tracker_support_facilitators.supervisor_assistence,
            users.name,
            enercare_tracker_support_facilitators.created_at,
            enercare_tracker_support_facilitators.updated_at
        ")->get();
    }


    public function headings(): array
    {
        return [
        'id',
        'agent',
        'FullName',
        'lob',
        'TeamLeader',
        'OM',
        'Campaign',
        'Position',
        'process',
        'process_specific',
        'additional_details',
        'behavior_identified',
        'recomendations',
        'repeated_interaction',
        'observations',
        'conference_in',
        'supervisor_assistence',
        'created_by',
        'created_at',
        'updated_at',
        ];
    }
}
