<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordTypesTable extends Migration
{

    public function up(): void
    {
        Schema::create('record_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('record_types');
    }
}

