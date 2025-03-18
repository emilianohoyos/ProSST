<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PesvCauseImprovementPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $causes = [
            'Falta de voluntad para implementar este requerimiento.',
            'Insuficiente compromiso y liderazgo de la alta dirección.',
            'Recursos técnicos y humanos limitados.',
            'Falta de evaluaciones de riesgo adecuadas.',
            'Comunicación interna deficiente.',
            'No actualización de políticas conforme a cambios legislativos.',
            'Falta de supervisión y monitoreo continuo.',
            'Ausencia de procedimientos claros para este tema.',
            'Inadecuada coordinación entre departamentos.',
            'No se tenía conocimiento sobre este requerimiento.',
            'Resistencia al cambio.',
            'Baja percepción de las consecuencias de incumplimientos.',
        ];

        foreach ($causes as $cause) {
            DB::table('pesv_cause_improvement_plans')->insert([
                'name' => $cause,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
