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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('person_type_id')->constrained()->onDelete('cascade');
            $table->string('identification');
            $table->string('name');
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign(['document_type_id']);
            $table->dropForeign(['person_type_id']);
        });
        Schema::dropIfExists('clients');
    }
};
