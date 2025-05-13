@extends('doctor.layout')

@section('title', 'Appointments Details | Medical Clinic')

@section('content')


 <!-- Main Content -->
            <main class="main-content">
                <div class="page-header-with-actions">
                    <div>
                        <h1>Appointment Details</h1>
                        <p class="text-muted">View and manage appointment information</p>
                    </div>
                    <div class="header-buttons">
                        {{-- <button class="btn btn-outline">
                            <i class="fas fa-print"></i>
                            Print Details
                        </button> --}}
                        <a href="{{ route('doctor.appointment-edit', $appointment->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                            Edit Appointment
                        </a>
                    </div>
                </div>

                <!-- Appointment Status Banner -->
                <div class="card" style="border-left: 4px solid var(--primary); margin-bottom: 20px;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <h3 style="color: var(--primary); margin-bottom: 5px;">Scheduled Appointment</h3>
                            <p class="text-muted">Please arrive 15 minutes before your scheduled time</p>
                        </div>
                        @php
                                $status = strtolower($appointment->status); 
                                $badgeClass = match ($status) {
                                    'confirmed' => 'badge-confirmed',
                                    'completed' => 'badge-completed',
                                    'cancelled' => 'badge-cancelled',
                                    default => 'badge-pending',
                                };
                            @endphp

                            <span class="appointment-badge {{ $badgeClass }}">
                                {{ ucfirst($status) }}
                            </span>
                    </div>
                </div>

                <!-- Appointment Details -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Appointment Information</h3>
                    </div>
                    <div class="record-details">
                        <div class="record-info-grid">
                            <div class="record-info-item">
                                <div class="record-info-label">Patient Name</div>
                                <div class="record-info-value">{{ $appointment->patient->full_name }}</div>
                            </div>
                            <div class="record-info-item">
                                <div class="record-info-label">Appointment Type</div>
                                <div class="record-info-value">{{ $appointment->appointmentType->name }}</div>
                            </div>
                            <div class="record-info-item">
                                <div class="record-info-label">Date</div>
                                <div class="record-info-value">{{ \Carbon\Carbon::parse($appointment->date)->format('F d, Y') }}</div>
                            </div>
                            <div class="record-info-item">
                                <div class="record-info-label">Time</div>
                                <div class="record-info-value">{{ $appointment->appointment_time }} - {{ $appointment->appointment_end_time }}</div>
                            </div>
                            <div class="record-info-item">
                                <div class="record-info-label">Doctor</div>
                                <div class="record-info-value">{{ $appointment->doctor->full_name }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Patient Information -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Patient Information</h3>
                        {{-- <a href="#" class="card-link">
                            View Full Profile <i class="fas fa-arrow-right"></i>
                        </a> --}}
                    </div>
                    <div class="record-details">
                        <div class="patient-cell" style="margin-bottom: 20px;">
                            <div class="patient-avatar">
                                {{ strtoupper(substr($appointment->patient->first_name, 0, 1) . substr($appointment->patient->last_name, 0, 1)) }}
                            </div>
                            <div>
                                <div style="font-weight: bold; font-size: 16px;">{{ $appointment->patient->full_name }}</div>
                            </div>
                        </div>
                        <div class="record-info-grid">
                            <div class="record-info-item">
                                <div class="record-info-label">Date of Birth</div>
                                <div class="record-info-value">{{ \Carbon\Carbon::parse($appointment->patient->birthdate)->format('F d, Y') }}</div>
                            </div>
                            <div class="record-info-item">
                                <div class="record-info-label">Age</div>
                                <div class="record-info-value">{{ \Carbon\Carbon::parse($appointment->patient->birthdate)->age }} years</div>
                            </div>
                            <div class="record-info-item">
                                <div class="record-info-label">Gender</div>
                                <div class="record-info-value">{{ $appointment->patient->gender }}</div>
                            </div>
                            <div class="record-info-item">
                                <div class="record-info-label">Phone</div>
                                <div class="record-info-value">{{ $appointment->patient->contact_number }}</div>
                            </div>
                            <div class="record-info-item">
                                <div class="record-info-label">Email</div>
                                <div class="record-info-value">{{ $appointment->patient->user->email }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Appointment Reason & Notes -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Reason & Notes</h3>
                    </div>
                    <div class="record-details">
                        <div class="record-section">
                            <div class="record-section-title">Reason for Visit</div>
                            <div class="record-notes">
                                <p>{{ $appointment->reason }}</p>
                            </div>
                        </div>
                        <div class="record-section">
                            <div class="record-section-title">Patient Notes</div>
                            <div class="record-notes">
                                <p>{{ $appointment->notes }}</p>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- <!-- Medical History -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Medical History</h3>
                    </div>
                    <div class="record-details">
                        <div class="record-section">
                            <div class="record-section-title">Conditions</div>
                            <div class="record-notes">
                                <ul>
                                    <li>Hypertension (diagnosed 2020)</li>
                                    <li>Type 2 Diabetes (diagnosed 2018)</li>
                                    <li>Hypercholesterolemia</li>
                                </ul>
                            </div>
                        </div>
                        <div class="record-section">
                            <div class="record-section-title">Current Medications</div>
                            <div class="record-notes">
                                <ul>
                                    <li>Lisinopril 10mg - once daily</li>
                                    <li>Metformin 500mg - twice daily</li>
                                    <li>Atorvastatin 20mg - once daily at bedtime</li>
                                </ul>
                            </div>
                        </div>
                        <div class="record-section">
                            <div class="record-section-title">Allergies</div>
                            <div class="record-notes">
                                <ul>
                                    <li>Penicillin - Severe rash</li>
                                    <li>Sulfa drugs - Difficulty breathing</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Previous Appointments -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Previous Appointments</h3>
                    </div>
                    <div class="table-container">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Provider</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>April 15, 2025</td>
                                    <td>Medication Review</td>
                                    <td>Dr. Sarah Johnson</td>
                                    <td><span class="badge-completed">Completed</span></td>
                                    <td>
                                        <div class="row-actions">
                                            <button class="btn-icon"><i class="fas fa-eye"></i></button>
                                            <button class="btn-icon"><i class="fas fa-file-medical"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>March 10, 2025</td>
                                    <td>Blood Work</td>
                                    <td>Dr. Michael Chen</td>
                                    <td><span class="badge-completed">Completed</span></td>
                                    <td>
                                        <div class="row-actions">
                                            <button class="btn-icon"><i class="fas fa-eye"></i></button>
                                            <button class="btn-icon"><i class="fas fa-file-medical"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>February 5, 2025</td>
                                    <td>Annual Physical</td>
                                    <td>Dr. Sarah Johnson</td>
                                    <td><span class="badge-completed">Completed</span></td>
                                    <td>
                                        <div class="row-actions">
                                            <button class="btn-icon"><i class="fas fa-eye"></i></button>
                                            <button class="btn-icon"><i class="fas fa-file-medical"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> --}}

                <!-- Action Buttons -->
                {{-- <div style="display: flex; justify-content: flex-end; gap: 15px; margin-top: 30px; margin-bottom: 30px;">
                    <button class="btn btn-outline">
                        <i class="fas fa-times"></i>
                        Cancel Appointment
                    </button>
                    <button class="btn btn-outline">
                        <i class="fas fa-calendar"></i>
                        Reschedule
                    </button>
                    <button class="btn btn-outline">
                        <i class="fas fa-envelope"></i>
                        Send Reminder
                    </button>
                    <button class="btn btn-primary">
                        <i class="fas fa-check"></i>
                        Check In Patient
                    </button>
                </div> --}}
            </main>

    <script>
        // Dropdown functionality
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownBtns = document.querySelectorAll('.dropdown .btn-icon, .dropdown .avatar-btn');
            
            dropdownBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const menu = this.nextElementSibling;
                    menu.classList.toggle('show');
                    
                    // Close other dropdowns
                    dropdownBtns.forEach(otherBtn => {
                        if (otherBtn !== btn) {
                            const otherMenu = otherBtn.nextElementSibling;
                            if (otherMenu) {
                                otherMenu.classList.remove('show');
                            }
                        }
                    });
                });
            });
            
            // Close dropdowns when clicking outside
            window.addEventListener('click', function() {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.classList.remove('show');
                });
            });
        });
    </script>

@endsection