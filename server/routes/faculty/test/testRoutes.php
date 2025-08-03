<?php

require_once '../../../controllers/faculty/test/testController.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$controller = new TestController();

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    $controller->getAllTests();
    exit;
}

if ($method == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $controller->createTest($data);
    exit;
}

http_response_code(405);
echo json_encode(["error" => "Method Not Allowed"]);
