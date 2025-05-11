@extends('doctor.layout')

@section('title', 'Messages | Medical Clinic')

@section('content')

<!-- Main Content -->
            <main class="main-content">
                <div class="page-header">
                    <h1>Messages</h1>
                    <a href="{{ route('patient.messages-create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> New Message
                    </a>
                </div>

                <button id="backToMessages" class="btn btn-outline back-to-messages">
                    <i class="fas fa-arrow-left"></i> Back to Messages
                </button>

                <!-- Messages Container -->
                <div id="messagesWrapper" class="messages-wrapper">
                    <!-- Messages Sidebar -->
                    <div class="messages-sidebar">
                        <div class="messages-search">
                            <input type="text" placeholder="Search messages..." class="search-input" id="searchMessages">
                            <button class="search-btn"><i class="fas fa-search"></i></button>
                        </div>
                        <div class="messages-filters">
                            <button class="filter-btn active" data-filter="all">All</button>
                            <button class="filter-btn" data-filter="unread">Unread</button>
                            <button class="filter-btn" data-filter="sent">Sent</button>
                            <button class="filter-btn" data-filter="archived">Archived</button>
                        </div>
                        <div class="messages-list" id="messagesList">
                            <!-- Message previews will be loaded here -->
                        </div>
                    </div>

                    <!-- Message Content -->
                    <div class="message-content" id="messageContent">
                        <div class="message-empty-state" id="emptyState">
                            <i class="fas fa-envelope-open"></i>
                            <h3>No message selected</h3>
                            <p>Select a message from the list to view its contents</p>
                        </div>
                        
                        <!-- Message details will be loaded here when a message is selected -->
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Sample message data
        const messages = [
            {
                id: 1,
                sender: {
                    name: "Dr. Sarah Johnson",
                    initials: "SJ"
                },
                date: "Mar 24, 2025",
                time: "10:30 AM",
                subject: "Test Results Available",
                snippet: "Your recent blood test results are now available. Please review them at your earliest convenience.",
                unread: true,
                content: `
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
                `
            },
            {
                id: 2,
                sender: {
                    name: "Dr. Michael Chen",
                    initials: "MC"
                },
                date: "Mar 22, 2025",
                time: "2:15 PM",
                subject: "Appointment Confirmation",
                snippet: "This is a confirmation for your upcoming appointment on March 30th at 2:00 PM.",
                unread: true,
                content: `
                    <p>Dear John,</p>
                    <p>This is a confirmation for your upcoming appointment on March 30th at 2:00 PM.</p>
                    <p>Please arrive 15 minutes early to complete any necessary paperwork. Remember to bring your insurance card and a list of any medications you're currently taking.</p>
                    <p>If you need to reschedule or have any questions, please call our office at (555) 123-4567 at least 24 hours in advance.</p>
                    <p>We look forward to seeing you.</p>
                    <p>Best regards,<br>Dr. Michael Chen</p>
                `
            },
            {
                id: 3,
                sender: {
                    name: "Dr. Emily Rodriguez",
                    initials: "ER"
                },
                date: "Mar 20, 2025",
                time: "9:45 AM",
                subject: "Prescription Renewal",
                snippet: "Your prescription for Lisinopril has been renewed. You can pick it up at your pharmacy.",
                unread: false,
                content: `
                    <p>Dear John,</p>
                    <p>I've renewed your prescription for Lisinopril (10mg, once daily). The prescription has been sent electronically to your pharmacy and should be ready for pickup today.</p>
                    <p>This renewal is for a 90-day supply with 3 refills. Please remember to schedule a follow-up appointment before your refills run out so we can evaluate your blood pressure and make any necessary adjustments to your medication.</p>
                    <p>If you experience any side effects or have concerns about your medication, please contact our office immediately.</p>
                    <p>Best regards,<br>Dr. Emily Rodriguez</p>
                `
            },
            {
                id: 4,
                sender: {
                    name: "Dr. James Wilson",
                    initials: "JW"
                },
                date: "Mar 18, 2025",
                time: "3:20 PM",
                subject: "Follow-up Appointment",
                snippet: "Based on your recent visit, I recommend scheduling a follow-up appointment in 3 months.",
                unread: false,
                content: `
                    <p>Dear John,</p>
                    <p>Thank you for coming in for your appointment last week. Based on our discussion and examination, I recommend scheduling a follow-up appointment in 3 months to monitor your progress.</p>
                    <p>In the meantime, please continue with the physical therapy exercises we discussed. Aim for 3-4 sessions per week, and remember to apply ice for 15-20 minutes after each session if you experience any discomfort.</p>
                    <p>If your symptoms worsen or you have any concerns before your next appointment, please don't hesitate to contact our office.</p>
                    <p>Best regards,<br>Dr. James Wilson</p>
                `
            },
            {
                id: 5,
                sender: {
                    name: "Dr. Lisa Thompson",
                    initials: "LT"
                },
                date: "Mar 15, 2025",
                time: "11:10 AM",
                subject: "Vaccination Reminder",
                snippet: "This is a reminder that you're due for your annual flu vaccination.",
                unread: false,
                content: `
                    <p>Dear John,</p>
                    <p>This is a friendly reminder that you're due for your annual flu vaccination. With flu season approaching, we recommend getting vaccinated as soon as possible.</p>
                    <p>Our clinic is offering flu shots Monday through Friday, 9:00 AM to 4:30 PM. No appointment is necessary; you can walk in at your convenience.</p>
                    <p>The vaccination is covered by most insurance plans, including yours. Please bring your insurance card when you come in.</p>
                    <p>If you've already received your flu shot elsewhere, please let us know so we can update your records.</p>
                    <p>Best regards,<br>Dr. Lisa Thompson</p>
                `
            }
        ];

        // DOM elements
        const messagesList = document.getElementById('messagesList');
        const messageContent = document.getElementById('messageContent');
        const emptyState = document.getElementById('emptyState');
        const messagesWrapper = document.getElementById('messagesWrapper');
        const backButton = document.getElementById('backToMessages');
        const searchInput = document.getElementById('searchMessages');
        const filterButtons = document.querySelectorAll('.filter-btn');

        // Current filter
        let currentFilter = 'all';
        let searchTerm = '';

        // Initialize the UI
        function initializeUI() {
            renderMessagesList();
            
            // Add event listeners
            backButton.addEventListener('click', function() {
                messagesWrapper.classList.remove('message-view-active');
            });
            
            searchInput.addEventListener('input', function() {
                searchTerm = this.value.toLowerCase();
                renderMessagesList();
            });
            
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    currentFilter = this.dataset.filter;
                    renderMessagesList();
                });
            });
        }

        // Render the messages list based on current filter and search
        function renderMessagesList() {
            messagesList.innerHTML = '';
            
            const filteredMessages = messages.filter(message => {
                // Apply filter
                if (currentFilter === 'unread' && !message.unread) return false;
                if (currentFilter === 'sent') return false; // No sent messages in this example
                if (currentFilter === 'archived') return false; // No archived messages in this example
                
                // Apply search
                if (searchTerm) {
                    const searchableText = `${message.sender.name} ${message.subject} ${message.snippet}`.toLowerCase();
                    return searchableText.includes(searchTerm);
                }
                
                return true;
            });
            
            if (filteredMessages.length === 0) {
                messagesList.innerHTML = `
                    <div class="p-4 text-center text-muted-foreground">
                        No messages found
                    </div>
                `;
                return;
            }
            
            filteredMessages.forEach(message => {
                const messageElement = document.createElement('div');
                messageElement.className = `message-preview ${message.unread ? 'unread' : ''}`;
                messageElement.dataset.id = message.id;
                messageElement.innerHTML = `
                    <div class="message-avatar">
                        <div class="avatar">
                            <span class="avatar-fallback">${message.sender.initials}</span>
                        </div>
                    </div>
                    <div class="message-info">
                        <div class="message-header">
                            <div class="message-sender">${message.sender.name}</div>
                            <div class="message-time">${message.date}</div>
                        </div>
                        <div class="message-subject">${message.subject}</div>
                        <div class="message-snippet">${message.snippet}</div>
                    </div>
                `;
                
                messageElement.addEventListener('click', function() {
                    const messageId = parseInt(this.dataset.id);
                    showMessage(messageId);
                    
                    // Mark as read
                    if (message.unread) {
                        message.unread = false;
                        this.classList.remove('unread');
                    }
                    
                    // Highlight selected message
                    document.querySelectorAll('.message-preview').forEach(el => {
                        el.classList.remove('active');
                    });
                    this.classList.add('active');
                    
                    // For mobile: show message view
                    messagesWrapper.classList.add('message-view-active');
                });
                
                messagesList.appendChild(messageElement);
            });
        }

        // Show a specific message
        function showMessage(messageId) {
            const message = messages.find(m => m.id === messageId);
            if (!message) return;
            
            emptyState.style.display = 'none';
            
            messageContent.innerHTML = `
                <div class="message-header-bar">
                    <div class="message-title">
                        <h3>${message.subject}</h3>
                        <div class="message-meta">
                            <span>From: ${message.sender.name}</span>
                            <span>To: John Doe</span>
                            <span>${message.date}, ${message.time}</span>
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
                    ${message.content}
                </div>
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
            `;
        }

        // Initialize the UI when the DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            initializeUI();
            
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

@endsection