-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 09, 2020 at 11:27 AM
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
-- Table structure for table `admin_announcement`
--

DROP TABLE IF EXISTS `admin_announcement`;
CREATE TABLE IF NOT EXISTS `admin_announcement` (
  `announcement_id` int(11) NOT NULL AUTO_INCREMENT,
  `announcement_text` text NOT NULL,
  `announcement_date` date NOT NULL,
  `announcement_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`announcement_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(80) NOT NULL,
  `phonecode` int(5) NOT NULL,
  `active_country` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=240 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country_name`, `phonecode`, `active_country`) VALUES
(1, 'Afghanistan', 93, 1),
(2, 'Albania', 355, 1),
(3, 'Algeria', 213, 1),
(4, 'American Samoa', 1684, 1),
(5, 'Andorra', 376, 1),
(6, 'Angola', 244, 1),
(7, 'Anguilla', 1264, 1),
(9, 'Antigua and Barbuda', 1268, 1),
(10, 'Argentina', 54, 1),
(11, 'Armenia', 374, 1),
(12, 'Aruba', 297, 1),
(13, 'Australia', 61, 1),
(14, 'Austria', 43, 1),
(15, 'Azerbaijan', 994, 1),
(16, 'Bahamas', 1242, 1),
(17, 'Bahrain', 973, 1),
(18, 'Bangladesh', 880, 1),
(19, 'Barbados', 1246, 1),
(20, 'Belarus', 375, 1),
(21, 'Belgium', 32, 1),
(22, 'Belize', 501, 1),
(23, 'Benin', 229, 1),
(24, 'Bermuda', 1441, 1),
(25, 'Bhutan', 975, 1),
(26, 'Bolivia', 591, 1),
(27, 'Bosnia and Herzegovina', 387, 1),
(28, 'Botswana', 267, 1),
(30, 'Brazil', 55, 1),
(31, 'British Indian Ocean Territory', 246, 1),
(32, 'Brunei Darussalam', 673, 1),
(33, 'Bulgaria', 359, 1),
(34, 'Burkina Faso', 226, 1),
(35, 'Burundi', 257, 1),
(36, 'Cambodia', 855, 1),
(37, 'Cameroon', 237, 1),
(38, 'Canada', 1, 1),
(39, 'Cape Verde', 238, 1),
(40, 'Cayman Islands', 1345, 1),
(41, 'Central African Republic', 236, 1),
(42, 'Chad', 235, 1),
(43, 'Chile', 56, 1),
(44, 'China', 86, 1),
(45, 'Christmas Island', 61, 1),
(46, 'Cocos (Keeling) Islands', 672, 1),
(47, 'Colombia', 57, 1),
(48, 'Comoros', 269, 1),
(49, 'Congo', 242, 1),
(50, 'Congo, the Democratic Republic of the', 242, 1),
(51, 'Cook Islands', 682, 1),
(52, 'Costa Rica', 506, 1),
(53, 'Cote D\'Ivoire', 225, 1),
(54, 'Croatia', 385, 1),
(55, 'Cuba', 53, 1),
(56, 'Cyprus', 357, 1),
(57, 'Czech Republic', 420, 1),
(58, 'Denmark', 45, 1),
(59, 'Djibouti', 253, 1),
(60, 'Dominica', 1767, 1),
(61, 'Dominican Republic', 1809, 1),
(62, 'Ecuador', 593, 1),
(63, 'Egypt', 20, 1),
(64, 'El Salvador', 503, 1),
(65, 'Equatorial Guinea', 240, 1),
(66, 'Eritrea', 291, 1),
(67, 'Estonia', 372, 1),
(68, 'Ethiopia', 251, 1),
(69, 'Falkland Islands (Malvinas)', 500, 1),
(70, 'Faroe Islands', 298, 1),
(71, 'Fiji', 679, 1),
(72, 'Finland', 358, 1),
(73, 'France', 33, 1),
(74, 'French Guiana', 594, 1),
(75, 'French Polynesia', 689, 1),
(77, 'Gabon', 241, 1),
(78, 'Gambia', 220, 1),
(79, 'Georgia', 995, 1),
(80, 'Germany', 49, 1),
(81, 'Ghana', 233, 1),
(82, 'Gibraltar', 350, 1),
(83, 'Greece', 30, 1),
(84, 'Greenland', 299, 1),
(85, 'Grenada', 1473, 1),
(86, 'Guadeloupe', 590, 1),
(87, 'Guam', 1671, 1),
(88, 'Guatemala', 502, 1),
(89, 'Guinea', 224, 1),
(90, 'Guinea-Bissau', 245, 1),
(91, 'Guyana', 592, 1),
(92, 'Haiti', 509, 1),
(94, 'Holy See (Vatican City State)', 39, 1),
(95, 'Honduras', 504, 1),
(96, 'Hong Kong', 852, 1),
(97, 'Hungary', 36, 1),
(98, 'Iceland', 354, 1),
(99, 'India', 91, 1),
(100, 'Indonesia', 62, 1),
(101, 'Iran, Islamic Republic of', 98, 1),
(102, 'Iraq', 964, 1),
(103, 'Ireland', 353, 1),
(104, 'Israel', 972, 1),
(105, 'Italy', 39, 1),
(106, 'Jamaica', 1876, 1),
(107, 'Japan', 81, 1),
(108, 'Jordan', 962, 1),
(109, 'Kazakhstan', 7, 1),
(110, 'Kenya', 254, 1),
(111, 'Kiribati', 686, 1),
(112, 'Korea, Democratic People\'s Republic of', 850, 1),
(113, 'Korea, Republic of', 82, 1),
(114, 'Kuwait', 965, 1),
(115, 'Kyrgyzstan', 996, 1),
(116, 'Lao People\'s Democratic Republic', 856, 1),
(117, 'Latvia', 371, 1),
(118, 'Lebanon', 961, 1),
(119, 'Lesotho', 266, 1),
(120, 'Liberia', 231, 1),
(121, 'Libyan Arab Jamahiriya', 218, 1),
(122, 'Liechtenstein', 423, 1),
(123, 'Lithuania', 370, 1),
(124, 'Luxembourg', 352, 1),
(125, 'Macao', 853, 1),
(126, 'Macedonia, the Former Yugoslav Republic of', 389, 1),
(127, 'Madagascar', 261, 1),
(128, 'Malawi', 265, 1),
(129, 'Malaysia', 60, 1),
(130, 'Maldives', 960, 1),
(131, 'Mali', 223, 1),
(132, 'Malta', 356, 1),
(133, 'Marshall Islands', 692, 1),
(134, 'Martinique', 596, 1),
(135, 'Mauritania', 222, 1),
(136, 'Mauritius', 230, 1),
(137, 'Mayotte', 269, 1),
(138, 'Mexico', 52, 1),
(139, 'Micronesia, Federated States of', 691, 1),
(140, 'Moldova, Republic of', 373, 1),
(141, 'Monaco', 377, 1),
(142, 'Mongolia', 976, 1),
(143, 'Montserrat', 1664, 1),
(144, 'Morocco', 212, 1),
(145, 'Mozambique', 258, 1),
(146, 'Myanmar', 95, 1),
(147, 'Namibia', 264, 1),
(148, 'Nauru', 674, 1),
(149, 'Nepal', 977, 1),
(150, 'Netherlands', 31, 1),
(151, 'Netherlands Antilles', 599, 1),
(152, 'New Caledonia', 687, 1),
(153, 'New Zealand', 64, 1),
(154, 'Nicaragua', 505, 1),
(155, 'Niger', 227, 1),
(156, 'Nigeria', 234, 1),
(157, 'Niue', 683, 1),
(158, 'Norfolk Island', 672, 1),
(159, 'Northern Mariana Islands', 1670, 1),
(160, 'Norway', 47, 1),
(161, 'Oman', 968, 1),
(162, 'Pakistan', 92, 1),
(163, 'Palau', 680, 1),
(164, 'Palestinian Territory, Occupied', 970, 1),
(165, 'Panama', 507, 1),
(166, 'Papua New Guinea', 675, 1),
(167, 'Paraguay', 595, 1),
(168, 'Peru', 51, 1),
(169, 'Philippines', 63, 1),
(171, 'Poland', 48, 1),
(172, 'Portugal', 351, 1),
(173, 'Puerto Rico', 1787, 1),
(174, 'Qatar', 974, 1),
(175, 'Reunion', 262, 1),
(176, 'Romania', 40, 1),
(177, 'Russian Federation', 70, 1),
(178, 'Rwanda', 250, 1),
(179, 'Saint Helena', 290, 1),
(180, 'Saint Kitts and Nevis', 1869, 1),
(181, 'Saint Lucia', 1758, 1),
(182, 'Saint Pierre and Miquelon', 508, 1),
(183, 'Saint Vincent and the Grenadines', 1784, 1),
(184, 'Samoa', 684, 1),
(185, 'San Marino', 378, 1),
(186, 'Sao Tome and Principe', 239, 1),
(187, 'Saudi Arabia', 966, 1),
(188, 'Senegal', 221, 1),
(189, 'Serbia and Montenegro', 381, 1),
(190, 'Seychelles', 248, 1),
(191, 'Sierra Leone', 232, 1),
(192, 'Singapore', 65, 1),
(193, 'Slovakia', 421, 1),
(194, 'Slovenia', 386, 1),
(195, 'Solomon Islands', 677, 1),
(196, 'Somalia', 252, 1),
(197, 'South Africa', 27, 1),
(199, 'Spain', 34, 1),
(200, 'Sri Lanka', 94, 1),
(201, 'Sudan', 249, 1),
(202, 'Suriname', 597, 1),
(203, 'Svalbard and Jan Mayen', 47, 1),
(204, 'Swaziland', 268, 1),
(205, 'Sweden', 46, 1),
(206, 'Switzerland', 41, 1),
(207, 'Syrian Arab Republic', 963, 1),
(208, 'Taiwan, Province of China', 886, 1),
(209, 'Tajikistan', 992, 1),
(210, 'Tanzania, United Republic of', 255, 1),
(211, 'Thailand', 66, 1),
(212, 'Timor-Leste', 670, 1),
(213, 'Togo', 228, 1),
(214, 'Tokelau', 690, 1),
(215, 'Tonga', 676, 1),
(216, 'Trinidad and Tobago', 1868, 1),
(217, 'Tunisia', 216, 1),
(218, 'Turkey', 90, 1),
(219, 'Turkmenistan', 7370, 1),
(220, 'Turks and Caicos Islands', 1649, 1),
(221, 'Tuvalu', 688, 1),
(222, 'Uganda', 256, 1),
(223, 'Ukraine', 380, 1),
(224, 'United Arab Emirates', 971, 1),
(225, 'United Kingdom', 44, 1),
(226, 'United States', 1, 1),
(227, 'United States Minor Outlying Islands', 1, 1),
(228, 'Uruguay', 598, 1),
(229, 'Uzbekistan', 998, 1),
(230, 'Vanuatu', 678, 1),
(231, 'Venezuela', 58, 1),
(232, 'Viet Nam', 84, 1),
(233, 'Virgin Islands, British', 1284, 1),
(234, 'Virgin Islands, U.s.', 1340, 1),
(235, 'Wallis and Futuna', 681, 1),
(236, 'Western Sahara', 212, 1),
(237, 'Yemen', 967, 1),
(238, 'Zambia', 260, 1),
(239, 'Zimbabwe', 263, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_active`
--

DROP TABLE IF EXISTS `customer_active`;
CREATE TABLE IF NOT EXISTS `customer_active` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_fullname` varchar(55) NOT NULL,
  `user_countrycode` varchar(10) DEFAULT NULL,
  `user_mobile` varchar(25) NOT NULL,
  `user_authpass` varchar(60) NOT NULL,
  `user_otp` varchar(10) NOT NULL DEFAULT '0',
  `user_address` text,
  `user_state` varchar(55) DEFAULT NULL,
  `user_city` varchar(25) DEFAULT NULL,
  `user_zipcode` varchar(10) DEFAULT NULL,
  `active_status` tinyint(1) NOT NULL,
  `user_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_tmp_mobile` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_tmp`
--

DROP TABLE IF EXISTS `customer_tmp`;
CREATE TABLE IF NOT EXISTS `customer_tmp` (
  `tmp_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_fullname` varchar(55) NOT NULL,
  `user_countrycode` varchar(10) DEFAULT NULL,
  `user_mobile` varchar(25) NOT NULL,
  `user_authpass` varchar(60) NOT NULL,
  `user_otp` varchar(10) NOT NULL,
  `user_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tmp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_admin`
--

DROP TABLE IF EXISTS `ot_admin`;
CREATE TABLE IF NOT EXISTS `ot_admin` (
  `id` int(11) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(60) NOT NULL,
  `otp` varchar(10) DEFAULT NULL,
  `admin_status` tinyint(4) NOT NULL DEFAULT '1',
  `show_announcement` tinyint(1) NOT NULL DEFAULT '0',
  `sms_apikey` varchar(255) DEFAULT NULL,
  `sms_senderid` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ot_admin`
--

INSERT INTO `ot_admin` (`id`, `email`, `password`, `otp`, `admin_status`, `show_announcement`, `sms_apikey`, `sms_senderid`) VALUES
(1, 'admin@admin.com', '$2y$10$dtllVJZBMzAsbt608Vs1sOyi8DCAL4pzqZM/6oZEXoXg6BHOIpale', NULL, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `send_nonuser_sms`
--

DROP TABLE IF EXISTS `send_nonuser_sms`;
CREATE TABLE IF NOT EXISTS `send_nonuser_sms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nonuser_country_code` int(11) NOT NULL,
  `nonuser_mobile` varchar(50) NOT NULL,
  `nonuser_sms_text` varchar(350) NOT NULL,
  `nonuser_sms_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `send_user_sms`
--

DROP TABLE IF EXISTS `send_user_sms`;
CREATE TABLE IF NOT EXISTS `send_user_sms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `country_code` int(11) NOT NULL,
  `user_mobile` varchar(50) NOT NULL,
  `sms_text` varchar(350) NOT NULL,
  `sms_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_announcement_read`
--

DROP TABLE IF EXISTS `user_announcement_read`;
CREATE TABLE IF NOT EXISTS `user_announcement_read` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `read_announcement` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
