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

  <style>
    select option:checked,
    select option:hover {
      background-color: #f97316;
      color: white;
    }
  </style>
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

        <div class="flex flex-col md:col-span-1 relative">
          <label class="font-semibold text-gray-700 mb-2">Timing</label>
          <div class="relative">

            <select
              name="timing"
              id="timingSelect"
              required
              class="w-full p-3 md:p-4 border border-gray-300 rounded-xl shadow-sm bg-white text-gray-700 text-lg 
           focus:ring-2 focus:ring-orange-400 focus:border-orange-400 outline-none transition duration-200">
              <option value="">--Select Timing--</option>
              <option value="morning">Morning</option>
              <option value="afternoon">Afternoon</option>
              <option value="evening">Evening</option>
              <option value="full_day">Full Day</option>
            </select>


          </div>
        </div>

        <div class="flex flex-col md:col-span-1">
          <label for="Duration" class="font-semibold text-gray-700 mb-2">Duration ( In Minutes )</label>
          <input type="number" name="Duration" id="Duration" placeholder="Enter Duration" required
            class="p-3 md:p-4 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 outline-none transition duration-200 w-full" />
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
            <select
              name="topic"
              id="topicSelect"
              required
              class="w-full p-3 md:p-4 border border-gray-300 rounded-xl shadow-sm bg-white text-gray-700 text-lg 
           focus:ring-2 focus:ring-orange-400 focus:border-orange-400 outline-none transition duration-200">
              <option value="">--Select Topic--</option>


            </select>


          </div>
        </div>

        <!-- Year & Department -->
        <div class="flex flex-col md:flex-row gap-4 md:col-span-2">

          <!-- Year -->
          <div class="flex-1 flex flex-col relative">
            <label class="font-semibold text-gray-700 mb-2">Year</label>
            <div class="relative">
              <select
                name="year"
                id="yearSelect"
                required
                class="w-full p-3 md:p-4 border border-gray-300 rounded-xl shadow-sm bg-white text-gray-700 text-lg 
           focus:ring-2 focus:ring-orange-400 focus:border-orange-400 outline-none transition duration-200">
                <option value="">--Select Year--</option>
                <option value="1">1st Year</option>
                <option value="2">2nd Year</option>
                <option value="3">3rd Year</option>
                <option value="4">4th Year</option>
              </select>
            </div>
          </div>

          <!-- Department -->
          <div class="flex-1 flex flex-col relative">
            <label class="font-semibold text-gray-700 mb-2">Department</label>
            <div class="relative">
              <select
                name="department"
                id="departmentSelect"
                required
                class="w-full p-3 md:p-4 border border-gray-300 rounded-xl shadow-sm bg-white text-gray-700 text-lg 
         focus:ring-2 focus:ring-orange-400 focus:border-orange-400 outline-none transition duration-200">
                <option value="" class="py-3">--Select Department--</option>
                <option value="cse" class="py-3">CSE</option>
                <option value="ece" class="py-3">ECE</option>
                <option value="mech" class="py-3">MECH</option>
                <option value="civil" class="py-3">CIVIL</option>
              </select>

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

  <script>
    let name = document.querySelector('.name-text');
    let main_name = document.querySelector('.main-name');
    let role = document.querySelector('.role-text');
    // session
    async function checkSession() {
      try {
        const res = await fetch('<?php echo $api ?>helpers/check_session.php', {
          credentials: 'include'
        });

        const data = await res.json();

        name.textContent = data.full_name || 'error';
        main_name.textContent = data.full_name || 'error';
        role.textContent = data.role || 'error';

        if (!data.logged_in) {

          window.location.href = '../';
        }
      } catch (err) {
        console.error('Session check failed', err);
      }
    };

    // fetch topics

   async function fetchTopics() {
  try {
    let userId = 1;

    if (!userId) {
      try {
        const res = await fetch('<?php echo $api ?>helpers/check_session.php', {
          credentials: 'include'
        });
        const data = await res.json();
        userId = data.id;
        window.currentUserId = userId;
      } catch (err) {
        console.error('Could not get user id from session:', err);
      }
    }

    const url = userId 
      ? `<?php echo $api; ?>faculty/topics/getTopics.php?user_id=${userId}` 
      : `<?php echo $api; ?>faculty/topics/getTopics.php`;

    const response = await fetch(url, { credentials: 'include' });
    const result = await response.json();

    if (result.success && Array.isArray(result.topics)) {
      const topicSelect = document.getElementById('topicSelect');
      if (topicSelect) {
        
        topicSelect.innerHTML = '<option value="">--Select Topic--</option>';
        
   
        result.topics.forEach(topic => {
          const opt = document.createElement('option');
          opt.value = topic.topic_id;
          opt.textContent = topic.title;
          topicSelect.appendChild(opt);
        });
      }
    }
  } catch (err) {
    console.error('Failed to fetch topics:', err);
  }
}

    window.addEventListener('DOMContentLoaded', () => {
      checkSession();
      fetchTopics()

    });
  </script>
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
          headers: {
            'Content-Type': 'application/json'
          },
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
</body>

</html>