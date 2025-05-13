@extends('admin.settings.index')

@section('title', 'Edit Record Type | Admin Settings | Medical Clinic')

@section('content')

<main class="settings-content">
    <div class="settings-section">
        <div class="settings-header">
            <h1>Edit Record Type</h1>
            <p>Modify the details of the selected medical record type</p>
        </div>

        <div class="card">
            <div class="card-body">
                <form id="record-type-form" action="{{ route('admin.settings.record-types.update', $recordType->id) }}" method="POST">
                    @csrf
                    @method('PUT')

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
                                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $recordType->name) }}" required>
                                    <small class="form-text">Update the full name of the record type</small>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="charge" class="required-field">Charge (₱)</label>
                                    <input type="number" id="charge" name="charge" class="form-control @error('charge') is-invalid @enderror" step="0.01" min="0" value="{{ old('charge', $recordType->charge) }}" required>
                                    <small class="form-text">Update the charge amount in pesos</small>
                                    @error('charge')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('admin.settings.record-types.index') }}" class="btn btn-outline">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Record Type</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropdownBtns = document.querySelectorAll('.dropdown .btn-icon, .dropdown .avatar-btn');

    dropdownBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const menu = this.nextElementSibling;
            menu.classList.toggle('show');

            dropdownBtns.forEach(otherBtn => {
                if (otherBtn !== btn) {
                    const otherMenu = otherBtn.nextElementSibling;
                    if (otherMenu) {
                        otherMenu.classList.remove('show');
                    }
                }
            });
        });
    });

    window.addEventListener('click', function() {
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.classList.remove('show');
        });
    });
});
</script>

@endsection
