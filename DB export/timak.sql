-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: localhost:3306
-- Čas generovania: Sun 16.Máj 2021, 20:36
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

--
-- Sťahujem dáta pre tabuľku `answers`
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
(190, 'We~Te~Se~De&Ew~Et~Es~Ed', NULL),
(191, '2', 1),
(192, '6', 0),
(193, '4', 0),
(194, '9', 0),
(195, 'správna odpoveď', 1),
(196, 'správna', 1),
(197, 'nesprávna', 0),
(198, 'nesprávna', 0),
(199, 'nesprávna', 0),
(200, 'm1~m2~m3~m4&o1~o2~o3~o4', NULL),
(201, 'Afrika', 1),
(202, 'Europa', 1),
(203, 'Afrika', 0),
(204, 'Amerika', 0),
(205, 'Azia', 0),
(206, 'aaaa', 1),
(207, 'sdasdasda', 1),
(208, 'adasdas', 1),
(209, 'Slovensko~Bulharsko~Litva~Lotyšsko&Bratislava~Sofia~Vilnius~Riga', NULL),
(210, 'more', 1),
(211, '1~2~3~4&5~6~7~8', NULL),
(212, 'odoved', 1),
(213, 'dsaasd', 1),
(214, 'dsadas', 0),
(215, 'dasdsa', 0),
(216, 'dasdas', 0),
(217, 'dsadsa~dsasd~sdsada~sdasdsa&dsadas~sdasds~sddsda~sdsada', NULL),
(218, 'sú', 1),
(219, 'som', 0),
(220, 'sme', 0),
(221, 'ste', 0),
(222, 'je', 1),
(223, 'sú', 0),
(224, 'si', 0),
(225, 'ste', 0),
(226, 'Kde', 1),
(227, 'Kedy', 0),
(228, 'Ako', 0),
(229, 'Koľko', 0),
(230, 'žltý', 1),
(231, 'modrý', 0),
(232, 'biely', 0),
(233, 'ružový', 0),
(234, 'som', 1),
(235, 'bývam', 0),
(236, 'byť', 0),
(237, 'bývať', 0),
(238, 'Študent.......domácu úlohu~Ja..........30 rokov.~Kde..........moje okuliare?~Cez víkend .........chodiť do školy.&píše~mám~sú~nemusím', NULL),
(239, 'Berlín', 1),
(240, 'Bratislava', 0),
(241, 'Viedeň', 0),
(242, 'Riga', 0),
(243, 'Košice~Frankfurt~Londýn~Nice&Slovensko~Nemecko~Anglicko~Francúzko', NULL),
(244, 'Varsava', 1),
(245, 'Bratislava', 1),
(246, 'Nemecko', 1),
(247, 'Slovensko', 0),
(248, 'Rusko', 0),
(249, 'Francuzsko', 0),
(250, 'Levice~Frankfurt~Nice~Porto&Slovensko~Nemecko~Francuzsko~Portugalsko', NULL),
(251, 'y', 1),
(252, 'i', 0),
(253, 'o', 0),
(254, 'u', 0),
(255, 'y', 1),
(256, 'i', 0),
(257, 'a', 0),
(258, 'o', 0),
(259, 'ano', 1);

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
(1, 'Otvorená odpoveď'),
(2, 'Možnosti'),
(3, 'Párovanie'),
(4, 'Kreslenie'),
(5, 'Matematický výraz');

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

--
-- Sťahujem dáta pre tabuľku `questions`
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
(117, 'Ds', 3, '190', NULL),
(118, 'oznac 2', 2, '191', '192,193,194'),
(119, 'Otázka s otvorenou odpoveďou?', 1, '195', NULL),
(120, 'Otázka s možnosťami', 2, '196', '197,198,199'),
(121, 'Otázka s párovanim', 3, '200', NULL),
(122, 'Kreslim otazku?', 4, NULL, NULL),
(123, 'matematicky vyraz?', 5, NULL, NULL),
(124, 'Afrika', 1, '201', NULL),
(125, 'Europa', 2, '202', '203,204,205'),
(126, 'Otazka', 1, '206', NULL),
(127, 'Otazka', 1, '207', NULL),
(128, 'Otazka', 1, '208', NULL),
(129, 'Hlavné mestá', 3, '209', NULL),
(130, 'Nakresli Afriku', 4, NULL, NULL),
(131, 'Majme pravouhlý trojuholník. Odvesny a,b s preponou c. Napíš vzorec na výpočet obsahu.', 5, NULL, NULL),
(132, 'nakresli pipik', 4, NULL, NULL),
(134, 'idk', 3, '211', NULL),
(136, 'zadam otazku', 1, '212', NULL),
(137, 'otazka kde su moznosti', 2, '213', '214,215,216'),
(138, 'dsadasdas', 3, '217', NULL),
(139, 'kreslim', 4, NULL, NULL),
(140, 'mat', 5, NULL, NULL),
(141, 'Choré deti.......doma.', 2, '218', '219,220,221'),
(142, 'Môj kamarát...........z Grécka.', 2, '222', '223,224,225'),
(143, '.......... študuješ? - Študujem na univerzite v Berlíne.', 2, '226', '227,228,229'),
(144, 'Citrón je .......... .', 2, '230', '231,232,233'),
(145, 'Ja........z Turecka.', 2, '234', '235,236,237'),
(146, 'Utvor správny pár', 3, '238', NULL),
(147, 'Nakresli Slnko', 4, NULL, NULL),
(148, 'Vytvor matematický príklad', 5, NULL, NULL),
(149, 'Hlavne mesto Nemecka', 2, '239', '240,241,242'),
(150, 'Spoj mestá so štátmi kde sa nachádzajú', 3, '243', NULL),
(151, 'Nakresli vlajku Ruska', 4, NULL, NULL),
(152, 'Napíš sinus', 5, NULL, NULL),
(153, 'Hlavne mesto Polska?', 1, '244', NULL),
(154, 'Ake je hlavne mesto Slovenska?', 1, '245', NULL),
(155, 'Ktory stat nema vo vlajke MODRU farbu', 2, '246', '247,248,249'),
(156, 'Prirad mesta k statom', 3, '250', NULL),
(157, 'Nakresli nemecku vlajku', 4, NULL, NULL),
(158, 'napis vzorec pre Pytagorovu vetu', 5, NULL, NULL),
(159, 'Dopln: m_slim', 2, '251', '252,253,254'),
(160, 'Dopln\" velk_ most', 2, '255', '256,257,258'),
(161, 'test', 1, '259', NULL);

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

--
-- Sťahujem dáta pre tabuľku `students`
--

INSERT INTO `students` (`id`, `first_name`, `last_name`, `active`, `test_number`, `test_submit`) VALUES
(37, 'Marek', 'drab', 1, 64291, 0),
(36, 'marek', 'drab', 1, 64291, 0),
(35, 'marek', 'drab', 1, 64291, 0),
(34, 'adasd', 'ass', 1, 64291, 0),
(33, 'Peter', 'Andrejko', 2, 64291, 0),
(32, 'Dominik', 'dd', 2, 64291, 0),
(30, 'Marek', 'koliesko', 3, 64291, 1),
(31, 'marek', 'test', 3, 64291, 1),
(29, 'prvy', 'student', 3, 88637, 1),
(28, 'Marek', 'Drab', 3, 64291, 1),
(49, 'kotvich', 'Drab', 3, 74585, 1),
(40, 'marek', 'drab', 2, 64291, 0),
(50, 'kotvich', 'roman', 3, 74585, 1),
(51, 'marek', 'drab', 3, 73892, 1),
(43, 'kotvich', 'drab', 2, 74585, 0),
(44, 'marek', 'drab', 1, 74585, 0),
(45, 'TEST TEST', 'danko', 2, 74585, 0),
(46, 'adasdadasdas', 'asdasdadsadas', 3, 74585, 1),
(52, 'michal ', 'hamrakaaa', 3, 73892, 1),
(48, 'marek', 'drab', 3, 74585, 1),
(53, 'ds', 'fds', 2, 64291, 0),
(54, 'Peter', 'Andrejko', 2, 64291, 0),
(55, 'Alexandra', 'Tomášová', 3, 73892, 1),
(56, 'dsad', 'dsad', 1, 64291, 0),
(57, 'jhgjhg', 'jhgjhg', 1, 64291, 0),
(58, 'Peter', 'Andrejko', 2, 64291, 0),
(59, 'marek', 'drab', 0, 64291, 0),
(60, 'Peter', 'dd', 1, 64291, 0),
(61, 'Peter', 'koliesko', 1, 64291, 0),
(62, 'marek', 'drab', 1, 64291, 0),
(63, 'marek', 'drab', 1, 64291, 0),
(64, 'Peter', 'Andrejko', 1, 64291, 0),
(65, 'marek', 'drab', 1, 64291, 0),
(66, 'marek', 'drab', 1, 64291, 0),
(67, 'marek', 'drab', 1, 64291, 0),
(68, 'marek', 'drab', 1, 64291, 0),
(69, 'marek', 'drab', 2, 64291, 0),
(70, 'marek', 'drab', 2, 64291, 0),
(71, 'marek', 'drab', 0, 64291, 0),
(72, 'Neviem', 'koliesko', 0, 64291, 0);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `submitted_answers`
--

CREATE TABLE `submitted_answers` (
  `id` int UNSIGNED NOT NULL,
  `is_correct` double NOT NULL,
  `input_answer` varchar(512) CHARACTER SET utf8 COLLATE utf8_slovak_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `submitted_answers`
--

INSERT INTO `submitted_answers` (`id`, `is_correct`, `input_answer`) VALUES
(126, 0, '<br />\r\n<b>Warning</b>:  require_once(inc/Database.php): Failed to open stream: No such file or directory in <b>/home/xdrabm/public_html/final/routes/sendCanva.php</b> on line <b>6</b><br />\r\n<br />\r\n<b>Fatal error</b>:  Uncaught Error: Failed opening required \'inc/Database.php\' (include_path=\'.:/usr/share/php\') in /home/xdrabm/public_html/final/routes/sendCanva.php:6\r\nStack trace:\r\n#0 {main}\r\n  thrown in <b>/home/xdrabm/public_html/final/routes/sendCanva.php</b> on line <b>6</b><br />\r\n'),
(125, 1, 'Porto~Nice~Frankfurt~Levice&Portugalsko~Francuzsko~Nemecko~Slovensko'),
(124, 1, 'Nemecko'),
(123, 1, 'Bratislava'),
(122, 0, 'a\\ co\\ ja\\ znam'),
(121, 0, 'marek_drab2021-May-Sun_18:37:07.png\r\n'),
(120, 0, 'Levice~Frankfurt~Porto~Nice&Nemecko~Portugalsko~Francuzsko~Slovensko'),
(119, 1, 'Nemecko'),
(118, 0, 'Stara Lubovna'),
(117, 0, 'a\\ +\\ b\\ =\\ c'),
(116, 0, 'michal _hamrakaaa2021-May-Sun_18:37:28.png\r\n'),
(115, 0.5, 'Porto~Nice~Frankfurt~Levice&Portugalsko~Nemecko~Francuzsko~Slovensko'),
(114, 0, 'Slovensko'),
(113, 0, 'Kosice'),
(112, 0, ''),
(111, 0, ''),
(109, 0, '2'),
(110, 0, ''),
(108, 0, 'odpoved na test'),
(106, 0, ''),
(107, 0, 'ok'),
(105, 1, 'y'),
(104, 1, 'y'),
(103, 1, 'a\\ +\\ b\\ =\\ c'),
(102, 1, 'michal_hamrak2021-May-Sun_17:52:16.png\r\n'),
(101, 1, 'Nice~Frankfurt~Porto~Levice&Francuzsko~Nemecko~Portugalsko~Slovensko'),
(100, 1, 'Nemecko'),
(99, 1, 'Bratislava'),
(97, 1, '1~22~22~21&2~3~3~2'),
(98, 0, '\\cos\\tan\\subset\\sum_{\\tan}^{ }'),
(96, 0, 'marek_test2021-May-Sun_17:01:37.png\r\n'),
(95, 0, '4'),
(94, 0, '\\tan'),
(93, 0, 'nezadane'),
(92, 0, '0'),
(91, 0, '2'),
(90, 0, ''),
(89, 0, '0'),
(88, 0, '0'),
(87, 0, 'nezadane'),
(86, 0, 'Viedeň'),
(85, 0, '\\sin'),
(84, 0.25, '21&2'),
(83, 0, 'Marek_Drab2021-May-Sun_16:35:38.png\r\n'),
(82, 1, '1'),
(127, 0, '\\left(:\\right)');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `submitted_tests`
--

CREATE TABLE `submitted_tests` (
  `id` int UNSIGNED NOT NULL,
  `test_code` int NOT NULL,
  `student_id` int NOT NULL,
  `submitted_answers_id` varchar(256) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `submitted_tests`
--

INSERT INTO `submitted_tests` (`id`, `test_code`, `student_id`, `submitted_answers_id`) VALUES
(31, 73892, 52, '113,114,115,116,117'),
(30, 74585, 50, '112'),
(29, 74585, 49, '111'),
(28, 74585, 48, '110'),
(27, 74585, 46, '109'),
(26, 74585, 47, '108'),
(25, 74585, 45, '107'),
(24, 74585, 44, '106'),
(23, 23018, 42, '104,105'),
(22, 73892, 41, '99,100,101,102,103'),
(21, 64291, 31, '95,96,97,98'),
(20, 64291, 30, '91,92,93,94'),
(19, 88637, 29, '86,87,88,89,90'),
(18, 64291, 28, '82,83,84,85'),
(32, 73892, 51, '118,119,120,121,122'),
(33, 73892, 55, '123,124,125,126,127');

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
(22, 'Tomas', 'Danko', 'danko.tomas.ts@gmail.com', '$2y$10$a8bxzlNMj05V6JaQ0gfCB.gyMs4atHxKwj9RI1T1F2CMOQRAE85wi', '4WMCZQZYICMQP3B6'),
(24, 'David', 'Gavenda', 'david@gmail.com', '$2y$10$hlFx05uAW6wximhq207HaOun7kNqA2hkFzOQr.JY2WH1u0FdHWXoi', '4CNXL55GMAY3OLF2');

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
(40, 'testpeto', 39840, '132,134', 1, 45, 8),
(46, 'test1', 64291, '108,109,111,113', 1, 25, 6),
(50, 'TD', 85734, '124,125,129,130,131', 1, 20, 22),
(48, 'testpeto', 73649, '118', 1, 25, 8),
(56, 'test casu ', 74585, '161', 1, 1, 6),
(55, 'TestHamrak2', 23018, '159,160', 1, 3, 9),
(54, 'testHamrak', 73892, '154,155,156,157,158', 1, 10, 9);

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `answers`
--
ALTER TABLE `answers`
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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;

--
-- AUTO_INCREMENT pre tabuľku `no_question_type`
--
ALTER TABLE `no_question_type`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pre tabuľku `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT pre tabuľku `students`
--
ALTER TABLE `students`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT pre tabuľku `submitted_answers`
--
ALTER TABLE `submitted_answers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT pre tabuľku `submitted_tests`
--
ALTER TABLE `submitted_tests`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pre tabuľku `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pre tabuľku `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
