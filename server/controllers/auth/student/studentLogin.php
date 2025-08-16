<?php
require_once('../../../config/db.php');
session_start();

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['roll_no'], $data['password'])) {
    echo json_encode(['error' => 'Roll number and password are required']);
    exit;
}

$roll_no = trim($data['roll_no']);
$password = trim($data['password']);

try {
    $db = new Database();
    $conn = $db->connect();

    // Fetch student by roll number
    $stmt = $conn->prepare("SELECT student_id, full_name, roll_no, password FROM students WHERE roll_no = ?");
    $stmt->execute([$roll_no]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$student || empty($student['password'])) {
        echo json_encode(['error' => 'Invalid roll number or password']);
        exit;
    }

    // Verify password
    if (!password_verify($password, $student['password'])) {
        echo json_encode(['error' => 'Invalid roll number or password']);
        exit;
    }

    // Store session
    $_SESSION['user_id'] = $student['student_id'];
    $_SESSION['roll_no'] = $student['roll_no'];
    $_SESSION['full_name'] = $student['full_name'];
    $_SESSION['role'] = 'student';

    echo json_encode([
        'success' => true,
        'user' => [
            'id' => $student['student_id'],
            'full_name' => $student['full_name'],
            'roll_no' => $student['roll_no'],
            'role' => 'student'
        ],
        'redirect' => './student/index.php' // frontend can use this to redirect
    ]);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
