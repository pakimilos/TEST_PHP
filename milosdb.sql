-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2020 at 12:33 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `milosdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `type`) VALUES
(1, 'proba', 'proba@gmail.com', '12345', 0),
(6, 'novi', 'novi@gmail.com', '123', 10),
(8, 'petar', 'petar@gmail.com', '12345', 9),
(9, 'rasko', 'rasko@gmail.com', '12345', 12),
(10, 'marko', 'mmarkovic@gmail.com', '12345', 15),
(11, 'nikola', 'dzoni@gmail.com', '12345', 11),
(12, 'savo', 'savoo@gmail.com', '12345', 10),
(13, 'kaca', 'kata@gmail.com', '12345', 14),
(14, 'ivana', 'ivka@gmail.com', '12345', 8),
(15, 'marina', 'mara@gmail.com', '12345', 11),
(16, 'branko', 'bane@gmail.com', '12345', 9),
(17, 'jovana', 'joca@gmail.com', '12345', 15),
(18, 'ana', 'anna@gmail.com', '12345', 10);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `type` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `type`, `parent`) VALUES
(1, 'Front End Developer', 0),
(2, 'Back End Developer', 0),
(3, 'Angular', 1),
(4, 'React', 1),
(5, 'Vue', 1),
(6, 'PHP', 2),
(7, 'NodeJs', 2),
(8, 'AngularJs', 3),
(9, 'Angular 2', 3),
(10, 'React native', 4),
(11, 'Symfony', 6),
(12, 'Laravel', 6),
(13, 'Silex', 11),
(14, 'Lumen', 12),
(15, 'Express', 7),
(16, 'NestJS', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
