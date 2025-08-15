<?php
require_once('../../config/db.php');
session_start(); // To access student info

$database = new Database();
$conn = $database->connect();

// Ensure session variables exist
if (!isset($_SESSION['user_id'], $_SESSION['department_id'], $_SESSION['year'])) {
    echo json_encode(['error' => 'Unauthorized: No student session found']);
    exit;
}

$student_id = $_SESSION['user_id'];
$student_dept = $_SESSION['department_id'];
$student_year = $_SESSION['year'];

// Get today's date to show upcoming tests
$today = date('Y-m-d');

$sql = "SELECT 
            test_id, 
            title, 
            description, 
            date, 
            time_slot, 
            duration_minutes, 
            department_id, 
            year, 
            is_active 
        FROM tests 
        WHERE department_id = :dept AND year = :year AND is_active = 1 AND date >= :today
        ORDER BY date ASC";

$stmt = $conn->prepare($sql);
$stmt->execute([
    ':dept' => $student_dept,
    ':year' => $student_year,
    ':today' => $today
]);

$tests = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');

if (empty($tests)) {
    echo json_encode(['message' => 'No tests available right now']);
} else {
    echo json_encode($tests);
}
