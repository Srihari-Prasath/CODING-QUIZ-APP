<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="../assets/css/staff/leaderboard.css">
   
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
        <nav>
            <a href="index.php">Dashboard</a>
            <a href="create-test.php">Create Test</a>
            <a href="upload-questions.php">Upload Questions</a>
            <a href="leaderboard.php" class="active">Leaderboard</a>
            <a href="reports.php">Reports</a>
        </nav>

        <div class="leaderboard-header">
            <div>
                <h2><i data-lucide="trophy"></i> Computer Science Leaderboard</h2>
                <p>Top performers in your department</p>
            </div>
            <div class="live-badge">
                <i data-lucide="trending-up"></i> Updated Live
            </div>
        </div>

        <div class="podium">
            <!-- Top 3 Podium -->
        </div>

        <div class="leaderboard">
            <h3>Complete Rankings</h3>
            <p>All students ranked by average test scores</p>
            <div id="leaderboard-table"></div>
        </div>

        <div class="stats-grid">
            <div class="stats-card">
                <h3>Department Average</h3>
                <div class="value">84.2%</div>
                <p class="description">Overall performance</p>
            </div>
            <div class="stats-card">
                <h3>Total Students</h3>
                <div class="value">156</div>
                <p class="description">Active participants</p>
            </div>
            <div class="stats-card">
                <h3>Tests Completed</h3>
                <div class="value">2,847</div>
                <p class="description">This semester</p>
            </div>
        </div>
    </main>

    <script>
        // Mock data
        const leaderboardData = [
            { rank: 1, name: "Alice Johnson", score: 95, testsCompleted: 18, avatar: "AJ" },
            { rank: 2, name: "Bob Smith", score: 92, testsCompleted: 16, avatar: "BS" },
            { rank: 3, name: "Carol Davis", score: 89, testsCompleted: 20, avatar: "CD" },
            { rank: 4, name: "David Wilson", score: 87, testsCompleted: 15, avatar: "DW" },
            { rank: 5, name: "Emma Brown", score: 85, testsCompleted: 17, avatar: "EB" },
            { rank: 6, name: "Frank Miller", score: 83, testsCompleted: 14, avatar: "FM" },
            { rank: 7, name: "Grace Lee", score: 82, testsCompleted: 19, avatar: "GL" },
            { rank: 8, name: "Henry Taylor", score: 80, testsCompleted: 13, avatar: "HT" },
            { rank: 9, name: "Ivy Chen", score: 78, testsCompleted: 16, avatar: "IC" },
            { rank: 10, name: "Jack Robinson", score: 76, testsCompleted: 12, avatar: "JR" }
        ];

        // Initialize Lucide icons
        lucide.createIcons();

        // Render podium
        function renderPodium() {
            const podium = document.querySelector('.podium');
            const topThree = leaderboardData.slice(0, 3);
            topThree.forEach((student, index) => {
                const card = document.createElement('div');
                card.className = `podium-card rank-${student.rank}`;
                card.innerHTML = `
                    <div class="rank">
                        ${student.rank === 1 ? '<i data-lucide="trophy" style="color: var(--color-gold);"></i>' : 
                         student.rank === 2 ? '<i data-lucide="medal" style="color: var(--color-silver);"></i>' : 
                         '<i data-lucide="award" style="color: var(--color-bronze);"></i>'}
                        <span class="badge">#${student.rank}</span>
                    </div>
                    <div class="avatar">${student.avatar}</div>
                    <h3>${student.name}</h3>
                    <p class="tests">${student.testsCompleted} tests completed</p>
                    <div class="score">${student.score}%</div>
                    <p class="score-label">Average Score</p>
                `;
                podium.appendChild(card);
            });
            lucide.createIcons();
        }

        // Render leaderboard
        function renderLeaderboard() {
            const leaderboardTable = document.getElementById('leaderboard-table');
            leaderboardTable.innerHTML = '';
            leaderboardData.forEach(student => {
                const item = document.createElement('div');
                item.className = `leaderboard-item rank-${student.rank}`;
                item.innerHTML = `
                    <div class="left">
                        <div class="rank">
                            ${student.rank === 1 ? '<i data-lucide="trophy" style="color: var(--color-gold);"></i>' : 
                             student.rank === 2 ? '<i data-lucide="medal" style="color: var(--color-silver);"></i>' : 
                             student.rank === 3 ? '<i data-lucide="award" style="color: var(--color-bronze);"></i>' : ''}
                            <span class="badge">#${student.rank}</span>
                        </div>
                        <div class="avatar">${student.avatar}</div>
                        <div class="info">
                            <p>${student.name}</p>
                            <p class="tests">${student.testsCompleted} tests completed</p>
                        </div>
                    </div>
                    <div class="right">
                        <div class="score">${student.score}%</div>
                        <p class="score-label">avg score</p>
                    </div>
                `;
                leaderboardTable.appendChild(item);
            });
            lucide.createIcons();
        }

        // Back button functionality (mock)
        document.querySelector('.back-btn')?.addEventListener('click', () => {
            window.location.href = 'index.php';
        });

        // Initial render
        renderPodium();
        renderLeaderboard();
    </script>
</body>
</html>