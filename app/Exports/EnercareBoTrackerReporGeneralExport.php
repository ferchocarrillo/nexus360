<?php

namespace App\Exports;

use App\EnercareBoTracker;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EnercareBoTrackerReporGeneralExport implements FromCollection, WithHeadings
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
        return EnercareBoTracker::whereDate('created','>=',$this->start_date)
        ->leftJoin("users", "users.id", "=", "enercare_bo_trackers.created_by")
        ->whereDate('created','<=',$this->end_date)
        ->selectraw("
            enercare_bo_trackers.id,
            enercare_bo_trackers.lob,
            enercare_bo_trackers.queue_tracker,
            enercare_bo_trackers.[case],
            enercare_bo_trackers.case_actioned,
            enercare_bo_trackers.created,
            enercare_bo_trackers.modified,
            users.name,
            enercare_bo_trackers.call_centre
        ")->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'lob',
            'queue_tracker',
            'case',
            'case_actioned',
            'created',
            'modified',
            'created_by',
            'call_centre'
        ];
    }
}
