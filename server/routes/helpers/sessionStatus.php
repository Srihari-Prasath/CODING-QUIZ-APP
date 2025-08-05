<?php
require_once '../../helpers/auth.php';

header('Content-Type: application/json');

if (isset($_SESSION['roll_no'], $_SESSION['role'])) {
    echo json_encode([
        "logged_in" => true,
        "roll_no" => $_SESSION['roll_no'],
        "role" => $_SESSION['role']
    ]);
} else {
    echo json_encode(["logged_in" => false]);
}
