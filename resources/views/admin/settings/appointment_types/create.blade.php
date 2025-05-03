@extends('admin.settings.index')

@section('title', 'Create Appointment Type | Admin Settings | Medical Clinic')

@section('content')

            <main class="settings-content">
                <div class="settings-section">
                    <div class="settings-header">
                        <h1>Create Specialization</h1>
                        <p>Add a new medical specialization to the system</p>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <form id="specialization-form" action="{{ route('admin.settings.appointment_types.store') }}" method="POST">
                                @csrf
                                <div class="form-section">
                                    <h3 class="form-section-title">Basic Information</h3>
                                    <div class="form-row">
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label for="name" class="required-field">Appointment Type Name</label>
                                                <input type="text" id="name" name="name" class="form-control" required>
                                                <small class="form-text text-muted">Enter the full name of the specialization</small>
                                            </div>
                                        </div>
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label for="specialization_ids" class="required-field">Specializations</label>
                                                <select id="specialization_ids" name="specialization_ids[]" class="form-control" multiple required>
                                                    @foreach($specializations as $specialization)
                                                        <option value="{{ $specialization->id }}">{{ $specialization->specialization_name }}</option>
                                                    @endforeach
                                                </select>
                                                <small class="form-text text-muted">Select one or more specializations related to this appointment type.</small>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea id="description" name="description" class="form-control" rows="3"></textarea>
                                        <small class="form-text text-muted">Provide a brief description of the specialization's focus and services</small>
                                    </div> --}}
                                </div>

                                {{-- <div class="form-section">
                                    <h3 class="form-section-title">Qualification Requirements</h3>
                                    <div class="form-group">
                                        <label for="specialization-qualifications">Required Qualifications</label>
                                        <textarea id="specialization-qualifications" name="qualifications" class="form-control" rows="3"></textarea>
                                        <small class="form-text text-muted">List the qualifications required for doctors in this specialization</small>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label for="specialization-experience">Minimum Experience (Years)</label>
                                                <input type="number" id="specialization-experience" name="experience" class="form-control" min="0" value="0">
                                                <small class="form-text text-muted">Minimum years of experience required</small>
                                            </div>
                                        </div>
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label for="specialization-certification">Certification Required</label>
                                                <select id="specialization-certification" name="certification" class="form-control">
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                                <small class="form-text text-muted">Is specialized certification required?</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-section">
                                    <h3 class="form-section-title">Additional Settings</h3>
                                    <div class="form-row">
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label for="specialization-status">Status</label>
                                                <select id="specialization-status" name="status" class="form-control">
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                </select>
                                                <small class="form-text text-muted">Set the current status of the specialization</small>
                                            </div>
                                        </div>
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label for="specialization-order">Display Order</label>
                                                <input type="number" id="specialization-order" name="order" class="form-control" value="0" min="0">
                                                <small class="form-text text-muted">Order in which the specialization appears in lists (0 = default)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="form-actions">
                                    <a href="specializations-index.html" class="btn btn-outline">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Create Appointment Type</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

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