-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: localhost:3306
-- Čas generovania: So 15.Máj 2021, 08:21
-- Verzia serveru: 8.0.23-0ubuntu0.20.04.1
-- Verzia PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `timak`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `answers`
--

CREATE TABLE `answers` (
  `id` int UNSIGNED NOT NULL,
  `answer` varchar(512) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `is_correct` tinyint DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `canvas`
--

CREATE TABLE `canvas` (
  `id` bigint NOT NULL,
  `id_studenta` int NOT NULL,
  `id_testu` int NOT NULL,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `body` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `canvas`
--

INSERT INTO `canvas` (`id`, `id_studenta`, `id_testu`, `name`, `body`) VALUES
(6, 1, 1, '232142021-May-Fri_13:41:57', NULL),
(7, 1, 1, 'tomas2021-May-Fri_15:33:17', NULL),
(8, 1, 1, '2021-May-Fri_15:50:05', NULL);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `latex`
--

CREATE TABLE `latex` (
  `id` int NOT NULL,
  `id_studenta` int NOT NULL,
  `id_testu` int NOT NULL,
  `value` varchar(512) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `body` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `no_question_type`
--

CREATE TABLE `no_question_type` (
  `id` int UNSIGNED NOT NULL,
  `type` varchar(64) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `no_question_type`
--

INSERT INTO `no_question_type` (`id`, `type`) VALUES
(1, 'otvorená odpoveď'),
(2, 'možnosti'),
(3, 'párovanie'),
(4, 'kreslenie'),
(5, 'matematický výraz');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `questions`
--

CREATE TABLE `questions` (
  `id` int UNSIGNED NOT NULL,
  `question` varchar(512) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `type_id` int NOT NULL,
  `correct_answer_id` varchar(512) CHARACTER SET utf8 COLLATE utf8_slovak_ci DEFAULT NULL,
  `all_answers_id` varchar(512) CHARACTER SET utf8 COLLATE utf8_slovak_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `students`
--

CREATE TABLE `students` (
  `id` int UNSIGNED NOT NULL,
  `first_name` varchar(512) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `last_name` varchar(512) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `active` tinyint NOT NULL,
  `test_number` int NOT NULL,
  `test_submit` tinyint NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `submitted_answers`
--

CREATE TABLE `submitted_answers` (
  `id` int UNSIGNED NOT NULL,
  `is_correct` tinyint NOT NULL,
  `answer_id` int NOT NULL,
  `input_answer` varchar(512) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `submitted_tests`
--

CREATE TABLE `submitted_tests` (
  `id` int UNSIGNED NOT NULL,
  `test_id` int NOT NULL,
  `student_id` int NOT NULL,
  `submitted_answers_id` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `teachers`
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
-- Sťahujem dáta pre tabuľku `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `surname`, `email`, `password`, `secret`) VALUES
(6, 'Marek', 'Drab', 'marek.drablp@gmail.com', '$2y$10$Dd6MsXfyNxe39D.uBZVr8e2YQitWSfjzEfMxCivj13KmGZsppi3vW', 'DYG2UCL4I4TG3MIO'),
(8, 'peter', 'najlepšie', 'peter@mail.to', '$2y$10$MK4yZfkxFyejRQgFnPqF1OCpdHErM4VkF0S9K6uS42MH6cUboUtn6', 'VPCSLW24E6BATNUQ'),
(9, 'Michal', 'Hamrák', 'xhamrak@stuba.sk', '$2y$10$ZvOjbDWkgKx/FvgoMXjjHeGc.m2fLvYITj7/f98b2/ZRrgjTZb1lK', 'PYDGKGAL5NYXAJ3K'),
(15, 'David', 'Gavenda', 'piskot@gmail.com', '$2y$10$l5KfbjaPyCvyl93uXQPyoOJsroO9gclJT5BC8imevfN91IZQbpCGm', '62ABJTLP4DFTIWGF'),
(22, 'Tomas', 'Danko', 'danko.tomas.ts@gmail.com', '$2y$10$a8bxzlNMj05V6JaQ0gfCB.gyMs4atHxKwj9RI1T1F2CMOQRAE85wi', '4WMCZQZYICMQP3B6');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `tests`
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
-- Sťahujem dáta pre tabuľku `tests`
--

INSERT INTO `tests` (`id`, `name`, `code`, `question_id`, `is_active`, `time_limit`, `teacher_id`) VALUES
(37, 'nevidite ma', 99274, '', 0, 25, 6);

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `canvas`
--
ALTER TABLE `canvas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexy pre tabuľku `latex`
--
ALTER TABLE `latex`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `no_question_type`
--
ALTER TABLE `no_question_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `submitted_answers`
--
ALTER TABLE `submitted_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `submitted_tests`
--
ALTER TABLE `submitted_tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexy pre tabuľku `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT pre tabuľku `canvas`
--
ALTER TABLE `canvas`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pre tabuľku `latex`
--
ALTER TABLE `latex`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pre tabuľku `no_question_type`
--
ALTER TABLE `no_question_type`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pre tabuľku `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT pre tabuľku `students`
--
ALTER TABLE `students`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pre tabuľku `submitted_answers`
--
ALTER TABLE `submitted_answers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `submitted_tests`
--
ALTER TABLE `submitted_tests`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pre tabuľku `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
