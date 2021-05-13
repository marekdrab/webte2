-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 13, 2021 at 07:47 PM
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
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `canvas`
--

CREATE TABLE `canvas` (
  `id` bigint NOT NULL,
  `id_studenta` int NOT NULL,
  `id_testu` int NOT NULL,
  `name` varchar(128) COLLATE utf8_slovak_ci NOT NULL,
  `body` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `canvas`
--

INSERT INTO `canvas` (`id`, `id_studenta`, `id_testu`, `name`, `body`) VALUES
(2, 1, 1, 'lala2021-May-Wed_12:06:08', NULL),
(3, 1, 1, '2021-May-Thu_17:00:16', NULL),
(4, 1, 1, 'ofoakjfdoij2021-May-Thu_19:04:02', NULL),
(5, 1, 1, 'tomas2021-May-Thu_19:19:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `latex`
--

CREATE TABLE `latex` (
  `id` int NOT NULL,
  `id_studenta` int NOT NULL,
  `id_testu` int NOT NULL,
  `value` varchar(512) COLLATE utf8_slovak_ci NOT NULL,
  `body` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `latex`
--

INSERT INTO `latex` (`id`, `id_studenta`, `id_testu`, `value`, `body`) VALUES
(1, 1, 1, '\\sqrt{2}', NULL),
(2, 1, 1, '\\sqrt{2}', NULL),
(3, 1, 1, '\\sqrt{2\\sin23}', NULL),
(4, 1, 1, '\\int_2^{45}23', NULL),
(5, 1, 1, '\\sqrt{\\sin5}+\\int_{12}^{22}2', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `canvas`
--
ALTER TABLE `canvas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `latex`
--
ALTER TABLE `latex`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `canvas`
--
ALTER TABLE `canvas`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `latex`
--
ALTER TABLE `latex`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
