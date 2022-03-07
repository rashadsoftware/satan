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
-- Table structure for table `configs`
--

DROP TABLE IF EXISTS `configs`;
CREATE TABLE IF NOT EXISTS `configs` (
  `configs_id` int(250) NOT NULL AUTO_INCREMENT,
  `configs_key` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `configs_icon` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `configs_type` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `configs_value` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`configs_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `configs`
--

INSERT INTO `configs` (`configs_id`, `configs_key`, `configs_icon`, `configs_type`, `configs_value`) VALUES
(1, 'facebook', '<i class=\"fab fa-facebook-f\"></i>', 'social', 'https://www.facebook.com/www.satan.az/'),
(2, 'instagram', '<i class=\"fab fa-instagram\"></i>', 'social', 'https://www.instagram.com/satan.az_official/'),
(3, 'youtube', '<i class=\"fab fa-youtube\"></i>', 'social', ''),
(4, 'pinterest', '<i class=\"fab fa-pinterest\"></i>', 'social', ''),
(5, 'telegram', '<i class=\"fab fa-telegram\"></i>', 'social', ''),
(6, 'mainColor', '', 'color', '#c60000'),
(7, 'secondColor', '', 'color', '#000000'),
(8, 'thirdColor', '', 'color', '#ffffff');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
