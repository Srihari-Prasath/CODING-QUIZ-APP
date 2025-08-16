<?php
session_start();

// Redirect to dashboard if quiz not submitted
// if (!isset($_SESSION['quiz_submitted']) || $_SESSION['quiz_submitted'] !== true) {
//     header("Location: index.php");
//     exit;
// }

// Get score from GET parameter (optional)
$score = isset($_GET['score']) ? intval($_GET['score']) : 0;
// Assume max score is 10 for 100%
$percentage = ($score / 10) * 100;
// Mock student name (replace with actual session variable if available)
$student_name = isset($_SESSION['student_name']) ? $_SESSION['student_name'] : "Student";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Completed!</title>
    <link rel="stylesheet" href="https://cdn.tailwindcss.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --color-primary: #F97316; 
            --color-primary-hover: #EA580C;
            --color-secondary: #FF8C00; 
            --color-background: #FFFFFF; 
            --color-surface: #F5F5F5; 
            --text: #1A120B; 
            --text-secondary: #D97706; 
            --card-border: #E5E7EB; 
            --shadow: rgba(0, 0, 0, 0.1);
            --gradient-primary: linear-gradient(135deg, #F97316 0%, #EA580C 100%);
        }

        body {
            background: var(--color-background);
            color: var(--text);
            font-family: 'Arial', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow-x: hidden;
            position: relative;
        }

        .full-page-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            border: none;
        }

        .centered-animation {
            position: absolute;
            top: 20%;
            width: 200px;
            height: 200px;
            z-index: 0;
        }

        .center-card {
            text-align: center;
            z-index: 10;
        }

        .progress-circle {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 1rem auto;
        }

        .progress-circle svg {
            width: 100%;
            height: 100%;
            transform: rotate(-90deg);
        }

        .progress-circle .background-circle {
            fill: none;
            stroke: var(--color-surface);
            stroke-width: 8;
        }

        .progress-circle .progress-ring {
            fill: none;
            stroke: var(--color-primary);
            stroke-width: 8;
            stroke-dasharray: 339.29;
            stroke-dashoffset: 339.29;
            animation: progress 2s ease-out forwards;
        }

        @keyframes progress {
            to {
                stroke-dashoffset: calc(339.29 * (100 - <?php echo $percentage; ?>) / 100);
            }
        }

        .progress-circle .percentage {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--color-primary);
        }

        .subtitle {
            font-size: 1.75rem;
            font-weight: bold;
            color: var(--text);
            margin-bottom: 1rem;
        }

        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            margin: 0.5rem;
        }

        .btn-primary {
            background: var(--gradient-primary);
            color: #FFFFFF;
        }

        .btn-primary:hover {
            background: var(--color-primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(249, 115, 22, 0.3);
        }

        .btn-secondary {
            background: #E5E7EB;
            color: var(--text);
            border: 1px solid var(--card-border);
        }

        .btn-secondary:hover {
            background: #D1D5DB;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .center-card {
            animation: fadeIn 1s ease-out;
        }
    </style>
</head>
<body>
    <iframe src="https://lottie.host/embed/df5d03f5-657c-4fb6-a16e-94c35207613c/oKtw2PfFjZ.lottie" class="full-page-animation"></iframe>

    <!-- <div class="centered-animation">
        <iframe src="https://lottie.host/embed/49c65b77-e05c-4d55-9221-fc149bc4d8e7/pAvAMLBqUV.lottie" style="width:100%;height:100%;border:none;"></iframe>
    </div> -->

    <div class="center-card">
        <!-- <p class="subtitle">You rocked the quiz!</p> -->
        <div class="progress-circle">
            <svg>
                <circle class="background-circle" cx="60" cy="60" r="54"></circle>
                <circle class="progress-ring" cx="60" cy="60" r="54"></circle>
            </svg>
            <div class="percentage"><?php echo $percentage; ?>%</div>
        </div>
        <p class="text-lg font-semibold mb-2">Score: <?php echo $score; ?> / 10</p>
        <p class="text-md text-gray-500 mb-4"><?php echo htmlspecialchars($student_name); ?></p>
        <div class="flex justify-center gap-4">
            <a href="leaderboard.php" class="btn btn-primary">Leaderboard</a>
            <a href="index.php" class="btn btn-secondary">Dashboard</a>
        </div>
    </div>

    <?php
    unset($_SESSION['quiz_submitted']);
    ?>

    <script>
        // Prevent back navigation
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            window.location.replace('index.php');
        };
    </script>
</body>
</html>