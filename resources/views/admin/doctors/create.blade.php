<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Doctor Account</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* You can reuse the styles from your admin dashboard */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        :root {
            --primary: #004258;
            --primary-light: #5a7d8c;
            --primary-dark: #00354a;
            --accent: rgba(90, 125, 140, 0.7);
            --text: #333;
            --text-light: #777;
            --danger: #e74c3c;
            --success: #2ecc71;
            --warning: #f39c12;
            --info: #3498db;
            --border-radius: 24px;
            --border-radius-sm: 12px;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        body {
            background-color: #f5f5f5;
            color: var(--text);
            min-height: 100vh;
        }

        .app-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Form Styles */
        .form-container {
            max-width: 800px;
            margin: 30px auto;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 30px;
        }

        .form-title {
            color: var(--primary);
            margin-bottom: 20px;
            font-size: 24px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding-bottom: 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: var(--text);
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: var(--border-radius-sm);
            font-size: 16px;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(0, 66, 88, 0.1);
        }

        .form-row {
            display: flex;
            gap: 20px;
        }

        .form-row .form-group {
            flex: 1;
        }

        .btn {
            padding: 12px 20px;
            border-radius: 50px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }

        .btn-outline {
            background-color: transparent;
            color: var(--primary);
            border: 1px solid var(--primary);
        }

        .btn-outline:hover {
            background-color: rgba(0, 66, 88, 0.05);
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
        }

        .validation-error {
            color: var(--danger);
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="app-container">
        <!-- Include your header and sidebar here -->
        
        <main class="main-content">
            <div class="form-container">
                <h2 class="form-title">Create Doctor Account</h2>
                
                <form method="POST" action="{{ route('admin.doctors.store') }}">
                    @csrf
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" id="first_name" name="first_name" class="form-input" required value="{{ old('first_name') }}">
                            @error('first_name')
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
                    </div>
                    
                    <div class="form-group">
                        <label for="middle_name" class="form-label">Middle Name (Optional)</label>
                        <input type="text" id="middle_name" name="middle_name" class="form-input" value="{{ old('middle_name') }}">
                        @error('middle_name')
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
    </div>
</body>
</html>