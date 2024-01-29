-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 15, 2020 at 11:48 PM
-- Server version: 5.7.31
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
-- Database: `official_announcement`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_announcement`
--

CREATE TABLE `admin_announcement` (
  `announcement_id` int(11) NOT NULL,
  `announcement_text` text NOT NULL,
  `youtube_id` varchar(25) DEFAULT NULL,
  `youtube_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `fb_url` varchar(255) DEFAULT NULL,
  `insta_url` varchar(255) DEFAULT NULL,
  `announcement_date` date NOT NULL,
  `like_count` int(11) NOT NULL DEFAULT '0',
  `announcement_status` tinyint(1) NOT NULL DEFAULT '1',
  `comment_active` tinyint(1) NOT NULL DEFAULT '1',
  `pinned` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `announcement_like`
--

CREATE TABLE `announcement_like` (
  `id` int(11) NOT NULL,
  `announce_id` int(11) NOT NULL,
  `user_ip` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `announcement_limit`
--

CREATE TABLE `announcement_limit` (
  `id` int(11) NOT NULL,
  `start_lim` int(11) NOT NULL DEFAULT '4',
  `load_lim` int(11) NOT NULL DEFAULT '4'
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

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `announceID` int(11) NOT NULL,
  `announceText` text NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `useremail` varchar(50) NOT NULL,
  `comment_text` text NOT NULL,
  `admin_reply` text,
  `comment_date` date NOT NULL,
  `comment_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `create_package`
--

CREATE TABLE `create_package` (
  `package_id` int(11) NOT NULL,
  `package_name` varchar(100) NOT NULL,
  `package_price` int(11) NOT NULL,
  `announcement_number` int(11) NOT NULL,
  `package_date` date NOT NULL,
  `package_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_admin`
--

CREATE TABLE `ot_admin` (
  `id` int(11) NOT NULL,
  `admin_email` varchar(60) NOT NULL,
  `auth_pass` varchar(60) NOT NULL,
  `otp` varchar(10) DEFAULT NULL,
  `unblock_msg` varchar(100) NOT NULL DEFAULT 'We''ve Unblocked you. Thanks.',
  `alignment` varchar(10) NOT NULL DEFAULT '0',
  `rec_email` varchar(100) DEFAULT NULL,
  `email_subscriber` tinyint(1) NOT NULL DEFAULT '0',
  `email_comment` tinyint(1) NOT NULL DEFAULT '0',
  `rec_email_comment` tinyint(1) NOT NULL DEFAULT '0',
  `pay_email` tinyint(1) NOT NULL DEFAULT '0',
  `free_announcement` int(11) NOT NULL DEFAULT '0',
  `user_chance` tinyint(1) NOT NULL DEFAULT '3',
  `announcement_url` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ot_admin`
--

INSERT INTO `ot_admin` (`id`, `admin_email`, `auth_pass`, `otp`, `unblock_msg`, `alignment`, `rec_email`, `email_subscriber`, `email_comment`, `rec_email_comment`, `pay_email`, `free_announcement`, `user_chance`, `announcement_url`) VALUES
(1, 'admin@admin.com', '$2y$10$dtllVJZBMzAsbt608Vs1sOyi8DCAL4pzqZM/6oZEXoXg6BHOIpale', NULL, 'We&#39;ve Unblocked you. Thank You.', '0', NULL, 0, 0, 0, 0, 0, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `item_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `item_price` decimal(18,2) NOT NULL,
  `announcement_credit` int(11) NOT NULL,
  `item_price_currency` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `txn_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` date NOT NULL,
  `modified_date` datetime NOT NULL,
  `pay_method` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subscriber`
--

CREATE TABLE `tbl_subscriber` (
  `id` int(11) NOT NULL,
  `subscriber_email` varchar(255) NOT NULL,
  `subscriber_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_announcement`
--

CREATE TABLE `user_announcement` (
  `announcement_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `announcement_text` text NOT NULL,
  `youtube_id` varchar(25) DEFAULT NULL,
  `youtube_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `fb_url` varchar(255) DEFAULT NULL,
  `insta_url` varchar(255) DEFAULT NULL,
  `announcement_date` date NOT NULL,
  `like_count` int(11) NOT NULL DEFAULT '0',
  `announcement_status` tinyint(1) NOT NULL DEFAULT '1',
  `comment_active` tinyint(1) NOT NULL DEFAULT '1',
  `pinned` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_announcement_like`
--

CREATE TABLE `user_announcement_like` (
  `id` int(11) NOT NULL,
  `announce_id` int(11) NOT NULL,
  `user_ip` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_comments`
--

CREATE TABLE `user_comments` (
  `comment_id` int(11) NOT NULL,
  `announceID` int(11) NOT NULL,
  `announceText` text NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `useremail` varchar(50) NOT NULL,
  `comment_text` text NOT NULL,
  `admin_reply` text,
  `comment_date` date NOT NULL,
  `comment_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_saas`
--

CREATE TABLE `user_saas` (
  `uid` int(11) NOT NULL,
  `u_email` varchar(100) NOT NULL,
  `u_pass` varchar(60) NOT NULL,
  `u_username` varchar(50) NOT NULL,
  `otp` int(4) DEFAULT NULL,
  `created_date` date NOT NULL,
  `purchase_announcements` int(11) NOT NULL DEFAULT '0',
  `announcement_left` int(11) DEFAULT NULL,
  `u_rec_email` varchar(100) DEFAULT NULL,
  `u_email_subscriber` tinyint(1) NOT NULL DEFAULT '0',
  `u_email_comment` tinyint(1) NOT NULL DEFAULT '0',
  `u_rec_email_comment` tinyint(1) NOT NULL DEFAULT '0',
  `u_status` tinyint(1) NOT NULL DEFAULT '0',
  `start_lim` int(11) NOT NULL DEFAULT '4',
  `load_lim` int(11) NOT NULL DEFAULT '4',
  `alignment` tinyint(1) NOT NULL DEFAULT '0',
  `logo_url` varchar(255) DEFAULT NULL,
  `logo_alt` varchar(15) DEFAULT NULL,
  `u_chance` tinyint(1) NOT NULL DEFAULT '3',
  `u_blocked` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl_subscriber`
--

CREATE TABLE `user_tbl_subscriber` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subscriber_email` varchar(100) NOT NULL,
  `subscriber_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_announcement`
--
ALTER TABLE `admin_announcement`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `announcement_like`
--
ALTER TABLE `announcement_like`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcement_limit`
--
ALTER TABLE `announcement_limit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `create_package`
--
ALTER TABLE `create_package`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `ot_admin`
--
ALTER TABLE `ot_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_subscriber`
--
ALTER TABLE `tbl_subscriber`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_announcement`
--
ALTER TABLE `user_announcement`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `user_announcement_like`
--
ALTER TABLE `user_announcement_like`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_comments`
--
ALTER TABLE `user_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `user_saas`
--
ALTER TABLE `user_saas`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `user_tbl_subscriber`
--
ALTER TABLE `user_tbl_subscriber`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_announcement`
--
ALTER TABLE `admin_announcement`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `announcement_like`
--
ALTER TABLE `announcement_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `create_package`
--
ALTER TABLE `create_package`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_subscriber`
--
ALTER TABLE `tbl_subscriber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_announcement`
--
ALTER TABLE `user_announcement`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_announcement_like`
--
ALTER TABLE `user_announcement_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_comments`
--
ALTER TABLE `user_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_saas`
--
ALTER TABLE `user_saas`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_tbl_subscriber`
--
ALTER TABLE `user_tbl_subscriber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
