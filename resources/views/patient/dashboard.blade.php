<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard | Medical Clinic</title>
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

        /* Medical Records */
        .medical-records {
            margin-top: 30px;
        }

        .records-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .records-title {
            font-size: 20px;
            color: var(--primary);
        }

        .records-tabs {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .records-tab {
            padding: 10px 20px;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .records-tab.active {
            background-color: var(--primary);
            color: white;
        }

        .records-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .record-item {
            background-color: white;
            border-radius: var(--border-radius-sm);
            padding: 20px;
            box-shadow: var(--shadow);
        }

        .record-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .record-title {
            font-weight: bold;
            color: var(--primary);
        }

        .record-date {
            color: var(--text-light);
            font-size: 14px;
        }

        .record-content {
            margin-bottom: 15px;
        }

        .record-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .record-doctor {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .doctor-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
        }

        .doctor-name {
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

            .records-list {
                grid-template-columns: 1fr;
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
        }
    </style>
</head>
<body>
    <div class="app-container">
        <!-- Header -->
        <header class="dashboard-header">
            <a href="{{ route('patient.dashboard') }}" class="logo">MediCare Clinic</a>
            <div class="header-actions">
                <button class="btn-icon notification-btn">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </button>
                <div class="dropdown">
                    <button class="avatar-btn">
                        <div class="avatar">
                            <img src="/placeholder.svg?height=40&width=40" alt="{{ Auth::user()->first_name }}">
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
                    <a href="{{ route('patient.dashboard') }}" class="sidebar-item active">
                        <i class="fas fa-chart-line"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="#" class="sidebar-item">
                        <i class="fas fa-calendar"></i>
                        <span>Appointments</span>
                    </a>
                    <a href="#" class="sidebar-item">
                        <i class="fas fa-file-medical"></i>
                        <span>Medical Records</span>
                    </a>
                    <a href="#" class="sidebar-item">
                        <i class="fas fa-pills"></i>
                        <span>Medications</span>
                    </a>
                    <a href="#" class="sidebar-item">
                        <i class="fas fa-credit-card"></i>
                        <span>Payments</span>
                    </a>
                    <a href="#" class="sidebar-item">
                        <i class="fas fa-envelope"></i>
                        <span>Messages</span>
                    </a>
                </nav>
            </aside>

            <!-- Main Content -->
            <main class="main-content">
                <!-- Welcome Card -->
                <div class="welcome-card">
                    <h1>Welcome, {{ Auth::user()->first_name }}!</h1>
                    <p>This is your patient dashboard. Here you can manage your appointments, view your medical records, and more.</p>
                    <button class="btn btn-primary">
                        <i class="fas fa-calendar-plus"></i>
                        Schedule New Appointment
                    </button>
                </div>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Upcoming Appointments</h3>
                            <div class="card-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">2</div>
                            <div class="card-label">Scheduled appointments</div>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="card-link">
                                View All <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Medical Records</h3>
                            <div class="card-icon">
                                <i class="fas fa-file-medical"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">8</div>
                            <div class="card-label">Total records</div>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="card-link">
                                View All <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Payments</h3>
                            <div class="card-icon">
                                <i class="fas fa-credit-card"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">$120</div>
                            <div class="card-label">Outstanding balance</div>
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
                    <h3 class="records-title">Upcoming Appointments</h3>
                    
                    <div class="appointment-item">
                        <div class="appointment-date">
                            <div class="appointment-date-day">24</div>
                            <div class="appointment-date-month">Mar</div>
                        </div>
                        <div class="appointment-details">
                            <div class="appointment-title">General Checkup</div>
                            <div class="appointment-info">
                                <span><i class="fas fa-clock"></i> 10:00 AM</span>
                                <span><i class="fas fa-user-md"></i> Dr. Sarah Johnson</span>
                            </div>
                        </div>
                        <div class="appointment-actions">
                            <button class="btn btn-outline">Reschedule</button>
                        </div>
                    </div>

                    <div class="appointment-item">
                        <div class="appointment-date">
                            <div class="appointment-date-day">30</div>
                            <div class="appointment-date-month">Mar</div>
                        </div>
                        <div class="appointment-details">
                            <div class="appointment-title">Follow-up Consultation</div>
                            <div class="appointment-info">
                                <span><i class="fas fa-clock"></i> 2:30 PM</span>
                                <span><i class="fas fa-user-md"></i> Dr. Michael Chen</span>
                            </div>
                        </div>
                        <div class="appointment-actions">
                            <button class="btn btn-outline">Reschedule</button>
                        </div>
                    </div>
                </div>

                <!-- Recent Medical Records -->
                <div class="medical-records">
                    <div class="records-header">
                        <h3 class="records-title">Recent Medical Records</h3>
                        <a href="#" class="btn btn-outline">View All Records</a>
                    </div>

                    <div class="records-tabs">
                        <div class="records-tab active">All</div>
                        <div class="records-tab">Consultations</div>
                        <div class="records-tab">Lab Results</div>
                        <div class="records-tab">Prescriptions</div>
                    </div>

                    <div class="records-list">
                        <div class="record-item">
                            <div class="record-header">
                                <div class="record-title">General Checkup</div>
                                <div class="record-date">Mar 15, 2025</div>
                            </div>
                            <div class="record-content">
                                <p>Regular health checkup. Blood pressure normal. Recommended annual screening tests based on age and risk factors.</p>
                            </div>
                            <div class="record-footer">
                                <div class="record-doctor">
                                    <div class="doctor-avatar">SJ</div>
                                    <div class="doctor-name">Dr. Sarah Johnson</div>
                                </div>
                                <a href="#" class="card-link">View <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>

                        <div class="record-item">
                            <div class="record-header">
                                <div class="record-title">Blood Test Results</div>
                                <div class="record-date">Feb 28, 2025</div>
                            </div>
                            <div class="record-content">
                                <p>Complete blood count and metabolic panel. All results within normal range. No significant findings.</p>
                            </div>
                            <div class="record-footer">
                                <div class="record-doctor">
                                    <div class="doctor-avatar">MC</div>
                                    <div class="doctor-name">Dr. Michael Chen</div>
                                </div>
                                <a href="#" class="card-link">View <i class="fas fa-arrow-right"></i></a>
                            </div>
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
            const tabs = document.querySelectorAll('.records-tab');
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
