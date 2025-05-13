@extends('admin.settings.index')

@section('title', 'Record Types | Admin Settings | Medical Clinic')

@section('content')

<!-- Main Content -->
<main class="settings-content">
    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 6px; margin-bottom: 15px;">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 6px; margin-bottom: 15px;">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif
    <div class="settings-section" id="record-types-section">
        <div class="settings-header">
            <h1>Record Types</h1>
            <p>Manage medical record types in the system</p>
            <a href="#" class="btn btn-primary" id="add-record-type-btn">
                <i class="fas fa-plus"></i> Add Record Type
            </a>
        </div>

        <!-- Search and Filter -->
        <form method="GET" action="{{ route('admin.settings.record-types.index') }}" class="search-box" style="display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-search"></i>
            <input type="text" name="search" placeholder="Search record types..." value="{{ request('search') }}">
            @if(request('search'))
                <a href="{{ route('admin.settings.record-types.index') }}" style="color: #999; margin-left: 5px;">Clear</a>
            @endif
        </form>


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
document.addEventListener('DOMContentLoaded', function () {
    // Dropdown toggle
    const dropdownBtns = document.querySelectorAll('.dropdown .btn-icon, .dropdown .avatar-btn');
    dropdownBtns.forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            const menu = this.nextElementSibling;
            menu.classList.toggle('show');
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

    window.addEventListener('click', function () {
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.classList.remove('show');
        });
    });

    // Open Add Modal
    document.getElementById('add-record-type-btn').addEventListener('click', function () {
        document.getElementById('modal-title').textContent = 'Add Record Type';
        document.getElementById('record-type-form').reset();
        document.getElementById('record-type-modal').classList.add('show');
    });

    // Delete Modal
    const deleteBtns = document.querySelectorAll('.delete-btn');
    deleteBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const row = this.closest('tr');
            const name = row.cells[0].textContent;

            document.getElementById('delete-confirmation-modal').classList.add('show');
            document.getElementById('delete-confirmation-message').textContent =
                `Are you sure you want to delete the "${name}" record type? This action cannot be undone.`;

            document.getElementById('confirm-delete').setAttribute('data-id', id);
        });
    });

    // Close Modals
    document.querySelectorAll('.close-modal').forEach(button => {
        button.addEventListener('click', function () {
            document.querySelectorAll('.modal').forEach(modal => modal.classList.remove('show'));
        });
    });

    document.getElementById('cancel-btn').addEventListener('click', function () {
        document.getElementById('record-type-modal').classList.remove('show');
    });

    document.getElementById('cancel-delete').addEventListener('click', function () {
        document.getElementById('delete-confirmation-modal').classList.remove('show');
    });

    document.getElementById('confirm-delete').addEventListener('click', function () {
        const id = this.getAttribute('data-id');
        const form = document.getElementById('delete-form');
        form.setAttribute('action', `/admin/settings/record-types/${id}`);
        form.submit();
    });

    // Click outside modal
    window.addEventListener('click', function (e) {
        document.querySelectorAll('.modal').forEach(modal => {
            if (e.target === modal) modal.classList.remove('show');
        });
    });

    // Search
    document.querySelector('.search-box input').addEventListener('input', function () {
        const searchTerm = this.value.toLowerCase();
        document.querySelectorAll('.data-table tbody tr').forEach(row => {
            const name = row.cells[0].textContent.toLowerCase();
            const charge = row.cells[1].textContent.toLowerCase();
            row.style.display = name.includes(searchTerm) || charge.includes(searchTerm) ? '' : 'none';
        });
    });
});
</script>

@endsection
