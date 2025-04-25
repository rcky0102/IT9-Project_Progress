<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment | Medical Clinic</title>
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
    <!-- Welcome Card -->
    <div class="welcome-card">
        <h1>Edit Appointment</h1>
        <p>Update your appointment details below.</p>
    </div>

    <div class="card">
        <form class="p-4" action="{{ route('appointments.update', $appointment->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Appointment Type -->
            <div class="form-group">
                <label for="appointmentType" class="form-label">Appointment Type</label>
                <select id="appointmentType" name="appointmentType" class="form-select" required>
                    <option value="" disabled>Select appointment type</option>
                    <option value="general-checkup" {{ old('appointmentType', $appointment->appointment_type) == 'general-checkup' ? 'selected' : '' }}>General Checkup</option>
                    <option value="follow-up" {{ old('appointmentType', $appointment->appointment_type) == 'follow-up' ? 'selected' : '' }}>Follow-up Consultation</option>
                    <option value="dental" {{ old('appointmentType', $appointment->appointment_type) == 'dental' ? 'selected' : '' }}>Dental Cleaning</option>
                    <option value="specialist" {{ old('appointmentType', $appointment->appointment_type) == 'specialist' ? 'selected' : '' }}>Specialist Consultation</option>
                    <option value="vaccination" {{ old('appointmentType', $appointment->appointment_type) == 'vaccination' ? 'selected' : '' }}>Vaccination</option>
                    <option value="physical-therapy" {{ old('appointmentType', $appointment->appointment_type) == 'physical-therapy' ? 'selected' : '' }}>Physical Therapy</option>
                </select>
            </div>

            <!-- Doctor Selection -->
            <div class="form-group">
                <label for="doctor" class="form-label">Select Doctor</label>
                <select id="doctor" name="doctor" class="form-select" required>
                    <option value="" disabled>Choose a healthcare provider</option>
                    <option value="dr-johnson" {{ old('doctor', $appointment->doctor) == 'dr-johnson' ? 'selected' : '' }}>Dr. Sarah Johnson - General Medicine</option>
                    <option value="dr-chen" {{ old('doctor', $appointment->doctor) == 'dr-chen' ? 'selected' : '' }}>Dr. Michael Chen - Cardiology</option>
                    <option value="dr-rodriguez" {{ old('doctor', $appointment->doctor) == 'dr-rodriguez' ? 'selected' : '' }}>Dr. Emily Rodriguez - Dentistry</option>
                    <option value="dr-patel" {{ old('doctor', $appointment->doctor) == 'dr-patel' ? 'selected' : '' }}>Dr. Raj Patel - Pediatrics</option>
                    <option value="dr-williams" {{ old('doctor', $appointment->doctor) == 'dr-williams' ? 'selected' : '' }}>Dr. James Williams - Orthopedics</option>
                </select>
            </div>

            @php
                use Carbon\Carbon;
            @endphp
            
            <!-- Appointment Date -->
            <div class="form-group">
                <label for="date" class="form-label">Appointment Date</label>
                <input 
                    type="date" 
                    id="date" 
                    name="date" 
                    class="form-control" 
                    value="{{ old('date', Carbon::parse($appointment->appointment_date)->format('Y-m-d')) }}" 
                    required>
            </div>

            <!-- Time Selection -->
            <div class="form-group">
                <label for="time" class="form-label">Preferred Time</label>
                <select id="time" name="time" class="form-select" required>
                    <option value="" disabled>Select a time slot</option>
                    @php
                        $timeSlots = ['9:00', '9:30', '10:00', '10:30', '11:00', '11:30', '1:00', '1:30', '2:00', '2:30', '3:00', '3:30', '4:00', '4:30'];
                    @endphp
                    @foreach ($timeSlots as $slot)
                        <option value="{{ $slot }}" {{ old('time', $appointment->appointment_time) == $slot ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::createFromFormat('H:i', $slot)->format('g:i A') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Reason for Visit -->
            <div class="form-group">
                <label for="reason" class="form-label">Reason for Visit</label>
                <textarea id="reason" name="reason" class="form-textarea" required>{{ old('reason', $appointment->reason) }}</textarea>
            </div>

            <!-- Additional Notes -->
            <div class="form-group">
                <label for="notes" class="form-label">Additional Notes (Optional)</label>
                <textarea id="notes" name="notes" class="form-textarea">{{ old('notes', $appointment->notes) }}</textarea>
            </div>

            <!-- Actions -->
            <div class="form-actions">
                <a href="{{ route('patient.patient_crud.show', $appointment->id) }}" class="btn btn-outline">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Appointment</button>
            </div>
        </form>
    </div>
</main>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Date picker functionality
            const dateInput = document.getElementById('date');
            const calendarPopup = document.getElementById('calendarPopup');
            const calendarDays = document.querySelectorAll('.calendar-day:not(.disabled)');

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
                    const month = 'March'; // This would be dynamic in a real implementation
                    const day = this.textContent;
                    const year = '2025'; // This would be dynamic in a real implementation
                    dateInput.value = `${month} ${day}, ${year}`;
                    
                    // Close calendar popup
                    calendarPopup.classList.remove('show');
                });
            });

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
