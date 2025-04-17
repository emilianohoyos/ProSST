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
        Schema::create('work_plan_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_plan_id')->constrained()->onDelete('cascade');
            $table->foreignId('work_plan_activity_id')->constrained()->onDelete('cascade');
            $table->boolean('month_1')->default(false);
            $table->boolean('month_2')->default(false);
            $table->boolean('month_3')->default(false);
            $table->boolean('month_4')->default(false);
            $table->boolean('month_5')->default(false);
            $table->boolean('month_6')->default(false);
            $table->boolean('month_7')->default(false);
            $table->boolean('month_8')->default(false);
            $table->boolean('month_9')->default(false);
            $table->boolean('month_10')->default(false);
            $table->boolean('month_11')->default(false);
            $table->boolean('month_12')->default(false);
            $table->boolean('resource_physical')->default(false);
            $table->boolean('resource_economic')->default(false);
            $table->boolean('resource_human')->default(false);
            $table->string('follow_up')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('work_plan_answers', function (Blueprint $table) {
            $table->dropForeign(['work_plan_id']);
            $table->dropForeign(['work_plan_activity_id']);
        });
        Schema::dropIfExists('work_plan_answers');
    }
};
