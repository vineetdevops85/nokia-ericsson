-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2024 at 09:39 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `external_alarm_master`
--

-- --------------------------------------------------------

--
-- Table structure for table `master_alarm`
--

CREATE TABLE `master_alarm` (
  `port` int(11) NOT NULL,
  `slogan` varchar(255) NOT NULL,
  `severity` varchar(255) NOT NULL,
  `normallyopen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_alarm`
--

INSERT INTO `master_alarm` (`port`, `slogan`, `severity`, `normallyopen`) VALUES
(1, 'RBS INTRUSION', 'MAJOR', 'false'),
(2, 'RBS CLIMATE FAIL', 'CRITICAL', 'false'),
(3, 'RBS HEX FAN FAIL', 'CRITICAL', 'false'),
(4, 'RBS EQPT TEMP HIGH', 'CRITICAL', 'false'),
(5, 'RBS EQPT TEMP LOW', 'CRITICAL', 'false');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_alarm`
--
ALTER TABLE `master_alarm`
  ADD PRIMARY KEY (`port`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `master_alarm`
--
ALTER TABLE `master_alarm`
  MODIFY `port` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
