<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\DoctorSchedule;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = [
            [
                'first_name' => 'Sarah',
                'middle_name' => null,
                'last_name' => 'Johnson',
                'specialty' => 'General Medicine',
                'email' => 'sarah.johnson@example.com',
                'phone' => '555-123-4567',
                'bio' => 'Dr. Sarah Johnson is a board-certified physician with over 10 years of experience in general medicine.',
                'is_active' => true,
            ],
            [
                'first_name' => 'Michael',
                'middle_name' => null,
                'last_name' => 'Chen',
                'specialty' => 'Cardiology',
                'email' => 'michael.chen@example.com',
                'phone' => '555-234-5678',
                'bio' => 'Dr. Michael Chen is a cardiologist specializing in heart disease prevention and treatment.',
                'is_active' => true,
            ],
            [
                'first_name' => 'Emily',
                'middle_name' => null,
                'last_name' => 'Rodriguez',
                'specialty' => 'Dentistry',
                'email' => 'emily.rodriguez@example.com',
                'phone' => '555-345-6789',
                'bio' => 'Dr. Emily Rodriguez is a dentist with expertise in preventive care and cosmetic dentistry.',
                'is_active' => true,
            ],
            [
                'first_name' => 'David',
                'middle_name' => null,
                'last_name' => 'Wilson',
                'specialty' => 'Dermatology',
                'email' => 'david.wilson@example.com',
                'phone' => '555-456-7890',
                'bio' => 'Dr. David Wilson is a dermatologist specializing in skin conditions and cosmetic procedures.',
                'is_active' => true,
            ],
        ];

        foreach ($doctors as $doctorData) {
            // Create user account for doctor
            $user = User::create([
                'first_name' => $doctorData['first_name'],
                'middle_name' => $doctorData['middle_name'],
                'last_name' => $doctorData['last_name'],
                'email' => $doctorData['email'],
                'password' => Hash::make('password'),
                'role' => 'doctor',
            ]);
            
            // Create doctor profile
            $doctor = Doctor::create([
                'user_id' => $user->id,
                'first_name' => $doctorData['first_name'],
                'last_name' => $doctorData['last_name'],
                'specialty' => $doctorData['specialty'],
                'email' => $doctorData['email'],
                'phone' => $doctorData['phone'],
                'bio' => $doctorData['bio'],
                'is_active' => $doctorData['is_active'],
            ]);
            
            // Create schedules for each doctor
            $this->createScheduleForDoctor($doctor->id);
        }
    }

    /**
     * Create a schedule for a doctor.
     */
    private function createScheduleForDoctor(int $doctorId): void
    {
        $weekdays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
        
        foreach ($weekdays as $day) {
            DoctorSchedule::create([
                'doctor_id' => $doctorId,
                'day_of_week' => $day,
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
                'is_available' => true,
            ]);
        }
        
        // Add Saturday with shorter hours for some doctors
        if (in_array($doctorId, [1, 3])) {
            DoctorSchedule::create([
                'doctor_id' => $doctorId,
                'day_of_week' => 'saturday',
                'start_time' => '09:00:00',
                'end_time' => '13:00:00',
                'is_available' => true,
            ]);
        }
    }
}