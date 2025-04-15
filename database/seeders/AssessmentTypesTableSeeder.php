<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssessmentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Auditoría'],
            ['name' => 'Diagnóstico'],
            // Puedes agregar más tipos aquí si lo necesitas
        ];

        DB::table('assessment_types')->insert($types);
    }
}
