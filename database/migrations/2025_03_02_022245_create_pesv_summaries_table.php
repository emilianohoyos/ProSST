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
        Schema::create('pesv_summaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesv_assessment_id')->constrained()->onDelete('cascade');
            $table->foreignId('step_id')->constrained()->onDelete('cascade');
            $table->integer('not complied');
            $table->integer('partially_complied');
            $table->integer('complied');
            $table->integer('evaluated');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesv_summaries', function (Blueprint $table) {
            $table->dropForeign(['pesv_assessment_id']);
            $table->dropForeign(['step_id']);
        });
        Schema::dropIfExists('pesv_summaries');
    }
};
