<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChargeToRecordTypesTable extends Migration
{
    public function up(): void
    {
        Schema::table('record_types', function (Blueprint $table) {
            $table->decimal('charge', 10, 2)->default(0)->after('name');
        });
    }

    public function down(): void
    {
        Schema::table('record_types', function (Blueprint $table) {
            $table->dropColumn('charge');
        });
    }
}
