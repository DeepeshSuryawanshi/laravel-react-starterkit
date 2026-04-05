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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');                 // India
            $table->string('iso2', 2)->unique();    // IN
            $table->string('iso3', 3)->nullable();  // IND
            $table->string('phone_code')->nullable(); // +91
            $table->string('currency')->nullable(); // INR
            $table->boolean('status')->default(true); // active/inactive
            $table->timestamps();
            $table->softDeletesTz(); // For soft deletes with timezone support
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
