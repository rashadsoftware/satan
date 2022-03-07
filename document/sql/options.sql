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
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
CREATE TABLE IF NOT EXISTS `options` (
  `options_id` int(250) NOT NULL AUTO_INCREMENT,
  `category_id` int(250) NOT NULL,
  `subcategory_id` int(250) NOT NULL,
  `options_title` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `options_seflink` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `options_type` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `options_security` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`options_id`)
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`options_id`, `category_id`, `subcategory_id`, `options_title`, `options_seflink`, `options_type`, `options_security`) VALUES
(37, 17, 45, 'Növü', 'novu', 'select', ''),
(38, 17, 45, 'Məhsulun vəziyyəti', 'mehsulun-veziyyeti', 'select', ''),
(39, 17, 46, 'Malın növü', 'malin-novu', 'select', ''),
(40, 17, 46, 'Məhsulun vəziyyəti', 'mehsulun-veziyyeti', 'select', ''),
(41, 18, 32, 'Elanın növü', 'elanin-novu', 'select', ''),
(42, 18, 32, 'Binanın tipi', 'binanin-tipi', 'select', ''),
(43, 18, 32, 'Əmlakın vəziyyəti', 'emlakin-veziyyeti', 'select', ''),
(44, 18, 32, 'Sahə m<sup>2</sup>', 'sahe-m', 'text', 'number'),
(45, 18, 32, 'Otaq sayı', 'otaq-sayi', 'text', 'number'),
(46, 18, 32, 'Yerləşdiyi mərtəbə', 'yerlesdiyi-mertebe', 'text', 'number'),
(47, 18, 32, 'Mərtəbələrin sayı', 'mertebelerin-sayi', 'text', 'number'),
(48, 18, 32, 'Əmlak sənədi', 'emlak-senedi', 'select', ''),
(49, 18, 32, 'Yerləşmə yeri', 'yerlesme-yeri', 'text', 'text'),
(50, 18, 39, 'Elanın növü', 'elanin-novu', 'select', ''),
(51, 18, 39, 'Əmlakın növü', 'emlakin-novu', 'select', ''),
(52, 18, 39, 'Əmlakın vəziyyəti', 'emlakin-veziyyeti', 'select', ''),
(53, 18, 39, 'Otaq sayı', 'otaq-sayi', 'text', 'number'),
(54, 18, 39, 'Sahə m<sup>2</sup>', 'sahe-m', 'text', 'number'),
(55, 18, 39, 'Yerləşmə yeri', 'yerlesme-yeri', 'text', 'text'),
(56, 18, 33, 'Elanın növü', 'elanin-novu', 'select', ''),
(57, 18, 33, 'Yerləşdiyi yer', 'yerlesdiyi-yer', 'text', 'text'),
(58, 18, 33, 'Sahə sot', 'sahe-sot', 'text', 'number'),
(59, 18, 34, 'Elanın növü', 'elanin-novu', 'select', ''),
(60, 18, 34, 'Əmlakın vəziyyəti', 'emlakin-veziyyeti', 'select', ''),
(61, 18, 34, 'Sahə m<sup>2</sup>', 'sahe-m', 'text', 'number'),
(62, 18, 34, 'Ölkə', 'olke', 'text', 'text'),
(63, 18, 38, 'Elanın növü', 'elanin-novu', 'select', ''),
(64, 18, 38, 'Əmlakın növü', 'emlakin-novu', 'select', ''),
(65, 18, 38, 'Əmlakın vəziyyəti', 'emlakin-veziyyeti', 'select', ''),
(66, 18, 38, 'Sahə m<sup>2</sup>', 'sahe-m', 'text', 'number'),
(67, 18, 38, 'Yerləşdiyi yer', 'yerlesdiyi-yer', 'text', 'text'),
(68, 18, 35, 'Elanın növü', 'elanin-novu', 'select', ''),
(69, 18, 35, 'Qarajın növü', 'qarajin-novu', 'select', ''),
(70, 17, 47, 'Malın növü', 'malin-novu', 'select', ''),
(71, 17, 48, 'Məhsulun vəziyyəti', 'mehsulun-veziyyeti', 'select', ''),
(72, 17, 49, 'Malın növü', 'malin-novu', 'select', ''),
(84, 17, 49, 'Məhsulun vəziyyəti', 'mehsulun-veziyyeti', 'select', ''),
(85, 17, 50, 'Malın növü', 'malin-novu', 'select', ''),
(86, 17, 50, 'Məhsulun vəziyyəti', 'mehsulun-veziyyeti', 'select', ''),
(87, 17, 51, 'Marka', 'marka', 'select', ''),
(88, 17, 51, 'Məhsulun vəziyyəti', 'mehsulun-veziyyeti', 'select', ''),
(89, 17, 52, 'Malın növü', 'malin-novu', 'select', ''),
(90, 17, 52, 'Məhsulun vəziyyəti', 'mehsulun-veziyyeti', 'select', ''),
(91, 17, 53, 'Marka', 'marka', 'select', ''),
(92, 17, 53, 'Məhsulun vəziyyəti', 'mehsulun-veziyyeti', 'select', ''),
(93, 17, 54, 'Operator', 'operator', 'select', ''),
(94, 17, 54, 'Mobil nömrə', 'mobil-nomre', 'text', 'number'),
(95, 17, 54, 'Məhsulun vəziyyəti', 'mehsulun-veziyyeti', 'select', ''),
(96, 17, 55, 'Malın növü', 'malin-novu', 'select', ''),
(97, 17, 55, 'Məhsulun vəziyyəti', 'mehsulun-veziyyeti', 'select', ''),
(98, 19, 40, 'Geyimin Tipi', 'geyimin-tipi', 'select', ''),
(99, 19, 40, 'Geyimin növü', 'geyimin-novu', 'select', ''),
(100, 19, 40, 'Məhsulun vəziyyəti', 'mehsulun-veziyyeti', 'select', ''),
(101, 19, 41, 'Növü', 'novu', 'select', ''),
(102, 19, 41, 'Məhsulun vəziyyəti', 'mehsulun-veziyyeti', 'select', ''),
(103, 19, 42, 'Malın növü', 'malin-novu', 'select', ''),
(104, 19, 42, 'Məhsulun vəziyyəti', 'mehsulun-veziyyeti', 'select', ''),
(105, 19, 44, 'Malın növü', 'malin-novu', 'select', ''),
(106, 20, 56, 'Cins', 'cins', 'select', ''),
(107, 20, 57, 'Cins', 'cins', 'select', ''),
(108, 20, 58, 'Cins', 'cins', 'select', ''),
(109, 20, 60, 'Malın növü', 'malin-novu', 'select', ''),
(110, 21, 62, 'Malın növü', 'malin-novu', 'select', ''),
(111, 21, 62, 'Məhsulun vəziyyəti', 'mehsulun-veziyyeti', 'select', ''),
(112, 21, 63, 'Malın növü', 'malin-novu', 'select', ''),
(113, 21, 63, 'Məhsulun vəziyyəti', 'mehsulun-veziyyeti', 'select', ''),
(114, 21, 64, 'Malın növü', 'malin-novu', 'select', ''),
(115, 21, 64, 'Məhsulun vəziyyəti', 'mehsulun-veziyyeti', 'select', ''),
(116, 21, 65, 'Malın növü', 'malin-novu', 'select', ''),
(117, 21, 65, 'Məhsulun vəziyyəti', 'mehsulun-veziyyeti', 'select', ''),
(118, 23, 67, 'Elanın növü', 'elanin-novu', 'select', ''),
(119, 23, 67, 'Fəaliyyət növü', 'fealiyyet-novu', 'select', ''),
(120, 23, 68, 'Malın növü', 'malin-novu', 'select', ''),
(121, 23, 68, 'Məhsulun vəziyyəti', 'mehsulun-veziyyeti', 'select', ''),
(122, 23, 69, 'Ərzaqın növü', 'erzaqin-novu', 'select', ''),
(123, 24, 70, 'Marka', 'marka', 'select', ''),
(124, 24, 70, 'Model', 'model', 'select', ''),
(125, 24, 70, 'Mühərrik növü', 'muherrik-novu', 'select', ''),
(126, 24, 70, 'Buraxılış ili', 'buraxilis-ili', 'text', 'number'),
(127, 24, 70, 'Sürət qutusu', 'suret-qutusu', 'select', ''),
(128, 24, 70, 'Kuzov növü', 'kuzov-novu', 'select', ''),
(129, 24, 70, 'Rəngi', 'rengi', 'select', ''),
(130, 24, 70, 'Mühərrik sm<sup>3</sup>', 'muherrik-sm-kub', 'text', 'number'),
(131, 24, 70, 'Ötürücü', 'oturucu', 'select', ''),
(132, 24, 70, 'Yürüş km', 'yurus-km', 'text', 'number'),
(133, 24, 70, 'At gücü', 'at-gucu', 'text', 'number'),
(134, 24, 70, 'Vəziyyəti', 'veziyyeti', 'select', ''),
(135, 24, 70, 'Barter', 'barter', 'select', ''),
(136, 25, 75, 'Məhsulun vəziyyəti', 'mehsulun-veziyyeti', 'select', ''),
(137, 25, 76, 'Məhsulun vəziyyəti', 'mehsulun-veziyyeti', 'select', ''),
(138, 23, 67, 'Əmək haqqı', 'emek-haqqi', 'text', 'number'),
(139, 25, 79, 'Məhsulun vəziyyəti', 'mehsulun-veziyyeti', 'select', ''),
(140, 22, 92, 'Təmirin növü', 'temirin-novu', 'select', ''),
(141, 22, 93, 'Xidmətin növü', 'xidmetin-novu', 'select', ''),
(142, 22, 98, 'Xidmətin növü', 'xidmetin-novu', 'select', ''),
(143, 22, 102, 'Xidmətin növü', 'xidmetin-novu', 'select', ''),
(144, 22, 108, 'Xidmətin növü', 'xidmetin-novu', 'select', ''),
(145, 22, 111, 'Texnikanın tipi', 'texnikanin-tipi', 'select', ''),
(146, 26, 83, 'Növü', 'novu', 'select', ''),
(147, 26, 84, 'Növü', 'novu', 'select', ''),
(148, 26, 84, 'Məhsulun vəziyyəti', 'mehsulun-veziyyeti', 'select', ''),
(149, 26, 85, 'Növü', 'novu', 'select', ''),
(150, 26, 85, 'Məhsulun vəziyyəti', 'mehsulun-veziyyeti', 'select', ''),
(151, 26, 86, 'Növü', 'novu', 'select', ''),
(152, 26, 86, 'Məhsulun vəziyyəti', 'mehsulun-veziyyeti', 'select', ''),
(153, 26, 87, 'Növü', 'novu', 'select', ''),
(154, 26, 88, 'Növü', 'novu', 'select', ''),
(155, 26, 89, 'Növü', 'novu', 'select', ''),
(156, 26, 90, 'Elanın növü', 'elanin-novu', 'select', ''),
(157, 26, 90, 'Tanışlıq məqsədi', 'tanisliq-meqsedi', 'select', ''),
(158, 26, 90, 'Yaş', 'yas', 'text', 'number'),
(159, 24, 71, 'Növü', 'novu', 'select', ''),
(160, 24, 71, 'Məhsulun vəziyyəti', 'mehsulun-veziyyeti', 'select', ''),
(161, 24, 72, 'Növü', 'novu', 'select', ''),
(162, 24, 72, 'Vəziyyəti', 'veziyyeti', 'select', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
