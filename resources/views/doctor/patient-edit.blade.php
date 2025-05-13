@extends('layouts.app')

@section('title', 'Edit Patient')

@section('content')
<div class="container">
    <h1>Edit Patient</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Please fix the following errors:
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('doctor.patients.update', $patient->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" class="form-control" value="{{ old('full_name', $patient->full_name) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email (optional)</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $patient->email) }}">
        </div>

        <div class="form-group">
            <label for="contact_number">Contact Number</label>
            <input type="text" id="contact_number" name="contact_number" class="form-control" value="{{ old('contact_number', $patient->contact_number) }}">
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <textarea id="address" name="address" class="form-control">{{ old('address', $patient->address) }}</textarea>
        </div>

        <!-- You can add more fields here based on your database schema -->

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update Patient</button>
            <a href="{{ route('doctor.patients.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
