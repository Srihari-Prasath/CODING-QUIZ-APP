<?php
require_once('../../../config/db.php'); // DB connection

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['roll_no'], $data['password'])) {
    echo json_encode(['error' => 'Roll number and password are required']);
    exit;
}

$roll_no = trim($data['roll_no']);
$password = trim($data['password']);

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

try {
    $db = new Database();
    $conn = $db->connect();

    // Check if student exists
    $stmt = $conn->prepare("SELECT student_id, password FROM students WHERE roll_no = ?");
    $stmt->execute([$roll_no]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$student) {
        echo json_encode(['error' => 'Student not found']);
        exit;
    }

    if (!empty($student['password'])) {
        echo json_encode(['error' => 'Password already set. Please login.']);
        exit;
    }

    // Update the password
    $updateStmt = $conn->prepare("UPDATE students SET password = ? WHERE roll_no = ?");
    $updateStmt->execute([$hashedPassword, $roll_no]);

    echo json_encode(['success' => true, 'message' => 'Password set successfully. You can now login.']);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
