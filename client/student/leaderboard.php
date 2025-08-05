<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Leaderboard</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="../assets/css/staff/leaderboard.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Add jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <link rel="stylesheet" href="../assets/css/staff/leaderboard.css">
</head>
<body class="min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-orange-400">IT 2nd Year Leaderboard</h1>
                
            </div>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center">
                        <span class="text-indigo-600 font-medium">IT</span>
                    </div>
                    <div>
                        <p class="font-medium text-orange-500">Alex Thompson</p>
                        <p class="text-xs text-gray-500">Faculty</p>
                    </div>
                </div>
                <button class="p-2 rounded-full hover:bg-gray-100 text-gray-500 hover:text-gray-700 transition-colors">
                    <i data-lucide="log-out"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Leaderboard -->
        <div class="bg-white p-8 rounded-lg shadow-md">
            <!-- 1st Place (Centered at Top) -->
            <div class="leaderboard-item rank-1 flex flex-col items-center mb-12 border-none">
                <div class="container">
                    <div class="parallax">
                        <img src="https://returnpath.com/assets/images/backgrounds/background-confetti-xl-arcade.svg">
                        <img src="https://returnpath.com/assets/images/backgrounds/background-confetti-lg-arcade.svg">
                        <img src="https://returnpath.com/assets/images/backgrounds/background-confetti-md-arcade.svg">
                        <img src="https://returnpath.com/assets/images/backgrounds/background-confetti-sm-arcade.svg">
                        <img src="https://returnpath.com/assets/images/backgrounds/background-confetti-xs-arcade.svg">
                    </div>
                </div>
                <img src="../assets/images/leaderboard/one.png" alt="Trophy" class="trophy-img">
                <span class="text-yellow-800 text-xl font-medium mb-2">#1</span>
                <h3 class="leaderboard-name">Naveen</h3>
            </div>

            <!-- 2nd and 3rd Place (Side by Side) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- 2nd Place (Left) -->
                <div class="leaderboard-item rank-2 flex flex-col items-center border-none">
                    <div class="container">
                        <div class="parallax">
                            <img src="https://returnpath.com/assets/images/backgrounds/background-confetti-xl-arcade.svg">
                            <img src="https://returnpath.com/assets/images/backgrounds/background-confetti-lg-arcade.svg">
                            <img src="https://returnpath.com/assets/images/backgrounds/background-confetti-md-arcade.svg">
                            <img src="https://returnpath.com/assets/images/backgrounds/background-confetti-sm-arcade.svg">
                            <img src="https://returnpath.com/assets/images/backgrounds/background-confetti-xs-arcade.svg">
                        </div>
                    </div>
                    <img src="../assets/images/leaderboard/two.png" alt="Medal" class="medal-img">
                    <span class="text-gray-800 text-lg font-medium mb-2">#2</span>
                    <h3 class="leaderboard-name">Sachin</h3>
                </div>

                <!-- 3rd Place (Right) -->
                <div class="leaderboard-item rank-3 flex flex-col items-center border-none">
                    <div class="container">
                        <div class="parallax">
                            <img src="https://returnpath.com/assets/images/backgrounds/background-confetti-xl-arcade.svg">
                            <img src="https://returnpath.com/assets/images/backgrounds/background-confetti-lg-arcade.svg">
                            <img src="https://returnpath.com/assets/images/backgrounds/background-confetti-md-arcade.svg">
                            <img src="https://returnpath.com/assets/images/backgrounds/background-confetti-sm-arcade.svg">
                            <img src="https://returnpath.com/assets/images/backgrounds/background-confetti-xs-arcade.svg">
                        </div>
                    </div>
                    <img src="../assets/images/leaderboard/two.png" alt="Award" class="award-img">
                    <span class="text-amber-800 text-lg font-medium mb-2">#3</span>
                    <h3 class="leaderboard-name">Sri hari Aashwin</h3>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Simulate live updates every 10 seconds
        setInterval(() => {
            console.log("Checking for updates...");
        }, 10000);

        // Confetti Animation Script (Original for Body Background)
        (function ($) {
            var ww = 0,
                wh = 0,
                maxw = 0,
                minw = 0,
                maxh = 0,
                textShadowSupport = true,
                xv = 0,
                colors = ['#f33', '#3f3', '#66f', '#3ff', '#f93', '#ff3', '#c3f'],
                confetti = ["\u2666", "\u2726", "\u25b0"],
                prevTime,
                absMax = 200,
                flakeCount = 0,
                flakes = [],
                xs = [],
                ys = [],
                vs = [],
                hvs = [];

            $(init);

            function init() {
                var initialFlakes = 75,
                    detectSize = function () {
                        ww = $(window).width();
                        wh = $(window).height();
                        maxw = ww + 300;
                        minw = -300;
                        maxh = wh + 300;
                    };
                
                detectSize();
                $(window).resize(detectSize);
                
                if (!$('body').css('textShadow')) {
                    textShadowSupport = false;
                }
                
                while (initialFlakes--) {
                    addFlake(true);
                }
                
                prevTime = Date.now();
                setInterval(move, 50);
            }

            function addFlake(initial) {        
                var $flake = $('<span>' + confetti[Math.floor(Math.random() * confetti.length)] + '</span>').css({
                    display: 'block',
                    position: 'fixed',
                    background: 'transparent',
                    width: 'auto',
                    height: 'auto',
                    margin: '0',
                    padding: '0',
                    textAlign: 'left',
                    zIndex: 9999
                });

                $('body').append($flake);
                flakes.push($flake);
                xs.push(0);
                ys.push(0);
                vs.push(0);
                hvs.push(0);
                flakeCount++;
                resetFlake(flakes.length - 1, initial);
            }

            function removeFlake() {
                $(flakes[0]).remove();
                flakes.shift();
                xs.shift();
                ys.shift();
                vs.shift();
                hvs.shift();
                flakeCount--;
            }

            function resetFlake(i, initial) {
                var color = colors[Math.floor(Math.random() * colors.length)],
                    sizes = [
                        {
                            r: 1.0,
                            css: {
                                fontSize: 15 + Math.floor(Math.random() * 20) + 'px',
                                textShadow: '9999px 0 6px ' + color
                            },
                            v: 4 + Math.floor(Math.random() * 2)
                        },
                        {
                            r: 0.6,
                            css: {
                                fontSize: 50 + Math.floor(Math.random() * 20) + 'px',
                                textShadow: '9999px 0 4px ' + color
                            },
                            v: 12 + Math.floor(Math.random() * 6)
                        },
                        {
                            r: 0.2,
                            css: {
                                fontSize: 90 + Math.floor(Math.random() * 30) + 'px',
                                textShadow: '9999px 0 12px ' + color
                            },
                            v: 24 + Math.floor(Math.random() * 12)
                        },
                        {
                            r: 0.1,
                            css: {
                                fontSize: 150 + Math.floor(Math.random() * 50) + 'px',
                                textShadow: '9999px 0 36px ' + color
                            },
                            v: 40 + Math.floor(Math.random() * 20)
                        }
                    ],
                    $flake = $(flakes[i]),
                    r = Math.random(),
                    s = sizes.length,
                    v,
                    x = (-300 + Math.floor(Math.random() * (ww + 300))),
                    y = (initial) ? (-300 + Math.floor(Math.random() * (wh + 300))) : -300;

                if (textShadowSupport) {
                    $flake.css('textIndent', '-9999px');
                }
                
                while (s--) {
                    if (r < sizes[s].r) {
                        v = sizes[s].v;
                        $flake.css(sizes[s].css);
                        break;
                    }
                }
                
                $flake.css({
                    color: color,
                    left: x + 'px',
                    top: y + 'px'
                });

                $flake.html(confetti[Math.floor(Math.random() * confetti.length)]);
                xs[i] = x;
                ys[i] = y;
                vs[i] = v;
                hvs[i] = Math.round(v * 0.5);
            }
            
            function move() {
                var i = flakeCount,
                    x, y, v, half_v,
                    newTime = Date.now(),
                    diffTime = newTime - prevTime;

                if (diffTime < 55 && flakeCount < absMax) {
                    addFlake();
                } else if (diffTime > 150) {
                    removeFlake();
                }

                prevTime = newTime;

                if (Math.random() > 0.8) {
                    xv += -1 + Math.random() * 2;
                    if (Math.abs(xv) > 3) {
                        xv = 3 * (xv / Math.abs(xv));
                    }
                }
                
                while (i--) {
                    x = xs[i];
                    y = ys[i];
                    v = vs[i];
                    half_v = hvs[i];
                    y += v;
                    x += Math.round(xv * v);
                    x += -half_v + Math.round(Math.random() * v);
                    
                    if (x > maxw) {
                        x = -300;
                    } else if (x < minw) {
                        x = ww;
                    }
                    
                    if (y > maxh) {
                        resetFlake(i);
                    } else {
                        xs[i] = x;
                        ys[i] = y;
                        $(flakes[i]).css({
                            left: x + 'px',
                            top: y + 'px'
                        });
                        
                        if (v >= 6) {
                            $(flakes[i]).animate({rotate: '+=' + half_v + 'deg'}, 0);
                        }
                    }
                }
            }
        })(jQuery);
    </script>
</body>
</html>