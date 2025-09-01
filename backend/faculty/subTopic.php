<?php


include("../../resource/conn.php");
include("../../resource/session.php");



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = isset($_SESSION['id']) ? intval($_SESSION['id']) : 0;
    $topic_id = intval($_POST['parentTopic']);
    $title = trim($_POST['subTopicName']);
    $description = trim($_POST['subTopicDescription']);
    $by_admin = 0;

    if (!empty($topic_id) && !empty($title)) {
        $stmt = $conn->prepare("
            INSERT INTO sub_topics (topic_id, title, description, added_by, by_admin, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, NOW(), NOW())
        ");
        $stmt->bind_param("issii", $topic_id, $title, $description, $user_id, $by_admin);

        if ($stmt->execute()) {
            header("Location: ../../faculty/topic.php");
        } else {
            echo "<p> Error: " . $stmt->error . "</p>";
        }

        $stmt->close();
    } else {
        echo "<p>⚠ Topic ID and Title are required.</p>";
    }
}
