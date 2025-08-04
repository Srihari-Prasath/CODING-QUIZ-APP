<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        :root {
            /* Light theme variables */
            --color-primary: #F97316;
            --color-primary-hover: #EA580C;
            --color-background: #FFFFFF;
            --color-surface: #F9FAFB;
            --text: #1a1a1a;
            --card-border: #e0e0e0;
            --shadow: rgba(0, 0, 0, 0.1);
        }

        [data-theme="dark"] {
            /* Dark theme variables */
            --color-primary: #F97316;
            --color-primary-hover: #EA580C;
            --color-background: #1a1a1a;
            --color-surface: #2d2d2d;
            --text: #f5f5f5;
            --card-border: #3d3d3d;
            --shadow: rgba(0, 0, 0, 0.3);
        }

        body {
            background: var(--color-background);
            color: var(--text);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            transition: all 0.3s ease;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background: var(--color-surface);
            padding: 1rem 0;
            border-bottom: 1px solid var(--card-border);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .profile-info {
            display: flex;
            flex-direction: column;
        }

        .logout-btn {
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
            background: var(--color-surface);
        }

        .theme-toggle {
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
            background: var(--color-surface);
            margin-left: 10px;
        }

        nav {
            background: var(--color-surface);
            padding: 1rem;
            border-radius: 8px;
            margin: 1rem 0;
        }

        nav a {
            color: var(--text);
            text-decoration: none;
            padding: 0.5rem 1rem;
            margin-right: 1rem;
            border-radius: 4px;
        }

        nav a.active,
        nav a:hover {
            background: var(--color-primary);
            color: #ffffff;
        }

        .welcome {
            margin: 2rem 0;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stats-card {
            background: var(--color-surface);
            border: 1px solid var(--card-border);
            padding: 1.5rem;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 2px 4px var(--shadow);
        }

        .stats-card i {
            font-size: 2rem;
            color: var(--color-primary);
        }

        .stats-card .trend {
            color: #22c55e;
            font-size: 0.9rem;
        }

        .filters {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .filters button {
            background: var(--color-primary);
            color: #ffffff;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filters button:hover {
            background: var(--color-primary-hover);
        }

        .quiz-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1rem;
        }

        .quiz-card {
            background: var(--color-surface);
            border: 1px solid var(--card-border);
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px var(--shadow);
        }

        .quiz-card h3 {
            margin: 0 0 0.5rem;
            color: var(--text);
        }

        .quiz-details {
            display: flex;
            gap: 1rem;
            margin: 1rem 0;
            color: var(--text);
        }

        .quiz-actions button {
            background: var(--color-primary);
            color: #ffffff;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
        }

        .quiz-actions button:hover {
            background: var(--color-primary-hover);
        }

        .no-results {
            text-align: center;
            padding: 2rem;
            background: var(--color-surface);
            border: 1px solid var(--card-border);
            border-radius: 8px;
        }
    </style>
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
                        <span id="logout-btn" class="logout-btn"><i data-lucide="log-out"></i></span>
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