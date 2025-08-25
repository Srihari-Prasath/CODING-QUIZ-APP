<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IQ Arena | NSCET</title>
    <script src="https://cdn.tailwindcss.com"></script>
    

   <link rel="stylesheet" href="./assets/css/resource/style.css">
   <link rel="stylesheet" href="./assets/css/home/style.css">

</head>
<body class="min-h-screen flex flex-col font-sans relative">
      <?php include('./launch-overlay.php') ?>

    <div style="position: absolute;left:30px;top:30px;width:180px;height:100px">
        <img src="./assets/img/main/logo.png" alt="">
    </div>
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

    <header class="words w-full text-center py-16 relative z-10 ">
        <div class="overlay"></div>
        <div class="text">
            <div class="wrapper">
                <div class="letter">I</div>
            </div>
            <div class="wrapper">
                <div class="letter">Q</div>
            </div>
             <div class="wrapper">
                <div class="letter"></div>
            </div>
            <div class="wrapper">
                <div class="letter">A</div>
            </div>
              <div class="wrapper">
                <div class="letter">R</div>
            </div>
            <div class="wrapper">
                <div class="letter">E</div>
            </div>
            <div class="wrapper">
                <div class="letter">N</div>
            </div>
           
            <div class="wrapper">
                <div class="letter">A</div>
            </div>
            
        </div>
        <div class="section-divider max-w-md mx-auto"></div>
    </header>

    <main class="flex flex-col items-center justify-center flex-grow w-full max-w-6xl px-4 mx-auto relative z-10">
        <!-- Welcome Section -->
        <section class="welcome-card card rounded-xl p-10 text-center w-full mb-8">
            <h2 class="text-3xl font-bold mb-6 text-white">
                Welcome to the NSCET Quiz App
            </h2>
            <p class="text-xl mb-10 text-gray-300 leading-relaxed max-w-2xl mx-auto">
                Test your coding skills or manage quizzes with our interactive platform.
                Choose your role below to get started!
            </p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <a href="./login.php" class="btn-primary text-white font-semibold py-4 px-8 rounded-xl text-xl transform transition-all duration-300">
                    Portal
                </a>
               
            </div>
        </section>
    </main>

    <?php include('./resource/footer.php') ?>

    <script>
        // Add smooth scrolling and additional interactivity
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

            // Parallax effect for background elements
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