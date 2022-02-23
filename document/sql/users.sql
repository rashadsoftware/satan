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
  `user_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_img`, `user_name`, `user_email`, `user_password`, `user_phone`, `user_status`, `user_ip`, `user_login`, `user_time`) VALUES
(1, 'user2.png', 'Rashad Alakbarov', 'rashadalakbarov2020@gmail.com', 'qasimov24123', '055 5356565', 'admin', '212.47.142.208', 'open', '2021-12-05 16:35:19'),
(4, '', 'Emil Hetemov', 'emil.hatamov1991@gmail.com', '5525339', '0774540707', 'admin', '', 'open', '2021-12-05 16:35:19'),
(6, '', 'Rəşad Ələkbərov', 'rashadalakbarov2020@gmail.com', 'qasimov24123', '', 'user', '', '', '2021-12-05 16:35:19'),
(7, '', '', 'murka-huseynzade-2004@mail.ru', 'aytac2003', '', 'user', '', '', '2021-12-05 16:35:19'),
(8, '', '', 'emil.hatamov1991@gmail.com', '5525339', '', 'user', '', '', '2021-12-05 16:35:19'),
(10, '', '', 'elsonabbasov@gmail.com', 'turkan2018', '', 'user', '', '', '2021-12-05 16:35:19'),
(11, '', '', 'nigarefendiyeva.lifeguard.az@gmail.com', 'afrodita12', '', 'user', '', '', '2021-12-08 09:26:54'),
(12, '', '', 'babayev_70@internet.ru', 'baku2021', '', 'user', '', '', '2021-12-11 06:40:58'),
(13, '', 'Elxan Aliyev', 'elxanaliyev6656@gmail.com', 'elxanelxan', '', 'user', '', '', '2021-12-13 07:29:52'),
(14, '', '', 'elviraeliyeva988@gmail.com', 'kabnet7', '', 'user', '', '', '2021-12-13 10:33:04'),
(15, '', '', 'tehlukesizliksistemleri@gmail.com', 'afrodita12', '', 'user', '', '', '2021-12-13 20:16:48'),
(16, '', '', 'memmedoglugroup.nazendexanim@gmail.com', '321147naz', '', 'user', '', '', '2021-12-15 09:00:15'),
(17, '', '', 'it.texnopark@gmail.com', 'axmed1978', '', 'user', '', '', '2021-12-23 13:53:14'),
(18, '', '', 'samira.huseynova.99@gmail.com', 'cakonda2', '', 'user', '', '', '2021-12-30 12:29:42'),
(19, '', '', 'agayevasolmaz07@gmail.com', 'kabinet16', '', 'user', '', '', '2022-01-08 03:12:19'),
(20, '', 'Samir', 'skerimli29@gmail.com', '3310113Ks', '', 'user', '', '', '2022-01-10 10:03:22'),
(21, '', '', 'tentchi.az@gmail.com', 'konul1988', '', 'user', '', '', '2022-01-11 07:47:25'),
(22, '', '', 'eynurhesenov6@gmail.com', 'eynur7777', '', 'user', '', '', '2022-01-11 08:24:32'),
(23, '', '', 'nurayaslanova.az@gmail.com', 'konul1988', '', 'user', '', '', '2022-01-11 13:14:18'),
(24, '', '', 'huseynovahumay9@gmail.com', 'kabinet9', '', 'user', '', '', '2022-01-12 09:42:40'),
(25, '', '', 'p.vamiq@mail.ru', 'bagira96', '', 'user', '', '', '2022-01-16 11:50:00'),
(26, '', '', 'elvinibayev0@gmail.com', '19988991e', '', 'user', '', '', '2022-01-18 10:36:41'),
(27, '', '', 'gunel-memmedova-94@inbox.ru', 'gunelmemmedova', '', 'user', '', '', '2022-01-19 06:09:20'),
(28, '', '', 'sefaabdullayeva04@gmail.com', 'kabinet7', '', 'user', '', '', '2022-01-27 05:14:00'),
(29, '', '', 'rustemovanaze@gmail.com', 'ilkin1234', '', 'user', '', '', '2022-02-02 08:27:48'),
(30, '', '', 'memmedoglugroup.nigar@gmail.com', 'ilkin1234', '', 'user', '', '', '2022-02-02 10:56:51'),
(31, '', '', 'memmedoglu.nazende@gmail.com', 'ilkin1234', '', 'user', '', '', '2022-02-03 08:12:55'),
(32, '', '', 'evalqisatqisi777@gmail.com', 'xanimxanim', '', 'user', '', '', '2022-02-03 17:42:15'),
(33, '', '', 'memmedoglugroup.kamala@gmail.com', 'ilkin1234', '', 'user', '', '', '2022-02-04 10:24:43'),
(34, '', '', 'memmedoglu.group@gmail.com', 'ilkin1234', '', 'user', '', '', '2022-02-04 13:49:25'),
(35, '', 'alim445', 'alim4454964@gmail.com', 'A2012M2015', '', 'user', '', '', '2022-02-05 06:24:51'),
(36, '', '', 'nazrustemova99@gmail.com', 'ilkin1234', '', 'user', '', '', '2022-02-05 10:37:11'),
(37, '', '', 'bassemdjebbar91@gmail.com', 'test12345', '', 'user', '', '', '2022-02-09 20:15:34'),
(38, '', '', 'memmedoglugroupmmc@gmail.com', 'ilkin1234', '', 'user', '', '', '2022-02-14 08:31:57'),
(39, '', '', 'memmedlielvin@gmail.com', 'ilkin1234', '', 'user', '', '', '2022-02-15 11:45:17');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
