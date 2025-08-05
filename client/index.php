<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal - Login & Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        :root {
            --primary-orange: #FF6B35;
            --secondary-orange: #FF9A3C;
            --dark-orange: #E05D2E;
            --light-orange: #FFB347;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
       
            background-blend-mode: overlay;
            position: relative;
            overflow-x: hidden;
        }
        
        .form-container {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .toggle-btn {
            background-color: transparent;
            color: var(--primary-orange);
        }
        
        .toggle-btn.active {
            background-color: var(--primary-orange);
            color: white;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-orange), var(--light-orange));
            background-size: 200% auto;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-position: right center;
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.4);
            transform: translateY(-2px);
        }
        
        .input-field {
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
        }
        
        .input-field:focus {
            border-color: var(--primary-orange);
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.2);
        }
        
        .grid-form {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }
        
        .avatar-container {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin: 0 auto;
            border: 3px solid var(--primary-orange);
            position: relative;
            cursor: pointer;
        }
        
        .avatar-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .avatar-placeholder {
            font-size: 2.5rem;
            color: var(--primary-orange);
        }
        
        .avatar-upload {
            position: absolute;
            bottom: 0;
            right: 0;
            background: var(--primary-orange);
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
        }
        
        .animate-fade {
            animation: fadeIn 0.5s ease-in-out;
        }
        
        .animate-fade-in {
            animation: fadeInUp 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .input-field {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .input-field:focus {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(255, 107, 53, 0.2), 0 2px 4px -1px rgba(255, 107, 53, 0.1);
        }
        
        .password-strength {
            height: 4px;
            background: #e5e7eb;
            margin-top: 0.5rem;
            border-radius: 2px;
            overflow: hidden;
        }
        
        .strength-bar {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
        }
        
        @media (max-width: 768px) {
            .grid-form {
                grid-template-columns: 1fr;
            }
            
            .toggle-btn {
                padding: 0.75rem 1rem;
                font-size: 0.875rem;
            }
        }
    </style>
</head>
<body>
    <!-- Wave Background Section -->
    <section>
        <div class="wave">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </section>

    <div class="w-full max-w-4xl mx-auto relative z-10">
        <!-- Toggle Buttons -->
        <div class="flex mb-8 mt-5 rounded-full bg-white shadow-md overflow-hidden w-fit mx-auto">
            <button id="loginToggle" class="toggle-btn active px-6 py-2 font-medium rounded-full transition-all duration-300">Login</button>
            <button id="registerToggle" class="toggle-btn px-6 py-2 font-medium rounded-full transition-all duration-300">Register</button>
        </div>

        <!-- Login Form -->
        <div id="loginForm" class="form-container rounded-2xl shadow-xl p-8 animate-fade w-full max-w-md mx-auto transform transition-all duration-500 hover:scale-[1.01] hover:shadow-2xl">
            <div class="text-center mb-8 animate-fade-in">
                <h1 class="text-3xl font-bold text-[var(--color-primary)] mb-2">Welcome Back!</h1>
            </div>

            <form class="space-y-6 group">
                <div>
                    <label for="loginEmail" class="block text-sm font-medium text-gray-700 mb-1">Student ID </label>
                    <div class="relative">
                        <input type="text" id="loginEmail" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none" placeholder="student@university.edu">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="loginPassword" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <input type="password" id="loginPassword" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none" placeholder="••••••••">
                        <button type="button" class="password-toggle absolute inset-y-0 right-0 flex items-center pr-3" onclick="togglePassword('loginPassword', 'loginEyeIcon')">
                            <i id="loginEyeIcon" class="fas fa-eye text-gray-400 hover:text-[var(--color-primary)]"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    

                    <a href="#" class="text-sm font-medium text-[var(--color-primary)] hover:text-[var(--color-primary-hover)]">Forgot password?</a>
                </div>

                <button type="submit" class="btn-primary w-full py-3 px-4 rounded-lg text-white font-semibold shadow-md transition-all duration-300 hover:-translate-y-1 active:translate-y-0 active:scale-95">
                    <span class="inline-block transition-transform duration-300 group-hover:translate-x-1">
                        Login  <i class="fas fa-arrow-right ml-2 transition-all duration-300 opacity-0 group-hover:opacity-100"></i>
                    </span>
                </button>

                
            </form>
        </div>

        <!-- Register Form  -->
        <div id="registerForm" class="form-container rounded-2xl shadow-xl p-8 hidden animate-fade">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-[var(--color-primary)] mb-2">Create Account</h1>
            </div>


            <form class="space-y-6">
                <div class="grid-form">
                    <div>
                        <label for="studentId" class="block text-sm font-medium text-gray-700 mb-1">Student ID*</label>
                        <input type="text" id="studentId" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none" placeholder="STD123456" required>
                    </div>
                    <div>
                        <label for="firstName" class="block text-sm font-medium text-gray-700 mb-1">First Name*</label>
                        <input type="text" id="firstName" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none" placeholder="John" required>
                    </div>                     

                    
                    <div>
                        <label for="registerEmail" class="block text-sm font-medium text-gray-700 mb-1">Email*</label>
                        <input type="email" id="registerEmail" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none" placeholder="student@university.edu" required>
                    </div>

                     <div>
                        <label for="year" class="block text-sm font-medium text-gray-700 mb-1">Year*</label>
                        <input type="text" id="year" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none" placeholder="year" required>
                    </div>
 <div>
                        <label for="department" class="block text-sm font-medium text-gray-700 mb-1">Department*</label>
                        <input type="text" id="department" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none" placeholder="department" required>
                    </div>

                    <div>
                        <label for="registerPassword" class="block text-sm font-medium text-gray-700 mb-1">Password*</label>
                        <div class="relative">
                            <input type="password" id="registerPassword" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none" placeholder="••••••••" required oninput="checkPasswordStrength()">
                            <button type="button" class="password-toggle absolute inset-y-0 right-0 flex items-center pr-3" onclick="togglePassword('registerPassword', 'registerEyeIcon')">
                                <i id="registerEyeIcon" class="fas fa-eye text-gray-400 hover:text-[var(--color-primary)]"></i>
                            </button>
                        </div>
                        <div class="password-strength">
                            <div id="strengthBar" class="strength-bar"></div>
                        </div>
                        <p id="passwordHint" class="text-xs text-gray-500 mt-1"></p>
                    </div>

                    
                </div>

               

                <div class="flex justify-center">
                    <button type="submit" class="btn-primary py-3 px-4 rounded-lg text-white font-semibold shadow-md transition-all duration-300">
                    Create Account
                </button>
                </div>

                
            </form>
        </div>
    </div>

    <script>
        // Toggle between login and register forms
        function showRegister() {
            document.getElementById('loginForm').classList.add('hidden');
            document.getElementById('registerForm').classList.remove('hidden');
            document.getElementById('loginToggle').classList.remove('active');
            document.getElementById('registerToggle').classList.add('active');
        }

        function showLogin() {
            document.getElementById('registerForm').classList.add('hidden');
            document.getElementById('loginForm').classList.remove('hidden');
            document.getElementById('registerToggle').classList.remove('active');
            document.getElementById('loginToggle').classList.add('active');
        }

        // Add event listeners to toggle buttons
        document.getElementById('loginToggle').addEventListener('click', showLogin);
        document.getElementById('registerToggle').addEventListener('click', showRegister);

        // Password visibility toggle
        function togglePassword(inputId, eyeIconId) {
            const input = document.getElementById(inputId);
            const eyeIcon = document.getElementById(eyeIconId);

            if (input.type === 'password') {
                input.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }

            // Check password match when toggling confirm password visibility
            if (inputId === 'confirmPassword' || inputId === 'registerPassword') {
                checkPasswordMatch();
            }
        }

        // Avatar preview
        function previewAvatar(event) {
            const input = event.target;
            const preview = document.getElementById('avatarPreview');
            const placeholder = document.getElementById('avatarPlaceholder');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        // Password strength checker
        function checkPasswordStrength() {
            const password = document.getElementById('registerPassword').value;
            const strengthBar = document.getElementById('strengthBar');
            const hint = document.getElementById('passwordHint');

            // Reset
            strengthBar.style.width = '0%';
            strengthBar.style.backgroundColor = '';
            hint.textContent = '';

            if (!password) return;

            // Calculate strength
            let strength = 0;
            let messages = [];

            // Length check
            if (password.length >= 8) strength += 25;
            if (password.length >= 12) strength += 15;

            // Complexity checks
            if (/[A-Z]/.test(password)) strength += 15; // Uppercase
            if (/[a-z]/.test(password)) strength += 15; // Lowercase
            if (/[0-9]/.test(password)) strength += 15; // Numbers
            if (/[^A-Za-z0-9]/.test(password)) strength += 15; // Special chars

            // Cap at 100
            strength = Math.min(strength, 100);

            // Update UI
            strengthBar.style.width = strength + '%';

            if (strength < 40) {
                strengthBar.style.backgroundColor = '#ef4444'; // red
                hint.textContent = 'Weak password';
                hint.className = 'text-xs text-red-500 mt-1';
            } else if (strength < 70) {
                strengthBar.style.backgroundColor = '#f59e0b'; // amber
                hint.textContent = 'Moderate password';
                hint.className = 'text-xs text-amber-500 mt-1';
            } else {
                strengthBar.style.backgroundColor = '#10b981'; // emerald
                hint.textContent = 'Strong password';
                hint.className = 'text-xs text-emerald-500 mt-1';
            }

            // Check password match
            checkPasswordMatch();
        }

        // Check if passwords match
        function checkPasswordMatch() {
            const password = document.getElementById('registerPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const match = document.getElementById('passwordMatch');
            const mismatch = document.getElementById('passwordMismatch');

            if (!password || !confirmPassword) {
                match.classList.add('hidden');
                mismatch.classList.add('hidden');
                return;
            }

            if (password === confirmPassword) {
                match.classList.remove('hidden');
                mismatch.classList.add('hidden');
            } else {
                match.classList.add('hidden');
                mismatch.classList.remove('hidden');
            }
        }

        // Add event listeners for password matching
        document.getElementById('confirmPassword').addEventListener('input', checkPasswordMatch);

        // Form validation
        document.querySelector('#loginForm form').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;

            if (!email || !password) {
                alert('Please fill in all fields');
                return;
            }

            // Simulate login process
            alert('Login successful! Redirecting to dashboard...');
            // window.location.href = 'dashboard.html';
        });

        document.querySelector('#registerForm form').addEventListener('submit', function(e) {
            e.preventDefault();
            const password = document.getElementById('registerPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const termsChecked = document.getElementById('terms').checked;
            const year = document.getElementById('year').value;
            const department = document.getElementById('department').value;

            // Check required fields
            const requiredFields = ['firstName', 'lastName', 'studentId', 'dob', 'registerEmail'];
            for (const fieldId of requiredFields) {
                if (!document.getElementById(fieldId).value) {
                    alert(`Please fill in the ${fieldId.replace(/([A-Z])/g, ' $1').toLowerCase()} field`);
                    return;
                }
            }

            if (!year) {
                alert('Please select your academic year');
                return;
            }

            if (!department) {
                alert('Please select your department');
                return;
            }

            if (!termsChecked) {
                alert('Please agree to the terms and conditions');
                return;
            }

            if (password !== confirmPassword) {
                alert('Passwords do not match');
                return;
            }

            // Check password strength
            const strengthBar = document.getElementById('strengthBar');
            const strength = parseInt(strengthBar.style.width) || 0;

            if (strength < 40) {
                if (!confirm('Your password is weak. Are you sure you want to proceed?')) {
                    return;
                }
            }

            // Simulate registration process
            alert('Registration successful! Please check your email for verification.');
            showLogin();
        });
    </script>
</body> 
</html>