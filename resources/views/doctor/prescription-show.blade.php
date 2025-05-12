@extends('doctor.layout')

@section('title', 'Prescription Details | Medical Clinic')

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
            <h1>Prescription Details</h1>
            <p class="text-muted">View the details of the prescription</p>
        </div>
        <div class="header-buttons">
            <a href="{{ route('doctor.prescriptions') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Back to Prescriptions
            </a>
            <a href="{{ route('doctor.prescription-edit', $prescription->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit Prescription
            </a>
        </div>
    </div>

    <!-- Prescription Card -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Prescription Information</h3>
        </div>
        <div class="card-content">
            @if($prescription)
                <div class="prescription-details">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Patient</label>
                            <p class="record-info-value">{{ $prescription->appointment->patient->full_name ?? 'Not specified' }}</p>
                        </div>
                        <div class="form-group">
                            <label>Appointment ID</label>
                            <p class="record-info-value">{{ $prescription->appointment_id }}</p>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Medication</label>
                            <p class="record-info-value">{{ $prescription->medication }}</p>
                        </div>
                        <div class="form-group">
                            <label>Dosage</label>
                            <p class="record-info-value">{{ $prescription->dosage }}</p>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Frequency</label>
                            <p class="record-info-value">{{ ucwords(str_replace('-', ' ', $prescription->frequency)) }}</p>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Start Date</label>
                            <p class="record-info-value">{{ \Carbon\Carbon::parse($prescription->start_date)->format('F d, Y') }}</p>
                        </div>
                        <div class="form-group">
                            <label>End Date</label>
                            <p class="record-info-value">{{ $prescription->end_date ? \Carbon\Carbon::parse($prescription->end_date)->format('F d, Y') : 'Not specified' }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Special Instructions</label>
                        <p class="record-info-value">{{ $prescription->instructions ?? 'No instructions provided' }}</p>
                    </div>
                </div>
            @else
                <p class="text-light">No prescription available.</p>
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