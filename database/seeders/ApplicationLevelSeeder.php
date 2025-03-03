<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicationLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            ['name_level' => 'básico', 'observation' => 'Nivel básico según PESV'],
            ['name_level' => 'intermedio', 'observation' => 'Nivel intermedio según PESV'],
            ['name_level' => 'avanzado', 'observation' => 'Nivel avanzado según PESV'],
        ];

        foreach ($levels as $level) {
            DB::table('application_levels')->insert([
                'name_level' => $level['name_level'],
                'observation' => $level['observation'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
