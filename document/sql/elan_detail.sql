-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 07, 2022 at 10:03 PM
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
-- Table structure for table `elan_detail`
--

DROP TABLE IF EXISTS `elan_detail`;
CREATE TABLE IF NOT EXISTS `elan_detail` (
  `elanDetail_id` int(250) NOT NULL AUTO_INCREMENT,
  `elan_id` int(250) NOT NULL,
  `options_id` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `elanDetail_value` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`elanDetail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5610 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `elan_detail`
--

INSERT INTO `elan_detail` (`elanDetail_id`, `elan_id`, `options_id`, `elanDetail_value`) VALUES
(5607, 50510985, '56', '82'),
(5608, 50510985, '57', '2142'),
(5609, 50510985, '58', '2');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
