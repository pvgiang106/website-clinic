-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2013 at 03:32 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `socialnetwork`
--

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
  `sex` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'male',
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'block',
  PRIMARY KEY (`userID`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `email`, `username`, `password`, `avatar`, `role`, `sex`, `status`) VALUES
(1, 'email@gmail.com', 'Tuan', 'Tancse1992', '/assets/userfile/img/users/tuan.jpg', 1, 'female', 'unblock'),
(2, 'email2@gmail.com', 'Giang', 'Tancse1992', '/assets/userfile/img/users/tuan.jpg', 0, 'male', 'block'),
(3, 'email3@gmail.com', 'VanTan', 'Tancse1992', '/assets/userfile/img/users/user3.png', 0, 'male', 'block'),
(4, 'gataohoa4@gmail.com', 'user4', '014349984e5d0f785fee3c2b3971f808', '/assets/userfile/img/users/user3.png', 0, 'male', 'block'),
(5, 'gataohoa5@gmail.com', 'user5', '014349984e5d0f785fee3c2b3971f808', '/assets/userfile/img/users/user3.png', 0, 'male', 'block'),
(6, 'gataohoa6@gmail.com', 'user6', '014349984e5d0f785fee3c2b3971f808', '/assets/userfile/img/users/user3.png', 0, 'female', 'block'),
(7, 'minhtuan.tablet@gmail.com', 'Minh Tuấn', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 'male', 'block'),
(12, 'newbiecse@gmail.com', 'newbiecse', 'Tancse1992', '/assets/userfile/img/users/tan.jpg', 1, 'male', 'unblock');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
