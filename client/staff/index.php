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
    <!-- Header -->
    <header class="header">
        <h1>Staff Dashboard</h1>
        <button id="logout-btn" class="btn-logout">Logout</button>
    </header>

    <main class="container">
        <?php include('./nav.php') ?>

        <div class="welcome">
            <h2>Welcome back, Alex!</h2>
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
            <button><i data-lucide="bar-chart-3"></i> Analytics</button>
        </div>

        <div id="quiz-grid" class="quiz-grid"></div>
    </main>

    <?php include('../resource/api.php') ?>

    <script>
        // Create Lucide icons
        lucide.createIcons();

        // SESSION CHECK
        async function checkSession() {
            try {
                const res = await fetch('<?php echo $api; ?>helpers/sessionStatus.php', {
                    credentials: 'include'
                });
                const data = await res.json();
                if (!data.logged_in) {
                    window.location.href = './'; // redirect to login if not logged in
                }
            } catch (err) {
                console.error("Session check failed", err);
            }
        }

        // LOGOUT
        async function handleLogout() {
            const logoutBtn = document.getElementById("logout-btn");
            if (!logoutBtn) return;

            logoutBtn.addEventListener("click", async () => {
                try {
                    const res = await fetch('<?php echo $api; ?>helpers/logout.php', {
                        method: 'POST',
                        credentials: 'include',
                        headers: { 'Content-Type': 'application/json' }
                    });
                    const data = await res.json();
                    if (data.success) {
                        alert("Logout successful!");
                        window.location.href = "../";
                    } else {
                        alert("Logout failed!");
                    }
                } catch (err) {
                    alert("Logout error: " + err.message);
                }
            });
        }

        // QUIZZES
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

        document.getElementById('search-input')?.addEventListener('input', (e) => {
            renderQuizzes(e.target.value, document.getElementById('filter-status')?.value);
        });

        document.getElementById('filter-status')?.addEventListener('change', (e) => {
            renderQuizzes(document.getElementById('search-input')?.value, e.target.value);
        });

        // INITIALIZE
        window.addEventListener('DOMContentLoaded', () => {
            checkSession();
            handleLogout();
            renderQuizzes();
        });
    </script>
</body>
</html>
