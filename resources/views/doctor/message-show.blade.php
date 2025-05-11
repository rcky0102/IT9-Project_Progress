@extends('doctor.layout')

@section('title', 'Message Details | Medical Clinic')

@section('content')

<!-- Main Content -->
<main class="main-content">
    <div class="page-header">
        <h1>
            <a href="{{ route('doctor.messages') }}" class="btn btn-outline" style="margin-right: 15px;">
                <i class="fas fa-arrow-left"></i> Back to Messages
            </a>
            Message Details
        </h1>
    </div>

    <!-- Message Details Container -->
    <div class="message-container">
        <!-- Patient Info -->
        <div class="patient-info-bar">
            <div class="avatar">
                <span class="avatar-fallback">{{ $message->appointment->patient->user->first_name[0] }}{{ $message->appointment->patient->user->last_name[0] }}</span>
            </div>
            <div class="patient-info">
                <div class="patient-name">{{ $message->appointment->patient->user->first_name }} {{ $message->appointment->patient->user->last_name }}</div>
                <div class="patient-details">
                    <span>Age: {{ $message->appointment->patient->age }}</span>
                    <span>DOB: {{ $message->appointment->patient->date_of_birth }}</span>
                    <span>MRN: {{ $message->appointment->patient->medical_record_number }}</span>
                </div>
            </div>
            <div class="patient-actions">
                <a href="#" class="btn btn-outline btn-sm">
                    <i class="fas fa-user-injured"></i> View Profile
                </a>
                <a href="#" class="btn btn-outline btn-sm">
                    <i class="fas fa-file-medical"></i> Medical Records
                </a>
            </div>
        </div>

        <!-- Current Message -->
        <div class="message-card">
            <div class="message-header-bar">
                <div class="message-title">
                    <h3>{{ $message->subject }}</h3>
                    <div class="message-meta">
                        <span>From: {{ $message->sender_type == 'doctor' ? 'Dr. ' . $message->appointment->doctor->user->first_name . ' ' . $message->appointment->doctor->user->last_name : $message->appointment->patient->user->first_name . ' ' . $message->appointment->patient->user->last_name }}</span>
                        <span>To: {{ $message->sender_type == 'doctor' ? $message->appointment->patient->user->first_name . ' ' . $message->appointment->patient->user->last_name : 'Dr. ' . $message->appointment->doctor->user->first_name . ' ' . $message->appointment->doctor->user->last_name }}</span>
                        <span>{{ \Carbon\Carbon::parse($message->created_at)->format('M d, Y, h:i A') }}</span>
                    </div>
                </div>
                <div class="message-actions">
                    <button class="btn-icon" title="Reply" onclick="focusReplyBox()">
                        <i class="fas fa-reply"></i>
                    </button>
                    <button class="btn-icon" title="Forward" onclick="forwardMessage()">
                        <i class="fas fa-share"></i>
                    </button>
                    <button class="btn-icon" title="Print" onclick="window.print()">
                        <i class="fas fa-print"></i>
                    </button>
                    <button class="btn-icon" title="Delete" onclick="deleteMessage()">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            <div class="message-body">
                {{ $message->content }}
            </div>
        </div>

        <!-- Message Thread -->
        <div class="message-thread">
            <h3>Conversation History</h3>
            
            @foreach($thread as $threadMessage)
                @if($threadMessage->id != $message->id)
                <div class="thread-message {{ $threadMessage->sender_type == 'doctor' ? 'sent' : 'received' }}">
                    <div class="thread-message-header">
                        <div class="thread-message-sender">
                            {{ $threadMessage->sender_type == 'doctor' ? 'Dr. ' . $threadMessage->appointment->doctor->user->first_name . ' ' . $threadMessage->appointment->doctor->user->last_name : $threadMessage->appointment->patient->user->first_name . ' ' . $threadMessage->appointment->patient->user->last_name }}
                        </div>
                        <div class="thread-message-time">
                            {{ \Carbon\Carbon::parse($threadMessage->created_at)->format('M d, Y, h:i A') }}
                        </div>
                    </div>
                    <div class="thread-message-content">
                        {{ $threadMessage->content }}
                    </div>
                </div>
                @endif
            @endforeach
        </div>

        <!-- Quick Reply Options -->
        <div class="quick-reply-options">
            <button class="quick-reply-btn" onclick="insertQuickReply('I\'ll review your results and get back to you shortly.')">
                <i class="fas fa-check"></i> Will Review
            </button>
            <button class="quick-reply-btn" onclick="insertQuickReply('Please schedule an appointment to discuss this further.')">
                <i class="fas fa-calendar-plus"></i> Schedule Appointment
            </button>
            <button class="quick-reply-btn" onclick="insertQuickReply('Your prescription has been renewed and sent to your pharmacy.')">
                <i class="fas fa-prescription"></i> Prescription Renewed
            </button>
            <button class="quick-reply-btn" onclick="insertQuickReply('Please call our office at (555) 123-4567 for immediate assistance.')">
                <i class="fas fa-phone"></i> Call Office
            </button>
        </div>

        <!-- Reply Box -->
        <div class="reply-box">
            <h4>Reply</h4>
            <form action="{{ route('doctor.messages.reply', $message->id) }}" method="POST">
                @csrf
                <textarea name="content" id="replyText" placeholder="Type your reply here..." rows="4" class="reply-textarea"></textarea>
                <div class="reply-actions">
                    <label for="attachment" class="btn btn-outline">
                        <i class="fas fa-paperclip"></i> Attach
                        <input type="file" id="attachment" name="attachment" style="display: none;">
                    </label>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Send
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
// Function to focus on reply box
function focusReplyBox() {
    document.getElementById('replyText').focus();
}

// Function to insert quick reply
function insertQuickReply(text) {
    document.getElementById('replyText').value = text;
    document.getElementById('replyText').focus();
}

// Function to forward message
function forwardMessage() {
    window.location.href = "{{ route('doctor.messages.forward', $message->id) }}";
}

// Function to delete message
function deleteMessage() {
    if (confirm('Are you sure you want to delete this message?')) {
        // Create a form and submit it
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = "{{ route('doctor.messages.destroy', $message->id) }}";
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = "{{ csrf_token() }}";
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    }
}

// Initialize UI on DOM load
document.addEventListener('DOMContentLoaded', () => {
    // File upload display
    const fileInput = document.getElementById('attachment');
    if (fileInput) {
        fileInput.addEventListener('change', function() {
            const fileName = this.files.length > 0 ? this.files[0].name : 'No file selected';
            alert(`File selected: ${fileName}`);
        });
    }
});
</script>

<style>
/* Styles for the message detail page */
.message-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.patient-info-bar {
    background-color: white;
    border-radius: var(--border-radius-sm);
    box-shadow: var(--shadow);
    padding: 15px 20px;
    display: flex;
    align-items: center;
    gap: 15px;
}

.patient-info {
    flex: 1;
}

.patient-name {
    font-weight: bold;
    color: var(--primary);
    margin-bottom: 3px;
}

.patient-details {
    display: flex;
    gap: 15px;
    font-size: 14px;
    color: var(--text-light);
}

.patient-actions {
    display: flex;
    gap: 10px;
}

.message-card {
    background-color: white;
    border-radius: var(--border-radius-sm);
    box-shadow: var(--shadow);
    overflow: hidden;
}

.message-header-bar {
    padding: 20px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.message-title h3 {
    color: var(--primary);
    margin-bottom: 10px;
}

.message-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    font-size: 14px;
    color: var(--text-light);
}

.message-actions {
    display: flex;
    gap: 10px;
}

.message-body {
    padding: 30px;
    line-height: 1.6;
    white-space: pre-wrap;
}

.message-thread {
    background-color: white;
    border-radius: var(--border-radius-sm);
    box-shadow: var(--shadow);
    padding: 20px;
}

.message-thread h3 {
    color: var(--primary);
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

.thread-message {
    margin-bottom: 20px;
    padding: 15px;
    border-radius: var(--border-radius-sm);
    max-width: 80%;
}

.thread-message.sent {
    background-color: rgba(0, 66, 88, 0.1);
    margin-left: auto;
}

.thread-message.received {
    background-color: #f5f5f5;
    margin-right: auto;
}

.thread-message-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.thread-message-sender {
    font-weight: bold;
    color: var(--primary);
}

.thread-message-time {
    font-size: 12px;
    color: var(--text-light);
}

.thread-message-content {
    line-height: 1.5;
    white-space: pre-wrap;
}

.quick-reply-options {
    display: flex;
    gap: 10px;
    padding: 15px;
    background-color: white;
    border-radius: var(--border-radius-sm);
    box-shadow: var(--shadow);
    overflow-x: auto;
}

.quick-reply-btn {
    padding: 8px 16px;
    border-radius: 50px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    background-color: white;
    cursor: pointer;
    transition: all 0.2s;
    font-size: 14px;
    white-space: nowrap;
}

.quick-reply-btn:hover {
    background-color: rgba(0, 66, 88, 0.05);
}

.reply-box {
    background-color: white;
    border-radius: var(--border-radius-sm);
    box-shadow: var(--shadow);
    padding: 20px;
}

.reply-box h4 {
    color: var(--primary);
    margin-bottom: 15px;
}

.reply-textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    resize: none;
    margin-bottom: 15px;
}

.reply-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

.btn-sm {
    padding: 6px 12px;
    font-size: 14px;
}

.avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    position: relative;
    overflow: hidden;
    border: 2px solid white;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.avatar-fallback {
    font-size: 16px;
}

@media (max-width: 768px) {
    .patient-details {
        flex-direction: column;
        gap: 5px;
    }
    
    .patient-actions {
        flex-direction: column;
    }
    
    .message-meta {
        flex-direction: column;
        gap: 5px;
    }
    
    .thread-message {
        max-width: 100%;
    }
    
    .quick-reply-options {
        padding: 10px;
    }
}
</style>

@endsection