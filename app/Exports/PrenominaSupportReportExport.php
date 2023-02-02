<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PrenominaSupportReportExport implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize, WithColumnFormatting, WithMapping, WithStrictNullComparison
{
    private $employees;

    public function __construct($employees)
    {
        $this->employees = $employees->map(function($employee){
            return $employee->payrollSupport;
        })->collapse();
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->employees;
    }

    public function map($novelty): array
    {
        return [
            "date" => Date::dateTimeToExcel(Carbon::parse($novelty->date)),
            "national_id" => $novelty->national_id,
            "novelty" => $novelty->novelty,
            "novelty_id" => $novelty->novelty_id,
            "total_time_in_seconds" => $novelty->total_time_in_seconds / 3600,
            "start_date" => Date::dateTimeToExcel(Carbon::parse($novelty->start_date)),
            "end_date" => Date::dateTimeToExcel(Carbon::parse($novelty->end_date)),
        ];
    }

    public function title(): string
    {
        return 'Soporte';
    }

    public function headings(): array
    {
        return [
            'FECHA',
            'IDENTIFICACION',
            'NOVEDAD',
            'NUMERO_INC',
            'HORAS',
            'HORA INICIO',
            'HORA FIN',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'E' => NumberFormat::FORMAT_NUMBER_00,
            'F' => NumberFormat::FORMAT_DATE_TIME2,
            'G' => NumberFormat::FORMAT_DATE_TIME2,
        ];
    }
}
