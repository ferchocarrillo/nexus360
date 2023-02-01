<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PrenominaReportExport implements WithMultipleSheets
{

    use Exportable;

    protected $employees;
    protected $employeesSummary;
    protected $employeesSupport;

    public function __construct($employees)
    {
        $this->employees = $employees;

        $this->employeesSummary = $this->employees->map(function($employee){
            return collect($employee)
            ->only(['campaign','supervisor','national_id','full_name','position','date_of_hire','termination_date'])
            ->merge($employee->prenomina);
        });

        $this->employeesSupport = $this->employees->map(function($employee){
            return $employee->payrollSupport;
        })->collapse()->map(function($novelty){
            return [
                "date" => Date::dateTimeToExcel(Carbon::parse($novelty->date)),
                "national_id" => $novelty->national_id,
                "novelty" => $novelty->novelty,
                "novelty_id" => $novelty->novelty_id,
                "total_time_in_seconds" => $novelty->total_time_in_seconds / 3600,
                "start_date" => Date::dateTimeToExcel(Carbon::parse($novelty->start_date)),
                "end_date" => Date::dateTimeToExcel(Carbon::parse($novelty->end_date)),
            ];
        });

    }

    public function sheets(): array
    {
        $sheets = [
            new PrenominaSummaryReportExport($this->employeesSummary),
            new PrenominaSupportReportExport($this->employeesSupport)
        ];

        return $sheets;

    }
}
