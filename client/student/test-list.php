<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test List</title>
    <script src="https://cdn.tailwindcss.com"></script>
   <link rel="stylesheet" href="../assets/css/student/testlist.css">
   <link rel="stylesheet" href="../assets/css/main.css">


</head>
<body>
    <div class="max-w-7xl mx-auto mt-10 px-4">
        <h1 class="text-3xl font-bold mb-6">Available Tests</h1>
        <div id="testContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"></div>
        <div id="test-list" class="space-y-4 p-4 custom-card rounded"></div>
    </div>

    <script>
    fetch('../../server/controllers/student/test-list.php')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('testContainer');
            if (!data || data.length === 0) {
                container.innerHTML = "<p class='text-gray-500'>No tests available.</p>";
                return;
            }

            data.forEach(test => {
                const card = document.createElement('div');
                card.className = "relative p-6 custom-card rounded";

                // Set indicator color based on is_active
                const statusColor = test.is_active === "0" || test.is_active === 0
                    ? 'status-inactive'
                    : 'status-active';

                card.innerHTML = `
    <span class="absolute top-3 right-3 w-3 h-3 rounded-full ${statusColor}" title="${test.is_active == 1 ? 'Active' : 'Inactive'}"></span>
    <h2 class="text-xl font-semibold mb-1">${test.title}</h2>
    <p class="text-gray-700 mb-2">${test.description || "No description available."}</p>
    <p class="text-sm text-gray-500 mb-1"><strong>Domain:</strong> ${test.domain || "N/A"}</p>
    <p class="text-sm text-gray-500 mb-1"><strong>Department:</strong> ${test.department || "N/A"} | <strong>Year:</strong> ${test.year || "N/A"}</p>
    <p class="text-sm text-gray-500 mb-1"><strong>Start:</strong> ${new Date(test.start_time).toLocaleString()}</p>
    <p class="text-sm text-gray-500 mb-1"><strong>End:</strong> ${new Date(test.end_time).toLocaleString()}</p>
    <p class="text-sm text-gray-500 mb-3"><strong>Duration:</strong> ${test.duration_minutes} mins | <strong>Marks:</strong> ${test.total_marks}</p>
    <button onclick="enrollAndStart(${test.test_id})" class="inline-block mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Start Test</button>
`;

                container.appendChild(card);
            });
        })
        .catch(error => {
            console.error('Error fetching test data:', error);
        });
    </script>

<script>
    function enrollAndStart(test_id) {
    fetch('../../server/controllers/student/enroll.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `test_id=${test_id}`
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            window.location.href = `quiz-attend.php?test_id=${test_id}`;
        } else {
            alert(data.error || 'Something went wrong.');
        }
    })
    .catch(err => {
        console.error(err);
        alert('Error enrolling in test.');
    });
}
</script>
</body>
</html>