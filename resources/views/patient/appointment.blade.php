<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments | Medical Clinic</title>
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

        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        /* Welcome Card */
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

        .btn-icon-sm {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--primary);
            color: var(--primary);
            background-color: transparent;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-icon-sm:hover {
            background-color: rgba(0, 66, 88, 0.05);
        }

        .btn-ghost {
            background-color: transparent;
            color: var(--text);
            border: none;
        }

        .btn-ghost:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        /* Tabs */
        .tabs {
            margin-bottom: 20px;
        }

        .tabs-list {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .tab-trigger {
            padding: 10px 20px;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.2s;
            background-color: transparent;
            border: none;
            font-weight: 500;
        }

        .tab-trigger.active {
            background-color: var(--primary);
            color: white;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Appointments List */
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
            border: 1px solid rgba(0, 0, 0, 0.05);
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

        .appointment-title-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 5px;
        }

        .appointment-title {
            font-weight: bold;
            color: var(--primary);
        }

        .appointment-badge {
            font-size: 12px;
            padding: 2px 8px;
            border-radius: 50px;
            font-weight: 500;
        }

        .badge-confirmed {
            background-color: rgba(46, 204, 113, 0.1);
            color: var(--success);
        }

        .badge-pending {
            background-color: rgba(243, 156, 18, 0.1);
            color: var(--warning);
        }

        .badge-cancelled {
            background-color: rgba(231, 76, 60, 0.1);
            color: var(--danger);
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
            min-width: 180px;
            z-index: 100;
            display: none;
            margin-top: 5px;
        }

        .dropdown-menu.show {
            display: block;
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

        /* Calendar View */
        .calendar-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        @media (min-width: 768px) {
            .calendar-container {
                grid-template-columns: 2fr 1fr;
            }
        }

        .calendar {
            background-color: white;
            border-radius: var(--border-radius-sm);
            padding: 20px;
            box-shadow: var(--shadow);
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .calendar-title {
            font-size: 18px;
            font-weight: bold;
            color: var(--primary);
        }

        .calendar-nav {
            display: flex;
            gap: 10px;
        }

        .calendar-nav-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--primary);
            color: var(--primary);
            background-color: transparent;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .calendar-nav-btn:hover {
            background-color: rgba(0, 66, 88, 0.05);
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
        }

        .calendar-weekday {
            text-align: center;
            font-weight: 500;
            color: var(--text-light);
            font-size: 14px;
            padding: 5px;
        }

        .calendar-day {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            cursor: pointer;
            position: relative;
            font-size: 14px;
        }

        .calendar-day:hover {
            background-color: rgba(0, 66, 88, 0.05);
        }

        .calendar-day.today {
            border: 1px solid var(--primary);
            font-weight: bold;
        }

        .calendar-day.selected {
            background-color: var(--primary);
            color: white;
            font-weight: bold;
        }

        .calendar-day.has-appointment {
            font-weight: bold;
            background-color: rgba(0, 66, 88, 0.1);
            color: var(--primary);
        }

        .calendar-day.other-month {
            color: var(--text-light);
            opacity: 0.5;
        }

        .day-appointments {
            background-color: white;
            border-radius: var(--border-radius-sm);
            padding: 20px;
            box-shadow: var(--shadow);
        }

        .day-appointments-title {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 15px;
            color: var(--primary);
        }

        .day-appointment-item {
            padding: 12px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .day-appointment-title {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .day-appointment-info {
            font-size: 14px;
            color: var(--text-light);
        }

        .no-appointments {
            text-align: center;
            padding: 30px 0;
            color: var(--text-light);
        }

        /* Header Actions */
        .tab-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
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

            .appointment-info {
                flex-direction: column;
                gap: 5px;
            }

            .appointment-actions .btn-outline {
                display: none;
            }

            .btn-icon-sm {
                display: none;
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
            position: relative;
        }

        /* App Container */
        .app-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Main Container */
        .main-container {
            display: flex;
            flex: 1;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        /* Welcome Card */
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
            font-size: 14px;
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
            color: var(--text);
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .btn-outline:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal {
            background-color: white;
            border-radius: var(--border-radius-sm);
            box-shadow: var(--shadow);
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            transform: translateY(20px);
            transition: transform 0.3s;
        }

        .modal-overlay.active .modal {
            transform: translateY(0);
        }

        .modal-header {
            padding: 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .modal-title {
            color: var(--primary);
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .modal-description {
            color: var(--text-light);
            font-size: 14px;
        }

        .modal-body {
            padding: 20px;
        }

        .modal-footer {
            padding: 15px 20px;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 14px;
            color: var(--text);
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(0, 66, 88, 0.1);
        }

        .form-select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            font-size: 14px;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
        }

        .form-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(0, 66, 88, 0.1);
        }

        .form-textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            font-size: 14px;
            min-height: 80px;
            resize: vertical;
            font-family: inherit;
        }

        .form-textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(0, 66, 88, 0.1);
        }

        /* Radio Buttons */
        .radio-group {
            display: flex;
            gap: 20px;
        }

        .radio-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .radio-input {
            appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid rgba(0, 0, 0, 0.2);
            border-radius: 50%;
            position: relative;
            cursor: pointer;
        }

        .radio-input:checked {
            border-color: var(--primary);
        }

        .radio-input:checked::after {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 10px;
            height: 10px;
            background-color: var(--primary);
            border-radius: 50%;
        }

        .radio-label {
            font-size: 14px;
            cursor: pointer;
        }

        /* Date Picker */
        .date-picker-wrapper {
            position: relative;
        }

        .date-picker-input {
            width: 100%;
            padding: 10px 12px;
            padding-right: 40px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
        }

        .date-picker-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            pointer-events: none;
        }

        /* Calendar Popup (simplified) */
        .calendar-popup {
            position: absolute;
            top: calc(100% + 5px);
            left: 0;
            background-color: white;
            border-radius: var(--border-radius-sm);
            box-shadow: var(--shadow);
            width: 300px;
            z-index: 10;
            display: none;
        }

        .calendar-popup.show {
            display: block;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .calendar-title {
            font-weight: 500;
            color: var(--primary);
        }

        .calendar-nav {
            display: flex;
            gap: 10px;
        }

        .calendar-nav-btn {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: none;
            cursor: pointer;
            color: var(--text);
            border-radius: 50%;
        }

        .calendar-nav-btn:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            padding: 10px;
        }

        .calendar-weekday {
            text-align: center;
            font-weight: 500;
            color: var(--text-light);
            font-size: 12px;
            padding: 5px;
        }

        .calendar-day {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            cursor: pointer;
            border-radius: 50%;
        }

        .calendar-day:hover {
            background-color: rgba(0, 66, 88, 0.05);
        }

        .calendar-day.today {
            border: 1px solid var(--primary);
            font-weight: bold;
        }

        .calendar-day.selected {
            background-color: var(--primary);
            color: white;
            font-weight: bold;
        }

        .calendar-day.disabled {
            color: var(--text-light);
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Responsive Styles */
        @media (max-width: 576px) {
            .modal {
                width: 95%;
            }

            .radio-group {
                flex-direction: column;
                gap: 10px;
            }

            .modal-footer {
                flex-direction: column;
            }

            .modal-footer .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="app-container">
        <!-- Header -->
        <header class="dashboard-header">
            <a href="#" class="logo">MediCare Clinic</a>
            <div class="header-actions">
                <button class="btn-icon notification-btn">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </button>
                <div class="dropdown">
                    <button class="avatar-btn">
                        <div class="avatar">
                            <img src="/placeholder.svg?height=40&width=40" alt="User">
                            <span class="avatar-fallback">JD</span>
                        </div>
                    </button>
                    <div class="dropdown-menu">
                        <div class="dropdown-header">
                            <p class="user-name">John Doe</p>
                            <p class="user-email">john.doe@example.com</p>
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
            <!-- Sidebar -->
            <aside class="sidebar">
                <nav class="sidebar-nav">
                    <a href="{{ route('patient.dashboard') }}" class="sidebar-item">
                        <i class="fas fa-chart-line"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="#" class="sidebar-item active">
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
                    <h1>Appointments</h1>
                    <p>Manage your upcoming appointments and schedule new ones.</p>
                    <button class="btn btn-primary" id="openModalBtn">
                        <i class="fas fa-plus"></i>
                        Schedule New Appointment
                    </button>
                </div>


                    <!-- Modal Overlay -->
    <div class="modal-overlay" id="appointmentModal">
        <div class="modal">
            <!-- Modal Header -->
            <div class="modal-header">
                <h2 class="modal-title">Schedule New Appointment</h2>
                <p class="modal-description">Fill in the details below to schedule your appointment with one of our healthcare providers.</p>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form id="appointmentForm">
                    <!-- Appointment Type -->
                    <div class="form-group">
                        <label for="appointmentType" class="form-label">Appointment Type</label>
                        <select id="appointmentType" class="form-select" required>
                            <option value="" selected disabled>Select appointment type</option>
                            <option value="general-checkup">General Checkup</option>
                            <option value="follow-up">Follow-up Consultation</option>
                            <option value="dental">Dental Cleaning</option>
                            <option value="specialist">Specialist Consultation</option>
                            <option value="vaccination">Vaccination</option>
                            <option value="physical-therapy">Physical Therapy</option>
                        </select>
                    </div>

                    <!-- Doctor Selection -->
                    <div class="form-group">
                        <label for="doctor" class="form-label">Select Doctor</label>
                        <select id="doctor" class="form-select" required>
                            <option value="" selected disabled>Choose a healthcare provider</option>
                            <option value="dr-johnson">Dr. Sarah Johnson - General Medicine</option>
                            <option value="dr-chen">Dr. Michael Chen - Cardiology</option>
                            <option value="dr-rodriguez">Dr. Emily Rodriguez - Dentistry</option>
                            <option value="dr-patel">Dr. Raj Patel - Pediatrics</option>
                            <option value="dr-williams">Dr. James Williams - Orthopedics</option>
                        </select>
                    </div>

                    <!-- Date Selection -->
                    <div class="form-group">
                        <label for="date" class="form-label">Appointment Date</label>
                        <div class="date-picker-wrapper">
                            <input type="text" id="date" class="date-picker-input" placeholder="Select a date" readonly required>
                            <i class="fas fa-calendar-alt date-picker-icon"></i>
                            
                            <!-- Calendar Popup (simplified) -->
                            <div class="calendar-popup" id="calendarPopup">
                                <div class="calendar-header">
                                    <span class="calendar-title">April 2025</span>
                                    <div class="calendar-nav">
                                        <button type="button" class="calendar-nav-btn">
                                            <i class="fas fa-chevron-left"></i>
                                        </button>
                                        <button type="button" class="calendar-nav-btn">
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="calendar-grid">
                                    <!-- Weekdays -->
                                    <div class="calendar-weekday">Sun</div>
                                    <div class="calendar-weekday">Mon</div>
                                    <div class="calendar-weekday">Tue</div>
                                    <div class="calendar-weekday">Wed</div>
                                    <div class="calendar-weekday">Thu</div>
                                    <div class="calendar-weekday">Fri</div>
                                    <div class="calendar-weekday">Sat</div>
                                    
                                    <!-- Days (simplified) -->
                                    <div class="calendar-day disabled">30</div>
                                    <div class="calendar-day disabled">31</div>
                                    <div class="calendar-day">1</div>
                                    <div class="calendar-day">2</div>
                                    <div class="calendar-day">3</div>
                                    <div class="calendar-day">4</div>
                                    <div class="calendar-day disabled">5</div>
                                    
                                    <div class="calendar-day disabled">6</div>
                                    <div class="calendar-day">7</div>
                                    <div class="calendar-day">8</div>
                                    <div class="calendar-day">9</div>
                                    <div class="calendar-day">10</div>
                                    <div class="calendar-day">11</div>
                                    <div class="calendar-day disabled">12</div>
                                    
                                    <div class="calendar-day disabled">13</div>
                                    <div class="calendar-day">14</div>
                                    <div class="calendar-day">15</div>
                                    <div class="calendar-day">16</div>
                                    <div class="calendar-day">17</div>
                                    <div class="calendar-day">18</div>
                                    <div class="calendar-day disabled">19</div>
                                    
                                    <div class="calendar-day disabled">20</div>
                                    <div class="calendar-day today">21</div>
                                    <div class="calendar-day">22</div>
                                    <div class="calendar-day">23</div>
                                    <div class="calendar-day selected">24</div>
                                    <div class="calendar-day">25</div>
                                    <div class="calendar-day disabled">26</div>
                                    
                                    <div class="calendar-day disabled">27</div>
                                    <div class="calendar-day">28</div>
                                    <div class="calendar-day">29</div>
                                    <div class="calendar-day">30</div>
                                    <div class="calendar-day">1</div>
                                    <div class="calendar-day">2</div>
                                    <div class="calendar-day disabled">3</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Time Selection -->
                    <div class="form-group">
                        <label for="time" class="form-label">Preferred Time</label>
                        <select id="time" class="form-select" required>
                            <option value="" selected disabled>Select a time slot</option>
                            <option value="9:00">9:00 AM</option>
                            <option value="9:30">9:30 AM</option>
                            <option value="10:00">10:00 AM</option>
                            <option value="10:30">10:30 AM</option>
                            <option value="11:00">11:00 AM</option>
                            <option value="11:30">11:30 AM</option>
                            <option value="1:00">1:00 PM</option>
                            <option value="1:30">1:30 PM</option>
                            <option value="2:00">2:00 PM</option>
                            <option value="2:30">2:30 PM</option>
                            <option value="3:00">3:00 PM</option>
                            <option value="3:30">3:30 PM</option>
                            <option value="4:00">4:00 PM</option>
                            <option value="4:30">4:30 PM</option>
                        </select>
                    </div>

                    <!-- Appointment Mode -->
                    <div class="form-group">
                        <label class="form-label">Appointment Mode</label>
                        <div class="radio-group">
                            <div class="radio-item">
                                <input type="radio" id="inPerson" name="appointmentMode" value="in-person" class="radio-input" checked>
                                <label for="inPerson" class="radio-label">In-Person</label>
                            </div>
                            <div class="radio-item">
                                <input type="radio" id="virtual" name="appointmentMode" value="virtual" class="radio-input">
                                <label for="virtual" class="radio-label">Virtual</label>
                            </div>
                        </div>
                    </div>

                    <!-- Insurance Information -->
                    <div class="form-group">
                        <label for="insurance" class="form-label">Insurance Provider</label>
                        <input type="text" id="insurance" class="form-control" placeholder="Enter your insurance provider">
                    </div>

                    <!-- Reason for Visit -->
                    <div class="form-group">
                        <label for="reason" class="form-label">Reason for Visit</label>
                        <textarea id="reason" class="form-textarea" placeholder="Please describe your symptoms or reason for the appointment" required></textarea>
                    </div>

                    <!-- Additional Notes -->
                    <div class="form-group">
                        <label for="notes" class="form-label">Additional Notes (Optional)</label>
                        <textarea id="notes" class="form-textarea" placeholder="Any additional information you'd like to share"></textarea>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" id="cancelBtn">Cancel</button>
                <button type="submit" class="btn btn-primary" id="scheduleBtn">Schedule Appointment</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Modal functionality
            const modal = document.getElementById('appointmentModal');
            const openModalBtn = document.getElementById('openModalBtn');
            const cancelBtn = document.getElementById('cancelBtn');
            const scheduleBtn = document.getElementById('scheduleBtn');
            const appointmentForm = document.getElementById('appointmentForm');

            // Date picker functionality
            const dateInput = document.getElementById('date');
            const calendarPopup = document.getElementById('calendarPopup');
            const calendarDays = document.querySelectorAll('.calendar-day:not(.disabled)');

            // Open modal
            openModalBtn.addEventListener('click', function() {
                modal.classList.add('active');
                document.body.style.overflow = 'hidden'; // Prevent scrolling
            });

            // Close modal
            function closeModal() {
                modal.classList.remove('active');
                document.body.style.overflow = ''; // Restore scrolling
            }

            cancelBtn.addEventListener('click', closeModal);

            // Close modal when clicking outside
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });

            // Handle form submission
            scheduleBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Check form validity
                const isValid = validateForm();
                
                if (isValid) {
                    // Here you would typically send the form data to your server
                    alert('Appointment scheduled successfully!');
                    closeModal();
                }
            });

            // Toggle calendar popup
            dateInput.addEventListener('click', function(e) {
                e.stopPropagation();
                calendarPopup.classList.toggle('show');
            });

            // Close calendar when clicking outside
            document.addEventListener('click', function(e) {
                if (!dateInput.contains(e.target) && !calendarPopup.contains(e.target)) {
                    calendarPopup.classList.remove('show');
                }
            });

            // Select date from calendar
            calendarDays.forEach(day => {
                day.addEventListener('click', function() {
                    // Remove selected class from all days
                    calendarDays.forEach(d => d.classList.remove('selected'));
                    
                    // Add selected class to clicked day
                    this.classList.add('selected');
                    
                    // Update input value
                    const month = 'April'; // This would be dynamic in a real implementation
                    const day = this.textContent;
                    const year = '2025'; // This would be dynamic in a real implementation
                    dateInput.value = `${month} ${day}, ${year}`;
                    
                    // Close calendar popup
                    calendarPopup.classList.remove('show');
                });
            });

            // Form validation
            function validateForm() {
                let isValid = true;
                const requiredFields = appointmentForm.querySelectorAll('[required]');
                
                requiredFields.forEach(field => {
                    if (!field.value) {
                        isValid = false;
                        field.classList.add('error');
                    } else {
                        field.classList.remove('error');
                    }
                });
                
                return isValid;
            }
        });
    </script>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Upcoming</h3>
                            <div class="card-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">3</div>
                            <div class="card-label">Scheduled appointments</div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Past</h3>
                            <div class="card-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">12</div>
                            <div class="card-label">Previous appointments</div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Doctors</h3>
                            <div class="card-icon">
                                <i class="fas fa-user-md"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">4</div>
                            <div class="card-label">Different specialists</div>
                        </div>
                    </div>
                </div>

                <!-- Appointments Tabs -->
                <div class="tabs">
                    <div class="tab-header">
                        <div class="tabs-list">
                            <button class="tab-trigger active" data-tab="list-view">List View</button>
                            <button class="tab-trigger" data-tab="calendar-view">Calendar View</button>
                        </div>
                        <button class="btn btn-outline">
                            <i class="fas fa-filter"></i>
                            Filter
                        </button>
                    </div>

                    <!-- List View Tab -->
                    <div id="list-view" class="tab-content active">
                        <div class="appointments-list">
                            <!-- Appointment Item 1 -->
                            <div class="appointment-item">
                                <div class="appointment-date">
                                    <div class="appointment-date-day">24</div>
                                    <div class="appointment-date-month">Mar</div>
                                </div>
                                <div class="appointment-details">
                                    <div class="appointment-title-wrapper">
                                        <div class="appointment-title">General Checkup</div>
                                        <span class="appointment-badge badge-confirmed">Confirmed</span>
                                    </div>
                                    <div class="appointment-info">
                                        <span><i class="fas fa-clock"></i> 10:00 AM</span>
                                        <span><i class="fas fa-user-md"></i> Dr. Sarah Johnson</span>
                                    </div>
                                </div>
                                <div class="appointment-actions">
                                    <button class="btn btn-outline">Reschedule</button>
                                    <button class="btn-icon-sm">
                                        <i class="fas fa-video"></i>
                                    </button>
                                    <div class="dropdown">
                                        <button class="btn-ghost btn-icon-sm">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="#" class="dropdown-item"><i class="fas fa-eye"></i> View Details</a>
                                            <a href="#" class="dropdown-item"><i class="fas fa-calendar-alt"></i> Reschedule</a>
                                            <a href="#" class="dropdown-item"><i class="fas fa-video"></i> Join Virtual</a>
                                            <a href="#" class="dropdown-item text-danger"><i class="fas fa-times-circle"></i> Cancel Appointment</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Appointment Item 2 -->
                            <div class="appointment-item">
                                <div class="appointment-date">
                                    <div class="appointment-date-day">30</div>
                                    <div class="appointment-date-month">Mar</div>
                                </div>
                                <div class="appointment-details">
                                    <div class="appointment-title-wrapper">
                                        <div class="appointment-title">Follow-up Consultation</div>
                                        <span class="appointment-badge badge-confirmed">Confirmed</span>
                                    </div>
                                    <div class="appointment-info">
                                        <span><i class="fas fa-clock"></i> 2:30 PM</span>
                                        <span><i class="fas fa-user-md"></i> Dr. Michael Chen</span>
                                    </div>
                                </div>
                                <div class="appointment-actions">
                                    <button class="btn btn-outline">Reschedule</button>
                                    <button class="btn-icon-sm">
                                        <i class="fas fa-video"></i>
                                    </button>
                                    <div class="dropdown">
                                        <button class="btn-ghost btn-icon-sm">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="#" class="dropdown-item"><i class="fas fa-eye"></i> View Details</a>
                                            <a href="#" class="dropdown-item"><i class="fas fa-calendar-alt"></i> Reschedule</a>
                                            <a href="#" class="dropdown-item"><i class="fas fa-video"></i> Join Virtual</a>
                                            <a href="#" class="dropdown-item text-danger"><i class="fas fa-times-circle"></i> Cancel Appointment</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Appointment Item 3 -->
                            <div class="appointment-item">
                                <div class="appointment-date">
                                    <div class="appointment-date-day">05</div>
                                    <div class="appointment-date-month">Apr</div>
                                </div>
                                <div class="appointment-details">
                                    <div class="appointment-title-wrapper">
                                        <div class="appointment-title">Dental Cleaning</div>
                                        <span class="appointment-badge badge-pending">Pending</span>
                                    </div>
                                    <div class="appointment-info">
                                        <span><i class="fas fa-clock"></i> 9:15 AM</span>
                                        <span><i class="fas fa-user-md"></i> Dr. Emily Rodriguez</span>
                                    </div>
                                </div>
                                <div class="appointment-actions">
                                    <button class="btn btn-outline">Confirm</button>
                                    <div class="dropdown">
                                        <button class="btn-ghost btn-icon-sm">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="#" class="dropdown-item"><i class="fas fa-eye"></i> View Details</a>
                                            <a href="#" class="dropdown-item"><i class="fas fa-calendar-alt"></i> Reschedule</a>
                                            <a href="#" class="dropdown-item text-danger"><i class="fas fa-times-circle"></i> Cancel Appointment</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Calendar View Tab -->
                    <div id="calendar-view" class="tab-content">
                        <div class="calendar-container">
                            <div class="calendar">
                                <div class="calendar-header">
                                    <h3 class="calendar-title">March 2025</h3>
                                    <div class="calendar-nav">
                                        <button class="calendar-nav-btn">
                                            <i class="fas fa-chevron-left"></i>
                                        </button>
                                        <button class="calendar-nav-btn">
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="calendar-grid">
                                    <!-- Weekdays -->
                                    <div class="calendar-weekday">Sun</div>
                                    <div class="calendar-weekday">Mon</div>
                                    <div class="calendar-weekday">Tue</div>
                                    <div class="calendar-weekday">Wed</div>
                                    <div class="calendar-weekday">Thu</div>
                                    <div class="calendar-weekday">Fri</div>
                                    <div class="calendar-weekday">Sat</div>
                                    
                                    <!-- Days from previous month -->
                                    <div class="calendar-day other-month">23</div>
                                    <div class="calendar-day other-month">24</div>
                                    <div class="calendar-day other-month">25</div>
                                    <div class="calendar-day other-month">26</div>
                                    <div class="calendar-day other-month">27</div>
                                    <div class="calendar-day other-month">28</div>
                                    <div class="calendar-day">1</div>
                                    
                                    <!-- Days in current month -->
                                    <div class="calendar-day">2</div>
                                    <div class="calendar-day">3</div>
                                    <div class="calendar-day">4</div>
                                    <div class="calendar-day">5</div>
                                    <div class="calendar-day">6</div>
                                    <div class="calendar-day">7</div>
                                    <div class="calendar-day">8</div>
                                    
                                    <div class="calendar-day">9</div>
                                    <div class="calendar-day">10</div>
                                    <div class="calendar-day">11</div>
                                    <div class="calendar-day">12</div>
                                    <div class="calendar-day">13</div>
                                    <div class="calendar-day">14</div>
                                    <div class="calendar-day">15</div>
                                    
                                    <div class="calendar-day">16</div>
                                    <div class="calendar-day">17</div>
                                    <div class="calendar-day">18</div>
                                    <div class="calendar-day">19</div>
                                    <div class="calendar-day">20</div>
                                    <div class="calendar-day today">21</div>
                                    <div class="calendar-day">22</div>
                                    
                                    <div class="calendar-day">23</div>
                                    <div class="calendar-day has-appointment selected">24</div>
                                    <div class="calendar-day">25</div>
                                    <div class="calendar-day">26</div>
                                    <div class="calendar-day">27</div>
                                    <div class="calendar-day">28</div>
                                    <div class="calendar-day">29</div>
                                    
                                    <div class="calendar-day has-appointment">30</div>
                                    <div class="calendar-day">31</div>
                                    <div class="calendar-day other-month">1</div>
                                    <div class="calendar-day other-month">2</div>
                                    <div class="calendar-day other-month">3</div>
                                    <div class="calendar-day other-month">4</div>
                                    <div class="calendar-day other-month has-appointment">5</div>
                                </div>
                            </div>
                            
                            <div class="day-appointments">
                                <h3 class="day-appointments-title">Appointments on March 24, 2025</h3>
                                <div class="day-appointment-item">
                                    <div class="day-appointment-title">General Checkup</div>
                                    <div class="day-appointment-info">10:00 AM - Dr. Sarah Johnson</div>
                                </div>
                                
                                <!-- No appointments message (hidden by default) -->
                                <div class="no-appointments" style="display: none;">
                                    No appointments scheduled for this day
                                </div>
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
            // Dropdown toggle
            const dropdownBtns = document.querySelectorAll('.dropdown .btn-icon, .dropdown .avatar-btn, .dropdown .btn-ghost');
            
            dropdownBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const menu = this.nextElementSibling;
                    menu.classList.toggle('show');
                    
                    // Close other dropdowns
                    dropdownBtns.forEach(otherBtn => {
                        if (otherBtn !== btn) {
                            const otherMenu = otherBtn.nextElementSibling;
                            if (otherMenu && otherMenu.classList.contains('dropdown-menu')) {
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

            // Tab functionality
            const tabTriggers = document.querySelectorAll('.tab-trigger');
            const tabContents = document.querySelectorAll('.tab-content');
            
            tabTriggers.forEach(trigger => {
                trigger.addEventListener('click', function() {
                    // Remove active class from all triggers and contents
                    tabTriggers.forEach(t => t.classList.remove('active'));
                    tabContents.forEach(c => c.classList.remove('active'));
                    
                    // Add active class to clicked trigger
                    this.classList.add('active');
                    
                    // Show corresponding content
                    const tabId = this.getAttribute('data-tab');
                    document.getElementById(tabId).classList.add('active');
                });
            });

            // Calendar day selection
            const calendarDays = document.querySelectorAll('.calendar-day');
            
            calendarDays.forEach(day => {
                day.addEventListener('click', function() {
                    // Remove selected class from all days
                    calendarDays.forEach(d => d.classList.remove('selected'));
                    
                    // Add selected class to clicked day
                    this.classList.add('selected');
                    
                    // Update appointments display
                    const dayNumber = this.textContent;
                    const appointmentsTitle = document.querySelector('.day-appointments-title');
                    const noAppointments = document.querySelector('.no-appointments');
                    const appointmentItems = document.querySelectorAll('.day-appointment-item');
                    
                    // Update title
                    appointmentsTitle.textContent = `Appointments on March ${dayNumber}, 2025`;
                    
                    // Show/hide appointments based on day
                    if (dayNumber === '24') {
                        noAppointments.style.display = 'none';
                        appointmentItems.forEach(item => {
                            item.style.display = 'block';
                        });
                    } else if (dayNumber === '30') {
                        noAppointments.style.display = 'none';
                        appointmentItems.forEach(item => {
                            const title = item.querySelector('.day-appointment-title').textContent;
                            if (title === 'General Checkup') {
                                item.style.display = 'none';
                            } else {
                                item.querySelector('.day-appointment-title').textContent = 'Follow-up Consultation';
                                item.querySelector('.day-appointment-info').textContent = '2:30 PM - Dr. Michael Chen';
                                item.style.display = 'block';
                            }
                        });
                    } else if (dayNumber === '5') {
                        noAppointments.style.display = 'none';
                        appointmentItems.forEach(item => {
                            const title = item.querySelector('.day-appointment-title').textContent;
                            if (title === 'General Checkup') {
                                item.querySelector('.day-appointment-title').textContent = 'Dental Cleaning';
                                item.querySelector('.day-appointment-info').textContent = '9:15 AM - Dr. Emily Rodriguez';
                                item.style.display = 'block';
                            } else {
                                item.style.display = 'none';
                            }
                        });
                    } else {
                        noAppointments.style.display = 'block';
                        appointmentItems.forEach(item => {
                            item.style.display = 'none';
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>