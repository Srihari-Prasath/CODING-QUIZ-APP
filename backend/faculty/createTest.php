<?php



if (!isset($_SESSION['id'])) {
    die("Unauthorized access");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $subject = trim($_POST['domain'] ?? '');
    $topic_id = intval($_POST['topic'] ?? 0);
    $sub_topic_id = intval($_POST['sub_topic'] ?? 0);
    $num_questions = intval($_POST['num_questions'] ?? 0);
    $department_id = intval($_POST['department'] ?? 0);
    $year = intval($_POST['year'] ?? 0);
    $timing = trim($_POST['timing'] ?? '');
    $duration = intval($_POST['Duration'] ?? 0);
    $is_active = 1; // default active
    $added_by = $_SESSION['id']; // session user id

    if ($title === '' || $subject === '' || $topic_id === 0) {
        die("⚠ Title, Subject and Topic are required.");
    }

    // Insert query
    $stmt = $conn->prepare("
        INSERT INTO tests 
        (title, description, added_by, subject, topic_id, sub_topic_id, num_questions, department_id, year, time_slot, duration_minutes, is_active, date) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
    ");
    $stmt->bind_param(
        "ssisiisiiiii",
        $title,
        $description,
        $added_by,
        $subject,
        $topic_id,
        $sub_topic_id,
        $num_questions,
        $department_id,
        $year,
        $timing,
        $duration,
        $is_active
    );

    if ($stmt->execute()) {
        header("Location: ./create-test.php"); // redirect to test list
        exit;
    } else {
        die("Database Error: " . $stmt->error);
    }
}
?>
