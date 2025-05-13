@extends('doctor.layout')

@section('title', 'Medical Record Details | Medical Clinic')

@section('content')

<!-- Main Content -->
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
                        <h1>Medical Record Details</h1>
                        <p class="text-muted">View the details of your medical record</p>
                    </div>
                    <div class="header-buttons">
                        <a onclick="history.back()" class="btn btn-outline">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                        <a href="{{ route('doctor.medical-records-edit', $medicalRecord->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit Medical Record
                        </a>
                    </div>
                </div>

                <!-- Medical Record Card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Record Information</h3>
                    </div>
                    <div class="card-content">
                        @if($medicalRecord)
                            <div class="record-details">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label>Patient</label>
                                        <p class="record-info-value">{{ $medicalRecord->appointment->patient->full_name }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Record Type</label>
                                        <p class="record-info-value">{{ $medicalRecord->recordType ? $medicalRecord->recordType->name : 'Not specified' }}</p>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label>Appointment ID</label>
                                        <p class="record-info-value">{{ $medicalRecord->appointment_id }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Date</label>
                                        <p class="record-info-value">{{ \Carbon\Carbon::parse($medicalRecord->date)->format('F d, Y') }}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Diagnosis</label>
                                    <p class="record-info-value">{{ $medicalRecord->diagnosis ?? 'No diagnosis provided' }}</p>
                                </div>

                                <h4 class="section-title">Vital Signs</h4>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label>Blood Pressure</label>
                                        <p class="record-info-value">{{ $medicalRecord->blood_pressure ?? 'Not recorded' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Temperature</label>
                                        <p class="record-info-value">{{ $medicalRecord->temperature ? $medicalRecord->temperature . ' °F' : 'Not recorded' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Heart Rate</label>
                                        <p class="record-info-value">{{ $medicalRecord->heart_rate ? $medicalRecord->heart_rate . ' bpm' : 'Not recorded' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Respiratory Rate</label>
                                        <p class="record-info-value">{{ $medicalRecord->respiratory_rate ? $medicalRecord->respiratory_rate . ' breaths/min' : 'Not recorded' }}</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Notes</label>
                                    <p class="record-info-value">{{ $medicalRecord->notes ?? 'No additional notes' }}</p>
                                </div>
                            </div>
                        @else
                            <p class="text-light">No medical record available.</p>
                        @endif
                    </div>
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