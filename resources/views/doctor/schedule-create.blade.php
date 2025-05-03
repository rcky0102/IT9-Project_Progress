@extends('doctor.layout')

@section('title', 'Create Availability | Medical Clinic')

@section('content')

            <!-- Main Content -->
            <main class="main-content">
                <div class="page-header-with-actions">
                    <div>
                        <h1>Create Availability</h1>
                        <p class="text-muted">Set your working hours and availability</p>
                    </div>
                    <a href="schedule.html" class="btn btn-outline">
                        <i class="fas fa-arrow-left"></i> Back to Schedule
                    </a>
                </div>

                <!-- Create Availability Form -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Availability Details</h3>
                    </div>
                    <form class="availability-form" action="{{ route('doctor.schedule-store') }}" method="POST">
                        @csrf
                    
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    
                        <input type="hidden" name="doctor_id" value="{{ $doctor->id ?? '' }}">
                    
                        <div class="form-group">
                            <label for="availability-name">Availability Name*</label>
                            <input type="text" id="availability-name" name="availability-name" class="form-control"
                                   value="{{ old('availability-name') }}" required>
                        </div>
                    
                        {{-- <div class="form-row d-flex gap-3">
                            <div class="form-group flex-fill">
                                <label for="effective-from">Effective From*</label>
                                <input type="date" id="effective-from" name="effective-from" class="form-control"
                                       value="{{ old('effective-from') }}" required>
                            </div>
                            <div class="form-group flex-fill">
                                <label for="effective-to">Effective To</label>
                                <input type="date" id="effective-to" name="effective-to" class="form-control"
                                       value="{{ old('effective-to') }}">
                                <small class="form-text">Leave blank for indefinite</small>
                            </div>
                        </div> --}}
                    
                        @php
                            $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                        @endphp
                    
                        <div class="availability-days mt-4">
                            @foreach ($days as $day)
                                <div class="availability-day mb-3">
                                    <div class="availability-day-header d-flex justify-content-between align-items-center">
                                        <span class="fw-bold">{{ ucfirst($day) }}</span>
                                        <label class="switch">
                                            <input type="checkbox" name="{{ $day }}-active" {{ old($day.'-active') ? 'checked' : '' }} checked>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                    
                                    <div class="availability-time-slots" id="{{ $day }}-slots">
                                        <div class="availability-time-slot d-flex align-items-center gap-2 mt-2">
                                            <input type="time" name="{{ $day }}-start[]" class="form-control w-25" value="09:00">
                                            <span>to</span>
                                            <input type="time" name="{{ $day }}-end[]" class="form-control w-25" value="17:00">
                                            <button type="button" class="btn btn-sm btn-danger remove-time-btn" title="Remove time slot">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                    
                                    <button type="button" class="btn btn-sm btn-outline-primary mt-2 add-time-slot-btn" data-day="{{ $day }}">
                                        <i class="fas fa-plus"></i> Add Time Slot
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    
                        <div class="form-actions mt-4">
                            <a href="{{ route('doctor.schedules') }}" class="btn btn-outline-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Create Availability</button>
                        </div>
                    </form>
                    
                    
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const addBtns = document.querySelectorAll('.add-time-slot-btn');
        
            addBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    const day = this.getAttribute('data-day');
                    const container = document.getElementById(`${day}-slots`);
                    const firstSlot = container.querySelector('.availability-time-slot');
                    const newSlot = firstSlot.cloneNode(true);
        
                    // Clear the time inputs
                    newSlot.querySelectorAll('input[type="time"]').forEach(input => input.value = '');
        
                    // Add event to new remove button
                    newSlot.querySelector('.remove-time-btn').addEventListener('click', function () {
                        if (container.querySelectorAll('.availability-time-slot').length > 1) {
                            this.closest('.availability-time-slot').remove();
                        }
                    });
        
                    container.appendChild(newSlot);
                });
            });
        
            document.querySelectorAll('.remove-time-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const container = this.closest('.availability-time-slots');
                    if (container.querySelectorAll('.availability-time-slot').length > 1) {
                        this.closest('.availability-time-slot').remove();
                    }
                });
            });
        });
        </script>
        

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

            // Day availability toggle
            const dayToggles = document.querySelectorAll('.availability-day-header .switch input');
            
            dayToggles.forEach(toggle => {
                toggle.addEventListener('change', function() {
                    const day = this.name.split('-')[0];
                    const timeSlots = document.getElementById(`${day}-slots`);
                    const addButton = document.querySelector(`.add-time-slot-btn[data-day="${day}"]`);
                    
                    if (this.checked) {
                        timeSlots.style.display = 'block';
                        addButton.style.display = 'block';
                    } else {
                        timeSlots.style.display = 'none';
                        addButton.style.display = 'none';
                    }
                });
            });

            // Add time slot functionality
            const addTimeSlotBtns = document.querySelectorAll('.add-time-slot-btn');

            addTimeSlotBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const day = this.getAttribute('data-day');
                    const slotsContainer = document.getElementById(`${day}-slots`);

                    // Clone the first time slot
                    const firstSlot = slotsContainer.querySelector('.availability-time-slot');
                    const newSlot = firstSlot.cloneNode(true);

                    // Reset input time values
                    const timeInputs = newSlot.querySelectorAll('input[type="time"]');
                    if (timeInputs.length >= 2) {
                        timeInputs[0].value = '09:00';
                        timeInputs[1].value = '17:00';
                    }

                    // Add event listener to the remove button
                    const removeBtn = newSlot.querySelector('.remove-time-btn');
                    removeBtn.addEventListener('click', function() {
                        if (slotsContainer.querySelectorAll('.availability-time-slot').length > 1) {
                            this.closest('.availability-time-slot').remove();
                        }
                    });

                    // Append the new slot
                    slotsContainer.appendChild(newSlot);
                });
            });

            // Remove time slot functionality
            const removeTimeBtns = document.querySelectorAll('.remove-time-btn');

            removeTimeBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const slot = this.closest('.availability-time-slot');
                    const slotsContainer = slot.parentElement;

                    // Only remove if there's more than one slot
                    if (slotsContainer.querySelectorAll('.availability-time-slot').length > 1) {
                        slot.remove();
                    }
                });
            });

        });
    </script>

@endsection