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
            <a href="#" class="btn btn-primary" id="add-record-type-btn">
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
                        <th>Charge</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recordTypes as $recordType)
                        <tr>
                            <td>{{ $recordType->name }}</td>
                            <td>₱{{ number_format($recordType->charge, 2) }}</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-icon edit-btn" data-id="{{ $recordType->id }}">
                                        <a href="{{ route('admin.settings.record-types.edit', $recordType->id) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </button>
                                    <button class="btn-icon delete-btn" data-id="{{ $recordType->id }}" data-name="{{ $recordType->name }}">
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
            <button class="pagination-btn">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</main>

<!-- Record Type Modal -->
<div class="modal" id="record-type-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="modal-title">Add Record Type</h2>
            <button class="close-modal">&times;</button>
        </div>
        <form id="record-type-form" method="POST" action="">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="record-type-name">Name</label>
                    <input type="text" id="record-type-name" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="record-type-charge">Charge (₱)</label>
                    <input type="number" id="record-type-charge" name="charge" class="form-control" required step="0.01" min="0">
                </div>

                <div class="form-group">
                    <label>Custom Fields</label>
                    <div id="custom-fields-container" style="margin-bottom: 15px;"></div>
                    <button type="button" class="btn btn-secondary" id="add-field-btn">
                        <i class="fas fa-plus"></i> Add Field
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" id="cancel-btn">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
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
document.getElementById('confirm-delete').addEventListener('click', function () {
    console.log('Confirm delete clicked'); // Add this
    const id = this.getAttribute('data-id');
    const form = document.getElementById('delete-form');
    form.setAttribute('action', `/admin/settings/record-types/${id}`);
    form.submit();
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