<?php
require_once '../../../config/db.php';

$db = new Database();
$pdo = $db->connect();

header('Content-Type: application/json');

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['title']) || !isset($data['created_by'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing title or created_by']);
        exit;
    }

    $title = trim($data['title']);
    $description = isset($data['description']) ? trim($data['description']) : '';
    $created_by = intval($data['created_by']);

    try {
        $stmt = $pdo->prepare("
            INSERT INTO topics (title, description, created_by) 
            VALUES (:title, :description, :created_by)
        ");
        $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':created_by' => $created_by
        ]);

        echo json_encode([
            'success' => true,
            'message' => 'Topic created successfully',
            'topic_id' => $pdo->lastInsertId()
        ]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Topic creation failed', 'details' => $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}
