<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'first_name' => 'Admin',
            'middle_name' => null, // or provide a middle name if needed
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        
        // If you have a test user
        User::create([
            'first_name' => 'Test',
            'middle_name' => null, // or provide a middle name if needed
            'last_name' => 'User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'role' => 'patient',
        ]);
        
        $this->call([
            DoctorSeeder::class,
            AppointmentTypeSeeder::class,
        ]);
    }
}