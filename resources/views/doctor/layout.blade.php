<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Doctor Dashboard | Medical Clinic')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/doctor-patients.css') }}">
    <link rel="stylesheet" href="{{ asset('css/doctor-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/doctor-styles.css')}}">
    <link rel="stylesheet" href="{{ asset('css/doctor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/doctor-messages.css') }}">
    <link rel="stylesheet" href="{{ asset('css/patient.css') }}">
    
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
                    <a href="{{ route('doctor.dashboard') }}" class="sidebar-item {{ request()->routeIs('doctor.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-chart-line"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('doctor.appointments') }}" class="sidebar-item {{ request()->routeIs('doctor.appointments') ? 'active' : '' }}">
                        <i class="fas fa-calendar"></i>
                        <span>Appointments</span>
                    </a>
                    <a href="{{ route('doctor.patients') }}" class="sidebar-item {{ request()->routeIs('doctor.patients') ? 'active' : '' }}">
                        <i class="fas fa-user"></i>
                        <span>Patients</span>
                    </a>
                    <a href="{{ route('doctor.medical-records') }}" class="sidebar-item {{ request()->routeIs('doctor.medical-records') ? 'active' : '' }}">
                        <i class="fas fa-file-medical"></i>
                        <span>Medical Records</span>
                    </a>
                    <a href="{{ route('doctor.prescriptions') }}" class="sidebar-item {{ request()->routeIs('doctor.prescriptions') ? 'active' : '' }}">
                        <i class="fas fa-pills"></i>
                        <span>Prescriptions</span>
                    </a>
                    <a href="{{ route('doctor.schedules') }}" class="sidebar-item {{ request()->routeIs('doctor.schedules') ? 'active' : '' }}">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Schedule</span>
                    </a>
                     <a href="{{ route('doctor.messages') }}" class="sidebar-item">
                        <i class="fas fa-envelope"></i>
                        <span>Messages</span>
                    </a>
                </nav>
            </aside>            

            @yield('content')

</body>
</html>
