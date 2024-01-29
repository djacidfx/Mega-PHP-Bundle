-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2022 at 06:33 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;



-- --------------------------------------------------------

--
-- Table structure for table `ot_admin`
--

CREATE TABLE `ot_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ot_admin`
--

INSERT INTO `ot_admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$dtllVJZBMzAsbt608Vs1sOyi8DCAL4pzqZM/6oZEXoXg6BHOIpale');

-- --------------------------------------------------------

--
-- Table structure for table `ot_blocked_ip`
--

CREATE TABLE `ot_blocked_ip` (
  `blocked_ip` int(11) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `block_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ot_notes`
--

CREATE TABLE `ot_notes` (
  `note_id` int(11) NOT NULL,
  `note_unique_id` varchar(255) NOT NULL,
  `note_password` varchar(60) DEFAULT NULL,
  `note` longtext NOT NULL,
  `note_status` tinyint(1) NOT NULL DEFAULT 0,
  `user_ip` varchar(100) NOT NULL,
  `note_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ot_admin`
--
ALTER TABLE `ot_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ot_blocked_ip`
--
ALTER TABLE `ot_blocked_ip`
  ADD PRIMARY KEY (`blocked_ip`);

--
-- Indexes for table `ot_notes`
--
ALTER TABLE `ot_notes`
  ADD PRIMARY KEY (`note_id`),
  ADD UNIQUE KEY `note_unique_id` (`note_unique_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ot_admin`
--
ALTER TABLE `ot_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ot_blocked_ip`
--
ALTER TABLE `ot_blocked_ip`
  MODIFY `blocked_ip` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_notes`
--
ALTER TABLE `ot_notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
