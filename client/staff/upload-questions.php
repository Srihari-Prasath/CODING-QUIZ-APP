<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Questions</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="../assets/css/staff/upload-questions.css">
</head>

<body>
    <header>
        <div class="container header-content">
            <div>
                <h1>Staff Dashboard</h1>
                <p>Manage quizzes and monitor student progress</p>
            </div>
            <div class="profile">
                <img src="/placeholder-avatar.jpg" alt="Profile">
                <div class="profile-info">
                    <p class="name">Alex Thompson</p>
                    <p class="role">Faculty</p>
                </div>
                <span id="logout-btn" class="logout-btn"><i data-lucide="log-out"></i></span>
            </div>
        </div>
    </header>

    <main class="container">
        <?php include('./nav.php') ?>

        <h2>Upload Questions</h2>
        <form id="upload-questions-form" enctype="multipart/form-data">
            <div class="form-group">
                <label>Select Quiz</label>
                <select id="quizSelect" name="quizId" required>
                    <option value="">Select a quiz</option>
                </select>
            </div>

            <div class="form-group">
                <label>Upload Questions File (CSV)</label>
               <input type="file" name="questionsFile" id="questionsFile" accept=".xlsx, .xlsm, .csv" required>

            </div>
            <button type="submit">Upload Questions</button>
        </form>
    </main>



    <!-- form post -->
    <?php include('../resource/api.php') ?>

    <script>
        // fetch tests
        window.addEventListener('DOMContentLoaded', async () => {
            try {
                const response = await fetch('<?php echo $api; ?>faculty/test/testRoutes.php');
                const result = await response.json();

                if (result.success) {
                    const quizSelect = document.getElementById('quizSelect');
                    quizSelect.innerHTML = '<option value="">Select a quiz</option>';

                    result.data.forEach(test => {
                        const option = document.createElement('option');
                        option.value = test.test_id;
                        option.textContent = test.title;
                        quizSelect.appendChild(option);
                    });
                } else {
                    console.error('Failed to load tests:', result.message);
                }
            } catch (err) {
                console.error('Error fetching quiz list:', err);
            }
        });



       
    </script>


    <script>
document.getElementById('upload-questions-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    const form = document.getElementById('upload-questions-form');
    const formData = new FormData(form);

    try {
        const response = await fetch('<?php echo $api; ?>faculty/question/questionRoutes.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();
        alert(result.message || result.error);

        if (result.message) {
            form.reset();
        }
    } catch (error) {
        console.error('Request failed:', error);
    }
});
</script>


</body>

</html>