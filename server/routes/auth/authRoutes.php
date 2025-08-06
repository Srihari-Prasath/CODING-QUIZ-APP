<?php

$route = $_GET['route'] ?? '';

switch ($route) {

    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            require_once __DIR__ . '/../../controllers/auth/updatePassword.php';
            exit;
        }
        break;

    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../../controllers/auth/loginController.php';
            exit;
        }
        break;

    case 'get-user-by-roll':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../../controllers/auth/getUserByRollController.php';
            exit;
        }
        break;

    case 'get-user-by-roll':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../../controllers/auth/getUserByRollController.php';
            exit;
        }
        break;


    case 'forgot_password':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../../controllers/auth/forgot_password.php';
            exit;
        }
        break;

    case 'reset_password':
        require_once __DIR__ . '/../../controllers/auth/reset_password.php';
        exit;

<<<<<<< Updated upstream
=======

>>>>>>> Stashed changes
    default:
        http_response_code(404);
        echo json_encode(["error" => "Route not found"]);
        break;
}
