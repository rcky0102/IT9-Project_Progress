@extends('patient.layout')

@section('title', 'Patient Dashboard | Medical Clinic')

@section('content')

<!-- Main Content -->
            <main class="main-content">
                <div class="page-header">
                    <h1>
                        <a href="messages.html" class="btn btn-outline" style="margin-right: 15px;">
                            <i class="fas fa-arrow-left"></i> Back to Messages
                        </a>
                        Compose New Message
                    </h1>
                </div>

                <!-- Compose Message Form -->
                <div class="compose-form">
                    <form id="messageForm" method="POST" action="{{ route('patient.messages-store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="appointment_id" class="form-label">Select Doctor</label>
                            <select name="appointment_id" id="appointment_id" class="form-control" required>
                                <option value="">-- Select a Doctor --</option>
                                @foreach ($uniqueAppointments as $appointment)
                                    @php
                                        $doctorUser = $appointment->doctor->user;
                                        $doctorName = "Dr. {$doctorUser->first_name} {$doctorUser->middle_name} {$doctorUser->last_name}";
                                        $specialty = $appointment->doctor->specialization->specialization_name ?? 'General';
                                    @endphp
                                    <option value="{{ $appointment->id }}">
                                        {{ $doctorName }} ({{ $specialty }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" id="subject" name="subject" class="form-control" placeholder="Enter message subject" required>
                        </div>

                        <div class="form-group">
                            <label for="content" class="form-label">Message</label>
                            <textarea id="content" name="content" class="form-control" rows="8" placeholder="Type your message here..." required></textarea>
                        </div>

                        {{-- <div class="form-group">
                            <label class="form-label">Attachments</label>
                            <div class="file-upload">
                                <label class="file-upload-label">
                                    <i class="fas fa-paperclip"></i> Attach File
                                    <input type="file" class="file-upload-input" id="attachment" name="attachment">
                                </label>
                                <span class="file-name" id="fileName">No file selected</span>
                            </div>
                        </div> --}}

                        <div class="form-actions">
                            <a class="btn btn-outline" href="{{ route('patient.messages') }}">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> Send Message
                            </button>
                        </div>
                    </form>


                </div>
            </main>
        </div>
    </div>

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

            // File upload display
            const fileInput = document.getElementById('attachment');
            const fileNameDisplay = document.getElementById('fileName');
            
            fileInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    fileNameDisplay.textContent = this.files[0].name;
                } else {
                    fileNameDisplay.textContent = 'No file selected';
                }
            });

        //     // Form submission
        //     const messageForm = document.getElementById('messageForm');
        //     messageForm.addEventListener('submit', function(e) {
        //         e.preventDefault();
                
        //         // Validate form
        //         const doctor = document.querySelector('input[name="doctor"]:checked');
        //         const subject = document.getElementById('subject').value;
        //         const message = document.getElementById('message').value;
                
        //         if (!doctor) {
        //             alert('Please select a doctor');
        //             return;
        //         }
                
        //         if (!subject) {
        //             alert('Please enter a subject');
        //             return;
        //         }
                
        //         if (!message) {
        //             alert('Please enter a message');
        //             return;
        //         }
                
        //         // In a real application, you would send the form data to the server here
        //         alert('Message sent successfully!');
        //         window.location.href = 'messages.html';
        //     });
        // });

        // // Function to select a doctor
        // function selectDoctor(element, doctorId) {
        //     // Remove selected class from all options
        //     document.querySelectorAll('.doctor-option').forEach(option => {
        //         option.classList.remove('selected');
        //     });
            
        //     // Add selected class to clicked option
        //     element.classList.add('selected');
            
        //     // Check the radio button
        //     document.querySelector(`input[value="${doctorId}"]`).checked = true;
        // }
    </script>

@endsection