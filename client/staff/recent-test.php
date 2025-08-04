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
        <?php include('./nav.php') ?>

        <h2>Recent Tests</h2>
<div id="recent-tests-container" class="recent-tests">
    <ul id="recent-tests-list">

    

    </ul>
</div>

    </main>


    <!-- form post -->
    <?php include('../resource/api.php') ?>

    <script>
     window.addEventListener('DOMContentLoaded', async () => {
    try {
        const response = await fetch('<?php echo $api; ?>faculty/test/testRoutes.php');
        const result = await response.json();

        if (result.success) {
            const testList = document.getElementById('recent-tests-list');
            result.data.forEach(test => {
                const li = document.createElement('li');
                li.innerHTML = `
                    <strong>${test.title}</strong><br>
                    <em>${test.description}</em><br>
                    <small>${test.domain} | ${test.department} | Year: ${test.year}</small><br>
                    <span>
                        Created By: ${test.created_by} <br>
                        Start: ${test.start_time} | End: ${test.end_time}<br>
                        Duration: ${test.duration_minutes} mins<br>
                        Total Qs: ${test.total_questions} | Marks: ${test.total_marks}<br>
                        Active: ${test.is_active == 1 ? 'Yes' : 'No'}
                    </span>
                    <hr>
                `;
                testList.appendChild(li);
            });
        } else {
            console.error('Failed to load tests:', result.message);
        }
    } catch (err) {
        console.error('Error fetching recent tests:', err);
    }
});

    </script>



</body>

</html>