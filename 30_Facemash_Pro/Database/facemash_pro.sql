-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 09, 2021 at 10:06 PM
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
  `id` int(11) NOT NULL,
  `adm_email` varchar(100) NOT NULL,
  `adm_name` varchar(55) DEFAULT NULL,
  `adm_password` varchar(60) NOT NULL,
  `otp` int(4) DEFAULT NULL,
  `about_us_name` varchar(25) NOT NULL DEFAULT 'About Us',
  `about_us_info` varchar(255) NOT NULL DEFAULT 'Lorem Ipsum Some Text Here !!!',
  `copyright_name` varchar(50) NOT NULL DEFAULT 'Company Name',
  `link_name` varchar(20) NOT NULL DEFAULT 'Quick Links',
  `default_load` int(11) NOT NULL DEFAULT '6',
  `on_load` int(11) NOT NULL DEFAULT '6',
  `fb_url` varchar(555) DEFAULT NULL,
  `insta_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(555) DEFAULT NULL,
  `linkedin_url` varchar(555) DEFAULT NULL,
  `behance_url` varchar(555) DEFAULT NULL,
  `dribble_url` varchar(555) DEFAULT NULL,
  `vk_url` varchar(555) DEFAULT NULL,
  `g_code` text,
  `admin_on` tinyint(1) NOT NULL DEFAULT '0',
  `user_on` tinyint(1) NOT NULL DEFAULT '0',
  `header_color` varchar(10) NOT NULL DEFAULT '#1DA1F2',
  `footer_color` varchar(10) NOT NULL DEFAULT '#000000',
  `footer_text_color` varchar(10) NOT NULL DEFAULT '#FFFFFF',
  `ad_code` text NOT NULL,
  `ad_on` tinyint(1) NOT NULL DEFAULT '0',
  `points` int(11) NOT NULL DEFAULT '1',
  `homepage_tagline` varchar(50) NOT NULL DEFAULT 'Who''s the Hottest ?',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ot_admin`
--

INSERT INTO `ot_admin` (`id`, `adm_email`, `adm_name`, `adm_password`, `otp`, `about_us_name`, `about_us_info`, `copyright_name`, `link_name`, `default_load`, `on_load`, `fb_url`, `insta_url`, `twitter_url`, `linkedin_url`, `behance_url`, `dribble_url`, `vk_url`, `g_code`, `admin_on`, `user_on`, `header_color`, `footer_color`, `footer_text_color`, `ad_code`, `ad_on`, `points`, `homepage_tagline`) VALUES
(1, 'admin@admin.com', 'CodeDaddy', '$2y$10$dtllVJZBMzAsbt608Vs1sOyi8DCAL4pzqZM/6oZEXoXg6BHOIpale', NULL, 'About Us', 'CodeDaddy is a Freelance Group of PHP Developers. Our Highest Priority is Customer Satisfaction.', 'CodeDaddy Company', 'Quick Link', 6, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '#4267B2', '#000000', '#FFFFFF', '', 1, 1, 'Who&#39;s the Hottest ?');

-- --------------------------------------------------------

--
-- Table structure for table `ot_admin_pages`
--

DROP TABLE IF EXISTS `ot_admin_pages`;
CREATE TABLE IF NOT EXISTS `ot_admin_pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(25) NOT NULL,
  `page_slug` varchar(25) NOT NULL,
  `page_text` text NOT NULL,
  `page_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`page_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_admin_pics`
--

DROP TABLE IF EXISTS `ot_admin_pics`;
CREATE TABLE IF NOT EXISTS `ot_admin_pics` (
  `pic_id` int(11) NOT NULL AUTO_INCREMENT,
  `pic_caption` varchar(20) NOT NULL,
  `pic_vote` int(11) NOT NULL DEFAULT '0',
  `pic_wins` int(11) NOT NULL DEFAULT '0',
  `pic_status` tinyint(1) NOT NULL DEFAULT '0',
  `pic_date` date NOT NULL,
  `pic_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
