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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('username')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->text('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('profile')->nullable();
            $table->enum('gender', ['male', 'female', 'custom']);
            $table->enum('relationship', ['single', 'relationship', 'married', 'engage']);
            $table->string('partner')->nullable();
            $table->string('school')->nullable();
            $table->string('college')->nullable();
            $table->string('university')->nullable();
            $table->string('work')->nullable();
            $table->string('website')->nullable();
            $table->string('location')->nullable();
            $table->string('address')->nullable();
            $table->boolean('is_private')->default(0);
            $table->boolean('is_banned')->default(0);
            $table->timestamp('expiration_date')->nullable();
            $table->timestamp('banned_at')->nullable();
            $table->timestamp('banned_to')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
