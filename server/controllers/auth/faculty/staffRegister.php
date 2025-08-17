<?php
require_once('../../../config/db.php');
session_start();

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['full_name'], $data['email'], $data['password'], $data['role'])) {
    echo json_encode(['error' => 'Full name, email, password, and role are required']);
    exit;
}

$full_name = trim($data['full_name']);
$email = trim($data['email']);
$password = password_hash(trim($data['password']), PASSWORD_DEFAULT);
$role = trim($data['role']);
$department_id = $data['department_id'] ?? null; // optional, can be null

try {
    $db = new Database();
    $conn = $db->connect();

    // Check if email already exists
    $stmt = $conn->prepare("SELECT staff_id FROM staff_users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch(PDO::FETCH_ASSOC)) {
        echo json_encode(['error' => 'Email already registered']);
        exit;
    }

    // Insert new staff
    $stmt = $conn->prepare("
        INSERT INTO staff_users (full_name, email, password, role, department_id)
        VALUES (?, ?, ?, ?, ?)
    ");
    $stmt->execute([$full_name, $email, $password, $role, $department_id]);

    $staff_id = $conn->lastInsertId();

    echo json_encode([
        'success' => true,
        'user' => [
            'id' => $staff_id,
            'full_name' => $full_name,
            'email' => $email,
            'role' => $role,
            'department_id' => $department_id
        ]
    ]);

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
