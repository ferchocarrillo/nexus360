<?php

namespace App\Exports;

use App\PayrollNovelty;
use App\PayrollNoveltySmlv;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PayrollNoveltyReportGeneralExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $smlvs = PayrollNoveltySmlv::get()->pluck('daily_salary','year')->toArray();
        
        $novelties = PayrollNovelty::select(
            'payroll_novelties.id',
            'payroll_novelties.employee_id',
            'payroll_novelties.national_id',
            'payroll_novelties.pep',
            'payroll_novelties.full_name',
            'payroll_novelties.date_of_hire',
            'payroll_novelties.campaign',
            'payroll_novelties.eps',
            'payroll_novelties.supervisor',
            'payroll_novelties.basic_salary_cop',
            'payroll_novelties.tag',
            'payroll_novelties.contingency',
            'payroll_novelties.cie10',
            'payroll_novelties.cie10_description',
            'payroll_novelties.start_date',
            'payroll_novelties.end_date',
            'payroll_novelties.days_hours',
            'payroll_novelties.extension',
            'payroll_novelties.extension_id',
            'payroll_novelties.status',
            'payroll_novelties.payroll_date',
            'payroll_novelties.days_to_recover',
            'payroll_novelties.date_of_filing',
            'payroll_novelties.recognized_value',
            'payroll_novelties.date_of_deposit',
            'payroll_novelties.observation',
            'users.name as created_by',
            'payroll_novelties.created_at',
            'payroll_novelties.updated_at'
        )->
        leftJoin('users','users.id','=','payroll_novelties.created_by')->
        get();

        return $novelties->map(function($novelty)use($smlvs){
            $yearStart_Date = date("Y",strtotime($novelty->start_date));
            if($novelty->extension =='1'){
                $novelty->extension = 'SI';
            }else if($novelty->extension =='0'){
                $novelty->extension = 'NO';
            }
            $novelty->estimated_to_recover = 0;
            if($novelty->days_to_recover && array_key_exists($yearStart_Date,$smlvs)){
                $novelty->estimated_to_recover = (
                        (($novelty->basic_salary_cop/30)*0.6667) < $smlvs[$yearStart_Date] ? 
                        $smlvs[$yearStart_Date]:
                        (($novelty->basic_salary_cop/30)*0.6667)
                    )*$novelty->days_to_recover; 
            }

            return $novelty;
        });
    }

    public function headings(): array
    {
        return [
            'CON',
            'ID EMPLEADO',
            'DOCUMENTO',
            'PEP',
            'NOMBRES',
            'FEC ING',
            'CAMPAÑA',
            'ENTIDAD',
            'SUPERVISOR',
            'BASICO',
            'ETIQUETA',
            'CONT',
            'DX',
            'DESCRIPCION',
            'F INICIAL',
            'F FINAL',
            'DIAS',
            'PRORR',
            'ID PRORROGA',
            'ESTADO',
            'REPORTE NOMINA',
            'DIAS A RECOBRAR',
            'FECHA RAD',
            'VALOR RECONOCIDO',
            'FECHA DE ABONO',
            'OBSERVACIONES',
            'CREADO POR',
            'FECHA CREACION',
            'FECHA ACTUALIZACION',
            'ESTIMADO A RECOBRAR'
        ];
    }
}
