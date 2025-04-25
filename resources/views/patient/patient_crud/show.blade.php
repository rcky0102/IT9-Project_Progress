<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Details | Medical Clinic</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="app-container">
        <!-- Header -->
        <header class="dashboard-header">
            <a href="index.html" class="logo">MediCare Clinic</a>
            <div class="header-actions">
                <button class="btn-icon notification-btn">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </button>
                <div class="dropdown">
                    <button class="avatar-btn" id="avatarBtn">
                        <div class="avatar">
                            <img src="https://via.placeholder.com/40" alt="User">
                            <span class="avatar-fallback">JD</span>
                        </div>
                    </button>
                    <div class="dropdown-menu" id="userDropdown">
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
                    <a href="#" class="sidebar-item">
                        <i class="fas fa-chart-line"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="index.html" class="sidebar-item active">
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

                <!-- Welcome Card -->
                <div class="welcome-card">
                    <div class="flex-between">
                        <div class="flex-center">
                            <a href="{{ route('patient.appointments') }}" class="btn-icon-sm">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                            <h1>Appointment Details</h1>
                        </div>
                        <a href="{{ route('patient.patient_crud.edit', $appointment->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                            Edit Appointment
                        </a>
                    </div>
                    <p>View the details of your scheduled appointment.</p>
                </div>

                <div class="card">
                    <div class="p-6">
                        <div class="flex-between mb-6">
                            <div>
                                <h2 class="text-2xl font-bold text-primary mb-2">{{ $appointment->appointment_type }}</h2>
                                <div class="flex-center gap-2">
                                    <span class="appointment-badge badge-confirmed">Confirmed</span>
                                </div>
                            </div>
                            <div class="appointment-date">
                                <div class="appointment-date-day">{{ \Carbon\Carbon::parse($appointment->appointment_date)->day }}</div>
                                <div class="appointment-date-month">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M') }}</div>
                            </div>
                        </div>

                        <div class="details-grid">
                            <div>
                                <h3 class="text-lg font-semibold mb-4 text-primary">Appointment Information</h3>
                                <div class="details-list">
                                    <div class="detail-item">
                                        <i class="fas fa-calendar-alt text-primary"></i>
                                        <div>
                                            <p class="font-medium">Date & Time</p>
                                            <p class="text-light">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') }} at {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</p>
                                        </div>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fas fa-user-md text-primary"></i>
                                        <div>
                                            <p class="font-medium">Healthcare Provider</p>
                                            <p class="text-light">{{ $appointment->doctor }}</p>
                                        </div>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                        <div>
                                            <p class="font-medium">Location</p>
                                            <p class="text-light">MediCare Clinic</p> <!-- Clinic location assumed as static -->
                                        </div>
                                    </div>
                                    {{-- <div class="detail-item">
                                        <i class="fas fa-video text-primary"></i>
                                        <div>
                                            <p class="font-medium">Appointment Mode</p>
                                            <p class="text-light">{{ $appointment->appointment_mode ?? 'In-Person' }}</p> <!-- Default to 'In-Person' if not set -->
                                        </div>
                                    </div> --}}
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold mb-4 text-primary">Additional Information</h3>
                                <div class="details-list">
                                    <div class="detail-block">
                                        <p class="font-medium">Reason for Visit</p>
                                        <p class="text-light">{{ $appointment->reason }}</p>
                                    </div>
                                    <div class="detail-block">
                                        <p class="font-medium">Additional Notes</p>
                                        <p class="text-light">{{ $appointment->notes }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex gap-4">
                            <button class="btn btn-outline">
                                <i class="fas fa-calendar-plus"></i>
                                Add to Calendar
                            </button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dropdown functionality
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle, .avatar-btn');
            
            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const dropdown = this.closest('.dropdown');
                    const menu = dropdown.querySelector('.dropdown-menu');
                    menu.classList.toggle('show');
                    
                    // Close other dropdowns
                    document.querySelectorAll('.dropdown-menu.show').forEach(openMenu => {
                        if (openMenu !== menu) {
                            openMenu.classList.remove('show');
                        }
                    });
                });
            });
            
            // Close dropdowns when clicking outside
            document.addEventListener('click', function() {
                document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                    menu.classList.remove('show');
                });
            });
        });
    </script>
</body>
</html>
