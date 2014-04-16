-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 16, 2014 at 10:18 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

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
  `id_chitiet` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `id_faq` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_phongkham` int(11) NOT NULL,
  `question` text COLLATE utf8_unicode_ci NOT NULL,
  `answer` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_faq`),
  KEY `email` (`email`,`id_phongkham`),
  KEY `id_phongkham` (`id_phongkham`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lich_kham`
--

CREATE TABLE IF NOT EXISTS `lich_kham` (
  `id_lichkham` int(11) NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `li_do_kham` text COLLATE utf8_unicode_ci NOT NULL,
  `id_phongkham` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_kham` date NOT NULL,
  `thoigian_batdau` time NOT NULL,
  `thoigian_kethuc` time NOT NULL,
  PRIMARY KEY (`id_lichkham`),
  KEY `id_phongkham` (`id_phongkham`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lich_phongkham`
--

CREATE TABLE IF NOT EXISTS `lich_phongkham` (
  `id_phongkham` int(11) NOT NULL,
  `thoigian_batdau` time NOT NULL,
  `thoigian_ketthuc` time NOT NULL,
  `ngay_kham` date NOT NULL,
  `so_luong_kham` int(11) NOT NULL,
  PRIMARY KEY (`id_phongkham`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  PRIMARY KEY (`id_phongkham`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `phongkham`
--

INSERT INTO `phongkham` (`id_phongkham`, `name`, `phone`, `address`, `district`, `provice`, `feature`, `website`, `register_day`, `expire_day`) VALUES
(1, 'Tan Binh', 976135377, '127/10 hoang hoa tham', 'Tan Binh', 'Ho Chi Minh', 'Tai, mui, hong', 'http://www.localhost.com', '2014-04-15', '2014-06-30'),
(2, 'Phu nhuan', 996926726, '181/30 phan dang luu', 'phu nhuan', 'Ho chi minh', 'rang,ham,mat', 'http://www.localhost.com', '2014-04-15', '2014-06-30');

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
  `height` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(1, 'pvgiang106@gmail.com', 'Pham Van Giang', '21232f297a57a5a743894a0e4a801fc3', 1),
(1, 'shinichi1691@gmail.com', 'Pham Van Giang', 'e10adc3949ba59abbe56e057f20f883e', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chi_tiet_kham`
--
ALTER TABLE `chi_tiet_kham`
  ADD CONSTRAINT `chi_tiet_kham_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user_customer` (`email`),
  ADD CONSTRAINT `chi_tiet_kham_ibfk_2` FOREIGN KEY (`id_phongkham`) REFERENCES `user_phongkham` (`id_phongkham`),
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
  ADD CONSTRAINT `lich_kham_ibfk_1` FOREIGN KEY (`id_phongkham`) REFERENCES `user_phongkham` (`id_phongkham`),
  ADD CONSTRAINT `lich_kham_ibfk_2` FOREIGN KEY (`email`) REFERENCES `user_customer` (`email`);

--
-- Constraints for table `user_phongkham`
--
ALTER TABLE `user_phongkham`
  ADD CONSTRAINT `user_phongkham_ibfk_1` FOREIGN KEY (`id_phongkham`) REFERENCES `phongkham` (`id_phongkham`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
