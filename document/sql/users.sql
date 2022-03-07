-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 07, 2022 at 10:04 PM
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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
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
  `user_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_img`, `user_name`, `user_email`, `user_password`, `user_phone`, `user_status`, `user_ip`, `user_login`, `user_time`) VALUES
(1, 'user2.png', 'Rashad Alakbarov', 'rashadalakbarov2020@gmail.com', 'qasimov24123', '055 5356565', 'admin', '212.47.142.208', 'open', '2021-12-05 16:35:19');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
