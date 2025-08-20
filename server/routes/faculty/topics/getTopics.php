<?php
require_once('../../../controllers/faculty/topics/showTopics.php');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
    exit;
}

$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : null;
$topics = getTopics($conn, $user_id);
echo json_encode(['success' => true, 'topics' => $topics]);