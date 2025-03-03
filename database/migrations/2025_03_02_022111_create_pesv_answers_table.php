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
        Schema::create('pesv_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesv_assessment_id')->constrained()->onDelete('cascade');
            $table->foreignId('pesv_question_id')->constrained()->onDelete('cascade');
            $table->foreignId('qualification_id')->constrained()->onDelete('cascade');
            $table->text('observation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesv_answers', function (Blueprint $table) {
            $table->dropForeign(['pesv_assessment_id']);
            $table->dropForeign(['pesv_question_id']);
            $table->dropForeign(['qualification_id']);
        });
        Schema::dropIfExists('pesv_answers');
    }
};
