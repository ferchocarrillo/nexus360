<?php

namespace App\Exports;

use App\AmericanWaterFieldSupportTracker;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AmericanWaterFieldSupportExport implements FromCollection, WithHeadings
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
        return AmericanWaterFieldSupportTracker::whereDate('created','>=',$this->start_date)
        ->leftJoin("users", "users.id", "=", "american_water_field_support_trackers.created_by")
        ->whereDate('created','<=',$this->end_date)
        ->selectraw("
            american_water_field_support_trackers.id,
            american_water_field_support_trackers.claim_number,
            american_water_field_support_trackers.threshold,
            american_water_field_support_trackers.status,
            american_water_field_support_trackers.observations,
            american_water_field_support_trackers.case_actioned,
            american_water_field_support_trackers.created,
            american_water_field_support_trackers.modified,
            users.name
        " )->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'claim_number',
            'threshold',
            'status',
            'observations',
            'case_actioned',
            'created',
            'modified',
            'created_by'
        ];
    }
}
