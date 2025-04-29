<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->unsignedBigInteger('appointment_type_id')->nullable()->after('user_id');
            $table->unsignedBigInteger('doctor_id')->nullable()->after('appointment_type_id');
    
            $table->foreign('appointment_type_id')->references('id')->on('appointment_types')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
        });
    }
    
    
    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['appointment_type_id']);
            $table->dropForeign(['doctor_id']);
            $table->dropColumn(['appointment_type_id', 'doctor_id']);
        });
    }
    
};
