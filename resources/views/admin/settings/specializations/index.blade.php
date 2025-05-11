<!DOCTYPE html>
@extends('admin.settings.index')

@section('title', 'Specializations | Admin Settings | Medical Clinic')

@section('content')

            <!-- Main Content -->
            <main class="settings-content">
                <!-- Doctor Specializations Section -->
                <div class="settings-section" id="doctor-specializations-section">
                    <div class="settings-header">
                        <h1>Doctor Specializations</h1>
                        <p>Manage medical specializations for doctors in the system</p>
                        <a href="{{ route('admin.settings.specializations.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Specialization
                        </a>
                    </div>


                    <!-- Search and Filter -->
                    <div class="filters-container">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Search specializations...">
                        </div>
                        <select class="filter-select">
                            <option value="all">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <!-- Specializations Table -->
                    <div class="table-container">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($specializations as $specialization)
                                    <tr>
                                        <td>{{ $specialization->specialization_name }}</td>
                                        <td>{{ $specialization->department->department_name }}</td>
                                        <td>{{ $specialization->description }}</td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="{{ route('admin.settings.specializations.edit', $specialization->id) }}" class="btn-icon edit-btn">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button"
                                                    class="btn-icon delete-btn"
                                                    data-id="{{ $specialization->id }}"
                                                    data-name="{{ $specialization->specialization_name }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
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
                <p id="delete-confirmation-message">Are you sure you want to delete this specialization? This action cannot be undone.</p>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>Warning: Deleting a specialization will also affect all associated doctor assignments.</span>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" id="cancel-delete">Cancel</button>
                <button class="btn btn-danger" id="confirm-delete">Delete</button>
            </div>
        </div>
    </div>
    <form id="delete-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

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

            // Delete specialization
            const deleteBtns = document.querySelectorAll('.delete-btn');
            
            deleteBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const row = this.closest('tr');
                    const name = row.cells[0].textContent;
                    
                    document.getElementById('delete-confirmation-modal').classList.add('show');
                    document.getElementById('delete-confirmation-message').textContent = `Are you sure you want to delete the "${name}" specialization? This action cannot be undone.`;
                    
                    // Store the ID for the delete confirmation
                    document.getElementById('confirm-delete').setAttribute('data-id', id);
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
            document.getElementById('confirm-delete').addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const deleteForm = document.getElementById('delete-form');
                const action = `/admin/settings/specializations/${id}`; 
                deleteForm.setAttribute('action', action);
                deleteForm.submit();
            });

            // Close modal when clicking outside
            window.addEventListener('click', function(e) {
                document.querySelectorAll('.modal').forEach(modal => {
                    if (e.target === modal) {
                        modal.classList.remove('show');
                    }
                });
            });
        });
    </script>

@endsection


