<?php
include("../../resource/conn.php");
require '../../vendor/autoload.php';


use PhpOffice\PhpSpreadsheet\IOFactory;


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['questionsFile'])) {
    $topic_id = intval($_POST['topic_id'] ?? 0);
    $subtopic_id = intval($_POST['subtopic_id'] ?? 0);
    $created_by = intval($_POST['user_id'] ?? 0);
    $by_admin = 0;

    $file = $_FILES['questionsFile']['tmp_name'];
    $ext = strtolower(pathinfo($_FILES['questionsFile']['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ['xlsx', 'xlsm', 'csv'])) {
        die('Invalid file type. Only XLSX, XLSM, or CSV allowed.');
    }

    try {
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, true);
        $header = array_map('strtolower', array_map('trim', $rows[1]));
        $required = ['question_text', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_option', 'mark'];
        foreach ($required as $col) {
            if (!in_array($col, $header)) {
                die('Missing required column: ' . $col);
            }
        }
        $colIndex = array_flip($header);
        $success = 0;
        for ($i = 2; $i <= count($rows); $i++) {
            $row = $rows[$i];
            $question_text = $row[$colIndex['question_text']] ?? '';
            $option_a = $row[$colIndex['option_a']] ?? '';
            $option_b = $row[$colIndex['option_b']] ?? '';
            $option_c = $row[$colIndex['option_c']] ?? '';
            $option_d = $row[$colIndex['option_d']] ?? '';
            $correct_option = $row[$colIndex['correct_option']] ?? '';
            $mark = $row[$colIndex['mark']] ?? '';

            if (!$question_text) continue;
            $stmt = $conn->prepare("INSERT INTO questions (sub_topic_id, question_text, option_a, option_b, option_c, option_d, correct_option, mark, created_by, by_admin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssssiii", $subtopic_id, $question_text, $option_a, $option_b, $option_c, $option_d, $correct_option, $mark, $created_by, $by_admin);
            if ($stmt->execute()) $success++;
            $stmt->close();
        }
        echo "<script>alert('Uploaded $success questions successfully!');window.location='../../faculty/topic.php';</script>";
        exit;
    } catch (Exception $e) {
        die('Error reading file: ' . $e->getMessage());
    }
} else {
    die('Invalid request.');
}
