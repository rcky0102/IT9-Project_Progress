<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescriptions | Medical Clinic</title>
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
                    <a href="appointments.html" class="sidebar-item">
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
                    <a href="prescriptions.html" class="sidebar-item active">
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
                        <h1>Prescriptions</h1>
                        <p class="text-muted">Manage patient prescriptions</p>
                    </div>
                    <button class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        New Prescription
                    </button>
                </div>

                <!-- Filters -->
                <div class="filters-container">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search prescriptions...">
                    </div>
                    <select class="filter-select">
                        <option value="">All Patients</option>
                        <option value="emma-wilson">Emma Wilson</option>
                        <option value="james-brown">James Brown</option>
                        <option value="olivia-martinez">Olivia Martinez</option>
                        <option value="robert-johnson">Robert Johnson</option>
                    </select>
                    <select class="filter-select">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="completed">Completed</option>
                        <option value="expired">Expired</option>
                    </select>
                </div>

                <!-- Prescription Stats -->
                <div class="dashboard-cards">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Active Prescriptions</h3>
                            <div class="card-icon">
                                <i class="fas fa-prescription"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">28</div>
                            <div class="card-label">Currently active</div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Prescriptions This Month</h3>
                            <div class="card-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">42</div>
                            <div class="card-label">New prescriptions</div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Expiring Soon</h3>
                            <div class="card-icon">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">5</div>
                            <div class="card-label">Within 7 days</div>
                        </div>
                    </div>
                </div>

                <!-- Prescriptions List -->
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Medication</th>
                                <th>Dosage</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="patient-cell">
                                        <div class="patient-avatar">
                                            <span class="avatar-fallback">EW</span>
                                        </div>
                                        <div>Emma Wilson</div>
                                    </div>
                                </td>
                                <td>Lisinopril</td>
                                <td>10mg daily</td>
                                <td>May 15, 2025</td>
                                <td>Aug 15, 2025</td>
                                <td>
                                    <span class="badge badge-outline-blue">Active</span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn-icon">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-eye"></i> View Details
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-edit"></i> Edit Prescription
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-print"></i> Print Prescription
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-envelope"></i> Email to Patient
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-times"></i> Cancel Prescription
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="patient-cell">
                                        <div class="patient-avatar">
                                            <span class="avatar-fallback">JB</span>
                                        </div>
                                        <div>James Brown</div>
                                    </div>
                                </td>
                                <td>Metformin</td>
                                <td>500mg twice daily</td>
                                <td>May 10, 2025</td>
                                <td>Aug 10, 2025</td>
                                <td>
                                    <span class="badge badge-outline-blue">Active</span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn-icon">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-eye"></i> View Details
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-edit"></i> Edit Prescription
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-print"></i> Print Prescription
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-envelope"></i> Email to Patient
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-times"></i> Cancel Prescription
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="patient-cell">
                                        <div class="patient-avatar">
                                            <span class="avatar-fallback">OM</span>
                                        </div>
                                        <div>Olivia Martinez</div>
                                    </div>
                                </td>
                                <td>Albuterol Inhaler</td>
                                <td>2 puffs as needed</td>
                                <td>May 8, 2025</td>
                                <td>Aug 8, 2025</td>
                                <td>
                                    <span class="badge badge-outline-blue">Active</span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn-icon">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-eye"></i> View Details
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-edit"></i> Edit Prescription
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-print"></i> Print Prescription
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-envelope"></i> Email to Patient
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-times"></i> Cancel Prescription
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="patient-cell">
                                        <div class="patient-avatar">
                                            <span class="avatar-fallback">RJ</span>
                                        </div>
                                        <div>Robert Johnson</div>
                                    </div>
                                </td>
                                <td>Ibuprofen</td>
                                <td>400mg as needed</td>
                                <td>May 5, 2025</td>
                                <td>Jun 5, 2025</td>
                                <td>
                                    <span class="badge badge-outline-blue">Active</span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn-icon">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-eye"></i> View Details
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-edit"></i> Edit Prescription
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-print"></i> Print Prescription
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-envelope"></i> Email to Patient
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-times"></i> Cancel Prescription
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Prescription Form -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">New Prescription</h3>
                    </div>
                    <div class="prescription-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="patient">Patient</label>
                                <select id="patient" class="form-control">
                                    <option value="">Select Patient</option>
                                    <option value="emma-wilson">Emma Wilson</option>
                                    <option value="james-brown">James Brown</option>
                                    <option value="olivia-martinez">Olivia Martinez</option>
                                    <option value="robert-johnson">Robert Johnson</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="medication">Medication</label>
                                <input type="text" id="medication" class="form-control" placeholder="Enter medication name">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="dosage">Dosage</label>
                                <input type="text" id="dosage" class="form-control" placeholder="Enter dosage">
                            </div>
                            <div class="form-group">
                                <label for="frequency">Frequency</label>
                                <select id="frequency" class="form-control">
                                    <option value="">Select Frequency</option>
                                    <option value="daily">Once Daily</option>
                                    <option value="twice-daily">Twice Daily</option>
                                    <option value="three-times">Three Times Daily</option>
                                    <option value="four-times">Four Times Daily</option>
                                    <option value="as-needed">As Needed</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="start-date">Start Date</label>
                                <input type="date" id="start-date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="end-date">End Date</label>
                                <input type="date" id="end-date" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="instructions">Special Instructions</label>
                            <textarea id="instructions" class="form-control" rows="3" placeholder="Enter any special instructions"></textarea>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-outline">Cancel</button>
                            <button class="btn btn-primary">Save Prescription</button>
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