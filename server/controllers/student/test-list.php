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

// Query the new table
$sql = "SELECT 
            test_id, 
            title, 
            description, 
            topic_id,
            num_questions,
            department_id, 
            year, 
            date AS start_date, 
            time_slot, 
            duration_minutes, 
            is_active 
        FROM tests 
        WHERE department_id = :dept 
          AND year = :year 
          AND is_active = 1 
          AND date >= :today
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
    echo json_encode([]);
} else {
    // Map to frontend-friendly structure
    $formattedTests = array_map(function($test) {
        return [
            'test_id' => $test['test_id'],
            'title' => $test['title'],
            'description' => $test['description'],
            'domain' => $test['topic_id'], // you may replace with actual topic name if needed
            'department' => $test['department_id'],
            'year' => $test['year'],
            'start_time' => $test['start_date'] . ' ' . $test['time_slot'],
            'end_time' => $test['start_date'] . ' ' . $test['time_slot'], // can be calculated if needed
            'duration_minutes' => $test['duration_minutes'],
            'total_marks' => $test['num_questions'], // assuming 1 mark per question
            'is_active' => $test['is_active']
        ];
    }, $tests);

    echo json_encode($formattedTests);
}
