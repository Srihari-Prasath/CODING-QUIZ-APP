<?php
require_once __DIR__ . '/../../config/db.php';

class ResetPasswordController {
    public static function reset() {
        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['token']) || !isset($input['password'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Token and new password are required']);
            return;
        }

        $token = $input['token'];
        $newPassword = $input['password'];
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $db = new Database();
        $conn = $db->connect();

        // Find token in password_resets table
        $stmt = $conn->prepare("SELECT * FROM password_resets WHERE otp = ?");
        $stmt->execute([$token]);
        $reset = $stmt->fetch();

        if (!$reset) {
            http_response_code(404);
            echo json_encode(['error' => 'Invalid or expired token']);
            return;
        }

        // Check token expiration
        if (strtotime($reset['expires_at']) < time()) {
            http_response_code(403);
            echo json_encode(['error' => 'Token expired']);
            return;
        }

        // Update password in users table
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE user_id = ?");
        $stmt->execute([$hashedPassword, $reset['user_id']]);

        // Delete the used token
        $stmt = $conn->prepare("DELETE FROM password_resets WHERE otp = ?");
        $stmt->execute([$token]);

        echo json_encode(['message' => 'Password has been successfully reset']);
    }
}

ResetPasswordController::reset();
