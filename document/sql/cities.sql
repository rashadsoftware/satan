-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 22, 2022 at 12:49 AM
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
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `city_id` int(250) NOT NULL AUTO_INCREMENT,
  `city_title` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `city_seflink` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_id`, `city_title`, `city_seflink`) VALUES
(11, 'Ağcabədi', 'agcabedi'),
(12, 'Ağdam', 'agdam'),
(13, 'Ağdaş', 'agdas'),
(14, 'Ağstafa', 'agstafa'),
(15, 'Ağsu', 'agsu'),
(16, 'Astara', 'astara'),
(17, 'Babək', 'babek'),
(18, 'Bakı', 'baki'),
(19, 'Balakən', 'balaken'),
(20, 'Beyləqan', 'beyleqan'),
(21, 'Biləsuvar', 'bilesuvar'),
(22, 'Bərdə', 'berde'),
(23, 'Culfa', 'culfa'),
(24, 'Cəbrayıl', 'cebrayil'),
(25, 'Cəlilabad', 'celilabad'),
(26, 'Daşkəsən', 'daskesen'),
(27, 'Füzuli', 'fuzuli'),
(28, 'Goranboy', 'goranboy'),
(29, 'Göyçay', 'goycay'),
(30, 'Göygöl', 'goygol'),
(31, 'Gədəbəy', 'gedebey'),
(32, 'Gəncə', 'gence'),
(33, 'Hacıqabul', 'haciqabul'),
(34, 'Imişli', 'imisli'),
(35, 'Ismayıllı', 'ismayilli'),
(36, 'Kürdəmir', 'kurdemir'),
(37, 'Kəlbəcər', 'kelbecer'),
(38, 'Kəngərli', 'kengerli'),
(39, 'Laçın', 'lacin'),
(40, 'Lerik', 'lerik'),
(41, 'Lənkəran', 'lenkeran'),
(42, 'Masallı', 'masalli'),
(43, 'Mingəçevir', 'mingecevir'),
(44, 'Naftalan', 'naftalan'),
(45, 'Naxçıvan', 'naxcivan'),
(46, 'Neftçala', 'neftcala'),
(47, 'Oğuz', 'oguz'),
(48, 'Ordubad', 'ordubad'),
(49, 'Qax', 'qax'),
(50, 'Qazax', 'qazax'),
(51, 'Qobustan', 'qobustan'),
(52, 'Quba', 'quba'),
(53, 'Qubadlı', 'qubadli'),
(54, 'Qusar', 'qusar'),
(55, 'Qəbələ', 'qebele'),
(56, 'Saatlı', 'saatli'),
(57, 'Sabirabad', 'sabirabad'),
(58, 'Şabran', 'sabran'),
(59, 'Şahbuz', 'sahbuz'),
(60, 'Salyan', 'salyan'),
(61, 'Şamaxı', 'samaxi'),
(62, 'Samux', 'samux'),
(63, 'Şirvan', 'sirvan'),
(64, 'Siyəzən', 'siyezen'),
(65, 'Sumqayıt', 'sumqayit'),
(66, 'Şuşa', 'susa'),
(67, 'Sədərək', 'sederek'),
(68, 'Şəki', 'seki'),
(69, 'Şəmkir', 'semkir'),
(70, 'Şərur', 'serur'),
(71, 'Tovuz', 'tovuz'),
(72, 'Tərtər', 'terter'),
(73, 'Ucar', 'ucar'),
(74, 'Xaçmaz', 'xacmaz'),
(75, 'Xırdalan', 'xirdalan'),
(76, 'Xızı', 'xizi'),
(77, 'Xocalı', 'xocali'),
(78, 'Xocavənd', 'xocavend'),
(79, 'Yardımlı', 'yardimli'),
(80, 'Yevlax', 'yevlax'),
(81, 'Zaqatala', 'zaqatala'),
(82, 'Zəngilan', 'zengilan'),
(83, 'Zərdab', 'zerdab');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
