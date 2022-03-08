-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 08, 2022 at 12:17 AM
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
-- Table structure for table `earnings`
--

DROP TABLE IF EXISTS `earnings`;
CREATE TABLE IF NOT EXISTS `earnings` (
  `earnings_id` int(11) NOT NULL AUTO_INCREMENT,
  `earnings_price` int(10) NOT NULL,
  `earnings_time` int(11) DEFAULT NULL,
  `earnings_retry` int(10) DEFAULT NULL,
  `earnings_state` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`earnings_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `earnings`
--

INSERT INTO `earnings` (`earnings_id`, `earnings_price`, `earnings_time`, `earnings_retry`, `earnings_state`) VALUES
(1, 1, 6, 8, 'simple'),
(2, 2, 6, 20, 'simple'),
(3, 3, 6, 40, 'simple'),
(4, 5, 10, NULL, 'vip'),
(5, 8, 20, NULL, 'vip'),
(6, 12, 30, NULL, 'vip');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
