-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 18, 2021 at 11:22 AM
-- Server version: 5.7.28
-- PHP Version: 7.4.0

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
-- Table structure for table `ot_admin`
--

DROP TABLE IF EXISTS `ot_admin`;
CREATE TABLE IF NOT EXISTS `ot_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adm_email` varchar(50) NOT NULL,
  `adm_password` varchar(60) NOT NULL,
  `adm_name` varchar(50) NOT NULL,
  `love_msg` varchar(100) NOT NULL,
  `block_msg` varchar(250) NOT NULL,
  `ga_code` text,
  `user_on` tinyint(1) NOT NULL DEFAULT '0',
  `admin_on` tinyint(1) NOT NULL DEFAULT '0',
  `about_us` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ot_admin`
--

INSERT INTO `ot_admin` (`id`, `adm_email`, `adm_password`, `adm_name`, `love_msg`, `block_msg`, `ga_code`, `user_on`, `admin_on`, `about_us`) VALUES
(1, 'admin@admin.com', '$2y$10$dtllVJZBMzAsbt608Vs1sOyi8DCAL4pzqZM/6oZEXoXg6BHOIpale', 'CodeDaddy', 'It seems, You&#39;ve already loved this secret.', 'We&#39;ve seen, You are not a Human !\r\nThis website is not for you.', NULL, 0, 0, 'SGVyZSB5b3UgY2FuIHBvc3QgYW55dGhpbmcuIFlvdSBjYW4gcG9zdCB0byBwcm9tb3RlIHRoZSB3ZWJzaXRlIG9yIG90aGVycyB3aXRob3V0IGxpbWl0YXRpb24uIA0KV2UgcHJvbW90ZSB0aGlzIHdlYnNpdGUgaW4gbWFueSBwbGFjZXMuIE1vcmUgYW5kIG1vcmUgcGVvcGxlIHdpbGwgc2VlIHlvdXIgcG9zdHMgZXZlcnkgZGF5Lg==');

-- --------------------------------------------------------

--
-- Table structure for table `ot_ads`
--

DROP TABLE IF EXISTS `ot_ads`;
CREATE TABLE IF NOT EXISTS `ot_ads` (
  `ad_id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_name` varchar(50) NOT NULL,
  `ad_code` longtext NOT NULL,
  `ad_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ad_id`),
  UNIQUE KEY `ad_name` (`ad_name`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ot_ads`
--

INSERT INTO `ot_ads` (`ad_id`, `ad_name`, `ad_code`, `ad_status`) VALUES
(1, 'header_970_90', '', 0),
(2, 'header_320_100', '', 0),
(3, 'desktopfeatured300_one', '', 0),
(4, 'desktopfeatured300_two', '', 0),
(5, 'desktoptrending300_one', '', 0),
(6, 'desktoptrending300_two', '', 0),
(7, 'mobilefeatured300_one', '', 0),
(8, 'mobiletrending300_one', '', 0),
(9, 'sidebar600', '', 0),
(10, 'sidebar300', '', 0),
(11, 'commonfeatured300', '', 0),
(12, 'commontrending300', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ot_comments`
--

DROP TABLE IF EXISTS `ot_comments`;
CREATE TABLE IF NOT EXISTS `ot_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  `c_user_ip` varchar(100) NOT NULL,
  `admin_reply` longtext,
  `comment_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_seen` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_ip_blocked`
--

DROP TABLE IF EXISTS `ot_ip_blocked`;
CREATE TABLE IF NOT EXISTS `ot_ip_blocked` (
  `ip_id` int(11) NOT NULL AUTO_INCREMENT,
  `blocked_ip` varchar(100) NOT NULL,
  `block_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ip_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_loader`
--

DROP TABLE IF EXISTS `ot_loader`;
CREATE TABLE IF NOT EXISTS `ot_loader` (
  `loader_id` int(11) NOT NULL AUTO_INCREMENT,
  `loading` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`loader_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ot_loader`
--

INSERT INTO `ot_loader` (`loader_id`, `loading`) VALUES
(1, 4),
(2, 4),
(3, 4),
(4, 4),
(5, 4),
(6, 4),
(7, 4),
(8, 4),
(9, 4);

-- --------------------------------------------------------

--
-- Table structure for table `ot_secrets`
--

DROP TABLE IF EXISTS `ot_secrets`;
CREATE TABLE IF NOT EXISTS `ot_secrets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `trending` tinyint(1) NOT NULL DEFAULT '0',
  `loves` int(11) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  `user_ip` varchar(100) NOT NULL,
  `secret_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `admin_seen` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_secret_love`
--

DROP TABLE IF EXISTS `ot_secret_love`;
CREATE TABLE IF NOT EXISTS `ot_secret_love` (
  `love_id` int(11) NOT NULL AUTO_INCREMENT,
  `love_post_id` int(11) NOT NULL,
  `love_user_ip` varchar(100) NOT NULL,
  `love_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`love_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
