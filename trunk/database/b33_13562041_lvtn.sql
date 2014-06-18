-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: sql310.byethost33.com
-- Generation Time: Jun 16, 2014 at 11:09 PM
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
  `trieu_chung` text COLLATE utf8_unicode_ci NOT NULL,
  `nhiet_do` int(11) NOT NULL,
  `huyet_ap` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `mach` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `chuan_doan` text COLLATE utf8_unicode_ci NOT NULL,
  `loi_khuyen` text COLLATE utf8_unicode_ci NOT NULL,
  `chi_phi` int(11) NOT NULL,
  PRIMARY KEY (`id_chitiet`),
  UNIQUE KEY `email` (`email`,`id_lichkham`,`id_phongkham`),
  KEY `id_phongkham` (`id_phongkham`),
  KEY `id_lichkham` (`id_lichkham`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `chi_tiet_kham`
--

INSERT INTO `chi_tiet_kham` (`id_chitiet`, `email`, `id_lichkham`, `id_phongkham`, `trieu_chung`, `nhiet_do`, `huyet_ap`, `mach`, `chuan_doan`, `loi_khuyen`, `chi_phi`) VALUES
(11, 'bvthinh@gmail.com', 17, 1, 'đau tùm lum', 37, '120/70', '80', 'không biết nữa:(', 'ăn uống đủ chát, đúng bữa,không thức khuya', 200000),
(3, 'bvthinh@gmail.com', 1, 1, 'Rat hong, ho co dom ', 38, '120/90', '90', 'Viem amidal nang', 'Uong thuoc deu dan hang ngay', 130000);

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `id_faq` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_phongkham` int(11) DEFAULT NULL,
  `question` text COLLATE utf8_unicode_ci NOT NULL,
  `answer` text COLLATE utf8_unicode_ci,
  `tieu_de` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_faq`),
  KEY `email` (`email`,`id_phongkham`),
  KEY `id_phongkham` (`id_phongkham`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id_faq`, `email`, `id_phongkham`, `question`, `answer`, `tieu_de`) VALUES
(1, 'hello city', NULL, 'tại sao tôi luôn mất ngủ dù đã ún nhiều thuốc rồi?', 'bạn cần uống thuốc theo liều lượng chỉ định, không nên lạm dụng thuốc ngủ', 'mất ngủ'),
(24, 'thinh@gmail.com', 1, 'xin thuoc uong bot lien i', NULL, 'anh bi dau bung nang'),
(25, 'bvthinh@gmail.com', 1, 'siêu đau bụng', NULL, 'siêu đau bụng'),
(26, 'bvthinh@gmail.com', 1, 'đau bụng, mêt mỏi', NULL, 'đi ngoài liên tục'),
(23, 'thinh@gmail.com', 1, 'siÃªu Ä‘au bá»¥ng siÃªu Ä‘au bá»¥ng siÃªu Ä‘au bá»¥ng', NULL, 'siÃªu Ä‘au bá»¥ng'),
(22, 'bvthinh91@gmail.com', 1, 'siÃƒÂªu Ã„Â‘au bÃ¡Â»Â¥ng siÃƒÂªu Ã„Â‘au bÃ¡Â»Â¥ng', NULL, 'siÃƒÂªu Ã„Â‘au bÃ¡Â»Â¥ng');

-- --------------------------------------------------------

--
-- Table structure for table `lich_kham`
--

CREATE TABLE IF NOT EXISTS `lich_kham` (
  `id_lichkham` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `li_do_kham` text COLLATE utf8_unicode_ci NOT NULL,
  `id_phongkham` int(11) NOT NULL,
  `ngay_kham` date NOT NULL,
  `thoigian_batdau` time NOT NULL,
  `thoigian_ketthuc` time NOT NULL,
  `tai_kham` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'True: accpet, false: waiting',
  `li_do_huy` text COLLATE utf8_unicode_ci COMMENT 'Ghi li do huy cua phong kham',
  PRIMARY KEY (`id_lichkham`),
  KEY `id_phongkham` (`id_phongkham`),
  KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=41 ;

--
-- Dumping data for table `lich_kham`
--

INSERT INTO `lich_kham` (`id_lichkham`, `email`, `li_do_kham`, `id_phongkham`, `ngay_kham`, `thoigian_batdau`, `thoigian_ketthuc`, `tai_kham`, `status`, `li_do_huy`) VALUES
(1, 'bvthinh@gmail.com', 'Kham hong', 1, '2014-05-13', '08:00:00', '09:00:00', 0, 1, ''),
(21, 'zing@gmail.com', 'dau khop, sung khop ngon chan', 1, '2014-06-27', '08:00:00', '09:00:00', 0, 1, NULL),
(20, 'bvthinh@gmail.com', 'em dau bung lem', 1, '2014-06-27', '08:00:00', '09:00:00', 0, 1, 'bận công tác'),
(14, 'bvthinh@gmail.com', 'kham kham sieu sieu tong tong quat quat', 1, '2014-05-30', '08:00:00', '09:00:00', 0, 1, 'bac si bị ốm nặng'),
(17, 'bvthinh@gmail.com', 'kham bung, da day, bong dai, than', 1, '2014-05-31', '12:00:00', '13:00:00', 0, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lich_phongkham`
--

CREATE TABLE IF NOT EXISTS `lich_phongkham` (
  `id_phongkham` int(11) NOT NULL,
  `ngay_kham` date NOT NULL,
  `thoigian_batdau` time NOT NULL,
  `thoigian_ketthuc` time NOT NULL,
  `so_luong_kham` int(11) NOT NULL,
  `current_register` int(11) NOT NULL DEFAULT '0' COMMENT 'So luong nguoi da dang ki',
  PRIMARY KEY (`id_phongkham`,`ngay_kham`,`thoigian_batdau`,`thoigian_ketthuc`),
  KEY `id_phongkham` (`id_phongkham`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lich_phongkham`
--

INSERT INTO `lich_phongkham` (`id_phongkham`, `ngay_kham`, `thoigian_batdau`, `thoigian_ketthuc`, `so_luong_kham`, `current_register`) VALUES
(1, '2014-06-28', '10:00:00', '11:00:00', 5, 5),
(1, '2014-06-28', '12:00:00', '13:00:00', 5, 2),
(1, '2014-06-27', '08:00:00', '09:00:00', 5, 2),
(1, '2014-05-13', '08:00:00', '09:00:00', 5, 0),
(1, '2014-05-31', '12:00:00', '13:00:00', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `phongkham`
--

CREATE TABLE IF NOT EXISTS `phongkham` (
  `id_phongkham` int(11) NOT NULL AUTO_INCREMENT,
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `phongkham`
--

INSERT INTO `phongkham` (`id_phongkham`, `name`, `phone`, `address`, `district`, `provice`, `feature`, `website`, `register_day`, `expire_day`, `toadoX`, `toadoY`) VALUES
(1, 'PK Tan Binh', 976135377, '127/10 Hoang Hoa Tham', 'Tan Binh', 'Ho Chi Minh', 'Tai Mui Hong', 'www.localhost.com', '2014-04-30', '2014-06-30', 10.7971, 106.647),
(2, 'PK Phu nhuan', 996926726, '181/30 phan dang luu', 'phu nhuan', 'Ho Chi Minh', 'Rang Ham Mat', 'www.localhost.com', '2014-04-30', '2014-06-30', 10.8005, 106.681),
(3, 'PK Thu Duc', 932662675, '18 Le Van Chi', 'Thu Duc', 'Ho Chi Minh', 'Rang Ham Mat', 'www.localhost.com', '2014-04-30', '2014-06-30', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `thong_bao`
--

CREATE TABLE IF NOT EXISTS `thong_bao` (
  `id_thongbao` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `noi_dung` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT 'true:da doc roi, false: chua doc',
  PRIMARY KEY (`id_thongbao`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `thong_bao`
--

INSERT INTO `thong_bao` (`id_thongbao`, `email`, `noi_dung`, `status`) VALUES
(1, 'bvthinh@gmail.com', 'hủy lịch khám', 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `toa_thuoc`
--

INSERT INTO `toa_thuoc` (`id_toathuoc`, `id_chitiet`, `ten_thuoc`, `sang`, `trua`, `toi`, `loi_dan`, `don_vi_dung`) VALUES
(1, 3, 'calogen', 3, 1, 1, 'uống đúng liều lượng', 'viên');

-- --------------------------------------------------------

--
-- Table structure for table `user_customer`
--

CREATE TABLE IF NOT EXISTS `user_customer` (
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `mid_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `sex` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `provice` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `district` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `register_day` date NOT NULL,
  `height` float NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_customer`
--

INSERT INTO `user_customer` (`email`, `name`, `mid_name`, `phone`, `sex`, `password`, `birthday`, `address`, `provice`, `district`, `register_day`, `height`, `weight`) VALUES
('zing@gmail.com', 'zin', 'baly', 134343434, 'Nam', '+??????', '1989-10-12', '84 thanh  thai-q.10-tp.ho chi minh', '', '', '0000-00-00', 1.68, 0),
('thinh@gmail.com', '', '', 0, '', '+??????', '0000-00-00', '', '', '', '0000-00-00', 0, 0),
('bvthinh@gmail.com', 'thinh', 'bui van', 1234343, 'Nam', '+??????', '1991-09-12', '84 thanh thai', '', '', '0000-00-00', 30, 30);

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
(1, 'admin@email.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(1, 'phongkham1@email.com', 'phongkham1', '62cc2d8b4bf2d8728120d052163a77df', 0),
(2, 'phongkham2@email.com', 'phongkham2', '62cc2d8b4bf2d8728120d052163a77df', 0),
(3, 'phongkham3@email.com', 'phongkham3', '62cc2d8b4bf2d8728120d052163a77df', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
