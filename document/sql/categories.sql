-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 22, 2022 at 12:48 AM
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
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(250) NOT NULL AUTO_INCREMENT,
  `category_title` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `category_seflink` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `category_icon` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `category_image` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`, `category_seflink`, `category_icon`, `category_image`) VALUES
(17, 'Elektronika', 'elektronika', '<i class=\"fas fa-mobile-alt\"></i>', 'elektronika.png'),
(18, 'Daşınmaz əmlak', 'dasinmaz-emlak', '<i class=\"fas fa-home\"></i>', '123456.png'),
(19, 'Şəxsi Əşyalar', 'sexsi-esyalar', '<i class=\"fas fa-tshirt\"></i>', '01a4857b5951111cd6fa9004f38f0a9f.png'),
(20, 'Heyvanlar', 'heyvanlar', '<i class=\"fas fa-paw\"></i>', 'heyvanlar.png'),
(21, 'Ev və bağ üçün', 'ev-ve-bag-ucun', '<i class=\"fas fa-couch\"></i>', 'garden.png'),
(22, 'Xidmətlər', 'xidmetler', '<i class=\"fas fa-cogs\"></i>', 'settings.png'),
(23, 'İş və biznes', 'is-ve-biznes', '<i class=\"fas fa-briefcase\"></i>', 'work.png'),
(24, 'Nəqliyyat', 'neqliyyat', '<i class=\"fas fa-car-alt\"></i>', 'aa81dc36100922881a2c896a4fde9f3a.png'),
(25, 'Uşaq aləmi', 'usaq-alemi', '<i class=\"fas fa-baby-carriage\"></i>', '02c1cf7923d9d7eaaa4c059255a32ce7.png'),
(26, 'Hobbi və Asudə', 'hobbi-ve-asude', '<i class=\"fas fa-dumbbell\"></i>', 'hobby.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
