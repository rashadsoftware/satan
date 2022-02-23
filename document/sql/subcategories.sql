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
-- Table structure for table `subcategories`
--

CREATE TABLE IF NOT EXISTS `subcategories` (
  `subcategory_id` int(250) NOT NULL AUTO_INCREMENT,
  `subcategory_title` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `subcategory_seflink` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `category_id` int(250) NOT NULL,
  PRIMARY KEY (`subcategory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`subcategory_id`, `subcategory_title`, `subcategory_seflink`, `category_id`) VALUES
(32, 'Mənzillər', 'menziller', 18),
(33, 'Torpaq', 'torpaq', 18),
(34, 'Xaricdə Əmlak', 'xaricde-emlak', 18),
(35, 'Qarajlar', 'qarajlar', 18),
(38, 'Obyektlər və ofislər', 'obyektler-ve-ofisler', 18),
(39, 'Villalar, Bağ evləri, Həyət evləri', 'villalar-bag-evleri-heyet-evleri', 18),
(40, 'Geyim və ayaqqabılar', 'geyim-ve-ayaqqabilar', 19),
(41, 'Saat və zinət əşyaları', 'saat-ve-zinet-esyalari', 19),
(42, 'Aksesuarlar', 'aksesuarlar', 19),
(43, 'Itmiş əşyalar', 'itmis-esyalar', 19),
(44, 'Sağlamlıq və Gözəllik', 'saglamliq-ve-gozellik', 19),
(45, 'Audio və video', 'audio-ve-video', 17),
(46, 'Kompüter aksesuarları', 'komputer-aksesuarlari', 17),
(47, 'Oyunlar, pultlar və proqramlar', 'oyunlar-pultlar-ve-proqramlar', 17),
(48, 'Masaüstü kompüterlər', 'masaustu-komputerler', 17),
(49, 'Kompüter ehtiyyat hissələri', 'komputer-ehtiyyat-hisseleri', 17),
(50, 'Planşet və elektron kitablar', 'planset-ve-elektron-kitablar', 17),
(51, 'Noutbuklar və Netbuklar', 'noutbuklar-ve-netbuklar', 17),
(52, 'Ofis avadanlığı və istehlak', 'ofis-avadanligi-ve-istehlak', 17),
(53, 'Telefonlar', 'telefonlar', 17),
(54, 'Sim kartlar və Nömrələr', 'sim-kartlar-ve-nomreler', 17),
(55, 'Foto texnika', 'foto-texnika', 17),
(56, 'İtlər', 'itler', 20),
(57, 'Pişiklər', 'pisikler', 20),
(58, 'Quşlar', 'quslar', 20),
(59, 'Akvarium və balıqlar', 'akvarium-ve-baliqlar', 20),
(60, 'Heyvanlar üçün məhsullar', 'heyvanlar-ucun-mehsullar', 20),
(61, 'Digər heyvanlar', 'diger-heyvanlar', 20),
(62, 'Təmir və tikinti', 'temir-ve-tikinti', 21),
(63, 'Mebel və interyer', 'mebel-ve-interyer', 21),
(64, 'Məişət texnikası', 'meiset-texnikasi', 21),
(65, 'Qab qacaq və mətbəx ləvazimatları', 'qab-qacaq-ve-metbex-levazimatlari', 21),
(66, 'Bitkilər', 'bitkiler', 21),
(67, 'İş', 'is', 23),
(68, 'Biznes üçün avadanlıq', 'biznes-ucun-avadanliq', 23),
(69, 'Ərzaq', 'erzaq', 23),
(70, 'Avtomobillər', 'avtomobiller', 24),
(71, 'Ehtiyyat hissələri və aksesuarları', 'ehtiyyat-hisseleri-ve-aksesuarlari', 24),
(72, 'Su nəqliyyatı', 'su-neqliyyati', 24),
(73, 'Motosikletlər və mopedlər', 'motosikletler-ve-mopedler', 24),
(74, 'Avtobuslar və xüsusi texnika', 'avtobuslar-ve-xususi-texnika', 24),
(75, 'Avtomobil oturacaqları', 'avtomobil-oturacaqlari', 25),
(76, 'Uşaq arabaları və avtomobillər', 'usaq-arabalari-ve-avtomobiller', 25),
(77, 'Oyuncaqlar', 'oyuncaqlar', 25),
(78, 'Uşaq geyimi', 'usaq-geyimi', 25),
(79, 'Uşaq mebeli', 'usaq-mebeli', 25),
(80, 'Məktəb ləvazimatları', 'mekteb-levazimatlari', 25),
(81, 'Uşaq qidası', 'usaq-qidasi', 25),
(82, 'Digər məhsullar', 'diger-mehsullar', 25),
(83, 'Biletlər və səyahət', 'biletler-ve-seyahet', 26),
(84, 'Velosipedlər', 'velosipedler', 26),
(85, 'Kolleksiya', 'kolleksiya', 26),
(86, 'Musiqi alətləri', 'musiqi-aletleri', 26),
(87, 'Idman və asudə', 'idman-ve-asude', 26),
(88, 'Kitab və jurnallar', 'kitab-ve-jurnallar', 26),
(89, 'Ovçuluq və balıqçılıq', 'ovculuq-ve-baliqciliq', 26),
(90, 'Tanışlıq', 'tanisliq', 26),
(91, 'Avadanlığın icarəsi', 'avadanligin-icaresi', 22),
(92, 'Avto təmir', 'avto-temir', 22),
(93, 'Avadanlıqların quraşdırılması', 'avadanliqlarin-qurasdirilmasi', 22),
(94, 'Dayələr, baxıcılar', 'dayeler-baxicilar', 22),
(95, 'Foto və video çəkiliş xidmətləri', 'foto-ve-video-cekilis-xidmetleri', 22),
(96, 'Gözəllik, sağlamlıq', 'gozellik-saglamliq', 22),
(97, 'Hüquq xidmətləri', 'huquq-xidmetleri', 22),
(98, 'IT, internet, telekom', 'it-internet-telekom', 22),
(99, 'Mebel yığılması və təmiri', 'mebel-yigilmasi-ve-temiri', 22),
(100, 'Musiqi, əyləncə və tədbirlər', 'musiqi-eylence-ve-tedbirler', 22),
(101, 'Mühasibat xidmətləri', 'muhasibat-xidmetleri', 22),
(102, 'Nəqliyyat və logistika', 'neqliyyat-ve-logistika', 22),
(103, 'Qidalanma, keyterinq', 'qidalanma-keyterinq', 22),
(104, 'Reklam, dizayn və poliqrafiya', 'reklam-dizayn-ve-poliqrafiya', 22),
(105, 'Sığorta xidmətləri', 'sigorta-xidmetleri', 22),
(106, 'Təhlükəsizlik sistemlərinin qurulması', 'tehlukesizlik-sistemlerinin-qurulmasi', 22),
(107, 'Təlim, hazırlıq kursları', 'telim-hazirliq-kurslari', 22),
(108, 'Təmir və tikinti', 'temir-ve-tikinti', 22),
(109, 'Təmizlik', 'temizlik', 22),
(110, 'Tərcümə', 'tercume', 22),
(111, 'Texnika təmiri', 'texnika-temiri', 22),
(112, 'Tibbi xidmətlər', 'tibbi-xidmetler', 22),
(113, 'Arxiv', 'arxiv', 22),
(114, 'Digər xidmətlər', 'diger-xidmetler', 22);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
