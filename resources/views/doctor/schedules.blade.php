@extends('doctor.layout')

@section('title', 'Schedule | Medical Clinic')

@section('content')

<main class="main-content">
    <div class="page-header-with-actions">
        <div>
            <h1>Schedule</h1>
            <p class="text-muted">Manage your work schedule</p>
        </div>
        <div class="header-buttons">
            <button class="btn btn-outline">
                <i class="fas fa-sync"></i> Refresh
            </button>
            <a href="{{ route('doctor.schedule-create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Availability
            </a>
        </div>
    </div>

    <!-- Availability Settings -->
    <div class="card">
        <div class="card-header">
            <div class="card-header-with-actions">
                <h3 class="card-title">Availability Settings</h3>
                <div class="card-actions">
                    <a href="{{ route('doctor.schedule-create') }}" class="btn btn-sm btn-outline">
                        <i class="fas fa-plus"></i> Add New
                    </a>
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
                            <td>{{ \Carbon\Carbon::parse($availability->start_time)->format('g:i A') }} - 
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

                                    <!-- Delete Button triggers form directly -->
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
</main>

@endsection
