-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2013 at 12:24 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.3

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
-- Table structure for table `eat`
--

CREATE TABLE IF NOT EXISTS `eat` (
  `planID` int(11) NOT NULL,
  `restaurantID` int(11) NOT NULL,
  `time_eat` datetime NOT NULL,
  `NumberTableBook` int(11) NOT NULL,
  PRIMARY KEY (`planID`,`restaurantID`,`time_eat`),
  KEY `FK_restaurantID_eat` (`restaurantID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eat`
--
ALTER TABLE `eat`
  ADD CONSTRAINT `FK_planID_eat` FOREIGN KEY (`planID`) REFERENCES `plan` (`planID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_restaurantID_eat` FOREIGN KEY (`restaurantID`) REFERENCES `restaurant` (`restaurantID`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
