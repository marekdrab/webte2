-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 15, 2021 at 08:08 PM
-- Server version: 8.0.23-0ubuntu0.20.04.1
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timak`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int UNSIGNED NOT NULL,
  `answer` varchar(512) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `is_correct` tinyint DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `answer`, `is_correct`) VALUES
(184, '1~22~22~21&2~3~3~2', NULL),
(183, '4', 0),
(182, '2', 0),
(181, '2', 0),
(180, '1', 1),
(179, '11', 1),
(178, 'ano', 1),
(177, '55', 1),
(130, 'Odpoveď správna', 1),
(131, 'možnosť', 0),
(132, 'možnosť', 0),
(133, 'možnosť', 0),
(134, 'aaaa', 1),
(135, 'možnosť1~možnosť2~možnosť3~možnosť4&odpoveď1~odpoveď2~odpoveď3~odpoveď4', NULL),
(136, 'ano', 1),
(137, 'test', 1),
(138, 'ano', 1),
(139, '1', 1),
(140, '2', 0),
(141, '3', 0),
(142, '4', 0),
(143, '123', 1),
(144, '123', 1),
(145, 'odpoved1', 1),
(146, 'spravna', 1),
(147, 'nespravna1', 0),
(148, 'nespravna2', 0),
(149, 'nespravna3', 0),
(150, 'ano', 1),
(151, 'ano', 1),
(152, '1', 1),
(153, '2', 0),
(154, '3', 0),
(155, '4', 0),
(156, 'ano', 1),
(157, 'ano', 1),
(158, 'ano', 1),
(159, 'ano', 1),
(160, '1', 1),
(161, '2', 0),
(162, '3', 0),
(163, '3', 0),
(164, '2~2~2~2&2~2~2~2', NULL),
(165, '123', 1),
(166, '11', 1),
(167, '22', 0),
(168, '33', 0),
(169, '44', 0),
(170, '1~2~3~4&1~2~3~4', NULL),
(171, 'ano', 1),
(172, 'ano', 1),
(173, '1', 1),
(174, '2', 0),
(175, '3', 0),
(176, '4', 0),
(185, 'Rest', 1),
(186, 'G', 1),
(187, 'U', 0),
(188, 'R', 0),
(189, 'Y', 0),
(190, 'We~Te~Se~De&Ew~Et~Es~Ed', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `no_question_type`
--

CREATE TABLE `no_question_type` (
  `id` int UNSIGNED NOT NULL,
  `type` varchar(64) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `no_question_type`
--

INSERT INTO `no_question_type` (`id`, `type`) VALUES
(1, 'Otvorená odpoveď'),
(2, 'Možnosti'),
(3, 'Párovanie'),
(4, 'Kreslenie'),
(5, 'Matematický výraz');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int UNSIGNED NOT NULL,
  `question` varchar(512) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `type_id` int NOT NULL,
  `correct_answer_id` varchar(512) CHARACTER SET utf8 COLLATE utf8_slovak_ci DEFAULT NULL,
  `all_answers_id` varchar(512) CHARACTER SET utf8 COLLATE utf8_slovak_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `type_id`, `correct_answer_id`, `all_answers_id`) VALUES
(98, 'moznosti2', 2, '166', '167,168,169'),
(99, 'parovanie', 3, '170', NULL),
(100, 'kreslenie', 4, NULL, NULL),
(101, 'mat', 5, NULL, NULL),
(103, 'otvorena`', 1, '172', NULL),
(106, 'otvorena`', 1, '178', NULL),
(105, 'otvorena`', 1, '177', NULL),
(108, 'mopznost', 2, '180', '181,182,183'),
(109, 'acafd', 4, NULL, NULL),
(113, '12333', 5, NULL, NULL),
(111, 'dasd', 3, '184', NULL),
(96, 'mar121', 5, NULL, NULL),
(95, '2eq', 5, NULL, NULL),
(94, 'mat22', 5, NULL, NULL),
(93, 'mat', 5, NULL, NULL),
(92, 'otvorena`', 5, NULL, NULL),
(91, 'otvorena`', 4, NULL, NULL),
(90, '1', 3, '164', NULL),
(89, 'otvorena`', 2, '160', '161,162,163'),
(102, 'otvorena`', 1, '171', NULL),
(86, 'otvorena`', 1, '157', NULL),
(85, 'otvorena`', 1, '156', NULL),
(84, 'moznosti', 2, '152', '153,154,155'),
(83, 'otvorena', 1, '151', NULL),
(82, 'otvorena', 1, '150', NULL),
(81, 'otazka2', 2, '146', '147,148,149'),
(80, '1. otazka', 1, '145', NULL),
(77, 'moznosti', 2, '139', '140,141,142'),
(78, 'otvorena', 1, '143', NULL),
(79, 'otvorena', 1, '144', NULL),
(73, 'Matematicka', 5, NULL, NULL),
(72, 'Kreslenie', 4, NULL, NULL),
(71, 'Párovacia otázka', 3, '135', NULL),
(70, 'Otvorená otázka', 1, '134', NULL),
(69, 'Tu bude otázka na možnosti?', 2, '130', '131,132,133'),
(114, 'Tttt', 4, NULL, NULL),
(115, 'Tff', 1, '185', NULL),
(116, 'Ff', 2, '186', '187,188,189'),
(117, 'Ds', 3, '190', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int UNSIGNED NOT NULL,
  `first_name` varchar(512) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `last_name` varchar(512) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `active` tinyint NOT NULL,
  `test_number` int NOT NULL,
  `test_submit` tinyint NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `first_name`, `last_name`, `active`, `test_number`, `test_submit`) VALUES
(1, 'Michal', 'Hamrak', 3, 98241, 0),
(2, 'Peter', 'Andrejko', 3, 64291, 0),
(3, 'Peter', 'Andrejko', 3, 64291, 0),
(4, 'Peter', 'Andrejko', 3, 64291, 0),
(5, 'Peter', 'Andrejko', 3, 64291, 0),
(6, 'Peter', 'Andrejko', 3, 64291, 0),
(7, 'Tom', 'Dan', 3, 98241, 0),
(8, 'dan', 'tom', 0, 98241, 0),
(9, 'Marek', 'Dráb', 3, 96968, 0),
(10, 'Marek', 'Dráb', 1, 64291, 0),
(11, 'qq', 'qq', 2, 98241, 0),
(12, 'Peter', 'Andrejko', 3, 64291, 0),
(13, 'Peter', 'Andrejko', 3, 64291, 0);

-- --------------------------------------------------------

--
-- Table structure for table `submitted_answers`
--

CREATE TABLE `submitted_answers` (
  `id` int UNSIGNED NOT NULL,
  `is_correct` double NOT NULL,
  `input_answer` varchar(512) CHARACTER SET utf8 COLLATE utf8_slovak_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `submitted_answers`
--

INSERT INTO `submitted_answers` (`id`, `is_correct`, `input_answer`) VALUES
(1, 0, '4'),
(2, 1, '1~22~22~21&3~2~3~2'),
(3, 1, '1'),
(4, 1, '21~22~1~22&3~2~2~3'),
(5, 1, '1~22~22~21&2~3~3~2'),
(6, 0, '21~22&3~2'),
(7, 0.5, '1~22~22~21&3~2~3~2'),
(8, 0, ''),
(9, 0, NULL),
(10, 1, 'Rest'),
(11, 1, 'G'),
(12, 1, 'De~Se~Te~We&Ed~Es~Et~Ew'),
(13, 0, NULL),
(14, 0.5, '21~1&2~2');

-- --------------------------------------------------------

--
-- Table structure for table `submitted_tests`
--

CREATE TABLE `submitted_tests` (
  `id` int UNSIGNED NOT NULL,
  `test_code` int NOT NULL,
  `student_id` int NOT NULL,
  `submitted_answers_id` varchar(256) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `submitted_tests`
--

INSERT INTO `submitted_tests` (`id`, `test_code`, `student_id`, `submitted_answers_id`) VALUES
(1, 64291, 2, '1,2'),
(2, 64291, 3, '3,4'),
(3, 64291, 4, '5'),
(4, 64291, 5, '6'),
(5, 64291, 6, '7'),
(6, 98241, 7, '8,9'),
(7, 96968, 9, '10,11,12'),
(8, 64291, 12, '13'),
(9, 64291, 13, '14');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int NOT NULL,
  `name` varchar(64) NOT NULL,
  `surname` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(256) NOT NULL,
  `secret` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `surname`, `email`, `password`, `secret`) VALUES
(6, 'Marek', 'Drab', 'marek.drablp@gmail.com', '$2y$10$Dd6MsXfyNxe39D.uBZVr8e2YQitWSfjzEfMxCivj13KmGZsppi3vW', 'DYG2UCL4I4TG3MIO'),
(8, 'peter', 'najlepšie', 'peter@mail.to', '$2y$10$MK4yZfkxFyejRQgFnPqF1OCpdHErM4VkF0S9K6uS42MH6cUboUtn6', 'VPCSLW24E6BATNUQ'),
(9, 'Michal', 'Hamrák', 'xhamrak@stuba.sk', '$2y$10$ZvOjbDWkgKx/FvgoMXjjHeGc.m2fLvYITj7/f98b2/ZRrgjTZb1lK', 'PYDGKGAL5NYXAJ3K'),
(15, 'David', 'Gavenda', 'piskot@gmail.com', '$2y$10$l5KfbjaPyCvyl93uXQPyoOJsroO9gclJT5BC8imevfN91IZQbpCGm', '62ABJTLP4DFTIWGF'),
(22, 'Tomas', 'Danko', 'danko.tomas.ts@gmail.com', '$2y$10$a8bxzlNMj05V6JaQ0gfCB.gyMs4atHxKwj9RI1T1F2CMOQRAE85wi', '4WMCZQZYICMQP3B6');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `code` int NOT NULL,
  `question_id` varchar(512) CHARACTER SET utf8 COLLATE utf8_slovak_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `time_limit` int NOT NULL,
  `teacher_id` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `name`, `code`, `question_id`, `is_active`, `time_limit`, `teacher_id`) VALUES
(38, 'TestHamrak', 98241, '69,70,71,72,73,', 1, 10, 9),
(40, 'testpeto', 39840, '', 0, 45, 8),
(46, 'test1', 64291, '108,109,111,113', 1, 25, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `no_question_type`
--
ALTER TABLE `no_question_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submitted_answers`
--
ALTER TABLE `submitted_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submitted_tests`
--
ALTER TABLE `submitted_tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `no_question_type`
--
ALTER TABLE `no_question_type`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `submitted_answers`
--
ALTER TABLE `submitted_answers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `submitted_tests`
--
ALTER TABLE `submitted_tests`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
