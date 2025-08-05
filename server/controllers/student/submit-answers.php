<?php
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

    // Insert student_test record
    $insertTest = $conn->prepare("INSERT INTO student_tests (student_id, test_id) VALUES (?, ?)");
    $insertTest->execute([$user_id, $test_id]);
    $student_test_id = $conn->lastInsertId();

    // Prepare insert into student_answers
    $insertAnswer = $conn->prepare("
        INSERT INTO student_answers 
        (student_test_id, question_id, selected_option, is_correct, marks_awarded) 
        VALUES (?, ?, ?, ?, ?)
    ");

    foreach ($user_answers as $question_id => $selected_option) {
        $question_id = intval($question_id);
        $selected_option = strtoupper(trim($selected_option));

        // Skip if not a valid question
        if (!isset($correct_map[$question_id])) continue;

        // Handle skipped
        if (!in_array($selected_option, ['A', 'B', 'C', 'D'])) {
            $selected_option = null;
            $is_correct = null;
            $marks_awarded = 0;
        } else {
            $is_correct = ($selected_option === $correct_map[$question_id]) ? 1 : 0;
            $marks_awarded = $is_correct ? $marks_map[$question_id] : 0;
        }

        $insertAnswer->execute([
            $student_test_id,
            $question_id,
            $selected_option,
            $is_correct,
            $marks_awarded
        ]);
    }

    $conn->commit();

    echo json_encode([
        'status' => 'success',
        'message' => 'Answers submitted successfully',
        'student_test_id' => $student_test_id
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
