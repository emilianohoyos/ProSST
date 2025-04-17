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
            DocumentTypeSeeder::class,
            PersonTypeSeeder::class,
            AdminUserSeeder::class,
            StepSeeder::class,
            StateSeeder::class,
            PesvCauseImprovementPlanSeeder::class,
            ActionTypeSeeder::class,
            ApplicationLevelSeeder::class,
            QualificationSeeder::class,
            SourceSeeder::class,
            QuestionSeeder::class,
            AssessmentTypesTableSeeder::class,
            ImprovementActionsSeeder::class,
            StatusActionsSeeder::class,
            WorkPlanActivitiesSeeder::class,
        ]);
    }
}
