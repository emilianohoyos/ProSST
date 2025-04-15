<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImprovementActionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actions = [
            ['name' => 'Si fue eficaz'],
            ['name' => 'Aún está en desarrollo'],
            ['name' => 'No fue eficaz'],
        ];

        DB::table('improvement_actions')->insert($actions);
    }
}
