-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Sep 13, 2020 at 04:46 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `bid` int(2) NOT NULL,
  `brandname` varchar(50) NOT NULL,
  `status` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`bid`, `brandname`, `status`) VALUES
(1, 'HP', 1),
(2, 'asus', 1),
(4, 'acer', 1),
(5, 'dell', 1),
(12, 'Apple', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cid` int(2) NOT NULL,
  `catname` varchar(50) NOT NULL,
  `parent_cat` tinyint(2) NOT NULL,
  `status` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cid`, `catname`, `parent_cat`, `status`) VALUES
(3, 'Electronics', 0, 1),
(15, 'Hardware', 0, 1),
(17, 'Gadgets', 0, 1),
(18, 'Mobile', 3, 1),
(19, 'Laptop', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_no` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `order_date` date NOT NULL,
  `sub_total` double NOT NULL,
  `gst` double NOT NULL,
  `discount` double NOT NULL,
  `net_total` double NOT NULL,
  `paid` double NOT NULL,
  `due` double NOT NULL,
  `payment_type` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_no`, `customer_name`, `order_date`, `sub_total`, `gst`, `discount`, `net_total`, `paid`, `due`, `payment_type`) VALUES
(17, 'shahi bahi ', '2020-11-09', 56, 10.08, 0, 66.08, 231.08, 0, 'Cash'),
(18, 'hamid', '2020-11-09', 128, 23.04, 0, 151.04, 151.04, 0, 'Cash'),
(19, 'shawon', '2020-11-09', 28, 5.04, 0, 33.04, 133.04, 0, 'Cash'),
(20, 'Asikur Rahman', '2020-12-09', 323, 58.14, 0, 381.14, 382.13, 0, 'Cash'),
(21, 'shahin', '0000-00-00', 3778.7200000000003, 680.1696000000001, 0, 4458.8896, 4458.88, 0.009600000000318687, 'Card'),
(22, 'shahin', '0000-00-00', 101453.72, 18261.6696, 100, 119615.3896, 119615.38, 0, 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `invoice_no`, `product_name`, `price`, `qty`) VALUES
(7, 17, 'Asus E203MAH Celeron Dual Core 11.6\" HD Laptop', 28, 1),
(8, 17, 'Asus E203MAH Celeron Dual Core 11.6\" HD Laptop', 28, 1),
(9, 18, 'Asus E203MAH Celeron Dual Core 11.6\" HD Laptop', 28, 1),
(10, 18, 'keyboard', 100, 1),
(11, 19, 'Asus E203MAH Celeron Dual Core 11.6\" HD Laptop', 28, 1),
(12, 20, 'Asus E203MAH Celeron Dual Core 11.6\" HD Laptop', 28, 4),
(13, 20, 'keyboard', 100, 1),
(14, 20, 'Nikon', 111, 1),
(15, 21, 'demo product 1', 500, 5),
(16, 21, 'Asus E203MAH Celeron Dual Core 11.6\" HD Laptop', 28, 2),
(17, 22, 'test 11', 50005, 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(2) NOT NULL,
  `cid` int(2) NOT NULL,
  `bid` int(2) NOT NULL,
  `productname` varchar(150) NOT NULL,
  `price` double(10,2) NOT NULL,
  `quantity` int(2) NOT NULL,
  `added_date` date NOT NULL,
  `status` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `cid`, `bid`, `productname`, `price`, `quantity`, `added_date`, `status`) VALUES
(3, 19, 2, 'Asus VivoBook N580', 500.86, 100, '2020-09-10', 1),
(4, 20, 2, 'Speker', 111.00, 98, '2020-09-10', 1),
(5, 19, 5, 'Black Laptop', 500.86, 100, '2020-09-10', 1),
(6, 18, 5, 'Telephone', 110.00, 100, '2020-09-10', 1),
(7, 19, 12, 'Nikon', 111.00, 0, '2020-09-10', 1),
(8, 20, 4, 'keyboard', 100.00, 39, '2020-09-11', 1),
(9, 19, 2, 'Asus X441MA Celeron Dual Core 14.0\" HD Laptop', 26.00, 48, '2020-09-11', 1),
(10, 19, 2, 'Asus E203MAH Celeron Dual Core 11.6\" HD Laptop', 28.00, 36, '2020-09-11', 1),
(11, 19, 12, 'demo product 1', 500.00, 5, '2020-09-13', 1),
(12, 17, 5, 'test 11', 50005.00, 199, '2020-09-13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(2) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `usertype` varchar(28) NOT NULL,
  `reg-date` date NOT NULL,
  `last-login` datetime NOT NULL,
  `notes` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `usertype`, `reg-date`, `last-login`, `notes`) VALUES
(1, 'Anisur Rahman', 'shahin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', '2020-09-06', '2020-09-13 12:14:24', ''),
(2, 'akkar', 'aa@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', '2020-09-06', '2020-09-06 00:00:00', ''),
(3, 'wwwwww', 'a@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', '2020-09-06', '2020-09-06 00:00:00', ''),
(4, 'ddddddd', 'w@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', '2020-09-06', '2020-09-06 00:00:00', ''),
(5, 'test', 'rizwan@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Other', '2020-09-06', '2020-09-09 07:19:39', ''),
(6, 'ddddddddddddd', 'd@gmail.com', '631577fc0428c1dbc6176a3ca5935f77', 'Admin', '2020-09-06', '2020-09-06 00:00:00', ''),
(7, 'd@gmail.com', 'dc@gmail.com', '631577fc0428c1dbc6176a3ca5935f77', 'Admin', '2020-09-06', '2020-09-06 00:00:00', ''),
(8, 'Asik Newaz', 'asik@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', 'Other', '2020-09-06', '2020-09-06 01:55:55', ''),
(9, 'Asik Newaz', 'asik3#@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Other', '2020-09-13', '2020-09-13 01:25:36', ''),
(10, 'Asik Newaz', 'asik1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Other', '2020-09-13', '2020-09-13 01:28:17', ''),
(11, 'Asik newaz', 'asik111@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Other', '2020-09-13', '2020-09-13 01:53:44', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`bid`),
  ADD UNIQUE KEY `brandname` (`brandname`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `cat_name` (`catname`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_no`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_no` (`invoice_no`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`),
  ADD UNIQUE KEY `productname` (`productname`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `bid` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cid` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD CONSTRAINT `invoice_details_ibfk_1` FOREIGN KEY (`invoice_no`) REFERENCES `invoice` (`invoice_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
