<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard | Medical Clinic</title>
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

        /* Upcoming Appointments */
        .appointments-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .appointment-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background-color: white;
            border-radius: var(--border-radius-sm);
            box-shadow: var(--shadow);
        }

        .appointment-date {
            width: 60px;
            height: 60px;
            background-color: var(--primary);
            color: white;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .appointment-date-day {
            font-size: 20px;
        }

        .appointment-date-month {
            font-size: 12px;
            text-transform: uppercase;
        }

        .appointment-details {
            flex: 1;
        }

        .appointment-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .appointment-info {
            color: var(--text-light);
            font-size: 14px;
            display: flex;
            gap: 15px;
        }

        .appointment-info span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .appointment-actions {
            display: flex;
            gap: 10px;
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

        /* Patient List */
        .patient-list {
            margin-top: 30px;
        }

        .patient-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .patient-title {
            font-size: 20px;
            color: var(--primary);
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

        .patient-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .patient-avatar {
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

        .badge-outline-blue {
            border: 1px solid var(--info);
            color: var(--info);
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

        .guide-text {
            max-width: 800px;
            margin-top: 10px;
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.5;
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

            .appointment-info {
                flex-direction: column;
                gap: 5px;
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
            <a href="{{ route('doctor.dashboard') }}" class="logo">MediCare Clinic</a>
            <div class="header-actions">
                <button class="btn-icon notification-btn">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </button>
                <div class="dropdown">
                    <button class="avatar-btn">
                        <div class="avatar">
                            <img src="/placeholder.svg?height=40&width=40" alt="Dr. {{ Auth::user()->first_name }}">
                            <span class="avatar-fallback">{{ substr(Auth::user()->first_name, 0, 1) }}{{ substr(Auth::user()->last_name, 0, 1) }}</span>
                        </div>
                    </button>
                    <div class="dropdown-menu">
                        <div class="dropdown-header">
                            <p class="user-name">Dr. {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                            <p class="user-email">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item"><i class="fas fa-user"></i> Profile</a>
                        <a href="#" class="dropdown-item"><i class="fas fa-cog"></i> Settings</a>
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
                    <a href="{{ route('doctor.dashboard') }}" class="sidebar-item active">
                        <i class="fas fa-chart-line"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('doctor.appointments') }}" class="sidebar-item">
                        <i class="fas fa-calendar"></i>
                        <span>Appointments</span>
                    </a>
                    <a href="{{ route('doctor.patients') }}" class="sidebar-item">
                        <i class="fas fa-user"></i>
                        <span>Patients</span>
                    </a>
                    <a href="#" class="sidebar-item">
                        <i class="fas fa-file-medical"></i>
                        <span>Medical Records</span>
                    </a>
                    <a href="#" class="sidebar-item">
                        <i class="fas fa-pills"></i>
                        <span>Prescriptions</span>
                    </a>
                    <a href="{{ route('doctor.schedules') }}" class="sidebar-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Schedule</span>
                    </a>
                </nav>
            </aside>

            <!-- Main Content -->
            <main class="main-content">
                <!-- Welcome Card -->
                <div class="welcome-card">
                    <h1>Welcome, Dr. {{ Auth::user()->first_name }}!</h1>
                    <p>This is your doctor dashboard. Here you can manage your appointments, view patient records, and more.</p>
                    <button class="btn btn-primary">
                        <i class="fas fa-calendar-plus"></i>
                        View Today's Schedule
                    </button>
                </div>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Today's Appointments</h3>
                            <div class="card-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">8</div>
                            <div class="card-label">Scheduled for today</div>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="card-link">
                                View All <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Patients</h3>
                            <div class="card-icon">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">45</div>
                            <div class="card-label">Total patients</div>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="card-link">
                                View All <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Pending Reports</h3>
                            <div class="card-icon">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">3</div>
                            <div class="card-label">Reports to complete</div>
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
                    <h3 class="records-title">Today's Appointments</h3>
                    
                    <div class="appointment-item">
                        <div class="appointment-date">
                            <div class="appointment-date-day">10</div>
                            <div class="appointment-date-month">AM</div>
                        </div>
                        <div class="appointment-details">
                            <div class="appointment-title">Emma Wilson - General Checkup</div>
                            <div class="appointment-info">
                                <span><i class="fas fa-clock"></i> 10:00 AM - 10:30 AM</span>
                                <span><i class="fas fa-phone"></i> +1 (555) 123-4567</span>
                            </div>
                        </div>
                        <div class="appointment-actions">
                            <button class="btn btn-outline">View Details</button>
                        </div>
                    </div>

                    <div class="appointment-item">
                        <div class="appointment-date">
                            <div class="appointment-date-day">11</div>
                            <div class="appointment-date-month">AM</div>
                        </div>
                        <div class="appointment-details">
                            <div class="appointment-title">James Brown - Follow-up Consultation</div>
                            <div class="appointment-info">
                                <span><i class="fas fa-clock"></i> 11:00 AM - 11:30 AM</span>
                                <span><i class="fas fa-phone"></i> +1 (555) 234-5678</span>
                            </div>
                        </div>
                        <div class="appointment-actions">
                            <button class="btn btn-outline">View Details</button>
                        </div>
                    </div>

                    <div class="appointment-item">
                        <div class="appointment-date">
                            <div class="appointment-date-day">2</div>
                            <div class="appointment-date-month">PM</div>
                        </div>
                        <div class="appointment-details">
                            <div class="appointment-title">Olivia Martinez - Blood Pressure Check</div>
                            <div class="appointment-info">
                                <span><i class="fas fa-clock"></i> 2:00 PM - 2:30 PM</span>
                                <span><i class="fas fa-phone"></i> +1 (555) 345-6789</span>
                            </div>
                        </div>
                        <div class="appointment-actions">
                            <button class="btn btn-outline">View Details</button>
                        </div>
                    </div>
                </div>

                <!-- Recent Patients -->
                <div class="patient-list">
                    <div class="patient-header">
                        <h3 class="patient-title">Recent Patients</h3>
                        <a href="#" class="btn btn-outline">View All Patients</a>
                    </div>

                    <div class="table-container">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Patient</th>
                                    <th>Contact</th>
                                    <th>Last Visit</th>
                                    <th>Diagnosis</th>
                                    <th>Next Appointment</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="patient-cell">
                                            <div class="patient-avatar">
                                                <img src="/placeholder.svg?height=40&width=40" alt="Emma Wilson">
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
                                    <td>Mar 15, 2025</td>
                                    <td>
                                        <span class="badge badge-outline">Hypertension</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-outline-blue">Mar 24, 2025</span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn-icon">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="#" class="dropdown-item">
                                                    <i class="fas fa-file-alt"></i> View Records
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="fas fa-calendar-plus"></i> Schedule Appointment
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="fas fa-prescription"></i> Prescribe Medication
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="fas fa-phone"></i> Call Patient
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="patient-cell">
                                            <div class="patient-avatar">
                                                <img src="/placeholder.svg?height=40&width=40" alt="James Brown">
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
                                    <td>Mar 10, 2025</td>
                                    <td>
                                        <span class="badge badge-outline">Diabetes</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-outline-blue">Mar 24, 2025</span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn-icon">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="#" class="dropdown-item">
                                                    <i class="fas fa-file-alt"></i> View Records
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="fas fa-calendar-plus"></i> Schedule Appointment
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="fas fa-prescription"></i> Prescribe Medication
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="fas fa-phone"></i> Call Patient
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="patient-cell">
                                            <div class="patient-avatar">
                                                <img src="/placeholder.svg?height=40&width=40" alt="Olivia Martinez">
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
                                    <td>Mar 5, 2025</td>
                                    <td>
                                        <span class="badge badge-outline">Asthma</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-outline-blue">Mar 19, 2025</span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn-icon">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="#" class="dropdown-item">
                                                    <i class="fas fa-file-alt"></i> View Records
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="fas fa-calendar-plus"></i> Schedule Appointment
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="fas fa-prescription"></i> Prescribe Medication
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="fas fa-phone"></i> Call Patient
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
        });
    </script>
</body>
</html>
