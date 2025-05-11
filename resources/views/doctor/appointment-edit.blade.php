@extends('doctor.layout')

@section('title', 'Edit appointment | Medical Clinic')

@section('content')

<!-- Main Content -->
            <main class="main-content">
                <div class="page-header-with-actions">
                    <div>
                        <h1>Edit Appointment</h1>
                        <p class="text-muted">Update appointment details and status</p>
                    </div>
                    <div class="header-buttons">
                        <button class="btn btn-outline" onclick="history.back()">
                            <i class="fas fa-arrow-left"></i> Back to Details
                        </button>
                    </div>
                </div>

                <!-- Edit Appointment Form -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Appointment Information</h3>
                    </div>
                    <div class="card-content">
                        <form class="schedule-form" action="{{ route('doctor.appointment-update', $appointment->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-row">
        <div class="form-group">
            <label for="patient-name">Patient Name</label>
            <input type="text" class="form-control" id="patient-name" value="{{ $appointment->patient->full_name }}" disabled readonly>
        </div>
        <div class="form-group">
            <label for="appointment-type">Appointment Type</label>
            <input type="text" class="form-control" id="appointment-type" value="{{ $appointment->appointmentType->name }}" disabled readonly>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="appointment_date">Date *</label>
            <input type="date" class="form-control @error('appointment_date') is-invalid @enderror"
                   name="appointment_date" id="appointment_date" 
                   value="{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d') }}" required>
            @error('appointment_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="appointment_time">Start Time *</label>
            <input type="time" class="form-control @error('appointment_time') is-invalid @enderror"
                   name="appointment_time" id="appointment_time" 
                   value="{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}" required>
            @error('appointment_time')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="appointment_end_time">End Time</label>
            <input type="time" class="form-control @error('appointment_end_time') is-invalid @enderror"
                   name="appointment_end_time" id="appointment_end_time" 
                   value="{{ $appointment->appointment_end_time ? \Carbon\Carbon::parse($appointment->appointment_end_time)->format('H:i') : '' }}">
            @error('appointment_end_time')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="appointment-status">Status *</label>
        <div class="status-options @error('status') is-invalid @enderror">
            @foreach (['confirmed', 'pending', 'completed', 'cancelled'] as $status)
                <div class="radio-container">
                    <input type="radio" id="status-{{ $status }}" name="status" value="{{ $status }}"
                        {{ $appointment->status === $status ? 'checked' : '' }}>
                    <label class="radio-label" for="status-{{ $status }}">{{ ucfirst($status) }}</label>
                </div>
            @endforeach
            @error('status')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-actions">
        <button type="button" class="btn btn-outline" onclick="history.back()">Cancel</button>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
    </div>
</form>


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
                            if (otherMenu) {
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

            // Calculate and display end time based on start time and duration
            const startTimeInput = document.getElementById('appointment-time');
            const durationSelect = document.getElementById('appointment-duration');
            const form = document.querySelector('.schedule-form');

            function calculateEndTime() {
                const startTime = startTimeInput.value;
                const duration = parseInt(durationSelect.value);
                if (startTime && duration) {
                    const [hours, minutes] = startTime.split(':').map(Number);
                    const startDate = new Date(2025, 0, 1, hours, minutes);
                    startDate.setMinutes(startDate.getMinutes() + duration);
                    const endHours = String(startDate.getHours()).padStart(2, '0');
                    const endMinutes = String(startDate.getMinutes()).padStart(2, '0');
                    const endTime = `${endHours}:${endMinutes}`;
                    // Optionally display end time to user (e.g., in a span or disabled input)
                    console.log(`End Time: ${endTime}`); // For demo; can be shown in UI
                }
            }

            startTimeInput.addEventListener('change', calculateEndTime);
            durationSelect.addEventListener('change', calculateEndTime);

            // Form submission handling (client-side validation)
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const date = document.getElementById('appointment-date').value;
                const time = startTimeInput.value;
                const duration = durationSelect.value;
                const status = document.querySelector('input[name="status"]:checked');

                if (!date || !time || !duration || !status) {
                    alert('Please fill all required fields.');
                    return;
                }

                // Simulate form submission
                console.log({
                    date,
                    start_time: time,
                    duration,
                    status: status.value,
                    reason: document.getElementById('reason').value,
                    notes: document.getElementById('notes').value
                });
                alert('Appointment updated successfully!');
                // Redirect or update UI as needed
            });
        });
    </script>

@endsection
