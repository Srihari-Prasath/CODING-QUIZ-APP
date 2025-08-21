<?php
require_once '../../../config/db.php';

function getAllTopics($user_id = null) {
    try {
        $db = new Database();
        $pdo = $db->connect();
        $sql = "SELECT topic_id, title, description, added_by, by_admin, created_at, updated_at FROM topics ";
        $params = [];
        if (!is_null($user_id)) {
            // Only show topics added by this user or by admin
            $sql .= " AND (by_admin = 1 OR added_by = :user_id)";
            $params[':user_id'] = $user_id;
        }
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
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
