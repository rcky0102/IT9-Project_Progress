@extends('doctor.layout')

@section('title', 'Patients | Medical Clinic')

@section('content')

            <!-- Main Content -->
    <main class="main-content">
        <div class="page-header-with-actions">
            <div>
                <h1>Patients</h1>
                <p class="text-muted">Manage your patient database</p>
            </div>
        </div>

        <!-- Patient List -->
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Patient</th>
                        <th>Contact</th>
                        <th>Age/Gender</th>
                        <th>Last Visit</th>
                        <th>Diagnosis</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($patients as $patient)
                    <tr>
                        <td>
                            <div class="patient-cell">
                                <div class="patient-avatar">
                                    <span class="avatar-fallback">
                                        {{ strtoupper(substr($patient->user->first_name, 0, 1)) }}
                                        {{ strtoupper(substr($patient->user->last_name, 0, 1)) }}
                                    </span>
                                </div>
                                <div>{{ $patient->user->first_name }} {{ $patient->user->middle_name }} {{ $patient->user->last_name }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="contact-cell">
                                <div>{{ $patient->user->email }}</div>
                                <div class="text-muted">{{ $patient->contact_number }}</div>
                            </div>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($patient->birthdate)->age }} / {{ $patient->gender }}</td>
                        <td>{{ \Carbon\Carbon::parse($patient->created_at)->format('F d, Y') }}</td>
                        @foreach($latestMedicalRecords as $medicalrecord)
                        <td>
                            <span class="badge badge-outline">{{ $medicalrecord->diagnosis }}</span>
                        </td>
                        @endforeach
                        <td>
                            <span class="badge badge-outline-blue" id="status-{{ $patient->id }}">Active</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <!-- <a href="{{ route('doctor.patients.edit', $patient->id) }}" class="btn-icon edit-btn">
                                    <i class="fas fa-edit"></i>
                                </a>

                              
                                <button type="button" class="btn-icon delete-btn" data-id="{{ $patient->id }}" onclick="cancelStatus({{ $patient->id }})">
                                    <i class="fas fa-trash"></i>
                                </button> -->
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Select all dropdown buttons
        const dropdownBtns = document.querySelectorAll('.dropdown .btn-icon');
        
        // Function to close all dropdown menus
        function closeAllDropdowns() {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.remove('show');
            });
        }

        // Add click event listener to each dropdown button
        dropdownBtns.forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.stopPropagation(); // Prevent event from bubbling up
                
                // Get the dropdown menu for the clicked button
                const menu = this.nextElementSibling;

                // Toggle the 'show' class to show or hide the dropdown menu
                menu.classList.toggle('show');

                // Close all other dropdowns
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
        window.addEventListener('click', function (e) {
            // If the clicked target is not part of any dropdown
            if (!e.target.closest('.dropdown')) {
                closeAllDropdowns();
            }
        });
    });
</script>

@endsection