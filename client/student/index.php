<?php
session_start();
error_log("Session at dashboard: " . print_r($_SESSION, true));

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$roll_no = $_SESSION['roll_no'];
$full_name = $_SESSION['full_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="../assets/css/student/dashboard.css">
    <link rel="stylesheet" href="../assets/css/main.css">
</head>
<body>
    <?php include('./header.php'); ?>

    <main class="container">

        <nav>
            <a href="index.php" class="active">Dashboard</a>
            <a href="test-list.php">Quiz-attend</a>
            <a href="leaderboard.php">Leaderboard</a>
            <a href="Result.php">Result</a>
            <a href="reports.php">Reports</a>
        </nav>  

        <div style="background: linear-gradient(135deg, #f5d692ff, #ffffffff); 
            color: black; 
            padding: 20px 30px; 
            border-radius: 12px; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.15); 
            width:350px;
            margin: 20px 0; 
            font-family: Arial, sans-serif; 
            ">
    <h2 style="margin: 0; font-size: 24px; font-weight: 600;">
        Welcome back, <?php echo htmlspecialchars($full_name); ?>!
    </h2>
</div>

        <div class="stats-grid">
            <div class="stats-card">
                <i data-lucide="book-open"></i>
                <div>
                    <h3>Quizzes Attended</h3>
                    <p>8</p>
                    <p class="description">This semester</p>
                    
                </div>
            </div>

            <div class="stats-card">
                <i data-lucide="users"></i>
                <div>
                    <h3>Students percentage</h3>
                    <p>156</p>
                    <p class="description">Total this month</p>
                    
                </div>
            </div>

            <div class="stats-card">
                <i data-lucide="trending-up"></i>
                <div>
                    <h3>Avg. Performance</h3>
                    <p>78%</p>
                    <p class="description">Class average</p>
                    
                </div>
            </div>

            <div class="stats-card">
                <i data-lucide="clock"></i>
                <div>
                    <h3>Ongoing Quizzes</h3>
                    <p>3</p>
                    
                </div>
            </div>
        </div>

        <div class="filters" style="margin: 1rem 0; text-align: right;">
    <a href="analytics.php" style="text-decoration: none;">
        <button style="
            background: linear-gradient(135deg, #f97316, #ea580c);
            color: #fff;
            border: none;
            padding: 0.7rem 1.4rem;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
        " 
        onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 6px 14px rgba(0,0,0,0.2)';"
        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 10px rgba(0,0,0,0.15)';">
            <i data-lucide="bar-chart-3"></i> Analytics
        </button>
    </a>
</div>


        <div id="quiz-grid" class="quiz-grid"></div>

    </main>

    <?php include('../../footer.php'); ?>

    <script>
        // Theme toggle
        const themeToggle = document.getElementById('theme-toggle');
        const body = document.body;

        function setTheme(theme) {
            body.setAttribute('data-theme', theme);
            themeToggle.innerHTML = theme === 'dark'
                ? '<i data-lucide="sun"></i>'
                : '<i data-lucide="moon"></i>';
            localStorage.setItem('theme', theme);
            lucide.createIcons();
        }

        const savedTheme = localStorage.getItem('theme') || 'light';
        setTheme(savedTheme);

        themeToggle.addEventListener('click', () => {
            const currentTheme = body.getAttribute('data-theme') || 'light';
            setTheme(currentTheme === 'light' ? 'dark' : 'light');
        });

        // Quiz rendering
        function renderQuizzes(searchTerm = '', filterStatus = 'all') {
            const quizGrid = document.getElementById('quiz-grid');
            quizGrid.innerHTML = '';

            const filteredQuizzes = quizzes.filter(quiz => {
                const matchesSearch = quiz.title.toLowerCase().includes(searchTerm.toLowerCase())
                    || quiz.subject.toLowerCase().includes(searchTerm.toLowerCase());
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

        // Logout
        document.getElementById("logout-btn").addEventListener("click", async () => {
            try {
                const res = await fetch("<?php echo $api ?? ''; ?>helpers/logout.php", {
                    method: "POST",
                    credentials: "include",
                    headers: { "Content-Type": "application/json" },
                });

                const data = await res.json();

                if (res.ok) {
                    alert("Logout successful!");
                    window.location.href = "../auth/login.php";
                } else {
                    alert("Logout failed: " + data.error);
                }
            } catch (err) {
                alert("Logout error: " + err.message);
            }
        });

        lucide.createIcons();
    </script>

</body>
</html>
