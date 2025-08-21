<?php
require_once '../../config/db.php';

header('Content-Type: application/json');
class PasswordController {
    public static function updatePassword() {
        $input = json_decode(file_get_contents("php://input"), true);

        if (
            !$input ||
            !isset($input['user_id'], $input['new_password'])
        ) {
            http_response_code(400);
            echo json_encode(["error" => "Missing user_id or new_password"]);
            return;
        }

        $db = new Database();
        $conn = $db->connect();

        try {
           
            $checkStmt = $conn->prepare("SELECT password FROM student_users WHERE user_id = ?");
            $checkStmt->execute([$input['user_id']]);
            $user = $checkStmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                http_response_code(404);
                echo json_encode(["error" => "User not found"]);
                return;
            }

            if (!empty($user['password'])) {
                http_response_code(403);
                echo json_encode(["error" => "Password already set"]);
                return;
            }

          
            $hashedPassword = password_hash($input['new_password'], PASSWORD_DEFAULT);
            $updateStmt = $conn->prepare("UPDATE student_users SET password = ? WHERE user_id = ?");
            $updateStmt->execute([$hashedPassword, $input['user_id']]);

            if ($updateStmt->rowCount() > 0) {
                echo json_encode(["success" => "Password set successfully"]);
            } else {
                http_response_code(500);
                echo json_encode(["error" => "Failed to update password"]);
            }

        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(["error" => "Database error: " . $e->getMessage()]);
        }
    }
}

PasswordController::updatePassword();
