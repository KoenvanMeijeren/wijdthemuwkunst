-- -------------------------------------------------------------
-- TablePlus 4.6.2(410)
--
-- https://tableplus.com/
--
-- Database: whuk
-- Generation Time: 2022-04-18 13:39:32.8050
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE TABLE `account` (
  `account_ID` int(11) NOT NULL AUTO_INCREMENT,
  `account_name` varchar(255) NOT NULL DEFAULT '',
  `account_email` varchar(255) NOT NULL,
  `account_password` text NOT NULL,
  `account_rights` tinyint(1) NOT NULL DEFAULT 0,
  `account_login_token` text DEFAULT NULL,
  `account_failed_login` tinyint(1) NOT NULL DEFAULT 0,
  `account_is_blocked` tinyint(1) NOT NULL DEFAULT 0,
  `account_is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`account_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

CREATE TABLE `contact_form` (
  `contact_form_id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_form_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `contact_form_email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `contact_form_message` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `contact_form_created_at` datetime NOT NULL,
  `contact_form_is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`contact_form_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

CREATE TABLE `event` (
  `event_ID` int(11) NOT NULL AUTO_INCREMENT,
  `event_slug_ID` int(11) DEFAULT NULL,
  `event_thumbnail_ID` int(11) DEFAULT 0,
  `event_banner_ID` int(11) DEFAULT 0,
  `event_title` text NOT NULL,
  `event_content` text NOT NULL,
  `event_location` varchar(54) NOT NULL,
  `event_date` datetime NOT NULL,
  `event_is_published` int(11) NOT NULL DEFAULT 0,
  `event_is_archived` tinyint(4) NOT NULL DEFAULT 0,
  `event_is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`event_ID`),
  KEY `event_slug_ID` (`event_slug_ID`),
  CONSTRAINT `event_ibfk_3` FOREIGN KEY (`event_slug_ID`) REFERENCES `slug` (`slug_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

CREATE TABLE `file` (
  `file_ID` int(11) NOT NULL AUTO_INCREMENT,
  `file_path` text NOT NULL,
  `file_is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`file_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

CREATE TABLE `menu` (
  `menu_ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `menu_slug_ID` int(11) NOT NULL,
  `menu_title` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `menu_weight` int(11) NOT NULL,
  `menu_is_deleted` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`menu_ID`),
  KEY `menu_slug_ID` (`menu_slug_ID`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`menu_slug_ID`) REFERENCES `slug` (`slug_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

CREATE TABLE `page` (
  `page_ID` int(11) NOT NULL AUTO_INCREMENT,
  `page_slug_ID` int(11) NOT NULL,
  `page_thumbnail_ID` int(11) DEFAULT NULL,
  `page_banner_ID` int(11) DEFAULT NULL,
  `page_title` text NOT NULL,
  `page_content` text NOT NULL,
  `page_in_menu` tinyint(1) NOT NULL DEFAULT 0,
  `page_is_published` tinyint(1) NOT NULL DEFAULT 0,
  `page_is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`page_ID`),
  KEY `page_slug_ID` (`page_slug_ID`),
  CONSTRAINT `page_ibfk_1` FOREIGN KEY (`page_slug_ID`) REFERENCES `slug` (`slug_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

CREATE TABLE `setting` (
  `setting_ID` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` text NOT NULL,
  `setting_value` text NOT NULL,
  `setting_is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`setting_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

CREATE TABLE `slug` (
  `slug_ID` int(11) NOT NULL AUTO_INCREMENT,
  `slug_name` text NOT NULL,
  `slug_is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`slug_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

CREATE TABLE `translation` (
  `translation_ID` int(11) NOT NULL AUTO_INCREMENT,
  `translation_key` text NOT NULL,
  `translation_value` text NOT NULL,
  `translation_language` varchar(2) NOT NULL DEFAULT 'nl',
  `translation_is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`translation_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO `account` (`account_ID`, `account_name`, `account_email`, `account_password`, `account_rights`, `account_login_token`, `account_failed_login`, `account_is_blocked`, `account_is_deleted`) VALUES
(1, 'Koen van Meijeren', 'koenvanmeijeren@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$ek9OT2ZkQkxHc2pEUk14Qw$a7fIZssrKFQAhzgIT0vodPM62Kv1wIHB4ZURKnGCeug', 3, 'd462f64853cdfcb41fca9a6a326dfc0858c3eef4cd35039ae904132bf70eeae0a8aa51eb96851a447c9ab122c22b248b414cb60a61ffd8f1671d535f8005ec5cc0c09cc1b7af40a766685f235a01dbcbfc28876e4282f80d97a712f14a120050de77c78a5ae2430781c0c08ec40ccf521fe12e76ee986732e47563afde3542efca036b546e741afab195d192e8a57edce45e52f31f1411f21c47142d07b0cbc271ab31f8da7a8b52696889d63b20f41eb6217bcaf7037cb468650ea92d1cd656884b660b85492f7f', 0, 0, 0),
(47, 'Beheerder', 'beheerder@test.nl', '$argon2id$v=19$m=65536,t=4,p=1$dFlsQ29QT3o3S2tZcnZmMg$zOeYh75WwFuR3LekyPJi5hU+gNUOtwlkaygisInYMzk', 1, 'fd50a319fcc3fa53beaf609feb1b4a1d26c2315741615d75c02984f549e63d9400ea58acd97a2876101c61d8a8e076754570105e5a66a49583b0fb1587b74ead3d1aecc09699c686d5d0889eb5ed7896216365ae7f0f0bdbafd4738d0705b34c4889a49354b5487e8411a1d684ed08f61f7482f8614c6a61b75de70d385ba9b93460e896a134ca607e40b823b2ee878ee0bec11f02272a99ef4c8be580cee7b779ed7452d1cba52df9cc68fd831ffaa9c10c115271be210b2ee38267c511d3fcc8849e0ec694887d', 0, 0, 0),
(50, 'Beheerder', 'superbeheerder@test.nl', '$argon2id$v=19$m=65536,t=4,p=1$WnlRUkcxODloaklPWS4zTQ$1CnaEdqIdIbQofhXUaKtpuviZ2R3Q/5VaihftwpMy4s', 2, '1145d75658712bd304705f71ef63c8309d4aa7ef810035f48f99f54e68f16bca97cc91e4f197f3ad7eb179a494f4adec55a4f88e30c42e4e4ce69683040336075f305a9b30b7bd453c208d91124b6dc122871d3340242a228d2f49b752e98a083a5d568ed6ab5ef30b94f04d4e5b3d15d8c749fd4689296e9f866df41b60cfd64536740f86b241c19f7e5bc022ad72281c17e8583d815f8cae890365c77d03460919c0ab4ca7bf0e6dff92f722da9dafeb4feeec5519c8c21cfd4d196c26fd34249dc69a2338bc36', 0, 0, 0),
(51, 'Account', 'account@test.nl', '$argon2id$v=19$m=65536,t=4,p=1$cWZ3TllPaWRxVjA0TU41bQ$O4kWtzr+CF8I3yWvGT02m1h+PZpvVWuHgay1WKlEVqA', 3, 'eae96793024711b89d7cfb2d717395117f2c288f537042ad5c71d2ff3a9f562931d56d9e2f6b412b5b92f29c6c3b8e2aacb54d33dae9f3c6df46155b9349b88dea3fc75cc9c79ba8060c363dc09da0cd31277a5b84441637279bab312f94f08d64bed87945781d6216939c1d08a3db58ed98d038104d8d3b1cb37d50b58ef396fb4bd7dbd865a9ef2aea2b5fa2c1ea4d3ec217ffbb0c53365521df46d50b7ed00f22d8a6bbdfd7215c3ff926dd2a2e70d782661fd13750c0745d4f88ee9c6917dc040cb82a83c1a9', 0, 1, 1),
(58, 'Test Nieuwe Views', 'view@test.nl', '$argon2id$v=19$m=65536,t=4,p=1$c0VlLzk3SFhNVFJiOEkzcA$oxNsGmsyJ1VBvbB1cGYzLwWC8dcjkKcXbj2Uw1UgV1c', 1, NULL, 0, 0, 1),
(59, 'test form validatie', 'formvalidatie@test.nl', '$argon2id$v=19$m=65536,t=4,p=1$ZGw3RjY4SFIuV201Tm5peQ$x0zLcL7e2+b7WKQFsaUu9jZcKcT4TyVjB7dAmDuTxwc', 3, NULL, 0, 0, 1),
(60, 'Test Form validatie', 'form@validatie.nl', '$argon2id$v=19$m=65536,t=4,p=1$aUtuY3dJVzBtRjJ4OGxqTA$8zHpNIeaJsnSeLiPa3THFSI1+JYi5572zdzrc3YfsHc', 1, NULL, 0, 0, 1),
(61, 'test', 'testen@testen.nl', '$argon2id$v=19$m=65536,t=4,p=1$Yk9xRUc3Wi5WRVR1MGVUcA$38LFl4aFub6aXrhgt/mac/Gq2W8hbRANVVQZqebLTGY', 1, NULL, 0, 0, 1),
(62, 'test admin', 'test@test.nl', '$argon2id$v=19$m=65536,t=4,p=1$ck83VUh5NUZpRnFaZktMOA$sSWhDNE0M3iYeEnjrctBkQHRQwSz01WvF9a5CNHcsps', 1, 'eaffe21b1ea2a6e69c234d66ea98d4b6d14e3bfa191c9cf3b78979416d2e3e78b98df2936a50b50ec906f994566b8b9b99604aca68a31fc671cab7a94f9e5943fc554a8a19757d76c199450488fd4083c1408a4f7b860e556fa6a5e1a3bf2e698fdade2535f006bf6851eca4c14ff8821f537c586ffb02fa7518d5b1a9687cd479411d16d2858706fcb2c1767e03e231b096cdeb0d0f92b87e264526c34c8c1c94ce8f42bde8837c50418752541ba6a96a8e80d23744d38781d0e8b4c32041477128acf2cdf5a6d1', 0, 0, 1),
(63, 'test', 'test@test.nl', '$argon2id$v=19$m=65536,t=4,p=1$NDl3YWV6VXVTMVNyeElkZg$vT3Gy1PBs0vxX533y5xyLQ3F0Qd2Yu3bylDoY+c5iR8', 1, NULL, 0, 0, 1);

INSERT INTO `contact_form` (`contact_form_id`, `contact_form_name`, `contact_form_email`, `contact_form_message`, `contact_form_created_at`, `contact_form_is_deleted`) VALUES
(1, 'Koen van Meijeren', 'koenvanmeijeren@gmail.com', 'Het Christelijk gemend koor &#34;Wijdt Hem Uw Kunst&#34; uit Harderwijk werd opgericht in 1953 en heeft op dit moment 65 leden. Sinds 2018 staat het  koor onder leiding van Marijn de Jong. Daarvoor stond het koor 23 jaar onder leiding van Evert van de Veen.  Het koor verleent haar medewerking aan verschillende zangavonden in Harderwijk en omgeving zoals de jaarlijks terugkerende Kerstzangdienst en Paaszangdienst in de Chr. Geref. Kerk te Harderwijk. De naam van het koor is ontleend aan het tweede vers van Psalm 33: &#34;Wijdt Hem uw kunst&#34;. Dit is dan ook de doelstelling van het koor. Het koor oefent iedere woensdagavond.', '2020-03-26 19:37:13', 1),
(2, 'Koen van Meijeren', 'koenvanmeijeren@gmail.com', 'use App\\Domain\\Admin\\ContactForm\\Repository\\ContactFormRepository;', '2020-03-26 19:37:13', 1),
(3, 'Koen van Meijeren', 'koenvanmeijeren@develto.nl', 'Hallo', '2020-03-26 19:37:13', 0),
(4, 'Koen van Meijeren', 'koenvanmeijeren@gmail.com', 'test', '2020-03-26 19:37:13', 1),
(5, 'Koen van Meijeren', 'koenvanmeijeren@gmail.com', 'test', '2020-03-26 19:37:13', 0),
(6, 'Koen van Meijeren', 'koenvanmeijeren@gmail.com', 'test', '2020-03-28 19:13:20', 0),
(7, 'Koen', 'koenvanmeijeren@gmail.com', 'test', '2020-03-30 18:22:14', 1),
(8, 'Koen van Meijeren', 'koenvanmeijeren@gmail.com', 'test', '2020-03-30 18:23:58', 1),
(9, 'Koen van Meijeren', 'koenvanmeijeren@gmail.com', 'test', '2020-04-05 12:44:00', 0),
(10, 'Koen van Meijeren', 'koenvanmeijeren@gmail.com', 'test', '2020-04-13 16:19:51', 0),
(11, 'Koen', 'koenvanmeijeren@gmail.com', 'test', '2020-04-14 17:13:26', 1),
(12, 'Koen', 'test@test.nl', 'test', '2020-06-01 13:17:59', 0);

INSERT INTO `event` (`event_ID`, `event_slug_ID`, `event_thumbnail_ID`, `event_banner_ID`, `event_title`, `event_content`, `event_location`, `event_date`, `event_is_published`, `event_is_archived`, `event_is_deleted`) VALUES
(1, 14, 7, 29, 'Kerstuitvoering', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n&lt;p&gt;test&lt;/p&gt;\r\n&lt;/body&gt;\r\n&lt;/html&gt;', 'Harderwijk - CGK de Zaaier', '2020-04-15 19:37:13', 1, 0, 0),
(2, 15, 8, 0, 'Paasuitvoering', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n\r\n&lt;/body&gt;\r\n&lt;/html&gt;', 'Harderwijk - CGK de Zaaier', '2020-03-10 19:42:44', 1, 1, 0),
(3, 26, 9, 0, 'test vier', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n\r\n&lt;/body&gt;\r\n&lt;/html&gt;', 'Harderwijk - CGK de Zaaier', '2020-03-19 19:44:41', 1, 1, 0),
(4, 28, 10, 0, 'test vijf', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n\r\n&lt;/body&gt;\r\n&lt;/html&gt;', 'test', '2020-03-10 20:03:33', 1, 1, 0),
(5, 29, 11, 0, 'test zes', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n\r\n&lt;/body&gt;\r\n&lt;/html&gt;', 'Harderwijk - CGK de Zaaier', '2020-03-25 20:04:01', 1, 1, 0),
(6, 7, 13, 0, 'test', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n&lt;p&gt;test&lt;/p&gt;\r\n&lt;/body&gt;\r\n&lt;/html&gt;', 'Harderwijk - CGK de Zaaier', '2020-04-22 18:12:54', 1, 0, 1),
(7, 35, 17, 21, 'Harderwijk concert', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n&lt;p&gt;test&lt;/p&gt;\r\n&lt;/body&gt;\r\n&lt;/html&gt;', 'Harderwijk - CGK de Zaaier', '2020-04-23 18:41:58', 1, 0, 0),
(8, 37, 0, 0, 'tweede paasdag', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n&lt;p&gt;test zoveel&lt;/p&gt;\r\n&lt;/body&gt;\r\n&lt;/html&gt;', 'CGK De zaaier', '2020-04-16 05:30:00', 1, 0, 1),
(9, 7, 26, 0, 'test', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n&lt;p&gt;test&lt;/p&gt;\r\n&lt;/body&gt;\r\n&lt;/html&gt;', 'Harderwijk - CGK de Zaaier', '2020-05-28 11:32:25', 1, 0, 0);

INSERT INTO `file` (`file_ID`, `file_path`, `file_is_deleted`) VALUES
(1, '/storage/media/626c6f62323032302d30332d30312031343a33313a3534.png', 0),
(2, '/storage/media/626c6f62323032302d30332d30342031393a31333a3535.png', 0),
(3, '/storage/media/626c6f62323032302d30332d30342031393a31343a3437.png', 0),
(4, '/storage/media/626c6f62323032302d30332d31372031373a32303a3139.png', 0),
(5, '/storage/media/626c6f62323032302d30332d31372031373a32313a3036.png', 0),
(6, '/storage/media/626c6f62323032302d30332d31372031393a33353a3234.png', 0),
(7, '/storage/media/626c6f62323032302d30332d31372031393a33373a3234.png', 0),
(8, '/storage/media/626c6f62323032302d30332d31372031393a34333a3037.png', 0),
(9, '/storage/media/626c6f62323032302d30332d31372031393a34343a3538.png', 0),
(10, '/storage/media/626c6f62323032302d30332d31372032303a30333a3438.png', 0),
(11, '/storage/media/626c6f62323032302d30332d31372032303a30353a3034.png', 0),
(12, '/storage/media/626c6f62323032302d30342d30352031323a34333a3234.png', 0),
(13, '/storage/media/626c6f62323032302d30342d30362031383a31333a3039.png', 0),
(14, '/storage/media/626c6f62323032302d30342d30362031383a31333a3138.png', 0),
(15, '/storage/media/626c6f62323032302d30342d30362031383a31353a3337.png', 0),
(16, '/storage/media/626c6f62323032302d30342d30362031383a31353a3433.png', 0),
(17, '/storage/media/626c6f62323032302d30342d30382031383a34373a3438.png', 0),
(18, '/storage/media/626c6f62323032302d30342d31332031363a32363a3430.png', 0),
(19, '/storage/media/626c6f62323032302d30342d31332031363a32363a3437.png', 0),
(20, '/storage/media/626c6f62323032302d30342d31332031363a33333a3032.png', 0),
(21, '/storage/media/626c6f62323032302d30342d31392031343a32333a3436.png', 0),
(22, '/storage/media/626c6f62323032302d30352d32322030393a34333a3237.png', 0),
(23, '/storage/media/626c6f62323032302d30352d32322030393a34333a3433.png', 0),
(24, '/storage/media/626c6f62323032302d30352d32322030393a34383a3035.png', 0),
(25, '/storage/media/626c6f62323032302d30352d32322030393a34383a3132.png', 0),
(26, '/storage/media/626c6f62323032302d30352d32322031313a33323a3337.png', 0),
(27, '/storage/media/626c6f62323032302d30352d32322031353a35393a3437.png', 0),
(28, '/storage/media/626c6f62323032302d30352d32322031353a35393a3536.png', 0),
(29, '/storage/media/626c6f62323032302d30352d32322031363a31373a3435.png', 0),
(30, '/storage/media/626c6f62323032302d30362d30312031333a30363a3139.png', 0),
(31, '/storage/media/626c6f62323032302d30372d30342031373a31363a3137.png', 0);

INSERT INTO `menu` (`menu_ID`, `menu_slug_ID`, `menu_title`, `menu_weight`, `menu_is_deleted`) VALUES
(1, 3, 'Concerten', 1, 1),
(2, 3, 'Concerten', 1, 1),
(3, 3, 'Concerten', 1, 1),
(4, 3, 'Concerten', 1, 1),
(5, 32, 'Home', 1, 1),
(6, 34, 'Home', 1, 0),
(7, 3, 'Concerten', 2, 0),
(8, 7, 'Home b', 1, 1),
(9, 7, 'test', 3, 1);

INSERT INTO `page` (`page_ID`, `page_slug_ID`, `page_thumbnail_ID`, `page_banner_ID`, `page_title`, `page_content`, `page_in_menu`, `page_is_published`, `page_is_deleted`) VALUES
(3, 13, 0, 0, 'Contact formulier verzonden', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n&lt;h1&gt;Contact verzonden&lt;/h1&gt;\r\n&lt;p&gt;Het contact formulier is succesvol verzonden.&lt;/p&gt;\r\n&lt;/body&gt;\r\n&lt;/html&gt;', 3, 0, 1),
(4, 13, 0, 0, 'Contact formulier verzonden', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n&lt;h1&gt;Contact formulier verzonden&lt;/h1&gt;\r\n&lt;p&gt;Het contact formulier is succesvol verzonden.&lt;/p&gt;\r\n&lt;/body&gt;\r\n&lt;/html&gt;', 3, 1, 1),
(5, 2, 0, 0, '404 - Pagina niet gevonden', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n&lt;h1&gt;404 - pagina niet gevonden&lt;/h1&gt;\r\n&lt;p&gt;Deze pagina bestaat niet.&lt;/p&gt;\r\n&lt;/body&gt;\r\n&lt;/html&gt;', 2, 1, 0),
(6, 1, 0, 0, 'Home', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n&lt;h1&gt;Historie&lt;/h1&gt;\r\n&lt;p&gt;Het Christelijk gemend koor &#34;Wijdt Hem Uw Kunst&#34; uit Harderwijk werd opgericht in 1953 en heeft op dit moment 65 leden. Sinds 2018 staat het&amp;nbsp; koor onder leiding van Marijn de Jong. Daarvoor stond het koor 23 jaar onder leiding van Evert van de Veen. &amp;nbsp;Het koor verleent haar medewerking aan verschillende zangavonden in Harderwijk en omgeving zoals de jaarlijks terugkerende Kerstzangdienst en Paaszangdienst in de Chr. Geref. Kerk te Harderwijk. De naam van het koor is ontleend aan het tweede vers van Psalm 33: &#34;Wijdt Hem uw kunst&#34;. Dit is dan ook de doelstelling van het koor. Het koor oefent iedere woensdagavond.&lt;/p&gt;\r\n&lt;/body&gt;\r\n&lt;/html&gt;', 2, 1, 0),
(7, 7, 0, 0, 'test', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n&lt;h1&gt;test&lt;/h1&gt;\r\n&lt;p&gt;test&lt;/p&gt;\r\n&lt;/body&gt;\r\n&lt;/html&gt;', 1, 1, 1),
(8, 3, NULL, NULL, 'Concerten', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n&lt;h1&gt;Concerten&lt;/h1&gt;\r\n&lt;p&gt;Enkele komende concerten.&lt;/p&gt;\r\n&lt;/body&gt;\r\n&lt;/html&gt;', 2, 1, 0),
(9, 7, 0, 0, 'test', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n&lt;p&gt;test&lt;/p&gt;\r\n&lt;/body&gt;\r\n&lt;/html&gt;', 0, 1, 1),
(10, 7, NULL, NULL, 'test', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n\r\n&lt;/body&gt;\r\n&lt;/html&gt;', 1, 1, 1),
(11, 27, NULL, NULL, 'Concerten historie', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n&lt;h1&gt;Concerten historie&lt;/h1&gt;\r\n&lt;p&gt;Enkele concerten uit het verleden.&lt;/p&gt;\r\n&lt;/body&gt;\r\n&lt;/html&gt;', 2, 1, 0),
(12, 30, NULL, NULL, 'Contact aanvraag verzonden', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n&lt;h1&gt;Contact aanvraag verzonden&lt;/h1&gt;\r\n&lt;p&gt;De contact aanvraag is succesvol verzonden.&lt;/p&gt;\r\n&lt;/body&gt;\r\n&lt;/html&gt;', 2, 1, 0),
(13, 7, NULL, NULL, 'test', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n&lt;p&gt;test&lt;/p&gt;\r\n&lt;/body&gt;\r\n&lt;/html&gt;', 0, 0, 1),
(14, 7, 0, 0, 'test', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n&lt;p&gt;test&lt;/p&gt;\r\n&lt;/body&gt;\r\n&lt;/html&gt;', 0, 1, 1),
(15, 7, NULL, NULL, 'test', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n&lt;p&gt;test&lt;/p&gt;\r\n&lt;/body&gt;\r\n&lt;/html&gt;', 0, 1, 1),
(16, 7, NULL, NULL, 'test', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n&lt;p&gt;test&lt;/p&gt;\r\n&lt;/body&gt;\r\n&lt;/html&gt;', 1, 1, 1),
(17, 7, NULL, NULL, 'test', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n&lt;p&gt;test&lt;/p&gt;\r\n&lt;/body&gt;\r\n&lt;/html&gt;', 1, 0, 1),
(18, 7, 0, 0, 'test', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n&lt;p&gt;test&lt;/p&gt;\r\n&lt;/body&gt;\r\n&lt;/html&gt;', 1, 0, 1),
(19, 7, 0, NULL, 'test', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n&lt;p&gt;test&lt;/p&gt;\r\n&lt;/body&gt;\r\n&lt;/html&gt;', 1, 1, 0);

INSERT INTO `setting` (`setting_ID`, `setting_key`, `setting_value`, `setting_is_deleted`) VALUES
(1, 'bedrijf_email', 'info@wijdthemuwkunst.nl', 0),
(2, 'bedrijf_naam', 'Wijdt Hem Uw Kunst', 0),
(3, 'copyright_tekst', 'Wijdt Hem Uw Kunst', 0),
(4, 'website_naam', 'Wijdt Hem Uw Kunst', 0),
(5, 'contactformulier_onderwerp', 'Contact aanvraag', 0),
(6, 'dit_is_een_test_sleutel', 'dit is een test waarde', 0),
(7, 'test', 'Wijdt Hem Uw Kunst', 1),
(8, 'test', 'test', 1);

INSERT INTO `slug` (`slug_ID`, `slug_name`, `slug_is_deleted`) VALUES
(1, 'home', 0),
(2, 'pagina-niet-gevonden', 0),
(3, 'concerten', 0),
(4, 'statisch', 0),
(5, 'kceditor', 0),
(6, 'tinymce', 0),
(7, 'test', 0),
(8, 'test-url', 0),
(9, 'test-url-fkkfak   kkfak', 0),
(10, 'test-url-fkkfak+++kkfak', 0),
(11, 'mess39d-up-text-just-to-stress-test-our-little-clean-url-function-gt', 0),
(12, 'mess-d-up-text-just-to-stress-test-our-little-clean-url-function-gt', 0),
(13, 'contact-verzonden', 0),
(14, 'kerstuitvoering', 0),
(15, 'paasuitvoering', 0),
(16, 'concert-3', 0),
(17, 'concert-4', 0),
(18, 'kerstuitvoeringen', 0),
(19, 'concert-', 0),
(20, 'concert-is-leuk', 0),
(21, 'concert-drie', 0),
(22, 'concert-vier', 0),
(23, 'kerstuitvoeringen-die-dit-jaar-zijn', 0),
(24, 'test-twee', 0),
(25, 'test-drie', 0),
(26, 'test-vier', 0),
(27, 'concerten-historie', 0),
(28, 'test-vijf', 0),
(29, 'test-zes', 0),
(30, 'contact-aanvraag-verzonden', 0),
(31, '', 0),
(32, '-', 0),
(33, 'home-test', 0),
(34, 'index', 0),
(35, 'harderwijk-concert', 0),
(36, 'pagina-niet-gevondens', 0),
(37, 'tweede-paasdag', 0);

INSERT INTO `translation` (`translation_ID`, `translation_key`, `translation_value`, `translation_language`, `translation_is_deleted`) VALUES
(1, 'Please contact us', 'Neem contact op', 'nl', 0),
(2, 'Send message', 'Bericht verzenden', 'nl', 0),
(3, 'Name', 'Naam', 'nl', 0),
(4, 'Email', 'Email', 'nl', 0),
(5, 'Message', 'Bericht', 'nl', 0),
(6, 'No events were found.', 'Er zijn geen concerten gevonden.', 'nl', 0),
(7, 'View more', 'Bekijk meer', 'nl', 0);



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;