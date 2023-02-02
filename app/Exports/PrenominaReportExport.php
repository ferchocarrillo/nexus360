<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PrenominaReportExport implements WithMultipleSheets
{

    use Exportable;

    protected $employees;

    public function __construct($employees)
    {
        $this->employees = $employees;
    }

    public function sheets(): array
    {
        $sheets = [
            new PrenominaSummaryReportExport($this->employees),
            new PrenominaSupportReportExport($this->employees)
        ];

        return $sheets;

    }
}
