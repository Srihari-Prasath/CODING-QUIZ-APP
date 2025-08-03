<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCQ Quiz App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar {
            transition: all 0.3s ease;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                z-index: 50;
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0,0,0,0.5);
                z-index: 40;
            }
            .overlay.active {
                display: block;
            }
        }
        .timer {
            animation: pulse 1s infinite alternate;
        }
        @keyframes pulse {
            from {
                transform: scale(1);
            }
            to {
                transform: scale(1.05);
            }
        }
        .option:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .option.selected {
            background-color: #f97316;
            color: white;
            border-color: #f97316;
        }
        .option.correct {
            background-color: #10b981;
            color: white;
            border-color: #10b981;
        }
        .option.incorrect {
            background-color: #ef4444;
            color: white;
            border-color: #ef4444;
        }
        .question-number.answered {
            background-color: #10b981; /* Green for answered */
            color: white;
        }
        .question-number.not-answered {
            background-color: #ef4444; /* Red for not answered */
            color: white;
        }
        .question-number.skipped {
            background-color: #f59e0b; /* Yellow for skipped */
            color: white;
        }
        .question-number.current {
            border: 2px solid #f97316;
            font-weight: bold;
            box-shadow: 0 0 0 2px white, 0 0 0 4px #f97316;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="sidebar bg-white w-64 border-r border-gray-200 p-4 flex flex-col md:relative">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Quiz Navigation</h2>
                <button id="closeSidebar" class="md:hidden text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="mb-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Time Left:</span>
                    <span id="sidebarTimer" class="font-bold">10:00</span>
                </div>
            </div>
            <div class="flex-1 overflow-y-auto">
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Questions</h3>
                <div class="grid grid-cols-5 gap-2 mb-6" id="questionNumbers">
                    <!-- Question numbers will be added here by JavaScript -->
                </div>
                
                <div class="space-y-2 text-sm">
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-green-500 mr-2"></div>
                        <span>Answered: <span id="answeredCount">0</span></span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-red-500 mr-2"></div>
                        <span>Not Answered: <span id="notAnsweredCount">0</span></span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-yellow-500 mr-2"></div>
                        <span>Skipped: <span id="skippedCount">0</span></span>
                    </div>
                </div>
            </div>
            <div class="mt-auto pt-4 border-t border-gray-200">
                <button id="submitQuiz" class="w-full bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md transition duration-300">
                    Submit Quiz
                </button>
            </div>
        </div>

        <!-- Mobile sidebar toggle -->
        <div class="md:hidden fixed bottom-6 right-6 z-30">
            <button id="toggleSidebar" class="bg-blue-500 text-white p-4 rounded-full shadow-lg hover:bg-blue-600 transition duration-300">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Overlay for mobile sidebar -->
        <div id="overlay" class="overlay"></div>

        <!-- Main content -->
        <div class="flex-1 overflow-auto">
            <div class="max-w-4xl mx-auto p-6">
                <!-- Header -->
                <header class="flex justify-between items-center mb-8">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">General Knowledge Quiz</h1>
                        <p class="text-gray-600">Test your knowledge with these questions</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="bg-white p-3 rounded-lg shadow-sm flex items-center">
                            <i class="fas fa-clock text-orange-500 mr-2"></i>
                            <span id="mainTimer" class="font-bold timer">10:00</span>
                        </div>
                    </div>
                </header>

                <!-- Question Card -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-sm font-medium text-blue-500">Question <span id="currentQuestionNumber">1</span>/10</span>
                            <span class="text-sm font-medium text-gray-500">1 point</span>
                        </div>
                        <h2 id="questionText" class="text-xl font-semibold text-gray-800 mb-6">What is the capital of France?</h2>
                        
                        <!-- Options -->
                        <div class="space-y-3" id="optionsContainer">
                            <div class="option bg-white border border-gray-200 rounded-lg p-4 cursor-pointer transition duration-300 hover:shadow-md">
                                <div class="flex items-center">
                                    <span class="font-medium mr-3">A.</span>
                                    <span>London</span>
                                </div>
                            </div>
                            <div class="option bg-white border border-gray-200 rounded-lg p-4 cursor-pointer transition duration-300 hover:shadow-md">
                                <div class="flex items-center">
                                    <span class="font-medium mr-3">B.</span>
                                    <span>Paris</span>
                                </div>
                            </div>
                            <div class="option bg-white border border-gray-200 rounded-lg p-4 cursor-pointer transition duration-300 hover:shadow-md">
                                <div class="flex items-center">
                                    <span class="font-medium mr-3">C.</span>
                                    <span>Berlin</span>
                                </div>
                            </div>
                            <div class="option bg-white border border-gray-200 rounded-lg p-4 cursor-pointer transition duration-300 hover:shadow-md">
                                <div class="flex items-center">
                                    <span class="font-medium mr-3">D.</span>
                                    <span>Madrid</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between items-center mt-6">
                    <button id="prevBtn" class="bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-6 rounded-md transition duration-300 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                        <i class="fas fa-arrow-left mr-2"></i> Previous
                    </button>
                    <div class="flex space-x-3">
                        <button id="skipBtn" class="bg-yellow-100 hover:bg-yellow-200 text-yellow-800 py-2 px-6 rounded-md transition duration-300">
                            <i class="fas fa-forward mr-2"></i> Skip
                        </button>
                        <button id="nextBtn" class="bg-orange-500 hover:bg-orange-600 text-white py-2 px-6 rounded-md transition duration-300">
                            Next <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Quiz data
            const quizData = [
                {
                    question: "What is the capital of France?",
                    options: ["London", "Paris", "Berlin", "Madrid"],
                    answer: "Paris"
                },
                {
                    question: "Which planet is known as the Red Planet?",
                    options: ["Venus", "Mars", "Jupiter", "Saturn"],
                    answer: "Mars"
                },
                {
                    question: "Who painted the Mona Lisa?",
                    options: ["Vincent van Gogh", "Pablo Picasso", "Leonardo da Vinci", "Michelangelo"],
                    answer: "Leonardo da Vinci"
                },
                {
                    question: "What is the largest ocean on Earth?",
                    options: ["Atlantic Ocean", "Indian Ocean", "Arctic Ocean", "Pacific Ocean"],
                    answer: "Pacific Ocean"
                },
                {
                    question: "Which country is home to the kangaroo?",
                    options: ["South Africa", "Brazil", "Australia", "New Zealand"],
                    answer: "Australia"
                },
                {
                    question: "What is the chemical symbol for gold?",
                    options: ["Go", "Gd", "Au", "Ag"],
                    answer: "Au"
                },
                {
                    question: "Which language has the most native speakers?",
                    options: ["English", "Hindi", "Spanish", "Mandarin Chinese"],
                    answer: "Mandarin Chinese"
                },
                {
                    question: "What is the tallest mountain in the world?",
                    options: ["K2", "Mount Everest", "Kangchenjunga", "Lhotse"],
                    answer: "Mount Everest"
                },
                {
                    question: "Which year did World War II end?",
                    options: ["1943", "1945", "1947", "1950"],
                    answer: "1945"
                },
                {
                    question: "Who wrote 'Romeo and Juliet'?",
                    options: ["Charles Dickens", "William Shakespeare", "Jane Austen", "Mark Twain"],
                    answer: "William Shakespeare"
                }
            ];

            // Quiz state
            let currentQuestion = 0;
            let answers = Array(quizData.length).fill(null);
            let skippedQuestions = Array(quizData.length).fill(false);
            let timeLeft = 600; // 10 minutes in seconds
            let timerInterval;
            let quizSubmitted = false;

            // DOM elements
            const questionText = document.getElementById('questionText');
            const optionsContainer = document.getElementById('optionsContainer');
            const currentQuestionNumber = document.getElementById('currentQuestionNumber');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const skipBtn = document.getElementById('skipBtn');
            const submitQuiz = document.getElementById('submitQuiz');
            const mainTimer = document.getElementById('mainTimer');
            const sidebarTimer = document.getElementById('sidebarTimer');
            const questionNumbers = document.getElementById('questionNumbers');
            const toggleSidebar = document.getElementById('toggleSidebar');
            const closeSidebar = document.getElementById('closeSidebar');
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('overlay');

            // Initialize the quiz
            function initQuiz() {
                // Create question numbers in sidebar
                quizData.forEach((_, index) => {
                    const questionNumber = document.createElement('div');
                    questionNumber.className = 'question-number w-10 h-10 flex items-center justify-center rounded-md border border-gray-300 cursor-pointer transition duration-300 hover:bg-gray-100';
                    questionNumber.textContent = index + 1;
                    questionNumber.dataset.index = index;
                    
                    questionNumber.addEventListener('click', () => {
                        navigateToQuestion(parseInt(questionNumber.dataset.index));
                        if (window.innerWidth < 768) {
                            sidebar.classList.remove('active');
                            overlay.classList.remove('active');
                        }
                    });
                    
                    questionNumbers.appendChild(questionNumber);
                });

                // Start timer
                startTimer();
                
                // Load first question
                loadQuestion(currentQuestion);
            }

            // Load a question
            function loadQuestion(index) {
                if (index < 0 || index >= quizData.length) return;
                
                currentQuestion = index;
                const question = quizData[index];
                
                // Update question text
                questionText.textContent = question.question;
                currentQuestionNumber.textContent = index + 1;
                
                // Update options
                optionsContainer.innerHTML = '';
                question.options.forEach((option, i) => {
                    const optionElement = document.createElement('div');
                    optionElement.className = 'option bg-white border border-gray-200 rounded-lg p-4 cursor-pointer transition duration-300 hover:shadow-md';
                    
                    // Mark if this option was selected
                    if (answers[index] === option) {
                        optionElement.classList.add('selected');
                    }
                    
                    optionElement.innerHTML = `
                        <div class="flex items-center">
                            <span class="font-medium mr-3">${String.fromCharCode(65 + i)}.</span>
                            <span>${option}</span>
                        </div>
                    `;
                    
                    optionElement.addEventListener('click', () => selectOption(option, index));
                    optionsContainer.appendChild(optionElement);
                });
                
                // Update navigation buttons
                prevBtn.disabled = index === 0;
                nextBtn.textContent = index === quizData.length - 1 ? 'Finish' : 'Next';
                
                // Update question numbers in sidebar
                updateQuestionNumbers();
            }

            // Select an option
            function selectOption(selectedOption, questionIndex) {
                if (quizSubmitted) return;
                
                answers[questionIndex] = selectedOption;
                
                // Highlight selected option
                const options = document.querySelectorAll('.option');
                options.forEach(option => {
                    option.classList.remove('selected', 'correct', 'incorrect');
                    
                    const optionText = option.textContent.trim().split('.').slice(1).join('.').trim();
                    if (optionText === selectedOption) {
                        option.classList.add('selected');
                    }
                });
                
                // Mark question as answered in sidebar
                updateQuestionNumbers();
            }

            // Navigate to a specific question
            function navigateToQuestion(index) {
                if (index >= 0 && index < quizData.length) {
                    loadQuestion(index);
                }
            }

            // Update question numbers in sidebar
            function updateQuestionNumbers() {
                const numbers = document.querySelectorAll('.question-number');
                let answeredCount = 0;
                let notAnsweredCount = 0;
                let skippedCount = 0;

                numbers.forEach((number, index) => {
                    number.classList.remove('answered', 'not-answered', 'skipped', 'current');
                    
                    if (answers[index] !== null) {
                        number.classList.add('answered');
                        answeredCount++;
                    } else if (skippedQuestions[index]) {
                        number.classList.add('skipped');
                        skippedCount++;
                    } else {
                        number.classList.add('not-answered');
                        notAnsweredCount++;
                    }
                    
                    if (index === currentQuestion) {
                        number.classList.add('current');
                    }
                });

                // Update counters
                document.getElementById('answeredCount').textContent = answeredCount;
                document.getElementById('notAnsweredCount').textContent = notAnsweredCount;
                document.getElementById('skippedCount').textContent = skippedCount;
            }

            // Timer functions
            function startTimer() {
                updateTimerDisplay();
                timerInterval = setInterval(() => {
                    if (timeLeft > 0) {
                        timeLeft--;
                        updateTimerDisplay();
                    } else {
                        clearInterval(timerInterval);
                        submitQuizAutomatically();
                    }
                }, 1000);
            }

            function updateTimerDisplay() {
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                const timeString = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                mainTimer.textContent = timeString;
                sidebarTimer.textContent = timeString;
                
                // Change color when time is running low
                if (timeLeft <= 60) {
                    mainTimer.classList.add('text-red-500');
                    sidebarTimer.classList.add('text-red-500');
                } else {
                    mainTimer.classList.remove('text-red-500');
                    sidebarTimer.classList.remove('text-red-500');
                }
            }

            function submitQuizAutomatically() {
                if (!quizSubmitted) {
                    quizSubmitted = true;
                    clearInterval(timerInterval);
                    alert('Time is up! Your quiz has been submitted automatically.');
                    // Here you would typically send the answers to a server
                    showResults();
                }
            }

            function showResults() {
                // Calculate score
                let score = 0;
                quizData.forEach((question, index) => {
                    if (answers[index] === question.answer) {
                        score++;
                    }
                });
                
                // Show all correct answers
                quizData.forEach((question, index) => {
                    const options = document.querySelectorAll('.option');
                    options.forEach(option => {
                        const optionText = option.textContent.trim().split('.').slice(1).join('.').trim();
                        if (optionText === question.answer) {
                            option.classList.add('correct');
                        }
                        if (answers[index] === optionText && answers[index] !== question.answer) {
                            option.classList.add('incorrect');
                        }
                    });
                });
                
                // Disable navigation
                prevBtn.disabled = true;
                nextBtn.disabled = true;
                skipBtn.disabled = true;
                
                // Show score
                alert(`You scored ${score} out of ${quizData.length}!`);
            }

            // Event listeners
            prevBtn.addEventListener('click', () => navigateToQuestion(currentQuestion - 1));
            nextBtn.addEventListener('click', () => {
                if (currentQuestion === quizData.length - 1) {
                    submitQuiz.click();
                } else {
                    navigateToQuestion(currentQuestion + 1);
                }
            });
            skipBtn.addEventListener('click', () => {
                skippedQuestions[currentQuestion] = true;
                navigateToQuestion(currentQuestion + 1);
            });
            
            submitQuiz.addEventListener('click', () => {
                if (confirm('Are you sure you want to submit your quiz?')) {
                    quizSubmitted = true;
                    clearInterval(timerInterval);
                    showResults();
                }
            });

            // Sidebar toggle for mobile
            toggleSidebar.addEventListener('click', () => {
                sidebar.classList.add('active');
                overlay.classList.add('active');
            });

            closeSidebar.addEventListener('click', () => {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });

            overlay.addEventListener('click', () => {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });

            // Initialize the quiz
            initQuiz();
        });
    </script>
</body>
</html>