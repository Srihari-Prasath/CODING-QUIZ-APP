<?php
require_once '../../../config/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_GET['topic_id'])) {
        echo json_encode(['error' => 'Missing topic_id']);
        exit;
    }

    $topic_id = $_GET['topic_id'];

    try {
        $db = new Database();
        $pdo = $db->connect();

        $stmt = $pdo->prepare("SELECT * FROM questions WHERE topic_id = :topic_id ORDER BY question_id DESC");
        $stmt->execute([':topic_id' => $topic_id]);

        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode(['success' => true, 'data' => $questions]);
    } catch (Exception $e) {
        echo json_encode(['error' => 'Fetch failed', 'details' => $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}
?>
