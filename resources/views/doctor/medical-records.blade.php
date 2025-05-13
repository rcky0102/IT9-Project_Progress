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
        <form action="{{ route('doctor.medical-records-index') }}" method="GET" class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" name="search" placeholder="Search records..." value="{{ request('search') }}">
        </form>
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
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                @foreach($medicalRecords as $record)
                <tr>
                    <td>
                        <div class="patient-cell">
                            <div class="patient-avatar">
                                <span class="avatar-fallback">
                                    {{ strtoupper(substr($record->appointment->patient->user->first_name, 0, 1) . substr($record->appointment->patient->user->last_name, 0, 1)) }}
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
                        <!-- Edit and Delete Icon Buttons -->
                        <div class="action-buttons">
                            <!-- Edit Button -->
                            <a href="{{ route('doctor.medical-records-edit', $record->id) }}" class="btn-icon">
                                <i class="fas fa-edit" title="Edit Record"></i>
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('doctor.medical-records-destroy', $record->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon" style="border: none; background: none;">
                                    <i class="fas fa-trash" title="Delete Record"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- <!-- Record Details -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Record Details</h3>
            <div class="card-actions">
                <button class="btn btn-outline">
                    <i class="fas fa-print"></i> Print
                </button>
                <button class="btn btn-outline">
                    <i class="fas fa-share"></i> Share
                </button>
            </div>
        </div>
        <div class="record-details">
            <div class="record-section">
                <h4 class="record-section-title">Patient Information</h4>
                <div class="record-info-grid">
                    <div class="record-info-item">
                        <div class="record-info-label">Name</div>
                        <div class="record-info-value">Emma Wilson</div>
                    </div>
                    <div class="record-info-item">
                        <div class="record-info-label">Age/Gender</div>
                        <div class="record-info-value">42 / Female</div>
                    </div>
                    <div class="record-info-item">
                        <div class="record-info-label">Contact</div>
                        <div class="record-info-value">+1 (555) 123-4567</div>
                    </div>
                    <div class="record-info-item">
                        <div class="record-info-label">Email</div>
                        <div class="record-info-value">emma.wilson@example.com</div>
                    </div>
                </div>
            </div>

            <div class="record-section">
                <h4 class="record-section-title">Consultation Details</h4>
                <div class="record-info-grid">
                    <div class="record-info-item">
                        <div class="record-info-label">Date</div>
                        <div class="record-info-value">May 15, 2025</div>
                    </div>
                    <div class="record-info-item">
                        <div class="record-info-label">Doctor</div>
                        <div class="record-info-value">Dr. John Smith</div>
                    </div>
                    <div class="record-info-item">
                        <div class="record-info-label">Diagnosis</div>
                        <div class="record-info-value">Hypertension</div>
                    </div>
                    <div class="record-info-item">
                        <div class="record-info-label">Blood Pressure</div>
                        <div class="record-info-value">140/90 mmHg</div>
                    </div>
                </div>
            </div>

            <div class="record-section">
                <h4 class="record-section-title">Notes</h4>
                <div class="record-notes">
                    <p>Patient presented with elevated blood pressure readings over the past month. Reported occasional headaches and dizziness. Physical examination revealed no other significant findings.</p>
                    <p>Recommended lifestyle modifications including reduced sodium intake, regular exercise, and stress management. Prescribed lisinopril 10mg daily. Follow-up appointment scheduled in 2 weeks to assess response to treatment.</p>
                </div>
            </div>
        </div>
    </div> --}}
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