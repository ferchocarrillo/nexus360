<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PrenominaSummaryReportExport implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize, WithColumnFormatting
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
        return 'Prenomina';
    }

    public function headings(): array
    {
        return [
            "IDENTIFICACION",
            "NOMBRE",
            "CAMPAÑA",
            "CARGO",
            "SUPERVISOR",
            "JOIN DATE",
            "TERMINATION DATE",
            "DIAS LABORADOS",
            "DIAS NOVEDADES",
            "HORAS EXTRA / RECARGOS",
            "DIAS REMUNERADOS",
            "HORAS REMUNERADAS",
            "DIAS NO REMUNERADOS",
            "HORAS NO REMUNERADAS",
            "INCAPACIDAD",
            "LICENCIA MATERNIDAD/PATERNIDAD",
            "VACACIONES",
            "HORA FESTIVO COMPENSADO",
            "HORA EXTRA DIURNA",
            "HORA EXTRA NOCTURNA",
            "HORA EXTRA DIURNA FESTIVA",
            "HORA EXTRA NOCTURNA FESTIVA",
            "HORA FESTIVO SIN COMPENSAR",
            "HORA RECARGO NOCTURNO",
            "HORA RECARGO NOCTURNO FESTIVO",
            "LICENCIA DE LUTO",
            "LICENCIA REMUNERADA",
            "HORA PERMISO REMUNERADO",
            "INASISTENCIA DIA",
            "DOMINGO DESCONTADO",
            "LICENCIA NO REMUNERADA",
            "HORA PERMISO NO REMUNERADO",
            "INASISTENCIA HORAS",
            "SUSPENSION",
        ];
    }

    public function columnFormats(): array
    {
        return [
            'H' => NumberFormat::FORMAT_NUMBER_00,
            'I' => NumberFormat::FORMAT_NUMBER_00,
            'J' => NumberFormat::FORMAT_NUMBER_00,
            'K' => NumberFormat::FORMAT_NUMBER_00,
            'L' => NumberFormat::FORMAT_NUMBER_00,
            'M' => NumberFormat::FORMAT_NUMBER_00,
            'N' => NumberFormat::FORMAT_NUMBER_00,
            'O' => NumberFormat::FORMAT_NUMBER_00,
            'P' => NumberFormat::FORMAT_NUMBER_00,
            'Q' => NumberFormat::FORMAT_NUMBER_00,
            'R' => NumberFormat::FORMAT_NUMBER_00,
            'S' => NumberFormat::FORMAT_NUMBER_00,
            'T' => NumberFormat::FORMAT_NUMBER_00,
            'U' => NumberFormat::FORMAT_NUMBER_00,
            'V' => NumberFormat::FORMAT_NUMBER_00,
            'W' => NumberFormat::FORMAT_NUMBER_00,
            'X' => NumberFormat::FORMAT_NUMBER_00,
            'Y' => NumberFormat::FORMAT_NUMBER_00,
            'Z' => NumberFormat::FORMAT_NUMBER_00,
            'AA' => NumberFormat::FORMAT_NUMBER_00,
            'AB' => NumberFormat::FORMAT_NUMBER_00,
            'AC' => NumberFormat::FORMAT_NUMBER_00,
            'AD' => NumberFormat::FORMAT_NUMBER_00,
            'AE' => NumberFormat::FORMAT_NUMBER_00,
            'AF' => NumberFormat::FORMAT_NUMBER_00,
            'AG' => NumberFormat::FORMAT_NUMBER_00,
            'AH' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }
}
