<?php
session_start();
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Not logged in']);
    exit;
}

$student_id = $_SESSION['user_id'];
$test_id = isset($_GET['test_id']) ? intval($_GET['test_id']) : 0;

if ($test_id <= 0) {
    echo json_encode(['error' => 'Invalid test ID']);
    exit;
}

require_once('../../config/db.php');
$database = new Database();
$conn = $database->connect();

try {
    $stmt = $conn->prepare("
        SELECT score, total_marks 
        FROM student_quiz_results 
        WHERE user_id = :user_id AND test_id = :test_id
    ");
    $stmt->bindValue(':user_id', $student_id, PDO::PARAM_INT);
    $stmt->bindValue(':test_id', $test_id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $score = floatval($row['score']);
        $total_marks = floatval($row['total_marks']);
        $percentage = $total_marks > 0 ? ($score / $total_marks) * 100 : 0;

        echo json_encode([
            'score' => $score,
            'total_marks' => $total_marks,
            'percentage' => round($percentage),
            'student_name' => $_SESSION['student_name'] ?? 'Student'
        ]);
    } else {
        echo json_encode([
            'score' => 0,
            'total_marks' => 0,
            'percentage' => 0,
            'student_name' => $_SESSION['student_name'] ?? 'Student'
        ]);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
