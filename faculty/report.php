<?php
// Ensure database connection
require_once '../resource/conn.php';

// Check if connection is successful
if (!$conn) {
    die('<div class="error">Database Connection Failed: ' . htmlspecialchars(mysqli_connect_error()) . '</div>');
}

// Sanitize and initialize POST variables
$department = isset($_POST['department']) ? mysqli_real_escape_string($conn, $_POST['department']) : '';
$time_filter = isset($_POST['time_filter']) ? mysqli_real_escape_string($conn, $_POST['time_filter']) : '';
$year = isset($_POST['year']) ? mysqli_real_escape_string($conn, $_POST['year']) : '';

// Build WHERE clause
$where = [];
$where[] = "d.full_name LIKE '%Computer Science%'";
if ($year !== '') {
    $where[] = "u.year = '$year'";
}
if ($time_filter !== '') {
    $today = date('Y-m-d');
    if ($time_filter === 'day') {
        $where[] = "DATE(st.end_time) = '$today'";
    } elseif ($time_filter === 'week') {
        $week_start = date('Y-m-d', strtotime('monday this week'));
        $week_end = date('Y-m-d', strtotime('sunday this week'));
        $where[] = "st.end_time BETWEEN '$week_start' AND '$week_end'";
    } elseif ($time_filter === 'month') {
        $month = date('m');
        $year_now = date('Y');
        $where[] = "MONTH(st.end_time) = '$month' AND YEAR(st.end_time) = '$year_now'";
    }
}
$where_sql = !empty($where) ? 'WHERE ' . implode(' AND ', $where) : '';

// Fetch report data
$sql = "SELECT u.id AS student_id, u.name AS student_name, d.full_name AS department, u.year, st.end_time AS test_date, st.score 
        FROM student_tests st 
        JOIN users u ON st.student_id = u.id 
        LEFT JOIN departments d ON u.department_id = d.id 
        $where_sql 
        ORDER BY st.end_time DESC";

$result = mysqli_query($conn, $sql);
$rows = [];
if ($result === false) {
    echo '<div class="error">SQL Error: ' . htmlspecialchars(mysqli_error($conn)) . '</div>';
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    mysqli_free_result($result);
}

// Close connection
mysqli_close($conn);
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
        <label for="year">Year:</label>
        <select name="year" id="year">
            <option value="">All</option>
            <option value="1" <?= $year === '1' ? 'selected' : '' ?>>1st Year</option>
            <option value="2" <?= $year === '2' ? 'selected' : '' ?>>2nd Year</option>
            <option value="3" <?= $year === '3' ? 'selected' : '' ?>>3rd Year</option>
            <option value="4" <?= $year === '4' ? 'selected' : '' ?>>4th Year</option>
        </select>
        <label for="time_filter">Time:</label>
        <select name="time_filter" id="time_filter">
            <option value="">All</option>
            <option value="day" <?= $time_filter === 'day' ? 'selected' : '' ?>>Day</option>
            <option value="week" <?= $time_filter === 'week' ? 'selected' : '' ?>>Week</option>
            <option value="month" <?= $time_filter === 'month' ? 'selected' : '' ?>>Month</option>
        </select>
        <button type="submit">Filter</button>
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
            .map(cell => cell.innerText.trim());
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