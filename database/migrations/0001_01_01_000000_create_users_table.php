<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // name
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            // email
            $table->string('email')->unique();
            // mobile
            $table->string('mobile')->nullable()->unique();
            $table->string('base_mobile')->nullable();
            $table->string('dial_code',6)->nullable();
            $table->string('country_code')->nullable();
            $table->foreignId('country_id')->nullable()->index();
            $table->foreign('country_id')->references('id')->on('countries')->nullOnDelete();
            // verification timestamps
            $table->timestamp('mobile_verified_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            // password
            $table->string('password');
            // otp for verification
            $table->string('otp',6)->nullable();
            $table->timestamp('otp_verifed_at')->nullable();
            $table->timestamp('otp_expires_at')->nullable();
            // active/inactive status
            $table->boolean('is_active')->default(true);
            // two factor authentication
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletesTz(); // For soft deletes with timezone support
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('mobile')->nullable();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
