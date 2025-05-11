@extends('admin.settings.index')

@section('title', 'Departments | Admin Settings | Medical Clinic')

@section('content')

            <!-- Main Content -->
            <main class="settings-content">
                <!-- Doctor Departments Section -->
                <div class="settings-section" id="doctor-departments-section">
                    <div class="settings-header">
                        <h1>Doctor Departments</h1>
                        <p>Manage medical departments in the clinic</p>
                        <a href="{{ route('admin.settings.departments.create')}}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Department
                        </a>
                    </div>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Search and Filter -->
                    <div class="filters-container">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Search departments...">
                        </div>
                        <select class="filter-select">
                            <option value="all">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <!-- Departments Table -->
                    <div class="table-container">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Department Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($departments as $department)
                                    <tr>
                                        <td>{{ $department->department_name }}</td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="{{ route('admin.settings.departments.edit', $department->id) }}" class="btn-icon edit-btn">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.settings.departments.destroy', $department->id) }}" method="POST" style="display: inline;" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn-icon delete-btn" data-id="{{ $department->id }}">
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
                    

                    <!-- Pagination -->
                    <div class="pagination">
                        <button class="pagination-btn" disabled>
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="pagination-btn active">1</button>
                        <button class="pagination-btn">2</button>
                        <button class="pagination-btn">3</button>
                        <button class="pagination-btn">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal" id="delete-confirmation-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Confirm Delete</h2>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <p id="delete-confirmation-message">Are you sure you want to delete this department? This action cannot be undone.</p>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>Warning: Deleting a department will also affect all associated specializations and doctor assignments.</span>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" id="cancel-delete">Cancel</button>
                <button class="btn btn-danger" id="confirm-delete">Delete</button>
            </div>
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

            // Delete department
            const deleteBtns = document.querySelectorAll('.delete-btn');
            
            deleteBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const row = this.closest('tr');
                    const name = row.cells[0].textContent;
                    
                    // Show the confirmation modal
                    const modal = document.getElementById('delete-confirmation-modal');
                    const confirmationMessage = document.getElementById('delete-confirmation-message');
                    
                    confirmationMessage.textContent = `Are you sure you want to delete the "${name}" department? This action cannot be undone.`;
                    
                    modal.classList.add('show');
                    
                    // Set the department ID on the confirm button for later use
                    const confirmDeleteButton = document.getElementById('confirm-delete');
                    confirmDeleteButton.setAttribute('data-id', id);
                });
            });

            // Close modal
            const closeButtons = document.querySelectorAll('.close-modal');
            
            closeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    document.querySelectorAll('.modal').forEach(modal => {
                        modal.classList.remove('show');
                    });
                });
            });

            // Cancel delete
            document.getElementById('cancel-delete').addEventListener('click', function() {
                document.getElementById('delete-confirmation-modal').classList.remove('show');
            });

            // Confirm delete
            document.getElementById('confirm-delete').addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                
                // Find the corresponding form and submit it to delete the department
                const form = document.querySelector(`.delete-btn[data-id="${id}"]`).closest('form');
                form.submit();
                
                // Cancel delete
                document.getElementById('cancel-delete').addEventListener('click', function() {
                    document.getElementById('delete-confirmation-modal').classList.remove('show');
                });

                // Close modal when clicking outside
                window.addEventListener('click', function(e) {
                    if (e.target === document.getElementById('delete-confirmation-modal')) {
                        document.getElementById('delete-confirmation-modal').classList.remove('show');
                    }
                });
            });
        });
    </script>

@endsection
