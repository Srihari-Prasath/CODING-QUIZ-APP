<?php
include '../resource/conn.php';

$student_name = 'NAVEEN'; // Example: replace with $_SESSION['student_name']
$sql = "SELECT u.id AS student_id, u.name AS student_name, d.full_name AS department,
       AVG(st.score) AS avg_score,
       SUM((SELECT COUNT(*) FROM student_answers sa WHERE sa.student_test_id = st.student_test_id)) AS total_attempted,
       SUM((SELECT COUNT(*) FROM student_answers sa WHERE sa.student_test_id = st.student_test_id AND sa.is_correct = 1)) AS total_correct,
       SUM((SELECT COUNT(*) FROM student_answers sa WHERE sa.student_test_id = st.student_test_id AND sa.is_correct = 0)) AS total_wrong,
       COUNT(st.student_test_id) AS tests_taken
FROM student_tests st
JOIN users u ON st.student_id = u.id
JOIN departments d ON u.department_id = d.id
WHERE u.name = '" . mysqli_real_escape_string($conn, $student_name) . "'
GROUP BY u.id, u.name, d.full_name";
$result = mysqli_query($conn, $sql);
$student_data = ($result && mysqli_num_rows($result) > 0) ? mysqli_fetch_assoc($result) : null;

$test_list = [];
if ($student_data) {
    $test_query = "SELECT st.test_id, t.title, st.score, st.status FROM student_tests st JOIN tests t ON st.test_id = t.test_id WHERE st.student_id = {$student_data['student_id']} ORDER BY st.test_id DESC";
    $test_result = mysqli_query($conn, $test_query);
    if ($test_result !== false) {
        while ($row = mysqli_fetch_assoc($test_result)) {
            $test_list[] = $row;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Report Page</title>
    <style>
        body {
            background: #fff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 2rem;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(255, 152, 0, 0.15);
        }
        h2 {
            color: #FF9800;
            text-align: center;
            margin-bottom: 2rem;
        }
        .student {
            margin-bottom: 2rem;
        }
        .student h3 {
            color: #F57C00;
            margin-bottom: 1rem;
        }
        .department {
            font-size: 1rem;
            color: #888;
            margin-bottom: 0.5rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }
        th, td {
            border: 1px solid #FFA726;
            padding: 0.5rem 1rem;
            text-align: left;
        }
        th {
            background: #FFD54F;
            color: #F57C00;
        }
        td {
            background: #FFF8E1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Student Report Page</h2>
        <div class="student">
            <h3><?php echo htmlspecialchars($student_data['student_name'] ?? 'Student'); ?></h3>
            <div class="department">Department: <?php echo htmlspecialchars($student_data['department'] ?? ''); ?></div>
            <div class="analytics">
                <p><b>Average Score:</b> <?php echo isset($student_data['avg_score']) ? round($student_data['avg_score'],2) : '0'; ?></p>
                <p><b>Total Attempted:</b> <?php echo $student_data['total_attempted'] ?? '0'; ?></p>
                <p><b>Total Correct:</b> <?php echo $student_data['total_correct'] ?? '0'; ?></p>
                <p><b>Total Wrong:</b> <?php echo $student_data['total_wrong'] ?? '0'; ?></p>
                <p><b>Tests Taken:</b> <?php echo $student_data['tests_taken'] ?? '0'; ?></p>
                <p><b>Accuracy Percentage:</b> <?php echo (isset($student_data['total_attempted']) && $student_data['total_attempted'] > 0) ? round(($student_data['total_correct']/$student_data['total_attempted'])*100,2) : '0'; ?>%</p>
            </div>
            <?php if (!empty($test_list)): ?>
                <table>
                    <tr>
                        <th>Test Title</th>
                        <th>Score</th>
                        <th>Status</th>
                    </tr>
                    <?php foreach ($test_list as $result): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($result['title']); ?></td>
                            <td><?php echo htmlspecialchars($result['score']); ?></td>
                            <td><?php echo htmlspecialchars($result['status']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <div>No results available.</div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
