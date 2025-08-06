<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Test</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/staff/create-test.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    

</head>

<body class="bg-gray-50 text-gray-800">
      <?php include('./header.php') ?>

    <main class="container mx-auto px-4 py-6">
        <?php include('./nav.php') ?>
        
    <div id="quiz-card" style="
  background: linear-gradient(to bottom right, #F97316, #fffbeb);
  box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
  border-radius: 1rem;
  padding: 1.5rem;
  border: 1px solid #F97316;
  font-family: ui-sans-serif, system-ui, sans-serif;
  margin-bottom: 1.5rem;
  transition: all 0.3s ease;
"
onmouseover="this.style.boxShadow='0 25px 50px -12px rgb(0 0 0 / 0.25)';this.style.transform='scale(1.02)'"
onmouseout="this.style.boxShadow='0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1)';this.style.transform='scale(1)'">
</div>

<script>

const quizData = {
  title: "Data Structures Quiz",
  description: "Covers Linked Lists, Trees, and Graphs fundamentals.",
  details: {
    domain: "Programming",
    department: "CSE",
    year: "II",
    startTime: "10:00 AM",
    endTime: "11:00 AM",
    duration: "60 mins",
    totalQuestions: "25",
    totalMarks: "50",
    status: "Active"
  }
};


function renderQuizCard() {
  const quizCard = document.getElementById('quiz-card');
  
  quizCard.innerHTML = `
    <h3 style="
      font-size: 1.5rem;
      line-height: 2rem;
      font-weight: 800;
      color: #7c2d12;
      margin-bottom: 0.5rem;
      letter-spacing: 0.025em;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    ">
      <i class="fas fa-brain" style="color: #92400e;"></i> ${quizData.title}
    </h3>

    <p style="
      font-size: 0.875rem;
      line-height: 1.25rem;
      color: #9a3412;
      margin-bottom: 1rem;
      font-style: italic;
    ">
      ${quizData.description}
    </p>

    <div style="
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      row-gap: 0.75rem;
      column-gap: 1.5rem;
      font-size: 15px;
      color: #7c2d12;
    ">
      <div>
        <i class="fas fa-folder" style="margin-right: 0.5rem; color: #92400e;"></i>
        <strong>Domain:</strong>
        <span style="color: #9a3412; margin-left: 0.25rem;">${quizData.details.domain}</span>
      </div>
      <div>
        <i class="fas fa-building-columns" style="margin-right: 0.5rem; color: #92400e;"></i>
        <strong>Department:</strong>
        <span style="color: #9a3412; margin-left: 0.25rem;">${quizData.details.department}</span>
      </div>
      <div>
        <i class="fas fa-calendar-alt" style="margin-right: 0.5rem; color: #92400e;"></i>
        <strong>Year:</strong>
        <span style="color: #9a3412; margin-left: 0.25rem;">${quizData.details.year}</span>
      </div>
      <div>
        <i class="fas fa-clock" style="margin-right: 0.5rem; color: #92400e;"></i>
        <strong>Start Time:</strong>
        <span style="color: #9a3412; margin-left: 0.25rem;">${quizData.details.startTime}</span>
      </div>
      <div>
        <i class="fas fa-hourglass-end" style="margin-right: 0.5rem; color: #92400e;"></i>
        <strong>End Time:</strong>
        <span style="color: #9a3412; margin-left: 0.25rem;">${quizData.details.endTime}</span>
      </div>
      <div>
        <i class="fas fa-stopwatch" style="margin-right: 0.5rem; color: #92400e;"></i>
        <strong>Duration:</strong>
        <span style="color: #9a3412; margin-left: 0.25rem;">${quizData.details.duration}</span>
      </div>
      <div>
        <i class="fas fa-list-ol" style="margin-right: 0.5rem; color: #92400e;"></i>
        <strong>Total Qs:</strong>
        <span style="color: #9a3412; margin-left: 0.25rem;">${quizData.details.totalQuestions}</span>
      </div>
      <div>
        <i class="fas fa-chart-bar" style="margin-right: 0.5rem; color: #92400e;"></i>
        <strong>Total Marks:</strong>
        <span style="color: #9a3412; margin-left: 0.25rem;">${quizData.details.totalMarks}</span>
      </div>
      <div>
        <i class="fas fa-check-circle" style="margin-right: 0.5rem; color: #92400e;"></i>
        <strong>Status:</strong>
        <span style="color: #15803d; font-weight: 700; margin-left: 0.25rem;">${quizData.details.status}</span>
      </div>
    </div>
  `;
}


</script>
    </main>

    <?php include('../resource/api.php') ?>

    <script>
        window.addEventListener('DOMContentLoaded', async () => {
            try {
                const response = await fetch('<?php echo $api; ?>faculty/test/testRoutes.php');
                const result = await response.json();

                if (result.success) {
                    const container = document.getElementById('recent-tests-container');

                    result.data.forEach(test => {
                        const div = document.createElement('div');
                        div.className = "bg-white border border-gray-200 rounded-xl shadow-md p-5";

                        div.innerHTML = `
                            <h3 class="text-xl font-semibold text-gray-800 mb-1">${test.title}</h3>
                            <p class="text-gray-600 mb-2">${test.description}</p>
                            <div class="text-sm text-gray-500 mb-2">
                                <span>Domain: ${test.domain}</span><br>
                                <span>Dept: ${test.department} | Year: ${test.year}</span>
                            </div>
                            <div class="text-sm text-gray-600 mb-2">
                                <span>Created by: ${test.created_by}</span><br>
                                <span>Start: ${test.start_time}</span><br>
                                <span>End: ${test.end_time}</span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-700 mb-2">
                                <span>Duration: ${test.duration_minutes} mins</span>
                                <span>Qs: ${test.total_questions}</span>
                                <span>Marks: ${test.total_marks}</span>
                            </div>
                            <div class="${test.is_active == 1 ? 'text-green-600' : 'text-red-600'} font-semibold text-sm">
                                Active: ${test.is_active == 1 ? 'Yes' : 'No'}
                            </div>
                        `;
                        container.appendChild(div);
                    });
                } else {
                    console.error('Failed to load tests:', result.message);
                }
            } catch (err) {
                console.error('Error fetching recent tests:', err);
            }
        });
        
    </script>


    <!-- logout  -->
    <?php include('../resource/logout.php') ?>
    <!-- session end  -->
    <?php include('../resource/check_session.php') ?>
</body>
</html>
