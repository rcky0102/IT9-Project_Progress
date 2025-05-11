@extends('doctor.layout')

@section('title', 'Messages | Medical Clinic')

@section('content')

<!-- Main Content -->
<main class="main-content">
    <div class="page-header">
        <h1>Messages</h1>
       <a href="{{ route('doctor.message-create') }}" class="btn btn-primary">
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

<script>
    // Assuming you passed the messages from the controller to the Blade template
    const messages = @json($messages);

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
                const searchableText = `${message.appointment.patient.user.first_name} ${message.appointment.patient.user.last_name} ${message.subject} ${message.snippet}`.toLowerCase();
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
                        <span class="avatar-fallback">${message.appointment.patient.user.first_name[0]}${message.appointment.patient.user.last_name[0]}</span>
                    </div>
                </div>
                <div class="message-info">
                    <div class="message-header">
                        <div class="message-sender">${message.appointment.patient.user.first_name} ${message.appointment.patient.user.last_name}</div>
                        <div class="message-time">${message.created_at}</div>
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
                        <span>From: Dr. ${message.appointment.doctor.user.first_name} ${message.appointment.doctor.user.last_name}</span>
                        <span>To: ${message.appointment.patient.user.first_name} ${message.appointment.patient.user.last_name}</span>
                        <span>${message.created_at}</span>
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