-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2025 at 01:58 PM
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
(74, 26, 'What is the correct file extension for Python files?', '.pt', '.pyt', '.py', '.python', 'C', 1),
(75, 26, 'How do you insert comments in Python?', '// comment', '<!-- comment -->', '-- comment', '# comment', 'D', 1),
(76, 26, 'Which keyword is used to define a function in Python?', 'func', 'define', 'def', 'function', 'C', 1),
(77, 26, 'Which of the following is a correct variable name in Python?', '2variable', 'my-var', 'my_variable', 'my variable', 'C', 1),
(78, 26, 'What is the output of print(2 ** 3)?', '6', '8', '9', '5', 'B', 1),
(79, 26, 'Which operator is used for floor division?', '/', '//', '%', '**', 'B', 1),
(80, 26, 'What is the output of print(type([]))?', '<class \'tuple\'>', '<class \'list\'>', '<class \'dict\'>', '<class \'set\'>', 'B', 1),
(81, 26, 'Which data type is immutable in Python?', 'list', 'set', 'dict', 'tuple', 'D', 1),
(82, 26, 'What is the output of len(\"Python\")?', '5', '6', '7', 'Error', 'B', 1),
(83, 26, 'Which keyword is used for loops in Python?', 'iterate', 'loop', 'for', 'repeat', 'C', 1),
(84, 26, 'What will print(\"Hello\" * 3) output?', 'HelloHelloHello', 'Hello*3', 'Hello 3', 'Error', 'A', 1),
(85, 26, 'Which method is used to remove whitespace from the beginning or end of a string?', 'strip()', 'trim()', 'clean()', 'remove()', 'A', 1),
(86, 26, 'What does the input() function return?', 'String', 'Integer', 'Boolean', 'Float', 'A', 1),
(87, 26, 'Which of the following is a Boolean operator?', '==', '!=', 'and', '+', 'C', 1),
(88, 26, 'Which of these is NOT a valid Python data type?', 'list', 'tuple', 'array', 'set', 'C', 1),
(89, 26, 'Which function converts a string to an integer?', 'str()', 'int()', 'float()', 'bool()', 'B', 1),
(90, 26, 'Which of the following is used to define a block of code in Python?', 'Brackets', 'Curly braces', 'Indentation', 'Parentheses', 'C', 1),
(91, 26, 'What will print(5 == \"5\") return?', 'True', 'False', 'Error', 'None', 'B', 1),
(92, 26, 'How do you start a multiline comment?', '/*', '#', '\"\"\"', '//', 'C', 1),
(93, 26, 'What does the \"pass\" keyword do?', 'Skips a loop', 'Ends a function', 'Does nothing', 'Raises an error', 'C', 1),
(94, 26, 'Which keyword is used for exception handling?', 'except', 'catch', 'try', 'error', 'A', 1),
(95, 26, 'What is the output of bool(0)?', 'True', 'False', '0', 'Error', 'B', 1),
(96, 26, 'What is the result of 10 // 3?', '3.33', '3', '4', '3.0', 'B', 1),
(97, 26, 'Which of the following is a mutable data type?', 'tuple', 'list', 'int', 'str', 'B', 1),
(98, 26, 'Which function returns the largest item?', 'min()', 'max()', 'big()', 'top()', 'B', 1),
(99, 26, 'What will print(0.1 + 0.2 == 0.3) return?', 'True', 'False', 'Error', 'None', 'B', 1),
(100, 26, 'How do you create a dictionary?', '{}', '()', '[]', '<>', 'A', 1),
(101, 26, 'What is the output of list(\"abc\")?', '[abc]', '[a, b, c]', '[\"abc\"]', '[\"a\", \"b\", \"c\"]', 'D', 1),
(102, 26, 'Which of the following opens a file for reading?', 'open(\"file.txt\", \"w\")', 'open(\"file.txt\", \"r\")', 'open(\"file.txt\", \"x\")', 'open(\"file.txt\", \"a\")', 'B', 1),
(103, 26, 'Which loop is guaranteed to run at least once?', 'for', 'while', 'do-while', 'None', 'C', 1),
(104, 26, 'What does the \"continue\" statement do in loops?', 'Breaks the loop', 'Skips to the next iteration', 'Exits function', 'Restarts loop', 'B', 1),
(105, 26, 'Which module is used for regular expressions?', 'regex', 're', 'match', 'pattern', 'B', 1),
(106, 26, 'What will len({1,2,2,3}) return?', '3', '4', '5', 'Error', 'A', 1),
(107, 26, 'Which of the following is used to install external packages?', 'get', 'install', 'pip', 'fetch', 'C', 1),
(108, 26, 'Which keyword is used to create a class?', 'struct', 'class', 'def', 'object', 'B', 1),
(109, 26, 'What is __init__ in Python?', 'A variable', 'A loop', 'A constructor', 'A destructor', 'C', 1),
(110, 26, 'Which method is used to return a string in all lowercase?', 'lower()', 'down()', 'min()', 'small()', 'A', 1),
(111, 26, 'Which symbol is used to import modules?', '@', '#', 'import', 'from', 'C', 1),
(112, 26, 'What does isinstance(x, int) check?', 'If x is defined', 'If x is int', 'If x is integer-like', 'If x is float', 'B', 1),
(113, 26, 'What will print([i for i in range(3)]) output?', '[1,2,3]', '[0,1,2]', '[1,2]', '[0,1,2,3]', 'B', 1);

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
(26, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(27, '9210', 'iykjbiuhii', '878998', '1', 1, 1, '21:08:00', '20:00:00', 9809, 9809, 9809, 0),
(28, '9210', 'iykjbiuhii', '878998', '1', 1, 1, '21:08:00', '20:00:00', 9809, 9809, 9809, 0),
(29, '9210', 'iykjbiuhii', '878998', '1', 1, 1, '21:08:00', '20:00:00', 9809, 9809, 9809, 0),
(30, '9210', 'iykjbiuhii', '878998', '1', 1, 1, '21:08:00', '20:00:00', 9809, 9809, 9809, 0),
(31, 'mark', '23', 'mark', '1', 2, 1, '13:35:00', '13:35:00', 323, 2323, 23, 0),
(32, 'mark', 'df', 'mrk', '1', 1, 1, '20:09:00', '20:09:00', 80, 8989, 8098, 0),
(33, 'mark', 'df', 'mrk', '1', 1, 1, '20:09:00', '20:09:00', 80, 8989, 8098, 0),
(34, 'mark', 'df', 'mrk', '1', 1, 1, '20:09:00', '20:09:00', 80, 8989, 8098, 0),
(35, 'mark', 'df', 'mrk', '1', 1, 1, '20:09:00', '20:09:00', 80, 8989, 8098, 0),
(36, 'mark', 'df', 'mrk', '1', 1, 1, '20:09:00', '20:09:00', 80, 8989, 8098, 0),
(37, '921022205011', '23', 'lhh', '1', 1, 1, '21:08:00', '14:17:00', 23223, 9098, 2323, 0),
(38, '921022205011', '23', 'lhh', '1', 1, 1, '21:08:00', '14:17:00', 23223, 9098, 2323, 0),
(39, '921022205011', '23', 'lhh', '1', 1, 1, '21:08:00', '14:17:00', 23223, 9098, 2323, 0),
(40, 'w23', '23', '2323', '1', 3, 1, '14:19:00', '02:19:00', 23, 23, 23, 0),
(41, '23', '233', '23', '1', 1, 1, '14:20:00', '14:20:00', 23, 23, 23, 0),
(42, 'Python Coding`', 'its python questions', 'Python', '1', 1, 1, '14:39:00', '14:39:00', 50, 50, 40, 0);

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
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

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
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

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
