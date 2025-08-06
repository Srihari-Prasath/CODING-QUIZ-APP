-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2025 at 06:27 AM
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
(1, 14, 'What is the capital of India?', 'Mumbai', 'Delhi', 'Chennai', 'Kolkata', 'B', 1),
(2, 14, 'Which language is primarily used for web development?', 'Python', 'HTML', 'C++', 'Java', 'B', 1),
(3, 14, '2 + 2 equals to?', '3', '4', '5', '6', 'B', 1),
(4, 24, 'What is the capital of India?', 'Mumbai', 'Delhi', 'Chennai', 'Kolkata', 'B', 1),
(5, 24, 'Which language is primarily used for web development?', 'Python', 'HTML', 'C++', 'Java', 'B', 1),
(6, 24, '2 + 2 equals to?', '3', '4', '5', '6', 'B', 1),
(7, 16, 'What is the capital of India?', 'Mumbai', 'Delhi', 'Chennai', 'Kolkata', 'B', 1),
(8, 16, 'Which language is primarily used for web development?', 'Python', 'HTML', 'C++', 'Java', 'B', 1),
(9, 16, '2 + 2 equals to?', '3', '4', '5', '6', 'B', 1),
(10, 13, 'What is the capital of India?', 'Mumbai', 'Delhi', 'Chennai', 'Kolkata', 'B', 1),
(11, 13, 'Which language is primarily used for web development?', 'Python', 'HTML', 'C++', 'Java', 'B', 1),
(12, 13, '2 + 2 equals to?', '3', '4', '5', '6', 'B', 1),
(13, 13, 'What is the capital of India?', 'Mumbai', 'Delhi', 'Chennai', 'Kolkata', 'B', 1),
(14, 13, 'Which language is primarily used for web development?', 'Python', 'HTML', 'C++', 'Java', 'B', 1),
(15, 13, '2 + 2 equals to?', '3', '4', '5', '6', 'B', 1),
(16, 13, 'What is the capital of India?', 'Mumbai', 'Delhi', 'Chennai', 'Kolkata', 'B', 1),
(17, 13, 'Which language is primarily used for web development?', 'Python', 'HTML', 'C++', 'Java', 'B', 1),
(18, 13, '2 + 2 equals to?', '3', '4', '5', '6', 'B', 1),
(19, 13, 'What is the capital of India?', 'Mumbai', 'Delhi', 'Chennai', 'Kolkata', 'B', 1),
(20, 13, 'Which language is primarily used for web development?', 'Python', 'HTML', 'C++', 'Java', 'B', 1),
(21, 13, '2 + 2 equals to?', '3', '4', '5', '6', 'B', 1),
(22, 21, 'What is the capital of India?', 'Mumbai', 'Delhi', 'Chennai', 'Kolkata', 'B', 1),
(23, 21, 'Which language is primarily used for web development?', 'Python', 'HTML', 'C++', 'Java', 'B', 1),
(24, 21, '2 + 2 equals to?', '3', '4', '5', '6', 'B', 1),
(25, 14, 'What is the capital of India?', 'Mumbai', 'Delhi', 'Chennai', 'Kolkata', 'B', 1),
(26, 14, 'Which language is primarily used for web development?', 'Python', 'HTML', 'C++', 'Java', 'B', 1),
(27, 14, '2 + 2 equals to?', '3', '4', '5', '6', 'B', 1),
(28, 14, 'What is the capital of India?', 'Mumbai', 'Delhi', 'Chennai', 'Kolkata', 'B', 1),
(29, 14, 'Which language is primarily used for web development?', 'Python', 'HTML', 'C++', 'Java', 'B', 1),
(30, 14, '2 + 2 equals to?', '3', '4', '5', '6', 'B', 1),
(31, 7, 'What is the capital of India?', 'Mumbai', 'Delhi', 'Chennai', 'Kolkata', 'B', 1),
(32, 7, 'Which language is primarily used for web development?', 'Python', 'HTML', 'C++', 'Java', 'B', 1),
(33, 7, '2 + 2 equals to?', '3', '4', '5', '6', 'B', 1);

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
  `student_test_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `selected_option` enum('A','B','C','D') DEFAULT NULL,
  `is_correct` tinyint(1) DEFAULT NULL,
  `marks_awarded` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_enrollment`
--

CREATE TABLE `student_enrollment` (
  `enrollment_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `test_id` int(11) DEFAULT NULL,
  `enrolled_on` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
(1, 'Unit Test 1', 'Test on Chapter 1 & 2', 'Mathematics', NULL, 2, NULL, '10:00:00', '10:30:00', 30, 50, 0, 1),
(2, 'Unit Test 1', 'Test on Chapter 1 & 2', 'Mathematics', NULL, 2, NULL, '10:00:00', '10:30:00', 30, 50, 0, 1),
(3, 'Unit Test 1', 'Test on Chapter 1 & 2', 'Mathematics', NULL, 2, NULL, '10:00:00', '10:30:00', 30, 50, 0, 1),
(4, 'Unit Test 1', 'Test on Chapter 1 & 2', 'Mathematics', NULL, 2, NULL, '10:00:00', '10:30:00', 30, 50, 0, 1),
(5, 'Unit Test 1', 'Test on Chapter 1 & 2', 'Mathematics', NULL, 2, NULL, '10:00:00', '10:30:00', 30, 50, 0, 1),
(6, 'Unit Test 1', 'Test on Chapter 1 & 2', 'Mathematics', NULL, 2, NULL, '10:00:00', '10:30:00', 30, 50, 0, 1),
(7, 'Unit Test 1', 'Test on Chapter 1 & 2', 'Mathematics', NULL, 2, NULL, '10:00:00', '10:30:00', 30, 50, 0, 1),
(8, 'Unit Test 1', 'Test on Chapter 1 & 2', 'Mathematics', NULL, 2, NULL, '10:00:00', '10:30:00', 30, 50, 0, 1),
(9, 'Unit Test 1', 'Test on Chapter 1 & 2', 'Mathematics', NULL, 2, NULL, '10:00:00', '10:30:00', 30, 50, 0, 1),
(10, 'Unit Test 1', 'Test on Chapter 1 & 2', 'Mathematics', NULL, 2, NULL, '10:00:00', '10:30:00', 30, 50, 0, 1),
(11, 'Unit Test 1', 'Test on Chapter 1 & 2', 'Mathematics', NULL, 2, NULL, '10:00:00', '10:30:00', 30, 50, 0, 1),
(12, 'Unit Test 1', 'Test on Chapter 1 & 2', 'Mathematics', NULL, 2, NULL, '10:00:00', '10:30:00', 30, 50, 0, 1),
(13, 'Unit Test 1', 'Test on Chapter 1 & 2', 'Mathematics', NULL, 2, NULL, '10:00:00', '10:30:00', 30, 50, 0, 1),
(14, 'Unit Test 1', 'Test on Chapter 1 & 2', 'Mathematics', NULL, 2, NULL, '10:00:00', '10:30:00', 30, 50, 0, 1),
(15, 'Unit Test 1', 'Test on Chapter 1 & 2', 'Mathematics', NULL, 2, NULL, '10:00:00', '10:30:00', 30, 50, 0, 1),
(16, 'Unit Test 1', 'Test on Chapter 1 & 2', 'Mathematics', NULL, 2, NULL, '10:00:00', '10:30:00', 30, 50, 0, 1),
(17, 'Unit Test 1', 'Test on Chapter 1 & 2', 'Mathematics', NULL, 2, NULL, '10:00:00', '10:30:00', 30, 50, 0, 1),
(18, 'Unit Test 1', 'Test on Chapter 1 & 2', 'Mathematics', NULL, 2, NULL, '10:00:00', '10:30:00', 30, 50, 0, 1),
(19, 'Unit Test 1', 'Test on Chapter 1 & 2', 'Mathematics', NULL, 2, NULL, '10:00:00', '10:30:00', 30, 50, 0, 1),
(20, 'Unit Test 1', 'Test on Chapter 1 & 2', 'Mathematics', NULL, 2, NULL, '10:00:00', '10:30:00', 30, 50, 0, 1),
(21, 'Unit Test 1', 'Test on Chapter 1 & 2', 'Mathematics', NULL, 2, NULL, '10:00:00', '10:30:00', 30, 50, 0, 1),
(22, 'Unit Test 1', 'Test on Chapter 1 & 2', 'Mathematics', NULL, 2, NULL, '10:00:00', '10:30:00', 30, 50, 0, 1),
(23, 'Unit Test 1', 'Test on Chapter 1 & 2', 'Mathematics', NULL, 2, NULL, '10:00:00', '10:30:00', 30, 50, 0, 1),
(24, 'mark', '23sfadf', 'mark', 'CSE', 2321, NULL, '00:00:00', '00:00:00', 23, 8, 323, 1),
(25, 'mark', '1313', 'mark', 'CSE', 1313, NULL, '11:38:00', '15:38:00', 2323, 8990, 12323, 1);

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
(1, 2, '921022205011', 'Mark', 'naveenbharathi5050@gmail.com', '$2y$10$ydD4abq6ROV77jty0SFpD.v2iQKv39puZDGwtB6WYXtqhHRt8HRea', 2, '2025-08-05 08:49:37', 1);

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
  ADD KEY `student_test_id` (`student_test_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `student_enrollment`
--
ALTER TABLE `student_enrollment`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `student_id` (`student_id`),
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
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `fk_department` (`department_id`);

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
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
-- AUTO_INCREMENT for table `student_tests`
--
ALTER TABLE `student_tests`
  MODIFY `student_test_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `tests` (`test_id`);

--
-- Constraints for table `student_answers`
--
ALTER TABLE `student_answers`
  ADD CONSTRAINT `student_answers_ibfk_1` FOREIGN KEY (`student_test_id`) REFERENCES `student_tests` (`student_test_id`),
  ADD CONSTRAINT `student_answers_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`);

--
-- Constraints for table `student_enrollment`
--
ALTER TABLE `student_enrollment`
  ADD CONSTRAINT `student_enrollment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `student_enrollment_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `tests` (`test_id`);

--
-- Constraints for table `student_tests`
--
ALTER TABLE `student_tests`
  ADD CONSTRAINT `student_tests_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `student_tests_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `tests` (`test_id`);

--
-- Constraints for table `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `tests_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_department` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
