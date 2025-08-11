<?php
require_once __DIR__ . '/../../config/db.php';

session_start();

$input = json_decode(file_get_contents("php://input"), true);
$roll_no = $input['roll_no'] ?? '';
$otp_code = $input['otp'] ?? '';

if (!$roll_no || !$otp_code) {
    echo json_encode(['error' => 'Roll number and OTP are required']);
    exit;
}

$db = new Database();
$conn = $db->connect();

// Get user by roll_no
$stmt = $conn->prepare("SELECT user_id, email FROM users WHERE roll_no = ?");
$stmt->execute([$roll_no]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo json_encode(['error' => 'User not found']);
    exit;
}

// Get the latest OTP for the user
$stmt = $conn->prepare("
    SELECT otp, expires_at 
    FROM password_resets 
    WHERE user_id = ? 
    ORDER BY expires_at DESC 
    LIMIT 1
");
$stmt->execute([$user['user_id']]);
$reset = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$reset) {
    echo json_encode(['error' => 'No OTP request found']);
    exit;
}

// Check OTP expiration
if (strtotime($reset['expires_at']) < time()) {
    echo json_encode(['error' => 'OTP expired']);
    exit;
}

// Match OTP
if ($reset['otp'] != $otp_code) {
    echo json_encode(['error' => 'Invalid OTP']);
    exit;
}

// ✅ OTP verified — Update user status to active
// $stmt = $conn->prepare("UPDATE users SET status = 1 WHERE user_id = ?");
// $stmt->execute([$user['user_id']]);

echo json_encode(['success' => true, 'message' => 'OTP verified. You can now reset your password.']);
exit;
