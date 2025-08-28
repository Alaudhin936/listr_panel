@extends('others.others_layout.master')

@section('others_css')
<style>
    /* Prevent window scrolling */
    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
        overflow: hidden;
    }
    
    /* Main container using Bootstrap grid */
    .container-fluid {
        height: 100vh;
        overflow: hidden;
    }
    
    .row {
        height: 100%;
        margin: 0;
    }
    
    /* Image column - fixed position */
    .col-image {
        padding: 0;
        height: 100vh;
        position: relative;
    }
    
    .fixed-image {
        width: 100%;
        height: 100vh;
        object-fit: cover;
        position: sticky;
        top: 0;
    }
    
    /* Form column - scrollable */
    .col-form {
        padding: 0;
        height: 100vh;
        overflow-y: auto;
    }
    
    .login-card {
        padding: 2rem;
    }
    
    /* Form styling */
    .theme-form {
        max-width: 100%;
    }
    
    /* Error messages */
    .text-danger {
        display: block;
        margin-top: 0.25rem;
        font-size: 0.875rem;
    }
    
    /* OTP input styling */
    .otp-inputs {
        display: flex;
        gap: 10px;
        justify-content: center;
        margin: 20px 0;
    }
    
    .otp-input {
        width: 50px;
        height: 50px;
        text-align: center;
        font-size: 18px;
        font-weight: bold;
        border: 2px solid #ddd;
        border-radius: 8px;
        background: #f8f9fa;
    }
    
    .otp-input:focus {
        border-color: #007bff;
        outline: none;
        background: #fff;
    }
    
    /* Hidden form steps */
    .form-step {
        display: none;
    }
    
    .form-step.active {
        display: block;
    }
    
    /* Loading spinner */
    .spinner-border {
        width: 1rem;
        height: 1rem;
        margin-right: 0.5rem;
    }
    
    /* Responsive adjustments */
    @media (max-width: 767.98px) {
        .col-image {
            display: none;
        }
        .col-form {
            width: 100%;
        }
        
        .otp-input {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }
    }
</style>
@endsection

@section('others_content')
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<div class="container-fluid p-0">
    <div class="row m-0">
        <!-- Left Column - Fixed Image -->
        <div class="col-md-6 p-0 col-image">  
            <img src="{{asset('/assets/images/left.png')}}" class="fixed-image">
        </div>
        
        <!-- Right Column - Scrollable Form -->
        <div class="col-md-6 p-0 col-form">    
            <div class="login-card">
                <div>
                    <div><a class="logo" href=""><img class="for-light" src="{{ asset('assets/images/listrlogo.png') }}" alt="loginpage" style="width:90px;"></a></div>
                    <div class="login-main"> 
                        <!-- Success/Error Messages -->
                        <div id="messageContainer"></div>

                        <!-- Step 1: Registration Form -->
                        <div id="step1" class="form-step active">
                            <form class="theme-form" id="registrationForm">
                                @csrf
                                <h4 class="text-center">Create new agency account</h4>
                                <p class="text-center">Fill the agency details below to register</p>
                                
                                <div class="form-group">
                                    <label class="col-form-label">Agency Name</label>
                                    <input class="form-control" type="text" name="name" required placeholder="Enter agency name" value="{{ old('name') }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Email Address</label>
                                    <input class="form-control" type="email" name="email" required placeholder="agency@example.com" value="{{ old('email') }}">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Phone Number</label>
                                    <input class="form-control" type="tel" name="phone" required placeholder="Enter phone number" value="{{ old('phone') }}">
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Address Line 1</label>
                                    <input class="form-control" type="text" name="address_line1" required placeholder="Enter agency address" value="{{ old('address_line1') }}">
                                    @error('address_line1')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Address Line 2 (Optional)</label>
                                    <input class="form-control" type="text" name="address_line2" placeholder="Additional address info" value="{{ old('address_line2') }}">
                                    @error('address_line2')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">State</label>
                                            <input class="form-control" type="text" name="state" required placeholder="Enter state" value="{{ old('state') }}">
                                            @error('state')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">City</label>
                                            <input class="form-control" type="text" name="city" required placeholder="Enter city" value="{{ old('city') }}">
                                            @error('city')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Zipcode</label>
                                            <input class="form-control" type="text" name="zipcode" required placeholder="Enter zipcode" value="{{ old('zipcode') }}">
                                            @error('zipcode')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Contact Person</label>
                                            <input class="form-control" type="text" name="contact_person" required placeholder="Enter contact person name" value="{{ old('contact_person') }}">
                                            @error('contact_person')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Landline (Optional)</label>
                                    <input class="form-control" type="tel" name="landline" placeholder="Enter landline number" value="{{ old('landline') }}">
                                    @error('landline')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-0">
                                    <div class="checkbox p-0">
                                        <input id="checkbox1" type="checkbox" required>
                                        <label class="text-muted" for="checkbox1">I agree to the terms and conditions</label>
                                    </div>
                                    <div class="text-end mt-3">
                                        <button class="btn btn-dark btn-block w-100" type="button" onclick="sendOTP()" id="sendOtpBtn">
                                            <span class="spinner-border spinner-border-sm d-none" id="otpSpinner"></span>
                                            <span id="otpBtnText">Send OTP & Register</span>
                                        </button>
                                    </div>
                                </div>
                               
                                <p class="mt-4 mb-0 text-center">Already have account?<a class="ms-2" href="{{ route('login') }}">Sign In</a></p>
                            </form>
                        </div>

                        <!-- Step 2: OTP Verification -->
                        <div id="step2" class="form-step">
                            <form class="theme-form" id="otpForm">
                                @csrf
                                <input type="hidden" name="temp_data" id="tempData">
                                <h4 class="text-center">Verify OTP</h4>
                                <p class="text-center">Enter the 4-digit code sent to your phone</p>
                                
                                <div class="otp-inputs">
                                    <input type="text" class="otp-input" maxlength="1" name="otp1" required>
                                    <input type="text" class="otp-input" maxlength="1" name="otp2" required>
                                    <input type="text" class="otp-input" maxlength="1" name="otp3" required>
                                    <input type="text" class="otp-input" maxlength="1" name="otp4" required>
                                </div>
                                
                                <div class="text-center mb-3">
                                    <small class="text-muted">Didn't receive the code? <a href="#" onclick="resendOTP()" id="resendOtpLink">Resend OTP</a></small>
                                </div>
                                
                                <div class="text-end">
                                    <button class="btn btn-secondary me-2" type="button" onclick="goBackToStep1()">Back</button>
                                    <button class="btn btn-dark" type="button" onclick="verifyOTP()" id="verifyOtpBtn">
                                        <span class="spinner-border spinner-border-sm d-none" id="verifySpinner"></span>
                                        <span id="verifyBtnText">Verify & Complete Registration</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('others_script')
<script>
// Timer variables
let resendTimer;
let timeLeft = 30;

function showMessage(type, message) {
    const messageContainer = document.getElementById('messageContainer');
    messageContainer.innerHTML = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
}

function setButtonLoading(buttonId, spinnerId, btnTextId, isLoading) {
    const spinner = document.getElementById(spinnerId);
    const btnText = document.getElementById(btnTextId);
    const button = document.getElementById(buttonId);
    
    if (isLoading) {
        spinner.classList.remove('d-none');
        btnText.textContent = 'Processing...';
        button.disabled = true;
    } else {
        spinner.classList.add('d-none');
        if (buttonId === 'sendOtpBtn') {
            btnText.textContent = 'Send OTP & Register';
        } else {
            btnText.textContent = 'Verify & Complete Registration';
        }
        button.disabled = false;
    }
}

// Function to start the resend timer
function startResendTimer() {
    const resendLink = document.getElementById('resendOtpLink');
    
    // Clear any existing timer
    clearInterval(resendTimer);
    
    // Disable the resend link
    resendLink.onclick = null;
    resendLink.style.pointerEvents = 'none';
    resendLink.style.color = '#6c757d';
    
    // Set initial time
    timeLeft = 30;
    resendLink.innerHTML = `Resend OTP (${timeLeft}s)`;
    
    // Start the countdown
    resendTimer = setInterval(() => {
        timeLeft--;
        
        if (timeLeft <= 0) {
            // Enable the resend link
            clearInterval(resendTimer);
            resendLink.innerHTML = 'Resend OTP';
            resendLink.onclick = function() { resendOTP(); };
            resendLink.style.pointerEvents = 'auto';
            resendLink.style.color = '';
        } else {
            // Update the timer text
            resendLink.innerHTML = `Resend OTP (${timeLeft}s)`;
        }
    }, 1000);
}

function sendOTP() {
    const form = document.getElementById('registrationForm');
    const formData = new FormData(form);
    
    // Validate form first
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }
    
    // Show loading state
    setButtonLoading('sendOtpBtn', 'otpSpinner', 'otpBtnText', true);
    
    // Send AJAX request to generate OTP
    fetch('{{ route("agency.send.otp") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        setButtonLoading('sendOtpBtn', 'otpSpinner', 'otpBtnText', false);
        
        if (data.success) {
            document.getElementById('tempData').value = data.temp_data;
            document.getElementById('step1').classList.remove('active');
            document.getElementById('step2').classList.add('active');
            showMessage('success', data.message);
            
            // Start the resend timer
            startResendTimer();
        } else {
            showMessage('danger', data.message);
        }
    })
    .catch(error => {
        setButtonLoading('sendOtpBtn', 'otpSpinner', 'otpBtnText', false);
        console.error('Error:', error);
        showMessage('danger', 'An error occurred. Please try again.');
    });
}

function resendOTP() {
    const tempData = document.getElementById('tempData').value;
    const resendLink = document.getElementById('resendOtpLink');
    
    resendLink.textContent = 'Sending...';
    resendLink.onclick = null;
    
    fetch('{{ route("agency.resend.otp") }}', {
        method: 'POST',
        body: JSON.stringify({ temp_data: tempData }),
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showMessage('success', data.message);
            
            // Restart the timer after successful resend
            startResendTimer();
        } else {
            showMessage('danger', data.message);
            resendLink.textContent = 'Resend OTP';
            resendLink.onclick = function() { resendOTP(); };
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showMessage('danger', 'Failed to resend OTP.');
        resendLink.textContent = 'Resend OTP';
        resendLink.onclick = function() { resendOTP(); };
    });
}

function verifyOTP() {
    const form = document.getElementById('otpForm');
    const formData = new FormData(form);
    
    // Show loading state
    setButtonLoading('verifyOtpBtn', 'verifySpinner', 'verifyBtnText', true);
    
    // Send AJAX request to verify OTP
    fetch('{{ route("agency.verify.otp") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        setButtonLoading('verifyOtpBtn', 'verifySpinner', 'verifyBtnText', false);
        
        if (data.success) {
            showMessage('success', data.message);
            // Clear the timer when verification is successful
            clearInterval(resendTimer);
            // Redirect after a short delay to show the success message
            setTimeout(() => {
                window.location.href = data.redirect;
            }, 2000);
        } else {
            showMessage('danger', data.message);
        }
    })
    .catch(error => {
        setButtonLoading('verifyOtpBtn', 'verifySpinner', 'verifyBtnText', false);
        console.error('Error:', error);
        showMessage('danger', 'An error occurred. Please try again.');
    });
}

function goBackToStep1() {
    document.getElementById('step2').classList.remove('active');
    document.getElementById('step1').classList.add('active');
    clearInterval(resendTimer);
    
    const resendLink = document.getElementById('resendOtpLink');
    resendLink.innerHTML = 'Resend OTP';
    resendLink.onclick = function() { resendOTP(); };
    resendLink.style.pointerEvents = 'auto';
    resendLink.style.color = '';
}

// OTP input navigation
document.addEventListener('DOMContentLoaded', function() {
    const otpInputs = document.querySelectorAll('.otp-input');
    
    otpInputs.forEach((input, index) => {
        input.addEventListener('input', function() {
            if (this.value.length === 1 && index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
            }
        });
        
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' && this.value === '' && index > 0) {
                otpInputs[index - 1].focus();
            }
        });
    });
});
</script>
@endsection