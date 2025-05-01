<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Appointment | Medical Clinic</title>
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
                    <a href="{{ route('patient.appointments') }}" class="sidebar-item active">
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
                    <h1>Schedule New Appointment</h1>
                    <p>Fill in the details below to schedule your appointment with one of our healthcare providers.</p>
                </div>

                <div class="card">
                    <form class="p-4" action="{{ route('appointments.store') }}" method="POST">
                        @csrf
                        <!-- Hidden User ID Field -->
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    
                        <!-- Appointment Type -->
                        <div class="form-group">
                            <label for="appointmentType" class="form-label">Appointment Type</label>
                            <select id="appointmentType" name="appointmentType" class="form-select" required>
                                <option value="" selected disabled>Select appointment type</option>
                                @foreach ($appointmentTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            
                        </div>
                    
                        <!-- Doctor Selection -->
                        <div class="form-group">
                            <label for="doctor" class="form-label">Select Doctor</label>
                            <select id="doctor" name="doctor" class="form-select" required>
                                <option value="" selected disabled>Select a doctor</option>
                            </select>   
                            <div id="doctor-availability" class="mt-3">
                                <!-- Availability details will be inserted here -->
                            </div>
                              
                        </div>

                        
                    
                      <!-- Date Selection -->
                        <div class="form-group">
                            <label for="date" class="form-label">Appointment Date</label>
                            <input type="date" id="date" name="date" class="form-control" required>
                        </div>

                    
                      <!-- Time Selection -->
                            <div class="form-group">
                                <label for="time" class="form-label">Preferred Time</label>
                                <input type="time" id="time" name="time" class="form-control" required>
                            </div>

                    
                        <!-- Reason for Visit -->
                        <div class="form-group">
                            <label for="reason" class="form-label">Reason for Visit</label>
                            <textarea id="reason" name="reason" class="form-textarea" placeholder="Please describe your symptoms or reason for the appointment" required></textarea>
                        </div>
                    
                        <!-- Additional Notes -->
                        <div class="form-group">
                            <label for="notes" class="form-label">Additional Notes (Optional)</label>
                            <textarea id="notes" name="notes" class="form-textarea" placeholder="Any additional information you'd like to share"></textarea>
                        </div>
                    
                        <!-- Form Actions -->
                        <div class="form-actions">
                            <a href="{{ route('patient.appointments') }}" class="btn btn-outline">Cancel</a>
                            <button type="submit" class="btn btn-primary">Schedule Appointment</button>
                        </div>
                    </form>
                    
                </div>
            </main>
        </div>
    </div>

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
                    const month = 'April'; // This would be dynamic in a real implementation
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

            document.getElementById('appointmentType').addEventListener('change', function () {
        const appointmentTypeId = this.value;
        const doctorSelect = document.getElementById('doctor');

        // Clear previous options
        doctorSelect.innerHTML = '<option selected disabled>Loading...</option>';

        fetch(`/get-doctors/${appointmentTypeId}`)
            .then(response => response.json())
            .then(doctors => {
                doctorSelect.innerHTML = '<option selected disabled>Select a doctor</option>';
                doctors.forEach(doctor => {
                    const fullName = `${doctor.user?.first_name ?? ''} ${doctor.user?.middle_name ?? ''} ${doctor.user?.last_name ?? ''}`.trim();

                    const specialization = doctor.specialization?.specialization_name || '';
                    const option = new Option(`Dr. ${fullName} - ${specialization}`, doctor.id);
                    doctorSelect.appendChild(option);

                });
            })
            .catch(() => {
                doctorSelect.innerHTML = '<option selected disabled>Error loading doctors</option>';
            });
    });
        });

        document.getElementById('doctor').addEventListener('change', function () {
        const doctorId = this.value;
        const availabilityDiv = document.getElementById('doctor-availability');
        availabilityDiv.innerHTML = 'Loading availability...';

        fetch(`/doctor/${doctorId}/availability`)
            .then(response => response.json())
            .then(data => {
                if (data.length === 0) {
                    availabilityDiv.innerHTML = '<p class="text-red-600">No availability found for this doctor.</p>';
                    return;
                }

                let html = '<h4 class="font-semibold mb-2">Availability:</h4><ul class="list-disc pl-6">';
                data.forEach(slot => {
                    html += `<li>
                        <strong>${slot.name}</strong> - ${slot.day}: 
                        ${formatTime(slot.start_time)} - ${formatTime(slot.end_time)} 
                        (${slot.status})
                    </li>`;
                });
                html += '</ul>';
                availabilityDiv.innerHTML = html;
            })
            .catch(() => {
                availabilityDiv.innerHTML = '<p class="text-red-600">Failed to load availability.</p>';
            });
    });

    function formatTime(timeStr) {
        const [hour, minute, second] = timeStr.split(':');
        const date = new Date();
        date.setHours(hour, minute);
        return date.toLocaleTimeString([], { hour: 'numeric', minute: '2-digit' });
    }
    </script>
</body>
</html>
