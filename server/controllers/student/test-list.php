<?php
require_once('../../config/db.php');

$database = new Database();
$conn = $database->connect();

$tests = [];

$sql = "SELECT 
            test_id, 
            title, 
            description, 
            start_time, 
            end_time, 
            duration_minutes, 
            total_marks, 
            domain, 
            department, 
            year, 
            is_active 
        FROM tests 
        ORDER BY start_time DESC";

$stmt = $conn->prepare($sql);
$stmt->execute();
$tests = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return as JSON (for frontend)
header('Content-Type: application/json');
echo json_encode($tests);
