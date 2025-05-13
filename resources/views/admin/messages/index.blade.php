@extends('admin.layout') <!-- Changed to admin layout -->

@section('title', 'Admin Messages | Medical Clinic')

@section('content')

<div class="message-container">
    <h2>All Messages</h2>

    @foreach ($messages as $message)
        <div class="message-card">
            <div class="message-header-bar">
                <div class="message-title">
                    <h3>{{ $message->subject }}</h3>
                    <div class="message-meta">
                        <span>To: {{ $message->appointment->doctor->full_name ?? $message->appointment->patient->full_name }}</span>
                        <span>{{ $message->time_ago }}</span>
                    </div>
                </div>
                <div class="message-actions">
                    <a href="{{ route('admin.messages.show', $message) }}" class="btn-sm">View</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection