-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 23, 2022 at 12:07 PM
-- Server version: 8.0.28-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pims`
--

-- --------------------------------------------------------

--
-- Table structure for table `accont2`
--

CREATE TABLE `accont2` (
  `accId` int NOT NULL,
  `balance` int NOT NULL,
  `supId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accont2`
--

INSERT INTO `accont2` (`accId`, `balance`, `supId`) VALUES
(11, -850000, 24),
(12, -1100000, 25);

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `accId` int NOT NULL,
  `balance` int NOT NULL,
  `cid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`accId`, `balance`, `cid`) VALUES
(8, 299000, 13),
(9, 0, 14);

-- --------------------------------------------------------

--
-- Table structure for table `bidhaa`
--

CREATE TABLE `bidhaa` (
  `bid` int NOT NULL,
  `bname` varchar(50) NOT NULL,
  `maelezo` varchar(50) NOT NULL,
  `buyprice` int NOT NULL,
  `sellprice` int NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bidhaa`
--

INSERT INTO `bidhaa` (`bid`, `bname`, `maelezo`, `buyprice`, `sellprice`, `status`) VALUES
(20, 'Belly Azam', 'Belly', 50000, 55000, 'active'),
(21, 'Ikram', 'Basmat', 110000, 110000, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int NOT NULL,
  `category_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cid` int NOT NULL,
  `fname` varchar(20) NOT NULL,
  `mname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `location` varchar(30) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cid`, `fname`, `mname`, `lname`, `location`, `status`) VALUES
(10, 'Kireko', 'Kireko', 'Kireko', 'Kmaiti', 'active'),
(11, 'Lukman', 'Luku', 'Lukman', 'Kmaiti', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `customer2`
--

CREATE TABLE `customer2` (
  `cid` int NOT NULL,
  `fname` varchar(20) NOT NULL,
  `mname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `location` varchar(30) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer2`
--

INSERT INTO `customer2` (`cid`, `fname`, `mname`, `lname`, `location`, `status`) VALUES
(13, 'Hamza', 'H', 'Hamza', 'Kwerekwe', 'active'),
(14, 'Charangi', 'R', 'Charangi', 'Shimoni', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `customer_account`
--

CREATE TABLE `customer_account` (
  `cust_account_id` bigint NOT NULL,
  `custid` int NOT NULL,
  `transactiondate` date NOT NULL,
  `description` varchar(200) NOT NULL,
  `debit` decimal(10,0) NOT NULL,
  `credit` decimal(10,0) NOT NULL,
  `balance` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer_account`
--

INSERT INTO `customer_account` (`cust_account_id`, `custid`, `transactiondate`, `description`, `debit`, `credit`, `balance`) VALUES
(3, 13, '2022-04-09', '1000', '1000', '0', '1000'),
(4, 13, '2022-04-09', '2000', '2000', '0', '3000'),
(5, 13, '2022-04-14', '8000', '8000', '0', '11000'),
(6, 13, '2022-04-14', '11000', '11000', '0', '22000'),
(7, 13, '2022-04-18', '4000', '4000', '0', '26000'),
(8, 13, '2022-04-18', '1000', '0', '1000', '25000'),
(9, 13, '2022-04-18', '5000', '0', '5000', '20000'),
(10, 13, '2022-04-18', '10000', '0', '10000', '10000'),
(11, 13, '2022-04-18', '1000', '0', '1000', '9000'),
(12, 13, '2022-04-18', 'malipo', '0', '1000', '8000'),
(13, 13, '2022-04-18', '12000', '12000', '0', '20000'),
(14, 14, '2022-04-21', '6000', '6000', '0', '6000'),
(15, 14, '2022-04-21', 'malipo', '0', '3000', '3000');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `oid` int NOT NULL,
  `odate` date NOT NULL,
  `cid` int NOT NULL,
  `customerId` int NOT NULL,
  `ordertype` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`oid`, `odate`, `cid`, `customerId`, `ordertype`) VALUES
(35, '2022-04-02', 10, 13, 'credit'),
(36, '2022-04-02', 10, 13, 'credit'),
(37, '2022-04-09', 10, 13, 'credit'),
(38, '2022-04-09', 10, 13, 'credit'),
(39, '2022-04-09', 10, 13, 'credit'),
(40, '2022-04-09', 11, 13, 'credit'),
(41, '2022-04-09', 11, 13, 'credit'),
(42, '2022-04-09', 10, 13, 'credit'),
(43, '2022-04-09', 10, 13, 'credit'),
(44, '2022-04-09', 10, 13, 'credit'),
(45, '2022-04-09', 11, 13, 'credit'),
(46, '2022-04-14', 10, 13, 'credit'),
(47, '2022-04-14', 10, 13, 'credit'),
(48, '2022-04-18', 10, 13, 'credit'),
(49, '2022-04-18', 10, 13, 'credit'),
(50, '2022-04-21', 10, 14, 'credit');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `odid` int NOT NULL,
  `bid` int NOT NULL,
  `oid` int NOT NULL,
  `price` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`odid`, `bid`, `oid`, `price`, `quantity`) VALUES
(54, 20, 35, 50000, 1),
(55, 20, 36, 50000, 5),
(56, 20, 37, 1000, 3),
(57, 20, 38, 1000, 1),
(58, 20, 39, 2000, 2),
(59, 20, 40, 1000, 1),
(60, 20, 41, 1000, 1),
(61, 20, 42, 1000, 1),
(62, 20, 43, 1000, 1),
(63, 20, 44, 1000, 1),
(64, 20, 45, 1000, 2),
(65, 21, 46, 4000, 2),
(66, 20, 47, 5000, 2),
(67, 21, 47, 1000, 1),
(68, 20, 48, 2000, 2),
(69, 20, 49, 2000, 6),
(70, 20, 50, 3000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_details_to_supplier`
--

CREATE TABLE `order_details_to_supplier` (
  `odtsid` bigint NOT NULL,
  `otsid` int NOT NULL,
  `bid` int NOT NULL,
  `price` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_to_supplier`
--

CREATE TABLE `order_to_supplier` (
  `otsid` bigint NOT NULL,
  `ordate` date NOT NULL,
  `supId` int NOT NULL,
  `ordertype` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `pid` int NOT NULL,
  `cid` int NOT NULL,
  `amount` int NOT NULL,
  `pdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`pid`, `cid`, `amount`, `pdate`) VALUES
(3, 13, 1000, '2022-04-18');

-- --------------------------------------------------------

--
-- Table structure for table `payment2`
--

CREATE TABLE `payment2` (
  `pid` int NOT NULL,
  `supId` int NOT NULL,
  `amount` int NOT NULL,
  `pdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment2`
--

INSERT INTO `payment2` (`pid`, `supId`, `amount`, `pdate`) VALUES
(4, 24, 50000, '2022-04-02'),
(5, 24, 500000, '2022-04-02'),
(6, 24, 1000000, '2022-04-02');

-- --------------------------------------------------------

--
-- Table structure for table `returnin`
--

CREATE TABLE `returnin` (
  `rid` int NOT NULL,
  `quantity` int NOT NULL,
  `rdate` date NOT NULL,
  `bid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `returnout`
--

CREATE TABLE `returnout` (
  `rid` int NOT NULL,
  `quantity` int NOT NULL,
  `rdate` date NOT NULL,
  `bid` int NOT NULL,
  `supId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `returnout`
--

INSERT INTO `returnout` (`rid`, `quantity`, `rdate`, `bid`, `supId`) VALUES
(2, 10, '2022-01-19', 19, 0),
(3, 10, '2022-01-19', 19, 22);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `sid` int NOT NULL,
  `jinalamtumiaji` varchar(20) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `mname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `address` varchar(30) NOT NULL,
  `nywilayamtumiaji` varchar(50) NOT NULL,
  `role` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`sid`, `jinalamtumiaji`, `fname`, `mname`, `lname`, `gender`, `address`, `nywilayamtumiaji`, `role`, `status`) VALUES
(1, 'ochu', 'othman', 'ali', 'makame', 'male', 'bububu', '243454074baf0893f1786b80196c5b1d', 'boss', 'active'),
(6, 'binabuu', 'Abdalla', 'Abuu', 'Hamad', 'male', 'Gulioni', '24df39639ddbc61699c0ddbd0a05c7d2', 'staff', 'active'),
(7, 'tyreez', 'Tahir', 'Abuu', 'Hamad', 'male', 'Mwanyanya', '4eac0e734b63cc88bef0cdb2111a512e', 'staff', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `sid` int NOT NULL,
  `bid` int NOT NULL,
  `stockin` int NOT NULL,
  `stockout` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`sid`, `bid`, `stockin`, `stockout`) VALUES
(37, 20, 8, 0),
(38, 21, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock2`
--

CREATE TABLE `stock2` (
  `sid2` int NOT NULL,
  `bid` int NOT NULL,
  `stockin` int NOT NULL,
  `sdate` date NOT NULL,
  `supId` int NOT NULL,
  `type` varchar(10) NOT NULL,
  `stockinprice` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock2`
--

INSERT INTO `stock2` (`sid2`, `bid`, `stockin`, `sdate`, `supId`, `type`, `stockinprice`) VALUES
(59, 20, 5, '2022-04-02', 24, 'credit', 60000),
(60, 20, 5, '2022-04-02', 24, 'credit', 50000),
(61, 20, 10, '2022-04-02', 24, 'credit', 50000),
(62, 20, 10, '2022-04-02', 24, 'credit', 50000),
(63, 20, 10, '2022-04-02', 24, 'credit', 60000),
(64, 21, 10, '2022-04-02', 25, 'credit', 110000),
(65, 20, 5, '2022-04-02', 24, 'credit', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supId` int NOT NULL,
  `supname` varchar(30) NOT NULL,
  `location` varchar(30) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supId`, `supname`, `location`, `status`) VALUES
(24, 'Azam', 'Mtoni', 'active'),
(25, 'Bopar ', 'Mlandege', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accont2`
--
ALTER TABLE `accont2`
  ADD PRIMARY KEY (`accId`);

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`accId`);

--
-- Indexes for table `bidhaa`
--
ALTER TABLE `bidhaa`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `customer2`
--
ALTER TABLE `customer2`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `customer_account`
--
ALTER TABLE `customer_account`
  ADD PRIMARY KEY (`cust_account_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`odid`);

--
-- Indexes for table `order_details_to_supplier`
--
ALTER TABLE `order_details_to_supplier`
  ADD PRIMARY KEY (`odtsid`);

--
-- Indexes for table `order_to_supplier`
--
ALTER TABLE `order_to_supplier`
  ADD PRIMARY KEY (`otsid`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `payment2`
--
ALTER TABLE `payment2`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `returnin`
--
ALTER TABLE `returnin`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `returnout`
--
ALTER TABLE `returnout`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`sid`),
  ADD UNIQUE KEY `username` (`jinalamtumiaji`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `stock2`
--
ALTER TABLE `stock2`
  ADD PRIMARY KEY (`sid2`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accont2`
--
ALTER TABLE `accont2`
  MODIFY `accId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `accId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bidhaa`
--
ALTER TABLE `bidhaa`
  MODIFY `bid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customer2`
--
ALTER TABLE `customer2`
  MODIFY `cid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `customer_account`
--
ALTER TABLE `customer_account`
  MODIFY `cust_account_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `oid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `odid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `order_details_to_supplier`
--
ALTER TABLE `order_details_to_supplier`
  MODIFY `odtsid` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_to_supplier`
--
ALTER TABLE `order_to_supplier`
  MODIFY `otsid` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `pid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment2`
--
ALTER TABLE `payment2`
  MODIFY `pid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `returnin`
--
ALTER TABLE `returnin`
  MODIFY `rid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `returnout`
--
ALTER TABLE `returnout`
  MODIFY `rid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `sid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `sid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `stock2`
--
ALTER TABLE `stock2`
  MODIFY `sid2` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
