<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .register-container {
            position: relative;
            width: 100%;
            max-width: 500px;
            background-color: white;
            border-radius: 24px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .close-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 24px;
            color: #777;
        }

        .avatar {
            position: relative;
            width: 100px;
            height: 100px;
            margin: 0 auto 30px;
            background-color: #004258;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .avatar::before {
            content: "";
            position: absolute;
            top: 25%;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 40px;
            background-color: white;
            border-radius: 50%;
        }

        .avatar::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 48px;
            background-color: #5a7d8c;
            border-bottom-left-radius: 50px;
            border-bottom-right-radius: 50px;
        }

        .form-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #004258;
            margin-bottom: 20px;
        }

        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        .form-row {
            display: flex;
            gap: 15px;
        }

        .form-row .form-group {
            flex: 1;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: none;
            border-radius: 50px;
            background-color: rgba(90, 125, 140, 0.7);
            color: white;
            font-size: 16px;
        }

        .form-group select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 16px;
        }

        .form-group input::placeholder, .form-group select::placeholder {
            color: rgba(255, 255, 255, 0.8);
        }

        .form-group select option {
            background-color: #004258;
            color: white;
        }

        .form-group .icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #004258;
            font-weight: bold;
        }

        .register-button {
            width: 100%;
            padding: 16px;
            background-color: #004258;
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            margin-bottom: 20px;
        }

        .register-button:hover {
            background-color: #00354a;
        }

        .login-link {
            text-align: center;
            font-size: 14px;
        }

        .login-link a {
            color: #004258;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .validation-error {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 5px;
            padding-left: 15px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <a href="{{ url('/') }}" class="close-button">×</a>
        
        <div class="avatar"></div>
        <div class="form-title">Create Patient Account</div>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name Fields -->
            <div class="form-row">
                <div class="form-group">
                    <span class="icon">👤</span>
                    <input type="text" name="first_name" placeholder="First Name" required value="{{ old('first_name') }}">
                    @error('first_name') <div class="validation-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <span class="icon">👤</span>
                    <input type="text" name="last_name" placeholder="Last Name" required value="{{ old('last_name') }}">
                    @error('last_name') <div class="validation-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-group">
                <span class="icon">👤</span>
                <input type="text" name="middle_name" placeholder="Middle Name" value="{{ old('middle_name') }}">
                @error('middle_name') <div class="validation-error">{{ $message }}</div> @enderror
            </div>

            <!-- Birthdate and Gender -->
            <div class="form-row">
                <div class="form-group">
                    <span class="icon">📅</span>
                    <input type="date" name="birthdate" placeholder="Birthdate" required value="{{ old('birthdate') }}">
                    @error('birthdate') <div class="validation-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <span class="icon">⚧</span>
                    <select name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('gender') <div class="validation-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <!-- Contact and Address -->
            <div class="form-row">
                <div class="form-group">
                    <span class="icon">📞</span>
                    <input type="text" name="contact_number" placeholder="Contact Number" required value="{{ old('contact_number') }}">
                    @error('contact_number') <div class="validation-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <span class="icon">🏠</span>
                    <input type="text" name="address" placeholder="Address" required value="{{ old('address') }}">
                    @error('address') <div class="validation-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <!-- Email -->
            <div class="form-group">
                <span class="icon">✉</span>
                <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}">
                @error('email') <div class="validation-error">{{ $message }}</div> @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <span class="icon">🔒</span>
                <input type="password" name="password" placeholder="Password" required>
                @error('password') <div class="validation-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <span class="icon">🔒</span>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
            </div>

            <button type="submit" class="register-button">Register</button>
        </form>

        
        
        <div class="login-link">
            <a href="{{ route('login') }}">Already have an account? Login here</a>
        </div>
    </div>
</body>
</html>