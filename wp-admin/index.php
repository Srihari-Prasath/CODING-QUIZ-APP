<?php 

$page_name = "Admin Panel";


?>
<?php include('./head.php') ?>
  
<?php include('./sidebar.php') ?>

      
      
            <!-- Dashboard Content -->
            <main class="p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-primary-50 text-primary-600">
                                <i data-feather="users"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Students</p>
                                <h3 class="text-2xl font-semibold text-gray-800">1,254</h3>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-primary-50 text-primary-600">
                                <i data-feather="user-check"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Staff</p>
                                <h3 class="text-2xl font-semibold text-gray-800">87</h3>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-primary-50 text-primary-600">
                                <i data-feather="help-circle"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Questions</p>
                                <h3 class="text-2xl font-semibold text-gray-800">5,678</h3>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-primary-50 text-primary-600">
                                <i data-feather="file-text"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Active Tests</p>
                                <h3 class="text-2xl font-semibold text-gray-800">24</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="bg-white rounded-lg shadow p-6 mb-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg font-semibold text-gray-800">Recent Activities</h2>
                        <a href="#" class="text-sm text-primary-600 hover:underline">View All</a>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="p-2 rounded-full bg-primary-50 text-primary-600">
                                <i data-feather="user-plus"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-800">New student added</p>
                                <p class="text-xs text-gray-500">John Doe (Roll No: 2023001) was added to Computer Science department</p>
                                <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="p-2 rounded-full bg-primary-50 text-primary-600">
                                <i data-feather="file-text"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-800">New test created</p>
                                <p class="text-xs text-gray-500">Mid-term exam created for Electrical Engineering (3rd Year)</p>
                                <p class="text-xs text-gray-400 mt-1">5 hours ago</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="p-2 rounded-full bg-primary-50 text-primary-600">
                                <i data-feather="upload"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-800">Bulk upload completed</p>
                                <p class="text-xs text-gray-500">150 questions uploaded for Mechanical Engineering department</p>
                                <p class="text-xs text-gray-400 mt-1">1 day ago</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
                        <div class="space-y-3">
                            <a href="students.html?action=add" class="flex items-center p-3 rounded-lg bg-primary-50 text-primary-600 hover:bg-primary-100">
                                <i data-feather="user-plus" class="mr-3"></i>
                                <span>Add New Student</span>
                            </a>
                            <a href="staff.html?action=add" class="flex items-center p-3 rounded-lg bg-primary-50 text-primary-600 hover:bg-primary-100">
                                <i data-feather="user-check" class="mr-3"></i>
                                <span>Add New Staff</span>
                            </a>
                            <a href="questions.html?action=add" class="flex items-center p-3 rounded-lg bg-primary-50 text-primary-600 hover:bg-primary-100">
                                <i data-feather="plus-circle" class="mr-3"></i>
                                <span>Add New Question</span>
                            </a>
                            <a href="tests.html?action=create" class="flex items-center p-3 rounded-lg bg-primary-50 text-primary-600 hover:bg-primary-100">
                                <i data-feather="file-text" class="mr-3"></i>
                                <span>Create New Test</span>
                            </a>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Bulk Operations</h3>
                        <div class="space-y-3">
                            <a href="#" class="flex items-center p-3 rounded-lg bg-primary-50 text-primary-600 hover:bg-primary-100">
                                <i data-feather="upload" class="mr-3"></i>
                                <span>Bulk Upload Students</span>
                            </a>
                            <a href="#" class="flex items-center p-3 rounded-lg bg-primary-50 text-primary-600 hover:bg-primary-100">
                                <i data-feather="upload" class="mr-3"></i>
                                <span>Bulk Upload Questions</span>
                            </a>
                            <a href="#" class="flex items-center p-3 rounded-lg bg-primary-50 text-primary-600 hover:bg-primary-100">
                                <i data-feather="download" class="mr-3"></i>
                                <span>Export Student Data</span>
                            </a>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">System Status</h3>
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium text-gray-700">Storage</span>
                                    <span class="text-sm font-medium text-gray-700">65%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-primary-600 h-2 rounded-full" style="width: 65%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium text-gray-700">Database</span>
                                    <span class="text-sm font-medium text-gray-700">42%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-primary-600 h-2 rounded-full" style="width: 42%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium text-gray-700">Memory</span>
                                    <span class="text-sm font-medium text-gray-700">78%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-primary-600 h-2 rounded-full" style="width: 78%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Initialize AOS
        AOS.init();
        
        // Initialize Feather Icons
        feather.replace();
        
        // Sidebar toggle functionality
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
        });
        
        // Simple animation for dashboard cards
        anime({
            targets: '.bg-white',
            translateY: [20, 0],
            opacity: [0, 1],
            delay: anime.stagger(100),
            easing: 'easeOutExpo'
        });
    </script>
</body>
</html>