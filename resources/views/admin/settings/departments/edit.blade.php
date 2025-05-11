@extends('admin.settings.index')

@section('title', 'Edit Department | Admin Settings | Medical Clinic')

@section('content')

    <!-- Main Content -->
    <main class="settings-content">
        <!-- Doctor Departments Section -->
        <div class="settings-section" id="doctor-departments-section">
            <div class="settings-header">
                <h1>Edit Department</h1>
                <p>Modify the department details</p>
                <a href="{{ route('admin.settings.departments.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Departments
                </a>
            </div>

            <!-- Edit Department Form -->
            <div class="form-container">
                <form action="{{ route('admin.settings.departments.update', $department->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Department Name -->
                    <div class="form-group">
                        <label for="department_name">Department Name</label>
                        <input type="text" name="department_name" id="department_name" class="form-control"
                               value="{{ old('department_name', $department->department_name) }}" required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </form>
            </div>
        </div>
    </main>

@endsection
