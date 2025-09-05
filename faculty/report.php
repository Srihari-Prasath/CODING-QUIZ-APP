<?php
require_once '../resource/conn.php'; 


$department = $_POST['department'] ?? '';
$time_filter = $_POST['time_filter'] ?? '';
$year = $_POST['year'] ?? '';


$where = [];

$where[] = "d.full_name LIKE '%Computer Science%'";
if ($year) {
    $where[] = "u.year = '" . mysqli_real_escape_string($conn, $year) . "'";
}
if ($time_filter) {
    $today = date('Y-m-d');
    if ($time_filter == 'day') {
        $where[] = "DATE(st.end_time) = '$today'";
    } elseif ($time_filter == 'week') {
        $week_start = date('Y-m-d', strtotime('monday this week'));
        $week_end = date('Y-m-d', strtotime('sunday this week'));
        $where[] = "st.end_time BETWEEN '$week_start' AND '$week_end'";
    } elseif ($time_filter == 'month') {
        $month = date('m');
        $year_now = date('Y');
        $where[] = "MONTH(st.end_time) = '$month' AND YEAR(st.end_time) = '$year_now'";
    }
}
$where_sql = $where ? ('WHERE ' . implode(' AND ', $where)) : '';

// Fetch report data with JOINs
$sql = "SELECT u.id AS student_id, u.name AS student_name, d.full_name AS department, u.year, st.end_time AS test_date, st.score FROM student_tests st JOIN users u ON st.student_id = u.id LEFT JOIN departments d ON u.department_id = d.id $where_sql ORDER BY st.end_time DESC";
// Run query and handle errors
$result = mysqli_query($conn, $sql);
$rows = [];
if ($result === false) {
    echo '<div class="error">SQL Error: ' . htmlspecialchars(mysqli_error($conn)) . '</div>';
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Reports</title>
    <style>
        :root {
            --color-primary: #F97316;
            --color-primary-hover: #EA580C;
            --color-secondary: #FF8C00;
            --color-accent: #FFA500;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #FFFFFF;
            padding: 2rem;
            line-height: 1.6;
        }

        h2 {
            color: var(--color-primary);
            margin-bottom: 1.5rem;
            text-align: center;
            font-size: 2rem;
        }

        .error {
            background-color: #ffe6e6;
            color: #d32f2f;
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
            text-align: center;
        }

        .filter-nav {
            display: flex;
            gap: 1rem;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            background-color: #f8f8f8;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            flex-wrap: wrap;
        }

        label {
            font-weight: 600;
            color: #333;
            margin-right: 0.5rem;
        }

        select, button {
            padding: 0.6rem 1.2rem;
            border-radius: 5px;
            font-size: 1rem;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }

        select {
            background-color: white;
            cursor: pointer;
            min-width: 120px;
        }

        select:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 5px rgba(249, 115, 22, 0.3);
        }

        button, .btn-details {
            background-color: var(--color-primary);
            color: white;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        button:hover, .btn-details:hover {
            background-color: var(--color-primary-hover);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
            margin-top: 1rem;
        }

        th, td {
            padding: 1rem;
            text-align: left;
        }

        th {
            background-color: var(--color-secondary);
            color: white;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #f8f8f8;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        td {
            border-bottom: 1px solid #eee;
        }

        .btn-details {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            border-radius: 5px;
        }

        @media (max-width: 600px) {
            .filter-nav {
                flex-direction: column;
                align-items: stretch;
                padding: 1.5rem;
            }

            select, button {
                width: 100%;
                margin-bottom: 0.5rem;
            }

            label {
                margin-bottom: 0.3rem;
            }
        }
    </style>
</head>
<body>
    <h2>Student Reports</h2>
    <form method="post" class="filter-nav">
        <label for="year">Year:</label>
        <select name="year" id="year">
            <option value="">All</option>
            <option value="1" <?= $year=='1'?'selected':'' ?>>1st Year</option>
            <option value="2" <?= $year=='2'?'selected':'' ?>>2nd Year</option>
            <option value="3" <?= $year=='3'?'selected':'' ?>>3rd Year</option>
            <option value="4" <?= $year=='4'?'selected':'' ?>>4th Year</option>
        </select>
        <label for="time_filter">Time:</label>
        <select name="time_filter" id="time_filter">
            <option value="">All</option>
            <option value="day" <?= $time_filter=='day'?'selected':'' ?>>Day</option>
            <option value="week" <?= $time_filter=='week'?'selected':'' ?>>Week</option>
            <option value="month" <?= $time_filter=='month'?'selected':'' ?>>Month</option>
        </select>
        <button type="submit">Filter</button>
    </form>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Department</th>
            <th>Year</th>
            <th>Date</th>
            <th>Score</th>
            <th>Action</th>
        </tr>
        <?php foreach ($rows as $r): ?>
        <tr>
            <td><?= htmlspecialchars($r['student_id']) ?></td>
            <td><?= htmlspecialchars($r['student_name']) ?></td>
            <td><?= htmlspecialchars($r['department']) ?></td>
            <td><?= htmlspecialchars($r['year']) ?></td>
            <td><?= htmlspecialchars($r['test_date']) ?></td>
            <td><?= htmlspecialchars($r['score']) ?></td>
            <td>
                <a href="student_report.php?student_id=<?= urlencode($r['student_id']) ?>" class="btn-details">View Details</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>