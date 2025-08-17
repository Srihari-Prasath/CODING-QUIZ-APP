<?php
// Enable error reporting temporarily (remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ✅ Enable CORS
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// ✅ Handle OPTIONS preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once('../../config/db.php');
session_start(); // To access student info

try {
    $database = new Database();
    $conn = $database->connect();

    // Fallback if session not set
    $student_id   = $_SESSION['user_id']        ?? 1;
    $student_dept = $_SESSION['department_id']  ?? 1;
    $student_year = $_SESSION['year']           ?? 1;

    // Get today's date
    $today = date('Y-m-d');

    // Fetch tests with department/topic names
    $sql = "SELECT 
                t.test_id, 
                t.title, 
                t.description, 
                t.topic_id,
                t.num_questions,
                t.department_id, 
                t.year, 
                t.date, 
                t.time_slot, 
                t.duration_minutes, 
                t.is_active,
                d.full_name as department_name,
                tp.title as topic_name
            FROM tests t
            LEFT JOIN departments d ON t.department_id = d.id
            LEFT JOIN topics tp ON t.topic_id = tp.topic_id
            WHERE t.department_id = :dept 
              AND t.year = :year 
              AND t.is_active = 1 
              AND t.date >= :today
            ORDER BY t.date ASC";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':dept' => $student_dept,
        ':year' => $student_year,
        ':today' => $today
    ]);

    $tests = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');

    // Map time_slot to proper start and end times
    function getSlotTimes($date, $slot, $duration) {
        switch (strtolower($slot)) {
            case 'full_day':
                return [$date . " 09:00:00", $date . " 21:00:00"];
            case 'morning':
                return [$date . " 09:00:00", $date . " 12:00:00"];
            case 'afternoon':
                return [$date . " 12:00:00", $date . " 14:00:00"];
            case 'evening':
                return [$date . " 14:30:00", $date . " 17:00:00"];
            default:
                $start = $date . " " . $slot;
                $end   = date('Y-m-d H:i:s', strtotime($start . " +{$duration} minutes"));
                return [$start, $end];
        }
    }

    if (empty($tests)) {
        echo json_encode([]);
    } else {
        $formattedTests = array_map(function($test) {
            list($startDateTime, $endDateTime) = getSlotTimes(
                $test['date'], 
                $test['time_slot'], 
                $test['duration_minutes']
            );

            return [
                'test_id' => $test['test_id'],
                'title' => $test['title'],
                'description' => $test['description'],
                'domain' => $test['topic_name'] ?? "N/A",
                'department' => $test['department_name'] ?? "N/A",
                'year' => $test['year'], // Keep numeric
                'start_time' => $startDateTime,
                'end_time' => $endDateTime,
                'duration_minutes' => $test['duration_minutes'],
                'total_marks' => $test['num_questions'],
                'is_active' => $test['is_active']
            ];
        }, $tests);

        echo json_encode($formattedTests);
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
