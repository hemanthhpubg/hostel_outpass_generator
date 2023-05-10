-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2023 at 06:29 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `example`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `name` varchar(10) NOT NULL,
  `pass` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`name`, `pass`) VALUES
('', ''),
('', ''),
('lol', '123');

-- --------------------------------------------------------

--
-- Table structure for table `outpass`
--

CREATE TABLE `outpass` (
  `Id` int(11) NOT NULL,
  `reg` varchar(10) NOT NULL,
  `fromd` date NOT NULL,
  `tod` date NOT NULL,
  `days` varchar(11) NOT NULL,
  `dest` varchar(100) NOT NULL,
  `reason` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Pending',
  `response` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outpass`
--

INSERT INTO `outpass` (`Id`, `reg`, `fromd`, `tod`, `days`, `dest`, `reason`, `status`, `response`) VALUES
(47, 'lol', '2023-05-10', '2023-05-16', '6', 'asfa', 'adfa', 'reject', 'poda'),
(48, '2020506053', '2023-05-01', '2023-05-10', '9', 'trichy', 'chumma`', 'reject', 'no way'),
(49, '2020506053', '2023-05-02', '2023-05-16', '14', 'trichy`', 'kabsf', 'reject', 'die'),
(50, '2020506053', '2023-05-21', '2023-05-23', '2', 'af', 'asf', 'reject', 'prob bro'),
(51, '2020506053', '2023-05-03', '2023-05-23', '20', 'trichy', 'asf', 'reject', 'ksjgdf'),
(52, 'lol', '2023-05-17', '2023-05-18', '1', 'anna', 'chumma', 'reject', 'aksjgfkjag');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `name` varchar(10) NOT NULL,
  `pass` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`name`, `pass`) VALUES
('2020506053', '2002-09-24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `outpass`
--
ALTER TABLE `outpass`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `outpass`
--
ALTER TABLE `outpass`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
