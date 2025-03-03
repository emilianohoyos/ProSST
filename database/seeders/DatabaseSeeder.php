<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            StepSeeder::class,
            StateSeeder::class,
            ActionTypeSeeder::class,
            ApplicationLevelSeeder::class,
            DocumentTypeSeeder::class,
            PersonTypeSeeder::class,
            QualificationSeeder::class,
            SourceSeeder::class,
            QuestionSeeder::class,
        ]);
    }
}
