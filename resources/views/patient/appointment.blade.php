<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments | Medical Clinic</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                    <button class="avatar-btn" id="avatarBtn">
                        <div class="avatar">
                            <img src="https://via.placeholder.com/40" alt="User">
                            <span class="avatar-fallback">JD</span>
                        </div>
                    </button>
                    <div class="dropdown-menu" id="userDropdown">
                        <div class="dropdown-header">
                            <p class="user-name">John Doe</p>
                            <p class="user-email">john.doe@example.com</p>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item"><i class="fas fa-user"></i> Profile</a>
                        <a href="#" class="dropdown-item"><i class="fas fa-cog"></i> Settings</a>
                        <div class="dropdown-divider"></div>
                        <form action="#" method="POST" class="dropdown-item text-danger">
                            <button type="submit" style="background: none; border: none; color: inherit; padding: 0; font: inherit; cursor: pointer; display: flex; align-items: center; gap: 10px; width: 100%; text-align: left;">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <div class="main-container">
            <!-- Sidebar -->
            <aside class="sidebar">
                <nav class="sidebar-nav">
                    <a href="#" class="sidebar-item">
                        <i class="fas fa-chart-line"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="index.html" class="sidebar-item active">
                        <i class="fas fa-calendar"></i>
                        <span>Appointments</span>
                    </a>
                    <a href="#" class="sidebar-item">
                        <i class="fas fa-file-medical"></i>
                        <span>Medical Records</span>
                    </a>
                    <a href="#" class="sidebar-item">
                        <i class="fas fa-pills"></i>
                        <span>Medications</span>
                    </a>
                    <a href="#" class="sidebar-item">
                        <i class="fas fa-credit-card"></i>
                        <span>Payments</span>
                    </a>
                    <a href="#" class="sidebar-item">
                        <i class="fas fa-envelope"></i>
                        <span>Messages</span>
                    </a>
                </nav>
            </aside>

            <!-- Main Content -->
            <main class="main-content">
                <!-- Welcome Card -->
                <div class="welcome-card">
                    <h1>Appointments</h1>
                    <p>Manage your upcoming appointments and schedule new ones.</p>
                    <a href="{{route('patient.patient_crud.create')}}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Schedule New Appointment
                    </a>
                </div>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Upcoming</h3>
                            <div class="card-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">3</div>
                            <div class="card-label">Scheduled appointments</div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Past</h3>
                            <div class="card-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">12</div>
                            <div class="card-label">Previous appointments</div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Doctors</h3>
                            <div class="card-icon">
                                <i class="fas fa-user-md"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">4</div>
                            <div class="card-label">Different specialists</div>
                        </div>
                    </div>
                </div>

                <!-- Appointments Tabs -->
                <div class="tabs">
                    <div class="tab-header">
                        <div class="tabs-list">
                            <button class="tab-trigger active" data-tab="list-view">List View</button>
                            <button class="tab-trigger" data-tab="calendar-view">Calendar View</button>
                        </div>
                        <button class="btn btn-outline">
                            <i class="fas fa-filter"></i>
                            Filter
                        </button>
                    </div>

                    <!-- List View Tab -->
                    <div id="list-view" class="tab-content active">
                        <div class="appointments-list">
                            <!-- Appointment Item 1 -->
                            <div class="appointment-item">
                                <div class="appointment-date">
                                    <div class="appointment-date-day">24</div>
                                    <div class="appointment-date-month">Mar</div>
                                </div>
                                <div class="appointment-details">
                                    <div class="appointment-title-wrapper">
                                        <div class="appointment-title">General Checkup</div>
                                        <span class="appointment-badge badge-confirmed">Confirmed</span>
                                    </div>
                                    <div class="appointment-info">
                                        <span><i class="fas fa-clock"></i> 10:00 AM</span>
                                        <span><i class="fas fa-user-md"></i> Dr. Sarah Johnson</span>
                                    </div>
                                </div>
                                <div class="appointment-actions">
                                    <button class="btn btn-outline">Reschedule</button>
                                    <button class="btn-icon-sm">
                                        <i class="fas fa-video"></i>
                                    </button>
                                    <div class="dropdown">
                                        <button class="btn-ghost btn-icon-sm dropdown-toggle">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="appointment-details.html?id=1" class="dropdown-item"><i class="fas fa-eye"></i> View Details</a>
                                            <a href="edit-appointment.html?id=1" class="dropdown-item"><i class="fas fa-calendar-alt"></i> Reschedule</a>
                                            <a href="#" class="dropdown-item"><i class="fas fa-video"></i> Join Virtual</a>
                                            <a href="#" class="dropdown-item text-danger"><i class="fas fa-times-circle"></i> Cancel Appointment</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Appointment Item 2 -->
                            <div class="appointment-item">
                                <div class="appointment-date">
                                    <div class="appointment-date-day">30</div>
                                    <div class="appointment-date-month">Mar</div>
                                </div>
                                <div class="appointment-details">
                                    <div class="appointment-title-wrapper">
                                        <div class="appointment-title">Follow-up Consultation</div>
                                        <span class="appointment-badge badge-confirmed">Confirmed</span>
                                    </div>
                                    <div class="appointment-info">
                                        <span><i class="fas fa-clock"></i> 2:30 PM</span>
                                        <span><i class="fas fa-user-md"></i> Dr. Michael Chen</span>
                                    </div>
                                </div>
                                <div class="appointment-actions">
                                    <button class="btn btn-outline">Reschedule</button>
                                    <button class="btn-icon-sm">
                                        <i class="fas fa-video"></i>
                                    </button>
                                    <div class="dropdown">
                                        <button class="btn-ghost btn-icon-sm dropdown-toggle">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="appointment-details.html?id=2" class="dropdown-item"><i class="fas fa-eye"></i> View Details</a>
                                            <a href="edit-appointment.html?id=2" class="dropdown-item"><i class="fas fa-calendar-alt"></i> Reschedule</a>
                                            <a href="#" class="dropdown-item"><i class="fas fa-video"></i> Join Virtual</a>
                                            <a href="#" class="dropdown-item text-danger"><i class="fas fa-times-circle"></i> Cancel Appointment</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Appointment Item 3 -->
                            <div class="appointment-item">
                                <div class="appointment-date">
                                    <div class="appointment-date-day">05</div>
                                    <div class="appointment-date-month">Apr</div>
                                </div>
                                <div class="appointment-details">
                                    <div class="appointment-title-wrapper">
                                        <div class="appointment-title">Dental Cleaning</div>
                                        <span class="appointment-badge badge-pending">Pending</span>
                                    </div>
                                    <div class="appointment-info">
                                        <span><i class="fas fa-clock"></i> 9:15 AM</span>
                                        <span><i class="fas fa-user-md"></i> Dr. Emily Rodriguez</span>
                                    </div>
                                </div>
                                <div class="appointment-actions">
                                    <button class="btn btn-outline">Confirm</button>
                                    <div class="dropdown">
                                        <button class="btn-ghost btn-icon-sm dropdown-toggle">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="appointment-details.html?id=3" class="dropdown-item"><i class="fas fa-eye"></i> View Details</a>
                                            <a href="edit-appointment.html?id=3" class="dropdown-item"><i class="fas fa-calendar-alt"></i> Reschedule</a>
                                            <a href="#" class="dropdown-item text-danger"><i class="fas fa-times-circle"></i> Cancel Appointment</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Calendar View Tab -->
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
                    </div>
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
</body>
</html>
