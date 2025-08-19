<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Portal - Login & Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        :root {
            --primary-orange: #FF6B35;
            --light-orange: #FFB347;
        }

        body {
            font-family: 'Poppins', sans-serif;
            position: relative;
            overflow-x: hidden;
            background-color: #f3f4f6;
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
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .toggle-btn { padding: 0.75rem 1rem; font-size: 0.875rem; }
        }
    </style>
</head>

<body>
    <div class="w-full max-w-4xl mx-auto relative z-10 mt-10">
        <!-- Toggle Buttons -->
        <div class="flex mb-8 mt-5 rounded-full bg-white shadow-md overflow-hidden w-fit mx-auto">
            <a href="./stu_index.php"><button id="loginToggle" class="toggle-btn  px-6 py-2 font-medium rounded-full transition-all duration-300">Login</button></a>
            <a href="./register.php"><button id="registerToggle" class="toggle-btn active px-6 py-2 font-medium rounded-full transition-all duration-300">Register</button></a>
        </div>

      

        <!-- Register Form -->
        <div id="registerForm" class="form-container rounded-2xl shadow-xl p-8 animate-fade w-full max-w-md mx-auto">
            <div class="text-center mb-8 animate-fade-in">
                <h1 class="text-3xl font-bold text-[var(--primary-orange)] mb-2">Register Faculty</h1>
            </div>


            <form class="space-y-6">
                <div class="grid-form">
                    <div>
                        <label for="studentId" class="block text-sm font-medium text-gray-700 mb-1">Roll No*</label>
                        <input type="text" id="studentId" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none" placeholder="921022205011" required>
                    </div>
                    <div>
                        <label for="firstName" class="block text-sm font-medium text-gray-700 mb-1">First Name*</label>
                        <input type="text" id="firstName" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none" placeholder="John" required disabled>
                    </div>


                    <div>
                        <label for="registerEmail" class="block text-sm font-medium text-gray-700 mb-1">Email*</label>
                        <input type="email" id="registerEmail" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none" placeholder="student@university.edu" required disabled>
                    </div>

                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700 mb-1">Year*</label>
                        <input type="text" id="year" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none" placeholder="year" required disabled>
                    </div>
                    <div>
                        <label for="department" class="block text-sm font-medium text-gray-700 mb-1">Department*</label>
                        <input type="text" id="department" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none" placeholder="department" required disabled>
                    </div>
            </form>
            <form id="updatePasswordForm">
                <div>
                    <label for="registerPassword" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" id="registerPassword" class="input-field w-full px-4 py-3 rounded-lg focus:outline-none"
                        placeholder="••••••••" required>
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

    <script src="./assets/js/auth/script.js"></script>



    <?php include('./resource/api.php') ?>
    <!-- fetch students -->
    <script>
        document.getElementById('studentId').addEventListener('blur', async () => {
            const rollNo = document.getElementById('studentId').value.trim();
            if (!rollNo) return;

            try {
                const response = await fetch('<?php echo $api; ?>faculty/auth/register.php', {
                    method: 'POST',
                    credentials: 'include',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ full_name, email, password, role: 'faculty', department_id })
                });

                const result = await response.json();

                if (result && result.name) {
                    document.getElementById('firstName').value = result.name || '';
                    document.getElementById('user_id').value = result.user_id || '';
                    document.getElementById('registerEmail').value = result.email || '';
                    document.getElementById('year').value = result.year || '';
                    document.getElementById('department').value = result.department_name || '';
                } else {
                    alert(data.error || "Registration failed.");
                }
            } catch (err) {
                console.error(err);
                alert("Unexpected error occurred.");
            }
        });
    </script>
</body>

</html>
