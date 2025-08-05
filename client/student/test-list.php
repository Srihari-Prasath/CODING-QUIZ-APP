<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="max-w-4xl mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6">Available Tests</h1>
        <div id="testContainer" class="grid gap-4"></div>
        <div id="test-list" class="space-y-4 p-4 bg-white shadow rounded"></div>
    </div>

    <script>
    fetch('../../server/controllers/student/test-list.php')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('testContainer');
            if (!data || data.length === 0) {
                container.innerHTML = "<p>No tests available.</p>";
                return;
            }

            data.forEach(test => {
                const card = document.createElement('div');
                card.className = "relative p-6 bg-white shadow rounded border";

                // Set indicator color based on is_active
                const statusColor = test.is_active === "0" || test.is_active === 0
                    ? 'bg-green-500'
                    : 'bg-red-500';

                card.innerHTML = `
                    <!-- Status indicator -->
                    <span class="absolute top-3 right-3 w-3 h-3 rounded-full ${statusColor}" title="${test.is_active == 1 ? 'Active' : 'Inactive'}"></span>

                    <h2 class="text-xl font-semibold mb-1">${test.title}</h2>
                    <p class="text-gray-700 mb-2">${test.description || "No description available."}</p>
                    <p class="text-sm text-gray-500 mb-1"><strong>Domain:</strong> ${test.domain || "N/A"}</p>
                    <p class="text-sm text-gray-500 mb-1"><strong>Department:</strong> ${test.department || "N/A"} | <strong>Year:</strong> ${test.year || "N/A"}</p>
                    <p class="text-sm text-gray-500 mb-1"><strong>Start:</strong> ${new Date(test.start_time).toLocaleString()}</p>
                    <p class="text-sm text-gray-500 mb-1"><strong>End:</strong> ${new Date(test.end_time).toLocaleString()}</p>
                    <p class="text-sm text-gray-500 mb-3"><strong>Duration:</strong> ${test.duration_minutes} mins | <strong>Marks:</strong> ${test.total_marks}</p>
                    <a href="quiz-attend.php?test_id=${test.test_id}" class="inline-block mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Start Test</a>
                `;

                container.appendChild(card);
            });
        })
        .catch(error => {
            console.error('Error fetching test data:', error);
        });
</script>

</body>
</html>
