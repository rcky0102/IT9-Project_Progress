@extends('admin.layout')

@section('title', 'Edit Doctor Account | Medical Clinic')

@section('content')
        
        <main class="main-content">
            <div class="form-container">
                <h2 class="form-title">Create Doctor Account</h2>
                
                <form method="POST" action="{{ route('admin.doctors.store') }}">
                    @csrf
                    
                    <div class="form-group">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-input" required value="{{ old('first_name') }}">
                        @error('first_name')
                            <div class="validation-error">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="middle_name" class="form-label">Middle Name (Optional)</label>
                        <input type="text" id="middle_name" name="middle_name" class="form-input" value="{{ old('middle_name') }}">
                        @error('middle_name')
                            <div class="validation-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-input" required value="{{ old('last_name') }}">
                        @error('last_name')
                            <div class="validation-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="specialization_id" class="form-label">Specialization</label>
                        <select id="specialization_id" name="specialization_id" class="form-input">
                            <option value="">Select Specialization</option>
                            @foreach($specializations as $specialization)
                                <option value="{{ $specialization->id }}" {{ old('specialization_id') == $specialization->id ? 'selected' : '' }}>
                                    {{ $specialization->specialization_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('specialization_id')
                            <div class="validation-error">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" id="email" name="email" class="form-input" required value="{{ old('email') }}">
                        @error('email')
                            <div class="validation-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-input" required>
                        @error('password')
                            <div class="validation-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" required>
                    </div>
                    
                    <div class="form-actions">
                        <a href="{{ route('admin.doctors.index') }}" class="btn btn-outline">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Create Doctor
                        </button>
                    </div>
                </form>
            </div>
        </main>
    

@endsection