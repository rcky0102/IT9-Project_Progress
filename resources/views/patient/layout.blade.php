<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Patient Dashboard | Medical Clinic')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/patient-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/patient-styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/patient.css') }}">
    <link rel="stylesheet" href="{{ asset('css/patient-payments.css') }}">
    <link rel="stylesheet" href="{{ asset('css/patient-invoice-details.css') }}">
    <style>
        /* Notification Dropdown Styles */
        .notification-dropdown {
            position: relative;
        }
        
        .notification-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: white;
            border-radius: var(--border-radius-sm, 4px);
            box-shadow: var(--shadow, 0 2px 10px rgba(0, 0, 0, 0.1));
            min-width: 300px;
            z-index: 100;
            display: none;
            margin-top: 10px;
        }
        
        .notification-menu.show {
            display: block;
        }
        
        .dropdown-header {
            padding: 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .dropdown-title {
            font-weight: bold;
            margin: 0;
        }
        
        .dropdown-actions {
            display: flex;
            gap: 10px;
        }
        
        .dropdown-action {
            background: none;
            border: none;
            color: var(--primary, #004258);
            font-size: 12px;
            cursor: pointer;
            padding: 0;
        }
        
        .dropdown-action:hover {
            text-decoration: underline;
        }
        
        .notification-items {
            max-height: 350px;
            overflow-y: auto;
        }
        
        .dropdown-item.unread {
            background-color: var(--primary-light, #e6f0f3);
        }
        
        .notification-content {
            flex: 1;
        }
        
        .notification-title {
            font-weight: 500;
            margin: 0 0 5px 0;
        }
        
        .notification-message {
            margin: 0 0 5px 0;
            font-size: 14px;
            color: var(--text-light, #666);
        }
        
        .notification-time {
            font-size: 12px;
            color: var(--text-light, #666);
            margin: 0;
        }
        
        .notification-icon {
            color: var(--primary, #004258);
        }
        
        .notification-icon.appointment {
            color: #3b82f6;
        }
        
        .notification-icon.message {
            color: #10b981;
        }
        
        .notification-icon.medication {
            color: #ef4444;
        }
        
        .dropdown-footer {
            padding: 10px 15px;
            text-align: center;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .dropdown-footer a {
            color: var(--primary, #004258);
            text-decoration: none;
            font-size: 14px;
        }
        
        .dropdown-footer a:hover {
            text-decoration: underline;
        }
        
        .empty-state {
            padding: 30px 15px;
            text-align: center;
            color: var(--text-light, #666);
        }

        /* Add this to the style section in the head */
        .btn-icon {
            position: relative;
            background: none;
            border: none;
            font-size: 1.2rem;
            color: #4b5563;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 50%;
            transition: background-color 0.2s;
            z-index: 10; /* Ensure button is above other elements */
        }

        .notification-dropdown {
            position: relative;
            z-index: 20; /* Higher z-index to ensure dropdown is above other elements */
        }
    </style>
</head>
<body>
    <div class="app-container">

        @if(session('success'))
                <div id="flash-message" class="flash-message">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const flash = document.getElementById('flash-message');
                    if (flash) {
                        setTimeout(() => flash.remove(), 3500);
                    }
                });
            </script>

        <!-- Header -->
        <header class="dashboard-header">
            <a href="{{ route('patient.dashboard') }}" class="logo">MediCare Clinic</a>
            <div class="header-actions">
                <!-- Notification Dropdown -->
                <div class="dropdown notification-dropdown">
                    <button class="btn-icon notification-btn" type="button">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </button>
                    <div class="dropdown-menu notification-menu">
                        <div class="dropdown-header">
                            <p class="dropdown-title">Notifications</p>
                            <div class="dropdown-actions">
                                <button class="dropdown-action" id="markAllReadBtn" type="button">Mark all as read</button>
                            </div>
                        </div>
                        <div class="notification-items">
                            <!-- Notifications will be populated by JavaScript -->
                        </div>
                        <div class="dropdown-footer">
                            <a href="#">View all notifications</a>
                        </div>
                    </div>
                </div>
                
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
                    <a href="{{ route('patient.dashboard') }}" class="sidebar-item {{ request()->routeIs('patient.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-chart-line"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('patient.appointments') }}" class="sidebar-item {{ request()->routeIs('patient.appointments') ? 'active' : '' }}">
                        <i class="fas fa-calendar"></i>
                        <span>Appointments</span>
                    </a>
                    <a href="{{ route('patient.medical-records') }}" class="sidebar-item {{ request()->routeIs('patient.medical-records') ? 'active' : '' }}">
                        <i class="fas fa-file-medical"></i>
                        <span>Medical Records</span>
                    </a>
                    <a href="{{ route('patient.medications') }}" class="sidebar-item">
                        <i class="fas fa-pills"></i>
                        <span>Medications</span>
                    </a>
                    <a href="{{ route('patient.payments') }}" class="sidebar-item">
                        <i class="fas fa-credit-card"></i>
                        <span>Payments</span>
                    </a>
                    <a href="{{ route('patient.messages') }}" class="sidebar-item">
                        <i class="fas fa-envelope"></i>
                        <span>Messages</span>
                    </a>
                </nav>
            </aside>
            
            @yield('content')
        </div>
    </div>

    <script>
    // Notification data
    const notifications = [
        {
            id: 1,
            title: "Appointment Reminder",
            message: "Your appointment with Dr. Smith is tomorrow at 10:00 AM",
            time: "1 hour ago",
            read: false,
            type: "appointment"
        },
        {
            id: 2,
            title: "New Message",
            message: "Dr. Johnson sent you a message regarding your recent lab results",
            time: "3 hours ago",
            read: false,
            type: "message"
        },
        {
            id: 3,
            title: "Medication Reminder",
            message: "Don't forget to take your medication today",
            time: "5 hours ago",
            read: false,
            type: "medication"
        }
    ];

    document.addEventListener('DOMContentLoaded', function() {
        console.log("DOM fully loaded");
        
        // DOM Elements
        const notificationBtn = document.querySelector('.notification-btn');
        const notificationBadge = document.querySelector('.notification-badge');
        const notificationMenu = document.querySelector('.notification-menu');
        const notificationItems = document.querySelector('.notification-items');
        const markAllReadBtn = document.getElementById('markAllReadBtn');
        const avatarBtn = document.querySelector('.avatar-btn');
        const userDropdownMenu = document.querySelector('.dropdown:not(.notification-dropdown) .dropdown-menu');
        
        console.log("Notification button:", notificationBtn);
        console.log("Notification menu:", notificationMenu);

        // Function to get icon based on notification type
        function getNotificationIcon(type) {
            switch (type) {
                case 'appointment':
                    return '<i class="fas fa-calendar notification-icon appointment"></i>';
                case 'message':
                    return '<i class="fas fa-comment notification-icon message"></i>';
                case 'medication':
                    return '<i class="fas fa-pills notification-icon medication"></i>';
                default:
                    return '<i class="fas fa-bell notification-icon"></i>';
            }
        }

        // Function to render notifications
        function renderNotifications() {
            console.log("Rendering notifications");
            // Clear the list
            notificationItems.innerHTML = '';
            
            // Update badge count
            const unreadCount = notifications.filter(notification => !notification.read).length;
            notificationBadge.textContent = unreadCount;
            
            // Hide badge if no unread notifications
            if (unreadCount === 0) {
                notificationBadge.style.display = 'none';
            } else {
                notificationBadge.style.display = 'flex';
            }
            
            // If no notifications, show empty message
            if (notifications.length === 0) {
                notificationItems.innerHTML = '<div class="empty-state">No notifications</div>';
                return;
            }
            
            // Render each notification
            notifications.forEach(notification => {
                const div = document.createElement('div');
                div.className = `dropdown-item ${notification.read ? '' : 'unread'}`;
                div.dataset.id = notification.id;
                
                div.innerHTML = `
                    ${getNotificationIcon(notification.type)}
                    <div class="notification-content">
                        <h4 class="notification-title">${notification.title}</h4>
                        <p class="notification-message">${notification.message}</p>
                        <p class="notification-time">${notification.time}</p>
                    </div>
                `;
                
                notificationItems.appendChild(div);
            });
        }

        // Function to mark a notification as read
        function markAsRead(id) {
            console.log("Marking as read:", id);
            const index = notifications.findIndex(notification => notification.id === parseInt(id));
            if (index !== -1) {
                notifications[index].read = true;
                renderNotifications();
            }
        }

        // Function to mark all notifications as read
        function markAllAsRead() {
            console.log("Marking all as read");
            notifications.forEach(notification => {
                notification.read = true;
            });
            renderNotifications();
        }

        // Make sure notification button is clickable by removing any existing listeners
        const newNotificationBtn = notificationBtn.cloneNode(true);
        notificationBtn.parentNode.replaceChild(newNotificationBtn, notificationBtn);
        
        // Re-assign the variable to the new button
        const updatedNotificationBtn = document.querySelector('.notification-btn');
        
        // Toggle notification dropdown with direct click handler
        updatedNotificationBtn.onclick = function(e) {
            console.log("Notification button clicked");
            e.preventDefault();
            e.stopPropagation();
            notificationMenu.classList.toggle('show');
            userDropdownMenu.classList.remove('show'); // Close user dropdown if open
            return false;
        };

        // Mark all as read
        if (markAllReadBtn) {
            markAllReadBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                markAllAsRead();
            });
        }

        // Mark notification as read when clicked
        if (notificationItems) {
            notificationItems.addEventListener('click', function(e) {
                const item = e.target.closest('.dropdown-item');
                if (item) {
                    markAsRead(item.dataset.id);
                }
            });
        }

        // Toggle user dropdown
        if (avatarBtn) {
            avatarBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                userDropdownMenu.classList.toggle('show');
                notificationMenu.classList.remove('show'); // Close notification dropdown if open
            });
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (notificationMenu && !notificationMenu.contains(e.target) && !updatedNotificationBtn.contains(e.target)) {
                notificationMenu.classList.remove('show');
            }
            
            if (userDropdownMenu && !userDropdownMenu.contains(e.target) && !avatarBtn.contains(e.target)) {
                userDropdownMenu.classList.remove('show');
            }
        });

        // Initialize notifications
        renderNotifications();
        
        console.log("Notification setup complete");
    });
</script>
</body>
</html>
