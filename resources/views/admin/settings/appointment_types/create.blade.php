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
                                                <label for="charge" class="required-field">Charge (₱)</label>
                                                <input type="number" id="charge" name="charge" class="form-control" step="0.01" min="0" required>
                                                <small class="form-text text-muted">Enter the price charged for this appointment type</small>
                                            </div>
                                        </div>
                            
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label class="required-field">Specializations</label>
                                                <div>
                                                    @foreach($specializations as $specialization)
                                                        <div class="form-check">
                                                            <label class="form-check-label d-flex align-items-center">
                                                                <input 
                                                                    type="checkbox" 
                                                                    id="specialization_{{ $specialization->id }}" 
                                                                    name="specialization_ids[]" 
                                                                    value="{{ $specialization->id }}" 
                                                                    class="form-check-input me-2"
                                                                >
                                                                {{ $specialization->specialization_name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <small class="form-text text-muted">
                                                    Select one or more specializations related to this appointment type.
                                                </small>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            
                                <div class="form-actions">
                                    <a onclick="history.back()" class="btn btn-outline">Cancel</a>
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