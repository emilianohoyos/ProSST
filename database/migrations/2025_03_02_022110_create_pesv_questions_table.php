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
        Schema::create('pesv_questions', function (Blueprint $table) {
            $table->id();
            $table->string('question', 900);
            $table->string('level');
            $table->integer('order');
            $table->foreignId('step_id')->constrained()->onDelete('cascade');
            $table->foreignId('action_type_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('source_id')->nullable()->constrained()->onDelete('cascade');
            $table->text('desc_detected_situation')->nullable();
            $table->text('improvement_action')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesv_questions', function (Blueprint $table) {
            $table->dropForeign(['step_id']);
            $table->dropForeign(['action_type_id']);
            $table->dropForeign(['source_id']);
        });
        Schema::dropIfExists('pesv_questions');
    }
};
