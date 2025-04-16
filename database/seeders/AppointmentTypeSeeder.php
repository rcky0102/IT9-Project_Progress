<?php
// database/seeders/AppointmentTypeSeeder.php

namespace Database\Seeders;

use App\Models\AppointmentType;
use Illuminate\Database\Seeder;

class AppointmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $appointmentTypes = [
            [
                'name' => 'General Checkup',
                'description' => 'Regular health checkup to monitor overall health and wellness.',
                'duration' => 30,
                'price' => 100.00,
                'is_active' => true,
            ],
            [
                'name' => 'Follow-up Consultation',
                'description' => 'Follow-up visit to discuss test results, treatment progress, or ongoing care.',
                'duration' => 20,
                'price' => 75.00,
                'is_active' => true,
            ],
            [
                'name' => 'Dental Cleaning',
                'description' => 'Professional teeth cleaning and oral health assessment.',
                'duration' => 45,
                'price' => 120.00,
                'is_active' => true,
            ],
            [
                'name' => 'Vaccination',
                'description' => 'Administration of vaccines for preventive care.',
                'duration' => 15,
                'price' => 50.00,
                'is_active' => true,
            ],
            [
                'name' => 'Specialist Consultation',
                'description' => 'Consultation with a medical specialist for specific health concerns.',
                'duration' => 60,
                'price' => 150.00,
                'is_active' => true,
            ],
        ];

        foreach ($appointmentTypes as $typeData) {
            AppointmentType::create($typeData);
        }
    }
}