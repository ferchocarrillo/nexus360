<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PrenominaSummaryReportExport implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize, WithColumnFormatting, WithMapping, WithStrictNullComparison
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

    public function map($row): array
    {
        $data = collect([
            $row->campaign,
            $row->supervisor,
            $row->national_id,
            $row->full_name,
            $row->position,
            $row->date_of_hire,
            $row->termination_date,
        ])->merge($row->prenomina->except('HORAS REMUNERADAS')->values());
        return $data->toArray();
    }

    public function title(): string
    {
        return 'Prenomina';
    }

    public function headings(): array
    {
        return [
            "CAMPAÑA",
            "SUPERVISOR",
            "IDENTIFICACION",
            "NOMBRE",
            "CARGO",
            "JOIN DATE",
            "TERMINATION DATE",
            "DÍAS LABORADOS",
            "DÍAS NOVEDADES",
            "HORAS EXTRA /RECARGOS",
            "REMUNERADO",
            "DÍAS NO REMUNERADOS",
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
        ];
    }
}
