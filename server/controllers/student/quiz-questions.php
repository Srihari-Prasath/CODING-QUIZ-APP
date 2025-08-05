<?php
header('Content-Type: application/json');


require_once('../../config/db.php');
$database = new Database();
$conn = $database->connect();

// Validate input
if (!isset($_GET['test_id']) || !is_numeric($_GET['test_id'])) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing or invalid test_id'
    ]);
    exit;
}

$test_id = intval($_GET['test_id']);


$sql = "SELECT question_id, question_text, option_a, option_b, option_c, option_d FROM questions WHERE test_id = :test_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':test_id', $test_id, PDO::PARAM_INT);
$stmt->execute();

$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);


echo json_encode([
    'status' => 'success',
    'test_id' => $test_id,
    'questions' => $questions
]);
?>
