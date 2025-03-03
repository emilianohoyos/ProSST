<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('document_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('person_type_id')->constrained()->onDelete('cascade');
            $table->string('country');
            $table->string('department');
            $table->string('city');
            $table->string('address');
            $table->rememberToken();
            $table->timestamps();
        });
        // User::create(['name' => 'Admin', 'email' => 'admin@themesbrand.com', 'password' => Hash::make('12345678'), 'email_verified_at' => now(), 'created_at' => now(),]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['document_type_id']);
            $table->dropForeign(['person_type_id']);
        });
        Schema::dropIfExists('users');
    }
};
