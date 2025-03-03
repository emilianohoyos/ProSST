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
        Schema::create('pesv_improvement_plan_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesv_assessment_id')->constrained()->onDelete('cascade');
            $table->foreignId('pesv_question_id')->constrained()->onDelete('cascade');
            $table->text('analysis_cause');
            $table->boolean('action_was_effective');
            $table->string('state_action');
            $table->text('people_to_be_informed');
            $table->text('channel_diffusion_improvement_action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesv_improvement_plan_answers', function (Blueprint $table) {
            $table->dropForeign(['pesv_assessment_id']);
            $table->dropForeign(['pesv_question_id']);
        });
        Schema::dropIfExists('pesv_improvement_plan_answers');
    }
};
