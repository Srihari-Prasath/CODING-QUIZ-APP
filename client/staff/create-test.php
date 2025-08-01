
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Test</title>
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
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
        .form-group label {
            font-size: 14px;
            color: #333;
            margin-bottom: 5px;
        }
        .form-group input {
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
            margin-top: 20px;
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
            <a href="create-test.php" class="active">Create Test</a>
            <a href="upload-questions.php">Upload Questions</a>
            <a href="leaderboard.php">Leaderboard</a>
            <a href="reports.php">Reports</a>
        </nav>

        <h2>Create New Test</h2>
        <form id="create-test-form">
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

        
        document.getElementById('create-test-form').addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
          
            console.log(Object.fromEntries(formData));
            alert('Test created successfully!');
            
        });
    </script>
</body>
</html>