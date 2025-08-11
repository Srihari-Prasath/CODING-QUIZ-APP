<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ForgotPasswordController
{
    public static function sendOTP()
    {
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

        // Generate 6-digit OTP
        $otp = rand(100000, 999999);
        $expires_at = (new DateTime('+15 minutes'))->format('Y-m-d H:i:s');

        // Delete any existing OTPs for this user
        $stmt = $conn->prepare("DELETE FROM password_resets WHERE user_id = ?");
        $stmt->execute([$user['user_id']]);

        // Store OTP in password_resets table
        $stmt = $conn->prepare("INSERT INTO password_resets (user_id, otp, expires_at) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE otp = VALUES(otp), expires_at = VALUES(expires_at)");
        $stmt->execute([$user['user_id'], $otp, $expires_at]);

        // Email content
        $subject = "Your OTP for Password Reset - Coding Quiz App";
        $body = "
            <p>Hi <b>{$user['name']}</b>,</p>
            <p>We received a request to reset your password. Use the OTP below to proceed:</p>
            <h2 style='color:blue;'>{$otp}</h2>
            <p>This OTP will expire in 15 minutes.</p>
            <br><p>Regards,<br>Coding Quiz App Team</p>
        ";

        // Send email SMTP
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'aaswinjs2004@gmail.com'; //  email
            $mail->Password = 'moey jsfr fqze mpsy';  //  SMTP key
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('aaswinjs2004@gmail.com', 'Coding Quiz App');
            $mail->addAddress($user['email'], $user['name']);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->send();
            echo json_encode(['message' => 'OTP sent to your email']);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Mail Error: ' . $mail->ErrorInfo]);
        }
    }
}

ForgotPasswordController::sendOTP();
