<?php

require_once '../../../config/db.php';

class TestController {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Get test
    public function getAllTests() {
        $sql = "SELECT test_id, title, description, domain, department, year, created_by,
                       start_time, end_time, duration_minutes, total_marks, is_active
                FROM tests";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $tests = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($tests);
    }

    //  create test
    public function createTest($data) {
        $sql = "INSERT INTO tests (title, description, domain, department, year, 
                                   start_time, end_time, duration_minutes, total_marks, is_active)
                VALUES (:title, :description, :domain, :department, :year,
                        :start_time, :end_time, :duration_minutes, :total_marks, :is_active)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':domain', $data['domain']);
        $stmt->bindParam(':department', $data['department']);
        $stmt->bindParam(':year', $data['year']); 
        $stmt->bindParam(':start_time', $data['start_time']);
        $stmt->bindParam(':end_time', $data['end_time']);
        $stmt->bindParam(':duration_minutes', $data['duration_minutes']);
        $stmt->bindParam(':total_marks', $data['total_marks']);
        $stmt->bindParam(':is_active', $data['is_active']);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Test created successfully."]);
        } else {
            echo json_encode(["error" => "Failed to create test."]);
        }
    }
}
