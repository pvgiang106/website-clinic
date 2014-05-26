-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 26, 2014 at 10:21 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_webclinic`
--
CREATE DATABASE IF NOT EXISTS `db_webclinic` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `db_webclinic`;

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
  `nhiet_do` float NOT NULL,
  `huyet_ap` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `mach` int(20) NOT NULL,
  `chuan_doan` text COLLATE utf8_unicode_ci NOT NULL,
  `loi_khuyen` text COLLATE utf8_unicode_ci NOT NULL,
  `chi_phi` int(11) NOT NULL,
  PRIMARY KEY (`id_chitiet`),
  UNIQUE KEY `email` (`email`,`id_lichkham`,`id_phongkham`),
  KEY `id_phongkham` (`id_phongkham`),
  KEY `id_lichkham` (`id_lichkham`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `id_faq` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_phongkham` int(11) NOT NULL,
  `question` text COLLATE utf8_unicode_ci NOT NULL,
  `answer` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_faq`),
  KEY `email` (`email`,`id_phongkham`),
  KEY `id_phongkham` (`id_phongkham`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
  `li_do_huy` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Ghi li do huy cua phong kham',
  PRIMARY KEY (`id_lichkham`),
  KEY `id_phongkham` (`id_phongkham`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `lich_kham`
--

INSERT INTO `lich_kham` (`id_lichkham`, `email`, `li_do_kham`, `id_phongkham`, `ngay_kham`, `thoigian_batdau`, `thoigian_ketthuc`, `tai_kham`, `status`, `li_do_huy`) VALUES
(16, 'demo1@email.com', 'Dau bung', 1, '2014-05-26', '15:00:00', '15:15:00', 0, 1, ''),
(17, 'demo2@email.com', 'Dau dau', 1, '2014-05-26', '15:30:00', '15:45:00', 0, 1, '');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lich_phongkham`
--

INSERT INTO `lich_phongkham` (`id_phongkham`, `ngay_kham`, `thoigian_batdau`, `thoigian_ketthuc`, `so_luong_kham`, `current_register`) VALUES
(1, '2014-05-26', '07:00:00', '08:00:00', 4, 0),
(1, '2014-05-26', '08:00:00', '09:00:00', 4, 0),
(1, '2014-05-26', '09:00:00', '10:00:00', 4, 0),
(1, '2014-05-26', '10:00:00', '11:00:00', 4, 0),
(1, '2014-05-26', '11:00:00', '12:00:00', 4, 0),
(1, '2014-05-26', '12:00:00', '13:00:00', 4, 0),
(1, '2014-05-26', '13:00:00', '14:00:00', 4, 0),
(1, '2014-05-26', '14:00:00', '15:00:00', 4, 0),
(1, '2014-05-26', '15:00:00', '16:00:00', 4, 0),
(1, '2014-05-26', '16:00:00', '17:00:00', 4, 0),
(1, '2014-05-27', '07:00:00', '08:00:00', 4, 0),
(1, '2014-05-27', '08:00:00', '09:00:00', 4, 0),
(1, '2014-05-27', '09:00:00', '10:00:00', 4, 0),
(1, '2014-05-27', '10:00:00', '11:00:00', 4, 0),
(1, '2014-05-27', '11:00:00', '12:00:00', 4, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `phongkham`
--

INSERT INTO `phongkham` (`id_phongkham`, `name`, `phone`, `address`, `district`, `provice`, `feature`, `website`, `register_day`, `expire_day`, `toadoX`, `toadoY`) VALUES
(1, 'Phòng khám 1', 976135377, '127/10 Hoang Hoa Tham', 'Tan Binh', 'Ho Chi Minh', 'Tai Mui Hong', 'www.localhost.com', '2014-04-30', '2014-06-30', 10.7971, 106.647),
(2, 'Phòng khám 2', 996926726, '181/30 phan dang luu', 'phu nhuan', 'Ho Chi Minh', 'Rang Ham Mat', 'www.localhost.com', '2014-04-30', '2014-06-30', 10.8005, 106.681);

-- --------------------------------------------------------

--
-- Table structure for table `thong_bao`
--

CREATE TABLE IF NOT EXISTS `thong_bao` (
  `id_thongbao` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT 'true: da doc roi, false: chua doc',
  PRIMARY KEY (`id_thongbao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `toa_thuoc`
--

CREATE TABLE IF NOT EXISTS `toa_thuoc` (
  `id_toathuoc` int(11) NOT NULL,
  `id_chitiet` int(11) NOT NULL,
  `ten_thuoc` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sang` tinyint(1) NOT NULL,
  `trua` tinyint(1) NOT NULL,
  `toi` tinyint(1) NOT NULL,
  `loi_dan` text COLLATE utf8_unicode_ci NOT NULL,
  `don_vi_dung` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_toathuoc`),
  KEY `id_chitiet` (`id_chitiet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_customer`
--

INSERT INTO `user_customer` (`email`, `name`, `mid_name`, `phone`, `sex`, `password`, `birthday`, `address`, `provice`, `district`, `register_day`, `height`, `weight`) VALUES
('demo1@email.com', 'demo1', 'demo', 976135377, 'Nam', '62cc2d8b4bf2d8728120d052163a77df', '1991-06-10', '127/10 Hoang Hoa Tham', 'Ho Chi Minh', 'Tan Binh', '2014-04-30', 1.6, 60),
('demo2@email.com', 'demo2', 'demo', 976135377, 'Nữ', '62cc2d8b4bf2d8728120d052163a77df', '1991-06-10', '181/30 Phan Dang Luu', 'Ho Chi Minh', 'Phu Nhuan', '2014-04-30', 1.6, 50);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_phongkham`
--

INSERT INTO `user_phongkham` (`id_phongkham`, `email`, `name`, `password`, `role`) VALUES
(1, 'admin@email.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(1, 'phongkham1@email.com', 'phongkham1', '62cc2d8b4bf2d8728120d052163a77df', 0),
(2, 'phongkham2@email.com', 'phongkham2', '62cc2d8b4bf2d8728120d052163a77df', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chi_tiet_kham`
--
ALTER TABLE `chi_tiet_kham`
  ADD CONSTRAINT `chi_tiet_kham_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user_customer` (`email`),
  ADD CONSTRAINT `chi_tiet_kham_ibfk_2` FOREIGN KEY (`id_phongkham`) REFERENCES `phongkham` (`id_phongkham`),
  ADD CONSTRAINT `chi_tiet_kham_ibfk_3` FOREIGN KEY (`id_lichkham`) REFERENCES `lich_kham` (`id_lichkham`);

--
-- Constraints for table `faq`
--
ALTER TABLE `faq`
  ADD CONSTRAINT `faq_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user_customer` (`email`),
  ADD CONSTRAINT `faq_ibfk_2` FOREIGN KEY (`id_phongkham`) REFERENCES `phongkham` (`id_phongkham`);

--
-- Constraints for table `lich_kham`
--
ALTER TABLE `lich_kham`
  ADD CONSTRAINT `lich_kham_ibfk_1` FOREIGN KEY (`id_phongkham`) REFERENCES `phongkham` (`id_phongkham`),
  ADD CONSTRAINT `lich_kham_ibfk_2` FOREIGN KEY (`email`) REFERENCES `user_customer` (`email`);

--
-- Constraints for table `lich_phongkham`
--
ALTER TABLE `lich_phongkham`
  ADD CONSTRAINT `lich_phongkham_ibfk_1` FOREIGN KEY (`id_phongkham`) REFERENCES `phongkham` (`id_phongkham`);

--
-- Constraints for table `toa_thuoc`
--
ALTER TABLE `toa_thuoc`
  ADD CONSTRAINT `toa_thuoc_ibfk_1` FOREIGN KEY (`id_chitiet`) REFERENCES `chi_tiet_kham` (`id_chitiet`);

--
-- Constraints for table `user_phongkham`
--
ALTER TABLE `user_phongkham`
  ADD CONSTRAINT `user_phongkham_ibfk_1` FOREIGN KEY (`id_phongkham`) REFERENCES `phongkham` (`id_phongkham`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
