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
        Schema::table('pesv_assessments', function (Blueprint $table) {
            $table->text('participants')
                ->nullable();
            $table->text('key_aspects')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesv_assessments', function (Blueprint $table) {
            $table->dropColumn(['participants', 'key_aspects']);
        });
    }
};
