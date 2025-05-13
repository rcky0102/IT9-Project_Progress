@extends('patient.layout')

@section('title', 'Schedule Appointment | Medical Clinic')

@section('content')

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
    availabilityDiv.innerHTML = 'Loading availability and confirmed appointments...';

    fetch(`/doctor/${doctorId}/availability`)
        .then(response => response.json())
        .then(data => {
            if ((data.availabilities.length === 0) && (data.confirmedAppointments.length === 0)) {
                availabilityDiv.innerHTML = '<p class="text-red-600">No availability or confirmed appointments found for this doctor.</p>';
                return;
            }

            let html = '';

            // Doctor's availability
            if (data.availabilities.length > 0) {
                html += '<h4 class="font-semibold mb-2">Availability:</h4><ul class="list-disc pl-6">';
                data.availabilities.forEach(slot => {
                    html += `<li>
                        <strong>${slot.name}</strong> - ${slot.day}: 
                        ${formatTime(slot.start_time)} - ${formatTime(slot.end_time)} 
                        (${slot.status})
                    </li>`;
                });
                html += '</ul>';
            }

            // Confirmed appointments - now showing both start and end times
            if (data.confirmedAppointments.length > 0) {
                html += '<h4 class="font-semibold mt-4 mb-2">Confirmed Appointments:</h4><ul class="list-disc pl-6">';
                data.confirmedAppointments.forEach(appointment => {
                    html += `<li>
                        <strong>${appointment.date}</strong> 
                        ${formatTime(appointment.time)} - ${formatTime(appointment.end_time)} 
                    </li>`;
                });
                html += '</ul>';
            }

            availabilityDiv.innerHTML = html;
        })
        .catch(() => {
            availabilityDiv.innerHTML = '<p class="text-red-600">Failed to load availability or confirmed appointments.</p>';
        });
});

function formatTime(timeString) {
    // Split the time string into hours and minutes
    const [hours, minutes] = timeString.split(':').map(Number);
    
    // Create a date object with fixed date (timezone doesn't matter here)
    const date = new Date();
    date.setHours(hours, minutes, 0, 0);
    
    // Format as AM/PM without timezone conversion
    return date.toLocaleTimeString([], { 
        hour: '2-digit', 
        minute: '2-digit',
        hour12: true
    });
}

    </script>

@endsection