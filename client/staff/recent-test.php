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

<style>
  .quiz-list-container {
  max-width: 1200px;
  margin: 30px auto;
  padding: 24px;
  background: #f0f4f8;
  border-radius: 12px;
  box-shadow: 0 8px 16px rgba(0,0,0,0.1);
  font-family: 'Segoe UI', sans-serif;
}

.quiz-list-container h2 {
  font-size: 24px;
  margin-bottom: 8px;
  color: #333;
}

.quiz-list-container .description {
  font-size: 14px;
  color: #666;
  margin-bottom: 16px;
}

.quiz-info-list {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.quiz-info-list li {
  background: #fff;
  padding: 10px 14px;
  margin-bottom: 10px;
  border-radius: 8px;
  font-size: 15px;
  color: #444;
  display: flex;
  justify-content: space-between;
  align-items: center;
  box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}

.status {
  padding: 2px 8px;
  border-radius: 4px;
  font-weight: bold;
}

.status.active {
  background-color: #d4edda;
  color: #155724;
}

.quiz-list-container{
  display: flex;
  gap: 3rem;
  flex-direction: column;
}


</style>    

</head>

<body class="bg-gray-50 text-gray-800">
      <?php include('./header.php') ?>

    <main class="container mx-auto px-4 py-6">
        <?php include('./nav.php') ?>
        
  <div class="quiz-list-container">
  <div>
    <h2>Data Structures Quiz</h2>
  <p class="description">Covers Linked Lists, Trees, and Graphs fundamentals.</p>

  <ul class="quiz-info-list">
    <li><strong>Domain:</strong> Programming</li>
    <li><strong>Department:</strong> CSE</li>
    <li><strong>Year:</strong> II</li>
    <li><strong>Start Time:</strong> 10:00 AM</li>
    <li><strong>End Time:</strong> 11:00 AM</li>
    <li><strong>Duration:</strong> 60 mins</li>
    <li><strong>Total Questions:</strong> 25</li>
    <li><strong>Total Marks:</strong> 50</li>
    <li><strong>Status:</strong> <span class="status active">Active</span></li>
  </ul>
  </div>
  <div>
    <h2>Data Structures Quiz</h2>
  <p class="description">Covers Linked Lists, Trees, and Graphs fundamentals.</p>

  <ul class="quiz-info-list">
    <li><strong>Domain:</strong> Programming</li>
    <li><strong>Department:</strong> CSE</li>
    <li><strong>Year:</strong> II</li>
    <li><strong>Start Time:</strong> 10:00 AM</li>
    <li><strong>End Time:</strong> 11:00 AM</li>
    <li><strong>Duration:</strong> 60 mins</li>
    <li><strong>Total Questions:</strong> 25</li>
    <li><strong>Total Marks:</strong> 50</li>
    <li><strong>Status:</strong> <span class="status active">Active</span></li>
  </ul>
  </div>
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
