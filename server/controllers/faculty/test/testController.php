<?php
require_once __DIR__ . '/../../config/db.php';

class TestController {
    public function create($params) {
        $topic_id = (int)$params['topic_id'];
        $num_questions = (int)$params['num_questions'];
        $department_id = (int)($params['department_id'] ?? 0);
        $year = (int)($params['year'] ?? 0);
        $date = $params['date'] ?? date('Y-m-d');
        $time_slot = $params['time_slot'] ?? 'morning';
        $duration_minutes = (int)($params['duration_minutes'] ?? 30);
        $created_by = isset($params['created_by']) ? (int)$params['created_by'] : null;

        if (!$created_by) {
            return ['success' => false, 'error' => 'Missing created_by (user_id)'];
        }

        try {
            $db = new Database();
            $pdo = $db->connect();

          
            $topicStmt = $pdo->prepare("SELECT title, description FROM topics WHERE topic_id = :topic_id");
            $topicStmt->execute([':topic_id' => $topic_id]);
            $topic = $topicStmt->fetch(PDO::FETCH_ASSOC);

            if (!$topic) {
                return ['success' => false, 'error' => 'Topic not found'];
            }

           
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

            return ['success' => true, 'test_id' => $test_id];

        } catch (Exception $e) {
            return ['success' => false, 'error' => 'Test creation failed', 'details' => $e->getMessage()];
        }
    }
}
