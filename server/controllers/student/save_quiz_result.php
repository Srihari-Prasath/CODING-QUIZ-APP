<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method, POST required'
    ]);
    exit;
}

require_once('../../config/db.php');
$database = new Database();
$conn = $database->connect(); // Assuming PDO connection

$data = json_decode(file_get_contents('php://input'), true);

if (
    !isset($data['user_id']) ||
    !isset($data['test_id']) ||
    !isset($data['score']) ||
    !isset($data['total_marks'])
) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing required data (user_id, test_id, score, total_marks)'
    ]);
    exit;
}

$user_id = intval($data['user_id']);
$test_id = intval($data['test_id']);
$score = intval($data['score']);
$total_marks = intval($data['total_marks']);

try {
    // Validate user_id exists
    $stmtUser = $conn->prepare("SELECT 1 FROM users WHERE user_id = :user_id");
    $stmtUser->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmtUser->execute();
    if ($stmtUser->fetchColumn() === false) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid user_id: does not exist'
        ]);
        exit;
    }

    // Validate test_id exists
    $stmtTest = $conn->prepare("SELECT 1 FROM tests WHERE test_id = :test_id");
    $stmtTest->bindParam(':test_id', $test_id, PDO::PARAM_INT);
    $stmtTest->execute();
    if ($stmtTest->fetchColumn() === false) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid test_id: does not exist'
        ]);
        exit;
    }

    // Insert or update score and total_marks
    $sql = "
        INSERT INTO student_quiz_results (user_id, test_id, score, total_marks, submitted_at)
        VALUES (:user_id, :test_id, :score, :total_marks, NOW())
        ON DUPLICATE KEY UPDATE 
            score = VALUES(score), 
            total_marks = VALUES(total_marks),
            submitted_at = NOW()
    ";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':test_id', $test_id, PDO::PARAM_INT);
    $stmt->bindParam(':score', $score, PDO::PARAM_INT);
    $stmt->bindParam(':total_marks', $total_marks, PDO::PARAM_INT);

    $stmt->execute();

    echo json_encode([
        'status' => 'success',
        'message' => 'Score saved successfully'
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to save score',
        'error' => $e->getMessage()
    ]);
}
?>
