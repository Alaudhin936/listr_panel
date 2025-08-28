<?php $__env->startSection('others_css'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('others_content'); ?>
<head>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>
<div class="container-fluid p-0">
    <div class="row m-0">
        <!-- Left Column - Fixed Image -->
        <div class="col-md-6 p-0 col-image">  
            <img src="<?php echo e(asset('/assets/images/left.png')); ?>" class="fixed-image">
        </div>
        
        <div class="col-md-6 p-0 col-form">    
            <div class="login-card">
                <div>
                    <div><a class="logo" ><img class="for-light" src="<?php echo e(asset('assets/images/listrlogo.png')); ?>" alt="loginpage" style="width:90px;"></a></div>
                    <div class="login-main">
                        <!-- Don't have account dropdown -->
                        <div class="text-center mb-3">
                            <label class="me-2">Don't have account?</label>
                            <select class="form-select d-inline-block" style="width:220px" onchange="handleAccountSelection(this)">
                                <option value="">Create Account</option>
                                <option value="<?php echo e(route('agency.signup')); ?>">Agency</option>
                                <option value="<?php echo e(route('agent.register')); ?>">Agent</option>
                            </select>
                        </div>

                        <div id="messageContainer"></div>

                        <!-- Step 1: Username Input -->
                        <div id="loginStep1" class="form-step active">
                            <form class="theme-form mt-4" id="loginForm">
                                <?php echo csrf_field(); ?>
                                <h4 class="text-center">Login</h4>
                                <p class="text-center">Enter your email or phone number</p>
                                
                                <div class="form-group">
                                    <label class="col-form-label">Email or Phone</label>
                                    <input class="form-control" type="text" name="username" value="<?php echo e(old('username')); ?>" required placeholder="Enter email or phone number">
                                    <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="text-danger"><?php echo e($message); ?></small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                
                                <div class="form-group mb-0">
                                    <div class="text-end mt-3">
                                        <button class="btn btn-dark btn-block w-100" type="button" onclick="sendOTP()" id="sendOtpBtn">
                                            <span class="spinner-border spinner-border-sm d-none" id="otpSpinner"></span>
                                            <span id="otpBtnText">Send OTP</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Step 2: OTP Verification -->
                        <div id="loginStep2" class="form-step">
                            <form class="theme-form mt-4" id="loginOtpForm">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="username" id="loginUsername">
                                <input type="hidden" name="user_type" id="userType">
                                <h4 class="text-center">Verify OTP</h4>
                                <p class="text-center">Enter the 4-digit code sent to you</p>
                                
                                <div class="otp-inputs">
                                    <input type="text" class="otp-input" maxlength="1" name="otp1" required>
                                    <input type="text" class="otp-input" maxlength="1" name="otp2" required>
                                    <input type="text" class="otp-input" maxlength="1" name="otp3" required>
                                    <input type="text" class="otp-input" maxlength="1" name="otp4" required>
                                </div>
                                
                                <div class="text-center mb-3">
                                    <small class="text-muted">Didn't receive the code? <a href="#" onclick="resendLoginOTP()" id="resendOtpLink">Resend OTP</a></small>
                                </div>
                                
                                <div class="form-group mb-0">
                                    <div class="checkbox p-0">
                                        <input id="remember-me" type="checkbox" name="remember">
                                        <label class="text-muted" for="remember-me">Remember me</label>
                                    </div>
                                    <div class="text-end mt-3">
                                        <button class="btn btn-secondary me-2" type="button" onclick="goBackToLoginStep1()">Back</button>
                                        <button class="btn btn-dark" type="button" onclick="verifyLoginOTP()" id="verifyOtpBtn">
                                            <span class="spinner-border spinner-border-sm d-none" id="verifySpinner"></span>
                                            <span id="verifyBtnText">Verify & Sign In</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('others_script'); ?>
<script>
// Global variables
let currentUserType = null;
let resendTimer;
let timeLeft = 30;

// Get routes dynamically based on detected user type
function getRoutes() {
    if (currentUserType === 'agency') {
        return {
            sendOtp: '<?php echo e(route("agency.login.send.otp")); ?>',
            resendOtp: '<?php echo e(route("agency.login.resend.otp")); ?>',
            verifyOtp: '<?php echo e(route("agency.login.verify.otp")); ?>',
            dashboard: '<?php echo e(route("agency.dashboard")); ?>'
        };
    } else {
        return {
            sendOtp: '<?php echo e(route("agent.login.send.otp")); ?>',
            resendOtp: '<?php echo e(route("agent.login.resend.otp")); ?>',
            verifyOtp: '<?php echo e(route("agent.login.verify.otp")); ?>',
            dashboard: '<?php echo e(route("agent.dashboard")); ?>'
        };
    }
}

function showMessage(type, message) {
    const messageContainer = document.getElementById('messageContainer');
    messageContainer.innerHTML = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
    
    // Auto-dismiss after 5 seconds
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if (alert) {
            alert.remove();
        }
    }, 5000);
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
            btnText.textContent = 'Send OTP';
        } else {
            btnText.textContent = 'Verify & Sign In';
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
    resendLink.style.cursor = 'not-allowed';
    
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
            resendLink.onclick = function() { resendLoginOTP(); };
            resendLink.style.pointerEvents = 'auto';
            resendLink.style.color = '';
            resendLink.style.cursor = 'pointer';
        } else {
            // Update the timer text
            resendLink.innerHTML = `Resend OTP (${timeLeft}s)`;
        }
    }, 1000);
}

// First try agency, then agent if agency fails
function sendOTP() {
    const form = document.getElementById('loginForm');
    const formData = new FormData(form);
    
    // Validate form first
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }
    
    // Show loading state
    setButtonLoading('sendOtpBtn', 'otpSpinner', 'otpBtnText', true);
    
    // Try agency first
    tryAgencyLogin(formData)
        .then(success => {
            if (!success) {
                // If agency fails, try agent
                return tryAgentLogin(formData);
            }
            return true;
        })
        .then(success => {
            setButtonLoading('sendOtpBtn', 'otpSpinner', 'otpBtnText', false);
            if (!success) {
                showMessage('danger', 'No account found with this email or phone number.');
            }
        })
        .catch(error => {
            setButtonLoading('sendOtpBtn', 'otpSpinner', 'otpBtnText', false);
            console.error('Error:', error);
            showMessage('danger', 'An error occurred. Please try again.');
        });
}

async function tryAgencyLogin(formData) {
    try {
        const response = await fetch('<?php echo e(route("agency.login.send.otp")); ?>', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            currentUserType = 'agency';
            document.getElementById('loginUsername').value = formData.get('username');
            document.getElementById('userType').value = 'agency';
            document.getElementById('loginStep1').classList.remove('active');
            document.getElementById('loginStep2').classList.add('active');
            showMessage('success', data.message);
            startResendTimer();
            return true;
        }
        
        return false;
    } catch (error) {
        console.error('Agency login error:', error);
        return false;
    }
}

async function tryAgentLogin(formData) {
    try {
        const response = await fetch('<?php echo e(route("agent.login.send.otp")); ?>', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            currentUserType = 'agent';
            document.getElementById('loginUsername').value = formData.get('username');
            document.getElementById('userType').value = 'agent';
            document.getElementById('loginStep1').classList.remove('active');
            document.getElementById('loginStep2').classList.add('active');
            showMessage('success', data.message);
            startResendTimer();
            return true;
        }
        
        return false;
    } catch (error) {
        console.error('Agent login error:', error);
        return false;
    }
}

function resendLoginOTP() {
    const username = document.getElementById('loginUsername').value;
    const resendLink = document.getElementById('resendOtpLink');
    
    if (!username || !currentUserType) {
        showMessage('danger', 'Session expired. Please start over.');
        goBackToLoginStep1();
        return;
    }
    
    resendLink.textContent = 'Sending...';
    resendLink.onclick = null;
    resendLink.style.pointerEvents = 'none';
    
    const routes = getRoutes();
    
    fetch(routes.resendOtp, {
        method: 'POST',
        body: JSON.stringify({ username: username }),
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showMessage('success', data.message);
            startResendTimer();
        } else {
            showMessage('danger', data.message);
            resendLink.textContent = 'Resend OTP';
            resendLink.onclick = function() { resendLoginOTP(); };
            resendLink.style.pointerEvents = 'auto';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showMessage('danger', 'Failed to resend OTP.');
        resendLink.textContent = 'Resend OTP';
        resendLink.onclick = function() { resendLoginOTP(); };
        resendLink.style.pointerEvents = 'auto';
    });
}

function verifyLoginOTP() {
    const form = document.getElementById('loginOtpForm');
    const formData = new FormData(form);
    
    if (!currentUserType) {
        showMessage('danger', 'Session expired. Please start over.');
        goBackToLoginStep1();
        return;
    }
    
    // Validate OTP inputs
    const otpInputs = document.querySelectorAll('.otp-input');
    let otpComplete = true;
    
    for (let i = 0; i < otpInputs.length; i++) {
        if (!otpInputs[i].value) {
            otpComplete = false;
            break;
        }
    }
    
    if (!otpComplete) {
        showMessage('danger', 'Please enter the complete 4-digit OTP code.');
        return;
    }
    
    // Show loading state
    setButtonLoading('verifyOtpBtn', 'verifySpinner', 'verifyBtnText', true);
    
    const routes = getRoutes();
    
    // Send AJAX request to verify OTP
    fetch(routes.verifyOtp, {
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
            clearInterval(resendTimer);
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

function goBackToLoginStep1() {
    document.getElementById('loginStep2').classList.remove('active');
    document.getElementById('loginStep1').classList.add('active');
    clearInterval(resendTimer);
    
    // Reset state
    currentUserType = null;
    document.getElementById('userType').value = '';
    
    // Reset the resend link
    const resendLink = document.getElementById('resendOtpLink');
    resendLink.innerHTML = 'Resend OTP';
    resendLink.onclick = function() { resendLoginOTP(); };
    resendLink.style.pointerEvents = 'auto';
    resendLink.style.color = '';
    resendLink.style.cursor = 'pointer';
}

function handleAccountSelection(selectElement) {
    if (selectElement.value) {
        window.location.href = selectElement.value;
    }
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
        
        input.addEventListener('paste', function(e) {
            e.preventDefault();
            const pasteData = e.clipboardData.getData('text').slice(0, 4);
            
            for (let i = 0; i < pasteData.length && i < otpInputs.length; i++) {
                otpInputs[i].value = pasteData[i];
            }
            
            if (pasteData.length === 4) {
                otpInputs[3].focus();
            } else if (pasteData.length > 0) {
                otpInputs[pasteData.length - 1].focus();
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('others.others_layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ADMIN\Desktop\listr\resources\views/others/authentication/login.blade.php ENDPATH**/ ?>