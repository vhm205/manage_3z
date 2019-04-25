-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2019 at 11:13 AM
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
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `ID` int(11) NOT NULL,
  `USERNAME` varchar(100) NOT NULL,
  `PASSWORD` varchar(200) NOT NULL,
  `SALT` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`ID`, `USERNAME`, `PASSWORD`, `SALT`) VALUES
(1, 'admin', '9bfb0d03e19bd8cc0804f4314f165382', '$1$hhvdws7H$TDRaehOvCeLYnYaUPtuQd/');

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
(1, 'Trà Đào', 15000, '../upload/tradao-thaomoc.jpg', '', 'Đồ uống', 1),
(2, 'Gong Cha', 20000, '../upload/Milk-Foam-Jasmine-Tea-600x600.jpg', 'Gong Cha là 1 loại Gong Cha', 'Đồ uống', 1),
(3, 'Trà sữa KOI', 20000, '../upload/teens-hung-tron-bao-lon-bo-tra-sua-latte-koi-the-do-ap-vao-cac-chi-nhanh-o-sai-gon-e30ee6b0636316728742360594.jpg', 'Trà sữa KOI 2019', 'Đồ uống', 1),
(4, 'Hồng trà', 25000, '../upload/CAFEDIDONG-HỒNG-TRÀ-BỌT-SỮA-01.jpg', 'Hồng Trà', 'Đồ uống', 0),
(5, 'Trà xanh Matcha', 25000, '../upload/bot-sua-tra-xanh-matcha-milk-200g-nhat-ban-5.jpg', 'Trà xanh Matcha 2019', 'Đồ uống', 0),
(6, 'Gà rán', 150000, '../upload/mo-quan-ga-ran.jpg', 'Gà rán KFC', 'Món ăn', 1),
(7, 'Mì cay Hàn Quốc', 50000, '../upload/foody-mobile-c2-jpg-125-636029607664543397.jpg', 'Mì cay Hàn Quốc Cấp 7', 'Món ăn', 1),
(8, 'Bia Tiger\'s Milk', 150000, '../upload/49a1c83a2e456dc4d85238055742aa6a.jpg', 'Bia Tiger\'s Milk 2019', 'Đồ uống', 1),
(9, 'Gỏi tôm', 20000, '../upload/cach-lam-goi-ngo-sen.jpg', 'Gỏi ngó sen tôm thịt', 'Món ăn', 0),
(10, 'Đá me', 10000, '../upload/cach-lam-da-me.jpg', 'Đá me hạt mềm', 'Đồ uống', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reports_revenue`
--

CREATE TABLE `reports_revenue` (
  `ID` int(10) NOT NULL,
  `MONTH` int(11) NOT NULL,
  `YEAR` int(4) NOT NULL,
  `TOTAL_MONEY` bigint(10) NOT NULL,
  `TOTAL_AMOUNT` int(5) NOT NULL,
  `DATE_CREATE` date NOT NULL,
  `TIME` varchar(20) NOT NULL,
  `DETAIL` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reports_revenue`
--

INSERT INTO `reports_revenue` (`ID`, `MONTH`, `YEAR`, `TOTAL_MONEY`, `TOTAL_AMOUNT`, `DATE_CREATE`, `TIME`, `DETAIL`) VALUES
(1, 3, 2019, 250000, 6, '2019-03-15', '04:37:22 pm', '{\"0\":{\"PEOPLE\":\"1\",\"TABLE\":\"Bàn 5\"},\"2\":{\"ID\":\"2\",\"NAME\":\"Gong Cha\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/Milk-Foam-Jasmine-Tea-600x600.jpg\",\"DESCRIPTION\":\"Gong Cha là 1 loại Gong Cha\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":2},\"3\":{\"ID\":\"3\",\"NAME\":\"Trà sữa KOI\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/teens-hung-tron-bao-lon-bo-tra-sua-latte-koi-the-do-ap-vao-cac-chi-nhanh-o-sai-gon-e30ee6b0636316728742360594.jpg\",\"DESCRIPTION\":\"Trà sữa KOI 2019\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":3},\"4\":{\"ID\":\"6\",\"NAME\":\"Gà rán\",\"PRICE\":\"150000\",\"IMAGE\":\"..\\/upload\\/mo-quan-ga-ran.jpg\",\"DESCRIPTION\":\"Gà rán KFC\",\"TYPE\":\"Thức ăn\",\"STATUS\":\"1\",\"0\":1}}'),
(2, 3, 2019, 110000, 6, '2019-03-06', '04:37:22 pm', '[{\"PEOPLE\":\"1\",\"TABLE\":\"Bàn 10\"},{\"ID\":\"1\",\"NAME\":\"Trà Đào\",\"PRICE\":\"15000\",\"IMAGE\":\"..\\/upload\\/tradao-thaomoc.jpg\",\"DESCRIPTION\":\"Trà Đào\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":2},{\"ID\":\"2\",\"NAME\":\"Gong Cha\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/Milk-Foam-Jasmine-Tea-600x600.jpg\",\"DESCRIPTION\":\"Gong Cha là 1 loại Gong Cha\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":3},{\"ID\":\"3\",\"NAME\":\"Trà sữa KOI\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/teens-hung-tron-bao-lon-bo-tra-sua-latte-koi-the-do-ap-vao-cac-chi-nhanh-o-sai-gon-e30ee6b0636316728742360594.jpg\",\"DESCRIPTION\":\"Trà sữa KOI 2019\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":1}]'),
(3, 3, 2019, 305000, 9, '2019-03-15', '04:37:22 pm', '[{\"PEOPLE\":\"1\",\"TABLE\":\"Bàn 10\"},{\"ID\":\"1\",\"NAME\":\"Trà Đào\",\"PRICE\":\"15000\",\"IMAGE\":\"..\\/upload\\/tradao-thaomoc.jpg\",\"DESCRIPTION\":\"Trà Đào\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":1},{\"ID\":\"2\",\"NAME\":\"Gong Cha\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/Milk-Foam-Jasmine-Tea-600x600.jpg\",\"DESCRIPTION\":\"Gong Cha là 1 loại Gong Cha\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":3},{\"ID\":\"3\",\"NAME\":\"Trà sữa KOI\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/teens-hung-tron-bao-lon-bo-tra-sua-latte-koi-the-do-ap-vao-cac-chi-nhanh-o-sai-gon-e30ee6b0636316728742360594.jpg\",\"DESCRIPTION\":\"Trà sữa KOI 2019\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":4},{\"ID\":\"6\",\"NAME\":\"Gà rán\",\"PRICE\":\"150000\",\"IMAGE\":\"..\\/upload\\/mo-quan-ga-ran.jpg\",\"DESCRIPTION\":\"Gà rán KFC\",\"TYPE\":\"Thức ăn\",\"STATUS\":\"1\",\"0\":1}]'),
(4, 3, 2019, 345000, 12, '2019-03-12', '04:37:22 pm', '[{\"PEOPLE\":\"1\",\"TABLE\":\"Bàn 5\"},{\"ID\":\"1\",\"NAME\":\"Trà Đào\",\"PRICE\":\"15000\",\"IMAGE\":\"..\\/upload\\/tradao-thaomoc.jpg\",\"DESCRIPTION\":\"Trà Đào\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":5},{\"ID\":\"2\",\"NAME\":\"Gong Cha\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/Milk-Foam-Jasmine-Tea-600x600.jpg\",\"DESCRIPTION\":\"Gong Cha là 1 loại Gong Cha\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":2},{\"ID\":\"3\",\"NAME\":\"Trà sữa KOI\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/teens-hung-tron-bao-lon-bo-tra-sua-latte-koi-the-do-ap-vao-cac-chi-nhanh-o-sai-gon-e30ee6b0636316728742360594.jpg\",\"DESCRIPTION\":\"Trà sữa KOI 2019\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":4},{\"ID\":\"6\",\"NAME\":\"Gà rán\",\"PRICE\":\"150000\",\"IMAGE\":\"..\\/upload\\/mo-quan-ga-ran.jpg\",\"DESCRIPTION\":\"Gà rán KFC\",\"TYPE\":\"Thức ăn\",\"STATUS\":\"1\",\"0\":1}]'),
(5, 3, 2019, 35000, 2, '2019-03-15', '04:37:22 pm', '[{\"PEOPLE\":\"1\",\"TABLE\":\"Bàn 20\"},{\"ID\":\"1\",\"NAME\":\"Trà Đào\",\"PRICE\":\"15000\",\"IMAGE\":\"..\\/upload\\/tradao-thaomoc.jpg\",\"DESCRIPTION\":\"Trà Đào\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":1},{\"ID\":\"2\",\"NAME\":\"Gong Cha\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/Milk-Foam-Jasmine-Tea-600x600.jpg\",\"DESCRIPTION\":\"Gong Cha là 1 loại Gong Cha\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":1}]'),
(6, 4, 2019, 95000, 5, '2019-04-03', '04:37:22 pm', '[{\"PEOPLE\":\"1\",\"TABLE\":\"Bàn 10\"},{\"ID\":\"1\",\"NAME\":\"Trà Đào\",\"PRICE\":\"15000\",\"IMAGE\":\"..\\/upload\\/tradao-thaomoc.jpg\",\"DESCRIPTION\":\"Trà Đào\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":1},{\"ID\":\"2\",\"NAME\":\"Gong Cha\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/Milk-Foam-Jasmine-Tea-600x600.jpg\",\"DESCRIPTION\":\"Gong Cha là 1 loại Gong Cha\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":3},{\"ID\":\"3\",\"NAME\":\"Trà sữa KOI\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/teens-hung-tron-bao-lon-bo-tra-sua-latte-koi-the-do-ap-vao-cac-chi-nhanh-o-sai-gon-e30ee6b0636316728742360594.jpg\",\"DESCRIPTION\":\"Trà sữa KOI 2019\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":1}]'),
(7, 4, 2019, 460000, 4, '2019-04-07', '04:37:22 pm', '[{\"PEOPLE\":\"1\",\"TABLE\":\"Bàn 5\"},{\"ID\":\"6\",\"NAME\":\"Gà rán\",\"PRICE\":\"150000\",\"IMAGE\":\"..\\/upload\\/mo-quan-ga-ran.jpg\",\"DESCRIPTION\":\"Gà rán KFC\",\"TYPE\":\"Thức ăn\",\"STATUS\":\"1\",\"0\":2},{\"ID\":\"8\",\"NAME\":\"Bia Tiger\'s Milk\",\"PRICE\":\"150000\",\"IMAGE\":\"..\\/upload\\/49a1c83a2e456dc4d85238055742aa6a.jpg\",\"DESCRIPTION\":\"Bia Tiger\'s Milk 2019\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":1},{\"ID\":\"10\",\"NAME\":\"Đá me\",\"PRICE\":\"10000\",\"IMAGE\":\"..\\/upload\\/cach-lam-da-me.jpg\",\"DESCRIPTION\":\"Đá me hạt mềm\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":1}]'),
(8, 4, 2019, 640000, 6, '2019-04-17', '04:37:22 pm', '{\"0\":{\"PEOPLE\":\"1\",\"TABLE\":\"Bàn 6\"},\"2\":{\"ID\":\"2\",\"NAME\":\"Gong Cha\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/Milk-Foam-Jasmine-Tea-600x600.jpg\",\"DESCRIPTION\":\"Gong Cha là 1 loại Gong Cha\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":2},\"3\":{\"ID\":\"6\",\"NAME\":\"Gà rán\",\"PRICE\":\"150000\",\"IMAGE\":\"..\\/upload\\/mo-quan-ga-ran.jpg\",\"DESCRIPTION\":\"Gà rán KFC\",\"TYPE\":\"Thức ăn\",\"STATUS\":\"1\",\"0\":4}}'),
(9, 4, 2019, 80000, 4, '2019-04-25', '04:37:22 pm', '[{\"PEOPLE\":\"1\",\"TABLE\":\"Bàn 2\"},{\"ID\":\"2\",\"NAME\":\"Gong Cha\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/Milk-Foam-Jasmine-Tea-600x600.jpg\",\"DESCRIPTION\":\"Gong Cha là 1 loại Gong Cha\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":3},{\"ID\":\"3\",\"NAME\":\"Trà sữa KOI\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/teens-hung-tron-bao-lon-bo-tra-sua-latte-koi-the-do-ap-vao-cac-chi-nhanh-o-sai-gon-e30ee6b0636316728742360594.jpg\",\"DESCRIPTION\":\"Trà sữa KOI 2019\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":1}]'),
(11, 5, 2019, 475000, 5, '2019-05-07', '04:37:22 pm', '[{\"PEOPLE\":\"1\",\"TABLE\":\"Bàn 20\"},{\"ID\":\"1\",\"NAME\":\"Trà Đào\",\"PRICE\":\"15000\",\"IMAGE\":\"..\\/upload\\/tradao-thaomoc.jpg\",\"DESCRIPTION\":\"Trà Đào\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":1},{\"ID\":\"8\",\"NAME\":\"Bia Tiger\'s Milk\",\"PRICE\":\"150000\",\"IMAGE\":\"..\\/upload\\/49a1c83a2e456dc4d85238055742aa6a.jpg\",\"DESCRIPTION\":\"Bia Tiger\'s Milk 2019\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":3},{\"ID\":\"10\",\"NAME\":\"Đá me\",\"PRICE\":\"10000\",\"IMAGE\":\"..\\/upload\\/cach-lam-da-me.jpg\",\"DESCRIPTION\":\"Đá me hạt mềm\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":1}]'),
(12, 1, 2020, 700000, 6, '2020-01-01', '04:37:22 pm', '{\"0\":{\"PEOPLE\":\"1\",\"TABLE\":\"Bàn 9\"},\"2\":{\"ID\":\"7\",\"NAME\":\"Mì cay Hàn Quốc\",\"PRICE\":\"50000\",\"IMAGE\":\"..\\/upload\\/foody-mobile-c2-jpg-125-636029607664543397.jpg\",\"DESCRIPTION\":\"Mì cay Hàn Quốc Cấp 7\",\"TYPE\":\"Món ăn\",\"STATUS\":\"1\",\"0\":2},\"3\":{\"ID\":\"8\",\"NAME\":\"Bia Tiger\'s Milk\",\"PRICE\":\"150000\",\"IMAGE\":\"..\\/upload\\/49a1c83a2e456dc4d85238055742aa6a.jpg\",\"DESCRIPTION\":\"Bia Tiger\'s Milk 2019\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":4}}'),
(13, 1, 2020, 510000, 6, '2020-01-11', '04:37:22 pm', '[{\"PEOPLE\":\"1\",\"TABLE\":\"Bàn 14\"},{\"ID\":\"2\",\"NAME\":\"Gong Cha\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/Milk-Foam-Jasmine-Tea-600x600.jpg\",\"DESCRIPTION\":\"Gong Cha là 1 loại Gong Cha\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":1},{\"ID\":\"3\",\"NAME\":\"Trà sữa KOI\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/teens-hung-tron-bao-lon-bo-tra-sua-latte-koi-the-do-ap-vao-cac-chi-nhanh-o-sai-gon-e30ee6b0636316728742360594.jpg\",\"DESCRIPTION\":\"Trà sữa KOI 2019\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":2},{\"ID\":\"6\",\"NAME\":\"Gà rán\",\"PRICE\":\"150000\",\"IMAGE\":\"..\\/upload\\/mo-quan-ga-ran.jpg\",\"DESCRIPTION\":\"Gà rán KFC\",\"TYPE\":\"Món ăn\",\"STATUS\":\"1\",\"0\":3}]'),
(14, 6, 2020, 100000, 5, '2020-06-02', '09:50:16 pm', '[{\"PEOPLE\":\"1\",\"TABLE\":\"Bàn 5\"},{\"ID\":\"2\",\"NAME\":\"Gong Cha\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/Milk-Foam-Jasmine-Tea-600x600.jpg\",\"DESCRIPTION\":\"Gong Cha là 1 loại Gong Cha\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":1},{\"ID\":\"3\",\"NAME\":\"Trà sữa KOI\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/teens-hung-tron-bao-lon-bo-tra-sua-latte-koi-the-do-ap-vao-cac-chi-nhanh-o-sai-gon-e30ee6b0636316728742360594.jpg\",\"DESCRIPTION\":\"Trà sữa KOI 2019\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":4}]'),
(15, 7, 2020, 135000, 7, '2020-07-18', '03:33:07 pm', '[{\"PEOPLE\":\"1\",\"TABLE\":\"Bàn 11\"},{\"ID\":\"1\",\"NAME\":\"Trà Đào\",\"PRICE\":\"15000\",\"IMAGE\":\"..\\/upload\\/tradao-thaomoc.jpg\",\"DESCRIPTION\":\"\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":1},{\"ID\":\"2\",\"NAME\":\"Gong Cha\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/Milk-Foam-Jasmine-Tea-600x600.jpg\",\"DESCRIPTION\":\"Gong Cha là 1 loại Gong Cha\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":4},{\"ID\":\"3\",\"NAME\":\"Trà sữa KOI\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/teens-hung-tron-bao-lon-bo-tra-sua-latte-koi-the-do-ap-vao-cac-chi-nhanh-o-sai-gon-e30ee6b0636316728742360594.jpg\",\"DESCRIPTION\":\"Trà sữa KOI 2019\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":2}]'),
(16, 7, 2020, 1501575000, 10014, '2020-07-18', '04:06:33 pm', '[{\"PEOPLE\":\"1\",\"TABLE\":\"Bàn 15\"},{\"ID\":\"1\",\"NAME\":\"Trà Đào\",\"PRICE\":\"15000\",\"IMAGE\":\"..\\/upload\\/tradao-thaomoc.jpg\",\"DESCRIPTION\":\"\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":1},{\"ID\":\"2\",\"NAME\":\"Gong Cha\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/Milk-Foam-Jasmine-Tea-600x600.jpg\",\"DESCRIPTION\":\"Gong Cha là 1 loại Gong Cha\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":2},{\"ID\":\"3\",\"NAME\":\"Trà sữa KOI\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/teens-hung-tron-bao-lon-bo-tra-sua-latte-koi-the-do-ap-vao-cac-chi-nhanh-o-sai-gon-e30ee6b0636316728742360594.jpg\",\"DESCRIPTION\":\"Trà sữa KOI 2019\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":1},{\"ID\":\"6\",\"NAME\":\"Gà rán\",\"PRICE\":\"150000\",\"IMAGE\":\"..\\/upload\\/mo-quan-ga-ran.jpg\",\"DESCRIPTION\":\"Gà rán KFC\",\"TYPE\":\"Món ăn\",\"STATUS\":\"1\",\"0\":10000},{\"ID\":\"8\",\"NAME\":\"Bia Tiger\'s Milk\",\"PRICE\":\"150000\",\"IMAGE\":\"..\\/upload\\/49a1c83a2e456dc4d85238055742aa6a.jpg\",\"DESCRIPTION\":\"Bia Tiger\'s Milk 2019\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":10}]'),
(17, 7, 2020, 95000, 5, '2020-07-25', '03:47:17 pm', '[{\"PEOPLE\":\"1\",\"TABLE\":\"Bàn 10\"},{\"ID\":\"1\",\"NAME\":\"Trà Đào\",\"PRICE\":\"15000\",\"IMAGE\":\"..\\/upload\\/tradao-thaomoc.jpg\",\"DESCRIPTION\":\"\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":1},{\"ID\":\"2\",\"NAME\":\"Gong Cha\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/Milk-Foam-Jasmine-Tea-600x600.jpg\",\"DESCRIPTION\":\"Gong Cha là 1 loại Gong Cha\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":3},{\"ID\":\"3\",\"NAME\":\"Trà sữa KOI\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/teens-hung-tron-bao-lon-bo-tra-sua-latte-koi-the-do-ap-vao-cac-chi-nhanh-o-sai-gon-e30ee6b0636316728742360594.jpg\",\"DESCRIPTION\":\"Trà sữa KOI 2019\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":1}]'),
(18, 7, 2020, 220000, 11, '2020-07-25', '03:49:26 pm', '[{\"PEOPLE\":\"1\",\"TABLE\":\"Bàn 9\"},{\"ID\":\"2\",\"NAME\":\"Gong Cha\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/Milk-Foam-Jasmine-Tea-600x600.jpg\",\"DESCRIPTION\":\"Gong Cha là 1 loại Gong Cha\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":1},{\"ID\":\"3\",\"NAME\":\"Trà sữa KOI\",\"PRICE\":\"20000\",\"IMAGE\":\"..\\/upload\\/teens-hung-tron-bao-lon-bo-tra-sua-latte-koi-the-do-ap-vao-cac-chi-nhanh-o-sai-gon-e30ee6b0636316728742360594.jpg\",\"DESCRIPTION\":\"Trà sữa KOI 2019\",\"TYPE\":\"Đồ uống\",\"STATUS\":\"1\",\"0\":10}]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`ID`);

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
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reports_revenue`
--
ALTER TABLE `reports_revenue`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
