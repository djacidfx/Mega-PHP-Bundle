-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 24, 2020 at 05:33 AM
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
-- Table structure for table `ot_admin`
--

DROP TABLE IF EXISTS `ot_admin`;
CREATE TABLE IF NOT EXISTS `ot_admin` (
  `id` int(11) NOT NULL,
  `adm_email` varchar(100) NOT NULL,
  `adm_password` varchar(60) NOT NULL,
  `adm_otp` int(4) DEFAULT NULL,
  `dark_mode` tinyint(1) NOT NULL DEFAULT '0',
  `start_lim` varchar(3) NOT NULL DEFAULT '4',
  `load_lim` varchar(3) NOT NULL DEFAULT '4',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ot_admin`
--

INSERT INTO `ot_admin` (`id`, `adm_email`, `adm_password`, `adm_otp`, `dark_mode`, `start_lim`, `load_lim`) VALUES
(1, 'admin@admin.com', '$2y$10$dtllVJZBMzAsbt608Vs1sOyi8DCAL4pzqZM/6oZEXoXg6BHOIpale', NULL, 0, '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `ot_image`
--

DROP TABLE IF EXISTS `ot_image`;
CREATE TABLE IF NOT EXISTS `ot_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img_caption` varchar(100) DEFAULT NULL,
  `img_name` varchar(100) NOT NULL,
  `img_count_people` int(11) NOT NULL DEFAULT '0',
  `img_rate` int(11) NOT NULL DEFAULT '0',
  `img_total_rating` decimal(10,2) NOT NULL DEFAULT '0.00',
  `img_status` tinyint(1) NOT NULL DEFAULT '1',
  `img_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_rating`
--

DROP TABLE IF EXISTS `ot_rating`;
CREATE TABLE IF NOT EXISTS `ot_rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_id` int(11) NOT NULL,
  `user_ip` varchar(100) NOT NULL,
  `user_rating` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
