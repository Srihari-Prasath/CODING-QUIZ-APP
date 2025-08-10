<?php
session_start();
require_once('../../config/db.php');

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(["error" => "Not logged in"]);
    exit;
}

$student_id = $_SESSION['user_id'];
$test_id = $_POST['test_id'] ?? null;

if (!$test_id) {
    http_response_code(400);
    echo json_encode(["error" => "Test ID is required"]);
    exit;
}

$database = new Database();
$conn = $database->connect();

$sql = "INSERT INTO student_enrollment (student_id, test_id, enrolled_on) VALUES (:student_id, :test_id, NOW())";
$stmt = $conn->prepare($sql);

try {
    $stmt->execute([
        ':student_id' => $student_id,
        ':test_id' => $test_id
    ]);
    echo json_encode(["success" => true]);
} catch (PDOException $e) {
    // Avoid duplicate enrollments
    if ($e->getCode() == 23000) {
        echo json_encode(["success" => true, "message" => "Already enrolled"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => $e->getMessage()]);
    }
}
