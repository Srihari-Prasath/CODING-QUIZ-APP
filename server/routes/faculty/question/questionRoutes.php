<?php

require_once '../../helpers/check-session.php';
require_once '../../../controllers/faculty/questions/questionController.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['quizId']) || !isset($_FILES['questionsFile'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing test_id or file']);
        exit;
    }

    $test_id = $_POST['quizId'];
    $file = $_FILES['questionsFile'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        http_response_code(400);
        echo json_encode(['error' => 'File upload failed']);
        exit;
    }

    // $result = uploadQuestionsFromExcel($test_id, $file['tmp_name']);

    if ($result['success']) {
        echo json_encode($result);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Upload failed', 'details' => $result['error']]);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}
