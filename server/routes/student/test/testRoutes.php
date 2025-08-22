<?php
require_once '../../../config/db.php';



$database = new Database();
$conn = $database->connect();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	$sql = "SELECT test_id, title, description, subject, topic_id, sub_topic_id, num_questions, department_id, year, date, time_slot, duration_minutes, created_by, created_at, is_active FROM tests";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$tests = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode(['status' => 'success', 'tests' => $tests]);
}
// No closing PHP tag to prevent extra output
?>
