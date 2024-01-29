-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 30, 2020 at 08:57 AM
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
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `txn_id` varchar(100) NOT NULL,
  `txn_type` varchar(50) NOT NULL,
  `address_country` varchar(50) NOT NULL,
  `total_amt` decimal(18,2) NOT NULL,
  `payer_email` varchar(200) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `pay_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_admin`
--

DROP TABLE IF EXISTS `subscription_admin`;
CREATE TABLE IF NOT EXISTS `subscription_admin` (
  `id` int(11) NOT NULL,
  `adm_email` varchar(100) NOT NULL,
  `adm_password` varchar(60) NOT NULL,
  `success_message` varchar(255) DEFAULT NULL,
  `paypal_business_email` varchar(255) DEFAULT NULL,
  `adm_otp` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription_admin`
--

INSERT INTO `subscription_admin` (`id`, `adm_email`, `adm_password`, `success_message`, `paypal_business_email`, `adm_otp`) VALUES
(1, 'admin@admin.com', '$2y$10$dtllVJZBMzAsbt608Vs1sOyi8DCAL4pzqZM/6oZEXoXg6BHOIpale', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plan`
--

DROP TABLE IF EXISTS `subscription_plan`;
CREATE TABLE IF NOT EXISTS `subscription_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_name` varchar(255) NOT NULL,
  `sub_date` date NOT NULL,
  `sub_price` varchar(100) NOT NULL,
  `sub_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
