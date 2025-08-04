
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="../assets/css/staff/dashboard.css">
</head>
<body>
    <header>
        <div class="container header-content">
            <div>
                <h1>Staff Dashboard</h1>
                <p>Manage quizzes and monitor student progress</p>
            </div>
            <div class="profile">
                <img src="/placeholder-avatar.jpg" alt="Profile">
                <div class="profile-info">
                    <p class="name">Alex Thompson</p>
                    <p class="role">Faculty</p>
                </div>
                <span id="logout-btn" class="logout-btn"><i data-lucide="log-out"></i></span>
            </div>
        </div>
    </header>

    <main class="container">
      <?php include('./nav.php') ?>
        <div class="welcome">
            <h2>Welcome back, Alex! 👋</h2>
            <p>Manage your quizzes and monitor student progress.</p>
        </div>

        <div class="stats-grid">
            <div class="stats-card">
                <i data-lucide="book-open"></i>
                <div>
                    <h3>Quizzes Created</h3>
                    <p>8</p>
                    <p class="description">This semester</p>
                    <p class="trend">+12% from last semester</p>
                </div>
            </div>
            <div class="stats-card">
                <i data-lucide="users"></i>
                <div>
                    <h3>Students Evaluated</h3>
                    <p>156</p>
                    <p class="description">Total this month</p>
                    <p class="trend">+8% from last month</p>
                </div>
            </div>
            <div class="stats-card">
                <i data-lucide="trending-up"></i>
                <div>
                    <h3>Avg. Performance</h3>
                    <p>78%</p>
                    <p class="description">Class average</p>
                    <p class="trend">+3% from last term</p>
                </div>
            </div>
            <div class="stats-card">
                <i data-lucide="clock"></i>
                <div>
                    <h3>Active Quizzes</h3>
                    <p>3</p>
                    <p class="description">Currently running</p>
                </div>
            </div>
        </div>

        <div class="filters">
            <div class="search-container">
                <i data-lucide="search"></i>
                <input id="search-input" type="text" placeholder="Search quizzes...">
            </div>
            <select id="filter-status">
                <option value="all">All Quizzes</option>
                <option value="active">Active</option>
                <option value="upcoming">Upcoming</option>
                <option value="completed">Completed</option>
            </select>
            <button><i data-lucide="bar-chart-3"></i> Analytics</button>
        </div>

        <div id="quiz-grid" class="quiz-grid"></div>
    </main>

    <script>
        // Mock data (replace with backend fetch)
        const quizzes = [
            {
                id: "1",
                title: "Data Structures & Algorithms",
                subject: "Computer Science",
                instructor: "Dr. Sarah Johnson",
                duration: 90,
                totalQuestions: 50,
                enrolledStudents: 28,
                maxStudents: 30,
                status: "active"
            },
            {
                id: "2",
                title: "React Fundamentals",
                subject: "Web Development",
                instructor: "Prof. Mike Chen",
                duration: 60,
                totalQuestions: 30,
                enrolledStudents: 15,
                maxStudents: 25,
                status: "upcoming"
            },
            {
                id: "3",
                title: "Database Management",
                subject: "Computer Science",
                instructor: "Dr. Emily Davis",
                duration: 120,
                totalQuestions: 40,
                enrolledStudents: 22,
                maxStudents: 30,
                status: "completed"
            }
        ];

        lucide.createIcons();

        
        function renderQuizzes(searchTerm = '', filterStatus = 'all') {
            const quizGrid = document.getElementById('quiz-grid');
            quizGrid.innerHTML = '';
            const filteredQuizzes = quizzes.filter(quiz => {
                const matchesSearch = quiz.title.toLowerCase().includes(searchTerm.toLowerCase()) ||
                                     quiz.subject.toLowerCase().includes(searchTerm.toLowerCase());
                const matchesFilter = filterStatus === 'all' || quiz.status === filterStatus;
                return matchesSearch && matchesFilter;
            });

            if (filteredQuizzes.length === 0) {
                quizGrid.innerHTML = `
                    <div class="no-results">
                        <i data-lucide="book-open"></i>
                        <h3>No quizzes found</h3>
                        <p>Try adjusting your search or filter criteria.</p>
                    </div>
                `;
                lucide.createIcons();
                return;
            }

            filteredQuizzes.forEach(quiz => {
                const quizCard = document.createElement('div');
                quizCard.className = 'quiz-card';
                quizCard.innerHTML = `
                    <h3>${quiz.title}</h3>
                    <p>${quiz.subject}</p>
                    <p>Instructor: ${quiz.instructor}</p>
                    <div class="quiz-details">
                        <span><i data-lucide="clock"></i>${quiz.duration} min</span>
                        <span><i data-lucide="book-open"></i>${quiz.totalQuestions} Qs</span>
                        <span><i data-lucide="users"></i>${quiz.enrolledStudents}/${quiz.maxStudents}</span>
                    </div>
                    <div class="quiz-actions">
                        <button onclick="manageQuiz('${quiz.id}')">Manage</button>
                    </div>
                `;
                quizGrid.appendChild(quizCard);
            });
            lucide.createIcons();
        }

       
        document.getElementById('search-input').addEventListener('input', (e) => {
            renderQuizzes(e.target.value, document.getElementById('filter-status').value);
        });

        document.getElementById('filter-status').addEventListener('change', (e) => {
            renderQuizzes(document.getElementById('search-input').value, e.target.value);
        });

       
        function manageQuiz(quizId) {
            alert(`Managing quiz ID: ${quizId}`);
            
        }

        
        renderQuizzes();
    </script>
</body>
</html>
