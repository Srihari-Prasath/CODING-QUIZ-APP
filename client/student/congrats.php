<?php
session_start();

// Redirect to dashboard if quiz not submitted
if (!isset($_SESSION['quiz_submitted']) || $_SESSION['quiz_submitted'] !== true) {
    header("Location: index.php");
    exit;
}

// Get score from GET parameter (optional)
$score = isset($_GET['score']) ? intval($_GET['score']) : 0;
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>🎉 Congratulations!</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="stylesheet" href="https://cdn.tailwindcss.com" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
  />
  <link rel="stylesheet" href="../assets/css/student/congrats.css" />
  
  <script>
    // Disable back button and redirect to dashboard if back is pressed
    history.pushState(null, null, location.href);
    window.onpopstate = function () {
        window.location.replace('index.php');
    };
  </script>
</head>

<body>
  <!-- Rain & particle layers -->
  <canvas id="rainCanvas"></canvas>
  <canvas id="particleCanvas"></canvas>

  <!-- Trophy Card -->
  <div class="center-card">
    <i class="fas fa-trophy text-yellow-400 text-8xl mb-4 drop-shadow-xl"></i>
    <h1 class="title">Congratulations!</h1>
    <p class="subtitle">You rocked the quiz!</p>
    
    <?php if ($score > 0): ?>
      <p class="text-lg font-semibold mb-4">Your Score: <?php echo $score; ?></p>
    <?php endif; ?>

    <!-- Buttons -->
    <a href="leaderboard.php" class="btn btn-primary">Leaderboard</a>
    <a href="index.php" class="btn btn-secondary">Dashboard</a>
  </div>

  <script src="../assets/js/student/congrats.js"></script>

  <?php
  // Clear quiz_submitted flag so this page can't be revisited without taking quiz again
  unset($_SESSION['quiz_submitted']);
  ?>
</body>
</html>
