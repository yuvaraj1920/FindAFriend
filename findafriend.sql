-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2023 at 12:01 PM
-- Server version: 8.0.29
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `findafriend`
--

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `username` varchar(20) NOT NULL,
  `start_location` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `destination_location` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `interest1` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `interest2` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `startDate` varchar(10) DEFAULT NULL,
  `endDate` varchar(10) DEFAULT NULL,
  `budget` int DEFAULT NULL,
  `location` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`username`, `start_location`, `destination_location`, `interest1`, `interest2`, `startDate`, `endDate`, `budget`, `location`) VALUES
('ganesh', 'guntur', 'vizag', '', '', '', '', 25500, ''),
('nikhil2701', 'guntur', 'vijayawada', '', '', '', '', 25500, ''),
('teja7012', 'guntur', 'vijayawada', '', '', '', '', 25500, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`) VALUES
('ganesh', 'ganesh123'),
('nikhil2701', 'nikhil2701'),
('teja7012', 'teja7012');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `username` varchar(20) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `phonenumer` varchar(15) NOT NULL,
  `government_id` varchar(30) NOT NULL,
  `location` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`username`, `firstname`, `lastname`, `mail`, `phonenumer`, `government_id`, `location`) VALUES
('ganesh', 'Patakamuri', 'Venkataganesh', 'ganesh.20mis7081@vitap.ac.in', '9705998050', '710216134155', 'Amaravathi'),
('nikhil2701', 'nikhil', 'sai', 'ganesh@gmail.com', '9705998050', '123456675', 'Guntur, India'),
('teja7012', 'teja', 'mahesh', 'ganesh@gmail.com', '9705998050', '12334454522442', 'Amaravathi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
