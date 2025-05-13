@extends('doctor.layout')

@section('title', 'Edit Patient')

@section('content')
<main class="main-content">
    <div class="page-header-with-actions">
        <div>
            <h1>Edit Patient</h1>
            <p class="text-muted">Update patient information</p>
        </div>
        <a href="{{ route('doctor.patients.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Patients
        </a>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Please fix the following errors:
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Edit Form -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('doctor.patients.update', $patient->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-grid">
                    <!-- Full Name -->
                    <div class="form-group">
                        <label for="full_name">Full Name <span class="text-danger">*</span></label>
                        <input type="text" id="full_name" name="full_name" class="form-control" value="{{ old('full_name', $patient->full_name) }}" required>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email (optional)</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $patient->email) }}">
                    </div>

                    <!-- Contact Number -->
                    <div class="form-group">
                        <label for="contact_number">Contact Number</label>
                        <input type="text" id="contact_number" name="contact_number" class="form-control" value="{{ old('contact_number', $patient->contact_number) }}">
                    </div>

                    <!-- Address -->
                    <div class="form-group full-width">
                        <label for="address">Address</label>
                        <textarea id="address" name="address" class="form-control">{{ old('address', $patient->address) }}</textarea>
                    </div>
                </div>

                <div class="form-actions mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Patient
                    </button>
                    <a href="{{ route('doctor.patients.index') }}" class="btn btn-outline-secondary">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
