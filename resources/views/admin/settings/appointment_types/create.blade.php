<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Specialization | Admin Settings | Medical Clinic</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{{ asset('css/admin-styles.css')}}}">
    <style>
        .form-section {
            margin-bottom: 2rem;
        }
        .form-section-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #333;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 0.5rem;
        }
        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin: -0.5rem;
        }
        .form-col {
            flex: 1;
            padding: 0.5rem;
            min-width: 250px;
        }
        .required-field::after {
            content: "*";
            color: #dc3545;
            margin-left: 4px;
        }
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid #e0e0e0;
        }
    </style>
</head>
<body>
    <div class="app-container">
        <header class="dashboard-header">
            <a href="../index.html" class="logo">MediCare Clinic</a>
            <div class="header-actions">
                <button class="btn-icon notification-btn">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">5</span>
                </button>
                <div class="dropdown">
                    <button class="avatar-btn" id="avatarBtn">
                        <div class="avatar">
                            <span class="avatar-fallback">AD</span>
                        </div>
                    </button>
                    <div class="dropdown-menu" id="userDropdown">
                        <div class="dropdown-header">
                            <p class="user-name">Admin User</p>
                            <p class="user-email">admin@example.com</p>
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
            <aside class="sidebar">
                <nav class="sidebar-nav">
                    <a href="../admin-dashboard.html" class="sidebar-item">
                        <i class="fas fa-chart-line"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="../admin-users.html" class="sidebar-item">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                    <a href="../admin-doctors.html" class="sidebar-item">
                        <i class="fas fa-user-md"></i>
                        <span>Doctors</span>
                    </a>
                    <a href="../admin-appointments.html" class="sidebar-item">
                        <i class="fas fa-calendar"></i>
                        <span>Appointments</span>
                    </a>
                    <a href="../admin-services.html" class="sidebar-item">
                        <i class="fas fa-file-medical"></i>
                        <span>Services</span>
                    </a>
                    <a href="../admin-billing.html" class="sidebar-item">
                        <i class="fas fa-credit-card"></i>
                        <span>Billing</span>
                    </a>
                    <a href="../admin-reports.html" class="sidebar-item">
                        <i class="fas fa-chart-bar"></i>
                        <span>Reports</span>
                    </a>
                    <a href="../admin-settings.html" class="sidebar-item active">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </nav>
                <div class="sidebar-footer">
                    <button class="sidebar-item text-danger" style="width: 100%; text-align: left; background: none; border: none; cursor: pointer;">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </div>
            </aside>

            <aside class="settings-sidebar">
                <div class="settings-sidebar-header">
                    <h3>Settings</h3>
                </div>
                <nav class="settings-nav">
                    <a href="#" class="settings-nav-item">
                        <i class="fas fa-clinic-medical"></i>
                        <span>Clinic Information</span>
                    </a>
                    <a href="#" class="settings-nav-item">
                        <i class="fas fa-user-shield"></i>
                        <span>User Permissions</span>
                    </a>
                    <a href="#" class="settings-nav-item">
                        <i class="fas fa-list-alt"></i>
                        <span>Appointment Types</span>
                    </a>
                    <a href="appointmenttypes-index.html" class="settings-nav-item">
                        <i class="fas fa-building"></i>
                        <span>Doctor appointmenttypes</span>
                    </a>
                    <a href="specializations-index.html" class="settings-nav-item active">
                        <i class="fas fa-stethoscope"></i>
                        <span>Doctor Specializations</span>
                    </a>
                    <a href="#" class="settings-nav-item">
                        <i class="fas fa-envelope"></i>
                        <span>Email Templates</span>
                    </a>
                    <a href="#" class="settings-nav-item">
                        <i class="fas fa-bell"></i>
                        <span>Notification Settings</span>
                    </a>
                    <a href="#" class="settings-nav-item">
                        <i class="fas fa-lock"></i>
                        <span>Security Settings</span>
                    </a>
                    <a href="#" class="settings-nav-item">
                        <i class="fas fa-database"></i>
                        <span>Backup & Restore</span>
                    </a>
                </nav>
            </aside>

            <main class="settings-content">
                <div class="settings-section">
                    <div class="settings-header">
                        <h1>Create Specialization</h1>
                        <p>Add a new medical specialization to the system</p>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <form id="specialization-form" action="{{ route('admin.settings.appointment_types.store') }}" method="POST">
                                @csrf
                                <div class="form-section">
                                    <h3 class="form-section-title">Basic Information</h3>
                                    <div class="form-row">
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label for="name" class="required-field">Appointment Type Name</label>
                                                <input type="text" id="name" name="name" class="form-control" required>
                                                <small class="form-text text-muted">Enter the full name of the specialization</small>
                                            </div>
                                        </div>
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label for="specialization_ids" class="required-field">Specializations</label>
                                                <select id="specialization_ids" name="specialization_ids[]" class="form-control" multiple required>
                                                    @foreach($specializations as $specialization)
                                                        <option value="{{ $specialization->id }}">{{ $specialization->specialization_name }}</option>
                                                    @endforeach
                                                </select>
                                                <small class="form-text text-muted">Select one or more specializations related to this appointment type.</small>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea id="description" name="description" class="form-control" rows="3"></textarea>
                                        <small class="form-text text-muted">Provide a brief description of the specialization's focus and services</small>
                                    </div> --}}
                                </div>

                                {{-- <div class="form-section">
                                    <h3 class="form-section-title">Qualification Requirements</h3>
                                    <div class="form-group">
                                        <label for="specialization-qualifications">Required Qualifications</label>
                                        <textarea id="specialization-qualifications" name="qualifications" class="form-control" rows="3"></textarea>
                                        <small class="form-text text-muted">List the qualifications required for doctors in this specialization</small>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label for="specialization-experience">Minimum Experience (Years)</label>
                                                <input type="number" id="specialization-experience" name="experience" class="form-control" min="0" value="0">
                                                <small class="form-text text-muted">Minimum years of experience required</small>
                                            </div>
                                        </div>
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label for="specialization-certification">Certification Required</label>
                                                <select id="specialization-certification" name="certification" class="form-control">
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                                <small class="form-text text-muted">Is specialized certification required?</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-section">
                                    <h3 class="form-section-title">Additional Settings</h3>
                                    <div class="form-row">
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label for="specialization-status">Status</label>
                                                <select id="specialization-status" name="status" class="form-control">
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                </select>
                                                <small class="form-text text-muted">Set the current status of the specialization</small>
                                            </div>
                                        </div>
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label for="specialization-order">Display Order</label>
                                                <input type="number" id="specialization-order" name="order" class="form-control" value="0" min="0">
                                                <small class="form-text text-muted">Order in which the specialization appears in lists (0 = default)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="form-actions">
                                    <a href="specializations-index.html" class="btn btn-outline">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Create Appointment Type</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dropdown functionality
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

            // Form submission
            document.getElementById('specialization-form').addEventListener('submit', function(e) {
                // In a real application, you would handle the form submission via AJAX
                // For this example, we'll just redirect to the specializations index page
                // e.preventDefault();
                // window.location.href = 'specializations-index.html';
            });
        });
    </script>
</body>
</html>