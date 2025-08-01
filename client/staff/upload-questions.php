
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Questions</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            min-height: 100vh;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        header {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
        }
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header-content h1 {
            font-size: 24px;
            color: #333;
            margin: 0;
        }
        .header-content p {
            color: #666;
            margin: 5px 0 0;
            font-size: 14px;
        }
        .profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
        .profile-info p {
            margin: 0;
            font-size: 14px;
        }
        .profile-info .name {
            font-weight: bold;
            color: #333;
        }
        .profile-info .role {
            color: #666;
        }
        .logout-btn {
            color: #666;
            cursor: pointer;
        }
        .logout-btn:hover {
            color: #333;
        }
        nav {
            margin: 20px 0;
            border-bottom: 2px solid #e0e0e0;
        }
        nav a {
            text-decoration: none;
            color: #666;
            padding: 10px 20px;
            display: inline-block;
            font-size: 16px;
        }
        nav a.active, nav a:hover {
            color: #007bff;
            border-bottom: 2px solid #007bff;
        }
        h2 {
            font-size: 24px;
            color: #333;
            margin: 20px 0;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-size: 14px;
            color: #333;
            margin-bottom: 5px;
            display: block;
        }
        .form-group select, .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
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
            <a href="index.php">Dashboard</a>
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
