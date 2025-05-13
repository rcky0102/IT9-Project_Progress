@extends('patient.layout')

@section('title', 'Invoice Details | Medical Clinic')

@section('content')

<main class="main-content">
    <div class="page-header no-print">
        <h1>Invoice Details</h1>
        <div class="header-actions">
            <a href="payments.html" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Back to Payments
            </a>
            <a href="{{ route('patient.payments-paynow', ['invoiceId' => $invoice->id]) }}" class="btn btn-primary">
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
                        <div class="info-value">{{ $invoice->invoice_number ?? 'N/A' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Date Issued:</div>
                        <div class="info-value">{{ $invoice->created_at ? $invoice->created_at->format('M d, Y') : 'N/A' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Due Date:</div>
                        <div class="info-value">{{ $invoice->due_date ? \Carbon\Carbon::parse($invoice->due_date)->format('M d, Y') : 'N/A' }}</div>
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
                            @if ($invoice->billable && $invoice->billable->patient)
                                {{ $invoice->billable->patient->user->first_name ?? 'N/A' }}
                            @else
                                N/A
                            @endif
                        </div>
                    </div>
                </div>
                <div class="provider-info">
                    <div class="info-title">Provider Information</div>
                    <div class="info-row">
                        <div class="info-label">Provider:</div>
                        <div class="info-value">
                            @if ($invoice->billable && $invoice->billable->doctor)
                                {{ $invoice->billable->doctor->full_name ?? 'N/A' }}
                            @else
                                N/A
                            @endif
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
                    <tr>
                        <td>{{ $invoice->billable && $invoice->billable->appointmentType ? $invoice->billable->appointmentType->name : 'N/A' }}</td>
                        <td>{{ $invoice->billable && $invoice->billable->appointment_date ? \Carbon\Carbon::parse($invoice->billable->appointment_date)->format('M d, Y') : 'N/A' }}</td>
                        <td class="text-right">₱{{ number_format($invoice->total_amount ?? 0, 2) }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Invoice Summary -->
            <div class="invoice-summary">
                <div class="summary-table">
                    <div class="summary-row">
                        <div>Subtotal:</div>
                        <div>₱{{ number_format($invoice->total_amount ?? 0, 2) }}</div>
                    </div>
                    <div class="summary-row total">
                        <div>Balance Due:</div>
                        <div>
                            ₱{{ number_format(($invoice->total_amount ?? 0) - ($invoice->payments->sum('amount_paid') ?? 0), 2) }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment History -->
            <h4 class="info-title">Payments</h4>
            <table class="services-table">
                <thead>
                    <tr>
                        <th>Appointment ID</th>
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
                            <td>{{ $payment->invoice && $payment->invoice->appointment ? $payment->invoice->appointment->id : 'N/A' }}</td> <!-- Appointment ID -->
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
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons no-print">
            {{-- <button class="btn btn-outline" onclick="window.print()">
                <i class="fas fa-print"></i> Print Invoice
            </button> --}}
            <a href="{{ route('payments.download', $payment->id) }}" class="btn btn-outline">
                <i class="fas fa-file-pdf"></i> Download Receipt
            </a>
            {{-- <a href="{{ route('patient.payments-paynow', ['invoiceId' => $invoice->id]) }}" class="btn btn-primary">
                <i class="fas fa-credit-card"></i> Pay Now
            </a> --}}
        </div>
    </div>
</main>




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