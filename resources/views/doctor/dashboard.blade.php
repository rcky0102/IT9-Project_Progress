@extends('doctor.layout')

@section('title', 'Doctor Dashboard | Medical Clinic')

@section('content')

            <!-- Main Content -->
            <main class="main-content">
                <!-- Welcome Card -->
                <div class="welcome-card">
                    <h1>Welcome, Dr. {{ Auth::user()->first_name }}!</h1>
                    <p>This is your doctor dashboard. Here you can manage your appointments, view patient records, and more.</p>
                    <button class="btn btn-primary">
                        <i class="fas fa-calendar-plus"></i>
                        View Today's Schedule
                    </button>
                </div>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Today's Appointments</h3>
                            <div class="card-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">8</div>
                            <div class="card-label">Scheduled for today</div>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="card-link">
                                View All <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Patients</h3>
                            <div class="card-icon">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">45</div>
                            <div class="card-label">Total patients</div>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="card-link">
                                View All <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Pending Reports</h3>
                            <div class="card-icon">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">3</div>
                            <div class="card-label">Reports to complete</div>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="card-link">
                                View Details <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Appointments -->
                <div class="appointments-list">
                    <h3 class="records-title">Today's Appointments</h3>
                    
                    <div class="appointment-item">
                        <div class="appointment-date">
                            <div class="appointment-date-day">10</div>
                            <div class="appointment-date-month">AM</div>
                        </div>
                        <div class="appointment-details">
                            <div class="appointment-title">Emma Wilson - General Checkup</div>
                            <div class="appointment-info">
                                <span><i class="fas fa-clock"></i> 10:00 AM - 10:30 AM</span>
                                <span><i class="fas fa-phone"></i> +1 (555) 123-4567</span>
                            </div>
                        </div>
                        <div class="appointment-actions">
                            <button class="btn btn-outline">View Details</button>
                        </div>
                    </div>

                    <div class="appointment-item">
                        <div class="appointment-date">
                            <div class="appointment-date-day">11</div>
                            <div class="appointment-date-month">AM</div>
                        </div>
                        <div class="appointment-details">
                            <div class="appointment-title">James Brown - Follow-up Consultation</div>
                            <div class="appointment-info">
                                <span><i class="fas fa-clock"></i> 11:00 AM - 11:30 AM</span>
                                <span><i class="fas fa-phone"></i> +1 (555) 234-5678</span>
                            </div>
                        </div>
                        <div class="appointment-actions">
                            <button class="btn btn-outline">View Details</button>
                        </div>
                    </div>

                    <div class="appointment-item">
                        <div class="appointment-date">
                            <div class="appointment-date-day">2</div>
                            <div class="appointment-date-month">PM</div>
                        </div>
                        <div class="appointment-details">
                            <div class="appointment-title">Olivia Martinez - Blood Pressure Check</div>
                            <div class="appointment-info">
                                <span><i class="fas fa-clock"></i> 2:00 PM - 2:30 PM</span>
                                <span><i class="fas fa-phone"></i> +1 (555) 345-6789</span>
                            </div>
                        </div>
                        <div class="appointment-actions">
                            <button class="btn btn-outline">View Details</button>
                        </div>
                    </div>
                </div>

                <!-- Recent Patients -->
                <div class="patient-list">
                    <div class="patient-header">
                        <h3 class="patient-title">Recent Patients</h3>
                        <a href="#" class="btn btn-outline">View All Patients</a>
                    </div>

                    <div class="table-container">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Patient</th>
                                    <th>Contact</th>
                                    <th>Last Visit</th>
                                    <th>Diagnosis</th>
                                    <th>Next Appointment</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="patient-cell">
                                            <div class="patient-avatar">
                                                <img src="/placeholder.svg?height=40&width=40" alt="Emma Wilson">
                                                <span class="avatar-fallback">EW</span>
                                            </div>
                                            <div>Emma Wilson</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="contact-cell">
                                            <div>emma.wilson@example.com</div>
                                            <div class="text-muted">+1 (555) 123-4567</div>
                                        </div>
                                    </td>
                                    <td>Mar 15, 2025</td>
                                    <td>
                                        <span class="badge badge-outline">Hypertension</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-outline-blue">Mar 24, 2025</span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn-icon">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="#" class="dropdown-item">
                                                    <i class="fas fa-file-alt"></i> View Records
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="fas fa-calendar-plus"></i> Schedule Appointment
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="fas fa-prescription"></i> Prescribe Medication
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="fas fa-phone"></i> Call Patient
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="patient-cell">
                                            <div class="patient-avatar">
                                                <img src="/placeholder.svg?height=40&width=40" alt="James Brown">
                                                <span class="avatar-fallback">JB</span>
                                            </div>
                                            <div>James Brown</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="contact-cell">
                                            <div>james.brown@example.com</div>
                                            <div class="text-muted">+1 (555) 234-5678</div>
                                        </div>
                                    </td>
                                    <td>Mar 10, 2025</td>
                                    <td>
                                        <span class="badge badge-outline">Diabetes</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-outline-blue">Mar 24, 2025</span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn-icon">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="#" class="dropdown-item">
                                                    <i class="fas fa-file-alt"></i> View Records
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="fas fa-calendar-plus"></i> Schedule Appointment
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="fas fa-prescription"></i> Prescribe Medication
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="fas fa-phone"></i> Call Patient
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="patient-cell">
                                            <div class="patient-avatar">
                                                <img src="/placeholder.svg?height=40&width=40" alt="Olivia Martinez">
                                                <span class="avatar-fallback">OM</span>
                                            </div>
                                            <div>Olivia Martinez</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="contact-cell">
                                            <div>olivia.martinez@example.com</div>
                                            <div class="text-muted">+1 (555) 345-6789</div>
                                        </div>
                                    </td>
                                    <td>Mar 5, 2025</td>
                                    <td>
                                        <span class="badge badge-outline">Asthma</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-outline-blue">Mar 19, 2025</span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn-icon">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="#" class="dropdown-item">
                                                    <i class="fas fa-file-alt"></i> View Records
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="fas fa-calendar-plus"></i> Schedule Appointment
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="fas fa-prescription"></i> Prescribe Medication
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="fas fa-phone"></i> Call Patient
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
        });
    </script>

@endsection
