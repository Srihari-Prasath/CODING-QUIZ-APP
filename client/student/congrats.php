<?php
session_start();

// Redirect to dashboard if quiz not submitted
// if (!isset($_SESSION['quiz_submitted']) || $_SESSION['quiz_submitted'] !== true) {
//     header("Location: index.php");
//     exit;
// }

// Get score from GET parameter (optional)
$score = isset($_GET['score']) ? intval($_GET['score']) : 0;
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>🎉 Quiz Completed!</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="stylesheet" href="https://cdn.tailwindcss.com" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
  />
  <link rel="stylesheet" href="../assets/css/student/congrats.css" />
  
  <script>
  
    history.pushState(null, null, location.href);
    window.onpopstate = function () {
        window.location.replace('index.php');
    };
  </script>

</head>

<body>
  
  <iframe src="https://lottie.host/embed/df5d03f5-657c-4fb6-a16e-94c35207613c/oKtw2PfFjZ.lottie" class="full-page-animation"></iframe>

  
  <div class="centered-animation">
    <iframe src="https://lottie.host/embed/49c65b77-e05c-4d55-9221-fc149bc4d8e7/pAvAMLBqUV.lottie" style="width:100%;height:100%;border:none;"></iframe>
  </div>

  <div class="center-card">
    <p class="subtitle">You rocked the quiz!</p>
    
    <?php if ($score > 0): ?>
      <p class="text-lg font-semibold mb-4">Your Score: <?php echo $score; ?></p>
    <?php endif; ?>

   
    <a href="leaderboard.php" class="btn btn-primary">Leaderboard</a>
    <a href="index.php" class="btn btn-secondary">Dashboard</a>
  </div>

  <?php
  unset($_SESSION['quiz_submitted']);
  ?>
</body>
</html>