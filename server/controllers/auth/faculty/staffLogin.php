<?php
require_once('../../../config/db.php');
session_start();

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['email'], $data['password'])) {
    echo json_encode(['error' => 'Email and password are required']);
    exit;
}

$email = trim($data['email']);
$password = trim($data['password']);

try {
    $db = new Database();
    $conn = $db->connect();

    // Fetch staff by email
    $stmt = $conn->prepare("
        SELECT staff_id, full_name, username, email, password, role, department_id
        FROM staff_users
        WHERE email = ?
    ");
    $stmt->execute([$email]);
    $staff = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$staff || empty($staff['password'])) {
        echo json_encode(['error' => 'Invalid email or password']);
        exit;
    }

    // Verify password
    if (!password_verify($password, $staff['password'])) {
        echo json_encode(['error' => 'Invalid email or password']);
        exit;
    }

    // Store session including role and department_id
    $_SESSION['user_id'] = $staff['staff_id'];
    $_SESSION['full_name'] = $staff['full_name'];
    $_SESSION['username'] = $staff['username'];
    $_SESSION['email'] = $staff['email'];
    $_SESSION['role'] = $staff['role'];
    $_SESSION['department_id'] = $staff['department_id'];

    echo json_encode([
        'success' => true,
        'user' => [
            'id' => $staff['staff_id'],
            'full_name' => $staff['full_name'],
            'username' => $staff['username'],
            'email' => $staff['email'],
            'role' => $staff['role'],
            'department_id' => $staff['department_id']
        ]
    ]);

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
