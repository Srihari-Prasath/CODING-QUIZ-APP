<?php
require_once '../../config/db.php';

class RegisterController {
    public static function register() {
     
        $input = json_decode(file_get_contents("php://input"), true);

        
        if (
            !$input || 
            !isset($input['roll_no'], $input['name'], $input['email'], $input['password'], $input['department_id'], $input['year'])
        ) {
            http_response_code(400);
            echo json_encode(["error" => "Missing required fields"]);
            return;
        }

  
        $db = new Database();
        $conn = $db->connect();

        
        $hashedPassword = password_hash($input['password'], PASSWORD_DEFAULT);

     
        $stmt = $conn->prepare("INSERT INTO users (role_id, roll_no, name, email, password, department_id, year) VALUES (?, ?, ?, ?, ?, ?, ?)");

        try {
            $stmt->execute([
                $input['role_id'] ?? 1,
                $input['roll_no'],
                $input['name'],
                $input['email'],
                $hashedPassword,
                $input['department_id'],
                $input['year']
            ]);
            echo json_encode(["message" => "User registered successfully"]);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(["error" => "Database error: " . $e->getMessage()]);
        }
    }
}


RegisterController::register();
