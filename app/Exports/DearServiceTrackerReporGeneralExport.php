<?php

namespace App\Exports;

use App\DearService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DearServiceTrackerReporGeneralExport implements FromCollection, WithHeadings
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
        return DearService::whereDate('dear_services_tracker.created_at','>=',$this->start_date)
        ->leftJoin("users", "users.id", "=", "dear_services_tracker.created_by")
        ->whereDate('dear_services_tracker.created_at','<=',$this->end_date)
        ->select(
            'dear_services_tracker.id',
            'dear_services_tracker.custumer_name',
            'dear_services_tracker.phone_number',
            'dear_services_tracker.disposition',
            'dear_services_tracker.call_attempts',
            'dear_services_tracker.comments',
            'users.name',
            'dear_services_tracker.created_at',
            'dear_services_tracker.updated_at'
        )->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'custumer_name',
            'phone_number',
            'disposition',
            'call_attempts',
            'comments',
            'created_by',
            'created_at',
            'updated_at'
        ];
    }
}
