<?php

namespace App\Exports;

use App\PayrollNovelty;
use App\PayrollNoveltyList;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PayrollNoveltyReportRRHHExport implements FromCollection, WithHeadings
{
    protected $start_date;

    function __construct($start_date)
    {
        $this->start_date = $start_date;    
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $novelties = PayrollNovelty::where('start_date','>=',$this->start_date)->orWhere('end_date','>=',$this->start_date)
        ->select('id','supervisor','campaign','full_name','national_id','start_date','end_date','days_hours','contingency as contingency_name','cie10','cie10_description','observation')
        ->get();

        $contingencies = array_column(PayrollNoveltyList::where('name','contingencies')->firstOrFail()->list,'name','cod');

        
        return $novelties->map(function($novelty)use($contingencies) {
            $novelty->contingency_name = $contingencies[$novelty->contingency_name];
            unset($novelty->contingency);
            return $novelty;
        });
    }

    public function headings(): array
    {
        return [
            "CON",
            "SUPERVISOR",
            "CAMPAÑA",
            "NOMBRES",
            "DOCUMENTO",
            "F INICIAL",
            "F FINAL",
            "DIAS",
            "NOMBRE NOVEDAD",
            "DX",
            "DESCRIPCION",
            "OBSERVACIONES"
        ];
    }
}
