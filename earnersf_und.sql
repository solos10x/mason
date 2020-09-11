-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2020 at 12:54 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `earnersf_und`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `author` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `image` varchar(200) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `author`, `message`, `image`, `date`) VALUES
(3, 'first', 'solos', 'PLEASE NOTE: \nRECIPIENT LIST WILL BE PUBLISHED EVERY 2HOURS FROM 8AM TO 8PM MONDAY THROUGH FRIDAY.', 'Off', '2017-03-21 07:33:49'),
(4, '', '', 'That will be all for today. New list will be out tomorrow by 8AM', 'On', '2017-03-21 07:39:52'),
(5, 'this the first', 'solomon', '&lt;div class=&quot;portlet-body col-md-4&quot;&gt;\r\n&lt;div class=&quot;note note-info &quot;&gt;\r\n&lt;h4 class=&quot;block&quot;&gt;Success! Some Header Goes Here&lt;/h4&gt;\r\n&lt;p&gt;Duis mollis, est non commodo luctus, nisi erat mattis consectetur purus sit amet porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;', '', '2017-06-29 23:24:03'),
(6, 'i should know by now ', '', '', '', '2017-06-30 11:43:50');

-- --------------------------------------------------------

--
-- Table structure for table `broadcast`
--

CREATE TABLE `broadcast` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `status` enum('On','Off') NOT NULL DEFAULT 'Off',
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `broadcast`
--

INSERT INTO `broadcast` (`id`, `message`, `status`, `date`) VALUES
(3, 'PLEASE NOTE: \nRECIPIENT LIST WILL BE PUBLISHED EVERY 2HOURS FROM 8AM TO 8PM MONDAY THROUGH FRIDAY.', 'Off', '2017-03-21 07:33:49'),
(4, 'That will be all for today. New list will be out tomorrow by 8AM', 'Off', '2017-03-21 07:39:52');

-- --------------------------------------------------------

--
-- Table structure for table `hold`
--

CREATE TABLE `hold` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT '0',
  `info` text NOT NULL,
  `user_status` enum('hold','pending','awaiting_release','completed') NOT NULL DEFAULT 'hold',
  `referred_uid` int(11) NOT NULL,
  `referred_status` enum('hold','pending','completed') NOT NULL DEFAULT 'hold',
  `released_to_activity` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hold`
--

INSERT INTO `hold` (`id`, `uid`, `username`, `type`, `amount`, `info`, `user_status`, `referred_uid`, `referred_status`, `released_to_activity`, `date`) VALUES
(22, 9, 'nadaeza', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'completed', 10, 'completed', 0, '2017-03-16 06:30:08'),
(23, 9, 'nadaeza', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 11, 'pending', 0, '2017-03-16 07:03:02'),
(24, 9, 'nadaeza', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 12, 'hold', 0, '2017-03-16 07:04:45'),
(25, 9, 'nadaeza', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 13, 'hold', 0, '2017-03-16 07:13:34'),
(26, 9, 'nadaeza', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 14, 'completed', 0, '2017-03-16 07:48:22'),
(27, 9, 'nadaeza', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 15, 'hold', 0, '2017-03-16 08:01:23'),
(28, 9, 'nadaeza', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 16, 'hold', 0, '2017-03-16 08:29:54'),
(29, 9, 'nadaeza', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 17, 'hold', 0, '2017-03-16 08:35:25'),
(30, 9, 'nadaeza', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 18, 'hold', 0, '2017-03-16 08:55:31'),
(31, 9, 'nadaeza', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 19, 'hold', 0, '2017-03-16 08:58:52'),
(32, 9, 'nadaeza', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 20, 'hold', 0, '2017-03-16 09:04:09'),
(33, 9, 'nadaeza', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 21, 'hold', 0, '2017-03-16 09:14:05'),
(34, 9, 'nadaeza', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 22, 'hold', 0, '2017-03-16 10:44:45'),
(35, 9, 'nadaeza', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 23, 'hold', 0, '2017-03-16 12:04:31'),
(36, 9, 'nadaeza', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 24, 'hold', 0, '2017-03-16 13:49:55'),
(37, 9, 'nadaeza', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 25, 'completed', 0, '2017-03-16 15:29:27'),
(38, 9, 'nadaeza', 'Referral Bonus', 20, '5% of incentive gained ($300) as a result of donating the sum of $200 to nadaeza', 'hold', 9, 'completed', 0, '2017-03-19 18:30:40'),
(39, 9, 'nadaeza', 'listed Hold', 75, '5% of incentive gained ($1500) as a result of donating the sum of $1000 to cliff', 'hold', 26, 'completed', 0, '2017-03-19 18:57:47'),
(40, 25, 'basheer', 'listed Hold', 4, '5% of incentive gained ($75) as a result of donating the sum of $50 to nadaeza', 'awaiting_release', 9, 'completed', 0, '2017-03-19 20:34:42'),
(41, 11, 'ebonysue', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 31, 'hold', 0, '2017-03-20 02:32:29'),
(43, 30, 'ehis', 'listed Hold', 126, '5% of incentive gained ($2520) as a result of donating the sum of $1680 to peter', 'hold', 23, 'completed', 0, '2017-03-20 03:22:39'),
(44, 11, 'ebonysue', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'pending', 32, 'completed', 0, '2017-03-20 03:48:08'),
(45, 11, 'ebonysue', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 33, 'hold', 0, '2017-03-20 03:49:27'),
(46, 32, 'Mauryn', 'listed Hold', 6, '5% of incentive gained ($120) as a result of donating the sum of $80 to ebonysue', 'awaiting_release', 11, 'completed', 0, '2017-03-20 03:55:12'),
(47, 32, 'Mauryn', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 35, 'hold', 0, '2017-03-20 04:40:46'),
(48, 35, 'Ceewhy', 'listed Hold', 4, '5% of incentive gained ($75) as a result of donating the sum of $50 to blackteddy', 'hold', 10, 'completed', 0, '2017-03-20 05:05:25'),
(49, 35, 'Ceewhy', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 38, 'hold', 0, '2017-03-20 05:26:02'),
(50, 11, 'ebonysue', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 39, 'hold', 0, '2017-03-20 05:29:00'),
(51, 38, 'mcteepee', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 41, 'hold', 0, '2017-03-20 05:41:45'),
(52, 38, 'mcteepee', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 42, 'hold', 0, '2017-03-20 05:44:40'),
(53, 11, 'ebonysue', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 45, 'hold', 0, '2017-03-20 05:47:18'),
(54, 38, 'mcteepee', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 46, 'hold', 0, '2017-03-20 05:48:47'),
(55, 38, 'mcteepee', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 47, 'hold', 0, '2017-03-20 05:50:23'),
(56, 38, 'mcteepee', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 48, 'hold', 0, '2017-03-20 05:51:41'),
(62, 38, 'mcteepee', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 56, 'hold', 0, '2017-03-20 06:24:27'),
(58, 38, 'mcteepee', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 51, 'hold', 0, '2017-03-20 05:55:31'),
(59, 50, 'cooljennyt', 'listed Hold', 4, '5% of incentive gained ($75) as a result of donating the sum of $50 to boluwatife', 'hold', 19, 'completed', 0, '2017-03-20 06:03:49'),
(60, 38, 'mcteepee', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 53, 'hold', 0, '2017-03-20 06:05:58'),
(61, 38, 'mcteepee', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 54, 'hold', 0, '2017-03-20 06:11:30'),
(63, 31, 'cheekah', 'instant Hold', 6, '20% of incentive gained ($30) as a result of donating the sum of $30 to boluwatife', 'hold', 19, 'completed', 0, '2017-03-20 06:30:17'),
(64, 39, 'Harbay', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 59, 'hold', 0, '2017-03-20 11:51:00'),
(65, 22, 'surebukky', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 60, 'hold', 0, '2017-03-20 12:01:25'),
(68, 9, 'nadaeza', 'Referral Bonus', 20, 'Bonus gained for refering a new member to the platform', 'hold', 64, 'completed', 0, '2017-03-22 02:50:02'),
(67, 11, 'ebonysue', 'instant Hold', 16, '20% of incentive gained ($80) as a result of donating the sum of $80 to Ohirash', 'pending', 27, 'completed', 0, '2017-03-21 08:28:09'),
(69, 11, 'ebonysue', 'instant Hold', 160, '20% of incentive gained ($800) as a result of donating the sum of $800 to cliff', 'hold', 26, 'completed', 0, '2017-03-22 03:25:43'),
(70, 11, 'ebonysue', 'listed Hold', 8, '5% of incentive gained ($157.5) as a result of donating the sum of $105 to Salawau47', 'hold', 13, 'completed', 0, '2017-03-22 03:27:21'),
(71, 64, 'jacknas', 'instant Hold', 12, '20% of incentive gained ($60) as a result of donating the sum of $60 to Mauryn', 'awaiting_release', 32, 'completed', 0, '2017-03-22 03:27:22'),
(72, 11, 'ebonysue', 'instant Hold', 20, '20% of incentive gained ($100) as a result of donating the sum of $100 to saggatmedia', 'hold', 15, 'completed', 0, '2017-03-22 03:30:55'),
(73, 11, 'ebonysue', 'instant Hold', 20, '20% of incentive gained ($100) as a result of donating the sum of $100 to basheer', 'hold', 25, 'completed', 0, '2017-03-22 03:31:45');

-- --------------------------------------------------------

--
-- Table structure for table `incoming`
--

CREATE TABLE `incoming` (
  `id` int(11) NOT NULL,
  `activityID` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `amount` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `status` enum('Pending','Completed') NOT NULL DEFAULT 'Pending',
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `incoming`
--

INSERT INTO `incoming` (`id`, `activityID`, `uid`, `username`, `amount`, `type`, `status`, `date`) VALUES
(12, 1628, 9, 'nadaeza', 120, 'Instant', 'Completed', '2017-03-19 18:04:54'),
(13, 1629, 27, 'Ohirash', 80, 'Instant', 'Completed', '2017-03-19 18:11:29'),
(14, 1630, 11, 'ebonysue', 80, 'Instant', 'Completed', '2017-03-19 18:38:52'),
(15, 1631, 26, 'cliff', 60, 'Listed', '', '2017-03-19 18:41:17'),
(16, 1632, 26, 'cliff', 800, 'Instant', 'Completed', '2017-03-19 18:44:31'),
(17, 1633, 14, 'yahaya18', 100, 'Instant', '', '2017-03-19 18:48:02'),
(18, 1634, 19, 'boluwatife', 110, 'Instant', '', '2017-03-19 18:52:04'),
(19, 1635, 9, 'blackteddy', 50, 'Listed', 'Completed', '2017-03-19 19:21:47'),
(27, 1643, 32, 'Mauryn', 194, 'Instant', '', '2017-03-20 04:24:41'),
(21, 1637, 13, 'Salawau47', 105, 'Listed', 'Completed', '2017-03-19 19:34:28'),
(22, 1638, 22, 'surebukky', 75, 'Listed', '', '2017-03-19 20:08:24'),
(23, 1639, 25, 'basheer', 145, 'Instant', '', '2017-03-19 20:37:46'),
(24, 1640, 14, 'yahaya18', 80, 'Instant', '', '2017-03-19 20:42:04'),
(25, 1641, 25, 'basheer', 100, 'Instant', 'Completed', '2017-03-19 20:44:04'),
(26, 1642, 9, 'kingsleyk', 200, 'Instant', 'Pending', '2017-03-19 20:57:28'),
(28, 1644, 15, 'saggatmedia', 100, 'Instant', 'Completed', '2017-03-20 07:44:12'),
(29, 1645, 13, 'Salawau47', 80, 'Instant', '', '2017-03-20 07:45:57'),
(30, 1646, 12, 'tripleaarnold', 60, 'Instant', '', '2017-03-20 07:50:43'),
(31, 1647, 64, 'jacknas', 108, 'Instant', '', '2017-03-22 12:14:57'),
(32, 1648, 10, 'blackteddy', 200, 'Timed', '', '2017-05-30 10:21:46');

-- --------------------------------------------------------

--
-- Table structure for table `outgoing`
--

CREATE TABLE `outgoing` (
  `id` int(11) NOT NULL,
  `activityID` int(11) NOT NULL DEFAULT '1',
  `recipient_uid` int(11) NOT NULL,
  `recipient_username` varchar(200) NOT NULL,
  `donor_uid` int(11) NOT NULL,
  `donor_username` varchar(200) NOT NULL,
  `donate_amount` int(11) NOT NULL DEFAULT '0',
  `current_incentive_percent` int(11) NOT NULL,
  `current_incentive_hold` int(11) NOT NULL,
  `profit_earned` int(11) NOT NULL,
  `profit_hold` int(11) NOT NULL,
  `previous_held` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `status` enum('Reserved','Paid','Confirmed','Unconfirmed') NOT NULL DEFAULT 'Reserved',
  `resultant_activity` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outgoing`
--

INSERT INTO `outgoing` (`id`, `activityID`, `recipient_uid`, `recipient_username`, `donor_uid`, `donor_username`, `donate_amount`, `current_incentive_percent`, `current_incentive_hold`, `profit_earned`, `profit_hold`, `previous_held`, `type`, `status`, `resultant_activity`, `date`) VALUES
(20, 1628, 9, 'nadaeza', 14, 'yahaya18', 200, 150, 5, 300, 15, 0, 'Instant', 'Confirmed', 1640, '2017-03-19 18:30:40'),
(22, 1628, 9, 'nadaeza', 25, 'basheer', 50, 150, 5, 75, 4, 0, 'Instant', 'Confirmed', 1639, '2017-03-19 20:34:42'),
(26, 1635, 10, 'blackteddy', 35, 'Ceewhy', 50, 150, 5, 75, 4, 0, 'Listed', 'Reserved', 0, '2017-03-20 05:05:25'),
(25, 1630, 11, 'ebonysue', 32, 'Mauryn', 80, 150, 5, 120, 6, 0, 'Instant', 'Confirmed', 1643, '2017-03-20 03:55:12'),
(29, 1634, 19, 'boluwatife', 31, 'cheekah', 30, 100, 20, 30, 6, 0, 'Instant', 'Reserved', 0, '2017-03-20 06:30:17'),
(32, 1632, 26, 'cliff', 11, 'ebonysue', 800, 100, 20, 800, 160, 0, 'Instant', 'Reserved', 0, '2017-03-22 03:25:43'),
(31, 1629, 27, 'Ohirash', 11, 'ebonysue', 80, 100, 20, 80, 16, 0, 'Instant', 'Paid', 0, '2017-03-21 08:28:09'),
(33, 1637, 13, 'Salawau47', 11, 'ebonysue', 105, 150, 5, 158, 8, 0, 'Listed', 'Reserved', 0, '2017-03-22 03:27:21'),
(34, 1643, 32, 'Mauryn', 64, 'jacknas', 60, 100, 20, 60, 12, 0, 'Instant', 'Confirmed', 1647, '2017-03-22 03:27:22'),
(35, 1644, 15, 'saggatmedia', 11, 'ebonysue', 100, 100, 20, 100, 20, 0, 'Instant', 'Reserved', 0, '2017-03-22 03:30:55'),
(36, 1641, 25, 'basheer', 11, 'ebonysue', 100, 100, 20, 100, 20, 0, 'Instant', 'Reserved', 0, '2017-03-22 03:31:45');

-- --------------------------------------------------------

--
-- Table structure for table `postads`
--

CREATE TABLE `postads` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `postads`
--

INSERT INTO `postads` (`id`, `title`, `image`, `date`) VALUES
(1, 'title', '', '2017-06-29 22:27:35'),
(2, 'title', '', '2017-06-29 22:35:47'),
(3, 'this the first', '', '2017-06-29 23:17:28'),
(4, 'this the first', '', '2017-06-29 23:20:41'),
(5, 'tilt', '', '2017-06-30 11:48:41');

-- --------------------------------------------------------

--
-- Table structure for table `setup`
--

CREATE TABLE `setup` (
  `id` int(11) NOT NULL,
  `bitcoin_value` int(11) NOT NULL DEFAULT '1',
  `dollar_to_naira` int(11) NOT NULL DEFAULT '1',
  `instant_incentive` int(11) NOT NULL DEFAULT '1',
  `instant_incentive_hold` int(11) NOT NULL DEFAULT '0',
  `instant_minimum` int(11) NOT NULL DEFAULT '1',
  `listed_incentive` int(11) NOT NULL DEFAULT '1',
  `listed_incentive_hold` int(11) NOT NULL DEFAULT '5',
  `listed_minimum` int(11) NOT NULL DEFAULT '1',
  `referral_bonus` int(11) NOT NULL DEFAULT '0',
  `list_limit` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setup`
--

INSERT INTO `setup` (`id`, `bitcoin_value`, `dollar_to_naira`, `instant_incentive`, `instant_incentive_hold`, `instant_minimum`, `listed_incentive`, `listed_incentive_hold`, `listed_minimum`, `referral_bonus`, `list_limit`) VALUES
(1, 1135540, 11356, 100, 20, 30, 150, 5, 50, 15, 6);

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

CREATE TABLE `support` (
  `id` int(11) NOT NULL,
  `ticketID` int(11) NOT NULL,
  `type` enum('Main','Reply') NOT NULL DEFAULT 'Main',
  `ticket_owner` int(11) NOT NULL DEFAULT '0',
  `uid` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `image` varchar(200) NOT NULL,
  `user_view_status` enum('0','1') NOT NULL DEFAULT '0',
  `admin_view_status` enum('0','1') NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  `department` enum('admin','super_admin','developer') NOT NULL DEFAULT 'admin'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `support`
--

INSERT INTO `support` (`id`, `ticketID`, `type`, `ticket_owner`, `uid`, `username`, `category`, `message`, `image`, `user_view_status`, `admin_view_status`, `date`, `department`) VALUES
(13, 398375, 'Main', 0, 9, 'nadaeza', 'Others', 'pls i want my admission now', '1496094912.jpg', '1', '1', '2017-05-29 22:55:12', 'admin'),
(14, 398375, 'Main', 0, 0, 'Admin', 'Others', 'sorry dear i dont give a fuck', '', '1', '1', '2017-05-29 22:58:02', 'admin'),
(15, 398376, 'Main', 0, 10, 'blackteddy', 'Enquiry', 'i want fuck you ', '', '0', '1', '2017-05-30 22:56:37', 'admin'),
(16, 398377, 'Main', 0, 30, 'ehis', 'Enquiry', 'i wnt to fuck', '1496183597.jpg', '0', '1', '2017-05-30 23:33:17', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tempusers`
--

CREATE TABLE `tempusers` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `confirmation_link` varchar(200) NOT NULL,
  `referral` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tempusers`
--

INSERT INTO `tempusers` (`id`, `email`, `password`, `confirmation_link`, `referral`) VALUES
(27, 'wiseanealkane@gmail.com', 'a0292e289e7744f47a56e2db82eff1ef', 'UPHElc9ADT2B1OfbzetL7nJRqwaxYQoqi1v8VC6S854Zf61kd3c2', 'nadaeza'),
(25, 'aliusalawau47@gmail.com', 'a0292e289e7744f47a56e2db82eff1ef', 'jiA9Bbf4ePU2WgTyJZSNpx715R6u355TsYf6mdyrnG02Fvqxjo77', 'nadaeza'),
(53, 'Obasam68@gmail.com', '238866c611ae4247404cc129bf94c6a9', 'bIFLlUGMPsCg3V6rJmNwAEnh4dfoE0Cfg0T5G0de5x9bapnUe12v', ''),
(55, 'eugose9@gmail.com', 'd39c7305ad346589880cc09dbc336326', '1qw5lPnJkYy07sAgeMOCbFojBVxBMH37Idz878C6cN6dbf0c6mV3', 'ebonysue'),
(42, 'berbatundey007@gmail.com', 'a0292e289e7744f47a56e2db82eff1ef', 'qr83JxRThlWEv5CMnpPLsabAdeF0ImaM05v03124LGdb2EpH8SR1', 'nadaeza'),
(40, 'aleemfarouk08@yahoo.com', 'a0292e289e7744f47a56e2db82eff1ef', 'PI3YcOBjCZhF5pR6UmaTdrfWJz6MQ6S3aWasedlkpnUzNf687256', 'nadaeza'),
(41, 'berbatundey@gmail.com', 'a0292e289e7744f47a56e2db82eff1ef', 'naGNLbYZpw7ZgO0ocUfA5euxmHh8o51Zn6Z8x1P3yUb540uF2Haa', 'nadaeza'),
(33, 'aajibola41@gmail.com', 'a0292e289e7744f47a56e2db82eff1ef', 'ritRVJBLAo6zfTpwbSCe9UZW7gVxg8PsZa034SUpfBIT4LW653ek', 'nadaeza'),
(45, 'musasodik@gmail.com', 'ddfcea53082a1141af1015179a0479da', 'RZc2ajo1bpiW5LkfqG4dy3VHmIH986M4dPc0f244yUF23d2j58Vz', ''),
(49, 'martinet1457@gmail.com', '3e1e05c86b290e8aa210b7d2cbd19039', 'IBSza7QxrubyhTJEdUws8oinHYn3TPsc01Z94A6BGq5D6fa5uUbS', ''),
(56, 'martinet1457@gmail.com', '3e1e05c86b290e8aa210b7d2cbd19039', 'MzQWPj5shcZapnDB0T6wv83AelYfClU86Z7Jc0x1932FVe32yR07', ''),
(60, 'Ajayiabisola20@gmail.com', '04f6381ad26676178a3384973720f31d', 'spYM49j0Ja5r2i8vkGIdlcgANLdzojr7g6c0sa900buk37291H5e', ''),
(111, 'Aremudeleolusegun@gmail.com', '7c49b153d4b59f8c0cf8c3e18dc80cb7', 'LWEkHofOrU7Z2gVS6jZDIBzi5Cfd6vkxTnP4qi7BjUdg2o4my7bp', ''),
(84, 'pammaryo@gmail.com', 'bbdd0e294fd183663ccadb3d3f94dca1', '2VAQTjSZxRGtBN4W6UJkLsCYlw30yO9Ni6Saw0f7nBsmlZVe7AF1', 'lilyd'),
(82, 'georgemna@yahoo.com', '84fd09185e93f3f41e0759e9735cd036', 'fBo9DGu23g0Izc7NY6VvOFhQRw4bIf9j3o9t0CYyDa2Oidelcc5N', ''),
(83, 'tenibegiloju@gmail.com', 'de855d979f1e0725c2aa9617f2e1d236', 'vB5SmdZ1kLgUpO8n6h2NYyzio787Dc1x2s78e629W7aej6CdYf4p', 'mcteepee'),
(65, 'charismaagu@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'tbRZJUV0CS9ypcvF6nlkzr7jxZeexcO0f185U9bbCadwb04e45TG', 'Mcteepee'),
(74, 'jacobtarz@gmail.com', 'a0d084955e6c731b494700d37feb3926', 'nMV1pRfDosi6gIkl4WT9HyZ0OEZc0f1ilhtuPVbM233R8asL03De', 'Mcteepee'),
(68, 'sirraymond2@gmail.com', 'c5e572589ad12e8109a4bf3cf412d997', 'HBFvEqa6TAZSx57j1gIGmcfudtc9yAF65Zfas4ZVMxoR5uq5H9U6', 'Mcteepee'),
(69, 'tessychichi@yahoo.com', '74a5f8465312e14c722208807080602c', 'UTW6BS7QzPjFdMRYhy1ap2sL90V6940x2dZ63ee77Io0w937nz6d', ''),
(92, 'faithike65@gmail.com', '9267d921862f7a0afcdafe579527e4d6', 'SRk21T6myJUpMP3svwuIOADVjCN3s07Ticyfo2VBfLe972a5U6gt', 'Mcteepee'),
(71, 'patienceawa2015@gmail.com', 'd66d08a4f60a7e3a30dbe19d5d735570', 'PZuJ9D5ShlRCVsQNTdkcx640eBm967QbJehyd7aI7s4bdg0Wanre', ''),
(73, 'cleopasjennifer100@gmail.com', '5682d9b29d46f1b8e7355be7e24b8633', 'sEYTMZA4iynFQe7OLCtlRmhIxB1v238Z15geqTf6rOiSb05aVMa6', ''),
(86, 'Kazeemjide123@gmail.com', 'ce16fe4978c0682c3ba03d4e99e83fe3', 'styal0G2Pk1JxYj6FuEScpNAVi1sDyb4ddge4e8da7G8J34RQc38', 'Mercyfavour'),
(85, 'egbuleud3124@gmail.com', 'bb055f0f4d7b53c750bb3bdb2eb988d0', 'YsHgjyuPWmxIC9kLcJUh70TroONb3qd7Gf6ckI5EraiW8d7Smg44', 'Mcteepee'),
(87, 'hizrael18@gmail.com', '26eb83f1b23d5ce00b5ffce257905b81', '2ZOirEn1WC53ha7so6NmyIHbzYiCBoO5eb1Z6baI2bwA2Z0H5LaT', ''),
(91, 'ekeleobed5@gmail.com', 'be121740bf988b2225a313fa1f107ca1', 'gJujzViqe2O98h13QfDSNUdBPR480d2rY2N2nG5HUiMbp3qho0J0', 'mcteepee'),
(94, 'andersonraymond15@gmail.comd', '39270c8ce6dc66d52bf45e19d1446c5c', 'c0hTk5Ys7by4ZarZdtEn6eADWUdQdGVcR8dn69p0of09474il7gq', ''),
(95, 'seggzzy@gmail.com', '7c49b153d4b59f8c0cf8c3e18dc80cb7', 'O73aH4dU6QxBuDLeCME5JtGmwRPaUGd7C3Vpe8a2D9ix5T6fZEml', ''),
(106, 'dammie2die4@gmail.com', 'eddfefbe9af4d7b9b18c2604e7d47907', 'txaYk9fbsB5mjv72QIrcURCFgd02WU6t99dD4pyA54ko0QaL3MFv', 'Harbay'),
(104, 'dammie2die4@gmail.com', 'eddfefbe9af4d7b9b18c2604e7d47907', 'glmoGdB7AIUJLc2ea8TRSOMEuqh00z9FfqNC3ZJMpAcVDfW8S5B5', 'Harbay'),
(103, 'johnterry12690@gmail.com', 'fe88f32e163296f6935aaefddf0af52a', 'nfZEQ65qu7dxsN3GRtkjoVYSDOYt09eIcfcj3Lfap6Pm7105hyZz', 'blackteddy'),
(102, 'Seggzzy@gmail.com', '7c49b153d4b59f8c0cf8c3e18dc80cb7', 'ZtCmnANO89qHLiB04ewhuTSvl22uaV8G9Z15Wn950SzCe0Bvje2k', ''),
(101, 'labakpraise@gmail.com', '08b75b754da09a66e623af1b39fbe061', 'YJV5CyGNSWBEg46f3A0pZ9Tqzve5z0uwW9V3Bn1NUGPf1b899s79', ''),
(107, 'mekdon1@yaHoo.com', '9534a400749a27dd3312e3f6bbc1a1cf', 'bYqD49cp6iUgfJG1oZA3LykI8Suxofd7ae66a45YHs1zqbjdar40', ''),
(115, 'femmybaf@gmail.com', 'b714ec9bb35870da54ca863e1012b24d', '0yAiRo82TYcU9nwGZuHte4gFNJb9S669x2aUFdNjYg7f36Hcd854', ''),
(114, 'reginald.okonkwo@yahoo.com', '5e02c46a4ac09c40a1a277e71e15182c', '6v3xVQmnrC2N9OoZLZwBuEekziY1f8Qdb37102Z3D6xb44dJN5gF', ''),
(117, 'suzypat0@gmail.com', '96d45ddc0dfefba31494de7fdd2014b6', '7UTaOzD6lY4cstZWLBEqH2pikAcdaa6Vnk85fO2cgseov8R75cfx', 'nadaeza'),
(118, 'suzypat0@gmail.com', '96d45ddc0dfefba31494de7fdd2014b6', '3bqYVt9y0g8lGIPJnp7NxFo2OveihTR2blbL3SPZF567U3fN0GwY', 'nadaeza'),
(119, 'mypeacehascome@yahoo.com', 'a0292e289e7744f47a56e2db82eff1ef', '26e409gfMFk7JSdZTqhojRHOsLSxovlU1uwfRp0gdnmbYasy919b', 'nadaeza');

-- --------------------------------------------------------

--
-- Table structure for table `timeline`
--

CREATE TABLE `timeline` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `info` text NOT NULL,
  `type` varchar(200) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timeline`
--

INSERT INTO `timeline` (`id`, `uid`, `info`, `type`, `date`) VALUES
(90, 9, 'You updated your profile basic details', 'Basic Update', '2017-03-15 08:45:16'),
(91, 9, 'You updated your bank details', 'Bank Update', '2017-03-15 17:42:52'),
(92, 9, 'You updated your bitcoin details', 'Bitcoin Update', '2017-03-15 17:53:29'),
(93, 10, 'You updated your profile basic details', 'Basic Update', '2017-03-16 06:32:11'),
(94, 10, 'You updated your bank details', 'Bank Update', '2017-03-16 06:33:12'),
(95, 11, 'You updated your profile basic details', 'Basic Update', '2017-03-16 07:04:13'),
(96, 11, 'You updated your profile basic details', 'Basic Update', '2017-03-16 07:05:08'),
(97, 11, 'You updated your bank details', 'Bank Update', '2017-03-16 07:08:43'),
(98, 13, 'You updated your profile basic details', 'Basic Update', '2017-03-16 07:36:33'),
(99, 13, 'You updated your bank details', 'Bank Update', '2017-03-16 07:37:47'),
(100, 13, 'You updated your password', 'Password Update', '2017-03-16 07:38:36'),
(101, 14, 'You updated your profile basic details', 'Basic Update', '2017-03-16 07:51:09'),
(102, 14, 'You updated your bank details', 'Bank Update', '2017-03-16 07:52:00'),
(103, 15, 'You updated your profile basic details', 'Basic Update', '2017-03-16 08:06:19'),
(104, 15, 'You updated your bank details', 'Bank Update', '2017-03-16 08:07:23'),
(105, 18, 'You updated your password', 'Password Update', '2017-03-16 09:00:35'),
(106, 19, 'You updated your profile basic details', 'Basic Update', '2017-03-16 09:03:08'),
(107, 12, 'You updated your profile basic details', 'Basic Update', '2017-03-16 09:53:33'),
(108, 12, 'You updated your profile basic details', 'Basic Update', '2017-03-16 09:53:41'),
(109, 12, 'You updated your profile basic details', 'Basic Update', '2017-03-16 09:54:03'),
(110, 12, 'You updated your bank details', 'Bank Update', '2017-03-16 09:57:46'),
(111, 23, 'You updated your profile basic details', 'Basic Update', '2017-03-16 12:12:42'),
(112, 23, 'You updated your bank details', 'Bank Update', '2017-03-16 12:14:32'),
(113, 26, 'You updated your profile basic details', 'Basic Update', '2017-03-19 17:47:54'),
(114, 26, 'You updated your bank details', 'Bank Update', '2017-03-19 17:50:13'),
(115, 27, 'You updated your profile basic details', 'Basic Update', '2017-03-19 18:04:24'),
(116, 9, 'You have been scheduled to receive with Donation ID <span class=\"label label-sm label-success\">1628</span>', 'Schedule To Receive', '2017-03-19 18:04:54'),
(117, 27, 'You updated your bank details', 'Bank Update', '2017-03-19 18:05:23'),
(118, 27, 'You have been scheduled to receive with Donation ID <span class=\"label label-sm label-success\">1629</span>', 'Schedule To Receive', '2017-03-19 18:11:29'),
(119, 28, 'You updated your profile basic details', 'Basic Update', '2017-03-19 18:28:03'),
(120, 28, 'You updated your bank details', 'Bank Update', '2017-03-19 18:28:48'),
(121, 14, 'You made a reservation on Activity ID <span class=\"label label-sm label-success\">1628</span>', 'Reservation', '2017-03-19 18:30:40'),
(122, 9, 'A reservation was made on your Activity with ID <span class=\"label label-sm label-success\">1628</span>', 'Reservation', '2017-03-19 18:30:40'),
(123, 11, 'You have been scheduled to receive with Donation ID <span class=\"label label-sm label-success\">1630</span>', 'Schedule To Receive', '2017-03-19 18:38:52'),
(124, 26, 'You have been scheduled to receive with Donation ID <span class=\"label label-sm label-success\">1631</span>', 'Schedule To Receive', '2017-03-19 18:41:17'),
(125, 26, 'You have been scheduled to receive with Donation ID <span class=\"label label-sm label-success\">1632</span>', 'Schedule To Receive', '2017-03-19 18:44:31'),
(126, 14, 'You have been scheduled to receive with Donation ID <span class=\"label label-sm label-success\">1633</span>', 'Schedule To Receive', '2017-03-19 18:48:02'),
(127, 19, 'You have been scheduled to receive with Donation ID <span class=\"label label-sm label-success\">1634</span>', 'Schedule To Receive', '2017-03-19 18:52:04'),
(128, 9, 'You made a reservation on Activity ID <span class=\"label label-sm label-success\">1631</span>', 'Reservation', '2017-03-19 18:57:47'),
(129, 26, 'A reservation was made on your Activity with ID <span class=\"label label-sm label-success\">1631</span>', 'Reservation', '2017-03-19 18:57:47'),
(130, 10, 'You have been scheduled to receive with Donation ID <span class=\"label label-sm label-success\">1635</span>', 'Schedule To Receive', '2017-03-19 19:21:47'),
(131, 23, 'You have been scheduled to receive with Donation ID <span class=\"label label-sm label-success\">1636</span>', 'Schedule To Receive', '2017-03-19 19:25:05'),
(132, 13, 'You have been scheduled to receive with Donation ID <span class=\"label label-sm label-success\">1637</span>', 'Schedule To Receive', '2017-03-19 19:34:28'),
(133, 22, 'You updated your profile basic details', 'Basic Update', '2017-03-19 19:40:47'),
(134, 22, 'You updated your bank details', 'Bank Update', '2017-03-19 19:42:06'),
(135, 24, 'You updated your profile basic details', 'Basic Update', '2017-03-19 19:53:56'),
(136, 24, 'You updated your bank details', 'Bank Update', '2017-03-19 19:55:11'),
(137, 22, 'You have been scheduled to receive with Donation ID <span class=\"label label-sm label-success\">1638</span>', 'Schedule To Receive', '2017-03-19 20:08:24'),
(138, 25, 'You updated your profile basic details', 'Basic Update', '2017-03-19 20:26:51'),
(139, 25, 'You updated your bank details', 'Bank Update', '2017-03-19 20:27:54'),
(140, 25, 'You made a reservation on Activity ID <span class=\"label label-sm label-success\">1628</span>', 'Reservation', '2017-03-19 20:34:42'),
(141, 9, 'A reservation was made on your Activity with ID <span class=\"label label-sm label-success\">1628</span>', 'Reservation', '2017-03-19 20:34:42'),
(142, 25, 'You claimed your donation to activity ID  <span class=\"label label-sm label-info\">1628</span>  was successful', 'Payment Claim', '2017-03-19 20:35:47'),
(143, 9, 'A claim on donation successfully paid was made on Activity ID  <span class=\"label label-sm label-info\">1628</span>  ', 'Payment Claim', '2017-03-19 20:35:47'),
(144, 25, 'Your donation on Activity ID  <span class=\"label label-sm label-success\">1628</span> was successfully confirmed ', 'Confirm', '2017-03-19 20:37:46'),
(145, 9, 'Your successfully received and confirmed donation from basheer  on Activity ID  <span class=\"label label-sm label-success\">1628</span> ', 'Confirm', '2017-03-19 20:37:46'),
(146, 14, 'You claimed your donation to activity ID  <span class=\"label label-sm label-info\">1628</span>  was successful', 'Payment Claim', '2017-03-19 20:40:05'),
(147, 9, 'A claim on donation successfully paid was made on Activity ID  <span class=\"label label-sm label-info\">1628</span>  ', 'Payment Claim', '2017-03-19 20:40:05'),
(148, 14, 'Your donation on Activity ID  <span class=\"label label-sm label-success\">1628</span> was successfully confirmed ', 'Confirm', '2017-03-19 20:42:04'),
(149, 9, 'Your successfully received and confirmed donation from yahaya18  on Activity ID  <span class=\"label label-sm label-success\">1628</span> ', 'Confirm', '2017-03-19 20:42:04'),
(150, 25, 'You have been scheduled to receive with Donation ID <span class=\"label label-sm label-success\">1641</span>', 'Schedule To Receive', '2017-03-19 20:44:04'),
(151, 17, 'You updated your profile basic details', 'Basic Update', '2017-03-19 20:48:49'),
(152, 17, 'You updated your bank details', 'Bank Update', '2017-03-19 20:50:03'),
(153, 17, 'You have been scheduled to receive with Donation ID <span class=\"label label-sm label-success\">1642</span>', 'Schedule To Receive', '2017-03-19 20:57:28'),
(154, 29, 'You updated your bank details', 'Bank Update', '2017-03-20 01:26:27'),
(155, 30, 'You updated your profile basic details', 'Basic Update', '2017-03-20 02:30:22'),
(156, 30, 'You updated your bank details', 'Bank Update', '2017-03-20 02:31:19'),
(157, 31, 'You updated your profile basic details', 'Basic Update', '2017-03-20 02:33:46'),
(158, 31, 'You updated your bank details', 'Bank Update', '2017-03-20 02:34:27'),
(159, 29, 'You updated your profile basic details', 'Basic Update', '2017-03-20 03:15:54'),
(160, 30, 'You made a reservation on Activity ID <span class=\"label label-sm label-success\">1636</span>', 'Reservation', '2017-03-20 03:20:44'),
(161, 23, 'A reservation was made on your Activity with ID <span class=\"label label-sm label-success\">1636</span>', 'Reservation', '2017-03-20 03:20:44'),
(162, 30, 'You made a reservation on Activity ID <span class=\"label label-sm label-success\">1636</span>', 'Reservation', '2017-03-20 03:22:39'),
(163, 23, 'A reservation was made on your Activity with ID <span class=\"label label-sm label-success\">1636</span>', 'Reservation', '2017-03-20 03:22:39'),
(164, 32, 'You updated your profile basic details', 'Basic Update', '2017-03-20 03:49:34'),
(165, 32, 'You updated your bank details', 'Bank Update', '2017-03-20 03:50:48'),
(166, 33, 'You updated your profile basic details', 'Basic Update', '2017-03-20 03:54:20'),
(167, 32, 'You made a reservation on Activity ID <span class=\"label label-sm label-success\">1630</span>', 'Reservation', '2017-03-20 03:55:12'),
(168, 11, 'A reservation was made on your Activity with ID <span class=\"label label-sm label-success\">1630</span>', 'Reservation', '2017-03-20 03:55:12'),
(169, 32, 'You claimed your donation to activity ID  <span class=\"label label-sm label-info\">1630</span>  was successful', 'Payment Claim', '2017-03-20 03:58:56'),
(170, 11, 'A claim on donation successfully paid was made on Activity ID  <span class=\"label label-sm label-info\">1630</span>  ', 'Payment Claim', '2017-03-20 03:58:56'),
(171, 33, 'You updated your bank details', 'Bank Update', '2017-03-20 04:10:05'),
(172, 34, 'You updated your profile basic details', 'Basic Update', '2017-03-20 04:13:50'),
(173, 32, 'Your donation on Activity ID  <span class=\"label label-sm label-success\">1630</span> was successfully confirmed ', 'Confirm', '2017-03-20 04:24:41'),
(174, 11, 'Your successfully received and confirmed donation from Mauryn  on Activity ID  <span class=\"label label-sm label-success\">1630</span> ', 'Confirm', '2017-03-20 04:24:41'),
(175, 36, 'You updated your profile basic details', 'Basic Update', '2017-03-20 04:45:34'),
(176, 36, 'You updated your bank details', 'Bank Update', '2017-03-20 04:46:36'),
(177, 35, 'You updated your profile basic details', 'Basic Update', '2017-03-20 04:49:27'),
(178, 35, 'You updated your bank details', 'Bank Update', '2017-03-20 04:50:45'),
(179, 35, 'You updated your password', 'Password Update', '2017-03-20 04:51:46'),
(180, 37, 'You updated your profile basic details', 'Basic Update', '2017-03-20 05:03:05'),
(181, 37, 'You updated your bank details', 'Bank Update', '2017-03-20 05:04:33'),
(182, 35, 'You made a reservation on Activity ID <span class=\"label label-sm label-success\">1635</span>', 'Reservation', '2017-03-20 05:05:25'),
(183, 10, 'A reservation was made on your Activity with ID <span class=\"label label-sm label-success\">1635</span>', 'Reservation', '2017-03-20 05:05:25'),
(184, 33, 'You updated your profile basic details', 'Basic Update', '2017-03-20 05:14:14'),
(185, 38, 'You updated your bank details', 'Bank Update', '2017-03-20 05:27:33'),
(186, 38, 'You updated your bank details', 'Bank Update', '2017-03-20 05:27:44'),
(187, 38, 'You updated your profile basic details', 'Basic Update', '2017-03-20 05:28:27'),
(188, 39, 'You updated your bank details', 'Bank Update', '2017-03-20 05:31:17'),
(189, 39, 'You updated your profile basic details', 'Basic Update', '2017-03-20 05:32:05'),
(190, 40, 'You updated your bank details', 'Bank Update', '2017-03-20 05:39:21'),
(191, 41, 'You updated your profile basic details', 'Basic Update', '2017-03-20 05:42:32'),
(192, 41, 'You updated your bank details', 'Bank Update', '2017-03-20 05:43:21'),
(193, 42, 'You updated your bank details', 'Bank Update', '2017-03-20 05:47:52'),
(194, 44, 'You updated your profile basic details', 'Basic Update', '2017-03-20 05:48:44'),
(195, 43, 'You updated your bank details', 'Bank Update', '2017-03-20 05:49:23'),
(196, 44, 'You updated your bank details', 'Bank Update', '2017-03-20 05:49:29'),
(197, 43, 'You updated your profile basic details', 'Basic Update', '2017-03-20 05:49:38'),
(198, 46, 'You updated your profile basic details', 'Basic Update', '2017-03-20 05:49:50'),
(199, 46, 'You updated your bank details', 'Bank Update', '2017-03-20 05:50:22'),
(200, 42, 'You updated your profile basic details', 'Basic Update', '2017-03-20 05:51:57'),
(201, 43, 'You made a reservation on Activity ID <span class=\"label label-sm label-success\">1635</span>', 'Reservation', '2017-03-20 05:52:29'),
(202, 10, 'A reservation was made on your Activity with ID <span class=\"label label-sm label-success\">1635</span>', 'Reservation', '2017-03-20 05:52:29'),
(203, 49, 'You updated your profile basic details', 'Basic Update', '2017-03-20 05:53:12'),
(204, 47, 'You updated your profile basic details', 'Basic Update', '2017-03-20 05:53:23'),
(205, 48, 'You updated your profile basic details', 'Basic Update', '2017-03-20 05:53:43'),
(206, 48, 'You updated your bank details', 'Bank Update', '2017-03-20 05:54:37'),
(207, 49, 'You updated your bank details', 'Bank Update', '2017-03-20 05:54:47'),
(208, 50, 'You updated your profile basic details', 'Basic Update', '2017-03-20 05:55:42'),
(209, 47, 'You updated your bank details', 'Bank Update', '2017-03-20 05:55:59'),
(210, 50, 'You updated your bank details', 'Bank Update', '2017-03-20 05:56:47'),
(211, 50, 'You updated your bank details', 'Bank Update', '2017-03-20 05:56:50'),
(212, 51, 'You updated your profile basic details', 'Basic Update', '2017-03-20 05:57:17'),
(213, 51, 'You updated your bank details', 'Bank Update', '2017-03-20 05:58:49'),
(214, 51, 'You updated your bank details', 'Bank Update', '2017-03-20 05:59:15'),
(215, 51, 'You updated your bank details', 'Bank Update', '2017-03-20 06:02:03'),
(216, 50, 'You made a reservation on Activity ID <span class=\"label label-sm label-success\">1634</span>', 'Reservation', '2017-03-20 06:03:49'),
(217, 19, 'A reservation was made on your Activity with ID <span class=\"label label-sm label-success\">1634</span>', 'Reservation', '2017-03-20 06:03:49'),
(218, 52, 'You updated your bank details', 'Bank Update', '2017-03-20 06:03:49'),
(219, 52, 'You updated your profile basic details', 'Basic Update', '2017-03-20 06:06:05'),
(220, 53, 'You updated your bank details', 'Bank Update', '2017-03-20 06:07:57'),
(221, 53, 'You updated your profile basic details', 'Basic Update', '2017-03-20 06:08:02'),
(222, 45, 'You updated your profile basic details', 'Basic Update', '2017-03-20 06:09:34'),
(223, 45, 'You updated your bank details', 'Bank Update', '2017-03-20 06:12:25'),
(224, 45, 'You updated your bank details', 'Bank Update', '2017-03-20 06:12:29'),
(225, 54, 'You updated your profile basic details', 'Basic Update', '2017-03-20 06:12:44'),
(226, 54, 'You updated your bank details', 'Bank Update', '2017-03-20 06:13:59'),
(227, 34, 'You updated your bank details', 'Bank Update', '2017-03-20 06:19:25'),
(228, 55, 'You updated your profile basic details', 'Basic Update', '2017-03-20 06:22:20'),
(229, 55, 'You updated your password', 'Password Update', '2017-03-20 06:23:12'),
(230, 55, 'You updated your bank details', 'Bank Update', '2017-03-20 06:25:02'),
(231, 56, 'You updated your profile basic details', 'Basic Update', '2017-03-20 06:27:12'),
(232, 56, 'You updated your bank details', 'Bank Update', '2017-03-20 06:28:54'),
(233, 31, 'You made a reservation on Activity ID <span class=\"label label-sm label-success\">1634</span>', 'Reservation', '2017-03-20 06:30:17'),
(234, 19, 'A reservation was made on your Activity with ID <span class=\"label label-sm label-success\">1634</span>', 'Reservation', '2017-03-20 06:30:17'),
(235, 56, 'You updated your bank details', 'Bank Update', '2017-03-20 06:31:24'),
(236, 19, 'You updated your bank details', 'Bank Update', '2017-03-20 07:24:49'),
(237, 15, 'You have been scheduled to receive with Donation ID <span class=\"label label-sm label-success\">1644</span>', 'Schedule To Receive', '2017-03-20 07:44:12'),
(238, 13, 'You have been scheduled to receive with Donation ID <span class=\"label label-sm label-success\">1645</span>', 'Schedule To Receive', '2017-03-20 07:45:57'),
(239, 12, 'You have been scheduled to receive with Donation ID <span class=\"label label-sm label-success\">1646</span>', 'Schedule To Receive', '2017-03-20 07:50:43'),
(240, 58, 'You updated your profile basic details', 'Basic Update', '2017-03-20 10:57:19'),
(241, 58, 'You updated your bank details', 'Bank Update', '2017-03-20 10:58:20'),
(242, 59, 'You updated your profile basic details', 'Basic Update', '2017-03-20 11:52:10'),
(243, 59, 'You updated your bank details', 'Bank Update', '2017-03-20 11:53:00'),
(244, 60, 'You updated your profile basic details', 'Basic Update', '2017-03-20 12:03:55'),
(245, 60, 'You updated your bank details', 'Bank Update', '2017-03-20 12:05:24'),
(246, 61, 'You updated your profile basic details', 'Basic Update', '2017-03-20 12:49:11'),
(247, 61, 'You updated your bank details', 'Bank Update', '2017-03-20 12:50:03'),
(248, 61, 'You updated your bank details', 'Bank Update', '2017-03-20 12:50:09'),
(249, 57, 'You updated your profile basic details', 'Basic Update', '2017-03-20 22:12:06'),
(250, 57, 'You updated your paypal details', 'Paypal Update', '2017-03-20 22:13:49'),
(251, 62, 'You updated your bank details', 'Bank Update', '2017-03-21 00:29:43'),
(252, 59, 'You made a reservation on Activity ID <span class=\"label label-sm label-success\">1634</span>', 'Reservation', '2017-03-21 08:26:38'),
(253, 19, 'A reservation was made on your Activity with ID <span class=\"label label-sm label-success\">1634</span>', 'Reservation', '2017-03-21 08:26:38'),
(254, 11, 'You made a reservation on Activity ID <span class=\"label label-sm label-success\">1629</span>', 'Reservation', '2017-03-21 08:28:09'),
(255, 27, 'A reservation was made on your Activity with ID <span class=\"label label-sm label-success\">1629</span>', 'Reservation', '2017-03-21 08:28:09'),
(256, 63, 'You updated your profile basic details', 'Basic Update', '2017-03-21 10:33:12'),
(257, 63, 'You updated your bank details', 'Bank Update', '2017-03-21 10:33:57'),
(258, 63, 'You updated your bitcoin details', 'Bitcoin Update', '2017-03-21 10:34:42'),
(259, 11, 'You claimed your donation to activity ID  <span class=\"label label-sm label-info\">1629</span>  was successful', 'Payment Claim', '2017-03-21 11:35:45'),
(260, 27, 'A claim on donation successfully paid was made on Activity ID  <span class=\"label label-sm label-info\">1629</span>  ', 'Payment Claim', '2017-03-21 11:35:45'),
(261, 64, 'You updated your profile basic details', 'Basic Update', '2017-03-22 02:55:29'),
(262, 64, 'You updated your bank details', 'Bank Update', '2017-03-22 02:57:25'),
(263, 64, 'You updated your profile basic details', 'Basic Update', '2017-03-22 02:58:01'),
(264, 11, 'You made a reservation on Activity ID <span class=\"label label-sm label-success\">1632</span>', 'Reservation', '2017-03-22 03:25:43'),
(265, 26, 'A reservation was made on your Activity with ID <span class=\"label label-sm label-success\">1632</span>', 'Reservation', '2017-03-22 03:25:43'),
(266, 11, 'You made a reservation on Activity ID <span class=\"label label-sm label-success\">1637</span>', 'Reservation', '2017-03-22 03:27:21'),
(267, 13, 'A reservation was made on your Activity with ID <span class=\"label label-sm label-success\">1637</span>', 'Reservation', '2017-03-22 03:27:21'),
(268, 64, 'You made a reservation on Activity ID <span class=\"label label-sm label-success\">1643</span>', 'Reservation', '2017-03-22 03:27:22'),
(269, 32, 'A reservation was made on your Activity with ID <span class=\"label label-sm label-success\">1643</span>', 'Reservation', '2017-03-22 03:27:22'),
(270, 11, 'You made a reservation on Activity ID <span class=\"label label-sm label-success\">1644</span>', 'Reservation', '2017-03-22 03:30:55'),
(271, 15, 'A reservation was made on your Activity with ID <span class=\"label label-sm label-success\">1644</span>', 'Reservation', '2017-03-22 03:30:55'),
(272, 11, 'You made a reservation on Activity ID <span class=\"label label-sm label-success\">1641</span>', 'Reservation', '2017-03-22 03:31:45'),
(273, 25, 'A reservation was made on your Activity with ID <span class=\"label label-sm label-success\">1641</span>', 'Reservation', '2017-03-22 03:31:45'),
(274, 65, 'You updated your profile basic details', 'Basic Update', '2017-03-22 03:34:54'),
(275, 65, 'You made a reservation on Activity ID <span class=\"label label-sm label-success\">1646</span>', 'Reservation', '2017-03-22 03:35:30'),
(276, 12, 'A reservation was made on your Activity with ID <span class=\"label label-sm label-success\">1646</span>', 'Reservation', '2017-03-22 03:35:30'),
(277, 65, 'You made a reservation on Activity ID <span class=\"label label-sm label-success\">1631</span>', 'Reservation', '2017-03-22 03:39:22'),
(278, 26, 'A reservation was made on your Activity with ID <span class=\"label label-sm label-success\">1631</span>', 'Reservation', '2017-03-22 03:39:22'),
(279, 65, 'You made a reservation on Activity ID <span class=\"label label-sm label-success\">1646</span>', 'Reservation', '2017-03-22 03:53:01'),
(280, 12, 'A reservation was made on your Activity with ID <span class=\"label label-sm label-success\">1646</span>', 'Reservation', '2017-03-22 03:53:01'),
(281, 64, 'You claimed your donation to activity ID  <span class=\"label label-sm label-info\">1643</span>  was successful', 'Payment Claim', '2017-03-22 04:21:46'),
(282, 32, 'A claim on donation successfully paid was made on Activity ID  <span class=\"label label-sm label-info\">1643</span>  ', 'Payment Claim', '2017-03-22 04:21:46'),
(283, 66, 'You updated your profile basic details', 'Basic Update', '2017-03-22 06:20:21'),
(284, 66, 'You updated your bank details', 'Bank Update', '2017-03-22 06:21:54'),
(285, 64, 'Your donation on Activity ID  <span class=\"label label-sm label-success\">1643</span> was successfully confirmed ', 'Confirm', '2017-03-22 12:14:57'),
(286, 32, 'Your successfully received and confirmed donation from jacknas  on Activity ID  <span class=\"label label-sm label-success\">1643</span> ', 'Confirm', '2017-03-22 12:14:57'),
(287, 67, 'You updated your profile basic details', 'Basic Update', '2017-03-22 14:04:50'),
(288, 67, 'You updated your bank details', 'Bank Update', '2017-03-22 14:06:04'),
(289, 68, 'You updated your profile basic details', 'Basic Update', '2017-03-22 15:09:54'),
(290, 68, 'You updated your bank details', 'Bank Update', '2017-03-22 15:10:36'),
(291, 69, 'You updated your profile basic details', 'Basic Update', '2017-03-24 12:25:58'),
(292, 69, 'You updated your bank details', 'Bank Update', '2017-03-24 12:26:57'),
(293, 9, 'You made a reservation on Activity ID <span class=\"label label-sm label-success\">1634</span>', 'Reservation', '2017-03-27 17:59:30'),
(294, 19, 'A reservation was made on your Activity with ID <span class=\"label label-sm label-success\">1634</span>', 'Reservation', '2017-03-27 17:59:30'),
(295, 9, 'You updated your profile basic details', 'Basic Update', '2017-05-28 15:44:15'),
(296, 9, 'You updated your profile basic details', 'Basi Update', '2017-05-28 15:44:37'),
(297, 9, 'You updated your profile basic details', 'Basi Update', '2017-05-28 15:44:50'),
(298, 9, 'You updated your profile basic details', 'Basic Update', '2017-05-28 22:35:00'),
(299, 9, 'You updated your profile basic details', 'Basic Update', '2017-05-28 22:35:15'),
(300, 9, 'You updated your profile basic details', 'Basic Update', '2017-05-28 22:35:36'),
(301, 9, 'You updated your bank details', 'UserInfo Update', '2017-05-29 11:02:12'),
(302, 9, 'You updated your bank details', 'UserInfo Update', '2017-05-29 11:02:25'),
(303, 9, 'You updated your profile basic details', 'Basic Update', '2017-05-29 11:03:09'),
(304, 9, 'You updated your bank details', 'UserInfo Update', '2017-05-29 11:07:20'),
(305, 9, 'You updated your bank details', 'UserInfo Update', '2017-05-29 11:12:14'),
(306, 9, 'You updated your profile basic details', 'Basic Update', '2017-05-29 19:39:38'),
(307, 9, 'You updated your personal details', 'Info Update', '2017-05-29 19:39:46'),
(308, 9, 'You updated your profile basic details', 'Basic Update', '2017-05-29 19:48:48'),
(309, 9, 'You updated your personal details', 'Info Update', '2017-05-29 20:13:18'),
(310, 9, 'You updated your contact details', 'Contact Update', '2017-05-29 20:17:41'),
(311, 9, 'You updated your contact details', 'Contact Update', '2017-05-29 20:21:15'),
(312, 9, 'You updated your contact details', 'Contact Update', '2017-05-29 20:21:16'),
(313, 9, 'You updated your contact details', 'Contact Update', '2017-05-29 20:21:16'),
(314, 9, 'You updated your contact details', 'Contact Update', '2017-05-29 23:45:08'),
(315, 9, 'You updated your contact details', 'Contact Update', '2017-05-29 23:46:21'),
(316, 10, 'You have been scheduled to receive with ActivityID <span class=\"label label-sm label-success\">1648</span>', 'Schedule To Receive', '2017-05-30 10:21:46'),
(317, 9, 'You updated your bank details', 'Bank Update', '2020-08-25 14:36:22'),
(318, 9, 'You updated your bank details', 'Bank Update', '2020-08-25 14:37:45'),
(319, 9, 'You updated your bank details', 'Bank Update', '2020-08-25 14:45:40'),
(320, 9, 'You updated your paypal details', 'Paypal Update', '2020-08-25 14:52:52'),
(321, 9, 'You updated your bitcoin details', 'Bitcoin Update', '2020-08-25 14:53:01'),
(322, 9, 'You updated your paypal details', 'Paypal Update', '2020-08-25 15:41:42'),
(323, 9, 'You updated your paypal details', 'Paypal Update', '2020-08-25 15:42:28'),
(324, 9, 'You updated your paypal details', 'Paypal Update', '2020-08-25 15:48:13'),
(325, 9, 'You updated your paypal details', 'Paypal Update', '2020-08-25 15:48:17'),
(326, 9, 'You updated your paypal details', 'Paypal Update', '2020-08-25 15:48:19'),
(327, 9, 'You updated your paypal details', 'Paypal Update', '2020-08-25 15:48:19'),
(328, 9, 'You updated your paypal details', 'Paypal Update', '2020-08-25 15:48:20'),
(329, 70, 'You updated your profile basic details', 'Basic Update', '2020-08-29 13:20:43'),
(330, 72, 'You updated your profile basic details', 'Basic Update', '2020-08-29 13:28:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `referral` varchar(200) NOT NULL,
  `bank_account_number` varchar(200) NOT NULL,
  `bank_account_name` varchar(200) NOT NULL,
  `bank_account_type` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `bank` varchar(200) NOT NULL,
  `bank_active` varchar(200) NOT NULL DEFAULT 'No',
  `paypal_id` varchar(200) NOT NULL,
  `paypal_active` varchar(10) NOT NULL,
  `bitcoin_address` varchar(200) NOT NULL,
  `bitcoin_active` varchar(10) NOT NULL,
  `country` varchar(250) NOT NULL,
  `level` enum('user','admin','super_admin') NOT NULL DEFAULT 'user',
  `reset_link` varchar(250) NOT NULL,
  `joined` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `referral`, `bank_account_number`, `bank_account_name`, `bank_account_type`, `phone`, `bank`, `bank_active`, `paypal_id`, `paypal_active`, `bitcoin_address`, `bitcoin_active`, `country`, `level`, `reset_link`, `joined`) VALUES
(7, 'monamoxie', 'aa@gmail.com', '1111', '', '3078986754', 'Ilemona Success Ibrahim', 'Current', ' 2348065789675', 'Guaranty Trust Bank (GTB)', 'Yes', '', '', '', '', 'Nigeria', 'super_admin', '', '2017-03-14 10:42:25'),
(9, 'nadaeza', '131@gmail.com', 'a0292e289e7744f47a56e2db82eff1ef', 'solos', '3078986754', 'Ilemona Success Ibrahim', 'Savings', '09035632102', 'Guaranty Trust Bank (GTB)', 'No', '1234567890', 'No', 'qwert93456789o', 'No', 'Nigeria', 'super_admin', '', '2017-03-15 08:43:34'),
(10, 'blackteddy', 'tiq4real@gmail.com', 'd2780a97ea6b112c0f56dbc2f2536095', 'nadaeza', '0125281923', 'IBRAHIM TARIQ', 'SAVINGS', '08162952345', 'GTBANK', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-16 06:30:08'),
(11, 'ebonysue', 'susanidenala@gmail.com', 'a392191ae7870f04904ec250ca0e14a6', 'nadaeza', '3083761156', 'Susan Idenala', 'Savings', '09099449169', 'First bank', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-16 07:03:02'),
(12, 'tripleaarnold', 'tripleaarnold23@gmail.com', 'f7bb89c9037b631b561f12c1c7eed69e', 'nadaeza', '0127073454', 'Addo Arnold', 'savings', '08130917487', 'GTB', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-16 07:04:45'),
(13, 'Salawau47', 'aliusalawu47@gmail.com', '2e645f0caefe73996458e542ee59c3f9', 'nadaeza', '0115807236', 'Salawu Aliu ibrahim', 'Savings', '08022797148', 'GTbank', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-16 07:13:34'),
(14, 'yahaya18', 'wahab.yahaya18@gmail.com', 'a0292e289e7744f47a56e2db82eff1ef', 'nadaeza', '2047895687', 'yahaya onimisi abdulwahab', 'savings', '08180678703', 'UBA', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-16 07:48:22'),
(15, 'saggatmedia', 'saggatmoney@gmail.com', 'a0292e289e7744f47a56e2db82eff1ef', 'nadaeza', '2052775613', 'ndifreke uduak', 'savings', '08138697212', 'UBA', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-16 08:01:23'),
(16, '', 'donmusa0@gmail.com', 'a0292e289e7744f47a56e2db82eff1ef', 'nadaeza', '', '', '', '', '', 'No', '', '', '', '', '', 'user', '', '2017-03-16 08:29:54'),
(17, 'kingsleyk', 'kingsleykrowned@gmail.com', 'a0292e289e7744f47a56e2db82eff1ef', 'nadaeza', '0125584473', 'kingsley uranu', 'savings', '08161613797', 'GTBank', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-16 08:35:25'),
(18, '', 'solos10x@gmail.com', '4297f44b13955235245b2497399d7a93', 'nadaeza', '', '', '', '', '', 'No', '', '', '', '', '', 'user', '', '2017-03-16 08:55:31'),
(19, 'boluwatife', 'bobomaster2015@gmail.com', 'a0292e289e7744f47a56e2db82eff1ef', 'nadaeza', '0081453529', 'nasiru abdullahi', 'savings', '08147196459', 'DIAMOND', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-16 08:58:52'),
(20, '', 'felysport@yahoo.com', 'a0292e289e7744f47a56e2db82eff1ef', 'nadaeza', '', '', '', '', '', 'No', '', '', '', '', '', 'user', '', '2017-03-16 09:04:09'),
(21, '', 'hajaradamidami@gmail.com', 'a0292e289e7744f47a56e2db82eff1ef', 'nadaeza', '', '', '', '', '', 'No', '', '', '', '', '', 'user', '', '2017-03-16 09:14:05'),
(22, 'surebukky', 'wisebukky@gmail.com', 'a0292e289e7744f47a56e2db82eff1ef', 'nadaeza', '0044433677', 'adeniyi adebukola', 'savings', '09055444350', 'access bank', 'Yes', '', '', '', '', 'Nigeria', 'admin', '0BZhj8rdHvqc3A7xkCaw1oUzWueUH4LRB0ilAEd0v5asn2adPfC8', '2017-03-16 10:44:45'),
(23, 'peter', 'Petereyinavio@gmail.com', 'a0292e289e7744f47a56e2db82eff1ef', 'nadaeza', '3038265104', 'Eyinavi peter onimisi', 'savings', '08055054727', 'First Bank', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-16 12:04:31'),
(24, 'jameela', 'jameelaabdulkareem2@gmail.com', 'a0292e289e7744f47a56e2db82eff1ef', 'nadaeza', '0124004860', 'jameela abdulkareem onize', 'savings', '07031955673', 'GTBank', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-16 13:49:55'),
(25, 'basheer', 'yusufubasheer@gmail.com', 'a0292e289e7744f47a56e2db82eff1ef', 'nadaeza', '0081453529', 'abdullahi nasiru', 'savings', '08161875524', 'DIAMOND', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-16 15:29:27'),
(26, 'cliff', 'ndubuisiekeh2016@gmail.com', 'fc330b13735de46b4d947efba31d1682', '', '0046888559', 'clifford ekeh', 'savings', '08121851435', 'union', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-19 17:46:01'),
(27, 'Ohirash', 'Ohirash@gmail.com', '0939d6c412756902ed9b258b91059088', '', '3068423532', 'Idris Abdulrasheed', 'Savings', '07033749865', 'First bank', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-19 18:03:02'),
(28, 'emymatt', 'emem4u2000@yahoo.com', 'bffc06e35d3a81bbdedf5770cb6b1ca3', '', '0302089564', 'Emem Matthew', 'Current', '08066275497', 'Ecobank', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-19 18:26:55'),
(29, 'wisane', 'wisanealkane@gmail.com', 'a28f05f5f45fe2d8a900736c8935fe44', '', '0726102217', 'Abdultawab Ibrahim', 'Savings', '08092754574', 'Access Bank', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 01:21:50'),
(30, 'ehis', 'ikhayeres@gmail.com', '843db1fabe9e18a5b395b2ae279ee215', '', '0110703962', 'Ikhayere Solomon', 'Savings', '08145790137', 'GT Bank', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 02:29:00'),
(31, 'cheekah', 'teenahpeetah@gmail.com', '141903dc030285f80e5217d34e3cf087', 'ebonysue', '3068780525', 'Chika Peter-Uwaoma', 'Savings', '08099442174', 'First Bank', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 02:32:29'),
(32, 'Mauryn', 'Nikki2ng@yahoo.com', '336d1011870bcf937848725613d6e73a', 'Ebonysue', '0005005733', 'Maureen Fredrick ', 'Savings', '08025496795', 'Gtb', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 03:48:08'),
(33, 'Teeboy', 'taheer.momodu@gmail.com', '29de9091bf70de52b55d35e5ed0988d5', 'ebonysue', '0038326425', 'Momodu Momoh-Tahiru', 'savings', '08037861766', 'Sterling Bank', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 03:49:27'),
(34, 'Muhamz', 'Trendscaster@gmail.com', '1873cec6fa31321b94cee30c5b49733b', '', '0000697021 ', 'Makanjuola Muhammad Fard ', 'Savings', '08124055386', 'Stanbic IBTC ', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 04:07:28'),
(35, 'Ceewhy', 'saliucynthia@gmail.com', '444aae466443223f3e639217f33c01a0', 'Mauryn', '6016636144', 'Saliu Cynthia Ochuwa', 'Savings', '07064722547', 'Fidelity', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 04:40:46'),
(36, 'Obasco', 'Obanlasamuel68@gmail.com', 'dd5a41102052ed6cd4ae26533318f97c', '', '3112991617', 'Oba sam', 'Savings', '08079219843', 'First bank', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 04:42:06'),
(37, 'martinjunior', 'danton4735@gmail.com', '3e1e05c86b290e8aa210b7d2cbd19039', '', '3056161653', 'Anthony Martin Sintei', 'savings', '07068631387', 'first bank', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 05:01:04'),
(38, 'mcteepee', 'topeowo261@yahoo.com', '57e7f266bb0dc62f2cb0f25976c14e93', 'ceewhy', '0054428342', 'Owosela Temitope', 'Savings', '07039466606', 'Access bank', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 05:26:02'),
(39, 'Harbay', 'abiodun4greatness@gmail.com', '5db931c142ccdc3101bc8c7fb8f3c34b', 'ebonysue', '0049734552', 'Adelowokan Abiodun', 'Savings', '08099448028', 'Guaranty Trust Bank', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 05:29:00'),
(40, '', 'teea1990@yahoo.com', '679ac109cce248926d77ee04422e276d', '', '0021710558', 'Akinyemi temitope ', 'Savings ', '', 'Diamond bank', 'Yes', '', '', '', '', '', 'user', '', '2017-03-20 05:37:43'),
(41, 'Lilyd', 'Fattyfabulous4real@yahoo.com', '710eeae732b64b8d6910c19217b282db', 'Mcteepee', '1004968372', 'Lilian ejiro Daramola ', 'Current', '08091792338', 'Zenith', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 05:41:45'),
(42, 'Akudo', 'chomiscup@yahoo.co.uk', '464c1fe1921041da49d8d956ba3788e9', 'Mcteepee', '3054619851', 'Okereke Akudo Chioma', 'Savings', '08037469171', 'First bank', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 05:44:40'),
(43, 'Mercyfavour', 'Olalusitolulope@gmail.com', 'ce16fe4978c0682c3ba03d4e99e83fe3', '', '3036701521 ', 'Olalusi tolulope oluwabunmi ', 'Savings ', '08039263909', 'First bank ', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 05:46:36'),
(44, 'jaykay', 'toopsyh@yahoo.com', 'a7c48d58aa1ee757374a4f2247351da5', '', '3069993801', 'hamzat adejoke', 'savings', '08099641091', 'first bank', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 05:46:52'),
(45, 'dann', 'johnwalkerunited@gmail.com', '7c56ddd227fc44e86a376f939f1f8e6e', 'ebonysue', '0031284077', 'N. Ezeani', 'Savings', '08136559180', 'Access bank', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 05:47:18'),
(46, 'Goshen', 'ccpearl6@gmail.com', '3b1461cf6a45c228fc52177e871f4938', 'mcteepee', '0108513010 ', 'Chibogu Ada Chioma ', 'savings ', '08063415449', 'GTB', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 05:48:47'),
(47, 'Tolulope123', 'Ogunleye.tolulope29@gmail.com', '36d13e56978630fb9c4989cbf6c1d81d', 'Mcteepee', '0230378548', 'Ogunleye tolulope abiola', 'Savings', '08063357527', 'Wema', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 05:50:23'),
(48, 'abundance', 'beautisful@yahoo.com', '6bfd92047eb517377d11334978696a5c', 'Mcteepee', '0039945407', 'Soton Celine Iselobhor ', 'Current', '08064886477', 'Gtbank', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 05:51:41'),
(49, 'queenwiny', 'winniemorganson@yahoo.com', '78a747a02862d1722fda649ae15308d3', '', '2037686622', 'winnie morganson', 'savings', '08033525264', 'UBA', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 05:52:08'),
(50, 'cooljennyt', 'Cleopasjennifer100@yahoo.com', '5682d9b29d46f1b8e7355be7e24b8633', '', '0027415673', 'Otolo Timipere Jennifer', 'Savings', '08062298749', 'Diamond', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 05:54:40'),
(51, 'warenia', 'warenia@yahoo.com', '567bfb6880ca4b668943fa3c84cb42e3', 'mcteepee', '0038772071', 'awoli ariwareni', 'savings', '08065121117', 'GTBank', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 05:55:30'),
(52, 'oscaino', 'blessedekum@gmail.com', '0b2cf50024d2c8afd357944d681df637', '', '0036069076', 'OSCAR EKUM', 'SAVING', '08070408854', 'Diamond Bank', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 06:00:33'),
(53, 'stevoo11', 'mrhoha7@gmail.com', 'c5e572589ad12e8109a4bf3cf412d997', 'Mcteepee', '3031020415', 'Ozang Stephen', 'Savings', '08062250869', 'Skye Bank', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 06:05:58'),
(54, 'Jacobtarz', 'jacktarvie@yahoo.com', '4b91efa18d24fb42e838d29e4d3c8942', 'Mcteepee', '6012355622', 'Jack Tarvie', 'Savings', '07083553173', 'Keystone Bank', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 06:11:30'),
(55, 'Momos', 'embrisibe@gmail.com', 'cc989606b586f33918fe0552dec367c8', '', '0125828272', 'Tabai Emomotimi', 'Current', '08037074113', 'Gtbank', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 06:19:48'),
(56, 'Onyidivine', 'onyidivin@gmail.com', 'bb055f0f4d7b53c750bb3bdb2eb988d0', 'Mcteepee', '6015669218', 'Egbule faith', 'Saving', '08189853316', 'Keystone bank', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 06:24:27'),
(57, 'phanaripin', 'phanaripin25@gmail.com', '0dab1d32f35ed5f3c0b803be99468fb3', '', '', '', '', ' 6285371992663', '', 'No', '', '', '', '', 'Indonesia', 'user', '', '2017-03-20 10:03:40'),
(58, 'zimemma', 'ezimuzor@gmail.com', '3a2ddb06bc9357254d48f4669cdd23b8', '', '0005209311', 'Emmanuel zimuzor charity', 'savings', '08067818463', 'Gtbank', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 10:55:30'),
(59, 'dhamz', 'ladegadamilola@yahoo.com', 'eddfefbe9af4d7b9b18c2604e7d47907', 'Harbay', '0042022261', 'Damilola A', 'savings', '08099449096', 'union bank', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 11:51:00'),
(60, 'Chiamaka', 'Okwukaoguchiamaka@yahoo.com', 'd65038d790c8910d3b35eb81790a89bc', 'Surebukky', '0025079880', 'Okwukaogu perpetual chiamaka ', 'Savings', '08165255458', 'Diamond bank ', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 12:01:25'),
(61, 'benbegold', 'benbegold@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', '', '0017331619', 'Abiodun Asiyanbi ', 'Savings ', '08032006452', 'GTB', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-20 12:47:45'),
(62, '', 'Suzzietee@gmail.com', '9fad6fdf0cc761937d13a70e3d241864', '', '0053052160', 'Awodein Temidayo', 'Savings', '', 'Access bank', 'Yes', '', '', '', '', '', 'user', '', '2017-03-21 00:28:39'),
(63, 'henzdollar', 'nwanne2008@gmail.com', '6fe1c5946265c81a13034f1c64fe89f5', '', '0119188339', 'Amaefule Henry', 'Savings', 'nwanne2008@gmail.com', 'GTBank', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-21 10:32:30'),
(64, 'jacknas', 'jackdickson131@gmail.com', 'a0292e289e7744f47a56e2db82eff1ef', 'nadaeza', '0081453529', 'abdullahi nasiru', 'savings', '08161875524', 'DIAMOND', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '2017-03-22 02:50:02'),
(65, 'kilode', 'moxie4lyt@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', '', '09073897653', '', 'No', '', '', '', '', 'Nigeria', 'user', '', '0000-00-00 00:00:00'),
(66, 'Biggesteddy', 'eduranceisabu@gmail.com', '237f787a7f759ec87816c2c3b9b6d685', 'ebonysue', '0050720770', 'Isabu A. Isabu', 'current', '08038681142', 'Access Bank', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '0000-00-00 00:00:00'),
(67, 'Tallaremu', 'seggzzy@gmail.com', '7c49b153d4b59f8c0cf8c3e18dc80cb7', '', '0171313935', 'Aremu Dele Olusegun', 'Savings', '07036799300', 'GTB', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '0000-00-00 00:00:00'),
(68, 'Stevens', 'cityayaya.us@gmail.com', 'e84ffa3b0b37bda68973a35f27ea7402', 'Tallaremu', '2176576084', 'Anyasi ugochukwu Stevens ', 'Savings ', '09077752660', 'Zenith Bank ', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '0000-00-00 00:00:00'),
(69, 'nana', 'merox2006@gmail.com', '56b07ba3f68fd17622a4f45d59cf94f6', '', '0027577595', 'Maryam Abdurraheem', 'savings', '08099449103', 'Gtb', 'Yes', '', '', '', '', 'Nigeria', 'user', '', '0000-00-00 00:00:00'),
(70, 'solos', 'solos@gmail.com', '124b05e96255fd3b8f7afdedbf82d687', 'ebonysue', '', '', '', '08134536821', '', 'No', '', '', '', '', 'Nigeria', 'user', '', '0000-00-00 00:00:00'),
(71, '', 'cpine088@gmail.com', '590217ff68b0a589e3ecec6b78f9601a', '', '', '', '', '', '', 'No', '', '', '', '', '', 'user', '', '0000-00-00 00:00:00'),
(72, 'cpain', 'cpine@gmail.com', '590217ff68b0a589e3ecec6b78f9601a', 'solos', '', '', '', '1923019813', '', 'No', '', '', '', '', 'United States of America (USA)', 'user', '', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `broadcast`
--
ALTER TABLE `broadcast`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hold`
--
ALTER TABLE `hold`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incoming`
--
ALTER TABLE `incoming`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `activityID` (`activityID`);

--
-- Indexes for table `outgoing`
--
ALTER TABLE `outgoing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postads`
--
ALTER TABLE `postads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setup`
--
ALTER TABLE `setup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tempusers`
--
ALTER TABLE `tempusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timeline`
--
ALTER TABLE `timeline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `broadcast`
--
ALTER TABLE `broadcast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hold`
--
ALTER TABLE `hold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `incoming`
--
ALTER TABLE `incoming`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `outgoing`
--
ALTER TABLE `outgoing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `postads`
--
ALTER TABLE `postads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `setup`
--
ALTER TABLE `setup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tempusers`
--
ALTER TABLE `tempusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `timeline`
--
ALTER TABLE `timeline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=331;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
