<?php
require_once '../../../config/db.php';

header('Content-Type: application/json');

$db = new Database();
$conn = $db->connect(); 
function getTopics($conn, $user_id = null) {
    $sql = "SELECT 
                `topic_id`, 
                `title`, 
                `description`, 
                `added_by`, 
                `by_admin`, 
                `created_at`, 
                `updated_at` 
            FROM `topics` 
            WHERE 1";

    if (!is_null($user_id)) {
         $sql .= " AND ( `by_admin` = 1 AND `added_by` = :user_id OR `added_by` IS NULL )";
    }

    $stmt = $conn->prepare($sql);

    if (!is_null($user_id)) {
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    }

    $stmt->execute();

    $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $topics;
}
