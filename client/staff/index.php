<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Staff Dashboard</title>

  <!-- TailwindCSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

  <?php include('./header.php') ?>

  <main class="container mx-auto p-6 flex flex-col gap-8">


    <section id="nav-section" class="mb-6">
      <?php include('./nav.php') ?>
    </section>


<section id="welcome-section" class="mb-10 relative overflow-hidden">
  <div class="relative z-10">
    <h2 class="text-2xl font-bold text-gray-800 tracking-tight">
      Welcome Back, Alex
    </h2>
    <p class="mt-2 text-gray-600 text-base">
      Here’s an overview of your recent activity and quizzes.
    </p>
  </div>

</section>


<section id="stats-section" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

  <!-- Quizzes Created -->
  <div class="bg-white p-6 rounded-2xl shadow-lg border-t-4 border-orange-400 hover:shadow-xl transition">
    <div class="flex items-center space-x-4">
      <div class="bg-orange-100 p-3 rounded-xl">
        <i data-lucide="book-open" class="w-7 h-7 text-orange-500"></i>
      </div>
      <div>
        <p class="text-sm text-gray-500">Quizzes Created</p>
        <p class="text-3xl font-bold text-gray-800">8</p>
        <p class="text-xs text-green-600 mt-1">↑ 12% vs last semester</p>
      </div>
    </div>
  </div>

  <!-- Students Evaluated -->
  <div class="bg-white p-6 rounded-2xl shadow-lg border-t-4 border-blue-400 hover:shadow-xl transition">
    <div class="flex items-center space-x-4">
      <div class="bg-blue-100 p-3 rounded-xl">
        <i data-lucide="users" class="w-7 h-7 text-blue-500"></i>
      </div>
      <div>
        <p class="text-sm text-gray-500">Students Evaluated</p>
        <p class="text-3xl font-bold text-gray-800">156</p>
        <p class="text-xs text-green-600 mt-1">↑ 8% vs last month</p>
      </div>
    </div>
  </div>

  <!-- Avg. Performance -->
  <div class="bg-white p-6 rounded-2xl shadow-lg border-t-4 border-green-400 hover:shadow-xl transition">
    <div class="flex items-center space-x-4">
      <div class="bg-green-100 p-3 rounded-xl">
        <i data-lucide="trending-up" class="w-7 h-7 text-green-500"></i>
      </div>
      <div class="flex-1">
        <p class="text-sm text-gray-500">Avg. Performance</p>
        <p class="text-3xl font-bold text-gray-800">78%</p>
        <div class="mt-2 w-full bg-gray-200 h-2 rounded-full overflow-hidden">
          <div class="bg-green-400 h-2 rounded-full" style="width: 78%"></div>
        </div>
        <p class="text-xs text-green-600 mt-1">↑ 3% vs last term</p>
      </div>
    </div>
  </div>

  <!-- Active Quizzes -->
  <div class="bg-white p-6 rounded-2xl shadow-lg border-t-4 border-yellow-400 hover:shadow-xl transition">
    <div class="flex items-center space-x-4">
      <div class="bg-yellow-100 p-3 rounded-xl">
        <i data-lucide="clock" class="w-7 h-7 text-yellow-500"></i>
      </div>
      <div>
        <p class="text-sm text-gray-500">Active Quizzes</p>
        <p class="text-3xl font-bold text-gray-800">3</p>
        <p class="text-xs text-gray-500 mt-1">Currently running</p>
      </div>
    </div>
  </div>

</section>


<section id="filters-section" 
         class="flex flex-col md:flex-row items-center justify-between gap-4 mb-6">

  <!-- Search Bar -->
  <div class="flex items-center bg-gray-50 border border-gray-200 p-3 rounded-xl shadow-sm w-full md:w-1/2 focus-within:ring-2 focus-within:ring-orange-400 transition">
    <i data-lucide="search" class="w-5 h-5 text-gray-400 mr-2"></i>
    <input type="text" 
           id="search-input" 
           placeholder="Search quizzes..." 
           class="w-full bg-transparent outline-none text-gray-700 placeholder-gray-400" />
  </div>

  <!-- Filters & Button -->
  <div class="flex space-x-3">
    <select id="filter-status" 
            class="p-2.5 rounded-xl border border-gray-200 bg-white shadow-sm text-gray-700 cursor-pointer hover:border-orange-400 focus:ring-2 focus:ring-orange-400 transition">
      <option value="all">All</option>
      <option value="active">Active</option>
      <option value="completed">Completed</option>
    </select>

    <button class="flex items-center px-5 py-2.5 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow-sm transition">
      <i data-lucide="bar-chart-3" class="w-5 h-5 mr-2"></i> Analytics
    </button>
  </div>
</section>




<section id="quiz-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

  <!-- Quiz Card -->
  <div class="bg-white p-5 rounded-xl shadow hover:shadow-md transition border-l-4 border-orange-500">
    <h3 class="text-lg font-semibold text-gray-800">Java Basics Quiz</h3>
    <p class="text-sm text-gray-500 mb-3">Created on: Jan 15, 2025</p>
    <div class="flex justify-between items-center">
      <span class="px-3 py-1 text-xs rounded-full bg-orange-100 text-orange-600 font-medium">Active</span>
      <button class="text-sm text-orange-600 hover:underline">View</button>
    </div>
  </div>

  <!-- Quiz Card -->
  <div class="bg-white p-5 rounded-xl shadow hover:shadow-md transition border-l-4 border-orange-500">
    <h3 class="text-lg font-semibold text-gray-800">HTML & CSS Fundamentals</h3>
    <p class="text-sm text-gray-500 mb-3">Created on: Dec 30, 2024</p>
    <div class="flex justify-between items-center">
      <span class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-600 font-medium">Completed</span>
      <button class="text-sm text-orange-600 hover:underline">View</button>
    </div>
  </div>

  <!-- Quiz Card -->
  <div class="bg-white p-5 rounded-xl shadow hover:shadow-md transition border-l-4 border-orange-500">
    <h3 class="text-lg font-semibold text-gray-800">Python Advanced Concepts</h3>
    <p class="text-sm text-gray-500 mb-3">Created on: Feb 2, 2025</p>
    <div class="flex justify-between items-center">
      <span class="px-3 py-1 text-xs rounded-full bg-orange-100 text-orange-600 font-medium">Active</span>
      <button class="text-sm text-orange-600 hover:underline">View</button>
    </div>
  </div>

  <!-- Quiz Card -->
  <div class="bg-white p-5 rounded-xl shadow hover:shadow-md transition border-l-4 border-orange-500">
    <h3 class="text-lg font-semibold text-gray-800">Database Management Quiz</h3>
    <p class="text-sm text-gray-500 mb-3">Created on: Nov 20, 2024</p>
    <div class="flex justify-between items-center">
      <span class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-600 font-medium">Completed</span>
      <button class="text-sm text-orange-600 hover:underline">View</button>
    </div>
  </div>

</section>

  </main>


  <section id="api-section">
    <?php include('../resource/api.php') ?>
  </section>


  <script>

    lucide.createIcons();

    async function checkSession() {
      try {
        const res = await fetch('<?php echo $api; ?>helpers/sessionStatus.php', { credentials: 'include' });
        const data = await res.json();
        if (!data.logged_in) window.location.href = './';
      } catch (err) {
        console.error("Session check failed", err);
      }
    }

    async function handleLogout() {
      document.getElementById("logout-btn")?.addEventListener("click", async () => {
        try {
          const res = await fetch('<?php echo $api; ?>helpers/logout.php', {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' }
          });
          const data = await res.json();
          if (data.success) {
            alert("Logout successful!");
            window.location.href = "../";
          } else {
            alert("Logout failed!");
          }
        } catch (err) {
          alert("Logout error: " + err.message);
        }
      });
    }

    function renderQuizzes(searchTerm = '', filterStatus = 'all') {
      const quizGrid = document.getElementById('quiz-section');
      quizGrid.innerHTML = '';

      const filteredQuizzes = quizzes.filter(quiz => {
        const matchesSearch = quiz.title.toLowerCase().includes(searchTerm.toLowerCase()) ||
                              quiz.subject.toLowerCase().includes(searchTerm.toLowerCase());
        const matchesFilter = filterStatus === 'all' || quiz.status === filterStatus;
        return matchesSearch && matchesFilter;
      });

      if (filteredQuizzes.length === 0) {
        quizGrid.innerHTML = `
          <div class="col-span-full bg-white p-6 rounded-2xl shadow text-center">
            <i data-lucide="book-open" class="w-10 h-10 text-gray-400 mx-auto mb-2"></i>
            <h3 class="text-lg font-semibold text-gray-700">No quizzes found</h3>
            <p class="text-gray-500">Try adjusting your search or filter criteria.</p>
          </div>
        `;
        lucide.createIcons();
        return;
      }

      filteredQuizzes.forEach(quiz => {
        const quizCard = document.createElement('div');
        quizCard.className = 'bg-white p-6 rounded-2xl shadow flex flex-col justify-between';
        quizCard.innerHTML = `
          <div>
            <h3 class="text-lg font-semibold text-gray-700">${quiz.title}</h3>
            <p class="text-gray-500">${quiz.subject}</p>
            <p class="text-sm text-gray-600"><strong>Instructor:</strong> ${quiz.instructor}</p>
            <div class="flex justify-between mt-3 text-sm text-gray-500">
              <span class="flex items-center gap-1"><i data-lucide="clock" class="w-4 h-4"></i>${quiz.duration} min</span>
              <span class="flex items-center gap-1"><i data-lucide="book-open" class="w-4 h-4"></i>${quiz.totalQuestions} Qs</span>
              <span class="flex items-center gap-1"><i data-lucide="users" class="w-4 h-4"></i>${quiz.enrolledStudents}/${quiz.maxStudents}</span>
            </div>
          </div>
          <button class="mt-4 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg" onclick="manageQuiz('${quiz.id}')">
            Manage
          </button>
        `;
        quizGrid.appendChild(quizCard);
      });

      lucide.createIcons();
    }

    function manageQuiz(quizId) {
      alert(`Managing quiz ID: ${quizId}`);
    }

    window.addEventListener('DOMContentLoaded', () => {
      checkSession();
      handleLogout();
      renderQuizzes();
    });
  </script>
</body>
</html>
