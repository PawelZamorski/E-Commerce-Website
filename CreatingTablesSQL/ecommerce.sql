-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2018 at 12:39 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`) VALUES
(20, 'Jeans'),
(21, 'Polo'),
(22, 'Jacket'),
(23, 'Trouser'),
(24, 'Blouse'),
(25, 'Sweater'),
(26, 'Shirt');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `clientID` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `county` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `zipCode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`clientID`, `login`, `password`, `firstName`, `lastName`, `address`, `city`, `county`, `country`, `zipCode`) VALUES
(1, 'user@user.com', 'user', 'user', 'user', 'user', 'Galway', 'Galway', 'Ireland', 'ed57-dg7');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `genderID` int(11) NOT NULL,
  `genderName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`genderID`, `genderName`) VALUES
(1, 'men'),
(2, 'women');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productDescription` varchar(255) DEFAULT NULL,
  `genderID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `productIMG` varchar(255) DEFAULT NULL,
  `price` decimal(7,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productName`, `productDescription`, `genderID`, `categoryID`, `productIMG`, `price`, `quantity`) VALUES
(101, 'DARK WASH SLIM 1', 'Jeans description', 1, 20, 'image/productImg/men/jeans/101', '28.30', 10),
(102, 'Jeans super  2', 'Jeans description', 1, 20, 'image/productImg/men/jeans/102', '45.30', 10),
(103, 'Jeans slim 3 ', 'Jeans description', 1, 20, 'image/productImg/men/jeans/103', '23.74', 10),
(104, 'Jeans super 4', 'Jeans description', 1, 20, 'image/productImg/men/jeans/101', '45.30', 10),
(105, 'Jeans slim 5', 'Jeans description', 1, 20, 'image/productImg/men/jeans/101', '23.74', 10),
(106, 'Jeans super 6', 'Jeans description', 1, 20, 'image/productImg/men/jeans/101', '45.30', 10),
(107, 'Jeans slim 7', 'Jeans description', 1, 20, 'image/productImg/men/jeans/101', '23.74', 10),
(108, 'Jeans super 8', 'Jeans description', 1, 20, 'image/productImg/men/jeans/101', '45.30', 10),
(109, 'Jeans slim 9', 'Jeans description', 1, 20, 'image/productImg/men/jeans/101', '23.74', 10),
(110, 'Sweater 1', 'Sweater description', 2, 25, 'image/productImg/women/sweater/101', '38.30', 8),
(111, 'Polo 1', 'Polo description', 1, 21, 'image/productImg/men/polo/101', '15.15', 10),
(112, 'Shirt 1', 'Shirt description', 1, 26, 'image/productImg/men/shirt/101', '18.23', 10),
(113, 'Blouse 1', 'Blouse description', 2, 24, 'image/productImg/women/blouse/101', '78.30', 10),
(114, 'Trouser 1', 'Trouser description', 2, 23, 'image/productImg/women/trouser/101', '28.30', 10),
(115, 'Jacket 1', 'Jacket description', 2, 22, 'image/productImg/women/jacket/101', '21.00', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`clientID`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`genderID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `genderID` (`genderID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`genderID`) REFERENCES `gender` (`genderID`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
