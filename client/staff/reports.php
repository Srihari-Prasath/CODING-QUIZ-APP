<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="../assets/css/staff/reports.css">
</head>
<body>
    <?php include('./header.php') ?>

    <main class="container">
        <?php include('./nav.php') ?>
        <h2><i data-lucide="bar-chart-2"></i> Reports</h2>
        <div class="reports">
            <div class="report-controls">
                <select id="report-type">
                    <option value="quiz">Quiz Performance</option>
                    <option value="student">Student Progress</option>
                    <option value="class">Class Overview</option>
                </select>
                <button id="generate-report" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 flex items-center"><i data-lucide="play" class="mr-2"></i> Generate Report</button>
            </div>
            <div id="report-content" class="mt-6"></div>
        </div>
    </main>

    <script>
        lucide.createIcons();

        document.getElementById('generate-report').addEventListener('click', () => {
            const reportType = document.getElementById('report-type').value;
            const reportContent = document.getElementById('report-content');
            let tableHTML = '';

            if (reportType === 'quiz') {
                tableHTML = `
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Quiz Name</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Average Score</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Participants</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-t">
                                    <td class="px-6 py-4 text-sm text-gray-600">Python Basics</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">85%</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">30</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">2025-07-15</td>
                                </tr>
                                <tr class="border-t">
                                    <td class="px-6 py-4 text-sm text-gray-600">Web Development</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">78%</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">28</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">2025-07-20</td>
                                </tr>
                                <tr class="border-t">
                                    <td class="px-6 py-4 text-sm text-gray-600">Data Structures</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">92%</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">25</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">2025-07-25</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                `;
            } else if (reportType === 'student') {
                tableHTML = `
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Student Name</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Total Quizzes</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Average Score</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Last Active</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-t">
                                    <td class="px-6 py-4 text-sm text-gray-600">John Doe</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">10</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">88%</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">2025-08-01</td>
                                </tr>
                                <tr class="border-t">
                                    <td class="px-6 py-4 text-sm text-gray-600">Jane Smith</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">8</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">92%</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">2025-08-02</td>
                                </tr>
                                <tr class="border-t">
                                    <td class="px-6 py-4 text-sm text-gray-600">Mike Johnson</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">9</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">85%</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">2025-08-03</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                `;
            } else if (reportType === 'class') {
                tableHTML = `
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Class Name</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Total Students</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Average Score</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Last Quiz Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-t">
                                    <td class="px-6 py-4 text-sm text-gray-600">IT 2nd Year</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">30</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">87%</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">2025-07-25</td>
                                </tr>
                                <tr class="border-t">
                                    <td class="px-6 py-4 text-sm text-gray-600">CS 3rd Year</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">25</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">90%</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">2025-07-20</td>
                                </tr>
                                <tr class="border-t">
                                    <td class="px-6 py-4 text-sm text-gray-600">ECE 2nd Year</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">28</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">83%</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">2025-07-15</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                `;
            }

            reportContent.innerHTML = tableHTML;
        });
    </script>
</body>
</html>