-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 29, 2020 at 06:29 AM
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
-- Table structure for table `item_category`
--

DROP TABLE IF EXISTS `item_category`;
CREATE TABLE IF NOT EXISTS `item_category` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(50) NOT NULL,
  `c_date` date NOT NULL,
  `c_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_db`
--

DROP TABLE IF EXISTS `item_db`;
CREATE TABLE IF NOT EXISTS `item_db` (
  `item_Id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(100) NOT NULL,
  `regular_price` int(11) NOT NULL,
  `main_category` int(11) NOT NULL,
  `item_description` longtext NOT NULL,
  `item_thumbnail` varchar(100) DEFAULT NULL,
  `item_preview` varchar(100) DEFAULT NULL,
  `item_mainfile` varchar(100) DEFAULT NULL,
  `item_filesize` varchar(50) DEFAULT NULL,
  `item_docufile` varchar(100) DEFAULT NULL,
  `item_tags` text,
  `item_demo_link` varchar(255) DEFAULT NULL,
  `item_youtube_link` varchar(255) DEFAULT NULL,
  `item_youtube_id` varchar(100) DEFAULT NULL,
  `item_sale` int(11) NOT NULL DEFAULT '0',
  `item_loved_by` int(11) NOT NULL DEFAULT '0',
  `item_viewed` int(11) NOT NULL DEFAULT '0',
  `item_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL,
  PRIMARY KEY (`item_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_loved`
--

DROP TABLE IF EXISTS `item_loved`;
CREATE TABLE IF NOT EXISTS `item_loved` (
  `love_id` int(11) NOT NULL AUTO_INCREMENT,
  `love_uid` int(11) NOT NULL,
  `love_item_id` int(11) NOT NULL,
  PRIMARY KEY (`love_id`)
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
  `STRIPE_SECRET_KEY` varchar(500) DEFAULT NULL,
  `STRIPE_PUBLISHABLE_KEY` varchar(500) DEFAULT NULL,
  `PAYPAL_BUSINESS_EMAIL` varchar(100) DEFAULT NULL,
  `paypal_on` tinyint(1) NOT NULL DEFAULT '0',
  `stripe_on` tinyint(1) NOT NULL DEFAULT '0',
  `txn_fee` decimal(18,2) NOT NULL DEFAULT '0.00',
  `otp` int(4) DEFAULT NULL,
  `user_chance` tinyint(1) NOT NULL DEFAULT '3',
  `rec_email` varchar(50) DEFAULT NULL,
  `about_us_name` varchar(25) NOT NULL DEFAULT 'About Us',
  `about_us_info` varchar(255) NOT NULL DEFAULT 'Lorem Ipsum Some Text Here !!!',
  `copyright_name` varchar(50) NOT NULL DEFAULT 'Company Name',
  `pay_email` tinyint(1) NOT NULL DEFAULT '0',
  `unblock_msg` varchar(100) NOT NULL DEFAULT 'We''ve Unblocked you. Thanks.',
  `mainfile_email` tinyint(1) NOT NULL DEFAULT '0',
  `link_name` varchar(20) NOT NULL DEFAULT 'Quick Links',
  `default_load` int(11) NOT NULL DEFAULT '3',
  `on_load` int(11) NOT NULL DEFAULT '3',
  `fb_url` varchar(555) DEFAULT NULL,
  `twitter_url` varchar(555) DEFAULT NULL,
  `linkedin_url` varchar(555) DEFAULT NULL,
  `behance_url` varchar(555) DEFAULT NULL,
  `dribble_url` varchar(555) DEFAULT NULL,
  `vk_url` varchar(555) DEFAULT NULL,
  `g_code` text,
  `admin_on` tinyint(1) NOT NULL DEFAULT '0',
  `user_on` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ot_admin`
--

INSERT INTO `ot_admin` (`id`, `adm_email`, `adm_name`, `adm_password`, `STRIPE_SECRET_KEY`, `STRIPE_PUBLISHABLE_KEY`, `PAYPAL_BUSINESS_EMAIL`, `paypal_on`, `stripe_on`, `txn_fee`, `otp`, `user_chance`, `rec_email`, `about_us_name`, `about_us_info`, `copyright_name`, `pay_email`, `unblock_msg`, `mainfile_email`, `link_name`, `default_load`, `on_load`, `fb_url`, `twitter_url`, `linkedin_url`, `behance_url`, `dribble_url`, `vk_url`, `g_code`, `admin_on`, `user_on`) VALUES
(1, 'admin@admin.com', NULL, '$2y$10$dtllVJZBMzAsbt608Vs1sOyi8DCAL4pzqZM/6oZEXoXg6BHOIpale', NULL, NULL, NULL, 0, 0, '0.00', NULL, 3, NULL, 'About Us', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.\r\nLorem Ipsum has been the industry&#39;s standard', 'Company Name', 0, 'We&#39;ve Unblocked you. Thanks.', 0, 'Quick Link', 6, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0);

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
-- Table structure for table `ot_payments`
--

DROP TABLE IF EXISTS `ot_payments`;
CREATE TABLE IF NOT EXISTS `ot_payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_user_id` int(11) NOT NULL,
  `p_item_id` int(11) NOT NULL,
  `p_total_amt` decimal(18,2) NOT NULL,
  `payment_method` varchar(55) DEFAULT NULL,
  `txn_id` varchar(255) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `payment_date` date NOT NULL,
  `complete_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_tags`
--

DROP TABLE IF EXISTS `ot_tags`;
CREATE TABLE IF NOT EXISTS `ot_tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_item_id` int(11) NOT NULL,
  `tag_name` varchar(255) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_user`
--

DROP TABLE IF EXISTS `ot_user`;
CREATE TABLE IF NOT EXISTS `ot_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_pass` varchar(60) NOT NULL,
  `user_otp` varchar(10) DEFAULT NULL,
  `user_status` tinyint(1) NOT NULL DEFAULT '0',
  `u_chance` tinyint(1) NOT NULL DEFAULT '0',
  `register_date` date NOT NULL,
  `user_blocked` tinyint(1) NOT NULL DEFAULT '0',
  `user_wallet` decimal(18,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_user_wallet`
--

DROP TABLE IF EXISTS `ot_user_wallet`;
CREATE TABLE IF NOT EXISTS `ot_user_wallet` (
  `wallet_id` int(11) NOT NULL AUTO_INCREMENT,
  `wallet_user_id` int(11) NOT NULL,
  `planId` int(11) NOT NULL,
  `planAmt` decimal(18,2) NOT NULL,
  `bonusAmt` decimal(18,2) NOT NULL,
  `wallet_amt` decimal(18,2) NOT NULL,
  `wallet_txn_id` varchar(555) NOT NULL,
  `wallet_method` varchar(55) NOT NULL,
  `wallet_complete_status` tinyint(1) NOT NULL DEFAULT '0',
  `wallet_date` date NOT NULL,
  PRIMARY KEY (`wallet_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_wallet_plan`
--

DROP TABLE IF EXISTS `ot_wallet_plan`;
CREATE TABLE IF NOT EXISTS `ot_wallet_plan` (
  `plan_id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_name` varchar(255) NOT NULL,
  `plan_amt` decimal(18,2) NOT NULL,
  `bonus_amt` decimal(18,2) NOT NULL DEFAULT '0.00',
  `plan_date` date NOT NULL,
  `plan_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`plan_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
