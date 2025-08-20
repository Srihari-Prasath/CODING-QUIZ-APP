<?php
require_once '../../config/db.php';

header('Content-Type: application/json');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class GetUserByRollController
{
    public static function getUserByRoll()
    {
        $input = json_decode(file_get_contents("php://input"), true);
        $roll_no = $input['roll_no'] ?? null;

        if (!$roll_no) {
            http_response_code(400);
            echo json_encode(["error" => "Roll number is required"]);
            return;
        }

        $db = new Database();
        $conn = $db->connect();

        $stmt = $conn->prepare("
        SELECT r.role_name
FROM faculty_users u
JOIN roles r ON u.role_id = r.role_id
WHERE u.roll_no = ?;"
);
        $stmt->execute([$roll_no]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            echo json_encode($user);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "User not found"]);
        }
    }
}

GetUserByRollController::getUserByRoll();
