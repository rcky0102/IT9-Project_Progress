@extends('patient.layout')

@section('title', 'Medication Details | Medical Clinic')

@section('content')

<!-- Main Content -->
<main class="main-content">

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

    <!-- Welcome Card -->
    <div class="welcome-card">
        <div class="flex-between">
            <div class="flex-center">
                <a href="{{ route('patient.appointments') }}" class="btn-icon-sm">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1>Appointment Details</h1>
            </div>
        </div>
        <p>View the details of your scheduled appointment and prescriptions.</p>
    </div>

    <div class="card">
        <div class="p-6">
            
            <!-- Prescription Information Section -->
                <div class="mt-8">
                    <h3 class="text-lg font-semibold mb-4 text-primary">Prescription Information</h3>

                    @if($prescription)
                        <div class="card mb-4">
                            <div class="p-4">
                                <div class="details-list">
                                    <div class="detail-block">
                                        <p class="font-medium">Medication</p>
                                        <p class="text-light">{{ $prescription->medication }}</p>
                                    </div>
                                    <div class="detail-block">
                                        <p class="font-medium">Dosage</p>
                                        <p class="text-light">{{ $prescription->dosage }}</p>
                                    </div>
                                    <div class="detail-block">
                                        <p class="font-medium">Frequency</p>
                                        <p class="text-light">{{ $prescription->frequency }}</p>
                                    </div>
                                    <div class="detail-block">
                                        <p class="font-medium">Duration</p>
                                        <p class="text-light">
                                            {{ \Carbon\Carbon::parse($prescription->start_date)->format('F d, Y') }} 
                                            to 
                                            {{ \Carbon\Carbon::parse($prescription->end_date)->format('F d, Y') }}
                                        </p>
                                    </div>
                                    <div class="detail-block">
                                        <p class="font-medium">Instructions</p>
                                        <p class="text-light">{{ $prescription->instructions ?? 'No additional instructions' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="text-light">Prescription not found.</p>
                    @endif
                </div>

        </div>
    </div>

</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Dropdown functionality
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle, .avatar-btn');
        
        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.stopPropagation();
                const dropdown = this.closest('.dropdown');
                const menu = dropdown.querySelector('.dropdown-menu');
                menu.classList.toggle('show');
                
                // Close other dropdowns
                document.querySelectorAll('.dropdown-menu.show').forEach(openMenu => {
                    if (openMenu !== menu) {
                        openMenu.classList.remove('show');
                    }
                });
            });
        });
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', function() {
            document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                menu.classList.remove('show');
            });
        });
    });
</script>

@endsection