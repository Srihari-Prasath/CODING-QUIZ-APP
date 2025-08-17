<?php
// ==========================
// submit_quiz.php
// Handles quiz submission
// ==========================

// ⚡ Strict error handling: hide notices/warnings to avoid breaking JSON
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', 0);

session_start(); // Start session

header('Content-Type: application/json');

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit;
}

require_once('../../config/db.php');
$database = new Database();
$conn = $database->connect();

// Ensure student is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Not logged in']);
    exit;
}

$student_id = intval($_SESSION['user_id']);

// Read JSON input
$input = file_get_contents('php://input');
$data = json_decode($input, true);
if (!isset($data['answers']) || !is_array($data['answers'])) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid or missing answers in request body']);
    exit;
}

$user_answers = $data['answers'];

// Auto-fetch latest enrolled test for this student
$stmt = $conn->prepare("SELECT test_id FROM student_enrollment WHERE student_id = ? ORDER BY enrolled_on DESC LIMIT 1");
$stmt->execute([$student_id]);
$test_row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$test_row) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'No enrolled test found for this student']);
    exit;
}

$test_id = intval($test_row['test_id']);

try {
    $conn->beginTransaction();

    // Fetch questions and correct options
    $stmt = $conn->prepare("
        SELECT q.question_id, q.correct_option, q.mark
        FROM questions q
        INNER JOIN test_questions tq ON q.question_id = tq.question_id
        WHERE tq.test_id = ?
    ");
    $stmt->execute([$test_id]);
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $correct_map = [];
    $mark_map = [];
    $total_marks = 0;
    foreach ($questions as $q) {
        $qid = intval($q['question_id']);
        $correct_map[$qid] = strtoupper(trim($q['correct_option']));
        $mark_map[$qid] = floatval($q['mark']);
        $total_marks += floatval($q['mark']);
    }

    // Insert record in student_tests
    $stmtTest = $conn->prepare("INSERT INTO student_tests (student_id, test_id, submitted_at) VALUES (?, ?, NOW())");
    $stmtTest->execute([$student_id, $test_id]);
    $student_test_id = $conn->lastInsertId();

    $total_score = 0;

    // Insert student answers
    $stmtAnswer = $conn->prepare("
        INSERT INTO student_answers (student_test_id, user_id, test_id, question_id, selected_option, answered_at)
        VALUES (?, ?, ?, ?, ?, NOW())
    ");

    foreach ($user_answers as $question_id => $selected_option) {
        $qid = intval($question_id);
        $selected_option = strtoupper(trim($selected_option));
        if (!in_array($selected_option, ['A', 'B', 'C', 'D'])) {
            $selected_option = null;
        }

        $marks_awarded = (isset($correct_map[$qid]) && $selected_option !== null && $selected_option === $correct_map[$qid])
            ? $mark_map[$qid]
            : 0;

        $total_score += $marks_awarded;

        $stmtAnswer->execute([
            $student_test_id,
            $student_id,
            $test_id,
            $qid,
            $selected_option
        ]);
    }

    // Update total score in student_tests
    $stmtUpdate = $conn->prepare("UPDATE student_tests SET score = ? WHERE student_test_id = ?");
    $stmtUpdate->execute([$total_score, $student_test_id]);

    // Insert or update student_quiz_results
    $stmtResult = $conn->prepare("
        INSERT INTO student_quiz_results (user_id, test_id, score, total_marks, submitted_at)
        VALUES (?, ?, ?, ?, NOW())
        ON DUPLICATE KEY UPDATE
            score = VALUES(score),
            total_marks = VALUES(total_marks),
            submitted_at = NOW()
    ");
    $stmtResult->execute([$student_id, $test_id, $total_score, $total_marks]);

    $conn->commit();
    $_SESSION['quiz_submitted'] = true;

    echo json_encode([
        'status' => 'success',
        'message' => 'Quiz submitted successfully',
        'student_test_id' => $student_test_id,
        'score' => $total_score,
        'total_marks' => $total_marks,
        'test_id' => $test_id 
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
