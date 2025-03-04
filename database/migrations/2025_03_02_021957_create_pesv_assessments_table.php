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
        Schema::create('pesv_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('application_level_id')->constrained()->onDelete('cascade');
            $table->date('completed_at')->nullable();
            $table->date('report_submitted_at')->nullable();
            $table->string('evaluated_process')->nullable();
            $table->string('path_work_plan')->nullable();
            $table->string('path_improvement_plan_path')->nullable();
            $table->integer('number_vehicles')->nullable();
            $table->foreignId('state_id')->constrained()->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesv_assessments', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['client_id']);
            $table->dropForeign(['state_id']);
            $table->dropForeign(['application_level_id']);
        });
        Schema::dropIfExists('pesv_assessments');
    }
};
