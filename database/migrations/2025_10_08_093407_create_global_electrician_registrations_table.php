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
        Schema::create('global_electrician_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('email', 255)->nullable();
            $table->string('phone')->nullable();
            $table->string('state', 100)->nullable();
            $table->string('city')->nullable();
            $table->foreignId('country_id');
            $table->foreignId('county_id');
            $table->foreignId('parish_id');
            $table->foreignId('zip_code_id');
            $table->text('message')->nullable();
            $table->string('licence_number', 100)->nullable();
            $table->string('licence_agency_url', 255)->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('global_electrician_registrations');
    }
};
