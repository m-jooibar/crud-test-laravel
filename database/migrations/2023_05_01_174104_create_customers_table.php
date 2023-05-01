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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->char('Firstname', 250)->nullable();
            $table->char('Lastname', 250)->nullable();
            $table->dateTime('DateOfBirth')->nullable();
            $table->char('PhoneNumber', 12)->nullable();
            $table->char('Email', 250)->nullable();
            $table->char('BankAccountNumber', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
