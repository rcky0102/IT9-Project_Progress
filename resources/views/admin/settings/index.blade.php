<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Settings | Medical Clinic</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin-styles.css') }}">
</head>
<body>
    <div class="app-container">
        <!-- Header -->
        <header class="dashboard-header">
            <a href="index.html" class="logo">MediCare Clinic</a>
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
                    <a href="admin-dashboard.html" class="sidebar-item">
                        <i class="fas fa-chart-line"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="admin-users.html" class="sidebar-item">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                    <a href="admin-doctors.html" class="sidebar-item">
                        <i class="fas fa-user-md"></i>
                        <span>Doctors</span>
                    </a>
                    <a href="admin-appointments.html" class="sidebar-item">
                        <i class="fas fa-calendar"></i>
                        <span>Appointments</span>
                    </a>
                    <a href="admin-services.html" class="sidebar-item">
                        <i class="fas fa-file-medical"></i>
                        <span>Services</span>
                    </a>
                    <a href="admin-billing.html" class="sidebar-item">
                        <i class="fas fa-credit-card"></i>
                        <span>Billing</span>
                    </a>
                    <a href="admin-reports.html" class="sidebar-item">
                        <i class="fas fa-chart-bar"></i>
                        <span>Reports</span>
                    </a>
                    <a href="admin-settings.html" class="sidebar-item active">
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
                    <a href="#" class="settings-nav-item active">
                        <i class="fas fa-list-alt"></i>
                        <span>Appointment Types</span>
                    </a>
                    <a href="#" class="settings-nav-item">
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
                <!-- Appointment Types Section -->
                <div class="settings-section" id="appointment-types-section">
                    <div class="settings-header">
                        <h1>Appointment Types</h1>
                        <p>Manage the types of appointments available in the system</p>
                        <button class="btn btn-primary" id="add-appointment-type-btn">
                            <i class="fas fa-plus"></i> Add Appointment Type
                        </button>
                    </div>

                    <!-- Search and Filter -->
                    <div class="filters-container">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Search appointment types...">
                        </div>
                        <select class="filter-select">
                            <option value="all">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <!-- Appointment Types Table -->
                    <div class="table-container">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Duration</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>General Checkup</td>
                                    <td>30 minutes</td>
                                    <td>$75.00</td>
                                    <td>Regular health examination and consultation</td>
                                    <td><span class="badge badge-success">Active</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-icon edit-btn" data-id="1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn-icon delete-btn" data-id="1">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Follow-up Consultation</td>
                                    <td>20 minutes</td>
                                    <td>$50.00</td>
                                    <td>Follow-up visit after initial treatment</td>
                                    <td><span class="badge badge-success">Active</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-icon edit-btn" data-id="2">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn-icon delete-btn" data-id="2">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dental Cleaning</td>
                                    <td>45 minutes</td>
                                    <td>$120.00</td>
                                    <td>Professional dental cleaning and examination</td>
                                    <td><span class="badge badge-success">Active</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-icon edit-btn" data-id="3">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn-icon delete-btn" data-id="3">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Specialist Consultation</td>
                                    <td>60 minutes</td>
                                    <td>$150.00</td>
                                    <td>Consultation with a medical specialist</td>
                                    <td><span class="badge badge-success">Active</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-icon edit-btn" data-id="4">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn-icon delete-btn" data-id="4">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Vaccination</td>
                                    <td>15 minutes</td>
                                    <td>$40.00</td>
                                    <td>Routine vaccination services</td>
                                    <td><span class="badge badge-success">Active</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-icon edit-btn" data-id="5">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn-icon delete-btn" data-id="5">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Physical Therapy</td>
                                    <td>45 minutes</td>
                                    <td>$90.00</td>
                                    <td>Therapeutic exercises and treatments</td>
                                    <td><span class="badge badge-warning">Inactive</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-icon edit-btn" data-id="6">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn-icon delete-btn" data-id="6">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination">
                        <button class="pagination-btn" disabled>
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="pagination-btn active">1</button>
                        <button class="pagination-btn">2</button>
                        <button class="pagination-btn">3</button>
                        <button class="pagination-btn">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>

                <!-- Doctor Specializations Section (Hidden by default) -->
                <div class="settings-section hidden" id="doctor-specializations-section">
                    <div class="settings-header">
                        <h1>Doctor Specializations</h1>
                        <p>Manage medical specializations for doctors in the system</p>
                        <button class="btn btn-primary" id="add-specialization-btn">
                            <i class="fas fa-plus"></i> Add Specialization
                        </button>
                    </div>

                    <!-- Search and Filter -->
                    <div class="filters-container">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Search specializations...">
                        </div>
                        <select class="filter-select">
                            <option value="all">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <!-- Specializations Table -->
                    <div class="table-container">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Doctors Count</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>General Medicine</td>
                                    <td>Internal Medicine</td>
                                    <td>8</td>
                                    <td>Primary healthcare and general medical services</td>
                                    <td><span class="badge badge-success">Active</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-icon edit-btn" data-id="1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn-icon delete-btn" data-id="1">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Cardiology</td>
                                    <td>Internal Medicine</td>
                                    <td>5</td>
                                    <td>Diagnosis and treatment of heart conditions</td>
                                    <td><span class="badge badge-success">Active</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-icon edit-btn" data-id="2">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn-icon delete-btn" data-id="2">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dentistry</td>
                                    <td>Dental Care</td>
                                    <td>6</td>
                                    <td>Oral health and dental procedures</td>
                                    <td><span class="badge badge-success">Active</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-icon edit-btn" data-id="3">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn-icon delete-btn" data-id="3">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pediatrics</td>
                                    <td>Child Health</td>
                                    <td>7</td>
                                    <td>Medical care for infants, children, and adolescents</td>
                                    <td><span class="badge badge-success">Active</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-icon edit-btn" data-id="4">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn-icon delete-btn" data-id="4">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Orthopedics</td>
                                    <td>Surgery</td>
                                    <td>4</td>
                                    <td>Treatment of musculoskeletal system</td>
                                    <td><span class="badge badge-success">Active</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-icon edit-btn" data-id="5">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn-icon delete-btn" data-id="5">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Neurology</td>
                                    <td>Neuroscience</td>
                                    <td>3</td>
                                    <td>Diagnosis and treatment of nervous system disorders</td>
                                    <td><span class="badge badge-warning">Inactive</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-icon edit-btn" data-id="6">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn-icon delete-btn" data-id="6">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination">
                        <button class="pagination-btn" disabled>
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="pagination-btn active">1</button>
                        <button class="pagination-btn">2</button>
                        <button class="pagination-btn">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Add/Edit Appointment Type Modal -->
    <div class="modal" id="appointment-type-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="appointment-type-modal-title">Add Appointment Type</h2>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="appointment-type-form">
                    <div class="form-group">
                        <label for="appointment-type-name">Name</label>
                        <input type="text" id="appointment-type-name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="appointment-type-duration">Duration (minutes)</label>
                        <input type="number" id="appointment-type-duration" name="duration" class="form-control" min="5" step="5" required>
                    </div>
                    <div class="form-group">
                        <label for="appointment-type-price">Price ($)</label>
                        <input type="number" id="appointment-type-price" name="price" class="form-control" min="0" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="appointment-type-description">Description</label>
                        <textarea id="appointment-type-description" name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="appointment-type-status">Status</label>
                        <select id="appointment-type-status" name="status" class="form-control">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="appointment-type-color">Color</label>
                        <input type="color" id="appointment-type-color" name="color" class="form-control" value="#004258">
                    </div>
                    <input type="hidden" id="appointment-type-id" name="id">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" id="cancel-appointment-type">Cancel</button>
                <button class="btn btn-primary" id="save-appointment-type">Save</button>
            </div>
        </div>
    </div>

    <!-- Add/Edit Specialization Modal -->
    <div class="modal" id="specialization-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="specialization-modal-title">Add Specialization</h2>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="specialization-form">
                    <div class="form-group">
                        <label for="specialization-name">Name</label>
                        <input type="text" id="specialization-name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="specialization-department">Department</label>
                        <select id="specialization-department" name="department" class="form-control" required>
                            <option value="">Select Department</option>
                            <option value="Internal Medicine">Internal Medicine</option>
                            <option value="Surgery">Surgery</option>
                            <option value="Pediatrics">Child Health</option>
                            <option value="Dental Care">Dental Care</option>
                            <option value="Neuroscience">Neuroscience</option>
                            <option value="Radiology">Radiology</option>
                            <option value="Emergency Medicine">Emergency Medicine</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="specialization-description">Description</label>
                        <textarea id="specialization-description" name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="specialization-status">Status</label>
                        <select id="specialization-status" name="status" class="form-control">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <input type="hidden" id="specialization-id" name="id">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" id="cancel-specialization">Cancel</button>
                <button class="btn btn-primary" id="save-specialization">Save</button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal" id="delete-confirmation-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Confirm Delete</h2>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <p id="delete-confirmation-message">Are you sure you want to delete this item? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" id="cancel-delete">Cancel</button>
                <button class="btn btn-danger" id="confirm-delete">Delete</button>
            </div>
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

            // Settings sidebar navigation
            const settingsNavItems = document.querySelectorAll('.settings-nav-item');
            const settingsSections = document.querySelectorAll('.settings-section');
            
            settingsNavItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active class from all nav items
                    settingsNavItems.forEach(navItem => {
                        navItem.classList.remove('active');
                    });
                    
                    // Add active class to clicked nav item
                    this.classList.add('active');
                    
                    // Hide all sections
                    settingsSections.forEach(section => {
                        section.classList.add('hidden');
                    });
                    
                    // Show the corresponding section
                    const sectionId = this.querySelector('span').textContent.toLowerCase().replace(/\s+/g, '-') + '-section';
                    document.getElementById(sectionId)?.classList.remove('hidden');
                });
            });

            // Modal functionality
            const modals = document.querySelectorAll('.modal');
            const closeButtons = document.querySelectorAll('.close-modal');
            const addAppointmentTypeBtn = document.getElementById('add-appointment-type-btn');
            const addSpecializationBtn = document.getElementById('add-specialization-btn');
            const cancelAppointmentTypeBtn = document.getElementById('cancel-appointment-type');
            const cancelSpecializationBtn = document.getElementById('cancel-specialization');
            const cancelDeleteBtn = document.getElementById('cancel-delete');
            
            // Open modals
            addAppointmentTypeBtn.addEventListener('click', function() {
                document.getElementById('appointment-type-modal').classList.add('show');
                document.getElementById('appointment-type-modal-title').textContent = 'Add Appointment Type';
                document.getElementById('appointment-type-form').reset();
                document.getElementById('appointment-type-id').value = '';
            });
            
            addSpecializationBtn.addEventListener('click', function() {
                document.getElementById('specialization-modal').classList.add('show');
                document.getElementById('specialization-modal-title').textContent = 'Add Specialization';
                document.getElementById('specialization-form').reset();
                document.getElementById('specialization-id').value = '';
            });
            
            // Close modals
            closeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    modals.forEach(modal => {
                        modal.classList.remove('show');
                    });
                });
            });
            
            cancelAppointmentTypeBtn.addEventListener('click', function() {
                document.getElementById('appointment-type-modal').classList.remove('show');
            });
            
            cancelSpecializationBtn.addEventListener('click', function() {
                document.getElementById('specialization-modal').classList.remove('show');
            });
            
            cancelDeleteBtn.addEventListener('click', function() {
                document.getElementById('delete-confirmation-modal').classList.remove('show');
            });
            
            // Close modals when clicking outside
            window.addEventListener('click', function(e) {
                modals.forEach(modal => {
                    if (e.target === modal) {
                        modal.classList.remove('show');
                    }
                });
            });

            // Edit appointment type
            const editAppointmentTypeBtns = document.querySelectorAll('#appointment-types-section .edit-btn');
            
            editAppointmentTypeBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    document.getElementById('appointment-type-modal').classList.add('show');
                    document.getElementById('appointment-type-modal-title').textContent = 'Edit Appointment Type';
                    
                    // In a real application, you would fetch the data from the server
                    // For this example, we'll just populate with dummy data
                    document.getElementById('appointment-type-id').value = id;
                    
                    // Get the row data
                    const row = this.closest('tr');
                    const name = row.cells[0].textContent;
                    const duration = row.cells[1].textContent.split(' ')[0];
                    const price = row.cells[2].textContent.substring(1);
                    const description = row.cells[3].textContent;
                    
                    const status = row.cells[4].querySelector('.badge').textContent.toLowerCase();
                    
                    // Populate the form
                    document.getElementById('appointment-type-name').value = name;
                    document.getElementById('appointment-type-duration').value = duration;
                    document.getElementById('appointment-type-price').value = price;
                    document.getElementById('appointment-type-description').value = description;
                    document.getElementById('appointment-type-status').value = status;
                });
            });

            // Edit specialization
            const editSpecializationBtns = document.querySelectorAll('#doctor-specializations-section .edit-btn');
            
            editSpecializationBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    document.getElementById('specialization-modal').classList.add('show');
                    document.getElementById('specialization-modal-title').textContent = 'Edit Specialization';
                    
                    // In a real application, you would fetch the data from the server
                    // For this example, we'll just populate with dummy data
                    document.getElementById('specialization-id').value = id;
                    
                    // Get the row data
                    const row = this.closest('tr');
                    const name = row.cells[0].textContent;
                    const department = row.cells[1].textContent;
                    const description = row.cells[3].textContent;
                    const status = row.cells[4].querySelector('.badge').textContent.toLowerCase();
                    
                    // Populate the form
                    document.getElementById('specialization-name').value = name;
                    document.getElementById('specialization-department').value = department;
                    document.getElementById('specialization-description').value = description;
                    document.getElementById('specialization-status').value = status;
                });
            });

            // Delete appointment type
            const deleteAppointmentTypeBtns = document.querySelectorAll('#appointment-types-section .delete-btn');
            
            deleteAppointmentTypeBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const row = this.closest('tr');
                    const name = row.cells[0].textContent;
                    
                    document.getElementById('delete-confirmation-modal').classList.add('show');
                    document.getElementById('delete-confirmation-message').textContent = `Are you sure you want to delete the appointment type "${name}"? This action cannot be undone.`;
                    
                    // Store the ID for the delete confirmation
                    document.getElementById('confirm-delete').setAttribute('data-id', id);
                    document.getElementById('confirm-delete').setAttribute('data-type', 'appointment-type');
                });
            });

            // Delete specialization
            const deleteSpecializationBtns = document.querySelectorAll('#doctor-specializations-section .delete-btn');
            
            deleteSpecializationBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const row = this.closest('tr');
                    const name = row.cells[0].textContent;
                    
                    document.getElementById('delete-confirmation-modal').classList.add('show');
                    document.getElementById('delete-confirmation-message').textContent = `Are you sure you want to delete the specialization "${name}"? This action cannot be undone.`;
                    
                    // Store the ID for the delete confirmation
                    document.getElementById('confirm-delete').setAttribute('data-id', id);
                    document.getElementById('confirm-delete').setAttribute('data-type', 'specialization');
                });
            });

            // Confirm delete
            const confirmDeleteBtn = document.getElementById('confirm-delete');
            
            confirmDeleteBtn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const type = this.getAttribute('data-type');
                
                // In a real application, you would send a request to the server to delete the item
                // For this example, we'll just remove the row from the table
                if (type === 'appointment-type') {
                    const row = document.querySelector(`#appointment-types-section .delete-btn[data-id="${id}"]`).closest('tr');
                    row.remove();
                } else if (type === 'specialization') {
                    const row = document.querySelector(`#doctor-specializations-section .delete-btn[data-id="${id}"]`).closest('tr');
                    row.remove();
                }
                
                document.getElementById('delete-confirmation-modal').classList.remove('show');
            });

            // Save appointment type
            const saveAppointmentTypeBtn = document.getElementById('save-appointment-type');
            
            saveAppointmentTypeBtn.addEventListener('click', function() {
                const form = document.getElementById('appointment-type-form');
                
                // Basic form validation
                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }
                
                const id = document.getElementById('appointment-type-id').value;
                const name = document.getElementById('appointment-type-name').value;
                const duration = document.getElementById('appointment-type-duration').value;
                const price = document.getElementById('appointment-type-price').value;
                const description = document.getElementById('appointment-type-description').value;
                const status = document.getElementById('appointment-type-status').value;
                
                // In a real application, you would send a request to the server to save the data
                // For this example, we'll just update the table if it's an edit, or add a new row if it's an add
                if (id) {
                    // Edit existing appointment type
                    const row = document.querySelector(`#appointment-types-section .edit-btn[data-id="${id}"]`).closest('tr');
                    row.cells[0].textContent = name;
                    row.cells[1].textContent = `${duration} minutes`;
                    row.cells[2].textContent = `$${price}`;
                    row.cells[3].textContent = description;
                    row.cells[4].innerHTML = `<span class="badge badge-${status === 'active' ? 'success' : 'warning'}">${status.charAt(0).toUpperCase() + status.slice(1)}</span>`;
                } else {
                    // Add new appointment type
                    const table = document.querySelector('#appointment-types-section .data-table tbody');
                    const newRow = table.insertRow();
                    
                    // Generate a new ID (in a real application, this would come from the server)
                    const newId = Math.floor(Math.random() * 1000);
                    
                    newRow.innerHTML = `
                        <td>${name}</td>
                        <td>${duration} minutes</td>
                        <td>$${price}</td>
                        <td>${description}</td>
                        <td><span class="badge badge-${status === 'active' ? 'success' : 'warning'}">${status.charAt(0).toUpperCase() + status.slice(1)}</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-icon edit-btn" data-id="${newId}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-icon delete-btn" data-id="${newId}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    `;
                    
                    // Add event listeners to the new buttons
                    const newEditBtn = newRow.querySelector('.edit-btn');
                    const newDeleteBtn = newRow.querySelector('.delete-btn');
                    
                    newEditBtn.addEventListener('click', function() {
                        // Same as the edit functionality above
                        const id = this.getAttribute('data-id');
                        document.getElementById('appointment-type-modal').classList.add('show');
                        document.getElementById('appointment-type-modal-title').textContent = 'Edit Appointment Type';
                        
                        document.getElementById('appointment-type-id').value = id;
                        
                        const row = this.closest('tr');
                        const name = row.cells[0].textContent;
                        const duration = row.cells[1].textContent.split(' ')[0];
                        const price = row.cells[2].textContent.substring(1);
                        const description = row.cells[3].textContent;
                        const status = row.cells[4].querySelector('.badge').textContent.toLowerCase();
                        
                        document.getElementById('appointment-type-name').value = name;
                        document.getElementById('appointment-type-duration').value = duration;
                        document.getElementById('appointment-type-price').value = price;
                        document.getElementById('appointment-type-description').value = description;
                        document.getElementById('appointment-type-status').value = status;
                    });
                    
                    newDeleteBtn.addEventListener('click', function() {
                        // Same as the delete functionality above
                        const id = this.getAttribute('data-id');
                        const row = this.closest('tr');
                        const name = row.cells[0].textContent;
                        
                        document.getElementById('delete-confirmation-modal').classList.add('show');
                        document.getElementById('delete-confirmation-message').textContent = `Are you sure you want to delete the appointment type "${name}"? This action cannot be undone.`;
                        
                        document.getElementById('confirm-delete').setAttribute('data-id', id);
                        document.getElementById('confirm-delete').setAttribute('data-type', 'appointment-type');
                    });
                }
                
                document.getElementById('appointment-type-modal').classList.remove('show');
            });

            // Save specialization
            const saveSpecializationBtn = document.getElementById('save-specialization');
            
            saveSpecializationBtn.addEventListener('click', function() {
                const form = document.getElementById('specialization-form');
                
                // Basic form validation
                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }
                
                const id = document.getElementById('specialization-id').value;
                const name = document.getElementById('specialization-name').value;
                const department = document.getElementById('specialization-department').value;
                const description = document.getElementById('specialization-description').value;
                const status = document.getElementById('specialization-status').value;
                
                // In a real application, you would send a request to the server to save the data
                // For this example, we'll just update the table if it's an edit, or add a new row if it's an add
                if (id) {
                    // Edit existing specialization
                    const row = document.querySelector(`#doctor-specializations-section .edit-btn[data-id="${id}"]`).closest('tr');
                    row.cells[0].textContent = name;
                    row.cells[1].textContent = department;
                    // Don't update the doctors count
                    row.cells[3].textContent = description;
                    row.cells[4].innerHTML = `<span class="badge badge-${status === 'active' ? 'success' : 'warning'}">${status.charAt(0).toUpperCase() + status.slice(1)}</span>`;
                } else {
                    // Add new specialization
                    const table = document.querySelector('#doctor-specializations-section .data-table tbody');
                    const newRow = table.insertRow();
                    
                    // Generate a new ID (in a real application, this would come from the server)
                    const newId = Math.floor(Math.random() * 1000);
                    
                    newRow.innerHTML = `
                        <td>${name}</td>
                        <td>${department}</td>
                        <td>0</td>
                        <td>${description}</td>
                        <td><span class="badge badge-${status === 'active' ? 'success' : 'warning'}">${status.charAt(0).toUpperCase() + status.slice(1)}</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-icon edit-btn" data-id="${newId}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-icon delete-btn" data-id="${newId}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    `;
                    
                    // Add event listeners to the new buttons
                    const newEditBtn = newRow.querySelector('.edit-btn');
                    const newDeleteBtn = newRow.querySelector('.delete-btn');
                    
                    newEditBtn.addEventListener('click', function() {
                        // Same as the edit functionality above
                        const id = this.getAttribute('data-id');
                        document.getElementById('specialization-modal').classList.add('show');
                        document.getElementById('specialization-modal-title').textContent = 'Edit Specialization';
                        
                        document.getElementById('specialization-id').value = id;
                        
                        const row = this.closest('tr');
                        const name = row.cells[0].textContent;
                        const department = row.cells[1].textContent;
                        const description = row.cells[3].textContent;
                        const status = row.cells[4].querySelector('.badge').textContent.toLowerCase();
                        
                        document.getElementById('specialization-name').value = name;
                        document.getElementById('specialization-department').value = department;
                        document.getElementById('specialization-description').value = description;
                        document.getElementById('specialization-status').value = status;
                    });
                    
                    newDeleteBtn.addEventListener('click', function() {
                        // Same as the delete functionality above
                        const id = this.getAttribute('data-id');
                        const row = this.closest('tr');
                        const name = row.cells[0].textContent;
                        
                        document.getElementById('delete-confirmation-modal').classList.add('show');
                        document.getElementById('delete-confirmation-message').textContent = `Are you sure you want to delete the specialization "${name}"? This action cannot be undone.`;
                        
                        document.getElementById('confirm-delete').setAttribute('data-id', id);
                        document.getElementById('confirm-delete').setAttribute('data-type', 'specialization');
                    });
                }
                
                document.getElementById('specialization-modal').classList.remove('show');
            });
        });
    </script>
</body>
</html>
