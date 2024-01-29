-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2022 at 11:00 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

CREATE TABLE `ot_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `copyright_name` varchar(100) DEFAULT NULL,
  `about_us` varchar(200) DEFAULT NULL,
  `auto_approve` tinyint(1) NOT NULL DEFAULT 0,
  `show_default` int(11) NOT NULL DEFAULT 6,
  `show_load_more` int(11) NOT NULL DEFAULT 6,
  `ad_code` text DEFAULT NULL,
  `ad_code_on` tinyint(1) NOT NULL DEFAULT 0,
  `analytic_code` text DEFAULT NULL,
  `analytic_code_on` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ot_admin`
--

INSERT INTO `ot_admin` (`id`, `username`, `password`, `copyright_name`, `about_us`, `auto_approve`, `show_default`, `show_load_more`, `ad_code`, `ad_code_on`, `analytic_code`, `analytic_code_on`) VALUES
(1, 'admin', '$2y$10$dtllVJZBMzAsbt608Vs1sOyi8DCAL4pzqZM/6oZEXoXg6BHOIpale', 'CodeDaddy', 'We are a Group Of Freelance PHP Developers. Our main concern is that Build something Unique and more Fun.\nOur Team is completely focused on to provide Best Quality Zip Contents.', 0, 6, 6, NULL, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ot_blocked_ip`
--

CREATE TABLE `ot_blocked_ip` (
  `blocked_ip` int(11) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `block_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ot_blogs`
--

CREATE TABLE `ot_blogs` (
  `blog_id` int(11) NOT NULL,
  `blog_title` varchar(100) NOT NULL,
  `blog_short_description` varchar(200) NOT NULL,
  `blog_slug` varchar(255) NOT NULL,
  `blog_image` varchar(100) NOT NULL,
  `blog_description` longtext NOT NULL,
  `blog_like` int(11) NOT NULL DEFAULT 0,
  `blog_view` int(11) NOT NULL DEFAULT 0,
  `blog_status` tinyint(1) NOT NULL DEFAULT 1,
  `blog_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ot_category`
--

CREATE TABLE `ot_category` (
  `cat_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_slug` varchar(100) NOT NULL,
  `category_status` tinyint(1) NOT NULL DEFAULT 1,
  `category_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ot_download`
--

CREATE TABLE `ot_download` (
  `download_id` int(11) NOT NULL,
  `download_zip_id` int(11) NOT NULL,
  `download_user_ip` varchar(100) NOT NULL,
  `download_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ot_pages`
--

CREATE TABLE `ot_pages` (
  `page_id` int(11) NOT NULL,
  `page_name` varchar(25) NOT NULL,
  `page_slug` varchar(100) NOT NULL,
  `page_description` longtext NOT NULL,
  `page_status` tinyint(1) NOT NULL DEFAULT 1,
  `page_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ot_zip`
--

CREATE TABLE `ot_zip` (
  `zip_id` int(11) NOT NULL,
  `zip_category` int(11) NOT NULL,
  `user_ip` varchar(100) NOT NULL,
  `zip_name` varchar(80) NOT NULL,
  `zip_slug` varchar(255) NOT NULL,
  `zip_description` text NOT NULL,
  `zip_file` varchar(100) NOT NULL,
  `zip_featured` tinyint(1) NOT NULL DEFAULT 0,
  `zip_popular` tinyint(1) NOT NULL DEFAULT 0,
  `zip_views` int(11) NOT NULL DEFAULT 0,
  `zip_status` tinyint(1) NOT NULL DEFAULT 0,
  `zip_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ot_admin`
--
ALTER TABLE `ot_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ot_blocked_ip`
--
ALTER TABLE `ot_blocked_ip`
  ADD PRIMARY KEY (`blocked_ip`);

--
-- Indexes for table `ot_blogs`
--
ALTER TABLE `ot_blogs`
  ADD PRIMARY KEY (`blog_id`),
  ADD UNIQUE KEY `blog_title` (`blog_title`);

--
-- Indexes for table `ot_category`
--
ALTER TABLE `ot_category`
  ADD PRIMARY KEY (`cat_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `ot_download`
--
ALTER TABLE `ot_download`
  ADD PRIMARY KEY (`download_id`);

--
-- Indexes for table `ot_pages`
--
ALTER TABLE `ot_pages`
  ADD PRIMARY KEY (`page_id`),
  ADD UNIQUE KEY `page_name` (`page_name`);

--
-- Indexes for table `ot_zip`
--
ALTER TABLE `ot_zip`
  ADD PRIMARY KEY (`zip_id`),
  ADD UNIQUE KEY `zip_name` (`zip_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ot_blocked_ip`
--
ALTER TABLE `ot_blocked_ip`
  MODIFY `blocked_ip` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_blogs`
--
ALTER TABLE `ot_blogs`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_category`
--
ALTER TABLE `ot_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_download`
--
ALTER TABLE `ot_download`
  MODIFY `download_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_pages`
--
ALTER TABLE `ot_pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_zip`
--
ALTER TABLE `ot_zip`
  MODIFY `zip_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
