-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2024 at 05:30 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpos`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessright`
--

CREATE TABLE `accessright` (
  `accessID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `accept` int(11) NOT NULL,
  `access` varchar(100) NOT NULL,
  `discounts` int(11) NOT NULL,
  `taxes` int(11) NOT NULL,
  `drawer` int(11) NOT NULL,
  `viewreceipts` int(11) NOT NULL,
  `refunds` int(11) NOT NULL,
  `Reprint` int(11) NOT NULL,
  `shift` int(11) NOT NULL,
  `Manageitem` int(11) NOT NULL,
  `costitem` int(11) NOT NULL,
  `settings` int(11) NOT NULL,
  `bViewsales` int(11) NOT NULL,
  `bmanageitem` int(11) NOT NULL,
  `bviewcost` int(11) NOT NULL,
  `bmanageemployee` int(11) NOT NULL,
  `bmanagecustomers` int(11) NOT NULL,
  `bmanagefeatured` int(11) NOT NULL,
  `bmanagebilling` int(11) NOT NULL,
  `bmanagepayment` int(11) NOT NULL,
  `bmanageloyalty` int(11) NOT NULL,
  `bmanagetaxes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accessright`
--

INSERT INTO `accessright` (`accessID`, `name`, `accept`, `access`, `discounts`, `taxes`, `drawer`, `viewreceipts`, `refunds`, `Reprint`, `shift`, `Manageitem`, `costitem`, `settings`, `bViewsales`, `bmanageitem`, `bviewcost`, `bmanageemployee`, `bmanagecustomers`, `bmanagefeatured`, `bmanagebilling`, `bmanagepayment`, `bmanageloyalty`, `bmanagetaxes`) VALUES
(36, 'asdasd', 0, 'pos,back_office', 1, 1, 0, 1, 0, 1, 0, 0, 1, 0, 0, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(37, 'tbetset', 0, 'pos,back_office', 1, 0, 1, 0, 0, 1, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(38, 't5nyr5fynmdrcy', 0, 'pos,back_office', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 1, 0, 0, 0, 0),
(39, 'thbtcfunftuntfc', 0, 'pos,back_office', 0, 1, 0, 1, 1, 0, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(40, 'r6un6drnur6un', 0, 'pos,back_office', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(41, 'goodshit', 1, 'pos,back_office', 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
(42, 'ayssss', 0, 'pos', 1, 0, 1, 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(46, 'qwerty', 1, 'pos', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendanceID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `clockInTime` datetime NOT NULL,
  `clockOutTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendanceID`, `userID`, `clockInTime`, `clockOutTime`) VALUES
(66, 17, '2024-03-18 13:15:25', '2024-03-18 13:15:33'),
(67, 17, '2024-03-18 13:15:46', '2024-03-18 13:16:03'),
(69, 17, '2024-03-18 15:10:45', '2024-03-18 15:10:55'),
(70, 17, '2024-03-18 15:11:02', NULL),
(71, 17, '2024-03-19 05:41:22', NULL),
(72, 17, '2024-03-19 07:36:05', '2024-03-19 08:03:16'),
(73, 17, '2024-03-19 08:03:23', '2024-03-19 08:04:26'),
(74, 17, '2024-03-19 08:04:31', NULL),
(75, 17, '2024-03-26 08:09:15', '2024-03-26 10:02:50'),
(76, 17, '2024-03-26 10:02:52', '2024-03-26 10:17:50'),
(77, 17, '2024-03-26 10:17:56', '2024-03-26 10:41:14'),
(78, 17, '2024-03-26 10:41:20', '2024-03-26 11:19:42'),
(79, 17, '2024-03-26 12:37:33', '2024-03-26 12:37:36'),
(80, 17, '2024-03-26 12:37:41', '2024-03-26 13:43:59'),
(82, 17, '2024-03-26 19:08:30', '2024-03-26 19:08:40'),
(83, 17, '2024-03-26 19:08:58', NULL),
(84, 17, '2024-03-28 13:52:39', NULL),
(85, 17, '2024-03-30 09:53:22', NULL),
(86, 17, '2024-03-31 11:02:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emp`
--

CREATE TABLE `emp` (
  `userID` int(11) NOT NULL,
  `Fullname` varchar(100) NOT NULL,
  `AppliedRole` varchar(100) NOT NULL,
  `Date` date NOT NULL,
  `accessID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp`
--

INSERT INTO `emp` (`userID`, `Fullname`, `AppliedRole`, `Date`, `accessID`) VALUES
(2, 'ferrr', 'Administrator', '2024-03-01', 0),
(10, 'yiiiii', 'Manager', '2024-03-18', 25),
(12, 'gtrbtyb', 'Cashier', '2024-03-18', 24),
(13, 'ebtxdtntb', 'Cashier', '2024-03-18', 23);

-- --------------------------------------------------------

--
-- Table structure for table `timecards`
--

CREATE TABLE `timecards` (
  `timeid` int(11) NOT NULL,
  `clockOut` datetime NOT NULL,
  `employeeID` varchar(100) NOT NULL,
  `store` varchar(100) DEFAULT NULL,
  `totalHours` varchar(100) NOT NULL,
  `clockIn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timecards`
--

INSERT INTO `timecards` (`timeid`, `clockOut`, `employeeID`, `store`, `totalHours`, `clockIn`) VALUES
(1, '2024-03-22 07:14:00', '2', 'jabi', '330', '2024-03-08 07:14:00'),
(2, '2024-03-15 07:31:00', '7', 'mcdo', '144', '2024-03-09 07:31:00'),
(3, '2024-03-19 02:43:00', '2', NULL, '9', '2024-03-19 11:43:00'),
(4, '2024-03-19 21:43:00', '2', NULL, '12', '2024-03-19 09:43:00'),
(5, '2024-03-19 11:49:00', '10', NULL, '5', '2024-03-19 09:49:00'),
(6, '2024-03-19 21:55:00', '7', NULL, '12', '2024-03-19 09:55:00'),
(7, '2024-03-19 17:07:00', '10', NULL, '7', '2024-03-19 10:07:00'),
(8, '2024-03-19 11:11:00', '15', NULL, '1.02', '2024-03-19 10:10:00'),
(9, '2024-03-26 08:50:00', '7', NULL, '0.02', '2024-03-26 08:49:00'),
(10, '2024-03-26 08:51:00', '2', NULL, '0.03', '2024-03-26 08:49:00'),
(11, '2024-03-26 08:52:00', '2', NULL, '0.05', '2024-03-26 08:49:00'),
(12, '2024-03-26 08:53:00', '2', NULL, '0.07', '2024-03-26 08:49:00'),
(13, '2024-03-26 08:56:00', '2', NULL, '0.07', '2024-03-26 08:52:00'),
(14, '2024-03-26 08:53:00', '2', NULL, '0.03', '2024-03-26 08:51:00'),
(15, '2024-03-26 09:52:00', '2', NULL, '1', '2024-03-26 08:52:00'),
(16, '2024-03-26 11:52:00', '2', NULL, '3', '2024-03-26 08:52:00'),
(17, '2024-03-26 08:58:00', '2', NULL, '0.03', '2024-03-26 08:56:00'),
(18, '2024-03-26 19:09:00', '7', NULL, '0.07', '2024-03-26 19:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `usercredential`
--

CREATE TABLE `usercredential` (
  `userID` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `levelofaccess` int(11) NOT NULL,
  `accessID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usercredential`
--

INSERT INTO `usercredential` (`userID`, `username`, `password`, `levelofaccess`, `accessID`) VALUES
(17, 'fer', '$2y$10$22LvslwIbEiqNiab0pt1DO0/Q2bMMurAAtktijM3rDw3wQc6EV4F6', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `userinformation`
--

CREATE TABLE `userinformation` (
  `userID` int(11) NOT NULL,
  `FirstName` text NOT NULL,
  `MiddleName` text NOT NULL,
  `LastName` text NOT NULL,
  `Address` text NOT NULL,
  `DateofBirth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessright`
--
ALTER TABLE `accessright`
  ADD PRIMARY KEY (`accessID`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendanceID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `emp`
--
ALTER TABLE `emp`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `timecards`
--
ALTER TABLE `timecards`
  ADD PRIMARY KEY (`timeid`);

--
-- Indexes for table `usercredential`
--
ALTER TABLE `usercredential`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `userinformation`
--
ALTER TABLE `userinformation`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessright`
--
ALTER TABLE `accessright`
  MODIFY `accessID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `emp`
--
ALTER TABLE `emp`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `timecards`
--
ALTER TABLE `timecards`
  MODIFY `timeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `usercredential`
--
ALTER TABLE `usercredential`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `userinformation`
--
ALTER TABLE `userinformation`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `usercredential` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
