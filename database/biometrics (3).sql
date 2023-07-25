-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2023 at 10:46 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biometrics`
--

-- --------------------------------------------------------

--
-- Table structure for table `rfid`
--

CREATE TABLE `rfid` (
  `rfid_id` int(255) NOT NULL,
  `rfid_fname` text NOT NULL,
  `rfid_lname` text NOT NULL,
  `rfid_username` varchar(250) NOT NULL,
  `rfid_carddata` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rfid`
--

INSERT INTO `rfid` (`rfid_id`, `rfid_fname`, `rfid_lname`, `rfid_username`, `rfid_carddata`) VALUES
(22, 'Jacob', 'Principe', 'MITSI-374512', '13316986828'),
(24, 'Kayle', 'Andrew', 'MITSI-171022', '671658555453');

-- --------------------------------------------------------

--
-- Table structure for table `time_in`
--

CREATE TABLE `time_in` (
  `id` int(200) NOT NULL,
  `rfid_att_cd` varchar(1000) NOT NULL,
  `time_in` varchar(250) NOT NULL,
  `date` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_in`
--

INSERT INTO `time_in` (`id`, `rfid_att_cd`, `time_in`, `date`, `status`) VALUES
(50, 'MITSI-171022', '14:34:53', '2023-07-14', 'Late');

-- --------------------------------------------------------

--
-- Table structure for table `time_out`
--

CREATE TABLE `time_out` (
  `id` int(200) NOT NULL,
  `rfid_att_cd` varchar(1000) NOT NULL,
  `time_out` varchar(250) NOT NULL,
  `date` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(200) NOT NULL,
  `name` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `admin_rights` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `admin_rights`) VALUES
(2, 'Admin', 'admin', 'admin123', '$2y$10$h3D9F8N7rt.AYJbTa7AUxugbG1c/hleC.GqjX3VrpZROFQeKoz7Fm'),
(3, 'user', 'user', 'user123', '$2y$10$y0XTs9mjdfWBF/jTkGW6fOdSWTpach9oAASgVoeGy9.VwkhSvZKJe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rfid`
--
ALTER TABLE `rfid`
  ADD PRIMARY KEY (`rfid_id`),
  ADD UNIQUE KEY `rfid_username` (`rfid_username`),
  ADD UNIQUE KEY `rfid_carddata` (`rfid_carddata`) USING HASH;

--
-- Indexes for table `time_in`
--
ALTER TABLE `time_in`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_out`
--
ALTER TABLE `time_out`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rfid`
--
ALTER TABLE `rfid`
  MODIFY `rfid_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `time_in`
--
ALTER TABLE `time_in`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `time_out`
--
ALTER TABLE `time_out`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
