@extends('patient.layout')

@section('title', 'Message Details | Medical Clinic')

@section('content')

<!-- Main Content -->
<main class="main-content">
    <div class="page-header">
        <h1>
            <a href="{{ route('patient.messages') }}" class="btn btn-outline" style="margin-right: 15px;">
                <i class="fas fa-arrow-left"></i> 
            </a>
            Message Details
        </h1>
        <a href="{{ route('patient.messages.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> New Message
        </a>
    </div>

    <!-- Message Details Container -->
    <div class="message-container">
        <!-- Doctor Info -->
        <div class="doctor-info-bar">
            <div class="avatar">
                <span class="avatar-fallback">Dr</span>
            </div>
            <div class="doctor-info">
                <div class="doctor-name">Dr. {{ $message->appointment->doctor->user->first_name }} {{ $message->appointment->doctor->user->last_name }}</div>
                <div class="doctor-details">
                    <span>Specialty: {{ $message->appointment->doctor->specialization->specialization_name }}</span>
                    {{-- <span>Department: {{ $message->appointment->doctor->department }}</span> --}}
                </div>
            </div>
            {{-- <div class="doctor-actions">
                <a href="#" class="btn btn-outline btn-sm">
                    <i class="fas fa-user-md"></i> View Profile
                </a>
                <a href="#" class="btn btn-outline btn-sm">
                    <i class="fas fa-calendar-plus"></i> Book Appointment
                </a>
            </div> --}}
        </div>

        <!-- Current Message -->
        <div class="message-card">
            <div class="message-header-bar">
                <div class="message-title">
                    <h3>{{ $message->subject }}</h3>
                    <div class="message-meta">
                        <span>From: {{ $message->sender_type == 'doctor' ? 'Dr. ' . $message->appointment->doctor->user->first_name . ' ' . $message->appointment->doctor->user->last_name : 'You' }}</span>
                        <span>To: {{ $message->sender_type == 'doctor' ? 'You' : 'Dr. ' . $message->appointment->doctor->user->first_name . ' ' . $message->appointment->doctor->user->last_name }}</span>
                        <span>{{ \Carbon\Carbon::parse($message->created_at)->format('M d, Y, h:i A') }}</span>
                    </div>
                </div>
                {{-- <div class="message-actions">
                    <button class="btn-icon" title="Reply" onclick="focusReplyBox()">
                        <i class="fas fa-reply"></i>
                    </button>
                    <button class="btn-icon" title="Print" onclick="window.print()">
                        <i class="fas fa-print"></i>
                    </button>
                </div> --}}
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
                <div class="thread-message {{ $threadMessage->sender_type == 'patient' ? 'sent' : 'received' }}">
                    <div class="thread-message-header">
                        <div class="thread-message-sender">
                            {{ $threadMessage->sender_type == 'patient' ? 'You' : 'Dr. ' . $threadMessage->appointment->doctor->user->first_name . ' ' . $threadMessage->appointment->doctor->user->last_name }}
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

        

        <!-- Common Questions -->
        {{-- <div class="quick-reply-options">
            <button class="quick-reply-btn" onclick="insertQuickReply('When will my test results be ready?')">
                <i class="fas fa-flask"></i> Test Results
            </button>
            <button class="quick-reply-btn" onclick="insertQuickReply('I need to reschedule my appointment. What dates are available?')">
                <i class="fas fa-calendar-alt"></i> Reschedule
            </button>
            <button class="quick-reply-btn" onclick="insertQuickReply('I need a prescription refill. Can you help with this?')">
                <i class="fas fa-prescription-bottle"></i> Refill
            </button>
            <button class="quick-reply-btn" onclick="insertQuickReply('I\'m experiencing new symptoms. Should I come in for a visit?')">
                <i class="fas fa-stethoscope"></i> New Symptoms
            </button>
        </div> --}}

        <!-- Reply Box -->
        {{-- <div class="reply-box">
            <h4>Reply</h4>
            <form action="{{ route('patient.messages.reply', $message->id) }}" method="POST">
                @csrf
                <textarea name="content" id="replyText" placeholder="Type your reply here..." rows="4" class="reply-textarea"></textarea>
                <div class="reply-actions">
                    <label for="attachment" class="btn btn-outline">
                        <i class="fas fa-paperclip"></i> Attach
                        <input type="file" id="attachment" name="attachment" style="display: none;">
                    </label>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Create Message
                    </button>
                </div>
            </form>
        </div> --}}
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

.doctor-info-bar {
    background-color: white;
    border-radius: var(--border-radius-sm);
    box-shadow: var(--shadow);
    padding: 15px 20px;
    display: flex;
    align-items: center;
    gap: 15px;
}

.doctor-info {
    flex: 1;
}

.doctor-name {
    font-weight: bold;
    color: var(--primary);
    margin-bottom: 3px;
}

.doctor-details {
    display: flex;
    gap: 15px;
    font-size: 14px;
    color: var(--text-light);
}

.doctor-actions {
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
    .doctor-details {
        flex-direction: column;
        gap: 5px;
    }
    
    .doctor-actions {
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