-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2025 at 03:25 AM
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
-- Table structure for table `faculty_users`
--

CREATE TABLE `faculty_users` (
  `id` int(11) NOT NULL,
  `roll_no` text NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_users`
--

INSERT INTO `faculty_users` (`id`, `roll_no`, `full_name`, `email`, `password`, `year`, `role_id`, `department_id`, `created_at`, `updated_at`) VALUES
(1, '921022205011', 'NAVEEN', 'naveen@gmail.com', '$2y$10$PnYRz2lbAii6ncCVLeiAC.a904gttmIyYlaelU62bg1wA0EEfg.n2', 0, 2, 1, '2025-08-18 06:16:30', '2025-08-20 10:33:25'),
(2, '921022205012', 'NAVEEN', 'naveenb@gmail.com', '$2y$10$PnYRz2lbAii6ncCVLeiAC.a904gttmIyYlaelU62bg1wA0EEfg.n2', 0, 2, 1, '2025-08-18 06:16:30', '2025-08-20 01:12:05');

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

INSERT INTO `questions` (`question_id`, `sub_topic_id`, `created_by`, `question_text`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_option`, `created_at`, `mark`) VALUES
(6, 1, 1, 'What is the capital of India?', 'Mumbai', 'Chennai', 'New Delhi', 'Kolkata', 'C', '2025-08-22 01:13:51', 1),
(7, 1, 1, 'Which data type is used to store decimal values in MySQL?', 'INT', 'VARCHAR', 'FLOAT', 'BOOLEAN', 'C', '2025-08-22 01:13:51', 2),
(8, 1, 1, 'HTML stands for?', 'Hyperlinks and Text Markup Language', 'Hyper Text Markup Language', 'Home Tool Markup Language', 'High Transfer Markup Language', 'B', '2025-08-22 01:13:51', 1),
(9, 1, 1, 'Which SQL command is used to extract data from a database?', 'GET', 'EXTRACT', 'SELECT', 'SHOW', 'C', '2025-08-22 01:13:51', 1),
(10, 1, 1, 'In C language, which symbol is used to denote a pointer?', '#', '*', '&', '%', 'B', '2025-08-22 01:13:51', 2);

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

--
-- Dumping data for table `student_answers`
--

INSERT INTO `student_answers` (`answer_id`, `user_id`, `test_id`, `question_id`, `selected_option`, `answered_at`, `student_test_id`) VALUES
(1, 1, 3, 1, 'A', '2025-08-17 11:44:16', 5),
(2, 1, 3, 2, 'C', '2025-08-17 11:44:16', 5),
(3, 1, 3, 3, 'D', '2025-08-17 11:44:16', 5),
(4, 1, 3, 1, 'A', '2025-08-17 12:00:58', 6),
(5, 1, 3, 2, 'C', '2025-08-17 12:00:58', 6),
(6, 1, 3, 3, 'D', '2025-08-17 12:00:58', 6),
(7, 1, 3, 5, 'B', '2025-08-17 12:47:17', 7),
(8, 1, 3, 6, 'B', '2025-08-17 12:47:17', 7),
(9, 1, 3, 9, 'B', '2025-08-17 12:47:17', 7),
(10, 1, 3, 10, 'B', '2025-08-17 12:47:17', 7),
(11, 1, 3, 11, 'B', '2025-08-17 12:47:17', 7),
(12, 1, 3, 5, 'B', '2025-08-17 12:49:32', 8),
(13, 1, 3, 6, 'B', '2025-08-17 12:49:32', 8),
(14, 1, 3, 9, 'B', '2025-08-17 12:49:32', 8),
(15, 1, 3, 10, 'B', '2025-08-17 12:49:32', 8),
(16, 1, 3, 11, 'B', '2025-08-17 12:49:32', 8),
(17, 1, 3, 5, 'B', '2025-08-17 12:59:52', 9),
(18, 1, 3, 6, 'B', '2025-08-17 12:59:52', 9),
(19, 1, 3, 9, 'B', '2025-08-17 12:59:52', 9),
(20, 1, 3, 10, 'B', '2025-08-17 12:59:52', 9),
(21, 1, 3, 11, 'B', '2025-08-17 12:59:52', 9),
(22, 1, 3, 5, 'B', '2025-08-17 13:00:06', 10),
(23, 1, 3, 6, 'B', '2025-08-17 13:00:06', 10),
(24, 1, 3, 9, 'B', '2025-08-17 13:00:06', 10),
(25, 1, 3, 10, 'B', '2025-08-17 13:00:06', 10),
(26, 1, 3, 11, 'B', '2025-08-17 13:00:06', 10),
(27, 1, 3, 5, 'A', '2025-08-17 13:12:15', 11),
(28, 1, 3, 6, 'D', '2025-08-17 13:12:15', 11),
(29, 1, 3, 9, 'B', '2025-08-17 13:12:15', 11),
(30, 1, 3, 10, 'B', '2025-08-17 13:12:15', 11),
(31, 1, 3, 11, 'C', '2025-08-17 13:12:15', 11),
(32, 1, 3, 5, 'B', '2025-08-17 13:20:21', 12),
(33, 1, 3, 6, 'C', '2025-08-17 13:20:21', 12),
(34, 1, 3, 9, 'B', '2025-08-17 13:20:21', 12),
(35, 1, 3, 10, 'A', '2025-08-17 13:20:21', 12),
(36, 1, 3, 11, 'B', '2025-08-17 13:20:21', 12),
(37, 1, 3, 5, 'B', '2025-08-17 13:27:17', 13),
(38, 1, 3, 6, 'A', '2025-08-17 13:27:17', 13),
(39, 1, 3, 9, 'A', '2025-08-17 13:27:17', 13),
(40, 1, 3, 10, 'A', '2025-08-17 13:27:17', 13),
(41, 1, 3, 11, 'B', '2025-08-17 13:27:17', 13),
(42, 1, 3, 5, 'B', '2025-08-17 15:52:58', 14),
(43, 1, 3, 6, 'B', '2025-08-17 15:52:58', 14),
(44, 1, 3, 9, 'B', '2025-08-17 15:52:58', 14),
(45, 1, 3, 10, 'A', '2025-08-17 15:52:58', 14),
(46, 1, 3, 11, 'C', '2025-08-17 15:52:58', 14),
(47, 1, 3, 5, 'B', '2025-08-17 15:53:41', 15),
(48, 1, 3, 6, 'B', '2025-08-17 15:53:41', 15),
(49, 1, 3, 9, 'B', '2025-08-17 15:53:41', 15),
(50, 1, 3, 10, 'A', '2025-08-17 15:53:41', 15),
(51, 1, 3, 11, 'C', '2025-08-17 15:53:41', 15),
(52, 1, 3, 5, 'C', '2025-08-17 15:55:54', 16),
(53, 1, 3, 6, 'D', '2025-08-17 15:55:54', 16),
(54, 1, 3, 9, 'A', '2025-08-17 15:55:54', 16),
(55, 1, 3, 10, 'A', '2025-08-17 15:55:54', 16),
(56, 1, 3, 11, 'B', '2025-08-17 15:55:54', 16),
(57, 1, 3, 5, 'D', '2025-08-17 16:03:27', 17),
(58, 1, 3, 6, 'D', '2025-08-17 16:03:27', 17),
(59, 1, 3, 9, 'D', '2025-08-17 16:03:27', 17),
(60, 1, 3, 10, 'B', '2025-08-17 16:03:27', 17),
(61, 1, 3, 11, 'D', '2025-08-17 16:03:27', 17),
(62, 1, 3, 5, 'B', '2025-08-17 16:03:51', 18),
(63, 1, 3, 6, 'B', '2025-08-17 16:03:51', 18),
(64, 1, 3, 9, 'B', '2025-08-17 16:03:51', 18),
(65, 1, 3, 10, 'B', '2025-08-17 16:03:51', 18),
(66, 1, 3, 11, 'B', '2025-08-17 16:03:51', 18),
(67, 1, 3, 5, 'B', '2025-08-17 16:09:56', 19),
(68, 1, 3, 6, 'B', '2025-08-17 16:09:56', 19),
(69, 1, 3, 9, 'B', '2025-08-17 16:09:56', 19),
(70, 1, 3, 10, 'B', '2025-08-17 16:09:56', 19),
(71, 1, 3, 11, 'B', '2025-08-17 16:09:56', 19),
(72, 1, 3, 5, 'B', '2025-08-17 16:15:09', 20),
(73, 1, 3, 6, 'B', '2025-08-17 16:15:09', 20),
(74, 1, 3, 9, 'B', '2025-08-17 16:15:09', 20),
(75, 1, 3, 10, 'B', '2025-08-17 16:15:09', 20),
(76, 1, 3, 11, 'B', '2025-08-17 16:15:09', 20),
(77, 1, 3, 5, 'B', '2025-08-17 17:10:04', 21),
(78, 1, 3, 6, 'C', '2025-08-17 17:10:04', 21),
(79, 1, 3, 9, 'B', '2025-08-17 17:10:04', 21),
(80, 1, 3, 10, 'A', '2025-08-17 17:10:04', 21),
(81, 1, 3, 11, 'B', '2025-08-17 17:10:04', 21),
(82, 1, 3, 5, 'B', '2025-08-17 17:13:18', 22),
(83, 1, 3, 6, 'C', '2025-08-17 17:13:18', 22),
(84, 1, 3, 9, 'B', '2025-08-17 17:13:18', 22),
(85, 1, 3, 10, 'B', '2025-08-17 17:13:18', 22),
(86, 1, 3, 11, 'B', '2025-08-17 17:13:18', 22),
(87, 1, 3, 5, 'B', '2025-08-17 17:16:55', 23),
(88, 1, 3, 6, 'B', '2025-08-17 17:16:55', 23),
(89, 1, 3, 9, 'B', '2025-08-17 17:16:55', 23),
(90, 1, 3, 10, 'A', '2025-08-17 17:16:55', 23),
(91, 1, 3, 11, 'B', '2025-08-17 17:16:55', 23),
(92, 1, 3, 5, 'B', '2025-08-17 17:21:26', 24),
(93, 1, 3, 6, 'B', '2025-08-17 17:21:26', 24),
(94, 1, 3, 9, 'B', '2025-08-17 17:21:26', 24),
(95, 1, 3, 10, 'A', '2025-08-17 17:21:26', 24),
(96, 1, 3, 11, 'B', '2025-08-17 17:21:26', 24),
(97, 1, 3, 5, 'B', '2025-08-17 17:21:36', 25),
(98, 1, 3, 6, 'B', '2025-08-17 17:21:36', 25),
(99, 1, 3, 9, 'B', '2025-08-17 17:21:36', 25),
(100, 1, 3, 10, 'A', '2025-08-17 17:21:36', 25),
(101, 1, 3, 11, 'B', '2025-08-17 17:21:36', 25),
(102, 1, 3, 5, 'B', '2025-08-17 17:23:08', 26),
(103, 1, 3, 6, 'B', '2025-08-17 17:23:08', 26),
(104, 1, 3, 9, 'B', '2025-08-17 17:23:08', 26),
(105, 1, 3, 10, 'B', '2025-08-17 17:23:08', 26),
(106, 1, 3, 11, 'B', '2025-08-17 17:23:08', 26),
(107, 1, 3, 5, 'B', '2025-08-17 17:26:23', 27),
(108, 1, 3, 6, 'B', '2025-08-17 17:26:23', 27),
(109, 1, 3, 9, 'A', '2025-08-17 17:26:23', 27),
(110, 1, 3, 10, 'A', '2025-08-17 17:26:23', 27),
(111, 1, 3, 11, 'B', '2025-08-17 17:26:23', 27),
(112, 1, 3, 5, 'D', '2025-08-17 17:26:52', 28),
(113, 1, 3, 6, 'D', '2025-08-17 17:26:52', 28),
(114, 1, 3, 9, 'B', '2025-08-17 17:26:52', 28),
(115, 1, 3, 10, 'B', '2025-08-17 17:26:52', 28),
(116, 1, 3, 11, 'C', '2025-08-17 17:26:52', 28),
(117, 1, 3, 10, 'B', '2025-08-17 18:00:51', 29),
(118, 1, 3, 10, 'B', '2025-08-17 18:00:51', 30),
(119, 1, 3, 10, 'B', '2025-08-17 18:01:00', 31),
(120, 1, 3, 10, 'B', '2025-08-17 18:01:01', 32),
(121, 1, 3, 10, 'B', '2025-08-17 18:01:01', 33),
(122, 1, 3, 5, 'C', '2025-08-17 18:18:28', 61),
(123, 1, 3, 6, 'B', '2025-08-17 18:18:28', 61),
(124, 1, 3, 9, 'C', '2025-08-17 18:18:28', 61),
(125, 1, 3, 10, 'B', '2025-08-17 18:18:28', 61),
(126, 1, 3, 11, 'B', '2025-08-17 18:18:28', 61),
(127, 1, 3, 5, 'B', '2025-08-17 20:40:14', 62),
(128, 1, 3, 6, 'B', '2025-08-17 20:40:14', 62),
(129, 1, 3, 9, 'B', '2025-08-17 20:40:14', 62),
(130, 1, 3, 10, 'B', '2025-08-17 20:40:14', 62),
(131, 1, 3, 11, 'B', '2025-08-17 20:40:14', 62);

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

--
-- Dumping data for table `student_enrollment`
--

INSERT INTO `student_enrollment` (`enrollment_id`, `student_id`, `test_id`, `enrolled_on`) VALUES
(1, 1, 3, '2025-08-17 10:43:55');

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

--
-- Dumping data for table `student_quiz_results`
--

INSERT INTO `student_quiz_results` (`result_id`, `user_id`, `test_id`, `score`, `total_marks`, `submitted_at`) VALUES
(1, 1, 3, 0, 5, '2025-08-17 12:00:58'),
(2, 1, 3, 5, 5, '2025-08-17 12:47:17'),
(3, 1, 3, 5, 5, '2025-08-17 12:49:32'),
(4, 1, 3, 5, 5, '2025-08-17 12:59:52'),
(5, 1, 3, 5, 5, '2025-08-17 13:00:06'),
(6, 1, 3, 2, 5, '2025-08-17 13:12:15'),
(7, 1, 3, 3, 5, '2025-08-17 13:20:21'),
(8, 1, 3, 2, 5, '2025-08-17 13:27:17'),
(9, 1, 3, 3, 5, '2025-08-17 15:52:58'),
(10, 1, 3, 3, 5, '2025-08-17 15:53:41'),
(11, 1, 3, 1, 5, '2025-08-17 15:55:54'),
(12, 1, 3, 1, 5, '2025-08-17 16:03:27'),
(13, 1, 3, 5, 5, '2025-08-17 16:03:51'),
(14, 1, 3, 5, 5, '2025-08-17 16:09:56'),
(15, 1, 3, 5, 5, '2025-08-17 16:15:09'),
(16, 1, 3, 3, 5, '2025-08-17 17:10:04'),
(17, 1, 3, 4, 5, '2025-08-17 17:13:18'),
(18, 1, 3, 4, 5, '2025-08-17 17:16:55'),
(19, 1, 3, 4, 5, '2025-08-17 17:21:26'),
(20, 1, 3, 4, 5, '2025-08-17 17:21:36'),
(21, 1, 3, 5, 5, '2025-08-17 17:23:08'),
(22, 1, 3, 3, 5, '2025-08-17 17:26:23'),
(23, 1, 3, 2, 5, '2025-08-17 17:26:52'),
(24, 1, 3, 1, 5, '2025-08-17 18:00:51'),
(25, 1, 3, 1, 5, '2025-08-17 18:00:51'),
(26, 1, 3, 1, 5, '2025-08-17 18:01:00'),
(27, 1, 3, 1, 5, '2025-08-17 18:01:01'),
(28, 1, 3, 1, 5, '2025-08-17 18:01:01'),
(29, 1, 3, 0, 5, '2025-08-17 18:01:20'),
(30, 1, 3, 0, 5, '2025-08-17 18:01:21'),
(31, 1, 3, 0, 5, '2025-08-17 18:01:24'),
(32, 1, 3, 0, 5, '2025-08-17 18:01:24'),
(33, 1, 3, 0, 5, '2025-08-17 18:01:25'),
(34, 1, 3, 0, 5, '2025-08-17 18:01:25'),
(35, 1, 3, 0, 5, '2025-08-17 18:01:25'),
(36, 1, 3, 0, 5, '2025-08-17 18:01:25'),
(37, 1, 3, 0, 5, '2025-08-17 18:01:25'),
(38, 1, 3, 0, 5, '2025-08-17 18:01:25'),
(39, 1, 3, 0, 5, '2025-08-17 18:01:26'),
(40, 1, 3, 0, 5, '2025-08-17 18:01:26'),
(41, 1, 3, 0, 5, '2025-08-17 18:01:26'),
(42, 1, 3, 0, 5, '2025-08-17 18:01:28'),
(43, 1, 3, 0, 5, '2025-08-17 18:01:28'),
(44, 1, 3, 0, 5, '2025-08-17 18:01:28'),
(45, 1, 3, 0, 5, '2025-08-17 18:01:28'),
(46, 1, 3, 0, 5, '2025-08-17 18:01:28'),
(47, 1, 3, 0, 5, '2025-08-17 18:01:29'),
(48, 1, 3, 0, 5, '2025-08-17 18:01:29'),
(49, 1, 3, 0, 5, '2025-08-17 18:01:29'),
(50, 1, 3, 0, 5, '2025-08-17 18:01:30'),
(51, 1, 3, 0, 5, '2025-08-17 18:01:35'),
(52, 1, 3, 0, 5, '2025-08-17 18:01:35'),
(53, 1, 3, 0, 5, '2025-08-17 18:01:35'),
(54, 1, 3, 0, 5, '2025-08-17 18:01:35'),
(55, 1, 3, 0, 5, '2025-08-17 18:01:35'),
(56, 1, 3, 3, 5, '2025-08-17 18:18:28'),
(57, 1, 3, 5, 5, '2025-08-17 20:40:14');

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

--
-- Dumping data for table `student_tests`
--

INSERT INTO `student_tests` (`student_test_id`, `student_id`, `test_id`, `started_at`, `submitted_at`, `score`, `feedback`) VALUES
(3, 1, 3, NULL, '2025-08-17 11:39:31', 0, NULL),
(4, 1, 3, NULL, '2025-08-17 11:42:10', 0, NULL),
(5, 1, 3, NULL, '2025-08-17 11:44:16', 0, NULL),
(6, 1, 3, NULL, '2025-08-17 12:00:58', 0, NULL),
(7, 1, 3, NULL, '2025-08-17 12:47:17', 5, NULL),
(8, 1, 3, NULL, '2025-08-17 12:49:32', 5, NULL),
(9, 1, 3, NULL, '2025-08-17 12:59:52', 5, NULL),
(10, 1, 3, NULL, '2025-08-17 13:00:06', 5, NULL),
(11, 1, 3, NULL, '2025-08-17 13:12:15', 2, NULL),
(12, 1, 3, NULL, '2025-08-17 13:20:21', 3, NULL),
(13, 1, 3, NULL, '2025-08-17 13:27:17', 2, NULL),
(14, 1, 3, NULL, '2025-08-17 15:52:58', 3, NULL),
(15, 1, 3, NULL, '2025-08-17 15:53:41', 3, NULL),
(16, 1, 3, NULL, '2025-08-17 15:55:54', 1, NULL),
(17, 1, 3, NULL, '2025-08-17 16:03:27', 1, NULL),
(18, 1, 3, NULL, '2025-08-17 16:03:51', 5, NULL),
(19, 1, 3, NULL, '2025-08-17 16:09:56', 5, NULL),
(20, 1, 3, NULL, '2025-08-17 16:15:09', 5, NULL),
(21, 1, 3, NULL, '2025-08-17 17:10:04', 3, NULL),
(22, 1, 3, NULL, '2025-08-17 17:13:18', 4, NULL),
(23, 1, 3, NULL, '2025-08-17 17:16:55', 4, NULL),
(24, 1, 3, NULL, '2025-08-17 17:21:26', 4, NULL),
(25, 1, 3, NULL, '2025-08-17 17:21:36', 4, NULL),
(26, 1, 3, NULL, '2025-08-17 17:23:08', 5, NULL),
(27, 1, 3, NULL, '2025-08-17 17:26:23', 3, NULL),
(28, 1, 3, NULL, '2025-08-17 17:26:52', 2, NULL),
(29, 1, 3, NULL, '2025-08-17 18:00:51', 1, NULL),
(30, 1, 3, NULL, '2025-08-17 18:00:51', 1, NULL),
(31, 1, 3, NULL, '2025-08-17 18:01:00', 1, NULL),
(32, 1, 3, NULL, '2025-08-17 18:01:01', 1, NULL),
(33, 1, 3, NULL, '2025-08-17 18:01:01', 1, NULL),
(34, 1, 3, NULL, '2025-08-17 18:01:20', 0, NULL),
(35, 1, 3, NULL, '2025-08-17 18:01:21', 0, NULL),
(36, 1, 3, NULL, '2025-08-17 18:01:24', 0, NULL),
(37, 1, 3, NULL, '2025-08-17 18:01:24', 0, NULL),
(38, 1, 3, NULL, '2025-08-17 18:01:25', 0, NULL),
(39, 1, 3, NULL, '2025-08-17 18:01:25', 0, NULL),
(40, 1, 3, NULL, '2025-08-17 18:01:25', 0, NULL),
(41, 1, 3, NULL, '2025-08-17 18:01:25', 0, NULL),
(42, 1, 3, NULL, '2025-08-17 18:01:25', 0, NULL),
(43, 1, 3, NULL, '2025-08-17 18:01:25', 0, NULL),
(44, 1, 3, NULL, '2025-08-17 18:01:26', 0, NULL),
(45, 1, 3, NULL, '2025-08-17 18:01:26', 0, NULL),
(46, 1, 3, NULL, '2025-08-17 18:01:26', 0, NULL),
(47, 1, 3, NULL, '2025-08-17 18:01:28', 0, NULL),
(48, 1, 3, NULL, '2025-08-17 18:01:28', 0, NULL),
(49, 1, 3, NULL, '2025-08-17 18:01:28', 0, NULL),
(50, 1, 3, NULL, '2025-08-17 18:01:28', 0, NULL),
(51, 1, 3, NULL, '2025-08-17 18:01:28', 0, NULL),
(52, 1, 3, NULL, '2025-08-17 18:01:29', 0, NULL),
(53, 1, 3, NULL, '2025-08-17 18:01:29', 0, NULL),
(54, 1, 3, NULL, '2025-08-17 18:01:29', 0, NULL),
(55, 1, 3, NULL, '2025-08-17 18:01:30', 0, NULL),
(56, 1, 3, NULL, '2025-08-17 18:01:35', 0, NULL),
(57, 1, 3, NULL, '2025-08-17 18:01:35', 0, NULL),
(58, 1, 3, NULL, '2025-08-17 18:01:35', 0, NULL),
(59, 1, 3, NULL, '2025-08-17 18:01:35', 0, NULL),
(60, 1, 3, NULL, '2025-08-17 18:01:35', 0, NULL),
(61, 1, 3, NULL, '2025-08-17 18:18:28', 3, NULL),
(62, 1, 3, NULL, '2025-08-17 20:40:14', 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_users`
--

CREATE TABLE `student_users` (
  `user_id` int(11) NOT NULL,
  `roll_no` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `student_users`
--

INSERT INTO `student_users` (`user_id`, `roll_no`, `name`, `email`, `password`, `year`, `created_at`, `department_id`) VALUES
(1, '921022205011', 'Naveen', 'naveenbharathi5050@gmail.com', '$2y$10$dJoybMfdQzeC/f5oygXJlO8zl2zJWUNyC3GzbN7ITJBkPz78qh80e', 4, '2025-08-21 04:31:22', 7);

-- --------------------------------------------------------

--
-- Table structure for table `sub_topics`
--

CREATE TABLE `sub_topics` (
  `sub_topic_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `added_by` int(11) NOT NULL,
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
(4, 4, 'we', 'we', 1, 0, '2025-08-20 16:29:04', '2025-08-20 16:29:04');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `test_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `subject` text NOT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `sub_topic_id` int(11) DEFAULT NULL,
  `num_questions` int(11) DEFAULT 0,
  `department_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_slot` enum('morning','evening','full_day') NOT NULL,
  `duration_minutes` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`test_id`, `title`, `description`, `subject`, `topic_id`, `sub_topic_id`, `num_questions`, `department_id`, `year`, `date`, `time_slot`, `duration_minutes`, `created_by`, `created_at`, `is_active`) VALUES
(1, 'Java Programming', 'Core Java concepts and OOP fundamentals', '', 1, 1, 5, 1, 1, '2025-08-17', 'morning', 60, 1, '2025-08-15 19:36:35', 1),
(2, 'Java Programming', 'Core Java concepts and OOP fundamentals', '', NULL, NULL, 5, 1, 1, '2025-08-18', 'morning', 60, 1, '2025-08-15 19:48:28', 1),
(3, 'Java Programming', 'Core Java concepts and OOP fundamentals', '', NULL, NULL, 5, 1, 2, '2025-08-17', 'full_day', 60, 1, '2025-08-15 19:54:36', 1),
(6, 'Sample Test', 'Test Description', 'Math', 1, 2, 10, 1, 2025, '2025-08-21', 'morning', 60, 1, '2025-08-21 01:42:44', 1),
(11, 'Sample Test', 'Test Description', 'Math', 1, 2, 10, 1, 2025, '2025-08-21', 'morning', 60, 1, '2025-08-21 01:51:51', 1),
(13, 'Sample Test', 'Test Description', 'Math', 1, 2, 10, 1, 2025, '2025-08-21', 'morning', 60, 1, '2025-08-21 01:52:35', 1),
(18, 'Mark', 'welcome', 'its python', 1, 1, 90, 1, 1, '2025-08-21', 'morning', 90, 1, '2025-08-21 02:10:14', 1),
(19, 'its test new', 'its test', 'new test', 1, 1, 90, 1, 1, '2025-08-21', 'morning', 90, 1, '2025-08-21 02:12:24', 1);

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
(9, 'mark', 'mark', 1, 0, '2025-08-20 16:09:56', '2025-08-20 16:09:56');

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
-- Indexes for table `faculty_users`
--
ALTER TABLE `faculty_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_role` (`role_id`),
  ADD KEY `fk_department` (`department_id`);

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
-- Indexes for table `student_users`
--
ALTER TABLE `student_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `unique_roll_no` (`roll_no`),
  ADD UNIQUE KEY `unique_email` (`email`),
  ADD KEY `idx_department_id` (`department_id`);

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
  ADD KEY `department_id` (`department_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `fk_tests_topic` (`topic_id`),
  ADD KEY `fk_tests_sub_topic` (`sub_topic_id`);

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
-- AUTO_INCREMENT for table `faculty_users`
--
ALTER TABLE `faculty_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `student_enrollment`
--
ALTER TABLE `student_enrollment`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_quiz_results`
--
ALTER TABLE `student_quiz_results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `student_tests`
--
ALTER TABLE `student_tests`
  MODIFY `student_test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `student_users`
--
ALTER TABLE `student_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_topics`
--
ALTER TABLE `sub_topics`
  MODIFY `sub_topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `test_questions`
--
ALTER TABLE `test_questions`
  MODIFY `test_question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_activity`
--
ALTER TABLE `admin_activity`
  ADD CONSTRAINT `admin_activity_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `student_users` (`user_id`);

--
-- Constraints for table `faculty_test_history`
--
ALTER TABLE `faculty_test_history`
  ADD CONSTRAINT `faculty_test_history_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `student_users` (`user_id`),
  ADD CONSTRAINT `faculty_test_history_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `tests` (`test_id`);

--
-- Constraints for table `faculty_users`
--
ALTER TABLE `faculty_users`
  ADD CONSTRAINT `fk_department` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `fk_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);

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
  ADD CONSTRAINT `fk_questions_faculty` FOREIGN KEY (`created_by`) REFERENCES `faculty_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_questions_subtopic` FOREIGN KEY (`sub_topic_id`) REFERENCES `sub_topics` (`sub_topic_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_users`
--
ALTER TABLE `student_users`
  ADD CONSTRAINT `fk_student_department` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_topics`
--
ALTER TABLE `sub_topics`
  ADD CONSTRAINT `fk_subtopic_added_by` FOREIGN KEY (`added_by`) REFERENCES `faculty_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_topic` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE;

--
-- Constraints for table `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `fk_tests_sub_topic` FOREIGN KEY (`sub_topic_id`) REFERENCES `sub_topics` (`sub_topic_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tests_topic` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tests_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`),
  ADD CONSTRAINT `tests_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `tests_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `student_users` (`user_id`);

--
-- Constraints for table `test_questions`
--
ALTER TABLE `test_questions`
  ADD CONSTRAINT `test_questions_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `tests` (`test_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `test_questions_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE;

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `fk_added_by` FOREIGN KEY (`added_by`) REFERENCES `faculty_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
