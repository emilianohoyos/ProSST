<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('states')->insert([
            ['name' => 'Creado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'En Gestión', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Finalizado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
