<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patients | Medical Clinic</title>
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
                    <a href="patients.html" class="sidebar-item active">
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
                        <h1>Patients</h1>
                        <p class="text-muted">Manage your patient database</p>
                    </div>
                    <button class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Add New Patient
                    </button>
                </div>

                <!-- Filters -->
                <div class="filters-container">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search patients...">
                    </div>
                    <select class="filter-select">
                        <option value="">All Diagnoses</option>
                        <option value="hypertension">Hypertension</option>
                        <option value="diabetes">Diabetes</option>
                        <option value="asthma">Asthma</option>
                        <option value="arthritis">Arthritis</option>
                    </select>
                    <select class="filter-select">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <!-- Patient Stats -->
                <div class="dashboard-cards">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Total Patients</h3>
                            <div class="card-icon">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">145</div>
                            <div class="card-label">Registered patients</div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">New Patients</h3>
                            <div class="card-icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">12</div>
                            <div class="card-label">This month</div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Appointments</h3>
                            <div class="card-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">28</div>
                            <div class="card-label">This month</div>
                        </div>
                    </div>
                </div>

                <!-- Patient List -->
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Contact</th>
                                <th>Age/Gender</th>
                                <th>Last Visit</th>
                                <th>Diagnosis</th>
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
                                <td>
                                    <div class="contact-cell">
                                        <div>emma.wilson@example.com</div>
                                        <div class="text-muted">+1 (555) 123-4567</div>
                                    </div>
                                </td>
                                <td>42 / Female</td>
                                <td>May 15, 2025</td>
                                <td>
                                    <span class="badge badge-outline">Hypertension</span>
                                </td>
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
                                                <i class="fas fa-eye"></i> View Profile
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-edit"></i> Edit Patient
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-file-medical"></i> Medical Records
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-calendar-plus"></i> Schedule Appointment
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-prescription"></i> Prescribe Medication
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
                                <td>
                                    <div class="contact-cell">
                                        <div>james.brown@example.com</div>
                                        <div class="text-muted">+1 (555) 234-5678</div>
                                    </div>
                                </td>
                                <td>58 / Male</td>
                                <td>May 10, 2025</td>
                                <td>
                                    <span class="badge badge-outline">Diabetes</span>
                                </td>
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
                                                <i class="fas fa-eye"></i> View Profile
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-edit"></i> Edit Patient
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-file-medical"></i> Medical Records
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-calendar-plus"></i> Schedule Appointment
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-prescription"></i> Prescribe Medication
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
                                <td>
                                    <div class="contact-cell">
                                        <div>olivia.martinez@example.com</div>
                                        <div class="text-muted">+1 (555) 345-6789</div>
                                    </div>
                                </td>
                                <td>35 / Female</td>
                                <td>May 5, 2025</td>
                                <td>
                                    <span class="badge badge-outline">Asthma</span>
                                </td>
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
                                                <i class="fas fa-eye"></i> View Profile
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-edit"></i> Edit Patient
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-file-medical"></i> Medical Records
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-calendar-plus"></i> Schedule Appointment
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-prescription"></i> Prescribe Medication
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
                                <td>
                                    <div class="contact-cell">
                                        <div>robert.johnson@example.com</div>
                                        <div class="text-muted">+1 (555) 456-7890</div>
                                    </div>
                                </td>
                                <td>62 / Male</td>
                                <td>May 1, 2025</td>
                                <td>
                                    <span class="badge badge-outline">Arthritis</span>
                                </td>
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
                                                <i class="fas fa-eye"></i> View Profile
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-edit"></i> Edit Patient
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-file-medical"></i> Medical Records
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-calendar-plus"></i> Schedule Appointment
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-prescription"></i> Prescribe Medication
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <button class="btn-icon pagination-btn"><i class="fas fa-chevron-left"></i></button>
                    <button class="pagination-btn active">1</button>
                    <button class="pagination-btn">2</button>
                    <button class="pagination-btn">3</button>
                    <span class="pagination-ellipsis">...</span>
                    <button class="pagination-btn">10</button>
                    <button class="btn-icon pagination-btn"><i class="fas fa-chevron-right"></i></button>
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