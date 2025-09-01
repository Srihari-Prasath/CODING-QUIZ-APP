<?php
include("../resource/conn.php");

$questions = [];
$error = "";

if (isset($_GET['subtopic_id'])) {
    $subtopic_id = intval($_GET['subtopic_id']);

    $sql = "SELECT 
                question_id, 
                sub_topic_id, 
                created_by, 
                by_admin, 
                question_text, 
                option_a, 
                option_b, 
                option_c, 
                option_d, 
                correct_option, 
                created_at, 
                mark 
            FROM questions 
            WHERE sub_topic_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $subtopic_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }

    $stmt->close();
    $conn->close();
} else {
    $error = "Invalid request. Pass subtopic_id as GET parameter.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Questions Viewer</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f9f9f9;
      margin: 0;
      padding: 20px;
    }
    h1 {
      text-align: center;
    }
    .question {
      background: #fff;
      margin: 15px 0;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .options p {
      margin: 4px 0;
    }
    .no-questions, .error {
      text-align: center;
      padding: 20px;
      font-size: 18px;
      color: #666;
      background: #fff3cd;
      border: 1px solid #ffeeba;
      border-radius: 6px;
    }
  </style>
</head>
<body>

<h1>Questions</h1>
<div id="questions-container">
  <?php if ($error): ?>
    <div class="error"><?= htmlspecialchars($error) ?></div>
  <?php elseif (count($questions) === 0): ?>
    <div class="no-questions">No questions available for this subtopic.</div>
  <?php else: ?>
    <?php foreach ($questions as $index => $q): ?>
      <div class="question">
        <h3>Q<?= $index + 1 ?>: <?= htmlspecialchars($q['question_text']) ?></h3>
        <div class="options">
          <p>A. <?= htmlspecialchars($q['option_a']) ?></p>
          <p>B. <?= htmlspecialchars($q['option_b']) ?></p>
          <p>C. <?= htmlspecialchars($q['option_c']) ?></p>
          <p>D. <?= htmlspecialchars($q['option_d']) ?></p>
          <p><strong>Correct:</strong> <?= htmlspecialchars($q['correct_option']) ?></p>
          <p><em>Mark: <?= htmlspecialchars($q['mark']) ?></em></p>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

</body>
</html>
