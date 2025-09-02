<?php

$page_name = "Students ";


?>
<?php include('./head.php') ?>

<?php include('./sidebar.php') ?>


<!-- Student Content -->
<main class="p-6">
    <!-- Action Bar -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div class="flex items-center space-x-3">
            <div class="relative">
                <input type="text" placeholder="Search students..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 w-full md:w-64">
                <i data-feather="search" class="absolute left-3 top-2.5 text-gray-400"></i>
            </div>
            <div>
                <select class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-primary-500 focus:border-primary-500">
                    <option>All Departments</option>
                    <option>Computer Science</option>
                    <option>Electrical Engineering</option>
                    <option>Mechanical Engineering</option>
                    <option>Civil Engineering</option>
                    <option>Electronics</option>
                    <option>Information Technology</option>
                    <option>Chemical Engineering</option>
                </select>
            </div>
            <div>
                <select class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-primary-500 focus:border-primary-500">
                    <option>All Years</option>
                    <option>1st Year</option>
                    <option>2nd Year</option>
                    <option>3rd Year</option>
                    <option>4th Year</option>
                </select>
            </div>
        </div>
        <div class="flex space-x-3">
            <a href="students.html?action=add" class="flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700">
                <i data-feather="user-plus" class="mr-2"></i>
                Add Student
            </a>
            <button id="openModalBtn"
                class="flex items-center px-4 py-2 border border-primary-600 text-primary-600 rounded-lg hover:bg-primary-50">
                <i data-feather="upload" class="mr-2"></i>
                Bulk Upload
            </button>
            <button class="flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                <i data-feather="download" class="mr-2"></i>
                Export
            </button>
        </div>
    </div>

    <!-- Student Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Roll No
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Department
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Year
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                   
                </tbody>
            </table>
        </div>
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            <div class="flex-1 flex justify-between sm:hidden">
                <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Previous
                </a>
                <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Next
                </a>
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Showing
                        <span class="font-medium">1</span>
                        to
                        <span class="font-medium">5</span>
                        of
                        <span class="font-medium">124</span>
                        results
                    </p>
                </div>
                <div>
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Previous</span>
                            <i data-feather="chevron-left" class="h-5 w-5"></i>
                        </a>
                        <a href="#" aria-current="page" class="z-10 bg-primary-50 border-primary-500 text-primary-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                            1
                        </a>
                        <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                            2
                        </a>
                        <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                            3
                        </a>
                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                            ...
                        </span>
                        <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                            8
                        </a>
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Next</span>
                            <i data-feather="chevron-right" class="h-5 w-5"></i>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Student Modal (Hidden by default) -->
    <div id="addStudentModal" class="fixed inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-primary-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i data-feather="user-plus" class="text-primary-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Add New Student
                            </h3>
                            <div class="mt-2">
                                <form class="space-y-4">
                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                        <div>
                                            <label for="firstName" class="block text-sm font-medium text-gray-700">First Name</label>
                                            <input type="text" name="firstName" id="firstName" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>
                                        <div>
                                            <label for="lastName" class="block text-sm font-medium text-gray-700">Last Name</label>
                                            <input type="text" name="lastName" id="lastName" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="rollNumber" class="block text-sm font-medium text-gray-700">Roll Number</label>
                                        <input type="text" name="rollNumber" id="rollNumber" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                        <input type="email" name="email" id="email" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                        <div>
                                            <label for="department" class="block text-sm font-medium text-gray-700">Department</label>
                                            <select id="department" name="department" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                                                <option>Computer Science</option>
                                                <option>Electrical Engineering</option>
                                                <option>Mechanical Engineering</option>
                                                <option>Civil Engineering</option>
                                                <option>Electronics</option>
                                                <option>Information Technology</option>
                                                <option>Chemical Engineering</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                                            <select id="year" name="year" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                                                <option>1st Year</option>
                                                <option>2nd Year</option>
                                                <option>3rd Year</option>
                                                <option>4th Year</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary-600 text-base font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Add Student
                    </button>
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    
</main>


<script>
    // Initialize AOS
    AOS.init();

    // Initialize Feather Icons
    feather.replace();

    // Sidebar toggle functionality
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('collapsed');
    });

    // Check URL for action parameter to show modal
    const urlParams = new URLSearchParams(window.location.search);
    const action = urlParams.get('action');

    if (action === 'add') {
        document.getElementById('addStudentModal').classList.remove('hidden');
    }

    // Close modal when clicking cancel or outside
    const modal = document.getElementById('addStudentModal');
    const closeButtons = modal.querySelectorAll('button[type="button"]');

    closeButtons.forEach(button => {
        button.addEventListener('click', function() {
            if (this.textContent.trim() === 'Cancel') {
                modal.classList.add('hidden');
            }
        });
    });

    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.classList.add('hidden');
        }
    });
</script>
</body>

</html>