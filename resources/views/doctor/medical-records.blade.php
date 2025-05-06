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
                <tr>
                    <td>
                        <div class="patient-cell">
                            <div class="patient-avatar">
                                <span class="avatar-fallback">EW</span>
                            </div>
                            <div>Emma Wilson</div>
                        </div>
                    </td>
                    <td>Consultation</td>
                    <td>May 15, 2025</td>
                    <td>
                        <span class="badge badge-outline">Hypertension</span>
                    </td>
                    <td>Dr. John Smith</td>
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
                <tr>
                    <td>
                        <div class="patient-cell">
                            <div class="patient-avatar">
                                <span class="avatar-fallback">JB</span>
                            </div>
                            <div>James Brown</div>
                        </div>
                    </td>
                    <td>Lab Result</td>
                    <td>May 12, 2025</td>
                    <td>
                        <span class="badge badge-outline">Diabetes</span>
                    </td>
                    <td>Dr. John Smith</td>
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
                <tr>
                    <td>
                        <div class="patient-cell">
                            <div class="patient-avatar">
                                <span class="avatar-fallback">OM</span>
                            </div>
                            <div>Olivia Martinez</div>
                        </div>
                    </td>
                    <td>Imaging</td>
                    <td>May 8, 2025</td>
                    <td>
                        <span class="badge badge-outline">Asthma</span>
                    </td>
                    <td>Dr. John Smith</td>
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
                <tr>
                    <td>
                        <div class="patient-cell">
                            <div class="patient-avatar">
                                <span class="avatar-fallback">RJ</span>
                            </div>
                            <div>Robert Johnson</div>
                        </div>
                    </td>
                    <td>Consultation</td>
                    <td>May 5, 2025</td>
                    <td>
                        <span class="badge badge-outline">Arthritis</span>
                    </td>
                    <td>Dr. John Smith</td>
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
            </tbody>
        </table>
    </div>

    <!-- Record Details -->
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