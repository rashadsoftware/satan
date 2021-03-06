-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 08, 2022 at 02:21 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elanlar`
--

-- --------------------------------------------------------

--
-- Table structure for table `forward`
--

DROP TABLE IF EXISTS `forward`;
CREATE TABLE IF NOT EXISTS `forward` (
  `forward_id` int(250) NOT NULL AUTO_INCREMENT,
  `elanID` int(20) NOT NULL,
  `forward_key` varchar(10) COLLATE utf8_turkish_ci NOT NULL COMMENT 'simple, vip, premium, forward',
  `forward_value` varchar(30) COLLATE utf8_turkish_ci NOT NULL COMMENT 'burada ödəniş məbləğləri olacaq',
  `forward_status` varchar(20) COLLATE utf8_turkish_ci NOT NULL COMMENT 'active, passive',
  `forward_start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `forward_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_ip` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`forward_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
