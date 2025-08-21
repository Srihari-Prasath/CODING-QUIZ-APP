<?php
require_once  '../../../config/db.php';


class TestController {
    public function getTestsByUser($userId = null) {
        try {
            $db = new Database();
            $pdo = $db->connect();

            if ($userId !== null) {
                $stmt = $pdo->prepare("SELECT * FROM tests WHERE created_by = :userId");
                $stmt->execute([':userId' => $userId]);
            } else {
                $stmt = $pdo->query("SELECT * FROM tests");
            }

            $tests = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return ['success' => true, 'tests' => $tests];
        } catch (Exception $e) {
            return ['success' => false, 'error' => 'Failed to fetch tests', 'details' => $e->getMessage()];
        }
    }
    public function create($params) {
        $title = $params['title'] ?? '';
        $description = $params['description'] ?? '';
        $subject = $params['subject'] ?? ($params['domain'] ?? '');
        $topic_id = (int)($params['topic_id'] ?? 0);
        $sub_topic_id = (int)($params['sub_topic_id'] ?? null);
        $num_questions = (int)($params['num_questions'] ?? 0);
        $department_id = (int)($params['department_id'] ?? ($params['department'] ?? 0));
        $year = (int)($params['year'] ?? 0);
        $date = $params['date'] ?? date('Y-m-d');
        $time_slot = $params['time_slot'] ?? ($params['timing'] ?? 'morning');
        $duration_minutes = (int)($params['duration_minutes'] ?? 30);
        $created_by = isset($params['created_by']) ? (int)$params['created_by'] : null;

        if (!$created_by) {
            return ['success' => false, 'error' => 'Missing created_by (user_id)'];
        }

        try {
            $db = new Database();
            $pdo = $db->connect();

            $stmt = $pdo->prepare("
                INSERT INTO tests 
                (title, description, subject, topic_id, sub_topic_id, num_questions, department_id, year, date, time_slot, duration_minutes, created_by) 
                VALUES 
                (:title, :description, :subject, :topic_id, :sub_topic_id, :num_questions, :department_id, :year, :date, :time_slot, :duration_minutes, :created_by)
            ");

            $success = $stmt->execute([
                ':title' => $title,
                ':description' => $description,
                ':subject' => $subject,
                ':topic_id' => $topic_id,
                ':sub_topic_id' => $sub_topic_id,
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
