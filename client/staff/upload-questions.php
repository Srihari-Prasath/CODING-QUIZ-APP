
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
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="create-test.php">Create Test</a>
            <a href="upload-questions.php" class="active">Upload Questions</a>
            <a href="leaderboard.php">Leaderboard</a>
            <a href="reports.php">Reports</a>
        </nav>

        <h2>Upload Questions</h2>
        <form id="upload-questions-form">
            <div class="form-group">
                <label>Select Quiz</label>
                <select name="quizId">
                    <option value="1">Data Structures & Algorithms</option>
                    <option value="2">React Fundamentals</option>
                    <option value="3">Database Management</option>
                </select>
            </div>
            <div class="form-group">
                <label>Upload Questions File (CSV/JSON)</label>
                <input type="file" name="questionsFile" accept=".csv,.json">
            </div>
            <button type="submit">Upload Questions</button>
        </form>
    </main>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Form submission
        document.getElementById('upload-questions-form').addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            // Mock backend call
            console.log(formData.get('quizId'), formData.get('questionsFile'));
            alert('Questions uploaded successfully!');
            // Replace with fetch to backend
            // fetch('/api/upload-questions', { method: 'POST', body: formData })
        });
    </script>
</body>
</html>
