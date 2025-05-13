@extends('patient.layout')

@section('title', 'Profile| Medical Clinic')

@section('content')


<style>
   .profile-edit-container {
    max-width: 600px;
    margin: 30px auto;
    padding: 25px;
    background: #ffffff;
    border-radius: 12px; /* Rounded corners */
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.profile-title {
    color: #2c3e50;
    text-align: center;
    margin-bottom: 25px;
    font-size: 24px;
}

.profile-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.form-row {
    display: flex;
    gap: 15px;
}

.form-group {
    flex: 1;
    position: relative;
}

.form-group .icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 16px;
}

input, select {
    width: 100%;
    padding: 12px 12px 12px 38px;
    border: 1px solid #ddd;
    border-radius: 8px; /* Rounded input fields */
    font-size: 16px;
    transition: all 0.3s;
}

select {
    padding-left: 38px;
    appearance: none;
    background: white;
}

input:focus, select:focus {
    outline: none;
    border-color: #4a90e2;
    box-shadow: 0 0 0 3px rgba(74,144,226,0.1);
}

.update-button {
    padding: 14px;
    background: #4a90e2;
    color: white;
    border: none;
    border-radius: 8px; /* Rounded button */
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.3s;
    margin-top: 10px;
}

.update-button:hover {
    background: #357ab8;
}

.validation-error {
    color: #e74c3c;
    font-size: 14px;
    margin-top: 5px;
    padding-left: 5px;
}
</style>

    <div class="profile-edit-container">
    <h2 class="profile-title">Edit Your Profile</h2>
    
    <form method="POST" action="{{ route('patient.profile.update') }}" class="profile-form">
        @csrf
        @method('PUT')

        <!-- Name Fields -->
        <div class="form-row">
            <div class="form-group">
                <span class="icon">👤</span>
                <input type="text" name="first_name" placeholder="First Name" required 
                    value="{{ old('first_name', $user->first_name) }}">
                @error('first_name') <div class="validation-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <span class="icon">👤</span>
                <input type="text" name="last_name" placeholder="Last Name" required 
                    value="{{ old('last_name', $user->last_name) }}">
                @error('last_name') <div class="validation-error">{{ $message }}</div> @enderror
            </div>
        </div>

        <!-- Middle Name -->
        <div class="form-group">
            <span class="icon">👤</span>
            <input type="text" name="middle_name" placeholder="Middle Name" 
                value="{{ old('middle_name', $user->middle_name) }}">
            @error('middle_name') <div class="validation-error">{{ $message }}</div> @enderror
        </div>

        <!-- Birthdate and Gender -->
        <div class="form-row">
            <div class="form-group">
                <span class="icon">📅</span>
                <input type="date" name="birthdate" placeholder="Birthdate" required 
                    value="{{ old('birthdate', $patient->birthdate) }}">
                @error('birthdate') <div class="validation-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <span class="icon">⚧</span>
                <select name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="male" {{ old('gender', $patient->gender) == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender', $patient->gender) == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender', $patient->gender) == 'other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('gender') <div class="validation-error">{{ $message }}</div> @enderror
            </div>
        </div>

        <!-- Contact and Address -->
        <div class="form-row">
            <div class="form-group">
                <span class="icon">📞</span>
                <input type="text" name="contact_number" placeholder="Contact Number" required 
                    value="{{ old('contact_number', $patient->contact_number) }}">
                @error('contact_number') <div class="validation-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <span class="icon">🏠</span>
                <input type="text" name="address" placeholder="Address" required 
                    value="{{ old('address', $patient->address) }}">
                @error('address') <div class="validation-error">{{ $message }}</div> @enderror
            </div>
        </div>

        <!-- Email -->
        <div class="form-group">
            <span class="icon">✉</span>
            <input type="email" name="email" placeholder="Email" required 
                value="{{ old('email', $user->email) }}">
            @error('email') <div class="validation-error">{{ $message }}</div> @enderror
        </div>

        <!-- Password (Optional) -->
        <div class="form-group">
            <span class="icon">🔒</span>
            <input type="password" name="password" placeholder="New Password (leave blank to keep current)">
            @error('password') <div class="validation-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <span class="icon">🔒</span>
            <input type="password" name="password_confirmation" placeholder="Confirm New Password">
        </div>

        <button type="submit" class="update-button">Save Changes</button>
    </form>
</div>

@endsection