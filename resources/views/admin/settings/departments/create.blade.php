<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Department | Admin Settings | Medical Clinic</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin-styles.css') }}">
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
        .color-preview {
            width: 30px;
            height: 30px;
            border-radius: 4px;
            display: inline-block;
            vertical-align: middle;
            margin-left: 10px;
            border: 1px solid #ccc;
        }
        .icon-preview {
            width: 40px;
            height: 40px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            border: 1px solid #ccc;
            margin-left: 10px;
            font-size: 1.2rem;
        }
        .icon-select-container {
            display: flex;
            align-items: center;
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
        <!-- Header -->
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
            <!-- Admin Sidebar -->
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

            <!-- Settings Sidebar -->
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
                    <a href="departments-index.html" class="settings-nav-item active">
                        <i class="fas fa-building"></i>
                        <span>Doctor Departments</span>
                    </a>
                    <a href="specializations-index.html" class="settings-nav-item">
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

            <!-- Main Content -->
            <main class="settings-content">
                <div class="settings-section">
                    <div class="settings-header">
                        <h1>Create Department</h1>
                        <p>Add a new medical department to the clinic</p>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <form id="department-form" action="{{ route('admin.settings.departments.store') }}" method="POST">
                                @csrf
                                <!-- Basic Information -->
                                <div class="form-section">
                                    <h3 class="form-section-title">Basic Information</h3>
                                    <div class="form-row">
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label for="department_name" class="required-field">Department Name</label>
                                                <input type="text" id="department_name" name="department_name" class="form-control" required>
                                                <small class="form-text text-muted">Enter the full name of the department</small>
                                            </div>
                                        </div>
                                        {{-- <div class="form-col">
                                            <div class="form-group">
                                                <label for="department-code">Department Code</label>
                                                <input type="text" id="department-code" name="code" class="form-control" placeholder="e.g., NEURO, CARDIO">
                                                <small class="form-text text-muted">Short code for the department (auto-generated if left empty)</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="department-description">Description</label>
                                        <textarea id="department-description" name="description" class="form-control" rows="3"></textarea>
                                        <small class="form-text text-muted">Provide a brief description of the department's services and focus</small>
                                    </div>
                                </div>

                                <!-- Department Head -->
                                <div class="form-section">
                                    <h3 class="form-section-title">Department Head</h3>
                                    <div class="form-group">
                                        <label for="department-head" class="required-field">Head of Department</label>
                                        <select id="department-head" name="head" class="form-control" required>
                                            <option value="">Select Doctor</option>
                                            <option value="1">Dr. Sarah Johnson</option>
                                            <option value="2">Dr. Michael Chen</option>
                                            <option value="3">Dr. Emily Rodriguez</option>
                                            <option value="4">Dr. James Williams</option>
                                            <option value="5">Dr. Robert Kim</option>
                                            <option value="6">Dr. Lisa Thompson</option>
                                            <option value="7">Dr. David Martinez</option>
                                            <option value="8">Dr. Jennifer Lee</option>
                                        </select>
                                        <small class="form-text text-muted">Select the doctor who will lead this department</small>
                                    </div>
                                </div>

                                <!-- Contact Information -->
                                <div class="form-section">
                                    <h3 class="form-section-title">Contact Information</h3>
                                    <div class="form-row">
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label for="department-location">Location</label>
                                                <input type="text" id="department-location" name="location" class="form-control" placeholder="e.g., Building A, Floor 2">
                                                <small class="form-text text-muted">Physical location of the department in the facility</small>
                                            </div>
                                        </div>
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label for="department-phone">Contact Phone</label>
                                                <input type="tel" id="department-phone" name="phone" class="form-control" placeholder="(123) 456-7890">
                                                <small class="form-text text-muted">Direct phone number for the department</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="department-email">Contact Email</label>
                                        <input type="email" id="department-email" name="email" class="form-control" placeholder="department@example.com">
                                        <small class="form-text text-muted">Email address for department inquiries</small>
                                    </div>
                                </div>

                                <!-- Additional Settings -->
                                <div class="form-section">
                                    <h3 class="form-section-title">Additional Settings</h3>
                                    <div class="form-row">
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label for="department-color">Department Color</label>
                                                <div style="display: flex; align-items: center;">
                                                    <input type="color" id="department-color" name="color" class="form-control" value="#004258" style="width: 60px; height: 40px;">
                                                    <div class="color-preview" id="color-preview" style="background-color: #004258;"></div>
                                                </div>
                                                <small class="form-text text-muted">Choose a color for department identification</small>
                                            </div>
                                        </div>
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label for="department-icon">Department Icon</label>
                                                <div class="icon-select-container">
                                                    <select id="department-icon" name="icon" class="form-control">
                                                        <option value="fa-building">Building</option>
                                                        <option value="fa-heartbeat">Heartbeat</option>
                                                        <option value="fa-brain">Brain</option>
                                                        <option value="fa-tooth">Dental</option>
                                                        <option value="fa-x-ray">X-Ray</option>
                                                        <option value="fa-baby">Pediatrics</option>
                                                        <option value="fa-bone">Orthopedics</option>
                                                        <option value="fa-eye">Ophthalmology</option>
                                                        <option value="fa-stethoscope">Stethoscope</option>
                                                    </select>
                                                    <div class="icon-preview" id="icon-preview">
                                                        <i class="fas fa-building"></i>
                                                    </div>
                                                </div>
                                                <small class="form-text text-muted">Select an icon to represent the department</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label for="department-status">Status</label>
                                                <select id="department-status" name="status" class="form-control">
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                </select>
                                                <small class="form-text text-muted">Set the current operational status of the department</small>
                                            </div>
                                        </div>
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label for="department-order">Display Order</label>
                                                <input type="number" id="department-order" name="order" class="form-control" value="0" min="0">
                                                <small class="form-text text-muted">Order in which the department appears in lists (0 = default)</small>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>

                                <!-- Form Actions -->
                                <div class="form-actions">
                                    <a href="departments-index.html" class="btn btn-outline">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Create Department</button>
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

            // Color preview
            const colorInput = document.getElementById('department-color');
            const colorPreview = document.getElementById('color-preview');
            
            colorInput.addEventListener('input', function() {
                colorPreview.style.backgroundColor = this.value;
            });

            // Icon preview
            const iconSelect = document.getElementById('department-icon');
            const iconPreview = document.getElementById('icon-preview');
            
            iconSelect.addEventListener('change', function() {
                iconPreview.innerHTML = `<i class="fas ${this.value}"></i>`;
            });

            // Auto-generate department code from name
            const departmentName = document.getElementById('department-name');
            const departmentCode = document.getElementById('department-code');
            
            departmentName.addEventListener('blur', function() {
                if (departmentCode.value === '') {
                    // Generate code from name (first 3-5 letters, uppercase)
                    let name = this.value.trim();
                    if (name) {
                        // Remove any non-alphanumeric characters
                        name = name.replace(/[^a-zA-Z0-9]/g, '');
                        // Take first word if multiple words
                        name = name.split(' ')[0];
                        // Take first 3-5 characters depending on length
                        let codeLength = Math.min(Math.max(name.length, 3), 5);
                        let code = name.substring(0, codeLength).toUpperCase();
                        departmentCode.value = code;
                    }
                }
            });

            // Form submission
            document.getElementById('department-form').addEventListener('submit', function(e) {
                // In a real application, you would handle the form submission via AJAX
                // For this example, we'll just redirect to the departments index page
                // e.preventDefault();
                // window.location.href = 'departments-index.html';
            });
        });
    </script>
</body>
</html>
