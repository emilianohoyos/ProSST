<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $steps = [
            ['id' => 0, 'description' => 'Preguntas para evaluar el nivel general de la gestión del riesgo vial'],
            ['id' => 1, 'description' => 'Líder del diseño e implementación del PESV.'],
            ['id' => 2, 'description' => 'Comité de seguridad vial'],
            ['id' => 3, 'description' => 'Política de Seguridad Vial de la organización.'],
            ['id' => 4, 'description' => 'Liderazgo, compromiso y corresponsabilidad del nivel directivo.'],
            ['id' => 5, 'description' => 'Diagnóstico'],
            ['id' => 6, 'description' => 'Caracterización, Evaluación y control de riesgos.'],
            ['id' => 7, 'description' => 'Objetivos y metas del PESV'],
            ['id' => 8, 'description' => 'Programas de gestión de riesgos críticos y factores de desempeño'],
            ['id' => 9, 'description' => 'Plan anual de trabajo'],
            ['id' => 10, 'description' => 'Competencia y plan anual de formación'],
            ['id' => 11, 'description' => 'Responsabilidad y comportamiento seguro'],
            ['id' => 12, 'description' => 'Plan de preparación y respuesta ante emergencias viales.'],
            ['id' => 13, 'description' => 'Investigación Interna de siniestros viales'],
            ['id' => 14, 'description' => 'Vías seguras administradas por la organización'],
            ['id' => 15, 'description' => 'Planificación de desplazamientos laborales.'],
            ['id' => 16, 'description' => 'Inspección de vehículos y equipos'],
            ['id' => 17, 'description' => 'Mantenimiento y control de vehículos seguros y equipos'],
            ['id' => 18, 'description' => 'Gestión del cambio y gestión de contratistas'],
            ['id' => 19, 'description' => 'Archivo documental y retención documental'],
            ['id' => 20, 'description' => 'Definición de indicadores'],
            ['id' => 21, 'description' => 'Registro y análisis estadístico de siniestros viales.'],
            ['id' => 22, 'description' => 'Auditoría anual'],
            ['id' => 23, 'description' => 'Mejora continua, acciones preventivas y correctivas'],
            ['id' => 24, 'description' => 'Mecanismos de comunicación y participación.'],
        ];

        foreach ($steps as $step) {
            DB::table('steps')->insert([
                'id' => $step['id'],
                'description' => $step['description'],
                'observation' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
