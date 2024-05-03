-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2024 at 04:35 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perusahaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `EducationID` int(11) NOT NULL,
  `EducationName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`EducationID`, `EducationName`) VALUES
(1, 'Pendidikan Dasar'),
(2, 'Pendidikan Menengah'),
(3, 'Pendidikan Tinggi'),
(10, 'perguruan tinggi'),
(16, 'S3');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EID` int(11) NOT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `Foto` varchar(255) DEFAULT NULL,
  `Gender` char(1) DEFAULT NULL,
  `Street` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `EducationID` int(11) DEFAULT NULL,
  `JobID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EID`, `LastName`, `FirstName`, `Foto`, `Gender`, `Street`, `City`, `EducationID`, `JobID`) VALUES
(2, 'Smith', 'Jane', 'foto1.jpeg', 'F', '456 Elm St', 'Bandung', 2, 2),
(3, 'Johnson', 'Robert', 'foto2.jpeg', 'M', '789 Oak St', 'Surabaya', 3, 3),
(4, 'Brow', 'Emily', 'foto1.jpeg', 'F', '567 Pine St', 'Yogyakarta', 2, 4),
(5, 'Lee', 'Michael', 'foto2.jpeg', 'M', '987 Maple St', 'Medan', 2, 5),
(6, 'Garcia', 'Sophia', 'foto1.jpeg', 'F', '345 Cedar St', 'Semarang', 3, 6),
(7, 'Wang', 'David', 'foto2.jpeg', 'M', '654 Birch St', 'Malang', 1, 7),
(9, 'Kim', 'Daniel', 'foto2.jpeg', 'M', '234 Oak St', 'Palembang', 3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `jobtitle`
--

CREATE TABLE `jobtitle` (
  `JobID` int(11) NOT NULL,
  `JobName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobtitle`
--

INSERT INTO `jobtitle` (`JobID`, `JobName`) VALUES
(1, 'Manajer Keuangan'),
(2, 'Manajer Sumber Daya Manusia'),
(3, 'Manajer Pemasaran'),
(4, 'Manajer Operasi'),
(5, 'Manajer Proyek'),
(6, 'Eksekutif Penjualan'),
(7, 'Spesialis Administrasi'),
(8, 'Koordinator Program'),
(9, 'Spesialis Layanan Pelanggan'),
(10, 'Analisis Digital');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`EducationID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EID`),
  ADD KEY `employee_education_fk` (`EducationID`),
  ADD KEY `employee_jobtitle_fk` (`JobID`);

--
-- Indexes for table `jobtitle`
--
ALTER TABLE `jobtitle`
  ADD PRIMARY KEY (`JobID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `EducationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `EID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `jobtitle`
--
ALTER TABLE `jobtitle`
  MODIFY `JobID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_education_fk` FOREIGN KEY (`EducationID`) REFERENCES `education` (`EducationID`) ON DELETE SET NULL,
  ADD CONSTRAINT `employee_jobtitle_fk` FOREIGN KEY (`JobID`) REFERENCES `jobtitle` (`JobID`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
