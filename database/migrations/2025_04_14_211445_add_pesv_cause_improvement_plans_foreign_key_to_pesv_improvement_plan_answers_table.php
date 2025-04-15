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
        Schema::table('pesv_improvement_plan_answers', function (Blueprint $table) {
            $table->foreignId('pesv_cause_improvement_plan_id')->nullable()->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesv_improvement_plan_answers', function (Blueprint $table) {
            $table->dropForeign(['assessment_type_id']);
            $table->dropColumn('assessment_type_id');
        });
    }
};
