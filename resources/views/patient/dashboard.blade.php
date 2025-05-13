@extends('patient.layout')

@section('title', 'Patient Dashboard | Medical Clinic')

@section('content')

            <!-- Main Content -->
            <main class="main-content">
                <!-- Welcome Card -->
                <div class="welcome-card">
                    <h1>Welcome, {{ Auth::user()->first_name }}!</h1>
                    <p>This is your patient dashboard. Here you can manage your appointments, view your medical records, and more.</p>
                    <a href="{{route('patient.patient_crud.create')}}" class="btn btn-primary">
                        <i class="fas fa-calendar-plus"></i>
                        Schedule New Appointment
                    </a>
                </div>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <!-- Upcoming Appointments -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Upcoming Appointments</h3>
                            <div class="card-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">{{ $upcomingAppointmentsCount }}</div>
                            <div class="card-label">Scheduled appointments</div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('patient.appointments') }}" class="card-link">
                                View All <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Medical Records -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Medical Records</h3>
                            <div class="card-icon">
                                <i class="fas fa-file-medical"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">{{ $medicalRecordsCount }}</div>
                            <div class="card-label">Total records</div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('patient.medical-records') }}" class="card-link">
                                View All <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Payments -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Payments</h3>
                            <div class="card-icon">
                                <i class="fas fa-credit-card"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">₱{{ number_format($outstandingBalance, 2) }}</div>
                            <div class="card-label">Outstanding balance</div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('patient.payments') }}" class="card-link">
                                View Details <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>




                <!-- Appointments Tabs -->
                {{-- <div class="tabs">
                    <div class="tab-header">
                        <div class="tabs-list">
                            <button class="tab-trigger active" data-tab="list-view">List View</button>
                            <button class="tab-trigger" data-tab="calendar-view">Calendar View</button>
                        </div>
                        <button class="btn btn-outline">
                            <i class="fas fa-filter"></i>
                            Filter
                        </button>
                    </div> --}}

                    <!-- List View Tab -->
                    <div id="list-view" class="tab-content active">
                        <div class="appointments-list">

                            @foreach ($appointments as $appointment)
                            @php
                                $day = \Carbon\Carbon::parse($appointment->appointment_date)->format('d');
                                $month = \Carbon\Carbon::parse($appointment->appointment_date)->format('M');
                                $time = \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A');
                            @endphp
                        
                            <div class="appointment-item">
                                <div class="appointment-date">
                                    <div class="appointment-date-day">{{ $day }}</div>
                                    <div class="appointment-date-month">{{ $month }}</div>
                                </div>
                                <div class="appointment-details">
                                    <div class="appointment-title-wrapper">
                                        <div class="appointment-title">
                                            {{ ucfirst(str_replace('-', ' ', optional($appointment->appointmentType)->name ?? 'Unknown Type')) }}
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
                                    <div class="appointment-info">
                                        <span>
                                            <i class="fas fa-clock"></i>
                                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                            @if($appointment->appointment_end_time)
                                                - {{ \Carbon\Carbon::parse($appointment->appointment_end_time)->format('h:i A') }}
                                            @else
                                                - (doctor will set once confirmed)
                                            @endif
                                        </span>


                                        <span><i class="fas fa-user-md"></i> {{ $doctorNames[$appointment->doctor_id] ?? 'Unknown Doctor' }}</span>
                                    </div>
                                </div>
                                <div class="appointment-actions">
                                    <div class="dropdown">
                                        <button class="btn-ghost btn-icon-sm dropdown-toggle">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="{{ route('patient.patient_crud.show', $appointment->id) }}" class="dropdown-item">
                                                <i class="fas fa-eye"></i> View Details
                                            </a>
                                            {{-- <a href="{{ url('edit-appointment?id=' . $appointment->id) }}" class="dropdown-item">
                                                <i class="fas fa-calendar-alt"></i> Reschedule
                                            </a> --}}
                                            <a href="#" class="dropdown-item text-danger"
                                                onclick="event.preventDefault(); 
                                                    if (confirm('Are you sure you want to cancel this appointment?')) {
                                                        document.getElementById('cancel-appointment-form-{{ $appointment->id }}').submit();
                                                    }">
                                                <i class="fas fa-times-circle"></i> Cancel Appointment
                                            </a>
                                            <form id="cancel-appointment-form-{{ $appointment->id }}" 
                                                action="{{ route('appointments.cancel', $appointment->id) }}" 
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('PATCH')
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                <!-- Recent Medical Records -->
                <div class="medical-records">
                    <div class="records-header">
                        <h3 class="records-title">Recent Medical Records</h3>
                        <a href="#" class="btn btn-outline">View All Records</a>
                    </div>

                    <div class="records-tabs">
                        <div class="records-tab active">All</div>
                        <div class="records-tab">Consultations</div>
                        <div class="records-tab">Lab Results</div>
                        <div class="records-tab">Prescriptions</div>
                    </div>

                    <div class="records-list">
                        <div class="record-item">
                            <div class="record-header">
                                <div class="record-title">General Checkup</div>
                                <div class="record-date">Mar 15, 2025</div>
                            </div>
                            <div class="record-content">
                                <p>Regular health checkup. Blood pressure normal. Recommended annual screening tests based on age and risk factors.</p>
                            </div>
                            <div class="record-footer">
                                <div class="record-doctor">
                                    <div class="doctor-avatar">SJ</div>
                                    <div class="doctor-name">Dr. Sarah Johnson</div>
                                </div>
                                <a href="#" class="card-link">View <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>

                        <div class="record-item">
                            <div class="record-header">
                                <div class="record-title">Blood Test Results</div>
                                <div class="record-date">Feb 28, 2025</div>
                            </div>
                            <div class="record-content">
                                <p>Complete blood count and metabolic panel. All results within normal range. No significant findings.</p>
                            </div>
                            <div class="record-footer">
                                <div class="record-doctor">
                                    <div class="doctor-avatar">MC</div>
                                    <div class="doctor-name">Dr. Michael Chen</div>
                                </div>
                                <a href="#" class="card-link">View <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

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
                            otherMenu.classList.remove('show');
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

            // Tab functionality
            const tabs = document.querySelectorAll('.records-tab');
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>

@endsection
