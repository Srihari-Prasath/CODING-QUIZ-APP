<?php
session_start(); // Start session at the very beginning

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method'
    ]);
    exit;
}

require_once('../../config/db.php');
$database = new Database();
$conn = $database->connect();

$data = json_decode(file_get_contents('php://input'), true);

if (
    !isset($data['test_id']) ||
    !isset($data['user_id']) ||
    !isset($data['answers']) ||
    !is_array($data['answers'])
) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid or missing data in request body'
    ]);
    exit;
}

$test_id = intval($data['test_id']);
$user_id = intval($data['user_id']);
$user_answers = $data['answers'];

try {
    $conn->beginTransaction();

    // Fetch correct answers and marks
    $stmt = $conn->prepare("SELECT question_id, correct_option, mark FROM questions WHERE test_id = ?");
    $stmt->execute([$test_id]);
    $correct_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $correct_map = [];
    $mark_map = [];

    foreach ($correct_data as $row) {
        $correct_map[$row['question_id']] = strtoupper(trim($row['correct_option']));
        $mark_map[$row['question_id']] = intval($row['mark']);
    }

    // Insert into student_tests to track this attempt
    $insertTest = $conn->prepare("INSERT INTO student_tests (student_id, test_id, submitted_at) VALUES (?, ?, NOW())");
    $insertTest->execute([$user_id, $test_id]);
    $student_test_id = $conn->lastInsertId();

    $total_score = 0;

    // Prepare insert into student_answers
    $insertAnswer = $conn->prepare("
        INSERT INTO student_answers 
        (student_test_id, user_id, test_id, question_id, selected_option, answered_at) 
        VALUES (?, ?, ?, ?, ?, NOW())
    ");

    foreach ($user_answers as $question_id => $selected_option) {
        $question_id = intval($question_id);
        $selected_option = strtoupper(trim($selected_option));

        if (!isset($correct_map[$question_id])) continue;

        if (!in_array($selected_option, ['A', 'B', 'C', 'D'])) {
            // Skipped or invalid answer
            $selected_option = null;
            $marks_awarded = 0;
        } else {
            $is_correct = ($selected_option === $correct_map[$question_id]) ? 1 : 0;
            $marks_awarded = $is_correct ? $mark_map[$question_id] : 0;
            $total_score += $marks_awarded;
        }

        $insertAnswer->execute([
            $student_test_id,
            $user_id,
            $test_id,
            $question_id,
            $selected_option ?: 'A' // default to A if null (avoid DB errors)
        ]);
    }

    // Update total score in student_tests
    $updateScore = $conn->prepare("UPDATE student_tests SET score = ? WHERE student_test_id = ?");
    $updateScore->execute([$total_score, $student_test_id]);

    $conn->commit();

    // Set session flag here to indicate quiz submitted
    $_SESSION['quiz_submitted'] = true;

    echo json_encode([
        'status' => 'success',
        'message' => 'Quiz submitted successfully',
        'student_test_id' => $student_test_id,
        'score' => $total_score
    ]);
} catch (Exception $e) {
    $conn->rollBack();
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Submission failed',
        'error' => $e->getMessage()
    ]);
}
?>
