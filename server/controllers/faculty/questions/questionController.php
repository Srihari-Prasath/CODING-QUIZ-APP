<?php
require_once '../../../config/db.php';
require_once '../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

// session_start(); // Uncomment when using login sessions
$created_by = $_SESSION['user_id'] ?? 1; // TEMP fallback for testing

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['topic_id']) || !isset($_FILES['questionsFile'])) {
        echo json_encode(['error' => 'Missing topic_id or file']);
        exit;
    }

    $topic_id = $_POST['topic_id'];
    $file = $_FILES['questionsFile'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(['error' => 'File upload failed']);
        exit;
    }

    try {
        $db = new Database();
        $pdo = $db->connect();

        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        // Read file depending on extension
        if ($extension === 'csv') {
            $rows = [];
            if (($handle = fopen($file['tmp_name'], 'r')) !== false) {
                while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                    $rows[] = $data;
                }
                fclose($handle);
            }
        } else {
            $spreadsheet = IOFactory::load($file['tmp_name']);
            $rows = $spreadsheet->getActiveSheet()->toArray();
        }

        // Process rows (skip header row)
        for ($i = 1; $i < count($rows); $i++) {
            $row = $rows[$i];

            $question_text   = trim($row[0] ?? '');
            $option_a        = trim($row[1] ?? '');
            $option_b        = trim($row[2] ?? '');
            $option_c        = trim($row[3] ?? '');
            $option_d        = trim($row[4] ?? '');
            $correct_option  = strtoupper(trim($row[5] ?? ''));
            $mark            = (float)($row[6] ?? 1);

            // Validate required fields
            if (!$question_text || !in_array($correct_option, ['A', 'B', 'C', 'D'])) {
                continue;
            }

            $stmt = $pdo->prepare("
                INSERT INTO questions (
                    topic_id, question_text, option_a, option_b, option_c, option_d, correct_option, mark, created_by
                ) VALUES (
                    :topic_id, :question_text, :option_a, :option_b, :option_c, :option_d, :correct_option, :mark, :created_by
                )
            ");

            $stmt->execute([
                ':topic_id'       => $topic_id,
                ':question_text'  => $question_text,
                ':option_a'       => $option_a,
                ':option_b'       => $option_b,
                ':option_c'       => $option_c,
                ':option_d'       => $option_d,
                ':correct_option' => $correct_option,
                ':mark'           => $mark,
                ':created_by'     => $created_by
            ]);
        }

        echo json_encode(['success' => true, 'message' => 'Questions uploaded successfully']);
    } catch (Exception $e) {
        echo json_encode(['error' => 'Upload failed', 'details' => $e->getMessage()]);
    }
}
