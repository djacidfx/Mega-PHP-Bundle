-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 01, 2020 at 10:02 AM
-- Server version: 5.7.28
-- PHP Version: 7.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- --------------------------------------------------------

--
-- Table structure for table `customer_active`
--

DROP TABLE IF EXISTS `customer_active`;
CREATE TABLE IF NOT EXISTS `customer_active` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_fullname` varchar(55) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_authpass` varchar(60) NOT NULL,
  `user_otp` varchar(10) NOT NULL DEFAULT '0',
  `active_status` tinyint(1) NOT NULL DEFAULT '1',
  `user_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_tmp_email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_tmp`
--

DROP TABLE IF EXISTS `customer_tmp`;
CREATE TABLE IF NOT EXISTS `customer_tmp` (
  `tmp_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_fullname` varchar(55) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_authpass` varchar(60) NOT NULL,
  `user_otp` varchar(10) NOT NULL,
  `user_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tmp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_admin`
--

DROP TABLE IF EXISTS `ot_admin`;
CREATE TABLE IF NOT EXISTS `ot_admin` (
  `id` int(11) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(60) NOT NULL,
  `admin_status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ot_admin`
--

INSERT INTO `ot_admin` (`id`, `email`, `password`, `admin_status`) VALUES
(1, 'admin@admin.com', '$2y$10$AReba68vvpkX5UdveU8YA.SWlaUSgiPofvzzS.xevaSQQuoN/wZHy', 1);

-- --------------------------------------------------------

--
-- Table structure for table `send_message`
--

DROP TABLE IF EXISTS `send_message`;
CREATE TABLE IF NOT EXISTS `send_message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `message_ticket_id` int(11) NOT NULL,
  `admin_message` text NOT NULL,
  `message_date` date NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_subject`
--

DROP TABLE IF EXISTS `ticket_subject`;
CREATE TABLE IF NOT EXISTS `ticket_subject` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(100) DEFAULT NULL,
  `subject_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`subject_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_system`
--

DROP TABLE IF EXISTS `ticket_system`;
CREATE TABLE IF NOT EXISTS `ticket_system` (
  `ticket_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_subject` varchar(100) NOT NULL,
  `ticket_email` varchar(55) NOT NULL,
  `ticket_body` text NOT NULL,
  `ticket_name` varchar(55) NOT NULL,
  `ticket_status` tinyint(1) NOT NULL DEFAULT '0',
  `ticket_date` date NOT NULL,
  PRIMARY KEY (`ticket_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
