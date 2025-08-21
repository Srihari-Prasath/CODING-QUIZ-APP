<?php 

require_once('../../../controllers/faculty/test/testcontroller.php');

header('Content-Type: application/json');



$controller = new TestController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (!$input) {
        echo json_encode(['success' => false, 'error' => 'Invalid or missing JSON input']);
        exit;
    }

    $required = ['title', 'description', 'subject', 'topic_id', 'sub_topic_id', 'num_questions', 'department_id', 'year', 'date', 'time_slot', 'duration_minutes', 'created_by'];
    foreach ($required as $field) {
        if (!isset($input[$field]) || $input[$field] === '' || $input[$field] === null) {
            echo json_encode(['success' => false, 'error' => 'Missing required field: ' . $field]);
            exit;
        }
    }

    $result = $controller->create($input);
    echo json_encode($result);

} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $userId = isset($_GET['user_id']) ? $_GET['user_id'] : null;
    $result = $controller->getTestsByUser($userId);
    echo json_encode($result);
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
