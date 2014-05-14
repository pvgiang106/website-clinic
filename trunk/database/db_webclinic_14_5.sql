-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 14, 2014 at 10:29 AM
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
  `loi_khuyen` text COLLATE utf8_unicode_ci NOT NULL,
  `chuan_doan` text COLLATE utf8_unicode_ci NOT NULL,
  `nhiet_do` int(11) NOT NULL,
  `trieu_chung` text COLLATE utf8_unicode_ci NOT NULL,
  `huyet_ap` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `mach` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `chi_phi` int(11) NOT NULL,
  PRIMARY KEY (`id_chitiet`),
  UNIQUE KEY `email` (`email`,`id_lichkham`,`id_phongkham`),
  KEY `id_phongkham` (`id_phongkham`),
  KEY `id_lichkham` (`id_lichkham`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `chi_tiet_kham`
--

INSERT INTO `chi_tiet_kham` (`id_chitiet`, `email`, `id_lichkham`, `id_phongkham`, `loi_khuyen`, `chuan_doan`, `nhiet_do`, `trieu_chung`, `huyet_ap`, `mach`, `chi_phi`) VALUES
(1, 'demo1@email.com', 1, 1, 'Uong thuoc deu dan', 'Viem amidal', 37, 'Rat hong, ho co dom', '120/80', '90', 120000);

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
  `li_do_kham` text COLLATE utf8_unicode_ci NOT NULL,
  `id_phongkham` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `thoigian_batdau` datetime NOT NULL,
  `thoigian_ketthuc` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'True: accpet, false: waiting',
  PRIMARY KEY (`id_lichkham`),
  KEY `id_phongkham` (`id_phongkham`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `lich_kham`
--

INSERT INTO `lich_kham` (`id_lichkham`, `li_do_kham`, `id_phongkham`, `email`, `thoigian_batdau`, `thoigian_ketthuc`, `status`) VALUES
(1, 'Kham hong', 1, 'demo1@email.com', '2014-05-13 08:00:00', '2014-05-13 09:00:00', 1),
(2, 'Kham tai', 1, 'demo2@email.com', '2014-05-17 09:00:00', '2014-05-17 10:00:00', 1),
(4, 'Khong tong quat', 2, 'demo1@email.com', '2014-05-18 10:00:00', '2014-05-18 11:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lich_phongkham`
--

CREATE TABLE IF NOT EXISTS `lich_phongkham` (
  `id_phongkham` int(11) NOT NULL,
  `thoigian_batdau` datetime NOT NULL,
  `thoigian_ketthuc` datetime NOT NULL,
  `so_luong_kham` int(11) NOT NULL,
  `current_register` int(11) NOT NULL COMMENT 'So luong nguoi da dang ki',
  PRIMARY KEY (`id_phongkham`,`thoigian_batdau`,`thoigian_ketthuc`),
  KEY `id_phongkham` (`id_phongkham`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lich_phongkham`
--

INSERT INTO `lich_phongkham` (`id_phongkham`, `thoigian_batdau`, `thoigian_ketthuc`, `so_luong_kham`, `current_register`) VALUES
(1, '2014-05-30 08:00:00', '2014-05-30 09:00:00', 5, 0),
(1, '2014-05-30 09:00:00', '2014-05-30 10:00:00', 5, 0),
(2, '2014-05-30 08:00:00', '2014-05-30 09:00:00', 5, 0),
(2, '2014-05-30 09:00:00', '2014-05-30 10:00:00', 5, 0),
(3, '2014-05-30 08:00:00', '2014-05-30 09:00:00', 5, 0),
(3, '2014-05-30 09:00:00', '2014-05-30 10:00:00', 5, 0);

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
  PRIMARY KEY (`id_phongkham`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `phongkham`
--

INSERT INTO `phongkham` (`id_phongkham`, `name`, `phone`, `address`, `district`, `provice`, `feature`, `website`, `register_day`, `expire_day`) VALUES
(1, 'Tan Binh', 976135377, '127/10 Hoang Hoa Tham', 'Tan Binh', 'Ho Chi Minh', 'Tai Mui Hong', 'www.localhost.com', '2014-04-30', '2014-06-30'),
(2, 'Phu nhuan', 996926726, '181/30 phan dang luu', 'phu nhuan', 'Ho Chi Minh', 'Rang Ham Mat', 'www.localhost.com', '2014-04-30', '2014-06-30'),
(3, 'Thu Duc', 932662675, '18 Le Van Chi', 'Thu Duc', 'Ho Chi Minh', 'Rang Ham Mat', 'www.localhost.com', '2014-04-30', '2014-06-30');

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
('demo1@email.com', 'demo1', 'demo1', 976135377, 'male', '62cc2d8b4bf2d8728120d052163a77df', '1991-06-10', '127/10 Hoang Hoa Tham', 'Ho Chi Minh', 'Tan Binh', '2014-04-30', 1.6, 60),
('demo2@email.com', 'demo2', 'demo2', 976135377, 'female', '62cc2d8b4bf2d8728120d052163a77df', '1991-06-10', '181/30 Phan Dang Luu', 'Ho Chi Minh', 'Phu Nhuan', '2014-04-30', 1.6, 50),
('demo3@email.com', 'demo3', 'demo3', 976135377, 'male', '62cc2d8b4bf2d8728120d052163a77df', '1991-06-10', '127/10 Hoang Hoa Tham', 'Ho Chi Minh', 'Tan Binh', '2014-04-30', 1.6, 60);

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
(2, 'phongkham2@email.com', 'phongkham2', '62cc2d8b4bf2d8728120d052163a77df', 0),
(3, 'phongkham3@email.com', 'phongkham3', '62cc2d8b4bf2d8728120d052163a77df', 0);

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
