@extends('patient.layout')

@section('title', 'Patient Dashboard | Medical Clinic')

@section('content')

<!-- Main Content -->
<main class="main-content">
    <div class="page-header">
        <h1>Messages</h1>
        <button class="btn btn-primary">
            <i class="fas fa-plus"></i> New Message
        </button>
    </div>

    <!-- Messages Container -->
    <div class="messages-container">
        <!-- Messages Sidebar -->
        <div class="messages-sidebar">
            <div class="messages-search">
                <input type="text" placeholder="Search messages..." class="search-input">
                <button class="search-btn"><i class="fas fa-search"></i></button>
            </div>
            <div class="messages-filters">
                <button class="filter-btn active">All</button>
                <button class="filter-btn">Unread</button>
                <button class="filter-btn">Sent</button>
                <button class="filter-btn">Archived</button>
            </div>
            <div class="messages-list">

                 @foreach ($doctors as $doctor)
                    <div class="message-preview unread">
                        <div class="message-avatar">
                            <div class="avatar">
                                <span class="avatar-fallback">{{ strtoupper(substr($doctor->user->first_name, 0, 1)) }}{{ strtoupper(substr($doctor->user->last_name, 0, 1)) }}</span>
                            </div>
                        </div>
                        <div class="message-info">
                            <div class="message-header">
                                <div class="message-sender">{{ $doctor->getFullNameAttribute() }}</div>
                                <div class="message-time">
                                    @if ($doctor->appointments->isNotEmpty())
                                        {{-- Ensure appointment_date is a Carbon instance --}}
                                        @php
                                            $appointmentDate = $doctor->appointments->last()->appointment_date;
                                            if (!$appointmentDate instanceof \Carbon\Carbon) {
                                                $appointmentDate = \Carbon\Carbon::parse($appointmentDate);
                                            }
                                        @endphp
                                        {{ $appointmentDate->format('M d, Y') }}
                                    @else
                                        No Appointments
                                    @endif
                                </div>
                            </div>
                            <div class="message-subject">
                                @if ($doctor->appointments->isNotEmpty())
                                    {{ $doctor->appointments->last()->reason }} 
                                @else
                                    No recent appointments scheduled.
                                @endif
                            </div>
                            <div class="message-snippet">
                                @if ($doctor->appointments->isNotEmpty())
                                    {{ $doctor->appointments->last()->notes }} 
                                @else
                                    This doctor has no appointments yet.
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        <!-- Message Content -->
        <div class="message-content">
            <div class="message-header-bar">
                <div class="message-title">
                    <h3>Test Results Available</h3>
                    <div class="message-meta">
                        <span>From: Dr. Sarah Johnson</span>
                        <span>To: John Doe</span>
                        <span>Mar 24, 2025, 10:30 AM</span>
                    </div>
                </div>
                <div class="message-actions">
                    <button class="btn-icon" title="Reply">
                        <i class="fas fa-reply"></i>
                    </button>
                    <button class="btn-icon" title="Forward">
                        <i class="fas fa-share"></i>
                    </button>
                    <button class="btn-icon" title="Print">
                        <i class="fas fa-print"></i>
                    </button>
                    <button class="btn-icon" title="Delete">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            <div class="message-body">
                <p>Dear John,</p>
                <p>Your recent blood test results are now available. Please review them at your earliest convenience.</p>
                <p>Overall, your results look good. Your cholesterol levels have improved since your last test, which is excellent news. Your blood pressure readings are also within the normal range.</p>
                <p>There are a few items I'd like to discuss with you during your upcoming appointment on March 30th:</p>
                <ul>
                    <li>Your vitamin D levels are slightly lower than optimal. I recommend increasing your daily supplement to 2000 IU.</li>
                    <li>Your glucose levels, while still in the normal range, have increased slightly since your last test. We should monitor this.</li>
                </ul>
                <p>I've attached the full lab report for your records. Please let me know if you have any questions before our appointment.</p>
                <p>Best regards,<br>Dr. Sarah Johnson</p>
            </div>
            {{-- <div class="message-attachments">
                <h4>Attachments</h4>
                <div class="attachment-list">
                    <div class="attachment-item">
                        <div class="attachment-icon">
                            <i class="fas fa-file-pdf"></i>
                        </div>
                        <div class="attachment-details">
                            <div class="attachment-name">Blood_Test_Results_Mar2025.pdf</div>
                            <div class="attachment-size">1.2 MB</div>
                        </div>
                        <div class="attachment-actions">
                            <button class="btn-icon" title="Download">
                                <i class="fas fa-download"></i>
                            </button>
                            <button class="btn-icon" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="reply-box">
                <h4>Reply</h4>
                <textarea placeholder="Type your reply here..." rows="4" class="reply-textarea"></textarea>
                <div class="reply-actions">
                    <button class="btn btn-outline">
                        <i class="fas fa-paperclip"></i> Attach
                    </button>
                    <button class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Send
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
// Dropdown functionality
document.addEventListener('DOMContentLoaded', function() {
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

// Filter buttons
const filterBtns = document.querySelectorAll('.filter-btn');
filterBtns.forEach(btn => {
    btn.addEventListener('click', function() {
        filterBtns.forEach(b => b.classList.remove('active'));
        this.classList.add('active');
    });
});

// Message preview selection
const messagePreviews = document.querySelectorAll('.message-preview');
messagePreviews.forEach(preview => {
    preview.addEventListener('click', function() {
        messagePreviews.forEach(p => p.classList.remove('active'));
        this.classList.add('active');
        this.classList.remove('unread');
    });
});
});
</script>

@endsection