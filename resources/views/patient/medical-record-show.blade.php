@extends('patient.layout')

@section('title', 'Medical Record Details | Medical Clinic')

@section('content')

           <!-- Main Content -->
            <main class="main-content">
                <!-- Flash Message -->
                @if(session('success'))
                    <div id="flash-message" class="flash-message">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const flash = document.getElementById('flash-message');
                        if (flash) {
                            setTimeout(() => flash.remove(), 3500);
                        }
                    });
                </script>

                <!-- Medical Record Card -->
                <div class="card">
                    <div class="p-6">
                        <div class="flex-between mb-6">
                            <h1 class="text-2xl font-bold text-primary">Medical Record Details</h1>
                            <a href="{{ route('patient.medical-records') }}" class="btn-icon-sm">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </div>
                        <p class="text-muted mb-6">View the medical record for your appointment.</p>

                        @if($medicalRecord)
                            <div class="details-grid">
                                <div>
                                    <h3 class="text-lg font-semibold mb-4 text-primary">Record Information</h3>
                                    <div class="details-list">
                                        {{-- <div class="detail-item">
                                            <i class="fas fa-id-badge text-primary"></i>
                                            <div>
                                                <p class="font-medium">Appointment ID</p>
                                                <p class="text-light">{{ $medicalRecord->appointment_id }}</p>
                                            </div>
                                        </div> --}}
                                        <div class="detail-item">
                                            <i class="fas fa-tags text-primary"></i>
                                            <div>
                                                <p class="font-medium">Record Type</p>
                                                <p class="text-light">{{ $medicalRecord->recordType ? $medicalRecord->recordType->name : 'Not specified' }}</p>
                                            </div>
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-calendar-alt text-primary"></i>
                                            <div>
                                                <p class="font-medium">Record Date</p>
                                                <p class="text-light">{{ \Carbon\Carbon::parse($medicalRecord->date)->format('F d, Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold mb-4 text-primary">Vital Signs</h3>
                                    <div class="details-list">
                                        <div class="detail-item">
                                            <i class="fas fa-heartbeat text-primary"></i>
                                            <div>
                                                <p class="font-medium">Blood Pressure</p>
                                                <p class="text-light">{{ $medicalRecord->blood_pressure ?? 'Not recorded' }}</p>
                                            </div>
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-thermometer-half text-primary"></i>
                                            <div>
                                                <p class="font-medium">Temperature</p>
                                                <p class="text-light">{{ $medicalRecord->temperature ? $medicalRecord->temperature . ' °F' : 'Not recorded' }}</p>
                                            </div>
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-heart text-primary"></i>
                                            <div>
                                                <p class="font-medium">Heart Rate</p>
                                                <p class="text-light">{{ $medicalRecord->heart_rate ? $medicalRecord->heart_rate . ' bpm' : 'Not recorded' }}</p>
                                            </div>
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-lungs text-primary"></i>
                                            <div>
                                                <p class="font-medium">Respiratory Rate</p>
                                                <p class="text-light">{{ $medicalRecord->respiratory_rate ? $medicalRecord->respiratory_rate . ' breaths/min' : 'Not recorded' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="details-grid">
                                <div>
                                    <h3 class="text-lg font-semibold mb-4 text-primary">Diagnosis & Notes</h3>
                                    <div class="details-list">
                                        <div class="detail-block">
                                            <p class="font-medium">Diagnosis</p>
                                            <p class="text-light">{{ $medicalRecord->diagnosis ?? 'No diagnosis provided' }}</p>
                                        </div>
                                        <div class="detail-block">
                                            <p class="font-medium">Notes</p>
                                            <p class="text-light">{{ $medicalRecord->notes ?? 'No additional notes' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p class="text-light">No medical record available.</p>
                        @endif
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
        });
    </script>

@endsection