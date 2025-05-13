@extends('patient.layout')

@section('title', 'Add Payment Method | Medical Clinic')

@section('content')

<!-- Main Content -->
<main class="main-content">
    <div class="page-header">
        <h1>Add Payment Method</h1>
        <a href="{{ route('patient.payments') }}" class="btn btn-outline">
            <i class="fas fa-arrow-left"></i> Back to Payments
        </a>
    </div>

    <!-- Payment Method Form -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Payment Method Details</h3>
        </div>
        <form action="{{ route('patient.payment-methods-store') }}" method="POST">
            @csrf
        
            <!-- Payment Method Selection -->
            <div style="padding: 20px;">
                <div style="margin-bottom: 30px;">
                    <label style="display: block; margin-bottom: 15px; font-weight: bold;">Payment Method Type</label>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px;">
                        <div style="border: 1px solid rgba(0, 0, 0, 0.1); border-radius: 12px; padding: 15px; cursor: pointer; position: relative; background-color: rgba(0, 66, 88, 0.05);">
                            <input type="radio" name="payment-type" id="credit-card" checked style="position: absolute; top: 15px; right: 15px;">
                            <label for="credit-card" style="cursor: pointer; display: block;">
                                <div style="display: flex; align-items: center; margin-bottom: 10px;">
                                    <div style="width: 40px; height: 40px; border-radius: 50%; background-color: rgba(0, 66, 88, 0.1); display: flex; align-items: center; justify-content: center; color: var(--primary); margin-right: 10px;">
                                        <i class="fas fa-credit-card"></i>
                                    </div>
                                    <div>
                                        <h4 style="margin: 0;">Credit or Debit Card</h4>
                                    </div>
                                </div>
                                <p style="margin: 0; font-size: 14px; color: var(--text-light);">Add a credit or debit card for secure payments</p>
                            </label>
                        </div>
                    </div>
                </div>
        
                <!-- Credit Card Details -->
                <div id="credit-card-details">
                    <h4 style="margin-top: 0; margin-bottom: 20px; color: var(--primary);">Card Information</h4>
        
                    {{-- Cardholder Name --}}
                    <div style="margin-bottom: 20px;">
                        <label for="card-name" style="display: block; margin-bottom: 8px; font-weight: bold;">Cardholder Name</label>
                        <input type="text" id="card-name" name="cardholder_name" value="{{ old('cardholder_name') }}" placeholder="Name as it appears on card"
                            style="width: 100%; padding: 10px 15px; border-radius: 50px; border: 1px solid rgba(0, 0, 0, 0.1);" required>
                        @error('cardholder_name')
                            <div style="color: red; font-size: 14px;">{{ $message }}</div>
                        @enderror
                    </div>
        
                    {{-- Card Number --}}
                    <div style="margin-bottom: 20px;">
                        <label for="card-number" style="display: block; margin-bottom: 8px; font-weight: bold;">Card Number</label>
                        <input type="text" id="card-number" name="card_number" value="{{ old('card_number') }}" placeholder="1234 5678 9012 3456"
                            style="width: 100%; padding: 10px 15px; border-radius: 50px; border: 1px solid rgba(0, 0, 0, 0.1);" required>
                        @error('card_number')
                            <div style="color: red; font-size: 14px;">{{ $message }}</div>
                        @enderror
                    </div>
        
                    {{-- Expiration Month & Year --}}
                    <div style="display: flex; gap: 15px; margin-bottom: 20px;">
                        <div style="flex: 1;">
                            <label for="card-expiry" style="display: block; margin-bottom: 8px; font-weight: bold;">Expiration Month</label>
                            <input type="text" id="card-expiry" name="expiration_month" value="{{ old('expiration_month') }}" placeholder="MM"
                                style="width: 100%; padding: 10px 15px; border-radius: 50px; border: 1px solid rgba(0, 0, 0, 0.1);" required>
                            @error('expiration_month')
                                <div style="color: red; font-size: 14px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div style="flex: 1;">
                            <label for="card-expiry-year" style="display: block; margin-bottom: 8px; font-weight: bold;">Expiration Year</label>
                            <input type="text" id="card-expiry-year" name="expiration_year" value="{{ old('expiration_year') }}" placeholder="YYYY"
                                style="width: 100%; padding: 10px 15px; border-radius: 50px; border: 1px solid rgba(0, 0, 0, 0.1);" required>
                            @error('expiration_year')
                                <div style="color: red; font-size: 14px;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
        
                    {{-- Security Code --}}
                    <div style="margin-bottom: 20px;">
                        <label for="security-code" style="display: block; margin-bottom: 8px; font-weight: bold;">Security Code (CVV)</label>
                        <input type="text" id="security-code" name="security_code" value="{{ old('security_code') }}" placeholder="123"
                            style="width: 100%; padding: 10px 15px; border-radius: 50px; border: 1px solid rgba(0, 0, 0, 0.1);" maxlength="4">
                        @error('security_code')
                            <div style="color: red; font-size: 14px;">{{ $message }}</div>
                        @enderror
                    </div>
        
                    {{-- Default Card Checkbox --}}
                    {{-- <div style="margin-bottom: 30px;">
                        <div style="display: flex; align-items: center;">
                            <input type="checkbox" id="default-card" name="default_card" style="margin-right: 10px;" {{ old('default_card') ? 'checked' : '' }}>
                            <label for="default-card">Set as default payment method</label>
                        </div>
                    </div> --}}
                </div>
        
                <!-- Form Buttons -->
                <div style="display: flex; justify-content: flex-end; gap: 15px;">
                    <a href="{{ route('patient.payments') }}" class="btn btn-outline">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Payment Method
                    </button>
                </div>
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

// Payment method type toggle
const creditCardRadio = document.getElementById('credit-card');
const bankAccountRadio = document.getElementById('bank-account');
const cashRadio = document.getElementById('cash');
const creditCardDetails = document.getElementById('credit-card-details');
const bankAccountDetails = document.getElementById('bank-account-details');
const cashDetails = document.getElementById('cash-details');
const billingAddressSection = document.getElementById('billing-address-section');

function updatePaymentMethodDisplay() {
    // Hide all payment method details
    creditCardDetails.style.display = 'none';
    bankAccountDetails.style.display = 'none';
    cashDetails.style.display = 'none';
    
    // Reset background colors
    creditCardRadio.parentElement.style.backgroundColor = '';
    bankAccountRadio.parentElement.style.backgroundColor = '';
    cashRadio.parentElement.style.backgroundColor = '';
    
    // Show selected payment method details
    if (creditCardRadio.checked) {
        creditCardDetails.style.display = 'block';
        creditCardRadio.parentElement.style.backgroundColor = 'rgba(0, 66, 88, 0.05)';
        billingAddressSection.style.display = 'block';
    } else if (bankAccountRadio.checked) {
        bankAccountDetails.style.display = 'block';
        bankAccountRadio.parentElement.style.backgroundColor = 'rgba(0, 66, 88, 0.05)';
        billingAddressSection.style.display = 'block';
    } else if (cashRadio.checked) {
        cashDetails.style.display = 'block';
        cashRadio.parentElement.style.backgroundColor = 'rgba(0, 66, 88, 0.05)';
        billingAddressSection.style.display = 'none'; // Hide billing address for cash
    }
}

creditCardRadio.addEventListener('change', updatePaymentMethodDisplay);
bankAccountRadio.addEventListener('change', updatePaymentMethodDisplay);
cashRadio.addEventListener('change', updatePaymentMethodDisplay);

// Billing address toggle
const sameAddressRadio = document.getElementById('same-address');
const differentAddressRadio = document.getElementById('different-address');
const differentAddressForm = document.getElementById('different-address-form');

sameAddressRadio.addEventListener('change', function() {
    if (this.checked) {
        differentAddressForm.style.display = 'none';
    }
});

differentAddressRadio.addEventListener('change', function() {
    if (this.checked) {
        differentAddressForm.style.display = 'block';
    }
});

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
    
    if (creditCardRadio.checked) {
        // Validate credit card fields
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
    } else if (bankAccountRadio.checked) {
        // Validate bank account fields
        const accountHolder = document.getElementById('account-holder').value;
        const routingNumber = document.getElementById('routing-number').value;
        const accountNumber = document.getElementById('account-number').value;
        
        if (!accountHolder) {
            isValid = false;
            errorMessage += 'Account holder name is required.\n';
        }
        
        if (!routingNumber || !/^\d{9}$/.test(routingNumber)) {
            isValid = false;
            errorMessage += 'Please enter a valid 9-digit routing number.\n';
        }
        
        if (!accountNumber) {
            isValid = false;
            errorMessage += 'Account number is required.\n';
        }
    } else if (cashRadio.checked) {
        // Validate cash payment fields
        const preferredLocation = document.getElementById('preferred-location').value;
        
        if (!preferredLocation) {
            isValid = false;
            errorMessage += 'Please select a preferred payment location.\n';
        }
    }
    
    if ((creditCardRadio.checked || bankAccountRadio.checked) && differentAddressRadio.checked) {
        // Validate address fields
        const addressLine1 = document.getElementById('address-line1').value;
        const city = document.getElementById('city').value;
        const state = document.getElementById('state').value;
        const zip = document.getElementById('zip').value;
        
        if (!addressLine1) {
            isValid = false;
            errorMessage += 'Address line 1 is required.\n';
        }
        
        if (!city) {
            isValid = false;
            errorMessage += 'City is required.\n';
        }
        
        if (!state) {
            isValid = false;
            errorMessage += 'State is required.\n';
        }
        
        if (!zip) {
            isValid = false;
            errorMessage += 'ZIP code is required.\n';
        }
    }
    
    if (!isValid) {
        alert('Please correct the following errors:\n\n' + errorMessage);
        return;
    }
    
    // If all validation passes, show success message
    alert('Payment method added successfully!');
    window.location.href = 'payments.html';
});
});
</script>

@endsection