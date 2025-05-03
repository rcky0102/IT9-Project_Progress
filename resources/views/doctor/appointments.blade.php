<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments | Medical Clinic</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/doctor.css') }}">
</head>
<body>
    <div class="app-container">
        <!-- Header -->
        <header class="dashboard-header">
            <a href="index.html" class="logo">MediCare Clinic</a>
            <div class="header-actions">
                <button class="btn-icon notification-btn">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </button>
                <div class="dropdown">
                    <button class="avatar-btn">
                        <div class="avatar">
                            <span class="avatar-fallback">DR</span>
                        </div>
                    </button>
                    <div class="dropdown-menu">
                        <div class="dropdown-header">
                            <p class="user-name">Dr. John Smith</p>
                            <p class="user-email">john.smith@example.com</p>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item"><i class="fas fa-user"></i> Profile</a>
                        <a href="#" class="dropdown-item"><i class="fas fa-cog"></i> Settings</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <div class="main-container">
            <!-- Sidebar -->
            <aside class="sidebar">
                <nav class="sidebar-nav">
                    <a href="index.html" class="sidebar-item">
                        <i class="fas fa-chart-line"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="appointments.html" class="sidebar-item active">
                        <i class="fas fa-calendar"></i>
                        <span>Appointments</span>
                    </a>
                    <a href="patients.html" class="sidebar-item">
                        <i class="fas fa-user"></i>
                        <span>Patients</span>
                    </a>
                    <a href="medical-records.html" class="sidebar-item">
                        <i class="fas fa-file-medical"></i>
                        <span>Medical Records</span>
                    </a>
                    <a href="prescriptions.html" class="sidebar-item">
                        <i class="fas fa-pills"></i>
                        <span>Prescriptions</span>
                    </a>
                    <a href="schedule.html" class="sidebar-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Schedule</span>
                    </a>
                </nav>
            </aside>

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
                <div class="filters-container">
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
                </div>

                <!-- Calendar View -->
                <div class="card">
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
                </div>

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

                    

                    <div class="appointment-item">
                        <div class="appointment-date">
                            <div class="appointment-date-day">26</div>
                            <div class="appointment-date-month">MAY</div>
                        </div>
                        <div class="appointment-details">
                            <div class="appointment-title">James Brown - Follow-up Consultation</div>
                            <div class="appointment-info">
                                <span><i class="fas fa-clock"></i> 11:00 AM - 11:30 AM</span>
                                <span><i class="fas fa-phone"></i> +1 (555) 234-5678</span>
                                <span><i class="fas fa-tag"></i> Follow-up</span>
                            </div>
                        </div>
                        <div class="appointment-status scheduled">
                            Scheduled
                        </div>
                        <div class="appointment-actions">
                            <button class="btn btn-outline">View Details</button>
                            <div class="dropdown">
                                <button class="btn-icon">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-edit"></i> Edit Appointment
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-check"></i> Mark as Completed
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-times"></i> Cancel Appointment
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-envelope"></i> Send Reminder
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="appointment-item">
                        <div class="appointment-date">
                            <div class="appointment-date-day">26</div>
                            <div class="appointment-date-month">MAY</div>
                        </div>
                        <div class="appointment-details">
                            <div class="appointment-title">Olivia Martinez - Blood Pressure Check</div>
                            <div class="appointment-info">
                                <span><i class="fas fa-clock"></i> 2:00 PM - 2:30 PM</span>
                                <span><i class="fas fa-phone"></i> +1 (555) 345-6789</span>
                                <span><i class="fas fa-tag"></i> Routine</span>
                            </div>
                        </div>
                        <div class="appointment-status scheduled">
                            Scheduled
                        </div>
                        <div class="appointment-actions">
                            <button class="btn btn-outline">View Details</button>
                            <div class="dropdown">
                                <button class="btn-icon">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-edit"></i> Edit Appointment
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-check"></i> Mark as Completed
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-times"></i> Cancel Appointment
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-envelope"></i> Send Reminder
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Past Appointments -->
                <h3 class="section-title">Past Appointments</h3>
                <div class="appointments-list">
                    <div class="appointment-item">
                        <div class="appointment-date">
                            <div class="appointment-date-day">20</div>
                            <div class="appointment-date-month">MAY</div>
                        </div>
                        <div class="appointment-details">
                            <div class="appointment-title">Robert Johnson - Annual Physical</div>
                            <div class="appointment-info">
                                <span><i class="fas fa-clock"></i> 9:00 AM - 10:00 AM</span>
                                <span><i class="fas fa-phone"></i> +1 (555) 456-7890</span>
                                <span><i class="fas fa-tag"></i> Annual</span>
                            </div>
                        </div>
                        <div class="appointment-status completed">
                            Completed
                        </div>
                        <div class="appointment-actions">
                            <button class="btn btn-outline">View Details</button>
                            <div class="dropdown">
                                <button class="btn-icon">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-file-medical"></i> View Medical Record
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-calendar-plus"></i> Schedule Follow-up
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-envelope"></i> Send Summary
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="appointment-item">
                        <div class="appointment-date">
                            <div class="appointment-date-day">15</div>
                            <div class="appointment-date-month">MAY</div>
                        </div>
                        <div class="appointment-details">
                            <div class="appointment-title">Sophia Garcia - Vaccination</div>
                            <div class="appointment-info">
                                <span><i class="fas fa-clock"></i> 3:00 PM - 3:15 PM</span>
                                <span><i class="fas fa-phone"></i> +1 (555) 567-8901</span>
                                <span><i class="fas fa-tag"></i> Vaccination</span>
                            </div>
                        </div>
                        <div class="appointment-status cancelled">
                            Cancelled
                        </div>
                        <div class="appointment-actions">
                            <button class="btn btn-outline">View Details</button>
                            <div class="dropdown">
                                <button class="btn-icon">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-calendar-plus"></i> Reschedule
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-envelope"></i> Contact Patient
                                    </a>
                                </div>
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
</body>
</html>