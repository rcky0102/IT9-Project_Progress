@extends('patient.layout')

@section('title', 'Messages | Medical Clinic')

@section('content')

<!-- Main Content -->
<main class="main-content">
    <div class="page-header">
        <h1>Messages</h1>
        <a href="{{ route('patient.messages.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> New Message
        </a>
    </div>

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
                <button class="filter-btn" data-filter="sent">Sent</button>
                <button class="filter-btn" data-filter="received">Received</button>
                <button class="filter-btn" data-filter="archived">Archived</button>
            </div>
            <div class="messages-list" id="messagesList">
                <!-- Message previews will be loaded here -->
            </div>
        </div>
    </div>
</main>

<script>
// Assuming messages are passed from the controller
const messages = @json($messages);

// DOM elements
const messagesList = document.getElementById('messagesList');
const searchInput = document.getElementById('searchMessages');
const filterButtons = document.querySelectorAll('.filter-btn');

// Current filter and search term
let currentFilter = 'all';
let searchTerm = '';

// Utility: Escape HTML to prevent XSS
function escapeHTML(str) {
    return str.replace(/[&<>"']/g, function(match) {
        const escapeMap = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#39;'
        };
        return escapeMap[match];
    });
}

// Utility: Format timestamp
function formatDate(timestamp) {
    const date = new Date(timestamp);
    return date.toLocaleString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

// Initialize the UI
function initializeUI() {
    renderMessagesList();

    searchInput.addEventListener('input', () => {
        searchTerm = searchInput.value.toLowerCase();
        renderMessagesList();
    });

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            currentFilter = button.dataset.filter;
            renderMessagesList();
        });
    });

    // Event delegation for message clicks
    messagesList.addEventListener('click', (e) => {
        const messageElement = e.target.closest('.message-preview');
        if (messageElement) {
            const messageId = parseInt(messageElement.dataset.id);

            // Highlight selected message
            document.querySelectorAll('.message-preview').forEach(el => el.classList.remove('active'));
            messageElement.classList.add('active');
            
            // Redirect to the message detail page with the correct message ID
            window.location.href = `/patient/messages/${messageId}`;
        }
    });
}

// Render the messages list (one message per doctor)
function renderMessagesList() {
    messagesList.innerHTML = '';

    // Group messages by doctor and select the most recent
    const doctorMessages = {};
    messages.forEach(message => {
        // Use doctor.user.id if available, else fallback to name
        const doctorId = message.appointment.doctor.user.id || 
                         `${message.appointment.doctor.user.first_name}_${message.appointment.doctor.user.last_name}`;
        if (!doctorMessages[doctorId] || new Date(message.created_at) > new Date(doctorMessages[doctorId].created_at)) {
            doctorMessages[doctorId] = message;
        }
    });

    // Convert to array and apply filters
    let filteredMessages = Object.values(doctorMessages).filter(message => {
        // Apply filter
        if (currentFilter === 'sent' && message.sender_type !== 'patient') return false;
        if (currentFilter === 'received' && message.sender_type !== 'doctor') return false;
        if (currentFilter === 'archived' && !message.isArchived) return false; // Placeholder for archived filter

        // Apply search
        if (searchTerm) {
            const searchableText = `${message.appointment.doctor.user.first_name} ${message.appointment.doctor.user.last_name} ${message.subject} ${message.content}`.toLowerCase();
            return searchableText.includes(searchTerm);
        }
        return true;
    });

    // Sort by created_at (newest first)
    filteredMessages.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));

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
        messageElement.className = 'message-preview';
        messageElement.dataset.id = message.id;
        messageElement.innerHTML = `
            <div class="message-avatar">
                <div class="avatar">
                    <span class="avatar-fallback">Dr</span>
                </div>
            </div>
            <div class="message-info">
                <div class="message-header">
                    <div class="message-sender">Dr. ${escapeHTML(message.appointment.doctor.user.first_name)} ${escapeHTML(message.appointment.doctor.user.last_name)}</div>
                    <div class="message-time">${formatDate(message.created_at)}</div>
                </div>
                <div class="message-subject">${escapeHTML(message.subject)}</div>
                <div class="message-snippet">${escapeHTML(message.content.substring(0, 100))}${message.content.length > 100 ? '...' : ''}</div>
            </div>
        `;
        messagesList.appendChild(messageElement);
    });
}

// Initialize UI on DOM load
document.addEventListener('DOMContentLoaded', () => {
    initializeUI();

    // Dropdown functionality
    const dropdownBtns = document.querySelectorAll('.dropdown .btn-icon, .dropdown .avatar-btn');
    dropdownBtns.forEach(btn => {
        btn.addEventListener('click', e => {
            e.stopPropagation();
            const menu = btn.nextElementSibling;
            menu.classList.toggle('show');
            dropdownBtns.forEach(otherBtn => {
                if (otherBtn !== btn) {
                    const otherMenu = otherBtn.nextElementSibling;
                    if (otherMenu) otherMenu.classList.remove('show');
                }
            });
        });
    });

    window.addEventListener('click', () => {
        document.querySelectorAll('.dropdown-menu').forEach(menu => menu.classList.remove('show'));
    });
});
</script>

<style>
/* Styles for the messages list */
.messages-wrapper {
    background-color: white;
    border-radius: var(--border-radius-sm);
    box-shadow: var(--shadow);
    overflow: hidden;
    height: calc(100vh - 200px);
    min-height: 500px;
}

.messages-sidebar {
    width: 100%;
    display: flex;
    flex-direction: column;
}

.messages-search {
    padding: 15px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    display: flex;
}

.messages-search .search-input {
    flex: 1;
    padding: 8px 16px;
    border-radius: 50px 0 0 50px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-right: none;
}

.search-btn {
    padding: 8px 16px;
    border-radius: 0 50px 50px 0;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-left: none;
    background-color: white;
    cursor: pointer;
    transition: all 0.2s;
}

.search-btn:hover {
    background-color: rgba(0, 66, 88, 0.05);
}

.messages-filters {
    padding: 10px 15px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    display: flex;
    gap: 10px;
    overflow-x: auto;
}

.filter-btn {
    padding: 8px 16px;
    border-radius: 50px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    background-color: white;
    cursor: pointer;
    transition: all 0.2s;
    font-size: 14px;
}

.filter-btn:hover {
    background-color: rgba(0, 66, 88, 0.05);
}

.filter-btn.active {
    background-color: var(--primary);
    color: white;
    border-color: var(--primary);
}

.messages-list {
    flex: 1;
    overflow-y: auto;
}

.message-preview {
    display: flex;
    padding: 15px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    cursor: pointer;
    transition: background-color 0.2s;
}

.message-preview:hover {
    background-color: rgba(0, 66, 88, 0.05);
}

.message-preview.active {
    background-color: rgba(0, 66, 88, 0.1);
}

.message-avatar {
    margin-right: 15px;
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

.message-info {
    flex: 1;
    min-width: 0;
}

.message-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 5px;
}

.message-sender {
    font-weight: bold;
}

.message-time {
    font-size: 12px;
    color: var(--text-light);
}

.message-subject {
    margin-bottom: 5px;
}

.message-snippet {
    font-size: 14px;
    color: var(--text-light);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

@media (max-width: 768px) {
    .messages-wrapper {
        height: auto;
        max-height: 70vh;
    }
}
</style>

@endsection