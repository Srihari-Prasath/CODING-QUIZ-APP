<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Test</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="../assets/css/staff/create-test.css">
</head>

<body>
    <?php include('./header.php') ?>

    <main class="container">
        <?php include('./nav.php') ?>

        <h2>Create New Test</h2>

        <form id="create-test-form">
            <div class="form-grid">

                <div class="form-group">
                    <label for="title">Test Title</label>
                    <input type="text" name="title" id="title" required>
                </div>

                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" name="domain" id="subject" required>
                </div>

                <div class="form-group">
                    <label for="totalMarks">Total Marks</label>
                    <input type="number" name="total_marks" id="totalMarks" required>
                </div>

                <div class="form-group">
                    <label for="startTime">Start Time</label>
                    <input type="time" name="start_time" id="startTime" required>
                </div>

                <div class="form-group">
                    <label for="endTime">End Time</label>
                    <input type="time" name="end_time" id="endTime" required>
                </div>

                <div class="form-group">
                    <label for="duration">Duration (minutes)</label>
                    <input type="number" name="duration" id="duration" required>
                </div>

                <div class="form-group">
                    <label for="totalQuestion">Total Questions</label>
                    <input type="number" name="total_questions" id="totalQuestion" required>
                </div>

                <div class="form-group">
                    <label for="year">Year</label>
                    <select name="year" id="year" required>
    <option value="">--Select Year--</option>
    <option value="1">1st Year</option>
    <option value="2">2nd Year</option>
    <option value="3">3rd Year</option>
    <option value="4">4th Year</option>
</select>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="4"></textarea>
                </div>

            </div>

            <div class="create-btn">
                <button type="submit">Create Test</button>
            </div>
        </form>

    </main>


    <!-- form post -->
    <?php include('../resource/api.php') ?>

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


                if (result.message) {
                    form.reset();
                }
            } catch (error) {
                console.error('Request failed:', error);
            }
        });
    </script>

    <!-- logout  -->
    <?php include('../resource/logout.php') ?>
    <!-- session end  -->
    <?php include('../resource/check_session.php') ?>

</body>

</html>