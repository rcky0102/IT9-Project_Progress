@extends('patient.layout')

@section('title', 'Appointment Details | Medical Clinic')

@section('content')

            <!-- Main Content -->
            <main class="main-content">

                @if(session('success'))
                    <div id="flash-message" class="flash-message">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const flash = document.getElementById('flash-message');
                        if (flash) {
                            setTimeout(() => flash.remove(), 3500);
                        }
                    });
                </script>

                <!-- Welcome Card -->
                <div class="welcome-card">
                    <div class="flex-between">
                        <div class="flex-center">
                            <a href="{{ route('patient.appointments') }}" class="btn-icon-sm">
                                <i class="fas fa-arrow-left"></i>
                            </a>

                            {{-- <a href="{{ route('patient.appointments') }}" class="btn btn-outline">
                                <i class="fas fa-arrow-left"></i> Back to Payments
                            </a> --}}
                            <h1>Appointment Details</h1>
                        </div>
                        {{-- <a href="{{ route('patient.patient_crud.edit', $appointment->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                            Edit Appointment
                        </a> --}}
                    </div>
                    <p>View the details of your scheduled appointment.</p>
                </div>

                <div class="card">
                    <div class="p-6">
                        <div class="flex-between mb-6">
                            <div>
                                <h2 class="text-2xl font-bold text-primary mb-2">{{ $appointment->appointmentType->name ?? 'Unknown Type' }}</h2>
                                <div class="flex-center gap-2">
                                    <span class="appointment-badge badge-confirmed">Confirmed</span>
                                </div>
                            </div>
                            <div class="appointment-date">
                                <div class="appointment-date-day">{{ \Carbon\Carbon::parse($appointment->appointment_date)->day }}</div>
                                <div class="appointment-date-month">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M') }}</div>
                            </div>
                        </div>
                
                        <div class="details-grid">
                            <div>
                                <h3 class="text-lg font-semibold mb-4 text-primary">Appointment Information</h3>
                                <div class="details-list">
                                    <div class="detail-item">
                                        <i class="fas fa-calendar-alt text-primary"></i>
                                        <div>
                                            <p class="font-medium">Date & Time</p>
                                            <p class="text-light">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') }} at {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</p>
                                        </div>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fas fa-user-md text-primary"></i>
                                        <div>
                                            <p class="font-medium">Healthcare Provider</p>
                                            <p class="text-light">
                                                {{ $appointment->doctor && $appointment->doctor->user 
                                                    ? $appointment->doctor->user->first_name . ' ' . $appointment->doctor->user->middle_name . ' ' . $appointment->doctor->user->last_name 
                                                    : 'Not Assigned' }}
                                            </p>
                                        </div>
                                    </div>
                                    {{-- <div class="detail-item">
                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                        <div>
                                            <p class="font-medium">Location</p>
                                            <p class="text-light">MediCare Clinic</p>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                
                            <div>
                                <h3 class="text-lg font-semibold mb-4 text-primary">Additional Information</h3>
                                <div class="details-list">
                                    <div class="detail-block">
                                        <p class="font-medium">Reason for Visit</p>
                                        <p class="text-light">{{ $appointment->reason }}</p>
                                    </div>
                                    <div class="detail-block">
                                        <p class="font-medium">Additional Notes</p>
                                        <p class="text-light">{{ $appointment->notes }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                        {{-- <div class="mt-8 flex gap-4">
                            <button class="btn btn-outline">
                                <i class="fas fa-calendar-plus"></i>
                                Add to Calendar
                            </button>
                        </div> --}}
                    </div>
                </div>
                
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dropdown functionality
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle, .avatar-btn');
            
            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const dropdown = this.closest('.dropdown');
                    const menu = dropdown.querySelector('.dropdown-menu');
                    menu.classList.toggle('show');
                    
                    // Close other dropdowns
                    document.querySelectorAll('.dropdown-menu.show').forEach(openMenu => {
                        if (openMenu !== menu) {
                            openMenu.classList.remove('show');
                        }
                    });
                });
            });
            
            // Close dropdowns when clicking outside
            document.addEventListener('click', function() {
                document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                    menu.classList.remove('show');
                });
            });
        });
    </script>

@endsection
