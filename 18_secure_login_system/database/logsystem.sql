-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 11, 2020 at 12:18 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `customer_active`
--

DROP TABLE IF EXISTS `customer_active`;
CREATE TABLE IF NOT EXISTS `customer_active` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_fullname` varchar(55) NOT NULL,
  `user_country` varchar(50) DEFAULT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_authpass` varchar(60) NOT NULL,
  `user_otp` varchar(10) NOT NULL DEFAULT '0',
  `user_address` text,
  `user_state` varchar(55) DEFAULT NULL,
  `user_city` varchar(25) DEFAULT NULL,
  `user_zipcode` varchar(10) DEFAULT NULL,
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
  `fullname` varchar(25) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(60) NOT NULL,
  `otp` varchar(10) DEFAULT NULL,
  `admin_status` tinyint(4) NOT NULL DEFAULT '1',
  `show_announcement` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ot_admin`
--

INSERT INTO `ot_admin` (`id`, `fullname`, `email`, `password`, `otp`, `admin_status`, `show_announcement`) VALUES
(1, 'Master Admin', 'admin@admin.com', '$2y$10$AReba68vvpkX5UdveU8YA.SWlaUSgiPofvzzS.xevaSQQuoN/wZHy', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `send_nonuser_email`
--

DROP TABLE IF EXISTS `send_nonuser_email`;
CREATE TABLE IF NOT EXISTS `send_nonuser_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nonuser_email` varchar(100) NOT NULL,
  `nonuser_subject` varchar(100) NOT NULL,
  `nonuser_email_text` text NOT NULL,
  `nonuser_email_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `send_user_email`
--

DROP TABLE IF EXISTS `send_user_email`;
CREATE TABLE IF NOT EXISTS `send_user_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `email_text` text NOT NULL,
  `email_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
