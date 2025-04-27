<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyDoctorsTableSpecialization extends Migration
{
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            // Drop the old specialization column
            $table->dropColumn('specialization');

            // Add specialization_id column after user_id
            $table->unsignedBigInteger('specialization_id')->after('user_id')->nullable();

            // Add foreign key constraint for specialization_id
            $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('doctors', function (Blueprint $table) {
            // Rollback changes
            $table->dropForeign(['specialization_id']);
            $table->dropColumn('specialization_id');
            
            // Optionally, add back the specialization column
            $table->string('specialization')->nullable();
        });
    }
}

