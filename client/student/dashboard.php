<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="../assets/css/student/dashboard.css">
</head>
<body>
    <header>
        <div class="container header-content">
            <div>
                <h1>Student Dashboard</h1>
                <p>Manage quizzes and monitor student progress</p>
            </div>
            <div class="profile-section">
                <a href="../profile.php" style="text-decoration: none;">
                    <div class="profile">
                        <img src="../assets/images/Infinity castle desktop wallpaper.jpg" alt="Profile">
                        <div class="profile-info">
                        </div>
                    </div>
                </a>
                <span id="theme-toggle" style="margin-top: 20px;" class="theme-toggle"><i data-lucide="moon"></i></span>
            </div>
        </div>
    </header>

    <main class="container">
        <nav>
            <a href="dashboard.php" class="active">Dashboard</a>
            <a href="quiz-attend.php">Quiz-attend</a>
            <a href="leaderboard.php">Leaderboard</a>
            <a href="Result.php">Result</a>
            <a href="reports.php">Reports</a>
        </nav>

        <div class="welcome">
            <h2>Welcome back, Alex! 👋</h2>
            <p>Manage your quizzes and monitor student progress.</p>
        </div>

        <div class="stats-grid">
            <div class="stats-card">
                <i data-lucide="book-open"></i>
                <div>
                    <h3>Quizzes Attended</h3>
                    <p>8</p>
                    <p class="description">This semester</p>
                    <p class="trend">+12% from last semester</p>
                </div>
            </div>
            <div class="stats-card">
                <i data-lucide="users"></i>
                <div>
                    <h3>Students percentage</h3>
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
                    <h3>More Quiz Have</h3>
                    <p>3</p>
                    <p class="description">Currently running</p>
                </div>
            </div>
        </div>

        <div class="filters">
            <a href="analytics.php" style="text-decoration: none;"><button><i data-lucide="bar-chart-3"></i> Analytics</button></a>
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

        // Theme toggle functionality
        const themeToggle = document.getElementById('theme-toggle');
        const body = document.body;

        function setTheme(theme) {
            body.setAttribute('data-theme', theme);
            themeToggle.innerHTML = theme === 'dark' ? '<i data-lucide="sun"></i>' : '<i data-lucide="moon"></i>';
            localStorage.setItem('theme', theme);
            lucide.createIcons();
        }

        // Load saved theme or default to light
        const savedTheme = localStorage.getItem('theme') || 'light';
        setTheme(savedTheme);

        themeToggle.addEventListener('click', () => {
            const currentTheme = body.getAttribute('data-theme') || 'light';
            setTheme(currentTheme === 'light' ? 'dark' : 'light');
        });

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

        function manageQuiz(quizId) {
            alert(`Managing quiz ID: ${quizId}`);
        }

        renderQuizzes();
    </script>
</body>
</html>