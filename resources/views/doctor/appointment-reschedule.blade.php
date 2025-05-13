@extends('doctor.layout')

@section('title', 'Reschedule Appointment | Medical Clinic')

@section('content')
<main class="main-content">
    <div class="page-header-with-actions">
        <div>
            <h1>Reschedule Appointment</h1>
            <p class="text-muted">Update the date and time for this appointment</p>
        </div>
    </div>

    <div class="card" style="max-width: 600px; margin-top: 30px;">
        <div class="card-header">
            <h3 class="card-title">Select New Schedule</h3>
        </div>
        <form action="{{ route('doctor.appointment-reschedule-submit', $appointment->id) }}" method="POST" class="form-layout">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="appointment_date">Appointment Date</label>
                <input type="date" name="appointment_date" id="appointment_date" class="form-control"
                       value="{{ old('appointment_date', $appointment->appointment_date) }}" required>
                @error('appointment_date')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="appointment_time">Start Time</label>
                <input type="time" name="appointment_time" id="appointment_time" class="form-control"
                       value="{{ old('appointment_time', $appointment->appointment_time) }}" required>
                @error('appointment_time')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="appointment_end_time">End Time (optional)</label>
                <input type="time" name="appointment_end_time" id="appointment_end_time" class="form-control"
                       value="{{ old('appointment_end_time', $appointment->appointment_end_time) }}">
                @error('appointment_end_time')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions" style="margin-top: 20px; display: flex; gap: 10px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Changes
                </button>
                <a href="{{ route('doctor.appointment-show', $appointment->id) }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Details
                </a>
            </div>
        </form>
    </div>
</main>
@endsection
