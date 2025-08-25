<?php
include("../resource/session.php");

include("../resource/conn.php");





// fetch topics
$topicStmt = $conn->prepare("
    SELECT topic_id, title 
    FROM sub_topics 
    WHERE by_admin = 1 OR added_by = ?
    ORDER BY created_at DESC
");
$topicStmt->bind_param("i", $_SESSION['id']);
$topicStmt->execute();
$topicResult = $topicStmt->get_result();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Questions</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800">
    <?php include('./header.php') ?>

    <main class="container mx-auto px-4 py-6">
        <?php include('./nav.php') ?>
        <section id="page-title" class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Upload Questions</h2>
            <p class="text-gray-600 mt-1">Select a quiz and upload your questions in CSV/XLSX format.</p>
        </section>

<section id="upload-form-section" class="bg-white rounded-3xl shadow-xl p-8 max-w-xl mx-auto">
    <form id="upload-questions-form" enctype="multipart/form-data" class="flex flex-col gap-6">

        <div class="flex flex-col relative">
           <label for="parentTopic" class="mb-2 font-semibold text-gray-700">Select Topic</label>
                        <select id="parentTopic" name="parentTopic" required
                            class="p-4 border border-gray-300 rounded-2xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 outline-none transition duration-200 w-full text-gray-800 font-medium">
                            <option value="">Select a topic</option>
                            <?php while ($row = $topicResult->fetch_assoc()): ?>
                                <option value="<?php echo $row['topic_id']; ?>">
                                    <?php echo htmlspecialchars($row['title']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
            </div>
        </div>
        <div class="flex flex-col">
            <label for="questionsFile" class="mb-2 font-semibold text-gray-700">Upload Questions File (CSV/XLSX)</label>
            <input type="file" name="questionsFile" id="questionsFile" accept=".xlsx, .xlsm, .csv" required
                class="p-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 outline-none w-full transition duration-200 cursor-pointer">
            <a href="/templates/questions-template.xlsx" download
               class="text-orange-500 hover:text-orange-600 mt-2 text-sm">Download template file</a>
        </div>
        <div class="flex justify-center mt-4">
            <button type="submit"
                class="px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-400 hover:from-orange-600 hover:to-orange-500 text-white rounded-2xl shadow-lg font-semibold transition duration-200">
                Upload Questions
            </button>
        </div>

    </form>
</section>

    </main>
   
</body>
</html>
