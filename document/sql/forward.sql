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
-- Table structure for table `forward`
--

CREATE TABLE IF NOT EXISTS `forward` (
  `forward_id` int(250) NOT NULL AUTO_INCREMENT,
  `elanID` int(20) NOT NULL,
  `forward_key` varchar(10) COLLATE utf8_turkish_ci NOT NULL COMMENT 'simple, vip, premium, forward',
  `forward_value` varchar(30) COLLATE utf8_turkish_ci NOT NULL COMMENT 'burada ödəniş məbləğləri olacaq',
  `forward_status` varchar(20) COLLATE utf8_turkish_ci NOT NULL COMMENT 'active, passive',
  `forward_start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `forward_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`forward_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `forward`
--

INSERT INTO `forward` (`forward_id`, `elanID`, `forward_key`, `forward_value`, `forward_status`, `forward_start_time`, `forward_time`) VALUES
(49, 47749456, 'forward', '2', 'passive', '2021-11-27 07:33:00', '2021-11-09 19:23:14'),
(50, 41592442, 'forward', '2', 'passive', '2021-11-27 01:33:00', '2021-11-09 19:25:23');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
