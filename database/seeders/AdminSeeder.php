<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // First check if admin already exists to avoid duplicates
        if (!User::where('email', 'admin@medicare.com')->exists()) {
            User::create([
                'first_name' => 'Admin',
                'middle_name' => '',
                'last_name' => 'User',
                'email' => 'admin@medicare.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]);

            $this->command->info('Admin user created successfully.');
        } else {
            $this->command->info('Admin user already exists.');
        }
    }
}
