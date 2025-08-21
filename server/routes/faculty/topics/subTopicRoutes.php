<?php
require_once '../../../controllers/faculty/topics/subTopicController.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $parent_topic_id = $input['parent_topic_id'] ?? null;
    $title = $input['title'] ?? '';
    $description = $input['description'] ?? '';
    $added_by = $input['added_by'] ?? null;
    $result = insertSubTopic($parent_topic_id, $title, $description, $added_by);
    echo json_encode($result);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $parent_topic_id = $_GET['parent_topic_id'] ?? null;
    $result = getSubTopics($parent_topic_id);
    echo json_encode($result);
    exit;
}
