<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="../assets/css/staff/reports.css">
    
       
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