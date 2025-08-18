<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSCET Quiz App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --color-primary: #F97316;  
            --color-primary-hover: #EA580C;
            --color-secondary: #FF8C00;  
            --color-accent: #FFA500; 
            --color-background: #FFFFFF; 
            --color-surface: #F3F4F6; 
            --text: #1F2937; 
            --text-secondary: #D4A373; 
            --card-border: #D1D5DB; 
            --shadow: rgba(209, 213, 219, 0.3); 
            --gradient-primary: linear-gradient(135deg, #F97316 0%, #EA580C 100%);
            --gradient-secondary: linear-gradient(135deg, #FF8C00 0%, #E67700 100%);
            --gradient-accent: linear-gradient(135deg, #FFA500 0%, #FF7F00 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--color-background);
            background-image: 
                radial-gradient(circle at 20% 80%, rgba(249, 115, 22, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 140, 0, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(255, 165, 0, 0.1) 0%, transparent 50%);
            color: var(--text);
            overflow-x: hidden;
            position: relative;
        }

        
        .bg-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .particle {
            position: absolute;
            background: var(--gradient-primary);
            border-radius: 50%;
            opacity: 0.1;
            animation: float 20s infinite linear;
        }

        .particle:nth-child(1) { width: 80px; height: 80px; top: 10%; left: 10%; animation-delay: 0s; }
        .particle:nth-child(2) { width: 60px; height: 60px; top: 20%; left: 80%; animation-delay: -5s; }
        .particle:nth-child(3) { width: 100px; height: 100px; top: 60%; left: 20%; animation-delay: -10s; }
        .particle:nth-child(4) { width: 40px; height: 40px; top: 80%; left: 90%; animation-delay: -15s; }
        .particle:nth-child(5) { width: 70px; height: 70px; top: 40%; left: 60%; animation-delay: -7s; }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-30px) rotate(120deg); }
            66% { transform: translateY(15px) rotate(240deg); }
        }

        /* Enhanced animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-100px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        @keyframes glow {
            0%, 100% { box-shadow: 0 0 20px rgba(249, 115, 22, 0.3); }
            50% { box-shadow: 0 0 40px rgba(249, 115, 22, 0.6), 0 0 60px rgba(249, 115, 22, 0.4); }
        }

        /* Component styles */
        .card {
            background: var(--color-surface);
            background-image: linear-gradient(135deg, var(--color-surface) 0%, rgba(249, 115, 22, 0.05) 100%);
            border: 1px solid var(--card-border);
            box-shadow: 
                0 10px 25px var(--shadow),
                0 0 0 1px rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 
                0 25px 50px rgba(209, 213, 219, 0.4),
                0 0 0 1px rgba(255, 255, 255, 0.1);
        }

        .welcome-card {
            animation: scaleIn 1s ease-out 0.3s both;
            margin-top: -300px;
        }

        .btn-primary {
            background: var(--gradient-primary);
            border: none;
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(249, 115, 22, 0.4);
            animation: glow 2s infinite;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:active {
            transform: translateY(-1px);
        }

        .feature-card {
            animation: fadeInUp 1s ease-out both;
            position: relative;
            overflow: hidden;
        }

        .feature-card:nth-child(1) { animation-delay: 0.6s; }
        .feature-card:nth-child(2) { animation-delay: 0.8s; }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--gradient-accent);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 1rem;
            background: var(--gradient-secondary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse 3s infinite;
        }

        .stats-container {
            animation: slideInLeft 1s ease-out 1s both;
        }

        .cta-section {
            animation: slideInRight 1s ease-out 1.2s both;
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .shape {
            position: absolute;
            opacity: 0.1;
            animation: floatShape 15s infinite linear;
        }

        .shape:nth-child(1) {
            width: 100px;
            height: 100px;
            background: var(--gradient-primary);
            border-radius: 30%;
            top: 10%;
            left: -10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 80px;
            height: 80px;
            background: var(--gradient-secondary);
            border-radius: 50%;
            top: 70%;
            left: -10%;
            animation-delay: -5s;
        }

        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            background: var(--gradient-accent);
            border-radius: 20%;
            top: 40%;
            left: -10%;
            animation-delay: -10s;
        }

        @keyframes floatShape {
            0% {
                transform: translateX(0) translateY(0) rotate(0deg);
            }
            100% {
                transform: translateX(100vw) translateY(-100px) rotate(360deg);
            }
        }

        .section-divider {
            height: 2px;
            background: var(--gradient-primary);
            margin: 3rem 0;
            animation: pulse 2s infinite;
        }

        .logo {
            position: absolute;
            top: 1rem;
            left: 1rem;
            width: 250px;
            height: auto;
            z-index: 20;
        }

         
        .overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 30vh;
            z-index: 100;
            background: linear-gradient(
                0deg,
                rgba(255, 255, 255, 1) 75%,
                rgba(255, 255, 255, 0.9) 80%,
                rgba(255, 255, 255, 0.25) 95%,
                rgba(255, 255, 255, 0) 100%
            );
        }

        .text {
            font-family: "Yanone Kaffeesatz", sans-serif;
            font-size: 100px;
            display: flex;
            position: relative;
            top: -10vh;
            left: 49%;
            transform: translateX(-50%);
            user-select: none;
            z-index: 10;
        }

        .wrapper {
            padding-left: 20px;
            padding-right: 20px;
            padding-top: 20px;
        }

        .letter {
            transition: ease-out 1s;
            transform: translateY(40%);
            color: var(--color-primary);
        }

        .wrapper:hover .letter {
            transform: translateY(-200%);
        }

         
        @media (max-width: 768px) {
            .text {
                font-size: 50px;
            }
            
            .card {
                margin: 1rem;
            }

            .logo {
                width: 120px;
            }
        }

         
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--color-background);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            animation: fadeOut 1s ease-out 2s forwards;
        }
  
        .loading-spinner {
            width: 60px;
            height: 60px;
            border: 3px solid rgba(249, 115, 22, 0.3);
            border-top: 3px solid #F97316;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes fadeOut {
            to {
                opacity: 0;
                visibility: hidden;
            }                                      
        }
    </style>
</head>
<body class="min-h-screen flex flex-col font-sans relative">
    <!-- Animated background particles -->
    <div class="bg-particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <!-- Floating shapes -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <header class="words w-full text-center py-16 relative z-10">
        <div class="overlay"></div>
        <div class="text">
            <div class="wrapper">
                <div class="letter">N</div>
            </div>
            <div class="wrapper">
                <div class="letter">S</div>
            </div>
            <div class="wrapper">
                <div class="letter">C</div>
            </div>
            <div class="wrapper">
                <div class="letter">E</div>
            </div>
            <div class="wrapper">
                <div class="letter">T</div>
            </div>
            <div class="wrapper">
                <div class="letter">&nbsp;</div>
            </div>
            <div class="wrapper">
                <div class="letter">Q</div>
            </div>
            <div class="wrapper">
                <div class="letter">U</div>
            </div>
            <div class="wrapper">
                <div class="letter">I</div>
            </div>
            <div class="wrapper">
                <div class="letter">Z</div>
            </div>
            <div class="wrapper">
                <div class="letter">&nbsp;</div>
            </div>
            <div class="wrapper">
                <div class="letter">A</div>
            </div>
            <div class="wrapper">
                <div class="letter">P</div>
            </div>
            <div class="wrapper">
                <div class="letter">P</div>
            </div>
        </div>
        <div class="section-divider max-w-md mx-auto"></div>
    </header>

    <main class="flex flex-col items-center justify-center flex-grow w-full max-w-6xl px-4 mx-auto relative z-10">
        <!-- Welcome Section -->
        <section class="welcome-card card rounded-xl p-10 text-center w-full mb-8">
            <h2 class="text-3xl font-bold mb-6 text-gray-900">
                Welcome to the NSCET CampusCoder
            </h2>
            <p class="text-xl mb-10 text-gray-600 leading-relaxed max-w-2xl mx-auto">
                Test your coding skills or manage quizzes with our interactive platform.
                Choose your role below to get started!
            </p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <a href=".../../client/stu_index.php" class="btn-primary text-white font-semibold py-4 px-8 rounded-xl text-xl transform transition-all duration-300">
                    Student Portal
                </a>
                <a href=".../../client/sta_index.php" class="btn-primary text-white font-semibold py-4 px-8 rounded-xl text-xl transform transition-all duration-300">
                    Staff Portal
                </a>
            </div>
        </section>
    </main>

    <?php include('./footer.php') ?>

    <script>

        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Add stagger animation to cards
            const cards = document.querySelectorAll('.card');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }, index * 100);
                    }
                });
            });

            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.6s ease';
                observer.observe(card);
            });

            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const particles = document.querySelectorAll('.particle');
                particles.forEach((particle, index) => {
                    const speed = 0.5 + (index * 0.1);
                    particle.style.transform = `translateY(${scrolled * speed}px)`;
                });
            });
        });
    </script>
</body>
</html>