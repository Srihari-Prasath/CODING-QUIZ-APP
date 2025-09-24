<?php
session_start();
// Include necessary files
require_once '../resource/conn.php';
require_once '../resource/session.php';

// Check if connection is successful
if (!$conn) {
    die('<div class="error">Database Connection Failed: ' . htmlspecialchars(mysqli_connect_error()) . '</div>');
}

// Get filter values
$department = isset($_POST['department']) ? trim($_POST['department']) : '';
$time_filter = isset($_POST['time_filter']) ? trim($_POST['time_filter']) : '';
$year = isset($_POST['year']) ? trim($_POST['year']) : '';

// Fetch all departments for dropdown
$dept_query = "SELECT id, full_name FROM departments ORDER BY full_name ASC";
$dept_result = mysqli_query($conn, $dept_query);
$departments = [];
if ($dept_result) {
    while ($dept_row = mysqli_fetch_assoc($dept_result)) {
        $departments[] = $dept_row;
    }
    mysqli_free_result($dept_result);
}

// Build prepared statement for filtering
$params = [];
$types = '';
$where_conditions = [];

// Base query
$base_query = "SELECT u.id AS student_id, u.name AS student_name, d.full_name AS department, u.year, 
               st.end_time AS test_date, st.score,
               t.title AS test_title, st.status AS test_status
               FROM student_tests st 
               JOIN users u ON st.student_id = u.id 
               LEFT JOIN departments d ON u.department_id = d.id 
               LEFT JOIN tests t ON st.test_id = t.test_id
               WHERE 1=1";

// Add department filter
if (!empty($department)) {
    $where_conditions[] = "d.id = ?";
    $params[] = $department;
    $types .= 'i';
}

// Add year filter
if (!empty($year)) {
    $where_conditions[] = "u.year = ?";
    $params[] = $year;
    $types .= 's';
}

// Add time filter
if (!empty($time_filter)) {
    $today = date('Y-m-d');
    switch ($time_filter) {
        case 'day':
            $where_conditions[] = "DATE(st.end_time) = ?";
            $params[] = $today;
            $types .= 's';
            break;
        case 'week':
            $week_start = date('Y-m-d', strtotime('monday this week'));
            $week_end = date('Y-m-d', strtotime('sunday this week'));
            $where_conditions[] = "DATE(st.end_time) BETWEEN ? AND ?";
            $params[] = $week_start;
            $params[] = $week_end;
            $types .= 'ss';
            break;
        case 'month':
            $month_start = date('Y-m-01');
            $month_end = date('Y-m-t');
            $where_conditions[] = "DATE(st.end_time) BETWEEN ? AND ?";
            $params[] = $month_start;
            $params[] = $month_end;
            $types .= 'ss';
            break;
    }
}

// Construct final query
if (!empty($where_conditions)) {
    $base_query .= ' AND ' . implode(' AND ', $where_conditions);
}
$base_query .= ' ORDER BY st.end_time DESC';

// Execute prepared statement
$rows = [];
$stmt = mysqli_prepare($conn, $base_query);
if ($stmt) {
    if (!empty($params)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }
    
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            // Calculate percentage if total questions exist
            if ($row['total_questions'] > 0) {
                $row['percentage'] = round(($row['correct_answers'] / $row['total_questions']) * 100, 1);
            } else {
                $row['percentage'] = 0;
            }
            $rows[] = $row;
        }
        mysqli_free_result($result);
    } else {
        echo '<div class="error">Error executing query: ' . htmlspecialchars(mysqli_error($conn)) . '</div>';
    }
    mysqli_stmt_close($stmt);
} else {
    echo '<div class="error">Error preparing statement: ' . htmlspecialchars(mysqli_error($conn)) . '</div>';
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
            --color-text: #333333;
            --color-border: #e0e0e0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            padding: 2rem;
            line-height: 1.6;
        }

        h2 {
            color: var(--color-primary);
            margin-bottom: 1.5rem;
            text-align: center;
            font-size: 2.2rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .error {
            background-color: #ffe6e6;
            color: #d32f2f;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            text-align: center;
            border: 1px solid #d32f2f;
        }

        .filter-nav {
            display: flex;
            gap: 1rem;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            background-color: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            flex-wrap: wrap;
            border: 1px solid var(--color-border);
        }

        label {
            font-weight: 600;
            color: var(--color-text);
            margin-right: 0.5rem;
        }

        select, button {
            padding: 0.7rem 1.5rem;
            border-radius: 8px;
            font-size: 1rem;
            border: 1px solid var(--color-border);
            transition: all 0.3s ease;
        }

        select {
            background-color: white;
            cursor: pointer;
            min-width: 150px;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23333' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.7rem center;
        }

        select:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 8px rgba(249, 115, 22, 0.3);
        }

        button, .btn-details {
            background-color: var(--color-primary);
            color: white;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            font-weight: 500;
        }

        button:hover, .btn-details:hover {
            background-color: var(--color-primary-hover);
            transform: translateY(-1px);
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background-color: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
            margin-top: 1rem;
        }

        th, td {
            padding: 1.2rem;
            text-align: left;
            border-bottom: 1px solid var(--color-border);
        }

        th {
            background-color: var(--color-secondary);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        tr:nth-child(even) {
            background-color: #fafafa;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn-details {
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        #downloadPdfBtn {
            display: block;
            margin: 0 auto 1.5rem;
            padding: 0.8rem 2rem;
            font-size: 1.1rem;
            border-radius: 8px;
        }

        #report-content {
            background-color: white;
            padding: 1rem;
            border-radius: 10px;
        }

        @media (max-width: 600px) {
            .filter-nav {
                flex-direction: column;
                align-items: stretch;
                padding: 1.5rem;
            }

            select, button {
                width: 100%;
                margin-bottom: 0.8rem;
            }

            label {
                margin-bottom: 0.5rem;
            }

            th, td {
                padding: 0.8rem;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <h2>Student Reports</h2>
    <button id="downloadPdfBtn" class="btn-details">Download PDF</button>
    <form method="post" class="filter-nav">
        <label for="department">Department:</label>
        <select name="department" id="department">
            <option value="">All Departments</option>
            <?php foreach ($departments as $dept): ?>
                <option value="<?= $dept['id'] ?>" <?= $department == $dept['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($dept['full_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <label for="year">Year:</label>
        <select name="year" id="year">
            <option value="">All Years</option>
            <option value="1" <?= $year === '1' ? 'selected' : '' ?>>1st Year</option>
            <option value="2" <?= $year === '2' ? 'selected' : '' ?>>2nd Year</option>
            <option value="3" <?= $year === '3' ? 'selected' : '' ?>>3rd Year</option>
            <option value="4" <?= $year === '4' ? 'selected' : '' ?>>4th Year</option>
        </select>
        
        <label for="time_filter">Time Period:</label>
        <select name="time_filter" id="time_filter">
            <option value="">All Time</option>
            <option value="day" <?= $time_filter === 'day' ? 'selected' : '' ?>>Today</option>
            <option value="week" <?= $time_filter === 'week' ? 'selected' : '' ?>>This Week</option>
            <option value="month" <?= $time_filter === 'month' ? 'selected' : '' ?>>This Month</option>
        </select>
        
        <button type="submit">Apply Filters</button>
        <button type="button" onclick="window.location.href='report.php'" style="background-color: #6b7280;">Reset</button>
    </form>
    <div id="report-content">
        <?php if (empty($rows)): ?>
            <div class="error">No records found for the selected filters.</div>
        <?php else: ?>
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
        <?php endif; ?>
    </div>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.0/jspdf.plugin.autotable.min.js"></script>
<script>
document.getElementById('downloadPdfBtn').addEventListener('click', async function() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF({ orientation: 'landscape' });    

    // Report metadata
    const departmentName = 'Computer Science';
    const selectedYear = '<?= $year ? $year : "All" ?>';
    const reportDate = new Date().toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });

    // Load logos
    async function loadImage(url) {
        return new Promise((resolve) => {
            const img = new Image();
            img.crossOrigin = 'Anonymous';
            img.onload = function() {
                const canvas = document.createElement('canvas');
                canvas.width = img.width;
                canvas.height = img.height;
                const ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0);
                resolve(canvas.toDataURL('image/png'));
            };
            img.onerror = () => resolve(null);
            img.src = url;
        });
    }

    const collegeLogo = await loadImage('assets/img/logo/logo.png');
    const iqarenaLogo = await loadImage('assets/img/logo/iqarena.png');

    const pageWidth = doc.internal.pageSize.getWidth();

    // Header
    if (collegeLogo) doc.addImage(collegeLogo, 'PNG', 14, 8, 30, 18);
    if (iqarenaLogo) doc.addImage(iqarenaLogo, 'PNG', pageWidth - 44, 8, 30, 18);

    doc.setFont('helvetica', 'bold');
    doc.setFontSize(20);
    doc.setTextColor(249, 115, 22);
    doc.text('NSCET IQArena Report', pageWidth / 2, 20, { align: 'center' });

    doc.setFontSize(12);
    doc.setTextColor(51, 51, 51);
    doc.setFont('helvetica', 'normal');
    const subHeader = `Department: ${departmentName} | Year: ${selectedYear} | Generated: ${reportDate}`;
    doc.text(subHeader, pageWidth / 2, 30, { align: 'center' });

    doc.setDrawColor(200, 200, 200);
    doc.line(14, 35, pageWidth - 14, 35);

    // Extract table data from HTML
    const table = document.querySelector('#report-content table');
    if (!table) {
        alert('No data available to generate PDF.');
        return;
    }

    const rows = [];
    const headers = [];
    table.querySelectorAll('tr').forEach((tr, i) => {
        const cells = Array.from(tr.querySelectorAll(i === 0 ? 'th' : 'td'))
            .map(cell => cell.innerText.trim())
            .slice(0, -1); 
        if (i === 0) {
            headers.push(cells);
        } else {
            rows.push(cells);
        }
    });

    // Build table with theme
    doc.autoTable({
        startY: 40,
        head: headers,
        body: rows,
        styles: { fontSize: 10, cellPadding: 3 },
        headStyles: {
            fillColor: [255, 140, 0], // orange header
            textColor: 255,
            halign: 'center'
        },
        bodyStyles: { textColor: [51, 51, 51] },
        alternateRowStyles: { fillColor: [245, 245, 245] },
        theme: 'striped'
    });

    // Footer
    doc.setFontSize(10);
    doc.setTextColor(100, 100, 100);
    doc.text('Generated by NSCET IQArena System', 14, doc.internal.pageSize.getHeight() - 10);

    // Save
    doc.save(`NSCET_IQArena_Report_${reportDate.replace(/, /g, '_')}.pdf`);
});
</script>

</body>
</html>