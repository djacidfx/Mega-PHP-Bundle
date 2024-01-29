-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 20, 2020 at 06:51 AM
-- Server version: 5.7.29
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `twofactoremail`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_active`
--

CREATE TABLE `customer_active` (
  `user_id` int(11) NOT NULL,
  `user_fullname` varchar(55) NOT NULL,
  `user_country` varchar(50) DEFAULT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_authpass` varchar(60) NOT NULL,
  `user_otp` varchar(10) NOT NULL DEFAULT '0',
  `user_address` text NOT NULL,
  `user_state` varchar(55) NOT NULL,
  `user_city` varchar(25) NOT NULL,
  `user_zipcode` varchar(10) NOT NULL,
  `active_status` tinyint(1) NOT NULL,
  `user_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_tmp_email` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_tmp`
--

CREATE TABLE `customer_tmp` (
  `tmp_id` int(11) NOT NULL,
  `user_fullname` varchar(55) NOT NULL,
  `user_countrycode` varchar(10) DEFAULT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_authpass` varchar(60) NOT NULL,
  `user_otp` varchar(10) NOT NULL,
  `user_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_admin`
--

CREATE TABLE `ot_admin` (
  `id` int(11) NOT NULL,
  `fullname` varchar(25) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(60) NOT NULL,
  `admin_status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ot_admin`
--

INSERT INTO `ot_admin` (`id`, `fullname`, `email`, `password`, `admin_status`) VALUES
(1, 'Master Admin', 'no-reply@yupok.com', '$2y$10$YZbf2uDifZoEIk35JfyyKeBw7ZaGe.rYnkUmRs8vOPzfvVrzKs1D.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_announcement_read`
--

DROP TABLE IF EXISTS `user_announcement_read`;
CREATE TABLE IF NOT EXISTS `user_announcement_read` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `read_announcement` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin_announcement`
--

DROP TABLE IF EXISTS `admin_announcement`;
CREATE TABLE IF NOT EXISTS `admin_announcement` (
  `announcement_id` int(11) NOT NULL AUTO_INCREMENT,
  `announcement_text` text NOT NULL,
  `announcement_date` date NOT NULL,
  `announcement_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`announcement_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table structure for table `show_announce`
--

CREATE TABLE `show_announce` (
  `show_announcement_id` int(11) NOT NULL,
  `show_announcement` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `show_announce`
--

INSERT INTO `show_announce` (`show_announcement_id`, `show_announcement`) VALUES
(1, 1);


--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_active`
--
ALTER TABLE `customer_active`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `customer_tmp`
--
ALTER TABLE `customer_tmp`
  ADD PRIMARY KEY (`tmp_id`);

--
-- Indexes for table `ot_admin`
--
ALTER TABLE `ot_admin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_active`
--
ALTER TABLE `customer_active`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_tmp`
--
ALTER TABLE `customer_tmp`
  MODIFY `tmp_id` int(11) NOT NULL AUTO_INCREMENT;
  
ALTER TABLE `show_announce`
  ADD PRIMARY KEY (`show_announcement_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
