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
        Schema::create('service_providers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('category_id');
            $table->json('subcategory_ids')->nullable();
            $table->foreignId('pricing_type_id')->nullable();
            $table->string('company_name');
            $table->string('registration_number')->nullable();
            $table->integer('year_of_establishment')->nullable();
            $table->integer('total_employees')->nullable();
            $table->string('phone', 20);
            $table->string('email')->nullable();
            $table->text('description')->nullable();
            $table->string('cover_photo')->nullable();
            $table->string('logo')->nullable();
            $table->integer('amount')->nullable();
            $table->foreignId('country_id');
            $table->foreignId('county_id');
            $table->foreignId('parish_id');
            $table->foreignId('zip_code_id');
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->string('upload_document')->nullable();
            $table->integer('experience_years')->nullable();
            $table->string('licence_number')->nullable();
            $table->string('licence_agency_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_providers');
    }
};
