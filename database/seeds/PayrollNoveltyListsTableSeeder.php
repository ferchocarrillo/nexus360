<?php

use Illuminate\Database\Seeder;
use App\PayrollNoveltyList;

class PayrollNoveltyListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PayrollNoveltyList::truncate();

        PayrollNoveltyList::create([
            'name' => 'contingencies',
            'list' => [
                ["cod" => "EG", "name" => "Enfermedad General"],
                ["cod" => "AT", "name" => "Accidente Laboral"],
                ["cod" => "LNR", "name" => "Licencia No Remunerada"],
                ["cod" => "PNR-H", "name" => "Permiso No Remunerado Por Horas"],
                ["cod" => "VAC", "name" => "Vacaciones"],
                ["cod" => "LR", "name" => "Licencia Remunerada"],
                ["cod" => "COMP", "name" => "Compensatorio"],
                ["cod" => "SUS", "name" => "Suspension"],
                ["cod" => "LP", "name" => "Licencia Paternidad"],
                ["cod" => "PR-H", "name" => "Permiso Remunerado En Horas"],
                ["cod" => "LM", "name" => "Licencia Maternidad"],
                // ["cod"=>"RET","name"=>"Retiro"],
                // ["cod"=>"RET VOL","name"=>"Retiro Voluntario"],
                // ["cod"=>"RET JUS","name"=>"Retiro Justa Causa"],
                // ["cod"=>"RET SIN JUS","name"=>"Retiro Sin Justa Causa"],
                ["cod" => "LT", "name" => "Licencia de Luto"]
            ]
        ]);

        PayrollNoveltyList::create([
            'name' => 'statuses',
            'list' => [
                "INFERIOR",
                "RADICADA",
                "PTE. RECO",
                "PTE. RECO CARTA",
                "NO APLICA",
                "NEGADA",
                "NEGADA PERIODO COTIZACION",
                "PAGADA",
                "PTE. TRANSFERENCIA",
                "PTE. TRANSCRIPCION"
            ]
        ]);

        PayrollNoveltyList::create([
            'name' => 'tags',
            'list' => [
                // "RETIRO",
                ["text" => "REPORTADA EXTEM - ANULADA - NO APLICA", "filter" => 0],
                ["text" => "PENDIENTE POR APLICAR EN SIG NOM", "filter" => 1],
                ["text" => "GRABADA EN NOVA", "filter" => 0],
                ["text" => "PENDIENTE POR GRABAR", "filter" => 1],
            ]
        ]);

        PayrollNoveltyList::create([
            'name' => 'cods_nova',
            'list' => [
                ["contingency" => "EG", "cod" => "1112", "cod_nova" => "INC"],
                ["contingency" => "SUS", "cod" => "1010", "cod_nova" => "SUSP"],
                ["contingency" => "SANC", "cod" => "1010", "cod_nova" => "SANC"],
                ["contingency" => "LNR", "cod" => "1005", "cod_nova" => "LNR"],
                // ["contingency" => "LT", "cod" => "1109", "cod_nova" => "LT"],
                ["contingency" => "LR", "cod" => "1119", "cod_nova" => "LR"],
                ["contingency" => "AT", "cod" => "1110", "cod_nova" => "AT"],
                ["contingency" => "LP", "cod" => "1113", "cod_nova" => "LP"],
                ["contingency" => "LM", "cod" => "1113", "cod_nova" => "LM"]
            ]
        ]);
    }
}
