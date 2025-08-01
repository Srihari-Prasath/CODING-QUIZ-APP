
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
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
        .reports {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .report-controls {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        select, button {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
        }
        button {
            background-color: #007bff;
            color: #fff;
            border: none;
        }
        button:hover {
            background-color: #0056b3;
        }
        #report-content {
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 4px;
            min-height: 100px;
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
            <a href="leaderboard.php">Leaderboard</a>
            <a href="reports.php" class="active">Reports</a>
        </nav>

        <h2>Reports</h2>
        <div class="reports">
            <div class="report-controls">
                <select id="report-type">
                    <option value="quiz">Quiz Performance</option>
                    <option value="student">Student Progress</option>
                    <option value="class">Class Overview</option>
                </select>
                <button id="generate-report">Generate Report</button>
            </div>
            <div id="report-content"></div>
        </div>
    </main>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Generate report
        document.getElementById('generate-report').addEventListener('click', () => {
            const reportType = document.getElementById('report-type').value;
            const reportContent = document.getElementById('report-content');
            // Mock backend call
            reportContent.innerHTML = `<p>Generated ${reportType} report. (Sample data)</p>`;
            // Replace with fetch to backend
            // fetch(`/api/reports?type=${reportType}`).then(res => res.json()).then(data => { ... })
        });
    </script>
</body>
</html>
