-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 28, 2022 at 12:36 PM
-- Server version: 8.0.31-0ubuntu0.20.04.2
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment3clone`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` bigint NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `file` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_date` varchar(100) DEFAULT NULL,
  `modified_date` varchar(100) DEFAULT NULL,
  `user_type` int NOT NULL DEFAULT '1',
  `soft_delete` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `password`, `gender`, `file`, `created_date`, `modified_date`, `user_type`, `soft_delete`) VALUES
(3, 'Rahul', 'Kumar', 'rose@mailinator.com', 1234567899, '1234567', 'Male', 'download (1).jpeg', 'Friday 9th of December 2022 11:10:04 AM', 'Monday 12th of December 2022 10:55:19 AM', 1, 0),
(4, 'samulesffff', 'badree', 'rose2@mailinator.com', 1234567899, 'BiM@123456', 'Male', 'download.jpeg', 'Friday 9th of December 2022 12:04:50 PM', 'Wednesday 28th of December 2022 10:28:00 AM', 1, 0),
(5, 'Rose', 'Dolsen', 'rose@gmail.com', 1234567899, 'rose', 'Female', 'download.png', 'Friday 9th of December 2022 01:25:45 PM', 'Monday 12th of December 2022 10:16:05 AM', 1, 1),
(7, 'Raj', 'Malhotra', 'raj@gmail.com', 9874561237, 'raj', 'Male', 'download (1).jpeg', 'Friday 9th of December 2022 03:40:04 PM', 'Monday 12th of December 2022 10:16:17 AM', 1, 0),
(10, 'Rohit', 'Pal', 'adqm@mailinator.com', 1234567899, 'BiM@123456', 'Male', 'download.jpeg', 'Friday 9th of December 2022 05:08:42 PM', 'Monday 12th of December 2022 12:57:32 PM', 1, 1),
(11, 'samules', 'badree', 'abc@gmail.com', 1234567899, 'abc', 'Male', 'download.png', 'Monday 12th of December 2022 09:05:58 AM', 'Monday 12th of December 2022 10:16:45 AM', 1, 1),
(12, 'samules', 'badree', 'adamtqm@mailinator.com', 1234567899, 'BiM@123456', 'Male', 'download (1).jpeg', 'Monday 12th of December 2022 09:13:57 AM', 'Monday 12th of December 2022 10:01:07 AM', 1, 1),
(14, 'Rohit', 'khanna', 'rohit@gmail.com', 9874561237, '123', 'Male', 'download.jpeg', 'Monday 12th of December 2022 10:35:17 AM', 'Monday 12th of December 2022 10:53:24 AM', 1, 0),
(15, 'Jenny', 'Johnson', 'jenny@gmail.com', 5874693214, 'jenny', 'Male', 'download.png', 'Monday 12th of December 2022 11:48:18 AM', 'Monday 12th of December 2022 11:48:39 AM', 1, 1),
(16, 'Varinder', 'Sharma', 'kallice@mailinator.com', 9874561237, 'BiM@SRcG', 'Male', 'download.jpeg', 'Monday 12th of December 2022 12:15:24 PM', 'Wednesday 28th of December 2022 10:28:35 AM', 1, 0),
(17, 'samules', 'badree', 'bannertqm@mailinator.com', 9874561237, 'BiM@QSDc', 'Male', 'download.png', 'Monday 12th of December 2022 12:33:33 PM', '', 1, 1),
(18, 'admin', 'admin', 'admin@gmail.com', 9874561230, '21232f297a57a5a743894a0e4a801fc3', 'Male', 'download.jpeg', 'Wednesday 28th of December 2022 10:20:37 AM', '', 0, 1),
(19, 'jenny', 'jonson', 'jenny8@gmail.com', 9874561230, 'c9f0f895fb98ab9159f51fd0297e236d', 'Female', 'download.jpeg', 'Wednesday 28th of December 2022 10:29:39 AM', 'Wednesday 28th of December 2022 11:22:52 AM', 1, 1),
(20, 'Rahul', 'Kumar', 'krahul@teqmavens.com', 9874561230, '87371f257edb838f6933a444fd887aa0', 'Male', 'download (1).jpeg', 'Wednesday 28th of December 2022 10:32:10 AM', 'Wednesday 28th of December 2022 11:44:00 AM', 1, 1),
(21, 'new', 'flag', 'flag@gmail.com', 9874561230, '327a6c4304ad5938eaf0efb6cc3e53dc', 'Male', 'download.png', 'Wednesday 28th of December 2022 11:25:00 AM', 'Wednesday 28th of December 2022 11:31:18 AM', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
