<?php
require_once '../resource/conn.php';
require_once '../resource/session.php';

$student_id = $_GET['student_id'] ?? null;
if (!$student_id) {
    echo '<div class="error">No student selected.</div>';
    exit;
}

// Fetch student info
$student_sql = "SELECT u.id, u.name, d.full_name AS department, u.year FROM users u LEFT JOIN departments d ON u.department_id = d.id WHERE u.id = '" . mysqli_real_escape_string($conn, $student_id) . "' LIMIT 1";
$student_result = mysqli_query($conn, $student_sql);
$student = mysqli_fetch_assoc($student_result);

// Fetch all tests attended by the student
$tests_sql = "SELECT st.student_test_id, t.title, t.subject, t.topic_id, st.score, st.end_time FROM student_tests st JOIN tests t ON st.test_id = t.test_id WHERE st.student_id = '" . mysqli_real_escape_string($conn, $student_id) . "' ORDER BY st.end_time DESC";
$tests_result = mysqli_query($conn, $tests_sql);
$tests = [];
while ($row = mysqli_fetch_assoc($tests_result)) {
    $tests[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Detailed Report</title>
    <style>
        body { background: #fff; padding: 2rem; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        h2 { color: #F97316; margin-bottom: 1rem; }
        .info { margin-bottom: 2rem; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.08); border-radius: 8px; }
        th, td { padding: 1rem; text-align: left; }
        th { background: #FF8C00; color: #fff; }
        tr:nth-child(even) { background: #f8f8f8; }
        tr:hover { background: #f1f1f1; }
        td { border-bottom: 1px solid #eee; }
        .back { display: inline-block; margin-bottom: 1rem; color: #F97316; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <a href="report.php" class="back">&larr; Back to Report</a>
    <h2>Student Details</h2>
    <div class="info">
        <strong>Name:</strong> <?= htmlspecialchars($student['name'] ?? '') ?><br>
        <strong>Department:</strong> <?= htmlspecialchars($student['department'] ?? '') ?><br>
        <strong>Year:</strong> <?= htmlspecialchars($student['year'] ?? '') ?><br>
        <strong>ID:</strong> <?= htmlspecialchars($student['id'] ?? '') ?>
    </div>
    <h2>Tests Attended</h2>
    <table>
        <tr>
            <th>Test Title</th>
            <th>Subject</th>
            <th>Score</th>
            <th>Date</th>
            <th>Topic ID</th>
        </tr>
        <?php foreach ($tests as $test): ?>
        <tr>
            <td><?= htmlspecialchars($test['title']) ?></td>
            <td><?= htmlspecialchars($test['subject']) ?></td>
            <td><?= htmlspecialchars($test['score']) ?></td>
            <td><?= htmlspecialchars($test['end_time']) ?></td>
            <td><?= htmlspecialchars($test['topic_id']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
