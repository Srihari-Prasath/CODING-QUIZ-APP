<?php 

include("../resource/conn.php");

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',
    'secure' => isset($_SERVER['HTTPS']),
    'httponly' => true,
    'samesite' => 'Lax'
]);
session_start();


if (!isset($_SESSION['role_id'])) { 
     header("Location: ../login.php");
           
        
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <script src="https://unpkg.com/lucide@latest"></script>
      <script src="https://cdn.tailwindcss.com"></script>
      
    <link rel="stylesheet" href="../assets/css/student/dash.css">
    <link rel="stylesheet" href="../assets/css/resource/style.css">
    
</head>
<body>
    <?php include('./header.php'); ?>

    <main class="container">

        <nav>
            <a href="index.php" class="active">Dashboard</a>
            <a href="test-list.php">Daily Quiz</a>
            <a href="leaderboard.php">Leaderboard</a>
            <a href="Result.php">Result</a>
            <a href="reports.php">Reports</a>
        </nav>  

        <div class="welcome">
            
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
                    <h3>Ongoing Quizzes</h3>
                    <p>3</p>
                    <p class="description">Currently running</p>
                </div>
            </div>
        </div>

        <div class="filters">
            <a href="analytics.php" style="text-decoration: none;">
                <button><i data-lucide="bar-chart-3"></i> Analytics</button>
            </a>
        </div>

        <div id="quiz-grid" class="quiz-grid"></div>

    </main>

  <?php include('../resource/footer.php'); ?>

</body>
</html>

