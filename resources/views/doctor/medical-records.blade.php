@extends('doctor.layout')

@section('title', 'Medical Records | Medical Clinic')

@section('content')

<!-- Main Content -->
<main class="main-content">
    <div class="page-header-with-actions">
        <div>
            <h1>Medical Records</h1>
            <p class="text-muted">View and manage patient medical records</p>
        </div>
        <a href="{{ route('doctor.medical-records-create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Create New Record
        </a>
    </div>

    <!-- Filters -->
    <div class="filters-container">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search records...">
        </div>
        <select class="filter-select">
            <option value="">All Patients</option>
            <option value="emma-wilson">Emma Wilson</option>
            <option value="james-brown">James Brown</option>
            <option value="olivia-martinez">Olivia Martinez</option>
            <option value="robert-johnson">Robert Johnson</option>
        </select>
        <select class="filter-select">
            <option value="">All Record Types</option>
            <option value="consultation">Consultation</option>
            <option value="lab-result">Lab Result</option>
            <option value="imaging">Imaging</option>
            <option value="surgery">Surgery</option>
        </select>
    </div>

    <!-- Records List -->
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Record Type</th>
                    <th>Date</th>
                    <th>Diagnosis</th>
                    <th>Created By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($medicalRecords as $record)
                <tr>
                    <td>
                        <div class="patient-cell">
                            <div class="patient-avatar">
                                <span class="avatar-fallback">
                                    {{ strtoupper(substr($record->appointment->patient->first_name, 0, 1) . substr($record->appointment->patient->last_name, 0, 1)) }}
                                </span>
                            </div>
                            <div>{{ $record->appointment->patient->full_name }}</div>
                        </div>
                    </td>
                    <td>{{ $record->recordType->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($record->date)->format('F d, Y') }}</td>
                    <td>
                        <span class="badge badge-outline">{{ $record->diagnosis }}</span>
                    </td>
                    <td>{{ $record->appointment->doctor->full_name }}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn-icon">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-eye"></i> View Record
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-edit"></i> Edit Record
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-print"></i> Print Record
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-share"></i> Share Record
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach

                
            </tbody>
        </table>
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
});
</script>

@endsection