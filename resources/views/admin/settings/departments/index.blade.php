<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departments | Admin Settings | Medical Clinic</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin-styles.css') }}">
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
                <!-- Doctor Departments Section -->
                <div class="settings-section" id="doctor-departments-section">
                    <div class="settings-header">
                        <h1>Doctor Departments</h1>
                        <p>Manage medical departments in the clinic</p>
                        <a href="{{ route('admin.settings.departments.create')}}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Department
                        </a>
                    </div>

                    <!-- Search and Filter -->
                    <div class="filters-container">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Search departments...">
                        </div>
                        <select class="filter-select">
                            <option value="all">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <!-- Departments Table -->
                    <div class="table-container">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Department Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($departments as $department)
                                    <tr>
                                        <td>{{ $department->department_name }}</td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="#" class="btn-icon edit-btn">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="#" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-icon delete-btn" onclick="return confirm('Are you sure?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
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
            </main>
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
                <p id="delete-confirmation-message">Are you sure you want to delete this department? This action cannot be undone.</p>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>Warning: Deleting a department will also affect all associated specializations and doctor assignments.</span>
                </div>
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

            // Delete department
            const deleteBtns = document.querySelectorAll('.delete-btn');
            
            deleteBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const row = this.closest('tr');
                    const name = row.cells[0].textContent;
                    
                    document.getElementById('delete-confirmation-modal').classList.add('show');
                    document.getElementById('delete-confirmation-message').textContent = `Are you sure you want to delete the "${name}" department? This action cannot be undone.`;
                    
                    // Store the ID for the delete confirmation
                    document.getElementById('confirm-delete').setAttribute('data-id', id);
                });
            });

            // Close modal
            const closeButtons = document.querySelectorAll('.close-modal');
            
            closeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    document.querySelectorAll('.modal').forEach(modal => {
                        modal.classList.remove('show');
                    });
                });
            });

            // Cancel delete
            document.getElementById('cancel-delete').addEventListener('click', function() {
                document.getElementById('delete-confirmation-modal').classList.remove('show');
            });

            // Confirm delete
            document.getElementById('confirm-delete').addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                
                // In a real application, you would send a request to the server to delete the department
                // For this example, we'll just remove the row from the table
                const row = document.querySelector(`.delete-btn[data-id="${id}"]`).closest('tr');
                row.remove();
                
                document.getElementById('delete-confirmation-modal').classList.remove('show');
            });

            // Close modal when clicking outside
            window.addEventListener('click', function(e) {
                document.querySelectorAll('.modal').forEach(modal => {
                    if (e.target === modal) {
                        modal.classList.remove('show');
                    }
                });
            });
        });
    </script>
</body>
</html>
