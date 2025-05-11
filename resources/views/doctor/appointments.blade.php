@extends('doctor.layout')

@section('title', 'Appointments | Medical Clinic')

@section('content')

            <!-- Main Content -->
            <main class="main-content">
                <div class="page-header-with-actions">
                    <div>
                        <h1>Appointments</h1>
                        <p class="text-muted">Manage your patient appointments</p>
                    </div>
                    <button class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        New Appointment
                    </button>
                </div>

                <!-- Filters -->
                <!-- <div class="filters-container">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search appointments...">
                    </div>
                    <select class="filter-select">
                        <option value="">All Status</option>
                        <option value="scheduled">Scheduled</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    <select class="filter-select">
                        <option value="">All Dates</option>
                        <option value="today">Today</option>
                        <option value="tomorrow">Tomorrow</option>
                        <option value="this-week">This Week</option>
                        <option value="next-week">Next Week</option>
                    </select>
                </div> -->

                <!-- Calendar View -->
                <!-- <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Calendar View</h3>
                        <div class="calendar-navigation">
                            <button class="btn-icon"><i class="fas fa-chevron-left"></i></button>
                            <span class="current-date">May 2025</span>
                            <button class="btn-icon"><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                    <div class="calendar-container">
                        <div class="calendar-header">
                            <div class="calendar-cell">Sun</div>
                            <div class="calendar-cell">Mon</div>
                            <div class="calendar-cell">Tue</div>
                            <div class="calendar-cell">Wed</div>
                            <div class="calendar-cell">Thu</div>
                            <div class="calendar-cell">Fri</div>
                            <div class="calendar-cell">Sat</div>
                        </div>
                        <div class="calendar-body">
                            <div class="calendar-cell disabled">28</div>
                            <div class="calendar-cell disabled">29</div>
                            <div class="calendar-cell disabled">30</div>
                            <div class="calendar-cell">1</div>
                            <div class="calendar-cell">2</div>
                            <div class="calendar-cell">3</div>
                            <div class="calendar-cell">4</div>
                            <div class="calendar-cell">5</div>
                            <div class="calendar-cell">6</div>
                            <div class="calendar-cell">7</div>
                            <div class="calendar-cell">8</div>
                            <div class="calendar-cell">9</div>
                            <div class="calendar-cell">10</div>
                            <div class="calendar-cell">11</div>
                            <div class="calendar-cell">12</div>
                            <div class="calendar-cell">13</div>
                            <div class="calendar-cell">14</div>
                            <div class="calendar-cell">15</div>
                            <div class="calendar-cell">16</div>
                            <div class="calendar-cell">17</div>
                            <div class="calendar-cell">18</div>
                            <div class="calendar-cell">19</div>
                            <div class="calendar-cell">20</div>
                            <div class="calendar-cell">21</div>
                            <div class="calendar-cell">22</div>
                            <div class="calendar-cell">23</div>
                            <div class="calendar-cell">24</div>
                            <div class="calendar-cell">25</div>
                            <div class="calendar-cell active">26
                                <div class="appointment-indicator">
                                    <span class="appointment-dot"></span>
                                    <span class="appointment-dot"></span>
                                    <span class="appointment-dot"></span>
                                </div>
                            </div>
                            <div class="calendar-cell">27</div>
                            <div class="calendar-cell">28</div>
                            <div class="calendar-cell">29</div>
                            <div class="calendar-cell">30</div>
                            <div class="calendar-cell">31</div>
                            <div class="calendar-cell disabled">1</div>
                        </div>
                    </div>
                </div> -->

                <!-- Upcoming Appointments -->
                <h3 class="section-title">Upcoming Appointments</h3>
                <div class="appointments-list">

                    @foreach($appointments as $appointment)
                        <div class="appointment-item">
                            <div class="appointment-date">
                                <div class="appointment-date-day">{{ \Carbon\Carbon::parse($appointment->appointment_date)->day }}</div>
                                <div class="appointment-date-month">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M') }}</div>
                            </div>

                            <div class="appointment-details">
                                <div class="appointment-title">
                                    {{ $appointment->patient->user->first_name }} {{ $appointment->patient->user->last_name }} - {{ $appointment->appointmentType->name }}
                                </div>
                                <div class="appointment-info">
                                    <span><i class="fas fa-clock"></i> {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</span>
                                    <span><i class="fas fa-phone"></i> {{ $appointment->patient->contact_number ?? 'N/A' }}</span>
                                    <span><i class="fas fa-tag"></i> {{ $appointment->reason }}</span>
                                </div>
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

                            <div class="appointment-actions">
                                <a href="#" class="btn btn-outline">View Details</a>
                                <div class="dropdown">
                                    <button class="btn-icon">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="#" class="dropdown-item">
                                            <i class="fas fa-edit"></i> Edit Appointment
                                        </a>
                                        <form action="#" method="POST">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="dropdown-item">
                                                <i class="fas fa-check"></i> Mark as Completed
                                            </button>
                                        </form>
                                        <form action="#" method="POST">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="dropdown-item">
                                                <i class="fas fa-times"></i> Cancel Appointment
                                            </button>
                                        </form>
                                        <a href="#" class="dropdown-item">
                                            <i class="fas fa-envelope"></i> Send Reminder
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    

                    
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