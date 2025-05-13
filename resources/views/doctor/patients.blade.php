@extends('doctor.layout')

@section('title', 'Patients | Medical Clinic')

@section('content')

            <!-- Main Content -->
            <main class="main-content">
                <div class="page-header-with-actions">
                    <div>
                        <h1>Patients</h1>
                        <p class="text-muted">Manage your patient database</p>
                    </div>
                    {{-- <button class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Add New Patient
                    </button> --}}
                </div>

                <!-- Filters -->
                <div class="filters-container">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search patients...">
                    </div>
                    {{-- <select class="filter-select">
                        <option value="">All Diagnoses</option>
                        <option value="hypertension">Hypertension</option>
                        <option value="diabetes">Diabetes</option>
                        <option value="asthma">Asthma</option>
                        <option value="arthritis">Arthritis</option>
                    </select>
                    <select class="filter-select">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select> --}}
                </div>

                <!-- Patient Stats -->
                <div class="dashboard-cards">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Total Patients</h3>
                            <div class="card-icon">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">145</div>
                            <div class="card-label">Registered patients</div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">New Patients</h3>
                            <div class="card-icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">12</div>
                            <div class="card-label">This month</div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Appointments</h3>
                            <div class="card-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-value">28</div>
                            <div class="card-label">This month</div>
                        </div>
                    </div>
                </div>

                <!-- Patient List -->
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Contact</th>
                                <th>Age/Gender</th>
                                <th>Last Visit</th>
                                <th>Diagnosis</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patients as $patient)
                            <tr>
                                <td>
                                    <div class="patient-cell">
                                        <div class="patient-avatar">
                                            <span class="avatar-fallback">
                                                {{ strtoupper(substr($patient->user->first_name, 0, 1)) }}
                                                {{ strtoupper(substr($patient->user->last_name, 0, 1)) }}
                                            </span>
                                        </div>
                                        <div>{{ $patient->user->first_name }} {{ $patient->user->middle_name }} {{ $patient->user->last_name }}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="contact-cell">
                                        <div>{{ $patient->user->email }}</div>
                                        <div class="text-muted">{{ $patient->contact_number }}</div>
                                    </div>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($patient->birthdate)->age }} / {{ $patient->gender }}</td>
                                <td>{{ \Carbon\Carbon::parse($patient->created_at)->format('F d, Y') }}</td>
                                @foreach($latestMedicalRecords as $medicalrecord)
                                <td>
                                    <span class="badge badge-outline">{{ $medicalrecord->diagnosis }}</span>
                                </td>
                                @endforeach
                                <td>
                                    <div class="appointment-actions">
                                        <a href="{{ route('doctor.patient-show', $patient->id) }}" class="btn btn-outline">View Details</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                {{-- <div class="pagination">
                    <button class="btn-icon pagination-btn"><i class="fas fa-chevron-left"></i></button>
                    <button class="pagination-btn active">1</button>
                    <button class="pagination-btn">2</button>
                    <button class="pagination-btn">3</button>
                    <span class="pagination-ellipsis">...</span>
                    <button class="pagination-btn">10</button>
                    <button class="btn-icon pagination-btn"><i class="fas fa-chevron-right"></i></button>
                </div> --}}
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