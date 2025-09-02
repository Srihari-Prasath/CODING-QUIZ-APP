<?php
include("../resource/conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    $student_id = intval($data['student_id']);
    $test_id = intval($data['test_id']);
    $answers = $data['answers'];

    $score = 0;
    $total = count($answers);

    foreach ($answers as $answer) {
        $question_id = intval($answer['question_id']);
        $selected_option = $answer['selected_option'];

        // Get correct answer
        $sql = "SELECT correct_option FROM questions WHERE question_id = $question_id";
        $res = $conn->query($sql);
        if ($res && $row = $res->fetch_assoc()) {
            if ($row['correct_option'] === $selected_option) {
                $score++;
            }
        }

        // Save answer to DB
        $stmt = $conn->prepare("INSERT INTO student_answers (student_id, test_id, question_id, selected_option) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiis", $student_id, $test_id, $question_id, $selected_option);
        $stmt->execute();
        $stmt->close();
    }

    // Save test result
    $stmt = $conn->prepare("INSERT INTO student_tests (student_id, test_id, score, total) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiii", $student_id, $test_id, $score, $total);
    $stmt->execute();
    $student_test_id = $stmt->insert_id;
    $stmt->close();

    echo json_encode([
        "status" => "success",
        "student_test_id" => $student_test_id,
        "score" => $score,
        "total" => $total
    ]);
}
?>
