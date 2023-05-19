-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2023 at 11:32 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `site_visits`
--

CREATE TABLE `site_visits` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lead_source` varchar(255) DEFAULT NULL,
  `vat_number` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `address2` text DEFAULT NULL,
  `town` varchar(255) DEFAULT NULL,
  `county` varchar(255) DEFAULT NULL,
  `eircode` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(100) NOT NULL COMMENT 'New, In Progress, On Hold, Lost,\r\nClosed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_visits`
--

INSERT INTO `site_visits` (`id`, `title`, `customer_id`, `name`, `lead_source`, `vat_number`, `email`, `phone`, `address`, `address2`, `town`, `county`, `eircode`, `message`, `user_id`, `date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'testt', 1, 'Karl Hughes', 'wp', '2', 'karl@dmcconsultancy.com', '0877187092', 'Cuirt Nua, Court\r\nHollywoodrath', NULL, NULL, NULL, NULL, 'bb', 122, '2023-04-24', 'New', '2023-04-24 12:08:06', '2023-04-24 12:21:54'),
(2, 'fsfs', 2, 'Niamh Carroll', 'instagram', '0', 'niamh@dmcconsultancy.com', '873930524', 'test', NULL, NULL, NULL, NULL, 'bb', 122, '2023-04-24', 'New', '2023-04-24 12:18:23', '2023-04-24 12:18:23');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
