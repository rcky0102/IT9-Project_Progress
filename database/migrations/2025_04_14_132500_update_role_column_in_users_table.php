<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, check if the column exists
        if (Schema::hasColumn('users', 'role')) {
            // Get the current column type
            $columnType = DB::getSchemaBuilder()->getColumnType('users', 'role');
            
            // If it's not an enum, modify it
            if ($columnType !== 'enum') {
                // Create a backup of existing data
                $users = DB::table('users')->select('id', 'role')->get();
                
                // Drop the existing column
                Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn('role');
                });
                
                // Add the new enum column
                Schema::table('users', function (Blueprint $table) {
                    $table->enum('role', ['admin', 'patient', 'doctor'])->default('patient');
                });
                
                // Restore data with appropriate mapping
                foreach ($users as $user) {
                    $role = 'patient'; // Default
                    
                    // Map existing values to new enum values
                    if (!empty($user->role)) {
                        if (strtolower($user->role) === 'admin') {
                            $role = 'admin';
                        } elseif (strtolower($user->role) === 'doctor') {
                            $role = 'doctor';
                        }
                    }
                    
                    DB::table('users')
                        ->where('id', $user->id)
                        ->update(['role' => $role]);
                }
            }
        } else {
            // If the column doesn't exist, add it
            Schema::table('users', function (Blueprint $table) {
                $table->enum('role', ['admin', 'patient', 'doctor'])->default('patient');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to revert as we're just ensuring the column is of the right type
    }
};