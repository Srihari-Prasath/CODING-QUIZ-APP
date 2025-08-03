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
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="create-test.php" class="active">Create Test</a>
            <a href="upload-questions.php">Upload Questions</a>
            <a href="leaderboard.php">Leaderboard</a>
            <a href="reports.php">Reports</a>
        </nav>

        <h2>Create New Test</h2>
        <form id="create-test-form" action="save_test.php" method="POST">
            <div class="form-grid">
                <div class="form-group">
                    <label>Test Title</label>
                    <input type="text" name="title" required>
                </div>
                <div class="form-group">
                    <label>Subject</label>
                    <input type="text" name="subject" required>
                </div>
                <div class="form-group">
                    <label>Instructor</label>
                    <input type="text" name="instructor" required>
                </div>
                <div class="form-group">
                    <label>Duration (minutes)</label>
                    <input type="number" name="duration" required>
                </div>
                <div class="form-group">
                    <label>Total Questions</label>
                    <input type="number" name="totalQuestions" required>
                </div>
                <div class="form-group">
                    <label>Max Students</label>
                    <input type="number" name="maxStudents" required>
                </div>
                <div class="form-group">
                    <label>Start Time</label>
                    <input type="time" name="startTime" required>
                </div>
                <div class="form-group">
                    <label>End Time</label>
                    <input type="time" name="endTime" required>
                </div>
            </div>
            <button type="submit">Create Test</button>
        </form>
    </main>

    <script>
        lucide.createIcons();

        document.getElementById('create-test-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            
            try {
                const response = await fetch('http://localhost/code_app/test_create.php', {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();
                alert(result.message);
                
                if (result.status === 'success') {
                    // Optionally reset form or redirect
                    e.target.reset();
                    // window.location.href = 'dashboard.php';
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred while creating the test');
            }
        });
    </script>
</body>
</html>