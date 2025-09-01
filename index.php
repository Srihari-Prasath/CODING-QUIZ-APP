<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IQ Arena | NSCET</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./assets/css/resource/style.css">
    <link rel="stylesheet" href="./assets/css/home/style.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            overflow-y: hidden;
        }

        #confetti {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 50;
        }
    </style>

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

</head>

<body>

    <div class="w-full text-center py-4 bg-gradient-to-r from-orange-600 via-orange-500 to-orange-700 text-white font-bold text-lg md:text-2xl shadow-md z-20 relative">
        THENI MELAPETTAI HINDU NADARGAL URAVINMURAI <br>
        NADAR SARASWATHI COLLEGE OF ENGINEERING AND TECHNOLOGY
        <div style="position: absolute;left:30px;top:0;width:140px;height:80px">
            <img src="./assets/img/logo/logo.png" alt="">
        </div>
    </div>

    <!-- Floating shapes -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="top-img flex justify-center">
        <img src="./assets/img/logo/iqarena.png" alt="" width="190px">
    </div>

    <header class="words w-full text-center main-text  relative z-10 ">

        <div class="text">
            <div class="wrapper" data-aos="fade-down-right" data-aos-delay="100">
                <div class="letter">I</div>
            </div>
            <div class="wrapper" data-aos="fade-down-right" data-aos-delay="200">
                <div class="letter">Q</div>
            </div>
            <div class="wrapper" data-aos="fade-down-right" data-aos-delay="300">
                <div class="letter"></div>
            </div>
            <div class="wrapper" data-aos="fade-down-right" data-aos-delay="400">
                <div class="letter">A</div>
            </div>
            <div class="wrapper" data-aos="fade-down-right" data-aos-delay="500">
                <div class="letter">R</div>
            </div>
            <div class="wrapper" data-aos="fade-down-right" data-aos-delay="600">
                <div class="letter">E</div>
            </div>
            <div class="wrapper" data-aos="fade-down-right" data-aos-delay="700">
                <div class="letter">N</div>
            </div>
            <div class="wrapper" data-aos="fade-down-right" data-aos-delay="800">
                <div class="letter">A</div>
            </div>
        </div>
    </header>

    <p class="text-center font-bold text-orange-500 main-sub-text text-4xl text-2xl">
        "The Skill Engine for the Next-Gen Engineers"
    </p>

    <div class="absolute w-full ">
        <?php include('./resource/footer.php') ?>
    </div>


    <main class="flex flex-col items-center justify-center flex-grow max-w-6xl px-4 mx-auto relative z-10"> 
        <a href="./login.php" class="btn-primary text-white font-semibold py-4 px-8 rounded-xl text-xl transform transition-all duration-300">
            Portal
        </a> 
    </main>





    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>