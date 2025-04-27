<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecializationsTable extends Migration
{
    public function up()
    {
        Schema::create('specializations', function (Blueprint $table) {
            $table->id();
            $table->string('specialization_name');
            $table->foreignId('department_id')->constrained('departments')->onDelete('cascade');
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('specializations');
    }
}
