<?php

use App\PayrollAdjustmentType;
use Illuminate\Database\Seeder;

class PayrollAdjustmentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $adjustmentTypes = [
            "Tiempo pendiente aprobar" => [
                "adjustment_types" => [
                    "Reposicion Hora" => [
                        "approve_by_om" => True,
                        "justifications" => [
                            "Problemas de conectividad",
                            "Problemas de energia",
                            "Permiso Justificado",
                            "Evento Corporativo",
                            "Cita médica personal",
                            "Diligencias Administrativas (Legal)"
                        ],
                    ],
                    "Hora Extra" => [
                        "approve_by_om" => True,
                        "justifications" => [
                            "Requerimiento de cliente",
                            "Requerimiento de operación"
                        ],
                    ],
                    "Cumple Horas de Contrato" => [
                        "approve_by_om" => True,
                        "justifications" => [
                            "Requerimiento de cliente",
                            "Requerimiento de operación"
                        ]
                    ]
                ]
            ],
            "Inasistencia Hrs" => [
                "adjustment_types" => [
                    "Permiso Remunerado" => [
                        "approve_by_om" => False,
                        "justifications" => [
                            "Calamidad domestica",
                            "Permiso de votacion ",
                            "Dia de cumpleaños",
                            "Día de la familia"
                        ],
                    ],
                    "Permiso No Remunerado" => [
                        "approve_by_om" => False,
                        "justifications" => [
                            "Permiso Justificado",
                            "Diligencias Administrativas (Legal)",
                            "Evento deportivo"
                        ],
                    ],
                    "Error del sistema" => [
                        "approve_by_om" => False,
                        "justifications" => [
                            "Conectividad a internet",
                            "Aplicativos del cliente",
                            "Aplicativos de CP360",
                            "Problema fisico del computador"
                        ],
                    ],
                ]
            ]
        ];

        foreach ($adjustmentTypes as $activityType => $activityTypeData) {
            foreach ($activityTypeData['adjustment_types'] as $adjustmentType => $adjustmentTypeData) {
                foreach ($adjustmentTypeData['justifications'] as $justification) {
                    PayrollAdjustmentType::create([
                        "activity_type" => $activityType,
                        "adjustment_type" => $adjustmentType,
                        "approve_by_om" => $adjustmentTypeData['approve_by_om'],
                        "justification" => $justification,
                        "active" => True,
                    ]);
                }
            }
        }
    }
}
