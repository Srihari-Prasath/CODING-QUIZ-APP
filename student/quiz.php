<?php
include("../resource/conn.php");
session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


if (!isset($_SESSION['id']) || !isset($_GET['id'])) {
    header("Location: test-list.php");
    die("Unauthorized");
}

$test_id = intval($_GET['id']);

// Fetch test info
$sql = "SELECT sub_topic_id, time_slot, duration_minutes ,title FROM tests WHERE test_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $test_id);
$stmt->execute();
$stmt->bind_result($subtopic_id, $time_slot, $duration_minutes,$title);
if (!$stmt->fetch()){
  header("Location: test-list.php");
  die("Test not found");
}

$stmt->close();

// Fetch questions
$sql = "SELECT question_id, question_text, option_a, option_b, option_c, option_d, correct_option, mark
        FROM questions
        WHERE sub_topic_id = ?
        ORDER BY RAND()";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $subtopic_id);
$stmt->execute();
$result = $stmt->get_result();

$questions = [];
while ($row = $result->fetch_assoc()) {
  $questions[] = [
    'id' => intval($row['question_id']),
    'question' => $row['question_text'],
    'options' => [
      'A' => $row['option_a'],
      'B' => $row['option_b'],
      'C' => $row['option_c'],
      'D' => $row['option_d']
    ],
    'correct' => $row['correct_option'],
    'mark' => intval($row['mark'])
  ];
}
$stmt->close();

$questions_json = json_encode($questions, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);



?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>NSCET Quiz</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
</head>
<body class="bg-gray-100 font-sans">

<div id="quizContent" class="h-screen overflow-hidden">
  <div class="flex h-full">
    <!-- Sidebar -->
    <aside class="bg-white w-72 border-r border-gray-200 p-4 flex flex-col">
      <h2 class="text-xl font-bold text-gray-800 mb-4">Navigation</h2>
      <div class="grid grid-cols-6 gap-2 mb-4" id="questionNumbers"></div>
      <div class="space-y-2 text-sm mt-2">
        <div class="flex items-center"><span class="inline-block w-3 h-3 rounded-full bg-green-500 mr-2"></span>Answered: <span id="answeredCount">0</span></div>
        <div class="flex items-center"><span class="inline-block w-3 h-3 rounded-full bg-yellow-500 mr-2"></span>Skipped: <span id="skippedCount">0</span></div>
        <div class="flex items-center"><span class="inline-block w-3 h-3 rounded-full bg-gray-300 mr-2"></span>Not Answered: <span id="notAnsweredCount">0</span></div>
      </div>
      <div class="mt-auto pt-4 border-t border-gray-200 space-y-2">
        <button id="submitQuiz" class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded">Submit Quiz</button>
      </div>
    </aside>

    <!-- Main -->
    <main class="flex-1 overflow-auto">
      <div class="max-w-4xl mx-auto p-6">
        <header class="flex justify-between items-center mb-4">
          <h1 class="text-2xl font-bold text-gray-800"> <?= htmlspecialchars($title) ?></h1>
         
        </header>

        <!-- Timer -->
        <div id="timer" class="text-right text-lg font-bold text-red-600 mb-4"></div>

        <!-- Questions -->
        <div id="quiz-container"></div>

        <div class="flex justify-between mt-6">
          <button id="prevBtn" class="bg-gray-200 py-2 px-4 rounded disabled:opacity-50" disabled><i class="fas fa-arrow-left mr-2"></i>Previous</button>
          <div class="space-x-2">
            <button id="skipBtn" class="bg-yellow-100 text-yellow-800 py-2 px-4 rounded"><i class="fas fa-forward mr-2"></i>Skip</button>
            <button id="nextBtn" class="bg-orange-500 text-white py-2 px-4 rounded">Next<i class="fas fa-arrow-right ml-2"></i></button>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>

<!-- Result Page -->
<div id="resultPage" class="hidden flex h-screen items-center justify-center">
  <div class="bg-white p-8 rounded-xl shadow-md text-center max-w-xl w-full">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Your Result</h2>
    <p id="resultText" class="text-lg text-gray-700 mb-4"></p>
    <div class="flex justify-center space-x-2">
      <a href="./"><button id="clearAllBtn" class="bg-gray-200 text-gray-800 py-2 px-5 rounded">Return</button></a>
    </div>
  </div>
</div>

<script>

const QUESTIONS = <?= $questions_json ?>;

let answers = {};
let currentQuestionIndex = 0;
const quizContent = document.getElementById("quizContent");
const resultPage = document.getElementById("resultPage");
const questionNumbers = document.getElementById("questionNumbers");
const answeredCountEl = document.getElementById("answeredCount");
const skippedCountEl = document.getElementById("skippedCount");
const notAnsweredCountEl = document.getElementById("notAnsweredCount");

let duration = <?= $duration_minutes ?> * 60;
const timerEl = document.getElementById('timer');
let timerInterval;

document.getElementById("prevBtn").onclick = onPrev;
document.getElementById("nextBtn").onclick = onNext;
document.getElementById("skipBtn").onclick = onSkip;
document.getElementById("submitQuiz").onclick = onSubmit;
document.getElementById("clearAllBtn").onclick = clearAll;

window.onload = function() {
  buildSidebar();
  renderQuestion();
  updateCounts();
  startTimer();
}

function startTimer() {
  timerInterval = setInterval(() => {
    let mins = Math.floor(duration / 60);
    let secs = duration % 60;
    timerEl.textContent = `Time Left: ${mins.toString().padStart(2,'0')}:${secs.toString().padStart(2,'0')}`;
    if (duration <= 0) {
      clearInterval(timerInterval);
      alert("Time's up!");
      onSubmit();
    }
    duration--;
  }, 1000);
}

function buildSidebar() {
  questionNumbers.innerHTML = "";
  QUESTIONS.forEach((q, idx) => {
    const btn = document.createElement("button");
    btn.textContent = idx + 1;
    btn.id = "qnum-" + q.id;
    btn.className = "w-9 h-9 text-sm flex items-center justify-center rounded border";
    btn.onclick = () => { currentQuestionIndex = idx; renderQuestion(); };
    questionNumbers.appendChild(btn);
    updateSidebarStatus(q.id);
  });
}

function updateSidebarStatus(qid) {
  const btn = document.getElementById("qnum-" + qid);
  if (!btn) return;
  if (answers[qid] === "") btn.className = "w-9 h-9 text-sm flex items-center justify-center rounded bg-yellow-500 text-white";
  else if (answers[qid]) btn.className = "w-9 h-9 text-sm flex items-center justify-center rounded bg-green-500 text-white";
  else btn.className = "w-9 h-9 text-sm flex items-center justify-center rounded border";
}
function renderQuestion() {
  if (!QUESTIONS[currentQuestionIndex]) return;

  const q = QUESTIONS[currentQuestionIndex];
  const container = document.getElementById("quiz-container");
  const selected = answers[q.id];

  let optionsHTML = "";
  Object.entries(q.options).forEach(([key, val]) => {
    const isSel = selected === key;
    optionsHTML += `
      <div class="option border rounded p-3 cursor-pointer ${isSel ? "border-orange-500 bg-orange-50" : "hover:bg-gray-50"}"
           data-label="${key}" data-qid="${q.id}">
        <span class="font-medium mr-2">${key}.</span>${val}
      </div>`;
  });

  container.innerHTML = `
    <div class="bg-white p-6 rounded shadow">
      <h2 class="text-xl font-semibold mb-4">${q.question}</h2>
      <div class="space-y-2">${optionsHTML}</div>
    </div>
  `;

  container.querySelectorAll(".option").forEach(opt => {
    opt.onclick = () => {
      const label = opt.dataset.label;
      const qid = parseInt(opt.dataset.qid, 10);
      answers[qid] = label;
      updateSidebarStatus(qid);
      updateCounts();
      renderQuestion();
    };
  });

  document.getElementById("prevBtn").disabled = currentQuestionIndex === 0;
}


function updateCounts() {
  let answered = 0, skipped = 0;
  QUESTIONS.forEach(q => {
    if (answers[q.id] === "") skipped++;
    else if (answers[q.id]) answered++;
  });
  answeredCountEl.textContent = answered;
  skippedCountEl.textContent = skipped;
  notAnsweredCountEl.textContent = QUESTIONS.length - answered - skipped;
}

function onPrev() { if(currentQuestionIndex>0){currentQuestionIndex--;renderQuestion();} }
function onNext() { if(currentQuestionIndex<QUESTIONS.length-1){currentQuestionIndex++;renderQuestion();} }

function onSkip() {
  const q = QUESTIONS[currentQuestionIndex];
  if (!answers.hasOwnProperty(q.id)) answers[q.id] = "";
  updateSidebarStatus(q.id);
  updateCounts();
  currentQuestionIndex = (currentQuestionIndex + 1) % QUESTIONS.length;
  renderQuestion();
}

function onSubmit() {
  clearInterval(timerInterval);
  const result = computeScore();

  fetch('save-quiz.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
  test_id:  <?= htmlspecialchars($test_id) ?>,
      answers: answers,
      score: result.score
    })
  })
  .then(res => res.json())
  
  .then(data => showResult(result)
) 
  .catch(() => showResult(result));
}

function computeScore() {
  let score = 0;
  const detail = [];
  QUESTIONS.forEach(q => {
    const given = answers[q.id];
    const correct = q.correct;
    const isCorrect = given === correct;
    if (isCorrect) score += q.mark || 1;
    detail.push({ id: q.id, question: q.question, given, correct, options: q.options, isCorrect });
  });
  return { score, total: QUESTIONS.reduce((s,q)=>s+(q.mark||1),0), detail };
}

function showResult(precomputed) {
  const data = precomputed || computeScore();
  quizContent.classList.add("hidden");
  resultPage.classList.remove("hidden");
  document.getElementById("resultText").textContent = `You scored 3 out of ${data.total}`;
}

function clearAll() { answers = {}; currentQuestionIndex=0; resultPage.classList.add("hidden"); }
</script>

</body>
</html>