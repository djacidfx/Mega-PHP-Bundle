-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2022 at 10:40 AM
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
-- Table structure for table `ot_auth`
--

CREATE TABLE `ot_auth` (
  `auth_id` int(11) NOT NULL,
  `auth` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ot_auth`
--

INSERT INTO `ot_auth` (`auth_id`, `auth`) VALUES
(1, '$2y$10$JioJuDLu2tfeMUQs0tZJL.4u64h9MnFu4IlX5USsAse7pqidUkcyy');

-- --------------------------------------------------------

--
-- Table structure for table `ot_blocked_ip`
--

CREATE TABLE `ot_blocked_ip` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `chance` tinyint(1) NOT NULL DEFAULT 3,
  `blocked` tinyint(1) NOT NULL DEFAULT 0,
  `ip_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ot_sites`
--

CREATE TABLE `ot_sites` (
  `site_id` int(11) NOT NULL,
  `site_title` varchar(50) NOT NULL,
  `site_url` varchar(255) NOT NULL,
  `user_ip` varchar(50) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `site_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ot_auth`
--
ALTER TABLE `ot_auth`
  ADD PRIMARY KEY (`auth_id`);

--
-- Indexes for table `ot_blocked_ip`
--
ALTER TABLE `ot_blocked_ip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ot_sites`
--
ALTER TABLE `ot_sites`
  ADD PRIMARY KEY (`site_id`),
  ADD UNIQUE KEY `site_url` (`site_url`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ot_auth`
--
ALTER TABLE `ot_auth`
  MODIFY `auth_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ot_blocked_ip`
--
ALTER TABLE `ot_blocked_ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_sites`
--
ALTER TABLE `ot_sites`
  MODIFY `site_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
