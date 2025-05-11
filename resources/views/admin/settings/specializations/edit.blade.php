@extends('admin.settings.index')

@section('title', 'Edit Specialization | Admin Settings | Medical Clinic')

@section('content')

<main class="settings-content">
    <div class="settings-section">
        <div class="settings-header">
            <h1>Edit Specialization</h1>
            <p>Edit the details of an existing medical specialization in the system</p>
        </div>

        <div class="card">
            <div class="card-body">
                <form id="specialization-form" action="{{ route('admin.settings.specializations.update', $specialization->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-section">
                        <h3 class="form-section-title">Basic Information</h3>
                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="specialization_name" class="required-field">Specialization Name</label>
                                    <input type="text" id="specialization_name" name="specialization_name" class="form-control" value="{{ $specialization->specialization_name }}" required>
                                    <small class="form-text text-muted">Enter the full name of the specialization</small>
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="department_id" class="required-field">Department</label>
                                    <select id="department_id" name="department_id" class="form-control" required>
                                        <option value="">Select Department</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}" {{ $department->id == $specialization->department_id ? 'selected' : '' }}>
                                                {{ $department->department_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="form-text text-muted">Select the department this specialization belongs to</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="form-control" rows="3">{{ $specialization->description }}</textarea>
                            <small class="form-text text-muted">Provide a brief description of the specialization's focus and services</small>
                        </div>
                    </div>

                    {{-- Optional Section for Qualifications, Experience, etc. --}}
                    {{-- You can uncomment and customize if you have those fields available --}}
                    {{-- <div class="form-section">
                        <h3 class="form-section-title">Qualification Requirements</h3>
                        <div class="form-group">
                            <label for="specialization-qualifications">Required Qualifications</label>
                            <textarea id="specialization-qualifications" name="qualifications" class="form-control" rows="3">{{ $specialization->qualifications }}</textarea>
                            <small class="form-text text-muted">List the qualifications required for doctors in this specialization</small>
                        </div>
                    </div> --}}

                    <div class="form-actions">
                        <a href="{{ route('admin.settings.specializations.index') }}" class="btn btn-outline">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Specialization</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Dropdown functionality
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

        // Form submission
        document.getElementById('specialization-form').addEventListener('submit', function(e) {
            // In a real application, you would handle the form submission via AJAX
            // For this example, we'll just redirect to the specializations index page
            // e.preventDefault();
            // window.location.href = 'specializations-index.html';
        });
    });
</script>

@endsection
