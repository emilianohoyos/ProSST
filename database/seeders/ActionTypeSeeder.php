<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actionTypes = [
            ['name' => 'Correctiva', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Preventiva', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mejora', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('action_types')->insert($actionTypes);
    }
}
