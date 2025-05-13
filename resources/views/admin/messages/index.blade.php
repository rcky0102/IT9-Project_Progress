@extends('admin.layout')

@section('title', 'Admin Messages | Medical Clinic')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Messages</h3>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <!-- New Message Form -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    <h4 class="card-title">New Message</h4>
                                </div>
                                <div class="card-body">
                                    <form action="#" method="POST">
                                        @csrf
                                        
                                        <div class="form-group">
                                            <label for="recipient_type">Recipient Type</label>
                                            <select class="form-control" id="recipient_type" name="recipient_type" required>
                                                <option value="">Select Recipient</option>
                                                <option value="doctor">Doctor</option>
                                                <option value="patient">Patient</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="recipient_id">Recipient</label>
                                            <select class="form-control" id="recipient_id" name="recipient_id" required disabled>
                                                <option value="">Select recipient type first</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="subject">Subject</label>
                                            <input type="text" class="form-control" id="subject" name="subject" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="content">Message</label>
                                            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary">Send Message</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Messages List -->
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header bg-secondary text-white">
                                    <h4 class="card-title">Message History</h4>
                                </div>
                                <div class="card-body">
                                    @if($messages->isEmpty())
                                        <div class="alert alert-info">No messages found</div>
                                    @else
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Subject</th>
                                                        <th>Recipient</th>
                                                        <th>Preview</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($messages as $message)
                                                    <tr>
                                                        <td>{{ $message->created_at->format('M d, Y h:i A') }}</td>
                                                        <td>{{ $message->subject }}</td>
                                                        <td>
                                                            @if($message->appointment->doctor)
                                                                Dr. {{ $message->appointment->doctor->full_name }}
                                                            @elseif($message->appointment->patient)
                                                                {{ $message->appointment->patient->full_name }}
                                                            @else
                                                                System
                                                            @endif
                                                        </td>
                                                        <td>{{ Str::limit($message->content, 50) }}</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-info view-message" 
                                                                    data-subject="{{ $message->subject }}"
                                                                    data-content="{{ $message->content }}"
                                                                    data-date="{{ $message->created_at->format('M d, Y h:i A') }}">
                                                                View
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        {{ $messages->links() }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Message View Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-muted mb-3"><small id="messageDate"></small></p>
                <div id="messageContent" class="py-3"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Dynamic recipient dropdown
    $('#recipient_type').change(function() {
        const type = $(this).val();
        $('#recipient_id').empty().prop('disabled', true);
        
        if (type) {
            $('#recipient_id').append($('<option>', {
                value: '',
                text: 'Loading...'
            }));
            
            const url = type === 'doctor' 
                ? '{{ route("api.doctors.list") }}' 
                : '{{ route("api.patients.list") }}';
            
            $.get(url, function(data) {
                $('#recipient_id').empty();
                $('#recipient_id').append($('<option>', {
                    value: '',
                    text: 'Select ' + type
                }));
                
                $.each(data, function(key, value) {
                    $('#recipient_id').append($('<option>', {
                        value: key,
                        text: value
                    }));
                });
                
                $('#recipient_id').prop('disabled', false);
            });
        }
    });
    
    // View message modal
    $('.view-message').click(function() {
        $('#messageModalLabel').text($(this).data('subject'));
        $('#messageDate').text($(this).data('date'));
        $('#messageContent').text($(this).data('content'));
        $('#messageModal').modal('show');
    });
});
</script>
@endpush

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