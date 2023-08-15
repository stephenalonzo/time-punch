-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 15, 2023 at 01:50 AM
-- Server version: 8.1.0
-- PHP Version: 7.4.3-4ubuntu2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oras_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `accrual_bank`
--

CREATE TABLE `accrual_bank` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `accrual` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accrual_bank`
--

INSERT INTO `accrual_bank` (`id`, `user_id`, `accrual`) VALUES
(1, 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `pay_period`
--

CREATE TABLE `pay_period` (
  `id` int NOT NULL,
  `pp_start` date NOT NULL,
  `pp_end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pay_period`
--

INSERT INTO `pay_period` (`id`, `pp_start`, `pp_end`) VALUES
(1, '2023-07-23', '2023-08-05');

-- --------------------------------------------------------

--
-- Table structure for table `time_off_request`
--

CREATE TABLE `time_off_request` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `emp_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `reason_for_leave` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `timeoff_start` date NOT NULL,
  `timeoff_end` date NOT NULL,
  `timeoff_hours` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `timeoff_status` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `timeoff_request_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `user_role` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `emp_status` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `punch_token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `user_role`, `emp_status`, `punch_token`) VALUES
(1, 'John', 'Smith', 'jsmith', 'pass123', 'ADMIN', 'OUT', '8db9e6a625'),
(2, 'Kate', 'Hill', 'khill', '123pass', 'USER', 'OUT', '82d45463e9');

-- --------------------------------------------------------

--
-- Table structure for table `user_punch`
--

CREATE TABLE `user_punch` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `punch_day` date NOT NULL,
  `in_day` time NOT NULL,
  `out_break_1` time NOT NULL,
  `in_break_1` time NOT NULL,
  `out_lunch` time NOT NULL,
  `in_lunch` time NOT NULL,
  `out_break_2` time NOT NULL,
  `in_break_2` time NOT NULL,
  `out_day` time NOT NULL,
  `total_hours` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `punch_token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accrual_bank`
--
ALTER TABLE `accrual_bank`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pay_period`
--
ALTER TABLE `pay_period`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_off_request`
--
ALTER TABLE `time_off_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_punch`
--
ALTER TABLE `user_punch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accrual_bank`
--
ALTER TABLE `accrual_bank`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pay_period`
--
ALTER TABLE `pay_period`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `time_off_request`
--
ALTER TABLE `time_off_request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_punch`
--
ALTER TABLE `user_punch`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accrual_bank`
--
ALTER TABLE `accrual_bank`
  ADD CONSTRAINT `accrual_bank_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `time_off_request`
--
ALTER TABLE `time_off_request`
  ADD CONSTRAINT `time_off_request_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_punch`
--
ALTER TABLE `user_punch`
  ADD CONSTRAINT `user_punch_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
