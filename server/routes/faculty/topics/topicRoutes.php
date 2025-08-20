<?php
require_once '../../../controllers/faculty/topics/topicController.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $topics = getAllTopics();
    echo json_encode($topics);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $title = $input['title'] ?? '';
    $description = $input['description'] ?? '';
    $added_by = $input['added_by'] ?? null;
    $result = insertTopic($title, $description, $added_by);
    echo json_encode($result);
    exit;
}