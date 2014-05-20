-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: sql310.byethost33.com
-- Generation Time: May 19, 2014 at 02:09 AM
-- Server version: 5.6.16-64.2-56
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `b33_13562041_lvtn`
--

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_kham`
--

CREATE TABLE IF NOT EXISTS `chi_tiet_kham` (
  `id_chitiet` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_lichkham` int(11) NOT NULL,
  `id_phongkham` int(11) NOT NULL,
  `loi_khuyen` text COLLATE utf8_unicode_ci NOT NULL,
  `chuan_doan` text COLLATE utf8_unicode_ci NOT NULL,
  `nhiet_do` int(11) NOT NULL,
  `trieu_chung` text COLLATE utf8_unicode_ci NOT NULL,
  `huyet_ap` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `mach` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `chi_phi` int(11) NOT NULL,
  PRIMARY KEY (`id_chitiet`),
  UNIQUE KEY `email` (`email`,`id_lichkham`,`id_phongkham`),
  UNIQUE KEY `id_lichkham` (`id_lichkham`),
  KEY `id_phongkham` (`id_phongkham`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `chi_tiet_kham`
--

INSERT INTO `chi_tiet_kham` (`id_chitiet`, `email`, `id_lichkham`, `id_phongkham`, `loi_khuyen`, `chuan_doan`, `nhiet_do`, `trieu_chung`, `huyet_ap`, `mach`, `chi_phi`) VALUES
(1, 'bvthinh@gmail.com', 4, 1, 'không nên ăn rau sống, thường xuyên rửa tay', 'đau bụng do vi khuẩn ecoly', 37, 'đau bụng, đi ngoài như điên', '80', '80', 500),
(2, 'bvthinh@gmail.com', 5, 1, 'khong nen an bay', 'bi loet da day', 37, 'dau bung du doi', '80', '70', 300);

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `id_faq` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_phongkham` int(11) NOT NULL,
  `question` text COLLATE utf8_unicode_ci NOT NULL,
  `answer` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_faq`),
  KEY `email` (`email`,`id_phongkham`),
  KEY `id_phongkham` (`id_phongkham`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lich_kham`
--

CREATE TABLE IF NOT EXISTS `lich_kham` (
  `id_lichkham` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL COMMENT 'True: accept, false: waiting',
  `li_do_kham` text COLLATE utf8_unicode_ci NOT NULL,
  `id_phongkham` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_kham` date NOT NULL,
  `thoigian_batdau` time NOT NULL,
  `thoigian_ketthuc` time NOT NULL,
  PRIMARY KEY (`id_lichkham`),
  KEY `id_phongkham` (`id_phongkham`),
  KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

--
-- Dumping data for table `lich_kham`
--

INSERT INTO `lich_kham` (`id_lichkham`, `status`, `li_do_kham`, `id_phongkham`, `email`, `ngay_kham`, `thoigian_batdau`, `thoigian_ketthuc`) VALUES
(7, 0, 'dau bung', 1, 'bvthinh@gmail.com', '2014-05-08', '08:30:00', '09:30:00'),
(6, 0, 'dau dau', 1, 'bvthinh@gmail.com', '2014-05-08', '08:30:00', '09:30:00'),
(4, 0, 'dau dau', 1, 'le@gmail.com', '2014-04-16', '08:30:00', '09:30:00'),
(5, 0, 'dau bung', 1, 'le@gmail.com', '2014-05-07', '08:30:00', '09:30:00'),
(8, 0, 'dau bung', 1, 'bvthinh@gmail.com', '2014-05-11', '08:00:00', '09:00:00'),
(9, 0, 'fshfgdshfsd', 2, 'bvthinh@gmail.com', '2014-05-11', '08:00:00', '09:00:00'),
(10, 0, 'chong mat, dau dau', 1, 'bvthinh@gmail.com', '2014-05-28', '08:00:00', '09:00:00'),
(11, 0, 'dau tim du doi', 1, 'bvthinh@gmail.com', '2014-05-28', '08:00:00', '09:00:00'),
(19, 0, '', 0, 'bvthinh@gmail.com', '2014-05-28', '08:00:00', '09:00:00'),
(20, 0, 'kham tong the', 1, 'bvthinh@gmail.com', '0000-00-00', '08:00:00', '09:00:00'),
(15, 0, 'dau tim zu doi', 0, 'bvthinh@gmail.com', '2014-05-28', '08:00:00', '09:00:00'),
(21, 0, 'kham da tong the', 1, 'bvthinh@gmail.com', '0000-00-00', '08:00:00', '09:00:00'),
(17, 0, 'dau dau du doi', 0, 'bvthinh@gmail.com', '2014-05-28', '09:00:00', '10:00:00'),
(18, 0, 'rat la dau dau dau', 0, 'bvthinh@gmail.com', '2014-05-28', '08:00:00', '09:00:00'),
(22, 0, 'kham kham', 1, 'bvthinh@gmail.com', '0000-00-00', '08:00:00', '09:00:00'),
(23, 0, 'kham tum lum', 1, 'bvthinh@gmail.com', '2014-05-28', '09:00:00', '10:00:00'),
(24, 0, 'di kham choi', 1, 'bvthinh@gmail.com', '2014-05-28', '08:00:00', '09:00:00'),
(25, 0, 'kham tri', 1, 'bvthinh@gmail.com', '2014-05-28', '08:00:00', '09:00:00'),
(26, 0, 'adsadadasd', 1, 'bvthinh@gmail.com', '2014-05-28', '08:00:00', '09:00:00'),
(27, 0, 'asdaddadasddas', 1, 'bvthinh@gmail.com', '2014-05-28', '08:00:00', '09:00:00'),
(28, 0, 'dk choi', 1, 'bvthinh@gmail.com', '2014-05-28', '08:00:00', '09:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `lich_phongkham`
--

CREATE TABLE IF NOT EXISTS `lich_phongkham` (
  `id_lichphongkham` int(11) NOT NULL AUTO_INCREMENT,
  `id_phongkham` int(11) NOT NULL,
  `thoigian_batdau` time NOT NULL,
  `thoigian_ketthuc` time NOT NULL,
  `ngay_kham` date NOT NULL,
  `so_luong_kham` int(11) NOT NULL,
  PRIMARY KEY (`id_lichphongkham`),
  UNIQUE KEY `id_lichphongkham_2` (`id_lichphongkham`),
  KEY `id_lichphongkham` (`id_lichphongkham`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `lich_phongkham`
--

INSERT INTO `lich_phongkham` (`id_lichphongkham`, `id_phongkham`, `thoigian_batdau`, `thoigian_ketthuc`, `ngay_kham`, `so_luong_kham`) VALUES
(1, 1, '08:00:00', '09:00:00', '2014-05-28', 5),
(2, 1, '09:00:00', '10:00:00', '2014-05-28', 4),
(3, 1, '13:00:00', '14:00:00', '2014-05-11', 5),
(4, 2, '08:00:00', '09:00:00', '2014-05-11', 5),
(5, 2, '09:00:00', '10:00:00', '2014-05-11', 5);

-- --------------------------------------------------------

--
-- Table structure for table `phongkham`
--

CREATE TABLE IF NOT EXISTS `phongkham` (
  `id_phongkham` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `district` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `provice` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `feature` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `register_day` date NOT NULL,
  `expire_day` date NOT NULL,
  `toadoX` float NOT NULL,
  `toadoY` float NOT NULL,
  PRIMARY KEY (`id_phongkham`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `phongkham`
--

INSERT INTO `phongkham` (`id_phongkham`, `name`, `phone`, `address`, `district`, `provice`, `feature`, `website`, `register_day`, `expire_day`, `toadoX`, `toadoY`) VALUES
(1, 'Tan Binh', 976135377, '127/10 hoang hoa tham', 'Tan Binh', 'Ho Chi Minh', 'Tai, mui, hong', 'http://www.localhost.com', '2014-04-15', '2014-06-30', 10.7971, 106.647),
(2, 'Phu nhuan', 996926726, '181/30 phan dang luu', 'phu nhuan', 'Ho chi minh', 'rang,ham,mat', 'http://www.localhost.com', '2014-04-15', '2014-06-30', 10.8005, 106.681);

-- --------------------------------------------------------

--
-- Table structure for table `toa_thuoc`
--

CREATE TABLE IF NOT EXISTS `toa_thuoc` (
  `id_toathuoc` int(11) NOT NULL AUTO_INCREMENT,
  `id_chitiet` int(11) NOT NULL,
  `ten_thuoc` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sang` tinyint(1) NOT NULL,
  `trua` tinyint(1) NOT NULL,
  `toi` tinyint(1) NOT NULL,
  `loi_dan` text COLLATE utf8_unicode_ci NOT NULL,
  `don_vi_dung` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_toathuoc`),
  KEY `id_chitiet` (`id_chitiet`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `toa_thuoc`
--

INSERT INTO `toa_thuoc` (`id_toathuoc`, `id_chitiet`, `ten_thuoc`, `sang`, `trua`, `toi`, `loi_dan`, `don_vi_dung`) VALUES
(4, 1, 'calogen', 3, 1, 1, 'cẩn thận, theo hướng dẫn', 'gói'),
(2, 1, 'nito', 2, 2, 2, 'uống đúng liều lượng', 'viên'),
(3, 1, 'sec', 1, 1, 1, 'uống đúng liều lượng', 'túp');

-- --------------------------------------------------------

--
-- Table structure for table `user_customer`
--

CREATE TABLE IF NOT EXISTS `user_customer` (
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mid_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `sex` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `province` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `district` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `register_day` date DEFAULT NULL,
  `height` float DEFAULT NULL,
  `weight` float DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_customer`
--

INSERT INTO `user_customer` (`email`, `name`, `mid_name`, `phone`, `sex`, `password`, `birthday`, `address`, `province`, `district`, `register_day`, `height`, `weight`) VALUES
('bvthinh@gmail.com', '', '', 0, '', '+??????', '0000-00-00', '', NULL, NULL, NULL, 45656, NULL),
('thinh@gmail.com', NULL, NULL, NULL, NULL, '+??????', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('a@gmail.com', NULL, NULL, NULL, NULL, '+??????', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('x-fact@gmail.com', NULL, NULL, NULL, NULL, 'h?`?xy"t', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('le@gmail.com', NULL, NULL, NULL, NULL, '+??????', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('thinhprok@gmail.com', NULL, NULL, NULL, NULL, '+??????', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_phongkham`
--

CREATE TABLE IF NOT EXISTS `user_phongkham` (
  `id_phongkham` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0' COMMENT 'Admintor: 1User default: 0',
  PRIMARY KEY (`email`),
  KEY `id_phongkham` (`id_phongkham`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_phongkham`
--

INSERT INTO `user_phongkham` (`id_phongkham`, `email`, `name`, `password`, `role`) VALUES
(1, 'pvgiang106@gmail.com', 'Pham Van Giang', '21232f297a57a5a743894a0e4a801fc3', 1),
(1, 'shinichi1691@gmail.com', 'Pham Van Giang', 'e10adc3949ba59abbe56e057f20f883e', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
