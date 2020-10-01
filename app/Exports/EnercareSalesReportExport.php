<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EnercareSalesReportExport implements FromCollection, WithHeadings
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
        return ['date', 'username', 'userteamleader', 'plan', 'cant'];
    }
}
