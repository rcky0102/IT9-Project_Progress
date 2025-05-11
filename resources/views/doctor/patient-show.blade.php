<!-- resources/views/doctor/patients/show.blade.php -->
@extends('doctor.layout')

@section('title', 'Patient Details | Medical Clinic')

@section('content')
  <main class="main-content">
    <!-- Flash Messages -->
    @if (session('success'))
      <div id="flash-message" class="flash-message">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
      </div>
    @endif
    @if (session('error'))
      <div id="flash-message-error" class="flash-message flash-message-error">
        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
      </div>
    @endif

    <!-- Welcome Card -->
    <div class="welcome-card">
      <div class="flex-between">
        <div class="flex-center">
          <a href="{{ route('doctor.patients') }}" class="btn-icon-sm">
            <i class="fas fa-arrow-left"></i>
          </a>
          <h1>Patient: {{ $patient->user->name }}</h1>
        </div>
        <button class="btn btn-primary" id="add-medical-record-btn">
          <i class="fas fa-plus"></i> Add Medical Record
        </button>
      </div>
      <p class="text-light">View patient details and medical records.</p>
    </div>

    <!-- Patient Details -->
    <div class="card">
      <div class="p-6">
        <div class="flex-between mb-6">
          <h2 class="text-2xl font-bold text-primary">Patient Information</h2>
          <div class="card-icon">
            <i class="fas fa-user"></i>
          </div>
        </div>
        <div class="details-grid">
          <div>
            <h3 class="text-lg font-semibold mb-4 text-primary">Personal Details</h3>
            <div class="details-list">
              <div class="detail-item">
                <i class="fas fa-user text-primary"></i>
                <div>
                  <p class="font-medium">Name</p>
                  <p class="text-light">{{ $patient->user->name }}</p>
                </div>
              </div>
              <div class="detail-item">
                <i class="fas fa-envelope text-primary"></i>
                <div>
                  <p class="font-medium">Email</p>
                  <p class="text-light">{{ $patient->user->email }}</p>
                </div>
              </div>
              <div class="detail-item">
                <i class="fas fa-phone text-primary"></i>
                <div>
                  <p class="font-medium">Phone Number</p>
                  <p class="text-light">{{ $patient->phone_number ?? 'N/A' }}</p>
                </div>
              </div>
            </div>
          </div>
          <div>
            <h3 class="text-lg font-semibold mb-4 text-primary">Additional Information</h3>
            <div class="details-list">
              <div class="detail-item">
                <i class="fas fa-calendar-alt text-primary"></i>
                <div>
                  <p class="font-medium">Date of Birth</p>
                  <p class="text-light">{{ $patient->date_of_birth ? \Carbon\Carbon::parse($patient->date_of_birth)->format('M d, Y') : 'N/A' }}</p>
                </div>
              </div>
              <div class="detail-item">
                <i class="fas fa-venus-mars text-primary"></i>
                <div>
                  <p class="font-medium">Gender</p>
                  <p class="text-light">{{ $patient->gender ?? 'N/A' }}</p>
                </div>
              </div>
              <div class="detail-item">
                <i class="fas fa-map-marker-alt text-primary"></i>
                <div>
                  <p class="font-medium">Address</p>
                  <p class="text-light">{{ $patient->address ?? 'N/A' }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Medical Records -->
    <div class="card">
      <div class="p-6">
        <div class="flex-between mb-6">
          <h2 class="text-2xl font-bold text-primary">Medical Records</h2>
          <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="medical-record-search" placeholder="Search records...">
          </div>
        </div>
        <div class="table-container">
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
                      <button class="btn-icon-sm dropdown-toggle">
                        <i class="fas fa-ellipsis-h"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a href="#" class="dropdown-item view-record" data-record-id="{{ $record->id }}">
                          <i class="fas fa-eye"></i> View Details
                        </a>
                        <a href="#" class="dropdown-item">
                          <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="#" class="dropdown-item text-danger delete-record" data-record-id="{{ $record->id }}">
                          <i class="fas fa-trash"></i> Delete
                        </a>
                      </div>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-light text-center">No medical records found.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Add Medical Record Modal -->
    <div class="modal" id="add-medical-record-modal">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="text-lg font-semibold text-primary">Add Medical Record</h3>
          <button class="close-modal"><i class="fas fa-times"></i></button>
        </div>
        <form action="#" method="POST">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label class="form-label" for="diagnosis">Diagnosis</label>
              <input type="text" id="diagnosis" name="diagnosis" class="form-control" required>
              @error('diagnosis')
                <div class="flash-message flash-message-error">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <label class="form-label" for="treatment">Treatment</label>
              <textarea id="treatment" name="treatment" class="form-textarea" rows="4" required></textarea>
              @error('treatment')
                <div class="flash-message flash-message-error">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <label class="form-label" for="notes">Notes (Optional)</label>
              <textarea id="notes" name="notes" class="form-textarea" rows="3"></textarea>
              @error('notes')
                <div class="flash-message flash-message-error">{{ $message }}</div>
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
          <h3 class="text-lg font-semibold text-primary">Medical Record Details</h3>
          <button class="close-modal"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
          <div class="details-list">
            <div class="detail-item">
              <i class="fas fa-calendar-alt text-primary"></i>
              <div>
                <p class="font-medium">Date</p>
                <p class="text-light" id="view-record-date"></p>
              </div>
            </div>
            <div class="detail-item">
              <i class="fas fa-diagnoses text-primary"></i>
              <div>
                <p class="font-medium">Diagnosis</p>
                <p class="text-light" id="view-record-diagnosis"></p>
              </div>
            </div>
            <div class="detail-item">
              <i class="fas fa-prescription text-primary"></i>
              <div>
                <p class="font-medium">Treatment</p>
                <p class="text-light" id="view-record-treatment"></p>
              </div>
            </div>
            <div class="detail-item">
              <i class="fas fa-notes-medical text-primary"></i>
              <div>
                <p class="font-medium">Notes</p>
                <p class="text-light" id="view-record-notes"></p>
              </div>
            </div>
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
      // Auto-dismiss flash messages
      ['flash-message', 'flash-message-error'].forEach(id => {
        const flash = document.getElementById(id);
        if (flash) setTimeout(() => flash.remove(), 3500);
      });

      // Dropdown functionality
      const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
      dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', e => {
          e.stopPropagation();
          const dropdown = toggle.closest('.dropdown');
          const menu = dropdown.querySelector('.dropdown-menu');
          menu.classList.toggle('show');
          document.querySelectorAll('.dropdown-menu.show').forEach(openMenu => {
            if (openMenu !== menu) openMenu.classList.remove('show');
          });
        });
      });

      // Close dropdowns on outside click
      document.addEventListener('click', () => {
        document.querySelectorAll('.dropdown-menu.show').forEach(menu => menu.classList.remove('show'));
      });

      // Add Medical Record Modal
      const addMedicalRecordBtn = document.getElementById('add-medical-record-btn');
      const addMedicalRecordModal = document.getElementById('add-medical-record-modal');
      const closeAddModal = addMedicalRecordModal.querySelector('.close-modal');
      const cancelAddBtn = addMedicalRecordModal.querySelector('[data-dismiss="modal"]');

      addMedicalRecordBtn.addEventListener('click', () => {
        addMedicalRecordModal.style.display = 'flex';
      });

      [closeAddModal, cancelAddBtn].forEach(btn => {
        btn.addEventListener('click', () => {
          addMedicalRecordModal.style.display = 'none';
        });
      });

      addMedicalRecordModal.addEventListener('click', e => {
        if (e.target === addMedicalRecordModal) addMedicalRecordModal.style.display = 'none';
      });

      // View Medical Record Modal
      const viewMedicalRecordModal = document.getElementById('view-medical-record-modal');
      const closeViewModal = viewMedicalRecordModal.querySelector('.close-modal');
      const cancelViewBtn = viewMedicalRecordModal.querySelector('[data-dismiss="modal"]');

      document.querySelectorAll('.view-record').forEach(button => {
        button.addEventListener('click', e => {
          e.preventDefault();
          const row = button.closest('tr');
          document.getElementById('view-record-date').textContent = row.cells[0].textContent;
          document.getElementById('view-record-diagnosis').textContent = row.cells[1].textContent;
          document.getElementById('view-record-treatment').textContent = row.cells[2].textContent;
          document.getElementById('view-record-notes').textContent = row.cells[3].textContent;
          viewMedicalRecordModal.style.display = 'flex';
        });
      });

      [closeViewModal, cancelViewBtn].forEach(btn => {
        btn.addEventListener('click', () => {
          viewMedicalRecordModal.style.display = 'none';
        });
      });

      viewMedicalRecordModal.addEventListener('click', e => {
        if (e.target === viewMedicalRecordModal) viewMedicalRecordModal.style.display = 'none';
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
          row.style.display = (diagnosis.includes(searchTerm) || treatment.includes(searchTerm) || notes.includes(searchTerm)) ? '' : 'none';
        });
      });

      // Delete Medical Record (Placeholder)
      document.querySelectorAll('.delete-record').forEach(button => {
        button.addEventListener('click', e => {
          e.preventDefault();
          const recordId = button.getAttribute('data-record-id');
          if (confirm('Are you sure you want to delete this medical record?')) {
            console.log('Delete record:', recordId);
            // Implement delete logic (e.g., AJAX request)
          }
        });
      });
    });
  </script>
@endsection