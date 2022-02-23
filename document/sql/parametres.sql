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
-- Table structure for table `parametres`
--

CREATE TABLE IF NOT EXISTS `parametres` (
  `parametres_id` int(250) NOT NULL AUTO_INCREMENT,
  `parametres_key` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `parametres_title` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `parametres_value` text COLLATE utf8_turkish_ci NOT NULL,
  `parametres_raiting` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`parametres_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `parametres`
--

INSERT INTO `parametres` (`parametres_id`, `parametres_key`, `parametres_title`, `parametres_value`, `parametres_raiting`) VALUES
(8, 'services', 'Elanı irəli çəkmək', 'Elanı qaldırmaqla elan öndə yerləşdirilir, tamamilə yenilənir, və axtarışın nəticələrində digər elanlardan öndə gəlir. \r\n\r\nSayta daim yeni elanlar əlavə olunduğundan əvvəlki elanlar geridə qalır və axtarış zamanı tapmaq çətinləşir. Nəticədə elanın effekti aşağı düşür. Elanı qaldırma xidməti elanı yenidən öndə yerləşdirərək yenilənməsini təmin edir.', 'simple'),
(10, 'services', 'Premium Elan', 'Premium elanlar saytda birinci səhifədə, və öndə yerləşdirilir, axtarış zamanı digər adi elanlardan öndə gəlir. Nəticədə sayta daxil olan hər bir istifadəçi tərəfindən baxılır, digər elanlara nisbətən tez tapılır və daha çox baxılır. Əgər satdığınız məhsulun daha tez satılmasını istəyirsinisə bu xidmətdən yararlanmağınız məsləhətdir.\r\n\r\nÖdəniş edildikdən sonra istifadəçi istəyinə uyğun şəkillərin sayını artıra bilər.\r\n\r\nUzunmüddətli ödənişlər üçün endirimlər edilir.', 'premium'),
(11, 'services', 'VIP Elan', 'VIP-elanlar ayrıca blokda yerləşdirilir. VIP müddət başa çatanadək bu elanlar 2 siyahıda, VIP-elanların siyahısında və adi elanların siyahısında görsənir. VIP müddət başa çatdıqdan sonra adi elanların siyahısında qalır. VIP blokdakı elanlar baş səhifədə və eyni kateqoriyalı elanların axtarışı zamanı bütün səhifələrdə göstərilir. Nəticədə sayta daxil olan hər bir istifadəçi tərəfindən baxılır və axtarış zamanı 1-ci səhifədə təqdim olunur. Vip elanlar, əlavə olaraq saytda Təcili, seçmə elanlar blokuna əlavə edilir.', 'vip'),
(12, 'contact', '', 'Təklif və Suallarınız üçün elektron adresimiz:', ''),
(13, 'rules', '', 'Elanı silib yenidən yerləşdirmək 30 gün ərzində qadağandır', ''),
(14, 'rules', '', 'Təkrar elan yerləşdirməyin, əks halda dərc olunmayacaq', ''),
(15, 'rules', '', 'Qadağan olunmuş xidmət və məhsul elanları qəbul olunmur', ''),
(16, 'rules', '', 'Elanınızı aid olmadığı kateqoriyaya əlavə etməyin', ''),
(17, 'rules', '', '\"Elanın adı\" bölməsində qiymət yazmayın və yalnız baş hərflərdən istifade etmək olmaz', ''),
(18, 'rules', '', 'Elanın təsvirinə aid olmayan məzmun, şəkil  yerləşdirməyin', ''),
(19, 'rules', '', 'Üzərində yazı, sayt adları, logo olan şəkillərlə elan dərc olunmayacaq', ''),
(20, 'rules', '', 'Bir elan içində başqa kateqoriyalara aid olan məhsullar (məsələn: bir elanın içində telefon və televizor, geyim və mebel, kompyuter və fotoaparat, velosiped və s) təqdim etməyin', ''),
(21, 'rules', '', 'Elanın məzmununda məlumatları böyük hərflərlə yazmaq, həmçinin telefon nömrəsi, e-mail ünvanı və şirkət haqqında xidmətləri yazmaq, (ş,Ş) həriflərinin yerinə (w, W) yazmaq olmaz', ''),
(22, 'rules', '', 'Elan yaradan zaman əlaqə vasitələrini (telefon nömrəsi, e-mail ünvanını) düzgün qeyd edin.\r\nDigər şəxslərin əlaqə nömrəsini qeyd etmək olmaz.\r\nSaytda statusundan (ödənişli-ödənişsiz) asılı olmayaraq  dərc olunan elanda qeyd edilən əlaqə nömrəsi dəyişdirilmir', ''),
(23, 'rules', '', 'Saytda QEYDİYYATSIZ istifadəçilər üçün elanı silmək və ya düzəliş etmək qaydaları:', 'title'),
(24, 'rules', '', 'Elanda qeyd etdiyiniz telefon nömrəsindən  WhatsApp-la və ya adi mesajla: (077) 384-86-84 nömrəsinə \"elanın kodunu yazın və nə etmək istədiyinizi göstərin.\r\nNÜMUNƏ : \"589678 elanı silin\" və yaxud \"589678 elanda qiyməti 123,000 manat edin\"\r\n\r\nQeyd: SMS - mesaj yalnız elanda qeyd olunan telefon nömrəsindən göndərilməlidir.\r\nƏks halda elan silinməyəcək və ya düzəliş olunmayacaqdır.', ''),
(25, 'rules', '', 'E-mail vasitəsi ilə:\r\n\r\nElanda qeyd etdiyiniz email adresindən bizim saytın emaili: info@satan.az adresinə \"elanın kodunu yazın və nə etmək istədiyinizi göstərin\"\r\n\r\nQeyd: Email yalnız elanda qeyd olunan email adresindən göndərilməlidir.\r\nƏks tədqirdə elan silinməyəcək və ya düzəliş olunmayacaqdır.', ''),
(26, 'rules', '', 'Satan.az - saytının adminstrasiyası elan yerləşdirməklə bağlı qaydaları xəbərdarlıq etmədən istənilən vaxt yeniləmək və dəyişdirmək hüququna malikdir.', ''),
(27, 'contact', '', 'E-mail: info@satan.az', ''),
(28, 'about', '', 'Satan.az - Pulsuz elanlar saytı 2021-ci ildə fəaliyyətə başlayıb. Siz bu saytda müxtəlif yeni və işlənmiş məhsullar sata bilər və təklif olunan xidmətlər bölmələrini nəzərdən keçirə bilərsiniz.  Tam pulsuz olaraq öz elanlarınızı yerləşdirə bilərsiniz!', ''),
(29, 'about', '', 'Həmçinin öz məhsullarınızın daha tez satılması və elanınızın saytdakı digər elanlardan öndə görünməsi üçün ödənişli olaraq \"Premium\", \"VİP\" və \"İrəli çək\" statuslardan istifadə edə bilərsiniz.', ''),
(30, 'contact', '', 'Tel: (077) 384-86-84', ''),
(31, 'rules', '', 'Elanda istifadə edəcəyiniz bir şəkilin maksimal həcmi 10 MB olmalıdır', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
