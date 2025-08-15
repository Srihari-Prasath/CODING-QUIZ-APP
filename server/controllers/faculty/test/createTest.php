<?php
require_once '../../../config/db.php';
require_once '../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

// Temporary fallback user for testing
$created_by = 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['topic_id']) || !isset($_POST['num_questions'])) {
        echo json_encode(['error' => 'Missing topic_id or num_questions']);
        exit;
    }

    $topic_id = (int)$_POST['topic_id'];
    $num_questions = (int)$_POST['num_questions'];
    $department_id = (int)($_POST['department_id'] ?? 0);
    $year = (int)($_POST['year'] ?? 0);
    $date = $_POST['date'] ?? date('Y-m-d');
    $time_slot = $_POST['time_slot'] ?? 'morning';
    $duration_minutes = (int)($_POST['duration_minutes'] ?? 30);

    try {
        $db = new Database();
        $pdo = $db->connect();

        // Fetch topic details for title/description
        $topicStmt = $pdo->prepare("SELECT title, description FROM topics WHERE topic_id = :topic_id");
        $topicStmt->execute([':topic_id' => $topic_id]);
        $topic = $topicStmt->fetch(PDO::FETCH_ASSOC);

        if (!$topic) {
            echo json_encode(['error' => 'Topic not found']);
            exit;
        }

        // Insert test metadata
        $stmt = $pdo->prepare("
            INSERT INTO tests 
            (title, description, topic_id, num_questions, department_id, year, date, time_slot, duration_minutes, created_by)
            VALUES
            (:title, :description, :topic_id, :num_questions, :department_id, :year, :date, :time_slot, :duration_minutes, :created_by)
        ");

        $stmt->execute([
            ':title' => $topic['title'],
            ':description' => $topic['description'],
            ':topic_id' => $topic_id,
            ':num_questions' => $num_questions,
            ':department_id' => $department_id,
            ':year' => $year,
            ':date' => $date,
            ':time_slot' => $time_slot,
            ':duration_minutes' => $duration_minutes,
            ':created_by' => $created_by
        ]);

        $test_id = $pdo->lastInsertId();

        // Pick random questions for this test
        $qStmt = $pdo->prepare("
            SELECT question_id 
            FROM questions 
            WHERE topic_id = :topic_id 
            ORDER BY RAND() 
            LIMIT :num_questions
        ");
        $qStmt->bindValue(':topic_id', $topic_id, PDO::PARAM_INT);
        $qStmt->bindValue(':num_questions', $num_questions, PDO::PARAM_INT);
        $qStmt->execute();
        $questions = $qStmt->fetchAll(PDO::FETCH_COLUMN);

        // Insert mapping into test_questions table
        $insertQ = $pdo->prepare("INSERT INTO test_questions (test_id, question_id) VALUES (:test_id, :question_id)");
        foreach ($questions as $qid) {
            $insertQ->execute([':test_id' => $test_id, ':question_id' => $qid]);
        }

        echo json_encode(['success' => true, 'test_id' => $test_id, 'questions' => $questions]);

    } catch (Exception $e) {
        echo json_encode(['error' => 'Test creation failed', 'details' => $e->getMessage()]);
    }
}
