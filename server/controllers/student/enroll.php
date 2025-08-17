<?php
// ✅ Enable CORS (for frontend API calls)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// ✅ Handle preflight OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

session_start();
require_once('../../config/db.php');

$database = new Database();
$conn = $database->connect();

// ✅ Fallback: If session not set, assume student_id=1 (for testing)
$student_id = $_SESSION['user_id'] ?? 1;

// ✅ Get raw JSON input
$input = json_decode(file_get_contents("php://input"), true);

$test_id = $input['test_id'] ?? null;
$student_id = $input['student_id'] ?? $student_id; // allow frontend to send student_id too

if (!$test_id) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Test ID is required"]);
    exit;
}

// ✅ Prepare SQL
$sql = "INSERT INTO student_enrollment (student_id, test_id, enrolled_on) 
        VALUES (:student_id, :test_id, NOW())";

$stmt = $conn->prepare($sql);

try {
    $stmt->execute([
        ':student_id' => $student_id,
        ':test_id'    => $test_id
    ]);

    echo json_encode([
        "success" => true,
        "message" => "Enrollment successful"
    ]);

} catch (PDOException $e) {
    // ✅ Handle duplicate enrollment
    if ($e->getCode() == "23000") {
        echo json_encode([
            "success" => true,
            "message" => "Already enrolled"
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            "success" => false,
            "error" => $e->getMessage()
        ]);
    }
}
