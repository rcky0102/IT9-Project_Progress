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
                    <a href="{{ route('dashboard') }}" class="sidebar-item">
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
                    <a href="{{ route('admin.settings.appointment_types.index')}}" class="settings-nav-item">
                        <i class="fas fa-list-alt"></i>
                        <span>Appointment Types</span>
                    </a>
                    <a href="{{ route('admin.settings.departments.index')}}" class="settings-nav-item">
                        <i class="fas fa-building"></i>
                        <span>Doctor Departments</span>
                    </a>
                    <a href="{{ route('admin.settings.specializations.index')}}" class="settings-nav-item">
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
        </div>
    </div>        
</body>
</html>
