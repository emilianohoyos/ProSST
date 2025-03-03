<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Natural', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Juridica', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('person_types')->insert($types);
    }
}
