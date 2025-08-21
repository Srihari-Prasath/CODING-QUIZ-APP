<?php
require_once '../../controllers/dept/deptController.php';

header('Content-Type: application/json');


$controller = new DeptController();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $result = $controller->getDepartments();
    echo json_encode($result);
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
