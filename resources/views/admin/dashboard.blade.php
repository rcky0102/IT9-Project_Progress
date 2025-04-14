<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Medical Clinic</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        :root {
            --primary: #004258;
            --primary-light: #5a7d8c;
            --primary-dark: #00354a;
            --accent: rgba(90, 125, 140, 0.7);
            --text: #333;
            --text-light: #777;
            --danger: #e74c3c;
            --success: #2ecc71;
            --warning: #f39c12;
            --info: #3498db;
            --border-radius: 24px;
            --border-radius-sm: 12px;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        body {
            background-color: #f5f5f5;
            color: var(--text);
            min-height: 100vh;
        }

        .app-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header Styles */
        .dashboard-header {
            background-color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo {
            color: var(--primary);
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .btn-icon {
            background: none;
            border: none;
            cursor: pointer;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            position: relative;
            transition: background-color 0.2s;
        }

        .btn-icon:hover {
            background-color: rgba(0, 66, 88, 0.1);
        }

        .notification-badge {
            position: absolute;
            top: 0;
            right: 0;
            background-color: var(--danger);
            color: white;
            font-size: 12px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .avatar-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            position: relative;
            overflow: hidden;
            border: 2px solid white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-fallback {
            font-size: 16px;
        }

        /* Main Container */
        .main-container {
            display: flex;
            flex: 1;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: white;
            box-shadow: var(--shadow);
            padding: 20px 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: calc(100vh - 70px);
            position: sticky;
            top: 70px;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .sidebar-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: var(--text);
            text-decoration: none;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .sidebar-item:hover {
            background-color: rgba(0, 66, 88, 0.05);
        }

        .sidebar-item.active {
            background-color: rgba(0, 66, 88, 0.1);
            color: var(--primary);
            border-left-color: var(--primary);
            font-weight: bold;
        }

        .sidebar-item i {
            width: 20px;
            text-align: center;
        }

        .text-danger {
            color: var(--danger);
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        .welcome-card {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 30px;
            box-shadow: var(--shadow);
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .welcome-card::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            width: 150px;
            height: 150px;
            background-color: var(--primary-light);
            opacity: 0.1;
            border-radius: 50%;
            transform: translate(50%, -50%);
        }

        .welcome-card h1 {
            color: var(--primary);
            margin-bottom: 10px;
            font-size: 28px;
        }

        .welcome-card p {
            color: var(--text-light);
            margin-bottom: 20px;
            font-size: 16px;
        }

        /* Dashboard Cards */
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background-color: white;
            border-radius: var(--border-radius-sm);
            padding: 20px;
            box-shadow: var(--shadow);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .card-title {
            font-size: 18px;
            color: var(--primary);
        }

        .card-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(0, 66, 88, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
        }

        .card-content {
            margin-bottom: 15px;
        }

        .card-value {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .card-label {
            color: var(--text-light);
            font-size: 14px;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        .card-link {
            color: var(--primary);
            text-decoration: none;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .card-link:hover {
            text-decoration: underline;
        }

        /* Buttons */
        .btn {
            padding: 10px 20px;
            border-radius: 50px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }

        .btn-outline {
            background-color: transparent;
            color: var(--primary);
            border: 1px solid var(--primary);
        }

        .btn-outline:hover {
            background-color: rgba(0, 66, 88, 0.05);
        }

        /* Dropdown Menu */
        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: white;
            border-radius: var(--border-radius-sm);
            box-shadow: var(--shadow);
            min-width: 200px;
            z-index: 100;
            display: none;
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-header {
            padding: 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .user-name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .user-email {
            color: var(--text-light);
            font-size: 14px;
        }

        .dropdown-divider {
            height: 1px;
            background-color: rgba(0, 0, 0, 0.05);
            margin: 5px 0;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            color: var(--text);
            text-decoration: none;
            transition: background-color 0.2s;
        }

        .dropdown-item:hover {
            background-color: rgba(0, 66, 88, 0.05);
        }

        .dropdown-item i {
            width: 16px;
            text-align: center;
        }

        /* Table Styles */
        .table-container {
            background-color: white;
            border-radius: var(--border-radius-sm);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            background-color: rgba(0, 66, 88, 0.05);
            color: var(--primary);
            font-weight: bold;
            text-align: left;
            padding: 15px;
            font-size: 14px;
        }

        .data-table td {
            padding: 15px;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            vertical-align: middle;
        }

        .data-table tr:hover {
            background-color: rgba(0, 66, 88, 0.02);
        }

        .user-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            position: relative;
            overflow: hidden;
        }

        .contact-cell {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 10px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-outline {
            border: 1px solid var(--primary);
            color: var(--primary);
        }

        .badge-success {
            background-color: var(--success);
            color: white;
        }

        .badge-warning {
            background-color: var(--warning);
            color: white;
        }

        .badge-danger {
            background-color: var(--danger);
            color: white;
        }

        .badge-info {
            background-color: var(--info);
            color: white;
        }

        /* Search and Filters */
        .filters-container {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .search-box {
            flex: 1;
            min-width: 250px;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: none;
            border-radius: 50px;
            background-color: white;
            box-shadow: var(--shadow);
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .filter-select {
            padding: 10px 15px;
            border: none;
            border-radius: 50px;
            background-color: white;
            box-shadow: var(--shadow);
            min-width: 200px;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 16px;
            padding-right: 40px;
        }

        /* Page Header */
        .page-header-with-actions {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
        }

        .page-header-with-actions h1 {
            color: var(--primary);
            margin-bottom: 10px;
            font-size: 28px;
        }

        .text-muted {
            color: var(--text-light);
        }

        /* Stats Cards */
        .stats-card {
            background-color: white;
            border-radius: var(--border-radius-sm);
            padding: 20px;
            box-shadow: var(--shadow);
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .stats-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stats-title {
            font-size: 16px;
            color: var(--text-light);
        }

        .stats-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .stats-icon.patients {
            background-color: var(--primary);
        }

        .stats-icon.doctors {
            background-color: var(--info);
        }

        .stats-icon.appointments {
            background-color: var(--success);
        }

        .stats-icon.revenue {
            background-color: var(--warning);
        }

        .stats-value {
            font-size: 28px;
            font-weight: bold;
            color: var(--text);
        }

        .stats-change {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 14px;
        }

        .stats-change.positive {
            color: var(--success);
        }

        .stats-change.negative {
            color: var(--danger);
        }

        /* Charts */
        .chart-container {
            background-color: white;
            border-radius: var(--border-radius-sm);
            padding: 20px;
            box-shadow: var(--shadow);
            margin-bottom: 30px;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-title {
            font-size: 18px;
            color: var(--primary);
        }

        .chart-actions {
            display: flex;
            gap: 10px;
        }

        .chart-placeholder {
            width: 100%;
            height: 300px;
            background-color: rgba(0, 66, 88, 0.05);
            border-radius: var(--border-radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
        }

        /* Tabs */
        .tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding-bottom: 10px;
        }

        .tab {
            padding: 10px 20px;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.2s;
            font-weight: bold;
        }

        .tab.active {
            background-color: var(--primary);
            color: white;
        }

        /* Recent Activity */
        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .activity-item {
            display: flex;
            gap: 15px;
            padding: 15px;
            background-color: white;
            border-radius: var(--border-radius-sm);
            box-shadow: var(--shadow);
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .activity-details {
            flex: 1;
        }

        .activity-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .activity-time {
            color: var(--text-light);
            font-size: 14px;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .sidebar {
                width: 70px;
            }

            .sidebar-item span {
                display: none;
            }

            .sidebar-item {
                justify-content: center;
                padding: 15px;
            }

            .sidebar-item i {
                margin: 0;
            }

            .main-content {
                padding: 20px;
            }
        }

        @media (max-width: 768px) {
            .dashboard-cards {
                grid-template-columns: 1fr;
            }

            .page-header-with-actions {
                flex-direction: column;
                gap: 15px;
            }

            .page-header-with-actions .btn {
                align-self: flex-start;
            }
        }

        @media (max-width: 576px) {
            .dashboard-header {
                padding: 15px;
            }

            .logo {
                font-size: 20px;
            }

            .main-content {
                padding: 15px;
            }

            .welcome-card {
                padding: 20px;
            }

            .welcome-card h1 {
                font-size: 24px;
            }

            .filters-container {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="app-container">
        <!-- Header -->
        <header class="dashboard-header">
            <a href="{{ route('admin.dashboard') }}" class="logo">MediCare Clinic</a>
            <div class="header-actions">
                <button class="btn-icon notification-btn">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">5</span>
                </button>
                <div class="dropdown">
                    <button class="avatar-btn">
                        <div class="avatar">
                            <span class="avatar-fallback">{{ substr(Auth::user()->first_name, 0, 1) }}{{ substr(Auth::user()->last_name, 0, 1) }}</span>
                        </div>
                    </button>
                    <div class="dropdown-menu">
                        <div class="dropdown-header">
                            <p class="user-name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                            <p class="user-email">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item"><i class="fas fa-user"></i> Profile</a>
                        <a href="{{ route('admin.settings.index') }}" class="dropdown-item"><i class="fas fa-cog"></i> Settings</a>
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('logout') }}" method="POST" class="dropdown-item text-danger">
                            @csrf
                            <button type="submit" style="background: none; border: none; color: inherit; padding: 0; font: inherit; cursor: pointer; display: flex; align-items: center; gap: 10px; width: 100%; text-align: left;">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <div class="main-container">
            <!-- Sidebar -->
            <aside class="sidebar">
                <nav class="sidebar-nav">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-item active">
                        <i class="fas fa-chart-line"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="sidebar-item">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                    <a href="{{ route('admin.doctors.index') }}" class="sidebar-item">
                        <i class="fas fa-user-md"></i>
                        <span>Doctors</span>
                    </a>
                    <a href="{{ route('admin.appointments.index') }}" class="sidebar-item">
                        <i class="fas fa-calendar"></i>
                        <span>Appointments</span>
                    </a>
                    <a href="{{ route('admin.services.index') }}" class="sidebar-item">
                        <i class="fas fa-file-medical"></i>
                        <span>Services</span>
                    </a>
                    <a href="{{ route('admin.billing.index') }}" class="sidebar-item">
                        <i class="fas fa-credit-card"></i>
                        <span>Billing</span>
                    </a>
                    <a href="{{ route('admin.reports.index') }}" class="sidebar-item">
                        <i class="fas fa-chart-bar"></i>
                        <span>Reports</span>
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="sidebar-item">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </nav>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="sidebar-item text-danger" style="width: 100%; text-align: left; background: none; border: none; cursor: pointer;">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </aside>

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
</body>
</html>