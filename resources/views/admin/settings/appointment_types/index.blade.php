@extends('admin.settings.index')

@section('title', 'Appointment Types | Admin Settings | Medical Clinic')

@section('content')

    <!-- Main Content -->
    <main class="settings-content">
        <!-- Appointment Types Section -->
        <div class="settings-section" id="appointment-types-section">
            <div class="settings-header">
                <h1>Appointment Types</h1>
                <p>Manage appointment types for doctors in the system</p>
                <a href="{{ route('admin.settings.appointment_types.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Appointment Type
                </a>
            </div>

            <!-- Search and Filter -->
            <div class="filters-container">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search appointment types...">
                </div>
                <select class="filter-select">
                    <option value="all">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <!-- Appointment Types Table -->
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Charge (₱)</th> 
                            <th>Specializations</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointmenttypes as $appointmenttype)
                            <tr>
                                <td>{{ $appointmenttype->name }}</td>
                                <td>₱{{ number_format($appointmenttype->charge, 2) }}</td> 
                                <td>
                                    @if($appointmenttype->specializations->isNotEmpty())
                                        {{ $appointmenttype->specializations->pluck('specialization_name')->implode(', ') }}
                                    @else
                                        None
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.settings.appointment_types.edit', $appointmenttype->id) }}" class="btn-icon edit-btn">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn-icon delete-btn" data-id="{{ $appointmenttype->id }}">
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

    <!-- Delete Confirmation Modal -->
    <div class="modal" id="delete-confirmation-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Confirm Delete</h2>
                <button class="close-modal">×</button>
            </div>
            <div class="modal-body">
                <p id="delete-confirmation-message">Are you sure you want to delete this appointment type? This action cannot be undone.</p>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>Warning: Deleting an appointment type will also affect all associated doctor assignments.</span>
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

            // Delete appointment type
            const deleteBtns = document.querySelectorAll('.delete-btn');
            
            deleteBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const row = this.closest('tr');
                    const name = row.cells[0].textContent;
                    
                    document.getElementById('delete-confirmation-modal').classList.add('show');
                    document.getElementById('delete-confirmation-message').textContent = `Are you sure you want to delete the "${name}" appointment type? This action cannot be undone.`;
                    
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
            document.getElementById('confirm-delete').addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const form = document.getElementById('delete-form');
                form.setAttribute('action', `/admin/settings/appointment_types/${id}`);
                form.submit();
                document.getElementById('delete-confirmation-modal').classList.remove('show');
            });

            // Close modal when clicking outside
            window.addEventListener('click', function(e) {
                document.querySelectorAll('.modal').forEach(modal => {
                    if (e.target === modal) {
                        modal.classList.remove('show');
                    }
                });
            });

            // Client-side search (live search)
            document.querySelector('.search-box input').addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                document.querySelectorAll('.data-table tbody tr').forEach(row => {
                    const name = row.cells[0].textContent.toLowerCase();
                    const specializations = row.cells[2].textContent.toLowerCase();
                    row.style.display = name.includes(searchTerm) || specializations.includes(searchTerm) ? '' : 'none';
                });
            });
        });
    </script>

@endsection
