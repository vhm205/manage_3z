-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2019 at 02:44 PM
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
(6, 'Gà rán', 150000, '../upload/mo-quan-ga-ran.jpg', 'Gà rán KFC', 'Món ăn', 1),
(7, 'Mì cay Hàn Quốc', 50000, '../upload/foody-mobile-c2-jpg-125-636029607664543397.jpg', 'Mì cay Hàn Quốc Cấp 7', 'Món ăn', 1),
(8, 'Bia Tiger\'s Milk', 150000, '../upload/49a1c83a2e456dc4d85238055742aa6a.jpg', 'Bia Tiger\'s Milk 2019', 'Đồ uống', 1),
(9, 'Gỏi tôm', 20000, '../upload/cach-lam-goi-ngo-sen.jpg', 'Gỏi ngó sen tôm thịt', 'Món ăn', 1),
(10, 'Đá me', 10000, '../upload/cach-lam-da-me.jpg', 'Đá me hạt mềm', 'Đồ uống', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reports_revenue`
--

CREATE TABLE `reports_revenue` (
  `ID` int(10) NOT NULL,
  `MONTH` int(2) NOT NULL,
  `TOTAL_MONEY` bigint(10) NOT NULL,
  `TOTAL_AMOUNT` int(5) NOT NULL,
  `DATE_CREATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DETAIL` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reports_revenue`
--

INSERT INTO `reports_revenue` (`ID`, `MONTH`, `TOTAL_MONEY`, `TOTAL_AMOUNT`, `DATE_CREATE`, `DETAIL`) VALUES
(1, 3, 250000, 6, '2019-03-15 11:25:08', '{\"0\":{\"PEOPLE\":\"1\",\"TABLE\":\"Bàn 5\"},\"2\":{\"ID\":\"2\",\"NAME\":\"Gong Cha\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/Milk-Foam-Jasmine-Tea-600x600.jpg\",\"DESCRIPTION\":\"Gong Cha là 1 loại Gong Cha\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":2},\"3\":{\"ID\":\"3\",\"NAME\":\"Trà sữa KOI\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/teens-hung-tron-bao-lon-bo-tra-sua-latte-koi-the-do-ap-vao-cac-chi-nhanh-o-sai-gon-e30ee6b0636316728742360594.jpg\",\"DESCRIPTION\":\"Trà sữa KOI 2019\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":3},\"4\":{\"ID\":\"6\",\"NAME\":\"Gà rán\",\"PRICE\":\"150000\",\"IMAGE\":\"..\\/upload\\/mo-quan-ga-ran.jpg\",\"DESCRIPTION\":\"Gà rán KFC\",\"TYPE\":\"Thức ăn\",\"STATUS\":\"1\",\"0\":1}}'),
(3, 3, 110000, 6, '2019-03-15 11:34:32', '[{\"PEOPLE\":\"1\",\"TABLE\":\"Bàn 10\"},{\"ID\":\"1\",\"NAME\":\"Trà Đào\",\"PRICE\":\"15000\",\"IMAGE\":\"..\\/upload\\/tradao-thaomoc.jpg\",\"DESCRIPTION\":\"Trà Đào\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":2},{\"ID\":\"2\",\"NAME\":\"Gong Cha\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/Milk-Foam-Jasmine-Tea-600x600.jpg\",\"DESCRIPTION\":\"Gong Cha là 1 loại Gong Cha\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":3},{\"ID\":\"3\",\"NAME\":\"Trà sữa KOI\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/teens-hung-tron-bao-lon-bo-tra-sua-latte-koi-the-do-ap-vao-cac-chi-nhanh-o-sai-gon-e30ee6b0636316728742360594.jpg\",\"DESCRIPTION\":\"Trà sữa KOI 2019\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":1}]'),
(5, 3, 305000, 9, '2019-03-15 01:34:01', '[{\"PEOPLE\":\"1\",\"TABLE\":\"Bàn 10\"},{\"ID\":\"1\",\"NAME\":\"Trà Đào\",\"PRICE\":\"15000\",\"IMAGE\":\"..\\/upload\\/tradao-thaomoc.jpg\",\"DESCRIPTION\":\"Trà Đào\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":1},{\"ID\":\"2\",\"NAME\":\"Gong Cha\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/Milk-Foam-Jasmine-Tea-600x600.jpg\",\"DESCRIPTION\":\"Gong Cha là 1 loại Gong Cha\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":3},{\"ID\":\"3\",\"NAME\":\"Trà sữa KOI\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/teens-hung-tron-bao-lon-bo-tra-sua-latte-koi-the-do-ap-vao-cac-chi-nhanh-o-sai-gon-e30ee6b0636316728742360594.jpg\",\"DESCRIPTION\":\"Trà sữa KOI 2019\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":4},{\"ID\":\"6\",\"NAME\":\"Gà rán\",\"PRICE\":\"150000\",\"IMAGE\":\"..\\/upload\\/mo-quan-ga-ran.jpg\",\"DESCRIPTION\":\"Gà rán KFC\",\"TYPE\":\"Thức ăn\",\"STATUS\":\"1\",\"0\":1}]'),
(6, 3, 345000, 12, '2019-03-15 01:46:10', '[{\"PEOPLE\":\"1\",\"TABLE\":\"Bàn 5\"},{\"ID\":\"1\",\"NAME\":\"Trà Đào\",\"PRICE\":\"15000\",\"IMAGE\":\"..\\/upload\\/tradao-thaomoc.jpg\",\"DESCRIPTION\":\"Trà Đào\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":5},{\"ID\":\"2\",\"NAME\":\"Gong Cha\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/Milk-Foam-Jasmine-Tea-600x600.jpg\",\"DESCRIPTION\":\"Gong Cha là 1 loại Gong Cha\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":2},{\"ID\":\"3\",\"NAME\":\"Trà sữa KOI\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/teens-hung-tron-bao-lon-bo-tra-sua-latte-koi-the-do-ap-vao-cac-chi-nhanh-o-sai-gon-e30ee6b0636316728742360594.jpg\",\"DESCRIPTION\":\"Trà sữa KOI 2019\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":4},{\"ID\":\"6\",\"NAME\":\"Gà rán\",\"PRICE\":\"150000\",\"IMAGE\":\"..\\/upload\\/mo-quan-ga-ran.jpg\",\"DESCRIPTION\":\"Gà rán KFC\",\"TYPE\":\"Thức ăn\",\"STATUS\":\"1\",\"0\":1}]'),
(7, 3, 35000, 2, '2019-03-15 01:50:18', '[{\"PEOPLE\":\"1\",\"TABLE\":\"Bàn 20\"},{\"ID\":\"1\",\"NAME\":\"Trà Đào\",\"PRICE\":\"15000\",\"IMAGE\":\"..\\/upload\\/tradao-thaomoc.jpg\",\"DESCRIPTION\":\"Trà Đào\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":1},{\"ID\":\"2\",\"NAME\":\"Gong Cha\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/Milk-Foam-Jasmine-Tea-600x600.jpg\",\"DESCRIPTION\":\"Gong Cha là 1 loại Gong Cha\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":1}]'),
(8, 3, 95000, 5, '2019-03-16 03:21:19', '[{\"PEOPLE\":\"1\",\"TABLE\":\"Bàn 10\"},{\"ID\":\"1\",\"NAME\":\"Trà Đào\",\"PRICE\":\"15000\",\"IMAGE\":\"..\\/upload\\/tradao-thaomoc.jpg\",\"DESCRIPTION\":\"Trà Đào\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":1},{\"ID\":\"2\",\"NAME\":\"Gong Cha\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/Milk-Foam-Jasmine-Tea-600x600.jpg\",\"DESCRIPTION\":\"Gong Cha là 1 loại Gong Cha\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":3},{\"ID\":\"3\",\"NAME\":\"Trà sữa KOI\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/teens-hung-tron-bao-lon-bo-tra-sua-latte-koi-the-do-ap-vao-cac-chi-nhanh-o-sai-gon-e30ee6b0636316728742360594.jpg\",\"DESCRIPTION\":\"Trà sữa KOI 2019\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":1}]'),
(9, 3, 460000, 4, '2019-03-16 03:21:56', '[{\"PEOPLE\":\"1\",\"TABLE\":\"Bàn 5\"},{\"ID\":\"6\",\"NAME\":\"Gà rán\",\"PRICE\":\"150000\",\"IMAGE\":\"..\\/upload\\/mo-quan-ga-ran.jpg\",\"DESCRIPTION\":\"Gà rán KFC\",\"TYPE\":\"Thức ăn\",\"STATUS\":\"1\",\"0\":2},{\"ID\":\"8\",\"NAME\":\"Bia Tiger\'s Milk\",\"PRICE\":\"150000\",\"IMAGE\":\"..\\/upload\\/49a1c83a2e456dc4d85238055742aa6a.jpg\",\"DESCRIPTION\":\"Bia Tiger\'s Milk 2019\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":1},{\"ID\":\"10\",\"NAME\":\"Đá me\",\"PRICE\":\"10000\",\"IMAGE\":\"..\\/upload\\/cach-lam-da-me.jpg\",\"DESCRIPTION\":\"Đá me hạt mềm\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":1}]'),
(10, 3, 640000, 6, '2019-03-16 06:25:07', '{\"0\":{\"PEOPLE\":\"1\",\"TABLE\":\"Bàn 6\"},\"2\":{\"ID\":\"2\",\"NAME\":\"Gong Cha\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/Milk-Foam-Jasmine-Tea-600x600.jpg\",\"DESCRIPTION\":\"Gong Cha là 1 loại Gong Cha\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":2},\"3\":{\"ID\":\"6\",\"NAME\":\"Gà rán\",\"PRICE\":\"150000\",\"IMAGE\":\"..\\/upload\\/mo-quan-ga-ran.jpg\",\"DESCRIPTION\":\"Gà rán KFC\",\"TYPE\":\"Thức ăn\",\"STATUS\":\"1\",\"0\":4}}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `reports_revenue`
--
ALTER TABLE `reports_revenue`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reports_revenue`
--
ALTER TABLE `reports_revenue`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
