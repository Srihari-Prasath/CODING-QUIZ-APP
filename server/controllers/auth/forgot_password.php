<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ForgotPasswordController {
    public static function sendResetLink() {
        // Accept JSON input
        $input = json_decode(file_get_contents('php://input'), true);

        if (!$input || !isset($input['roll_no'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Roll number is required']);
            return;
        }

        $roll_no = $input['roll_no'];
        $db = new Database();
        $conn = $db->connect();

        // Check user
        $stmt = $conn->prepare("SELECT user_id, name, email FROM users WHERE roll_no = ?");
        $stmt->execute([$roll_no]);
        $user = $stmt->fetch();

        if (!$user) {
            http_response_code(404);
            echo json_encode(['error' => 'No account found for that roll number']);
            return;
        }

        // Generate secure token
        $token = bin2hex(random_bytes(32));
        $expires_at = (new DateTime('+15 minutes'))->format('Y-m-d H:i:s');

        // Store token in password_resets table
        $stmt = $conn->prepare("INSERT INTO password_resets (user_id, otp, expires_at) VALUES (?, ?, ?)");
        $stmt->execute([$user['user_id'], $token, $expires_at]);

        // Create reset link (change to your frontend URL)
        $resetLink = "http://localhost/CODING-QUIZ-APP/client/reset-password.html?token=" . urlencode($token);

        // Email content
        $subject = "Recover Your Password - Coding Quiz App";
        $body = "
            <p>Hi <b>{$user['name']}</b>,</p>
            <p>We received a request to reset your password. Click the button below to reset it:</p>
            <p><a href='{$resetLink}' style='padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none;'>Reset Password</a></p>
            <p>This link will expire in 15 minutes.</p>
            <br><p>Regards,<br>Coding Quiz App Team</p>
        ";

        // Send email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // ✅ Use 'smtp.gmail.com' if you switch back to Gmail
            // $mail->SMTPAuth = true;
            $mail->Username = 'aaswinjs2004@gmail.com'; // 🔁 your Brevo email
            $mail->Password = 'dqpz haly gvgy grtm';    // 🔁 SMTP key
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('aaswinjs2004@gmail.com', 'Coding Quiz App');
            $mail->addAddress($user['email'], $user['name']);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->send();
            echo json_encode(['message' => 'Password reset link sent to your email']);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Mail Error: ' . $mail->ErrorInfo]);
        }
    }
}

ForgotPasswordController::sendResetLink();
