<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $qualifications = ['NA', '0', '1', '2'];

        foreach ($qualifications as $qualification) {
            DB::table('qualifications')->insert([
                'name' => $qualification,
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
