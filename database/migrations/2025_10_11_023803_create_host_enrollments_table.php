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
        Schema::create('host_enrollments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->foreignId('annual_income_id')->nullable();
            $table->string('employee_number')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->foreignId('country_id');
            $table->foreignId('county_id');
            $table->foreignId('parish_id');
            $table->foreignId('zip_code_id');
            $table->text('message')->nullable();
            $table->string('licence_number')->nullable();
            $table->string('licence_agency_url')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Inactive');
            $table->json('answers_json')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('host_enrollments');
    }
};
