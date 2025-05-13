@extends('patient.layout')

@section('title', 'Payments | Medical Clinic')

@section('content')

<!-- Main Content -->
<main class="main-content">
    <div class="page-header">
        <h1>Payments</h1>
        {{-- <a href="{{ route('patient.payments-create') }}" class="btn btn-primary">
            <i class="fas fa-credit-card"></i> Make a Payment
        </a> --}}
    </div>

    <!-- Payment Summary -->
    <div class="payment-summary">
        <div class="summary-card">
            <div class="summary-icon">
                <i class="fas fa-file-invoice-dollar"></i>
            </div>
            <div class="summary-details">
                <h4>Outstanding Balance</h4>
                <div class="summary-value">$120.00</div>
            </div>
        </div>
        <div class="summary-card">
            <div class="summary-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="summary-details">
                <h4>Next Payment Due</h4>
                <div class="summary-value">Apr 15, 2025</div>
            </div>
        </div>
        <div class="summary-card">
            <div class="summary-icon">
                <i class="fas fa-history"></i>
            </div>
            <div class="summary-details">
                <h4>Last Payment</h4>
                <div class="summary-value">$75.00 on Mar 10, 2025</div>
            </div>
        </div>
    </div>

    <!-- Payment Filters -->
    <div class="filters-container">
        {{-- <div class="filters">
            <button class="filter-btn active">All</button>
            <button class="filter-btn">Unpaid</button>
            <button class="filter-btn">Paid</button>
            <button class="filter-btn">Insurance Pending</button>
        </div> --}}
        <div class="search-container">
            <input type="text" class="search-input" placeholder="Search invoices...">
            <button class="search-btn"><i class="fas fa-search"></i></button>
        </div>
    </div>

    <!-- Invoices Table -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Recent Invoices</h3>
    </div>
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Invoice #</th>
                    <th>Date</th>
                    <th>Service</th>
                    <th>Provider</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->invoice_number }}</td>
                    <td>{{ $invoice->created_at->format('M d, Y') }}</td>
                    
                   <td>
                        @if ($invoice->billable instanceof \App\Models\Appointment)
                            {{ $invoice->billable->appointmentType->name ?? 'N/A' }}
                        @elseif ($invoice->billable instanceof \App\Models\MedicalRecord)
                            Medical Record
                        @endif
                    </td>

                    <td>
                        @if ($invoice->billable instanceof \App\Models\Appointment)
                            {{ $invoice->billable->doctor->full_name ?? 'N/A' }}
                        @elseif ($invoice->billable instanceof \App\Models\MedicalRecord)
                            {{ $invoice->billable->appointment->doctor->full_name ?? 'N/A' }}
                        @endif
                    </td>


                    {{-- Total --}}
                    <td>₱{{ number_format($invoice->total_amount, 2) }}</td>

                    {{-- Status --}}
                    <td>
                        <span class="badge {{ $invoice->status === 'paid' ? 'paid' : 'unpaid' }}">
                            {{ ucfirst($invoice->status) }}
                        </span>
                    </td>

                    {{-- Actions --}}
                    <td>
                        <div class="table-actions">
                            {{-- @if ($invoice->status === 'unpaid')
                                <a href="{{ route('patient.payments-invoice-details', ['invoiceId' => $invoice->id]) }}" class="btn btn-sm btn-outline">Pay Now</a>
                            @endif --}}
                            <a href="{{ route('patient.payments-invoice-details', ['invoiceId' => $invoice->id]) }}" class="btn btn-sm btn-outline">View</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



    <!-- Payment Methods -->
    <div class="payment-methods">
        <h3>Payment Methods</h3>
        <div class="methods-container">
            @foreach ($paymentMethods as $method)
                <div class="payment-method-card">
                    <div class="payment-method-icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <div class="payment-method-details">
                        <h4>
                            {{-- {{ $method->cardholder_name }}  --}}
                            Card/Debit ending in {{ substr($method->card_number, -4) }}
                        </h4>
                        <p>Expires {{ $method->expiration_month }}/{{ substr($method->expiration_year, -2) }}</p>
                        @if ($loop->first) 
                            <div class="payment-method-default">Default</div>
                        @endif
                    </div>
                    <div class="payment-method-actions">
                        <a href="#" class="btn btn-sm btn-outline">Edit</a>
                        <form action="#" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline text-danger" onclick="return confirm('Are you sure?')">Remove</button>
                        </form>
                    </div>
                </div>
            @endforeach


            {{-- <div class="payment-method-card">
                <div class="payment-method-icon">
                    <i class="fas fa-university"></i>
                </div>
                <div class="payment-method-details">
                    <h4>Bank Account</h4>
                    <p>Checking **** 7890</p>
                </div>
                <div class="payment-method-actions">
                    <button class="btn btn-sm btn-outline">Edit</button>
                    <button class="btn btn-sm btn-outline text-danger">Remove</button>
                </div>
            </div> --}}

            <div class="add-payment-method">
                <a href="{{ route('patient.payment-methods') }}" class="btn btn-outline">
                    <i class="fas fa-plus"></i> Add Payment Method
                </a>
            </div>
        </div>
    </div>

    {{-- <!-- Insurance Information -->
    <div class="insurance-info">
        <h3>Insurance Information</h3>
        <div class="insurance-card">
            <div class="insurance-header">
                <h4>Primary Insurance</h4>
                <button class="btn btn-sm btn-outline">Edit</button>
            </div>
            <div class="insurance-details">
                <div class="info-row">
                    <div class="info-label">Provider:</div>
                    <div class="info-value">Blue Cross Blue Shield</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Plan:</div>
                    <div class="info-value">PPO Family Plan</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Member ID:</div>
                    <div class="info-value">BCBS12345678</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Group Number:</div>
                    <div class="info-value">GRP987654</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Effective Date:</div>
                    <div class="info-value">Jan 01, 2025</div>
                </div>
            </div>
        </div>
    </div> --}}
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

// Filter buttons
const filterBtns = document.querySelectorAll('.filter-btn');
filterBtns.forEach(btn => {
    btn.addEventListener('click', function() {
        filterBtns.forEach(b => b.classList.remove('active'));
        this.classList.add('active');
    });
});
});
</script>

@endsection