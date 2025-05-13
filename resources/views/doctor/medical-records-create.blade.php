@extends('doctor.layout')

@section('title', 'Medical Records | Medical Clinic')

@section('content')

 <!-- Main Content -->
 <main class="main-content">
    <div class="page-header-with-actions">
        <div>
            <h1>Create Medical Record</h1>
            <p class="text-muted">Add a new medical record for a patient</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Record Information</h3>
        </div>
        <form action="{{ route('doctor.medical-records-store') }}" method="POST" class="record-form">
            @csrf
        
            <div class="form-row">
                <div class="form-group">
                    <label for="appointment_id">Patient</label>
                    <select name="appointment_id" id="appointment_id" class="form-control" required>
                        <option value="">Select Patient</option>
                        @foreach($appointments as $appointment)
                            <option value="{{ $appointment->id }}" {{ old('appointment_id') == $appointment->id ? 'selected' : '' }}>
                                {{ $appointment->patient->full_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('appointment_id')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>                
        
                <div class="form-group">
                    <label for="record_type_id">Record Type *</label>
                    <select id="record_type_id" name="record_type_id" class="form-control" required>
                        <option value="">Select record type</option>
                        @foreach ($recordTypes as $recordType)
                            <option value="{{ $recordType->id }}" {{ old('record_type_id') == $recordType->id ? 'selected' : '' }}>
                                {{ $recordType->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('record_type_id')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        
            <div class="form-row">
                <div class="form-group">
                    <label for="date">Date *</label>
                    <input type="date" id="date" name="date" class="form-control" required value="{{ old('date') }}">
                    @error('date')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
        
                <div class="form-group">
                    <label for="diagnosis">Diagnosis *</label>
                    <input type="text" id="diagnosis" name="diagnosis" class="form-control" placeholder="Enter diagnosis" required value="{{ old('diagnosis') }}">
                    @error('diagnosis')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        
            <h4 class="section-title">Vital Signs</h4>
            <div class="form-row">
                <div class="form-group">
                    <label for="blood_pressure">Blood Pressure</label>
                    <input type="text" id="blood_pressure" name="blood_pressure" class="form-control" placeholder="e.g. 120/80 mmHg" value="{{ old('blood_pressure') }}">
                </div>
                <div class="form-group">
                    <label for="temperature">Temperature</label>
                    <input type="text" id="temperature" name="temperature" class="form-control" placeholder="e.g. 98.6 °F" value="{{ old('temperature') }}">
                </div>
                <div class="form-group">
                    <label for="heart_rate">Heart Rate</label>
                    <input type="text" id="heart_rate" name="heart_rate" class="form-control" placeholder="e.g. 72 bpm" value="{{ old('heart_rate') }}">
                </div>
                <div class="form-group">
                    <label for="respiratory_rate">Respiratory Rate</label>
                    <input type="text" id="respiratory_rate" name="respiratory_rate" class="form-control" placeholder="e.g. 16 breaths/min" value="{{ old('respiratory_rate') }}">
                </div>
            </div>
        
            <div class="form-group">
                <label for="notes">Notes *</label>
                <textarea id="notes" name="notes" class="form-control" rows="6" placeholder="Enter detailed notes about the patient's condition, treatment plan, etc." required>{{ old('notes') }}</textarea>
                @error('notes')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
        
            <div class="form-actions">
                <a onclick="history.back()" class="btn btn-outline">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Record
                </button>
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
    
        // // Form submission
        // const form = document.querySelector('.record-form');
        // if (form) {
        //     form.addEventListener('submit', function(e) {
        //         e.preventDefault();  
        //         alert('Record created successfully!');
        //         form.submit(); // This will submit the form normally
        //     });
        // }
    });
    </script>

@endsection