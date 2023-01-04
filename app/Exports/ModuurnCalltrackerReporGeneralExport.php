<?php

namespace App\Exports;

use App\ModuurnTracker;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ModuurnCalltrackerReporGeneralExport implements FromCollection, WithHeadings
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
        return ModuurnTracker::whereDate('created','>=',$this->start_date)
        ->leftJoin("users", "users.id", "=", "moduurn_calltrackers.created_by")
        ->whereDate('created','<=',$this->end_date)
        ->selectraw("
            moduurn_calltrackers.id,
            moduurn_calltrackers.phone_number1,
            moduurn_calltrackers.phone_number2,
            moduurn_calltrackers.list_id,
            moduurn_calltrackers.not_show,
            moduurn_calltrackers.is_schedule,
            moduurn_calltrackers.reason_not_schedule,
            moduurn_calltrackers.type,
            moduurn_calltrackers.transferCall,
            moduurn_calltrackers.date_schedule,
            moduurn_calltrackers.country,
            moduurn_calltrackers.region,
            moduurn_calltrackers.state,
            moduurn_calltrackers.expert,
            moduurn_calltrackers.created,
            moduurn_calltrackers.modified,
            users.name
        ")->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'phone_number1',
            'phone_number2',
            'list_id',
            'not_show',
            'is_schedule',
            'reason_not_schedule',
            'type',
            'transferCall',
            'date_schedule',
            'country',
            'region',
            'state',
            'expert',
            'created',
            'modified',
            'created_by'
        ];
    }
}
