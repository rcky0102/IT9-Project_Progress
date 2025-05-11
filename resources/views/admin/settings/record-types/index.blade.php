@extends('admin.settings.index')

@section('title', 'Record Types | Admin Settings | Medical Clinic')

@section('content')

<!-- Main Content -->
<main class="settings-content">
    <!-- Record Types Section -->
    <div class="settings-section" id="record-types-section">
        <div class="settings-header">
            <h1>Record Types</h1>
            <p>Manage medical record types in the system</p>
            <a href="{{ route('admin.settings.record-types.create') }}" class="btn btn-primary" id="add-record-type-btn">
                <i class="fas fa-plus"></i> Add Record Type
            </a>
        </div>

        <!-- Search and Filter -->
        <div class="filters-container">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search record types...">
            </div>
            <select class="filter-select">
                <option value="all">All Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <!-- Record Types Table -->
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Specializations</th>
                        <th>Fields</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($recordTypes as $recordType)
                        <tr>
                            <td>{{ $recordType->name }}</td>
                            <td>{{ implode(', ', $recordType->specializations->pluck('name')->toArray()) }}</td>
                            <td>{{ $recordType->fields->count() }} fields</td>
                            <td>
                                <span class="badge {{ $recordType->status === 'active' ? 'badge-success' : 'badge-warning' }}">
                                    {{ ucfirst($recordType->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.settings.record-types.edit', $recordType->id) }}" class="btn-icon edit-btn">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.settings.record-types.destroy', $recordType->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon delete-btn" onclick="return confirm('Are you sure you want to delete this record type?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    <!-- <tr>
                        <td>Consultation</td>
                        <td>General Medicine, Cardiology, Neurology</td>
                        <td>8 fields</td>
                        <td><span class="badge badge-success">Active</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-icon edit-btn" data-id="1">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-icon delete-btn" data-id="1">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr> -->
                    <!-- <tr>
                        <td>Lab Result</td>
                        <td>Pathology, Hematology</td>
                        <td>12 fields</td>
                        <td><span class="badge badge-success">Active</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-icon edit-btn" data-id="2">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-icon delete-btn" data-id="2">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr> -->
                    <!-- <tr>
                        <td>Imaging</td>
                        <td>Radiology, Cardiology</td>
                        <td>6 fields</td>
                        <td><span class="badge badge-success">Active</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-icon edit-btn" data-id="3">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-icon delete-btn" data-id="3">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr> -->
                    <!-- <tr>
                        <td>Surgery</td>
                        <td>General Surgery, Orthopedics</td>
                        <td>15 fields</td>
                        <td><span class="badge badge-success">Active</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-icon edit-btn" data-id="4">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-icon delete-btn" data-id="4">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr> -->
                    <!-- <tr>
                        <td>Prescription</td>
                        <td>All Specializations</td>
                        <td>5 fields</td>
                        <td><span class="badge badge-warning">Inactive</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-icon edit-btn" data-id="5">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-icon delete-btn" data-id="5">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr> -->
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
    <p id="delete-confirmation-message">Are you sure you want to delete this record type? This action cannot be undone.</p>
    <div class="alert alert-warning" style="background-color: #fff3cd; color: #856404; padding: 15px; border-radius: 6px; margin-top: 15px; display: flex; align-items: flex-start; gap: 10px;">
        <i class="fas fa-exclamation-triangle"></i>
        <span>Warning: Deleting a record type will affect all existing medical records of this type and may cause data loss.</span>
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

// Open add record type modal
document.getElementById('add-record-type-btn').addEventListener('click', function() {
    document.getElementById('modal-title').textContent = 'Add Record Type';
    document.getElementById('record-type-form').reset();
    document.getElementById('record-type-modal').classList.add('show');
});

// Open edit record type modal
const editBtns = document.querySelectorAll('.edit-btn');

editBtns.forEach(btn => {
    btn.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const row = this.closest('tr');
        const name = row.cells[0].textContent;
        
        document.getElementById('modal-title').textContent = 'Edit Record Type';
        document.getElementById('record-type-name').value = name;
        
        // Set other form values based on the record type
        // This would typically come from an API in a real application
        
        document.getElementById('record-type-modal').classList.add('show');
    });
});

// Delete record type
const deleteBtns = document.querySelectorAll('.delete-btn');

deleteBtns.forEach(btn => {
    btn.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const row = this.closest('tr');
        const name = row.cells[0].textContent;
        
        document.getElementById('delete-confirmation-modal').classList.add('show');
        document.getElementById('delete-confirmation-message').textContent = `Are you sure you want to delete the "${name}" record type? This action cannot be undone.`;
        
        // Store the ID for the delete confirmation
        document.getElementById('confirm-delete').setAttribute('data-id', id);
    });
});

// Close modals
const closeButtons = document.querySelectorAll('.close-modal');

closeButtons.forEach(button => {
    button.addEventListener('click', function() {
        document.querySelectorAll('.modal').forEach(modal => {
            modal.classList.remove('show');
        });
    });
});

// Cancel buttons
document.getElementById('cancel-btn').addEventListener('click', function() {
    document.getElementById('record-type-modal').classList.remove('show');
});

document.getElementById('cancel-delete').addEventListener('click', function() {
    document.getElementById('delete-confirmation-modal').classList.remove('show');
});

// Confirm delete
document.getElementById('confirm-delete').addEventListener('click', function() {
    const id = this.getAttribute('data-id');
    
    // In a real application, you would send a request to the server to delete the record type
    // For this example, we'll just remove the row from the table
    const row = document.querySelector(`.delete-btn[data-id="${id}"]`).closest('tr');
    row.remove();
    
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

// Add custom field
document.getElementById('add-field-btn').addEventListener('click', function() {
    const container = document.getElementById('custom-fields-container');
    const fieldRow = document.createElement('div');
    fieldRow.className = 'custom-field-row';
    fieldRow.style = 'display: flex; gap: 10px; margin-bottom: 10px;';
    
    fieldRow.innerHTML = `
        <input type="text" class="form-control" placeholder="Field name" style="flex: 2;">
        <select class="form-control" style="flex: 1;">
            <option value="text">Text</option>
            <option value="number">Number</option>
            <option value="date">Date</option>
            <option value="select">Dropdown</option>
            <option value="checkbox">Checkbox</option>
        </select>
        <button type="button" class="btn-icon delete-field-btn">
            <i class="fas fa-times"></i>
        </button>
    `;
    
    container.appendChild(fieldRow);
    
    // Add event listener to the delete button
    fieldRow.querySelector('.delete-field-btn').addEventListener('click', function() {
        fieldRow.remove();
    });
});

// Delete custom field
document.querySelectorAll('.delete-field-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        this.closest('.custom-field-row').remove();
    });
});

// Form submission
document.getElementById('record-type-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // In a real application, you would send the form data to the server
    // For this example, we'll just close the modal
    document.getElementById('record-type-modal').classList.remove('show');
    
    // Show a success message
    alert('Record type saved successfully!');
});

// Client-side search
document.querySelector('.search-box input').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    document.querySelectorAll('.data-table tbody tr').forEach(row => {
        const name = row.cells[0].textContent.toLowerCase();
        const specializations = row.cells[1].textContent.toLowerCase();
        row.style.display = name.includes(searchTerm) || specializations.includes(searchTerm) ? '' : 'none';
    });
});
});
</script>

@endsection