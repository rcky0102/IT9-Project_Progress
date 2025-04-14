<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CheckRoleColumnType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Get the column definition
        $columnDefinition = DB::select("SHOW COLUMNS FROM users WHERE Field = 'role'")[0];
        
        // Output the column type for debugging
        echo "Current role column type: " . $columnDefinition->Type . PHP_EOL;
        
        // If it's an ENUM without 'admin'
        if (strpos($columnDefinition->Type, 'enum') === 0 && strpos($columnDefinition->Type, 'admin') === false) {
            // Modify it to include 'admin'
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('patient', 'doctor', 'admin') NOT NULL");
            echo "Modified role column to include 'admin'" . PHP_EOL;
        }
        // If it's a VARCHAR that's too short
        else if (strpos($columnDefinition->Type, 'varchar') === 0) {
            $length = (int) filter_var($columnDefinition->Type, FILTER_SANITIZE_NUMBER_INT);
            if ($length < 10) {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('role', 50)->change();
                });
                echo "Modified role column to varchar(50)" . PHP_EOL;
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // No need to revert as this is just a check
    }
}
