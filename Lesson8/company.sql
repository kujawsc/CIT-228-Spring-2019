-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2019 at 08:51 PM
-- Server version: 5.7.17
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `company`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contactID` int(11) NOT NULL,
  `fName` varchar(50) DEFAULT NULL,
  `lName` varchar(50) DEFAULT NULL,
  `jobTitle` varchar(50) DEFAULT NULL,
  `busPhone` varchar(15) DEFAULT NULL,
  `mobPhone` varchar(15) DEFAULT NULL,
  `faxNum` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contactID`, `fName`, `lName`, `jobTitle`, `busPhone`, `mobPhone`, `faxNum`, `email`) VALUES
(1, 'John', 'Cracks', 'Pro Moth', '(231)102-5123', '(231)326-3244', '1732573', 'TrueLiar43@gmail.com'),
(2, 'Jill', 'Null', 'Kitchen Manager', '(231)736-5565', '(231)684-2597', '3546846', 'jullnull@gmail.com'),
(3, 'Maddy', 'Sweet', 'Office Assc', '(217)-381-8165', '(231)326-2816', '645286', 'maddy56@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `custID` int(11) NOT NULL,
  `fName` varchar(50) DEFAULT NULL,
  `lName` varchar(50) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `zipCode` int(11) DEFAULT NULL,
  `salesPerson` int(11) DEFAULT NULL,
  `contact` int(11) DEFAULT NULL,
  `webpage` char(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`custID`, `fName`, `lName`, `street`, `zipCode`, `salesPerson`, `contact`, `webpage`) VALUES
(1, 'Mark', 'Tompson', 'Blast Ave', 65432, 1, 1, 'Tompson500.com'),
(2, 'Gort', 'Gorto', 'Saphire Street', 17423, 5, NULL, 'gortgorto.com'),
(3, 'Biggy', 'Wo\'le', 'Ruby Road', 17352, 4, NULL, 'wolebiggy.com'),
(4, 'Manny', 'Crux', 'Tupac Street', 27345, 2, 2, 'crux25.com'),
(5, 'Troy', 'Baka', 'Street Hams', 83457, 1, 3, 'baka.com'),
(6, 'Maddy', 'Goll', 'Blast Ave', 65432, 1, 2, 'goll.com');

-- --------------------------------------------------------

--
-- Table structure for table `saleperson`
--

CREATE TABLE `saleperson` (
  `salePersonID` int(11) NOT NULL,
  `fName` varchar(50) DEFAULT NULL,
  `lName` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saleperson`
--

INSERT INTO `saleperson` (`salePersonID`, `fName`, `lName`) VALUES
(1, 'John', 'Cracks'),
(2, 'Mason', 'Ploon'),
(3, 'Alice', 'Mallice'),
(4, 'Ron', 'Toller'),
(5, 'Kate', 'Mole');

-- --------------------------------------------------------

--
-- Table structure for table `zipcodes`
--

CREATE TABLE `zipcodes` (
  `zipCode` int(11) NOT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zipcodes`
--

INSERT INTO `zipcodes` (`zipCode`, `city`, `state`, `country`) VALUES
(65432, 'Bort', 'Bortzy', 'Bortolia'),
(17352, 'Montree', 'Coldland', 'Canada'),
(83457, 'Detroit', 'Texas', 'America'),
(17423, 'Hawaii', 'Grazni', 'China'),
(27345, 'Nop', 'Fitzy', 'Australia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contactID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`custID`);

--
-- Indexes for table `saleperson`
--
ALTER TABLE `saleperson`
  ADD PRIMARY KEY (`salePersonID`);

--
-- Indexes for table `zipcodes`
--
ALTER TABLE `zipcodes`
  ADD PRIMARY KEY (`zipCode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contactID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `custID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `saleperson`
--
ALTER TABLE `saleperson`
  MODIFY `salePersonID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
