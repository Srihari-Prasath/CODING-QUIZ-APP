<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Leaderboard Dashboard</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="../assets/css/staff/leaderboard.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        
        .avatar-badge {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: 600;
            color: white;
        }
        
        .rank-1 .avatar-badge {
            background: linear-gradient(135deg, #fcd34d, #f59e0b);
        }
        
        .rank-2 .avatar-badge {
            background: linear-gradient(135deg, #e5e7eb, #9ca3af);
        }
        
        .rank-3 .avatar-badge {
            background: linear-gradient(135deg, #d4b499, #92400e);
        }
        
        .rank-4 .avatar-badge,
        .rank-5 .avatar-badge,
        .rank-6 .avatar-badge,
        .rank-7 .avatar-badge,
        .rank-8 .avatar-badge,
        .rank-9 .avatar-badge,
        .rank-10 .avatar-badge {
            background: linear-gradient(135deg, #93c5fd, #3b82f6);
        }
        
        .podium-card {
            transition: all 0.3s ease;
        }
        
        .podium-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .leaderboard-item {
            transition: all 0.2s ease;
        }
        
        .leaderboard-item:hover {
            transform: translateX(5px);
        }
        
        .stats-card {
            transition: all 0.3s ease;
        }
        
        .stats-card:hover {
            transform: scale(1.03);
        }
        
        .live-pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
            100% {
                opacity: 1;
            }
        }
    </style>
</head>
<body class="min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-orange-600">Student Dashboard</h1>
                <p class="text-gray-500 text-sm">Track student progress and achievements</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center">
                        <span class="text-indigo-600 font-medium">AT</span>
                    </div>
                    <div>
                        <p class="font-medium text-orange-600">Alex Thompson</p>
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
        <!-- Leaderboard Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div class="mb-4 md:mb-0">
                <h2 class="text-2xl md:text-3xl font-bold text-orange-600 flex items-center">
                    <i data-lucide="trophy" class="text-yellow-500 mr-3"></i>
                    Artificial Intelligence Leaderboard
                </h2>
                <p class="text-gray-500 mt-1">Top performers in your department</p>
            </div>
            <div class="flex items-center bg-green-50 text-green-700 px-4 py-2 rounded-full">
                <i data-lucide="activity" class="w-4 h-4 mr-2 live-pulse"></i>
                <span class="text-sm font-medium">Updated Live</span>
            </div>
        </div>

        <!-- Podium -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <!-- 2nd Place -->
            <div class="podium-card rank-2 bg-white rounded-xl shadow-md p-6 flex flex-col items-center order-1 md:order-1 h-64">
                <div class="flex items-center mb-4">
                    <i data-lucide="medal" class="text-gray-400 w-6 h-6 mr-2"></i>
                    <span class="bg-gray-100 text-gray-800 text-sm font-medium px-3 py-1 rounded-full">#2</span>
                </div>
                <div class="avatar-badge mb-4">BS</div>
                <h3 class="font-semibold text-orange-600 text-center mb-1">Bob Smith</h3>
                <p class="text-gray-500 text-xs text-center mb-4">16 tests completed</p>
                <div class="text-3xl font-bold text-gray-700">92%</div>
                <p class="text-gray-400 text-xs mt-1">Average Score</p>
            </div>

            <!-- 1st Place -->
            <div class="podium-card rank-1 bg-white rounded-xl shadow-lg p-6 flex flex-col items-center order-2 md:order-2 h-72 -mt-4">
                <div class="flex items-center mb-4">
                    <i data-lucide="trophy" class="text-yellow-500 w-6 h-6 mr-2"></i>
                    <span class="bg-yellow-100 text-yellow-800 text-sm font-medium px-3 py-1 rounded-full">#1</span>
                </div>
                <div class="avatar-badge mb-4">AJ</div>
                <h3 class="font-semibold text-orange-600 text-center mb-1">Alice Johnson</h3>
                <p class="text-gray-500 text-xs text-center mb-4">18 tests completed</p>
                <div class="text-4xl font-bold text-gray-800">95%</div>
                <p class="text-gray-400 text-xs mt-1">Average Score</p>
            </div>

            <!-- 3rd Place -->
            <div class="podium-card rank-3 bg-white rounded-xl shadow-md p-6 flex flex-col items-center order-3 md:order-3 h-60">
                <div class="flex items-center mb-4">
                    <i data-lucide="award" class="text-amber-700 w-6 h-6 mr-2"></i>
                    <span class="bg-amber-100 text-amber-800 text-sm font-medium px-3 py-1 rounded-full">#3</span>
                </div>
                <div class="avatar-badge mb-4">CD</div>
                <h3 class="font-semibold text-orange-600 text-center mb-1">Carol Davis</h3>
                <p class="text-gray-500 text-xs text-center mb-4">20 tests completed</p>
                <div class="text-2xl font-bold text-gray-700">89%</div>
                <p class="text-gray-400 text-xs mt-1">Average Score</p>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="stats-card bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-gray-500 text-sm font-medium mb-1">Department Average</h3>
                <div class="text-3xl font-bold text-orange-600 mb-1">84.2%</div>
                <p class="text-gray-400 text-xs">Overall performance</p>
            </div>
            <div class="stats-card bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-gray-500 text-sm font-medium mb-1">Total Students</h3>
                <div class="text-3xl font-bold text-orange-600 mb-1">156</div>
                <p class="text-gray-400 text-xs">Active participants</p>
            </div>
            <div class="stats-card bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-gray-500 text-sm font-medium mb-1">Tests Completed</h3>
                <div class="text-3xl font-bold text-orange-600 mb-1">2,847</div>
                <p class="text-gray-400 text-xs">This semester</p>
            </div>
        </div>
    </main>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Simulate live updates every 10 seconds
        setInterval(() => {
            // In a real app, you would fetch new data here
            console.log("Checking for updates...");
        }, 10000);
    </script>
</body>
</html>