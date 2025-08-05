<?php
$score = isset($_GET['score']) ? intval($_GET['score']) : 0;
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>🎉 Congratulations!</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="https://cdn.tailwindcss.com">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/student/congrats.css">
  <script>src="../assets/js/student/congrats.js"</script>


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



    <!-- Buttons -->
    <a href="leaderboard.php" class="btn btn-primary">Leaderboard</a>
    <a href="dashboard.php"  class="btn btn-secondary">Dashboard</a>
  </div>

  <script src="assets/js/congrats.js"></script>
</body>
</html>