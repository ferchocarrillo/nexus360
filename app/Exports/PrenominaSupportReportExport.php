<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PrenominaSupportReportExport implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize, WithColumnFormatting
{
    private $employees;

    public function __construct($employees)
    {
        $this->employees = $employees;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->employees;
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
