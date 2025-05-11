@extends('patient.layout')

@section('title', 'Medications | Medical Clinic')

@section('content')

<!-- Main Content -->
<main class="main-content">
    <div class="page-header">
        <h1>Medications</h1>
        <button class="btn btn-outline">
            <i class="fas fa-print"></i> Print Medication List
        </button>
    </div>

    <!-- Medication Filters -->
    <div class="filters-container">
        <div class="filters">
            <button class="filter-btn active">All</button>
            <button class="filter-btn">Current</button>
            <button class="filter-btn">Past</button>
        </div>
        <div class="search-container">
            <input type="text" class="search-input" placeholder="Search medications...">
            <button class="search-btn"><i class="fas fa-search"></i></button>
        </div>
    </div>

    <!-- Current Medications -->
    <div class="medications-section">
        <h3>Current Medications</h3>
        <div class="medications-grid">
            @foreach ($prescriptions as $prescription)
                <div class="medication-card">
                    <div class="medication-header">
                        <h4>{{ $prescription->medication }}</h4>
                        <span class="badge">
                            {{ \Carbon\Carbon::now()->lessThanOrEqualTo($prescription->end_date) ? 'Active' : 'Expired' }}
                        </span>
                    </div>
                    <div class="medication-details">
                        <div class="medication-info">
                            <div class="info-item">
                                <span class="info-label">Dosage:</span>
                                <span class="info-value">{{ $prescription->dosage }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Frequency:</span>
                                <span class="info-value">{{ ucfirst(str_replace('-', ' ', $prescription->frequency)) }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Purpose:</span>
                                <span class="info-value">N/A</span> {{-- You can add a purpose column if needed --}}
                            </div>
                            <div class="info-item">
                                <span class="info-label">Prescribed:</span>
                                <span class="info-value">{{ \Carbon\Carbon::parse($prescription->start_date)->format('M d, Y') }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Ends:</span>
                                <span class="info-value">{{ \Carbon\Carbon::parse($prescription->end_date)->format('M d, Y') }}</span>
                            </div>
                        </div>
                        <div class="medication-instructions">
                            <h5>Instructions</h5>
                            <p>{{ $prescription->instructions ?? 'No specific instructions provided.' }}</p>
                        </div>
                    </div>
                    <div class="medication-actions">
                        <button class="btn btn-sm btn-outline">Request Refill</button>
                        <button class="btn btn-sm btn-outline">View Details</button>
                    </div>
                </div>
            @endforeach


            <div class="medication-card">
                <div class="medication-header">
                    <h4>Atorvastatin</h4>
                    <span class="badge">Active</span>
                </div>
                <div class="medication-details">
                    <div class="medication-info">
                        <div class="info-item">
                            <span class="info-label">Dosage:</span>
                            <span class="info-value">20mg</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Frequency:</span>
                            <span class="info-value">Once daily</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Purpose:</span>
                            <span class="info-value">Cholesterol management</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Prescribed:</span>
                            <span class="info-value">Mar 15, 2025</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Refills:</span>
                            <span class="info-value">2 remaining</span>
                        </div>
                    </div>
                    <div class="medication-instructions">
                        <h5>Instructions</h5>
                        <p>Take one tablet by mouth once daily in the evening. Take with food.</p>
                    </div>
                </div>
                <div class="medication-actions">
                    <button class="btn btn-sm btn-outline">Request Refill</button>
                    <button class="btn btn-sm btn-outline">View Details</button>
                </div>
            </div>

            <div class="medication-card">
                <div class="medication-header">
                    <h4>Loratadine</h4>
                    <span class="badge">Active</span>
                </div>
                <div class="medication-details">
                    <div class="medication-info">
                        <div class="info-item">
                            <span class="info-label">Dosage:</span>
                            <span class="info-value">10mg</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Frequency:</span>
                            <span class="info-value">Once daily as needed</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Purpose:</span>
                            <span class="info-value">Allergy relief</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Prescribed:</span>
                            <span class="info-value">Feb 28, 2025</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Refills:</span>
                            <span class="info-value">5 remaining</span>
                        </div>
                    </div>
                    <div class="medication-instructions">
                        <h5>Instructions</h5>
                        <p>Take one tablet by mouth once daily as needed for allergy symptoms. May cause drowsiness.</p>
                    </div>
                </div>
                <div class="medication-actions">
                    <button class="btn btn-sm btn-outline">Request Refill</button>
                    <button class="btn btn-sm btn-outline">View Details</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Past Medications -->
    <div class="medications-section">
        <h3>Past Medications</h3>
        <div class="medications-grid">
            <div class="medication-card past">
                <div class="medication-header">
                    <h4>Amoxicillin</h4>
                    <span class="badge inactive">Completed</span>
                </div>
                <div class="medication-details">
                    <div class="medication-info">
                        <div class="info-item">
                            <span class="info-label">Dosage:</span>
                            <span class="info-value">500mg</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Frequency:</span>
                            <span class="info-value">Three times daily</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Purpose:</span>
                            <span class="info-value">Bacterial infection</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Prescribed:</span>
                            <span class="info-value">Dec 10, 2024</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">End Date:</span>
                            <span class="info-value">Dec 20, 2024</span>
                        </div>
                    </div>
                    <div class="medication-instructions">
                        <h5>Instructions</h5>
                        <p>Take one capsule by mouth three times daily for 10 days. Take with food.</p>
                    </div>
                </div>
                <div class="medication-actions">
                    <button class="btn btn-sm btn-outline">View Details</button>
                </div>
            </div>

            <div class="medication-card past">
                <div class="medication-header">
                    <h4>Prednisone</h4>
                    <span class="badge inactive">Completed</span>
                </div>
                <div class="medication-details">
                    <div class="medication-info">
                        <div class="info-item">
                            <span class="info-label">Dosage:</span>
                            <span class="info-value">Tapering dose</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Frequency:</span>
                            <span class="info-value">Once daily</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Purpose:</span>
                            <span class="info-value">Inflammation</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Prescribed:</span>
                            <span class="info-value">Nov 05, 2024</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">End Date:</span>
                            <span class="info-value">Nov 15, 2024</span>
                        </div>
                    </div>
                    <div class="medication-instructions">
                        <h5>Instructions</h5>
                        <p>Follow tapering schedule as directed. Take with food in the morning.</p>
                    </div>
                </div>
                <div class="medication-actions">
                    <button class="btn btn-sm btn-outline">View Details</button>
                </div>
            </div>
        </div>
    </div>

    {{-- <!-- Medication Schedule -->
    <div class="medication-schedule">
        <h3>Daily Medication Schedule</h3>
        <div class="schedule-container">
            <div class="schedule-time">
                <h4>Morning</h4>
                <div class="schedule-items">
                    <div class="schedule-item">
                        <div class="schedule-item-name">Lisinopril 10mg</div>
                        <div class="schedule-item-time">8:00 AM</div>
                    </div>
                </div>  
            </div>
            <div class="schedule-time">
                <h4>Afternoon</h4>
                <div class="schedule-items">
                    <div class="schedule-item">
                        <div class="schedule-item-name">Loratadine 10mg</div>
                        <div class="schedule-item-time">As needed</div>
                    </div>
                </div>
            </div>
            <div class="schedule-time">
                <h4>Evening</h4>
                <div class="schedule-items">
                    <div class="schedule-item">
                        <div class="schedule-item-name">Atorvastatin 20mg</div>
                        <div class="schedule-item-time">8:00 PM</div>
                    </div>
                </div>
            </div>
        </div>
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