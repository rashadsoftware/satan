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
-- Table structure for table `merchant`
--

CREATE TABLE IF NOT EXISTS `merchant` (
  `merchant_id` int(250) NOT NULL AUTO_INCREMENT,
  `merchant_reference` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `merchant_signature` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `merchant_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`merchant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `merchant`
--

INSERT INTO `merchant` (`merchant_id`, `merchant_reference`, `merchant_signature`, `merchant_time`) VALUES
(48, '9439880422861073', 'OGHV6pfF6ZbZRI/yfKauRg==', '2022-01-28 18:01:51'),
(49, '3409793616386529', 'RZPWBlhW6t5tlPo9GKdXtg==', '2022-01-28 23:57:11'),
(50, '4901276675006232', 'lHKi+ayFeJTD1PNcwNDe5Q==', '2022-02-03 08:56:46');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
