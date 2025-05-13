@extends('patient.layout')

@section('title', 'Create Message | Medical Clinic')

@section('content')

<!-- Main Content -->
<main class="main-content">
    <div class="page-header">
        <h1>
            <a href="{{ route('patient.messages') }}" class="btn btn-outline" style="margin-right: 15px;">
                <i class="fas fa-arrow-left"></i> 
            </a>
            Compose New Message
        </h1>
    </div>

    <!-- Compose Message Form -->
    <div class="compose-form">
        <form id="messageForm" method="POST" action="{{ route('patient.messages.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="appointment_id" class="form-label">Select Doctor</label>
                <select name="appointment_id" id="appointment_id" class="form-control" required>
                    <option value="">-- Select a Doctor --</option>
                    @foreach ($uniqueAppointments as $appointment)
                        <option value="{{ $appointment->id }}">
                            Dr. {{ $appointment->doctor->user->first_name }} {{ $appointment->doctor->user->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" id="subject" name="subject" class="form-control" placeholder="Enter message subject" required>
            </div>

            <div class="form-group">
                <label for="content" class="form-label">Message</label>
                <textarea id="content" name="content" class="form-control" rows="8" placeholder="Type your message here..." required></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Message Priority</label>
                <div class="priority-options">
                    <label class="priority-option">
                        <input type="radio" name="priority" value="low" checked> Routine
                    </label>
                    <label class="priority-option">
                        <input type="radio" name="priority" value="medium"> Important
                    </label>
                    <label class="priority-option">
                        <input type="radio" name="priority" value="high"> Urgent
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Attachments</label>
                <div class="file-upload">
                    <label class="file-upload-label">
                        <i class="fas fa-paperclip"></i> Attach File
                        <input type="file" class="file-upload-input" id="attachment" name="attachment">
                    </label>
                    <span class="file-name" id="fileName">No file selected</span>
                </div>
            </div>

            <div class="form-actions">
                <a class="btn btn-outline" href="{{ route('patient.messages') }}">
                    <i class="fas fa-times"></i> Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i> Send Message
                </button>
            </div>
        </form>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // File upload display
    const fileInput = document.getElementById('attachment');
    const fileNameDisplay = document.getElementById('fileName');
    
    if (fileInput && fileNameDisplay) {
        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                fileNameDisplay.textContent = this.files[0].name;
            } else {
                fileNameDisplay.textContent = 'No file selected';
            }
        });
    }

    // Dropdown functionality
    const dropdownBtns = document.querySelectorAll('.dropdown .btn-icon, .dropdown .avatar-btn');
    dropdownBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const menu = this.nextElementSibling;
            menu.classList.toggle('show');
            
            // Close other dropdowns
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

    // Close dropdowns when clicking outside
    window.addEventListener('click', function() {
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.classList.remove('show');
        });
    });
});
</script>

<style>
/* Additional styles specific to the compose form */
.compose-form {
    background-color: white;
    border-radius: var(--border-radius-sm);
    box-shadow: var(--shadow);
    padding: 30px;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: var(--primary);
}

.form-control {
    width: 100%;
    padding: 12px 15px;
    border-radius: var(--border-radius-sm);
    border: 1px solid rgba(0, 0, 0, 0.1);
    font-size: 16px;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary-light);
    box-shadow: 0 0 0 2px rgba(0, 66, 88, 0.1);
}

.form-select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23004258' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 15px center;
    background-size: 16px;
}

.priority-options {
    display: flex;
    gap: 15px;
    margin-top: 10px;
}

.priority-option {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
}

.priority-option input {
    margin: 0;
}

.file-upload {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-top: 10px;
}

.file-upload-label {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    background-color: #f5f5f5;
    border-radius: var(--border-radius-sm);
    cursor: pointer;
    transition: all 0.2s;
}

.file-upload-label:hover {
    background-color: #e9e9e9;
}

.file-upload-input {
    display: none;
}

.file-name {
    font-size: 14px;
    color: var(--text-light);
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 15px;
    margin-top: 30px;
}

@media (max-width: 768px) {
    .compose-form {
        padding: 20px;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .form-actions .btn {
        width: 100%;
    }
    
    .priority-options {
        flex-direction: column;
        gap: 10px;
    }
}
</style>

@endsection