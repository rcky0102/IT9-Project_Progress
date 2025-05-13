<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard | Medical Clinic')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-doctor.css')}}">
    <link rel="stylesheet" href="{{ asset('css/admin-doctor-create.css')}}">
    <link rel="stylesheet" href="{{ asset('css/patient-invoice-details.css')}}">
    <link rel="stylesheet" href="{{ asset('css/patient-payments.css')}}">
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
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-chart-line"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="sidebar-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                    <a href="{{ route('admin.doctors.index') }}" class="sidebar-item {{ request()->routeIs('admin.doctors.*') ? 'active' : '' }}">
                        <i class="fas fa-user-md"></i>
                        <span>Doctors</span>
                    </a>
                    <a href="{{ route('admin.appointments.index') }}" class="sidebar-item {{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}">
                        <i class="fas fa-calendar"></i>
                        <span>Appointments</span>
                    </a>
                    <a href="{{ route('admin.billing.index') }}" class="sidebar-item {{ request()->routeIs('admin.billings.*') ? 'active' : '' }}">
                        <i class="fas fa-credit-card"></i>
                        <span>Billing</span>
                    </a>
                    <a href="{{ route('admin.reports.index') }}" class="sidebar-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                        <i class="fas fa-chart-bar"></i>
                        <span>Reports</span>
                    <a href="{{ route('admin.settings.departments.index') }}" class="sidebar-item {{ request()->routeIs('admin.settings.departments.*') ? 'active' : '' }}">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </nav>
            </aside>


            @yield('content')
            
</body>
</html>