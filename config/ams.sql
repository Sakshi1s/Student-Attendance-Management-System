-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2022 at 04:38 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ams`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `student_view`
-- (See below for the actual view)
--
CREATE TABLE `student_view` (
`id` int(32)
,`sname` varchar(50)
,`prn` varchar(50)
,`sem` int(5)
);

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `name`, `email`, `password`) VALUES
(3, 'Ganesh', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500'),
(4, 'Mahesh', 'admin@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `tblattendance`
--

CREATE TABLE `tblattendance` (
  `ID` int(32) NOT NULL,
  `name` varchar(50) NOT NULL,
  `prn` varchar(50) NOT NULL,
  `sem` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `status` int(10) NOT NULL,
  `date` date NOT NULL,
  `takenby` varchar(100) NOT NULL,
  `branch` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblattendance`
--

INSERT INTO `tblattendance` (`ID`, `name`, `prn`, `sem`, `subject`, `status`, `date`, `takenby`, `branch`) VALUES
(1, 'Mahesh', '2046491245021', '5', 'TOC', 1, '2022-11-02', 'Mahesh', 1),
(4, 'Ganesh', '2046491245017', '5', 'HCI', 1, '2022-11-02', 'Mahesh', 1),
(44, 'Ganesh', '2046491245017', '5', 'Chemistry', 0, '2022-12-18', 'Yash Wadatkar', 1),
(45, 'Mahesh', '2046491245021', '5', 'Chemistry', 0, '2022-12-18', 'Yash Wadatkar', 1),
(46, 'Shantanu', '2046491245045', '5', 'Chemistry', 0, '2022-12-18', 'Yash Wadatkar', 1),
(47, 'Tilak Talwekar', '2046491245055', '5', 'Chemistry', 0, '2022-12-18', 'Yash Wadatkar', 1),
(48, 'Yash', '2046491245063', '5', 'Chemistry', 0, '2022-12-18', 'Yash Wadatkar', 1),
(49, 'Ganesh', '2046491245017', '5', 'DS', 0, '2022-12-18', 'Mahesh Rohane', 1),
(50, 'Mahesh', '2046491245021', '5', 'DS', 0, '2022-12-18', 'Mahesh Rohane', 1),
(51, 'Shantanu', '2046491245045', '5', 'DS', 0, '2022-12-18', 'Mahesh Rohane', 1),
(52, 'Tilak Talwekar', '2046491245055', '5', 'DS', 0, '2022-12-18', 'Mahesh Rohane', 1),
(53, 'Yash', '2046491245063', '5', 'DS', 0, '2022-12-18', 'Mahesh Rohane', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblbranch`
--

CREATE TABLE `tblbranch` (
  `ID` int(32) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `bname` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblbranch`
--

INSERT INTO `tblbranch` (`ID`, `branch`, `bname`) VALUES
(1, 'CS', 'Computer Engineering'),
(2, 'EE', 'Electrical Engineering'),
(3, 'ME', 'Mechanical Engineering'),
(4, 'CVE', 'Civil Engineering'),
(5, 'ALLB', 'All Branch');

-- --------------------------------------------------------

--
-- Table structure for table `tblcalattendance`
--

CREATE TABLE `tblcalattendance` (
  `CTID` int(32) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `subject` varchar(20) NOT NULL,
  `sem` varchar(10) NOT NULL,
  `branch` varchar(20) NOT NULL,
  `percentage` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcalattendance`
--

INSERT INTO `tblcalattendance` (`CTID`, `sname`, `subject`, `sem`, `branch`, `percentage`) VALUES
(1, 'Mahesh', 'TOC', '5', '1', '90.00'),
(2, 'Mahesh', 'HCI', '5', '1', '90.00');

-- --------------------------------------------------------

--
-- Table structure for table `tblclass`
--

CREATE TABLE `tblclass` (
  `ID` int(11) NOT NULL,
  `nsem` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblclass`
--

INSERT INTO `tblclass` (`ID`, `nsem`) VALUES
(1, '1st'),
(2, '2nd'),
(3, '3rd'),
(4, '4th'),
(5, '5th'),
(6, '6th'),
(7, '7th'),
(8, '8th');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudent`
--

CREATE TABLE `tblstudent` (
  `ID` int(32) NOT NULL,
  `prn` varchar(50) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `sem` int(5) NOT NULL,
  `branch` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblstudent`
--

INSERT INTO `tblstudent` (`ID`, `prn`, `sname`, `email`, `sem`, `branch`) VALUES
(15, '2046491245021', 'Mahesh', 'abc@gmail.com', 5, '1'),
(16, '2046491245045', 'Shantanu', 'spp@gmail.com', 5, '1'),
(17, '2046491245017', 'Ganesh', 'ggg@bitwardha.ac.in', 5, '1'),
(18, '2046491245063', 'Yash', 'ymw@bitwardha.ac.in', 5, '1'),
(406, '2046491245055', 'Tilak Talwekar', 'tat@gmail.com', 5, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubject`
--

CREATE TABLE `tblsubject` (
  `SID` int(32) NOT NULL,
  `name` varchar(50) NOT NULL,
  `branch` int(30) NOT NULL,
  `sem` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblsubject`
--

INSERT INTO `tblsubject` (`SID`, `name`, `branch`, `sem`) VALUES
(14, 'SE', 1, 4),
(15, 'DS', 1, 3),
(17, 'BCom', 1, 5),
(18, 'DM', 1, 3),
(19, 'DBS', 1, 5),
(21, 'OS', 5, 4),
(22, 'Chemistry', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblteacher`
--

CREATE TABLE `tblteacher` (
  `tid` int(32) NOT NULL,
  `tname` varchar(50) NOT NULL,
  `temail` varchar(50) NOT NULL,
  `tpassword` varchar(50) NOT NULL,
  `branch` int(32) NOT NULL,
  `sem` int(23) NOT NULL,
  `subject` int(23) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblteacher`
--

INSERT INTO `tblteacher` (`tid`, `tname`, `temail`, `tpassword`, `branch`, `sem`, `subject`) VALUES
(1, 'Mahesh Rohane', 'abc@gmail.com', 'd31289dba4dbc7835e14244ce6cf5fb5', 1, 5, 15),
(2, 'Ganesh', 'ggg@gmail.com', 'b4af804009cb036a4ccdc33431ef9ac9', 2, 3, 15),
(3, 'Shantanu', 'spp@gmail.com', '3a790e20402f211bdb52a2a4946e391e', 1, 3, 18),
(5, 'Yash Wadatkar', 'ymw@gmail.com', 'ae2aa4267b605d1bf8c8e1438aa3f1fe', 2, 5, 22),
(6, 'Ramesh Hane', 'ram@gmail.com', 'tea#1234', 1, 5, 25);

-- --------------------------------------------------------

--
-- Structure for view `student_view`
--
DROP TABLE IF EXISTS `student_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `student_view`  AS SELECT `tblstudent`.`ID` AS `id`, `tblstudent`.`sname` AS `sname`, `tblstudent`.`prn` AS `prn`, `tblstudent`.`sem` AS `sem` FROM `tblstudent``tblstudent`  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblattendance`
--
ALTER TABLE `tblattendance`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblbranch`
--
ALTER TABLE `tblbranch`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcalattendance`
--
ALTER TABLE `tblcalattendance`
  ADD PRIMARY KEY (`CTID`);

--
-- Indexes for table `tblclass`
--
ALTER TABLE `tblclass`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblstudent`
--
ALTER TABLE `tblstudent`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblsubject`
--
ALTER TABLE `tblsubject`
  ADD PRIMARY KEY (`SID`);

--
-- Indexes for table `tblteacher`
--
ALTER TABLE `tblteacher`
  ADD PRIMARY KEY (`tid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblattendance`
--
ALTER TABLE `tblattendance`
  MODIFY `ID` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tblbranch`
--
ALTER TABLE `tblbranch`
  MODIFY `ID` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblcalattendance`
--
ALTER TABLE `tblcalattendance`
  MODIFY `CTID` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblclass`
--
ALTER TABLE `tblclass`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblstudent`
--
ALTER TABLE `tblstudent`
  MODIFY `ID` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=517;

--
-- AUTO_INCREMENT for table `tblsubject`
--
ALTER TABLE `tblsubject`
  MODIFY `SID` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tblteacher`
--
ALTER TABLE `tblteacher`
  MODIFY `tid` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
