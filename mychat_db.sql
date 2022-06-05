-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2022 at 05:41 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mychat_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `messag`
--

CREATE TABLE `messag` (
  `id` bigint(20) NOT NULL,
  `msgid` varchar(60) NOT NULL,
  `sender` bigint(20) NOT NULL,
  `receiver` bigint(20) NOT NULL,
  `message` text NOT NULL,
  `files` text NOT NULL,
  `date` datetime NOT NULL,
  `seen` int(11) NOT NULL,
  `received` int(11) NOT NULL,
  `deleted_sender` tinyint(1) NOT NULL,
  `deleted_receiver` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messag`
--

INSERT INTO `messag` (`id`, `msgid`, `sender`, `receiver`, `message`, `files`, `date`, `seen`, `received`, `deleted_sender`, `deleted_receiver`) VALUES
(1, '456789', 456456, 456, '456', '', '0000-00-00 00:00:00', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) NOT NULL,
  `msgid` varchar(60) NOT NULL,
  `sender` bigint(20) NOT NULL,
  `receiver` bigint(20) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `msgid`, `sender`, `receiver`, `message`, `date`) VALUES
(30, 'VXo2', 15224114200, 9223372036854775807, 'hello', '2021-12-17 13:13:30'),
(31, 'VXo2', 9223372036854775807, 15224114200, 'hi', '2021-12-17 13:13:34'),
(32, 'VXo2', 15224114200, 9223372036854775807, 'woo', '2021-12-17 13:13:36'),
(33, 'VXo2', 9223372036854775807, 15224114200, 'ya', '2021-12-17 13:13:40'),
(34, 'VXo2', 15224114200, 9223372036854775807, 'yup', '2021-12-17 13:13:44'),
(35, 'VXo2', 9223372036854775807, 15224114200, 'hey', '2021-12-17 13:13:47'),
(36, 'VXo2', 15224114200, 9223372036854775807, 'he', '2021-12-17 13:13:50'),
(37, 'VXo2', 9223372036854775807, 15224114200, 'whay', '2021-12-17 13:13:57'),
(38, 'VXo2', 15224114200, 9223372036854775807, 'why', '2021-12-17 13:14:01'),
(39, 'dNxo', 9223372036854775807, 42928937066865, 'what is your name ?', '2022-02-16 18:19:19'),
(40, 'dNxo', 9223372036854775807, 42928937066865, 'HI', '2022-06-03 17:11:48'),
(41, 'dNxo', 42928937066865, 9223372036854775807, 'hello', '2022-06-03 17:11:57'),
(42, 'dNxo', 42928937066865, 9223372036854775807, 'asd', '2022-06-03 17:12:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `userid` bigint(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(500) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userid`, `username`, `email`, `gender`, `password`, `image`, `date`) VALUES
(35, 42928937066865, 'qweqweqwe', 'qweqwe@asd.com', 'Male', 'qweqweqwe', '', '2021-12-22 14:47:05'),
(36, 9223372036854775807, 'wonghoncheung', 'wonghoncheung@hotmail.com', 'Male', 'qweqweqwe', '', '2021-12-22 14:53:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messag`
--
ALTER TABLE `messag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `msgid` (`msgid`),
  ADD KEY `sender` (`sender`),
  ADD KEY `receiver` (`receiver`),
  ADD KEY `date` (`date`),
  ADD KEY `deleted_sender` (`deleted_sender`),
  ADD KEY `deleted_receiver` (`deleted_receiver`),
  ADD KEY `seen` (`seen`),
  ADD KEY `msgid_2` (`msgid`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `sender` (`sender`),
  ADD KEY `receiver` (`receiver`),
  ADD KEY `date` (`date`),
  ADD KEY `msgid` (`msgid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `userid` (`userid`),
  ADD KEY `email` (`email`),
  ADD KEY `date` (`date`),
  ADD KEY `gender` (`gender`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messag`
--
ALTER TABLE `messag`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
