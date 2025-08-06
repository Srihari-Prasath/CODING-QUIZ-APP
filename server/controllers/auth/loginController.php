<?php
require_once '../../config/db.php';

session_set_cookie_params([
    'lifetime' => 0,            
    'path' => '/',
    'domain' => '',               
    'secure' => isset($_SERVER['HTTPS']),
    'httponly' => true,
    'samesite' => 'Lax'           
]);
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
            SELECT u.roll_no, u.password, r.role_name
            FROM users u
            JOIN roles r ON u.role_id = r.role_id
            WHERE u.roll_no = ?
        ");
        $stmt->execute([$roll_no]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
         
            session_regenerate_id(true);

            $_SESSION['roll_no'] = $user['roll_no'];
            $_SESSION['role'] = $user['role_name'];

            echo json_encode([
                "message" => "Login successful",
                "user" => [
                    "roll_no" => $user['roll_no'],
                    "role" => $user['role_name']
                ]
            ]);
        } else {
            http_response_code(401);
            echo json_encode(["error" => "Invalid roll number or password"]);
        }
    }
}

LoginController::login();
