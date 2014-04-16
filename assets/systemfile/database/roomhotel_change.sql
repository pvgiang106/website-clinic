-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2013 at 04:07 PM
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
-- Table structure for table `roomhotel`
--

CREATE TABLE IF NOT EXISTS `roomhotel` (
  `RoomNumber` int(11) NOT NULL,
  `HotelID` int(11) NOT NULL,
  `RoomType` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `RoomDescreption` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `RoomFacilites` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `Price` float NOT NULL,
  `DayChecked` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`RoomNumber`,`HotelID`),
  KEY `HotelId` (`HotelID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roomhotel`
--

INSERT INTO `roomhotel` (`RoomNumber`, `HotelID`, `RoomType`, `RoomDescreption`, `RoomFacilites`, `Price`, `DayChecked`) VALUES
(101, 157923, '3', '', '', 400000, '\r'),
(102, 157923, '2', '', '', 450000, '\r'),
(103, 157923, '1', '', '', 500000, '\r'),
(111, 269363, 'Standard Double Room sleeps 2', '25 square metre. City view Nice room with cozy designed, full of modern facilites such as: air conditioner, daily newspaper, in room safe, tub, fridge... all bring you the most comfortable during your stay at our hotel', 'Air Conditioning;Air Conditioning In-Room Control;Climate Control;Heating;Hairdryer;Complimentary Newspaper;Wake Up Calls;Daily Housekeeping;Late Check Out;Early Check In;Tourist Information;Fire Place;Broadband Free;Wifi Free;Telephone;Work Desk', 500000, '2013-11-22;2013-11-23;2013-11-21;'),
(112, 269363, 'Superior Room sleeps 2 Adults 1 child', '25 square metre. City view Nice room with cozy designed, full of modern facilites such as: air conditioner, daily newspaper, in room safe, tub, fridge... all bring you the most comfortable during your stay at our hotel', 'Air Conditioning;Air Conditioning In-Room Control;Climate Control;Heating;Hairdryer;Complimentary Newspaper;Wake Up Calls;Daily Housekeeping;Late Check Out;Early Check In;Tourist Information;Fire Place;Broadband Free;Wifi Free;Telephone;Work Desk', 550000, '\r'),
(113, 269363, 'Deluxe Room sleeps 2 Adults 1 child', '40 square metre. City view. Nice room with cozy designed, full of modern facilites such as: air conditioner, daily newspaper, in room safe, tub, fridge... all bring you the most comfortable during your stay at our hotel', 'Air Conditioning;Air Conditioning In-Room Control;Climate Control;Heating;Hairdryer;Complimentary Newspaper;Wake Up Calls;Daily Housekeeping;Late Check Out;Early Check In;Tourist Information;Fire Place;Broadband Free;Wifi Free;Telephone;Work Desk', 600000, '\r'),
(121, 269379, '3', '', '', 600000, '\r'),
(122, 269379, '2', '', '', 650000, '\r'),
(123, 269379, '1', '', '', 700000, '\r'),
(131, 269933, '3', '', '', 700000, '\r'),
(132, 269933, '2', '', '', 750000, '\r'),
(133, 269933, '1', '', '', 800000, '\r'),
(141, 269935, '3', '', '', 800000, '\r'),
(142, 269935, '2', '', '', 850000, '\r'),
(143, 269935, '1', '', '', 850000, '\r'),
(151, 269937, '3', '', '', 900000, '\r'),
(152, 269937, '2', '', '', 950000, '\r'),
(153, 269937, '1', '', '', 1000000, '\r'),
(161, 269948, '3', '', '', 1000000, '\r'),
(162, 269948, '2', '', '', 1050000, '\r'),
(163, 269948, '1', '', '', 1100000, '\r'),
(171, 276671, '3', '', '', 1100000, '\r'),
(172, 276671, '2', '', '', 1150000, '\r'),
(173, 276671, '1', '', '', 1200000, '\r'),
(181, 276694, '3', '', '', 1200000, '\r'),
(182, 276694, '2', '', '', 1250000, '\r'),
(183, 276694, '1', '', '', 1300000, '\r'),
(191, 276712, '3', '', '', 1300000, '\r'),
(192, 276712, '2', '', '', 1350000, '\r'),
(193, 276712, '1', '', '', 1400000, '\r'),
(201, 276716, '3', '', '', 1400000, '\r'),
(202, 276716, '2', '', '', 1450000, '\r'),
(203, 276716, '1', '', '', 1500000, '\r'),
(211, 276946, '3', '', '', 1500000, '\r'),
(212, 276946, '2', '', '', 1550000, '\r'),
(213, 276946, '1', '', '', 1600000, '\r'),
(221, 276992, '3', '', '', 1600000, '\r'),
(222, 276992, '2', '', '', 1650000, '\r'),
(223, 276992, '1', '', '', 1700000, '\r'),
(231, 277283, '3', '', '', 1700000, '\r'),
(232, 277283, '2', '', '', 1750000, '\r'),
(233, 277283, '1', '', '', 1800000, '\r'),
(241, 277287, '3', '', '', 1800000, '\r'),
(242, 277287, '2', '', '', 1850000, '\r'),
(246, 277287, '1', '', '', 1900000, '\r');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `roomhotel`
--
ALTER TABLE `roomhotel`
  ADD CONSTRAINT `roomhotel_ibfk_1` FOREIGN KEY (`HotelId`) REFERENCES `hotel` (`HotelID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
