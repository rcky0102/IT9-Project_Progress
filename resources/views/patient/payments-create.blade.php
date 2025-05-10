@extends('patient.layout')

@section('title', 'Make a Payment | Medical Clinic')

@section('content')

<!-- Main Content -->
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
        <form>
            <div style="padding: 20px;">
                <!-- Outstanding Balance Summary -->
                <div style="background-color: #f9f9f9; padding: 15px; border-radius: 12px; margin-bottom: 20px;">
                    <h4 style="color: var(--primary); margin-bottom: 15px;">Outstanding Balance</h4>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <span>Total Outstanding:</span>
                        <span style="font-weight: bold;">$120.00</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <span>Due Date:</span>
                        <span>Apr 15, 2025</span>
                    </div>
                </div>

                <!-- Payment Amount -->
                <div style="margin-bottom: 20px;">
                    <label for="payment-amount" style="display: block; margin-bottom: 8px; font-weight: bold;">Payment Amount</label>
                    <div style="display: flex; align-items: center;">
                        <div style="position: relative;">
                            <span style="position: absolute; left: 15px; top: 10px;">$</span>
                            <input type="text" id="payment-amount" value="120.00" style="padding: 10px 10px 10px 30px; border-radius: 50px; border: 1px solid rgba(0, 0, 0, 0.1); width: 150px;">
                        </div>
                        <div style="margin-left: 15px;">
                            <button type="button" class="btn btn-sm btn-outline" style="margin-right: 5px;">Pay Minimum ($30)</button>
                            <button type="button" class="btn btn-sm btn-outline">Pay Full ($120)</button>
                        </div>
                    </div>
                </div>

                <!-- Payment Method Selection -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 15px; font-weight: bold;">Select Payment Method</label>
                    
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 20px;">
                        @foreach ($paymentMethods as $index => $method)
                        <div style="border: 1px solid rgba(0, 0, 0, 0.1); border-radius: 12px; padding: 15px; cursor: pointer; position: relative; background-color: rgba(0, 66, 88, 0.05); margin-bottom: 10px;">
                            <input 
                                type="radio" 
                                name="payment_method_id" 
                                id="payment-method-{{ $index }}" 
                                value="{{ $method->id }}" 
                                {{ $loop->first ? 'checked' : '' }} 
                                style="position: absolute; top: 15px; right: 15px;"
                            >
                            <label for="payment-method-{{ $index }}" style="cursor: pointer;">
                                <div style="display: flex; align-items: center; margin-bottom: 10px;">
                                    <div style="width: 40px; height: 40px; border-radius: 50%; background-color: rgba(0, 66, 88, 0.1); display: flex; align-items: center; justify-content: center; color: var(--primary); margin-right: 10px;">
                                        <i class="fas fa-credit-card"></i>
                                    </div>
                                    <div>
                                        <h4 style="margin: 0;">Card/Debit ending in {{ substr($method->card_number, -4) }}</h4>
                                        <p style="margin: 5px 0 0; font-size: 14px; color: var(--text-light);">
                                            Expires {{ $method->expiration_month }}/{{ substr($method->expiration_year, -2) }}
                                        </p>
                                        @if ($loop->first)
                                            <span style="font-size: 12px; color: green;">Default</span>
                                        @endif
                                    </div>
                                </div>
                            </label>
                        </div>
                        @endforeach

                        
                        {{-- <div style="border: 1px solid rgba(0, 0, 0, 0.1); border-radius: 12px; padding: 15px; cursor: pointer; position: relative;">
                            <input type="radio" name="payment-method" id="bank-payment" style="position: absolute; top: 15px; right: 15px;">
                            <label for="bank-payment" style="cursor: pointer;">
                                <div style="display: flex; align-items: center; margin-bottom: 10px;">
                                    <div style="width: 40px; height: 40px; border-radius: 50%; background-color: rgba(0, 66, 88, 0.1); display: flex; align-items: center; justify-content: center; color: var(--primary); margin-right: 10px;">
                                        <i class="fas fa-university"></i>
                                    </div>
                                    <div>
                                        <h4 style="margin: 0;">Bank Account</h4>
                                        <p style="margin: 5px 0 0; font-size: 14px; color: var(--text-light);">Checking **** 7890</p>
                                    </div>
                                </div>
                            </label>
                        </div> --}}

                        
                        
                        <div style="border: 1px solid rgba(0, 0, 0, 0.1); border-radius: 12px; padding: 15px; cursor: pointer; position: relative;">
                            <input type="radio" name="payment_method_id" id="cash-payment" value="cash" style="position: absolute; top: 15px; right: 15px;">
                            <label for="cash-payment" style="cursor: pointer;">
                                <div style="display: flex; align-items: center; margin-bottom: 10px;">
                                    <div style="width: 40px; height: 40px; border-radius: 50%; background-color: rgba(0, 66, 88, 0.1); display: flex; align-items: center; justify-content: center; color: var(--primary); margin-right: 10px;">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                    <div>
                                        <h4 style="margin: 0;">Cash</h4>
                                        <p style="margin: 5px 0 0; font-size: 14px; color: var(--text-light);">Pay in person</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                    
                    <div style="display: flex; align-items: center; margin-bottom: 20px;">
                        <input type="checkbox" id="new-payment-method" style="margin-right: 10px;">
                        <label for="new-payment-method">Use a new payment method</label>
                    </div>
                </div>

                <!-- Credit Card Details (shown when using a new payment method) -->
                <div id="new-payment-details" style="display: none; margin-bottom: 20px; padding: 20px; border: 1px solid rgba(0, 0, 0, 0.1); border-radius: 12px;">
                    <h4 style="margin-top: 0; margin-bottom: 15px; color: var(--primary);">New Card Details</h4>
                    
                    <div style="margin-bottom: 15px;">
                        <label for="card-name" style="display: block; margin-bottom: 8px;">Cardholder Name</label>
                        <input type="text" id="card-name" placeholder="Name on card" style="width: 100%; padding: 10px 15px; border-radius: 50px; border: 1px solid rgba(0, 0, 0, 0.1);">
                    </div>
                    
                    <div style="margin-bottom: 15px;">
                        <label for="card-number" style="display: block; margin-bottom: 8px;">Card Number</label>
                        <input type="text" id="card-number" placeholder="1234 5678 9012 3456" style="width: 100%; padding: 10px 15px; border-radius: 50px; border: 1px solid rgba(0, 0, 0, 0.1);">
                    </div>
                    
                    <div style="display: flex; gap: 15px; margin-bottom: 15px;">
                        <div style="flex: 1;">
                            <label for="card-expiry" style="display: block; margin-bottom: 8px;">Expiration Date</label>
                            <input type="text" id="card-expiry" placeholder="MM/YY" style="width: 100%; padding: 10px 15px; border-radius: 50px; border: 1px solid rgba(0, 0, 0, 0.1);">
                        </div>
                        <div style="flex: 1;">
                            <label for="card-cvc" style="display: block; margin-bottom: 8px;">CVC</label>
                            <input type="text" id="card-cvc" placeholder="123" style="width: 100%; padding: 10px 15px; border-radius: 50px; border: 1px solid rgba(0, 0, 0, 0.1);">
                        </div>
                    </div>
                    
                    <div style="display: flex; align-items: center;">
                        <input type="checkbox" id="save-card" style="margin-right: 10px;">
                        <label for="save-card">Save this card for future payments</label>
                    </div>
                </div>
                
                <!-- Cash Payment Details (shown when cash is selected) -->
                <div id="cash-payment-details" style="display: none; margin-bottom: 20px; padding: 20px; border: 1px solid rgba(0, 0, 0, 0.1); border-radius: 12px;">
                    <h4 style="margin-top: 0; margin-bottom: 15px; color: var(--primary);">Cash Payment Information</h4>
                    
                    <div style="background-color: #f9f9f9; padding: 15px; border-radius: 12px; margin-bottom: 20px;">
                        <div style="display: flex; align-items: flex-start; gap: 10px;">
                            <i class="fas fa-info-circle" style="color: var(--primary); margin-top: 2px;"></i>
                            <div>
                                <p style="margin: 0 0 10px; font-size: 14px;">Please bring this amount in cash to any of our clinic locations during business hours. A receipt will be provided upon payment.</p>
                                <p style="margin: 0; font-size: 14px; font-weight: bold;">This will not complete your payment now. This option is to indicate your intention to pay with cash.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label for="preferred-location" style="display: block; margin-bottom: 8px; font-weight: bold;">Preferred Payment Location</label>
                        <select id="preferred-location" style="width: 100%; padding: 10px 15px; border-radius: 50px; border: 1px solid rgba(0, 0, 0, 0.1);">
                            <option value="">Select a location</option>
                            <option value="main">Main Clinic - 123 Medical Dr.</option>
                            <option value="north">North Branch - 456 Health Ave.</option>
                            <option value="east">East Branch - 789 Wellness Blvd.</option>
                        </select>
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label for="payment-date" style="display: block; margin-bottom: 8px; font-weight: bold;">Planned Payment Date</label>
                        <input type="date" id="payment-date" style="width: 100%; padding: 10px 15px; border-radius: 50px; border: 1px solid rgba(0, 0, 0, 0.1);">
                    </div>
                </div>

                <!-- Billing Address (only shown for card and bank payments) -->
                <div id="billing-address-section" style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 15px; font-weight: bold;">Billing Address</label>
                    
                    <div style="display: flex; align-items: center; margin-bottom: 15px;">
                        <input type="radio" name="billing-address" id="same-address" checked style="margin-right: 10px;">
                        <label for="same-address">Same as my profile address</label>
                    </div>
                    
                    <div style="display: flex; align-items: center;">
                        <input type="radio" name="billing-address" id="different-address" style="margin-right: 10px;">
                        <label for="different-address">Use a different billing address</label>
                    </div>
                </div>

                <!-- Payment Summary -->
                <div style="background-color: #f9f9f9; padding: 15px; border-radius: 12px; margin-bottom: 20px;">
                    <h4 style="color: var(--primary); margin-bottom: 15px;">Payment Summary</h4>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <span>Payment Amount:</span>
                        <span>$120.00</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <span>Processing Fee:</span>
                        <span>$0.00</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; font-weight: bold; padding-top: 10px; border-top: 1px solid rgba(0, 0, 0, 0.1);">
                        <span>Total:</span>
                        <span>$120.00</span>
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <div style="margin-bottom: 20px;">
                    <div style="display: flex; align-items: flex-start;">
                        <input type="checkbox" id="terms" style="margin-right: 10px; margin-top: 3px;">
                        <label for="terms" style="font-size: 14px;">I authorize Medical Clinic to charge my selected payment method for the amount specified above. I have read and agree to the <a href="#" style="color: var(--primary);">Terms and Conditions</a>.</label>
                    </div>
                </div>

                <!-- Form Actions -->
                <div style="display: flex; justify-content: flex-end; gap: 15px;">
                    <a href="payments.html" class="btn btn-outline">Cancel</a>
                    <button type="submit" class="btn btn-primary" id="submit-button">
                        <i class="fas fa-credit-card"></i> <span id="button-text">Complete Payment</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</main>
</div>
</div>

<script>

document.addEventListener('DOMContentLoaded', function () {
        const radios = document.querySelectorAll('input[name="payment_method_id"]');
        const cashDetails = document.getElementById('cash-payment-details');

        radios.forEach(radio => {
            radio.addEventListener('change', function () {
                if (this.value === 'cash') {
                    cashDetails.style.display = 'block';
                } else {
                    cashDetails.style.display = 'none';
                }
            });

            // Trigger on load (in case cash is selected by default)
            if (radio.checked && radio.value === 'cash') {
                cashDetails.style.display = 'block';
            }
        });
    });
    
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

// New payment method toggle
const newPaymentMethodCheckbox = document.getElementById('new-payment-method');
const newPaymentDetails = document.getElementById('new-payment-details');

newPaymentMethodCheckbox.addEventListener('change', function() {
    if (this.checked) {
        newPaymentDetails.style.display = 'block';
    } else {
        newPaymentDetails.style.display = 'none';
    }
});

// Payment method selection
const cardPaymentRadio = document.getElementById('card-payment');
const bankPaymentRadio = document.getElementById('bank-payment');
const cashPaymentRadio = document.getElementById('cash-payment');
const cashPaymentDetails = document.getElementById('cash-payment-details');
const billingAddressSection = document.getElementById('billing-address-section');
const submitButton = document.getElementById('submit-button');
const buttonText = document.getElementById('button-text');

function updatePaymentMethodDisplay() {
    // Reset all payment method containers
    document.querySelectorAll('input[name="payment-method"]').forEach(r => {
        r.parentElement.style.backgroundColor = '';
    });
    
    // Hide all specific payment details
    cashPaymentDetails.style.display = 'none';
    
    // Add highlight to selected payment method container
    if (cardPaymentRadio.checked) {
        cardPaymentRadio.parentElement.style.backgroundColor = 'rgba(0, 66, 88, 0.05)';
        billingAddressSection.style.display = 'block';
        buttonText.textContent = 'Complete Payment';
        submitButton.querySelector('i').className = 'fas fa-credit-card';
    } else if (bankPaymentRadio.checked) {
        bankPaymentRadio.parentElement.style.backgroundColor = 'rgba(0, 66, 88, 0.05)';
        billingAddressSection.style.display = 'block';
        buttonText.textContent = 'Complete Payment';
        submitButton.querySelector('i').className = 'fas fa-university';
    } else if (cashPaymentRadio.checked) {
        cashPaymentRadio.parentElement.style.backgroundColor = 'rgba(0, 66, 88, 0.05)';
        cashPaymentDetails.style.display = 'block';
        billingAddressSection.style.display = 'none'; // Hide billing address for cash
        buttonText.textContent = 'Schedule Cash Payment';
        submitButton.querySelector('i').className = 'fas fa-money-bill-wave';
        
        // Disable new payment method checkbox for cash
        newPaymentMethodCheckbox.checked = false;
        newPaymentMethodCheckbox.disabled = true;
        newPaymentDetails.style.display = 'none';
    } else {
        // Enable new payment method checkbox if no cash is selected
        newPaymentMethodCheckbox.disabled = false;
    }
}

cardPaymentRadio.addEventListener('change', updatePaymentMethodDisplay);
bankPaymentRadio.addEventListener('change', updatePaymentMethodDisplay);
cashPaymentRadio.addEventListener('change', updatePaymentMethodDisplay);

// Initialize display
updatePaymentMethodDisplay();

// Form validation
const form = document.querySelector('form');
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
    const paymentAmount = document.getElementById('payment-amount').value;
    if (!paymentAmount || isNaN(parseFloat(paymentAmount)) || parseFloat(paymentAmount) <= 0) {
        isValid = false;
        errorMessage += 'Please enter a valid payment amount.\n';
    }
    
    if (cashPaymentRadio.checked) {
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
    if (!cashPaymentRadio.checked && isValid) {
        alert('Payment of $' + paymentAmount + ' processed successfully!');
        window.location.href = 'payments.html';
    }
});

// Quick payment amount buttons
const minPayBtn = document.querySelector('.btn-sm.btn-outline:first-of-type');
const fullPayBtn = document.querySelector('.btn-sm.btn-outline:last-of-type');

minPayBtn.addEventListener('click', function() {
    document.getElementById('payment-amount').value = '30.00';
});

fullPayBtn.addEventListener('click', function() {
    document.getElementById('payment-amount').value = '120.00';
});
});
</script>

@endsection