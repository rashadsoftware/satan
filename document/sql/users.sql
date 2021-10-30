-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 28, 2021 at 06:23 AM
-- Server version: 5.7.33-36
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
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(250) NOT NULL AUTO_INCREMENT,
  `user_img` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `user_name` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `user_email` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `user_password` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `user_phone` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `user_status` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `user_ip` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `user_login` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_img`, `user_name`, `user_email`, `user_password`, `user_phone`, `user_status`, `user_ip`, `user_login`) VALUES
(1, '8fa8aa9f1a5971955ebad12f6a0215ea.jpg', 'Rashad Alakbarov', 'rashadalakbarov2020@gmail.com', 'qasimov24123', '055 5356565', 'admin', '212.47.142.208', 'close'),
(2, '', 'Şamil Quliyev', 'gulieff@yahoo.com', '123456', '0555356565', 'admin', '5.197.240.69', 'open'),
(3, '1f2a4662524c2de81a437a15165cc20d.php', '', 'gulieff666@gmail.com', '123456', '', 'admin', '185.30.90.34', 'open'),
(4, '', 'Emil Hetemov', 'emil.hatamov1991@gmail.com', '5525339', '', 'admin', '', 'open');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
