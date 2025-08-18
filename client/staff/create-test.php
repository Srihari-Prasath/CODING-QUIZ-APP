<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Test</title>

  <!-- TailwindCSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-gray-100 min-h-screen font-sans">


  <?php include('./header.php') ?>

  <main class="container mx-auto p-6 flex flex-col gap-8">

    <section id="nav-section">
      <?php include('./nav.php') ?>
    </section>

    <section id="title-section">
      <h2 class="text-3xl font-bold text-gray-800 mb-2">Create New Test</h2>
      <p class="text-gray-500">Fill out the form below to create a new test for students.</p>
    </section>

<section id="form-section" class="bg-white p-8 rounded-3xl shadow-xl w-full max-w-[95%] mx-auto">
  <form id="create-test-form" class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <!-- Test Title -->
    <div class="flex flex-col md:col-span-2">
      <label for="title" class="font-semibold text-gray-700 mb-2">Test Title</label>
      <input type="text" name="title" id="title" placeholder="Enter test title" required
             class="p-3 md:p-4 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 outline-none transition duration-200 w-full" />
    </div>

    <!-- Subject -->
    <div class="flex flex-col md:col-span-2">
      <label for="subject" class="font-semibold text-gray-700 mb-2">Subject</label>
      <input type="text" name="domain" id="subject" placeholder="Enter subject" required
             class="p-3 md:p-4 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 outline-none transition duration-200 w-full" />
    </div>

    <!-- Timing Dropdown -->
    <div class="flex flex-col md:col-span-2 relative">
      <label class="font-semibold text-gray-700 mb-2">Timing</label>
      <div class="relative">
        <button type="button" class="w-full p-3 md:p-4 border border-gray-300 rounded-xl shadow-sm bg-white text-left focus:ring-2 focus:ring-orange-400 focus:border-orange-400 outline-none transition duration-200" id="timingBtn">
          --Select Timing--
        </button>
        <ul class="absolute z-10 w-full bg-white border border-gray-300 rounded-xl shadow-lg mt-1 hidden" id="timingList">
          <li class="p-3 hover:bg-orange-100 cursor-pointer" data-value="morning">Morning</li>
          <li class="p-3 hover:bg-orange-100 cursor-pointer" data-value="afternoon">Afternoon</li>
          <li class="p-3 hover:bg-orange-100 cursor-pointer" data-value="evening">Evening</li>
          <li class="p-3 hover:bg-orange-100 cursor-pointer" data-value="full_day">Full Day</li>
        </ul>
        <input type="hidden" name="timing" id="timingInput">
      </div>
    </div>

    <!-- Total Marks -->
    <div class="flex flex-col md:col-span-1">
      <label for="totalMarks" class="font-semibold text-gray-700 mb-2">Total Marks</label>
      <input type="number" name="total_marks" id="totalMarks" placeholder="Enter marks" required
             class="p-3 md:p-4 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 outline-none transition duration-200 w-full" />
    </div>

    <!-- Total Questions -->
    <div class="flex flex-col md:col-span-1">
      <label for="totalQuestion" class="font-semibold text-gray-700 mb-2">Total Questions</label>
      <input type="number" name="total_questions" id="totalQuestion" placeholder="Enter total questions" required
             class="p-3 md:p-4 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 outline-none transition duration-200 w-full" />
    </div>

    <!-- Select Topic -->
    <div class="flex flex-col md:col-span-2 relative">
      <label class="font-semibold text-gray-700 mb-2">Select Topic</label>
      <div class="relative">
        <button type="button" class="w-full p-3 md:p-4 border border-gray-300 rounded-xl shadow-sm bg-white text-left focus:ring-2 focus:ring-orange-400 focus:border-orange-400 outline-none transition duration-200" id="topicBtn">
          --Select Topic--
        </button>
        <ul class="absolute z-10 w-full bg-white border border-gray-300 rounded-xl shadow-lg mt-1 hidden" id="topicList">
          <li class="p-3 hover:bg-orange-100 cursor-pointer" data-value="topic1">Dummy Topic 1</li>
          <li class="p-3 hover:bg-orange-100 cursor-pointer" data-value="topic2">Dummy Topic 2</li>
          <li class="p-3 hover:bg-orange-100 cursor-pointer" data-value="topic3">Dummy Topic 3</li>
          <li class="p-3 hover:bg-orange-100 cursor-pointer" data-value="topic4">Dummy Topic 4</li>
        </ul>
        <input type="hidden" name="topic" id="topicInput">
      </div>
    </div>

    <!-- Year & Department -->
    <div class="flex flex-col md:flex-row gap-4 md:col-span-2">

      <!-- Year -->
      <div class="flex-1 flex flex-col relative">
        <label class="font-semibold text-gray-700 mb-2">Year</label>
        <div class="relative">
          <button type="button" class="w-full p-3 md:p-4 border border-gray-300 rounded-xl shadow-sm bg-white text-left focus:ring-2 focus:ring-orange-400 focus:border-orange-400 outline-none transition duration-200" id="yearBtn">
            --Select Year--
          </button>
          <ul class="absolute z-10 w-full bg-white border border-gray-300 rounded-xl shadow-lg mt-1 hidden" id="yearList">
            <li class="p-3 hover:bg-orange-100 cursor-pointer" data-value="1">1st Year</li>
            <li class="p-3 hover:bg-orange-100 cursor-pointer" data-value="2">2nd Year</li>
            <li class="p-3 hover:bg-orange-100 cursor-pointer" data-value="3">3rd Year</li>
            <li class="p-3 hover:bg-orange-100 cursor-pointer" data-value="4">4th Year</li>
          </ul>
          <input type="hidden" name="year" id="yearInput">
        </div>
      </div>

      <!-- Department -->
      <div class="flex-1 flex flex-col relative">
        <label class="font-semibold text-gray-700 mb-2">Department</label>
        <div class="relative">
          <button type="button" class="w-full p-3 md:p-4 border border-gray-300 rounded-xl shadow-sm bg-white text-left focus:ring-2 focus:ring-orange-400 focus:border-orange-400 outline-none transition duration-200" id="departmentBtn">
            --Select Department--
          </button>
          <ul class="absolute z-10 w-full bg-white border border-gray-300 rounded-xl shadow-lg mt-1 hidden" id="departmentList">
            <li class="p-3 hover:bg-orange-100 cursor-pointer" data-value="cse">CSE</li>
            <li class="p-3 hover:bg-orange-100 cursor-pointer" data-value="ece">ECE</li>
            <li class="p-3 hover:bg-orange-100 cursor-pointer" data-value="mech">MECH</li>
            <li class="p-3 hover:bg-orange-100 cursor-pointer" data-value="civil">CIVIL</li>
          </ul>
          <input type="hidden" name="department" id="departmentInput">
        </div>
      </div>

    </div>

    <!-- Description -->
    <div class="flex flex-col md:col-span-2">
      <label for="description" class="font-semibold text-gray-700 mb-2">Description</label>
      <textarea name="description" id="description" rows="4" placeholder="Enter description..."
                class="p-3 md:p-4 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 outline-none transition duration-200 w-full"></textarea>
    </div>

    <div class="md:col-span-2 flex justify-center mt-6">
      <button type="submit"
              class="px-8 py-3 bg-gradient-to-r from-orange-500 to-orange-400 hover:from-orange-600 hover:to-orange-500 text-white rounded-2xl shadow-lg font-semibold transition duration-200">
        Create Test
      </button>
    </div>

  </form>
</section>


  </main>

  <?php include('../resource/api.php') ?>
  <?php include('../resource/logout.php') ?>
  <?php include('../resource/check_session.php') ?>

  <script>
    document.getElementById('create-test-form').addEventListener('submit', async (e) => {
      e.preventDefault();

      const form = e.target;
      const jsonObject = {
        title: form.title.value,
        description: form.description.value,
        domain: form.domain.value,
        year: parseInt(form.year.value),
        start_time: form.startTime.value,
        end_time: form.endTime.value,
        duration_minutes: parseInt(form.duration.value),
        total_marks: parseInt(form.totalMarks.value),
        total_questions: parseInt(form.totalQuestion.value),
      };

      try {
        const response = await fetch('<?php echo $api; ?>faculty/test/testRoutes.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          credentials: 'include',
          body: JSON.stringify(jsonObject)
        });

        const result = await response.json();
        alert(result.message || result.error);
        form.reset();
      } catch (error) {
        console.error('Request failed:', error);
        alert("Request failed: " + error.message);
      }
    });
  </script>
  <script>
function setupDropdown(btnId, listId, inputId) {
  const btn = document.getElementById(btnId);
  const list = document.getElementById(listId);
  const input = document.getElementById(inputId);

  btn.addEventListener('click', () => list.classList.toggle('hidden'));

  list.querySelectorAll('li').forEach(item => {
    item.addEventListener('click', () => {
      btn.textContent = item.textContent;
      input.value = item.dataset.value;
      list.classList.add('hidden');
    });
  });

  document.addEventListener('click', e => {
    if (!btn.contains(e.target) && !list.contains(e.target)) {
      list.classList.add('hidden');
    }
  });
}


setupDropdown('timingBtn', 'timingList', 'timingInput');
setupDropdown('topicBtn', 'topicList', 'topicInput');
setupDropdown('yearBtn', 'yearList', 'yearInput');
setupDropdown('departmentBtn', 'departmentList', 'departmentInput');
</script>
</body>
</html>
