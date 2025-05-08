@extends('patient.layout')

@section('title', 'Payments | Medical Clinic')

@section('content')

<!-- Main Content -->
<main class="main-content">
    <div class="page-header">
        <h1>Payments</h1>
        <button class="btn btn-primary">
            <i class="fas fa-credit-card"></i> Make a Payment
        </button>
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
        <div class="filters">
            <button class="filter-btn active">All</button>
            <button class="filter-btn">Unpaid</button>
            <button class="filter-btn">Paid</button>
            <button class="filter-btn">Insurance Pending</button>
        </div>
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
                        <th>Insurance</th>
                        <th>Your Cost</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>INV-2025-0342</td>
                        <td>Mar 15, 2025</td>
                        <td>General Checkup</td>
                        <td>Dr. Sarah Johnson</td>
                        <td>$150.00</td>
                        <td>$120.00</td>
                        <td>$30.00</td>
                        <td><span class="badge unpaid">Unpaid</span></td>
                        <td>
                            <div class="table-actions">
                                <button class="btn btn-sm btn-outline">Pay Now</button>
                                <button class="btn btn-sm btn-outline">View</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>INV-2025-0341</td>
                        <td>Mar 15, 2025</td>
                        <td>Blood Test</td>
                        <td>Clinical Laboratory</td>
                        <td>$200.00</td>
                        <td>$110.00</td>
                        <td>$90.00</td>
                        <td><span class="badge unpaid">Unpaid</span></td>
                        <td>
                            <div class="table-actions">
                                <button class="btn btn-sm btn-outline">Pay Now</button>
                                <button class="btn btn-sm btn-outline">View</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>INV-2025-0325</td>
                        <td>Feb 28, 2025</td>
                        <td>Blood Test</td>
                        <td>Clinical Laboratory</td>
                        <td>$200.00</td>
                        <td>$125.00</td>
                        <td>$75.00</td>
                        <td><span class="badge paid">Paid</span></td>
                        <td>
                            <div class="table-actions">
                                <button class="btn btn-sm btn-outline">Receipt</button>
                                <button class="btn btn-sm btn-outline">View</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>INV-2024-0987</td>
                        <td>Dec 12, 2024</td>
                        <td>X-Ray</td>
                        <td>Radiology Department</td>
                        <td>$350.00</td>
                        <td>$280.00</td>
                        <td>$70.00</td>
                        <td><span class="badge paid">Paid</span></td>
                        <td>
                            <div class="table-actions">
                                <button class="btn btn-sm btn-outline">Receipt</button>
                                <button class="btn btn-sm btn-outline">View</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>INV-2024-0954</td>
                        <td>Nov 05, 2024</td>
                        <td>Annual Physical</td>
                        <td>Dr. Sarah Johnson</td>
                        <td>$250.00</td>
                        <td>$250.00</td>
                        <td>$0.00</td>
                        <td><span class="badge insurance">Insurance Covered</span></td>
                        <td>
                            <div class="table-actions">
                                <button class="btn btn-sm btn-outline">View</button>
                            </div>
                        </td>
                    </tr>
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