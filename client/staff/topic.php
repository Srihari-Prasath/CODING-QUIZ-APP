<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Topic</title>

    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-gray-100 min-h-screen font-sans">

    <?php include('./header.php') ?>

    <main class="container mx-auto p-6 flex flex-col gap-8">
        <section id="nav-section">
            <?php include('./nav.php') ?>
        </section>

<section id="form-section" class="bg-white p-10 rounded-3xl shadow-xl max-w-3xl mx-auto">
    
    <!-- Section Header -->
    <div class="mb-6 text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Create New Topic</h2>
        <p class="text-gray-500">Add a topic with a descriptive summary for students.</p>
    </div>

    <form id="create-topic-form" class="flex flex-col gap-8">

        <!-- Topic Name -->
        <div class="flex flex-col">
            <label for="topicName" class="mb-2 font-semibold text-gray-700">Topic Name</label>
            <input type="text" id="topicName" name="topicName" placeholder="Enter topic name" required
                class="p-4 border border-gray-300 rounded-2xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 outline-none transition duration-200 w-full text-gray-800 font-medium" />
        </div>

        <!-- Description -->
        <div class="flex flex-col">
            <label for="topicDescription" class="mb-2 font-semibold text-gray-700">Description</label>
            <textarea id="topicDescription" name="description" rows="5" placeholder="Enter topic description"
                class="p-4 border border-gray-300 rounded-2xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 outline-none transition duration-200 w-full text-gray-800 font-medium"></textarea>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-center">
            <button type="submit"
                class="px-10 py-4 bg-gradient-to-r from-orange-500 to-orange-400 hover:from-orange-600 hover:to-orange-500 text-white rounded-3xl shadow-xl font-semibold text-lg transition duration-200">
                Create Topic
            </button>
        </div>

    </form>
</section>


    </main>
    <?php include('../resource/api.php') ?>
   

     <?php include('./sessionHandle.php') ?>


     <!-- insert topics -->
     <script>
      
     document.getElementById('create-topic-form').addEventListener('submit', async function(e) {
         e.preventDefault();
         const topicName = document.getElementById('topicName').value.trim();
         const topicDescription = document.getElementById('topicDescription').value.trim();
         let added_by = localStorage.getItem("roll_id"); 
         console.log(added_by)
         const payload = {
             title: topicName,
             description: topicDescription,
             added_by: added_by
         };
         try {
             const res = await fetch('<?php echo $api; ?>faculty/topics/topicRoutes.php', {
                 method: 'POST',
                 headers: { 'Content-Type': 'application/json' },
                 body: JSON.stringify(payload)
             });
             const result = await res.json();
             if (result.success) {
                 alert('Topic created successfully!');
                 document.getElementById('create-topic-form').reset();
             } else {
                 alert('Error: ' + (result.error || 'Failed to create topic'));
             }
         } catch (err) {
             alert('Network error: ' + err.message);
         }
     });
     </script>

</body>
</html>
