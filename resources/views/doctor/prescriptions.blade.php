@extends('doctor.layout')

@section('title', 'Prescriptions | Medical Clinic')

@section('content')

            <!-- Main Content -->
            <main class="main-content">
                <div class="page-header-with-actions">
                    <div>
                        <h1>Prescriptions</h1>
                        <p class="text-muted">Manage patient prescriptions</p>
                    </div>
                    <a href="{{ route('doctor.prescription-create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        New Prescription
                    </a>                    
                </div>

                <!-- Filters -->
                <div class="filters-container">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search prescriptions...">
                    </div>
                    <select class="filter-select">
                        <option value="">All Patients</option>
                        <option value="emma-wilson">Emma Wilson</option>
                        <option value="james-brown">James Brown</option>
                        <option value="olivia-martinez">Olivia Martinez</option>
                        <option value="robert-johnson">Robert Johnson</option>
                    </select>
                    <select class="filter-select">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="completed">Completed</option>
                        <option value="expired">Expired</option>
                    </select>
                </div>

                <!-- Prescription Stats -->
                <div class="dashboard-cards">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Active Prescriptions</h3>
                            <div class="card-icon">
                                <i class="fas fa-prescription"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">28</div>
                            <div class="card-label">Currently active</div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Prescriptions This Month</h3>
                            <div class="card-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">42</div>
                            <div class="card-label">New prescriptions</div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Expiring Soon</h3>
                            <div class="card-icon">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">5</div>
                            <div class="card-label">Within 7 days</div>
                        </div>
                    </div>
                </div>

                <!-- Prescriptions List -->
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Medication</th>
                                <th>Dosage</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prescriptions as $prescription)
                            <tr>
                                <td>
                                    <div class="patient-cell">
                                        <div class="patient-avatar">
                                            <span class="avatar-fallback">
                                                {{ strtoupper(substr($prescription->appointment->patient->user->first_name, 0, 1)) }}
                                                {{ strtoupper(substr($prescription->appointment->patient->user->last_name, 0, 1)) }}
                                            </span>
                                        </div>
                                        <div>
                                            {{ $prescription->appointment->patient->full_name }}
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $prescription->medication }}</td>
                                <td>{{ $prescription->dosage }} - {{ ucfirst(str_replace('-', ' ', $prescription->frequency)) }}</td>
                                <td>{{ \Carbon\Carbon::parse($prescription->start_date)->format('M d, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($prescription->end_date)->format('M d, Y') }}</td>
                                <td>
                                    <span class="badge badge-outline-blue">Active</span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn-icon">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-eye"></i> View Details
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-edit"></i> Edit Prescription
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-print"></i> Print Prescription
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-envelope"></i> Email to Patient
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-times"></i> Cancel Prescription
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                            
                        </tbody>
                    </table>
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