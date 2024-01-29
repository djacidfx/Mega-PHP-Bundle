-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 11, 2020 at 06:04 AM
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
-- Table structure for table `billing_admin`
--

DROP TABLE IF EXISTS `billing_admin`;
CREATE TABLE IF NOT EXISTS `billing_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(55) NOT NULL,
  `auth_pass` varchar(60) NOT NULL,
  `user_role` varchar(20) NOT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing_admin`
--

INSERT INTO `billing_admin` (`id`, `email`, `auth_pass`, `user_role`, `active_status`) VALUES
(1, 'admin@admin.com', '$2y$10$dtllVJZBMzAsbt608Vs1sOyi8DCAL4pzqZM/6oZEXoXg6BHOIpale', 'Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `billing_brand`
--

DROP TABLE IF EXISTS `billing_brand`;
CREATE TABLE IF NOT EXISTS `billing_brand` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `brand_name` varchar(55) NOT NULL,
  `brand_status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`brand_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `billing_category`
--

DROP TABLE IF EXISTS `billing_category`;
CREATE TABLE IF NOT EXISTS `billing_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  `category_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `billing_company`
--

DROP TABLE IF EXISTS `billing_company`;
CREATE TABLE IF NOT EXISTS `billing_company` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `company_email` varchar(55) DEFAULT NULL,
  `company_contact` varchar(55) DEFAULT NULL,
  `company_taxno` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing_company`
--

INSERT INTO `billing_company` (`company_id`, `company_name`, `company_email`, `company_contact`, `company_taxno`) VALUES
(1, 'Admin', 'admin@admin.com', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `billing_order`
--

DROP TABLE IF EXISTS `billing_order`;
CREATE TABLE IF NOT EXISTS `billing_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_customer_id` int(11) NOT NULL,
  `order_enter_by` int(11) DEFAULT NULL,
  `order_edited_by` int(11) DEFAULT NULL,
  `order_total` int(11) NOT NULL,
  `order_customername` varchar(55) NOT NULL,
  `order_customer_email` varchar(100) DEFAULT NULL,
  `order_customer_mobile` varchar(50) DEFAULT NULL,
  `order_customer_tax_no` varchar(100) DEFAULT NULL,
  `order_customer_address` varchar(255) DEFAULT NULL,
  `order_paid_amount` varchar(55) NOT NULL,
  `order_due_amount` varchar(55) NOT NULL DEFAULT '0',
  `order_discount` int(11) NOT NULL DEFAULT '0',
  `order_date` date NOT NULL,
  `order_payment_status` tinyint(1) NOT NULL DEFAULT '0',
  `order_status` tinyint(1) NOT NULL DEFAULT '0',
  `order_server_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `billing_order_detail`
--

DROP TABLE IF EXISTS `billing_order_detail`;
CREATE TABLE IF NOT EXISTS `billing_order_detail` (
  `billing_serial_id` int(11) NOT NULL AUTO_INCREMENT,
  `billing_order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_beforetax` varchar(55) NOT NULL,
  `price_aftertax` varchar(55) NOT NULL,
  `tax_percent` varchar(55) NOT NULL,
  `tax_amount` varchar(55) NOT NULL,
  `product_price_beforetax` varchar(55) NOT NULL,
  `product_price_taxamount` varchar(55) NOT NULL,
  `product_total_price` varchar(55) NOT NULL,
  PRIMARY KEY (`billing_serial_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `billing_product`
--

DROP TABLE IF EXISTS `billing_product`;
CREATE TABLE IF NOT EXISTS `billing_product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_sku` varchar(55) NOT NULL,
  `product_quantity` varchar(10) NOT NULL,
  `product_unit` varchar(55) NOT NULL,
  `product_base_price` varchar(55) NOT NULL,
  `product_tax_rate` varchar(55) NOT NULL,
  `product_selling_price` varchar(55) NOT NULL,
  `product_enter_by` varchar(55) NOT NULL,
  `product_edited_by` int(11) DEFAULT NULL,
  `product_status` tinyint(1) NOT NULL DEFAULT '1',
  `product_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `billing_tax`
--

DROP TABLE IF EXISTS `billing_tax`;
CREATE TABLE IF NOT EXISTS `billing_tax` (
  `tax_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_slab_rate` varchar(10) NOT NULL,
  `tax_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`tax_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `billing_user`
--

DROP TABLE IF EXISTS `billing_user`;
CREATE TABLE IF NOT EXISTS `billing_user` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_username` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone` varchar(55) NOT NULL,
  `customer_password` varchar(60) NOT NULL,
  `customer_name` varchar(55) NOT NULL,
  `customer_tax_no` varchar(55) NOT NULL,
  `customer_status` tinyint(1) NOT NULL DEFAULT '1',
  `customer_date` varchar(55) NOT NULL,
  `enter_by` int(11) DEFAULT NULL,
  `edited_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `world_currencies`
--

DROP TABLE IF EXISTS `world_currencies`;
CREATE TABLE IF NOT EXISTS `world_currencies` (
  `world_currency_id` int(11) NOT NULL AUTO_INCREMENT,
  `langEN` varchar(39) NOT NULL,
  `symbol_hex` text,
  `currency_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`world_currency_id`)
) ENGINE=MyISAM AUTO_INCREMENT=151 DEFAULT CHARSET=utf8 COMMENT='World Currencies (ISO 4217)';

--
-- Dumping data for table `world_currencies`
--

INSERT INTO `world_currencies` (`world_currency_id`, `langEN`, `symbol_hex`, `currency_status`) VALUES
(1, 'United Arab Emirates dirham', '062F;002E;0625', 0),
(2, 'Afghan afghani', '060B', 0),
(3, 'Albanian lek', '004C;0065;006B', 0),
(4, 'Netherlands Antillean guilder', '0192', 0),
(5, 'Angolan kwanza', '004B;007A', 0),
(6, 'Argentine peso', '0024', 0),
(7, 'Australian dollar', '0024', 0),
(8, 'Aruban florin', '0192', 0),
(9, 'Azerbaijani manat', '043C;0430;043D', 0),
(10, 'Bosnia and Herzegovina convertible mark', '004B;004D', 0),
(11, 'Barbados dollar', '0024', 0),
(12, 'Bangladeshi taka', '09F3', 0),
(13, 'Bulgarian lev', '043B;0432', 0),
(14, 'Bahraini dinar', '002E;062F;002E;0628', 0),
(15, 'Burundian franc', '0046;0042;0075', 0),
(16, 'Bermudian dollar', '0024', 0),
(17, 'Brunei dollar', '0024', 0),
(18, 'Boliviano', '0024;0062', 0),
(19, 'Brazilian real', '0052;0024', 0),
(20, 'Bahamian dollar', '0024', 0),
(21, 'Bhutanese ngultrum', '004E;0075', 0),
(22, 'Botswana pula', '0050', 0),
(23, 'Belarusian ruble', '0070;002E', 0),
(24, 'Belize dollar', '0042;005A;0024', 0),
(25, 'Canadian dollar', '0024', 0),
(26, 'Congolese franc', '0046;0043', 0),
(27, 'Swiss franc', '0043;0048;0046', 0),
(28, 'Chilean peso', '0024', 0),
(29, 'Chinese yuan', '00A5', 0),
(30, 'Colombian peso', '0024', 0),
(31, 'Costa Rican colon', '20A1', 0),
(32, 'Cuban convertible peso', '0024', 0),
(33, 'Cuban peso', '20B1', 0),
(34, 'Cape Verde escudo', '0024', 0),
(35, 'Czech koruna', '004B;010D', 0),
(36, 'Djiboutian franc', '0046;0064;006A', 0),
(37, 'Danish krone', '006B;0072', 0),
(38, 'Dominican peso', '0052;0044;0024', 0),
(39, 'Algerian dinar', '062F;062C', 0),
(40, 'Egyptian pound', '00A3', 0),
(41, 'Eritrean nakfa', '0646;0627;0641;0643;0627', 0),
(42, 'Ethiopian birr', '1265;122D', 0),
(43, 'Euro', '20AC', 0),
(44, 'Fiji dollar', '0024', 0),
(45, 'Falkland Islands pound', '00A3', 0),
(46, 'Pound sterling', '00A3', 0),
(47, 'Georgian lari', '20BE', 0),
(48, 'Ghanaian cedi', '00A2', 0),
(49, 'Gibraltar pound', '00A3', 0),
(50, 'Gambian dalasi', '0044', 0),
(51, 'Guinean franc', '0046;0047', 0),
(52, 'Guatemalan quetzal', '0051', 0),
(53, 'Guyanese dollar', '0024', 0),
(54, 'Hong Kong dollar', '0024', 0),
(55, 'Honduran lempira', '004C', 0),
(56, 'Croatian kuna', '006B;006E', 0),
(57, 'Haitian gourde', '0047', 0),
(58, 'Hungarian forint', '0046;0074', 0),
(59, 'Indonesian rupiah', '0052;0070', 0),
(60, 'Israeli new shekel', '20AA', 0),
(61, 'Indian rupee', '20B9', 0),
(62, 'Iraqi dinar', '0639;002E;062F', 0),
(63, 'Iranian rial', 'FDFC', 0),
(64, 'Icelandic króna', '006B;0072', 0),
(65, 'Jamaican dollar', '004A;0024', 0),
(66, 'Jordanian dinar', '062F;064A;0646;0627;0631', 0),
(67, 'Japanese yen', '00A5', 0),
(68, 'Kenyan shilling', '004B;0053;0068', 0),
(69, 'Kyrgyzstani som', '043B;0432', 0),
(70, 'Cambodian riel', '17DB', 0),
(71, 'Comoro franc', '0043;0046', 0),
(72, 'North Korean won', '20A9', 0),
(73, 'South Korean won', '20A9', 0),
(74, 'Kuwaiti dinar', '062F;002E;0643', 0),
(75, 'Cayman Islands dollar', '0024', 0),
(76, 'Kazakhstani tenge', '043B;0432', 0),
(77, 'Lao kip', '20AD', 0),
(78, 'Lebanese pound', '00A3', 0),
(79, 'Sri Lankan rupee', '20A8', 0),
(80, 'Liberian dollar', '0024', 0),
(81, 'Lesotho loti', '004C', 0),
(82, 'Libyan dinar', '0644;002E;062F', 0),
(83, 'Moroccan dirham', '004D;0041;0044', 0),
(84, 'Malagasy ariary', '0041;0072', 0),
(85, 'Macedonian denar', '0434;0435;043D', 0),
(86, 'Burmese kyat', '004B', 0),
(87, 'Mongolian tögrög', '20AE', 0),
(88, 'Macanese pataca', '004D;004F;0050;0024', 0),
(89, 'Mauritanian ouguiya', '0055;004D', 0),
(90, 'Mauritian rupee', '20A8', 0),
(91, 'Maldivian rufiyaa', '002D;0783', 0),
(92, 'Malawian kwacha', '004D;004B', 0),
(93, 'Mexican peso', '0024', 0),
(94, 'Malaysian ringgit', '0052;004D', 0),
(95, 'Mozambican metical', '004D;0054', 0),
(96, 'Namibian dollar', '0024', 0),
(97, 'Nigerian naira', '20A6', 0),
(98, 'Nicaraguan córdoba', '0043;0024', 0),
(99, 'Norwegian krone', '006B;0072', 0),
(100, 'Nepalese rupee', '20A8', 0),
(101, 'New Zealand dollar', '0024', 0),
(102, 'Omani rial', 'FDFC', 0),
(103, 'Panamanian balboa', '0042;002F;002E', 0),
(104, 'Peruvian Sol', '0053;002F;002E', 0),
(105, 'Papua New Guinean kina', '004B', 0),
(106, 'Philippine peso', '20B1', 0),
(107, 'Pakistani rupee', '20A8', 0),
(108, 'Polish złoty', '007A;0142', 0),
(109, 'Paraguayan guaraní', '0047;0073', 0),
(110, 'Qatari riyal', 'FDFC', 0),
(111, 'Romanian leu', '006C;0065;0069', 0),
(112, 'Serbian dinar', '0414;0438;043D;002E', 0),
(113, 'Russian ruble', '0440;0443;0431', 0),
(114, 'Rwandan franc', '0046;0052;0077', 0),
(115, 'Saudi riyal', 'FDFC', 0),
(116, 'Solomon Islands dollar', '0024', 0),
(117, 'Seychelles rupee', '20A8', 0),
(118, 'Sudanese pound', '062C;002E;0633', 0),
(119, 'Swedish krona/kronor', '006B;0072', 0),
(120, 'Singapore dollar', '0024', 0),
(121, 'Saint Helena pound', '00A3', 0),
(122, 'Sierra Leonean leone', '004C;0065', 0),
(123, 'Somali shilling', '0053', 0),
(124, 'Surinamese dollar', '0024', 0),
(125, 'South Sudanese pound', '0024', 0),
(126, 'São Tomé and Príncipe dobra', '0044;0062', 0),
(127, 'Syrian pound', '00A3', 0),
(128, 'Swazi lilangeni', '004C', 0),
(129, 'Thai baht', '0E3F', 0),
(130, 'Turkmenistani manat', '0054', 0),
(131, 'Tunisian dinar', '062F;002E;062A', 0),
(132, 'Tongan paʻanga', '0054;0024', 0),
(133, 'Turkish lira', '20BA', 0),
(134, 'Trinidad and Tobago dollar', '0054;0054;0024', 0),
(135, 'New Taiwan dollar', '004E;0054;0024', 0),
(136, 'Tanzanian shilling', '0054;0053;0068', 0),
(137, 'Ukrainian hryvnia', '20B4', 0),
(138, 'Ugandan shilling', '0055;0053;0068', 0),
(139, 'United States dollar', '0024', 1),
(140, 'Uruguayan peso', '0024;0055', 0),
(141, 'Uzbekistan som', '043B;0432', 0),
(142, 'Venezuelan bolívar', '0042;0073', 0),
(143, 'Vietnamese dong', '20AB', 0),
(144, 'Vanuatu vatu', '0056;0054', 0),
(145, 'Samoan tala', '0057;0053;0024', 0),
(146, 'East Caribbean dollar', '0024', 0),
(147, 'CFP franc (franc Pacifique)', '0046', 0),
(148, 'Yemeni rial', 'FDFC', 0),
(149, 'South African rand', '0052', 0),
(150, 'Zambian kwacha', '005A;0024', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
