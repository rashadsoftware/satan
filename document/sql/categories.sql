-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 28, 2021 at 06:19 AM
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
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(250) NOT NULL AUTO_INCREMENT,
  `category_title` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `category_seflink` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `category_icon` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`, `category_seflink`, `category_icon`) VALUES
(17, 'Elektronika', 'elektronika', '<i class=\"fas fa-mobile-alt\"></i>'),
(18, 'Daşınmaz əmlak', 'dasinmaz-emlak', '<i class=\"fas fa-home\"></i>'),
(19, 'Şəxsi Əşyalar', 'sexsi-esyalar', '<i class=\"fas fa-tshirt\"></i>'),
(20, 'Heyvanlar', 'heyvanlar', '<i class=\"fas fa-paw\"></i>'),
(21, 'Ev və bağ üçün', 'ev-ve-bag-ucun', '<i class=\"fas fa-couch\"></i>'),
(22, 'Xidmətlər', 'xidmetler', '<i class=\"fas fa-cogs\"></i>'),
(23, 'İş və biznes', 'is-ve-biznes', '<i class=\"fas fa-briefcase\"></i>'),
(24, 'Nəqliyyat', 'neqliyyat', '<i class=\"fas fa-car-alt\"></i>'),
(25, 'Uşaq aləmi', 'usaq-alemi', '<i class=\"fas fa-baby-carriage\"></i>'),
(26, 'Hobbi və Asudə', 'hobbi-ve-asude', '<i class=\"fas fa-dumbbell\"></i>');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
