<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documentTypes = [
            ['name' => 'Cédula de Ciudadanía', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cédula de Extranjería', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'NIT', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pasaporte', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('document_types')->insert($documentTypes);
    }
}
