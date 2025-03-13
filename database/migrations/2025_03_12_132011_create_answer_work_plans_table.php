<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('answer_work_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_plan_id')->constrained()->onDelete('cascade');
            $table->foreignId('work_plan_activity_id')->constrained()->onDelete('cascade');
            $table->foreignId('responsible_work_plan_id')->constrained()->onDelete('cascade');
            $table->foreignId('status_activity_work_plan_id')->constrained()->onDelete('cascade');
            $table->foreignId('monitoring_work_plan_id')->constrained()->onDelete('cascade');
            $table->foreignId('resources_work_plan_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('answer_work_plans', function (Blueprint $table) {
            $table->dropForeign(['work_plan_id']);
            $table->dropForeign(['work_plan_activity_id']);
            $table->dropForeign(['responsible_work_plan_id']);
            $table->dropForeign(['status_activity_work_plan_id']);
            $table->dropForeign(['monitoring_work_plan_id']);
            $table->dropForeign(['resources_work_plan_id']);
        });
        Schema::dropIfExists('answer_work_plans');
    }
};
