<?php

namespace App\Exports;

use App\PayrollNovelty;
use App\PayrollNoveltyList;
use Carbon\Carbon;
use Exception;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use stdClass;

class PayrollNoveltyFlatFileExport implements FromCollection, WithHeadings
{
    protected $novelties;

    function __construct($novelties)
    {
        $this->novelties = $novelties;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $cods_nova = PayrollNoveltyList::where('name','cods_nova')->firstOrFail()->list;
        $novelties = $this->novelties;

        $flatFile = [];
        foreach ($novelties as $novelty) {
            try {
                $objCodNova = (object) current(array_filter($cods_nova,function($cod) use($novelty){return $cod["contingency"] == $novelty->contingency;}));
            } catch(Exception $e){
                throw new Exception("$novelty->id$novelty->contingency");
            }

            
            $periods = $this->getPeriods($novelty->start_date,$novelty->end_date);

            foreach($periods as $period){
                $flatFile[] =[
                    "his_inc" => $novelty->national_id,
                    "cod_inc" => $objCodNova->cod,
                    "num_inc" => $objCodNova->cod_nova.$novelty->id,
                    "fec_per" => $period->payroll_date,
                    "dia_inc" => $period->days,
                    "ibc_inc" => (int) $novelty->basic_salary_cop,
                    "num_ina" => ($novelty->extension_id ? $objCodNova->cod_nova.$novelty->extension_id : null),
                    "ind_liq" => null,
                    "fec_ina" => $period->start_date,
                    "fec_inc" => $period->start_date,
                    "fec_fin" => $period->end_date,
                    "cod_dig" => $novelty->cie10,
                ] ;
            }
            
        }
        return collect($flatFile);               
    }

    private function getPeriods($start_date,$end_date){

        $start_date = Carbon::parse($start_date);
        $end_date = Carbon::parse($end_date);

        $diffDays = $start_date->diffInDays($end_date)+1;

        $q = ceil($diffDays/15);        

        $periods = [];
        

        for ($i=0; $i <= $q ; $i++) {
            $payroll_date = ($start_date->day > 15 ? $start_date->copy()->endOfMonth()->floorDay() :  $start_date->copy()->addDays(15-$start_date->day));
            $data = new stdClass();
            $data->payroll_date = $payroll_date->isoFormat("YYYY-MM-DD");
            $data->start_date = $start_date->isoFormat("YYYY-MM-DD");
            $data->end_date = ($payroll_date->gte($end_date) ?  $end_date->isoFormat("YYYY-MM-DD") : $payroll_date->isoFormat("YYYY-MM-DD"));
            $data->days = ($payroll_date->gte($end_date) ?  $start_date->diffInDays($end_date) : $start_date->diffInDays($payroll_date))+1;
            
            $data->check= [
                "start/end_date"=> [$start_date,$end_date,$payroll_date],
                "payroll_date_1"=> $start_date->diffInDays($end_date),
                "payroll_date_2"=> $start_date->diffInDays($payroll_date)
            ];

            $periods[] = $data;
            if($payroll_date->gte($end_date)){
                return $periods;
            }else{
                $start_date = $payroll_date->addDay();
            }
        }

        return $periods;
    }

    public function headings(): array
    {
        return [
            "his_inc",
            "cod_inc",
            "num_inc",
            "fec_per",
            "dia_inc",
            "ibc_inc",
            "num_ina",
            "ind_liq",
            "fec_ina",
            "fec_inc",
            "fec_fin",
            "cod_dig"
        ];
    }
}

