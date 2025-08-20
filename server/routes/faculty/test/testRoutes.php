<?php
require_once __DIR__ . '/../controllers/TestController.php';

header('Content-Type: application/json');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$controller = new TestController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (!$input) {
        echo json_encode(['success' => false, 'error' => 'Invalid or missing JSON input']);
        exit;
    }

    $result = $controller->create($input);
    echo json_encode($result);

} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
