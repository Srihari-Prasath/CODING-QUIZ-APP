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
        <form id="upload-questions-form" action="http://localhost/code_app/save_questions.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Select Quiz</label>
                <select name="quizId" required>
                    <?php
                    // Database connection
                    $conn = new mysqli("localhost", "root", "", "quiz_system");
                    if (!$conn->connect_error) {
                        $result = $conn->query("SELECT id, title FROM tests");
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['id']}'>{$row['title']}</option>";
                        }
                        $conn->close();
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Upload Questions File (CSV)</label>
                <input type="file" name="questionsFile" accept=".csv" required>
            </div>
            <button type="submit">Upload Questions</button>
        </form>
    </main>

    <script>
        lucide.createIcons();

        document.getElementById('upload-questions-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);

            try {
                const response = await fetch('http://localhost/code_app/save_questions.php', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();
                alert(result.message);
                if (result.status === 'success') {
                    e.target.reset();
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred while uploading questions');
            }
        });
    </script>
</body>
</html>