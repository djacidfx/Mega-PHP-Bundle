-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 19, 2021 at 10:52 PM
-- Server version: 5.7.34
-- PHP Version: 7.3.6

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

CREATE TABLE `ot_admin` (
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
  `insta_url` varchar(255) DEFAULT NULL,
  `fb_url` varchar(555) DEFAULT NULL,
  `twitter_url` varchar(555) DEFAULT NULL,
  `linkedin_url` varchar(555) DEFAULT NULL,
  `behance_url` varchar(555) DEFAULT NULL,
  `dribble_url` varchar(555) DEFAULT NULL,
  `vk_url` varchar(555) DEFAULT NULL,
  `g_code` text,
  `admin_on` tinyint(1) NOT NULL DEFAULT '0',
  `user_on` tinyint(1) NOT NULL DEFAULT '0',
  `hard_rejected` int(11) NOT NULL DEFAULT '0',
  `elite_author_requirement` varchar(10) NOT NULL DEFAULT '10',
  `power_elite_author_requirement` varchar(10) NOT NULL DEFAULT '16',
  `elite_buyer_requirement` varchar(10) NOT NULL DEFAULT '10',
  `power_elite_buyer_requirement` int(10) NOT NULL DEFAULT '16',
  `community_superstar_requirement` varchar(10) NOT NULL DEFAULT '16',
  `uploader_king_requirement` varchar(10) NOT NULL DEFAULT '16',
  `follower_rockstar_requirement` varchar(10) NOT NULL DEFAULT '16',
  `commission` int(11) NOT NULL DEFAULT '0',
  `refund_max_day` tinyint(2) NOT NULL DEFAULT '5',
  `min_wallet` int(11) NOT NULL DEFAULT '1',
  `max_wallet` int(11) NOT NULL DEFAULT '100',
  `minimum_payout` int(11) NOT NULL DEFAULT '50',
  `send_payout_day` int(11) NOT NULL DEFAULT '15',
  `show_community_earning` tinyint(1) NOT NULL DEFAULT '1',
  `show_user_panel` tinyint(1) NOT NULL DEFAULT '1',
  `user_panel_message` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ot_admin`
--

INSERT INTO `ot_admin` (`id`, `adm_email`, `adm_name`, `adm_password`, `STRIPE_SECRET_KEY`, `STRIPE_PUBLISHABLE_KEY`, `PAYPAL_BUSINESS_EMAIL`, `paypal_on`, `stripe_on`, `txn_fee`, `otp`, `user_chance`, `rec_email`, `about_us_name`, `about_us_info`, `copyright_name`, `pay_email`, `unblock_msg`, `mainfile_email`, `link_name`, `default_load`, `on_load`, `insta_url`, `fb_url`, `twitter_url`, `linkedin_url`, `behance_url`, `dribble_url`, `vk_url`, `g_code`, `admin_on`, `user_on`, `hard_rejected`, `elite_author_requirement`, `power_elite_author_requirement`, `elite_buyer_requirement`, `power_elite_buyer_requirement`, `community_superstar_requirement`, `uploader_king_requirement`, `follower_rockstar_requirement`, `commission`, `refund_max_day`, `min_wallet`, `max_wallet`, `minimum_payout`, `send_payout_day`, `show_community_earning`, `show_user_panel`, `user_panel_message`) VALUES
(1, 'admin@admin.com', 'CodeDaddy', '$2y$10$dtllVJZBMzAsbt608Vs1sOyi8DCAL4pzqZM/6oZEXoXg6BHOIpale', NULL, NULL, NULL, 1, 1, 0.00, NULL, 3, NULL, 'About Us', 'Unprofessional is a leading global marketplace for  learning via Video Course, connecting millions of people to the skills they need to succeed.\r\nSkillful Authors will get High Passive Income as Reward', 'CodeDaddy Company', 0, 'We&#39;ve Unblocked you. Thanks.', 0, 'Quick Link', 6, 6, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '10', '16', '10', 16, '16', '16', '16', 30, 5, 10, 999, 50, 15, 1, 1, 'We&#39;ve got something special for you after Server Maintenance Break.\r\nAnd we can&#39;t wait for you to see it.\r\nPlease check back after 24 Hours.');

-- --------------------------------------------------------

--
-- Table structure for table `ot_admin_pages`
--

CREATE TABLE `ot_admin_pages` (
  `page_id` int(11) NOT NULL,
  `page_name` varchar(25) NOT NULL,
  `page_slug` varchar(25) NOT NULL,
  `page_text` longtext NOT NULL,
  `page_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_author_badge`
--

CREATE TABLE `ot_author_badge` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_author_level_requirement`
--

CREATE TABLE `ot_author_level_requirement` (
  `level_id` int(11) NOT NULL,
  `level_price` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ot_author_level_requirement`
--

INSERT INTO `ot_author_level_requirement` (`level_id`, `level_price`) VALUES
(1, 1),
(2, 50),
(3, 100),
(4, 200),
(5, 300),
(6, 400),
(7, 500),
(8, 600),
(9, 700),
(10, 800),
(11, 900),
(12, 1000),
(13, 1100),
(14, 1200),
(15, 1300),
(16, 1500);

-- --------------------------------------------------------

--
-- Table structure for table `ot_author_payouts`
--

CREATE TABLE `ot_author_payouts` (
  `payout_id` int(11) NOT NULL,
  `p_txn_id` varchar(255) NOT NULL,
  `p_author_id` int(11) NOT NULL,
  `p_month` varchar(50) NOT NULL,
  `p_year` int(11) NOT NULL,
  `payout_amt` decimal(18,2) NOT NULL,
  `payout_method` varchar(100) NOT NULL,
  `payout_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paypal_email` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_author_statement`
--

CREATE TABLE `ot_author_statement` (
  `statement_id` int(11) NOT NULL,
  `s_txn_id` varchar(500) NOT NULL,
  `author_id` int(11) NOT NULL,
  `s_item_id` int(11) NOT NULL,
  `s_author_earning` decimal(18,2) NOT NULL,
  `s_type` tinyint(1) NOT NULL DEFAULT '1',
  `s_paid` tinyint(1) NOT NULL DEFAULT '0',
  `s_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_buyer_level_requirement`
--

CREATE TABLE `ot_buyer_level_requirement` (
  `buyer_level_id` int(11) NOT NULL,
  `buyer_level_purchased` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ot_buyer_level_requirement`
--

INSERT INTO `ot_buyer_level_requirement` (`buyer_level_id`, `buyer_level_purchased`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16);

-- --------------------------------------------------------

--
-- Table structure for table `ot_category`
--

CREATE TABLE `ot_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_image` varchar(255) DEFAULT NULL,
  `category_status` tinyint(1) NOT NULL DEFAULT '0',
  `category_video` int(11) NOT NULL DEFAULT '0',
  `category_view` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_comments`
--

CREATE TABLE `ot_comments` (
  `comment_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `comment_item_id` int(11) NOT NULL,
  `comment_user_id` int(11) NOT NULL,
  `comment_status` tinyint(1) NOT NULL DEFAULT '1',
  `comment_seen` tinyint(1) NOT NULL DEFAULT '0',
  `author_report` tinyint(1) NOT NULL DEFAULT '0',
  `comment_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_comment_thread`
--

CREATE TABLE `ot_comment_thread` (
  `comment_thread_id` int(11) NOT NULL,
  `thread_user_id` int(11) NOT NULL,
  `thread_comment_id` int(11) NOT NULL,
  `thread_item_id` int(11) NOT NULL,
  `thread_comment` text NOT NULL,
  `thread_report` tinyint(1) NOT NULL DEFAULT '0',
  `thread_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_counsellor_level_requirement`
--

CREATE TABLE `ot_counsellor_level_requirement` (
  `counsellor_level_id` int(11) NOT NULL,
  `counsellor_level_solutions` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ot_counsellor_level_requirement`
--

INSERT INTO `ot_counsellor_level_requirement` (`counsellor_level_id`, `counsellor_level_solutions`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16);

-- --------------------------------------------------------

--
-- Table structure for table `ot_featured`
--

CREATE TABLE `ot_featured` (
  `featured_id` int(11) NOT NULL,
  `featured_item_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_featured_author_file`
--

CREATE TABLE `ot_featured_author_file` (
  `featured_file_id` int(11) NOT NULL,
  `featured_file_user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_follower_level_requirement`
--

CREATE TABLE `ot_follower_level_requirement` (
  `follower_level_id` int(11) NOT NULL,
  `follower_level_users` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ot_follower_level_requirement`
--

INSERT INTO `ot_follower_level_requirement` (`follower_level_id`, `follower_level_users`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16);

-- --------------------------------------------------------

--
-- Table structure for table `ot_follower_list`
--

CREATE TABLE `ot_follower_list` (
  `follower_list_id` int(11) NOT NULL,
  `follower_parent_id` int(11) NOT NULL,
  `follower_user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_forum_category`
--

CREATE TABLE `ot_forum_category` (
  `forum_cat_id` int(11) NOT NULL,
  `forum_cat_name` varchar(50) NOT NULL,
  `forum_cat_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_forum_topic`
--

CREATE TABLE `ot_forum_topic` (
  `topic_id` int(11) NOT NULL,
  `topic_cat_id` int(11) NOT NULL,
  `topic_user_id` int(11) NOT NULL,
  `topic_title` varchar(100) NOT NULL,
  `topic_description` text NOT NULL,
  `topic_solved` tinyint(1) NOT NULL DEFAULT '0',
  `topic_answers` int(11) NOT NULL DEFAULT '0',
  `topic_status` tinyint(1) NOT NULL DEFAULT '1',
  `topic_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `topic_updated_time` datetime NOT NULL,
  `topic_admin_seen` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_forum_topic_answers`
--

CREATE TABLE `ot_forum_topic_answers` (
  `answer_id` int(11) NOT NULL,
  `answer_topic_id` int(11) NOT NULL,
  `answer_user_id` int(11) NOT NULL,
  `is_solution` tinyint(1) NOT NULL DEFAULT '0',
  `user_answer` text NOT NULL,
  `answer_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_hard_rejects`
--

CREATE TABLE `ot_hard_rejects` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_title` varchar(100) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `reason` varchar(555) NOT NULL,
  `user_comment` varchar(555) DEFAULT NULL,
  `instruction` varchar(555) DEFAULT NULL,
  `hard_reject_time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_hr_subject`
--

CREATE TABLE `ot_hr_subject` (
  `hr_sub_id` int(11) NOT NULL,
  `hr_sub_title` varchar(500) NOT NULL,
  `hr_sub_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_hr_title`
--

CREATE TABLE `ot_hr_title` (
  `hr_id` int(11) NOT NULL,
  `hr_title` varchar(100) NOT NULL,
  `hr_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_lovers`
--

CREATE TABLE `ot_lovers` (
  `lovers_id` int(11) NOT NULL,
  `lovers_user_id` int(11) NOT NULL,
  `lovers_item_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_notifications`
--

CREATE TABLE `ot_notifications` (
  `notification_id` int(11) NOT NULL,
  `n_type` tinyint(2) NOT NULL,
  `n_link` varchar(555) NOT NULL,
  `n_user_id` int(11) NOT NULL,
  `n_seen` tinyint(1) NOT NULL DEFAULT '0',
  `n_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_payments`
--

CREATE TABLE `ot_payments` (
  `payment_id` int(11) NOT NULL,
  `p_user_id` int(11) NOT NULL,
  `p_author_id` int(11) NOT NULL,
  `p_item_id` int(11) NOT NULL,
  `p_total_amt` decimal(18,2) NOT NULL,
  `p_commission` int(11) NOT NULL,
  `p_admin_earning` decimal(18,2) NOT NULL,
  `p_author_earning` decimal(18,2) NOT NULL,
  `payment_method` varchar(10) NOT NULL,
  `txn_id` varchar(255) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `payment_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `complete_status` tinyint(1) NOT NULL DEFAULT '0',
  `paid` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_ratings`
--

CREATE TABLE `ot_ratings` (
  `rating_id` int(11) NOT NULL,
  `rating_item_id` int(11) NOT NULL,
  `rating_user_id` int(11) NOT NULL,
  `rating_star` decimal(18,2) NOT NULL DEFAULT '0.00',
  `rating_report` tinyint(1) NOT NULL DEFAULT '0',
  `rating_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rating_comment` varchar(350) DEFAULT NULL,
  `rating_author_reply` varchar(350) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_refunds`
--

CREATE TABLE `ot_refunds` (
  `refund_id` int(11) NOT NULL,
  `r_txn_id` varchar(500) NOT NULL,
  `r_item_id` int(11) NOT NULL,
  `r_user_id` int(11) NOT NULL,
  `r_user_reason` text NOT NULL,
  `r_author_id` int(11) NOT NULL,
  `r_author_reason` text,
  `r_amount` decimal(18,2) NOT NULL,
  `r_status` tinyint(1) NOT NULL DEFAULT '0',
  `r_author_declined` tinyint(1) NOT NULL DEFAULT '0',
  `r_disputed` tinyint(1) NOT NULL DEFAULT '0',
  `r_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_tags`
--

CREATE TABLE `ot_tags` (
  `id` int(11) NOT NULL,
  `tag_item_id` int(11) NOT NULL,
  `tag_name` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_trendsetter`
--

CREATE TABLE `ot_trendsetter` (
  `trending_id` int(11) NOT NULL,
  `trending_user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_uploader_level_requirement`
--

CREATE TABLE `ot_uploader_level_requirement` (
  `uploader_level_id` int(11) NOT NULL,
  `uploader_level_videos` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ot_uploader_level_requirement`
--

INSERT INTO `ot_uploader_level_requirement` (`uploader_level_id`, `uploader_level_videos`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16);

-- --------------------------------------------------------

--
-- Table structure for table `ot_users`
--

CREATE TABLE `ot_users` (
  `id` int(11) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_payout_email` varchar(100) DEFAULT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_wallet` decimal(18,2) NOT NULL DEFAULT '0.00',
  `user_fullname` varchar(50) NOT NULL,
  `user_auth` varchar(60) NOT NULL,
  `user_temp_email` varchar(100) DEFAULT NULL,
  `user_otp` varchar(4) DEFAULT NULL,
  `u_chance` tinyint(1) NOT NULL DEFAULT '1',
  `user_dp` varchar(100) DEFAULT NULL,
  `user_about_us` varchar(555) DEFAULT NULL,
  `user_sold_items` int(11) NOT NULL DEFAULT '0',
  `user_sold_price` int(11) NOT NULL DEFAULT '0',
  `user_purchased_items` int(11) NOT NULL DEFAULT '0',
  `community_problem_solved` int(11) NOT NULL DEFAULT '0',
  `user_followers` int(11) NOT NULL DEFAULT '0',
  `user_following` int(11) NOT NULL DEFAULT '0',
  `user_loved_counting` int(11) NOT NULL DEFAULT '0',
  `insta_network` varchar(555) DEFAULT NULL,
  `fb_network` varchar(555) DEFAULT NULL,
  `twitter_network` varchar(555) DEFAULT NULL,
  `linkedin_network` varchar(555) DEFAULT NULL,
  `behance_network` varchar(555) DEFAULT NULL,
  `dribbble_network` varchar(555) DEFAULT NULL,
  `vk_network` varchar(555) DEFAULT NULL,
  `youtube_network` varchar(555) DEFAULT NULL,
  `user_blocked` tinyint(1) NOT NULL DEFAULT '0',
  `user_status` tinyint(1) NOT NULL DEFAULT '0',
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email_comment` tinyint(1) NOT NULL DEFAULT '1',
  `email_sale` tinyint(1) NOT NULL DEFAULT '1',
  `email_itemupdate_approve` tinyint(1) NOT NULL DEFAULT '1',
  `email_itemupdate_reject` tinyint(1) NOT NULL DEFAULT '1',
  `email_author_reply` tinyint(1) NOT NULL DEFAULT '1',
  `email_user_reply` tinyint(1) NOT NULL DEFAULT '1',
  `email_item_rating` tinyint(1) NOT NULL DEFAULT '1',
  `email_item_love` tinyint(1) NOT NULL DEFAULT '1',
  `email_payout_release` tinyint(1) NOT NULL DEFAULT '1',
  `email_forum_topic` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_users_temp_video`
--

CREATE TABLE `ot_users_temp_video` (
  `temp_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_category` int(11) DEFAULT NULL,
  `item_title` varchar(100) NOT NULL,
  `item_price` int(11) NOT NULL,
  `item_description` longtext NOT NULL,
  `item_tags` text NOT NULL,
  `item_main_file` varchar(100) DEFAULT NULL,
  `item_main_file_size` varchar(55) DEFAULT NULL,
  `item_preview_img` varchar(100) DEFAULT NULL,
  `item_demo_video` varchar(100) DEFAULT NULL,
  `item_demo_video_size` varchar(55) DEFAULT NULL,
  `reviewer_comment` varchar(300) DEFAULT NULL,
  `title_issue` tinyint(1) NOT NULL DEFAULT '0',
  `price_issue` tinyint(1) NOT NULL DEFAULT '0',
  `description_issue` tinyint(1) NOT NULL DEFAULT '0',
  `tags_issue` tinyint(1) NOT NULL DEFAULT '0',
  `category_issue` tinyint(1) NOT NULL DEFAULT '0',
  `preview_issue` tinyint(1) NOT NULL DEFAULT '0',
  `demo_issue` tinyint(1) NOT NULL DEFAULT '0',
  `mainfile_issue` tinyint(1) NOT NULL DEFAULT '0',
  `item_time` datetime NOT NULL,
  `item_soft_reject` tinyint(1) NOT NULL DEFAULT '0',
  `upload_success` tinyint(1) NOT NULL DEFAULT '0',
  `soft_reject_count` int(11) NOT NULL DEFAULT '0',
  `additonal_instruction` text,
  `temp_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_users_update_status`
--

CREATE TABLE `ot_users_update_status` (
  `status_id` int(11) NOT NULL,
  `status_item_id` int(11) NOT NULL,
  `status_user_id` int(11) NOT NULL,
  `status_reviewer_comment` varchar(500) DEFAULT NULL,
  `status_approved` varchar(50) NOT NULL DEFAULT 'Pending',
  `status_update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_users_video`
--

CREATE TABLE `ot_users_video` (
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_category` int(11) NOT NULL,
  `item_title` varchar(100) NOT NULL,
  `item_price` int(11) NOT NULL,
  `item_description` longtext NOT NULL,
  `item_tags` text NOT NULL,
  `item_mainfile` varchar(100) NOT NULL,
  `item_mainfile_size` varchar(100) NOT NULL,
  `item_preview_image` varchar(100) NOT NULL,
  `item_demo_video` varchar(100) NOT NULL,
  `item_created_time` datetime NOT NULL,
  `item_updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `item_status` tinyint(1) NOT NULL DEFAULT '1',
  `item_pause` tinyint(1) NOT NULL DEFAULT '1',
  `item_delete` tinyint(1) NOT NULL DEFAULT '1',
  `item_featured` tinyint(1) NOT NULL DEFAULT '0',
  `item_sale` int(11) NOT NULL DEFAULT '0',
  `item_rated_by` int(11) NOT NULL DEFAULT '0',
  `item_love` int(11) NOT NULL DEFAULT '0',
  `item_rating` decimal(18,2) NOT NULL DEFAULT '0.00',
  `item_viewed` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_users_video_update`
--

CREATE TABLE `ot_users_video_update` (
  `update_id` int(11) NOT NULL,
  `update_item_id` int(11) NOT NULL,
  `update_user_id` int(11) NOT NULL,
  `update_preview_image` varchar(200) DEFAULT NULL,
  `update_demo_file` varchar(200) DEFAULT NULL,
  `update_main_file` varchar(200) DEFAULT NULL,
  `zip_size` varchar(50) DEFAULT NULL,
  `update_item_category` int(11) DEFAULT '0',
  `update_comment` varchar(350) DEFAULT NULL,
  `update_upload_success` tinyint(1) NOT NULL DEFAULT '0',
  `update_closed` tinyint(1) NOT NULL DEFAULT '0',
  `reviewer_remark` varchar(300) DEFAULT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_user_purchases`
--

CREATE TABLE `ot_user_purchases` (
  `purchase_id` int(11) NOT NULL,
  `purchase_item_id` int(11) NOT NULL,
  `purchase_user_id` int(11) NOT NULL,
  `user_downloaded` tinyint(1) NOT NULL DEFAULT '0',
  `purchase_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `download_block` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_wallet`
--

CREATE TABLE `ot_wallet` (
  `wallet_id` int(11) NOT NULL,
  `w_txn_id` varchar(500) NOT NULL,
  `w_user_id` int(11) NOT NULL,
  `w_amt` decimal(18,2) NOT NULL DEFAULT '0.00',
  `w_payment_method` varchar(50) NOT NULL,
  `w_payment_status` varchar(50) NOT NULL,
  `w_payment_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `w_complete_status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ot_admin`
--
ALTER TABLE `ot_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ot_admin_pages`
--
ALTER TABLE `ot_admin_pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `ot_author_badge`
--
ALTER TABLE `ot_author_badge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ot_author_level_requirement`
--
ALTER TABLE `ot_author_level_requirement`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `ot_author_payouts`
--
ALTER TABLE `ot_author_payouts`
  ADD PRIMARY KEY (`payout_id`),
  ADD UNIQUE KEY `p_txn_id` (`p_txn_id`);

--
-- Indexes for table `ot_author_statement`
--
ALTER TABLE `ot_author_statement`
  ADD PRIMARY KEY (`statement_id`);

--
-- Indexes for table `ot_buyer_level_requirement`
--
ALTER TABLE `ot_buyer_level_requirement`
  ADD PRIMARY KEY (`buyer_level_id`);

--
-- Indexes for table `ot_category`
--
ALTER TABLE `ot_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `ot_comments`
--
ALTER TABLE `ot_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `ot_comment_thread`
--
ALTER TABLE `ot_comment_thread`
  ADD PRIMARY KEY (`comment_thread_id`);

--
-- Indexes for table `ot_counsellor_level_requirement`
--
ALTER TABLE `ot_counsellor_level_requirement`
  ADD PRIMARY KEY (`counsellor_level_id`);

--
-- Indexes for table `ot_featured`
--
ALTER TABLE `ot_featured`
  ADD PRIMARY KEY (`featured_id`);

--
-- Indexes for table `ot_featured_author_file`
--
ALTER TABLE `ot_featured_author_file`
  ADD PRIMARY KEY (`featured_file_id`);

--
-- Indexes for table `ot_follower_level_requirement`
--
ALTER TABLE `ot_follower_level_requirement`
  ADD PRIMARY KEY (`follower_level_id`);

--
-- Indexes for table `ot_follower_list`
--
ALTER TABLE `ot_follower_list`
  ADD PRIMARY KEY (`follower_list_id`);

--
-- Indexes for table `ot_forum_category`
--
ALTER TABLE `ot_forum_category`
  ADD PRIMARY KEY (`forum_cat_id`);

--
-- Indexes for table `ot_forum_topic`
--
ALTER TABLE `ot_forum_topic`
  ADD PRIMARY KEY (`topic_id`);

--
-- Indexes for table `ot_forum_topic_answers`
--
ALTER TABLE `ot_forum_topic_answers`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `ot_hard_rejects`
--
ALTER TABLE `ot_hard_rejects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ot_hr_subject`
--
ALTER TABLE `ot_hr_subject`
  ADD PRIMARY KEY (`hr_sub_id`);

--
-- Indexes for table `ot_hr_title`
--
ALTER TABLE `ot_hr_title`
  ADD PRIMARY KEY (`hr_id`);

--
-- Indexes for table `ot_lovers`
--
ALTER TABLE `ot_lovers`
  ADD PRIMARY KEY (`lovers_id`);

--
-- Indexes for table `ot_notifications`
--
ALTER TABLE `ot_notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `ot_payments`
--
ALTER TABLE `ot_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `ot_ratings`
--
ALTER TABLE `ot_ratings`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `ot_refunds`
--
ALTER TABLE `ot_refunds`
  ADD PRIMARY KEY (`refund_id`),
  ADD UNIQUE KEY `r_txn_id` (`r_txn_id`);

--
-- Indexes for table `ot_tags`
--
ALTER TABLE `ot_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ot_trendsetter`
--
ALTER TABLE `ot_trendsetter`
  ADD PRIMARY KEY (`trending_id`);

--
-- Indexes for table `ot_uploader_level_requirement`
--
ALTER TABLE `ot_uploader_level_requirement`
  ADD PRIMARY KEY (`uploader_level_id`);

--
-- Indexes for table `ot_users`
--
ALTER TABLE `ot_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `ot_users_temp_video`
--
ALTER TABLE `ot_users_temp_video`
  ADD PRIMARY KEY (`temp_id`);

--
-- Indexes for table `ot_users_update_status`
--
ALTER TABLE `ot_users_update_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `ot_users_video`
--
ALTER TABLE `ot_users_video`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `ot_users_video_update`
--
ALTER TABLE `ot_users_video_update`
  ADD PRIMARY KEY (`update_id`);

--
-- Indexes for table `ot_user_purchases`
--
ALTER TABLE `ot_user_purchases`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `ot_wallet`
--
ALTER TABLE `ot_wallet`
  ADD PRIMARY KEY (`wallet_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ot_admin_pages`
--
ALTER TABLE `ot_admin_pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_author_badge`
--
ALTER TABLE `ot_author_badge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_author_level_requirement`
--
ALTER TABLE `ot_author_level_requirement`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ot_author_payouts`
--
ALTER TABLE `ot_author_payouts`
  MODIFY `payout_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_author_statement`
--
ALTER TABLE `ot_author_statement`
  MODIFY `statement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_buyer_level_requirement`
--
ALTER TABLE `ot_buyer_level_requirement`
  MODIFY `buyer_level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ot_category`
--
ALTER TABLE `ot_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_comments`
--
ALTER TABLE `ot_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_comment_thread`
--
ALTER TABLE `ot_comment_thread`
  MODIFY `comment_thread_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_counsellor_level_requirement`
--
ALTER TABLE `ot_counsellor_level_requirement`
  MODIFY `counsellor_level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ot_featured`
--
ALTER TABLE `ot_featured`
  MODIFY `featured_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_featured_author_file`
--
ALTER TABLE `ot_featured_author_file`
  MODIFY `featured_file_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_follower_level_requirement`
--
ALTER TABLE `ot_follower_level_requirement`
  MODIFY `follower_level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ot_follower_list`
--
ALTER TABLE `ot_follower_list`
  MODIFY `follower_list_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_forum_category`
--
ALTER TABLE `ot_forum_category`
  MODIFY `forum_cat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_forum_topic`
--
ALTER TABLE `ot_forum_topic`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_forum_topic_answers`
--
ALTER TABLE `ot_forum_topic_answers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_hard_rejects`
--
ALTER TABLE `ot_hard_rejects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_hr_subject`
--
ALTER TABLE `ot_hr_subject`
  MODIFY `hr_sub_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_hr_title`
--
ALTER TABLE `ot_hr_title`
  MODIFY `hr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_lovers`
--
ALTER TABLE `ot_lovers`
  MODIFY `lovers_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_notifications`
--
ALTER TABLE `ot_notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_payments`
--
ALTER TABLE `ot_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_ratings`
--
ALTER TABLE `ot_ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_refunds`
--
ALTER TABLE `ot_refunds`
  MODIFY `refund_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_tags`
--
ALTER TABLE `ot_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_trendsetter`
--
ALTER TABLE `ot_trendsetter`
  MODIFY `trending_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_uploader_level_requirement`
--
ALTER TABLE `ot_uploader_level_requirement`
  MODIFY `uploader_level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ot_users`
--
ALTER TABLE `ot_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_users_temp_video`
--
ALTER TABLE `ot_users_temp_video`
  MODIFY `temp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_users_update_status`
--
ALTER TABLE `ot_users_update_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_users_video`
--
ALTER TABLE `ot_users_video`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_users_video_update`
--
ALTER TABLE `ot_users_video_update`
  MODIFY `update_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_user_purchases`
--
ALTER TABLE `ot_user_purchases`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_wallet`
--
ALTER TABLE `ot_wallet`
  MODIFY `wallet_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
