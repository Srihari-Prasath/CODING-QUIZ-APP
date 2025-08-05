<?php
require_once __DIR__ . '/../../config/db.php';

class LoginController {
    public static function login() {
        $input = json_decode(file_get_contents("php://input"), true);

        if (!$input || !isset($input['roll_no'], $input['password'])) {
            http_response_code(400);
            echo json_encode(["error" => "Roll number and password required"]);
            return;
        }

        $roll_no = $input['roll_no'];
        $password = $input['password'];

        $db = new Database();
        $conn = $db->connect();

        $stmt = $conn->prepare("SELECT user_id, role_id, roll_no, name, email, password, department, year FROM users WHERE roll_no = ?");
        $stmt->execute([$roll_no]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            unset($user['password']);
            echo json_encode([
                "message" => "Login successful",
                "user" => $user
            ]);
        } else {
            http_response_code(401);
            echo json_encode(["error" => "Invalid roll number or password"]);
        }
    }
}

LoginController::login();
