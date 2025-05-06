@extends('doctor.layout')

@section('title', 'Medical Records | Medical Clinic')

@section('content')

 <!-- Main Content -->
 <main class="main-content">
    <div class="page-header-with-actions">
        <div>
            <h1>Create Medical Record</h1>
            <p class="text-muted">Add a new medical record for a patient</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Record Information</h3>
        </div>
        <form class="record-form">
            <div class="form-row">
                <div class="form-group">
                    <label for="patient">Patient *</label>
                    <select id="patient" class="form-control" required>
                        <option value="">Select a patient</option>
                        <option value="1">Emma Wilson</option>
                        <option value="2">James Brown</option>
                        <option value="3">Olivia Martinez</option>
                        <option value="4">Robert Johnson</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="record-type">Record Type *</label>
                    <select id="record-type" class="form-control" required>
                        <option value="">Select record type</option>
                        <option value="consultation">Consultation</option>
                        <option value="lab_result">Lab Result</option>
                        <option value="imaging">Imaging</option>
                        <option value="surgery">Surgery</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="date">Date *</label>
                    <input type="date" id="date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="diagnosis">Diagnosis *</label>
                    <input type="text" id="diagnosis" class="form-control" placeholder="Enter diagnosis" required>
                </div>
            </div>

            <h4 class="section-title">Vital Signs</h4>
            <div class="form-row">
                <div class="form-group">
                    <label for="blood-pressure">Blood Pressure</label>
                    <input type="text" id="blood-pressure" class="form-control" placeholder="e.g. 120/80 mmHg">
                </div>
                <div class="form-group">
                    <label for="temperature">Temperature</label>
                    <input type="text" id="temperature" class="form-control" placeholder="e.g. 98.6 °F">
                </div>
                <div class="form-group">
                    <label for="heart-rate">Heart Rate</label>
                    <input type="text" id="heart-rate" class="form-control" placeholder="e.g. 72 bpm">
                </div>
                <div class="form-group">
                    <label for="respiratory-rate">Respiratory Rate</label>
                    <input type="text" id="respiratory-rate" class="form-control" placeholder="e.g. 16 breaths/min">
                </div>
            </div>

            <div class="form-group">
                <label for="notes">Notes *</label>
                <textarea id="notes" class="form-control" rows="6" placeholder="Enter detailed notes about the patient's condition, treatment plan, etc." required></textarea>
            </div>

            <div class="form-actions">
                <a href="medical-records.html" class="btn btn-outline">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Record
                </button>
            </div>
        </form>
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

// Form submission (prevent default for demo)
const form = document.querySelector('.record-form');
if (form) {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Record created successfully!');
        window.location.href = 'medical-records.html';
    });
}
});
</script>

@endsection