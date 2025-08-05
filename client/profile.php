<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile Dashboard</title>
    <meta name="description" content="Dynamic profile page for college students">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="profile.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#ff6b35",
                        secondary: "#e55a2b",
                        accent: "#ff8c42",
                        dark: "#1e293b",
                        light: "#fff7f4"
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'slide-down': 'slideDown 0.3s ease-out',
                        'scale-in': 'scaleIn 0.4s ease-out',
                        'bounce-soft': 'bounceSoft 0.6s ease-out',
                        'pulse-soft': 'pulseSoft 2s infinite',
                        'float': 'float 3s ease-in-out infinite',
                        'shimmer': 'shimmer 2s linear infinite'
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' }
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' }
                        },
                        slideDown: {
                            '0%': { transform: 'translateY(-10px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' }
                        },
                        scaleIn: {
                            '0%': { transform: 'scale(0.9)', opacity: '0' },
                            '100%': { transform: 'scale(1)', opacity: '1' }
                        },
                        bounceSoft: {
                            '0%': { transform: 'scale(0.3)' },
                            '50%': { transform: 'scale(1.05)' },
                            '70%': { transform: 'scale(0.9)' },
                            '100%': { transform: 'scale(1)' }
                        },
                        pulseSoft: {
                            '0%, 100%': { opacity: '1' },
                            '50%': { opacity: '0.8' }
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' }
                        },
                        shimmer: {
                            '0%': { backgroundPosition: '-200% 0' },
                            '100%': { backgroundPosition: '200% 0' }
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 min-h-screen">
    <header class="bg-white shadow-lg border-b-2 border-orange-100 animate-slide-down">
        <nav class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2 animate-fade-in">
                <div class="w-8 h-8 bg-gradient-to-br from-primary to-accent rounded-lg flex items-center justify-center animate-float">
                    <i class="fas fa-graduation-cap text-white"></i>
                </div>
                <span class="text-primary font-bold text-2xl bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">Name</span>
            </div>
        </nav>
    </header>

    <main class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <div class="lg:col-span-1 bg-white rounded-2xl shadow-xl p-6 relative card-hover animate-slide-up border border-orange-100">
                <div class="absolute top-4 right-4 flex space-x-2">
                    <button id="editProfileBtn" class="text-gray-400 hover:text-primary transition-all duration-300 p-2 rounded-full hover:bg-orange-50 animate-bounce-soft button-press" title="Edit Profile">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button id="changePasswordBtn" class="text-gray-400 hover:text-primary transition-all duration-300 p-2 rounded-full hover:bg-orange-50 animate-bounce-soft button-press" title="Change Password">
                        <i class="fas fa-lock"></i>
                    </button>
                </div>
                <div class="flex flex-col items-center animate-fade-in">
    <div class="relative animate-scale-in">
        <div class="gradient-border p-1 rounded-full">
            <img 
                id="profileImage"
                src="" 
                alt="Profile picture" 
                class="w-24 h-24 rounded-full cursor-pointer hover:opacity-80 transition-all duration-500 hover:scale-105 hidden"
                loading="lazy"
            >
            <div id="defaultProfile" class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center cursor-pointer">
                <i class="fas fa-user text-gray-400 text-3xl"></i>
            </div>
        </div>
        <button id="changePhotoBtn" class="absolute bottom-2 right-2 bg-gradient-to-r from-primary to-accent text-white rounded-full w-8 h-8 flex items-center justify-center text-xs hover:scale-110 transition-all duration-300 shadow-lg animate-bounce-soft">
            <i class="fas fa-camera"></i>
        </button>
    </div>
                    <h2 id="profileName" class="text-xl font-bold text-dark mt-4 animate-fade-in">Rahul Sharma</h2>
                    <p id="profileRole" class="text-sm text-primary font-medium mb-2 animate-fade-in">Student</p>
                    <div class="w-full border-t border-orange-200 my-4 animate-fade-in"></div>
                    
                    <div class="w-full space-y-4 animate-slide-up">
                        <div class="hover:bg-orange-50 p-2 rounded-lg transition-all duration-300">
                            <p class="text-xs text-gray-400 font-medium">Roll Number</p>
                            <p id="profileRoll" class="text-sm font-semibold text-dark">CS2023001</p>
                        </div>
                        <div class="hover:bg-orange-50 p-2 rounded-lg transition-all duration-300">
                            <p class="text-xs text-gray-400 font-medium">Department</p>
                            <p id="profileDept" class="text-sm font-semibold text-dark">Computer Science</p>
                        </div>
                        <div class="hover:bg-orange-50 p-2 rounded-lg transition-all duration-300">
                            <p class="text-xs text-gray-400 font-medium">Year</p>
                            <p id="profileYear" class="text-sm font-semibold text-primary">II</p>
                        </div>
                        <div class="hover:bg-orange-50 p-2 rounded-lg transition-all duration-300">
                            <p class="text-xs text-gray-400 font-medium">Email</p>
                            <p id="profileEmail" class="text-sm font-semibold text-dark break-words">rahul.sharma@college.edu</p>
                        </div>
                        <div class="hover:bg-orange-50 p-2 rounded-lg transition-all duration-300">
                            <button id="logoutBtn" class="w-full px-4 py-2 bg-gradient-to-r from-primary to-accent text-white rounded-lg hover:shadow-lg transition-all duration-300 hover:scale-[1.02] font-medium flex items-center justify-center space-x-2">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-3 space-y-6">
                <div class="bg-white rounded-2xl shadow-xl p-6 card-hover animate-slide-up border border-orange-100" style="animation-delay: 0.1s">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-dark bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent text-glow">Performance Stats</h3>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-gradient-to-br from-orange-100 to-orange-200 p-6 rounded-xl text-center stat-card transition-all duration-500 hover:shadow-lg border border-orange-200">
                            <p class="text-3xl font-bold text-primary animate-bounce-soft number-counter text-glow" id="problemsSolved">42</p>
                            <p class="text-xs text-gray-600 font-medium mt-2">Problems Solved</p>
                        </div>
                        <div class="bg-gradient-to-br from-orange-50 to-orange-100 p-6 rounded-xl text-center stat-card transition-all duration-500 hover:shadow-lg border border-orange-200">
                            <p class="text-3xl font-bold text-orange-600 animate-bounce-soft number-counter text-glow" id="testsTaken" style="animation-delay: 0.1s">8</p>
                            <p class="text-xs text-gray-600 font-medium mt-2">Tests Taken</p>
                        </div>
                        <div class="bg-gradient-to-br from-yellow-50 to-orange-100 p-6 rounded-xl text-center stat-card transition-all duration-500 hover:shadow-lg border border-orange-200">
                            <p class="text-3xl font-bold text-orange-500 animate-bounce-soft number-counter text-glow" id="avgScore" style="animation-delay: 0.2s">78</p>
                            <p class="text-xs text-gray-600 font-medium mt-2">Avg. Score</p>
                        </div>
                        <div class="bg-gradient-to-br from-purple-50 to-orange-100 p-6 rounded-xl text-center stat-card transition-all duration-500 hover:shadow-lg border border-orange-200">
                            <p class="text-3xl font-bold text-purple-600 animate-bounce-soft number-counter text-glow" id="rank" style="animation-delay: 0.3s">15</p>
                            <p class="text-xs text-gray-600 font-medium mt-2">Rank</p>
                        </div>
                    </div>
                </div>

                <div id="dynamicContent" class="bg-white rounded-2xl shadow-xl p-6 card-hover animate-slide-up border border-orange-100" style="animation-delay: 0.2s">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-dark bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">Recent Activities</h3>
                    </div>
                    <div class="space-y-4">
                        <div class="activity-item flex items-center justify-between p-4 bg-gradient-to-r from-gray-50 to-orange-50 rounded-xl transition-all duration-300 animate-fade-in border border-orange-100">
                            <div>
                                <p class="text-sm font-semibold text-dark">Solved: Two Sum Problem</p>
                                <p class="text-xs text-gray-500 mt-1">2 days ago</p>
                            </div>
                            <span class="text-xs px-3 py-1 bg-gradient-to-r from-orange-100 to-orange-200 text-orange-800 rounded-full font-medium animate-pulse-soft">Easy</span>
                        </div>
                        <div class="activity-item flex items-center justify-between p-4 bg-gradient-to-r from-gray-50 to-orange-50 rounded-xl transition-all duration-300 animate-fade-in border border-orange-100" style="animation-delay: 0.1s">
                            <div>
                                <p class="text-sm font-semibold text-dark">Completed: Data Structures Test</p>
                                <p class="text-xs text-gray-500 mt-1">1 week ago</p>
                            </div>
                            <span class="text-xs px-3 py-1 bg-gradient-to-r from-orange-200 to-orange-300 text-orange-800 rounded-full font-medium animate-pulse-soft">85%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="editProfileModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center hidden z-50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl p-8 w-full max-w-md shadow-2xl animate-scale-in glass-effect border border-orange-200">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">Edit Profile</h3>
                <button id="closeEditModal" class="text-gray-500 hover:text-primary transition-all duration-300 p-2 rounded-full hover:bg-orange-50">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="profileForm" class="space-y-6">
                <div class="animate-fade-in">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Name</label>
                    <input type="text" id="editName" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl bg-gray-100 transition-all duration-300" readonly>
                    <p class="text-xs text-gray-500 mt-2 flex items-center"><i class="fas fa-lock mr-1"></i>Name cannot be edited</p>
                </div>
                <div class="animate-fade-in" style="animation-delay: 0.1s">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                    <input type="email" id="editEmail" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl bg-gray-100 transition-all duration-300" readonly>
                    <p class="text-xs text-gray-500 mt-2 flex items-center"><i class="fas fa-lock mr-1"></i>Email cannot be edited</p>
                </div>
                <div class="animate-fade-in" style="animation-delay: 0.2s">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Department</label>
                    <input type="text" id="editDept" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl bg-gray-100 transition-all duration-300" readonly>
                    <p class="text-xs text-gray-500 mt-2 flex items-center"><i class="fas fa-lock mr-1"></i>Department cannot be edited</p>
                </div>
                <div class="animate-fade-in" style="animation-delay: 0.3s">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Year</label>
                    <select id="editYear" class="w-full px-4 py-3 border-2 border-orange-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-300 hover:border-primary">
                        <option value="I">I</option>
                        <option value="II">II</option>
                        <option value="III">III</option>
                        <option value="IV">IV</option>
                    </select>
                    <p class="text-xs text-green-600 mt-2 flex items-center"><i class="fas fa-edit mr-1"></i>You can edit your current year</p>
                </div>
                <div class="flex justify-end space-x-4 pt-4">
                    <button type="button" id="cancelEdit" class="px-6 py-3 border-2 border-gray-300 rounded-xl hover:bg-gray-50 transition-all duration-300 font-medium">Cancel</button>
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-primary to-accent text-white rounded-xl hover:shadow-lg transition-all duration-300 hover:scale-105 font-medium">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <div id="changePasswordModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center hidden z-50 backdrop-blur-sm modal-backdrop">
        <div class="bg-white rounded-2xl p-8 w-full max-w-md shadow-2xl animate-scale-in glass-effect border border-orange-200 card-hover">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">Change Password</h3>
                <button id="closePasswordModal" class="text-gray-500 hover:text-primary transition-all duration-300 p-2 rounded-full hover:bg-orange-50 button-press">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="passwordForm" class="space-y-6">
                <div class="animate-fade-in">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Current Password</label>
                    <div class="relative">
                        <input type="password" id="currentPassword" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl pr-12 focus:ring-2 focus:ring-primary focus:border-primary input-focus transition-all duration-300" required>
                        <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center toggle-password hover:text-primary transition-colors duration-300 button-press" data-target="currentPassword">
                            <i class="fas fa-eye text-gray-400"></i>
                        </button>
                    </div>
                </div>
                <div class="animate-fade-in" style="animation-delay: 0.1s">
                    <label class="block text-sm font-bold text-gray-700 mb-2">New Password</label>
                    <div class="relative">
                        <input type="password" id="newPassword" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl pr-12 focus:ring-2 focus:ring-primary focus:border-primary input-focus transition-all duration-300" required minlength="8">
                        <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center toggle-password hover:text-primary transition-colors duration-300 button-press" data-target="newPassword">
                            <i class="fas fa-eye text-gray-400"></i>
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 mt-2 flex items-center"><i class="fas fa-info-circle mr-1"></i>Minimum 8 characters</p>
                </div>
                <div class="animate-fade-in" style="animation-delay: 0.2s">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Confirm New Password</label>
                    <div class="relative">
                        <input type="password" id="confirmPassword" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl pr-12 focus:ring-2 focus:ring-primary focus:border-primary input-focus transition-all duration-300" required>
                        <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center toggle-password hover:text-primary transition-colors duration-300 button-press" data-target="confirmPassword">
                            <i class="fas fa-eye text-gray-400"></i>
                        </button>
                    </div>
                </div>
                <div class="flex justify-end space-x-4 pt-4">
                    <button type="button" id="cancelPassword" class="px-6 py-3 border-2 border-gray-300 rounded-xl hover:bg-gray-50 transition-all duration-300 font-medium button-press">Cancel</button>
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-primary to-accent text-white rounded-xl hover:shadow-lg transition-all duration-300 hover:scale-105 font-medium button-press">Change Password</button>
                </div>
            </form>
        </div>
    </div>

    <div id="profilePhotoModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center hidden z-50 backdrop-blur-sm">
    <div class="bg-white rounded-2xl p-8 w-full max-w-md shadow-2xl animate-scale-in glass-effect border border-orange-200">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">Change Profile Photo</h3>
            <button id="closePhotoModal" class="text-gray-500 hover:text-primary transition-all duration-300 p-2 rounded-full hover:bg-orange-50">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="space-y-6">
            <div class="text-center animate-scale-in">
                <div class="gradient-border p-1 rounded-full inline-block">
                    <div id="previewDefault" class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center mx-auto">
                        <i class="fas fa-user text-gray-400 text-5xl"></i>
                    </div>
                    <img id="previewImage" src="" alt="Preview" class="w-32 h-32 rounded-full mx-auto hidden">
                </div>
            </div>
            <div class="animate-fade-in" style="animation-delay: 0.1s">
                <label class="block text-sm font-bold text-gray-700 mb-3">Choose a photo:</label>
                <input type="file" id="photoInput" accept="image/*" class="w-full px-4 py-3 border-2 border-dashed border-orange-300 rounded-xl hover:border-primary transition-all duration-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-medium file:bg-primary file:text-white hover:file:bg-secondary">
                <p class="text-xs text-gray-500 mt-2 flex items-center"><i class="fas fa-info-circle mr-1"></i>Supported formats: JPG, PNG, GIF (Max: 5MB)</p>
            </div>
            <div class="flex justify-between items-center pt-4">
                <button type="button" id="removePhoto" class="px-6 py-3 text-red-500 hover:text-red-700 transition-all duration-300 font-medium">Remove Photo</button>
                <div class="flex space-x-4">
                    <button type="button" id="cancelPhoto" class="px-6 py-3 border-2 border-gray-300 rounded-xl hover:bg-gray-50 transition-all duration-300 font-medium">Cancel</button>
                    <button type="button" id="savePhoto" class="px-6 py-3 bg-gradient-to-r from-primary to-accent text-white rounded-xl hover:shadow-lg transition-all duration-300 hover:scale-105 font-medium">Save Photo</button>
                </div>
            </div>
        </div>
    </div>
</div>

    <div id="successToast" class="fixed top-6 right-6 bg-gradient-to-r from-primary to-accent text-white px-6 py-4 rounded-2xl shadow-2xl transform translate-x-full transition-all duration-500 z-50 animate-bounce-soft">
        <div class="flex items-center">
            <div class="bg-white bg-opacity-20 rounded-full p-1 mr-3 animate-pulse-soft">
                <i class="fas fa-check-circle text-lg"></i>
            </div>
            <span id="toastMessage" class="font-medium">Changes saved successfully!</span>
        </div>
    </div>

    <footer class="bg-white border-t-2 border-orange-100 mt-12 py-8 animate-fade-in">
        <div class="container mx-auto px-4 text-center">
            <div class="flex items-center justify-center space-x-2 mb-2">
                <div class="w-6 h-6 bg-gradient-to-br from-primary to-accent rounded-lg flex items-center justify-center animate-float">
                    <i class="fas fa-graduation-cap text-white text-sm"></i>
                </div>
                <span class="text-primary font-bold text-lg">Name</span>
            </div>
            <p class="text-sm text-gray-500">© 2025 Name</p>
        </div>
    </footer>

    <script>
        // User data
        const userData = {
            name: "Rahul Sharma",
            role: "Student",
            roll: "CS2023001",
            dept: "Computer Science",
            year: "II",
            email: "rahul.sharma@college.edu",
            profileImage: "profile.jpg",
            stats: {
                problemsSolved: 42,
                testsTaken: 8,
                avgScore: 78,
                rank: 15
            }
        };

        // DOM elements
        const profileName = document.getElementById('profileName');
        const profileRole = document.getElementById('profileRole');
        const profileRoll = document.getElementById('profileRoll');
        const profileDept = document.getElementById('profileDept');
        const profileYear = document.getElementById('profileYear');
        const profileEmail = document.getElementById('profileEmail');
        const profileImage = document.getElementById('profileImage');
        const problemsSolved = document.getElementById('problemsSolved');
        const testsTaken = document.getElementById('testsTaken');
        const avgScore = document.getElementById('avgScore');
        const rank = document.getElementById('rank');
        const logoutBtn = document.getElementById('logoutBtn');

        // Modal elements
        const editProfileBtn = document.getElementById('editProfileBtn');
        const editProfileModal = document.getElementById('editProfileModal');
        const closeEditModal = document.getElementById('closeEditModal');
        const cancelEdit = document.getElementById('cancelEdit');
        const profileForm = document.getElementById('profileForm');
        const editName = document.getElementById('editName');
        const editEmail = document.getElementById('editEmail');
        const editDept = document.getElementById('editDept');
        const editYear = document.getElementById('editYear');

        // Password modal elements
        const changePasswordBtn = document.getElementById('changePasswordBtn');
        const changePasswordModal = document.getElementById('changePasswordModal');
        const closePasswordModal = document.getElementById('closePasswordModal');
        const cancelPassword = document.getElementById('cancelPassword');
        const passwordForm = document.getElementById('passwordForm');
        const currentPassword = document.getElementById('currentPassword');
        const newPassword = document.getElementById('newPassword');
        const confirmPassword = document.getElementById('confirmPassword');

        // Photo modal elements
        const changePhotoBtn = document.getElementById('changePhotoBtn');
        const profilePhotoModal = document.getElementById('profilePhotoModal');
        const closePhotoModal = document.getElementById('closePhotoModal');
        const cancelPhoto = document.getElementById('cancelPhoto');
        const savePhoto = document.getElementById('savePhoto');
        const photoInput = document.getElementById('photoInput');
        const previewImage = document.getElementById('previewImage');

        // Toast
        const successToast = document.getElementById('successToast');
        const toastMessage = document.getElementById('toastMessage');

        // Initialize profile data
        profileName.textContent = userData.name;
        profileRole.textContent = userData.role;
        profileRoll.textContent = userData.roll;
        profileDept.textContent = userData.dept;
        profileYear.textContent = userData.year;
        profileEmail.textContent = userData.email;
        profileImage.src = userData.profileImage;
        problemsSolved.textContent = userData.stats.problemsSolved;
        testsTaken.textContent = userData.stats.testsTaken;
        avgScore.textContent = userData.stats.avgScore;
        rank.textContent = userData.stats.rank;

        // Function to show toast
        function showToast(message) {
            toastMessage.textContent = message;
            successToast.classList.remove('translate-x-full');
            setTimeout(() => {
                successToast.classList.add('translate-x-full');
            }, 3000);
        }

        // Edit Profile functionality
        editProfileBtn.addEventListener('click', () => {
            editName.value = userData.name;
            editEmail.value = userData.email;
            editDept.value = userData.dept;
            editYear.value = userData.year;
            editProfileModal.classList.remove('hidden');
        });

        // Close modals
        [closeEditModal, cancelEdit].forEach(btn => {
            btn.addEventListener('click', () => {
                editProfileModal.classList.add('hidden');
            });
        });

        [closePasswordModal, cancelPassword].forEach(btn => {
            btn.addEventListener('click', () => {
                changePasswordModal.classList.add('hidden');
                passwordForm.reset();
            });
        });

        [closePhotoModal, cancelPhoto].forEach(btn => {
            btn.addEventListener('click', () => {
                profilePhotoModal.classList.add('hidden');
                selectedPhotoSrc = '';
            });
        });

        // Save profile changes
        profileForm.addEventListener('submit', (e) => {
            e.preventDefault();
            userData.year = editYear.value;
            profileYear.textContent = userData.year;
            editProfileModal.classList.add('hidden');
            showToast('Profile updated successfully!');
        });

        // Password change functionality
        changePasswordBtn.addEventListener('click', () => {
            changePasswordModal.classList.remove('hidden');
        });

        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(btn => {
            btn.addEventListener('click', () => {
                const targetId = btn.getAttribute('data-target');
                const targetInput = document.getElementById(targetId);
                const icon = btn.querySelector('i');
                
                if (targetInput.type === 'password') {
                    targetInput.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    targetInput.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });

        // Password form submission
        passwordForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            if (newPassword.value !== confirmPassword.value) {
                alert('New passwords do not match!');
                return;
            }
            
            if (newPassword.value.length < 8) {
                alert('Password must be at least 8 characters long!');
                return;
            }
            
            changePasswordModal.classList.add('hidden');
            passwordForm.reset();
            showToast('Password changed successfully!');
        });

        // Profile photo functionality
        let selectedPhotoSrc = '';
        changePhotoBtn.addEventListener('click', () => {
            previewImage.src = profileImage.src;
            selectedPhotoSrc = profileImage.src;
            profilePhotoModal.classList.remove('hidden');
        });

        // Handle file input
        photoInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                if (file.size > 5 * 1024 * 1024) {
                    alert('File size must be less than 5MB');
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = (e) => {
                    selectedPhotoSrc = e.target.result;
                    previewImage.src = selectedPhotoSrc;
                };
                reader.readAsDataURL(file);
            }
        });

        // Save photo
        savePhoto.addEventListener('click', () => {
            if (selectedPhotoSrc) {
                profileImage.src = selectedPhotoSrc;
                userData.profileImage = selectedPhotoSrc;
                profilePhotoModal.classList.add('hidden');
                showToast('Profile photo updated successfully!');
            }
        });

        // Click on profile image to change photo
        profileImage.addEventListener('click', () => {
            changePhotoBtn.click();
        });

        // Logout functionality
        logoutBtn.addEventListener('click', () => {
            // Add your logout logic here
            alert('Logout functionality would be implemented here');
        });

        // Close modals when clicking outside
        [editProfileModal, changePasswordModal, profilePhotoModal].forEach(modal => {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                    if (modal === changePasswordModal) {
                        passwordForm.reset();
                    }
                    if (modal === profilePhotoModal) {
                        selectedPhotoSrc = '';
                    }
                }
            });
        });
    </script>
</body>
</html>