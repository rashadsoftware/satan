-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 22, 2022 at 12:50 AM
-- Server version: 5.7.35-38
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shamil6883_elan`
--

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `payment_id` int(250) NOT NULL AUTO_INCREMENT,
  `elanID` int(250) NOT NULL,
  `payment_price` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `payment_status` varchar(20) COLLATE utf8_turkish_ci NOT NULL COMMENT 'simple, premium, vip',
  `payment_place` varchar(20) COLLATE utf8_turkish_ci NOT NULL COMMENT 'card',
  `payment_read` varchar(20) COLLATE utf8_turkish_ci NOT NULL DEFAULT 'unread' COMMENT 'read, unread',
  `payment_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `elanID`, `payment_price`, `payment_status`, `payment_place`, `payment_read`, `payment_time`) VALUES
(1, 44332058, '3', 'forward', 'card', 'unread', '2021-11-07 17:52:48'),
(2, 83021387, '12', 'vip', 'card', 'unread', '2021-11-07 17:53:36'),
(3, 87363678, '12', 'vip', 'card', 'unread', '2021-11-07 18:15:48'),
(4, 98740226, '3', 'forward', 'card', 'unread', '2021-11-07 18:16:01'),
(5, 98740226, '12', 'vip', 'card', 'unread', '2021-11-07 18:16:07'),
(6, 27520766, '12', 'vip', 'card', 'unread', '2021-11-07 18:16:17'),
(7, 83844834, '8', 'vip', 'card', 'unread', '2021-11-07 18:17:19'),
(8, 83844834, '2', 'forward', 'card', 'unread', '2021-11-07 18:17:24'),
(9, 35692699, '3', 'forward', 'card', 'unread', '2021-11-07 18:17:35'),
(10, 35692699, '12', 'vip', 'card', 'unread', '2021-11-07 18:17:42'),
(11, 84377064, '12', 'vip', 'card', 'unread', '2021-11-07 18:20:04'),
(12, 84377064, '3', 'forward', 'card', 'unread', '2021-11-07 18:20:16'),
(13, 49317796, '12', 'vip', 'card', 'unread', '2021-11-07 18:24:57'),
(14, 49317796, '3', 'forward', 'card', 'unread', '2021-11-07 18:26:21'),
(15, 18999684, '8', 'vip', 'card', 'unread', '2021-11-07 18:28:33'),
(16, 33137236, '5', 'vip', 'card', 'unread', '2021-11-07 18:28:45'),
(17, 33137236, '1', 'forward', 'card', 'unread', '2021-11-07 18:28:54'),
(18, 76980152, '1', 'forward', 'card', 'unread', '2021-11-07 18:29:11'),
(19, 46521327, '8', 'vip', 'card', 'unread', '2021-11-07 21:28:59'),
(20, 32842012, '12', 'vip', 'card', 'unread', '2021-11-07 22:10:13'),
(21, 98325114, '12', 'vip', 'card', 'unread', '2021-11-07 22:10:23'),
(22, 34375679, '12', 'vip', 'card', 'unread', '2021-11-07 22:10:40'),
(23, 28117785, '5', 'vip', 'card', 'unread', '2021-11-08 07:03:25'),
(24, 80811758, '1', 'forward', 'card', 'unread', '2021-11-08 21:56:43'),
(25, 80811758, '5', 'vip', 'card', 'unread', '2021-11-08 21:56:59'),
(26, 73277461, '5', 'vip', 'card', 'unread', '2021-11-09 08:10:03'),
(27, 39892775, '12', 'vip', 'card', 'unread', '2021-11-09 11:04:15'),
(28, 88373653, '12', 'vip', 'card', 'unread', '2021-11-09 11:07:30'),
(29, 80811758, '12', 'vip', 'card', 'unread', '2021-11-09 11:08:57'),
(30, 94766575, '30', 'vip', 'card', 'unread', '2021-11-09 11:12:12'),
(31, 47749456, '8', 'forward', 'card', 'unread', '2021-11-09 19:23:14'),
(32, 21391502, '8', 'forward', 'card', 'unread', '2021-11-09 19:25:23'),
(33, 23859349, '8', 'forward', 'card', 'unread', '2021-11-09 19:26:40'),
(34, 62263234, '10', 'vip', 'card', 'unread', '2021-11-10 19:35:29'),
(35, 80811758, '8', 'forward', 'card', 'unread', '2021-11-11 09:48:04'),
(36, 32315867, '30', 'vip', 'card', 'unread', '2021-11-11 16:34:47'),
(37, 99331984, '40', 'forward', 'card', 'unread', '2021-11-11 16:35:50'),
(38, 58488619, '8', 'forward', 'card', 'unread', '2021-11-11 18:38:14'),
(39, 44254039, '8', 'forward', 'card', 'unread', '2021-11-11 20:13:03'),
(40, 44254039, '30', 'vip', 'card', 'unread', '2021-11-11 20:13:16'),
(41, 62263234, '40', 'forward', 'card', 'unread', '2021-11-12 18:09:34'),
(42, 99331984, '10', 'vip', 'card', 'unread', '2021-11-13 19:59:47'),
(43, 85373143, '40', 'forward', 'card', 'unread', '2021-11-16 11:04:04');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
