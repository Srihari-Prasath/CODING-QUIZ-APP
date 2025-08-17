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
    </div>

<script>
async function fetchTests() {
    try {
        const res = await fetch('../../server/controllers/student/test-list.php', {
            method: 'GET',
            credentials: 'include' // include session for student info
        });

        const data = await res.json();
        const container = document.getElementById('testContainer');
        container.innerHTML = ""; // clear previous content

        if (!data || data.length === 0) {
            container.innerHTML = "<p class='text-gray-500'>No available tests at the moment.</p>";
            return;
        }

        data.forEach(test => {
            const card = document.createElement('div');
            card.className = "relative p-6 custom-card rounded shadow hover:shadow-lg transition";

            // Status indicator
            const statusColor = test.is_active == 1 ? 'status-active' : 'status-inactive';

            // Convert start & end times to readable slot
            function getSlotLabel(start, end) {
                const startH = new Date(start).getHours();
                const endH = new Date(end).getHours();
                if (startH === 9 && endH === 21) return 'Full Day';
                if (startH === 9 && endH === 12) return 'Morning';
                if (startH === 12 && endH === 14) return 'Afternoon';
                if (startH === 14 && endH === 17) return 'Evening';
                return `${new Date(start).toLocaleTimeString()} - ${new Date(end).toLocaleTimeString()}`;
            }

            const slotLabel = getSlotLabel(test.start_time, test.end_time);

            card.innerHTML = `
                <span class="absolute top-3 right-3 w-3 h-3 rounded-full ${statusColor}" title="${test.is_active == 1 ? 'Active' : 'Inactive'}"></span>
                <h2 class="text-xl font-semibold mb-1">${test.title}</h2>
                <p class="text-gray-700 mb-2">${test.description || "No description available."}</p>
                <p class="text-sm text-gray-500 mb-1"><strong>Domain:</strong> ${test.domain || "N/A"}</p>
                <p class="text-sm text-gray-500 mb-1"><strong>Department:</strong> ${test.department || "N/A"} | <strong>Year:</strong> ${test.year || "N/A"}</p>
                <p class="text-sm text-gray-500 mb-1"><strong>Time Slot:</strong> ${slotLabel}</p>
                <p class="text-sm text-gray-500 mb-3"><strong>Duration:</strong> ${test.duration_minutes} mins | <strong>Marks:</strong> ${test.total_marks}</p>
                <button onclick="window.location.href='quiz-attend.php?test_id=${test.test_id}'" class="inline-block mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Start Test
                </button>
            `;

            container.appendChild(card);
        });

    } catch (error) {
        console.error("Error fetching tests:", error);
        document.getElementById('testContainer').innerHTML = "<p class='text-red-500'>Failed to fetch tests.</p>";
    }
}

// Fetch tests on page load
window.addEventListener('DOMContentLoaded', fetchTests);
</script>
</body>
</html>
