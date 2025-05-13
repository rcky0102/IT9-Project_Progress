@extends('admin.layout')

@section('title', 'Create Message | Medical Clinic')

@section('content')

<style>
    .message-content {
    white-space: pre-wrap;
    line-height: 1.6;
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.03);
}

.card {
    border-radius: 0.5rem;
}

.form-control {
    border-radius: 0.375rem;
}

.btn {
    border-radius: 0.375rem;
}
</style>

<div class="container">
    <h1 class="mb-4">Send New Message</h1>
    
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.messages.store') }}" method="POST">
                @csrf
                
                <div class="form-group mb-3">
                    <label for="appointment_id">Select Appointment</label>
                    <select name="appointment_id" id="appointment_id" class="form-control" required>
                        <option value="">Select an appointment</option>
                        @foreach($appointments as $appointment)
                        <option value="{{ $appointment->id }}">
                            #{{ $appointment->id }} - 
                            {{ $appointment->patient->user->first_name }} with 
                            Dr. {{ $appointment->doctor->user->first_name }} - 
                            {{ $appointment->appointment_date->format('M d, Y') }}
                        </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group mb-3">
                    <label for="subject">Subject</label>
                    <input type="text" name="subject" id="subject" 
                           class="form-control" required>
                </div>
                
                <div class="form-group mb-3">
                    <label for="content">Message Content</label>
                    <textarea name="content" id="content" rows="5" 
                              class="form-control" required></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i> Send Message
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
c) Show (resources/views/admin/messages/show.blade.php)
html
@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Message Details</h1>
    
    <div class="card shadow-sm">
        <div class="card-header">
            <h5>{{ $message->subject }}</h5>
        </div>
        
        <div class="card-body">
            <div class="mb-4">
                <p><strong>Sent:</strong> {{ $message->created_at->format('M d, Y h:i A') }}</p>
                <p><strong>Sender:</strong> Admin</p>
                
                @if($message->appointment)
                <p><strong>Appointment:</strong> #{{ $message->appointment->id }}</p>
                <p><strong>Patient:</strong> {{ $message->appointment->patient->user->full_name }}</p>
                <p><strong>Doctor:</strong> Dr. {{ $message->appointment->doctor->user->full_name }}</p>
                @endif
            </div>
            
            <div class="message-content p-3 bg-light rounded">
                {!! nl2br(e($message->content)) !!}
            </div>
        </div>
        
        <div class="card-footer">
            <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Messages
            </a>
        </div>
    </div>
</div>
@endsection