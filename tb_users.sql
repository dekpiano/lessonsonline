-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2024 at 11:37 AM
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
-- Database: `skjacth_lessonsonline`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `UserID` int(11) NOT NULL,
  `UserCode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `UserPrefix` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `UserFirstName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `UserLastName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `UserBirthday` date NOT NULL,
  `UserPhone` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserType` enum('student','teacher','admin') COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateCreated` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`UserID`, `UserCode`, `UserPrefix`, `UserFirstName`, `UserLastName`, `UserBirthday`, `UserPhone`, `Username`, `Password`, `Email`, `UserType`, `DateCreated`) VALUES
(1, 'User_0001', 'นาย', 'วชิรวิทย์', 'แกล้วการไถ', '2024-03-04', '0910518473', 'dekpiano@skj.ac.th', '$2y$10$Uz9L6PXtrcqD7l83Ma1s4eKE09htCu4wS1zLXH3vDZRCDvg19uiEi', 'dekpiano@skj.ac.th', 'student', '2024-03-04 10:56:59'),
(2, 'User_0002', 'เด็กหญิง', 'วชิรวิทย์', 'แกล้วการไถ', '2024-03-14', '0910518473', 'nuntakarn.j@skj.ac.th', '$2y$10$NldPnaFtHbEnRM9I.Nl7E.k6u1cmb2qB.7UM3rkuCIr0z7sBqt9he', 'nuntakarn.j@skj.ac.th', 'student', '2024-03-04 11:06:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
