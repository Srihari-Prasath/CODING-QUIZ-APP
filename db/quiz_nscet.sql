-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2025 at 06:21 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz_nscet`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_activity`
--

CREATE TABLE `admin_activity` (
  `activity_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `performed_on` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `short_name` varchar(50) NOT NULL,
  `full_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `short_name`, `full_name`) VALUES
(1, 'cse', 'B.E. Computer Science & Engineering'),
(2, 'civil', 'B.E. Civil Engineering'),
(3, 'ece', 'B.E. Electronics & Communication Engineering'),
(4, 'eee', 'B.E. Electrical and Electronics Engineering'),
(5, 'mech', 'B.E. Mechanical Engineering'),
(6, 'ai-and-ds', 'B.Tech. Artificial Intelligence & Data Science'),
(7, 'it', 'B.Tech. Information Technology'),
(8, 'se', 'Structural Engineering'),
(9, 'mfe', 'Manufacturing Engineering'),
(10, 's-and-h', 'Science and Humanities');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_test_history`
--

CREATE TABLE `faculty_test_history` (
  `history_id` int(11) NOT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `test_id` int(11) DEFAULT NULL,
  `assigned_on` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `student_test_id` int(11) DEFAULT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `given_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `test_id` int(11) DEFAULT NULL,
  `question_text` text DEFAULT NULL,
  `option_a` text DEFAULT NULL,
  `option_b` text DEFAULT NULL,
  `option_c` text DEFAULT NULL,
  `option_d` text DEFAULT NULL,
  `correct_option` enum('A','B','C','D') DEFAULT NULL,
  `mark` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `test_id`, `question_text`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_option`, `mark`) VALUES
(1, 1, 'What is the capital of France?', 'Berlin', 'Madrid', 'Paris', 'Rome', 'C', 1),
(2, 1, 'Which planet is known as the Red Planet?', 'Earth', 'Mars', 'Jupiter', 'Saturn', 'B', 1),
(3, 1, 'What is the boiling point of water?', '90°C', '100°C', '110°C', '120°C', 'B', 1),
(4, 1, 'Who wrote \"Romeo and Juliet\"?', 'Mark Twain', 'William Shakespeare', 'Charles Dickens', 'Leo Tolstoy', 'B', 1),
(5, 1, 'What is the largest mammal?', 'Elephant', 'Blue Whale', 'Giraffe', 'Hippopotamus', 'B', 1),
(6, 1, 'Which country hosted the 2016 Summer Olympics?', 'China', 'Brazil', 'UK', 'Russia', 'B', 1),
(7, 1, 'What is the chemical symbol for gold?', 'Au', 'Ag', 'Fe', 'Pb', 'A', 1),
(8, 1, 'How many continents are there?', '5', '6', '7', '8', 'C', 1),
(9, 1, 'Who painted the Mona Lisa?', 'Michelangelo', 'Leonardo da Vinci', 'Raphael', 'Donatello', 'B', 1),
(10, 1, 'What gas do plants absorb?', 'Oxygen', 'Carbon Dioxide', 'Nitrogen', 'Hydrogen', 'B', 1),
(11, 2, 'What does CPU stand for?', 'Central Process Unit', 'Central Processing Unit', 'Computer Personal Unit', 'Control Processing Unit', 'B', 1),
(12, 2, 'Which language is primarily used for web development?', 'Python', 'HTML', 'C++', 'Java', 'B', 1),
(13, 2, 'What does RAM stand for?', 'Read Access Memory', 'Random Access Memory', 'Run Access Memory', 'Real Application Memory', 'B', 1),
(14, 2, 'Which company created the Windows OS?', 'Apple', 'Google', 'Microsoft', 'IBM', 'C', 1),
(15, 2, 'What is an IP address?', 'Internet Provider', 'Internet Protocol Address', 'Internal Protocol Address', 'Internet Public Address', 'B', 1),
(16, 2, 'Which of these is a programming language?', 'HTTP', 'FTP', 'JavaScript', 'HTML', 'C', 1),
(17, 2, 'What is the main function of the motherboard?', 'Storage', 'Processing', 'Connectivity', 'Power supply', 'C', 1),
(18, 2, 'Which is not an operating system?', 'Linux', 'Windows', 'Google Chrome', 'macOS', 'C', 1),
(19, 2, 'What does URL stand for?', 'Uniform Resource Locator', 'Uniform Reference Locator', 'Unified Resource Locator', 'Universal Resource Locator', 'A', 1),
(20, 2, 'Which protocol is used to send emails?', 'HTTP', 'FTP', 'SMTP', 'POP3', 'C', 1),
(21, 3, 'What is 7 x 8?', '54', '56', '58', '60', 'B', 1),
(22, 3, 'What is the square root of 81?', '7', '8', '9', '10', 'C', 1),
(23, 3, 'What is 15% of 200?', '20', '25', '30', '35', 'C', 1),
(24, 3, 'If x + 2 = 7, what is x?', '3', '4', '5', '6', 'C', 1),
(25, 3, 'What is the next prime number after 7?', '9', '10', '11', '13', 'C', 1),
(26, 3, 'What is 12 divided by 3?', '3', '4', '5', '6', 'B', 1),
(27, 3, 'What is the value of pi (approx)?', '3.14', '3.15', '3.16', '3.17', 'A', 1),
(28, 3, 'What is 5 squared?', '10', '15', '20', '25', 'D', 1),
(29, 3, 'What is the sum of angles in a triangle?', '90°', '180°', '270°', '360°', 'B', 1),
(30, 3, 'Solve: 2(3 + 4)', '10', '12', '14', '16', 'C', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'student'),
(2, 'faculty'),
(3, 'hod'),
(4, 'vice_principal'),
(5, 'principal');

-- --------------------------------------------------------

--
-- Table structure for table `student_answers`
--

CREATE TABLE `student_answers` (
  `answer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `selected_option` enum('A','B','C','D') NOT NULL,
  `answered_at` datetime DEFAULT current_timestamp(),
  `student_test_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_enrollment`
--

CREATE TABLE `student_enrollment` (
  `enrollment_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `test_id` int(11) DEFAULT NULL,
  `enrolled_on` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_quiz_results`
--

CREATE TABLE `student_quiz_results` (
  `result_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `total_marks` int(11) NOT NULL,
  `submitted_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_tests`
--

CREATE TABLE `student_tests` (
  `student_test_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `test_id` int(11) DEFAULT NULL,
  `started_at` datetime DEFAULT NULL,
  `submitted_at` datetime DEFAULT NULL,
  `score` int(11) DEFAULT 0,
  `feedback` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `test_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `domain` varchar(250) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `duration_minutes` int(11) DEFAULT NULL,
  `total_marks` int(11) DEFAULT NULL,
  `total_questions` int(11) NOT NULL,
  `is_active` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`test_id`, `title`, `description`, `domain`, `department`, `year`, `created_by`, `start_time`, `end_time`, `duration_minutes`, `total_marks`, `total_questions`, `is_active`) VALUES
(1, 'General Knowledge Quiz', 'Test your general knowledge with diverse questions.', 'General Knowledge', 'All Departments', 4, 1, '10:00:00', '11:00:00', 60, 10, 10, 1),
(2, 'Tech Basics Test', 'Assessment on fundamental technology concepts.', 'Technology', 'IT', 4, 2, '14:00:00', '15:00:00', 60, 10, 10, 1),
(3, 'Math Challenge', 'Mathematics proficiency test for 1st year students.', 'Mathematics', 'Science', 4, 3, '09:00:00', '09:45:00', 45, 10, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `roll_no` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `role_id`, `roll_no`, `name`, `email`, `password`, `year`, `created_at`, `department_id`) VALUES
(1, 1, '921022205021', 'Hari Prasath', 'hari@example.com', '', 4, '2025-08-10 16:12:34', 7),
(2, 1, '921022205011', 'Naveen Bharathi', 'Naveen@example.com', '', 4, '2025-08-10 16:12:34', 7),
(3, 1, '921022243017', 'Sandhosh', 'sandhosh@example.com', '', 4, '2025-08-10 16:12:34', 6),
(4, 1, '921022243011', 'Keerthana', 'keerthana@example.com', '', 4, '2025-08-10 16:12:34', 6),
(5, 1, '921022104033', 'Joshika', 'joshika@example.com', '', 4, '2025-08-10 16:12:34', 1),
(6, 1, '921022104041', 'Sachin', 'sachin@example.com', '', 4, '2025-08-10 16:12:34', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_activity`
--
ALTER TABLE `admin_activity`
  ADD PRIMARY KEY (`activity_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `short_name` (`short_name`);

--
-- Indexes for table `faculty_test_history`
--
ALTER TABLE `faculty_test_history`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `faculty_id` (`faculty_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `student_test_id` (`student_test_id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `student_answers`
--
ALTER TABLE `student_answers`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `test_id` (`test_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `student_test_id` (`student_test_id`);

--
-- Indexes for table `student_enrollment`
--
ALTER TABLE `student_enrollment`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indexes for table `student_quiz_results`
--
ALTER TABLE `student_quiz_results`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indexes for table `student_tests`
--
ALTER TABLE `student_tests`
  ADD PRIMARY KEY (`student_test_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`test_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `email` (`email`),
  ADD KEY `department_id` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_activity`
--
ALTER TABLE `admin_activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `faculty_test_history`
--
ALTER TABLE `faculty_test_history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student_answers`
--
ALTER TABLE `student_answers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_enrollment`
--
ALTER TABLE `student_enrollment`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_quiz_results`
--
ALTER TABLE `student_quiz_results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_tests`
--
ALTER TABLE `student_tests`
  MODIFY `student_test_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_activity`
--
ALTER TABLE `admin_activity`
  ADD CONSTRAINT `admin_activity_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `faculty_test_history`
--
ALTER TABLE `faculty_test_history`
  ADD CONSTRAINT `faculty_test_history_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `faculty_test_history_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `tests` (`test_id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`student_test_id`) REFERENCES `student_tests` (`student_test_id`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`faculty_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
