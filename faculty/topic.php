<?php
include("../resource/conn.php");
include("../resource/session.php");

include("../backend/faculty/Createtopic.php");


$topicStmt = $conn->prepare("
    SELECT t.topic_id, t.title AS topic_title, t.description AS topic_desc,
           s.sub_topic_id, s.title AS sub_title, s.description AS sub_desc
    FROM topics t
    LEFT JOIN sub_topics s ON s.topic_id = t.topic_id
    WHERE t.by_admin = 1 OR t.added_by = ?
    ORDER BY t.created_at DESC, s.sub_topic_id ASC
");
$topicStmt->bind_param("i", $_SESSION['id']);
$topicStmt->execute();
$result = $topicStmt->get_result();

$topics = [];
while ($row = $result->fetch_assoc()) {
    $tid = $row['topic_id'];
    if (!isset($topics[$tid])) {
        $topics[$tid] = [
            'title' => $row['topic_title'],
            'description' => $row['topic_desc'],
            'subtopics' => []
        ];
    }
    if ($row['sub_topic_id']) {
        $topics[$tid]['subtopics'][] = [
            'id' => $row['sub_topic_id'],
            'title' => $row['sub_title'],
            'description' => $row['sub_desc']
        ];
    }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topics, Subtopics & Upload Questions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/resource/style.css">
</head>

<body>

    <!-- Header -->
    <?php include('./header.php') ?>
    <main class="container mx-auto p-6 flex flex-col gap-6">
        <main class="container mx-auto px-4 py-6">
            <?php include('./nav.php') ?>
            <section id="page-title" class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800 text-center uppercase">Topics</h2>
            </section>
            <!-- Add Buttons -->
            <div class="flex gap-3 justify-end">
                <button id="open-topic-popup" class="px-3 py-2 bg-orange-200 border border-white rounded">Add Topic</button>
                <button id="open-subtopic-popup" class="px-3 py-2 bg-orange-200 border border-white rounded">Add Subtopic</button>
            </div>

            <div class="flex gap-6">
                <!-- Topics List -->
                <div class="w-1/4 bg-white rounded-2xl shadow p-4">
                    <h2 class="font-bold text-xl mb-2">Topics</h2>
                    <ul id="topicList" class="space-y-2">
                        <?php foreach ($topics as $tid => $topic): ?>
                            <li>
                                <button class="topic-btn w-full text-left px-3 py-2 rounded hover:bg-orange-100"
                                    data-topic-id="<?= $tid ?>" data-first-sub="<?= $topic['subtopics'][0]['id'] ?? 0 ?>"
                                    data-topic-desc="<?= htmlspecialchars($topic['description']) ?>">
                                    <?= htmlspecialchars($topic['title']) ?>
                                </button>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div id="topicDescription" class="mt-4 text-gray-600 text-sm"></div>
                </div>

                <!-- Subtopics List -->
                <div class="w-1/4 bg-white rounded-2xl shadow p-4">
                    <h2 class="font-bold text-xl mb-2">Subtopics</h2>
                    <ul id="subtopicList" class="space-y-2"></ul>
                    <div id="subtopicDescription" class="mt-4 text-gray-600 text-sm"></div>
                </div>

                <!-- Upload Questions -->
                <div class="flex-1">
                    <section id="upload-form-section" class="bg-white rounded-3xl shadow-xl p-8 hidden">
                        <form id="upload-questions-form" enctype="multipart/form-data" class="flex flex-col gap-6" action="../backend/faculty/uploadQuestions.php" method="post">
                            <input type="hidden" name="topic_id" id="uploadTopicId">
                            <input type="hidden" name="subtopic_id" id="uploadSubtopicId">
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['id'] ?>">

                            <div class="flex flex-col">
                                <label for="questionsFile" class="mb-2 font-semibold text-gray-700">
                                    Upload Questions File (CSV/XLSX)
                                </label>
                                <input type="file" name="questionsFile" id="questionsFile" accept=".xlsx,.xlsm,.csv" required
                                    class="p-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 outline-none w-full transition duration-200 cursor-pointer">
                                <a href="/templates/questions-template.xlsx" download
                                    class="text-orange-500 hover:text-orange-600 mt-2 text-sm">
                                    Download template file
                                </a>
                            </div>

                            <div class="flex justify-center mt-4">
                                <button type="submit"
                                    class="px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-400 hover:from-orange-600 hover:to-orange-500 text-white rounded-2xl shadow-lg font-semibold transition duration-200">
                                    Upload Questions
                                </button>
                            </div>
                        </form>
                    </section>

                </div>
            </div>
        </main>

        <?php include('../resource/footer.php') ?>

        <!-- Topic Modal -->
        <div id="topic-popup" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
            <div class="bg-white p-10 rounded-3xl shadow-xl max-w-3xl w-full relative">
                <button id="close-topic-popup" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
                <h2 class="text-3xl font-bold text-gray-800 mb-2 text-center">Create New Topic</h2>
                <p class="text-gray-500 mb-6 text-center">Add a topic with description for students.</p>
                <form id="create-topic-form" class="flex flex-col gap-6" action="./topic.php" method="post">
                    <input type="text" name="topicName" placeholder="Topic Name" required
                        class="p-4 border rounded-2xl w-full">
                    <textarea name="description" placeholder="Description" rows="5" required class="p-4 border rounded-2xl w-full"></textarea>
                    <button type="submit" class="px-5 py-3 bg-orange-500 text-white rounded shadow font-semibold">Create Topic</button>
                </form>
            </div>
        </div>

        <!-- Subtopic Modal -->
        <div id="subtopic-popup" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
            <div class="bg-white p-10 rounded-3xl shadow-xl max-w-3xl w-full relative">
                <button id="close-subtopic-popup" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
                <h2 class="text-3xl font-bold text-gray-800 mb-2 text-center">Create Sub Topic</h2>
                <p class="text-gray-500 mb-6 text-center">Select a topic and add a sub topic with description.</p>
                <form id="create-subtopic-form" class="flex flex-col gap-6" action="../backend/faculty/subTopic.php" method="post">
                    <select name="parentTopic" required class="p-4 border rounded-2xl w-full">
                        <option value="">Select Topic</option>
                        <?php foreach ($topics as $tid => $topic): ?>
                            <option value="<?= $tid ?>"><?= htmlspecialchars($topic['title']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="text" name="subTopicName" placeholder="Subtopic Name" required class="p-4 border rounded-2xl w-full">
                    <textarea name="subTopicDescription" placeholder="Description" rows="5" required class="p-4 border rounded-2xl w-full"></textarea>
                    <button type="submit" class="px-5 py-3 bg-orange-500 text-white rounded shadow font-semibold">Create Subtopic</button>
                </form>
            </div>
        </div>
    </main>





    <script>
        const topics = <?= json_encode($topics) ?>;
        const topicList = document.getElementById('topicList');
        const subtopicList = document.getElementById('subtopicList');
        const uploadForm = document.getElementById('upload-form-section');
        const uploadTopicId = document.getElementById('uploadTopicId');
        const uploadSubtopicId = document.getElementById('uploadSubtopicId');
        const topicDescription = document.getElementById('topicDescription');
        const subtopicDescription = document.getElementById('subtopicDescription');

        function renderSubtopics(topicId, defaultSubId) {
            subtopicList.innerHTML = '';
            subtopicDescription.textContent = '';

            if (!topics[topicId] || topics[topicId].subtopics.length === 0) {
                subtopicList.innerHTML = '<li class="text-gray-400">No subtopics</li>';
                uploadForm.classList.add('hidden');
                return;
            }

            topics[topicId].subtopics.forEach(sub => {
                const li = document.createElement('li');
                li.className = "flex items-center justify-between";

                // Subtopic button
                const btn = document.createElement('button');
                btn.textContent = sub.title;
                btn.className = 'subtopic-btn flex-1 text-left px-3 py-2 rounded hover:bg-orange-100';
                btn.dataset.subId = sub.id;

                const link = document.createElement('a');
                link.href = `./Questions.php?subtopic_id=${sub.id}`;
                link.className = "ml-2 text-orange-500 hover:text-orange-700";
                link.title = "View Questions";
                link.innerHTML = "📄";

                // Default select
                if (sub.id === defaultSubId) {
                    btn.classList.add('bg-orange-200');
                    uploadForm.classList.remove('hidden');
                    uploadTopicId.value = topicId;
                    uploadSubtopicId.value = sub.id;
                    subtopicDescription.textContent = sub.description || '';
                }

                btn.onclick = () => {
                    document.querySelectorAll('.subtopic-btn').forEach(b => b.classList.remove('bg-orange-200'));
                    btn.classList.add('bg-orange-200');
                    uploadForm.classList.remove('hidden');
                    uploadTopicId.value = topicId;
                    uploadSubtopicId.value = sub.id;
                    subtopicDescription.textContent = sub.description || '';
                };

                li.appendChild(btn);
                li.appendChild(link);
                subtopicList.appendChild(li);
            });
        }



        document.querySelectorAll('.topic-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const topicId = btn.dataset.topicId;
                const firstSub = parseInt(btn.dataset.firstSub) || 0;
                document.querySelectorAll('.topic-btn').forEach(b => b.classList.remove('bg-orange-200'));
                btn.classList.add('bg-orange-200');
                topicDescription.textContent = btn.dataset.topicDesc || '';
                renderSubtopics(topicId, firstSub);
            });
        });

        const firstTopicBtn = document.querySelector('.topic-btn');
        if (firstTopicBtn) firstTopicBtn.click();


        ['topic', 'subtopic'].forEach(type => {
            const openBtn = document.getElementById(`open-${type}-popup`);
            const closeBtn = document.getElementById(`close-${type}-popup`);
            const popup = document.getElementById(`${type}-popup`);

            openBtn.addEventListener('click', () => popup.classList.remove('hidden'));
            closeBtn.addEventListener('click', () => popup.classList.add('hidden'));
            window.addEventListener('click', (e) => {
                if (e.target === popup) popup.classList.add('hidden');
            });
        });
    </script>

</body>

</html>