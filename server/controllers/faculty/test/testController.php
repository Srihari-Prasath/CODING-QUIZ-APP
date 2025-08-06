<?php
require_once '../../../config/db.php';

class TestController
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Get all tests
    public function getAllTests()
    {
        try {
            $sql = "SELECT test_id, title, description, domain, department, year, created_by,
                       start_time, end_time, duration_minutes, total_marks, total_questions, is_active
                FROM tests  ORDER BY test_id DESC ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $tests = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode([
                'success' => true,
                'data' => $tests
            ]);
        } catch (PDOException $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Database error: ' . $e->getMessage()
            ]);
        }
    }


    // Create test
    public function createTest($data)
    {
        session_start();

        if (!isset($_SESSION['roll_no'])) {
            http_response_code(401);
            echo json_encode(["error" => "Unauthorized. Missing session data."]);
            return;
        }

        $roll_no = $_SESSION['roll_no'];

        $userQuery = $this->conn->prepare("SELECT user_id, department_id FROM users WHERE roll_no = :roll_no");
        $userQuery->bindParam(':roll_no', $roll_no);
        $userQuery->execute();
        $user = $userQuery->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            http_response_code(403);
            echo json_encode(["error" => "User not found"]);
            return;
        }

        $created_by = $user['user_id'];
        $department = $user['department_id'];

        $sql = "INSERT INTO tests (
            title, description, domain, department, year,
            created_by, start_time, end_time, duration_minutes,
            total_marks, total_questions
        ) VALUES (
            :title, :description, :domain, :department, :year,
            :created_by, :start_time, :end_time, :duration_minutes,
            :total_marks, :total_questions
        )";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':domain', $data['domain']);
        $stmt->bindParam(':department', $department);
        $stmt->bindParam(':year', $data['year']);
        $stmt->bindParam(':created_by', $created_by);
        $stmt->bindParam(':start_time', $data['start_time']);
        $stmt->bindParam(':end_time', $data['end_time']);
        $stmt->bindParam(':duration_minutes', $data['duration_minutes']);
        $stmt->bindParam(':total_marks', $data['total_marks']);
        $stmt->bindParam(':total_questions', $data['total_questions']);


        if ($stmt->execute()) {
            echo json_encode(["message" => "Test created successfully."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Failed to create test."]);
        }
    }
}
