<?php
require_once '../../../config/db.php';

function insertSubTopic($topic_id, $title, $description, $added_by) {
    if (!$topic_id || !$title || !$description || !$added_by) {
        return ['error' => 'Missing required fields'];
    }
    try {
        $db = new Database();
        $pdo = $db->connect();
        $stmt = $pdo->prepare("INSERT INTO sub_topics (topic_id, title, description, added_by, created_at, updated_at) VALUES (:topic_id, :title, :description, :added_by, NOW(), NOW())");
        $stmt->execute([
            ':topic_id' => $topic_id,
            ':title' => $title,
            ':description' => $description,
            ':added_by' => $added_by
        ]);
        return ['success' => true, 'sub_topic_id' => $pdo->lastInsertId()];
    } catch (Exception $e) {
        return ['error' => $e->getMessage()];
    }
}

function getSubTopics($topic_id = null) {
    try {
        $db = new Database();
        $pdo = $db->connect();
        if ($topic_id) {
            $stmt = $pdo->prepare("SELECT sub_topic_id, topic_id, title, description, added_by, by_admin, created_at, updated_at FROM sub_topics WHERE topic_id = :topic_id");
            $stmt->execute([':topic_id' => $topic_id]);
        } else {
            $stmt = $pdo->prepare("SELECT sub_topic_id, topic_id, title, description, added_by, by_admin, created_at, updated_at FROM sub_topics WHERE 1");
            $stmt->execute();
        }
        $subtopics = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $subtopics;
    } catch (Exception $e) {
        return ['error' => $e->getMessage()];
    }
}

function getTopics($user_id = null) {
    try {
        $db = new Database();
        $conn = $db->connect();
        $sql = "SELECT topic_id, title, description, added_by, by_admin, created_at, updated_at FROM topics WHERE 1";
        if (!is_null($user_id)) {
            $sql .= " AND (by_admin = 1 OR by_admin = 0 AND added_by = :user_id OR added_by IS NULL)";
        }
        $stmt = $conn->prepare($sql);
        if (!is_null($user_id)) {
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        }
        $stmt->execute();
        $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $topics;
    } catch (Exception $e) {
        return ['error' => $e->getMessage()];
    }
}
