@extends('patient.layout')

@section('title', 'Pay Now | Medical Clinic')

@section('content')

<main class="main-content">
    <div class="page-header">
        <h1>Make a Payment</h1>
        <a href="payments.html" class="btn btn-outline">
            <i class="fas fa-arrow-left"></i> Back to Payments
        </a>
    </div>

    <!-- Payment Form -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Payment Details</h3>
        </div>
        <form id="payment-form">
            <div class="form-section">
                <!-- Outstanding Balance Summary -->
                <div class="balance-summary">
                    <h4>Outstanding Balance</h4>
                    <div class="balance-row">
                        <span>Total Outstanding:</span>
                        <span class="balance-value">${{ number_format($outstandingBalance, 2) }}</span>
                    </div>
                    <div class="balance-row">
                        <span>Due Date:</span>
                        <span>{{ \Carbon\Carbon::parse($invoice->due_date)->format('M d, Y') }}</span>
                    </div>
                    
                    <div class="balance-row">
                        <span>Invoice #:</span>
                        <span>{{ $invoice->invoice_number }}</span>
                    </div>
                    <div class="balance-row">
                        <span>Service:</span>
                        <span>{{ $invoice->appointment->appointmentType->name }}</span>
                    </div>
                </div>
        
                <!-- Payment Amount -->
                <div class="form-group">
                    <label for="payment-amount" class="form-label">Payment Amount</label>
                    <div class="amount-input-container">
                        <div class="amount-input-wrapper">
                            <span>$</span>
                            <input type="text" id="payment-amount" value="{{ $outstandingBalance }}" class="amount-input">
                        </div>
                        <div class="amount-buttons">
                            <button type="button" class="btn btn-sm btn-outline" id="min-payment-btn">Pay Minimum ({{ number_format($outstandingBalance * 0.25, 2) }})</button>
                            <button type="button" class="btn btn-sm btn-outline" id="full-payment-btn">Pay Full ({{ number_format($outstandingBalance, 2) }})</button>
                        </div>
                    </div>
                </div>
        
                <!-- Payment Method Selection -->
                <div class="form-group">
                    <label class="form-label">Select Payment Method</label>
                    
                    <div class="payment-methods-grid">
                        @foreach ($paymentMethods as $paymentMethod)
    <div class="payment-method-card">
        <input type="radio" name="payment_method_id" id="payment-method-{{ $paymentMethod->id }}" value="{{ $paymentMethod->id }}" class="payment-method-radio">
        <label for="payment-method-{{ $paymentMethod->id }}">
            <div class="payment-method-content">
                <div class="payment-method-icon">
                    <i class="fas fa-credit-card"></i>
                </div>
                <div class="payment-method-details">
                    <h4>
                        Card/Debit ending in {{ substr($paymentMethod->card_number, -4) }}
                    </h4>
                    <p>Expires {{ $paymentMethod->expiration_month }}/{{ substr($paymentMethod->expiration_year, -2) }}</p>
                    @if ($loop->first)
                        <div class="payment-method-default">Default</div>
                    @endif
                </div>
            </div>
        </label>
    </div>
@endforeach


                        <div class="payment-method-card" id="cash-method">
                            <input type="radio" name="payment_method_id" id="cash-payment" value="cash" class="payment-method-radio">
                            <label for="cash-payment">
                                <div class="payment-method-content">
                                    <div class="payment-method-icon">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                    <div class="payment-method-details">
                                        <h4>Cash</h4>
                                        <p>Pay in person</p>
                                    </div>
                                </div>
                            </label>
                        </div>

                    </div>
                </div>

                <!-- Cash Payment Details (shown when cash is selected) -->
                <div id="cash-payment-details" class="cash-payment-details" style="display: none;">
                    <h4>Cash Payment Information</h4>

                    <div class="info-box">
                        <i class="fas fa-info-circle"></i>
                        <div>
                            <p>Please bring this amount in cash to any of our clinic locations during business hours. A receipt will be provided upon payment.</p>
                            <p style="font-weight: bold;">This will not complete your payment now. This option is to indicate your intention to pay with cash.</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="preferred-location" class="form-label">Preferred Payment Location</label>
                        <select id="preferred-location" class="input-full">
                            <option value="">Select a location</option>
                            <option value="main">Main Clinic - 123 Medical Dr.</option>
                            <option value="north">North Branch - 456 Health Ave.</option>
                            <option value="east">East Branch - 789 Wellness Blvd.</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="payment-date" class="form-label">Planned Payment Date</label>
                        <input type="date" id="payment-date" class="input-full">
                    </div>
                </div>
        
                <!-- Terms and Conditions -->
                <div class="form-group">
                    <div class="checkbox-container">
                        <input type="checkbox" id="terms">
                        <label for="terms" style="font-size: 14px;">I authorize Medical Clinic to charge my selected payment method for the amount specified above. I have read and agree to the <a href="#" style="color: var(--primary);">Terms and Conditions</a>.</label>
                    </div>
                </div>
        
                <!-- Payment Summary -->
                <div class="payment-summary">
                    <h4>Payment Summary</h4>
                    <div class="summary-row">
                        <span>Payment Amount:</span>
                        <span id="summary-amount">${{ number_format($outstandingBalance, 2) }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Processing Fee:</span>
                        <span>$0.00</span>
                    </div>
                    <div class="summary-total">
                        <span>Total:</span>
                        <span id="summary-total">${{ number_format($outstandingBalance, 2) }}</span>
                    </div>
                </div>
        
                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="#" class="btn btn-outline">Cancel</a>
                    <button type="submit" class="btn btn-primary" id="submit-button">
                        <i class="fas fa-credit-card"></i> <span id="button-text">Complete Payment</span>
                    </button>
                </div>
            </div>
        </form>
        
        
    </div>
</main>
</div>

<script>

        // When a payment method is selected, check if it is 'cash'
        document.querySelectorAll('input[name="payment_method_id"]').forEach(function (input) {
        input.addEventListener('change', function() {
            if (document.getElementById('cash-payment').checked) {
                // Show cash payment details if 'Cash' is selected
                document.getElementById('cash-payment-details').style.display = 'block';
            } else {
                // Hide cash payment details if 'Cash' is not selected
                document.getElementById('cash-payment-details').style.display = 'none';
            }
        });
    });

document.addEventListener('DOMContentLoaded', function() {
    // Payment method selection
    const paymentMethods = document.querySelectorAll('.payment-method-card');
    const paymentRadios = document.querySelectorAll('input[name="payment_method_id"]');
    const cashDetails = document.getElementById('cash-payment-details');
    const billingAddressSection = document.getElementById('billing-address-section');
    const submitButton = document.getElementById('submit-button');
    const buttonText = document.getElementById('button-text');
    const newPaymentMethodCheckbox = document.getElementById('new-payment-method');
    const newPaymentDetails = document.getElementById('new-payment-details');
    
    // Payment amount elements
    const paymentAmountInput = document.getElementById('payment-amount');
    const summaryAmount = document.getElementById('summary-amount');
    const summaryTotal = document.getElementById('summary-total');
    const minPaymentBtn = document.getElementById('min-payment-btn');
    const fullPaymentBtn = document.getElementById('full-payment-btn');
    
    // Update payment method display
    function updatePaymentMethodDisplay() {
        // Reset all payment method cards
        paymentMethods.forEach(method => {
            method.classList.remove('active');
        });
        
        // Find the checked radio and activate its card
        paymentRadios.forEach(radio => {
            if (radio.checked) {
                const card = radio.closest('.payment-method-card');
                card.classList.add('active');
                
                // Handle cash payment special case
                if (radio.value === 'cash') {
                    cashDetails.style.display = 'block';
                    billingAddressSection.style.display = 'none';
                    buttonText.textContent = 'Schedule Cash Payment';
                    submitButton.querySelector('i').className = 'fas fa-money-bill-wave';
                    
                    // Disable new payment method for cash
                    newPaymentMethodCheckbox.checked = false;
                    newPaymentMethodCheckbox.disabled = true;
                    newPaymentDetails.style.display = 'none';
                } else {
                    cashDetails.style.display = 'none';
                    billingAddressSection.style.display = 'block';
                    buttonText.textContent = 'Complete Payment';
                    submitButton.querySelector('i').className = 'fas fa-credit-card';
                    
                    // Enable new payment method checkbox
                    newPaymentMethodCheckbox.disabled = false;
                }
            }
        });
    }
    
    // Add click event to payment method cards
    paymentMethods.forEach(method => {
        method.addEventListener('click', function() {
            const radio = this.querySelector('input[type="radio"]');
            radio.checked = true;
            updatePaymentMethodDisplay();
        });
    });
    
    // Add change event to payment method radios
    paymentRadios.forEach(radio => {
        radio.addEventListener('change', updatePaymentMethodDisplay);
    });
    
    // New payment method toggle
    newPaymentMethodCheckbox.addEventListener('change', function() {
        if (this.checked) {
            newPaymentDetails.style.display = 'block';
        } else {
            newPaymentDetails.style.display = 'none';
        }
    });
    
    // Payment amount update
    function updatePaymentAmount(amount) {
        paymentAmountInput.value = amount;
        summaryAmount.textContent = `$${amount}`;
        summaryTotal.textContent = `$${amount}`;
    }
    
    // Quick payment buttons
    minPaymentBtn.addEventListener('click', function() {
        updatePaymentAmount('30.00');
    });
    
    fullPaymentBtn.addEventListener('click', function() {
        updatePaymentAmount('120.00');
    });
    
    // Manual payment amount input
    paymentAmountInput.addEventListener('input', function() {
        let amount = this.value;
        // Remove non-numeric characters except decimal point
        amount = amount.replace(/[^\d.]/g, '');
        // Ensure only one decimal point
        const parts = amount.split('.');
        if (parts.length > 2) {
            amount = parts[0] + '.' + parts.slice(1).join('');
        }
        // Format to 2 decimal places
        if (parts.length === 2 && parts[1].length > 2) {
            amount = parts[0] + '.' + parts[1].substring(0, 2);
        }
        
        this.value = amount;
        summaryAmount.textContent = `$${amount}`;
        summaryTotal.textContent = `$${amount}`;
    });
    
    // Form submission
    const form = document.getElementById('payment-form');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Check if terms are accepted
        const termsCheckbox = document.getElementById('terms');
        if (!termsCheckbox.checked) {
            alert('Please accept the terms and conditions to proceed.');
            return;
        }
        
        // Basic validation
        let isValid = true;
        let errorMessage = '';
        
        // Get payment amount
        const paymentAmount = paymentAmountInput.value;
        if (!paymentAmount || isNaN(parseFloat(paymentAmount)) || parseFloat(paymentAmount) <= 0) {
            isValid = false;
            errorMessage += 'Please enter a valid payment amount.\n';
        }
        
        // Check which payment method is selected
        const selectedPaymentMethod = document.querySelector('input[name="payment_method_id"]:checked');
        
        if (selectedPaymentMethod.value === 'cash') {
            // Validate cash payment fields
            const preferredLocation = document.getElementById('preferred-location').value;
            const paymentDate = document.getElementById('payment-date').value;
            
            if (!preferredLocation) {
                isValid = false;
                errorMessage += 'Please select a preferred payment location.\n';
            }
            
            if (!paymentDate) {
                isValid = false;
                errorMessage += 'Please select a planned payment date.\n';
            }
            
            if (isValid) {
                alert('Your cash payment has been scheduled. Please bring $' + paymentAmount + ' to the selected clinic location.');
                window.location.href = 'payments.html';
            }
        } else if (newPaymentMethodCheckbox.checked) {
            // Validate new card details
            const cardName = document.getElementById('card-name').value;
            const cardNumber = document.getElementById('card-number').value;
            const cardExpiry = document.getElementById('card-expiry').value;
            const cardCvc = document.getElementById('card-cvc').value;
            
            if (!cardName) {
                isValid = false;
                errorMessage += 'Cardholder name is required.\n';
            }
            
            if (!cardNumber || cardNumber.replace(/\s/g, '').length < 13) {
                isValid = false;
                errorMessage += 'Please enter a valid card number.\n';
            }
            
            if (!cardExpiry || !/^\d{2}\/\d{2}$/.test(cardExpiry)) {
                isValid = false;
                errorMessage += 'Please enter a valid expiration date (MM/YY).\n';
            }
            
            if (!cardCvc || !/^\d{3,4}$/.test(cardCvc)) {
                isValid = false;
                errorMessage += 'Please enter a valid security code.\n';
            }
        }
        
        if (!isValid) {
            alert('Please correct the following errors:\n\n' + errorMessage);
            return;
        }
        
        // If all validation passes and it's not a cash payment
        if (selectedPaymentMethod.value !== 'cash' && isValid) {
            // Show processing state
            const originalButtonText = buttonText.textContent;
            const originalIcon = submitButton.querySelector('i').className;
            
            submitButton.disabled = true;
            buttonText.textContent = 'Processing...';
            submitButton.querySelector('i').className = 'fas fa-spinner fa-spin';
            
            // Simulate payment processing
            setTimeout(function() {
                alert('Payment of $' + paymentAmount + ' processed successfully!');
                window.location.href = 'payments.html';
            }, 1500);
        }
    });
    
    // Initialize the page
    updatePaymentMethodDisplay();
});
</script>

@endsection