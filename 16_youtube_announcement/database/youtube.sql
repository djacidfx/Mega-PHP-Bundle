-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 26, 2020 at 12:35 PM
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
  `youtube_id` varchar(25) DEFAULT NULL,
  `youtube_url` varchar(255) DEFAULT NULL,
  `announcement_date` date NOT NULL,
  `like_count` int(11) NOT NULL DEFAULT '0',
  `announcement_status` tinyint(1) NOT NULL DEFAULT '1',
  `comment_active` tinyint(1) NOT NULL DEFAULT '1',
  `pinned` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`announcement_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `announcement_like`
--

DROP TABLE IF EXISTS `announcement_like`;
CREATE TABLE IF NOT EXISTS `announcement_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `announce_id` int(11) NOT NULL,
  `user_ip` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `announcement_limit`
--

DROP TABLE IF EXISTS `announcement_limit`;
CREATE TABLE IF NOT EXISTS `announcement_limit` (
  `id` int(11) NOT NULL,
  `start_lim` int(11) NOT NULL DEFAULT '4',
  `load_lim` int(11) NOT NULL DEFAULT '4',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcement_limit`
--

INSERT INTO `announcement_limit` (`id`, `start_lim`, `load_lim`) VALUES
(1, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `announceID` int(11) NOT NULL,
  `announceText` text NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `useremail` varchar(50) NOT NULL,
  `comment_text` text NOT NULL,
  `admin_reply` text,
  `comment_date` date NOT NULL,
  `comment_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_admin`
--

DROP TABLE IF EXISTS `ot_admin`;
CREATE TABLE IF NOT EXISTS `ot_admin` (
  `id` int(11) NOT NULL,
  `admin_email` varchar(60) NOT NULL,
  `auth_pass` varchar(60) NOT NULL,
  `otp` varchar(10) DEFAULT NULL,
  `alignment` varchar(10) NOT NULL DEFAULT '0',
  `rec_email` varchar(100) DEFAULT NULL,
  `email_subscriber` tinyint(1) NOT NULL DEFAULT '0',
  `email_comment` tinyint(1) NOT NULL DEFAULT '0',
  `rec_email_comment` tinyint(1) NOT NULL DEFAULT '0',
  `dark_mode` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ot_admin`
--

INSERT INTO `ot_admin` (`id`, `admin_email`, `auth_pass`, `otp`, `alignment`, `rec_email`, `email_subscriber`, `email_comment`, `rec_email_comment`, `dark_mode`) VALUES
(1, 'admin@admin.com', '$2y$10$dtllVJZBMzAsbt608Vs1sOyi8DCAL4pzqZM/6oZEXoXg6BHOIpale', NULL, '0', NULL, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subscriber`
--

DROP TABLE IF EXISTS `tbl_subscriber`;
CREATE TABLE IF NOT EXISTS `tbl_subscriber` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subscriber_email` varchar(255) NOT NULL,
  `subscriber_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
