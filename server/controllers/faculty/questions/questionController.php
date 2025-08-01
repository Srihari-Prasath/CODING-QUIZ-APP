<?php
require_once '../../../config/db.php';
require_once '../../../vendor/PhpSpreadsheet';

use PhpOffice\PhpSpreadsheet\IOFactory;

function uploadQuestionsFromExcel($test_id, $filePath)
{
    global $pdo;

    try {
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        for ($i = 1; $i < count($rows); $i++) {
            $row = $rows[$i];

            $question_text = trim($row[0] ?? '');
            $option_a = trim($row[1] ?? '');
            $option_b = trim($row[2] ?? '');
            $option_c = trim($row[3] ?? '');
            $option_d = trim($row[4] ?? '');
            $correct_option = strtoupper(trim($row[5] ?? ''));
            $mark = (float)($row[6] ?? 0);

            if (!$question_text || !in_array($correct_option, ['A', 'B', 'C', 'D'])) {
                continue; 
            }

            $stmt = $pdo->prepare("
                INSERT INTO questions (
                    test_id, question_text, option_a, option_b, option_c, option_d, correct_option, mark
                ) VALUES (
                    :test_id, :question_text, :option_a, :option_b, :option_c, :option_d, :correct_option, :mark
                )
            ");

            $stmt->execute([
                ':test_id' => $test_id,
                ':question_text' => $question_text,
                ':option_a' => $option_a,
                ':option_b' => $option_b,
                ':option_c' => $option_c,
                ':option_d' => $option_d,
                ':correct_option' => $correct_option,
                ':mark' => $mark,
            ]);
        }

        echo json_encode(['success' => true, 'message' => 'Questions uploaded successfully']);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Upload failed', 'details' => $e->getMessage()]);
    }
}
