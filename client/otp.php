<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification & Password Reset</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .otp-input {
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 1.2rem;
            margin: 0 5px;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
            transition: all 0.3s;
        }
        .otp-input:focus {
            border-color: #f97316;
            outline: none;
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.2);
        }
        .otp-input.filled {
            border-color: #10b981;
        }
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #64748b;
        }
        .progress-bar {
            height: 4px;
            background-color: #e2e8f0;
            border-radius: 2px;
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            background-color: #f97316;
            transition: width 0.3s;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden w-full max-w-md">
        <div class="bg-gradient-to-r from-orange-500 to-amber-600 p-6 text-white">
            <h1 class="text-2xl font-bold">Reset Your Password</h1>
            <p class="text-blue-100 mt-1">Enter the OTP sent to your email</p>
        </div>
        
        <div class="p-6">
            <!-- OTP Verification Section -->
            <div id="otpSection">
                <div class="flex justify-center mb-6">
                    <div class="w-24 h-24 bg-orange-50 rounded-full flex items-center justify-center">
                        <i class="fas fa-envelope text-orange-500 text-4xl"></i>
                    </div>
                </div>
                
                <div class="text-center mb-6">
                    <p class="text-gray-600">We've sent a 6-digit code to <span class="font-semibold">user@example.com</span></p>
                    <button class="text-orange-500 hover:text-orange-700 text-sm font-medium mt-2">Resend OTP</button>
                </div>
                
                <div class="flex justify-center mb-8">
                    <input type="text" maxlength="1" class="otp-input" data-index="0" autofocus>
                    <input type="text" maxlength="1" class="otp-input" data-index="1">
                    <input type="text" maxlength="1" class="otp-input" data-index="2">
                    <input type="text" maxlength="1" class="otp-input" data-index="3">
                    <input type="text" maxlength="1" class="otp-input" data-index="4">
                    <input type="text" maxlength="1" class="otp-input" data-index="5">
                </div>
                
                <div class="progress-bar mb-2">
                    <div id="otpProgress" class="progress-fill" style="width: 0%"></div>
                </div>
                <p class="text-xs text-gray-500 text-center mb-6">Verifying OTP...</p>
                
                <button id="verifyBtn" class="w-full bg-gray-300 text-white py-3 rounded-lg font-medium cursor-not-allowed" disabled>
                    Verify OTP
                </button>
            </div>
            
            <!-- Password Reset Section (hidden initially) -->
            <div id="passwordSection" class="hidden">
                <div class="flex justify-center mb-6">
                    <div class="w-24 h-24 bg-green-50 rounded-full flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-500 text-4xl"></i>
                    </div>
                </div>
                
                <div class="text-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">OTP Verified!</h2>
                    <p class="text-gray-600 mt-1">Now set your new password</p>
                </div>
                
                <div class="space-y-4 mb-6">
                    <div class="relative">
                        <label for="newPassword" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                        <input type="password" id="newPassword" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition" placeholder="Enter new password">
                        <i class="fas fa-eye-slash password-toggle" onclick="togglePassword('newPassword', this)"></i>
                    </div>
                    
                    <div class="relative">
                        <label for="confirmPassword" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                        <input type="password" id="confirmPassword" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition" placeholder="Confirm new password">
                        <i class="fas fa-eye-slash password-toggle" onclick="togglePassword('confirmPassword', this)"></i>
                    </div>
                    
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-yellow-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    Password must be at least 8 characters long and contain a mix of letters, numbers, and symbols.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <button id="resetBtn" class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-lg font-medium transition">
                    Reset Password
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const otpInputs = document.querySelectorAll('.otp-input');
            const verifyBtn = document.getElementById('verifyBtn');
            const otpProgress = document.getElementById('otpProgress');
            const otpSection = document.getElementById('otpSection');
            const passwordSection = document.getElementById('passwordSection');
            const resetBtn = document.getElementById('resetBtn');
            
            let otp = '';
            let verificationInProgress = false;
            
            // OTP input handling
            otpInputs.forEach(input => {
                input.addEventListener('input', function() {
                    const value = this.value;
                    const index = parseInt(this.dataset.index);
                    
                    if (value.length === 1) {
                        this.classList.add('filled');
                        otp = otp.substring(0, index) + value + otp.substring(index + 1);
                        
                        // Auto focus next input
                        if (index < otpInputs.length - 1) {
                            otpInputs[index + 1].focus();
                        }
                    } else {
                        this.classList.remove('filled');
                        otp = otp.substring(0, index) + otp.substring(index + 1);
                    }
                    
                    // Update verify button state
                    if (otp.length === 6) {
                        verifyBtn.disabled = false;
                        verifyBtn.classList.remove('bg-gray-300', 'cursor-not-allowed');
                        verifyBtn.classList.add('bg-orange-500', 'hover:bg-orange-600', 'cursor-pointer');
                    } else {
                        verifyBtn.disabled = true;
                        verifyBtn.classList.add('bg-gray-300', 'cursor-not-allowed');
                        verifyBtn.classList.remove('bg-orange-500', 'hover:bg-orange-600', 'cursor-pointer');
                    }
                });
                
                // Handle backspace
                input.addEventListener('keydown', function(e) {
                    if (e.key === 'Backspace' && this.value === '' && this.dataset.index > 0) {
                        otpInputs[parseInt(this.dataset.index) - 1].focus();
                    }
                });
            });
            
            // Verify OTP button click
            verifyBtn.addEventListener('click', function() {
                if (verificationInProgress) return;
                
                verificationInProgress = true;
                verifyBtn.disabled = true;
                verifyBtn.textContent = 'Verifying...';
                
                // Simulate OTP verification progress
                let progress = 0;
                const interval = setInterval(() => {
                    progress += 10;
                    otpProgress.style.width = `${progress}%`;
                    
                    if (progress >= 100) {
                        clearInterval(interval);
                        setTimeout(() => {
                            // Simulate successful verification
                            otpSection.classList.add('hidden');
                            passwordSection.classList.remove('hidden');
                        }, 500);
                    }
                }, 200);
            });
            
            // Reset password button click
            resetBtn.addEventListener('click', function() {
                const newPassword = document.getElementById('newPassword').value;
                const confirmPassword = document.getElementById('confirmPassword').value;
                
                if (!newPassword || !confirmPassword) {
                    alert('Please fill in both password fields');
                    return;
                }
                
                if (newPassword !== confirmPassword) {
                    alert('Passwords do not match');
                    return;
                }
                
                if (newPassword.length < 8) {
                    alert('Password must be at least 8 characters long');
                    return;
                }
                
                // Simulate password reset
                resetBtn.disabled = true;
                resetBtn.textContent = 'Processing...';
                
                setTimeout(() => {
                    // Show success message
                    const successHTML = `
                        <div class="text-center py-8">
                            <div class="w-20 h-20 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-check-circle text-green-500 text-3xl"></i>
                            </div>
                            <h2 class="text-xl font-bold text-gray-800 mb-2">Password Reset Successful!</h2>
                            <p class="text-gray-600 mb-6">You can now login with your new password</p>
                            <button onclick="window.location.href='login.html'" class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-lg font-medium transition">
                                Back to Login
                            </button>
                        </div>
                    `;
                    
                    passwordSection.innerHTML = successHTML;
                }, 1500);
            });
        });
        
        function togglePassword(inputId, icon) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        }
    </script>
</body>
</html>