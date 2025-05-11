@extends('doctor.layout')

@section('title', 'Edit Prescription | Medical Clinic')

@section('content')

<main class="main-content">
    <!-- Flash Message -->
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

    <!-- Page Header -->
    <div class="page-header-with-actions">
        <div>
            <h1>Edit Prescription</h1>
            <p class="text-muted">Update an existing prescription for a patient</p>
        </div>
    </div>

    <!-- Prescription Form -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Prescription Information</h3>
        </div>
        <form action="{{ route('doctor.prescription-update', $prescription->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="prescription-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="appointment_id">Patient *</label>
                        <select name="appointment_id" id="appointment_id" class="form-control" required>
                            <option value="">Select Patient</option>
                            @foreach($appointments as $appointment)
                                <option value="{{ $appointment->id }}" {{ old('appointment_id', $prescription->appointment_id) == $appointment->id ? 'selected' : '' }}>
                                    {{ $appointment->patient->full_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('appointment_id')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="medication">Medication *</label>
                        <input type="text" id="medication" name="medication" class="form-control" placeholder="Enter medication name" required value="{{ old('medication', $prescription->medication) }}">
                        @error('medication')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="dosage">Dosage *</label>
                        <input type="text" id="dosage" name="dosage" class="form-control" placeholder="Enter dosage" required value="{{ old('dosage', $prescription->dosage) }}">
                        @error('dosage')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="frequency">Frequency *</label>
                        <select id="frequency" name="frequency" class="form-control" required>
                            <option value="">Select Frequency</option>
                            <option value="once-daily" {{ old('frequency', $prescription->frequency) == 'once-daily' ? 'selected' : '' }}>Once Daily</option>
                            <option value="twice-daily" {{ old('frequency', $prescription->frequency) == 'twice-daily' ? 'selected' : '' }}>Twice Daily</option>
                            <option value="three-times-daily" {{ old('frequency', $prescription->frequency) == 'three-times-daily' ? 'selected' : '' }}>Three Times Daily</option>
                            <option value="four-times-daily" {{ old('frequency', $prescription->frequency) == 'four-times-daily' ? 'selected' : '' }}>Four Times Daily</option>
                            <option value="as-needed" {{ old('frequency', $prescription->frequency) == 'as-needed' ? 'selected' : '' }}>As Needed</option>
                        </select>
                        @error('frequency')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="start_date">Start Date *</label>
                        <input type="date" id="start_date" name="start_date" class="form-control" required value="{{ old('start_date', $prescription->start_date) }}">
                        @error('start_date')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="date" id="end_date" name="end_date" class="form-control" value="{{ old('end_date', $prescription->end_date) }}">
                        @error('end_date')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="instructions">Special Instructions</label>
                    <textarea id="instructions" name="instructions" class="form-control" rows="3" placeholder="Enter any special instructions">{{ old('instructions', $prescription->instructions) }}</textarea>
                    @error('instructions')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-actions">
                    <a href="{{ route('doctor.prescriptions') }}" class="btn btn-outline">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Prescription</button>
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