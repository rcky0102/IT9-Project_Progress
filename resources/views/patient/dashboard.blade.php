@extends('patient.layout')

@section('title', 'Patient Dashboard | Medical Clinic')

@section('content')

            <!-- Main Content -->
            <main class="main-content">
                <!-- Welcome Card -->
                <div class="welcome-card">
                    <h1>Welcome, {{ Auth::user()->first_name }}!</h1>
                    <p>This is your patient dashboard. Here you can manage your appointments, view your medical records, and more.</p>
                    <button class="btn btn-primary">
                        <i class="fas fa-calendar-plus"></i>
                        Schedule New Appointment
                    </button>
                </div>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Upcoming Appointments</h3>
                            <div class="card-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">2</div>
                            <div class="card-label">Scheduled appointments</div>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="card-link">
                                View All <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Medical Records</h3>
                            <div class="card-icon">
                                <i class="fas fa-file-medical"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">8</div>
                            <div class="card-label">Total records</div>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="card-link">
                                View All <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Payments</h3>
                            <div class="card-icon">
                                <i class="fas fa-credit-card"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">$120</div>
                            <div class="card-label">Outstanding balance</div>
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
                    <h3 class="records-title">Upcoming Appointments</h3>
                    
                    <div class="appointment-item">
                        <div class="appointment-date">
                            <div class="appointment-date-day">24</div>
                            <div class="appointment-date-month">Mar</div>
                        </div>
                        <div class="appointment-details">
                            <div class="appointment-title">General Checkup</div>
                            <div class="appointment-info">
                                <span><i class="fas fa-clock"></i> 10:00 AM</span>
                                <span><i class="fas fa-user-md"></i> Dr. Sarah Johnson</span>
                            </div>
                        </div>
                        <div class="appointment-actions">
                            <button class="btn btn-outline">Reschedule</button>
                        </div>
                    </div>

                    <div class="appointment-item">
                        <div class="appointment-date">
                            <div class="appointment-date-day">30</div>
                            <div class="appointment-date-month">Mar</div>
                        </div>
                        <div class="appointment-details">
                            <div class="appointment-title">Follow-up Consultation</div>
                            <div class="appointment-info">
                                <span><i class="fas fa-clock"></i> 2:30 PM</span>
                                <span><i class="fas fa-user-md"></i> Dr. Michael Chen</span>
                            </div>
                        </div>
                        <div class="appointment-actions">
                            <button class="btn btn-outline">Reschedule</button>
                        </div>
                    </div>
                </div>

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
