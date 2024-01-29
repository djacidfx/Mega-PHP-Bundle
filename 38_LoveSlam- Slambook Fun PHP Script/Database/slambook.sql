-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 26, 2021 at 11:09 AM
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
  `block_msg` varchar(250) DEFAULT NULL,
  `ga_code` text,
  `user_on` tinyint(1) NOT NULL DEFAULT '0',
  `admin_on` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ot_admin`
--

INSERT INTO `ot_admin` (`id`, `adm_email`, `adm_password`, `adm_name`, `block_msg`, `ga_code`, `user_on`, `admin_on`) VALUES
(1, 'admin@admin.com', '$2y$10$dtllVJZBMzAsbt608Vs1sOyi8DCAL4pzqZM/6oZEXoXg6BHOIpale', 'CodeDaddy', 'We&#39;ve seen you are not behaving like Human !\r\nGo away from here !!!', 'PCEtLSBHbG9iYWwgc2l0ZSB0YWcgKGd0YWcuanMpIC0gR29vZ2xlIEFuYWx5dGljcyAtLT4NCjxzY3JpcHQgYXN5bmMgc3JjPSJodHRwczovL3d3dy5nb29nbGV0YWdtYW5hZ2VyLmNvbS9ndGFnL2pzP2lkPVVBLTcyMTM5MjU3LTEiPjwvc2NyaXB0Pg0KPHNjcmlwdD4NCiAgd2luZG93LmRhdGFMYXllciA9IHdpbmRvdy5kYXRhTGF5ZXIgfHwgW107DQogIGZ1bmN0aW9uIGd0YWcoKXtkYXRhTGF5ZXIucHVzaChhcmd1bWVudHMpO30NCiAgZ3RhZygnanMnLCBuZXcgRGF0ZSgpKTsNCg0KICBndGFnKCdjb25maWcnLCAnVUEtNzIxMzkyNTctMScpOw0KPC9zY3JpcHQ+', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ot_ads`
--

DROP TABLE IF EXISTS `ot_ads`;
CREATE TABLE IF NOT EXISTS `ot_ads` (
  `ad_id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_name` varchar(50) NOT NULL,
  `ad_code` text NOT NULL,
  `ad_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ad_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ot_ads`
--

INSERT INTO `ot_ads` (`ad_id`, `ad_name`, `ad_code`, `ad_status`) VALUES
(1, 'header468', '', 0),
(2, 'header320', '', 0),
(3, 'sidebar600', '', 0),
(4, 'sidebar600left', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ot_all_answers`
--

DROP TABLE IF EXISTS `ot_all_answers`;
CREATE TABLE IF NOT EXISTS `ot_all_answers` (
  `all_id` int(11) NOT NULL AUTO_INCREMENT,
  `all_answer_id` int(11) NOT NULL,
  `all_slambook_id` int(11) NOT NULL,
  `all_quest_id` int(11) NOT NULL,
  `all_answer` varchar(100) NOT NULL,
  PRIMARY KEY (`all_id`)
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
-- Table structure for table `ot_questions`
--

DROP TABLE IF EXISTS `ot_questions`;
CREATE TABLE IF NOT EXISTS `ot_questions` (
  `quest_id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `question_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`quest_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_slambook`
--

DROP TABLE IF EXISTS `ot_slambook`;
CREATE TABLE IF NOT EXISTS `ot_slambook` (
  `slambook_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `user_ip` varchar(100) NOT NULL,
  `slambook_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`slambook_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_slambook_answers`
--

DROP TABLE IF EXISTS `ot_slambook_answers`;
CREATE TABLE IF NOT EXISTS `ot_slambook_answers` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `ans_user_ip` varchar(100) NOT NULL,
  `ans_slambook_id` int(11) NOT NULL,
  `ans_username` varchar(20) NOT NULL,
  `slamanswer_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`answer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_slambook_quest`
--

DROP TABLE IF EXISTS `ot_slambook_quest`;
CREATE TABLE IF NOT EXISTS `ot_slambook_quest` (
  `sb_quest_id` int(11) NOT NULL AUTO_INCREMENT,
  `sb_slambook_id` int(11) NOT NULL,
  `sb_questions` varchar(100) NOT NULL,
  PRIMARY KEY (`sb_quest_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
