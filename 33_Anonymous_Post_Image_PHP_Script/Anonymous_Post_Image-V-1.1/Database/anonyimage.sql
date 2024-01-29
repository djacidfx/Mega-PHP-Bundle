-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 21, 2021 at 02:06 AM
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
-- Table structure for table `anony_category`
--

DROP TABLE IF EXISTS `anony_category`;
CREATE TABLE IF NOT EXISTS `anony_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(30) NOT NULL,
  `category_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `anony_like`
--

DROP TABLE IF EXISTS `anony_like`;
CREATE TABLE IF NOT EXISTS `anony_like` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `like_ip` varchar(255) NOT NULL,
  `like_post_id` int(11) NOT NULL,
  PRIMARY KEY (`like_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `anony_love`
--

DROP TABLE IF EXISTS `anony_love`;
CREATE TABLE IF NOT EXISTS `anony_love` (
  `love_id` int(11) NOT NULL AUTO_INCREMENT,
  `love_ip` varchar(255) NOT NULL,
  `love_post_id` int(11) NOT NULL,
  PRIMARY KEY (`love_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `anony_post`
--

DROP TABLE IF EXISTS `anony_post`;
CREATE TABLE IF NOT EXISTS `anony_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_type` tinyint(1) NOT NULL DEFAULT '0',
  `cat_id` int(11) NOT NULL,
  `post_title` varchar(50) NOT NULL,
  `post_image` varchar(100) NOT NULL,
  `post_description` longtext,
  `post_date` date NOT NULL,
  `post_status` tinyint(1) NOT NULL DEFAULT '0',
  `post_featured` tinyint(1) NOT NULL DEFAULT '0',
  `post_view` int(11) NOT NULL DEFAULT '0',
  `post_like` int(11) NOT NULL DEFAULT '0',
  `post_love` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_title` (`post_title`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `mainfile_email` tinyint(1) NOT NULL DEFAULT '0',
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
  `auto_approve` tinyint(1) NOT NULL DEFAULT '1',
  `already_liked` varchar(255) DEFAULT NULL,
  `already_loved` varchar(255) DEFAULT NULL,
  `approve_message` varchar(255) DEFAULT NULL,
  `title_limit` int(11) NOT NULL DEFAULT '50',
  `description_limit` int(11) NOT NULL DEFAULT '300',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ot_admin`
--

INSERT INTO `ot_admin` (`id`, `adm_email`, `adm_name`, `adm_password`, `otp`, `about_us_name`, `about_us_info`, `copyright_name`, `mainfile_email`, `link_name`, `default_load`, `on_load`, `fb_url`, `insta_url`, `twitter_url`, `linkedin_url`, `behance_url`, `dribble_url`, `vk_url`, `g_code`, `admin_on`, `user_on`, `header_color`, `footer_color`, `footer_text_color`, `ad_code`, `ad_on`, `auto_approve`, `already_liked`, `already_loved`, `approve_message`, `title_limit`, `description_limit`) VALUES
(1, 'admin@admin.com', 'CodeDaddy', '$2y$10$dtllVJZBMzAsbt608Vs1sOyi8DCAL4pzqZM/6oZEXoXg6BHOIpale', NULL, 'About Us', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard', 'CodeDaddy Company', 0, 'Quick Link', 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '#4267B2', '#000000', '#FFFFFF', '', 0, 0, 'Oops, It seems you already liked this Post. Thanks', 'Oops, It seems you already loved this Post. Thanks', 'Thanks for Posting. After approval, It will be published.', 50, 300);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
