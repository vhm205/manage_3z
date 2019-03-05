-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2019 at 02:59 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ql_nhahang`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(200) NOT NULL,
  `PRICE` int(11) NOT NULL,
  `IMAGE` text NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `TYPE` varchar(50) NOT NULL DEFAULT 'Đồ uống',
  `STATUS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ID`, `NAME`, `PRICE`, `IMAGE`, `DESCRIPTION`, `TYPE`, `STATUS`) VALUES
(1, 'Trà Đào', 15000, '../upload/tradao-thaomoc.jpg', 'Trà Đào', 'Đồ uống', 1),
(2, 'Gong Cha', 20000, '../upload/Milk-Foam-Jasmine-Tea-600x600.jpg', 'Gong Cha là 1 loại Gong Cha', 'Đồ uống', 1),
(3, 'Trà sữa KOI', 20000, '../upload/teens-hung-tron-bao-lon-bo-tra-sua-latte-koi-the-do-ap-vao-cac-chi-nhanh-o-sai-gon-e30ee6b0636316728742360594.jpg', 'Trà sữa KOI 2019', 'Đồ uống', 1),
(4, 'Hồng trà', 25000, '../upload/CAFEDIDONG-HỒNG-TRÀ-BỌT-SỮA-01.jpg', 'Hồng Trà', 'Đồ uống', 0),
(5, 'Trà xanh Matcha', 25000, '../upload/bot-sua-tra-xanh-matcha-milk-200g-nhat-ban-5.jpg', 'Trà xanh Matcha 2019', 'Đồ uống', 0),
(6, 'Gà rán', 150000, '../upload/mo-quan-ga-ran.jpg', 'Gà rán KFC', 'Thức ăn', 1),
(7, 'Mì cay Hàn Quốc', 50000, '../upload/foody-mobile-c2-jpg-125-636029607664543397.jpg', 'Mì cay Hàn Quốc Cấp 7', 'Thức ăn', 1),
(8, 'Bia Tiger\'s Milk', 150000, '../upload/49a1c83a2e456dc4d85238055742aa6a.jpg', 'Bia Tiger\'s Milk 2019', 'Đồ uống', 1),
(9, 'Gỏi tôm', 20000, '../upload/cach-lam-goi-ngo-sen.jpg', 'Gỏi ngó sen tôm thịt', 'Thức ăn', 1),
(10, 'Đá me', 10000, '../upload/cach-lam-da-me.jpg', 'Đá me hạt mềm', 'Đồ uống', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
