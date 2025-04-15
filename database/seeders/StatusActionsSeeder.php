<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusActionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('status_actions')->insert([
            ['name' => 'Abierta'],
            ['name' => 'En desarrollo'],
            ['name' => 'Cerrada']
        ]);
    }
}
