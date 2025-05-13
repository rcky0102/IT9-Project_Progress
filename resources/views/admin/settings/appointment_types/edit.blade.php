@extends('admin.settings.index')

@section('title', 'Edit Appointment Type | Admin Settings | Medical Clinic')

@section('content')
<main class="settings-content">
    <div class="settings-section">
        <div class="settings-header">
            <h1>Edit Appointment Type</h1>
            <p>Update the details of the appointment type</p>
        </div>

        
        <div class="card">
            <div class="card-body">
                <form id="specialization-form" action="{{ route('admin.settings.appointment_types.update', $appointmentType->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-section">
                        <h3 class="form-section-title">Basic Information</h3>
                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="name" class="required-field">Appointment Type Name</label>
                                    <input type="text" id="name" name="name" class="form-control" value="{{ $appointmentType->name }}" required>
                                    <small class="form-text text-muted">Enter the full name of the appointment type</small>
                                </div>
                            </div>

                            <div class="form-col">
                                <div class="form-group">
                                    <label for="charge" class="required-field">Charge (₱)</label>
                                    <input type="number" id="charge" name="charge" class="form-control" step="0.01" min="0" value="{{ $appointmentType->charge }}" required>
                                    <small class="form-text text-muted">Enter the price charged for this appointment type</small>
                                </div>
                            </div>

                            <div class="form-col">
                                <div class="form-group">
                                    <label class="required-field">Specializations</label>
                                    <div>
                                        @foreach($specializations as $specialization)
                                            <div class="form-check">
                                                <label class="form-check-label d-flex align-items-center">
                                                    <input 
                                                        type="checkbox" 
                                                        id="specialization_{{ $specialization->id }}" 
                                                        name="specialization_ids[]" 
                                                        value="{{ $specialization->id }}" 
                                                        class="form-check-input me-2"
                                                        @if(in_array($specialization->id, $appointmentType->specializations->pluck('id')->toArray())) checked @endif
                                                    >
                                                    {{ $specialization->specialization_name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <small class="form-text text-muted">Select one or more specializations related to this appointment type.</small>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('admin.settings.appointment_types.index')}}" class="btn btn-outline">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Appointment Type</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection