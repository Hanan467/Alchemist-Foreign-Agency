-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Feb 23, 2024 at 08:39 PM
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
-- Database: `crowdfund`
--

-- --------------------------------------------------------

--
-- Table structure for table `backing`
--

CREATE TABLE `backing` (
  `Backing ID` int(11) NOT NULL,
  `Campaign_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Amount_pledged` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `backing`
--

INSERT INTO `backing` (`Backing ID`, `Campaign_Id`, `User_Id`, `Amount_pledged`, `Timestamp`) VALUES
(1, 2, 3, 25000, '2024-02-18 13:38:27'),
(2, 2, 4, 30000, '2024-02-19 13:16:23'),
(5, 5, 2, 6700, '2024-02-23 18:58:14'),
(6, 5, 4, 6500, '2024-02-23 18:59:27'),
(7, 6, 4, 2300, '2024-02-23 19:01:20'),
(9, 4, 2, 2400, '2024-02-23 19:13:07'),
(10, 4, 4, 5000, '2024-02-23 19:17:16');

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

CREATE TABLE `campaign` (
  `Campaign_Id` int(10) NOT NULL,
  `User_Id` int(10) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `Funding_goal` int(20) NOT NULL,
  `Start_date` date NOT NULL,
  `Image` varchar(20) NOT NULL,
  `Category` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`Campaign_Id`, `User_Id`, `Title`, `Description`, `Funding_goal`, `Start_date`, `Image`, `Category`) VALUES
(2, 2, 'school construction for rural villages in Ethiopia', 'this project is for building preparatory schools in rural Ethiopia', 100000, '2024-02-20', 'download.jpg', 'Eduacation'),
(4, 3, 'Online Coding Bootcamp for High School Students', 'This online coding bootcamp is designed to introduce high school students to the fundamentals of computer programming. Through live coding sessions, projects, and mentorship, participants will gain practical coding skills and prepare for future careers in technology.', 300000, '2024-03-04', 'bootcamp.jpg', 'Eduacation'),
(5, 2, 'Financial Literacy Program for Teens', 'This program teaches teens essential financial literacy skills, including budgeting, saving, investing, and understanding credit. Through interactive workshops and real-life scenarios, participants will gain the knowledge and confidence to make informed financial decisions as they transition into adulthood.', 35000, '2024-02-27', 'finance.jpg', 'Eduacation'),
(6, 2, 'Medical Equipment Donation Drive', ' This project focuses on collecting and donating medical equipment to hospitals and clinics in low-income areas. The donated equipment, such as hospital beds, wheelchairs, and medical supplies, will help healthcare facilities improve their capacity to treat patients and save lives.', 400000, '2024-03-03', 'equipments.jpg', 'Medical');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `Comment Id` int(10) NOT NULL,
  `User Id` int(10) NOT NULL,
  `Campaign Id` int(10) NOT NULL,
  `Comment text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `Profile Id` int(10) NOT NULL,
  `User_Id` int(10) NOT NULL,
  `Profile_picture` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`Profile Id`, `User_Id`, `Profile_picture`) VALUES
(1, 2, 'avatar3.png'),
(2, 3, 'avatar2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `update`
--

CREATE TABLE `update` (
  `Update Id` int(10) NOT NULL,
  `Campaign Id` int(10) NOT NULL,
  `Update text` text NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_Id` int(10) NOT NULL,
  `Username` varchar(7) NOT NULL,
  `First_name` varchar(30) NOT NULL,
  `Last_name` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `Phone_no` int(15) NOT NULL,
  `Birthday` date DEFAULT NULL,
  `Paymenmt detail` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_Id`, `Username`, `First_name`, `Last_name`, `Email`, `Password`, `Phone_no`, `Birthday`, `Paymenmt detail`) VALUES
(2, 'niha47', 'Hanan', 'Ansar', 'hala@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 933695089, '2023-09-29', ''),
(3, 'hila99', 'Hila', 'Ansar', 'hila@gmail.com', '4afd521d77158e02aed37e2274b90c9c', 917931971, '2017-02-14', ''),
(4, 'hasu98', 'Hasinet', 'Ansar', 'hasu@gmail.com', '9e1e06ec8e02f0a0074f2fcc6b26303b', 987654321, '0000-00-00', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `backing`
--
ALTER TABLE `backing`
  ADD PRIMARY KEY (`Backing ID`),
  ADD KEY `backing_ibfk_1` (`Campaign_Id`),
  ADD KEY `backing_ibfk_2` (`User_Id`);

--
-- Indexes for table `campaign`
--
ALTER TABLE `campaign`
  ADD PRIMARY KEY (`Campaign_Id`),
  ADD KEY `campaign_ibfk_1` (`User_Id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`Comment Id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`Profile Id`),
  ADD KEY `profile_ibfk_1` (`User_Id`);

--
-- Indexes for table `update`
--
ALTER TABLE `update`
  ADD PRIMARY KEY (`Update Id`),
  ADD KEY `Campaign Id` (`Campaign Id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `backing`
--
ALTER TABLE `backing`
  MODIFY `Backing ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `campaign`
--
ALTER TABLE `campaign`
  MODIFY `Campaign_Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `Comment Id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `Profile Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `update`
--
ALTER TABLE `update`
  MODIFY `Update Id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `backing`
--
ALTER TABLE `backing`
  ADD CONSTRAINT `backing_ibfk_1` FOREIGN KEY (`Campaign_Id`) REFERENCES `campaign` (`Campaign_Id`),
  ADD CONSTRAINT `backing_ibfk_2` FOREIGN KEY (`User_Id`) REFERENCES `user` (`User_Id`);

--
-- Constraints for table `campaign`
--
ALTER TABLE `campaign`
  ADD CONSTRAINT `campaign_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `user` (`User_Id`);

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `user` (`User_Id`);

--
-- Constraints for table `update`
--
ALTER TABLE `update`
  ADD CONSTRAINT `update_ibfk_1` FOREIGN KEY (`Campaign Id`) REFERENCES `update` (`Update Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
