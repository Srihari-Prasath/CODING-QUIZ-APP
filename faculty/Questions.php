<?php

include("../resource/conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['subtopic_id'])) {
    $subtopic_id = intval($_GET['subtopic_id']); 

    $sql = "SELECT 
                question_id, 
                sub_topic_id, 
                created_by, 
                by_admin, 
                question_text, 
                option_a, 
                option_b, 
                option_c, 
                option_d, 
                correct_option, 
                created_at, 
                mark 
            FROM questions 
            WHERE sub_topic_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $subtopic_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $questions = [];
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($questions, JSON_PRETTY_PRINT);

    $stmt->close();
    $conn->close();
} else {
    http_response_code(400);
    echo json_encode(["error" => "Invalid request. Pass subtopic_id as GET parameter."]);
}
?>