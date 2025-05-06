<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalRecordsTable extends Migration
{

    public function up(): void
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();

            $table->foreignId('appointment_id')->constrained()->onDelete('cascade');
            $table->foreignId('record_type_id')->constrained('record_types')->onDelete('restrict');

            $table->date('date');
            $table->string('diagnosis');

            $table->string('blood_pressure')->nullable();
            $table->string('temperature')->nullable();
            $table->string('heart_rate')->nullable();
            $table->string('respiratory_rate')->nullable();

            $table->text('notes');

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('records');
    }
}


