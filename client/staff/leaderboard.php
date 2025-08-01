<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            min-height: 100vh;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        header {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
        }
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header-content h1 {
            font-size: 24px;
            color: #333;
            margin: 0;
        }
        .header-content p {
            color: #666;
            margin: 5px 0 0;
            font-size: 14px;
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
        .profile-info p {
            margin: 0;
            font-size: 14px;
        }
        .profile-info .name {
            font-weight: bold;
            color: #333;
        }
        .profile-info .role {
            color: #666;
        }
        .logout-btn {
            color: #666;
            cursor: pointer;
        }
        .logout-btn:hover {
            color: #333;
        }
        nav {
            margin: 20px 0;
            border-bottom: 2px solid #e0e0e0;
        }
        nav a {
            text-decoration: none;
            color: #666;
            padding: 10px 20px;
            display: inline-block;
            font-size: 16px;
        }
        nav a.active, nav a:hover {
            color: #007bff;
            border-bottom: 2px solid #007bff;
        }
        h2 {
            font-size: 24px;
            color: #333;
            margin: 20px 0;
        }
        .leaderboard {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }
        th {
            color: #666;
            font-weight: normal;
        }
        td {
            color: #333;
        }
        tr {
            border-bottom: 1px solid #e0e0e0;
        }
    </style>
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

        <h2>Leaderboard</h2>
        <div class="leaderboard">
            <table>
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Student</th>
                        <th>Quiz</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody id="leaderboard-table"></tbody>
            </table>
        </div>
    </main>

    <script>
        // Mock data (replace with backend fetch)
        const leaderboardData = [
            { rank: 1, student: "John Doe", quiz: "Data Structures & Algorithms", score: 95 },
            { rank: 2, student: "Jane Smith", quiz: "React Fundamentals", score: 90 },
            { rank: 3, student: "Bob Johnson", quiz: "Database Management", score: 85 }
        ];

        // Initialize Lucide icons
        lucide.createIcons();

        // Render leaderboard
        function renderLeaderboard() {
            const leaderboardTable = document.getElementById('leaderboard-table');
            leaderboardTable.innerHTML = '';
            leaderboardData.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.rank}</td>
                    <td>${item.student}</td>
                    <td>${item.quiz}</td>
                    <td>${item.score}%</td>
                `;
                leaderboardTable.appendChild(row);
            });
        }

        // Initial render
        renderLeaderboard();
    </script>
</body>
</html>
