<?php

namespace App\Exports;

use App\AmericanWaterBoTracker;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AmericanWaterBoTrackerReporGeneralExport implements FromCollection, WithHeadings
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
        return AmericanWaterBoTracker::whereDate('created_at','>=',$this->start_date)
        ->whereDate('created_at','<=',$this->end_date)->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'username',
            'queue',
            'cus_id',
            'customer_name',
            'spreadsheet',
            'status',
            'enr_number',
            'agreement_classification',
            'additional_notes',
            'started_at',
            'created_at',
            'updated_at'
        ];
    }
}
