-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 17, 2014 at 06:22 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `chi_tiet_kham`
--

INSERT INTO `chi_tiet_kham` (`id_chitiet`, `email`, `id_lichkham`, `id_phongkham`, `trieu_chung`, `nhiet_do`, `huyet_ap`, `mach`, `chuan_doan`, `loi_khuyen`, `chi_phi`) VALUES
(3, 'bvthinh@email.com', 59, 1, 'Đau bụng', 38, '125/90', 90, 'Nhiễm khuẩn đường ruột', 'Ăn đồ nầu chín', 80000);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id_faq`, `email`, `id_phongkham`, `question`, `answer`) VALUES
(1, 'bvthinh@email.com', 1, 'Thưa BS vòm họng tôi có nỗi lên một cái mục bằng ngón tay vậy xin BS cho biết tôi bị bệnh gì xin cám ơn BSg', 'Chảo em, theo em mô tả thì em có thể bị viêm họng hạt. Viêm họng hạt mạn tính có thể do rất nhiều nguyên nhân như viêm xoang, trào ngược dạ dày thực quản.  Em hãy đến bệnh viện Tai Mũi Họng TPHCM(155B Trần Quốc Thảo Q3) để bác sĩ khám, cho làm xét nghiệm kiểm tra nếu cần để xác định rõ bệnh của em và hướng dẫn em cách điều trị tốt nhất.'),
(2, 'bvthinh@email.com', 1, 'Chào bác sĩ.năm nay cháu 21 tuổi. Dạo này cháu hay bị vướng 1 bên thành abidam.đau lan lên hàm và tai, đầu bên bị nuốt vướng.xin hỏi cháu bị gì ạ? cháu có bị viêm xoang cấp xuất tiết và đã chữa khỏi.mong bác sĩ giúp cháu', 'Chào em, theo em mô tả thì em có thể bị viêm amidan hay viêm họng. Em hãy đến bệnh viện Tai Mũi Họng TPHCM(155B Trần Quốc Thảo Q3) để bác sĩ khám, cho làm xét nghiệm kiểm tra nếu cần để xác định rõ bệnh của em và hướng dẫn em cách điều trị tốt nhất.'),
(3, 'bvthinh@email.com', 1, 'chao bac si cho biet dau hieu cua benh ung thu vom hong', 'Chào em, các dấu hiệu gợi ý của ung thư vòm họng là chảy máu mũi hay khạc ra máu kèm ù tai và nhức đầu. Nếu em có 2 hoặc 3 triệu chứng như trên thì nên đến bệnh viện nội soi kiểm tra để tầm soát u vùng vòm họng. Rất cám ơn sự quan tâm của em!\r\n'),
(4, 'bvthinh@email.com', 1, 'Cháu bị có dỏm loãng trong họng lâu ngày là bị bênh gì a.', 'Chào em, theo em mô tả thì em có thể bị viêm họng, viêm amidan hay viêm mũi xoang. Em hãy đến bệnh viện Tai Mũi Họng TPHCM(155B Trần Quốc Thảo Q3) để bác sĩ khám, cho làm xét nghiệm kiểm tra nếu cần và hướng dẫn em cách điều trị tốt nhất!\r\n'),
(5, 'bvthinh@email.com', 1, 'Thưa bác sĩ, tôi năm nay 38 tuổi, khoảng vài năm trở lại đây, tai trái của tôi bị rè nghe như tiếng ve kêu, không biết là bị sao vậy, bác sĩ tư vấn giúp tôi với', ''),
(6, 'bvthinh@email.com', 1, 'Mẹ em bị chay máu cam ca tuần nay ma k biết lí do gì,xin bác sĩ hướng dẫn cách khám và điều trị như thế nào. Cảm ơn bác sĩ.', ''),
(7, 'dtttam@email.com', 1, 'Tai phải của em bị rè khi nghe tiếng ồn lớn hoặc khi hát karaoke, cảm giác khó chịu. Cho e hỏi bệnh của e là gì và cách chua tri', ''),
(8, 'htbnham@email.com', 1, 'em bị viêm mũi dị ứng 5 năm rồi mà không bớt, uống thuôc chỉ bớt tức thời..ngày nào cũng chảy nươc mũi và ngứa mũi..làm sao để bệnh em giảm bớt', '');

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
  `tai_kham` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'True: accpet, false: waiting',
  `li_do_huy` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Ghi li do huy cua phong kham',
  PRIMARY KEY (`id_lichkham`),
  KEY `id_phongkham` (`id_phongkham`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=66 ;

--
-- Dumping data for table `lich_kham`
--

INSERT INTO `lich_kham` (`id_lichkham`, `email`, `li_do_kham`, `id_phongkham`, `ngay_kham`, `thoigian_batdau`, `thoigian_ketthuc`, `tai_kham`, `status`, `li_do_huy`) VALUES
(59, 'bvthinh@email.com', 'Khám tổng quát', 1, '2014-06-12', '08:00:00', '08:15:00', 0, 1, ''),
(60, 'lqkhanh@email.com', 'Khám mắt', 1, '2014-06-12', '10:00:00', '10:15:00', 0, 1, ''),
(61, 'pttquyen@email.com', 'Sốt , chóng mặt', 1, '2014-06-12', '08:15:00', '08:30:00', 0, 1, ''),
(62, 'htbnham@email.com', 'Đau bụng', 1, '2014-06-12', '09:00:00', '09:15:00', 0, 1, '');

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
(1, '2014-06-12', '07:00:00', '08:00:00', 4, 0),
(1, '2014-06-12', '08:00:00', '09:00:00', 4, 2),
(1, '2014-06-12', '09:00:00', '10:00:00', 4, 1),
(1, '2014-06-12', '10:00:00', '11:00:00', 4, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `phongkham`
--

INSERT INTO `phongkham` (`id_phongkham`, `name`, `phone`, `address`, `district`, `provice`, `feature`, `website`, `register_day`, `expire_day`, `toadoX`, `toadoY`) VALUES
(1, 'PK Tân Bình', 976135377, '127/10 Hoàng Hoa Thám', 'Tân Bình', 'Hồ Chí Minh', 'Tai, Mũi, Họng', 'www.pktanbinh.com', '2014-04-30', '2014-07-31', 10.8, 106.65),
(2, 'PK Phú Nhuận', 996926726, '181/30 Phan Đăng Lưu', 'Phú Nhuận', 'Hồ Chí Minh', 'Răng, Hàm, Mặt', 'www.pkphunhuan.com', '2014-04-30', '2014-07-31', 10.8, 106.68),
(7, 'PK Gò Vấp', 972484964, '28 Phan Văn Trị', 'Gò Vấp', 'Hồ Chí Minh', 'Đa khoa', 'www.pkgovap.com', '2014-04-30', '2014-07-31', 10.83, 106.66),
(10, 'PK Thủ Đức', 983339031, '85 Lê Văn Chí', 'Thủ Đức', 'Hồ Chí Minh', 'Xương khớp', 'www.pkthuduc.com', '2014-04-30', '2014-07-31', 10.85, 106.77),
(11, 'PK Tân Phú', 974527239, '58 Lũy Bán Bích', 'Tân Phú', 'Hồ Chí Minh', 'Nội Khoa', 'www.pktanphu.com', '2014-04-30', '2014-07-31', 10.76, 106.63);

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
-- Table structure for table `thuoc`
--

CREATE TABLE IF NOT EXISTS `thuoc` (
  `id_thuoc` int(11) NOT NULL AUTO_INCREMENT,
  `ten_thuoc` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sang` tinyint(1) NOT NULL,
  `trua` tinyint(1) NOT NULL,
  `toi` tinyint(1) NOT NULL,
  `don_vi_dung` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_thuoc`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `thuoc`
--

INSERT INTO `thuoc` (`id_thuoc`, `ten_thuoc`, `sang`, `trua`, `toi`, `don_vi_dung`) VALUES
(1, 'Panadol', 1, 1, 1, '1'),
(2, 'Alaxan', 1, 1, 1, '1'),
(3, 'fulcaca', 1, 0, 0, '1'),
(4, 'Kaletra', 1, 1, 1, '1'),
(5, 'Goldpearl', 0, 1, 1, '1'),
(6, 'Vermeb', 0, 1, 1, '1'),
(7, 'Bimaz', 1, 0, 1, '1'),
(8, 'Lactospor', 1, 0, 0, '1'),
(9, 'Penmoxy 250', 0, 1, 1, '0.5'),
(10, 'Migocap 10', 1, 0, 0, '1'),
(11, 'dfasd', 0, 0, 0, 'asgfasg');

-- --------------------------------------------------------

--
-- Table structure for table `toa_thuoc`
--

CREATE TABLE IF NOT EXISTS `toa_thuoc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_chitiet` int(11) NOT NULL,
  `id_thuoc` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `toa_thuoc`
--

INSERT INTO `toa_thuoc` (`id`, `id_chitiet`, `id_thuoc`) VALUES
(1, 3, 6),
(2, 3, 8),
(3, 3, 9);

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
('bvthinh@email.com', 'Thịnh', 'Bùi Văn', 1656868758, 'Nam', '62cc2d8b4bf2d8728120d052163a77df', '1991-08-24', '32 Thành Thái', 'Hồ Chí Minh', '10', '2014-05-01', 1.62, 54),
('dtttam@email.com', 'Tâm ', 'Đoàn Thủy Thanh', 942479699, 'Nữ', '62cc2d8b4bf2d8728120d052163a77df', '1992-08-02', '13 D5', 'Hồ Chí Minh', 'Bình Thạnh', '2014-05-01', 1.54, 40),
('hnthien@email.com', 'Thiện', 'Hồ Ngọc', 935520608, 'Nam', '62cc2d8b4bf2d8728120d052163a77df', '1991-05-15', '120 Hoàng Hoa Thám', 'Hồ Chí Minh', 'Tân Bình', '2014-05-01', 1.67, 62),
('htbnham@email.com', 'Nhâm', 'Hoàng Thị Bích', 1677126424, 'Nữ', '62cc2d8b4bf2d8728120d052163a77df', '1992-03-29', '325 Bạch Đằng', 'Hồ Chí Minh', 'Bình Thạnh', '2014-05-01', 1.58, 42),
('lqkhanh@email.com', 'Khánh', 'Lưu Quốc', 907478671, 'Nam', '62cc2d8b4bf2d8728120d052163a77df', '1991-06-04', '181/30 Phan Đăng Lưu', 'Hồ Chí Minh', 'Phú Nhuận', '2014-05-01', 1.62, 60),
('pttquyen@email.com', 'Quyên', 'Phạm Thúy', 1646877221, 'Nữ', '62cc2d8b4bf2d8728120d052163a77df', '1991-08-28', '9 Trần Văn Dư', 'Hồ Chí Minh', 'Tân Bình', '2014-05-01', 1.6, 50),
('ptttrang@email.com', 'Trang', 'Phạm Thu', 942578468, 'Nữ', '62cc2d8b4bf2d8728120d052163a77df', '1991-11-07', '3 Chu Văn An', 'Hồ Chí Minh', 'Bình Thạnh', '2014-05-01', 1.59, 50),
('pvgiang@email.com', 'Giang', 'Phạm Văn', 976135377, 'Nam', '62cc2d8b4bf2d8728120d052163a77df', '1991-06-10', '127/10 Hoàng Hoa Thám', 'Hồ Chí Minh', 'Tân Bình', '2014-05-01', 1.6, 60);

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
(1, 'admin@email.com', 'Administrator', '21232f297a57a5a743894a0e4a801fc3', 1),
(7, 'pkgovap@email.com', 'PK Gò Vấp', '62cc2d8b4bf2d8728120d052163a77df', 0),
(2, 'pkphunhuan@email.com', 'PK Phú Nhuận', '62cc2d8b4bf2d8728120d052163a77df', 0),
(1, 'pktanbinh@email.com', 'PK Tân Bình', '62cc2d8b4bf2d8728120d052163a77df', 0),
(11, 'pktanphu@email.com', 'PK Tân Phú', '62cc2d8b4bf2d8728120d052163a77df', 0),
(10, 'pkthuduc@email.com', 'PK Thủ Đức', '62cc2d8b4bf2d8728120d052163a77df', 0);

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
-- Constraints for table `user_phongkham`
--
ALTER TABLE `user_phongkham`
  ADD CONSTRAINT `user_phongkham_ibfk_1` FOREIGN KEY (`id_phongkham`) REFERENCES `phongkham` (`id_phongkham`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
