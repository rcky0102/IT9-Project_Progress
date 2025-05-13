@extends('admin.layout')

@section('title', 'Billing Details | Medical Clinic')

@section('content')

<main class="main-content">
    <div class="page-header no-print">
        <h1>Invoice Details</h1>
        <div class="header-actions">
            <a onclick="history.back()" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Back 
            </a>
            <a href="{{ route('admin.billing.create', ['invoiceId' => $invoice->id]) }}" class="btn btn-primary">
                <i class="fas fa-credit-card"></i> Pay Now
            </a>
        </div>
    </div>

    <div class="card">
    <div class="card-header">
        <h3 class="card-title">Invoice #{{ $invoice->invoice_number }}</h3>
        <span class="invoice-status status-{{ strtolower($invoice->status) }}">
            {{ ucfirst($invoice->status) }}
        </span>
    </div>
    <div class="card-body">

        <!-- Invoice Header -->
        <div class="invoice-header">
            <div class="invoice-info">
                <h2>Invoice</h2>
                <div class="info-row">
                    <div class="info-label">Invoice Number:</div>
                    <div class="info-value">{{ $invoice->invoice_number }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Date Issued:</div>
                    <div class="info-value">{{ $invoice->created_at->format('M d, Y') }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Due Date:</div>
                    <div class="info-value">{{ optional($invoice->due_date)->format('M d, Y') }}</div>
                </div>
            </div>
        </div>

        <!-- Patient and Provider Info -->
        <div class="patient-provider">
            <div class="patient-info">
                <div class="info-title">Patient Information</div>
                <div class="info-row">
                    <div class="info-label">Name:</div>
                    <div class="info-value">
                        @php
                            $patient = null;
                            if ($invoice->billable_type === \App\Models\Appointment::class) {
                                $patient = $invoice->billable->patient ?? null;
                            } elseif ($invoice->billable_type === \App\Models\MedicalRecord::class) {
                                $patient = $invoice->billable->appointment->patient ?? null;
                            }
                        @endphp
                        {{ $patient?->full_name ?? 'N/A' }}
                    </div>
                </div>
            </div>
            <div class="provider-info">
                <div class="info-title">Provider Information</div>
                <div class="info-row">
                    <div class="info-label">Provider:</div>
                    <div class="info-value">
                        @php
                            $doctor = null;
                            if ($invoice->billable_type === \App\Models\Appointment::class) {
                                $doctor = $invoice->billable->doctor ?? null;
                            } elseif ($invoice->billable_type === \App\Models\MedicalRecord::class) {
                                $doctor = $invoice->billable->appointment->doctor ?? null;
                            }
                        @endphp
                        {{ $doctor?->full_name ?? 'N/A' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Services and Charges -->
        <h4 class="info-title">Services and Charges</h4>
        <table class="services-table">
            <thead>
                <tr>
                    <th>Services</th>
                    <th>Date</th>
                    <th class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $appointmentType = null;
                    $appointmentDate = null;

                    if ($invoice->billable_type === \App\Models\Appointment::class) {
                        $appointmentType = $invoice->billable->appointmentType->name ?? 'N/A';
                        $appointmentDate = $invoice->billable->appointment_date ?? null;
                    } elseif ($invoice->billable_type === \App\Models\MedicalRecord::class) {
                        $appointmentType = $invoice->billable->appointment->appointmentType->name ?? 'N/A';
                        $appointmentDate = $invoice->billable->appointment->appointment_date ?? null;
                    }
                @endphp
                <tr>
                    <td>{{ $appointmentType }}</td>
                    <td>{{ $appointmentDate ? \Carbon\Carbon::parse($appointmentDate)->format('M d, Y') : 'N/A' }}</td>
                    <td class="text-right">₱{{ number_format($invoice->total_amount, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Invoice Summary -->
        <div class="invoice-summary">
            <div class="summary-table">
                <div class="summary-row">
                    <div>Subtotal:</div>
                    <div>₱{{ number_format($invoice->total_amount, 2) }}</div>
                </div>
                <div class="summary-row total">
                    <div>Balance Due:</div>
                    <div>
                        ₱{{ number_format($invoice->total_amount - $invoice->payments->sum('amount_paid'), 2) }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment History -->
            <h4 class="info-title">Payments</h4>
            <table class="services-table">
                <thead>
                    <tr>
                        <th>Invoice #</th>
                        <th>Payment Method</th>
                        <th class="text-right">Amount Paid</th>
                        <th>Status</th>
                        <th>Date Paid</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($payments as $payment)
                        <tr>
                            {{-- <td>{{ $payment->invoice && $payment->invoice->appointment ? $payment->invoice->appointment->id : 'N/A' }}</td> <!-- Appointment ID --> --}}
                            <td>{{ $payment->invoice ? $payment->invoice->invoice_number : 'N/A' }}</td>
                            <td>{{ $payment->paymentMethod ? $payment->paymentMethod->cardholder_name : 'N/A' }}</td>
                            <td class="text-right">₱{{ number_format($payment->amount_paid ?? 0, 2) }}</td>
                            <td>
                                <span class="badge 
                                    {{ $payment->status === 'paid' ? 'bg-success' : 'bg-warning text-dark' }}">
                                    {{ ucfirst($payment->status) }}
                                </span>
                            </td>
                            <td>{{ $payment->paid_at ? \Carbon\Carbon::parse($payment->paid_at)->format('M d, Y h:i A') : 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No payments found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Action Buttons -->
            <div class="action-buttons no-print">
                <a href="{{ route('payments.downloadPDF', $payment->id) }}" class="btn btn-sm btn-primary">
                    Download Receipt
                </a>

                {{-- <button class="btn btn-outline" onclick="window.print()">
                    <i class="fas fa-print"></i> Print Invoice
                </button> --}}
            </div>
</div>

</main>


    </div>

    <script>
        // Function to simulate downloading PDF
        function downloadPDF() {
            // In a real implementation, this would generate and download a PDF
            // For this demo, we'll just show an alert
            alert('Invoice PDF is being generated and will download shortly.');
            
            // Simulate a download after a short delay
            setTimeout(function() {
                const link = document.createElement('a');
                link.href = '#'; // In a real implementation, this would be the PDF URL
                link.download = 'Invoice-INV-2025-001.pdf';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }, 1000);
        }
        
        // Function to handle payment button click
        document.addEventListener('DOMContentLoaded', function() {
            const payNowButtons = document.querySelectorAll('a[href="payment-invoice.html"]');
            
            payNowButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    // You could add additional logic here if needed
                    // For example, passing the invoice ID to the payment page via URL parameter
                    
                    // For this demo, we'll just navigate to the payment page
                    window.location.href = 'payment-invoice.html';
                });
            });
        });
    </script>

@endsection