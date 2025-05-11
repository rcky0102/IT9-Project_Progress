@extends('doctor.layout')

@section('title', 'Schedule | Medical Clinic')

@section('content')

            <!-- Main Content -->
            <main class="main-content">
                <div class="page-header-with-actions">
                    <div>
                        <h1>Schedule</h1>
                        <p class="text-muted">Manage your work schedule</p>
                    </div>
                    <div class="header-buttons">
                        <button class="btn btn-outline">
                            <i class="fas fa-sync"></i> Refresh
                        </button>
                        <a href="{{ route('doctor.schedule-create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Availability
                        </a>
                    </div>
                </div>

                

                <!-- Availability Settings -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-with-actions">
                            <h3 class="card-title">Availability Settings</h3>
                            <div class="card-actions">
                                <a href="{{ route('doctor.schedule-create') }}" class="btn btn-sm btn-outline">
                                    <i class="fas fa-plus"></i> Add New
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-container">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Working Days</th>
                                    <th>Hours</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($availabilities as $availability)
                                    <tr>
                                        <td>{{ $availability->name }}</td>
                                        <td>{{ $availability->day }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($availability->start_time)->format('g:i A') }} - 
                                            {{ \Carbon\Carbon::parse($availability->end_time)->format('g:i A') }}
                                        </td>
                                        <td>
                                            <span class="badge badge-outline-{{ $availability->status == 'Active' ? 'blue' : 'red' }}">
                                                {{ $availability->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="row-actions">
                                                <a href="#" class="btn-icon" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="#" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-icon delete-btn" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        
                    </div>
                </div>

                <!-- Delete Confirmation Dialog -->
                <div class="delete-confirmation" id="delete-confirmation" style="display: none;">
                    <div class="delete-confirmation-content">
                        <h3>Delete Availability</h3>
                        <p>Are you sure you want to delete this availability schedule? This action cannot be undone.</p>
                        <div class="delete-actions">
                            <button id="cancel-delete" class="btn btn-outline">Cancel</button>
                            <button id="confirm-delete" class="btn btn-danger">Delete</button>
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

            // View selector functionality
            const viewBtns = document.querySelectorAll('.view-btn');
            
            viewBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    viewBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Delete functionality
            const deleteBtns = document.querySelectorAll('.delete-btn');
            const deleteConfirmation = document.getElementById('delete-confirmation');
            const cancelDeleteBtn = document.getElementById('cancel-delete');
            const confirmDeleteBtn = document.getElementById('confirm-delete');

            deleteBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    deleteConfirmation.style.display = 'flex';
                });
            });

            cancelDeleteBtn.addEventListener('click', function() {
                deleteConfirmation.style.display = 'none';
            });

            confirmDeleteBtn.addEventListener('click', function() {
                deleteConfirmation.style.display = 'none';
                alert('Availability deleted successfully');
            });
        });
    </script>

@endsection