@extends('admin.layout')

@section('title', 'Admin Dashboard | Medical Clinic')

@section('content')

            <!-- Main Content -->
            <main class="main-content">
                <!-- Welcome Card -->
                <div class="welcome-card">
                    <h1>Welcome, {{ Auth::user()->first_name }}!</h1>
                    <p>This is your admin dashboard. Here you can manage users, appointments, billing, and more.</p>
                    <a href="{{ route('admin.reports.index') }}" class="btn btn-primary">
                        <i class="fas fa-download"></i>
                        Generate Reports
                    </a>
                </div>

                <!-- Stats Cards -->
                <div class="dashboard-cards">
                    <div class="stats-card">
                        <div class="stats-header">
                            <div class="stats-title">Total Patients</div>
                            <div class="stats-icon patients">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="stats-value">1,248</div>
                        <div class="stats-change positive">
                            <i class="fas fa-arrow-up"></i> 12% from last month
                        </div>
                    </div>

                    <div class="stats-card">
                        <div class="stats-header">
                            <div class="stats-title">Active Doctors</div>
                            <div class="stats-icon doctors">
                                <i class="fas fa-user-md"></i>
                            </div>
                        </div>
                        <div class="stats-value">32</div>
                        <div class="stats-change positive">
                            <i class="fas fa-arrow-up"></i> 3 new this month
                        </div>
                    </div>

                    <div class="stats-card">
                        <div class="stats-header">
                            <div class="stats-title">Appointments</div>
                            <div class="stats-icon appointments">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                        </div>
                        <div class="stats-value">156</div>
                        <div class="stats-change positive">
                            <i class="fas fa-arrow-up"></i> 8% from last week
                        </div>
                    </div>

                    <div class="stats-card">
                        <div class="stats-header">
                            <div class="stats-title">Monthly Revenue</div>
                            <div class="stats-icon revenue">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                        </div>
                        <div class="stats-value">$45,289</div>
                        <div class="stats-change positive">
                            <i class="fas fa-arrow-up"></i> 15% from last month
                        </div>
                    </div>
                </div>

                <!-- Charts -->
                <div class="chart-container">
                    <div class="chart-header">
                        <h3 class="chart-title">Appointment Statistics</h3>
                        <div class="chart-actions">
                            <button class="btn btn-outline">
                                <i class="fas fa-calendar"></i> Monthly
                            </button>
                            <button class="btn btn-outline">
                                <i class="fas fa-download"></i> Export
                            </button>
                        </div>
                    </div>
                    <div class="chart-placeholder">
                        <p>Appointment trend chart would be displayed here</p>
                    </div>
                </div>

                <!-- Recent Users -->
                <div class="page-header-with-actions">
                    <div>
                        <h3 class="chart-title">Recent Users</h3>
                        <p class="text-muted">Manage all users in the system</p>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New User
                    </a>
                </div>

                <div class="tabs">
                    <div class="tab active">All Users</div>
                    <div class="tab">Patients</div>
                    <div class="tab">Doctors</div>
                    <div class="tab">Staff</div>
                </div>

                <div class="filters-container">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search users...">
                    </div>
                    <select class="filter-select">
                        <option value="all">All Roles</option>
                        <option value="patient">Patients</option>
                        <option value="doctor">Doctors</option>
                        <option value="admin">Administrators</option>
                        <option value="staff">Staff</option>
                    </select>
                    <button class="btn btn-outline">
                        <i class="fas fa-filter"></i> More Filters
                    </button>
                </div>

                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Contact</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Joined</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar">
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
                                <td>
                                    <span class="badge badge-outline">Patient</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>Mar 15, 2025</td>
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
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-envelope"></i> Send Message
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item text-danger">
                                                <i class="fas fa-ban"></i> Deactivate
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar">
                                            <span class="avatar-fallback">MC</span>
                                        </div>
                                        <div>Dr. Michael Chen</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="contact-cell">
                                        <div>michael.chen@example.com</div>
                                        <div class="text-muted">+1 (555) 234-5678</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-outline">Doctor</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>Jan 10, 2025</td>
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
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-envelope"></i> Send Message
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item text-danger">
                                                <i class="fas fa-ban"></i> Deactivate
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Recent Activity -->
                <div class="page-header-with-actions">
                    <div>
                        <h3 class="chart-title">Recent Activity</h3>
                        <p class="text-muted">Latest actions in the system</p>
                    </div>
                    <button class="btn btn-outline">
                        <i class="fas fa-history"></i> View All Activity
                    </button>
                </div>

                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="activity-details">
                            <div class="activity-title">New patient registered: Emma Wilson</div>
                            <div class="activity-time">Today, 10:30 AM</div>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="activity-details">
                            <div class="activity-title">Appointment confirmed: Dr. Michael Chen with James Brown</div>
                            <div class="activity-time">Today, 9:15 AM</div>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <div class="activity-details">
                            <div class="activity-title">Payment received: $150 from Olivia Martinez</div>
                            <div class="activity-time">Yesterday, 3:45 PM</div>
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
            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>

@endsection