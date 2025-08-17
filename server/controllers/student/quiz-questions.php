<?php
header('Content-Type: application/json');
session_start();

require_once(__DIR__ . '/../../config/db.php');
$database = new Database();
$conn = $database->connect();

// ✅ Ensure student is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode([
        'status' => 'error',
        'message' => 'Not logged in'
    ]);
    exit;
}

$student_id = $_SESSION['user_id'];

// ✅ Fetch the test_id from student_enrollment table
$sql = "SELECT test_id 
        FROM student_enrollment 
        WHERE student_id = :student_id 
        ORDER BY enrolled_on DESC 
        LIMIT 1";   // latest enrollment
$stmt = $conn->prepare($sql);
$stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
$stmt->execute();

$testRow = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$testRow) {
    http_response_code(404);
    echo json_encode([
        'status' => 'error',
        'message' => 'No test found for this student'
    ]);
    exit;
}

$test_id = intval($testRow['test_id']);

// ✅ Fetch questions via JOIN
$sql = "SELECT 
            q.question_id, 
            q.question_text, 
            q.option_a, 
            q.option_b, 
            q.option_c, 
            q.option_d, 
            q.correct_option,
            q.mark
        FROM test_questions tq
        INNER JOIN questions q ON tq.question_id = q.question_id
        WHERE tq.test_id = :test_id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':test_id', $test_id, PDO::PARAM_INT);
$stmt->execute();

$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ✅ Output response
echo json_encode([
    'status' => 'success',
    'test_id' => $test_id,
    'questions' => $questions
]);
?>
