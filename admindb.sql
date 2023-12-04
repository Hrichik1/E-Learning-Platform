-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2023 at 08:24 PM
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
-- Database: `admindb`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminregdb`
--

CREATE TABLE `adminregdb` (
  `name` varchar(25) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(10) NOT NULL,
  `pass` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminregdb`
--

INSERT INTO `adminregdb` (`name`, `email`, `username`, `pass`) VALUES
('Hrichik Paul', 'hrichik.paul69@gmail.com', 'ankan', '12'),
('Sadman', 'saddu@mail.com', 'sadman12', 'sad'),
('Nirvik', 'nirvik@gmail.com', 'nirvik', '123'),
('Rifat Chowdhury', 'rifat123@gmail.com', 'fami', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `all_courses`
--

CREATE TABLE `all_courses` (
  `Courses` varchar(50) NOT NULL,
  `Time` time(4) NOT NULL,
  `ID` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `all_courses`
--

INSERT INTO `all_courses` (`Courses`, `Time`, `ID`) VALUES
('ACCOUNTING ', '10:30:00.0000', 1001),
('DIGITAL LOGIC AND CIRCUIT ', '11:00:00.0000', 2001),
('PROGRAMMING IN PYTHO', '12:00:00.0000', 1011);

-- --------------------------------------------------------

--
-- Table structure for table `coursedb`
--

CREATE TABLE `coursedb` (
  `Course_ID` int(10) NOT NULL,
  `Course_Name` varchar(30) NOT NULL,
  `Pice` varchar(250) NOT NULL,
  `Link` varchar(250) NOT NULL,
  `Quantity` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coursedb`
--

INSERT INTO `coursedb` (`Course_ID`, `Course_Name`, `Pice`, `Link`, `Quantity`) VALUES
(101, 'Math', '$20', 'https://study.com/academy/course/algebra.html', 22),
(103, 'Math 3', '$40', 'https://www.scribd.com/document/518089970/New-General-Mathematics-3-1', 20),
(201, 'English', '$20', 'https://www.britannica.com/topic/English-language', 21),
(202, 'English 02', '$25', 'https://www.youtube.com/watch?v=mpXPqNDF-B0', 22);

-- --------------------------------------------------------

--
-- Table structure for table `mentor`
--

CREATE TABLE `mentor` (
  `FullName` varchar(100) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Date_of_Birth` date NOT NULL,
  `EducationQualification` varchar(150) NOT NULL,
  `CV` varchar(100) NOT NULL,
  `Password` varchar(150) NOT NULL,
  `ID` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mentor`
--

INSERT INTO `mentor` (`FullName`, `Username`, `Email`, `Date_of_Birth`, `EducationQualification`, `CV`, `Password`, `ID`) VALUES
('Hrichik Paul ', 'ankan', 'hrichik.@gmail.com', '2013-11-21', 'CSE', '', '1234', 11234),
('Fariha alam', 'fari', 'fa@gmail.com', '2023-11-01', 'cse', '', '12f', 12345);

-- --------------------------------------------------------

--
-- Table structure for table `my_courses`
--

CREATE TABLE `my_courses` (
  `Courses` varchar(100) NOT NULL,
  `Time` time(4) NOT NULL,
  `ID` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `my_courses`
--

INSERT INTO `my_courses` (`Courses`, `Time`, `ID`) VALUES
('WEB-TECHNOLOGIES', '10:30:00.0000', 1051);

-- --------------------------------------------------------

--
-- Table structure for table `student_courses`
--

CREATE TABLE `student_courses` (
  `Student_ID` int(11) NOT NULL,
  `Student_Name` varchar(25) NOT NULL,
  `Course_ID` int(11) NOT NULL,
  `Course_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_courses`
--

INSERT INTO `student_courses` (`Student_ID`, `Student_Name`, `Course_ID`, `Course_Name`) VALUES
(0, '', 0, ''),
(0, '', 0, ''),
(1, '', 101, ''),
(1, '', 101, ''),
(0, '', 0, ''),
(0, '', 0, ''),
(1, '', 101, ''),
(1, '', 101, ''),
(2, '', 103, ''),
(1, '', 201, ''),
(2, '', 201, ''),
(2, '', 103, ''),
(1, '', 202, ''),
(3, '', 103, ''),
(2, '', 1001, ''),
(3, '', 103, ''),
(3, '', 2001, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_courses`
--
ALTER TABLE `all_courses`
  ADD UNIQUE KEY `Courses` (`Courses`);

--
-- Indexes for table `mentor`
--
ALTER TABLE `mentor`
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `my_courses`
--
ALTER TABLE `my_courses`
  ADD UNIQUE KEY `Courses` (`Courses`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
