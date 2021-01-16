<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EnercareCallTrackerReportExport implements FromCollection, WithHeadings
{

    protected $query;

    function __construct($query)
    {
        $this->query = $query;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->query;
    }

    public function headings(): array
    {
        return ['id','site_id','username','supervisor','lob','service_call','category','subcategory','reason_not_pitch','reason_not_sale','created_at','type','plan','contract_id','upgrade','rwh','bogo','repairplan','typesale'];
    }
}
