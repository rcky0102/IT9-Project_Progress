<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChargeToAppointmentTypesTable extends Migration
{

    public function up(): void
    {
        Schema::table('appointment_types', function (Blueprint $table) {
            $table->decimal('charge', 8, 2)->after('name')->default(0.00);
        });
    }


    public function down(): void
    {
        Schema::table('appointment_types', function (Blueprint $table) {
            $table->dropColumn('charge');
        });
    }
}
