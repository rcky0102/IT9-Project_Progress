@extends('admin.layout')

@section('title', 'Admin Messages | Medical Clinic')

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
    <h1 class="mb-4">Messages</h1>
    
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">All Messages</h5>
            <a href="{{ route('admin.messages.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> New Message
            </a>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Subject</th>
                            <th>Appointment</th>
                            <th>Sent To</th>
                            <th>Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $message)
                        <tr>
                            <td>{{ $message->id }}</td>
                            <td>{{ $message->subject }}</td>
                            <td>
                                @if($message->appointment)
                                #{{ $message->appointment->id }} - {{ $message->appointment->appointmentType->name ?? 'N/A' }}
                                @else
                                N/A
                                @endif
                            </td>
                            <td>
                                @if($message->appointment && $message->appointment->doctor)
                                Dr. {{ $message->appointment->doctor->user->first_name }}
                                @elseif($message->appointment && $message->appointment->patient)
                                Patient: {{ $message->appointment->patient->user->first_name }}
                                @else
                                System
                                @endif
                            </td>
                            <td>{{ $message->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="{{ route('admin.messages.show', $message->id) }}" 
                                   class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{ $messages->links() }}
        </div>
    </div>
</div>

@endsection