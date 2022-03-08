-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 08, 2022 at 12:57 AM
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
-- Table structure for table `merchant`
--

DROP TABLE IF EXISTS `merchant`;
CREATE TABLE IF NOT EXISTS `merchant` (
  `merchant_id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_path` varchar(10) COLLATE utf8_turkish_ci NOT NULL COMMENT '"kart"',
  `merchant_status` varchar(20) COLLATE utf8_turkish_ci NOT NULL COMMENT '"simple, vip"',
  `merchant_elan` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `merchant_price` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `merchant_ip` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `merchant_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `merchant_state` int(5) NOT NULL DEFAULT '1' COMMENT '"1 => open, 2 => waiting, 3 => close"',
  `merchant_order` varchar(250) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`merchant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `merchant`
--

INSERT INTO `merchant` (`merchant_id`, `merchant_path`, `merchant_status`, `merchant_elan`, `merchant_price`, `merchant_ip`, `merchant_time`, `merchant_state`, `merchant_order`) VALUES
(4, 'kart', 'vip', '50510985', '12', '::1', '2022-03-08 00:56:20', 1, '40353271');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
