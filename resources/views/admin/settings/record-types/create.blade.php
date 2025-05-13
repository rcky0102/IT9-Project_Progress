@extends('admin.settings.index')

@section('title', 'Create Record Types | Admin Settings | Medical Clinic')

@section('content')

<main class="settings-content">
    <div class="settings-section">
        <div class="settings-header">
            <h1>Create Record Type</h1>
            <p>Add a new medical record type to the system</p>
        </div>

        <div class="card">
            <div class="card-body">
                <form id="record-type-form" action="{{ route('admin.settings.record-types.store') }}" method="POST">
                    @csrf

                    <!-- Error Handling -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops! Something went wrong.</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-section">
                        <h3 class="form-section-title">Basic Information</h3>
                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="name" class="required-field">Record Type Name</label>
                                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                    <small class="form-text">Enter the full name of the record type</small>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="charge" class="required-field">Charge (₱)</label>
                                    <input type="number" id="charge" name="charge" class="form-control @error('charge') is-invalid @enderror" step="0.01" min="0" value="{{ old('charge') }}" required>
                                    <small class="form-text">Enter the charge amount in pesos</small>
                                    @error('charge')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3 class="form-section-title">Custom Fields</h3>
                        <div id="custom-fields-container">
                            <!-- Dynamic custom fields will be appended here -->
                        </div>
                        <button type="button" id="add-field-btn" class="btn btn-outline">Add Custom Field</button>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('admin.settings.record-types.index') }}" class="btn btn-outline">Cancel</a>
                        <button type="submit" class="btn btn-primary">Create Record Type</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let fieldCounter = 1;

    // Add custom field
    document.getElementById('add-field-btn').addEventListener('click', function() {
        const container = document.getElementById('custom-fields-container');
        const fieldRow = document.createElement('div');
        fieldRow.className = 'custom-field-row';
        fieldRow.style = 'display: flex; gap: 10px; margin-bottom: 10px;';
        
        fieldRow.innerHTML = `
            <input type="text" name="custom_fields[${fieldCounter}][name]" class="form-control" placeholder="Field name" style="flex: 2;">
            <select name="custom_fields[${fieldCounter}][type]" class="form-control" style="flex: 1;">
                <option value="text">Text</option>
                <option value="number">Number</option>
                <option value="date">Date</option>
                <option value="select">Dropdown</option>
                <option value="checkbox">Checkbox</option>
            </select>
            <button type="button" class="btn-icon delete-field-btn">
                <i class="fas fa-times"></i>
            </button>
        `;
        
        container.appendChild(fieldRow);
        fieldCounter++;
        
        // Add event listener to the delete button
        fieldRow.querySelector('.delete-field-btn').addEventListener('click', function() {
            fieldRow.remove();
        });
    });

    // Delete custom field
    document.querySelectorAll('.delete-field-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            this.closest('.custom-field-row').remove();
        });
    });
});
</script>

@endsection
