<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['id'], $_SESSION['role'])) {
    echo json_encode([
        'logged_in' => true,
        'role' => $_SESSION['role'],
        'id' => $_SESSION['id'],
        'name' => $_SESSION['name'],
        'email' => $_SESSION['email'],
        'roll_no' => $_SESSION['roll_no']
    ]);
} else {
    echo json_encode(['logged_in' => false]);
}
?>
