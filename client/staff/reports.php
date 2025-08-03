<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        :root {
            --color-primary: #F97316;
            --color-primary-hover: #EA580C;
            --color-background: #FFFFFF;
            --color-surface: #F9FAFB;
            --color-text-primary: #111827;
            --color-text-secondary: #6B7280;
            --color-shadow: rgba(0, 0, 0, 0.08);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(145deg, var(--color-surface), #E5E7EB);
            margin: 0;
            min-height: 100vh;
            color: var(--color-text-primary);
            line-height: 1.6;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
        }

        header {
            background: var(--color-background);
            box-shadow: 0 4px 12px var(--color-shadow);
            padding: 16px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(8px);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-content h1 {
            font-size: 28px;
            font-weight: 700;
            color: var(--color-text-primary);
            margin: 0;
            letter-spacing: -0.025em;
        }

        .header-content p {
            color: var(--color-text-secondary);
            margin: 4px 0 0;
            font-size: 14px;
            font-weight: 500;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .profile img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--color-primary);
            transition: transform 0.3s ease, border-color 0.3s ease;
        }

        .profile img:hover {
            transform: scale(1.05);
            border-color: var(--color-primary-hover);
        }

        .profile-info p {
            margin: 0;
            font-size: 14px;
        }

        .profile-info .name {
            font-weight: 600;
            color: var(--color-text-primary);
        }

        .profile-info .role {
            color: var(--color-text-secondary);
            font-size: 13px;
        }

        .logout-btn {
            color: var(--color-text-secondary);
            cursor: pointer;
            font-weight: 500;
            transition: color 0.2s ease, transform 0.2s ease;
        }

        .logout-btn:hover {
            color: var(--color-primary);
            transform: translateY(-1px);
        }

        nav {
            margin: 24px 0;
            border-bottom: 1px solid #E5E7EB;
        }

        nav a {
            text-decoration: none;
            color: var(--color-text-secondary);
            padding: 12px 24px;
            display: inline-block;
            font-size: 16px;
            font-weight: 500;
            position: relative;
            transition: color 0.3s ease;
        }

        nav a.active, nav a:hover {
            color: var(--color-primary);
        }

        nav a.active::after, nav a:hover::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 24px;
            width: calc(100% - 48px);
            height: 2px;
            background: var(--color-primary);
            transition: background 0.3s ease;
        }

        h2 {
            font-size: 28px;
            font-weight: 700;
            color: var(--color-text-primary);
            margin: 32px 0 16px;
            letter-spacing: -0.025em;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .reports {
            background: var(--color-background);
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 6px 24px var(--color-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .reports:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .report-controls {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
            align-items: center;
        }

        select, button {
            padding: 12px;
            border: 1px solid #D1D5DB;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            background: var(--color-surface);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        select:focus, button:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
        }

        button {
            background: linear-gradient(90deg, var(--color-primary), #FB923C);
            color: #FFFFFF;
            border: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background: linear-gradient(90deg, var(--color-primary-hover), var(--color-primary));
            transform: translateY(-1px);
        }

        button:active {
            transform: translateY(0);
        }

        #report-content {
            border: 1px solid #D1D5DB;
            padding: 20px;
            border-radius: 8px;
            min-height: 150px;
            background: var(--color-surface);
            font-size: 14px;
            color: var(--color-text-primary);
            transition: border-color 0.2s ease;
        }

        #report-content:hover {
            border-color: var(--color-primary);
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

        <h2><i data-lucide="bar-chart-2"></i> Reports</h2>
        <div class="reports">
            <div class="report-controls">
                <select id="report-type">
                    <option value="quiz">Quiz Performance</option>
                    <option value="student">Student Progress</option>
                    <option value="class">Class Overview</option>
                </select>
                <button id="generate-report"><i data-lucide="play"></i> Generate Report</button>
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