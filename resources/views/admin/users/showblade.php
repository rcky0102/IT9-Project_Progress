@extends('admin.layout')

@section('title', 'User Details | Medical Clinic')

@section('content')

<main class="main-content">
        <!-- Flash Message -->
        @if (session('success'))
            <div class="flash-message">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Patient Header -->
        <div class="page-header-with-actions">
            <div>
                <h1>Patient: {{ $patient->user->name }}</h1>
                <p class="text-muted">View patient details and medical records</p>
            </div>
            <div class="header-buttons">
                <a href="{{ route('doctor.patients.index') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-left"></i> Back to Patients
                </a>
                <button class="btn btn-primary" id="add-medical-record-btn">
                    <i class="fas fa-plus"></i> Add Medical Record
                </button>
            </div>
        </div>

        <!-- Patient Details -->
        <div class="card patient-details">
            <div class="card-header">
                <h3 class="card-title">Patient Information</h3>
                <div class="card-icon">
                    <i class="fas fa-user"></i>
                </div>
            </div>
            <div class="card-content">
                <div class="form-row">
                    <div class="form-group">
                        <label>Name</label>
                        <p>{{ $patient->user->name }}</p>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <p>{{ $patient->user->email }}</p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <p>{{ $patient->date_of_birth ? \Carbon\Carbon::parse($patient->date_of_birth)->format('M d, Y') : 'N/A' }}</p>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <p>{{ $patient->gender ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Phone Number</label>
                        <p>{{ $patient->phone_number ?? 'N/A' }}</p>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <p>{{ $patient->address ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Medical Records -->
        <div class="table-container">
            <div class="page-header-with-actions">
                <h3>Medical Records</h3>
                <div class="filters-container">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="medical-record-search" placeholder="Search records...">
                    </div>
                </div>
            </div>
            <table class="data-table" id="medical-records-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Diagnosis</th>
                        <th>Treatment</th>
                        <th>Notes</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($patient->medicalRecords as $record)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($record->created_at)->format('M d, Y') }}</td>
                            <td>{{ $record->diagnosis ?? 'N/A' }}</td>
                            <td>{{ $record->treatment ?? 'N/A' }}</td>
                            <td>{{ Str::limit($record->notes ?? 'N/A', 50) }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn-icon dropdown-toggle">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="#" class="dropdown-item view-record" data-record-id="{{ $record->id }}">
                                            <i class="fas fa-eye"></i> View Details
                                        </a>
                                        <a href="#" class="dropdown-item">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item text-danger delete-record" data-record-id="{{ $record->id }}">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-muted">No medical records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Add Medical Record Modal -->
        <div class="modal" id="add-medical-record-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Add Medical Record</h3>
                    <button class="close-modal"><i class="fas fa-times"></i></button>
                </div>
                <form action="{{ route('doctor.medical-records.store', $patient->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="diagnosis">Diagnosis</label>
                            <input type="text" id="diagnosis" name="diagnosis" class="form-control" required>
                            @error('diagnosis')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="treatment">Treatment</label>
                            <textarea id="treatment" name="treatment" class="form-control" rows="4" required></textarea>
                            @error('treatment')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="notes">Notes (Optional)</label>
                            <textarea id="notes" name="notes" class="form-control" rows="3"></textarea>
                            @error('notes')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Record</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- View Medical Record Modal -->
        <div class="modal" id="view-medical-record-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Medical Record Details</h3>
                    <button class="close-modal"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Date</label>
                        <p id="view-record-date"></p>
                    </div>
                    <div class="form-group">
                        <label>Diagnosis</label>
                        <p id="view-record-diagnosis"></p>
                    </div>
                    <div class="form-group">
                        <label>Treatment</label>
                        <p id="view-record-treatment"></p>
                    </div>
                    <div class="form-group">
                        <label>Notes</label>
                        <p id="view-record-notes"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Dropdown Toggle
            document.querySelectorAll('.dropdown-toggle').forEach(button => {
                button.addEventListener('click', () => {
                    const dropdownMenu = button.nextElementSibling;
                    const isVisible = dropdownMenu.classList.contains('show');

                    // Close all dropdowns
                    document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                        menu.classList.remove('show');
                    });

                    // Toggle current dropdown
                    if (!isVisible) {
                        dropdownMenu.classList.add('show');
                    }
                });
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', (event) => {
                if (!event.target.closest('.dropdown')) {
                    document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                        menu.classList.remove('show');
                    });
                }
            });

            // Add Medical Record Modal
            const addMedicalRecordBtn = document.getElementById('add-medical-record-btn');
            const addMedicalRecordModal = document.getElementById('add-medical-record-modal');
            const closeAddModal = addMedicalRecordModal.querySelector('.close-modal');
            const cancelAddBtn = addMedicalRecordModal.querySelector('[data-dismiss="modal"]');

            addMedicalRecordBtn.addEventListener('click', () => {
                addMedicalRecordModal.style.display = 'flex';
            });

            closeAddModal.addEventListener('click', () => {
                addMedicalRecordModal.style.display = 'none';
            });

            cancelAddBtn.addEventListener('click', () => {
                addMedicalRecordModal.style.display = 'none';
            });

            addMedicalRecordModal.addEventListener('click', (event) => {
                if (event.target === addMedicalRecordModal) {
                    addMedicalRecordModal.style.display = 'none';
                }
            });

            // View Medical Record Modal
            const viewMedicalRecordModal = document.getElementById('view-medical-record-modal');
            const closeViewModal = viewMedicalRecordModal.querySelector('.close-modal');
            const cancelViewBtn = viewMedicalRecordModal.querySelector('[data-dismiss="modal"]');

            document.querySelectorAll('.view-record').forEach(button => {
                button.addEventListener('click', (event) => {
                    event.preventDefault();
                    const recordId = button.getAttribute('data-record-id');
                    const row = button.closest('tr');
                    const date = row.cells[0].textContent;
                    const diagnosis = row.cells[1].textContent;
                    const treatment = row.cells[2].textContent;
                    const notes = row.cells[3].textContent;

                    document.getElementById('view-record-date').textContent = date;
                    document.getElementById('view-record-diagnosis').textContent = diagnosis;
                    document.getElementById('view-record-treatment').textContent = treatment;
                    document.getElementById('view-record-notes').textContent = notes;

                    viewMedicalRecordModal.style.display = 'flex';
                });
            });

            closeViewModal.addEventListener('click', () => {
                viewMedicalRecordModal.style.display = 'none';
            });

            cancelViewBtn.addEventListener('click', () => {
                viewMedicalRecordModal.style.display = 'none';
            });

            viewMedicalRecordModal.addEventListener('click', (event) => {
                if (event.target === viewMedicalRecordModal) {
                    viewMedicalRecordModal.style.display = 'none';
                }
            });

            // Search Medical Records
            const searchInput = document.getElementById('medical-record-search');
            const rows = document.querySelectorAll('#medical-records-table tbody tr');

            searchInput.addEventListener('input', () => {
                const searchTerm = searchInput.value.toLowerCase();
                rows.forEach(row => {
                    const diagnosis = row.cells[1].textContent.toLowerCase();
                    const treatment = row.cells[2].textContent.toLowerCase();
                    const notes = row.cells[3].textContent.toLowerCase();
                    if (diagnosis.includes(searchTerm) || treatment.includes(searchTerm) || notes.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            // Delete Medical Record (Placeholder)
            document.querySelectorAll('.delete-record').forEach(button => {
                button.addEventListener('click', (event) => {
                    event.preventDefault();
                    const recordId = button.getAttribute('data-record-id');
                    if (confirm('Are you sure you want to delete this medical record?')) {
                        // Implement delete logic (e.g., AJAX request)
                        console.log('Delete record:', recordId);
                    }
                });
            });
        });
    </script>

@endsection