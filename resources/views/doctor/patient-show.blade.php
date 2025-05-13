@extends('doctor.layout')

@section('title', 'Patient Details | Medical Clinic')

@section('content')


 <!-- Main Content -->
<main class="main-content">
    <div class="page-header-with-actions">
        <div>
            <h1>Patient Details</h1>
            <p class="text-muted">View and manage patient information</p>
        </div>
    </div>

    <!-- Patient Information -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Patient Information</h3>
            {{-- <a href="#" class="card-link">
                View Full Profile <i class="fas fa-arrow-right"></i>
            </a> --}}
        </div>
        <div class="record-details">
            <div class="patient-cell" style="margin-bottom: 20px;">
                <div class="patient-avatar">
                    {{ strtoupper(substr($patient->first_name, 0, 1) . substr($patient->last_name, 0, 1)) }}
                </div>
                <div>
                    <div style="font-weight: bold; font-size: 16px;">
                        {{ $patient->full_name }}
                    </div>
                </div>
            </div>
            <div class="record-info-grid">
                <div class="record-info-item">
                    <div class="record-info-label">Date of Birth</div>
                    <div class="record-info-value">{{ \Carbon\Carbon::parse($patient->birthdate)->format('F d, Y') }}</div>
                </div>
                <div class="record-info-item">
                    <div class="record-info-label">Age</div>
                    <div class="record-info-value">{{ \Carbon\Carbon::parse($patient->birthdate)->age }} years</div>
                </div>
                <div class="record-info-item">
                    <div class="record-info-label">Gender</div>
                    <div class="record-info-value">{{ $patient->gender }}</div>
                </div>
                <div class="record-info-item">
                    <div class="record-info-label">Phone</div>
                    <div class="record-info-value">{{ $patient->contact_number }}</div>
                </div>
                <div class="record-info-item">
                    <div class="record-info-label">Email</div>
                    <div class="record-info-value">{{ $patient->user->email }}</div>
                </div>
            </div>
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