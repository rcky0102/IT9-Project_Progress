<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule New Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card mb-4 bg-light">
            <div class="card-body">
                <h1>Schedule New Appointment</h1>
                <p>Please fill out the form below to schedule your appointment.</p>
            </div>
        </div>

        <div id="error-container" class="alert alert-danger" style="display: none;">
            <ul id="error-list"></ul>
        </div>

        <div class="card">
            <div class="card-body">
                <form id="appointment-form" method="POST">
                    <input type="hidden" name="_token" id="csrf-token" value="">
                    
                    <div class="form-group mb-3">
                        <label for="appointment_type_id" class="form-label">Appointment Type</label>
                        <select name="appointment_type_id" id="appointment_type_id" class="form-control" required>
                            <option value="">Select Appointment Type</option>
                            <!-- Appointment types will be loaded dynamically -->
                        </select>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="doctor_id" class="form-label">Doctor</label>
                        <select name="doctor_id" id="doctor_id" class="form-control" required>
                            <option value="">Select Doctor</option>
                            <!-- Doctors will be loaded dynamically -->
                        </select>
                    </div>
                    
                    <div class="form-group mb-3" id="date-container" style="display: none;">
                        <label for="date" class="form-label">Date</label>
                        <select name="date" id="date" class="form-control" required disabled>
                            <option value="">Select Date</option>
                        </select>
                    </div>
                    
                    <div class="form-group mb-3" id="time-slot-container" style="display: none;">
                        <label for="time_slot" class="form-label">Time Slot</label>
                        <select name="time_slot" id="time_slot" class="form-control" required disabled>
                            <option value="">Select Time Slot</option>
                        </select>
                    </div>
                    
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="is_virtual" id="is_virtual" value="1">
                        <label class="form-check-label" for="is_virtual">
                            Virtual Appointment (Online)
                        </label>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="notes" class="form-label">Notes (Optional)</label>
                        <textarea name="notes" id="notes" class="form-control" rows="3" placeholder="Please provide any additional information that might be helpful for the doctor."></textarea>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Schedule Appointment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set CSRF token
            document.getElementById('csrf-token').value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Load appointment types
            fetch('/api/appointment-types')
                .then(response => response.json())
                .then(types => {
                    const select = document.getElementById('appointment_type_id');
                    types.forEach(type => {
                        const option = document.createElement('option');
                        option.value = type.id;
                        option.textContent = `${type.name} (${type.duration} min)`;
                        option.dataset.duration = type.duration;
                        select.appendChild(option);
                    });
                })
                .catch(error => console.error('Error loading appointment types:', error));
            
            // Load doctors
            fetch('/api/doctors')
                .then(response => response.json())
                .then(doctors => {
                    const select = document.getElementById('doctor_id');
                    doctors.forEach(doctor => {
                        const option = document.createElement('option');
                        option.value = doctor.id;
                        option.textContent = `Dr. ${doctor.first_name} ${doctor.last_name} - ${doctor.specialty}`;
                        select.appendChild(option);
                    });
                })
                .catch(error => console.error('Error loading doctors:', error));
            
            const doctorSelect = document.getElementById('doctor_id');
            const dateSelect = document.getElementById('date');
            const dateContainer = document.getElementById('date-container');
            const timeSlotSelect = document.getElementById('time_slot');
            const timeSlotContainer = document.getElementById('time-slot-container');
            
            // When doctor is selected, fetch available dates
            doctorSelect.addEventListener('change', function() {
                const doctorId = this.value;
                
                if (doctorId) {
                    // Reset date and time slot selections
                    dateSelect.innerHTML = '<option value="">Select Date</option>';
                    timeSlotSelect.innerHTML = '<option value="">Select Time Slot</option>';
                    timeSlotSelect.disabled = true;
                    timeSlotContainer.style.display = 'none';
                    
                    // Enable date selection and show container
                    dateSelect.disabled = false;
                    dateContainer.style.display = 'block';
                    
                    // Fetch available dates
                    fetch(`/appointments/available-dates?doctor_id=${doctorId}`)
                        .then(response => response.json())
                        .then(dates => {
                            if (dates.length > 0) {
                                dates.forEach(date => {
                                    const option = document.createElement('option');
                                    option.value = date.date;
                                    option.textContent = date.formatted;
                                    dateSelect.appendChild(option);
                                });
                            } else {
                                const option = document.createElement('option');
                                option.value = '';
                                option.textContent = 'No available dates';
                                dateSelect.appendChild(option);
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching available dates:', error);
                        });
                } else {
                    // Reset and disable date selection
                    dateSelect.innerHTML = '<option value="">Select Date</option>';
                    dateSelect.disabled = true;
                    dateContainer.style.display = 'none';
                    
                    // Reset and disable time slot selection
                    timeSlotSelect.innerHTML = '<option value="">Select Time Slot</option>';
                    timeSlotSelect.disabled = true;
                    timeSlotContainer.style.display = 'none';
                }
            });
            
            // When date is selected, fetch available time slots
            dateSelect.addEventListener('change', function() {
                const date = this.value;
                const doctorId = doctorSelect.value;
                
                if (date && doctorId) {
                    // Reset time slot selection
                    timeSlotSelect.innerHTML = '<option value="">Select Time Slot</option>';
                    
                    // Enable time slot selection and show container
                    timeSlotSelect.disabled = false;
                    timeSlotContainer.style.display = 'block';
                    
                    // Fetch available time slots
                    fetch(`/appointments/available-time-slots?doctor_id=${doctorId}&date=${date}`)
                        .then(response => response.json())
                        .then(timeSlots => {
                            if (timeSlots.length > 0) {
                                timeSlots.forEach(slot => {
                                    const option = document.createElement('option');
                                    option.value = slot.formatted;
                                    option.textContent = slot.formatted;
                                    timeSlotSelect.appendChild(option);
                                });
                            } else {
                                const option = document.createElement('option');
                                option.value = '';
                                option.textContent = 'No available time slots';
                                timeSlotSelect.appendChild(option);
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching available time slots:', error);
                        });
                } else {
                    // Reset and disable time slot selection
                    timeSlotSelect.innerHTML = '<option value="">Select Time Slot</option>';
                    timeSlotSelect.disabled = true;
                    timeSlotContainer.style.display = 'none';
                }
            });
            
            // Form submission
            document.getElementById('appointment-form').addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                
                fetch('/appointments', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.getElementById('csrf-token').value,
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(data => {
                            throw new Error(JSON.stringify(data));
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    window.location.href = '/patient/appointments';
                })
                .catch(error => {
                    try {
                        const errors = JSON.parse(error.message);
                        const errorContainer = document.getElementById('error-container');
                        const errorList = document.getElementById('error-list');
                        
                        errorList.innerHTML = '';
                        
                        if (errors.errors) {
                            Object.values(errors.errors).forEach(errorMessages => {
                                errorMessages.forEach(message => {
                                    const li = document.createElement('li');
                                    li.textContent = message;
                                    errorList.appendChild(li);
                                });
                            });
                            
                            errorContainer.style.display = 'block';
                        }
                    } catch (e) {
                        console.error('Error processing form submission:', error);
                    }
                });
            });
        });
    </script>
</body>
</html>