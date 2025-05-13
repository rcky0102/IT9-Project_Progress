@extends('admin.layout')

@section('title', 'Manage Doctors | Medical Clinic')

@section('content')

            <!-- Main Content -->
            <main class="main-content">
                <div class="page-header-with-actions">
                    <div>
                        <h1>Manage Doctors</h1>
                        <p class="text-muted">Create and manage doctor accounts</p>
                    </div>
                    <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New Doctor
                    </a>
                </div>
                
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
                
                <div class="filters-container">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search doctors...">
                    </div>
                </div>
                
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Doctor</th>
                                <th>Specialization</th>  
                                <th>Contact</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($doctors as $doctor)
                            <tr>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar">
                                            <span class="avatar-fallback">{{ substr($doctor->first_name, 0, 1) }}{{ substr($doctor->last_name, 0, 1) }}</span>
                                        </div>
                                        <div>{{ $doctor->first_name }} {{ $doctor->last_name }}</div>
                                    </div>
                                </td>
                                <td>
                                    <!-- Check if doctor and specialization exist -->
                                    <div>
                                        @if($doctor->doctor && $doctor->doctor->specialization)
                                            {{ $doctor->doctor->specialization->specialization_name }}
                                        @else
                                            N/A
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="contact-cell">
                                        <div>{{ $doctor->email }}</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>{{ $doctor->created_at->format('M d, Y') }}</td>              
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.doctors.edit', $doctor->id) }}" class="n-icon edit-btn">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this doctor?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon delete-btn">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            
                            @if(count($doctors) == 0)
                            <tr>
                                <td colspan="6" class="text-center">No doctors found</td> <!-- Updated colspan to 6 -->
                            </tr>
                            @endif
                        </tbody>
                        
                        
                    </table>
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
                            otherMenu.classList.remove('show');
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