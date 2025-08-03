<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json");

$route = $_GET['route'] ?? '';

switch ($route) {
    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../../controllers/auth/register.php';
            exit;
        }
        break;

    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../../controllers/auth/login.php';
            exit;
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(["error" => "Route not found"]);
        break;
}
