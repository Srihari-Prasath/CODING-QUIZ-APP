-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2025 at 07:02 AM
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
-- Database: `iqarena`
--

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
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `reset_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `otp` varchar(6) NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `sub_topic_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `by_admin` int(11) NOT NULL DEFAULT 1,
  `question_text` text NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `correct_option` char(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `mark` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `sub_topic_id`, `created_by`, `by_admin`, `question_text`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_option`, `created_at`, `mark`) VALUES
(6, 1, 1, 0, 'What is the capital of India?', 'Mumbai', 'Chennai', 'New Delhi', 'Kolkata', 'C', '2025-08-22 01:13:51', 1),
(7, 1, 1, 0, 'Which data type is used to store decimal values in MySQL?', 'INT', 'VARCHAR', 'FLOAT', 'BOOLEAN', 'C', '2025-08-22 01:13:51', 1),
(8, 1, 1, 0, 'HTML stands for?', 'Hyperlinks and Text Markup Language', 'Hyper Text Markup Language', 'Home Tool Markup Language', 'High Transfer Markup Language', 'B', '2025-08-22 01:13:51', 1),
(9, 1, 1, 0, 'Which SQL command is used to extract data from a database?', 'GET', 'EXTRACT', 'SELECT', 'SHOW', 'C', '2025-08-22 01:13:51', 1),
(10, 1, 1, 0, 'In C language, which symbol is used to denote a pointer?', '#', '*', '&', '%', 'B', '2025-08-22 01:13:51', 1);

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
  `student_answers_id` int(11) NOT NULL,
  `student_test_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` text DEFAULT NULL,
  `is_correct` tinyint(1) DEFAULT NULL,
  `marked_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `student_answers`
--

INSERT INTO `student_answers` (`student_answers_id`, `student_test_id`, `question_id`, `answer`, `is_correct`, `marked_at`) VALUES
(1, 1, 6, 'B', 0, '2025-08-25 06:28:56'),
(2, 1, 7, '', 0, '2025-08-25 06:28:56'),
(3, 1, 8, 'B', 1, '2025-08-25 06:28:56'),
(4, 1, 9, '', 0, '2025-08-25 06:28:56'),
(5, 1, 10, 'A', 0, '2025-08-25 06:28:56'),
(6, 1, 6, 'B', 0, '2025-08-25 06:29:52'),
(7, 1, 7, 'C', 1, '2025-08-25 06:29:52'),
(8, 1, 8, 'B', 1, '2025-08-25 06:29:52'),
(9, 1, 9, 'C', 1, '2025-08-25 06:29:52'),
(10, 1, 10, 'B', 1, '2025-08-25 06:29:52'),
(11, 1, 6, 'A', 0, '2025-08-25 09:42:10'),
(12, 1, 7, 'C', 1, '2025-08-25 09:42:10'),
(13, 1, 8, 'D', 0, '2025-08-25 09:42:10'),
(14, 1, 9, 'A', 0, '2025-08-25 09:42:10'),
(15, 1, 10, 'B', 1, '2025-08-25 09:42:10');

-- --------------------------------------------------------

--
-- Table structure for table `student_tests`
--

CREATE TABLE `student_tests` (
  `student_test_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `start_time` datetime DEFAULT current_timestamp(),
  `end_time` datetime DEFAULT NULL,
  `score` decimal(5,2) DEFAULT 0.00,
  `status` enum('started','completed') DEFAULT 'started'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `student_tests`
--

INSERT INTO `student_tests` (`student_test_id`, `student_id`, `test_id`, `start_time`, `end_time`, `score`, `status`) VALUES
(1, 1, 1, '2025-08-24 22:39:39', '2025-08-25 09:42:10', 2.00, 'completed'),
(2, 1, 1, '2025-08-24 22:39:39', NULL, 3.00, 'started'),
(3, 1, 1, '2025-08-24 22:39:40', NULL, 3.00, 'started'),
(4, 1, 1, '2025-08-24 22:39:40', NULL, 3.00, 'started'),
(5, 1, 1, '2025-08-24 22:39:41', NULL, 3.00, 'started'),
(6, 1, 1, '2025-08-24 22:43:21', NULL, 3.00, 'started'),
(7, 1, 1, '2025-08-24 22:44:54', NULL, 3.00, 'started'),
(8, 1, 1, '2025-08-24 22:46:10', NULL, 3.00, 'started'),
(9, 1, 1, '2025-08-24 22:49:29', NULL, 3.00, 'started'),
(10, 1, 1, '2025-08-24 22:55:30', NULL, 3.00, 'started'),
(11, 1, 1, '2025-08-24 22:55:58', NULL, 3.00, 'started'),
(12, 1, 1, '2025-08-24 22:56:09', NULL, 3.00, 'started'),
(13, 1, 1, '2025-08-24 22:56:20', NULL, 3.00, 'started'),
(14, 1, 1, '2025-08-24 22:56:37', NULL, 3.00, 'started'),
(15, 1, 1, '2025-08-24 22:58:50', NULL, 3.00, 'started'),
(16, 1, 1, '2025-08-24 23:05:11', NULL, 3.00, 'started'),
(17, 1, 1, '2025-08-24 23:05:22', NULL, 3.00, 'started'),
(18, 1, 1, '2025-08-24 23:08:40', NULL, 3.00, 'started'),
(19, 1, 1, '2025-08-24 23:09:00', NULL, 3.00, 'started'),
(20, 1, 1, '2025-08-24 23:09:09', NULL, 3.00, 'started'),
(21, 1, 1, '2025-08-24 23:09:14', NULL, 3.00, 'started'),
(22, 1, 1, '2025-08-24 23:10:11', NULL, 3.00, 'started'),
(23, 1, 1, '2025-08-24 23:10:34', NULL, 3.00, 'started'),
(24, 1, 1, '2025-08-25 05:30:57', NULL, 3.00, 'started'),
(25, 1, 1, '2025-08-25 05:47:52', NULL, 3.00, 'started'),
(26, 1, 1, '2025-08-25 05:49:08', NULL, 3.00, 'started'),
(27, 1, 1, '2025-08-25 05:49:43', NULL, 3.00, 'started'),
(28, 1, 1, '2025-08-25 05:50:14', NULL, 3.00, 'started'),
(29, 1, 1, '2025-08-25 05:58:18', NULL, 3.00, 'started'),
(30, 1, 1, '2025-08-25 06:00:40', NULL, 3.00, 'started'),
(31, 1, 1, '2025-08-25 06:01:55', NULL, 0.00, 'started'),
(32, 1, 1, '2025-08-25 06:29:20', NULL, 0.00, 'started'),
(33, 1, 1, '2025-08-25 06:37:06', NULL, 0.00, 'started'),
(34, 1, 1, '2025-08-25 06:37:29', NULL, 0.00, 'started'),
(35, 1, 1, '2025-08-25 09:42:02', NULL, 0.00, 'started'),
(36, 1, 1, '2025-08-25 09:49:56', NULL, 0.00, 'started');

-- --------------------------------------------------------

--
-- Table structure for table `sub_topics`
--

CREATE TABLE `sub_topics` (
  `sub_topic_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `by_admin` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_topics`
--

INSERT INTO `sub_topics` (`sub_topic_id`, `topic_id`, `title`, `description`, `added_by`, `by_admin`, `created_at`, `updated_at`) VALUES
(1, 1, 'Variables & Data Types', 'Understanding variables and types', 1, 0, '2025-08-20 10:57:44', '2025-08-20 15:56:39'),
(2, 1, 'Control Structures', 'If, loops, and switch statements', 1, 0, '2025-08-20 10:57:44', '2025-08-20 10:57:44'),
(3, 7, 'in fully oops', 'oops based', 1, 0, '2025-08-20 16:20:53', '2025-08-20 16:21:20'),
(4, 4, 'we', 'we', NULL, 1, '2025-08-20 16:29:04', '2025-08-25 02:20:46'),
(5, 3, 'new', 'new', 2, 0, '2025-08-24 12:03:40', '2025-08-24 12:03:40'),
(6, 3, 'new', 'new', 2, 0, '2025-08-24 12:04:22', '2025-08-24 12:04:22'),
(7, 3, 'new', 'new', 2, 0, '2025-08-24 12:04:28', '2025-08-24 12:04:28'),
(8, 11, 'new another', '', 2, 0, '2025-08-24 12:04:52', '2025-08-24 12:17:13');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `test_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `sub_topic_id` int(11) DEFAULT NULL,
  `num_questions` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time_slot` varchar(100) DEFAULT NULL,
  `duration_minutes` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`test_id`, `title`, `description`, `subject`, `added_by`, `topic_id`, `sub_topic_id`, `num_questions`, `department_id`, `year`, `date`, `time_slot`, `duration_minutes`, `created_at`, `is_active`) VALUES
(1, 'test', 'its new one', 'new', 2, 11, 1, 90, 1, 1, '2025-08-24', 'morning', 90, '2025-08-24 13:07:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `test_questions`
--

CREATE TABLE `test_questions` (
  `test_question_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `test_questions`
--

INSERT INTO `test_questions` (`test_question_id`, `test_id`, `question_id`, `created_at`) VALUES
(1, 2, 10, '2025-08-15 19:48:28'),
(2, 2, 9, '2025-08-15 19:48:28'),
(3, 2, 7, '2025-08-15 19:48:28'),
(4, 2, 6, '2025-08-15 19:48:28'),
(5, 2, 8, '2025-08-15 19:48:28'),
(6, 3, 10, '2025-08-15 19:54:36'),
(7, 3, 9, '2025-08-15 19:54:36'),
(8, 3, 11, '2025-08-15 19:54:36'),
(9, 3, 6, '2025-08-15 19:54:36'),
(10, 3, 5, '2025-08-15 19:54:36');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `topic_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `by_admin` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topic_id`, `title`, `description`, `added_by`, `by_admin`, `created_at`, `updated_at`) VALUES
(1, 'Python', 'its test', 1, 0, '2025-08-19 07:46:38', '2025-08-20 15:49:19'),
(2, 'python 2', 'its test', 1, 0, '2025-08-19 07:46:38', '2025-08-20 15:49:17'),
(3, 'python 2', 'its test', NULL, 1, '2025-08-19 07:46:38', '2025-08-20 01:11:13'),
(4, 'another', 'its test', 2, 0, '2025-08-19 07:46:38', '2025-08-20 16:23:24'),
(5, 'python 2', 'its test', NULL, 1, '2025-08-19 07:46:38', '2025-08-20 01:11:13'),
(6, 'Programming Basics', 'Covers intro programming concepts', 1, 0, '2025-08-20 10:57:44', '2025-08-20 15:49:22'),
(7, 'java', 'its java', 1, 0, '2025-08-20 15:47:12', '2025-08-20 15:48:57'),
(8, 'Programming in C', 'Its programmer', 1, 0, '2025-08-20 16:08:26', '2025-08-20 16:08:26'),
(9, 'mark', 'mark', 1, 0, '2025-08-20 16:09:56', '2025-08-20 16:09:56'),
(10, 'new', 'new', NULL, 0, '2025-08-24 11:46:40', '2025-08-24 11:46:40'),
(11, 'new topic', 'new topic', 2, 0, '2025-08-24 11:47:08', '2025-08-24 11:47:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `roll_no` text NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `roll_no`, `name`, `email`, `password`, `year`, `role_id`, `department_id`, `created_at`, `updated_at`) VALUES
(1, '9210', 'NAVEEN', 'naveen@gmail.com', '$2y$10$YQ0VpNPllFSVsYMgHvIgnu6s4mp6Rw1VbhCqiYBpCSwAWC9OJECau', 1, 1, 1, '2025-08-18 06:16:30', '2025-08-24 13:40:48'),
(2, '123', 'NAVEEN', 'naveenb@gmail.com', '$2y$10$YQ0VpNPllFSVsYMgHvIgnu6s4mp6Rw1VbhCqiYBpCSwAWC9OJECau', 0, 2, 1, '2025-08-18 06:16:30', '2025-08-24 09:48:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `short_name` (`short_name`);

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
  ADD KEY `fk_questions_subtopic` (`sub_topic_id`),
  ADD KEY `fk_questions_faculty` (`created_by`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `student_answers`
--
ALTER TABLE `student_answers`
  ADD PRIMARY KEY (`student_answers_id`),
  ADD KEY `student_test_id` (`student_test_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `student_tests`
--
ALTER TABLE `student_tests`
  ADD PRIMARY KEY (`student_test_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indexes for table `sub_topics`
--
ALTER TABLE `sub_topics`
  ADD PRIMARY KEY (`sub_topic_id`),
  ADD KEY `fk_topic` (`topic_id`),
  ADD KEY `fk_subtopic_added_by` (`added_by`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`test_id`),
  ADD KEY `fk_tests_department` (`department_id`),
  ADD KEY `fk_tests_topic` (`topic_id`),
  ADD KEY `fk_tests_subtopic` (`sub_topic_id`),
  ADD KEY `fk_tests_user` (`added_by`);

--
-- Indexes for table `test_questions`
--
ALTER TABLE `test_questions`
  ADD PRIMARY KEY (`test_question_id`),
  ADD KEY `test_id` (`test_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `fk_added_by` (`added_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `roll_no` (`roll_no`) USING HASH,
  ADD KEY `fk_role` (`role_id`),
  ADD KEY `fk_department` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student_answers`
--
ALTER TABLE `student_answers`
  MODIFY `student_answers_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `student_tests`
--
ALTER TABLE `student_tests`
  MODIFY `student_test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `sub_topics`
--
ALTER TABLE `sub_topics`
  MODIFY `sub_topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `test_questions`
--
ALTER TABLE `test_questions`
  MODIFY `test_question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`student_test_id`) REFERENCES `student_tests` (`student_test_id`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`faculty_id`) REFERENCES `student_users` (`user_id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_questions_faculty` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_questions_subtopic` FOREIGN KEY (`sub_topic_id`) REFERENCES `sub_topics` (`sub_topic_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_answers`
--
ALTER TABLE `student_answers`
  ADD CONSTRAINT `student_answers_ibfk_1` FOREIGN KEY (`student_test_id`) REFERENCES `student_tests` (`student_test_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_answers_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE;

--
-- Constraints for table `student_tests`
--
ALTER TABLE `student_tests`
  ADD CONSTRAINT `student_tests_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_tests_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `tests` (`test_id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_topics`
--
ALTER TABLE `sub_topics`
  ADD CONSTRAINT `fk_subtopic_added_by` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_topic` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE;

--
-- Constraints for table `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `fk_tests_department` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tests_subtopic` FOREIGN KEY (`sub_topic_id`) REFERENCES `sub_topics` (`sub_topic_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tests_topic` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tests_user` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `fk_added_by` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_department` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `fk_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
