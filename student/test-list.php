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
    exit;
}

$year = $_SESSION['year'];  
$department_id = $_SESSION['department_id'];

// fetch tests along with topic & sub_topic names
$stmt = $conn->prepare("
    SELECT 
        t.test_id, 
        t.title, 
        t.description, 
        t.subject, 
        t.added_by, 
        t.num_questions, 
        t.department_id, 
        t.year, 
        t.date, 
        t.time_slot, 
        t.duration_minutes, 
        t.created_at, 
        t.is_active,
        tp.title AS topic_name,
        st.title AS sub_topic_name
    FROM tests t
    LEFT JOIN topics tp ON t.topic_id = tp.topic_id
    LEFT JOIN sub_topics st ON t.sub_topic_id = st.sub_topic_id
    WHERE t.year = ? AND t.department_id = ? AND t.is_active = 1
    ORDER BY t.created_at DESC
");

$stmt->bind_param("ii", $year, $department_id);
$stmt->execute();
$result = $stmt->get_result();

$tests = [];
while ($row = $result->fetch_assoc()) {
    $tests[] = $row;
}
$stmt->close();
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Quiz | IQ Arena</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/student/dash.css">
    <link rel="stylesheet" href="../assets/css/resource/style.css">

</head>

<body>

    <?php include('./header.php'); ?>

    <main class="container">

        <nav>
            <a href="index.php">Dashboard</a>
            <a href="test-list.php" class="active">Daily Quiz</a>
            <a href="leaderboard.php">Leaderboard</a>
            <a href="Result.php">Result</a>
            <a href="reports.php">Reports</a>
        </nav>

<div id="quiz-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
    <?php if (count($tests) > 0): ?>
        <?php foreach ($tests as $test): ?>
            <div class="quiz-card bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 p-5 text-left">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">
                    <?php echo htmlspecialchars($test['title']); ?>
                </h3>
                <p class="text-gray-600 mb-3"><?php echo htmlspecialchars($test['description']); ?></p>

                <div class="text-sm text-gray-500 space-y-1 mb-4">
                    <p><strong class="text-gray-700">Subject:</strong> <?php echo htmlspecialchars($test['subject']); ?></p>
                    <p><strong class="text-gray-700">Topic:</strong> <?php echo htmlspecialchars($test['topic_name'] ?? 'N/A'); ?></p>
                    <p><strong class="text-gray-700">Sub Topic:</strong> <?php echo htmlspecialchars($test['sub_topic_name'] ?? 'N/A'); ?></p>
                    <p><strong class="text-gray-700">Date:</strong> <?php echo htmlspecialchars($test['date']); ?></p>
                    <p><strong class="text-gray-700">Time Slot:</strong> <?php echo htmlspecialchars($test['time_slot']); ?></p>
                    <p><strong class="text-gray-700">Duration:</strong> <?php echo htmlspecialchars($test['duration_minutes']); ?> mins</p>
                </div>

                <a href="./test.php?id=<?php echo $test['test_id']; ?>"
                   class="mt-auto inline-block bg-orange-500 hover:bg-orange-600 text-white font-medium px-4 py-2 rounded-lg transition duration-300">
                    Start Test
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="col-span-3 text-gray-500 text-lg">No tests available for your year and department.</p>
    <?php endif; ?>
</div>



    </main>

    <?php include('../resource/footer.php'); ?>

</body>

</html>