<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateRoleColumnInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // First, check the current column type
        $columnType = DB::connection()->getDoctrineColumn('users', 'role')->getType()->getName();
        
        if ($columnType === 'string') {
            // If it's a string (VARCHAR), make sure it's long enough
            Schema::table('users', function (Blueprint $table) {
                $table->string('role', 50)->change();
            });
        } else {
            // If it's an ENUM, modify it to include 'admin'
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('patient', 'doctor', 'admin') NOT NULL");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revert to original state if needed
        // This depends on what the original state was
    }
}
