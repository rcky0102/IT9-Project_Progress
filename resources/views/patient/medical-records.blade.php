@extends('patient.layout')

@section('title', 'Medical Records | Medical Clinic')

@section('content')

<!-- Main Content -->
<main class="main-content">
    <div class="page-header">
        <h1>Medical Records</h1>
        <button class="btn btn-outline">
            <i class="fas fa-download"></i> Download All Records
        </button>
    </div>

    <!-- Medical Records Filters -->
    <div class="filters-container">
        <div class="filters">
            <button class="filter-btn active">All</button>
            <button class="filter-btn">Consultations</button>
            <button class="filter-btn">Lab Results</button>
            <button class="filter-btn">Imaging</button>
            <button class="filter-btn">Procedures</button>
        </div>
        <div class="search-container">
            <input type="text" class="search-input" placeholder="Search records...">
            <button class="search-btn"><i class="fas fa-search"></i></button>
        </div>
    </div>

    <!-- Timeline View -->
    <div class="timeline-container">

            <div class="timeline-items">
                @foreach($medicalRecords as $year => $records)
                    <div class="timeline-year">
                        <h3>{{ $year }}</h3>
                        <div class="timeline-items">
                            @foreach ($records as $medicalRecord)
                                <div class="timeline-item">
                                    <div class="timeline-date">
                                        <div class="timeline-date-day">{{ \Carbon\Carbon::parse($medicalRecord->date)->format('d') }}</div>
                                        <div class="timeline-date-month">{{ \Carbon\Carbon::parse($medicalRecord->date)->format('M') }}</div>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="timeline-header">
                                            <h4>{{ optional($medicalRecord->recordType)->name }}</h4>
                                            <span class="badge {{ Str::slug(optional($medicalRecord->recordType)->name, '-') }}">{{ optional($medicalRecord->recordType)->name }}</span>
                                        </div>
                                        <div class="timeline-details">
                                            <p><strong>Diagnosis:</strong> {{ $medicalRecord->diagnosis }}</p> <!-- Diagnosis added here -->
                                            <p><strong>Notes:</strong> {{ $medicalRecord->notes }}</p> <!-- Existing notes section -->
                                            <div class="timeline-meta">
                                                <span><i class="fas fa-user-md"></i> {{ optional($medicalRecord->appointment->doctor)->full_name ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                        <div class="timeline-actions">
                                            <a href="#" class="btn btn-sm btn-outline">View Details</a>
                                            <a href="#" class="btn btn-sm btn-outline">Download PDF</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

        <div class="timeline-year">
            <h3>2024</h3>
            <div class="timeline-items">
                <div class="timeline-item">
                    <div class="timeline-date">
                        <div class="timeline-date-day">12</div>
                        <div class="timeline-date-month">Dec</div>
                    </div>
                    <div class="timeline-content">
                        <div class="timeline-header">
                            <h4>Chest X-Ray</h4>
                            <span class="badge imaging">Imaging</span>
                        </div>
                        <div class="timeline-details">
                            <p>Routine chest X-ray. No abnormalities detected. Lungs clear. Heart size normal.</p>
                            <div class="timeline-meta">
                                <span><i class="fas fa-x-ray"></i> Radiology Department</span>
                                <span><i class="fas fa-user-md"></i> Dr. Robert Williams</span>
                            </div>
                        </div>
                        <div class="timeline-actions">
                            <button class="btn btn-sm btn-outline">View Images</button>
                            <button class="btn btn-sm btn-outline">Download Report</button>
                        </div>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-date">
                        <div class="timeline-date-day">05</div>
                        <div class="timeline-date-month">Oct</div>
                    </div>
                    <div class="timeline-content">
                        <div class="timeline-header">
                            <h4>Annual Physical</h4>
                            <span class="badge consultation">Consultation</span>
                        </div>
                        <div class="timeline-details">
                            <p>Comprehensive annual physical examination. All vital signs normal. Recommended lifestyle modifications for optimal health.</p>
                            <div class="timeline-meta">
                                <span><i class="fas fa-user-md"></i> Dr. Sarah Johnson</span>
                                <span><i class="fas fa-clinic-medical"></i> Main Clinic</span>
                            </div>
                        </div>
                        <div class="timeline-actions">
                            <button class="btn btn-sm btn-outline">View Details</button>
                            <button class="btn btn-sm btn-outline">Download PDF</button>
                        </div>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-date">
                        <div class="timeline-date-day">18</div>
                        <div class="timeline-date-month">Jul</div>
                    </div>
                    <div class="timeline-content">
                        <div class="timeline-header">
                            <h4>Minor Surgical Procedure</h4>
                            <span class="badge procedure">Procedure</span>
                        </div>
                        <div class="timeline-details">
                            <p>Removal of skin lesion on right forearm. Procedure completed successfully. Biopsy results benign.</p>
                            <div class="timeline-meta">
                                <span><i class="fas fa-user-md"></i> Dr. Emily Rodriguez</span>
                                <span><i class="fas fa-clinic-medical"></i> Surgical Center</span>
                            </div>
                        </div>
                        <div class="timeline-actions">
                            <button class="btn btn-sm btn-outline">View Details</button>
                            <button class="btn btn-sm btn-outline">Download PDF</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Health Summary -->
<div class="health-summary">
    <h3>Health Summary</h3>
    <div class="summary-cards">
        <div class="summary-card">
            <div class="summary-icon">
                <i class="fas fa-heartbeat"></i>
            </div>
            <div class="summary-details">
                <h4>Vital Signs</h4>
                @if($latestRecord)
                <ul class="summary-list">
                    <li><span>Blood Pressure:</span> {{ $latestRecord->blood_pressure ?? 'N/A' }} mmHg</li>
                    <li><span>Heart Rate:</span> {{ $latestRecord->heart_rate ?? 'N/A' }} bpm</li>
                    <li><span>Temperature:</span> {{ $latestRecord->temperature ?? 'N/A' }} °F</li>
                    <li><span>Respiratory Rate:</span> {{ $latestRecord->respiratory_rate ?? 'N/A' }} breaths/min</li>
                </ul>
                <div class="summary-date">Last updated: {{ \Carbon\Carbon::parse($latestRecord->date)->format('M d, Y') }}</div>
                @else
                <p>No recent vital signs available.</p>
                @endif
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon">
                <i class="fas fa-notes-medical"></i>
            </div>
            <div class="summary-details">
                <h4>Conditions</h4>
                @if($latestDiagnoses && $latestDiagnoses->count())
                    <ul class="summary-list">
                        @foreach($latestDiagnoses as $date => $diagnosis)
                            <li>{{ $diagnosis }}</li>
                        @endforeach
                    </ul>
                    <div class="summary-date">
                        Last updated: {{ \Carbon\Carbon::parse($latestDiagnoses->keys()->first())->format('M d, Y') }}
                    </div>
                @else
                    <p>No recent diagnoses found.</p>
                @endif
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

// Filter buttons
const filterBtns = document.querySelectorAll('.filter-btn');
filterBtns.forEach(btn => {
    btn.addEventListener('click', function() {
        filterBtns.forEach(b => b.classList.remove('active'));
        this.classList.add('active');
    });
});
});
</script>

@endsection