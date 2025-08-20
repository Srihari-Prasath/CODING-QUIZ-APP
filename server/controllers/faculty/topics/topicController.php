<?php
require_once '../../../config/db.php';

function getAllTopics() {
    try {
        $db = new Database();
        $pdo = $db->connect();
        $stmt = $pdo->prepare("SELECT topic_id, title, description, added_by, by_admin, created_at, updated_at FROM topics WHERE 1");
        $stmt->execute();
        $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $topics;
    } catch (Exception $e) {
        return ['error' => $e->getMessage()];
    }
}

function insertTopic($title, $description, $added_by) {
    if (!$title || !$description || !$added_by) {
        return ['error' => 'Missing required fields'];
    }
    try {
        $db = new Database();
        $pdo = $db->connect();
        $stmt = $pdo->prepare("INSERT INTO topics (title, description, added_by, created_at, updated_at) VALUES (:title, :description, :added_by, NOW(), NOW())");
        $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':added_by' => $added_by
        ]);
        return ['success' => true, 'topic_id' => $pdo->lastInsertId()];
    } catch (Exception $e) {
        return ['error' => $e->getMessage()];
    }
}
