<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        .login-container {
            position: relative;
            width: 100%;
            max-width: 400px;
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

        .form-group {
            position: relative;
            margin-bottom: 20px;
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

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #004258;
            font-size: 14px;
        }

        .remember-me input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #004258;
        }

        .forgot-password {
            color: #004258;
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .login-button {
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

        .login-button:hover {
            background-color: #00354a;
        }

        .signup-link {
            text-align: center;
            font-size: 14px;
        }

        .signup-link a {
            color: #004258;
            text-decoration: none;
        }

        .signup-link a:hover {
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
    <div class="login-container">
        <a href="{{ url('/') }}" class="close-button">×</a>
        
        <div class="avatar"></div>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-group">
                <span class="icon">✉</span>
                <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}">
                @error('email')
                    <div class="validation-error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <span class="icon">🔒</span>
                <input type="password" name="password" placeholder="Password" required>
                @error('password')
                    <div class="validation-error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <span class="icon">👤</span>
                <select name="role" required>
                    <option value="">Login as...</option>
                    <option value="patient" {{ old('role') == 'patient' ? 'selected' : '' }}>Patient</option>
                    <option value="doctor" {{ old('role') == 'doctor' ? 'selected' : '' }}>Doctor</option>
                </select>
                @error('role')
                    <div class="validation-error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-options">
                <label class="remember-me">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    Remember me
                </label>
                
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-password">Forgot Password?</a>
                @endif
            </div>
            
            <button type="submit" class="login-button">Login</button>
        </form>
        
        <div class="signup-link">
            <a href="{{ route('register') }}">Don't have an account yet? Sign up now</a>
        </div>
    </div>
</body>
</html>
