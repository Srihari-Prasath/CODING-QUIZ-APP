<?php
session_start();
include("../../resource/conn.php");

require '../../vendor/autoload.php';



use PhpOffice\PhpSpreadsheet\IOFactory;

header('Content-Type: application/json');

$response = [
    "status" => "error",
    "message" => "Unknown error"
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $department_id = intval($_POST['department']);
    $year = intval($_POST['year']);

    if ($department_id == 0 || $year == 0) {
        echo json_encode([
            "status" => "error",
            "message" => "Department and Year are required."
        ]);
        exit;
    }

    $filePath = $_FILES['file']['tmp_name'];

    try {
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        array_shift($rows); 

        $stmt = $conn->prepare("INSERT INTO users 
            (roll_no, name, email, year, role_id, department_id, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())");
        $stmt->bind_param("sssiii", $roll_no, $name, $email, $year, $role_id, $department_id);

        $role_id = 1;
        $inserted = 0;

        foreach ($rows as $row) {
            $roll_no = trim($row[0]);
            $name    = trim($row[1]);
            $email   = trim($row[2]);

            if (empty($roll_no) || empty($name) || empty($email)) {
                continue;
            }

            $stmt->execute();
            $inserted++;
        }

        $response = [
            "status" => "success",
            "message" => "Bulk upload successful!",
            "inserted" => $inserted,
            "department_id" => $department_id,
            "year" => $year
        ];
    } catch (Exception $e) {
        $response = [
            "status" => "error",
            "message" => "Error reading file: " . $e->getMessage()
        ];
    }
} else {
    $response = [
        "status" => "error",
        "message" => "No file uploaded!"
    ];
}

echo json_encode($response);
