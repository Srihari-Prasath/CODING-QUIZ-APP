<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Test Result | CodeCampus</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: linear-gradient(135deg,#fff7f0,#fff3e6);
    }
    .fade-in {
      opacity: 0;
      transform: translateY(20px) scale(0.98);
      animation: fadeInUp 0.6s ease forwards;
    }
    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }
    .card-animate:hover {
      transform: scale(1.015);
      box-shadow: 0 12px 28px -6px rgba(255, 102, 0, 0.35);
    }
    .score-badge {
      min-width: 56px;
      height: 56px;
      border-radius: 9999px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 600;
      font-size: 0.875rem;
      box-shadow: 0 8px 24px -4px rgba(235,92,11,0.3);
      animation: popIn 0.4s ease forwards;
    }
    @keyframes popIn {
      0% { transform: scale(0.6); opacity: 0; }
      80% { transform: scale(1.1); opacity: 1; }
      100% { transform: scale(1); }
    }
    .footer-animate {
      animation: slideFadeIn 1s ease forwards;
    }
    @keyframes slideFadeIn {
      from { opacity: 0; transform: translateY(40px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body class="font-sans text-gray-800">

  <div class="max-w-6xl mx-auto px-6 py-10">
    <!-- Header / Title with Send Button -->
    <div class="flex justify-between items-center mb-8 fade-in" style="animation-delay:.05s">
      <div class="text-left">
        <h1 class="text-5xl font-extrabold text-orange-600 drop-shadow-md mb-2 animate-pulse">🎓 Student Test Result</h1>
        <p class="text-gray-600">Detailed breakdown of your performance</p>
      </div>
      <button
        id="sendMailBtn"
        class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-4 py-2 rounded-xl shadow-md transition-transform duration-300 hover:scale-105"
      >
        📩 Send to Mail
      </button>
    </div>

    <!-- Summary -->
    <div class="grid grid-cols-1 sm:grid-cols-5 gap-4 mb-10">
      <div class="bg-white rounded-xl shadow-lg p-5 flex flex-col items-center border-l-4 border-orange-500 fade-in card-animate" style="animation-delay:.1s">
        <div class="text-sm text-gray-500">Total Questions</div>
        <div class="text-2xl font-bold text-orange-600" id="total-questions">0</div>
      </div>
      <div class="bg-white rounded-xl shadow-lg p-5 flex flex-col items-center border-l-4 border-green-500 fade-in card-animate" style="animation-delay:.2s">
        <div class="text-sm text-gray-500">Correct</div>
        <div class="text-2xl font-bold text-green-600" id="correct-answers">0</div>
      </div>
      <div class="bg-white rounded-xl shadow-lg p-5 flex flex-col items-center border-l-4 border-red-500 fade-in card-animate" style="animation-delay:.3s">
        <div class="text-sm text-gray-500">Wrong</div>
        <div class="text-2xl font-bold text-red-600" id="wrong-answers">0</div>
      </div>
      <div class="bg-white rounded-xl shadow-lg p-5 flex flex-col items-center border-l-4 border-blue-500 fade-in card-animate" style="animation-delay:.4s">
        <div class="text-sm text-gray-500">Total Score</div>
        <div class="text-2xl font-bold text-blue-600" id="total-score">0</div>
      </div>
      <div class="bg-white rounded-xl shadow-lg p-5 flex flex-col items-center border-l-4 border-yellow-500 fade-in card-animate" style="animation-delay:.5s">
        <div class="text-sm text-gray-500">Score Per Question</div>
        <div class="text-2xl font-bold text-yellow-600">1</div>
      </div>
    </div>

    <!-- Questions list -->
    <div id="questions-container" class="space-y-6"></div>
  </div>

  <footer class="text-center text-sm text-gray-500 py-6 footer-animate">
    © 2025 CodeCampus. All rights reserved.
  </footer>

  <script>
    const resultsData = [
      {
        question: "What is the capital of France?",
        options: ["Berlin", "Madrid", "Paris", "Rome"],
        correctIndex: 2,
        selectedIndex: 2,
      },
      {
        question: "Which planet is known as the Red Planet?",
        options: ["Earth", "Mars", "Venus", "Saturn"],
        correctIndex: 1,
        selectedIndex: 0,
      },
      {
        question: "What is 5 + 7?",
        options: ["10", "11", "12", "13"],
        correctIndex: 2,
        selectedIndex: 2,
      }
    ];

    const scorePerQuestion = 1;
    let correct = 0;
    const container = document.getElementById("questions-container");

    resultsData.forEach((q, idx) => {
      const isCorrect = q.selectedIndex === q.correctIndex;
      if (isCorrect) correct++;

      const card = document.createElement("div");
      card.className = `relative flex flex-col md:flex-row items-start gap-4 bg-white rounded-2xl shadow-lg p-6 border ${isCorrect ? 'border-green-300' : 'border-red-300'} fade-in card-animate`;
      card.style.animationDelay = `${0.6 + idx * 0.15}s`;

      const left = document.createElement("div");
      left.className = "flex-1";

      const qTitle = document.createElement("h2");
      qTitle.className = "text-lg font-semibold text-orange-700 mb-2";
      qTitle.textContent = `Q${idx+1}: ${q.question}`;

      const optionsList = document.createElement("ul");
      optionsList.className = "space-y-2";

      q.options.forEach((opt, i) => {
        const li = document.createElement("li");
        li.className = "flex justify-between items-center px-4 py-2 rounded-lg transition relative";

        if (i === q.correctIndex) {
          li.classList.add("bg-green-50", "border", "border-green-300", "text-green-800", "font-medium");
          li.innerHTML = `<span>${String.fromCharCode(65 + i)}. ${opt}</span><span class="text-sm">✔️ Correct</span>`;
        } else if (i === q.selectedIndex && i !== q.correctIndex) {
          li.classList.add("bg-red-50", "border", "border-red-300", "text-red-800");
          li.innerHTML = `<span>${String.fromCharCode(65 + i)}. ${opt}</span><span class="text-sm">✖️ Your answer</span>`;
        } else {
          li.classList.add("bg-gray-50");
          li.innerHTML = `<span>${String.fromCharCode(65 + i)}. ${opt}</span>`;
        }

        optionsList.appendChild(li);
      });

      left.appendChild(qTitle);
      left.appendChild(optionsList);

      const right = document.createElement("div");
      right.className = "flex-none flex items-center justify-center";
      const badge = document.createElement("div");
      badge.className = "score-badge " + (isCorrect ? "bg-green-500 text-white" : "bg-red-500 text-white");
      badge.textContent = isCorrect ? `+${scorePerQuestion}` : "+0";
      right.appendChild(badge);

      card.appendChild(left);
      card.appendChild(right);
      container.appendChild(card);
    });

    // Summary update
    document.getElementById("total-questions").textContent = resultsData.length;
    document.getElementById("correct-answers").textContent = correct;
    document.getElementById("wrong-answers").textContent = resultsData.length - correct;
    document.getElementById("total-score").textContent = correct * scorePerQuestion;

    // Send button simulation
    document.getElementById("sendMailBtn").addEventListener("click", () => {
      const btn = document.getElementById("sendMailBtn");
      btn.disabled = true;
      btn.innerText = "📨 Sending...";
      setTimeout(() => {
        btn.innerText = "✅ Sent!";
        btn.classList.remove("bg-orange-500");
        btn.classList.add("bg-green-500");
      }, 2000);
    });
  </script>
</body>
</html>
