<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Leaderboard Dashboard</title>
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
            box-shadow: 0 4px 6px rgba(245, 158, 11, 0.3);
        }
        
        .rank-2 .avatar-badge {
            background: linear-gradient(135deg, #e5e7eb, #9ca3af);
            box-shadow: 0 4px 6px rgba(156, 163, 175, 0.3);
        }
        
        .rank-3 .avatar-badge {
            background: linear-gradient(135deg, #d4b499, #92400e);
            box-shadow: 0 4px 6px rgba(146, 64, 14, 0.3);
        }
        
        .rank-4 .avatar-badge,
        .rank-5 .avatar-badge,
        .rank-6 .avatar-badge,
        .rank-7 .avatar-badge,
        .rank-8 .avatar-badge,
        .rank-9 .avatar-badge,
        .rank-10 .avatar-badge {
            background: linear-gradient(135deg, #93c5fd, #3b82f6);
            box-shadow: 0 4px 6px rgba(59, 130, 246, 0.3);
        }
        
        .podium-card {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .podium-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .podium-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
        }
        
        .rank-1::before {
            background: linear-gradient(90deg, #fcd34d, #f59e0b);
        }
        
        .rank-2::before {
            background: linear-gradient(90deg, #e5e7eb, #9ca3af);
        }
        
        .rank-3::before {
            background: linear-gradient(90deg, #d4b499, #92400e);
        }
        
        .leaderboard-item {
            transition: all 0.2s ease;
        }
        
        .leaderboard-item:hover {
            transform: translateX(5px);
            background-color: #f9fafb;
        }
        
        .stats-card {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .stats-card:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .stats-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #f97316, #f59e0b);
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
        
        .progress-bar {
            height: 8px;
            border-radius: 4px;
            background-color: #e5e7eb;
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
            border-radius: 4px;
            background: linear-gradient(90deg, #3b82f6, #6366f1);
            transition: width 0.6s ease;
        }
        
        .floating-trophy {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
            100% {
                transform: translateY(0px);
            }
        }
        
        .glow {
            box-shadow: 0 0 15px rgba(245, 158, 11, 0.5);
        }
        
        .highlight-card {
            background: linear-gradient(135deg, rgba(253, 230, 138, 0.2), rgba(254, 243, 199, 0.2));
            border: 1px solid rgba(253, 230, 138, 0.5);
        }
        
        .tab-button.active {
            color: #ea580c;
            border-color: #ea580c;
        }
        
        .tab-content {
            transition: opacity 0.3s ease;
        }
    </style>
</head>
<body class="min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-10">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="bg-orange-100 p-2 rounded-lg">
                    <i data-lucide="brain" class="w-6 h-6 text-orange-600"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-orange-600">Admin Dashboard</h1>
                    <p class="text-gray-500 text-sm">Monitor all department activities</p>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="hidden md:block">
                    <div class="flex items-center space-x-2 bg-orange-50 px-3 py-1 rounded-full">
                        <i data-lucide="calendar" class="w-4 h-4 text-orange-500"></i>
                        
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center relative">
                        <span class="text-indigo-600 font-medium">AT</span>
                        <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="hidden md:block">
                        <p class="font-medium text-orange-600">Prof. Alex Thompson</p>
                        <p class="text-xs text-gray-500">Admin</p>
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
        <!-- Department Tabs -->
        <div class="mb-8">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8">
                    <button class="tab-button active border-orange-500 text-orange-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-tab="ai">
                        AI Department
                    </button>
                    <button class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-tab="cs">
                        Computer Science
                    </button>
                    <button class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-tab="it">
                        Information Technology
                    </button>
                </nav>
            </div>
        </div>

        <!-- HODs Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-orange-600 mb-4">AI Department HOD</h3>
                <div class="flex items-center">
                    <div class="w-16 h-16 rounded-full bg-indigo-100 flex items-center justify-center mr-4">
                        <span class="text-indigo-600 text-xl font-medium">AT</span>
                    </div>
                    <div>
                        <p class="font-medium">Prof. Alex Thompson</p>
                        <p class="text-sm text-gray-500">12 years experience</p>
                        <p class="text-sm text-gray-500 mt-1">alex.thompson@university.edu</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-orange-600 mb-4">CS Department HOD</h3>
                <div class="flex items-center">
                    <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                        <span class="text-blue-600 text-xl font-medium">MJ</span>
                    </div>
                    <div>
                        <p class="font-medium">Prof. Michael Johnson</p>
                        <p class="text-sm text-gray-500">15 years experience</p>
                        <p class="text-sm text-gray-500 mt-1">michael.johnson@university.edu</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-orange-600 mb-4">IT Department HOD</h3>
                <div class="flex items-center">
                    <div class="w-16 h-16 rounded-full bg-purple-100 flex items-center justify-center mr-4">
                        <span class="text-purple-600 text-xl font-medium">SW</span>
                    </div>
                    <div>
                        <p class="font-medium">Prof. Sarah Williams</p>
                        <p class="text-sm text-gray-500">10 years experience</p>
                        <p class="text-sm text-gray-500 mt-1">sarah.williams@university.edu</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Department Leaderboards -->
        <div class="tab-content active" id="ai-tab">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                <h2 class="text-2xl font-bold text-orange-600 flex items-center">
                    <i data-lucide="cpu" class="text-orange-500 mr-3"></i>
                    AI Department Leaderboard
                </h2>
            </div>
            <!-- AI Department Podium (same as before but with AI students) -->
        </div>

        <div class="tab-content hidden" id="cs-tab">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                <h2 class="text-2xl font-bold text-orange-600 flex items-center">
                    <i data-lucide="code" class="text-blue-500 mr-3"></i>
                    CS Department Leaderboard
                </h2>
            </div>
            <!-- CS Department Podium -->
        </div>

        <div class="tab-content hidden" id="it-tab">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                <h2 class="text-2xl font-bold text-orange-600 flex items-center">
                    <i data-lucide="database" class="text-purple-500 mr-3"></i>
                    IT Department Leaderboard
                </h2>
            </div>
            <!-- IT Department Podium -->
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
                <div class="absolute bottom-4 left-4 text-xs text-gray-400">
                    <i data-lucide="trending-up" class="w-4 h-4 text-green-500 inline mr-1"></i> +2.5% this week
                </div>
            </div>

            <!-- 1st Place -->
            <div class="podium-card rank-1 bg-white rounded-xl shadow-lg p-6 flex flex-col items-center order-2 md:order-2 h-72 -mt-4 glow">
                <div class="flex items-center mb-4">
                    <i data-lucide="crown" class="text-yellow-500 w-6 h-6 mr-2"></i>
                    <span class="bg-yellow-100 text-yellow-800 text-sm font-medium px-3 py-1 rounded-full">TOP PERFORMER</span>
                </div>
                <div class="avatar-badge mb-4">AJ</div>
                <h3 class="font-semibold text-orange-600 text-center mb-1">Alice Johnson</h3>
                <p class="text-gray-500 text-xs text-center mb-4">18 tests completed</p>
                <div class="text-4xl font-bold text-gray-800">95%</div>
                <p class="text-gray-400 text-xs mt-1">Average Score</p>
                <div class="absolute bottom-4 left-4 text-xs text-gray-400">
                    <i data-lucide="award" class="w-4 h-4 text-yellow-500 inline mr-1"></i> 5 perfect scores
                </div>
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
                <div class="absolute bottom-4 left-4 text-xs text-gray-400">
                    <i data-lucide="clock" class="w-4 h-4 text-blue-500 inline mr-1"></i> Fastest completion time
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="stats-card bg-white rounded-xl shadow-sm p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-gray-500 text-sm font-medium mb-1">Department Average</h3>
                        <div class="text-3xl font-bold text-orange-600 mb-1">84.2%</div>
                        <p class="text-gray-400 text-xs">Overall performance</p>
                    </div>
                    <div class="bg-orange-100 p-2 rounded-lg">
                        <i data-lucide="bar-chart-2" class="w-5 h-5 text-orange-600"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex justify-between text-xs text-gray-500 mb-1">
                        <span>Lowest: 62%</span>
                        <span>Highest: 95%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 84.2%"></div>
                    </div>
                </div>
            </div>
            <div class="stats-card bg-white rounded-xl shadow-sm p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-gray-500 text-sm font-medium mb-1">Total Students</h3>
                        <div class="text-3xl font-bold text-orange-600 mb-1">156</div>
                        <p class="text-gray-400 text-xs">Active participants</p>
                    </div>
                    <div class="bg-orange-100 p-2 rounded-lg">
                        <i data-lucide="users" class="w-5 h-5 text-orange-600"></i>
                    </div>
                </div>
                <div class="mt-4 flex space-x-2">
                    <div class="flex items-center text-xs text-gray-500">
                        <i data-lucide="chevrons-up" class="w-4 h-4 text-green-500 mr-1"></i>
                        <span>+12 this month</span>
                    </div>
                </div>
            </div>
            <div class="stats-card bg-white rounded-xl shadow-sm p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-gray-500 text-sm font-medium mb-1">Tests Completed</h3>
                        <div class="text-3xl font-bold text-orange-600 mb-1">2,847</div>
                        <p class="text-gray-400 text-xs">This semester</p>
                    </div>
                    <div class="bg-orange-100 p-2 rounded-lg">
                        <i data-lucide="clipboard-check" class="w-5 h-5 text-orange-600"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center text-xs text-gray-500">
                        <i data-lucide="zap" class="w-4 h-4 text-yellow-500 mr-1"></i>
                        <span>Avg. 35 tests/student</span>
                    </div>
                </div>
            </div>
            
        </div>

        <!-- Full Leaderboard -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-semibold text-orange-600">Full Leaderboard</h3>
                <div class="flex items-center space-x-2">
                    <div class="relative">
                        <input type="text" placeholder="Search students..." class="pl-8 pr-4 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-200 focus:border-orange-300">
                        <i data-lucide="search" class="w-4 h-4 text-gray-400 absolute left-3 top-2.5"></i>
                    </div>
                    <button class="p-2 rounded-lg hover:bg-gray-50">
                        <i data-lucide="download" class="w-5 h-5 text-gray-500"></i>
                    </button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rank</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tests Completed</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Average Score</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Activity</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Row 1 -->
                        <tr class="leaderboard-item hover:bg-orange-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                        <span class="text-yellow-800 font-medium">1</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="avatar-badge">AJ</div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-orange-600">Alice Johnson</div>
                                        <div class="text-sm text-gray-500">CS-2048</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="w-32">
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: 95%"></div>
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">95% complete</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">18</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">95%</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2 hours ago</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                View Only
                            </td>
                        </tr>
                        <!-- Row 2 -->
                        <tr class="leaderboard-item hover:bg-orange-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                        <span class="text-gray-800 font-medium">2</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="avatar-badge">BS</div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-orange-600">Bob Smith</div>
                                        <div class="text-sm text-gray-500">CS-2049</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="w-32">
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: 92%"></div>
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">92% complete</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">16</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">92%</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">5 hours ago</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="text-orange-600 hover:text-orange-900 mr-3">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                </button>
                                <button class="text-blue-600 hover:text-blue-900">
                                    <i data-lucide="message-square" class="w-4 h-4"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Row 3 -->
                        <tr class="leaderboard-item hover:bg-orange-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center">
                                        <span class="text-amber-800 font-medium">3</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="avatar-badge">CD</div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-orange-600">Carol Davis</div>
                                        <div class="text-sm text-gray-500">CS-2050</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="w-32">
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: 89%"></div>
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">89% complete</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">20</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">89%</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Yesterday</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="text-orange-600 hover:text-orange-900 mr-3">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                </button>
                                <button class="text-blue-600 hover:text-blue-900">
                                    <i data-lucide="message-square" class="w-4 h-4"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Row 4 -->
                        <tr class="leaderboard-item hover:bg-orange-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <span class="text-blue-800 font-medium">4</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="avatar-badge">EM</div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-orange-600">Ethan Miller</div>
                                        <div class="text-sm text-gray-500">CS-2051</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="w-32">
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: 87%"></div>
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">87% complete</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">87%</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Yesterday</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="text-orange-600 hover:text-orange-900 mr-3">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                </button>
                                <button class="text-blue-600 hover:text-blue-900">
                                    <i data-lucide="message-square" class="w-4 h-4"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Row 5 -->
                        <tr class="leaderboard-item hover:bg-orange-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <span class="text-blue-800 font-medium">5</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="avatar-badge">SW</div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-orange-600">Sarah Wilson</div>
                                        <div class="text-sm text-gray-500">CS-2052</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="w-32">
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: 85%"></div>
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">85% complete</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">14</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">85%</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2 days ago</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="text-orange-600 hover:text-orange-900 mr-3">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                </button>
                                <button class="text-blue-600 hover:text-blue-900">
                                    <i data-lucide="message-square" class="w-4 h-4"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between">
                <div class="text-sm text-gray-500">
                    Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span class="font-medium">156</span> students
                </div>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 rounded-md border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Previous
                    </button>
                    <button class="px-3 py-1 rounded-md bg-orange-600 text-white text-sm font-medium hover:bg-orange-700">
                        1
                    </button>
                    <button class="px-3 py-1 rounded-md border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50">
                        2
                    </button>
                    <button class="px-3 py-1 rounded-md border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50">
                        3
                    </button>
                    <button class="px-3 py-1 rounded-md border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Next
                    </button>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-orange-600">Recent Activity</h3>
            </div>
            <div class="divide-y divide-gray-200">
                <!-- Activity 1 -->
                <div class="px-6 py-4 flex items-start">
                    <div class="flex-shrink-0 bg-green-100 p-2 rounded-lg">
                        <i data-lucide="award" class="w-5 h-5 text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900">
                            <span class="text-orange-600">Alice Johnson</span> achieved a perfect score on Neural Networks Quiz
                        </p>
                        <p class="text-sm text-gray-500 mt-1">
                            <span class="font-medium">Score:</span> 100% • <span class="font-medium">Time:</span> 12 minutes • 2 hours ago
                        </p>
                    </div>
                </div>
                <!-- Activity 2 -->
                <div class="px-6 py-4 flex items-start">
                    <div class="flex-shrink-0 bg-blue-100 p-2 rounded-lg">
                        <i data-lucide="clock" class="w-5 h-5 text-blue-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900">
                            <span class="text-orange-600">Bob Smith</span> completed the Machine Learning Challenge in record time
                        </p>
                        <p class="text-sm text-gray-500 mt-1">
                            <span class="font-medium">Time:</span> 18 minutes • <span class="font-medium">Score:</span> 98% • 5 hours ago
                        </p>
                    </div>
                </div>
                <!-- Activity 3 -->
                <div class="px-6 py-4 flex items-start">
                    <div class="flex-shrink-0 bg-purple-100 p-2 rounded-lg">
                        <i data-lucide="book-open" class="w-5 h-5 text-purple-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900">
                            <span class="text-orange-600">Carol Davis</span> completed all Deep Learning modules
                        </p>
                        <p class="text-sm text-gray-500 mt-1">
                            <span class="font-medium">Progress:</span> 100% • <span class="font-medium">Average:</span> 89% • Yesterday
                        </p>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-gray-100 text-center">
                <button class="text-orange-600 text-sm font-medium hover:text-orange-700 flex items-center justify-center mx-auto">
                    View all activity
                    <i data-lucide="chevron-down" class="w-4 h-4 ml-1"></i>
                </button>
            </div>
        </div>
    </main>

   

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Tab functionality
        document.querySelectorAll('.tab-button').forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all tabs and buttons
                document.querySelectorAll('.tab-button').forEach(btn => {
                    btn.classList.remove('active', 'border-orange-500', 'text-orange-600');
                    btn.classList.add('border-transparent', 'text-gray-500');
                });
                
                // Add active class to clicked button
                button.classList.add('active', 'border-orange-500', 'text-orange-600');
                button.classList.remove('border-transparent', 'text-gray-500');
                
                // Hide all tab contents
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.add('hidden');
                    content.classList.remove('active');
                });
                
                // Show selected tab content
                const tabId = button.getAttribute('data-tab');
                document.getElementById(`${tabId}-tab`).classList.remove('hidden');
                document.getElementById(`${tabId}-tab`).classList.add('active');
            });
        });
        
        // Simulate live updates every 10 seconds
        setInterval(() => {
            // In a real app, you would fetch new data here
            console.log("Checking for updates...");
            
            // Add a subtle visual cue that data is refreshing
            const liveIndicator = document.querySelector('.live-pulse');
            if (liveIndicator) {
                liveIndicator.classList.remove('live-pulse');
                void liveIndicator.offsetWidth; // Trigger reflow
                liveIndicator.classList.add('live-pulse');
            }
        }, 10000);
        
        // Add hover effects for better interactivity
        document.querySelectorAll('.leaderboard-item').forEach(row => {
            row.addEventListener('mouseenter', () => {
                const rankCell = row.querySelector('td:first-child div');
                if (rankCell) {
                    rankCell.classList.add('transform', 'scale-110');
                }
            });
            row.addEventListener('mouseleave', () => {
                const rankCell = row.querySelector('td:first-child div');
                if (rankCell) {
                    rankCell.classList.remove('transform', 'scale-110');
                }
            });
        });
    </script>
</body>
</html>