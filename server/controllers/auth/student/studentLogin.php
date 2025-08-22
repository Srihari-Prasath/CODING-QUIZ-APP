<?php
require_once '../../config/db.php';

session_start();

class LoginController {
    public static function login() {
        $input = json_decode(file_get_contents("php://input"), true);

        if (!$input || !isset($input['roll_no'], $input['password'])) {
            http_response_code(400);
            echo json_encode(["error" => "Roll number and password are required"]);
            return;
        }

        $roll_no = $input['roll_no'];
        $password = $input['password'];

        $db = new Database();
        $conn = $db->connect();

        $stmt = $conn->prepare("
            SELECT u.user_id, u.roll_no, u.password, u.name, u.email , u.year,u.department_id
            FROM student_users u
            WHERE u.roll_no = ?
        ");
        $stmt->execute([$roll_no]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);

            $_SESSION['id'] = $user['user_id']; 
            $_SESSION['roll_no'] = $user['roll_no'];
            $_SESSION['role'] = "student";
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['year'] = $user['year'];
            $_SESSION['department'] = $user['department_id'];


            echo json_encode([
                "message" => "Login successful",
                "user" => [
                    "id" => $user['user_id'], 
                    "roll_no" => $user['roll_no'],
                    "role" => "student",
                    "name" => $user['name'],
                    "email" => $user['email'],
                    "year" => $user['year'],
                    "department" => $user['department_id']
                ]
            ]);
        } else {
            http_response_code(401);
            echo json_encode(["error" => "Invalid roll number or password"]);
        }
    }
}

LoginController::login();
