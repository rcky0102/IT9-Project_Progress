@extends('admin.layout')

@section('title', 'Billings | Medical Clinic')

@section('content')

<!-- Main Content -->
            <main class="main-content">
                <div class="page-header-with-actions">
                    <div>
                        <h1>Billing & Payments</h1>
                        <p class="text-muted">Manage invoices and payments</p>
                    </div>
                    <div class="header-buttons">
                        <button class="btn btn-outline">
                            <i class="fas fa-file-invoice"></i> Generate Invoices
                        </button>
                        <button class="btn btn-primary" id="create-invoice-btn">
                            <i class="fas fa-plus"></i> Create Invoice
                        </button>
                    </div>
                </div>

                <!-- Billing Summary Cards -->
                <div class="dashboard-cards">
                    <div class="stats-card">
                        <div class="stats-header">
                            <div class="stats-title">Total Revenue</div>
                            <div class="stats-icon revenue">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                        </div>
                        <div class="stats-value">$45,289</div>
                        <div class="stats-change positive">
                            <i class="fas fa-arrow-up"></i> 15% from last month
                        </div>
                    </div>

                    <div class="stats-card">
                        <div class="stats-header">
                            <div class="stats-title">Pending Payments</div>
                            <div class="stats-icon" style="background-color: var(--warning);">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                        <div class="stats-value">$12,450</div>
                        <div class="stats-change negative">
                            <i class="fas fa-arrow-up"></i> 8% from last month
                        </div>
                    </div>

                    <div class="stats-card">
                        <div class="stats-header">
                            <div class="stats-title">Overdue Payments</div>
                            <div class="stats-icon" style="background-color: var(--danger);">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                        </div>
                        <div class="stats-value">$3,780</div>
                        <div class="stats-change negative">
                            <i class="fas fa-arrow-down"></i> 5% from last month
                        </div>
                    </div>

                    <div class="stats-card">
                        <div class="stats-header">
                            <div class="stats-title">Insurance Claims</div>
                            <div class="stats-icon" style="background-color: var(--info);">
                                <i class="fas fa-file-medical"></i>
                            </div>
                        </div>
                        <div class="stats-value">128</div>
                        <div class="stats-change positive">
                            <i class="fas fa-arrow-up"></i> 12 more than last month
                        </div>
                    </div>
                </div>

                <div class="tabs">
                    <div class="tab active">All Invoices</div>
                    <div class="tab">Paid</div>
                    <div class="tab">Pending</div>
                    <div class="tab">Overdue</div>
                    <div class="tab">Insurance Claims</div>
                </div>

                <div class="filters-container">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search invoices...">
                    </div>
                    <select class="filter-select">
                        <option value="all">All Patients</option>
                        <option value="john-doe">John Doe</option>
                        <option value="jane-smith">Jane Smith</option>
                        <option value="robert-brown">Robert Brown</option>
                        <option value="emma-wilson">Emma Wilson</option>
                    </select>
                    <select class="filter-select">
                        <option value="all">All Status</option>
                        <option value="paid">Paid</option>
                        <option value="pending">Pending</option>
                        <option value="overdue">Overdue</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    <div class="date-range">
                        <input type="date" class="filter-date" value="2025-04-01">
                        <span>to</span>
                        <input type="date" class="filter-date" value="2025-05-01">
                    </div>
                    <button class="btn btn-outline">
                        <i class="fas fa-filter"></i> Apply Filters
                    </button>
                </div>

                <div class="table-container">
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
                                                <a href="{{ route('admin.billing.show', ['invoiceId' => $invoice->id]) }}" class="btn btn-sm btn-outline">View</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="pagination-container">
                    <div class="pagination-info">
                        Showing 1 to 5 of 25 entries
                    </div>
                    <div class="pagination">
                        <button class="pagination-btn" disabled>
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="pagination-btn active">1</button>
                        <button class="pagination-btn">2</button>
                        <button class="pagination-btn">3</button>
                        <button class="pagination-btn">4</button>
                        <button class="pagination-btn">5</button>
                        <button class="pagination-btn">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>

                <!-- Create Invoice Modal -->
                <div class="modal" id="create-invoice-modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>Create New Invoice</h3>
                            <button class="close-modal"><i class="fas fa-times"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="invoice-patient">Patient</label>
                                <select id="invoice-patient" class="form-control">
                                    <option value="">Select patient</option>
                                    <option value="1">John Doe</option>
                                    <option value="2">Jane Smith</option>
                                    <option value="3">Robert Brown</option>
                                    <option value="4">Emma Wilson</option>
                                    <option value="5">Michael Clark</option>
                                </select>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="invoice-date">Invoice Date</label>
                                    <input type="date" id="invoice-date" class="form-control" value="2025-05-01">
                                </div>
                                <div class="form-group">
                                    <label for="invoice-due-date">Due Date</label>
                                    <input type="date" id="invoice-due-date" class="form-control" value="2025-05-15">
                                </div>
                            </div>
                            
                            <div class="invoice-items-section">
                                <h4>Invoice Items</h4>
                                <div class="invoice-items">
                                    <div class="invoice-item">
                                        <div class="form-row">
                                            <div class="form-group">
                                                <label for="item-service-1">Service</label>
                                                <select id="item-service-1" class="form-control">
                                                    <option value="">Select service</option>
                                                    <option value="consultation">General Consultation</option>
                                                    <option value="cardiology">Cardiology Consultation</option>
                                                    <option value="blood-test">Blood Test - Complete Panel</option>
                                                    <option value="xray">X-Ray - Chest</option>
                                                    <option value="therapy">Physical Therapy Session</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="item-quantity-1">Quantity</label>
                                                <input type="number" id="item-quantity-1" class="form-control" value="1" min="1">
                                            </div>
                                            <div class="form-group">
                                                <label for="item-price-1">Price ($)</label>
                                                <input type="number" id="item-price-1" class="form-control" placeholder="0.00">
                                            </div>
                                            <div class="form-group">
                                                <label for="item-total-1">Total ($)</label>
                                                <input type="number" id="item-total-1" class="form-control" placeholder="0.00" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <button class="btn btn-outline btn-sm remove-item">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-outline btn-sm add-item-btn">
                                    <i class="fas fa-plus"></i> Add Item
                                </button>
                            </div>
                            
                            <div class="invoice-summary">
                                <div class="summary-row">
                                    <div class="summary-label">Subtotal:</div>
                                    <div class="summary-value">$0.00</div>
                                </div>
                                <div class="summary-row">
                                    <div class="summary-label">Tax (8%):</div>
                                    <div class="summary-value">$0.00</div>
                                </div>
                                <div class="summary-row total">
                                    <div class="summary-label">Total:</div>
                                    <div class="summary-value">$0.00</div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="invoice-notes">Notes</label>
                                <textarea id="invoice-notes" class="form-control" rows="3" placeholder="Enter invoice notes"></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label>Payment Method</label>
                                <div class="radio-container">
                                    <label class="radio-label">
                                        <input type="radio" name="payment-method" value="cash" checked> Cash
                                    </label>
                                    <label class="radio-label">
                                        <input type="radio" name="payment-method" value="credit-card"> Credit Card
                                    </label>
                                    <label class="radio-label">
                                        <input type="radio" name="payment-method" value="insurance"> Insurance
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-outline" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary">Create Invoice</button>
                        </div>
                    </div>
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

            // Tab functionality
            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Select all checkbox
            const selectAll = document.getElementById('select-all');
            const rowCheckboxes = document.querySelectorAll('.row-checkbox');
            
            selectAll.addEventListener('change', function() {
                rowCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
            });

            // Modal functionality
            const createInvoiceBtn = document.getElementById('create-invoice-btn');
            const createInvoiceModal = document.getElementById('create-invoice-modal');
            const closeModal = document.querySelector('.close-modal');
            const cancelBtn = document.querySelector('[data-dismiss="modal"]');
            
            createInvoiceBtn.addEventListener('click', function() {
                createInvoiceModal.style.display = 'flex';
            });
            
            closeModal.addEventListener('click', function() {
                createInvoiceModal.style.display = 'none';
            });
            
            cancelBtn.addEventListener('click', function() {
                createInvoiceModal.style.display = 'none';
            });
            
            window.addEventListener('click', function(e) {
                if (e.target === createInvoiceModal) {
                    createInvoiceModal.style.display = 'none';
                }
            });

            // Add invoice item
            const addItemBtn = document.querySelector('.add-item-btn');
            const invoiceItems = document.querySelector('.invoice-items');
            
            addItemBtn.addEventListener('click', function() {
                const itemCount = document.querySelectorAll('.invoice-item').length + 1;
                const newItem = document.createElement('div');
                newItem.className = 'invoice-item';
                newItem.innerHTML = `
                    <div class="form-row">
                        <div class="form-group">
                            <label for="item-service-${itemCount}">Service</label>
                            <select id="item-service-${itemCount}" class="form-control">
                                <option value="">Select service</option>
                                <option value="consultation">General Consultation</option>
                                <option value="cardiology">Cardiology Consultation</option>
                                <option value="blood-test">Blood Test - Complete Panel</option>
                                <option value="xray">X-Ray - Chest</option>
                                <option value="therapy">Physical Therapy Session</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="item-quantity-${itemCount}">Quantity</label>
                            <input type="number" id="item-quantity-${itemCount}" class="form-control" value="1" min="1">
                        </div>
                        <div class="form-group">
                            <label for="item-price-${itemCount}">Price ($)</label>
                            <input type="number" id="item-price-${itemCount}" class="form-control" placeholder="0.00">
                        </div>
                        <div class="form-group">
                            <label for="item-total-${itemCount}">Total ($)</label>
                            <input type="number" id="item-total-${itemCount}" class="form-control" placeholder="0.00" readonly>
                        </div>
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button class="btn btn-outline btn-sm remove-item">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
                invoiceItems.appendChild(newItem);
                
                // Add event listener to remove button
                const removeBtn = newItem.querySelector('.remove-item');
                removeBtn.addEventListener('click', function() {
                    invoiceItems.removeChild(newItem);
                });
            });
        });
    </script>

@endsection