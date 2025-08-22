<?php
require_once '../../../config/db.php';

$sql = "SELECT * FROM questions";
$stmt = $conn->prepare($sql);
$stmt->execute();
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode(['status' => 'success', 'questions' => $questions]);
?>
