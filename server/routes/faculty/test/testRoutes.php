<?php

require_once '../../../controllers/faculty/test/testController.php';

$controller = new TestController();

$method = $_SERVER['REQUEST_METHOD'];


if ($method == 'GET' ) {
    $controller->getAllTests();
}

if ($method == 'POST' ) {
    $data = json_decode(file_get_contents("php://input"), true);
    $controller->createTest($data);
}
