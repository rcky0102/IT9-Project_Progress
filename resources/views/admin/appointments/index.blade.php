@extends('admin.layout')

@section('title', 'Appointmens | Medical Clinic')

@section('content')

            <!-- Main Content -->
            <main class="main-content">
                <!-- Welcome Card -->
                <div class="welcome-card">
                    <h1>Appointments</h1>
                    <p>Manage your upcoming appointments and schedule new ones.</p>
                    {{-- <a href="{{route('patient.patient_crud.create')}}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Schedule New Appointment
                    </a> --}}
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
                                        <span><i class="fas fa-user"></i> {{ $appointment->patient->full_name ?? 'Unknown Patient' }}</span>
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
                        
                        

                    {{-- <!-- Calendar View Tab -->
                    <div id="calendar-view" class="tab-content">
                        <div class="calendar-container">
                            <div class="calendar">
                                <div class="calendar-header">
                                    <h3 class="calendar-title">March 2025</h3>
                                    <div class="calendar-nav">
                                        <button class="calendar-nav-btn">
                                            <i class="fas fa-chevron-left"></i>
                                        </button>
                                        <button class="calendar-nav-btn">
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="calendar-grid">
                                    <!-- Weekdays -->
                                    <div class="calendar-weekday">Sun</div>
                                    <div class="calendar-weekday">Mon</div>
                                    <div class="calendar-weekday">Tue</div>
                                    <div class="calendar-weekday">Wed</div>
                                    <div class="calendar-weekday">Thu</div>
                                    <div class="calendar-weekday">Fri</div>
                                    <div class="calendar-weekday">Sat</div>
                                    
                                    <!-- Days from previous month -->
                                    <div class="calendar-day other-month">23</div>
                                    <div class="calendar-day other-month">24</div>
                                    <div class="calendar-day other-month">25</div>
                                    <div class="calendar-day other-month">26</div>
                                    <div class="calendar-day other-month">27</div>
                                    <div class="calendar-day other-month">28</div>
                                    <div class="calendar-day">1</div>
                                    
                                    <!-- Days in current month -->
                                    <div class="calendar-day">2</div>
                                    <div class="calendar-day">3</div>
                                    <div class="calendar-day">4</div>
                                    <div class="calendar-day">5</div>
                                    <div class="calendar-day">6</div>
                                    <div class="calendar-day">7</div>
                                    <div class="calendar-day">8</div>
                                    
                                    <div class="calendar-day">9</div>
                                    <div class="calendar-day">10</div>
                                    <div class="calendar-day">11</div>
                                    <div class="calendar-day">12</div>
                                    <div class="calendar-day">13</div>
                                    <div class="calendar-day">14</div>
                                    <div class="calendar-day">15</div>
                                    
                                    <div class="calendar-day">16</div>
                                    <div class="calendar-day">17</div>
                                    <div class="calendar-day">18</div>
                                    <div class="calendar-day">19</div>
                                    <div class="calendar-day">20</div>
                                    <div class="calendar-day today">21</div>
                                    <div class="calendar-day">22</div>
                                    
                                    <div class="calendar-day">23</div>
                                    <div class="calendar-day has-appointment selected">24</div>
                                    <div class="calendar-day">25</div>
                                    <div class="calendar-day">26</div>
                                    <div class="calendar-day">27</div>
                                    <div class="calendar-day">28</div>
                                    <div class="calendar-day">29</div>
                                    
                                    <div class="calendar-day has-appointment">30</div>
                                    <div class="calendar-day">31</div>
                                    <div class="calendar-day other-month">1</div>
                                    <div class="calendar-day other-month">2</div>
                                    <div class="calendar-day other-month">3</div>
                                    <div class="calendar-day other-month">4</div>
                                    <div class="calendar-day other-month has-appointment">5</div>
                                </div>
                            </div>
                            
                            <div class="day-appointments">
                                <h3 class="day-appointments-title">Appointments on March 24, 2025</h3>
                                <div class="day-appointment-item">
                                    <div class="day-appointment-title">General Checkup</div>
                                    <div class="day-appointment-info">10:00 AM - Dr. Sarah Johnson</div>
                                </div>
                                
                                <!-- No appointments message (hidden by default) -->
                                <div class="no-appointments" style="display: none;">
                                    No appointments scheduled for this day
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </main>
        </div>
    </div>

    <script>
        // Dropdown functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Dropdown toggle
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

            // Tab functionality
            const tabTriggers = document.querySelectorAll('.tab-trigger');
            const tabContents = document.querySelectorAll('.tab-content');
            
            tabTriggers.forEach(trigger => {
                trigger.addEventListener('click', function() {
                    // Remove active class from all triggers and contents
                    tabTriggers.forEach(t => t.classList.remove('active'));
                    tabContents.forEach(c => c.classList.remove('active'));
                    
                    // Add active class to clicked trigger
                    this.classList.add('active');
                    
                    // Show corresponding content
                    const tabId = this.getAttribute('data-tab');
                    document.getElementById(tabId).classList.add('active');
                });
            });

            // Calendar day selection
            const calendarDays = document.querySelectorAll('.calendar-day');
            
            calendarDays.forEach(day => {
                day.addEventListener('click', function() {
                    // Remove selected class from all days
                    calendarDays.forEach(d => d.classList.remove('selected'));
                    
                    // Add selected class to clicked day
                    this.classList.add('selected');
                    
                    // Update appointments display
                    const dayNumber = this.textContent;
                    const appointmentsTitle = document.querySelector('.day-appointments-title');
                    const noAppointments = document.querySelector('.no-appointments');
                    const appointmentItems = document.querySelectorAll('.day-appointment-item');
                    
                    // Update title
                    appointmentsTitle.textContent = `Appointments on March ${dayNumber}, 2025`;
                    
                    // Show/hide appointments based on day
                    if (dayNumber === '24') {
                        noAppointments.style.display = 'none';
                        appointmentItems.forEach(item => {
                            item.style.display = 'block';
                            item.querySelector('.day-appointment-title').textContent = 'General Checkup';
                            item.querySelector('.day-appointment-info').textContent = '10:00 AM - Dr. Sarah Johnson';
                        });
                    } else if (dayNumber === '30') {
                        noAppointments.style.display = 'none';
                        appointmentItems.forEach(item => {
                            item.style.display = 'block';
                            item.querySelector('.day-appointment-title').textContent = 'Follow-up Consultation';
                            item.querySelector('.day-appointment-info').textContent = '2:30 PM - Dr. Michael Chen';
                        });
                    } else if (dayNumber === '5') {
                        noAppointments.style.display = 'none';
                        appointmentItems.forEach(item => {
                            item.style.display = 'block';
                            item.querySelector('.day-appointment-title').textContent = 'Dental Cleaning';
                            item.querySelector('.day-appointment-info').textContent = '9:15 AM - Dr. Emily Rodriguez';
                        });
                    } else {
                        noAppointments.style.display = 'block';
                        appointmentItems.forEach(item => {
                            item.style.display = 'none';
                        });
                    }
                });
            });
        });
    </script>

@endsection
