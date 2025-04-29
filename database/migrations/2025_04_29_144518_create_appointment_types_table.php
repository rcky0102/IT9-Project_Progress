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
        Schema::create('appointment_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., General Checkup, Vaccination, etc.
            $table->timestamps();
        });

        // Pivot table for many-to-many relationship
        Schema::create('appointment_type_specialization', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('specialization_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_type_specialization');
        Schema::dropIfExists('specializations');
        Schema::dropIfExists('appointment_types');
    }
};
