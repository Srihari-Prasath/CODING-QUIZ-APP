  <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="sidebar bg-white shadow-lg w-64 fixed h-full z-10">
            <div class="p-4 flex items-center border-b border-gray-200">
                <div class="bg-primary-500 p-2 rounded-lg">
                    <i data-feather="book" class="text-white"></i>
                </div>
                <span class="logo-text ml-3 text-xl font-bold text-primary-600">Exam Portal</span>
            </div>
            <div class="p-4">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center">
                        <i data-feather="user" class="text-primary-600"></i>
                    </div>
                    <div class="ml-3">
                        <p class="font-medium text-gray-800">Admin User</p>
                        <p class="text-xs text-gray-500">Administrator</p>
                    </div>
                </div>
                <nav>
                    <ul class="space-y-2">
                        <li>
                            <a href="index.html" class="nav-item flex items-center p-3 rounded-lg bg-primary-50 text-primary-600">
                                <i data-feather="home" class="text-primary-600"></i>
                                <span class="nav-text ml-3 font-medium">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="students.php" class="nav-item flex items-center p-3 rounded-lg hover:bg-primary-50 text-gray-700 hover:text-primary-600">
                                <i data-feather="users"></i>
                                <span class="nav-text ml-3">Students</span>
                            </a>
                        </li>
                        <li>
                            <a href="staff.html" class="nav-item flex items-center p-3 rounded-lg hover:bg-primary-50 text-gray-700 hover:text-primary-600">
                                <i data-feather="user-check"></i>
                                <span class="nav-text ml-3">Staff</span>
                            </a>
                        </li>
                        <li>
                            <a href="questions.html" class="nav-item flex items-center p-3 rounded-lg hover:bg-primary-50 text-gray-700 hover:text-primary-600">
                                <i data-feather="help-circle"></i>
                                <span class="nav-text ml-3">Questions</span>
                            </a>
                        </li>
                        <li>
                            <a href="departments.html" class="nav-item flex items-center p-3 rounded-lg hover:bg-primary-50 text-gray-700 hover:text-primary-600">
                                <i data-feather="layers"></i>
                                <span class="nav-text ml-3">Departments</span>
                            </a>
                        </li>
                        <li>
                            <a href="tests.html" class="nav-item flex items-center p-3 rounded-lg hover:bg-primary-50 text-gray-700 hover:text-primary-600">
                                <i data-feather="file-text"></i>
                                <span class="nav-text ml-3">Tests</span>
                            </a>
                        </li>
                        <li>
                            <a href="reports.html" class="nav-item flex items-center p-3 rounded-lg hover:bg-primary-50 text-gray-700 hover:text-primary-600">
                                <i data-feather="bar-chart-2"></i>
                                <span class="nav-text ml-3">Reports</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="absolute bottom-0 w-full p-4 border-t border-gray-200">
                <a href="#" class="nav-item flex items-center p-3 rounded-lg hover:bg-primary-50 text-gray-700 hover:text-primary-600">
                    <i data-feather="settings"></i>
                    <span class="nav-text ml-3">Settings</span>
                </a>
                <a href="#" class="nav-item flex items-center p-3 rounded-lg hover:bg-primary-50 text-gray-700 hover:text-primary-600">
                    <i data-feather="log-out"></i>
                    <span class="nav-text ml-3">Logout</span>
                </a>
            </div>
        </div>

          <div class="main-content flex-1 ml-64 overflow-auto">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm py-4 px-6 flex justify-between items-center sticky top-0 z-10">
                <div class="flex items-center">
                    <button id="sidebarToggle" class="mr-4 text-gray-600 hover:text-primary-600">
                        <i data-feather="menu"></i>
                    </button>
                    <h1 class="text-xl font-semibold text-gray-800">Dashboard</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="p-2 rounded-full hover:bg-gray-100 text-gray-600 hover:text-primary-600">
                        <i data-feather="bell"></i>
                    </button>
                    <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center">
                        <i data-feather="user" class="text-primary-600"></i>
                    </div>
                </div>
            </header>
