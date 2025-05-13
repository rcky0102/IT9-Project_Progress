@extends('doctor.layout')

@section('title', 'Schedule | Medical Clinic')

@section('content')

            <!-- Main Content -->
            <main class="main-content">
                <div class="page-header-with-actions">
                    <div>
                        <h1>Schedule</h1>
                        <p class="text-muted">Manage your work schedule</p>
                    </div>
                    <div class="header-buttons">
                        {{-- <button class="btn btn-outline">
                            <i class="fas fa-sync"></i> Refresh
                        </button> --}}
                        <a href="{{ route('doctor.schedule-create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Availability
                        </a>
                    </div>
                </div>

                <!-- Schedule View Selector -->
                {{-- <div class="view-selector">
                    <button class="view-btn active">
                        <i class="fas fa-calendar-day"></i> Day
                    </button>
                    <button class="view-btn">
                        <i class="fas fa-calendar-week"></i> Week
                    </button>
                    <button class="view-btn">
                        <i class="fas fa-calendar-alt"></i> Month
                    </button>
                    <button class="view-btn">
                        <i class="fas fa-list"></i> List
                    </button>
                </div> --}}

                {{-- <!-- Date Navigation -->
                <div class="date-navigation">
                    <button class="btn-icon"><i class="fas fa-chevron-left"></i></button>
                    <h2 class="current-date">May 26, 2025</h2>
                    <button class="btn-icon"><i class="fas fa-chevron-right"></i></button>
                    <button class="btn btn-outline today-btn">Today</button>
                </div>

                <!-- Schedule Grid -->
                <div class="schedule-container">
                    <div class="schedule-sidebar">
                        <div class="time-slot">8:00 AM</div>
                        <div class="time-slot">9:00 AM</div>
                        <div class="time-slot">10:00 AM</div>
                        <div class="time-slot">11:00 AM</div>
                        <div class="time-slot">12:00 PM</div>
                        <div class="time-slot">1:00 PM</div>
                        <div class="time-slot">2:00 PM</div>
                        <div class="time-slot">3:00 PM</div>
                        <div class="time-slot">4:00 PM</div>
                        <div class="time-slot">5:00 PM</div>
                    </div>
                    <div class="schedule-content">
                        <div class="schedule-column">
                            <div class="schedule-header">Monday</div>
                            <div class="schedule-events">
                                <div class="schedule-event" style="top: 60px; height: 60px; background-color: rgba(52, 152, 219, 0.2); border-left: 3px solid #3498db;">
                                    <div class="event-time">9:00 AM - 10:00 AM</div>
                                    <div class="event-title">Staff Meeting</div>
                                </div>
                                <div class="schedule-event" style="top: 180px; height: 30px; background-color: rgba(46, 204, 113, 0.2); border-left: 3px solid #2ecc71;">
                                    <div class="event-time">11:00 AM - 11:30 AM</div>
                                    <div class="event-title">James Brown</div>
                                </div>
                                <div class="schedule-event" style="top: 240px; height: 60px; background-color: rgba(155, 89, 182, 0.2); border-left: 3px solid #9b59b6;">
                                    <div class="event-time">12:00 PM - 1:00 PM</div>
                                    <div class="event-title">Lunch Break</div>
                                </div>
                                <div class="schedule-event" style="top: 360px; height: 30px; background-color: rgba(46, 204, 113, 0.2); border-left: 3px solid #2ecc71;">
                                    <div class="event-time">2:00 PM - 2:30 PM</div>
                                    <div class="event-title">Olivia Martinez</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Weekly Overview -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Weekly Overview</h3>
                    </div>
                    <div class="weekly-overview">
                        <div class="week-day">
                            <div class="week-day-header">Mon</div>
                            <div class="week-day-content">
                                <div class="week-day-count">4</div>
                                <div class="week-day-label">Appointments</div>
                            </div>
                        </div>
                        <div class="week-day">
                            <div class="week-day-header">Tue</div>
                            <div class="week-day-content">
                                <div class="week-day-count">6</div>
                                <div class="week-day-label">Appointments</div>
                            </div>
                        </div>
                        <div class="week-day">
                            <div class="week-day-header">Wed</div>
                            <div class="week-day-content">
                                <div class="week-day-count">5</div>
                                <div class="week-day-label">Appointments</div>
                            </div>
                        </div>
                        <div class="week-day">
                            <div class="week-day-header">Thu</div>
                            <div class="week-day-content">
                                <div class="week-day-count">3</div>
                                <div class="week-day-label">Appointments</div>
                            </div>
                        </div>
                        <div class="week-day">
                            <div class="week-day-header">Fri</div>
                            <div class="week-day-content">
                                <div class="week-day-count">7</div>
                                <div class="week-day-label">Appointments</div>
                            </div>
                        </div>
                        <div class="week-day weekend">
                            <div class="week-day-header">Sat</div>
                            <div class="week-day-content">
                                <div class="week-day-count">0</div>
                                <div class="week-day-label">Off</div>
                            </div>
                        </div>
                        <div class="week-day weekend">
                            <div class="week-day-header">Sun</div>
                            <div class="week-day-content">
                                <div class="week-day-count">0</div>
                                <div class="week-day-label">Off</div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!-- Availability Settings -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-with-actions">
                            <h3 class="card-title">Availability Settings</h3>
                            <div class="card-actions">
                                {{-- <a href="{{ route('doctor.schedule-create') }}" class="btn btn-sm btn-outline">
                                    <i class="fas fa-plus"></i> Add New
                                </a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="table-container">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Working Days</th>
                                    <th>Hours</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($availabilities as $availability)
                                    <tr>
                                        <td>{{ $availability->name }}</td>
                                        <td>{{ $availability->day }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($availability->start_time)->format('g:i A') }} - 
                                            {{ \Carbon\Carbon::parse($availability->end_time)->format('g:i A') }}
                                        </td>
                                        <td>
                                            <span class="badge badge-outline-{{ $availability->status == 'Active' ? 'blue' : 'red' }}">
                                                {{ $availability->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="row-actions">
                                                <a href="{{ route('doctor.schedule-edit', $availability->id) }}" class="btn-icon" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                
                                                <button type="button" class="btn-icon delete-btn" title="Delete" onclick="document.getElementById('delete-form-{{ $availability->id }}').submit();">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                                <!-- Hidden Delete Form -->
                                                <form id="delete-form-{{ $availability->id }}" method="POST" action="{{ route('doctor.schedule-destroy', $availability->id) }}" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        
                    </div>
                </div>

                <!-- Delete Confirmation Dialog -->
                <div class="delete-confirmation" id="delete-confirmation" style="display: none;">
                    <div class="delete-confirmation-content">
                        <h3>Delete Availability</h3>
                        <p>Are you sure you want to delete this availability schedule? This action cannot be undone.</p>
                        <div class="delete-actions">
                            <button id="cancel-delete" class="btn btn-outline">Cancel</button>
                            <button id="confirm-delete" class="btn btn-danger">Delete</button>
                        </div>
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

            // View selector functionality
            const viewBtns = document.querySelectorAll('.view-btn');
            
            viewBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    viewBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Delete functionality
            const deleteBtns = document.querySelectorAll('.delete-btn');
            const deleteConfirmation = document.getElementById('delete-confirmation');
            const cancelDeleteBtn = document.getElementById('cancel-delete');
            const confirmDeleteBtn = document.getElementById('confirm-delete');

            deleteBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    deleteConfirmation.style.display = 'flex';
                });
            });

            cancelDeleteBtn.addEventListener('click', function() {
                deleteConfirmation.style.display = 'none';
            });

            confirmDeleteBtn.addEventListener('click', function() {
                deleteConfirmation.style.display = 'none';
                alert('Availability deleted successfully');
            });
        });
    </script>

@endsection