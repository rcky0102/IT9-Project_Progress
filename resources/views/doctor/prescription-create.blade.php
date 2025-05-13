@extends('doctor.layout')

@section('title', 'Create Prescription | Medical Clinic')

@section('content')

<main class="main-content">

<!-- Prescription Form -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">New Prescription</h3>
    </div>
    <form action="{{ route('doctor.prescription-store') }}" method="POST">
        @csrf
        <div class="prescription-form">
            <div class="form-row">
                <div class="form-group">
                    <label for="appointment_id">Patient</label>
                    <select name="appointment_id" id="patient" class="form-control" required>
                        <option value="">Select Patient</option>
                        @foreach($appointments as $appointment)
                            <option value="{{ $appointment->id }}">
                                {{ $appointment->patient->full_name }}
                            </option>
                        @endforeach
                    </select>                    
                </div>
                <div class="form-group">
                    <label for="medication">Medication</label>
                    <input type="text" id="medication" name="medication" class="form-control" placeholder="Enter medication name" required>
                </div>
            </div>
    
            <div class="form-row">
                <div class="form-group">
                    <label for="dosage">Dosage</label>
                    <input type="text" id="dosage" name="dosage" class="form-control" placeholder="Enter dosage" required>
                </div>
                <div class="form-group">
                    <label for="frequency">Frequency</label>
                    <select id="frequency" name="frequency" class="form-control" required>
                        <option value="">Select Frequency</option>
                        <option value="once-daily">Once Daily</option>
                        <option value="twice-daily">Twice Daily</option>
                        <option value="three-times-daily">Three Times Daily</option>
                        <option value="four-times-daily">Four Times Daily</option>
                        <option value="as-needed">As Needed</option>
                    </select>
                </div>
            </div>
    
            <div class="form-row">
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="date" id="end_date" name="end_date" class="form-control">
                </div>
            </div>
    
            <div class="form-group">
                <label for="instructions">Special Instructions</label>
                <textarea id="instructions" name="instructions" class="form-control" rows="3" placeholder="Enter any special instructions"></textarea>
            </div>
    
            <div class="form-actions">
                <a onclick="history.back()" class="btn btn-outline">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Prescription</button>
            </div>
        </div>
    </form>
    
</div>
</main>

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
    });
</script>


@endsection