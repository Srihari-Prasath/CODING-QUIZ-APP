<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['id'], $_SESSION['role'])) {
    echo json_encode([
        'logged_in' => true,
        'role' => $_SESSION['role'],
        'full_name' => $_SESSION['full_name'],
        'email' => $_SESSION['email']
    ]);
} else {
    echo json_encode(['logged_in' => false]);
}
?>
