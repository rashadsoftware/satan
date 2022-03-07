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
-- Table structure for table `elan`
--

DROP TABLE IF EXISTS `elan`;
CREATE TABLE IF NOT EXISTS `elan` (
  `elan_id` int(250) NOT NULL,
  `elan_name` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `elan_veren` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `elan_kateqoriya` int(250) NOT NULL,
  `elan_seher` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `elan_qiymet` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `elan_mezmun` text COLLATE utf8_turkish_ci NOT NULL,
  `elan_raiting` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `elan_status` varchar(250) COLLATE utf8_turkish_ci NOT NULL COMMENT 'active, deactive, waiting, blocked',
  `customer_id` int(250) NOT NULL,
  `elan_time` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `elan_pswd` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `elan_okno` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`elan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `elan`
--

INSERT INTO `elan` (`elan_id`, `elan_name`, `elan_veren`, `elan_kateqoriya`, `elan_seher`, `elan_qiymet`, `elan_mezmun`, `elan_raiting`, `elan_status`, `customer_id`, `elan_time`, `elan_pswd`, `elan_okno`) VALUES
(50510985, 'yuytyty', 'own', 33, '27', '32525', '<p>sua 8dhdsasdh sass asasa saus</p>', 'simple', 'active', 52553182, '', '', 'no');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
