-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2023 at 08:37 AM
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
-- Table structure for table `fingerprint`
--

CREATE TABLE `fingerprint` (
  `fingerprint_id` int(250) NOT NULL,
  `fingerprint_username` varchar(250) NOT NULL,
  `fingerprint_fingerid` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fingerprint`
--

INSERT INTO `fingerprint` (`fingerprint_id`, `fingerprint_username`, `fingerprint_fingerid`) VALUES
(1, 'MITSI-10021', '3'),
(2, 'MITSI-20543', '4'),
(3, 'MITSI-3', '5'),
(4, 'MITSI-4', '6'),
(5, 'MITSI-5', '7'),
(6, 'MITSI-6', '8'),
(7, 'MITSI-7', '9'),
(8, 'MITSI-8', '10'),
(9, 'MITSI-9', '11'),
(10, 'MITSI-10', '12'),
(11, 'MITSI-11', '13'),
(12, 'MITSI-12', '14'),
(13, 'MITSI-13', '15'),
(14, 'MITSI-14', '16'),
(15, 'MITSI-15', '17'),
(16, 'MITSI-16', '18'),
(17, 'MITSI-17', '19'),
(18, 'MITSI-18', '20'),
(19, 'MITSI-19', '21'),
(20, 'MITSI-20', '22'),
(21, 'MITSI-21', '23'),
(22, 'MITSI-22', '24'),
(23, 'MITSI-23', '25'),
(24, 'MITSI-24', '26'),
(25, 'MITSI-25', '27'),
(26, 'MITSI-26', '28'),
(27, 'MITSI-27', '29'),
(28, 'MITSI-28', '30'),
(29, 'MITSI-29', '31'),
(30, 'MITSI-30', '32'),
(31, 'MITSI-31', '33'),
(32, 'MITSI-32', '34'),
(33, 'MITSI-33', '35'),
(34, 'MITSI-34', '36'),
(35, 'MITSI-35', '37'),
(36, 'MITSI-36', '38'),
(37, 'MITSI-37', '39'),
(38, 'MITSI-38', '40'),
(39, 'MITSI-39', '41'),
(40, 'MITSI-40', '42'),
(41, 'MITSI-41', '43'),
(42, 'MITSI-42', '44'),
(43, 'MITSI-43', '45'),
(44, 'MITSI-44', '46'),
(45, 'MITSI-45', '47'),
(46, 'MITSI-46', '48'),
(47, 'MITSI-47', '49'),
(48, 'MITSI-48', '50'),
(49, 'MITSI-49', '51'),
(50, 'MITSI-50', '52'),
(51, 'MITSI-51', '53'),
(52, 'MITSI-52', '54'),
(53, 'MITSI-53', '55'),
(54, 'MITSI-54', '56'),
(55, 'MITSI-55', '57'),
(56, 'MITSI-56', '58'),
(57, 'MITSI-57', '59'),
(58, 'MITSI-58', '60'),
(59, 'MITSI-59', '61'),
(60, 'MITSI-60', '62'),
(61, 'MITSI-61', '63'),
(62, 'MITSI-62', '64'),
(63, 'MITSI-63', '65'),
(64, 'MITSI-64', '66'),
(65, 'MITSI-65', '67'),
(66, 'MITSI-66', '68'),
(67, 'MITSI-67', '69'),
(68, 'MITSI-68', '70'),
(69, 'MITSI-69', '71'),
(70, 'MITSI-70', '72'),
(71, 'MITSI-71', '73'),
(72, 'MITSI-72', '74'),
(73, 'MITSI-73', '75'),
(74, 'MITSI-74', '76'),
(75, 'MITSI-75', '77'),
(76, 'MITSI-76', '78'),
(77, 'MITSI-77', '79'),
(78, 'MITSI-78', '80'),
(79, 'MITSI-79', '81'),
(80, 'MITSI-80', '82'),
(81, 'MITSI-81', '83'),
(82, 'MITSI-82', '84'),
(83, 'MITSI-83', '85'),
(84, 'MITSI-84', '86'),
(85, 'MITSI-85', '87'),
(86, 'MITSI-86', '88'),
(87, 'MITSI-87', '89'),
(88, 'MITSI-88', '90'),
(89, 'MITSI-89', '91'),
(90, 'MITSI-90', '92'),
(91, 'MITSI-91', '93'),
(92, 'MITSI-92', '94'),
(93, 'MITSI-93', '95'),
(94, 'MITSI-94', '96'),
(95, 'MITSI-95', '97'),
(96, 'MITSI-96', '98'),
(97, 'MITSI-97', '99'),
(98, 'MITSI-98', '100');

-- --------------------------------------------------------

--
-- Table structure for table `fingerprint_signalread`
--

CREATE TABLE `fingerprint_signalread` (
  `fingerprint_deviceid` varchar(250) NOT NULL,
  `currently_editing` int(250) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fingerprint_signalread`
--

INSERT INTO `fingerprint_signalread` (`fingerprint_deviceid`, `currently_editing`, `status`) VALUES
('finger_1', 0, 'stand-by');

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
(46, 'Reydentor', 'Casaljay', 'MITSI-10021', 'b3c0c817'),
(47, 'Roger', 'Azon', 'MITSI-20543', '9c61f838'),
(55, 'UNREGISTERED', 'UNREGISTERED', 'MITSI-76348', ' 0319c117');

-- --------------------------------------------------------

--
-- Table structure for table `time_in`
--

CREATE TABLE `time_in` (
  `id` int(200) NOT NULL,
  `full_name` text NOT NULL,
  `rfid_att_cd` varchar(1000) NOT NULL,
  `time_in` varchar(250) NOT NULL,
  `date` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `time_out`
--

CREATE TABLE `time_out` (
  `id` int(200) NOT NULL,
  `full_name` text NOT NULL,
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
-- Indexes for table `fingerprint`
--
ALTER TABLE `fingerprint`
  ADD PRIMARY KEY (`fingerprint_id`),
  ADD UNIQUE KEY `fingerprint_username` (`fingerprint_username`);

--
-- Indexes for table `fingerprint_signalread`
--
ALTER TABLE `fingerprint_signalread`
  ADD PRIMARY KEY (`fingerprint_deviceid`);

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
-- AUTO_INCREMENT for table `fingerprint`
--
ALTER TABLE `fingerprint`
  MODIFY `fingerprint_id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `rfid`
--
ALTER TABLE `rfid`
  MODIFY `rfid_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `time_in`
--
ALTER TABLE `time_in`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `time_out`
--
ALTER TABLE `time_out`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
