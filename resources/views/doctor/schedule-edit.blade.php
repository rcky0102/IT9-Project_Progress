@extends('doctor.layout')

@section('title', 'Edit Schedule | Medical Clinic')

@section('content')

<main class="main-content">
    <div class="page-header-with-actions">
        <h1>Edit Availability</h1>
        <p class="text-muted">Modify your schedule details</p>
    </div>

    <div class="card">
        <form action="{{ route('doctor.schedule-update', $availability->id) }}" method="POST">
            @csrf
            @method('PUT')  <!-- This is important for updating -->
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $availability->name }}">
                </div>
                <div class="form-group">
                    <label for="day">Working Days</label>
                    <input type="text" id="day" name="day" class="form-control" value="{{ $availability->day }}">
                </div>
                <div class="form-group">
                    <label for="start_time">Start Time</label>
                    <input type="time" id="start_time" name="start_time" class="form-control" value="{{ \Carbon\Carbon::parse($availability->start_time)->format('H:i') }}">
                </div>
                <div class="form-group">
                    <label for="end_time">End Time</label>
                    <input type="time" id="end_time" name="end_time" class="form-control" value="{{ \Carbon\Carbon::parse($availability->end_time)->format('H:i') }}">
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="Active" {{ $availability->status == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ $availability->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</main>

@endsection