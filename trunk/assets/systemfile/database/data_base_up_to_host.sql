-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2013 at 07:07 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `socialnetwork`
--
-- CREATE DATABASE IF NOT EXISTS `socialnetwork` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
-- USE `socialnetwork`;

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `albumID` int(11) NOT NULL AUTO_INCREMENT,
  `albumName` varchar(250) COLLATE utf8_unicode_ci DEFAULT 'No Name',
  `image` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `planID` int(11) NOT NULL,
  PRIMARY KEY (`albumID`),
  KEY `FK_albumPlanID_planPlanID_idx` (`planID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=49 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`albumID`, `albumName`, `image`, `planID`) VALUES
(1, 'uploads/AnGiang.jpg', 'path image', 1);

-- --------------------------------------------------------

--
-- Table structure for table `attraction`
--

CREATE TABLE IF NOT EXISTS `attraction` (
  `attractionID` int(11) NOT NULL AUTO_INCREMENT,
  `cityID` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varbinary(8000) DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`attractionID`),
  KEY `cityID` (`cityID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bring`
--

CREATE TABLE IF NOT EXISTS `bring` (
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `planID` int(11) NOT NULL,
  `number` int(5) DEFAULT NULL,
  PRIMARY KEY (`name`,`planID`),
  KEY `FK_planID_bring` (`planID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE IF NOT EXISTS `car` (
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `tranportID` int(11) NOT NULL,
  PRIMARY KEY (`name`,`tranportID`),
  KEY `FK_transportID_car` (`tranportID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `to` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `sent` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recd` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `from`, `to`, `message`, `sent`, `recd`) VALUES
(15, 'newbiecse', 'NguyenVanTan', 'xrxzr', '2013-11-02 18:13:11', 0),
(16, 'newbiecse', 'NguyenVanTan', 'hvhv', '2013-11-02 18:13:13', 0),
(17, 'newbiecse', 'Tuan', 'bbbbbbbbb', '2013-11-02 21:43:46', 1),
(18, 'Tuan', 'newbiecse', 'cccc', '2013-11-05 18:33:50', 1),
(19, 'newbiecse', 'Tuan', 'a', '2013-11-07 23:17:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `cityID` int(11) NOT NULL AUTO_INCREMENT,
  `cityName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `continent` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`cityID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=64 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`cityID`, `cityName`, `continent`, `country`, `image`) VALUES
(1, 'An Giang', 'asian', 'Việt Nam', '/assets/userfile/img/city/AnGiang.jpg'),
(2, 'Bà Rịa', 'asian', 'Việt Nam', '/assets/userfile/img/city/BaRia_VungTau.jpg'),
(3, 'Bạc Liêu', 'asian', 'Việt Nam', '/assets/userfile/img/city/BacLieu.jpg'),
(4, 'Bắc Kạn', 'asian', 'Việt Nam', '/assets/userfile/img/city/BacKan.jpg'),
(5, 'Bắc Giang', 'asian', 'Việt Nam', '/assets/userfile/img/city/BacGiang.jpg'),
(6, 'Bắc Ninh', 'asian', 'Việt Nam', '/assets/userfile/img/city/BacNinh.jpg'),
(7, 'Bến Tre', 'asian', 'Việt Nam', '/assets/userfile/img/city/BenTre.jpg'),
(8, 'Bình Dương', 'asian', 'Việt Nam', '/assets/userfile/img/city/BinhDuong.jpg'),
(9, 'Bình Định', 'asian', 'Việt Nam', '/assets/userfile/img/city/BinhDinh.jpg'),
(10, 'Bình Phước', 'asian', 'Việt Nam', '/assets/userfile/img/city/BinhPhuoc.jpg'),
(11, 'Bình Thuận', 'asian', 'Việt Nam', '/assets/userfile/img/city/BinhThuan.jpg'),
(12, 'Cà Mau', 'asian', 'Việt Nam', '/assets/userfile/img/city/CaMau.jpg'),
(13, 'Cao Bằng', 'asian', 'Việt Nam', '/assets/userfile/img/city/CaoBang.jpg'),
(14, 'Cần Thơ', 'asian', 'Việt Nam', '/assets/userfile/img/city/CanTho.jpg'),
(15, 'Đà Nẵng', 'asian', 'Việt Nam', '/assets/userfile/img/city/DaNang.jpg'),
(16, 'Đăk Lăk', 'asian', 'Việt Nam', '/assets/userfile/img/city/DakLak.jpg'),
(17, 'Đăk Nông', 'asian', 'Việt Nam', '/assets/userfile/img/city/DakNong.jpg'),
(18, 'Đồng Nai', 'asian', 'Việt Nam', '/assets/userfile/img/city/DongNai.jpg'),
(19, 'Đồng Tháp', 'asian', 'Việt Nam', '/assets/userfile/img/city/DongThap.jpg'),
(20, 'Điện Biên', 'asian', 'Việt Nam', '/assets/userfile/img/city/DienBien.jpg'),
(21, 'Gia Lai', 'asian', 'Việt Nam', '/assets/userfile/img/city/GiaLai.jpg'),
(22, 'Hà Giang', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaGiang.jpg'),
(23, 'Hà Nam', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaNam.jpg'),
(24, 'Hà Nội', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaNoi.jpg'),
(25, 'Hà Tĩnh', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaTinh.jpg'),
(26, 'Hải Dương', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiDuong.jpg'),
(27, 'Hải Phòng', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiPhong.jpg'),
(28, 'Hòa Bình', 'asian', 'Việt Nam', '/assets/userfile/img/city/HoaBinh.jpg'),
(29, 'Hậu Giang', 'asian', 'Việt Nam', '/assets/userfile/img/city/HauGiang.jpg'),
(30, 'Hưng Yên', 'asian', 'Việt Nam', '/assets/userfile/img/city/HungYen.jpg'),
(31, 'Hồ Chí Minh', 'asian', 'Việt Nam', '/assets/userfile/img/city/HoChiMinh.jpg'),
(32, 'Khánh Hòa', 'asian', 'Việt Nam', '/assets/userfile/img/city/KhanhHoa.jpg'),
(33, 'Kiên Giang', 'asian', 'Việt Nam', '/assets/userfile/img/city/KienGiang.jpg'),
(34, 'Kon Tum', 'asian', 'Việt Nam', '/assets/userfile/img/city/KonTum.jpg'),
(35, 'Lai Châu', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiPhong.jpg'),
(36, 'Lào Cai', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiPhong.jpg'),
(37, 'Lạng Sơn', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiPhong.jpg'),
(38, 'Lâm Đồng', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiPhong.jpg'),
(39, 'Long An', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiPhong.jpg'),
(40, 'Nam Định', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiPhong.jpg'),
(41, 'Nghệ An', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiPhong.jpg'),
(42, 'Ninh Bình', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiPhong.jpg'),
(43, 'Ninh Thuận', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiPhong.jpg'),
(44, 'Phú Thọ', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiPhong.jpg'),
(45, 'Phú Yên', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiPhong.jpg'),
(46, 'Quảng Bình', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiPhong.jpg'),
(47, 'Quảng Nam', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiPhong.jpg'),
(48, 'Quảng Ngãi', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiPhong.jpg'),
(49, 'Quảng Ninh', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiPhong.jpg'),
(50, 'Quảng Trị', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiPhong.jpg'),
(51, 'Sóc Trăng', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiPhong.jpg'),
(52, 'Sơn La', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiPhong.jpg'),
(53, 'Tây Ninh', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiPhong.jpg'),
(54, 'Thái Bình', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiPhong.jpg'),
(55, 'Thái Nguyên', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiPhong.jpg'),
(56, 'Thanh Hóa', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiPhong.jpg'),
(57, 'Thừa Thiên - Huế', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiPhong.jpg'),
(58, 'Tiền Giang', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiPhong.jpg'),
(59, 'Trà Vinh', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiPhong.jpg'),
(60, 'Tuyên Quang', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiPhong.jpg'),
(61, 'Vĩnh Long', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiPhong.jpg'),
(62, 'Vĩnh Phúc', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiPhong.jpg'),
(63, 'Yên Bái', 'asian', 'Việt Nam', '/assets/userfile/img/city/HaiPhong.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `comment_image`
--

CREATE TABLE IF NOT EXISTS `comment_image` (
  `userID` int(11) NOT NULL,
  `imageID` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`userID`,`imageID`),
  KEY `userID` (`userID`),
  KEY `imageID` (`imageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment_status`
--

CREATE TABLE IF NOT EXISTS `comment_status` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_unicode_ci,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `statusID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `userID` (`userID`),
  KEY `statusID` (`statusID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `comment_video`
--

CREATE TABLE IF NOT EXISTS `comment_video` (
  `userID` int(11) NOT NULL,
  `videoID` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`userID`,`videoID`),
  KEY `videoID` (`videoID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eat`
--

CREATE TABLE IF NOT EXISTS `eat` (
  `planID` int(11) NOT NULL,
  `restaurantID` int(11) NOT NULL,
  `time_eat` datetime NOT NULL,
  PRIMARY KEY (`planID`,`restaurantID`,`time_eat`),
  KEY `FK_restaurantID_eat` (`restaurantID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flight`
--

CREATE TABLE IF NOT EXISTS `flight` (
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `transportID` int(11) NOT NULL,
  `bussiness` float DEFAULT NULL,
  `economy` float DEFAULT NULL,
  `departure_time` datetime NOT NULL,
  `time_leave` datetime NOT NULL,
  PRIMARY KEY (`name`,`transportID`,`departure_time`),
  KEY `transportID` (`transportID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

CREATE TABLE IF NOT EXISTS `friend` (
  `userID1` int(11) NOT NULL,
  `userID2` int(11) NOT NULL,
  `classified` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`userID1`,`userID2`),
  KEY `FK_UserID2_UserID_idx` (`userID2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `friend`
--

INSERT INTO `friend` (`userID1`, `userID2`, `classified`) VALUES
(0, 1, NULL),
(0, 2, NULL),
(0, 3, NULL),
(0, 4, NULL),
(0, 5, NULL),
(0, 6, NULL),
(1, 0, NULL),
(2, 0, NULL),
(2, 3, NULL),
(3, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gift`
--

CREATE TABLE IF NOT EXISTS `gift` (
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `num` int(5) DEFAULT NULL,
  `planID` int(11) NOT NULL,
  PRIMARY KEY (`name`,`planID`),
  KEY `FK_planID_gift` (`planID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE IF NOT EXISTS `hotel` (
  `hotelID` int(11) NOT NULL AUTO_INCREMENT,
  `hotelName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varbinary(8000) DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cityID` int(11) NOT NULL,
  PRIMARY KEY (`hotelID`),
  KEY `cityID` (`cityID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_image`
--

CREATE TABLE IF NOT EXISTS `hotel_image` (
  `hotelID` int(11) NOT NULL,
  `image` blob NOT NULL,
  `imageID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`imageID`),
  KEY `hotelID` (`hotelID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `imageID` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `caption` varchar(250) COLLATE utf8_unicode_ci DEFAULT 'Enter caption for this image now ...',
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `albumID` int(11) NOT NULL,
  PRIMARY KEY (`imageID`),
  KEY `userID` (`albumID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=55 ;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`imageID`, `path`, `caption`, `time`, `albumID`) VALUES
(44, '/uploads/BacLieu.jpg', 'Enter caption for this image now ...', '2013-11-16 16:29:54', 1),
(46, '/uploads/BinhDinh.jpg', 'Enter caption for this image now ...', '2013-11-16 16:32:12', 1),
(47, '/uploads/BinhDuong.jpg', 'Enter caption for this image now ...', '2013-11-16 16:32:12', 1),
(48, '/uploads/BinhPhuoc.jpg', 'Enter caption for this image now ...', '2013-11-16 16:32:12', 1),
(49, '/uploads/AnGiang.jpg', 'Enter caption for this image now ...', '2013-11-17 10:08:32', 1),
(50, '/uploads/BacGiang.jpg', 'Enter caption for this image now ...', '2013-11-17 10:15:33', 1),
(51, '/uploads/BacKan.jpg', 'Enter caption for this image now ...', '2013-11-17 10:18:42', 1),
(52, '/uploads/BacLieu.jpg', 'Enter caption for this image now ...', '2013-11-17 10:22:16', 1),
(53, '/uploads/AnGiang.jpg', 'Enter caption for this image now ...', '2013-11-17 11:06:56', 1),
(54, '/uploads/BacGiang.jpg', 'Enter caption for this image now ...', '2013-11-17 11:08:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `liked`
--

CREATE TABLE IF NOT EXISTS `liked` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `timeLike` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `userID` int(11) NOT NULL,
  `statusID` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_userID_idx` (`userID`),
  KEY `FK_statusID_idx` (`statusID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=101 ;

-- --------------------------------------------------------

--
-- Table structure for table `moto`
--

CREATE TABLE IF NOT EXISTS `moto` (
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `fare` float DEFAULT NULL,
  `tranportID` int(11) NOT NULL,
  PRIMARY KEY (`name`,`tranportID`),
  KEY `FK_transportID_moto` (`tranportID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `move`
--

CREATE TABLE IF NOT EXISTS `move` (
  `transportID` int(11) NOT NULL,
  `cityID_from` int(11) NOT NULL,
  `cityID_des` int(11) NOT NULL,
  PRIMARY KEY (`transportID`,`cityID_from`,`cityID_des`),
  KEY `FK_cityfrom_move` (`cityID_from`),
  KEY `FK_citydes_move` (`cityID_des`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `other`
--

CREATE TABLE IF NOT EXISTS `other` (
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `transportID` int(11) NOT NULL,
  `fare` float DEFAULT NULL,
  PRIMARY KEY (`name`,`transportID`),
  KEY `FK_transportID_other` (`transportID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE IF NOT EXISTS `plan` (
  `planID` int(11) NOT NULL AUTO_INCREMENT,
  `planName` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `totalCost` decimal(2,0) NOT NULL,
  `beginDate` date NOT NULL,
  `endDate` date NOT NULL,
  `score` int(11) NOT NULL DEFAULT '0',
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`planID`),
  KEY `FK_PlanUserID_UserUserID_idx` (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`planID`, `planName`, `totalCost`, `beginDate`, `endDate`, `score`, `userID`) VALUES
(1, 'around the world', '12', '2013-10-23', '2013-10-28', 0, 0),
(2, 'plan 2', '1', '2013-10-23', '2013-10-28', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `plane`
--

CREATE TABLE IF NOT EXISTS `plane` (
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `transportID` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`name`,`transportID`),
  KEY `FK_transportID_plane` (`transportID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `userID` int(11) NOT NULL,
  `fullName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phoneNum` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthDay` date NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE IF NOT EXISTS `restaurant` (
  `restaurantID` int(11) NOT NULL AUTO_INCREMENT,
  `cityID` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varbinary(8000) DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`restaurantID`),
  KEY `cityID` (`cityID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ride`
--

CREATE TABLE IF NOT EXISTS `ride` (
  `fare` float DEFAULT NULL,
  `long` datetime DEFAULT NULL,
  `departure_time` datetime NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `transportID` int(11) NOT NULL,
  PRIMARY KEY (`departure_time`,`name`,`transportID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE IF NOT EXISTS `room` (
  `roomNumber` int(11) NOT NULL AUTO_INCREMENT,
  `classified` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `status` tinyint(1) NOT NULL,
  `hotelID` int(11) NOT NULL,
  PRIMARY KEY (`roomNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `share`
--

CREATE TABLE IF NOT EXISTS `share` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `dateShared` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `userID` int(11) NOT NULL,
  `statusID` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_shared_userID_idx` (`userID`),
  KEY `FK_statusID_idx` (`statusID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=63 ;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `statusID` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `isImage` int(11) DEFAULT '0' COMMENT '0 is text\n1 is image',
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`statusID`),
  KEY `UserId` (`userID`),
  KEY `userID_2` (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=68 ;

-- --------------------------------------------------------

--
-- Table structure for table `stay`
--

CREATE TABLE IF NOT EXISTS `stay` (
  `roomNumber` int(11) NOT NULL,
  `hotelID` int(11) NOT NULL,
  `planID` int(11) NOT NULL,
  `dateBegin` date NOT NULL,
  `dataEnd` date NOT NULL,
  PRIMARY KEY (`roomNumber`,`hotelID`,`planID`,`dateBegin`),
  KEY `FK_hotelID_stay` (`hotelID`),
  KEY `FK_planID_stay` (`planID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `train`
--

CREATE TABLE IF NOT EXISTS `train` (
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `transportID` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`name`,`transportID`),
  KEY `FK_tranportID_train` (`transportID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trains`
--

CREATE TABLE IF NOT EXISTS `trains` (
  `transportID` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `departure_time` datetime NOT NULL,
  `time_leave` datetime DEFAULT NULL,
  `hard` float DEFAULT NULL,
  `soft` float DEFAULT NULL,
  `soft_air` float DEFAULT NULL,
  PRIMARY KEY (`transportID`,`name`,`departure_time`),
  KEY `transportID` (`transportID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transport`
--

CREATE TABLE IF NOT EXISTS `transport` (
  `transportID` int(11) NOT NULL AUTO_INCREMENT,
  `classified` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`transportID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` text COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0' COMMENT 'Admintor: 1\nUser default: 0',
  PRIMARY KEY (`userID`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `email`, `username`, `password`, `avatar`, `role`) VALUES
(0, 'newbiecse@gmail.com', 'newbiecse', 'Tancse1992', '/assets/userfile/img/users/tan.jpg', 1),
(1, 'email@gmail.com', 'Tuan', 'Tancse1992', '/assets/userfile/img/users/tuan.jpg', 1),
(2, 'email2@gmail.com', 'Giang', 'Tancse1992', '/assets/userfile/img/users/tuan.jpg', 0),
(3, 'email3@gmail.com', 'VanTan', 'Tancse1992', '/assets/userfile/img/users/user3.png', 0),
(4, 'gataohoa4@gmail.com', 'user4', '014349984e5d0f785fee3c2b3971f808', '/assets/userfile/img/users/user3.png', 0),
(5, 'gataohoa5@gmail.com', 'user5', '014349984e5d0f785fee3c2b3971f808', '/assets/userfile/img/users/user3.png', 0),
(6, 'gataohoa6@gmail.com', 'user6', '014349984e5d0f785fee3c2b3971f808', '/assets/userfile/img/users/user3.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `use_transport`
--

CREATE TABLE IF NOT EXISTS `use_transport` (
  `planID` int(11) NOT NULL,
  `cityID_from` int(11) NOT NULL,
  `cityID_des` int(11) NOT NULL,
  PRIMARY KEY (`planID`,`cityID_from`,`cityID_des`),
  KEY `FK_cityfrom_use` (`cityID_from`),
  KEY `FK_citydes_use` (`cityID_des`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `videoID` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime DEFAULT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`videoID`),
  KEY `UserId` (`userID`),
  KEY `userID_2` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `visit`
--

CREATE TABLE IF NOT EXISTS `visit` (
  `planID` int(11) NOT NULL,
  `cityID` int(11) NOT NULL,
  `dateTo` date NOT NULL,
  `dateLeave` date NOT NULL,
  `money` decimal(2,0) NOT NULL DEFAULT '0',
  PRIMARY KEY (`planID`,`cityID`,`dateTo`),
  KEY `FK_VisitCityID_CityCityID_idx` (`cityID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `visit`
--

INSERT INTO `visit` (`planID`, `cityID`, `dateTo`, `dateLeave`, `money`) VALUES
(1, 1, '2013-11-01', '2013-11-08', '0'),
(1, 2, '2013-11-07', '2013-11-07', '0');

-- --------------------------------------------------------

--
-- Table structure for table `visit_attrac`
--

CREATE TABLE IF NOT EXISTS `visit_attrac` (
  `planID` int(11) NOT NULL,
  `arrtractionID` int(11) NOT NULL,
  `time_visit` datetime NOT NULL,
  PRIMARY KEY (`planID`,`arrtractionID`,`time_visit`),
  KEY `FK_attractionID_visit_attrac` (`arrtractionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `FK_albumPlanID_planPlanID` FOREIGN KEY (`planID`) REFERENCES `plan` (`planID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `attraction`
--
ALTER TABLE `attraction`
  ADD CONSTRAINT `FK_cityID_attraction` FOREIGN KEY (`cityID`) REFERENCES `city` (`cityID`) ON DELETE CASCADE;

--
-- Constraints for table `bring`
--
ALTER TABLE `bring`
  ADD CONSTRAINT `FK_name_bring` FOREIGN KEY (`name`) REFERENCES `items` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_planID_bring` FOREIGN KEY (`planID`) REFERENCES `plan` (`planID`) ON DELETE CASCADE;

--
-- Constraints for table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `FK_transportID_car` FOREIGN KEY (`tranportID`) REFERENCES `transport` (`transportID`) ON DELETE CASCADE;

--
-- Constraints for table `comment_image`
--
ALTER TABLE `comment_image`
  ADD CONSTRAINT `FK_imageID_comment_image` FOREIGN KEY (`imageID`) REFERENCES `image` (`imageID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_userID_comment_image` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `comment_status`
--
ALTER TABLE `comment_status`
  ADD CONSTRAINT `FK_statusID_comment_status` FOREIGN KEY (`statusID`) REFERENCES `status` (`statusID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_userID_comment_status` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `comment_video`
--
ALTER TABLE `comment_video`
  ADD CONSTRAINT `FK_userID_comment_video` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_videoID_comment_video` FOREIGN KEY (`videoID`) REFERENCES `video` (`videoID`) ON DELETE CASCADE;

--
-- Constraints for table `eat`
--
ALTER TABLE `eat`
  ADD CONSTRAINT `FK_planID_eat` FOREIGN KEY (`planID`) REFERENCES `plan` (`planID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_restaurantID_eat` FOREIGN KEY (`restaurantID`) REFERENCES `restaurant` (`restaurantID`) ON DELETE CASCADE;

--
-- Constraints for table `flight`
--
ALTER TABLE `flight`
  ADD CONSTRAINT `FK_transportID_flight` FOREIGN KEY (`transportID`) REFERENCES `transport` (`transportID`) ON DELETE CASCADE;

--
-- Constraints for table `friend`
--
ALTER TABLE `friend`
  ADD CONSTRAINT `FK_UserID1_UserID` FOREIGN KEY (`userID1`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_UserID2_UserID` FOREIGN KEY (`userID2`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `gift`
--
ALTER TABLE `gift`
  ADD CONSTRAINT `FK_planID_gift` FOREIGN KEY (`planID`) REFERENCES `plan` (`planID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hotel_image`
--
ALTER TABLE `hotel_image`
  ADD CONSTRAINT `FK_imageHotelID_hotelID` FOREIGN KEY (`hotelID`) REFERENCES `hotel` (`hotelID`) ON DELETE CASCADE;

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`albumID`) REFERENCES `album` (`albumID`) ON DELETE CASCADE;

--
-- Constraints for table `liked`
--
ALTER TABLE `liked`
  ADD CONSTRAINT `FK_Like_userID` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Like_statusID` FOREIGN KEY (`statusID`) REFERENCES `status` (`statusID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `moto`
--
ALTER TABLE `moto`
  ADD CONSTRAINT `FK_transportID_moto` FOREIGN KEY (`tranportID`) REFERENCES `transport` (`transportID`) ON DELETE CASCADE;

--
-- Constraints for table `move`
--
ALTER TABLE `move`
  ADD CONSTRAINT `FK_citydes_move` FOREIGN KEY (`cityID_des`) REFERENCES `city` (`cityID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_cityfrom_move` FOREIGN KEY (`cityID_from`) REFERENCES `city` (`cityID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_transportID_move` FOREIGN KEY (`transportID`) REFERENCES `transport` (`transportID`) ON DELETE CASCADE;

--
-- Constraints for table `other`
--
ALTER TABLE `other`
  ADD CONSTRAINT `FK_transportID_other` FOREIGN KEY (`transportID`) REFERENCES `transport` (`transportID`) ON DELETE CASCADE;

--
-- Constraints for table `plan`
--
ALTER TABLE `plan`
  ADD CONSTRAINT `FK_PlanUserID_UserUserID` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `plane`
--
ALTER TABLE `plane`
  ADD CONSTRAINT `FK_transportID_plane` FOREIGN KEY (`transportID`) REFERENCES `transport` (`transportID`) ON DELETE CASCADE;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `FK_ProfileUserID_UserUserID` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD CONSTRAINT `FK_cityID_restaurant` FOREIGN KEY (`cityID`) REFERENCES `city` (`cityID`) ON DELETE CASCADE;

--
-- Constraints for table `share`
--
ALTER TABLE `share`
  ADD CONSTRAINT `FK_share_userID` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_share_statusID` FOREIGN KEY (`statusID`) REFERENCES `status` (`statusID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `FK_userID_status` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `stay`
--
ALTER TABLE `stay`
  ADD CONSTRAINT `FK_hotelID_stay` FOREIGN KEY (`hotelID`) REFERENCES `hotel` (`hotelID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_planID_stay` FOREIGN KEY (`planID`) REFERENCES `plan` (`planID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_roomNumber_stay` FOREIGN KEY (`roomNumber`) REFERENCES `room` (`roomNumber`) ON DELETE CASCADE;

--
-- Constraints for table `train`
--
ALTER TABLE `train`
  ADD CONSTRAINT `FK_tranportID_train` FOREIGN KEY (`transportID`) REFERENCES `transport` (`transportID`) ON DELETE CASCADE;

--
-- Constraints for table `trains`
--
ALTER TABLE `trains`
  ADD CONSTRAINT `FK_transport_trains` FOREIGN KEY (`transportID`) REFERENCES `transport` (`transportID`) ON DELETE CASCADE;

--
-- Constraints for table `use_transport`
--
ALTER TABLE `use_transport`
  ADD CONSTRAINT `FK_citydes_use` FOREIGN KEY (`cityID_des`) REFERENCES `city` (`cityID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_cityfrom_use` FOREIGN KEY (`cityID_from`) REFERENCES `city` (`cityID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_planID_use` FOREIGN KEY (`planID`) REFERENCES `plan` (`planID`) ON DELETE CASCADE;

--
-- Constraints for table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `FK_userID_video` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `visit`
--
ALTER TABLE `visit`
  ADD CONSTRAINT `FK_VisitCityID_CityCityID` FOREIGN KEY (`cityID`) REFERENCES `city` (`cityID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_VisitPlanID_PlanPlanID` FOREIGN KEY (`planID`) REFERENCES `plan` (`planID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `visit_attrac`
--
ALTER TABLE `visit_attrac`
  ADD CONSTRAINT `FK_attractionID_visit_attrac` FOREIGN KEY (`arrtractionID`) REFERENCES `attraction` (`attractionID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_planID_visit_attrac` FOREIGN KEY (`planID`) REFERENCES `plan` (`planID`) ON DELETE CASCADE;
