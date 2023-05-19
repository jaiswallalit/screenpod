-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 09, 2023 at 06:10 AM
-- Server version: 5.7.42
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `screenpod212_newdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `site_visits`
--

CREATE TABLE `site_visits` (
  `id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `lead_source` text,
  `category` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `site_visits`
--

INSERT INTO `site_visits` (`id`, `location`, `customer_id`, `user_id`, `date`, `telephone`, `phone`, `email`, `contact`, `lead_source`, `category`, `model`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'testeeee', 1, 122, NULL, '1234567890', '12345678909', 'lalit1@gmail.com', 'test', NULL, 'jaw', 'impact', 'test', '2023-04-25 08:02:41', '2023-04-26 05:19:36'),
(3, 'Dublin', 1, 116, '2023-04-26', '0851201708', NULL, 'hugheskarl@hotmail.com', 'Joe Bloggs', NULL, 'Airvac', 'AV52', 'Needs 5 by June', '2023-04-26 14:14:00', '2023-04-26 14:14:00'),
(4, 'Location', 3, 116, NULL, '0851201708', '+353 85 120 1708', 'karljordanhughes@gmail.com', 'Danielle', 'fb', 'Airvac', 'AV52', 'Danielle', '2023-04-26 14:32:12', '2023-04-26 16:19:35'),
(5, 'rrurur', 1, 122, NULL, '1234567890', '12345678909', 'lalit@gmail.com', '22345', 'fb', 'bd', 'ttt', 'fg', '2023-04-26 15:47:28', '2023-04-26 16:19:19'),
(6, 'Dublin', 2, 122, '2023-04-27', '1234567890', '1234567890', 'lttest@gmail.com', 'apitest', 'instagram', 'Jaw', 'impact', 'hellotest', '2023-04-28 05:05:29', '2023-04-28 05:05:29'),
(7, 'Kildare', 11, 116, NULL, '1234567890', '12345678909', 'testtt@gmail.com', '22345444444', 'instagram', 'teddd', '10570', 'fb', '2023-04-28 05:12:02', '2023-04-28 05:12:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `site_visits`
--
ALTER TABLE `site_visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `site_visits`
--
ALTER TABLE `site_visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
