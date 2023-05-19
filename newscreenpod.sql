-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2023 at 06:34 PM
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
-- Database: `newscreenpod`
--

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE `actions` (
  `id` int(11) NOT NULL,
  `action_title` varchar(111) NOT NULL,
  `action_slug` varchar(111) NOT NULL,
  `class` varchar(100) NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `actions`
--

INSERT INTO `actions` (`id`, `action_title`, `action_slug`, `class`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Add', 'add', 'info', NULL, '2021-01-18 09:43:54', '2021-01-18 09:43:54'),
(2, 'Edit', 'edit', 'info', 'fas fa-pencil-alt', '2021-01-18 09:43:54', '2021-01-18 09:43:54'),
(3, 'Delete', 'delete', 'danger', 'fas fa-trash', '2021-01-18 09:44:32', '2021-01-18 09:44:32'),
(4, 'View', 'view', 'info', 'fas fa-eye', '2021-01-18 09:44:32', '2021-01-18 09:44:32'),
(5, 'Export', 'export', 'info', NULL, '2021-01-18 11:04:06', '2021-01-18 11:04:06'),
(6, 'Import', 'import', 'info', NULL, '2021-01-18 11:04:06', '2021-01-18 11:04:06'),
(8, 'Status', 'status', 'success', NULL, '2021-02-12 10:56:40', '2021-02-12 10:56:40'),
(9, 'Reset Password', 'password', 'primary', 'fas fa-key', '2021-02-23 04:47:04', '2021-02-23 04:47:04'),
(10, 'Add More', 'add_more', 'info', NULL, '2021-01-18 09:43:54', '2021-01-18 09:43:54'),
(11, 'Add Trade', 'addtrade', 'info', NULL, '2022-08-09 04:16:33', '2022-08-09 04:16:33'),
(12, 'ViewTrade', 'viewtrade', 'info', NULL, '2022-08-09 04:16:33', '2022-08-09 04:16:33');

-- --------------------------------------------------------

--
-- Table structure for table `admin_permissions`
--

CREATE TABLE `admin_permissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `action_id` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_permissions`
--

INSERT INTO `admin_permissions` (`id`, `user_id`, `role_id`, `action_id`, `created_at`, `updated_at`) VALUES
(3, 103, 16, 'index,view', '2021-03-18 12:05:13', '2021-03-18 12:05:13'),
(8, 114, 16, 'index,view', '2021-07-07 13:48:02', '2021-07-07 13:48:02'),
(9, 115, 16, 'index,view', '2021-07-09 16:22:36', '2021-07-09 16:22:36'),
(11, 117, 16, 'index,view', '2021-07-12 16:18:54', '2021-07-12 16:18:54'),
(13, 118, 16, 'index,view', '2021-07-12 16:20:16', '2021-07-12 16:20:16'),
(14, 119, 16, 'index,view', '2021-07-12 17:40:09', '2021-07-12 17:40:09'),
(16, 113, 16, 'index,view', '2021-08-03 18:42:57', '2021-08-03 18:42:57'),
(17, 120, 16, 'index,view', '2021-09-06 18:42:22', '2021-09-06 18:42:22'),
(19, 127, 16, 'index,view', '2021-11-01 20:16:36', '2021-11-01 20:16:36'),
(41, 163, 16, 'index,view', '2022-12-05 14:52:39', '2022-12-05 14:52:39'),
(42, 163, 14, 'index,view,add', '2022-12-05 14:52:39', '2022-12-05 14:52:39'),
(44, 165, 14, 'index,view', '2022-12-06 13:48:08', '2022-12-06 13:48:08');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dealer_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `dealer_id`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Jaw Crusher', 1, 'Jaw Crusher', '1681388293.jpg', '2023-04-13 12:18:13', '2023-04-21 09:19:10'),
(2, 'mytestct', 1, 'test22', '1682060273.jpg', '2023-04-21 01:27:53', '2023-04-21 01:32:14'),
(3, 'screen', 2, 'gdfghdf', '1682062402.jpg', '2023-04-21 02:03:22', '2023-04-21 02:03:22'),
(4, 'screenpod2', 2, 'fs', '1682065563.jpg', '2023-04-21 02:56:03', '2023-04-21 02:56:03'),
(5, 'mytest', 2, 'testttt', '1682080980.jpg', '2023-04-21 07:13:01', '2023-04-21 07:13:01');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE `contracts` (
  `id` int(11) NOT NULL,
  `quote_id` int(11) NOT NULL,
  `agreement_no` text DEFAULT NULL,
  `offer_date` date DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contracts`
--

INSERT INTO `contracts` (`id`, `quote_id`, `agreement_no`, `offer_date`, `name`, `company_name`, `telephone`, `created_at`, `updated_at`) VALUES
(1, 1, 'CB033VE', '2023-05-10', 'Chris Bell', 'Screenpod Design and Manufacturing Ltd', '1234567890', '2023-05-10 07:26:00', '2023-05-10 07:26:00');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `address2` text DEFAULT NULL,
  `town` varchar(255) DEFAULT NULL,
  `county` varchar(255) DEFAULT NULL,
  `eircode` varchar(255) DEFAULT NULL,
  `vat_number` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `status` int(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `address`, `address2`, `town`, `county`, `eircode`, `vat_number`, `company`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Karl Hughes', 'karl@dmcconsultancy.com', '0877187092', 'Cuirt Nua, Court\r\nHollywoodrath', 'testhhh', 'testttttttt', 'test', 'test', '2', 'test', 1, '2022-11-07 11:23:50', '2023-03-29 11:44:59'),
(2, 'Niamh Carroll', 'niamh@dmcconsultancy.com', '873930524', 'test', NULL, NULL, NULL, NULL, '0', NULL, 1, '2022-11-07 11:23:50', '2023-03-12 12:13:00'),
(3, 'Danielle McSorley', 'danielle@dmcconsultancy.com', '0871323956', 'BROWNSTOWN ROAD\r\nnewcastle', NULL, NULL, NULL, 'D22Y2F2', 'ie6565467h', 'Quarryplant International', 1, '2022-11-07 11:23:50', '2023-03-02 11:41:45'),
(9, 'Darren Mcsorley', 'Darren@quarryplant.ie', '0868562402', 'BROWNSTOWN ROAD\n', NULL, NULL, NULL, NULL, NULL, 'DMC', 1, '2023-03-02 18:20:27', '2023-05-16 22:16:27'),
(11, 'Joe Bloggs', 'test@dmcconsultancy.com', '0871323956', 'Newcastle', 'Co Dublin', NULL, 'Dublin', 'D22Y2F2', NULL, 'testdmc', 1, '2023-03-15 18:08:15', '2023-03-29 11:27:25');

-- --------------------------------------------------------

--
-- Table structure for table `dealers`
--

CREATE TABLE `dealers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` int(4) NOT NULL COMMENT '1=>Video Url, 2=>Video File',
  `video_url` text DEFAULT NULL,
  `video_file` text DEFAULT NULL,
  `status` int(4) NOT NULL DEFAULT 1,
  `order_no` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dealers`
--

INSERT INTO `dealers` (`id`, `name`, `image`, `type`, `video_url`, `video_file`, `status`, `order_no`, `created_at`, `updated_at`) VALUES
(1, 'JAW', '1681388188.png', 2, '', '5218_1681388188.png', 1, NULL, '2023-04-13 12:16:28', '2023-04-13 12:16:28'),
(2, 'screenpod', '1682062306.jpg', 2, '', '9050_1682062306.mp4', 1, NULL, '2023-04-21 02:01:46', '2023-04-21 02:01:46');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(5, '1615287237.jpg', 1, '2021-03-09 10:53:57', '2021-03-09 10:53:57'),
(6, '1615287245.jpg', 1, '2021-03-09 10:54:05', '2021-03-09 10:54:05'),
(7, '1630675733.jpeg', 1, '2021-09-03 17:58:53', '2021-09-03 17:58:53');

-- --------------------------------------------------------

--
-- Table structure for table `hires`
--

CREATE TABLE `hires` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `dealer_id` int(11) NOT NULL,
  `stock_number` varchar(255) NOT NULL,
  `backorder_number` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `model` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `hours` varchar(100) NOT NULL,
  `weight` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` float NOT NULL,
  `type` varchar(100) NOT NULL COMMENT 'New,Used,Trade',
  `attachment` varchar(255) DEFAULT NULL,
  `status` varchar(100) NOT NULL COMMENT 'Coming Soon, In Stock, Sold',
  `upcoming_quantity` int(11) NOT NULL DEFAULT 0,
  `date` date DEFAULT NULL,
  `order_no` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hires`
--

INSERT INTO `hires` (`id`, `category_id`, `dealer_id`, `stock_number`, `backorder_number`, `title`, `model`, `year`, `hours`, `weight`, `description`, `price`, `type`, `attachment`, `status`, `upcoming_quantity`, `date`, `order_no`, `created_at`, `updated_at`) VALUES
(2, 1, 1, '12345', '1234', 'Tesab 10570 Tracked Jaw Crusher', '10570', '2023', '2', '1', '<p>Tesab 10570 Tracked Jaw Crusher<br></p>', 200, 'New', 'Screenpod__Backend_Wireframes.pdf', 'In Stock', 222, '2023-04-13', 1, '2023-04-13 13:23:46', '2023-04-13 13:47:19');

-- --------------------------------------------------------

--
-- Table structure for table `hire_images`
--

CREATE TABLE `hire_images` (
  `id` int(11) NOT NULL,
  `hire_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hire_images`
--

INSERT INTO `hire_images` (`id`, `hire_id`, `image`, `created_at`, `updated_at`) VALUES
(2, 2, '2449_1681392226.jpg', '2023-04-13 13:23:46', '2023-04-13 13:23:46'),
(3, 2, '2783_1681393639.jpg', '2023-04-13 13:47:19', '2023-04-13 13:47:19'),
(4, 2, '8614_1681393643.jpg', '2023-04-13 13:47:23', '2023-04-13 13:47:23');

-- --------------------------------------------------------

--
-- Table structure for table `hire_info`
--

CREATE TABLE `hire_info` (
  `id` int(11) NOT NULL,
  `quote_id` int(11) NOT NULL,
  `hire_orders_id` int(11) DEFAULT NULL,
  `product_id` varchar(100) DEFAULT NULL,
  `min_hire_period` text DEFAULT NULL,
  `payment_terms` varchar(255) DEFAULT NULL,
  `purcharse_period` varchar(255) DEFAULT NULL,
  `consumables` text DEFAULT NULL,
  `transport_in` text DEFAULT NULL,
  `weekly_hire_price` int(15) DEFAULT NULL,
  `fittings_price` int(15) DEFAULT NULL,
  `transport_out_price` int(15) DEFAULT NULL,
  `delivery_location` varchar(255) DEFAULT NULL,
  `site_contact` varchar(255) DEFAULT NULL,
  `hire_start` date DEFAULT NULL,
  `hire_end` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hire_info`
--

INSERT INTO `hire_info` (`id`, `quote_id`, `hire_orders_id`, `product_id`, `min_hire_period`, `payment_terms`, `purcharse_period`, `consumables`, `transport_in`, `weekly_hire_price`, `fittings_price`, `transport_out_price`, `delivery_location`, `site_contact`, `hire_start`, `hire_end`, `created_at`, `updated_at`) VALUES
(1, 0, 3, '2', '8 weeks', 'test', 'TBClt', '4 weeks', '£350+vat', 0, 0, 0, 'Griffon Road, Quarry Hill Industrial Estate, DE7 4RF Ilkeston', 'TBC', '2023-05-10', '2023-06-10', '2023-05-17 11:34:51', '2023-05-17 11:34:51'),
(2, 6, 1, '3', '8 weeks', 'test', 'TBClt', '4 weeks', '£350+vat', 0, 0, 0, 'Griffon Road, Quarry Hill Industrial Estate, DE7 4RF Ilkeston', 'TBC', '2023-05-10', '2023-06-10', '2023-05-17 12:10:22', '2023-05-17 12:10:22'),
(3, 6, 3, '6', '8 weeks', 'test', 'TBClt', '4 weeks', '£350+vat', 0, 0, 0, 'Griffon Road, Quarry Hill Industrial Estate, DE7 4RF Ilkeston', 'TBC', '2023-05-10', '2023-06-10', '2023-05-19 01:33:53', '2023-05-19 01:33:53'),
(5, 0, 5, '1', 'gg', 'gs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-19 12:48:41', '2023-05-19 12:48:41');

-- --------------------------------------------------------

--
-- Table structure for table `hire_orders`
--

CREATE TABLE `hire_orders` (
  `id` int(11) NOT NULL,
  `order_number` varchar(255) DEFAULT NULL,
  `agreement_no` text DEFAULT NULL,
  `quote_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `price` float NOT NULL,
  `currency` varchar(100) NOT NULL DEFAULT '€',
  `qty` varchar(255) DEFAULT NULL,
  `tax` float NOT NULL,
  `total_price` float NOT NULL,
  `serial_number` varchar(255) DEFAULT NULL,
  `PDI_status` int(4) DEFAULT 0 COMMENT '1=>Approved,0=>Defected',
  `PDI_message` text DEFAULT NULL,
  `payment_confirm` int(4) NOT NULL DEFAULT 0 COMMENT '1=>Yes,0=>No',
  `delivered` int(4) NOT NULL DEFAULT 0,
  `delivery_date` date DEFAULT NULL,
  `is_read` int(4) NOT NULL DEFAULT 0,
  `sendprivew` int(4) NOT NULL DEFAULT 0,
  `pdf_url` text NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `machines_submit` text DEFAULT NULL,
  `insurance` int(4) NOT NULL DEFAULT 0 COMMENT '1=>Yes,0=>No',
  `deposit` int(4) NOT NULL DEFAULT 0 COMMENT '1=>Yes,0=>No',
  `returned` int(4) NOT NULL DEFAULT 0 COMMENT '1=>Yes,0=>No',
  `date_duration` date DEFAULT NULL,
  `duration` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `order_status` int(4) NOT NULL DEFAULT 1 COMMENT '1=>Ok,10=>Waitlist',
  `depot` varchar(255) DEFAULT NULL,
  `extras` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) NOT NULL,
  `transport` varchar(255) DEFAULT NULL,
  `transport_price` float NOT NULL,
  `payment_terms` varchar(255) DEFAULT NULL,
  `delivery_price` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hire_orders`
--

INSERT INTO `hire_orders` (`id`, `order_number`, `agreement_no`, `quote_id`, `user_id`, `customer_id`, `product_id`, `price`, `currency`, `qty`, `tax`, `total_price`, `serial_number`, `PDI_status`, `PDI_message`, `payment_confirm`, `delivered`, `delivery_date`, `is_read`, `sendprivew`, `pdf_url`, `notes`, `machines_submit`, `insurance`, `deposit`, `returned`, `date_duration`, `duration`, `date`, `order_status`, `depot`, `extras`, `payment_type`, `transport`, `transport_price`, `payment_terms`, `delivery_price`, `created_at`, `updated_at`) VALUES
(1, '#ON015', 'CB015VB', 0, 116, 3, '5', 200, '£', '1', 46, 246, '80968', 0, NULL, 0, 0, NULL, 0, 0, '', 'fvd', NULL, 0, 0, 0, '2023-05-19', 'teesss', '2023-05-19', 0, '65', 'test', '', 'rrrr', 30, NULL, 0, '2023-05-19 00:13:18', '2023-05-19 00:13:18'),
(2, '#ON02', 'CB02VB', 6, 167, 9, '3', 180, '$', '2', 82.8, 442.8, '', 0, NULL, 0, 0, NULL, 0, 1, 'hireorder_9u58tiQThD.pdf', NULL, NULL, 0, 0, 0, NULL, NULL, '2023-05-19', 0, NULL, NULL, '', NULL, 0, NULL, 0, '2023-05-19 00:20:12', '2023-05-19 00:20:12'),
(3, '#ON03', 'CB03VB', 6, 167, 9, '6', 180, '$', '2', 82.8, 442.8, '', 0, NULL, 0, 0, NULL, 0, 1, 'hireorder_D0JzyviHQ8.pdf', NULL, NULL, 0, 0, 0, NULL, NULL, '2023-05-19', 0, NULL, NULL, '', NULL, 0, NULL, 0, '2023-05-19 00:20:13', '2023-05-19 00:20:13'),
(5, '#ON04', 'CB04VB', 0, 116, 3, '1', 100, '€', '2', 46, 246, '', 0, NULL, 0, 0, NULL, 0, 1, '', NULL, NULL, 0, 0, 0, NULL, NULL, '2023-05-19', 0, NULL, NULL, '', NULL, 0, NULL, 0, '2023-05-19 01:08:23', '2023-05-19 01:08:23');

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
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
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `title`, `customer_id`, `name`, `lead_source`, `vat_number`, `email`, `phone`, `address`, `address2`, `town`, `county`, `eircode`, `message`, `user_id`, `date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'title', 3, 'lalit', NULL, NULL, 'lalit@gmail.com', '78898888', 'address', NULL, NULL, NULL, NULL, NULL, 116, '2023-04-28', 'In Progress', '2023-04-28 04:22:03', '2023-04-28 04:22:03'),
(2, 'title', 1, 'lalit', NULL, NULL, 'lalit@gmail.com', '78898888', 'address', NULL, NULL, NULL, NULL, NULL, 167, '2023-05-10', 'In Progress', '2023-05-10 01:44:19', '2023-05-10 01:44:19'),
(3, 'test', 9, 'Darren Mcsorley', NULL, NULL, 'Darren@quarryplant.ie', '0868562402', 'BROWNSTOWN ROAD\n', NULL, NULL, NULL, NULL, NULL, 122, '2023-05-16', 'Quote Sent', '2023-05-16 03:30:45', '2023-05-16 03:30:45'),
(4, 'demodmc', 11, 'Joe Bloggs', NULL, NULL, 'test@dmcconsultancy.com', '0871323956', 'Newcastle', NULL, NULL, NULL, NULL, NULL, 167, '2023-05-16', 'Quote Sent', '2023-05-16 03:35:37', '2023-05-16 03:35:37'),
(5, 'dmc', 9, 'Darren Mcsorley', NULL, NULL, 'Darren@quarryplant.ie', '0868562402', 'BROWNSTOWN ROAD\n', NULL, NULL, NULL, NULL, NULL, 167, '2023-05-16', 'Quote Sent', '2023-05-16 03:55:53', '2023-05-16 03:55:53'),
(6, 'csda', 9, 'Darren Mcsorley', NULL, NULL, 'Darren@quarryplant.ie', '0868562402', 'BROWNSTOWN ROAD\n', NULL, NULL, NULL, NULL, NULL, 167, '2023-05-17', 'Quote Sent', '2023-05-17 09:53:06', '2023-05-17 09:53:06');

-- --------------------------------------------------------

--
-- Table structure for table `lead_comments`
--

CREATE TABLE `lead_comments` (
  `id` int(11) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `comment_by` int(11) NOT NULL,
  `comment` text NOT NULL,
  `is_read` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(0, '2014_10_12_000000_create_users_table', 1),
(0, '2014_10_12_100000_create_password_resets_table', 1),
(0, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(3, 'FJS @ QMS\'21', 'Visit FJS Plant Repairs Ltd at CQMS’21 Stand 25 - Zone 3. \r\n\r\nBuy tickets here: ? https://www.eventbrite.ie/e/cqms-21-tickets-159970057749', '1628859266.png', 1, '2021-08-13 17:24:27', '2021-08-13 17:24:27');

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `make` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`id`, `name`, `mobile`, `email`, `make`, `model`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Vikas Nagar', '01234567890', 'vikas@gmail.com', 'KUBOTA', 'K008-3', 'samfjnskjv dkjn vkjsdnkj vnkjsnkjsnvkljdsnvkj skjdlnvkljnskjnvkjdnfsvhj ndfkjs vkjidnfskjvl', '2021-08-20 16:31:40', '2021-08-20 16:31:40'),
(2, 'Martin Lehane', '0863033856', 'Mlehane86@gmail.com', 'Liugong', '9027F Stage V', 'Hi, \r\nI\'m looking for cab parts & glass for a Liugong 9027F ZTS. \r\nI\'d appreciate a call back ASAP! \r\n\r\nThanks,\r\nMartin', '2021-10-26 00:04:39', '2021-10-26 00:04:39'),
(3, 'Karl Hughes', '0872456252', 'karl@dmcconsultancy.com', 'Liugong', '909ECR', 'TEST EMAIL', '2021-10-28 17:28:56', '2021-10-28 17:28:56'),
(4, 'Karl Hughes', '0876767676', 'karl@dmcconsultancy.com', 'KUBOTA', 'KX019-4', 'TEST', '2021-10-28 17:29:18', '2021-10-28 17:29:18'),
(5, 'Karl Hughes', '0987878787', 'karl@dmcconsultancy.com', 'KUBOTA', 'K008-3', 'TEST', '2021-11-02 21:08:55', '2021-11-02 21:08:55'),
(6, 'Karl Hughes', '08717171717', 'karl@dmcconsultancy.com', 'KUBOTA', 'KX015-4', 'test', '2021-11-02 21:12:48', '2021-11-02 21:12:48'),
(7, 'Test', '123456890', 'test@gmail.com', 'FRD', 'FDG05-PL', 'test', '2021-11-03 12:57:04', '2021-11-03 12:57:04'),
(8, 'Test', '123456890', 'test@gmail.com', 'KUBOTA', 'KX015-4', 'stores@fjsplant.ie', '2021-11-03 12:59:35', '2021-11-03 12:59:35'),
(9, 'Karl Hughes', '08767676767', 'karl@dmcconsultancy.com', 'Liugong', '909ECR', 'TEST', '2021-11-08 19:12:00', '2021-11-08 19:12:00'),
(10, 'Karl Hughes', '0867273636', 'karl@dmcconsultancy.com', 'Liugong', '909ECR', 'TEST', '2021-11-08 19:12:37', '2021-11-08 19:12:37'),
(11, 'Test', '123456890', 'test@gmail.com', 'KUBOTA', 'KX016-4', 'My Code not Working', '2021-11-08 20:09:03', '2021-11-08 20:09:03'),
(12, 'unused-files', '1234567890', 'admin@gmail.com', 'KUBOTA', 'KC110HR-4', 'Testing', '2021-11-08 20:14:02', '2021-11-08 20:14:02'),
(13, 'test.php', '1234567890', 'aakashsoni048@gmail.com', 'KUBOTA', 'KX019-4', 'Testing', '2021-11-08 20:14:21', '2021-11-08 20:14:21'),
(14, 'ajay', '09303119152', 'ajjukanojiya@152gmail.com', 'KUBOTA', 'R070', 'hi this ajay create for test', '2021-11-08 20:42:01', '2021-11-08 20:42:01'),
(15, 'akash', '1234567890', 'akash@gmail.com', 'KUBOTA', 'R070', 'hi this create by aksh fir demo', '2021-11-08 20:47:16', '2021-11-08 20:47:16'),
(16, 'Test', '123456890', 'test@gmail.com', 'KUBOTA', 'KX016-4', 'stripe/eception/invalidrequestexception amount must convert to at least 50 cents. ? converts to approximently € 0.06', '2021-11-09 12:17:52', '2021-11-09 12:17:52'),
(17, 'ajay', '09303119152', 'ajjukanojiya@152gmail.com', 'KUBOTA', 'KX042-4', 'ccvcx', '2021-11-10 12:58:41', '2021-11-10 12:58:41'),
(18, 'ajay', '09303119152', 'ajjukanojiya@152gmail.com', 'KUBOTA', 'KC110HR-4', 'xzcx', '2021-11-10 13:00:06', '2021-11-10 13:00:06'),
(19, 'ajay', '09303119152', 'ajjukanojiya@152gmail.com', 'KUBOTA', 'KC110HR-4', 'xzcx', '2021-11-10 13:00:36', '2021-11-10 13:00:36'),
(20, 'ajay', '09303119152', 'ajjukanojiya@152gmail.com', 'Evoquip', 'Harrier 750', 'cdfg', '2021-11-10 13:03:59', '2021-11-10 13:03:59'),
(21, 'Karl Hughes', '0877187181', 'hugheskarl@hotmail.com', 'Liugong', '909ECR', 'TEST', '2021-11-11 18:36:43', '2021-11-11 18:36:43'),
(22, 'Alan kirwan', '0878164457', 'kirwanconstruction1@gmail.com', 'KUBOTA', 'K008-3', 'Hi, I have a kubota k008-3  year 2005. I need a replacement bucket link. A set Bucket bushes.  6 clips for pins. All filters for service and oil. \r\nWould you have all this in stock ?\r\n\r\nThanks\r\n\r\nAlan Kirwan', '2021-12-22 15:20:58', '2021-12-22 15:20:58'),
(23, 'test', '045863542', 'enquiries@fjsplant.ie', 'Liugong', '909ECR', 'test - Clive can you let me know if you receive this - Robyn', '2022-06-15 18:23:59', '2022-06-15 18:23:59');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `tokenable_id` int(11) NOT NULL,
  `tokenable_type` text NOT NULL,
  `abilities` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_used_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `name`, `token`, `tokenable_id`, `tokenable_type`, `abilities`, `created_at`, `updated_at`, `last_used_at`) VALUES
(1, 'HJhhauyushjs', 'a29f5b8355976d0cd590245b587b54c6b92964d17f897e1cdcd7c9745a3b1bcb', 126, 'App\\Models\\User', '[\"*\"]', '2022-01-07 21:37:55', '2022-01-07 21:37:55', NULL),
(2, 'HJhhauyushjs', '4dda48fe9e675f8dd36376db661ec108161c3113fdc25f412a3cc13f4e282f93', 126, 'App\\Models\\User', '[\"*\"]', '2022-01-07 21:38:44', '2022-01-07 21:38:44', NULL),
(3, 'auth_token', '1090abbd67428fa0455c4ff295bd9eaf3d13a0a0411a97c3dbab44094ac9c5b3', 126, 'App\\Models\\User', '[\"*\"]', '2022-01-07 21:41:12', '2022-01-07 21:45:06', '2022-01-07 21:45:06'),
(4, 'auth_token', '3e03e8346ce49dfac247db3b073e941892a1211a4a9c9cafaf1f7c2453fceede', 126, 'App\\Models\\User', '[\"*\"]', '2022-01-10 11:02:54', '2022-01-10 11:02:54', NULL),
(5, 'auth_token', '1b48ec8246469960f05c551b5142605c6d3fb033572145f102b544fef38b7bd5', 126, 'App\\Models\\User', '[\"*\"]', '2022-01-10 11:15:41', '2022-01-10 11:15:41', NULL),
(6, 'auth_token', '0d8c518eb251658d5cbe8182f32f2c41c7abfe50e5083c689ae1478ecddef4b1', 126, 'App\\Models\\User', '[\"*\"]', '2022-01-10 11:50:58', '2022-07-05 11:17:50', '2022-07-05 11:17:50'),
(7, 'auth_token', '6652ab027c0b32763d944b597dcaf6e834eb136147149d0cdaaeff186430b3c0', 126, 'App\\Models\\User', '[\"*\"]', '2022-01-10 17:32:43', '2022-02-02 11:13:33', '2022-02-02 11:13:33'),
(8, 'auth_token', 'f438a70e76e86b01b79bb740a81113d938c2a2f02ebfc3d031eff7c5202ddb47', 126, 'App\\Models\\User', '[\"*\"]', '2022-01-10 17:38:50', '2022-01-10 17:38:50', NULL),
(9, 'auth_token', '51dd0ad1a43d72db9004eea4267ff1486818e40cfd7c6fba9a3075590c4c02de', 126, 'App\\Models\\User', '[\"*\"]', '2022-01-10 17:39:38', '2022-01-10 17:39:38', NULL),
(10, 'auth_token', '7a2783f5955e210358209d8a1f22c91a31643693ee82273a906c236b35c77922', 126, 'App\\Models\\User', '[\"*\"]', '2022-01-10 17:39:45', '2022-08-10 04:00:28', '2022-08-10 04:00:28'),
(11, 'auth_token', '90d563d942b20078fe858305abb7c291d063113503c5f1774079d2fc5c1e15b6', 126, 'App\\Models\\User', '[\"*\"]', '2022-01-10 17:44:25', '2022-01-10 17:44:25', NULL),
(12, 'auth_token', '16f8c62fe46223cb77dfe85a4a31f8c3c904f7f1785e947af293d954648258b7', 126, 'App\\Models\\User', '[\"*\"]', '2022-01-10 17:47:56', '2022-01-10 17:47:56', NULL),
(13, 'auth_token', 'dc57a3aa04e699860e7e64d6e58916c097dbec24e38f0921d8164bf34eb77621', 126, 'App\\Models\\User', '[\"*\"]', '2022-01-10 17:54:06', '2022-01-10 17:54:06', NULL),
(14, 'auth_token', 'ae36ba83af30e7a30af2eed17a9fed0d75f8011062ff493e24a885f162e251df', 126, 'App\\Models\\User', '[\"*\"]', '2022-01-10 18:49:03', '2022-01-10 18:49:03', NULL),
(15, 'auth_token', 'a926f8f851a910e06022cd47964646b997494aea9a9e722fc3411cbc9a91dec9', 126, 'App\\Models\\User', '[\"*\"]', '2022-01-10 18:56:23', '2022-01-10 18:56:23', NULL),
(16, 'auth_token', 'a1b0e44ff955a975ee6a8606543790e77fe50f2291ff690339096151fc9648c1', 126, 'App\\Models\\User', '[\"*\"]', '2022-01-10 19:13:59', '2022-01-10 19:13:59', NULL),
(17, 'auth_token', '73dcd99b4566b87133ac0ab0760037a37c18c963e1e3f8047466eecbea8c41a5', 126, 'App\\Models\\User', '[\"*\"]', '2022-01-10 19:28:24', '2022-01-10 19:28:24', NULL),
(18, 'auth_token', '93082f55e2bd80c535311d0fd750b2e9727ee1b8c12b29e7329120f64205dce6', 126, 'App\\Models\\User', '[\"*\"]', '2022-01-10 19:35:03', '2022-01-10 19:35:03', NULL),
(19, 'auth_token', '74bbcc1460874c920ac3ba0a8fbac1b57079ee65e90382f365deeb7fd12033fd', 126, 'App\\Models\\User', '[\"*\"]', '2022-01-12 19:42:22', '2022-01-12 19:42:22', NULL),
(20, 'auth_token', 'caf8418eb528b6ea535a93e5790139b2c48a914ae51532cc20d8f4aa6ce601f8', 126, 'App\\Models\\User', '[\"*\"]', '2022-01-13 13:37:59', '2022-01-13 13:37:59', NULL),
(21, 'auth_token', '102080ccbc1f5bbb231bc086ef76f5d221f6a616646e0790ae63e46b7cf81561', 126, 'App\\Models\\User', '[\"*\"]', '2022-01-13 13:38:57', '2022-01-13 13:38:57', NULL),
(22, 'auth_token', '87111881d4574fc1dcd6ea12358fa2cb39ba59cb67a81603afb08e8971d59f08', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-02 11:12:37', '2022-02-02 11:12:37', NULL),
(23, 'auth_token', 'e767b363aa3a178c195ce2f9bb3fada65920baa7567354c54c667c7af3d63268', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-02 12:03:25', '2022-02-02 12:03:25', NULL),
(24, 'auth_token', '6638fd92cec268ef7b340d7c65b80c7a5faf943a44a61c41f0ae889abf46e193', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-02 12:04:06', '2022-02-02 12:04:06', NULL),
(25, 'auth_token', '15980ade57c0a0c8df420c03766f9ab23612c72757811d97a8ad80e23fa8bc2e', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-02 12:05:54', '2022-02-02 12:05:54', NULL),
(26, 'auth_token', '8a70d9f2c959ac49d58ee671abb87e87178b041a4d9e13d41dadafab649c1195', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-02 12:07:23', '2022-02-02 12:07:23', NULL),
(27, 'auth_token', 'fe6c2e5a7b4f5caafcb727c6301cecfd24d63e207c3d44e1702c2f5ddf35473a', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-02 12:11:31', '2022-02-02 12:11:31', NULL),
(28, 'auth_token', 'aead286a40f4019c05f91df1ab9561244d30cc5b8756e8b3cfa56f8422d0c33b', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-02 12:16:18', '2022-02-02 12:16:18', NULL),
(29, 'auth_token', 'a4560b5f2e670b2f51bd3e9310e5b05acbc6964dde8c2ab96a9d5aa57c6a6e8a', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-02 12:19:27', '2022-02-02 12:19:27', NULL),
(30, 'auth_token', '0ed11da3e93383f08b6fe029b50aa6004bbd897fb48b2729abfe685a8ce7cedf', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-02 12:21:37', '2022-02-02 12:21:37', NULL),
(31, 'auth_token', '4a067118268f27808e8fe3ed998f8cb46cb00fe89654097a3be789d65ee26000', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-02 12:27:24', '2022-02-02 12:29:00', '2022-02-02 12:29:00'),
(32, 'auth_token', '34ddb2d1813724cc7a21918c9465e1472571377ed3329754d00c85019b8f74f8', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-02 12:33:05', '2022-02-02 12:33:05', NULL),
(33, 'auth_token', '0688df791b4de3003e845cfe76258e12650830273f2c0165f5cf6695a1ac6a8f', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-02 12:34:47', '2022-02-02 12:34:47', NULL),
(34, 'auth_token', '3fd984660e35f1e0c7538e42cc754ba53f714f9e8b6c3e529eb705ab92880bca', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-02 12:36:47', '2022-02-02 12:36:47', NULL),
(35, 'auth_token', '5bd5ccb0d265ec053fcb8fbfc24b85ee2c611a69f071e6fc726ea0e2128ae112', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-02 12:38:13', '2022-02-02 13:05:41', '2022-02-02 13:05:41'),
(36, 'auth_token', 'fed0b385c8340d5fc04b07dba2032016e9385e8d028f36fe3c3c78ba18b930d3', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-02 13:17:20', '2022-02-03 16:25:00', '2022-02-03 16:25:00'),
(37, 'auth_token', 'bde6e45b04dd69a197b6e3945b7f7b904128183ff0f2ff9de7ad89af76ccbdc5', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-10 16:59:26', '2022-02-10 18:01:03', '2022-02-10 18:01:03'),
(38, 'auth_token', '774dcfd9ee0ff77717735ba6767868c3776d0f7e6be5013e2516dc7e59078b34', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-11 11:41:50', '2022-05-06 15:20:20', '2022-05-06 15:20:20'),
(39, 'auth_token', '0ed212dff8c24048ebbdf752a611cff9558b803b5674e89727eed34646a4f91a', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-14 16:39:20', '2022-02-14 16:39:20', NULL),
(40, 'auth_token', '95db2c65b0778cd5dc01187dfca3ffebaff0416cebf7207cafd497dfecad5534', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-14 17:04:49', '2022-02-15 12:09:58', '2022-02-15 12:09:58'),
(41, 'auth_token', '9f256a2b884b3456700045b9f2acbc0fe424f3e286d39a52a7ca7c129d81c78d', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-14 17:08:53', '2022-03-01 18:47:32', '2022-03-01 18:47:32'),
(42, 'auth_token', '5823c80191fd0b16e20029651dd3f3c9dc6d6b8e5b712025967e18147fa9cfbd', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-15 12:33:03', '2022-02-17 19:20:39', '2022-02-17 19:20:39'),
(43, 'auth_token', '77e9724a4809cbeb23a0643a19044a7a3cf29c18452f9ed638deb8ccb83647ee', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-15 13:41:40', '2022-02-15 13:41:40', NULL),
(44, 'auth_token', '1b43910699f380943956e7ee93a9a7731e6bd260ea2cf9b4cfe8c60f46a296c0', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-15 13:47:49', '2022-02-18 18:35:56', '2022-02-18 18:35:56'),
(45, 'auth_token', '55d171be6828ec638690a47170ff5e8f3d7419511fb3c96f4f217bd32983f4ef', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-15 14:14:16', '2022-02-15 17:14:36', '2022-02-15 17:14:36'),
(46, 'auth_token', '2d3596d6d4afd9b0b83ec989bf620357a7fc874738997a302945ab2dd5441e25', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-18 11:30:51', '2022-02-18 11:30:51', NULL),
(47, 'auth_token', 'b8921846afec257d5270f472835fbc7315b8160da7ea177d6520dfd4eb7d0b7c', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-18 17:06:10', '2022-02-18 17:06:10', NULL),
(48, 'auth_token', 'ad343eac896d8908fc943c0ae9e139446a1ea5fd2b9091830599521a993bea17', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-22 11:33:30', '2022-02-23 17:02:15', '2022-02-23 17:02:15'),
(49, 'auth_token', '29eed68ed008742283601b9b81d655166664206677cfdd0c68fcea94a20dfdf1', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-22 11:36:01', '2022-02-22 11:36:01', NULL),
(50, 'auth_token', '4af9d5e3ae3804ebcfdc7d9714f5ffb4dc784bb87ddc248f6db2d6feab38b1c7', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-22 12:18:51', '2022-02-22 12:18:51', NULL),
(51, 'auth_token', '4c7cac9aa51e37c1e560616c80181145f29312579aad70453fc3d82e096a8a88', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-22 12:19:25', '2022-02-22 12:19:25', NULL),
(52, 'auth_token', '458bdcf0acb0f1cc9e0371e88a8a25d3bbe329bcc3c78900039dbf835c712a9e', 112, 'App\\Models\\User', '[\"*\"]', '2022-02-22 12:19:51', '2022-02-22 12:19:51', NULL),
(53, 'auth_token', 'c2003e57313e73349447ed0edc162b5a2a3f3eb69ec3b7dec9f0821f0c70421a', 112, 'App\\Models\\User', '[\"*\"]', '2022-02-22 12:19:54', '2022-02-22 12:53:15', '2022-02-22 12:53:15'),
(54, 'auth_token', '96fe8c3164abd930c6b703f0a8b942bc265789738c2d1f753d7d5c319eadd30b', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-23 18:10:54', '2022-02-23 18:10:54', NULL),
(55, 'auth_token', 'ec673bcbefe831ebf2e977426cb5da0bb0bd0bb1b25f3cb0b530b0533ec96f2f', 126, 'App\\Models\\User', '[\"*\"]', '2022-02-23 18:12:01', '2022-02-28 20:35:27', '2022-02-28 20:35:27'),
(56, 'auth_token', '3ac11c4bf32c5d35aa4c12d614a77a243eb61ff1bd24bf9edee4fc08a0a3473c', 112, 'App\\Models\\User', '[\"*\"]', '2022-02-24 18:57:38', '2022-02-24 18:57:38', NULL),
(57, 'auth_token', 'c93fc3eda154914dd24513ccec887972466a38bd8bb9975ecca4d3bb7e8b0141', 112, 'App\\Models\\User', '[\"*\"]', '2022-02-24 18:57:45', '2022-02-24 18:57:45', NULL),
(58, 'auth_token', '4d01455bca2e2e9f865059c499a20e27e17bef70345415d82c3cea7730df105d', 112, 'App\\Models\\User', '[\"*\"]', '2022-02-24 18:57:58', '2022-02-28 15:49:15', '2022-02-28 15:49:15'),
(59, 'auth_token', 'd41f43466623f07138e5851514e4b547eb7265faaa9bff8222235c41ad39c0d0', 116, 'App\\Models\\User', '[\"*\"]', '2022-02-24 22:30:25', '2022-02-24 22:30:25', NULL),
(60, 'auth_token', '3b23870d48ed4e0dbbd61d7e863ceaf561167a28e89feea10b451c88a5d2e52b', 116, 'App\\Models\\User', '[\"*\"]', '2022-02-24 22:30:30', '2022-03-21 21:49:06', '2022-03-21 21:49:06'),
(61, 'auth_token', '7f647a42ee914f69c51762c5727b3b2d0373311a2775c93ea12ec58c87b5340a', 126, 'App\\Models\\User', '[\"*\"]', '2022-03-01 17:56:10', '2022-03-01 17:56:10', NULL),
(62, 'auth_token', '68f599b59d43184cb08df88e91987708dff6ad7d8e192c2864a5f1f5944b7bb2', 126, 'App\\Models\\User', '[\"*\"]', '2022-03-01 17:56:16', '2022-03-01 17:56:16', NULL),
(63, 'auth_token', '82b9fc3829001f7d0853cfe92f075fed96ae8e73fb0d29e08972162a15fc15ca', 126, 'App\\Models\\User', '[\"*\"]', '2022-03-01 17:56:19', '2022-03-01 17:56:19', NULL),
(64, 'auth_token', '0eae3801affd68f86f829574a0ede5884d9c7533b8bfbb387704a29228b59eb4', 126, 'App\\Models\\User', '[\"*\"]', '2022-03-01 17:56:20', '2022-03-01 17:56:20', NULL),
(65, 'auth_token', '928a50e241c3dfcd4bb88a32eefe33b2059b8240d883f9b3731159bd5d235d1c', 126, 'App\\Models\\User', '[\"*\"]', '2022-03-01 17:57:42', '2022-03-01 17:57:42', NULL),
(66, 'auth_token', 'e924ac6f06764b7909abc9c6957950758d02ff1cdd1d14c38067451e5a5c630c', 126, 'App\\Models\\User', '[\"*\"]', '2022-03-01 17:57:48', '2022-03-01 18:28:04', '2022-03-01 18:28:04'),
(67, 'auth_token', '4ebef4ffcc5e3f0fc72bdc92ce3d5c08a6a6cdab28824095a0c9afa8c8e7bf67', 126, 'App\\Models\\User', '[\"*\"]', '2022-03-01 18:50:46', '2022-03-02 16:37:03', '2022-03-02 16:37:03'),
(68, 'auth_token', '71f361b8cac06635004e377b0b95e10ab87a5158fc65fe231fcba639d0dd1754', 126, 'App\\Models\\User', '[\"*\"]', '2022-03-01 19:51:18', '2022-03-01 19:51:18', NULL),
(69, 'auth_token', '25d244d501c462dc7414c582eff1fb4159dc3da1fcfae90487a3ca8bfcc95b27', 126, 'App\\Models\\User', '[\"*\"]', '2022-03-01 19:59:30', '2022-03-01 20:42:50', '2022-03-01 20:42:50'),
(70, 'auth_token', 'a79620fd299029ef2dab46d8649d1d51b3ea207f34c022b15472a9d2466bebbe', 126, 'App\\Models\\User', '[\"*\"]', '2022-03-02 16:42:10', '2022-03-02 16:43:24', '2022-03-02 16:43:24'),
(71, 'auth_token', '8ca9a1450508a2b5f9e9bc51771ec62b7ed5deb916b68dbb3dd3b71e3f40f25d', 126, 'App\\Models\\User', '[\"*\"]', '2022-03-02 16:45:34', '2022-03-02 16:51:59', '2022-03-02 16:51:59'),
(72, 'auth_token', '808683c6e409e5b9d702327e17c61f39c239daeab8ff1341a276a5e8c5214e1b', 126, 'App\\Models\\User', '[\"*\"]', '2022-03-02 16:55:21', '2022-04-01 11:53:06', '2022-04-01 11:53:06'),
(73, 'auth_token', '33d724f3aa92532eabaeabae396f9ac637ac47b2a47868ece1ea16fc376bc4f1', 126, 'App\\Models\\User', '[\"*\"]', '2022-03-03 11:14:03', '2022-03-03 11:15:34', '2022-03-03 11:15:34'),
(74, 'auth_token', '9289cf78de9b762fdb1b3587f3abd75913a3875d5f567d6c9389d7ae48f5de19', 126, 'App\\Models\\User', '[\"*\"]', '2022-03-03 11:26:12', '2022-03-03 12:26:49', '2022-03-03 12:26:49'),
(75, 'auth_token', '2ca9fde05e11c91798d956fe3e37eb199cc1997f4fec9d85e70a0f53578ef11c', 126, 'App\\Models\\User', '[\"*\"]', '2022-03-03 12:28:13', '2022-03-03 12:28:13', NULL),
(76, 'auth_token', 'b89d28a55fe7e51d98ad75c4d5520ecbf9fedf8ba36130bf80f9e60e2405d342', 126, 'App\\Models\\User', '[\"*\"]', '2022-03-03 12:29:38', '2022-03-03 12:29:38', NULL),
(77, 'auth_token', '8130d7ecfead9fa1191700a5649c59e6be115f82b3c821d85ddaf38cd6a66eda', 126, 'App\\Models\\User', '[\"*\"]', '2022-03-03 12:30:59', '2022-03-03 12:30:59', NULL),
(78, 'auth_token', '9573d1336328c4e00460d001059192a8019500d3a8c9f59d920a7c2e720c9108', 126, 'App\\Models\\User', '[\"*\"]', '2022-03-03 12:37:04', '2022-03-03 17:24:19', '2022-03-03 17:24:19'),
(79, 'auth_token', '430387f7495524dd2a1569ea52aec5190d0b3b7e81626f4c24c6ac39676f0dce', 126, 'App\\Models\\User', '[\"*\"]', '2022-03-03 17:32:51', '2022-03-04 18:27:16', '2022-03-04 18:27:16'),
(80, 'auth_token', 'a07516cc2671c2ee76ccbea8e9da11d216ba1c6428d40a5dc1372497c5026f18', 126, 'App\\Models\\User', '[\"*\"]', '2022-03-04 19:08:57', '2022-03-04 20:57:09', '2022-03-04 20:57:09'),
(81, 'auth_token', 'ce9a6820b34b9fa69d5bcdf9739bdedb51b156e99a669a07009f341e7f8ad51a', 126, 'App\\Models\\User', '[\"*\"]', '2022-03-09 13:01:05', '2022-03-09 14:28:29', '2022-03-09 14:28:29'),
(82, 'auth_token', '5a9dec49efeb2fad92fbf187a3f3e39acc4b8e811e001f7c6d157f4ed6b35ac7', 126, 'App\\Models\\User', '[\"*\"]', '2022-03-10 13:52:07', '2022-03-11 12:12:27', '2022-03-11 12:12:27'),
(83, 'auth_token', '9accc0e221f2e58820bfa031f1d19948a49f9cdca982d97af8268a4425675c1e', 126, 'App\\Models\\User', '[\"*\"]', '2022-03-14 12:45:28', '2022-03-14 19:38:01', '2022-03-14 19:38:01'),
(84, 'auth_token', '791f9e7070d1037f48b53bd4d0c94d4ebf363d2dc4336dc37f597d6317e31c07', 126, 'App\\Models\\User', '[\"*\"]', '2022-03-15 18:54:56', '2022-03-24 12:34:55', '2022-03-24 12:34:55'),
(85, 'auth_token', 'f8e968bfae6a4509e5346bdd2990fadff8fb70267a456592f2dfc746c0562db7', 126, 'App\\Models\\User', '[\"*\"]', '2022-04-01 11:29:57', '2022-04-01 12:40:26', '2022-04-01 12:40:26'),
(86, 'auth_token', '91691768e56ddf0726c9da76b48bff6dba2c852113b5d8d86ac5507fadd50a9d', 126, 'App\\Models\\User', '[\"*\"]', '2022-04-01 11:58:46', '2022-04-01 12:21:46', '2022-04-01 12:21:46'),
(87, 'auth_token', '80af59340de144d90488152d3b6dbb59bf91a16bd578d36a38e4824becaa8950', 126, 'App\\Models\\User', '[\"*\"]', '2022-04-01 12:26:57', '2022-04-01 12:46:25', '2022-04-01 12:46:25'),
(88, 'auth_token', '41c8f681aa19be96bfd03736f6a042c7bfa9212201ee9348ca7637ed129528f2', 126, 'App\\Models\\User', '[\"*\"]', '2022-04-01 12:53:01', '2022-04-01 13:34:30', '2022-04-01 13:34:30'),
(89, 'auth_token', '20fde8a669ec67284533c7a734bdafe6ad59499ea3eff56a04948becb941bd0f', 126, 'App\\Models\\User', '[\"*\"]', '2022-04-01 13:57:09', '2022-04-01 18:01:31', '2022-04-01 18:01:31'),
(90, 'auth_token', '11acd815da9137c2a5ff7c883bfdcbb3eef317d8a46f2c15657de45a29cdeff5', 126, 'App\\Models\\User', '[\"*\"]', '2022-04-01 16:26:24', '2022-09-14 11:30:20', '2022-09-14 11:30:20'),
(91, 'auth_token', '87bd12f13687841cb4595a08d68b8db05446d242e0df82af249d7a7ff157c189', 126, 'App\\Models\\User', '[\"*\"]', '2022-04-01 16:53:39', '2022-04-01 17:10:54', '2022-04-01 17:10:54'),
(92, 'auth_token', '02c700b766e4b924609061879b0486a7ca35c476b29af20fa2048a0b7b0d1e53', 126, 'App\\Models\\User', '[\"*\"]', '2022-04-01 17:37:38', '2022-04-05 16:24:55', '2022-04-05 16:24:55'),
(93, 'auth_token', '53e280865c14e549f57230a3e4bb10c7b6ceb351ae7cf07dcdbff572e436ba7a', 126, 'App\\Models\\User', '[\"*\"]', '2022-04-04 11:15:53', '2022-04-04 16:45:01', '2022-04-04 16:45:01'),
(94, 'auth_token', '3b3de9ebcdb6294e5bc4c9935c676f2b5c6912f3275c1f4de62c5e6898818a88', 126, 'App\\Models\\User', '[\"*\"]', '2022-04-04 11:25:06', '2022-04-04 11:25:06', NULL),
(95, 'auth_token', 'e84a0536e188d77ee0587327a0148dae88bf30427490dd3a38d772dc7b091863', 126, 'App\\Models\\User', '[\"*\"]', '2022-04-04 17:15:18', '2022-04-05 12:15:26', '2022-04-05 12:15:26'),
(96, 'auth_token', '713fa2ed43ed802a58f702bc489cf31b5f0ab7da26ae469e6a396e63c7664773', 126, 'App\\Models\\User', '[\"*\"]', '2022-04-04 17:33:43', '2022-04-04 18:08:38', '2022-04-04 18:08:38'),
(97, 'auth_token', '23fac1d7aef32c39e3e0328b3f67832fb2e32f5f2f1fc36a0477d3b2d65ca39e', 126, 'App\\Models\\User', '[\"*\"]', '2022-04-05 14:08:22', '2022-05-06 13:47:24', '2022-05-06 13:47:24'),
(98, 'auth_token', 'e33ded6808193c2ae530b0c442ed8e0afacb0faa449cfb5de0b3e8c98f854739', 126, 'App\\Models\\User', '[\"*\"]', '2022-04-05 16:57:03', '2022-06-23 08:16:44', '2022-06-23 08:16:44'),
(99, 'auth_token', '153a55d543ee090d956322dd566e2a0b3c77b8147a1afb5df376cf3e98f109ab', 126, 'App\\Models\\User', '[\"*\"]', '2022-04-06 12:09:17', '2022-04-06 12:42:06', '2022-04-06 12:42:06'),
(100, 'auth_token', '116ea07e189cf4378e841eee246b27fbfc132f6d974b0fca7f80475b6a5f16ab', 126, 'App\\Models\\User', '[\"*\"]', '2022-04-06 12:45:42', '2022-08-10 04:00:53', '2022-08-10 04:00:53'),
(101, 'auth_token', 'c3210929c09caa64cbfdfefcdd08a78619c408104bbdbd77632892189e56a273', 126, 'App\\Models\\User', '[\"*\"]', '2022-04-06 16:02:30', '2022-05-06 16:55:27', '2022-05-06 16:55:27'),
(102, 'auth_token', 'fe6b95747a7b111249a0d1791d1614d2c44185a1ae5710017d18283700e5d695', 126, 'App\\Models\\User', '[\"*\"]', '2022-04-07 13:42:23', '2022-04-07 13:43:48', '2022-04-07 13:43:48'),
(103, 'auth_token', '31527ea3158ba9135fb79b4b6695c57d19211f3003508e4a5244ef8f440f5164', 116, 'App\\Models\\User', '[\"*\"]', '2022-04-07 20:12:00', '2022-05-05 21:47:37', '2022-05-05 21:47:37'),
(104, 'auth_token', '9bf4ffa896fe75a30901c16e570446eea764a01318f4d93eb01d1b43ed73b45c', 126, 'App\\Models\\User', '[\"*\"]', '2022-04-11 15:55:37', '2022-04-11 15:57:27', '2022-04-11 15:57:27'),
(105, 'auth_token', 'ec0323b096baef161e7cb608db847b7c6ca81302b8666b554bc001cbc0f5dea5', 126, 'App\\Models\\User', '[\"*\"]', '2022-05-06 14:55:36', '2022-05-06 15:31:02', '2022-05-06 15:31:02'),
(106, 'auth_token', 'c435eb18e596c0dcc2b256f5f1546ce26b7fde5c4b7d67b658f4135ce499b160', 126, 'App\\Models\\User', '[\"*\"]', '2022-05-11 18:37:51', '2022-05-11 19:02:12', '2022-05-11 19:02:12'),
(107, 'auth_token', '1c980edc1bc0115be5cc0064e508c9b2c2bf58ddf54bcda0bd75de55b63c0de5', 112, 'App\\Models\\User', '[\"*\"]', '2022-06-21 17:14:00', '2022-06-22 15:45:23', '2022-06-22 15:45:23'),
(108, 'auth_token', 'a692e4b7c177b8b491b689a40904d268232387badfc5ca7d16b1cf3561edea86', 126, 'App\\Models\\User', '[\"*\"]', '2022-06-21 17:15:10', '2022-06-21 17:17:46', '2022-06-21 17:17:46'),
(109, 'auth_token', '27194bbb6668275aed21057cf1345496a30af55f76ed4f54ca8a460e7f73d019', 126, 'App\\Models\\User', '[\"*\"]', '2022-06-21 17:49:13', '2022-06-21 17:49:13', NULL),
(110, 'auth_token', '7c5de8f5826d0a35dfd3d42f4ceeeab87df548cbcf29e4aae8e3dc49858e5354', 126, 'App\\Models\\User', '[\"*\"]', '2022-06-22 06:34:34', '2022-06-30 10:09:45', '2022-06-30 10:09:45'),
(111, 'auth_token', 'c69750ca9cc77df0cdfab9776562134af7804ab21d5464524062b2d0c00b4674', 116, 'App\\Models\\User', '[\"*\"]', '2022-06-22 11:18:10', '2022-10-21 13:14:07', '2022-10-21 13:14:07'),
(112, 'auth_token', '1b8811ce59ece721ccf6d404163a1e0fff2ed7a93077d388dca93255fbf8d0a4', 126, 'App\\Models\\User', '[\"*\"]', '2022-06-22 12:09:31', '2022-06-23 04:49:16', '2022-06-23 04:49:16'),
(113, 'auth_token', '65c7fc91d20a72e4bee59eccd509e52e5ae70a55aab65b7b35782c111428118e', 1, 'App\\Models\\User', '[\"*\"]', '2022-06-22 12:39:34', '2022-06-29 00:38:36', '2022-06-29 00:38:36'),
(114, 'auth_token', 'a5d978d2c399f2df54d0d2614b9bec4e3d2ddb1bcff6ab37e290308b41542747', 126, 'App\\Models\\User', '[\"*\"]', '2022-06-23 05:13:24', '2022-08-30 06:36:48', '2022-08-30 06:36:48'),
(115, 'auth_token', '3f3c6e47c7fcfb4e87bf32de729f2a72bdec2af180e0ba3fda4b1fcf1aa7c942', 126, 'App\\Models\\User', '[\"*\"]', '2022-06-23 06:22:09', '2022-07-26 11:14:09', '2022-07-26 11:14:09'),
(116, 'auth_token', 'c5085def1bc3b04291b2d992f3eeae8358ae300f15eebb045748515160142b47', 128, 'App\\Models\\User', '[\"*\"]', '2022-06-23 07:54:02', '2022-06-23 09:24:53', '2022-06-23 09:24:53'),
(117, 'auth_token', '23ec17b547776c250b1ca6cbe3117529f2cac68d213444532922dd37f305eb63', 126, 'App\\Models\\User', '[\"*\"]', '2022-06-23 08:13:07', '2022-06-23 09:04:17', '2022-06-23 09:04:17'),
(118, 'auth_token', '266ebc71da2f414b33db1ffa4069fc7201279d4ec40b90ed8f814bbc61d9076c', 126, 'App\\Models\\User', '[\"*\"]', '2022-06-23 09:05:21', '2022-06-23 09:05:26', '2022-06-23 09:05:26'),
(119, 'auth_token', 'd873bc72f70f5a8293eb9e617b3f9388f4f6838a71e80f322299e7eafbadacd2', 128, 'App\\Models\\User', '[\"*\"]', '2022-06-23 09:09:17', '2022-06-23 09:09:40', '2022-06-23 09:09:40'),
(120, 'auth_token', '0373741d95f86053ad9a3739f5e478f199f991fe690eddb5391a0faee336a625', 126, 'App\\Models\\User', '[\"*\"]', '2022-06-23 09:10:31', '2022-06-27 07:16:22', '2022-06-27 07:16:22'),
(121, 'auth_token', '77fb1b46552ba79fd159e526e1a81756a0d040e4c3f453f8d142839ddb2540e9', 126, 'App\\Models\\User', '[\"*\"]', '2022-06-23 09:28:38', '2022-06-23 09:49:27', '2022-06-23 09:49:27'),
(122, 'auth_token', 'b01e4905015922a6c2c7dce9bebd852fa35dedea0d38ef08d1eaee50e236881b', 128, 'App\\Models\\User', '[\"*\"]', '2022-06-23 09:56:43', '2022-06-24 06:05:03', '2022-06-24 06:05:03'),
(123, 'auth_token', 'a5962442f9b07cce638d460e661d20e80736fd201ca46ba908cb020e9026f1e5', 128, 'App\\Models\\User', '[\"*\"]', '2022-06-24 06:07:47', '2022-06-24 06:47:55', '2022-06-24 06:47:55'),
(124, 'auth_token', '9ceb3b4f3365b525ea7e47c0db70bbbfced9d74d17eda050bd326edf1963e163', 128, 'App\\Models\\User', '[\"*\"]', '2022-06-24 06:49:45', '2022-06-24 07:17:40', '2022-06-24 07:17:40'),
(125, 'auth_token', 'bb62bcab5d097163dca1844b46978d5ff29284a2b52d39b979fa1d7a1a3e8cbf', 128, 'App\\Models\\User', '[\"*\"]', '2022-06-24 07:18:57', '2022-06-27 06:29:29', '2022-06-27 06:29:29'),
(126, 'auth_token', '468fa84469bc3d699b031dadb4963c40e3f87415fa0206001a5dddb4586b0490', 128, 'App\\Models\\User', '[\"*\"]', '2022-06-30 09:31:42', '2022-07-05 05:12:46', '2022-07-05 05:12:46'),
(127, 'auth_token', 'fca1021442aa80e312de3f0f531f2bbd704deca7cb9d1e2d9b8835127c0b85c6', 128, 'App\\Models\\User', '[\"*\"]', '2022-07-01 12:14:07', '2022-07-04 10:45:05', '2022-07-04 10:45:05'),
(128, 'auth_token', 'fcf822b1c9d7f7b7539357f52eb5c502315550d14c7e737795b8415da8fafa54', 128, 'App\\Models\\User', '[\"*\"]', '2022-07-04 08:20:40', '2022-07-04 08:20:50', '2022-07-04 08:20:50'),
(129, 'auth_token', '5da18538c245980b9a83fb78c93b3aa7311fa580c187af6de0f64a9b91615b5f', 128, 'App\\Models\\User', '[\"*\"]', '2022-07-04 09:51:11', '2022-07-04 13:30:24', '2022-07-04 13:30:24'),
(130, 'auth_token', 'a9a53bd2ff581c55d93f837fa546481da5d8ba35b3e4f2678008507c02e7d8f7', 128, 'App\\Models\\User', '[\"*\"]', '2022-07-04 13:31:52', '2022-07-04 13:41:25', '2022-07-04 13:41:25'),
(131, 'auth_token', '955a970a14b64d09effde60dfea22744ff0ae8d04fc5aa379d2a3fc998dc1c44', 128, 'App\\Models\\User', '[\"*\"]', '2022-07-04 13:57:46', '2022-07-05 08:18:35', '2022-07-05 08:18:35'),
(132, 'auth_token', 'aa46be1512f9bd88490c120cccd4c46ce1dab7c5902106e04acf9bc7ed0d091e', 128, 'App\\Models\\User', '[\"*\"]', '2022-07-05 04:10:31', '2022-07-05 07:46:17', '2022-07-05 07:46:17'),
(133, 'auth_token', '9e9a416d8708e0a86b902a8a40b20de5e90bd2e23377e0cfea79bca49dc2712a', 128, 'App\\Models\\User', '[\"*\"]', '2022-07-05 08:30:31', '2022-07-05 08:57:06', '2022-07-05 08:57:06'),
(134, 'auth_token', '38205a69e9ab8a5b09697a701ef8f42637c0ddfc63d9a97afa6dc6c6295e364e', 128, 'App\\Models\\User', '[\"*\"]', '2022-07-05 09:00:07', '2022-07-05 12:25:54', '2022-07-05 12:25:54'),
(135, 'auth_token', '918cbb5ec9d20fd9b6a057226b88ffe2001d930cce19f618747a79486b594f30', 128, 'App\\Models\\User', '[\"*\"]', '2022-07-05 09:05:31', '2022-07-05 09:06:11', '2022-07-05 09:06:11'),
(136, 'auth_token', '758d1a62d822f7e8206389e4949e44de531755896402cf20d40ece4b98b81d97', 128, 'App\\Models\\User', '[\"*\"]', '2022-07-05 09:08:37', '2022-07-05 09:32:39', '2022-07-05 09:32:39'),
(137, 'auth_token', '835d5d4eb7fd36f98ce3fa57e8718c871cf00f0ec144cbc4038b77931ec7244d', 129, 'App\\Models\\User', '[\"*\"]', '2022-07-05 10:20:00', '2022-07-06 05:47:18', '2022-07-06 05:47:18'),
(138, 'auth_token', 'fbb7f3e684e3de8b288d1919163cf6636eda91e955522d9e0ced030230aa13e6', 129, 'App\\Models\\User', '[\"*\"]', '2022-07-05 10:24:24', '2022-07-06 08:02:56', '2022-07-06 08:02:56'),
(139, 'auth_token', 'a03dac2e2f3c783f7bf045b94dc5ee83a8b906e08e8cee95d3eb14c04a715019', 129, 'App\\Models\\User', '[\"*\"]', '2022-07-05 12:35:14', '2022-07-05 13:19:28', '2022-07-05 13:19:28'),
(140, 'auth_token', 'e79db4aea46a4cf86e32ddf84b6315651f4aec1f4ab387bd524b16a63cb281c8', 129, 'App\\Models\\User', '[\"*\"]', '2022-07-05 13:56:03', '2022-07-06 14:01:13', '2022-07-06 14:01:13'),
(141, 'auth_token', 'c9adb30e6290ff02bc79703b75522505f0e92d3264b6a1b8765065fbe2392f2d', 112, 'App\\Models\\User', '[\"*\"]', '2022-07-06 04:54:16', '2022-07-06 04:54:18', '2022-07-06 04:54:18'),
(142, 'auth_token', 'bb13b785729f4b135cdc37edeb4e36139f6b86dfdb9ac9281013420beda0fb7b', 128, 'App\\Models\\User', '[\"*\"]', '2022-07-06 05:03:34', '2022-07-07 06:20:05', '2022-07-07 06:20:05'),
(143, 'auth_token', 'ed24518e0487918850cf93f2934df0dfa20c41413e8076dfa2eaaed099d80d12', 129, 'App\\Models\\User', '[\"*\"]', '2022-07-06 06:51:14', '2022-07-06 07:16:51', '2022-07-06 07:16:51'),
(144, 'auth_token', 'b9081a55a79d923f15c445df04b7314287388ccff45e0ca9bb7f4ac8d775e928', 129, 'App\\Models\\User', '[\"*\"]', '2022-07-06 07:24:27', '2022-07-06 13:01:00', '2022-07-06 13:01:00'),
(145, 'auth_token', '07f6df65ee6449128214da97e1d6ceeea5ee6bef8cdb1e003bb39ca822de9a5b', 128, 'App\\Models\\User', '[\"*\"]', '2022-07-06 08:13:50', '2022-07-06 08:14:05', '2022-07-06 08:14:05'),
(146, 'auth_token', 'e3b37d81d054e9d08328dc9bc0aeda255e4fafa1dd7901c31aa3bc45e3129be8', 129, 'App\\Models\\User', '[\"*\"]', '2022-07-06 13:16:15', '2022-07-07 08:19:36', '2022-07-07 08:19:36'),
(147, 'auth_token', '31bcfb40d1ef966cf62e0427214b97667a5c2f132b52991edb3fba5ecfc716ef', 129, 'App\\Models\\User', '[\"*\"]', '2022-07-06 14:03:10', '2022-07-06 14:03:22', '2022-07-06 14:03:22'),
(148, 'auth_token', '48f0ff085c5d62cad3b97a49818060f737e5495a537c0aa8ce8def2247a9ecfb', 128, 'App\\Models\\User', '[\"*\"]', '2022-07-07 06:28:07', '2022-07-07 07:11:35', '2022-07-07 07:11:35'),
(149, 'auth_token', '38c8d4b7a3d1f7f9882ed0ce838619e3484001d15d2385885a33000ad9dc60f0', 128, 'App\\Models\\User', '[\"*\"]', '2022-07-07 07:22:29', '2022-07-29 10:13:29', '2022-07-29 10:13:29'),
(150, 'auth_token', 'ef8be2b8dec0cecba205c116eac64c58214a64dbf51e8397d198ba43ec8cb9da', 129, 'App\\Models\\User', '[\"*\"]', '2022-07-07 09:04:13', '2022-07-07 09:08:25', '2022-07-07 09:08:25'),
(151, 'auth_token', '49860b5c932c59936cc80f2243a428ebeaa14ab03dcdd85e574f0af7e431ffb9', 129, 'App\\Models\\User', '[\"*\"]', '2022-07-07 09:11:45', '2022-07-07 10:08:22', '2022-07-07 10:08:22'),
(152, 'auth_token', 'ff7f7b5aabafef8dd7a6037d07ab1c530ef55ade5f0a62067a18d64d2b59a304', 128, 'App\\Models\\User', '[\"*\"]', '2022-07-07 09:16:33', '2022-07-07 09:25:30', '2022-07-07 09:25:30'),
(153, 'auth_token', '5f787f87dabfd9b6f88e492defe8612dc826afff36631e4ab11d5ceb5d406073', 128, 'App\\Models\\User', '[\"*\"]', '2022-07-07 09:43:12', '2022-07-07 11:23:45', '2022-07-07 11:23:45'),
(154, 'auth_token', 'c687729e8b38a2e08bad49ab555f229306e25109e6ce439018f96b391087612b', 129, 'App\\Models\\User', '[\"*\"]', '2022-07-07 10:43:33', '2022-07-07 11:33:46', '2022-07-07 11:33:46'),
(155, 'auth_token', '3d64ee0ff0f4d2e8ae6817bd27fee16ef1958f7b56ce0ccf0b35db1c561ca711', 128, 'App\\Models\\User', '[\"*\"]', '2022-07-07 11:33:19', '2022-07-08 12:05:28', '2022-07-08 12:05:28'),
(156, 'auth_token', '5bead3c5f6a0fd6ba9ceb98976387b0e8cf037f7cd79d2fb99d00f1a3a973644', 129, 'App\\Models\\User', '[\"*\"]', '2022-07-07 12:22:40', '2022-07-08 10:43:11', '2022-07-08 10:43:11'),
(157, 'auth_token', 'd70be79080a60603552adb004685e1762274c6497d00102d8b3c9696a6d9e65d', 129, 'App\\Models\\User', '[\"*\"]', '2022-07-07 13:53:45', '2022-07-07 13:56:12', '2022-07-07 13:56:12'),
(158, 'auth_token', 'c1a5860e14510fa8274ee914976cf9460fb135ed81fe02fb921581f083be019e', 129, 'App\\Models\\User', '[\"*\"]', '2022-07-08 12:19:47', '2022-07-11 07:02:02', '2022-07-11 07:02:02'),
(159, 'auth_token', '9c748857e0c2d993ddddffc6b269add5d26d30ba19eab400fd254dd3b4192d29', 128, 'App\\Models\\User', '[\"*\"]', '2022-07-11 04:23:46', '2022-07-11 05:51:13', '2022-07-11 05:51:13'),
(160, 'auth_token', 'cd78df803363d9d063c2e5225bbe370da7c60c89853fd0fde6dacc10042ba0e0', 128, 'App\\Models\\User', '[\"*\"]', '2022-07-11 05:57:15', '2022-07-11 07:15:28', '2022-07-11 07:15:28'),
(161, 'auth_token', '46cb63ebd5ea2430b60c07d67f36e4e603346faf50cad0450e6408a276e0dd64', 129, 'App\\Models\\User', '[\"*\"]', '2022-07-11 07:43:15', '2022-07-11 09:59:29', '2022-07-11 09:59:29'),
(162, 'auth_token', '978fcc94edd1e46351af820ed6857d8c986a416d40d29710529954c414a28cff', 128, 'App\\Models\\User', '[\"*\"]', '2022-07-11 08:44:14', '2022-07-14 05:24:04', '2022-07-14 05:24:04'),
(163, 'auth_token', '1b3cb96dff3c244add31815020576952d071130e8ec4ea693cc2e37a8b30f581', 129, 'App\\Models\\User', '[\"*\"]', '2022-07-11 10:16:12', '2022-07-14 05:26:49', '2022-07-14 05:26:49'),
(164, 'auth_token', '95a3d0a0aff64de878f97ec8e026c4dad43ca67d9159133cbefdb3547edd8205', 116, 'App\\Models\\User', '[\"*\"]', '2022-07-13 13:15:53', '2022-10-03 15:56:24', '2022-10-03 15:56:24'),
(165, 'auth_token', 'aa3c7c6e837d7af8bc03a633582c8cf4764d3ca4a299f218efaa376025b5afc4', 129, 'App\\Models\\User', '[\"*\"]', '2022-07-14 06:03:18', '2022-07-21 11:49:42', '2022-07-21 11:49:42'),
(166, 'auth_token', '9100ea5027ac931a7dd7d5e3b0b57dd9239ef0cf7e73b7e7f6292fbaf92985af', 129, 'App\\Models\\User', '[\"*\"]', '2022-07-14 07:03:49', '2022-07-15 11:58:20', '2022-07-15 11:58:20'),
(167, 'auth_token', '4b235bcfcb2670028d103f4b15e1f3d6612ed0682d43d7c8aa73ba43ff578702', 128, 'App\\Models\\User', '[\"*\"]', '2022-07-21 11:58:06', '2022-07-21 12:26:16', '2022-07-21 12:26:16'),
(168, 'auth_token', '163bea68e3588043e974befa6e59ebcd64d07db4a46045c46b95e90164ea96f1', 129, 'App\\Models\\User', '[\"*\"]', '2022-07-21 13:19:05', '2022-07-28 12:17:34', '2022-07-28 12:17:34'),
(169, 'auth_token', '15dc7d28b7cfefd5e29dba8ceedcb409ba587d5a52b7db992af37edd1afbaf7a', 122, 'App\\Models\\User', '[\"*\"]', '2022-07-22 08:33:59', '2022-10-03 15:32:54', '2022-10-03 15:32:54'),
(170, 'auth_token', '5d1b6323ee3fe24465c6e44c2b89728e8c741240a01d07eed171d4b6194f748d', 128, 'App\\Models\\User', '[\"*\"]', '2022-07-26 04:06:21', '2022-07-29 04:43:43', '2022-07-29 04:43:43'),
(171, 'auth_token', 'f4877180e3cd5620059f8e8a7966f5d60ef117493c2511d72f0fc1c27140c8dd', 128, 'App\\Models\\User', '[\"*\"]', '2022-07-28 04:23:46', '2022-07-28 04:31:14', '2022-07-28 04:31:14'),
(172, 'auth_token', 'e161eda72ae0f26d04973a921abd22d214a59c6e42582228cf6420baf41a229d', 128, 'App\\Models\\User', '[\"*\"]', '2022-07-29 06:00:27', '2022-08-01 09:08:06', '2022-08-01 09:08:06'),
(173, 'auth_token', '94595b0ce14e20bb92ba55f08e1b46581709e02dc5ebe1bec1b20b61cca68f70', 128, 'App\\Models\\User', '[\"*\"]', '2022-07-29 10:20:04', '2022-09-14 07:16:46', '2022-09-14 07:16:46'),
(174, 'auth_token', '6665f1539a4d07eb17c08b6f2d0a3396af865d28ce8dc789d6619a9ebb963481', 129, 'App\\Models\\User', '[\"*\"]', '2022-07-29 10:56:54', '2022-08-01 07:11:47', '2022-08-01 07:11:47'),
(175, 'auth_token', '0a4115b78987d34fdde2fe7a00f5ee5e8cc2918c02be6b4583e63a472775552f', 128, 'App\\Models\\User', '[\"*\"]', '2022-08-01 09:20:24', '2022-08-01 11:45:24', '2022-08-01 11:45:24'),
(176, 'auth_token', '48b469e118d4bf929ca1dcf1a9dadb95301165c34d3a2647577524c385803684', 129, 'App\\Models\\User', '[\"*\"]', '2022-08-01 12:49:17', '2022-08-01 14:36:12', '2022-08-01 14:36:12'),
(177, 'auth_token', 'e8247c1129b0863aa41346dc9f2c2ea70fe701a7b0e16640b28030cfc29817f8', 128, 'App\\Models\\User', '[\"*\"]', '2022-08-01 13:30:55', '2022-08-01 13:31:37', '2022-08-01 13:31:37'),
(178, 'auth_token', '55d45fd8fc6dc65af974b42b45588509a0085710001f95e3cc670fcdeed9cee8', 129, 'App\\Models\\User', '[\"*\"]', '2022-08-02 04:45:42', '2022-08-10 13:22:26', '2022-08-10 13:22:26'),
(179, 'auth_token', '3e39dcf3ee4c4eb4a896ef3bf240da620d39dce0ae4ce22d86f7e2f0b14304b3', 128, 'App\\Models\\User', '[\"*\"]', '2022-08-09 04:19:32', '2022-08-10 07:08:19', '2022-08-10 07:08:19'),
(180, 'auth_token', 'd588711960dfa41a2b49be10b45098f2221fdbb9725cabb4d799382f9e50801a', 128, 'App\\Models\\User', '[\"*\"]', '2022-08-12 04:14:14', '2022-08-12 07:17:36', '2022-08-12 07:17:36'),
(181, 'auth_token', 'a5e57468be6ead4fa6ba5bc1ee3862444079d982a82c4e1c472c5be8dceeb0c7', 128, 'App\\Models\\User', '[\"*\"]', '2022-08-12 08:03:21', '2022-08-19 11:51:51', '2022-08-19 11:51:51'),
(182, 'auth_token', '05bf318629de3641f48db9c397cb225b0ea15a2877ec4014fd8cedcaaee2d92a', 129, 'App\\Models\\User', '[\"*\"]', '2022-08-12 10:45:09', '2022-08-22 08:35:16', '2022-08-22 08:35:16'),
(183, 'auth_token', '2fc1ecd158d2746bcb2dc3afc7bcd7364496e55ed571ce45d2f48e319113ef13', 128, 'App\\Models\\User', '[\"*\"]', '2022-08-19 07:01:41', '2022-08-19 10:44:47', '2022-08-19 10:44:47'),
(184, 'auth_token', 'c0c8f1f2f50977798b6ce16d7fefa3ad0d4949b70d313fa83dc3fcf2c7a015ab', 129, 'App\\Models\\User', '[\"*\"]', '2022-08-22 15:52:17', '2022-08-23 11:47:27', '2022-08-23 11:47:27'),
(185, 'auth_token', '62b38e19dee1f1538c4fa42f15cc7eb23e36b33f037e759e4e5f7e6f76891585', 128, 'App\\Models\\User', '[\"*\"]', '2022-08-23 06:20:21', '2022-08-23 14:00:14', '2022-08-23 14:00:14'),
(186, 'auth_token', '1a42918f46eb61b251a9f350399f55bf435a055b202f51616cef09206e23208d', 129, 'App\\Models\\User', '[\"*\"]', '2022-08-23 15:17:45', '2022-08-24 07:46:39', '2022-08-24 07:46:39'),
(187, 'auth_token', 'c3ab30aa91106a157b1cc96ea7a22395ab2e57570c46de91b58f73997f641642', 128, 'App\\Models\\User', '[\"*\"]', '2022-08-24 04:08:53', '2022-08-24 04:11:03', '2022-08-24 04:11:03'),
(188, 'auth_token', 'f0e8d00cf5f56918270fe48771ba9088682050ff7584a697d1cfaac5af2ee9a7', 128, 'App\\Models\\User', '[\"*\"]', '2022-08-24 04:29:08', '2022-08-24 04:29:08', NULL),
(189, 'auth_token', '8eca517e3ed41a93969ba255bb82a4be2ffdcb7ae92318e716093fb7e38957c1', 128, 'App\\Models\\User', '[\"*\"]', '2022-08-29 15:03:39', '2022-08-30 07:11:25', '2022-08-30 07:11:25'),
(190, 'auth_token', '709a16825ba120985637b0506e29e6156f5d17d95c1342c1bc17d97889b6c5bc', 129, 'App\\Models\\User', '[\"*\"]', '2022-08-29 15:39:46', '2022-08-30 04:30:21', '2022-08-30 04:30:21'),
(191, 'auth_token', 'b556139308542f8ac59d25230f3d21b02bfcd4949dcd49f78fdff8e529d43a02', 129, 'App\\Models\\User', '[\"*\"]', '2022-08-30 04:50:33', '2022-08-30 10:49:55', '2022-08-30 10:49:55'),
(192, 'auth_token', '1e6eb902543a0df32bcf4636b5fd619a150d1bd2fd8eaa52e0c8350c37ab970a', 129, 'App\\Models\\User', '[\"*\"]', '2022-09-14 06:30:08', '2022-09-14 10:56:24', '2022-09-14 10:56:24'),
(193, 'auth_token', 'b26c9b3b679291139c98f3c5e3ee3c86b27776543b8a52ff491a1ad306bf00ed', 128, 'App\\Models\\User', '[\"*\"]', '2022-09-14 09:02:41', '2022-09-14 09:02:41', NULL),
(194, 'auth_token', '39fcd44c20f0d70e7ec97c0ee6696fe6104537ffb7c1513933960503673620d8', 128, 'App\\Models\\User', '[\"*\"]', '2022-09-14 10:25:18', '2022-09-14 11:00:58', '2022-09-14 11:00:58'),
(195, 'auth_token', 'c8c776a5d221554d1d0ad094ec01ed3e83547c47ab882d0f0b40883932f300cc', 128, 'App\\Models\\User', '[\"*\"]', '2022-09-14 10:32:58', '2022-09-14 11:01:47', '2022-09-14 11:01:47'),
(196, 'auth_token', 'fa9d99411df2dbf1f189cfd9701fa74948437820a5ea64324abf2b94a38bef0c', 129, 'App\\Models\\User', '[\"*\"]', '2022-09-14 11:32:08', '2022-09-14 12:28:37', '2022-09-14 12:28:37'),
(197, 'auth_token', 'b14e0fd50c7066ac6d3294a406045a00fee7848476ff4d477812db9e02ada693', 128, 'App\\Models\\User', '[\"*\"]', '2022-09-14 11:35:11', '2022-09-14 12:15:10', '2022-09-14 12:15:10'),
(198, 'auth_token', '68d09785e7dac76901680c8c79a68ea8ae5d64ada7f83854bd6704d827bf993f', 129, 'App\\Models\\User', '[\"*\"]', '2022-09-14 11:47:56', '2022-09-14 11:48:17', '2022-09-14 11:48:17'),
(199, 'auth_token', '38c712251218ec4234e9c2c751476d90e4ad83b32e0fcb89fe72c0828688ceee', 128, 'App\\Models\\User', '[\"*\"]', '2022-09-14 12:03:44', '2022-09-16 08:57:28', '2022-09-16 08:57:28'),
(200, 'auth_token', '886bfa910cbf28717d4d8a57b7983ae8390757604f72c4415f5302caa54406fb', 131, 'App\\Models\\User', '[\"*\"]', '2022-09-14 12:45:59', '2022-09-16 06:12:53', '2022-09-16 06:12:53'),
(201, 'auth_token', '6b40fcef7cddd92b0cb642ffb0a5ff32933137156adde0b911b71fca47659bca', 128, 'App\\Models\\User', '[\"*\"]', '2022-09-15 06:51:40', '2022-09-15 06:52:40', '2022-09-15 06:52:40'),
(202, 'auth_token', '8fe7f9427028b803653ad70d2a33b8131e59e63c475704693f5be110655bb5db', 131, 'App\\Models\\User', '[\"*\"]', '2022-09-15 07:33:38', '2022-09-15 07:33:38', NULL),
(203, 'auth_token', '026ab73ae61654b47eef001b11407ba71153bded59a9af87ec70ee0d82bc5e1f', 131, 'App\\Models\\User', '[\"*\"]', '2022-09-15 07:34:53', '2022-09-15 07:34:53', NULL),
(204, 'auth_token', '789a6c8041a922d68f43522607a588b60d295b3e20c6af32ff3eea3119f11e38', 132, 'App\\Models\\User', '[\"*\"]', '2022-09-15 07:42:15', '2022-09-15 07:42:15', NULL),
(205, 'auth_token', '6fdf674f857b470c0061287d09f5a798c5f100e533ed55873f18ab9a5c47709d', 132, 'App\\Models\\User', '[\"*\"]', '2022-09-15 07:54:24', '2022-09-20 07:35:35', '2022-09-20 07:35:35'),
(206, 'auth_token', '81c95ac94d62122c3760a821c1633240a0d54f3acb24e7382e70fdea3018781c', 133, 'App\\Models\\User', '[\"*\"]', '2022-09-15 11:22:45', '2022-09-16 05:34:31', '2022-09-16 05:34:31'),
(207, 'auth_token', '042f79f9ec0a3f10fb3449e1bcf164dde36546723f19133f4688b3fd16cb6a9b', 128, 'App\\Models\\User', '[\"*\"]', '2022-09-16 04:41:40', '2022-09-16 04:41:40', NULL),
(208, 'auth_token', 'b640c11d315c9b392da8b0ae3db7f05727a82148be8f106f2135d03fb2aacc1d', 133, 'App\\Models\\User', '[\"*\"]', '2022-09-16 04:44:39', '2022-09-16 08:52:11', '2022-09-16 08:52:11'),
(209, 'auth_token', '4c990f05f4797a2bf2daafccef2f4f6c9c040739c1f9375f77249061cff60172', 133, 'App\\Models\\User', '[\"*\"]', '2022-09-16 08:43:52', '2022-09-16 08:45:54', '2022-09-16 08:45:54'),
(210, 'auth_token', 'f819429e7579ad7289e8b58f650494b9803986f88f8620dd0f6c3e8e629a370d', 133, 'App\\Models\\User', '[\"*\"]', '2022-09-16 08:46:17', '2022-09-17 14:09:43', '2022-09-17 14:09:43'),
(211, 'auth_token', '47ed57e3d5d9c0e664c976cfb33692b06271ef557331f91585863804c3ffe55d', 133, 'App\\Models\\User', '[\"*\"]', '2022-09-16 09:02:04', '2022-09-20 09:36:27', '2022-09-20 09:36:27'),
(212, 'auth_token', 'c6062a441b1874ec364f7df560c7eae7b345394d7885ce092f7fae0e41f5b72c', 133, 'App\\Models\\User', '[\"*\"]', '2022-09-19 06:37:04', '2022-09-19 08:37:43', '2022-09-19 08:37:43'),
(213, 'auth_token', '912699becdb1fad915d87f7a52b1fee9b0c1aa86e307818319f682943152b508', 129, 'App\\Models\\User', '[\"*\"]', '2022-09-19 08:39:28', '2022-09-19 13:25:49', '2022-09-19 13:25:49'),
(214, 'auth_token', 'e1dd0d1804f5a811b0d0b54e62f46f660dbcead0c87d9341b997356360ef9632', 133, 'App\\Models\\User', '[\"*\"]', '2022-09-19 11:41:10', '2022-09-19 12:11:13', '2022-09-19 12:11:13'),
(215, 'auth_token', 'd6f6acba62026ac63b482b9fef35edb2cb3eebae8c9354d19d6ecc2f42f4f05e', 129, 'App\\Models\\User', '[\"*\"]', '2022-09-19 12:14:01', '2022-09-19 12:14:37', '2022-09-19 12:14:37'),
(216, 'auth_token', '572dc46a1eb95efe3a758735ce2f5c3bafd03f911b37dceb98c1d64eca4a6768', 132, 'App\\Models\\User', '[\"*\"]', '2022-09-20 04:25:26', '2022-09-20 04:46:06', '2022-09-20 04:46:06'),
(217, 'auth_token', '45a7e75135378947a7ec586c9d2485116c4343c41ed558feedec022ac1bfc922', 129, 'App\\Models\\User', '[\"*\"]', '2022-09-20 09:07:51', '2022-09-20 09:08:22', '2022-09-20 09:08:22'),
(218, 'auth_token', '182f988c724a84836b07987de2902e50c11fe4a6f777932a29750ec68a28e32f', 129, 'App\\Models\\User', '[\"*\"]', '2022-09-20 09:18:56', '2022-09-20 09:23:44', '2022-09-20 09:23:44'),
(219, 'auth_token', '0080a636573c1a48787769ad749dec147c7d728ce69fdc766b7e65fd834a7554', 132, 'App\\Models\\User', '[\"*\"]', '2022-09-20 09:26:15', '2022-09-20 09:32:23', '2022-09-20 09:32:23'),
(220, 'auth_token', '6c429f54f38078c6bcc9f08eaab90820c6e55b296a947c018101dae6203a4369', 129, 'App\\Models\\User', '[\"*\"]', '2022-09-20 10:32:22', '2022-09-22 12:31:48', '2022-09-22 12:31:48'),
(221, 'auth_token', '6bc978c497f5aa9882e0e5f455a571de1e5a945b19cd974d6482213d4fe1ba1a', 132, 'App\\Models\\User', '[\"*\"]', '2022-09-22 12:00:26', '2022-09-26 09:14:45', '2022-09-26 09:14:45'),
(222, 'auth_token', '778cc528f46a0bb8994fcb65fc122e9e3f434dbb1a80d25cc559eebc4b83a344', 129, 'App\\Models\\User', '[\"*\"]', '2022-09-22 13:04:37', '2022-09-23 05:04:33', '2022-09-23 05:04:33'),
(223, 'auth_token', 'ffa52530e2e6e9eef010bc89651766b6010d596c6f75bc5eb7e90717b17c1f2e', 133, 'App\\Models\\User', '[\"*\"]', '2022-09-23 08:00:33', '2022-09-23 08:09:30', '2022-09-23 08:09:30'),
(224, 'auth_token', 'b62c355356934aaee358845e7291f0c942882e2c7432ff9b9af9389f56f8b188', 129, 'App\\Models\\User', '[\"*\"]', '2022-09-23 08:30:38', '2022-09-23 08:41:07', '2022-09-23 08:41:07'),
(225, 'auth_token', '75f9f43c3636802e72e1c20e79b5f44c3e7ab844545b4216643ae3a02d79de59', 129, 'App\\Models\\User', '[\"*\"]', '2022-09-23 08:45:28', '2022-09-26 04:51:50', '2022-09-26 04:51:50'),
(226, 'auth_token', 'bb35ab547ca4f10caaa7c517398213d0c859ddc95c612a30d369074092d38e07', 129, 'App\\Models\\User', '[\"*\"]', '2022-09-26 08:52:29', '2022-09-26 11:01:53', '2022-09-26 11:01:53'),
(227, 'auth_token', 'f7ce924b266059c682589b77fc6322b24c500f4cece5922d473db61b89da74f8', 132, 'App\\Models\\User', '[\"*\"]', '2022-09-26 11:40:39', '2022-09-26 11:40:52', '2022-09-26 11:40:52'),
(228, 'auth_token', '9cf3bb1c6e793f0fc281990907c775640c88954d791873466ad3f49d8eff1063', 129, 'App\\Models\\User', '[\"*\"]', '2022-09-27 05:50:53', '2022-10-03 14:19:02', '2022-10-03 14:19:02'),
(229, 'auth_token', 'ab87325836981d133245f483302ee10d77f42abc882b6dc5affc2c51fed4e905', 130, 'App\\Models\\User', '[\"*\"]', '2022-10-03 11:05:56', '2022-10-03 15:31:50', '2022-10-03 15:31:50'),
(230, 'auth_token', 'c5bcb0239ad4bf71c2a38fb1d6922af85de688b1dafa81310a00bdeef244a7d8', 123, 'App\\Models\\User', '[\"*\"]', '2022-10-03 14:41:30', '2022-10-03 20:35:13', '2022-10-03 20:35:13'),
(231, 'auth_token', '74fc5af03d9d77dfb2ccfeccf7bf678df156e293c8c82e5dc47602f0276724ed', 123, 'App\\Models\\User', '[\"*\"]', '2022-10-03 14:45:07', '2022-10-04 05:37:23', '2022-10-04 05:37:23'),
(232, 'auth_token', '0b49041a295773a7254e2b9cfcc4c8b364bdd579a7c17ffe3ebde7cbe8fc9c38', 123, 'App\\Models\\User', '[\"*\"]', '2022-10-03 14:45:43', '2022-10-04 17:10:37', '2022-10-04 17:10:37'),
(233, 'auth_token', '2b33c429126cac3aa60e780e4e6311f0cfdfb73fe438cb1dd3416565ac62bb28', 137, 'App\\Models\\User', '[\"*\"]', '2022-10-03 15:21:15', '2022-10-04 04:13:37', '2022-10-04 04:13:37'),
(234, 'auth_token', '089612ef1ffa7bd468b04f392553da5b47b0efabbd3742bd2d6a58b3ff78537d', 137, 'App\\Models\\User', '[\"*\"]', '2022-10-04 06:15:50', '2022-10-07 09:07:21', '2022-10-07 09:07:21'),
(235, 'auth_token', '39f3b0efb36b640ea653dd1bd987c59a8bff117f6b2d0a27c9afa552e18cbf63', 137, 'App\\Models\\User', '[\"*\"]', '2022-10-06 09:30:15', '2022-10-07 05:15:10', '2022-10-07 05:15:10'),
(236, 'auth_token', '3f40eff20b37216f4bca3f8eda740db6c7e130870f522b0b1ead1df54abb81d2', 137, 'App\\Models\\User', '[\"*\"]', '2022-10-06 12:43:31', '2022-10-06 12:43:31', NULL),
(237, 'auth_token', 'f9b5efdc64e40f95e20172f19542d2592c7d0ceaea320565a2f945604a93b21b', 137, 'App\\Models\\User', '[\"*\"]', '2022-10-07 06:32:45', '2022-10-07 06:55:02', '2022-10-07 06:55:02'),
(238, 'auth_token', 'd351bbe01f73ee10a51fc96036f991738bf1f8d42b40c22e0fdf7b91de59562d', 137, 'App\\Models\\User', '[\"*\"]', '2022-10-07 08:50:26', '2022-10-07 09:57:28', '2022-10-07 09:57:28'),
(239, 'auth_token', '047fd43c8695d5f02d503205502ddad4288172b3e36e1db4acbb850ff7506dcd', 137, 'App\\Models\\User', '[\"*\"]', '2022-10-07 11:18:04', '2022-10-07 11:18:06', '2022-10-07 11:18:06'),
(240, 'auth_token', '49331722e7ef3953532d65dc88bc157b64fcca82ff83a01096e7a86cdda1a187', 137, 'App\\Models\\User', '[\"*\"]', '2022-10-07 11:20:53', '2022-10-07 11:23:43', '2022-10-07 11:23:43'),
(241, 'auth_token', 'bd08da78e06533079b650b17a43794167a0b132eb2d61aa582e0824bf72f5e15', 137, 'App\\Models\\User', '[\"*\"]', '2022-10-07 11:29:15', '2022-10-07 11:29:15', NULL),
(242, 'auth_token', '5147db5e7a40cbe916d64d74bafd1032a6dbb638f3426a3d3cf5ef1543ffff65', 137, 'App\\Models\\User', '[\"*\"]', '2022-10-07 11:39:06', '2022-10-07 11:39:06', NULL),
(243, 'auth_token', '90bf4afc556c2e037ebdadc76cb0ec6e84ab4d4b00c7d8f9258f1eb9f2a41080', 137, 'App\\Models\\User', '[\"*\"]', '2022-10-07 11:45:27', '2022-10-07 12:39:13', '2022-10-07 12:39:13'),
(244, 'auth_token', '4fd047975f313b1f2f91417fd02cf58297ff9d50104756c880c2602459452d3d', 137, 'App\\Models\\User', '[\"*\"]', '2022-10-07 12:37:19', '2022-10-07 12:37:19', NULL),
(245, 'auth_token', '0a16efb4708d02285c4ed444cdf9eeb6c7204999add2305344857f9f9ad8bf83', 137, 'App\\Models\\User', '[\"*\"]', '2022-10-07 12:54:49', '2022-10-07 14:16:05', '2022-10-07 14:16:05'),
(246, 'auth_token', '6f42ea0204d10a6223ba6df214510644e8e9b85d2b3b620bfc9bf91bcd1bc713', 137, 'App\\Models\\User', '[\"*\"]', '2022-10-07 12:58:00', '2022-10-07 12:59:37', '2022-10-07 12:59:37'),
(247, 'auth_token', 'ff23c7de3fed0e081240c4268bd859e50f863eb8ca91b7e37ff1fe385940c408', 137, 'App\\Models\\User', '[\"*\"]', '2022-10-09 08:55:01', '2022-10-10 11:20:57', '2022-10-10 11:20:56'),
(248, 'auth_token', '6766bd7895b4f79ea82368c01ca31be424e8384fc3c4ec958a68c1dcf599b780', 137, 'App\\Models\\User', '[\"*\"]', '2022-10-10 11:22:21', '2022-10-10 11:22:21', NULL),
(249, 'auth_token', '94669d2b9feb3d58f54915a847e3db47bfa57f35dd1edd93cacbb8ac10d91633', 140, 'App\\Models\\User', '[\"*\"]', '2022-10-10 11:27:24', '2022-10-11 04:08:22', '2022-10-11 04:08:22'),
(250, 'auth_token', '92a617f61c9d01b3d56ab086b0c9161f955c5f3f5af31505dc02b0a919a95e5c', 140, 'App\\Models\\User', '[\"*\"]', '2022-10-10 12:41:36', '2022-10-14 12:53:45', '2022-10-14 12:53:45'),
(251, 'auth_token', '58ebeec8d58ff324e35dd04e328713c900a831ad38531f0bdbe77043b11d5aec', 140, 'App\\Models\\User', '[\"*\"]', '2022-10-11 06:40:12', '2022-10-11 06:40:19', '2022-10-11 06:40:19'),
(252, 'auth_token', 'ad6ce5a978857fb6ab1c08477fa00b32ee3658e3511f7f4a61917ae0aa5f35db', 140, 'App\\Models\\User', '[\"*\"]', '2022-10-11 06:40:36', '2022-10-11 06:40:36', NULL),
(253, 'auth_token', 'f818ad7eec3d1f32bc3b13dae0982229586170ed2d62a1d7e9cd7a2e90d79020', 122, 'App\\Models\\User', '[\"*\"]', '2022-10-11 07:38:32', '2022-10-14 09:05:09', '2022-10-14 09:05:09'),
(254, 'auth_token', 'da193562eb46ecf38c1782099d3ccbe9f7d4e484f2bb62eb4c6ee18a3f248cfd', 140, 'App\\Models\\User', '[\"*\"]', '2022-10-11 08:10:30', '2022-10-12 08:03:46', '2022-10-12 08:03:46'),
(255, 'auth_token', '6cad2bdd9b767a34c63a9fcbb4f89ba56810191b8baa302d8594213e7b20e625', 141, 'App\\Models\\User', '[\"*\"]', '2022-10-12 07:34:04', '2022-10-12 07:45:07', '2022-10-12 07:45:07'),
(256, 'auth_token', '4467e90976ed95ec324a9cc82851c61891f3425be269d627e16ea93bf9553eb7', 141, 'App\\Models\\User', '[\"*\"]', '2022-10-12 08:05:38', '2022-10-12 12:26:47', '2022-10-12 12:26:47'),
(257, 'auth_token', '8d09408e613e71d2ce59ac7b58a53180e0ee4f8a329c948c746a95467a30492a', 139, 'App\\Models\\User', '[\"*\"]', '2022-10-12 09:17:29', '2022-10-21 08:06:33', '2022-10-21 08:06:33'),
(258, 'auth_token', '1be574469e286c60c4ea9c7f92c90983c39154487b5c8d82749a2cfef2b69c05', 140, 'App\\Models\\User', '[\"*\"]', '2022-10-13 04:26:35', '2022-10-14 13:32:25', '2022-10-14 13:32:25'),
(259, 'auth_token', 'bd165700338685a9088b82c5ae3352ddb61c8ce395587a7d93b3a8cc0b9f7b3a', 130, 'App\\Models\\User', '[\"*\"]', '2022-10-13 09:57:25', '2022-11-10 09:39:27', '2022-11-10 09:39:27'),
(260, 'auth_token', 'cf3a85b7472d2d35edc6d303326c5545c775e86fc2d1c41e97db43735fcad95a', 122, 'App\\Models\\User', '[\"*\"]', '2022-10-14 09:05:20', '2022-10-21 13:49:46', '2022-10-21 13:49:46'),
(261, 'auth_token', '07cfecef8cf713b1566047d01ca193974d58d8282299a9cde88e61bc0bce189b', 141, 'App\\Models\\User', '[\"*\"]', '2022-10-14 13:48:13', '2022-10-14 13:48:16', '2022-10-14 13:48:16'),
(262, 'auth_token', '37cbdf6dd173bdfe5018acf88c5f5b9484cd57c5ca0f283ee176692cd23818a0', 140, 'App\\Models\\User', '[\"*\"]', '2022-10-14 13:49:04', '2022-10-14 13:49:08', '2022-10-14 13:49:08'),
(263, 'auth_token', '9ab54df7d428e25c404cdc48d99fa9f4c42f105b18ac16d7c3f3e92c90c19c71', 116, 'App\\Models\\User', '[\"*\"]', '2022-10-14 19:32:19', '2022-10-18 04:51:34', '2022-10-18 04:51:34'),
(264, 'auth_token', '749dd2fae0c2e028cf89306c99e61c115640836e55135ffe2943a3c2a43fb2bc', 130, 'App\\Models\\User', '[\"*\"]', '2022-10-17 13:51:09', '2022-10-17 13:53:14', '2022-10-17 13:53:14');
INSERT INTO `personal_access_tokens` (`id`, `name`, `token`, `tokenable_id`, `tokenable_type`, `abilities`, `created_at`, `updated_at`, `last_used_at`) VALUES
(265, 'auth_token', '4b28e90dfda69fa26dee18000cdf19cfc336f28f8c40f143d3372239d815e0cf', 130, 'App\\Models\\User', '[\"*\"]', '2022-10-17 15:51:40', '2022-10-17 15:51:52', '2022-10-17 15:51:52'),
(266, 'auth_token', 'c945445bd538199e7e47a9f48ef97ea5559a25fa5c211740028901177102ddfa', 130, 'App\\Models\\User', '[\"*\"]', '2022-10-17 15:53:25', '2022-10-17 15:53:26', '2022-10-17 15:53:26'),
(267, 'auth_token', '7c13b721bbcb7ef28ba4169f36f467d356e33fdbd9c6f392e349b680e5c55db3', 116, 'App\\Models\\User', '[\"*\"]', '2022-10-18 05:14:39', '2022-10-18 12:16:03', '2022-10-18 12:16:03'),
(268, 'auth_token', 'ea84f9dfeca2f5ed6f3ed1422794591ffefcf4493b2cc586d4aedb13e6a7a044', 116, 'App\\Models\\User', '[\"*\"]', '2022-10-18 13:33:15', '2022-10-18 18:36:56', '2022-10-18 18:36:56'),
(269, 'auth_token', '83988be62b06c6032c13375b9d0898bd27aece90863886758c5bf51cd8c4489d', 116, 'App\\Models\\User', '[\"*\"]', '2022-10-18 18:37:39', '2022-10-19 04:39:37', '2022-10-19 04:39:37'),
(270, 'auth_token', '624e286eed4e256caa2204f35f99b5535091bc9e17bddab85681d24879f19070', 116, 'App\\Models\\User', '[\"*\"]', '2022-10-19 04:29:53', '2022-10-26 04:19:10', '2022-10-26 04:19:10'),
(271, 'auth_token', 'aa51b7b066adec8897e8175b447576b34a4b549d68ebbcb20ae6b9231fe3bd99', 116, 'App\\Models\\User', '[\"*\"]', '2022-10-19 05:54:54', '2022-10-21 06:33:37', '2022-10-21 06:33:37'),
(272, 'auth_token', '635a1cadab3d268d5b2838d046dfeffac617cb4883bfe04a3db133425783bc35', 116, 'App\\Models\\User', '[\"*\"]', '2022-10-19 07:50:06', '2022-10-19 07:51:26', '2022-10-19 07:51:26'),
(273, 'auth_token', '8b1da71479b478c6afc37c41c658ef02c8c765ff68a52becfbde14360b3ffaaa', 116, 'App\\Models\\User', '[\"*\"]', '2022-10-19 07:52:47', '2022-10-19 10:38:32', '2022-10-19 10:38:32'),
(274, 'auth_token', 'f4cec36f98126545be2646f1c6f32d62f570a45b81f7fa8eff1b95457cefe71c', 116, 'App\\Models\\User', '[\"*\"]', '2022-10-19 12:47:57', '2022-10-19 13:54:51', '2022-10-19 13:54:51'),
(275, 'auth_token', '8167a34221a63d9986b9cf3d9d4b804f748fd7c3d104f6542d25555f78e54445', 116, 'App\\Models\\User', '[\"*\"]', '2022-10-19 15:15:22', '2022-10-19 15:15:27', '2022-10-19 15:15:27'),
(276, 'auth_token', 'c52830ac26b1d6b366ed0d2343d252f1cd3d47e5aca230abfc6e8eec628b82ec', 116, 'App\\Models\\User', '[\"*\"]', '2022-10-19 15:22:03', '2022-10-19 15:25:35', '2022-10-19 15:25:35'),
(277, 'auth_token', 'dec11190c8b60ceffb46045ebe157e619f27ac3eaff0da29c73dd215a152474d', 116, 'App\\Models\\User', '[\"*\"]', '2022-10-19 15:26:17', '2022-10-19 15:26:21', '2022-10-19 15:26:21'),
(278, 'auth_token', '28061126d4e57b52f0295d12d7e40a8954b1ac6cc853cf93e1bf827bcff3c6f2', 116, 'App\\Models\\User', '[\"*\"]', '2022-10-19 15:31:49', '2022-10-20 06:35:27', '2022-10-20 06:35:27'),
(279, 'auth_token', '7ceef7320eacb37af2050119ba0f948608670ac64d811c756cc161af4ba77811', 142, 'App\\Models\\User', '[\"*\"]', '2022-10-20 14:26:32', '2022-10-21 04:34:15', '2022-10-21 04:34:15'),
(280, 'auth_token', '64476c55f6d96b3d9760896258adb17244412258316dbde5bb500c85f4a3d1b3', 142, 'App\\Models\\User', '[\"*\"]', '2022-10-21 05:55:32', '2022-11-08 08:46:12', '2022-11-08 08:46:12'),
(281, 'auth_token', 'e1fcd035933316baca1cf2351b0b4e86649b85df2a0b0b51358663bef3b6dcd6', 142, 'App\\Models\\User', '[\"*\"]', '2022-10-21 06:21:32', '2022-10-21 17:57:15', '2022-10-21 17:57:15'),
(282, 'auth_token', '69925f8c93f4c4df44a454fddf4c591a05e79b6d79608e2be4df30b6091577d0', 142, 'App\\Models\\User', '[\"*\"]', '2022-10-21 06:33:51', '2022-10-21 06:34:45', '2022-10-21 06:34:45'),
(283, 'auth_token', 'b65490f2ad56e27572fa65e4e54832cb8c355f5b901a4bcc521f0a23ef0ce449', 139, 'App\\Models\\User', '[\"*\"]', '2022-10-21 08:26:56', '2022-11-15 13:34:18', '2022-11-15 13:34:18'),
(284, 'auth_token', '7b4c7f42edde8e99eaed99cfdd3edd90b679275f2119ae1be950880a0b4e6bcc', 116, 'App\\Models\\User', '[\"*\"]', '2022-10-21 13:17:27', '2022-11-10 09:35:25', '2022-11-10 09:35:25'),
(285, 'auth_token', 'b25421814369c34d0ad9799e08e8f5efb840ca04f25bb2489f45dda8fed3e62a', 123, 'App\\Models\\User', '[\"*\"]', '2022-10-21 13:50:18', '2022-11-07 16:39:33', '2022-11-07 16:39:33'),
(286, 'auth_token', 'ef6da1d707ebddf049fac3dfde2b32011bbd15bfb29d27af4193cf9d94ee3c81', 134, 'App\\Models\\User', '[\"*\"]', '2022-10-21 14:33:28', '2022-11-08 13:53:52', '2022-11-08 13:53:52'),
(287, 'auth_token', '4d3cb481f6f662f3dce1b391798c316deecc3fde23c9677012aca0a38cc84a38', 123, 'App\\Models\\User', '[\"*\"]', '2022-10-21 14:34:34', '2022-10-21 14:34:34', NULL),
(288, 'auth_token', '23f50b233096f25cfe603a695a4be4ded301988416bd14b7f697d1010768fce1', 123, 'App\\Models\\User', '[\"*\"]', '2022-10-21 14:35:33', '2022-11-10 13:39:37', '2022-11-10 13:39:37'),
(289, 'auth_token', '350f214fb40d414317011035303b2f47547d7d825e2ab77bd7f6947d64a8501b', 142, 'App\\Models\\User', '[\"*\"]', '2022-10-21 17:59:02', '2022-10-23 11:17:21', '2022-10-23 11:17:21'),
(290, 'auth_token', '834bc44bec0372c36494fa20a88b88ab48758380683aa0cdf335d191635bf931', 142, 'App\\Models\\User', '[\"*\"]', '2022-10-26 04:21:09', '2022-10-26 04:21:09', NULL),
(291, 'auth_token', '6f760153f02f8f89fe2e70efd1c28021f2a6727c8e1822683c98aec05cce61bc', 142, 'App\\Models\\User', '[\"*\"]', '2022-10-26 05:00:18', '2022-10-27 07:05:56', '2022-10-27 07:05:56'),
(292, 'auth_token', '30835b529aa19ee0c302c427a7d1b00dab38633bf7ceb05ab3d67d8331652571', 142, 'App\\Models\\User', '[\"*\"]', '2022-10-26 05:08:50', '2022-10-26 05:45:49', '2022-10-26 05:45:49'),
(293, 'auth_token', '180800d5baa30c9d6d268f178ae6e1a336a7d6570d62017806a07b70359c0b35', 142, 'App\\Models\\User', '[\"*\"]', '2022-10-26 05:51:09', '2022-10-26 12:27:41', '2022-10-26 12:27:41'),
(294, 'auth_token', '8eff5e9a69a58aa4a8c3baf0613d1632c12720c690ef28aa1a391db804c0fd90', 142, 'App\\Models\\User', '[\"*\"]', '2022-10-26 13:44:57', '2022-10-26 13:45:32', '2022-10-26 13:45:32'),
(295, 'auth_token', 'ef30d5b414549e8c993809f81f2b6bc2111bbf28305fd4dccf7ad1ffcd45a9d6', 142, 'App\\Models\\User', '[\"*\"]', '2022-10-26 14:31:23', '2022-10-27 07:39:21', '2022-10-27 07:39:21'),
(296, 'auth_token', '629ef5bc01909b815e1e8ee6730bbf02619aa67786f26aebd8e7551ff797ac92', 142, 'App\\Models\\User', '[\"*\"]', '2022-10-27 08:02:31', '2022-10-28 09:27:54', '2022-10-28 09:27:54'),
(297, 'auth_token', 'f8627a4f2c933f485e3e25297f4cecb3013c2e28211b6e1f187759b2be9e3910', 142, 'App\\Models\\User', '[\"*\"]', '2022-10-27 12:04:47', '2022-10-31 14:30:15', '2022-10-31 14:30:15'),
(298, 'auth_token', 'e1162c5df748a9eb9f203fb1c1192c7ce58802f170aa8aab5608dae27c49d5fb', 142, 'App\\Models\\User', '[\"*\"]', '2022-10-27 13:47:10', '2022-10-31 14:10:15', '2022-10-31 14:10:15'),
(299, 'auth_token', '4ad3d31b8999858840f2e7332b1842d252397997c812913a12490f1974774ec4', 142, 'App\\Models\\User', '[\"*\"]', '2022-10-31 09:37:58', '2022-10-31 11:30:18', '2022-10-31 11:30:18'),
(300, 'auth_token', '0b47380adfed57f2ca01d62da55be2197cee75655afba61cfad1d412a60d30e8', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-01 02:56:51', '2022-11-01 06:57:21', '2022-11-01 06:57:21'),
(301, 'auth_token', '5f997c60434d68d4946236931deb7c4841f3ac42fa7f4c173cba6d97cf2b0cdb', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-01 07:43:34', '2022-11-01 08:42:29', '2022-11-01 08:42:29'),
(302, 'auth_token', '932f3481e2c40f4addc76c6c61c2cc69f3078043018924407646f91433eefb05', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-01 08:37:54', '2022-11-02 13:25:48', '2022-11-02 13:25:48'),
(303, 'auth_token', '65d1c42314be185cf1a3ed0ea813c88d4ca690f18c0f21422e6e1673b0cbc732', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-01 13:51:05', '2022-11-02 12:55:00', '2022-11-02 12:55:00'),
(304, 'auth_token', '038c1d7c98db83a9da0f7a7ebfdc87abcedab051acf621f2e1c2e56ccca6f15a', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-02 12:55:47', '2022-11-02 13:04:21', '2022-11-02 13:04:21'),
(305, 'auth_token', 'd15354f06991917d39d7a0da351f9c3ba1dad079148917b25afe9a3378404075', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-03 16:02:07', '2022-11-03 16:55:35', '2022-11-03 16:55:35'),
(306, 'auth_token', 'ee0f90b762e0afba84d76f39223b1ec0aef8a051bc96e9e305a1ed7274e8a62c', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-04 05:00:50', '2022-11-04 05:00:50', NULL),
(307, 'auth_token', '3ae8c1e277cf1da04c5b78f5b0fc63e752a85e41676f2a48a1f143426d3c732e', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-04 06:34:12', '2022-11-21 10:53:47', '2022-11-21 10:53:47'),
(308, 'auth_token', '89525f11ec3a1ef41ff7a3a35c0f44bcaba826a3c7bdb23ed086bc28b519f991', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-04 06:39:21', '2022-11-04 06:39:26', '2022-11-04 06:39:26'),
(309, 'auth_token', '70ec6b1f2bbafda11e57f51d8a080d5df6f8642533f53f28e1b6983066ffc11b', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-04 06:44:53', '2022-11-04 08:35:58', '2022-11-04 08:35:58'),
(310, 'auth_token', 'b2d41472f19b7738c4ad1425bfee2164d5104f254c40456744a666ec00e9fe98', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-04 07:15:11', '2022-11-04 07:15:11', NULL),
(311, 'auth_token', '7aa31b889eede168820fbc26237bec7a9cd572956e6f0c5fd9dfc0649793c270', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-04 08:50:32', '2022-11-04 08:50:45', '2022-11-04 08:50:45'),
(312, 'auth_token', '35a93bdf3389ffed8267ba7e3f307302726cb67b3ad28e231b3c48686a70ac49', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-04 09:03:04', '2022-11-07 04:41:42', '2022-11-07 04:41:42'),
(313, 'auth_token', 'a154b7ef70bd798e7dfc7389cf91f919942f9764e4887b1aacf1e7869a5c33ad', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-07 04:45:33', '2022-11-07 04:45:33', NULL),
(314, 'auth_token', 'f1f0e1cd03bd48a9ab1c2f8edd834c7020ba261e9a45dfccd34e8db0cef612e5', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-07 04:49:52', '2022-11-10 10:10:48', '2022-11-10 10:10:48'),
(315, 'auth_token', 'fc0b20a775c261eea644af8a10a9ce441ff6ebe147b05d0291ebdcc050ea1729', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-08 06:41:43', '2022-11-08 06:42:05', '2022-11-08 06:42:05'),
(316, 'auth_token', '6ebe495dc89a84da390134ddc7441a331cec85061f575b2c7e319d3903e762c9', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-08 08:05:16', '2022-11-08 08:06:45', '2022-11-08 08:06:45'),
(317, 'auth_token', '6a6a8ba2081bd5211616012f93cd03b6ea161b52ed8b4f2208bca56a6a835782', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-08 21:04:24', '2022-11-08 21:04:36', '2022-11-08 21:04:36'),
(318, 'auth_token', '4fa1e6d59ea7c6b0372ca077f2fc2de1a8a7373e3bad8947ad8f2576b43a9d23', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-09 16:20:55', '2022-11-09 16:20:55', NULL),
(319, 'auth_token', '30a5f27eb1f11d62b186d01c114dd5998314bff0925fbf9b98e32a0525646807', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-10 09:36:01', '2022-11-15 13:23:43', '2022-11-15 13:23:43'),
(320, 'auth_token', '6138c60075e8fc9b1ae907f10c906d14480de79f5a4bf7d68f3d46dd6516e084', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-10 10:13:24', '2022-11-10 10:16:07', '2022-11-10 10:16:07'),
(321, 'auth_token', '7da654c3f0763c3a3a8396059f49d548c2510338aea74d5ae10172e198f9edd0', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-10 10:17:15', '2022-11-10 10:17:15', NULL),
(322, 'auth_token', '5c94edad66dd45f1db18be840ffe2727ad6e53e3dc8efe555bf0543bca851984', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-10 10:21:45', '2022-11-15 13:59:37', '2022-11-15 13:59:37'),
(323, 'auth_token', '86c5593b392ed24d8fa010de5fc3512a3a229a36c3a210a6d3f8089a5d50628b', 123, 'App\\Models\\User', '[\"*\"]', '2022-11-10 13:39:48', '2022-11-14 12:55:22', '2022-11-14 12:55:22'),
(324, 'auth_token', '10b9e980108dcc52f67f6623aeea81f2293c3c4f535fc1decd8f9837a06ac3a4', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-11 05:10:54', '2022-11-11 05:30:14', '2022-11-11 05:30:14'),
(325, 'auth_token', 'bec1e8726fee4f00bc441985e5de8f7d5e390b9dbcad31a8d10d8a29e7fa5464', 123, 'App\\Models\\User', '[\"*\"]', '2022-11-15 12:30:27', '2022-11-17 17:03:40', '2022-11-17 17:03:40'),
(326, 'auth_token', 'e6123a234297365dc635272d657867b947c221ce9a193aba663e10db696ec0a2', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-15 13:27:27', '2022-11-15 13:34:03', '2022-11-15 13:34:03'),
(327, 'auth_token', '30d6defdaa207e45cd600d749cdf0c6cd2ffdd4985cdc60c7ff0ad2009f5ac46', 138, 'App\\Models\\User', '[\"*\"]', '2022-11-15 13:34:14', '2022-11-15 13:34:14', NULL),
(328, 'auth_token', '64efe7df505da9142c5bfcc73bd991bec1217fbf49d5bd1f63f71f2c060bfaff', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-15 13:34:22', '2022-11-18 09:19:06', '2022-11-18 09:19:06'),
(329, 'auth_token', '35a5ea4ae11c733a08fd5260277016c9c53885de1d3f1c1831ea4ad9c9e5f15c', 138, 'App\\Models\\User', '[\"*\"]', '2022-11-15 13:34:48', '2022-11-30 16:21:25', '2022-11-30 16:21:25'),
(330, 'auth_token', 'f46744f83fb933fccfe960958161c3bccf9bc5050785ec737930175a07eb9d25', 139, 'App\\Models\\User', '[\"*\"]', '2022-11-15 13:38:13', '2022-11-15 13:48:46', '2022-11-15 13:48:46'),
(331, 'auth_token', '8e00adcb66e87963835a6e65231bb573cac46eedf52fd58ca00736d05fa7ffb5', 122, 'App\\Models\\User', '[\"*\"]', '2022-11-15 13:59:58', '2022-11-30 10:50:26', '2022-11-30 10:50:26'),
(332, 'auth_token', '10e6e25805cf9c547e3cbe639b723fc5ac6e4d85847d9fee51baa61718d97d1a', 139, 'App\\Models\\User', '[\"*\"]', '2022-11-15 14:21:21', '2022-11-15 16:49:06', '2022-11-15 16:49:06'),
(333, 'auth_token', 'b10dc01bfb48f6330d73e17df808ede01b2a91bb26370a2a71df705e2ddd5251', 139, 'App\\Models\\User', '[\"*\"]', '2022-11-15 16:49:58', '2022-11-24 12:01:56', '2022-11-24 12:01:56'),
(334, 'auth_token', '0cceab5d1189feea84c94901d24f2686af371f10492bf2591057ce5b69ac3889', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-16 04:24:35', '2022-11-17 13:23:25', '2022-11-17 13:23:25'),
(335, 'auth_token', '49ab92377c91dc15eda915b8d7a1ba56faed55792d4df53be0f6f2f56102cb0a', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-16 04:43:13', '2022-11-16 10:14:58', '2022-11-16 10:14:58'),
(336, 'auth_token', 'aaff6193289d2138e1cfe97475ddcd834bd8ae568eb6ec0cf789f88d0c749f63', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-16 09:59:17', '2022-11-18 09:00:07', '2022-11-18 09:00:07'),
(337, 'auth_token', '40a3b007d48bebaaeaca46ffabafbc32ad81d7b6d1353710e4251d2cbcf86f86', 123, 'App\\Models\\User', '[\"*\"]', '2022-11-17 17:09:48', '2022-11-18 11:02:15', '2022-11-18 11:02:15'),
(338, 'auth_token', '408e4492f39aa07532a602e5ef6154321213160d64e183c989c4a0f82d3ad147', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-18 06:43:03', '2022-11-18 06:43:06', '2022-11-18 06:43:06'),
(339, 'auth_token', '02f0e4d37d09375e8ca1cd004a69ef9bb981a5e2342755ac5e22ff042c43eaef', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-18 06:43:49', '2022-11-18 06:43:49', NULL),
(340, 'auth_token', '08b11bcc571dfc026321f76e86f6fd89e66cc3019f3469454def0244c03e5fc0', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-18 06:49:54', '2022-11-18 09:25:10', '2022-11-18 09:25:10'),
(341, 'auth_token', 'e3ca9da889441617a097a1835b2cdd1b34636b8b6316b9851ba14068e0a0a3b5', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-18 09:19:19', '2022-11-18 09:19:35', '2022-11-18 09:19:35'),
(342, 'auth_token', '844ff1b9431d657e4f4216da18e1ead17bc50a028f635395d1c905f2d28ebf86', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-18 09:19:20', '2022-11-18 09:19:20', NULL),
(343, 'auth_token', '89e0eac9dfbcaa21c1dc1240a32a08704bc9e74267d5f7ea301b83ebdee75be7', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-18 09:20:52', '2022-11-18 09:49:15', '2022-11-18 09:49:15'),
(344, 'auth_token', 'cea6064625f712400525d3fb129169be5a00687433d8250ab2deba16537da233', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-18 09:20:55', '2022-11-18 09:52:19', '2022-11-18 09:52:19'),
(345, 'auth_token', 'd98a28e8d0f4ea98a55a3b38135003ed1817420724721c4f78fd488c01947863', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-18 09:26:10', '2022-11-18 10:40:25', '2022-11-18 10:40:25'),
(346, 'auth_token', 'bd280a7275b7299d1f546e4e4ba42d54288c0f4cba7c0b95579c0942e11d9b45', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-18 09:35:54', '2023-05-19 05:48:45', '2023-05-19 05:48:45'),
(347, 'auth_token', '88da99e875f0d1ff80b8f3fe52630796f5cc8bcb7b237033d8f0c0fdc541bb08', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-18 09:49:38', '2022-11-18 10:03:29', '2022-11-18 10:03:29'),
(348, 'auth_token', '451c16fa2b3820d9523b760476246934715106a9efc2271de9344718f136af4f', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-18 10:10:33', '2022-11-18 10:10:33', NULL),
(349, 'auth_token', '7d01b4046bdb513e60bc2652fc45edbb114f7dee64e24d6969b26896febe9fb3', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-18 10:12:45', '2022-11-18 10:12:54', '2022-11-18 10:12:54'),
(350, 'auth_token', '500b7bb265e4152ea257df892ef979274035f2f19a5a457f4ac583bbd41959d8', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-18 10:37:34', '2022-11-18 10:38:55', '2022-11-18 10:38:55'),
(351, 'auth_token', '636c5abf361e8e490df2acd504a6bd0f574088aeec9fa8a88ad16297f9abd59b', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-18 10:40:50', '2022-11-18 10:53:33', '2022-11-18 10:53:33'),
(352, 'auth_token', '86c188531592346671b727b09175e23e45724f7151afd82a699bde009be08ac3', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-18 10:54:00', '2022-11-18 10:57:51', '2022-11-18 10:57:51'),
(353, 'auth_token', '23ec3d071b39654c3105b1b6ba491053112ddafd4786ce2f3259627fff1e19aa', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-18 10:59:40', '2022-11-18 11:04:47', '2022-11-18 11:04:47'),
(354, 'auth_token', 'd55dae4c6e1d6bef9f49b5c2238e4870fcf59b4cbf8b79f76e7dc8a80d024967', 123, 'App\\Models\\User', '[\"*\"]', '2022-11-18 11:16:05', '2022-11-28 08:44:04', '2022-11-28 08:44:04'),
(355, 'auth_token', 'b56eea3545a03ac00f7281753d4d43fdfc40b5a9adadff946e331981a28004a3', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-18 12:02:18', '2022-11-18 12:05:05', '2022-11-18 12:05:05'),
(356, 'auth_token', '0154a6b415f57891e03bd61c8532d92e46eab501c18acf120ce35b6c44c159d4', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-18 12:30:36', '2022-11-18 12:32:22', '2022-11-18 12:32:22'),
(357, 'auth_token', '5de0831bf33b31b513132155564c8abc1d9f6c7b7fa56000b526b801103d5e5a', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-18 13:50:08', '2022-11-18 13:50:59', '2022-11-18 13:50:59'),
(358, 'auth_token', '416a32fa2b7cd3676fd452df45a2e4fdefe247ad44c466071a747cc00c09737a', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-18 13:52:23', '2022-11-18 13:52:35', '2022-11-18 13:52:35'),
(359, 'auth_token', 'd15f0b2fe3280174993aa24d5fd95ff6306cdcb6df59e21c5e1d3cae5a6fdfea', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-18 14:45:52', '2022-11-21 04:10:50', '2022-11-21 04:10:50'),
(360, 'auth_token', '346eb0fcd014da15306e584ffaefb6b4a1262125f9ddc126616d004b4df49161', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-18 15:13:08', '2022-11-18 15:13:16', '2022-11-18 15:13:16'),
(361, 'auth_token', 'a6563dc64aecca1379d97b01edf5325f9dde9d614cab6af6bac5b53690f3296c', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-18 15:13:51', '2022-11-18 15:16:28', '2022-11-18 15:16:28'),
(362, 'auth_token', '053fc1e78e6382d9cf8e39842391dffd36a4984ce93e7de3bdc6a943eea3e5a7', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-18 15:16:47', '2022-11-18 15:16:47', NULL),
(363, 'auth_token', '122ca1c029ced9f294a6e62c641866ed21569770ef01d5ccbf326f52b6b9b516', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-18 15:17:52', '2022-11-18 15:19:25', '2022-11-18 15:19:25'),
(364, 'auth_token', 'ee2febe34dae3d18878b48edcf6a11180521034fdef06b3cac93ded8ab3855d2', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-18 15:19:56', '2022-11-18 15:20:09', '2022-11-18 15:20:09'),
(365, 'auth_token', 'a0ddff8ce2635038001d0b1f492efe28c415c9280c32129dcf44ebba03238f86', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-18 15:23:09', '2022-11-23 10:00:19', '2022-11-23 10:00:19'),
(366, 'auth_token', '4a338e2fa280d3cd65f002ea3899be572cc0ab40dfbecd515a604bb483dd5f25', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-21 04:12:29', '2022-11-30 11:07:02', '2022-11-30 11:07:02'),
(367, 'auth_token', '0bb2b46863e2f70f8d975f6d4c06f89b26ca3561a5f671c83df15682d88fe6a5', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-21 07:17:44', '2022-11-21 10:39:35', '2022-11-21 10:39:35'),
(368, 'auth_token', 'ab653547d7750fb4630cdfd83a4a4fc9f940fc5825e45bd4075117e7c7cfda71', 134, 'App\\Models\\User', '[\"*\"]', '2022-11-21 14:35:39', '2022-11-21 14:36:07', '2022-11-21 14:36:07'),
(369, 'auth_token', '5d6242157771f19c7119474e9a6fd9572aaf9e09900491d5674d259addf1a857', 134, 'App\\Models\\User', '[\"*\"]', '2022-11-21 15:09:23', '2022-11-21 15:09:36', '2022-11-21 15:09:36'),
(370, 'auth_token', '6b1dff42211792777c05a97f585fc741e7554ecb582bb0249e4657b332ff8473', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-21 15:59:21', '2022-11-22 12:42:12', '2022-11-22 12:42:12'),
(371, 'auth_token', '40f706866ed9ae95554c64f19b8d6d381ec50f0a2924e69f394379cf8575f292', 134, 'App\\Models\\User', '[\"*\"]', '2022-11-21 16:05:17', '2022-11-21 16:06:16', '2022-11-21 16:06:16'),
(372, 'auth_token', 'b3a9ed3670ea767e0380bb01442ee7464dfdb164f6de1546ee38195a2308050c', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-22 12:43:10', '2022-11-22 12:43:15', '2022-11-22 12:43:15'),
(373, 'auth_token', '90e0785f589de4f53ede8ba5cd46182babc65cc838cfa1318ab5d73631fda5ee', 134, 'App\\Models\\User', '[\"*\"]', '2022-11-22 13:24:50', '2022-11-22 13:30:10', '2022-11-22 13:30:10'),
(374, 'auth_token', '4e1ea4e255941aded395208950ff5653666542a0430e10fd31da7c03218c93e1', 134, 'App\\Models\\User', '[\"*\"]', '2022-11-22 15:28:32', '2022-11-22 15:29:14', '2022-11-22 15:29:14'),
(375, 'auth_token', 'a683fec51e1cdd291b495b53a61e43a31697baa70b8c5ddeae8560ed98132cb4', 134, 'App\\Models\\User', '[\"*\"]', '2022-11-22 15:35:27', '2022-11-23 10:00:47', '2022-11-23 10:00:47'),
(376, 'auth_token', '23ca01c9074358dbd55d96c33ad69404e9c3619b0db766261438301e7711da16', 134, 'App\\Models\\User', '[\"*\"]', '2022-11-23 10:06:59', '2022-11-23 10:07:13', '2022-11-23 10:07:13'),
(377, 'auth_token', '784e6e87701ccd79dc5374c2b20e380797290b9f698d1853dc1a92ef64c35d38', 134, 'App\\Models\\User', '[\"*\"]', '2022-11-23 10:47:41', '2022-11-23 10:52:20', '2022-11-23 10:52:20'),
(378, 'auth_token', '700c5c9be8c2942920a3e41151cbac74fa97dd290959ee1cae21467759eb5735', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-23 10:50:29', '2022-11-23 10:52:30', '2022-11-23 10:52:30'),
(379, 'auth_token', '45cbcf9582c9b66c4fba3c92414782ba06e9f7a3082f503ff060972e6740fc91', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-23 11:35:31', '2022-11-23 11:36:40', '2022-11-23 11:36:40'),
(380, 'auth_token', 'c9c077d6e8934963fef4c71dc17e49469a9fc5a62d1e47d2a4d6532e1120566f', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-23 13:13:50', '2022-11-24 10:21:31', '2022-11-24 10:21:31'),
(381, 'auth_token', '85b61cb5daf22707939f350cbcc489242e4f9994366aff6b04a83d896538d44a', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-23 14:17:42', '2022-11-23 14:20:19', '2022-11-23 14:20:19'),
(382, 'auth_token', '19daddb554b2791564e60bd454ba5fbd5ea447734fcd7945b2c0d1664d93411e', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-23 15:57:54', '2022-11-23 15:57:54', NULL),
(383, 'auth_token', 'a04320a36504fd765827cd980e257a9afe41a949b3356fadc75e1ffbeaacb47b', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-24 09:17:29', '2022-11-24 09:19:45', '2022-11-24 09:19:45'),
(384, 'auth_token', 'e4e1e6714d702c5966054e5b2db175de8df49799b6605304ef8b1c70882a3d46', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-24 09:45:58', '2022-11-24 09:46:39', '2022-11-24 09:46:39'),
(385, 'auth_token', '87ec002bcd1494b211ca3fe0f5501250d95b3ae23f46c331f646433fadb27377', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-24 09:48:07', '2022-11-24 09:49:07', '2022-11-24 09:49:07'),
(386, 'auth_token', 'e774c993d409b220d466b48ffd8b62a54172d191535f9293249b3cdd5f1eb86e', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-24 09:49:18', '2022-11-30 10:10:31', '2022-11-30 10:10:31'),
(387, 'auth_token', '935b045c6ab02089cf302a5a7207cfe54144b3cd660759a4238d62a22142a92d', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-24 10:16:06', '2022-11-30 11:02:02', '2022-11-30 11:02:02'),
(388, 'auth_token', '154cd95c7c85057193ed1938807e8ee1903c388e7779c8fb7cabbc1623ed6388', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-24 10:24:54', '2022-11-24 10:26:35', '2022-11-24 10:26:35'),
(389, 'auth_token', 'aece3317e0614bc192ff80979a508c894cbc5455012112f80f8f6f8725f422ea', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-24 10:32:58', '2022-11-24 10:34:31', '2022-11-24 10:34:31'),
(390, 'auth_token', '387b53b99e54339ffd45061d25cf8bef5c18db650a551bad78d382f04d163027', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-24 11:03:34', '2022-11-24 11:12:49', '2022-11-24 11:12:49'),
(391, 'auth_token', 'c8a35d474e2fc3e35bfd891996711440c583f5340c839e30656e69fc6f634d9e', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-24 11:19:36', '2022-11-24 11:31:23', '2022-11-24 11:31:23'),
(392, 'auth_token', 'ff04101eb3eb24cc2ad638ebe5e04504f9752c939b53b1806369c84c936ce20a', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-24 11:33:19', '2022-11-24 12:17:53', '2022-11-24 12:17:53'),
(393, 'auth_token', 'f03249ada7aec48a9efabe11f3246ec05032e16586b31d00b3decd8241cb81f3', 139, 'App\\Models\\User', '[\"*\"]', '2022-11-24 12:03:36', '2022-11-24 12:03:41', '2022-11-24 12:03:41'),
(394, 'auth_token', 'e3c0dc89276a7d08b0b5a33924df41443572d1b80cd66257c5ed1d97da0aaada', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-24 12:26:39', '2022-11-25 08:03:51', '2022-11-25 08:03:51'),
(395, 'auth_token', 'f7abcfbdb65efd983d875b6adc53fd94f0136f93b54017677ac2b882b325309c', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-25 05:40:58', '2022-11-25 05:41:57', '2022-11-25 05:41:57'),
(396, 'auth_token', '2f96e25a1465c016bddc3e71b9470419d02f7a297d9309b73d5ddd55c7a05311', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-25 05:44:11', '2022-11-25 05:45:07', '2022-11-25 05:45:07'),
(397, 'auth_token', 'f1fddf7e4534c02416af3cad25e00943e2c365b62783f195b57c85ac61f5cdf2', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-25 05:47:29', '2022-11-25 05:48:35', '2022-11-25 05:48:35'),
(398, 'auth_token', '68be4e8d2882e69b5b2d629af4844c6548809da3f036f7256d4e917d0688ebad', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-25 05:52:46', '2022-11-25 05:55:08', '2022-11-25 05:55:08'),
(399, 'auth_token', 'fc6168aee3d2c2a9968fc7e24e15fe304ebb381192d3602ddecf0d14b24623e2', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-25 06:18:11', '2022-11-25 06:23:07', '2022-11-25 06:23:07'),
(400, 'auth_token', '2e4ac10f68137c6ab92c355d50b58a461a34bf3d422fc2bf78770a07f8f4fb60', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-25 06:25:43', '2022-11-25 06:28:01', '2022-11-25 06:28:01'),
(401, 'auth_token', '949cfe155efc43c59a175addf2a13f3e668f604edd20c3cb6e337c2c452a66ec', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-25 06:29:55', '2022-11-25 06:30:40', '2022-11-25 06:30:40'),
(402, 'auth_token', '1398fdafd2ad84f313630fc84a95402ab4befbf086effa1336c00bdae3d84bb2', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-25 06:33:11', '2022-11-25 06:33:16', '2022-11-25 06:33:16'),
(403, 'auth_token', 'c3a769b1299c66640a001aa544aab543c92d496cbcd088b8a32f005b206325c1', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-25 06:37:16', '2022-11-25 06:38:21', '2022-11-25 06:38:21'),
(404, 'auth_token', 'e10fb649474514bbff493e02f9e685a30e38cdece64bfa7883f5f9b3297536f7', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-25 07:05:44', '2022-11-25 07:07:15', '2022-11-25 07:07:15'),
(405, 'auth_token', '6cf1fc4e1e01a855210b65c24434c6b9ce5acb761c4923b651a8a817a22f72a8', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-25 07:07:50', '2022-11-25 07:08:53', '2022-11-25 07:08:53'),
(406, 'auth_token', '1ab804dba9c0b6c981bfe29a3f4f7251179819c0b7df664409789d6923b83d90', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-25 07:35:23', '2022-11-25 07:35:25', '2022-11-25 07:35:25'),
(407, 'auth_token', 'b50b4b7d74af8e701cb7862c5e84c11c94e55f7aa836d59defac2e71857ef946', 146, 'App\\Models\\User', '[\"*\"]', '2022-11-25 10:33:07', '2022-11-25 10:33:36', '2022-11-25 10:33:36'),
(408, 'auth_token', 'e7cd33b59a1ec7212f48c7dae382c3b2020520c6c9e596d3da2218d69edabd02', 139, 'App\\Models\\User', '[\"*\"]', '2022-11-28 07:29:14', '2022-11-28 09:43:08', '2022-11-28 09:43:08'),
(409, 'auth_token', '058d3d78df46bf3ebd5a48ad37f87f2e0d5a59dea1e233e96348c84e041e6dde', 139, 'App\\Models\\User', '[\"*\"]', '2022-11-28 11:46:58', '2022-11-28 11:47:02', '2022-11-28 11:47:02'),
(410, 'auth_token', '940a0b7c671d55f08718ae677661c17df93687bdffc751bccb8480693da3a230', 139, 'App\\Models\\User', '[\"*\"]', '2022-11-28 11:54:53', '2022-11-28 11:57:41', '2022-11-28 11:57:41'),
(411, 'auth_token', '6872aa02ec351200571a37a0a2765bc43d779c54f426b393459c2ecdcb0ef380', 146, 'App\\Models\\User', '[\"*\"]', '2022-11-28 12:20:58', '2022-12-12 22:37:26', '2022-12-12 22:37:26'),
(412, 'auth_token', 'ee11d45d53d8243d86ce200675cceca1d345e423ba9eec48421f2050cca95fe9', 123, 'App\\Models\\User', '[\"*\"]', '2022-11-29 14:47:56', '2022-11-29 14:47:56', NULL),
(413, 'auth_token', '51579b427ec017e98256d9719d6ea8f929e0c5ff7be0e266291e55907886a11e', 123, 'App\\Models\\User', '[\"*\"]', '2022-11-29 14:55:10', '2022-11-29 14:56:57', '2022-11-29 14:56:57'),
(414, 'auth_token', 'b14bf02ec15256d6da4840ec8401213cf90a058adeb4f6d4de6a5a82c8a7329e', 123, 'App\\Models\\User', '[\"*\"]', '2022-11-29 14:57:50', '2022-11-29 14:58:00', '2022-11-29 14:58:00'),
(415, 'auth_token', '7d5fb63c6f827d271a7ad9ea8763cf275c9cb478d21b3265564e1910a31bc309', 123, 'App\\Models\\User', '[\"*\"]', '2022-11-29 15:00:59', '2022-11-29 15:01:16', '2022-11-29 15:01:16'),
(416, 'auth_token', '3005c7ffeef17132bf9d1ffa76e981514d4c33a3254b7a08916d2b6c1ceb4065', 123, 'App\\Models\\User', '[\"*\"]', '2022-11-29 15:01:55', '2022-11-29 15:05:52', '2022-11-29 15:05:52'),
(417, 'auth_token', '0f51774fc038b9b74b1dece9e41281acd8fcc07998b7078f87470d3d72c2af64', 139, 'App\\Models\\User', '[\"*\"]', '2022-11-30 07:05:14', '2022-11-30 10:03:48', '2022-11-30 10:03:48'),
(418, 'auth_token', '92362b514cc847eec5863e645f042a7143afa51958a4dc962df9f09fec445174', 139, 'App\\Models\\User', '[\"*\"]', '2022-11-30 10:15:02', '2022-11-30 10:15:14', '2022-11-30 10:15:14'),
(419, 'auth_token', '43eb88e89edcc169384d20009f2bec24c10fa3f484957ccd412c1db6653584bd', 139, 'App\\Models\\User', '[\"*\"]', '2022-11-30 10:16:35', '2022-11-30 10:16:43', '2022-11-30 10:16:43'),
(420, 'auth_token', 'd87d8127c0699a7090564d70b6551b6e7648f56f26dcb4bd7f810a1ef7970905', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-30 10:21:19', '2022-11-30 10:21:19', NULL),
(421, 'auth_token', '02d610fe21b4178425b089510585276070f832c09a3497e95c0d2e346a4eee6a', 147, 'App\\Models\\User', '[\"*\"]', '2022-11-30 10:25:33', '2022-11-30 10:27:37', '2022-11-30 10:27:37'),
(422, 'auth_token', 'd13a55f98c10cc1e68e5455253d5ff9aba3c0941f0b9ee2a526c17565e144b21', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-30 10:26:32', '2022-11-30 10:32:33', '2022-11-30 10:32:33'),
(423, 'auth_token', '1f321efecbbda176726b60a6c153d633559406fbe3fd82276b78047e84c7ecf8', 147, 'App\\Models\\User', '[\"*\"]', '2022-11-30 10:29:57', '2022-11-30 10:30:07', '2022-11-30 10:30:07'),
(424, 'auth_token', 'b5ccfa8e44f46682a264a680ff80192ce1c72cb4009813e38da85b3f1f7830ba', 139, 'App\\Models\\User', '[\"*\"]', '2022-11-30 10:31:24', '2022-11-30 10:32:35', '2022-11-30 10:32:35'),
(425, 'auth_token', '8f93309e06eb14b1b860ceb0d94e7374bcdeb96ae575dab542de892539a61132', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-30 10:33:07', '2022-11-30 10:43:27', '2022-11-30 10:43:27'),
(426, 'auth_token', '76271e85aba00087047e9a27dc75c4ab08ed9efe9ff56b85a22a345450359db8', 139, 'App\\Models\\User', '[\"*\"]', '2022-11-30 10:34:41', '2022-11-30 10:35:36', '2022-11-30 10:35:36'),
(427, 'auth_token', 'e57c98a1fefbce2f102a56f045b0f0be988ae64df9bc144c5ed34f1046ad746a', 139, 'App\\Models\\User', '[\"*\"]', '2022-11-30 10:36:27', '2022-11-30 10:36:32', '2022-11-30 10:36:32'),
(428, 'auth_token', '5caafd1a5645469f1972c5e598e6eafd7480aeeae32d583fe3471da0039782e0', 123, 'App\\Models\\User', '[\"*\"]', '2022-11-30 10:36:45', '2022-11-30 10:36:45', NULL),
(429, 'auth_token', 'ec85464fa486fdda1ffa18c02a7fe071cc7db0113628bd2b410a2048973135b9', 139, 'App\\Models\\User', '[\"*\"]', '2022-11-30 10:37:25', '2022-11-30 10:37:25', NULL),
(430, 'auth_token', 'bc436581efe8ddb4936c77847d5c4447386c1bd35485b769b15588f343771eb9', 139, 'App\\Models\\User', '[\"*\"]', '2022-11-30 10:41:53', '2022-11-30 10:47:48', '2022-11-30 10:47:48'),
(431, 'auth_token', 'a3a8cec95299993b9dde73383cdae50a28abac65f0c851781f2f60e1c7a9e796', 123, 'App\\Models\\User', '[\"*\"]', '2022-11-30 10:42:24', '2022-11-30 10:44:26', '2022-11-30 10:44:26'),
(432, 'auth_token', '0e29771244fb397891fbef2c54f6de7c5afe0c063223894dc87ccc538c4d779c', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-30 10:44:14', '2022-11-30 10:47:05', '2022-11-30 10:47:05'),
(433, 'auth_token', 'bbe1033b812463867ed4038caaad635737cd3e2ffeab876e69d11724d578fb26', 147, 'App\\Models\\User', '[\"*\"]', '2022-11-30 10:50:24', '2022-11-30 10:50:46', '2022-11-30 10:50:46'),
(434, 'auth_token', 'b64ce944917ccb58d200bdc19f713306d2d561140d4e47c1b93605c83f4c85d2', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-30 10:50:39', '2022-11-30 10:50:47', '2022-11-30 10:50:47'),
(435, 'auth_token', '550e1bf2cd865f74e338e59d7b7e7db177c8413eeda52f912807f34108f25b30', 147, 'App\\Models\\User', '[\"*\"]', '2022-11-30 10:51:41', '2022-11-30 10:55:21', '2022-11-30 10:55:21'),
(436, 'auth_token', 'e2d0acc2b358e03239b4da55c584d6e1ca81dedb06e56f79133592b148d391a0', 143, 'App\\Models\\User', '[\"*\"]', '2022-11-30 10:55:15', '2022-11-30 11:07:51', '2022-11-30 11:07:51'),
(437, 'auth_token', 'ea6cc674d5f66ec956c4ff3ba5ac7bbec4a6520beac72e8fb06cb938b5a11c6f', 147, 'App\\Models\\User', '[\"*\"]', '2022-11-30 10:55:46', '2022-11-30 10:59:09', '2022-11-30 10:59:09'),
(438, 'auth_token', 'eef6759cd2bdbc6ad94dc8e31e1ea0e23837002e8b6bbc64145609dacfc701cf', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-30 10:56:24', '2022-11-30 10:56:24', NULL),
(439, 'auth_token', '3fa0a4442ede761074c515427dd616e5612ee17f0ed557c34d07b1142b04cca5', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-30 10:56:42', '2022-11-30 10:57:37', '2022-11-30 10:57:37'),
(440, 'auth_token', 'c48849b3f06ea8c8da01080d771bbc3aacacb4255f1b8e88a3473e9e2d530444', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-30 10:57:11', '2022-11-30 11:02:08', '2022-11-30 11:02:08'),
(441, 'auth_token', 'd8ed12599f267f1c8c1dd601a9162a3d23358ae0b0074ca33c2fdb4126877ded', 139, 'App\\Models\\User', '[\"*\"]', '2022-11-30 10:58:09', '2022-11-30 10:58:41', '2022-11-30 10:58:41'),
(442, 'auth_token', 'a5202a376d63a6b24e61736ab5281daefde9408b44d3e6c70f5ac75b96316520', 123, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:01:21', '2022-11-30 11:01:21', NULL),
(443, 'auth_token', '423348000eb32efe0db9601c37c477b65223e51b00398d4ea3a2b743adde62b3', 147, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:02:04', '2022-11-30 11:02:07', '2022-11-30 11:02:07'),
(444, 'auth_token', '0a1d9cc4326d8f218493c60e62877a043a0e28b627bad10735c137ffe46f64d8', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:02:42', '2022-11-30 11:04:36', '2022-11-30 11:04:36'),
(445, 'auth_token', '53e81e45b466fd586efecf237c4f4b93386f583cea56a75645a7065c848f37a8', 147, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:02:43', '2022-11-30 11:02:45', '2022-11-30 11:02:45'),
(446, 'auth_token', '2f775d313a77d632ad23e01ac67ab290faa2378ca5eb3e6931adbe2a33893df1', 139, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:03:00', '2022-11-30 11:03:40', '2022-11-30 11:03:40'),
(447, 'auth_token', '33dd643d9e5bd1744a8a2681c38e08b3edb3480cdac3384630f16833b6318e41', 147, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:03:04', '2022-11-30 11:05:05', '2022-11-30 11:05:05'),
(448, 'auth_token', '19e7be2a394734205cc767bd36b8621518521d20782af0a213b4c85963164ccd', 122, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:05:12', '2022-11-30 11:05:50', '2022-11-30 11:05:50'),
(449, 'auth_token', '34c5f32a04a79e3f8a562810fd454bcff9c0b6f39e6219c9bdc600901be36940', 147, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:06:05', '2022-11-30 11:07:33', '2022-11-30 11:07:33'),
(450, 'auth_token', 'ac6d38947d7369a1192fd2a78c803068426b063081248f4a5291ae1be801f9e8', 147, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:09:13', '2022-11-30 11:13:51', '2022-11-30 11:13:51'),
(451, 'auth_token', '6e6505cdab7e0e7ed89cfc4f3f939c67d5088497f5bdd6d2b061ae55e7e2e6e2', 147, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:10:59', '2022-11-30 11:11:10', '2022-11-30 11:11:10'),
(452, 'auth_token', 'e49cef0ae38ae7ac4c6c56151f5488b1fffebc1c3ec84f06c4159b80d141d8e4', 123, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:12:54', '2022-11-30 11:12:54', NULL),
(453, 'auth_token', '17940baa33694baa302ac646f5dc7de3fba64fefa4c7a86f68924bf0885a6d6c', 123, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:13:12', '2022-11-30 11:18:06', '2022-11-30 11:18:06'),
(454, 'auth_token', '37f596017801284101c4f9a10939ca218ffa627937d057d2c8b93db6808bfa62', 143, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:14:39', '2022-11-30 11:16:17', '2022-11-30 11:16:17'),
(455, 'auth_token', '6ff798a866938019a33402154fbc7a3e63b8f3cbd8ff55ec8bc595848dab79a9', 147, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:16:40', '2022-11-30 11:17:09', '2022-11-30 11:17:09'),
(456, 'auth_token', 'b0689d6fb7f822894b92b58d1c6ffc7bb6df3a502908929baf0a7b80f91a7caf', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:17:12', '2022-11-30 11:17:48', '2022-11-30 11:17:48'),
(457, 'auth_token', 'f0e46dbc16042eb18e51b393490b9a5d71ba141369d24d57445e4b66d61c903e', 139, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:17:54', '2022-11-30 11:18:33', '2022-11-30 11:18:33'),
(458, 'auth_token', '334a18a29f468566a8de21d3ca3a5376c897683c116ce47d666eb98329f3feee', 139, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:19:29', '2022-11-30 11:20:30', '2022-11-30 11:20:30'),
(459, 'auth_token', 'a495df7ab781b0ef0081b8c56699bb6718909cd27b67c1088e5120ad56244b59', 116, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:19:42', '2022-12-05 19:18:28', '2022-12-05 19:18:28'),
(460, 'auth_token', '149326900505a6c057feaf110dd7bcfab9848ff2b77c6acb172e9d62f90d9e28', 143, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:22:48', '2022-11-30 11:22:56', '2022-11-30 11:22:56'),
(461, 'auth_token', '87c3fb38903bd6a920f7be91c5a593d217a8707578e25813f5aa307d0000194e', 123, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:23:01', '2022-11-30 11:23:08', '2022-11-30 11:23:08'),
(462, 'auth_token', '8ac8fc711f2aa0e6ce48c7b31842eee4d6fa75c7db89ae2fed8f77ad863db7da', 139, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:23:06', '2022-11-30 11:23:33', '2022-11-30 11:23:33'),
(463, 'auth_token', 'a00166ab3b9795179e4966288bc4dd9ce8e536630f7e2737e0739b327b8c11b4', 147, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:23:19', '2022-11-30 11:23:42', '2022-11-30 11:23:42'),
(464, 'auth_token', '9c0550b5540d28722bd39609d836a5c9ce705c65dda15e945d5105d9eccd5d8f', 147, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:23:37', '2022-11-30 11:23:41', '2022-11-30 11:23:41'),
(465, 'auth_token', '06ac5c49486693ca90085fa2d4df978139529d6df633250e7a3d1fba945c099e', 143, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:27:37', '2022-11-30 11:37:24', '2022-11-30 11:37:24'),
(466, 'auth_token', '5561c1987bf051be57be917cb8958419ad1fe3e599c4898bad590ac89a50c5fb', 139, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:27:39', '2022-11-30 11:34:21', '2022-11-30 11:34:21'),
(467, 'auth_token', 'e0d9d0202697dd302989e684903f0d74592834727d8083353c9aee126279f379', 147, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:28:07', '2022-11-30 11:35:58', '2022-11-30 11:35:58'),
(468, 'auth_token', '225aeb5131bf5d422976e9bd34d8539bf83f69dc373dd557c382be686bc9c020', 147, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:28:16', '2022-11-30 11:35:25', '2022-11-30 11:35:25'),
(469, 'auth_token', '061420bc4c99391a1450bf08df3de6f2b40943af7ba54f463b1f0ea017444619', 123, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:28:56', '2022-11-30 11:33:08', '2022-11-30 11:33:08'),
(470, 'auth_token', '6a01939c2173763e18e39f87b681624bbe450c7fcb5a4e385f45c02e18af2478', 139, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:38:13', '2022-11-30 11:38:49', '2022-11-30 11:38:49'),
(471, 'auth_token', 'a74cc65f3db3c70c071bdecebded261ff60a0d0ceca3b20d777e2c1405c35e7a', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:39:36', '2022-11-30 11:40:28', '2022-11-30 11:40:28'),
(472, 'auth_token', '42144f0f069666d0a88ca5ceeb5a8b9359e56e1f599b51043a3603ac05144309', 139, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:41:08', '2022-11-30 11:41:21', '2022-11-30 11:41:21'),
(473, 'auth_token', 'fb943629012d151649c2def3999e3c3b6f294a5498cc25254286c3a5654a1e1f', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:41:57', '2022-11-30 11:42:05', '2022-11-30 11:42:05'),
(474, 'auth_token', '42634f10ed84ea6af7be8c56108ffa7e9f3afe3c1a6b5daf4951ffc272607d0d', 139, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:42:43', '2022-11-30 11:42:59', '2022-11-30 11:42:59'),
(475, 'auth_token', '21df8ea00440097507cf8270030a9fc96cf0a2cf10b4166cb77eb019e1a047f9', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:51:28', '2022-11-30 11:52:58', '2022-11-30 11:52:58'),
(476, 'auth_token', '918f4c99fe223678ee20275822cce539493e1af13c9a660e1b841136a9a17972', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:54:59', '2022-11-30 12:04:07', '2022-11-30 12:04:07'),
(477, 'auth_token', 'bd9515de11f55c7063c07a1181ddc0bce816af5ffd33365ed442dce6edd9c5bf', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-30 11:56:41', '2022-11-30 11:56:44', '2022-11-30 11:56:44'),
(478, 'auth_token', 'f1635c308289d71c0e0cb190944fc41b530a10529585c6ca8677b4f9193b1b03', 142, 'App\\Models\\User', '[\"*\"]', '2022-11-30 12:16:10', '2022-12-01 05:20:07', '2022-12-01 05:20:07'),
(479, 'auth_token', 'df3e51c7cb5e20242d01c2738a7cf56301d9ea8ccb0ac14fb429e6c92f86fa5a', 139, 'App\\Models\\User', '[\"*\"]', '2022-11-30 13:08:18', '2022-11-30 13:34:32', '2022-11-30 13:34:32'),
(480, 'auth_token', 'ecb6af8d4885f8f54a5b40e7f8af83dd6aa8cab48a629b32a7124400fd50e939', 123, 'App\\Models\\User', '[\"*\"]', '2022-11-30 13:17:40', '2022-11-30 13:18:22', '2022-11-30 13:18:22'),
(481, 'auth_token', '2377fd7a5c6f55282bd9ee29786bbf2e7fd68fac9ecc506794c4fc86292028c5', 139, 'App\\Models\\User', '[\"*\"]', '2022-11-30 13:57:19', '2022-11-30 21:24:40', '2022-11-30 21:24:40'),
(482, 'auth_token', '6c9a0d117e74fbe6f414fdad05a4769c60a27c85f175b1e0236e0304793cddb7', 143, 'App\\Models\\User', '[\"*\"]', '2022-11-30 14:18:31', '2022-11-30 14:24:06', '2022-11-30 14:24:06'),
(483, 'auth_token', '73601f78668c8cc7f8b9a0db7b5a13305521c475a2b71a0d0728157ac5de8731', 123, 'App\\Models\\User', '[\"*\"]', '2022-11-30 16:09:57', '2022-11-30 16:12:51', '2022-11-30 16:12:51'),
(484, 'auth_token', '5c0591bdc63481cf550ab8338c92456c1131fc20c1eae0313e549b5d62fa5ef6', 123, 'App\\Models\\User', '[\"*\"]', '2022-11-30 16:13:33', '2022-11-30 16:14:52', '2022-11-30 16:14:52'),
(485, 'auth_token', '1d4ce2915e91ce54b3ce8b6f81f925b9e26fb8151e33362d9a7f31f5c1667b19', 123, 'App\\Models\\User', '[\"*\"]', '2022-11-30 16:17:19', '2022-11-30 16:19:16', '2022-11-30 16:19:16'),
(486, 'auth_token', '5d9d5f546039539799487e96f5370e3ce8e5da5241106a8b5b9355f2e28e8ad5', 123, 'App\\Models\\User', '[\"*\"]', '2022-11-30 16:51:11', '2022-11-30 16:51:17', '2022-11-30 16:51:17'),
(487, 'auth_token', '4649ab6d65b001965e08b802b697a231331057e30e266111c885be50d8c4bb5b', 123, 'App\\Models\\User', '[\"*\"]', '2022-11-30 17:32:50', '2022-12-08 04:32:58', '2022-12-08 04:32:58'),
(488, 'auth_token', '5168f9255f64e8670d12048b70889afb9034912830dad025678f7f98d81a52cc', 139, 'App\\Models\\User', '[\"*\"]', '2022-11-30 21:24:53', '2022-11-30 21:35:25', '2022-11-30 21:35:25'),
(489, 'auth_token', '17e18b58784c8ffd8109b2c685a755990ca391cfe94bf8ecfa161e61ed6b15a6', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-01 06:13:06', '2022-12-01 06:21:16', '2022-12-01 06:21:16'),
(490, 'auth_token', 'a35efc6c1892a7e4922c94669ebc362b10ed477ffec7051ebeb34425cb41983a', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-01 06:22:47', '2022-12-01 06:48:11', '2022-12-01 06:48:11'),
(491, 'auth_token', '225ed12537ed41853f4a0535d63eea3663ec6a60a0e2bb7a669eda4ab6b216be', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-01 06:30:33', '2022-12-01 06:31:54', '2022-12-01 06:31:54'),
(492, 'auth_token', 'ae095e5462d13dcebcae47f07678e2bd39f3418ea98304a0f307d21feb62b73a', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-01 06:49:44', '2022-12-01 07:24:08', '2022-12-01 07:24:08'),
(493, 'auth_token', '82fdb818db00844550445f9ad2f3bda567ed137b1e380349aa7be7b13eff78bc', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-01 07:39:09', '2022-12-01 07:39:37', '2022-12-01 07:39:37'),
(494, 'auth_token', '87c58853f6ec5a260b0606c65394040b5e3cfad292780d771d22227f6b85f370', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-01 16:00:16', '2022-12-01 16:00:58', '2022-12-01 16:00:58'),
(495, 'auth_token', '6d8e6458f546d631c86248214cd1e26c9f90fd677b8f1dbde7e091489bd9b93b', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-01 16:07:37', '2022-12-02 14:52:41', '2022-12-02 14:52:41'),
(496, 'auth_token', '1138ce78b18443f014fd35630f8490eefcf3960c54c6e6cbd64018586db2b300', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-01 16:16:03', '2022-12-01 16:44:08', '2022-12-01 16:44:08'),
(497, 'auth_token', 'ddcfc81d97aa05481aa20355fc2a8baca71155e5f1c67c76551e0d53303ca6c8', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-01 16:20:52', '2022-12-01 16:22:17', '2022-12-01 16:22:17'),
(498, 'auth_token', 'ffe7eeca81314edb1dd69593bd9c935fed526323c1f6b2159e5a8c7affbd5ca8', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-01 16:23:17', '2022-12-01 16:24:28', '2022-12-01 16:24:28'),
(499, 'auth_token', 'c3774edd3f8b5c718119699e00a002a4cdbaecfa7117c9da01dee734d2be9559', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-01 16:28:21', '2022-12-01 16:28:24', '2022-12-01 16:28:24'),
(500, 'auth_token', '1c25491be2a63ab11d44d61f70e0d3fb9b4a49ca0743a40a7f28ce460ea2121d', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-01 16:36:50', '2022-12-01 16:38:08', '2022-12-01 16:38:08'),
(501, 'auth_token', '9831baea4f5f069f66d1199fd7c173512f73044f5fd31249cdee24072bb4de0c', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-01 18:19:58', '2022-12-01 18:21:02', '2022-12-01 18:21:02'),
(502, 'auth_token', '968b6eb8b42e0585f24432872653d70f4d8cfabec1f14e1a6b7af9b9966bd229', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-01 18:22:32', '2022-12-01 18:22:42', '2022-12-01 18:22:42'),
(503, 'auth_token', 'd5fef2dfa9eca0dddd7dd5932b3701ca36cd5fa59b669d30ec765eaac4003bd1', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-01 18:30:28', '2022-12-01 18:36:42', '2022-12-01 18:36:42'),
(504, 'auth_token', '7bce67c81bcb8f96e3bda1877c4ee8fc1b5bc910b93c72ee3e97980066c1b550', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-01 18:31:20', '2022-12-05 19:19:50', '2022-12-05 19:19:50'),
(505, 'auth_token', 'a5ff93022c9cb2ae167a8dfe3afa701c57cb36bc27faeb6db619c2bc0901412d', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-01 18:38:17', '2022-12-01 18:43:12', '2022-12-01 18:43:12'),
(506, 'auth_token', 'f014cafd04bddc14a8ea7d3043d8e5d62dd923fef92854f589da2d304502c07f', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-01 18:44:02', '2022-12-01 18:47:54', '2022-12-01 18:47:54'),
(507, 'auth_token', '2dee60f722d1e0a3a5352766db6f3a79bdfac9599d64f720f6dca7c1e90df7b1', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-01 19:15:22', '2022-12-01 19:15:56', '2022-12-01 19:15:56'),
(508, 'auth_token', 'b2b66559e19d479f8c3943ac3cd4afba409118fa1383571041c577ed218b2a3c', 149, 'App\\Models\\User', '[\"*\"]', '2022-12-01 19:24:36', '2022-12-01 19:24:36', NULL),
(509, 'auth_token', 'b9904809f927c728c1522f161669bb6c204947b0f85a46e021cb07793dea0abb', 149, 'App\\Models\\User', '[\"*\"]', '2022-12-01 19:26:24', '2022-12-01 19:29:40', '2022-12-01 19:29:40'),
(510, 'auth_token', '63fe9d08ee1c8e4cce4232cfd17ca93c7383ba74bb8340847b62265c3e808130', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-01 19:55:31', '2022-12-01 19:57:15', '2022-12-01 19:57:15'),
(511, 'auth_token', '10b1b2171e7858c1a516f23bf8d7cda52704b7e28fa2f4642f94c1af07b280ae', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-01 20:14:21', '2022-12-01 20:17:18', '2022-12-01 20:17:18'),
(512, 'auth_token', '11cb24b17204812b91cf1f6bb209af1d7ae22f116a7a2a2cb4294ab52abe7b2d', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-01 20:20:49', '2022-12-01 20:20:52', '2022-12-01 20:20:52'),
(513, 'auth_token', '1a77c6116c2d5d592cd16525941d8e21fc9b1ce442c04f435cea87bfa9d71f7f', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-01 20:21:29', '2022-12-01 20:21:38', '2022-12-01 20:21:38'),
(514, 'auth_token', '42bb18a8c60b6c91309ceb048e770c0e264483ebbaa3296896fe642002a5acd2', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-01 20:22:18', '2022-12-01 20:22:29', '2022-12-01 20:22:29'),
(515, 'auth_token', 'fd883aec91ca364813200a03402f233d2e43735ee9c29971622a63a8d01db6aa', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-01 20:39:00', '2022-12-01 21:29:14', '2022-12-01 21:29:14'),
(516, 'auth_token', '95598dcd5166d9245fc13c5a3a5b58a0f730bd71012f69b902eeb93fe0f959c7', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-01 21:31:15', '2022-12-01 21:33:49', '2022-12-01 21:33:49'),
(517, 'auth_token', '0c28cac8bc87f96f6f5bfd10524e1118bc2853c8675f9285f1ddaa27a0bc12a1', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-01 21:35:43', '2022-12-01 21:35:52', '2022-12-01 21:35:52'),
(518, 'auth_token', 'fa47f09c00f1f7ffdffeba678fdbe4a9afc06dd5455cd1c09c9702c4800d33f4', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-01 21:41:21', '2022-12-01 21:44:58', '2022-12-01 21:44:58'),
(519, 'auth_token', 'bee0b8854136be68bc6dccc2fb02740e62ad19bb5de06498761d7f7a05951b0d', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-01 21:47:32', '2022-12-01 21:48:20', '2022-12-01 21:48:20'),
(520, 'auth_token', '66ff77c8532c2bc6cf62ba86eb210a8124f6ad728f8d9abd3c6bcc85e83d1cde', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-01 21:53:18', '2022-12-01 21:58:23', '2022-12-01 21:58:23'),
(521, 'auth_token', 'c80bbe1ae6f742f4375d151156ba37a0114752f7ed129da9598f90709eafa2b4', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-02 15:41:06', '2022-12-05 19:08:22', '2022-12-05 19:08:22'),
(522, 'auth_token', '7d2454109c74007332efb080754e1fdda539ff588870efbef48d702f69c229cc', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-05 19:10:14', '2022-12-05 19:11:20', '2022-12-05 19:11:20'),
(523, 'auth_token', '44108fcab7085beb8b571a5e9f363dd7c50f847631c1c0149d29de5dac9a4771', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-05 19:17:06', '2022-12-05 19:17:09', '2022-12-05 19:17:09'),
(524, 'auth_token', 'ea29b397215bd6f07fb783f011f627637f79aaa26e42c43b44a40837e30455ec', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-05 19:17:39', '2022-12-05 19:17:41', '2022-12-05 19:17:41');
INSERT INTO `personal_access_tokens` (`id`, `name`, `token`, `tokenable_id`, `tokenable_type`, `abilities`, `created_at`, `updated_at`, `last_used_at`) VALUES
(525, 'auth_token', '8a0764d382c6a3a5b549565bacd9115b3f06b56c2e8ed8cddb82efaec07116b5', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-05 19:18:46', '2022-12-05 19:18:48', '2022-12-05 19:18:48'),
(526, 'auth_token', '637637b2f5b5a86dda992262ae701ef251b13b9a2e9e7e854475d89aa1c7c4ed', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-05 19:22:04', '2022-12-05 19:22:15', '2022-12-05 19:22:15'),
(527, 'auth_token', '6be6321f4a9cc040d249d60bfe78e0e492eadb83281235b68b38a05f44bd92d2', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-05 19:28:38', '2022-12-05 19:28:40', '2022-12-05 19:28:40'),
(528, 'auth_token', '2bf0573e6b01b932a56e4e39fa9279dba1422a9cbd8c6f02aa32010681318365', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-06 04:40:00', '2022-12-06 04:40:00', NULL),
(529, 'auth_token', '07a3f88035b95cbaab894126947882403982f7d8730c2530fcf680eb935ad736', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-06 17:18:35', '2022-12-06 17:18:37', '2022-12-06 17:18:37'),
(530, 'auth_token', 'ae3b38c3259f4116d7c6ea246e9db8251fb799ba0760475047d98d1c3ef96044', 122, 'App\\Models\\User', '[\"*\"]', '2022-12-06 17:26:25', '2022-12-06 17:26:29', '2022-12-06 17:26:29'),
(531, 'auth_token', 'cbc7ef892db966856c343a0e340867f27a42023c7c2ae325e822c13a94c60adb', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-06 17:28:00', '2022-12-06 17:28:05', '2022-12-06 17:28:05'),
(532, 'auth_token', '2c1f7c1d9f1f43307ca2909616caf37cf4da809eae9a562067e95666c78df196', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-06 17:39:03', '2022-12-06 17:39:15', '2022-12-06 17:39:15'),
(533, 'auth_token', '4f88c1dff4197c0b46da54f59ed225138fb83b2ae83d758994c01accc3160112', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-06 17:52:52', '2022-12-06 17:52:55', '2022-12-06 17:52:55'),
(534, 'auth_token', '189b2dbd4d93851685369b314c2d55cf053a2aa9cd4c5dc2ebe71c73cc50bb34', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-07 15:52:25', '2022-12-07 15:52:55', '2022-12-07 15:52:55'),
(535, 'auth_token', '51d529c9b60cfc95d448dbd32ae94ac909c42c7f33b94f2fa97392959ee111b0', 122, 'App\\Models\\User', '[\"*\"]', '2022-12-07 16:06:53', '2022-12-07 16:06:55', '2022-12-07 16:06:55'),
(536, 'auth_token', '0c4e1429b6874285ea29450a9d864729b7eb1714bee168f97c56105fd7b3f102', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-07 16:12:35', '2022-12-07 16:12:37', '2022-12-07 16:12:37'),
(537, 'auth_token', '92c05e3e1664b3debf19aecfeb2839a97bcfb179076eb7fc810276039b12727a', 122, 'App\\Models\\User', '[\"*\"]', '2022-12-07 16:12:42', '2022-12-07 16:12:46', '2022-12-07 16:12:46'),
(538, 'auth_token', '13a4f88cd886dc7ed5f4d28b87dc4210417643de809917d867164f2bda3377a1', 122, 'App\\Models\\User', '[\"*\"]', '2022-12-07 16:13:52', '2022-12-07 16:13:58', '2022-12-07 16:13:58'),
(539, 'auth_token', '032a8afb09d2a713610977622b5a32ef729dce7673a50600a4d610e3042b1d2b', 122, 'App\\Models\\User', '[\"*\"]', '2022-12-07 16:14:48', '2022-12-07 16:17:17', '2022-12-07 16:17:17'),
(540, 'auth_token', '049afd8105c947a40a5cb9d7a53e51514af1211986c9c7003884826cf34eddaf', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-07 16:16:07', '2022-12-07 16:16:07', NULL),
(541, 'auth_token', '091690b175dfaa39243bf94845cbd032903e6bc2a288f0da64f588bbb707128e', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-07 16:19:33', '2022-12-07 16:19:33', NULL),
(542, 'auth_token', 'a9e746941dd068f66fc48f9be7bb45f03b6efb98ff2b719ee0b0d8b26fc3e786', 122, 'App\\Models\\User', '[\"*\"]', '2022-12-07 16:22:09', '2022-12-07 16:22:12', '2022-12-07 16:22:12'),
(543, 'auth_token', 'dcc32d9638b61f6e1a529470c38bdbe56cd09de4cd63160de9b9f2561a364ee8', 122, 'App\\Models\\User', '[\"*\"]', '2022-12-07 16:24:27', '2022-12-07 16:24:35', '2022-12-07 16:24:35'),
(544, 'auth_token', '420e7efa3d4c8ce881aa654caa2e84d90d5a66376e24b4e2f317b0fac4bd35ad', 122, 'App\\Models\\User', '[\"*\"]', '2022-12-07 16:37:21', '2022-12-07 16:37:21', NULL),
(545, 'auth_token', '37ee0a170dedc9b6263687c589c259a9d8e514dc7408707d4ec9fc55e3c9ba4c', 122, 'App\\Models\\User', '[\"*\"]', '2022-12-07 16:39:32', '2022-12-07 16:39:59', '2022-12-07 16:39:59'),
(546, 'auth_token', 'fbfc4e07cffd84029a00dfcef320fca71cbf9ab0d7667f20f90469e832859423', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-07 16:42:41', '2022-12-07 16:42:48', '2022-12-07 16:42:48'),
(547, 'auth_token', '3f561d168fc8c25744cb4ae5b3923124d4ce77d7bd8f4793645b2361e592901e', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-07 16:42:53', '2022-12-07 16:42:53', NULL),
(548, 'auth_token', 'bd58bcc2c7e6f4b66567047506c018a2102393f6c3aa9f11ce807eb2488b6515', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-07 16:45:06', '2022-12-07 16:45:10', '2022-12-07 16:45:10'),
(549, 'auth_token', '304f86d903b03e2663496f1763f9d80c70cfdb0b203f471962daeba80fdba014', 122, 'App\\Models\\User', '[\"*\"]', '2022-12-07 16:46:15', '2022-12-07 16:49:01', '2022-12-07 16:49:01'),
(550, 'auth_token', 'c6bff607152cb8455df24e5df6811907a240475713b77d3f7a8a434b8570b1b0', 122, 'App\\Models\\User', '[\"*\"]', '2022-12-07 16:49:10', '2022-12-07 16:49:16', '2022-12-07 16:49:16'),
(551, 'auth_token', '801ffcc5371ce3d8a00862f5ca07bb6cb61e378abd17c3414b79516aed65c516', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-07 17:15:28', '2022-12-07 17:15:28', NULL),
(552, 'auth_token', '9f1f6cc36c27b3c81268741f8d89043db35a6f4cbad2e0e89323eabf831b0db7', 116, 'App\\Models\\User', '[\"*\"]', '2022-12-07 23:28:44', '2022-12-12 20:28:39', '2022-12-12 20:28:39'),
(553, 'auth_token', 'e83d8ac5197353422e7cf447e90dde541f453196bcb863ae60efb8bc60a801ca', 123, 'App\\Models\\User', '[\"*\"]', '2022-12-08 16:03:41', '2022-12-08 16:04:47', '2022-12-08 16:04:47'),
(554, 'auth_token', '6e4a9eb7b963d5ce08ba037d541550bfe4380fff0eef3bbedc5115e556111843', 123, 'App\\Models\\User', '[\"*\"]', '2022-12-08 16:05:27', '2022-12-08 16:09:14', '2022-12-08 16:09:14'),
(555, 'auth_token', '3f9e8e4fa25c0aa6db73affbd772661c35061ed3e012a664e73a3278edbb28f0', 123, 'App\\Models\\User', '[\"*\"]', '2022-12-08 16:10:25', '2022-12-08 22:55:00', '2022-12-08 22:55:00'),
(556, 'auth_token', '73440072ac8f8e80c1531547917dc35a7343160bf58c6d2d8a478f33297cdb40', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-08 21:59:03', '2022-12-08 21:59:54', '2022-12-08 21:59:54'),
(557, 'auth_token', 'ba3f0617853c77cbb32d321ffc846be401b84ca8bafd253f4c1a1a43e1fbe5b9', 122, 'App\\Models\\User', '[\"*\"]', '2022-12-08 22:05:56', '2022-12-08 22:06:05', '2022-12-08 22:06:05'),
(558, 'auth_token', '9ae8df4c9ce6632fe11ffa3f5b95b2ed8647e313648e1092d9fc0d01d00bf7e0', 122, 'App\\Models\\User', '[\"*\"]', '2022-12-08 22:06:53', '2022-12-09 21:15:36', '2022-12-09 21:15:36'),
(559, 'auth_token', 'f5f67aec3ec2fe953e62e994bd45ebb0451557ca0ff6b366010ea167acd0d1a7', 123, 'App\\Models\\User', '[\"*\"]', '2022-12-08 22:59:57', '2022-12-08 23:00:13', '2022-12-08 23:00:13'),
(560, 'auth_token', 'c85101941809a4392b7622a7199bd6c0e51b3be06463372ef733f46411899a40', 123, 'App\\Models\\User', '[\"*\"]', '2022-12-08 23:04:44', '2022-12-08 23:04:51', '2022-12-08 23:04:51'),
(561, 'auth_token', '85bdef7267c14092ff4a6a9cf4e8d7b060107f573cbcdf92956ce3fedb8d65ba', 123, 'App\\Models\\User', '[\"*\"]', '2022-12-08 23:22:46', '2022-12-12 19:17:08', '2022-12-12 19:17:08'),
(562, 'auth_token', 'd340a08e0c682d2f771fc6ef631b3cb262b4e5f096295f6a3159f0f6a4b5f801', 1, 'App\\Models\\User', '[\"*\"]', '2022-12-08 23:52:58', '2022-12-11 20:18:42', '2022-12-11 20:18:42'),
(563, 'auth_token', '707ab40c413bfa441675291ec46219d809a6e3a57cdc2a3ddc31874d41f54819', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-09 00:51:28', '2022-12-09 00:51:32', '2022-12-09 00:51:32'),
(564, 'auth_token', 'adbcdd3f7686b40b873289ac9e08a5c84ffd438722b4b3afa6816684b36bbbd7', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-09 01:52:58', '2022-12-09 01:53:01', '2022-12-09 01:53:01'),
(565, 'auth_token', '311b5ad4ee0ff6340687062568b3a19184406733fe5e216a236ba8cea45fa2a1', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-09 11:45:30', '2022-12-09 14:56:51', '2022-12-09 14:56:51'),
(566, 'auth_token', '05ecd2232878e18524631d518bcaee8e98f05d1a7db711e0849c25f76648837e', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-09 13:09:55', '2022-12-09 17:51:37', '2022-12-09 17:51:37'),
(567, 'auth_token', '97550a7729cbab226b6e19cb18e51e1967aefd0b6ce312c6ac153903e59389d9', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-09 15:25:32', '2022-12-09 15:25:51', '2022-12-09 15:25:51'),
(568, 'auth_token', '666e9a010ff31b9477e66b9684569fce73ca247d5f80533e88ae9083433f0f3f', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-09 15:26:16', '2022-12-09 15:26:19', '2022-12-09 15:26:19'),
(569, 'auth_token', 'f23a64e84c7399cc2075c520503d99557c099814bfd4c70875286eeed71d20ba', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-09 15:29:18', '2022-12-09 15:29:21', '2022-12-09 15:29:21'),
(570, 'auth_token', 'a68a1f4086643c806f529e32ce09ec2c1a369c457e934bafdc9bdd3338d77318', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-09 16:27:22', '2022-12-09 16:31:56', '2022-12-09 16:31:56'),
(571, 'auth_token', '3b4d548bd39db3e3250f476cbbfe31959422d0879db81c4bbb6eb09054b4580f', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-09 17:36:30', '2022-12-09 17:36:47', '2022-12-09 17:36:47'),
(572, 'auth_token', '3e0a9c7cbf109b1e5d7c454cc45d81dcd4df39ba964d718066f790bd32d4f0b6', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-09 17:39:12', '2022-12-09 17:40:51', '2022-12-09 17:40:51'),
(573, 'auth_token', '1ac76e51437ee349d48b1d75606643eb0bb4b0ddaf6059d2d7509cfc356add34', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-09 17:41:19', '2022-12-09 17:41:30', '2022-12-09 17:41:30'),
(574, 'auth_token', 'eecb0a6d288cf1b915f946f24afa7687e2a65329392327cf2c49870645dd1820', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-09 17:44:10', '2022-12-09 17:44:24', '2022-12-09 17:44:24'),
(575, 'auth_token', 'c1237cc8acb91892d1ea31ce7d5021acf3538c268791b178ab1ca6a4adb41713', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-09 17:45:14', '2022-12-09 17:45:49', '2022-12-09 17:45:49'),
(576, 'auth_token', '59409cab8b380cc01efb7b97c8f68ddf1f65e8d8004d32b246a6f47b55c97083', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-09 19:57:06', '2022-12-09 19:57:06', NULL),
(577, 'auth_token', '80c79e8da0a6f7a96585a976a08902442b8cb865abec0d0f76432a7bd5de22e9', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-09 20:07:17', '2022-12-09 20:07:17', NULL),
(578, 'auth_token', 'b405e712ca17ffb59fc0d307b9be366ba625638f78a6002103b0c429f5983ce3', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-12 15:15:34', '2022-12-12 15:15:34', NULL),
(579, 'auth_token', '4337b66f67b0863ff0c2912805075b3cd69035256b0024f0a89fb9fd5f817208', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-12 18:06:23', '2022-12-12 18:07:46', '2022-12-12 18:07:46'),
(580, 'auth_token', '1b849429548e51b4f318545bf3baa5d080ea147cb82d667e8260d11f4ecda44b', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-12 18:56:07', '2022-12-12 18:56:07', NULL),
(581, 'auth_token', '36c9565693f25f748c2e2180bbe6b6128d388e37ca300c582656e49beb366e5d', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-12 18:57:49', '2022-12-12 18:57:49', NULL),
(582, 'auth_token', '3b978a89b3a5c5de911a1935124fcead0579124e4212d0dc59a7b829ecf9febd', 123, 'App\\Models\\User', '[\"*\"]', '2022-12-12 19:17:28', '2022-12-12 19:17:47', '2022-12-12 19:17:47'),
(583, 'auth_token', 'cd51c9086b172ac42c35adfbd3767df287b1f6b04cbd6122fdb5a8d34faf5854', 123, 'App\\Models\\User', '[\"*\"]', '2022-12-12 19:18:00', '2022-12-12 19:18:43', '2022-12-12 19:18:43'),
(584, 'auth_token', '633687152d0401eb042a0e9639fc09f13230a3bccc0ddbbf82b6864951a43009', 123, 'App\\Models\\User', '[\"*\"]', '2022-12-12 19:20:35', '2022-12-12 19:27:40', '2022-12-12 19:27:40'),
(585, 'auth_token', 'a5135bea4df7ca0666d92345cdb994ee645a66bf614c5d4ca452c18409e86829', 123, 'App\\Models\\User', '[\"*\"]', '2022-12-12 19:28:13', '2022-12-12 19:29:43', '2022-12-12 19:29:43'),
(586, 'auth_token', '50bc61122ce7b912b2dd59e4d7eeebdf7b0ad912ce0b97949839811744ed0e8e', 123, 'App\\Models\\User', '[\"*\"]', '2022-12-12 19:30:17', '2022-12-12 19:30:32', '2022-12-12 19:30:32'),
(587, 'auth_token', 'f0171647713a6a4afc0818e5f09f6136b668601f54ffa5f06725c4e5944ed21b', 123, 'App\\Models\\User', '[\"*\"]', '2022-12-12 19:38:35', '2022-12-12 19:38:40', '2022-12-12 19:38:40'),
(588, 'auth_token', '7e6329e07ac7cf936d6ddc766b2420a680a5e526130335c16072607da8313cb2', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-12 19:48:15', '2022-12-12 19:48:15', NULL),
(589, 'auth_token', '6ee72b44351aec6f5869105e8b2136047dcb8f2b2851672fa621374362205276', 123, 'App\\Models\\User', '[\"*\"]', '2022-12-12 19:53:09', '2022-12-12 19:54:15', '2022-12-12 19:54:15'),
(590, 'auth_token', '669b0084634fc5a236b22c99995459f6e6fbce07077e25e0843a8db1f30ab672', 123, 'App\\Models\\User', '[\"*\"]', '2022-12-12 19:56:34', '2022-12-12 20:03:19', '2022-12-12 20:03:19'),
(591, 'auth_token', 'e5bd836f30f599c35cad17a34cbef06aa89dd89b2e66aff4bf771d41f4901d71', 123, 'App\\Models\\User', '[\"*\"]', '2022-12-12 20:13:24', '2022-12-16 15:57:24', '2022-12-16 15:57:24'),
(592, 'auth_token', '2d9800f9aa24b3dca5e7e7b188e9048aee5ea8801cdeea246518b5e1602dd85b', 146, 'App\\Models\\User', '[\"*\"]', '2022-12-12 22:39:34', '2022-12-12 22:39:39', '2022-12-12 22:39:39'),
(593, 'auth_token', 'fa88b6b803e76b019d353783958864cd0e0d3b22fbe3f3f75439ffe180ed9cf0', 146, 'App\\Models\\User', '[\"*\"]', '2022-12-12 23:52:43', '2022-12-12 23:52:47', '2022-12-12 23:52:47'),
(594, 'auth_token', '653b837af01bf421fb7f765e0e2dee6856ebef25f87a54dcdf319fbdee8b8d4c', 146, 'App\\Models\\User', '[\"*\"]', '2022-12-12 23:54:11', '2022-12-12 23:54:15', '2022-12-12 23:54:15'),
(595, 'auth_token', 'dd082b718262d5884237922703e7261873eba3e91c6a0996a6d89da722004a3d', 146, 'App\\Models\\User', '[\"*\"]', '2022-12-12 23:55:48', '2022-12-22 22:27:19', '2022-12-22 22:27:19'),
(596, 'auth_token', '3f3cf6b6c03741aeb3059f64d1f79726af4d22e100d28b77a1c216e0a2d97f03', 149, 'App\\Models\\User', '[\"*\"]', '2022-12-15 15:15:10', '2022-12-15 15:15:10', NULL),
(597, 'auth_token', '63e37b80e241f4636be3728a8b89910eac9c85c257e1d8fdd2ec46e904ce8808', 147, 'App\\Models\\User', '[\"*\"]', '2022-12-15 17:49:07', '2022-12-15 17:49:55', '2022-12-15 17:49:55'),
(598, 'auth_token', '0016557f8d752b72be4a99276668b095ce58dc9f643ae1c8635e433a7f91c9d3', 149, 'App\\Models\\User', '[\"*\"]', '2022-12-15 19:59:08', '2022-12-15 19:59:16', '2022-12-15 19:59:16'),
(599, 'auth_token', 'da171456ec5b7f655574a4aaacf23cfa786675098a1cca806387e42dcf00965a', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-15 20:00:25', '2022-12-15 20:00:27', '2022-12-15 20:00:27'),
(600, 'auth_token', 'c1fdab1467dda084cf4b7095184069b9397c769ffb5553e63cf2da935577f549', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-15 20:00:47', '2022-12-15 20:00:58', '2022-12-15 20:00:58'),
(601, 'auth_token', 'ae9ae499fa9665fea1a7e9e30a5954f73815fd30199e11a1d209e5642ff6d68f', 123, 'App\\Models\\User', '[\"*\"]', '2022-12-16 16:02:08', '2022-12-16 16:03:18', '2022-12-16 16:03:18'),
(602, 'auth_token', 'e740f35befe3242df8e5768a7392949776cb2bb0a2f1cbc6dc8623484c9e268d', 123, 'App\\Models\\User', '[\"*\"]', '2022-12-16 16:05:04', '2022-12-22 18:30:17', '2022-12-22 18:30:17'),
(603, 'auth_token', '2997113b6d6b9c55846c23a7e5207986f7ac3c9e445cdd2892bada378aeb1256', 122, 'App\\Models\\User', '[\"*\"]', '2022-12-16 23:25:49', '2022-12-16 23:26:42', '2022-12-16 23:26:42'),
(604, 'auth_token', 'fa9898891f76d57e093cd0ea79d56027b6ae09a4d6c572d38ec32915fc2ebde1', 122, 'App\\Models\\User', '[\"*\"]', '2022-12-16 23:27:56', '2022-12-16 23:28:41', '2022-12-16 23:28:41'),
(605, 'auth_token', '064aead75da8d333cd9ee5889189a37aa15cc20fc9f6ca0aa467c396436215d3', 1, 'App\\Models\\User', '[\"*\"]', '2022-12-17 21:20:01', '2022-12-17 21:20:42', '2022-12-17 21:20:42'),
(606, 'auth_token', '4f59d907b026683f1e9033c3de58b19a0b08a3a98bc7577da1630ba64e7c79ae', 147, 'App\\Models\\User', '[\"*\"]', '2022-12-21 20:02:32', '2022-12-21 20:02:32', NULL),
(607, 'auth_token', '0dd02b8d95b732be30df7fd6ae42f3c985b75d6b3c08613384773809ebee53a2', 147, 'App\\Models\\User', '[\"*\"]', '2022-12-21 20:05:41', '2022-12-21 20:05:41', NULL),
(608, 'auth_token', '305cbbec4c00e37287fb9b14bc538d9c3ec456967dac4ad95a176fd766ea5aff', 147, 'App\\Models\\User', '[\"*\"]', '2022-12-21 20:28:57', '2022-12-21 20:29:08', '2022-12-21 20:29:08'),
(609, 'auth_token', '22492fdd58d3768851f0bbecf674220b24e4d13f0afe96e976d6cfba30b019ab', 122, 'App\\Models\\User', '[\"*\"]', '2022-12-22 00:24:35', '2022-12-22 00:31:33', '2022-12-22 00:31:33'),
(610, 'auth_token', '8f3eb0082800b467ef7eb764367571641cae081daf31a9f8ffcfe6ac8a5cc526', 122, 'App\\Models\\User', '[\"*\"]', '2022-12-22 00:31:41', '2022-12-23 19:18:27', '2022-12-23 19:18:27'),
(611, 'auth_token', '01a447bc580ceb589364cf93332e73ee50e961ca3328471f7cad7591024b271e', 116, 'App\\Models\\User', '[\"*\"]', '2022-12-22 15:19:14', '2022-12-22 15:19:43', '2022-12-22 15:19:43'),
(612, 'auth_token', '30e4a1eba45ddda3238817d92d874b13dbc540732a6b078906a93704f74e659e', 116, 'App\\Models\\User', '[\"*\"]', '2022-12-22 15:20:02', '2022-12-22 15:20:18', '2022-12-22 15:20:18'),
(613, 'auth_token', '9e75c35945e25bc2b87bb48289004f3066b5dfc3edc4bcc7d51cd606eddd09d5', 123, 'App\\Models\\User', '[\"*\"]', '2022-12-22 18:30:33', '2022-12-22 19:39:51', '2022-12-22 19:39:51'),
(614, 'auth_token', 'aecb408f2c10ae5ecb164e1e08d4e5fc7708044495bcf61c2e12474a40fffc9a', 116, 'App\\Models\\User', '[\"*\"]', '2022-12-22 18:47:37', '2022-12-22 18:47:44', '2022-12-22 18:47:44'),
(615, 'auth_token', '12162bfc46df31df36b46642f6ea3cea8ab66636d5aceb002e7ad7817810e26a', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-22 18:53:40', '2022-12-22 18:53:45', '2022-12-22 18:53:45'),
(616, 'auth_token', 'df93549e225fadf2db276913ffdaf9211e795ec38e134e8d57f6d94f609a5ced', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-22 18:54:25', '2022-12-22 18:54:42', '2022-12-22 18:54:42'),
(617, 'auth_token', 'af3397d000530a07365d1cd8dd562db3dad1c6834fe5573d0e0af752c4349a21', 116, 'App\\Models\\User', '[\"*\"]', '2022-12-22 19:43:12', '2022-12-22 19:43:12', NULL),
(618, 'auth_token', 'b3d5746378f3c6c537b3e435cb5136069fd06f93aaa5a30824ae0fd04e8f2456', 116, 'App\\Models\\User', '[\"*\"]', '2022-12-22 22:07:42', '2022-12-22 22:07:48', '2022-12-22 22:07:48'),
(619, 'auth_token', 'b7862025bf22d5ad55aa87bf5445f914e8b48e70eb0e9559a3714d3a01224fc0', 116, 'App\\Models\\User', '[\"*\"]', '2022-12-22 22:11:53', '2022-12-22 22:11:53', NULL),
(620, 'auth_token', '36eaee5754220266713f64745e9ac07f404f66310109feaf73a192bf9fb84a81', 116, 'App\\Models\\User', '[\"*\"]', '2022-12-22 22:18:26', '2022-12-22 22:18:35', '2022-12-22 22:18:35'),
(621, 'auth_token', 'da7d0d7e839f9fe020e06becd4a183a97d4c53e32988c085f1b8ad5a46a923a4', 116, 'App\\Models\\User', '[\"*\"]', '2022-12-22 23:59:10', '2022-12-22 23:59:17', '2022-12-22 23:59:17'),
(622, 'auth_token', '0fb307661d5de12fd6f294fc14ea7e0c5d6a9d15653c5c66ef76dbfe3df347cf', 116, 'App\\Models\\User', '[\"*\"]', '2022-12-22 23:59:40', '2022-12-22 23:59:59', '2022-12-22 23:59:59'),
(623, 'auth_token', 'f3155b9d7eef437160a3b83c5f408fb33e5b2c634c59715e7676ccca9f80bc97', 122, 'App\\Models\\User', '[\"*\"]', '2022-12-23 19:19:24', '2022-12-23 19:19:39', '2022-12-23 19:19:39'),
(624, 'auth_token', 'f4fd30ad24aa94e27fd0612b61877c2b95890f2556b2df9e93347a6d52af05ac', 142, 'App\\Models\\User', '[\"*\"]', '2022-12-26 21:13:31', '2022-12-26 21:14:14', '2022-12-26 21:14:14'),
(625, 'auth_token', '5a01070b909dd470854bd1567617a2a70f099e45ca4e4bda2952a342847d057f', 116, 'App\\Models\\User', '[\"*\"]', '2023-01-07 19:35:08', '2023-01-07 19:39:52', '2023-01-07 19:39:52'),
(626, 'auth_token', 'd223b8fd27a2692555f76842d06dc281849b14a626b252bbdaf17fd27119a7ca', 116, 'App\\Models\\User', '[\"*\"]', '2023-01-07 20:50:24', '2023-01-07 20:52:40', '2023-01-07 20:52:40'),
(627, 'auth_token', '7542cf2b6ea64fecc030f4d6c14da4cc7d63bdc156598e410bbd1222ee30b89f', 116, 'App\\Models\\User', '[\"*\"]', '2023-01-08 09:53:18', '2023-01-08 09:53:23', '2023-01-08 09:53:23'),
(628, 'auth_token', '2036795dbed614dc1dbb31347ff717c0c67f6cb3fbe8362e5ee89e2576e73c79', 142, 'App\\Models\\User', '[\"*\"]', '2023-01-08 10:24:10', '2023-01-08 10:25:00', '2023-01-08 10:25:00'),
(629, 'auth_token', 'd04b4e78e7e2cab3888ec2edba874cb557fbee7759cb3f6a9f15753fe0785e4e', 142, 'App\\Models\\User', '[\"*\"]', '2023-01-11 05:21:40', '2023-01-27 17:22:30', '2023-01-27 17:22:30'),
(630, 'auth_token', 'd12a52784c4620dbf149a45bc2df4c299cc8f6286d337c812964d1e36dcc7d60', 116, 'App\\Models\\User', '[\"*\"]', '2023-01-21 17:21:30', '2023-01-21 17:21:30', NULL),
(631, 'auth_token', 'ad1914bda678e17c4aa946602b5f0aeec4875afb16dd08ef85f3c6268c4c4959', 116, 'App\\Models\\User', '[\"*\"]', '2023-01-27 17:22:42', '2023-01-27 17:22:42', NULL),
(632, 'auth_token', '11be96847a1af1a9588b4f0ad5d6a9782b91d02a7992be961d11e776d182ae83', 116, 'App\\Models\\User', '[\"*\"]', '2023-01-30 16:03:43', '2023-01-30 16:03:43', NULL),
(633, 'auth_token', '8556f430fb4c554f075cae9d6bb972a52b09dca0ac1077c6b973f5f47710cc49', 116, 'App\\Models\\User', '[\"*\"]', '2023-01-30 16:04:20', '2023-01-30 16:11:28', '2023-01-30 16:11:28'),
(634, 'auth_token', 'ab9ff5fb9fb105bb72d53ec719310966875b1a5fc25378a2989b08daa71069e5', 116, 'App\\Models\\User', '[\"*\"]', '2023-01-30 16:20:25', '2023-01-30 16:20:25', NULL),
(635, 'auth_token', '2a7ea5ef48d0f70daef7a50e43e19e973fecf5a5fcc104617ba9425cf20b931e', 116, 'App\\Models\\User', '[\"*\"]', '2023-01-31 14:38:44', '2023-01-31 14:38:44', NULL),
(636, 'auth_token', '3d83b6226a084f059d96fdf7a065f75f29fd87b46943777a8eb72eac20591b36', 116, 'App\\Models\\User', '[\"*\"]', '2023-01-31 14:40:52', '2023-01-31 14:41:10', '2023-01-31 14:41:10'),
(637, 'auth_token', 'a509d528907d3d0f7152453f4a3873ca4429ae5199c2f87496bf798c217b0a1d', 116, 'App\\Models\\User', '[\"*\"]', '2023-01-31 14:41:32', '2023-01-31 14:41:32', NULL),
(638, 'auth_token', 'ab13fb5865ce87d1c2e70090d0b62e5a8f989f58ddc7133ba678bbe4d4ec7e65', 116, 'App\\Models\\User', '[\"*\"]', '2023-01-31 14:44:11', '2023-01-31 14:44:11', NULL),
(639, 'auth_token', 'c168c3b0f6b14deb2010ac44baf59d1eb56e87f3ceaa8e9a46f9072c482ce580', 116, 'App\\Models\\User', '[\"*\"]', '2023-01-31 16:15:26', '2023-01-31 16:15:26', NULL),
(640, 'auth_token', '64d46ce2a99b063494f705eb323e3027005c633e396573bd2db1e47b936b3033', 116, 'App\\Models\\User', '[\"*\"]', '2023-02-08 15:54:55', '2023-02-08 15:55:28', '2023-02-08 15:55:28'),
(641, 'auth_token', '2d3f49be72c5a7d911b74632333274e93334c8106e79467eff8e5dd80bccfe51', 116, 'App\\Models\\User', '[\"*\"]', '2023-02-08 15:56:22', '2023-02-08 15:57:03', '2023-02-08 15:57:03'),
(642, 'auth_token', '7552c660a4d92b2bbbc60de17c2701cef8d2fd5934ad4a50f4de61baddbfc7ff', 116, 'App\\Models\\User', '[\"*\"]', '2023-02-13 13:05:20', '2023-02-13 13:05:29', '2023-02-13 13:05:29'),
(643, 'auth_token', '34c17c46a78cfbd09a572a91ab32c5afb0023eb8effec94a4f9e57df6d2164fe', 116, 'App\\Models\\User', '[\"*\"]', '2023-02-15 11:48:12', '2023-02-15 11:48:16', '2023-02-15 11:48:16'),
(644, 'auth_token', 'a9c2404a06e5fc85d92b1995d92207308e36896c18526d72d0b9edb66ad32c46', 116, 'App\\Models\\User', '[\"*\"]', '2023-02-15 15:55:18', '2023-02-15 15:55:18', NULL),
(645, 'auth_token', '241c9519aefe6819f5e83876780eca7d37b2941c06658e7dc6de44df847b9b54', 116, 'App\\Models\\User', '[\"*\"]', '2023-02-15 16:40:01', '2023-02-15 16:40:01', NULL),
(646, 'auth_token', '5c4afd48bfd45375bf42128935b346c6c199de28af3b00982c8d4443e5a37c41', 116, 'App\\Models\\User', '[\"*\"]', '2023-02-15 16:48:51', '2023-02-15 16:48:51', NULL),
(647, 'auth_token', '653dab133a654b3ff58e9be86a96e2fb4f2f549ef521185a9367273dbbf1386a', 116, 'App\\Models\\User', '[\"*\"]', '2023-02-15 16:55:01', '2023-02-15 16:55:01', NULL),
(648, 'auth_token', 'c328acac77ef4a119501c544b206b780529d7d89c5f18ca935ff6fe7dce02d0a', 116, 'App\\Models\\User', '[\"*\"]', '2023-02-15 16:56:26', '2023-02-15 16:56:26', NULL),
(649, 'auth_token', 'b2248b57da72fe22057289f816ef49753b83e9d975c10af4357c6aa955da28bb', 116, 'App\\Models\\User', '[\"*\"]', '2023-02-15 16:56:36', '2023-02-15 16:56:36', NULL),
(650, 'auth_token', 'ed249919671f239eb3e71189bd3b397ed5471414b21341ab78440975ee151f98', 116, 'App\\Models\\User', '[\"*\"]', '2023-02-15 16:56:45', '2023-02-15 16:56:45', NULL),
(651, 'auth_token', 'd7800df5125d10a77c253a0677ef329db8bbf8bdb2e969e5c56ec1632e8996fc', 116, 'App\\Models\\User', '[\"*\"]', '2023-02-15 16:57:17', '2023-02-15 16:57:17', NULL),
(652, 'auth_token', '8f5fe5702c134edbf33986e7429e82f43b5af250c1dff0c292c7d87b11c92e9a', 116, 'App\\Models\\User', '[\"*\"]', '2023-02-15 17:02:44', '2023-02-15 17:02:44', NULL),
(653, 'auth_token', '49ec9a179ffcc6ce909f7c7179c8029066e6039f4ef39de95e169ac2e86f23dc', 116, 'App\\Models\\User', '[\"*\"]', '2023-02-15 17:02:58', '2023-02-15 17:02:58', NULL),
(654, 'auth_token', 'a6ddcc0799702b531e1a1970c63865db33babab70d834c64bd9c818ae39db82a', 116, 'App\\Models\\User', '[\"*\"]', '2023-02-15 17:03:01', '2023-02-15 17:03:01', NULL),
(655, 'auth_token', '38d0b4c76c59b7ea9c1970a51f7e0ac32ac9953dc98133f375989e531f97feaa', 166, 'App\\Models\\User', '[\"*\"]', '2023-02-17 10:23:33', '2023-02-17 10:24:14', '2023-02-17 10:24:14'),
(656, 'auth_token', '59065c1acf5b4412816d633d387b412af43593c2cc0e433eb9dd5af9aec7b0e4', 166, 'App\\Models\\User', '[\"*\"]', '2023-02-20 11:05:00', '2023-02-20 11:13:10', '2023-02-20 11:13:10'),
(657, 'auth_token', '8ce4124c073665f3da94ef791af3c9f44c43eabf966ad7561744daa67dffdba8', 166, 'App\\Models\\User', '[\"*\"]', '2023-02-20 11:15:31', '2023-02-20 11:15:44', '2023-02-20 11:15:44'),
(658, 'auth_token', '7ec4ccc0e21b411e758aeba6a243c79500e0e3bb0783aa8d6fb3e57f518ed103', 166, 'App\\Models\\User', '[\"*\"]', '2023-02-22 10:29:53', '2023-02-22 10:30:13', '2023-02-22 10:30:13'),
(659, 'auth_token', 'ba74e71b382feb0fac6d9e7b65c16f3c0734fbbbd67e6fc01b2cf57fdb071a89', 166, 'App\\Models\\User', '[\"*\"]', '2023-02-23 11:53:09', '2023-02-23 11:53:09', NULL),
(660, 'auth_token', 'c634ec7197c3f5ad57fc0bf2af2815506a83c43723613683f0426f7284a8a10d', 166, 'App\\Models\\User', '[\"*\"]', '2023-02-23 11:53:25', '2023-02-23 11:53:39', '2023-02-23 11:53:39'),
(661, 'auth_token', '1626aa491f2f98cb4fa30d568ff3c742085062246b5991ffd6a2d7f1c74560f0', 116, 'App\\Models\\User', '[\"*\"]', '2023-02-26 08:43:05', '2023-02-26 08:43:24', '2023-02-26 08:43:24'),
(662, 'auth_token', 'cfae660fd184afcec3a814a38fa5ee209a399ea74c9bb21f83ded7ee8a14ce0f', 116, 'App\\Models\\User', '[\"*\"]', '2023-02-27 13:43:47', '2023-02-27 13:43:48', '2023-02-27 13:43:48'),
(663, 'auth_token', 'bb54787d4bfa4e51674ac847f01819e2ad8e9e8c9b0e623130c5ffedbb032ae0', 116, 'App\\Models\\User', '[\"*\"]', '2023-02-27 15:57:44', '2023-02-27 15:57:44', NULL),
(664, 'auth_token', 'fe9051081d311abc3ee1bf3ea3504b4e32f76c2ff875961135edbfa9461c558e', 116, 'App\\Models\\User', '[\"*\"]', '2023-02-27 16:17:45', '2023-02-27 16:17:45', NULL),
(665, 'auth_token', '0dbc4bb187b48eff251242567998fcab17598d5ffada359c001bfdd5b1dcab39', 116, 'App\\Models\\User', '[\"*\"]', '2023-02-28 11:04:28', '2023-02-28 11:04:42', '2023-02-28 11:04:42'),
(666, 'auth_token', '881bc84f0eeb3c05ed4fe262c6ca0d8c5872d58203800a56ecf00ad34bdede58', 116, 'App\\Models\\User', '[\"*\"]', '2023-02-28 11:32:51', '2023-02-28 11:32:53', '2023-02-28 11:32:53'),
(667, 'auth_token', '777b5e3bc0f21eadc44d5cef8981efa8cb68ba824e7531a14b915fd5bebb4ec2', 166, 'App\\Models\\User', '[\"*\"]', '2023-02-28 11:45:06', '2023-02-28 11:45:37', '2023-02-28 11:45:37'),
(668, 'auth_token', 'b7d542812583b1554416d83692e58db3a135959116cb3d1414b26d02b9ba09f2', 166, 'App\\Models\\User', '[\"*\"]', '2023-02-28 11:46:33', '2023-02-28 11:46:48', '2023-02-28 11:46:48'),
(669, 'auth_token', '68d446fa36d77710761d148daa120fba7b890815bb005da75bee7d8b41a65b3c', 116, 'App\\Models\\User', '[\"*\"]', '2023-02-28 17:45:07', '2023-02-28 17:45:07', NULL),
(670, 'auth_token', 'e627d7ec439a8d438f0f4db33c9928e3f42e5f7e3a3818a7696c79ca17c71867', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-01 09:28:26', '2023-03-01 09:28:34', '2023-03-01 09:28:34'),
(671, 'auth_token', '7feac05aa3e81329278841abd70876d980ccd0dfa4bf18b03c4f94bac34b5a59', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-02 07:55:02', '2023-03-02 07:57:09', '2023-03-02 07:57:09'),
(672, 'auth_token', 'df8929e8ac6193e568e079b8850b3a62ec9adcec8d66d62bbe7ea176340d992d', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-02 07:57:34', '2023-03-02 07:58:08', '2023-03-02 07:58:08'),
(673, 'auth_token', '6fb120ba146feec6765c285d9b32ab59ed3f97a4ab8bdec0c3c09ab6546a31b7', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-02 09:10:19', '2023-03-02 09:10:21', '2023-03-02 09:10:21'),
(674, 'auth_token', '952738694e09b676abb4fab977ee16ecb365a05d4ca712f630eae55ba326ff64', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-02 09:15:46', '2023-03-02 09:15:47', '2023-03-02 09:15:47'),
(675, 'auth_token', '04030349440ad3429b8c1530cbef66ca93b21d2385016b04da15a8578169d911', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-02 09:21:48', '2023-03-02 09:22:32', '2023-03-02 09:22:32'),
(676, 'auth_token', 'a75f12d463edcc048401b2e56c1803732d8e5ecfcdfaf2f5c2fbc9c90dc8982b', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-02 09:24:36', '2023-03-02 09:24:36', NULL),
(677, 'auth_token', '412fa15b45e3afbacc8414b02695c5687da9e7fc10106af90f92dacd91aa45ab', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-02 09:49:47', '2023-03-02 09:49:50', '2023-03-02 09:49:50'),
(678, 'auth_token', '72af00d90adab29497dde08c488585eb927e6325341012a81b8f7f159c320143', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-02 09:51:37', '2023-03-02 09:51:46', '2023-03-02 09:51:46'),
(679, 'auth_token', 'b96dfbdc8783a08af1c4331ae8bf8e82c6ee0621ae31543afe7deee9de5568f1', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-02 09:52:57', '2023-03-02 09:53:22', '2023-03-02 09:53:22'),
(680, 'auth_token', '7e16b94181cc480bfa707a746df2887ef11d22fa4287facaeb3150bf9a813727', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-02 09:54:15', '2023-03-02 09:54:58', '2023-03-02 09:54:58'),
(681, 'auth_token', '566324e503da0331282a07d42d645111834fd7262105e1e6af246ae27f1a34e9', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-02 11:20:05', '2023-03-02 11:22:29', '2023-03-02 11:22:29'),
(682, 'auth_token', 'cb8bb0f1e747b6561d72d1285b1ebde7b7f74447969c6556b4c24761972d4d9b', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-02 11:23:38', '2023-03-02 11:23:49', '2023-03-02 11:23:49'),
(683, 'auth_token', '83be1ca6938a2460f53c8cd1de6eccdd59469c87a234d6f0818162408969ff0d', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-02 11:24:57', '2023-03-02 11:25:31', '2023-03-02 11:25:31'),
(684, 'auth_token', 'e84a900836ac71ac5e1548409284314613831d2a24dbebb5d78583b5a092fb2a', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-02 11:27:25', '2023-03-02 11:28:45', '2023-03-02 11:28:45'),
(685, 'auth_token', '82c3da095e532d9c498df651de021c482d3f22ab30597c246c8d0cdfeeb4657c', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-02 11:30:35', '2023-03-02 11:30:40', '2023-03-02 11:30:40'),
(686, 'auth_token', 'ca6e6750d633d6d9b1f90aaa732cec68e59cfdc07c7c9567cd54ee7aa9c1f4f1', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-02 11:44:33', '2023-03-02 11:44:37', '2023-03-02 11:44:37'),
(687, 'auth_token', '959350bb4328351ab802332cdb8b169f59d3ec2a7f6a0277074509fdd25fe217', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-02 11:45:01', '2023-03-02 11:45:13', '2023-03-02 11:45:13'),
(688, 'auth_token', 'b4b1c446f7b7f0deb8cf8554a802af1a0094ec2c16b033f609f8a6886bc33005', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-02 11:45:28', '2023-03-02 11:45:41', '2023-03-02 11:45:41'),
(689, 'auth_token', '277a0edc95a07b430d5d275b130eb8c0b8dc9ff4a00545af4719717823f45ad9', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-02 11:51:33', '2023-03-02 11:52:10', '2023-03-02 11:52:10'),
(690, 'auth_token', 'fb9ecfd748482d588e17ab017d1702b59d38393435f25eca1bfe94b583b1ea64', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-02 12:34:54', '2023-03-02 12:35:30', '2023-03-02 12:35:30'),
(691, 'auth_token', '3f1b23f8384caed681bcae0bbb1f85d475a5c353ee2f755b30a54e37265d02dc', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-02 12:35:53', '2023-03-02 12:36:24', '2023-03-02 12:36:24'),
(692, 'auth_token', '1292bfe58fa71aed137e95a0c1df91b4f98ad949c8bfdadadaeec3c0b3987fc1', 166, 'App\\Models\\User', '[\"*\"]', '2023-03-02 15:51:33', '2023-03-02 15:52:12', '2023-03-02 15:52:12'),
(693, 'auth_token', 'be92367044bf114d99c94b45a52fb61bd32958aa7e62d556fdc3dbcd8ddba1d7', 166, 'App\\Models\\User', '[\"*\"]', '2023-03-02 15:52:31', '2023-03-02 15:53:39', '2023-03-02 15:53:39'),
(694, 'auth_token', '550b7664df0ceccebe7fa2524ac67287f2cecb345b81e05232dd92e8188e2290', 166, 'App\\Models\\User', '[\"*\"]', '2023-03-02 15:53:55', '2023-03-02 15:54:04', '2023-03-02 15:54:04'),
(695, 'auth_token', '651db40a9db0c7e1b2858f015e061bdc2b01bf149e6f58f0a846627df220fb63', 166, 'App\\Models\\User', '[\"*\"]', '2023-03-02 15:54:20', '2023-03-02 15:54:27', '2023-03-02 15:54:27'),
(696, 'auth_token', '9a19067fd8d9a2300369e77c8bc725226252e94b022f3edd8495201c43b49d30', 166, 'App\\Models\\User', '[\"*\"]', '2023-03-02 15:54:56', '2023-03-02 15:54:56', NULL),
(697, 'auth_token', '3424817ecfbb8b20c8108fe4161ca67bab1d2deba34230d10ec89c22f1d0f790', 166, 'App\\Models\\User', '[\"*\"]', '2023-03-02 15:55:14', '2023-03-02 15:55:14', NULL),
(698, 'auth_token', '27723453ceba8b3e21fa9b3dfbc9a6ae0c0735dc1e1ddc41e7b18f35223c706b', 166, 'App\\Models\\User', '[\"*\"]', '2023-03-02 15:55:25', '2023-03-02 15:55:29', '2023-03-02 15:55:29'),
(699, 'auth_token', '9ef913168f2ee6907375899dc989463ccb00ac782b32e1eebd632c13d697d6b4', 166, 'App\\Models\\User', '[\"*\"]', '2023-03-02 15:56:47', '2023-03-02 15:56:50', '2023-03-02 15:56:50'),
(700, 'auth_token', '356273795b4a304283daa4002e1ff8fbd3bc48b7d68ad591f6b58ce8c5f1ca75', 166, 'App\\Models\\User', '[\"*\"]', '2023-03-02 15:57:21', '2023-03-02 15:57:26', '2023-03-02 15:57:26'),
(701, 'auth_token', 'ebc74899d09fb769a96a96837d0ab51660077493780493406c0c0401f2b43a96', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-02 15:59:31', '2023-03-02 16:47:30', '2023-03-02 16:47:30'),
(702, 'auth_token', 'd972b5ba71f996d3df44ce63b0cdc0715b0acbda6c6e87d361a76a4423983804', 166, 'App\\Models\\User', '[\"*\"]', '2023-03-02 16:01:06', '2023-03-02 16:01:06', NULL),
(703, 'auth_token', '86dc6afbf4f89a55bf90eb8ec15d5060bdb95f63ad181b9388dc2c381a576af9', 166, 'App\\Models\\User', '[\"*\"]', '2023-03-02 16:01:34', '2023-03-02 16:01:38', '2023-03-02 16:01:38'),
(704, 'auth_token', '9ae47cd46a7fa8df3c250cd7c1e0e338cb0a4c45bb709668fb35f45f20620438', 166, 'App\\Models\\User', '[\"*\"]', '2023-03-02 16:02:53', '2023-03-02 16:02:57', '2023-03-02 16:02:57'),
(705, 'auth_token', '62c64b9e14ae821bb0d569bf47c065fffa50a7eece9ae891cae414f3e9ac05ee', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-02 17:06:03', '2023-03-02 17:08:57', '2023-03-02 17:08:57'),
(706, 'auth_token', '5aa6ea6501a3c58331a371bf71f329281a24952471118cddb09c2292395ea9d9', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-02 17:37:30', '2023-03-02 17:39:45', '2023-03-02 17:39:45'),
(707, 'auth_token', 'f91d57ee043248a4321be3b51aecceb237b33889d649d7a15c98108bf1f9fc01', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-02 17:57:04', '2023-03-02 17:57:49', '2023-03-02 17:57:49'),
(708, 'auth_token', '5e34fdcb44d61923fc9255b4ff17215564c50daa1c56759def225880778e700e', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-02 17:58:26', '2023-03-02 18:00:34', '2023-03-02 18:00:34'),
(709, 'auth_token', '0feac034bd63badc8725af1d02bad26870233e68bd95e726f5722e1fad63b898', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-02 17:58:48', '2023-03-02 18:01:36', '2023-03-02 18:01:36'),
(710, 'auth_token', 'ce86cd1934c4581bc8e466ae8f4095081434cddf3434e2603d952f14e272c1ca', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-02 18:00:46', '2023-03-02 18:00:48', '2023-03-02 18:00:48'),
(711, 'auth_token', 'd232de778487dda84a00c879aa86e69178ee12e08c2f7b1fc79f9297ac70b772', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-02 18:02:16', '2023-03-03 05:02:00', '2023-03-03 05:02:00'),
(712, 'auth_token', '29674f76f4c408f420dcc2d467efeaa6fca993974ad8c09ef1e5e6396b5cc472', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-02 18:19:00', '2023-03-02 18:22:20', '2023-03-02 18:22:20'),
(713, 'auth_token', 'b95e646b36271ee92ceba6df6d422d8a2bc15374791dccabf751c5907a8b5c0b', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-02 18:22:47', '2023-03-02 18:23:40', '2023-03-02 18:23:40'),
(714, 'auth_token', '604fccd1635192fd82a1eabe5cdb420868e9b2db8a8ec193757d87e248b23569', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-02 18:24:41', '2023-03-02 18:25:27', '2023-03-02 18:25:27'),
(715, 'auth_token', '2c4e8227d5b88d8faef5b00e3014b1dcc84aa7e2e2ee16b5fe42d6293652299f', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-02 18:25:53', '2023-03-02 18:26:39', '2023-03-02 18:26:39'),
(716, 'auth_token', 'acfdae9b77035a8241863a1d2b0baa9ebdc3b7dfca2e82e5484ace85573115bd', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-02 18:29:32', '2023-03-02 18:29:34', '2023-03-02 18:29:34'),
(717, 'auth_token', '488aaafcff67e1f1f4d3daf3c833ae161c540e5d1646f8a532b1574b52920cad', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-03 05:39:11', '2023-03-09 06:47:25', '2023-03-09 06:47:25'),
(718, 'auth_token', '2bdd66d4098a82d0d20365d72621b9af5f169b2b54a9fa55c3a90b298cb54025', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-05 16:56:17', '2023-03-05 16:57:29', '2023-03-05 16:57:29'),
(719, 'auth_token', '30a039548c6ee4b7333e463a4501b4e379645cfe74da8286511715042c7879fb', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-06 15:05:47', '2023-03-06 15:05:52', '2023-03-06 15:05:52'),
(720, 'auth_token', 'be78ef01cea1563beeeca65ef19183d34dd4db69a26bf8c8ac46f1b15dafaa5f', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-07 07:31:00', '2023-03-07 07:32:42', '2023-03-07 07:32:42'),
(721, 'auth_token', '4bc089751694d082561ff172ab9cad1ccd5eebcae6b5b5010475b65387787f68', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-09 06:13:14', '2023-03-09 06:13:16', '2023-03-09 06:13:16'),
(722, 'auth_token', '5ffbdaebcb5406d2e59d8027a1d4a6a292d89475a707872f288044853995e6d1', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-09 06:15:28', '2023-03-09 06:16:26', '2023-03-09 06:16:26'),
(723, 'auth_token', '0132f836e1087fd908242e30abd7906538ccf89de8575eb1f34c76b785b33ae8', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-09 06:49:49', '2023-03-09 06:50:21', '2023-03-09 06:50:21'),
(724, 'auth_token', 'b95529a51d827a9b39daa0f21cb503ec40f1e3d7b8bf48031005567187fd52af', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-09 06:56:02', '2023-03-09 06:56:37', '2023-03-09 06:56:37'),
(725, 'auth_token', 'efb054d0f058b3084cdae96ff70cd2e8256c9ba04efefff7116cf6bd0fb8e6b6', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-09 10:11:26', '2023-03-12 12:02:48', '2023-03-12 12:02:48'),
(726, 'auth_token', '318955b7346b17677a0a8b22cf26396c8127c42cb9d3ea430be1f0d5a8781977', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-10 10:12:24', '2023-03-10 10:12:26', '2023-03-10 10:12:26'),
(727, 'auth_token', '70fe358642558ce5685c64567924575766e545822b7cb9323ea591a769baeeda', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-10 10:13:44', '2023-03-10 10:13:47', '2023-03-10 10:13:47'),
(728, 'auth_token', '7e435d1ee4e0eaffdf8ab7979bcd1eb6326f9a3b5541ffbd48474fcf37333c74', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-10 10:27:44', '2023-03-10 10:27:53', '2023-03-10 10:27:53'),
(729, 'auth_token', 'ad804f1747407f15babba6bef8950822b49c9f0531d8af071e3779e92f1a583c', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-10 10:31:31', '2023-03-10 10:33:02', '2023-03-10 10:33:02'),
(730, 'auth_token', '3a98bc4f9d8182108b9034b4229a8c5e0626f35b9ef241e4e3ee164268a44528', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-10 12:07:15', '2023-03-14 04:05:21', '2023-03-14 04:05:21'),
(731, 'auth_token', '7f56f107ab23f955b10cd28276ad98cb5b9adbafe9e9c889baaccb4419b54bbc', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-10 13:01:27', '2023-03-11 09:31:38', '2023-03-11 09:31:38'),
(732, 'auth_token', 'c2eabfe89c0995437f1ab949295ea7c096d0abea6d567f472cc2c2a472271646', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-10 15:12:14', '2023-03-10 15:12:42', '2023-03-10 15:12:42'),
(733, 'auth_token', '04fbeb89de5b1eac994150488ffff678dba3b810ac0a05b999ff5ce169bc767a', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-10 15:13:01', '2023-03-10 15:13:21', '2023-03-10 15:13:21'),
(734, 'auth_token', '809d48588f350933292c7634c2b0a3b76023f5cecbc4b5ef24295381e7f5555d', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-10 15:26:06', '2023-03-10 15:26:36', '2023-03-10 15:26:36'),
(735, 'auth_token', 'ad9d15a1f25c1bb539fc224cf31e2254a3db8b3f839391c593c993916898bb06', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-10 15:36:47', '2023-03-10 15:38:28', '2023-03-10 15:38:28'),
(736, 'auth_token', '773e55cf6e188e54bf68339a81ef872d2e14c66c7a1916d3857845219d3199ea', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-11 09:31:37', '2023-03-11 09:31:54', '2023-03-11 09:31:54'),
(737, 'auth_token', 'd86c1ba4da097c8deeb67f02733bec17a313cb66a3ce6e63cd0cc5f072436aa0', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-11 14:36:03', '2023-03-11 14:36:11', '2023-03-11 14:36:11'),
(738, 'auth_token', 'b3b15a51e3caf5481719ac286bac43746acd2ed35c9325b040a58852f4217182', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-11 14:53:08', '2023-03-11 14:53:17', '2023-03-11 14:53:17'),
(739, 'auth_token', 'df848424592246dc4b2d9b98d96637a073d2499ccf86fac9f9b4d5b22dac68c8', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-11 14:54:27', '2023-03-11 14:54:47', '2023-03-11 14:54:47'),
(740, 'auth_token', '31e3a4a8b925e8292e45b22dd95eb7cb50e1747b81aad29f3292634976c8c784', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-12 07:59:16', '2023-03-12 07:59:46', '2023-03-12 07:59:46'),
(741, 'auth_token', '1df6f035b885d69636fe558808617f6da4fa8517d1db80286740f17a4144da41', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-12 12:04:08', '2023-03-12 12:07:50', '2023-03-12 12:07:50'),
(742, 'auth_token', '2f220e84159ea98365e8ef1b90c70468311e5da13827be312242bbc2f7a9c253', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-12 12:10:23', '2023-03-12 12:10:36', '2023-03-12 12:10:36'),
(743, 'auth_token', '00588898c953752a7a86dafd8a471768fa76883baf04d27c0263e67df01fffd3', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-12 12:11:10', '2023-03-12 12:11:34', '2023-03-12 12:11:34'),
(744, 'auth_token', '5fef8f5bfa9f0ac68daf9264be64b39955dfe672ffc0fdf0c620e1e48e7fb083', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-12 12:14:17', '2023-03-12 12:14:19', '2023-03-12 12:14:19'),
(745, 'auth_token', '1e061f801a7fdd027bca36fbf5c3c7877750a6e1e14ce965f3eedc54eef91c29', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-12 12:20:16', '2023-03-12 12:21:10', '2023-03-12 12:21:10'),
(746, 'auth_token', '07ceb9f93f7ef6c6bb69c3c71dfe94780c8ccba4720c5a789fe2be71537b0391', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-12 12:24:17', '2023-03-12 12:24:20', '2023-03-12 12:24:20'),
(747, 'auth_token', 'e76f662555906848dbe1c1dbf2afc3a5af8da5f870f8abd278735246ec0cd4a9', 166, 'App\\Models\\User', '[\"*\"]', '2023-03-12 12:27:05', '2023-03-12 12:28:44', '2023-03-12 12:28:44'),
(748, 'auth_token', '70a8c7d36b24dce204b1afd1680c209a68d3e795b28c252b56a5c89a84812d94', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-12 12:43:22', '2023-03-12 12:45:21', '2023-03-12 12:45:21'),
(749, 'auth_token', 'af15c1da70679ec038ec2d8946fcd1f68e81ee3fac395040b9743efde4230f56', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-12 13:55:36', '2023-03-12 13:56:11', '2023-03-12 13:56:11'),
(750, 'auth_token', 'e82acfdc5910bf406a10c747d1ea1bf1a3bce2f894ecce2b16c15126bccb1356', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-12 13:58:24', '2023-03-12 13:58:42', '2023-03-12 13:58:42'),
(751, 'auth_token', '590f2780e8b83b91691c0c013e04e029653a6e1b94b9018854e6b95c9d49dd02', 166, 'App\\Models\\User', '[\"*\"]', '2023-03-12 17:28:53', '2023-03-12 17:28:56', '2023-03-12 17:28:56'),
(752, 'auth_token', '8c6e51434d808d1c77366d859b9b038e3f2de781a61c6d759a062df14c3dec28', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-13 05:22:54', '2023-03-13 05:23:04', '2023-03-13 05:23:04'),
(753, 'auth_token', 'd1a6134a1fedcdc74bdd9782383a83d2b245979aaccd9a4320a8563564600757', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-13 05:30:26', '2023-03-13 05:36:23', '2023-03-13 05:36:23'),
(754, 'auth_token', 'b4bb8ddbed523e208d3a0b708caa02d31a44be1d1b64ab189228d4f0e8ae4340', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-13 05:42:47', '2023-03-13 05:44:17', '2023-03-13 05:44:17'),
(755, 'auth_token', '81a3bfa825a544da1c07b0e330e0c22be7642cb59a961a24067082f2436ed1a4', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-13 05:48:07', '2023-03-13 06:11:19', '2023-03-13 06:11:19'),
(756, 'auth_token', 'cce4977fa41aa18707dabc9512ebd988c897c42cef70fd37d511a98f51d6b1df', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-13 06:17:17', '2023-03-13 06:17:25', '2023-03-13 06:17:25'),
(757, 'auth_token', '880439ee768751ee03b65ecf40023b8eb491491846d3435fcd4d6b3349e24a42', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-13 15:02:49', '2023-03-13 15:09:16', '2023-03-13 15:09:16'),
(758, 'auth_token', '2087ea62116182b96bc2c30c3dd526dbaf709208eac3ac36025d7770097d01dc', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-13 16:07:44', '2023-03-13 16:07:57', '2023-03-13 16:07:57'),
(759, 'auth_token', '9fe354b443ec1619686573a361e97af5c608bd0366de99a247f9311bdd375529', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-13 16:10:08', '2023-03-13 16:10:27', '2023-03-13 16:10:27'),
(760, 'auth_token', '410daee91b78a545fd88db121b7b780b6a4c4dd0512aa12cabfa667434012ca2', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-13 16:12:49', '2023-03-13 16:13:02', '2023-03-13 16:13:02'),
(761, 'auth_token', '241c496997065eadfeec941de646f3d7fee473c9ddac77e72bb00dde77fa043c', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-13 16:18:47', '2023-03-13 16:20:11', '2023-03-13 16:20:11'),
(762, 'auth_token', '84aa6c794415e2e22d9a4665cf306463616a91e03ca7db534ddd3890e770cbff', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-14 03:23:01', '2023-03-14 03:23:17', '2023-03-14 03:23:17'),
(763, 'auth_token', '87deef80d658b2b155d17eb53e8cada0b8fdca118492bb9d9bc18ce42939e7ec', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-14 03:24:18', '2023-03-14 03:25:20', '2023-03-14 03:25:20'),
(764, 'auth_token', '26245a1763dc0b64201f425bef2368fbc9d917405fe4dbdea97afe34dc4808e6', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-14 03:26:48', '2023-03-14 03:27:49', '2023-03-14 03:27:49'),
(765, 'auth_token', 'c37bdaee3bebf0b85ebc95ae94500fc69eee55187c4876d7d20d5cdcad47b8ae', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-14 03:58:26', '2023-03-14 07:52:55', '2023-03-14 07:52:55'),
(766, 'auth_token', 'e901fa9008ee692ea26423a2a34c870c4b2e2aca8cf623d0d0e2ced8fd6e2ff9', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-14 04:05:36', '2023-03-17 15:51:57', '2023-03-17 15:51:57'),
(767, 'auth_token', '3e27e9af17e887c4aec245e519a08871d4399e52e990168d0cae0bd17f0f7ab1', 166, 'App\\Models\\User', '[\"*\"]', '2023-03-14 04:13:39', '2023-03-14 04:13:43', '2023-03-14 04:13:43'),
(768, 'auth_token', '926352f56f1355a1f55dcfa0d180304ec9be335e17ff5bc56c77e9b81862ca22', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-14 04:35:54', '2023-04-01 07:21:09', '2023-04-01 07:21:09'),
(769, 'auth_token', 'd9deafce7ccb00655620174a713736bbe1ef12d0c3927875de3df6213614f3d2', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-14 04:36:08', '2023-03-14 04:36:12', '2023-03-14 04:36:12'),
(770, 'auth_token', 'c9494c515cbec5acd086c2870e5d56ec029323cc9e8b2ea94bdd83663998dced', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-14 04:49:02', '2023-03-14 04:49:02', NULL),
(771, 'auth_token', 'dfff8dfb0a79e8f1cb0dc44995bd0085cd0d6c83109ec170e53c9698e98d95b2', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-14 05:24:41', '2023-03-14 05:27:11', '2023-03-14 05:27:11'),
(772, 'auth_token', 'c2ee0880c98fcbbc331be3c7544cc7b92c84f573c0d000cfb5bc79701261782d', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-14 05:28:10', '2023-03-14 05:29:35', '2023-03-14 05:29:35'),
(773, 'auth_token', '80beb45f66a8d2f72152e95563aecf1380b14205989b5c8ae309da4e48e3bd71', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-14 05:30:37', '2023-03-14 05:30:40', '2023-03-14 05:30:40'),
(774, 'auth_token', 'b48d093cfcdf8f8af4210b0f9079afed6c1cc610878aece9750b7b2e7427e56a', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-14 05:33:29', '2023-03-14 05:33:33', '2023-03-14 05:33:33'),
(775, 'auth_token', 'c59f6eae432b5b1e45de77a85753b3be3f83b9273bc7bb513502909dbd15be1f', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-14 05:34:31', '2023-03-14 05:34:35', '2023-03-14 05:34:35'),
(776, 'auth_token', 'd0d16c405afbcfb20e8adb6c638b8a8d2ab482fc9d1f17e10344e42344aa936b', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-14 05:35:46', '2023-03-14 05:35:50', '2023-03-14 05:35:50'),
(777, 'auth_token', 'e305b7750ee5798bea8d67246065ad6e4236a533672964d8724e706036003e19', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-14 05:44:16', '2023-03-14 05:44:36', '2023-03-14 05:44:36'),
(778, 'auth_token', '2fd73ff24b50432f944e248b8dc62f35845cfb21408b1b48a4955aaa1ae36eab', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-14 05:46:23', '2023-03-14 05:48:13', '2023-03-14 05:48:13'),
(779, 'auth_token', 'f08ae4a9a76ea5a4719a44ab9079c8394973f84bd657c35e8c128c714a081c9b', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-14 05:49:30', '2023-03-14 05:49:33', '2023-03-14 05:49:33'),
(780, 'auth_token', '65fe23d64f4058512a5b9298bcb46986345384930c667cf89c7bd1eacd600fe2', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-14 05:54:04', '2023-03-14 05:54:06', '2023-03-14 05:54:06'),
(781, 'auth_token', 'e6d602fa7becaa3e99019187bdfa5fad111933e694f2d5733b6c64da7e36981b', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-14 05:55:43', '2023-03-14 05:55:52', '2023-03-14 05:55:52'),
(782, 'auth_token', '43c34109ccad7fdcec4d459c7cd1587f42ed1f7965594c3d79113c8998d20994', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-14 05:56:48', '2023-03-14 05:56:53', '2023-03-14 05:56:53'),
(783, 'auth_token', '17d84f4a2a559aab80a391faa83b5f3144b273e989cadae33fc547a3db0f4cea', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-14 05:58:55', '2023-03-14 05:59:17', '2023-03-14 05:59:17'),
(784, 'auth_token', '5d5babe5f46c6a36c2d98ab07f0635798cc36f0acf743c64036872814a014997', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-14 06:06:16', '2023-03-14 06:07:27', '2023-03-14 06:07:27'),
(785, 'auth_token', '18080f706b7eb7e263cdf6eabeceadd0ce944c0465f54cb0b3eaa42d7d958db9', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-14 06:08:41', '2023-03-14 06:12:53', '2023-03-14 06:12:53'),
(786, 'auth_token', 'b0f2e86b3c283fb215226d868c9a6765042902b1596e515b3c26e545b3fe245d', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-14 07:53:13', '2023-03-14 12:25:43', '2023-03-14 12:25:43');
INSERT INTO `personal_access_tokens` (`id`, `name`, `token`, `tokenable_id`, `tokenable_type`, `abilities`, `created_at`, `updated_at`, `last_used_at`) VALUES
(787, 'auth_token', 'b94f1ce136495e850bd11baca8a590d9b1e13510523829080d47152791d064e2', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-14 12:28:22', '2023-03-14 15:45:16', '2023-03-14 15:45:16'),
(788, 'auth_token', 'b5c9129dfec2bc962d94a1d97fd54d5e809359a2d60bbcf2694c36dfc86528fb', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-14 16:51:35', '2023-03-14 16:57:53', '2023-03-14 16:57:53'),
(789, 'auth_token', 'c704f084f6cec200ad97c633e67eea6dd598ee947ad1bb88655315bc8f38a572', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-14 16:59:11', '2023-03-14 17:00:12', '2023-03-14 17:00:12'),
(790, 'auth_token', '1da8e011601909e515f95585f7f647415c5a65dda6c7422723251be4769f9f92', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-14 17:14:06', '2023-03-14 18:49:19', '2023-03-14 18:49:19'),
(791, 'auth_token', '7eca2d6dca6e4816e082ea0bec4b9a7e783d9845cbd9ecd49c3e5232dd6e453a', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-14 18:10:57', '2023-03-14 18:10:57', NULL),
(792, 'auth_token', '3bcc0ea553ad5692c444bc0e5e5e77d28cfeb1631edaf4ffdd9e142a38bfe746', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-14 18:54:11', '2023-03-14 18:55:19', '2023-03-14 18:55:19'),
(793, 'auth_token', '4555e3ed531e30f25b94dcdf8eb5aaddbd2ec92a6aed5eeda75ac67ea9444d4f', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-14 19:47:55', '2023-03-14 19:48:26', '2023-03-14 19:48:26'),
(794, 'auth_token', '08657f5b237b2aef6a3b336acfa68e06ce01d4c969b46140ef9d2f88a50de866', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-14 19:56:20', '2023-03-14 20:00:40', '2023-03-14 20:00:40'),
(795, 'auth_token', '50cfd80a65c807b5a2c5b6dd10c49d06a5ec7a4411795fa88b0f2fdbc2642447', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-14 20:06:23', '2023-03-14 20:06:41', '2023-03-14 20:06:41'),
(796, 'auth_token', 'f3b65214222a246cf567e4ba089c2b586467a40a8efd3537a38264b0912ef65f', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-14 20:14:12', '2023-03-14 20:27:53', '2023-03-14 20:27:53'),
(797, 'auth_token', 'bf468f12fdb9866b440ad07e38f090f6313e7d59abea8b9e5dbb2709811ee1a1', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-14 20:30:16', '2023-03-14 20:33:51', '2023-03-14 20:33:51'),
(798, 'auth_token', '27ef4827be13c33acc00c9e5179e3bd5c0238c2a861794b83149845f0224ed53', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-14 20:55:53', '2023-03-14 20:56:15', '2023-03-14 20:56:15'),
(799, 'auth_token', '840086e50e2acce6ea7253b6e1723052500699cf3c8d8b69130f45f51e371ff4', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-15 02:29:09', '2023-03-15 02:31:10', '2023-03-15 02:31:10'),
(800, 'auth_token', 'a212cca029c88262489c0497e26d43103dca27607df34b6582eeac06e9347ce5', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-15 02:40:40', '2023-03-15 02:44:27', '2023-03-15 02:44:27'),
(801, 'auth_token', '1e4745c93d968506662821585944ba5b776ec4ff015dfc158377c0763f9a8cd2', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-15 03:14:38', '2023-03-15 03:15:47', '2023-03-15 03:15:47'),
(802, 'auth_token', 'f15dcd30b99eae503f79b116e9f792d51fa7bc8c3e807bd8c08193a91a360243', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-15 05:13:28', '2023-03-15 05:14:30', '2023-03-15 05:14:30'),
(803, 'auth_token', '2de90ff4e9b17c729299e8bd35cb9da7bc865e47258d87a39553f29498b6a3b0', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-15 05:16:02', '2023-03-15 05:17:14', '2023-03-15 05:17:14'),
(804, 'auth_token', '0b21a8de5013c96a351ca30d81fd4c6d4a1664e95c8633f4233d6fef176aa71b', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-15 05:20:03', '2023-03-15 05:20:09', '2023-03-15 05:20:09'),
(805, 'auth_token', 'c01cd0ad5e8414e3892935da6371c3703eebb01545468d92a16cbc1ce0456887', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-15 05:21:10', '2023-03-15 05:23:27', '2023-03-15 05:23:27'),
(806, 'auth_token', '4f5a40f2912e0765189619f77001421914e30d059148d7c4d87e7b62477d8448', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-15 05:24:27', '2023-03-15 05:39:55', '2023-03-15 05:39:55'),
(807, 'auth_token', 'edd3ae224b87a194973ec55d5b49c99c3cb03bb714a1ac6c8e330192301d4884', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-15 05:25:26', '2023-03-15 05:26:54', '2023-03-15 05:26:54'),
(808, 'auth_token', '8e9e7d3806ba86ec614d3b12d8c06767dbac50e419b5d53106bd9495222b18ff', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-15 05:36:40', '2023-03-15 05:37:28', '2023-03-15 05:37:28'),
(809, 'auth_token', 'a903b8d9bb542c76bef83904805a336c5c31f88c1e913743e46828f5bd35a08f', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-15 05:58:51', '2023-03-15 06:01:08', '2023-03-15 06:01:08'),
(810, 'auth_token', '596b5fab5e3598dc2e0c61b11d5edf517ee999b96327c07a5038801540fc1043', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-15 06:00:41', '2023-03-15 06:01:32', '2023-03-15 06:01:32'),
(811, 'auth_token', '271eb5bbe214804d1fd6c862b4d276d3a5d13745154523eb4181289dad9d97b0', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-15 06:02:33', '2023-03-15 06:06:12', '2023-03-15 06:06:12'),
(812, 'auth_token', '7c394c96fe58287bdf5eb6bf7b09ffe70b3d4810cfeb7ee62841015c2b030812', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-15 06:15:45', '2023-03-15 06:15:54', '2023-03-15 06:15:54'),
(813, 'auth_token', '27d40920a952406b7c6528328ab607268d465c5371829f15b1c0c4ca30e2bcb4', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-15 10:21:48', '2023-03-15 10:26:54', '2023-03-15 10:26:54'),
(814, 'auth_token', '1cfb0bab4503b9b862300b90f5a65fd05026ec08c89cd93d3dd8dac10b9d8c16', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-15 17:49:59', '2023-03-15 17:50:14', '2023-03-15 17:50:14'),
(815, 'auth_token', 'bb65949ecfc5d5ded97f88e0652bf6469854791a170f2a3b840d0d1276ef0e3d', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-15 17:51:10', '2023-03-15 17:51:22', '2023-03-15 17:51:22'),
(816, 'auth_token', '34cbfe3d8c12ca1f086e1c912bd267c0dfc79a2eb3c779a59272bee9d7636e0b', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-15 17:53:25', '2023-03-15 17:54:27', '2023-03-15 17:54:27'),
(817, 'auth_token', 'eade52cddd89e4b38bc9546e367a8fb318cf46eafd0138519d26562eb377eab7', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-15 17:55:40', '2023-03-15 17:55:43', '2023-03-15 17:55:43'),
(818, 'auth_token', '95ec746cf16071d7a80377efca54a562e57a57adf082bcdef660c88b0649dd0f', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-15 17:55:56', '2023-03-15 17:57:04', '2023-03-15 17:57:04'),
(819, 'auth_token', '48d77e7515fa6ffe127177aecfe5f9e3667c71bf34e1970ea3a65541c0feff61', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-15 18:01:29', '2023-03-15 18:02:19', '2023-03-15 18:02:19'),
(820, 'auth_token', '5e81385f3b9d42134b9ea496099784e4454f51165be9033f8fd1cdbc72f3a34d', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-15 18:08:31', '2023-03-15 18:08:43', '2023-03-15 18:08:43'),
(821, 'auth_token', 'd128b6395f1a620046d8d8f5f62cfd0f8797e1711dd812fb85cf735250ad645f', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-15 18:10:13', '2023-03-15 18:13:43', '2023-03-15 18:13:43'),
(822, 'auth_token', '128aa65e68a3ca7819d73e436b94ddf0ad397fe043dc55087640f12e9e5f6de8', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-15 18:24:25', '2023-03-15 18:26:37', '2023-03-15 18:26:37'),
(823, 'auth_token', 'fdfd863a2fbb859332af646475a181bcc182ce36962b5a1b53c4c39a5704bb0a', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-15 18:26:15', '2023-03-15 18:26:38', '2023-03-15 18:26:38'),
(824, 'auth_token', '5312b9c35d2d866b8bbbdc473d0e2631bc169faec86e4cc16c384df61d23df67', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-15 18:31:56', '2023-03-15 19:37:25', '2023-03-15 19:37:25'),
(825, 'auth_token', 'a3a2b019e0aae5ea6291975e8a4d1341df9e80410ffe3696ed00f7e46e3da1eb', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-15 18:36:25', '2023-03-15 18:36:38', '2023-03-15 18:36:38'),
(826, 'auth_token', '4128d1c4013c2c18c0857c112ed4dbbecbe616f1df6abffa21add01fdcff968c', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-15 19:37:37', '2023-03-15 19:39:08', '2023-03-15 19:39:08'),
(827, 'auth_token', '87a4f71f226356ba857b88162121cced94a215fbf12fdd390c88b3eec6165b4c', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-15 19:57:59', '2023-03-15 19:59:02', '2023-03-15 19:59:02'),
(828, 'auth_token', '9be069afba233b498e04a2ea8a02ebb89fff79cb2d47d6ba5602e00110322186', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-15 20:50:58', '2023-03-15 20:52:02', '2023-03-15 20:52:02'),
(829, 'auth_token', '219b741d0a4a1b9c189a4eb16d3642f24048e5b3325bf1efe8b9eaf3d2c022aa', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-16 04:52:56', '2023-03-16 04:53:11', '2023-03-16 04:53:11'),
(830, 'auth_token', 'a107072f0f80101acd91de4446aee7227454d936f46a4486fda1eb750212eac6', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-16 19:33:28', '2023-03-16 19:34:10', '2023-03-16 19:34:10'),
(831, 'auth_token', '886e3cb4fc3d1b74f47c8b330ecda987df9b58ec8be74c66af90efef20333da6', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-16 20:23:35', '2023-03-16 20:24:23', '2023-03-16 20:24:23'),
(832, 'auth_token', 'd17d3b2a65f8c46f2b9334101906a395373d75739e5eb9c111fb5c6a1d4a82de', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-16 20:40:02', '2023-03-16 20:42:13', '2023-03-16 20:42:13'),
(833, 'auth_token', '8c0f2c9c30d30ac10a327cbbee64abd87afa16db32093fc57174958e319e1535', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-16 20:42:20', '2023-03-18 20:43:17', '2023-03-18 20:43:17'),
(834, 'auth_token', '2d7909c3f695a6d0327eacbd3a642360335fd6b907d25089940c171a496cdc0e', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-17 15:52:20', '2023-03-21 14:03:38', '2023-03-21 14:03:38'),
(835, 'auth_token', '0a5ef1efa7e81949ef1703e184b9940a21868e730c84ed48f8ee80d5f9b54d9e', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-17 16:35:15', '2023-03-17 16:38:08', '2023-03-17 16:38:08'),
(836, 'auth_token', '3d14dd7bbb621b87a1a49b4eb67f8fd8a5e1fb0764111e69106533c45f445fe1', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-17 16:39:07', '2023-03-17 16:40:55', '2023-03-17 16:40:55'),
(837, 'auth_token', 'a4afef58582216371fe5af22bb156dc3d72eb5c752f96955d10f07147d83f7b2', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-19 15:38:43', '2023-03-19 15:38:43', NULL),
(838, 'auth_token', '25838d0b7d27ca2f0da65ac66f66fbc2926dc0c0a047860b8e288e529a3d670f', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-20 11:48:17', '2023-03-20 11:49:05', '2023-03-20 11:49:05'),
(839, 'auth_token', '4fbd922a4a894b80e46a7f5149a68a58cc0429238c18eb67c8317a841e0e5e2b', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-20 13:19:34', '2023-03-20 13:20:29', '2023-03-20 13:20:29'),
(840, 'auth_token', '496efe4b1fa8cd3361b089e2014d0795c798a5f98f35b73264b0eee4969f6627', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-20 14:08:19', '2023-03-20 14:08:45', '2023-03-20 14:08:45'),
(841, 'auth_token', 'edeb376dc0d8c939df95845abbe51ad2282902d70c8ba568894aa8edcb392802', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-20 15:31:57', '2023-03-20 15:32:41', '2023-03-20 15:32:41'),
(842, 'auth_token', 'db46523b13437c29d27131c92c9de3844b90531ff4b532d8875a849b011ac128', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-20 16:11:18', '2023-03-20 16:11:54', '2023-03-20 16:11:54'),
(843, 'auth_token', 'bcbccd2b3eb3c9f98e80c5bafe9a87cfcb5fc5747cfe63c950310e6f91131342', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-20 17:06:31', '2023-03-20 17:07:01', '2023-03-20 17:07:01'),
(844, 'auth_token', '4a10e0bd9367303f51a3823e0607c40d9c2f79df79ed0a3964192bc070656766', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-20 17:42:46', '2023-03-20 17:42:54', '2023-03-20 17:42:54'),
(845, 'auth_token', 'fa69b43a96ad1a6cd7454829608733d5cdc6f4ae07516614a914272be81a25db', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-20 17:44:00', '2023-03-20 17:45:54', '2023-03-20 17:45:54'),
(846, 'auth_token', '2fefb6d291d029d74ab95a1bcef1907f6b803241d1e20a50752cec04e3b16482', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-20 18:51:00', '2023-03-20 18:51:51', '2023-03-20 18:51:51'),
(847, 'auth_token', '345130bb04c969684c00373b704665f60cda8df36e40be548c82f55623bf6966', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-21 14:03:53', '2023-03-27 04:33:19', '2023-03-27 04:33:19'),
(848, 'auth_token', '5d060c2c8ce48f91f0f33a901066bd1632ad803bcb0bb5e10861f139fbf7a4dd', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-21 14:48:01', '2023-03-21 14:50:48', '2023-03-21 14:50:48'),
(849, 'auth_token', '3639db0034394543fd2ffa3d7327f063e1fe565a6d26531e4ae7789566a26520', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-21 14:56:07', '2023-03-21 14:56:11', '2023-03-21 14:56:11'),
(850, 'auth_token', 'e84bae14a6c0891a66b289a4154562880a640efae9d79dd009aa1fa698a9a940', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-21 15:42:03', '2023-03-23 18:15:55', '2023-03-23 18:15:55'),
(851, 'auth_token', '2ae96a0feaf7be6a1f74f4c6b52acc1ff293c353f286b23d345d2c1da3fec2e2', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-21 17:17:46', '2023-03-22 09:39:14', '2023-03-22 09:39:14'),
(852, 'auth_token', '4def524a93ff006ce0bb68aad82b9efa5ca86e4b16cb9ee2b7f78f2a30930a26', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-22 09:42:29', '2023-03-22 09:44:22', '2023-03-22 09:44:22'),
(853, 'auth_token', '715c95c73e443c4c63629da860fec7c613758c4a464719d65163b72ca0d9387a', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-23 18:16:46', '2023-03-23 18:16:53', '2023-03-23 18:16:53'),
(854, 'auth_token', '8dcf05d024b5ee1124c53f117278deb7cf7ccb1a32272883240470b782b7e3a0', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-23 18:22:59', '2023-03-24 11:55:52', '2023-03-24 11:55:52'),
(855, 'auth_token', 'ab02e617a08d30aea644fd385a29d6d4925f462e54c306bee7d84f8a0d1c68d8', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-25 10:03:47', '2023-03-25 10:03:56', '2023-03-25 10:03:56'),
(856, 'auth_token', '1866a59553e4c3351f9edcd45881c17905a30212dabe189077678c49072cf3ce', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-25 11:38:09', '2023-03-25 11:38:12', '2023-03-25 11:38:12'),
(857, 'auth_token', '3df4711b64207213f77ef15d9ea6c5520613b3323660de09da89398eb0f3ac85', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-25 11:38:54', '2023-03-25 11:39:46', '2023-03-25 11:39:46'),
(858, 'auth_token', '20520a175aa79be2ba1a5990e5ff6c7590c4a27d713dafd9ad83fe3ccc8ff2ba', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-25 11:41:23', '2023-03-25 11:43:04', '2023-03-25 11:43:04'),
(859, 'auth_token', '6b44feb287e8a502dbcb21a94579a586a3a1c3a8417196b86615bcb770344483', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-25 11:43:49', '2023-03-25 11:43:53', '2023-03-25 11:43:53'),
(860, 'auth_token', '26ec2f4dee0b3c885e4ebadb8d9a7af9915209b6a26928a129c1471ef0d68919', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-25 11:45:11', '2023-03-25 11:46:59', '2023-03-25 11:46:59'),
(861, 'auth_token', 'fa8f76bb14c995423a8b82c9f8112f88f8237530a57c2e922e9419bbd0ecb409', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-25 11:47:19', '2023-03-25 11:47:25', '2023-03-25 11:47:25'),
(862, 'auth_token', '76c74d1beb7149948ac9152d7b1d2e159c6e12dd547a72d1e4d7deb58e85354f', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-25 11:48:26', '2023-03-25 11:49:11', '2023-03-25 11:49:11'),
(863, 'auth_token', '8fcb97d183ab89ff444193a6a5cd08831b665934dde78e947fa78172ea9467df', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-25 11:49:44', '2023-03-25 11:51:15', '2023-03-25 11:51:15'),
(864, 'auth_token', '60777b8474d22ad78050b93f700a95e1847821025ad49def08f90de2e0854b17', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-25 11:52:42', '2023-03-25 11:52:46', '2023-03-25 11:52:46'),
(865, 'auth_token', '1a60c2399b9a49a3d013ba95842bd5f928c9a79ff9a52b8577b075430271cc9f', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-25 11:55:17', '2023-03-25 11:55:52', '2023-03-25 11:55:52'),
(866, 'auth_token', '2eeb80598423f73aa38061e2a874c96b6568959e208378ccc8ba07fef985702d', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-25 11:57:21', '2023-03-25 11:57:24', '2023-03-25 11:57:24'),
(867, 'auth_token', 'fe6bb570f95f34b23f983caf72f6269a81a9d685cec8830d6e0c74663cf8f7fb', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-25 12:02:43', '2023-03-27 12:37:50', '2023-03-27 12:37:50'),
(868, 'auth_token', '734afb7bdfaf298df76c49cebf5cd8f22ffb29050b1ccad40b0a67df938ab6c9', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-26 05:57:52', '2023-03-26 05:59:34', '2023-03-26 05:59:34'),
(869, 'auth_token', 'dd069c93a944bfce744c8a7773660ca6697305dea31f9de1d4bd5ee38e324e9e', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-26 06:00:17', '2023-03-26 06:00:33', '2023-03-26 06:00:33'),
(870, 'auth_token', '0a82ab333c98f9280bd2c8de189b8ff8c585ca7aef4f8a04211a6f78c540b548', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-26 06:08:33', '2023-03-26 06:09:36', '2023-03-26 06:09:36'),
(871, 'auth_token', '911d805b035dad210d9fa686b499cef7959142b6d0bfaf7a2fdaa4a3bef4b29c', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-26 06:13:29', '2023-03-26 06:14:00', '2023-03-26 06:14:00'),
(872, 'auth_token', 'b162a92db238e5d02108dfef94cdf8af79db0278f1c574cb3132545c02cc1d71', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-26 07:01:20', '2023-03-26 07:02:01', '2023-03-26 07:02:01'),
(873, 'auth_token', 'b6e8dc3bc5fafb3b89677a9e9014a0a72bfc2ca91b258dfef8c2aeadcff77692', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-26 20:09:50', '2023-03-26 20:17:33', '2023-03-26 20:17:33'),
(874, 'auth_token', 'c915c60551a30c643202c89bcc45790b17d468426ae3c35f314b63f99090d3a1', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-26 20:19:05', '2023-03-26 20:19:20', '2023-03-26 20:19:20'),
(875, 'auth_token', 'a542b2037236f92a88efc15081f6233c17da0e2044fd695997d67e7d3da61454', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-26 20:20:28', '2023-03-27 03:22:48', '2023-03-27 03:22:48'),
(876, 'auth_token', 'c98a11d00976a719f144d0e1071082196a8279c284b7755afb01b845ae4fd882', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-27 04:13:03', '2023-03-27 04:13:33', '2023-03-27 04:13:33'),
(877, 'auth_token', '31fd53086daaf9ed4b1160c69e1dca30746a7ac7fc2f02483487ad6ccec7ef35', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-27 04:36:00', '2023-03-27 04:44:49', '2023-03-27 04:44:49'),
(878, 'auth_token', '5ac00978099f8ce70942a260edf66f7a0dff07e2454a2bf304eea45a22b35a06', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-27 04:56:10', '2023-03-27 04:58:18', '2023-03-27 04:58:18'),
(879, 'auth_token', '7a6bad72b643493a36cfe4dd935b458f58e90dce23ac89a0e945780470aaa5b8', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-27 05:14:07', '2023-03-27 05:22:07', '2023-03-27 05:22:07'),
(880, 'auth_token', 'e2334a94af3c95833ac494d8510e26accfcc1cd8e8e50046607f0a3561d6f156', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-27 05:23:54', '2023-03-27 05:38:34', '2023-03-27 05:38:34'),
(881, 'auth_token', 'ab378140e63840f74febdb61f538deba55e348d13b4db6dc0a5c715529bb2cf5', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-27 05:38:48', '2023-03-27 05:58:23', '2023-03-27 05:58:23'),
(882, 'auth_token', 'ad0ed6d5fc751e36f93d9fca1d9c62dbaf486bd270b06de7b4518c48dcd9896c', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-27 05:59:08', '2023-03-27 05:59:20', '2023-03-27 05:59:20'),
(883, 'auth_token', 'f2d73015ef669a176a055d6d264e45202d18b336b5f1de9bc6e3dca403202570', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-27 06:36:14', '2023-03-27 06:36:28', '2023-03-27 06:36:28'),
(884, 'auth_token', '36afb568f4e27811927d87426d648b0d7c8e458c9e1a9f83d4f4dbf53c3e93bb', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-27 06:38:40', '2023-03-27 06:38:45', '2023-03-27 06:38:45'),
(885, 'auth_token', '356e8937fb34cde1eb19285952b2ae97ec84203bb807fd5def8eaec4ce4e6948', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-27 06:45:00', '2023-03-27 06:45:04', '2023-03-27 06:45:04'),
(886, 'auth_token', 'a34d525eb49b0ff3e06d026df524267fce21ff6e7167cd6f80cb4f3f8a555f40', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-27 06:48:00', '2023-03-27 06:49:20', '2023-03-27 06:49:20'),
(887, 'auth_token', 'ae107783b274d26adf588cc225b7e70151a747c282961ced95c7fcf6807cb987', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-27 06:52:05', '2023-03-27 06:52:47', '2023-03-27 06:52:47'),
(888, 'auth_token', '083f9d7b239a5dd9b8ac2ebd704043c2e35cb7de1a5612a36331a222778c6065', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-27 06:53:14', '2023-03-27 06:54:01', '2023-03-27 06:54:01'),
(889, 'auth_token', '91ad68590b33995cf2c994881b9ba43af2caaee20b9a77b043f618cd262fce13', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-27 06:54:13', '2023-03-28 06:40:18', '2023-03-28 06:40:18'),
(890, 'auth_token', '9dbfc52344e44e123d42009a53ed7403032a0f066871a5bfa68e4c7e0bee5b20', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-27 06:57:09', '2023-03-27 07:00:18', '2023-03-27 07:00:18'),
(891, 'auth_token', '10c7798c95fe929511e2c0227b00a4dbec9a27c6fba927d451a76529f8dd16b4', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-27 07:49:36', '2023-03-27 07:56:35', '2023-03-27 07:56:35'),
(892, 'auth_token', '3f18347eaf64bed9984efe8284a6c4e8b1a1c619e67423f5dc7782ec82f42daf', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-27 14:19:07', '2023-03-28 12:59:46', '2023-03-28 12:59:46'),
(893, 'auth_token', 'd85801569a81f63cdb0d125d7f8645ea89e52f0afe7ba83a3f14ce63d3ea8faa', 166, 'App\\Models\\User', '[\"*\"]', '2023-03-28 08:42:08', '2023-03-28 08:42:13', '2023-03-28 08:42:13'),
(894, 'auth_token', '9f066a7383ee844648f2c20161abdc84d07a7b29b6d4348574d59beb4dcb1387', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-28 12:59:50', '2023-03-28 13:01:33', '2023-03-28 13:01:33'),
(895, 'auth_token', 'b320ed479e6665010e7fefbb6159770330a0b2ca3ebd17d68d16bdcf64a4087f', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-28 15:04:28', '2023-03-28 15:05:20', '2023-03-28 15:05:20'),
(896, 'auth_token', '78651abf3984bd1a9c0ff39ee08bb3bae91f83721b00724ce1f1edcbb2adc0f9', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-28 15:06:02', '2023-03-28 15:06:12', '2023-03-28 15:06:12'),
(897, 'auth_token', '74dd6893a0f1ae38fb33d415f1f7a2831fb970c966280178cd94d49250e81c23', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-28 15:10:06', '2023-03-28 15:11:23', '2023-03-28 15:11:23'),
(898, 'auth_token', 'd0aa344370dfca7ec8eaf1e2df414ff95a2b28a221aab40c41ccc2e73753bc92', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-28 15:23:03', '2023-03-28 15:23:11', '2023-03-28 15:23:11'),
(899, 'auth_token', 'fa1cfe4734078bfe8980b490d676a843e7f6a59af8f57d60e2ff8786d55695d2', 167, 'App\\Models\\User', '[\"*\"]', '2023-03-28 15:23:24', '2023-03-28 15:23:26', '2023-03-28 15:23:26'),
(900, 'auth_token', '322957902a475332930a8a08e569a3b0015065b5eeb58982b922d70e3f6f9416', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-28 15:26:04', '2023-03-28 15:26:48', '2023-03-28 15:26:48'),
(901, 'auth_token', '7a4c1f4f7be9905d5ff54eb2fec89a070d1b9772695fcf0e0d2e6d54066c5ed1', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-28 15:27:17', '2023-03-28 15:28:02', '2023-03-28 15:28:02'),
(902, 'auth_token', '3c69af3699c01a8982f7c14e566e860677d5b1b8a56d41ac45793281b40b19fb', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-28 15:28:54', '2023-03-28 15:29:29', '2023-03-28 15:29:29'),
(903, 'auth_token', '4f96e5bbc78bc3a4322f85d7b70dcf3d2d3ef9a8d77ec160b24c322ea915e66e', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-28 15:31:53', '2023-03-28 15:31:53', NULL),
(904, 'auth_token', '75cee09852d4564f3a0811a0cb51ef07a7dd0874c00e87776e1c7352df555b82', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-28 15:33:33', '2023-03-28 15:35:20', '2023-03-28 15:35:20'),
(905, 'auth_token', 'ebb551da17d3ea94a7a7b32fb7f94209a6058cfc0e2627e5c2b3ca62eed5e3ac', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-28 15:35:58', '2023-03-28 15:36:23', '2023-03-28 15:36:23'),
(906, 'auth_token', '2d65bdcc455648a42917d52565eb9565c6fc4c1bba1d0172eea50bd71b51572f', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-28 16:06:07', '2023-03-28 16:07:05', '2023-03-28 16:07:05'),
(907, 'auth_token', 'ac912ff062d2d0bfa347a2c30671c883ca9d7af2ecb0125b95530f8cc69f2c7a', 166, 'App\\Models\\User', '[\"*\"]', '2023-03-29 08:08:38', '2023-03-29 08:08:38', NULL),
(908, 'auth_token', 'db134bab2bf5c56cd66d24ce3a1f17e6fb319ca6d3d3fdd805969bc12e52d18f', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-29 09:59:55', '2023-03-29 10:01:43', '2023-03-29 10:01:43'),
(909, 'auth_token', 'b068add3199c99f8b418c910b86ec87915d71824ab58fc3b9dcdaa49cf872f6b', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-29 10:02:35', '2023-03-29 10:03:51', '2023-03-29 10:03:51'),
(910, 'auth_token', '4b56609d0751d3e82f49e5c80b95d11945a0ebda764e9b5068e26dfe448ff0fe', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-29 10:26:01', '2023-03-29 10:27:07', '2023-03-29 10:27:07'),
(911, 'auth_token', 'baeb077e4f4321a742bce847220876ad5a9507e874d2ef5a91e7a71542108b17', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-29 11:22:04', '2023-03-29 11:22:04', NULL),
(912, 'auth_token', 'eb5c78b3e4ffe5d1e6ce84cdb01ede56333340070683283aef6debdd07230a9b', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-29 11:22:54', '2023-03-29 11:23:50', '2023-03-29 11:23:50'),
(913, 'auth_token', '96ada0be3941b18fcd0e768f334625e8f2e353fbd6b9b57b81e834121e994fb5', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-29 11:29:42', '2023-03-29 11:29:49', '2023-03-29 11:29:49'),
(914, 'auth_token', 'f94424421030dc6831d48734bfdc54f136e794554115d43d02f1152ca57f4389', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-29 11:30:20', '2023-03-29 11:30:25', '2023-03-29 11:30:25'),
(915, 'auth_token', '68bfaafb7673c326963aad0d78fb1b2851a4b4983e1a72eff8bfe0c22f0ff129', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-29 11:31:37', '2023-03-29 11:32:35', '2023-03-29 11:32:35'),
(916, 'auth_token', '80b3898d70c6065e17d5ddc29726db1a8a3b63a573f2b07055ad841feef77ee7', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-29 11:34:54', '2023-03-29 15:00:09', '2023-03-29 15:00:09'),
(917, 'auth_token', 'a85f8e69cf43dec56b4f1d81786baa277c4b79eeebd3e7bf56ea9873ab976f47', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-29 11:47:22', '2023-03-29 11:54:27', '2023-03-29 11:54:27'),
(918, 'auth_token', 'aaa564fde9496d2619ef049ba5096409786e111114a474187db0e8588856f812', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-29 12:14:39', '2023-03-29 12:18:56', '2023-03-29 12:18:56'),
(919, 'auth_token', '1c26a316115b1a83a1c6c0d2d16c8e0cce0277facd3e5e02e6b0c0ceef8408fb', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-29 12:29:09', '2023-03-29 12:29:44', '2023-03-29 12:29:44'),
(920, 'auth_token', 'b1a6967eaf4a8ba8eaf9c9cb13011516d51c4d8abc6a9f9bd5602d567fa2e4da', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-29 12:29:29', '2023-03-29 12:30:02', '2023-03-29 12:30:02'),
(921, 'auth_token', 'e443cf3317394000a9913c2f2f8770feee5728fd6fce588ff76f2c3518f77d1a', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-29 12:31:04', '2023-03-29 12:31:16', '2023-03-29 12:31:16'),
(922, 'auth_token', '0bd1ef0b5119923091c45610b02575d3db06fe4d673f94c806c82c896b494594', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-29 14:55:31', '2023-03-29 15:28:33', '2023-03-29 15:28:33'),
(923, 'auth_token', 'b1b254e3e8dede92426bbcc12ec0a7eec4d696869aa9ba928c24ca939d4d5c30', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-29 15:00:21', '2023-03-29 15:00:21', NULL),
(924, 'auth_token', '864f1ce34bd747034453f185480cb15b87fdd88b68409e7370b604dafcff134f', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-29 15:05:01', '2023-03-29 15:05:22', '2023-03-29 15:05:22'),
(925, 'auth_token', '99e61e35b0f5a9c2c570427d7c84e721c9b6941966bf0a80af205a7578f20284', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-29 15:06:16', '2023-03-29 15:10:33', '2023-03-29 15:10:33'),
(926, 'auth_token', 'e4a465a64f62e67a78f2ac04f08ec598fffe5d63c0681326fe66e6de1c800f81', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-29 15:11:19', '2023-03-29 15:13:13', '2023-03-29 15:13:13'),
(927, 'auth_token', '4cb6c5ef98339f67aa4fc633053af12259a027f3923784e4f403be5d0f1f15c6', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-29 15:13:27', '2023-03-29 15:16:36', '2023-03-29 15:16:36'),
(928, 'auth_token', 'c2ad9a072f28381327f4a52527f728c38a0d91d265572837a42aacfe371c8aba', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-29 15:18:29', '2023-03-29 15:19:31', '2023-03-29 15:19:31'),
(929, 'auth_token', '87260eb1ac7ffe410087940ed80efefc315965e076da11551c22cc82cb0449e1', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-29 15:22:21', '2023-03-29 15:22:25', '2023-03-29 15:22:25'),
(930, 'auth_token', 'c479d4fd9899c7596a947292ca9521ec5e4f4b4fc50603d1d133090f1e4de090', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-29 15:22:53', '2023-03-29 15:57:14', '2023-03-29 15:57:14'),
(931, 'auth_token', '8357e4411393c511b98627b2441990d33460611271d87c9c9706dcaf4feb8a24', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-29 15:25:32', '2023-03-29 15:25:43', '2023-03-29 15:25:43'),
(932, 'auth_token', '89b5c75beb99240dbd92ccf686155543750177bd8d0a64d0a3534f5b57053409', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-29 15:29:00', '2023-03-30 07:42:42', '2023-03-30 07:42:42'),
(933, 'auth_token', 'cf9e166df81d1a20c152baba36d9cd04b896f04740ab3c2634a777dc26955524', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-29 15:38:09', '2023-03-29 15:39:29', '2023-03-29 15:39:29'),
(934, 'auth_token', 'd6c76dd2d3ff56d531c428f51eb327b710340083bac85567a6f43625e1634870', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-29 15:57:36', '2023-03-29 15:59:54', '2023-03-29 15:59:54'),
(935, 'auth_token', '68b5d39428a6bde598d9e8e876f02a082c9903ee0164a9731d02f0a0b001bd96', 166, 'App\\Models\\User', '[\"*\"]', '2023-03-29 16:12:02', '2023-03-29 16:12:02', NULL),
(936, 'auth_token', 'e95dee42dafd471bb0423602b915f2cfd62af5f87d7cdf1fa30723ae793a1697', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-29 16:20:56', '2023-03-29 16:22:31', '2023-03-29 16:22:31'),
(937, 'auth_token', '043d45095c559c33eb1d85c51091b92802d9458bf68bccd9383f12c0e7bdfb24', 116, 'App\\Models\\User', '[\"*\"]', '2023-03-29 16:22:54', '2023-03-29 16:23:11', '2023-03-29 16:23:11'),
(938, 'auth_token', '2be476c380cfc88837d76eb3351b979c2f5e20e050b8dc4945882db60fbafb99', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-29 16:49:06', '2023-03-29 16:49:16', '2023-03-29 16:49:16'),
(939, 'auth_token', 'b772bc8ee08df1a04f3ca20f6313786ab3a8147d3ce805cca0118956ace13522', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-29 16:51:32', '2023-03-29 16:53:11', '2023-03-29 16:53:11'),
(940, 'auth_token', 'eec740dca39450f18412d085eb6cfd88c1deca430e19f7ccaf2912f7ef85c631', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-29 16:58:00', '2023-03-29 16:58:50', '2023-03-29 16:58:50'),
(941, 'auth_token', 'd7e5ca68a489127d0ec057901bce4a50a44d587537ae9e82ee3f619247b6b363', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-29 17:05:59', '2023-03-29 17:06:13', '2023-03-29 17:06:13'),
(942, 'auth_token', '0349d392ca43729e448fc7bd2ac09ef1cb88733b8d408629b0cf4fa26fb3e606', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-29 17:06:06', '2023-03-30 10:36:40', '2023-03-30 10:36:40'),
(943, 'auth_token', '66b1b4780b7717991b06eab2b4a3a1a57dbe2ae262b00e6780edf7c875ca3576', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-29 17:10:43', '2023-03-29 17:10:53', '2023-03-29 17:10:53'),
(944, 'auth_token', 'c271a07c922010974f7bd8ab16a74b91f5d70fbd84c0b707bcb5be6159f1e2f4', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-29 17:11:44', '2023-03-29 17:11:50', '2023-03-29 17:11:50'),
(945, 'auth_token', '37555782ebec90a2c56c30513183157589ee88c2b14c51735090a2c6e00a61f1', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-29 17:13:19', '2023-03-30 08:01:19', '2023-03-30 08:01:19'),
(946, 'auth_token', 'fa29b0e3f88874d13c3f8b13d854d5b111c890702611b2d03771b71f96f067dc', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-30 10:12:55', '2023-03-30 10:12:55', NULL),
(947, 'auth_token', '927dacae3bf2e1ca10b3bb68821aa57074c470b77f530008cf08ee089eec5681', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-30 10:15:27', '2023-03-30 10:15:27', NULL),
(948, 'auth_token', '630fd86c3573d1515795e4854b029d6cc23cac41cacad3539231f4ffe03ea3bf', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-30 10:16:36', '2023-03-30 10:17:29', '2023-03-30 10:17:29'),
(949, 'auth_token', 'c03779482071ea88aa5f1af951795a837105b6c5adbdcce592b41b6d032ed9d8', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-30 10:17:01', '2023-03-30 10:17:01', NULL),
(950, 'auth_token', '096dda5893fd609583d2c7571bbc1e9967723918891a1ff146244f68825e6063', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-30 10:36:59', '2023-03-30 10:38:27', '2023-03-30 10:38:27'),
(951, 'auth_token', '9785f937d3ff67d2e189ca5d9a049135e65c74add8054d6a0d9752abf877e5cf', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-30 10:41:18', '2023-03-30 10:43:00', '2023-03-30 10:43:00'),
(952, 'auth_token', '960975fff20609981b5967b8f07104dbe37fba4dc6f0aa59190e78885a23a302', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-30 10:43:47', '2023-03-30 10:49:20', '2023-03-30 10:49:20'),
(953, 'auth_token', '76fc917bc94fc1d0c9a931615d9d990de91feec69faf7cbaf6cea0ab8beb4c4f', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-30 10:55:09', '2023-03-30 10:55:46', '2023-03-30 10:55:46'),
(954, 'auth_token', 'd4b43f68be181b5f1bd50619ca1529f4b8b6b11bcce3177173b670c2f70e1d0a', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-30 10:58:06', '2023-03-30 10:58:45', '2023-03-30 10:58:45'),
(955, 'auth_token', '9ce9127208d4345f2811677b729837ffa77749870ecc5d831f212d5cb514fd49', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-30 11:11:59', '2023-03-30 11:12:16', '2023-03-30 11:12:16'),
(956, 'auth_token', 'fdfe6a19bbd6ad696f343bf9c0e1ef7cdb99cb796ece97b230c9624475dc09ed', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-30 11:19:57', '2023-03-31 16:28:32', '2023-03-31 16:28:32'),
(957, 'auth_token', 'd0a6f2c34c755450f3a898691b18c6a313289fdac4a90b15080a37438edd0172', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-30 12:47:35', '2023-03-30 12:48:21', '2023-03-30 12:48:21'),
(958, 'auth_token', '70c8b8f3c4d4566f09a6ee999be3e2fd66b5b62c514d434ba0cd37f5a32ab390', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-30 12:50:23', '2023-03-30 12:52:05', '2023-03-30 12:52:05'),
(959, 'auth_token', '7a39cc929f4401c96326badc420b3505523ecc2765b0c108706645dd38fd7256', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-30 12:52:42', '2023-03-30 12:54:20', '2023-03-30 12:54:20'),
(960, 'auth_token', '20857f933520d6f9a84388d42cc9df5a3b55440af14c5fef81ae8a7038a961a3', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-30 13:03:48', '2023-03-30 13:06:43', '2023-03-30 13:06:43'),
(961, 'auth_token', 'dea66d8a5f83a32c22e3da1bad8964cea9705369e81a5004e3da022d8e158f46', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-30 14:16:46', '2023-03-30 15:27:29', '2023-03-30 15:27:29'),
(962, 'auth_token', '6ba48013b5e7ee824a0e4fbe212c33de9e612a4dd77a0c241b6944dce28c5b18', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-30 15:28:28', '2023-03-30 15:29:23', '2023-03-30 15:29:23'),
(963, 'auth_token', 'cf67988a79d0f39be0dfce86307b7f4d699bd4cd0eee99bb38d4896cb358a57c', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-30 18:08:11', '2023-03-30 18:10:17', '2023-03-30 18:10:17'),
(964, 'auth_token', '879b9302ce096ca81350a1734e7b1aa7a3c19677c34cf2bde5d5221c98cae0ea', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-31 09:30:08', '2023-03-31 09:30:15', '2023-03-31 09:30:15'),
(965, 'auth_token', '4468a89a52576034ba1bba723baf6225f03a8db883bc66ca0de486a3b489f56b', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-31 11:10:36', '2023-03-31 11:11:52', '2023-03-31 11:11:52'),
(966, 'auth_token', '78d772a330daf9de5e444bbe40cda4d79841d5c6c90edc104673f879c4671400', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-31 13:14:36', '2023-03-31 13:16:30', '2023-03-31 13:16:30'),
(967, 'auth_token', 'f7c28b1909c739148f3019f7ee7b0554f1154adda3ca103a37f67e76603b0df5', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-31 13:17:44', '2023-03-31 13:18:55', '2023-03-31 13:18:55'),
(968, 'auth_token', '2e263c9fe14ee011bec75f76af0bdf68399ca353f030168a2c829428607c95f5', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-31 13:19:27', '2023-03-31 13:19:54', '2023-03-31 13:19:54'),
(969, 'auth_token', 'cf8637321bfdf0b9cd5e2feaf201573b67fae91096ad320c869b22d8323da285', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-31 13:20:41', '2023-03-31 13:20:43', '2023-03-31 13:20:43'),
(970, 'auth_token', 'e9b3c39951324d196ed6d9080642482b2d1e374c00b76ebda8bbaf7e769fc923', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-31 16:17:30', '2023-03-31 16:17:46', '2023-03-31 16:17:46'),
(971, 'auth_token', '1405124ecc5e796d57dff017e0f8737ec35ee8415222b820beed56db4768cd75', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-31 16:35:00', '2023-03-31 16:35:23', '2023-03-31 16:35:23'),
(972, 'auth_token', '4275d9d88b7642b1e510ec1f4067f493879e8d58a4b233f7605c60b88512516f', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-31 16:37:16', '2023-03-31 16:37:37', '2023-03-31 16:37:37'),
(973, 'auth_token', '4d85d2fca0e500e00bb997d5ccbc5cddd1d32d53c0bba89758990ec77fc72b6c', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-31 16:38:54', '2023-03-31 16:39:10', '2023-03-31 16:39:10'),
(974, 'auth_token', 'e4fa717a2e1997c020b2f2b31c73ea59cc37ac7d9165ca84ed8961fd26164594', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-31 16:43:52', '2023-03-31 16:44:18', '2023-03-31 16:44:18'),
(975, 'auth_token', '9cc6d7b319518dbbe2a28faf0ec41ab79dbf78f457800ca6cbf4aafe96d37e75', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-31 16:44:41', '2023-03-31 16:45:16', '2023-03-31 16:45:16'),
(976, 'auth_token', '0cdcbb6ef2a1521c944ba1ee6c86e8d8d92f3150cbfaae98488aad1ec2a08bfc', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-31 17:07:30', '2023-03-31 17:08:15', '2023-03-31 17:08:15'),
(977, 'auth_token', '66966662066ecbb66c51dfcd720c1a434627e02e8e54fae498aae1504aaf18f9', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-31 17:08:51', '2023-03-31 17:09:13', '2023-03-31 17:09:13'),
(978, 'auth_token', '8f9793badba45461fc30ff63b86d8d692a1274e137d63b2663b6d453473ca57e', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-31 17:11:56', '2023-03-31 17:12:29', '2023-03-31 17:12:29'),
(979, 'auth_token', 'c892940b89c2d7bd8ae11eb04e7c9dc245a19ab6ff253d38fde2704b179e30ec', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-31 17:14:09', '2023-03-31 17:14:42', '2023-03-31 17:14:42'),
(980, 'auth_token', 'b7286b1013b1239ad0b7479b8d9b04b221dc009f7add54746434fef75169c3ef', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-31 17:17:53', '2023-03-31 17:18:09', '2023-03-31 17:18:09'),
(981, 'auth_token', '4f84998858d266d4dfa1186060d40581359f0bc2c67743c9f772efc8912b8558', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-31 17:38:21', '2023-03-31 18:25:50', '2023-03-31 18:25:50'),
(982, 'auth_token', '7877bbaf3f7e9974775539d8c0c2ac8831560147cb9bd496b18737118b7278a0', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-31 18:26:53', '2023-03-31 18:27:32', '2023-03-31 18:27:32'),
(983, 'auth_token', 'bdcec07bb54b7849ddc58f28d95ec8f7437215327c06d125d77ced1c83e7a2ae', 122, 'App\\Models\\User', '[\"*\"]', '2023-03-31 18:44:07', '2023-03-31 18:45:52', '2023-03-31 18:45:52'),
(984, 'auth_token', 'ae5a01f5c080d9631f010d2400c9d95a1d781fc230c7e41d4f12fa3a7af418d4', 166, 'App\\Models\\User', '[\"*\"]', '2023-04-03 09:56:48', '2023-04-03 09:56:48', NULL),
(985, 'auth_token', 'cd2a43b470c5053ac0f9315e2155b6417c5cd3e15ef2e26abfea293b331822d3', 166, 'App\\Models\\User', '[\"*\"]', '2023-04-03 09:57:40', '2023-04-03 09:57:40', NULL),
(986, 'auth_token', '4c83e970f74ab16550886cf704761a3469edb529846698ed1b55243d16639fe3', 166, 'App\\Models\\User', '[\"*\"]', '2023-04-03 09:59:00', '2023-04-03 09:59:00', NULL),
(987, 'auth_token', '2bd8b4d2a8e1eb6fc9ab3857e70b9b6121decc6be4a6d52467f7e2bd27b0e98c', 166, 'App\\Models\\User', '[\"*\"]', '2023-04-03 10:01:45', '2023-04-03 10:01:45', NULL),
(988, 'auth_token', 'a43710b94b414efea93e4d6b90d0ed16fe59bc16b681bd32c48c9445ff156ac7', 166, 'App\\Models\\User', '[\"*\"]', '2023-04-03 10:04:33', '2023-04-03 10:04:34', '2023-04-03 10:04:34'),
(989, 'auth_token', '7c00289cfc4ecaa83b2ca40f67f6614998905361a132579cb9ab1d9263f5a254', 166, 'App\\Models\\User', '[\"*\"]', '2023-04-03 10:10:47', '2023-04-03 10:10:49', '2023-04-03 10:10:49'),
(990, 'auth_token', '773128c54d4df4fbf8157fbbf79d552135eba74d81c6c4a3f58e6cf1ed9c10e4', 166, 'App\\Models\\User', '[\"*\"]', '2023-04-03 10:12:53', '2023-04-03 10:12:54', '2023-04-03 10:12:54'),
(991, 'auth_token', 'a6e50cdad8a4f7941812e807a49253d2c4a455996e8944c03baa700b9fef4ced', 166, 'App\\Models\\User', '[\"*\"]', '2023-04-03 10:20:28', '2023-04-03 10:20:32', '2023-04-03 10:20:32'),
(992, 'auth_token', '7b9abd1697e0f77d42326e44d5f299a23b8f9d8a8bf3d4be2bad6ca927167708', 166, 'App\\Models\\User', '[\"*\"]', '2023-04-03 10:30:44', '2023-04-03 10:30:54', '2023-04-03 10:30:54'),
(993, 'auth_token', '004b57860e5fdb4529d472f55cf25f1e42818c1d47a8c11601c2eb00bd6cec2e', 166, 'App\\Models\\User', '[\"*\"]', '2023-04-03 10:32:19', '2023-04-03 10:32:24', '2023-04-03 10:32:24'),
(994, 'auth_token', '1a41a6a16ae38c648e4d21dad545ec5b8e3c08e0a25b4640b2b8baa94e0415ac', 166, 'App\\Models\\User', '[\"*\"]', '2023-04-03 10:38:00', '2023-04-03 10:38:05', '2023-04-03 10:38:05'),
(995, 'auth_token', '8526973743c991dc1be5844920f48f2c0e10ce42606116dab4996f55bc030ffb', 166, 'App\\Models\\User', '[\"*\"]', '2023-04-03 10:39:30', '2023-04-03 10:39:32', '2023-04-03 10:39:32'),
(996, 'auth_token', '3cf3b08bfed429ee7fb6595cc4d4c5fc4dd1bf876f4ec778ff649048cb22b9a9', 166, 'App\\Models\\User', '[\"*\"]', '2023-04-03 10:42:48', '2023-04-03 10:42:54', '2023-04-03 10:42:54'),
(997, 'auth_token', 'e5b221a1f8cbdb62577125324a8066828b63da119ededd2f56c611ece4cfb163', 166, 'App\\Models\\User', '[\"*\"]', '2023-04-03 10:52:22', '2023-04-03 10:52:39', '2023-04-03 10:52:39'),
(998, 'auth_token', 'f8f44e00f3cabd169602d58d9ca443b254433a797f56b094cefeb411118ffd30', 166, 'App\\Models\\User', '[\"*\"]', '2023-04-03 10:53:37', '2023-04-03 10:53:37', NULL),
(999, 'auth_token', '70d2765da444c6ce4801d985a773890e4fc0dd59cb30a16d3afb3a8da4f5b677', 166, 'App\\Models\\User', '[\"*\"]', '2023-04-03 10:53:56', '2023-04-03 10:53:56', NULL),
(1000, 'auth_token', '46d53f805302f98a5902503a0a633be607f79d3e0966bce1957256655dc02fb0', 166, 'App\\Models\\User', '[\"*\"]', '2023-04-03 10:56:55', '2023-04-03 10:57:07', '2023-04-03 10:57:07'),
(1001, 'auth_token', '8107f66f6e1ea6b1eac630e2afb2854d0ae6d7d2313f9cb687a3fa76501a0807', 166, 'App\\Models\\User', '[\"*\"]', '2023-04-03 10:58:29', '2023-04-03 10:58:29', NULL),
(1002, 'auth_token', 'f71af0ad141d21daeb8990870da30ab19ab55f6f3fd47c64a78219b54159cbe6', 166, 'App\\Models\\User', '[\"*\"]', '2023-04-03 11:01:14', '2023-04-03 11:01:14', NULL),
(1003, 'auth_token', '4f85e43cf50c37593b47b9db70148eb9e0ba922c903a56df1cfbef075c90d9a6', 166, 'App\\Models\\User', '[\"*\"]', '2023-04-03 11:29:07', '2023-04-03 11:29:39', '2023-04-03 11:29:39'),
(1004, 'auth_token', '1ddfb4bf88a0d5e4154dde7a81df9ecfb945c22ecbaafdbfbe747a37da52c7e8', 166, 'App\\Models\\User', '[\"*\"]', '2023-04-03 11:30:07', '2023-04-03 11:31:03', '2023-04-03 11:31:03'),
(1005, 'auth_token', 'f140ac170c5048d75a7bcbc353b7fed045d744725351d6b06f4c03854ca3e758', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-03 13:00:20', '2023-04-03 13:02:57', '2023-04-03 13:02:57'),
(1006, 'auth_token', 'c5baada94e62011e1d442b247905af197b870bb6c8148cd0ea44e6e79fa4236f', 166, 'App\\Models\\User', '[\"*\"]', '2023-04-03 13:11:02', '2023-04-03 13:11:21', '2023-04-03 13:11:21'),
(1007, 'auth_token', '5e2175aa81fbc89171b4ed0901cc6f371b8b5d20d91caf83fe68bb9656f1b448', 166, 'App\\Models\\User', '[\"*\"]', '2023-04-03 13:14:37', '2023-04-03 13:14:46', '2023-04-03 13:14:46'),
(1008, 'auth_token', '24ba20ccb4a1af2b0da7eda3bf22b944086141e65ee2f09f403e70dccde129e1', 166, 'App\\Models\\User', '[\"*\"]', '2023-04-03 13:15:04', '2023-04-03 13:15:13', '2023-04-03 13:15:13'),
(1009, 'auth_token', '957e2b86735f77679a5978a0320a84a43a6bb0e52cbf635ab60dd49b1f19cf45', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-03 13:15:29', '2023-04-03 13:16:41', '2023-04-03 13:16:41'),
(1010, 'auth_token', '76d241adc3d25480b8a306584f414488603ab4dcd35ac9d71d262f25f0b9c55a', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-03 13:23:38', '2023-04-04 09:07:02', '2023-04-04 09:07:02'),
(1011, 'auth_token', 'c388ac02365addc0cc2e7fd07567212c992ce6a0b839c58cbab3a90508eaf632', 166, 'App\\Models\\User', '[\"*\"]', '2023-04-03 13:27:13', '2023-04-03 13:27:19', '2023-04-03 13:27:19'),
(1012, 'auth_token', 'f24dc533703d849fdb7b325c8d40217785890748bfa641a386b365ee0ba4eae9', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-03 13:27:28', '2023-04-03 13:27:32', '2023-04-03 13:27:32'),
(1013, 'auth_token', '4e85c54d86422ee375fd99665768b4b361b899419e6d0bea7c111906771a8eab', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-03 13:29:09', '2023-04-03 13:29:18', '2023-04-03 13:29:18'),
(1014, 'auth_token', '9e097d8288292c13d5522f19673f462e0731f9f07fe576c1a18bbe52a3f3eb99', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-03 14:34:20', '2023-04-03 14:35:04', '2023-04-03 14:35:04'),
(1015, 'auth_token', 'f2a498ca020d64ce4daa7911ba81c55696700022b8e46570b668440695abc042', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-03 14:40:28', '2023-04-03 14:41:03', '2023-04-03 14:41:03'),
(1016, 'auth_token', '9e1ee35255841d5419df73cbe17b6012c44a235dc512062df00322af26b08106', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-03 15:23:15', '2023-04-03 15:23:50', '2023-04-03 15:23:50'),
(1017, 'auth_token', 'd2e4fa7df5705238707cb7ef376be949470e443906cd35e1e89f40e43ffd212b', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-03 15:29:39', '2023-04-03 15:29:48', '2023-04-03 15:29:48'),
(1018, 'auth_token', '511e841a4ba859ddcbbcd005a1dc80d3fa5dd1e9dd8ae42a1c2d9331c70b9606', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-03 15:33:18', '2023-04-03 15:33:25', '2023-04-03 15:33:25'),
(1019, 'auth_token', '4519f42386adcd3e18f7c4959de4f6e657a275b6bf0ab5c9559e2ec31931147f', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-03 15:34:24', '2023-04-03 15:34:41', '2023-04-03 15:34:41'),
(1020, 'auth_token', 'b288192d9994aeb0de3f0dcf050aac552069d607a3dbbc72159ea86963d88a1d', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-03 15:53:34', '2023-04-03 15:53:43', '2023-04-03 15:53:43'),
(1021, 'auth_token', 'ad5fbb68caecb8e5e3e7ca2184b41854f71c813ed4aef17e210d15ef52bc21d4', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-03 16:32:52', '2023-04-03 16:32:52', NULL),
(1022, 'auth_token', '3c44dbf2e267ce4b39e89806113da8a89f4108202b54ae8cdb3754e44205ca92', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-04 09:11:12', '2023-04-04 09:12:03', '2023-04-04 09:12:03'),
(1023, 'auth_token', 'fd25643b4c6d04da82631747a4281ba9d42d72560e467a92b644ffb5ef44eb1d', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-04 09:23:51', '2023-04-04 09:23:51', NULL),
(1024, 'auth_token', 'b7d8b63d115422ab836b46269a1f376d2106195524f58451a5619bc04a115094', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-04 09:24:30', '2023-04-04 09:24:53', '2023-04-04 09:24:53'),
(1025, 'auth_token', '18d625653d7103f40a2ebefbf1bf961159ab8392dc5543720a7c69232122ca30', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-04 09:27:12', '2023-04-04 09:27:16', '2023-04-04 09:27:16'),
(1026, 'auth_token', 'c1f3d62531a3b6d05cc2dfb5136222daf90d25abbdc823c1577b97c3f1ea2e8d', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-04 10:16:48', '2023-04-04 10:17:02', '2023-04-04 10:17:02'),
(1027, 'auth_token', '4e5f2134b5505be0f223b2d37b10499eec6bcba7aafa5551de012cda6ccfd925', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-04 10:17:41', '2023-04-04 10:17:48', '2023-04-04 10:17:48'),
(1028, 'auth_token', 'b18815641c68655623662533ff09860d68dab380566078b0f04fe2c73004b6ad', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-04 10:18:41', '2023-04-04 10:19:00', '2023-04-04 10:19:00'),
(1029, 'auth_token', '74b32b48b99a33be0c923865eb2c58a734e6f0de441fe768fe55af8e0e139177', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-04 10:33:36', '2023-04-04 10:35:01', '2023-04-04 10:35:01'),
(1030, 'auth_token', 'dff9fb5116e87e4e707c3bb7476e649078f931e2bf1dfa637481e88cc80009ab', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-04 11:23:01', '2023-04-04 11:23:04', '2023-04-04 11:23:04'),
(1031, 'auth_token', '6dc32f0978119dcbddd476003989412547edd2d7b6ce987e5dd97fd2bc8987a9', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-04 11:23:59', '2023-04-04 11:24:02', '2023-04-04 11:24:02'),
(1032, 'auth_token', 'c5ff523b8f26b05220db78c8ff7d99dd52e3445333b1ce313745ab2b67589e41', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-04 11:29:52', '2023-04-04 11:30:44', '2023-04-04 11:30:44'),
(1033, 'auth_token', '6eabb75e5cf61dae3cb05e81126b3903c37831550f94fdea67f2beae8958c43c', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-04 11:37:23', '2023-04-04 11:39:34', '2023-04-04 11:39:34'),
(1034, 'auth_token', '04eeb9deee104457aac79987eadfe2b5c9e112a96462ee1c2c792470aa1fffc6', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-04 11:48:31', '2023-04-04 11:48:33', '2023-04-04 11:48:33'),
(1035, 'auth_token', '957852a5eccd508411c48a709708a1337b8975ef062ec2002d6bcac674b3ee1c', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-04 12:31:39', '2023-04-04 12:32:08', '2023-04-04 12:32:08'),
(1036, 'auth_token', '5f2d96768a61052487bb9654df342b7e28511f2de8e67a5e980cd2f1a653d443', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-04 12:56:11', '2023-04-04 12:57:38', '2023-04-04 12:57:38'),
(1037, 'auth_token', '723d78c92c7ca32169834dd4009c62f984452c196adb2927293e18875f66741d', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-04 14:18:15', '2023-04-04 14:18:36', '2023-04-04 14:18:36'),
(1038, 'auth_token', '8059a42a666b15180768ae8f0baa401ede143abf7c60c55e9dc9065eabcc4835', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-04 14:39:27', '2023-04-04 14:40:04', '2023-04-04 14:40:04'),
(1039, 'auth_token', 'cc8961212827bbf1d0a456214cf7ddc47f309414bd08ae68e401872a6ccff55b', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-04 14:41:21', '2023-04-04 14:42:30', '2023-04-04 14:42:30'),
(1040, 'auth_token', '94fbfbea9550e3253ff32368f8cfda77e0f0f425484c9e0a1607e5fe8205440b', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-04 14:42:53', '2023-04-04 14:43:37', '2023-04-04 14:43:37'),
(1041, 'auth_token', '1b9640a4d2a58d43ad0a1587664e957bc30122ae43b27a57e509a71ff3ec0dae', 122, 'App\\Models\\User', '[\"*\"]', '2023-04-04 14:44:10', '2023-04-04 14:48:19', '2023-04-04 14:48:19'),
(1042, 'auth_token', 'a6171af4ea22feaa46a72f7757a2cb5507bd7788bae562dd568658d981ecc5f3', 116, 'App\\Models\\User', '[\"*\"]', '2023-04-04 15:28:12', '2023-04-04 15:28:21', '2023-04-04 15:28:21'),
(1043, 'auth_token', '43833861c38798497b7d6179e69c37b300cdd91676ca8881cce1c3e4d63abd1d', 167, 'App\\Models\\User', '[\"*\"]', '2023-04-26 05:50:14', '2023-04-26 05:50:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `productions`
--

CREATE TABLE `productions` (
  `id` int(11) NOT NULL,
  `order_number` varchar(255) DEFAULT NULL,
  `customer_order` int(11) DEFAULT NULL,
  `machine_order_number` varchar(255) DEFAULT NULL,
  `sales_orders_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `make` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `serial_number` varchar(255) DEFAULT NULL,
  `PDI_status` int(4) DEFAULT 0 COMMENT '1=>Approved,0=>Defected',
  `PDI_message` text DEFAULT NULL,
  `payment_confirm` int(4) DEFAULT 0 COMMENT '1=>Yes,0=>No',
  `purchased_sheet` int(4) DEFAULT 0 COMMENT '1=>Yes,0=>No',
  `steel_parts_due` date DEFAULT NULL,
  `parts_due` date DEFAULT NULL,
  `build_start_week` date DEFAULT NULL,
  `build_finish_week` date DEFAULT NULL,
  `build_shed` text DEFAULT NULL,
  `electrics_start_week` date DEFAULT NULL,
  `ready_for_dispatch` int(4) NOT NULL DEFAULT 0 COMMENT '1=>Yes,0=>No',
  `machine_dispatched` int(4) NOT NULL DEFAULT 0 COMMENT '1=>Yes,0=>No',
  `dispatched_week` date DEFAULT NULL,
  `dispatch_date` date DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `depot` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `dealer_id` int(11) NOT NULL,
  `stock_number` varchar(255) NOT NULL,
  `backorder_number` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `model` varchar(100) NOT NULL,
  `region` varchar(255) DEFAULT NULL,
  `year` varchar(100) NOT NULL,
  `hours` varchar(100) NOT NULL,
  `weight` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` float NOT NULL,
  `type` varchar(100) NOT NULL COMMENT 'New,Used,Trade,Hire',
  `attachment` varchar(255) DEFAULT NULL,
  `video_file` text DEFAULT NULL,
  `insurance` varchar(255) DEFAULT NULL,
  `ce_cert` varchar(555) DEFAULT NULL,
  `cert` varchar(255) DEFAULT NULL,
  `pdf_url` text DEFAULT NULL,
  `status` varchar(100) NOT NULL COMMENT 'Coming Soon, In Stock, Sold,On Hire',
  `upcoming_quantity` int(11) NOT NULL DEFAULT 0,
  `date` date DEFAULT NULL,
  `order_no` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `dealer_id`, `stock_number`, `backorder_number`, `title`, `model`, `region`, `year`, `hours`, `weight`, `description`, `price`, `type`, `attachment`, `video_file`, `insurance`, `ce_cert`, `cert`, `pdf_url`, `status`, `upcoming_quantity`, `date`, `order_no`, `created_at`, `updated_at`) VALUES
(1, 5, 2, '100900', '', 'mymodel', 'mymodel', 'reg', '2023', '2', '2', '<p>yy</p>', 200, 'Hire', 'Tesab__Backend_Wireframes.pdf', '2341_1682085145.mp4', 'Tesab__Backend_Wireframes.pdf', 'Tesab__Backend_Wireframes.pdf', NULL, 'products_1.pdf', 'Sold', 8, '2023-04-21', 1, '2023-04-21 08:22:25', '2023-05-11 01:43:59'),
(2, 2, 2, '1234567890', '', 'onhireproduct', 'onhireproduct', 'fgdh', '2023', '2', '2', '<p>gdgd</p>', 200, 'New/Hire', '', '1683619409.mp4', 'Screenpod__Backend_Wireframes.pdf', 'Screenpod__Backend_Wireframes.pdf', NULL, 'products_2.pdf', 'In Stock', 2, '2023-04-21', 2, '2023-04-21 08:26:20', '2023-05-09 04:15:21'),
(3, 3, 2, '1234567865432', '', 'fsdfsfs', 'fsdfsfs', 'dfg', '2023', '2', '33', '<p>dfddsf</p>', 200, 'New/Hire', '', '1682352893.mp4', 'Tesab__Backend_Wireframes.pdf', 'Tesab__Backend_Wireframes.pdf', NULL, NULL, 'In Stock', 3, '2023-04-21', 3, '2023-04-21 11:11:46', '2023-04-24 11:54:50'),
(4, 1, 1, '100900d', '', 'fsfsf', 'fsfsf', 'testr', '2023', '2', '5', '<p>sfs</p>', 200, 'New', '', '', '', '', NULL, NULL, 'In Stock', 2, '2023-04-24', 4, '2023-04-24 11:38:39', '2023-05-17 10:43:08'),
(5, 1, 1, '1234', '', 'rt123', 'rt123', 'dublin', '2023', '2', '1', '<p>vxvxvx</p>', 200, 'Hire', '', '', '', '', NULL, NULL, 'In Stock', 123, '2023-04-28', 5, '2023-04-28 00:15:52', '2023-04-28 00:15:52'),
(6, 1, 1, '34221111', '', 'tttt', 'tttt', 'dfg', '2023', '2', '2', '<p>grsg</p>', 200, 'Hire', '', '', '', '', NULL, 'products_6.pdf', 'Sold', 1, '2023-05-10', 6, '2023-05-10 00:32:01', '2023-05-19 00:20:13');

-- --------------------------------------------------------

--
-- Table structure for table `product_extra_info`
--

CREATE TABLE `product_extra_info` (
  `id` int(11) NOT NULL,
  `quote_id` varchar(111) NOT NULL DEFAULT '0',
  `sales_orders_id` int(55) NOT NULL DEFAULT 0,
  `product_id` varchar(111) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `depot` varchar(200) DEFAULT NULL,
  `hitch` varchar(200) DEFAULT NULL,
  `buckets` varchar(200) DEFAULT NULL,
  `extra` varchar(200) DEFAULT NULL,
  `loader` varchar(255) DEFAULT NULL,
  `warranty` varchar(255) DEFAULT NULL,
  `cabtype` varchar(255) DEFAULT NULL,
  `tyres` varchar(255) DEFAULT NULL,
  `accessories` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(3, 3, '6669_1682095307.jpg', '2023-04-21 11:11:48', '2023-04-21 11:11:48'),
(4, 1, '3291_1682346603.jpg', '2023-04-24 09:00:04', '2023-04-24 09:00:04'),
(5, 4, '1345_1682356119.jpg', '2023-04-24 11:38:40', '2023-04-24 11:38:40'),
(6, 5, '6404_1682660752.png', '2023-04-28 00:15:53', '2023-04-28 00:15:53'),
(7, 2, '6754_1683624915.jpg', '2023-05-09 04:05:16', '2023-05-09 04:05:16'),
(8, 2, '4984_1683624919.png', '2023-05-09 04:05:19', '2023-05-09 04:05:19'),
(9, 2, '4019_1683624919.jpg', '2023-05-09 04:05:20', '2023-05-09 04:05:20'),
(10, 2, '7322_1683624920.jpg', '2023-05-09 04:05:20', '2023-05-09 04:05:20'),
(11, 2, '3537_1683624920.jpg', '2023-05-09 04:05:20', '2023-05-09 04:05:20'),
(12, 2, '8485_1683625521.jpg', '2023-05-09 04:15:21', '2023-05-09 04:15:21'),
(14, 1, '4628_1683625813.jpg', '2023-05-09 04:20:14', '2023-05-09 04:20:14'),
(15, 1, '3344_1683625842.jpg', '2023-05-09 04:20:42', '2023-05-09 04:20:42'),
(16, 1, '3329_1683625843.jpg', '2023-05-09 04:20:43', '2023-05-09 04:20:43'),
(17, 6, '8743_1683698521.jpg', '2023-05-10 00:32:02', '2023-05-10 00:32:02');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `id` int(11) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `pdf_url` text NOT NULL,
  `currency` varchar(100) NOT NULL DEFAULT '€',
  `price` float NOT NULL,
  `is_read` int(4) NOT NULL DEFAULT 0,
  `date` date DEFAULT NULL,
  `created_time` varchar(255) DEFAULT NULL,
  `sent` int(4) NOT NULL DEFAULT 0,
  `sent_on` date DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL COMMENT 'New,Hire',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `lead_id`, `customer_id`, `attachment`, `pdf_url`, `currency`, `price`, `is_read`, `date`, `created_time`, `sent`, `sent_on`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, 'quote_1.pdf', '$', 9200, 1, '2023-04-28', NULL, 1, '2023-04-28', 'Sales', '2023-04-28 04:22:03', '2023-05-02 04:26:10'),
(2, 1, 3, NULL, 'quote_2.pdf', '$', 9000, 1, '2023-04-28', NULL, 1, '2023-04-28', 'Hire', '2023-04-28 04:23:25', '2023-04-28 07:51:34'),
(3, 2, 1, NULL, 'contracts_3.pdf', '$', 9000, 1, '2023-05-10', NULL, 1, '2023-05-10', 'Hire', '2023-05-10 01:44:19', '2023-05-10 08:50:23'),
(4, 3, 9, NULL, '', '€', 200, 1, '2023-05-16', NULL, 0, NULL, NULL, '2023-05-16 03:30:45', '2023-05-16 03:30:53'),
(5, 4, 11, NULL, '', '€', 20, 1, '2023-05-16', NULL, 0, NULL, 'Sales', '2023-05-16 03:35:37', '2023-05-16 03:35:42'),
(6, 5, 9, NULL, '', '€', 601, 1, '2023-05-16', NULL, 1, '2023-05-16', 'Hire', '2023-05-16 03:55:53', '2023-05-16 06:33:45'),
(7, 6, 9, NULL, '', '€', 400, 1, '2023-05-17', NULL, 0, NULL, 'Sales', '2023-05-17 09:53:06', '2023-05-17 10:43:24');

-- --------------------------------------------------------

--
-- Table structure for table `quote_products`
--

CREATE TABLE `quote_products` (
  `id` int(11) NOT NULL,
  `quote_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `machine_price` int(11) NOT NULL DEFAULT 0,
  `quantity` int(11) NOT NULL,
  `currency` varchar(100) NOT NULL DEFAULT '€',
  `total_price` float NOT NULL,
  `sent` int(4) NOT NULL DEFAULT 0,
  `sendprivew` int(4) NOT NULL DEFAULT 0,
  `status` varchar(100) DEFAULT NULL COMMENT 'Sales,Hire',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `quote_products`
--

INSERT INTO `quote_products` (`id`, `quote_id`, `product_id`, `price`, `machine_price`, `quantity`, `currency`, `total_price`, `sent`, `sendprivew`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 5000, 100, 1, '$', 5000, 1, 1, 'Sales', '2023-04-28 09:52:03', '2023-04-28 09:52:03'),
(2, 1, 4, 4000, 100, 1, '$', 4000, 1, 1, 'Sales', '2023-04-28 09:52:04', '2023-04-28 09:52:04'),
(3, 2, 4, 4000, 100, 2, '$', 4000, 0, 1, 'Hire', '2023-04-28 09:53:25', '2023-04-28 09:53:25'),
(4, 2, 1, 5000, 100, 1, '$', 5000, 0, 1, 'Hire', '2023-04-28 09:53:26', '2023-04-28 09:53:26'),
(5, 2, 2, 100, 100, 2, '€', 200, 0, 0, 'Hire', '2023-04-28 09:55:30', '2023-04-28 09:55:30'),
(6, 2, 3, 500, 500, 1, '€', 500, 0, 0, 'Hire', '2023-04-28 09:55:30', '2023-04-28 09:55:30'),
(7, 1, 4, 200, 0, 1, '€', 200, 0, 0, NULL, '2023-05-02 04:26:10', '2023-05-02 04:26:10'),
(8, 3, 6, 5000, 100, 2, '$', 5000, 0, 1, 'Hire', '2023-05-10 07:14:19', '2023-05-10 07:14:19'),
(9, 3, 5, 4000, 100, 1, '$', 4000, 0, 1, 'Hire', '2023-05-10 07:14:19', '2023-05-10 07:14:19'),
(10, 4, 5, 200, 200, 1, '€', 200, 0, 0, NULL, '2023-05-16 09:00:45', '2023-05-16 09:00:45'),
(11, 5, 5, 20, 20, 1, '€', 20, 0, 0, 'Sales', '2023-05-16 09:05:37', '2023-05-16 09:05:37'),
(12, 6, 3, 200, 200, 2, '€', 400, 0, 0, 'Hire', '2023-05-16 09:25:53', '2023-05-16 04:14:28'),
(13, 6, 6, 201, 0, 1, '€', 201, 1, 0, 'Hire', '2023-05-16 05:32:43', '2023-05-16 06:33:45'),
(14, 7, 6, 200, 200, 1, '€', 200, 1, 0, 'Sales', '2023-05-17 15:23:07', '2023-05-17 15:23:07'),
(15, 7, 4, 200, 0, 1, '€', 200, 0, 0, NULL, '2023-05-17 10:43:24', '2023-05-17 10:43:24');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `action_id` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `name_slug` varchar(100) NOT NULL,
  `url` varchar(200) NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `section_id`, `action_id`, `name`, `name_slug`, `url`, `order`, `created_at`, `updated_at`) VALUES
(1, 1, '1,2,3', 'Actions', 'actions', 'actions.index', 1, '2021-02-12 04:48:53', '2021-02-23 00:35:50'),
(2, 1, '1,2,3,4', 'Sections', 'sections', 'sections.index', 2, '2021-02-12 04:49:49', '2021-02-23 00:35:56'),
(3, 1, '1,2,3', 'Roles', 'roles', 'roles.index', 3, '2021-02-12 04:50:11', '2021-02-23 00:35:58'),
(4, 3, '1,3,8,9', 'Admin', 'sub_admin', 'sub_admin.index', 0, '2021-02-11 23:21:45', '2021-02-23 01:38:09'),
(7, 3, '1,2,3,4,8,9', 'Sales Reps', 'users', 'users.index', 0, '2021-02-22 23:55:06', '2021-03-04 23:04:25'),
(11, 9, '1,2,3', 'Categories', 'categories', 'categories.index', 1, '2021-03-04 00:11:31', '2021-03-04 00:57:36'),
(12, 9, '1,2,8,3', 'Brands', 'dealers', 'dealers.index', 2, '2021-03-04 00:14:22', '2021-03-04 00:14:22'),
(13, 9, '1,2,3,8,4', 'Equipment', 'products', 'products.index', 3, '2021-03-04 00:26:09', '2021-03-04 05:28:44'),
(14, 10, '1,2,3,4,8', 'Sales Calls', 'leads', 'leads.index', 2, '2021-03-05 00:45:34', '2021-03-05 01:44:04'),
(15, 10, '2,3,4,11', 'Sales Quotes', 'quotes', 'quotes.index', 4, '2021-03-05 05:18:31', '2021-08-02 11:40:48'),
(16, 12, '4', 'Sales Order', 'sales_order', 'sales_order.index', 1, '2021-03-06 06:49:31', '2021-08-04 14:55:49'),
(17, 11, '4', 'Sales Calls Report', 'sales_calls_report', 'sales_calls_report.index', 0, '2021-03-06 09:47:40', '2021-03-06 09:47:40'),
(18, 11, '4', 'Sales Order Report', 'reports', 'reports.complete_sales', 0, '2021-03-08 08:59:45', '2021-03-08 08:59:45'),
(20, 20, '1,2,3,8', 'Gallery', 'gallery', 'gallery.index', 0, '2021-03-09 10:40:47', '2021-03-09 10:40:47'),
(21, 20, '1,2,3,8', 'Team', 'team', 'team.index', 0, '2021-03-09 12:00:55', '2021-03-09 12:17:02'),
(22, 20, '1,2,3,8', 'News', 'news', 'news.index', 0, '2021-03-10 04:26:06', '2021-03-10 04:26:06'),
(23, 20, '4,3', 'Contacts', 'contacts', 'contacts.index', 0, '2021-03-16 05:49:55', '2021-03-16 05:49:55'),
(24, 20, '4', 'Services', 'services', 'services.index', 0, '2021-04-29 11:50:16', '2021-08-20 16:11:41'),
(25, 10, '1,2,3,6,8', 'Customers', 'customers', 'customers.index', 1, '2021-07-08 10:32:08', '2021-07-08 11:27:59'),
(27, 20, '4', 'Parts', 'parts', 'parts.index', 1, '2021-08-20 16:09:21', '2021-08-20 16:09:21'),
(29, 9, '2,3', 'Trade in', 'products', 'products.tradein', 6, '2022-12-05 06:43:38', '2022-12-05 06:43:38'),
(30, 333, '1,2,3,8,10', 'Stock', 'instock', 'instock.instock', 5, '2023-03-23 17:31:35', '2023-03-23 17:31:35'),
(32, 11, '', 'Quotes Report', 'quotes_report', 'quotes_report.quotereport', 0, '2023-03-24 17:01:34', '2023-03-24 17:01:34'),
(33, 20, '1,2,3,8', 'Hire Machines\r\n', 'hires', 'hires.index', 4, '2023-04-13 13:03:47', '2023-04-13 13:03:47'),
(34, 10, '1,2,3,4,8', 'Site Visits', 'site_visits', 'site_visits.index', 3, '2023-04-25 12:54:28', '2023-04-25 12:54:28'),
(35, 10, '2,3,4,11', 'Hire Quotes', 'hirequotes', 'hirequotes.index', 5, '2023-04-26 09:04:28', '2023-04-26 09:04:28'),
(36, 12, '4', 'Hire Order', 'hire_order', 'hire_order.index', 2, '2023-05-16 14:22:51', '2023-05-16 14:22:51'),
(37, 13, '4', 'Planning', 'production', 'production.index', 1, '2023-05-18 17:46:04', '2023-05-18 17:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `sales_orders`
--

CREATE TABLE `sales_orders` (
  `id` int(11) NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `machine_order_number` varchar(255) NOT NULL,
  `quote_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `price` float NOT NULL,
  `all_machine_price` float NOT NULL,
  `currency` varchar(100) NOT NULL DEFAULT '€',
  `qty` varchar(255) DEFAULT NULL,
  `tax` float NOT NULL,
  `total_price` float NOT NULL,
  `sub_total_price` float NOT NULL,
  `message` text DEFAULT NULL,
  `serial_number` varchar(255) DEFAULT NULL,
  `PDI_status` int(4) DEFAULT 0 COMMENT '1=>Approved,0=>Defected',
  `PDI_message` text DEFAULT NULL,
  `payment_confirm` int(4) NOT NULL DEFAULT 0 COMMENT '1=>Yes,0=>No',
  `delivered` int(4) NOT NULL DEFAULT 0,
  `delivery_date` date NOT NULL DEFAULT current_timestamp(),
  `is_read` int(4) NOT NULL DEFAULT 0,
  `sendprivew` int(4) NOT NULL DEFAULT 0,
  `pdf_url` text NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `machines_notes` varchar(255) NOT NULL,
  `machines_submit` text DEFAULT NULL,
  `delivery_arrangements` varchar(255) NOT NULL,
  `order_date` date DEFAULT NULL,
  `date` date DEFAULT NULL,
  `order_status` int(4) NOT NULL DEFAULT 1 COMMENT '1=>Ok,10=>Waitlist',
  `depot` varchar(255) DEFAULT NULL,
  `warranty` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) NOT NULL,
  `transport` varchar(255) DEFAULT NULL,
  `transport_price` float NOT NULL,
  `payment_terms` varchar(255) DEFAULT NULL,
  `delivery_price` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_orders`
--

INSERT INTO `sales_orders` (`id`, `order_number`, `machine_order_number`, `quote_id`, `user_id`, `customer_id`, `product_id`, `price`, `all_machine_price`, `currency`, `qty`, `tax`, `total_price`, `sub_total_price`, `message`, `serial_number`, `PDI_status`, `PDI_message`, `payment_confirm`, `delivered`, `delivery_date`, `is_read`, `sendprivew`, `pdf_url`, `notes`, `machines_notes`, `machines_submit`, `delivery_arrangements`, `order_date`, `date`, `order_status`, `depot`, `warranty`, `payment_type`, `transport`, `transport_price`, `payment_terms`, `delivery_price`, `created_at`, `updated_at`) VALUES
(1, '23_1', '23_1_1', 0, 1, 3, '5', 200, 233, '€', '1', 53.59, 286.59, 233, NULL, NULL, 0, NULL, 0, 0, '2023-05-17', 1, 0, '', NULL, 'fghgfh', '1', 'jgjg', NULL, '2023-05-17', 0, NULL, NULL, '', NULL, 0, NULL, 0, '2023-05-17 10:50:29', '2023-05-17 10:51:12'),
(2, '23_1', '23_1_2', 0, 1, 3, '2', 0, 233, '€', '1', 53.59, 286.59, 233, NULL, NULL, 1, NULL, 0, 0, '0000-00-00', 1, 0, '', NULL, 'klj', '1', '', NULL, '2023-05-17', 0, NULL, NULL, '', NULL, 0, NULL, 0, '2023-05-17 11:18:54', '2023-05-18 04:42:06');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `section_title` varchar(200) NOT NULL,
  `section_slug` varchar(200) NOT NULL,
  `section_order` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `section_title`, `section_slug`, `section_order`, `created_at`, `updated_at`) VALUES
(1, 'Modules', 'modules', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'User Management', 'user-management', 3, '2021-02-12 04:51:16', '2021-02-12 04:51:16'),
(9, 'Equipment Management', 'product-management', 4, '2021-03-04 05:40:48', '2021-03-04 05:40:48'),
(10, 'Lead Management', 'lead-management', 5, '2021-03-05 06:14:04', '2021-03-05 06:14:04'),
(11, 'Reports', 'reports', 8, '2023-03-24 16:39:55', '2023-03-24 16:39:55'),
(12, 'Sales Management', 'sales_management', 6, '2023-05-08 21:45:52', '2023-05-08 21:45:52'),
(13, 'Production Management', 'production_management', 7, '2023-05-18 23:12:48', '2023-05-18 23:12:48');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `make` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `request_type` varchar(100) NOT NULL COMMENT 'Service, Repair',
  `issue` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `email`, `address`, `make`, `model`, `serial_number`, `request_type`, `issue`, `created_at`, `updated_at`) VALUES
(1, 'Vikas Nagar', 'vikas@gmail.com', 'Sector 63, Noida', 'kjdnsj', 'description', '3r32r432', 'Service', 'This is test request, Pls ignore', '2021-08-20 15:56:00', '2021-08-20 15:56:00'),
(2, 'Vikas Nagar', 'vikas@gmail.com', 'Sector 63, Noida', 'dsfbdfbfdgb', 'shssh', 'sfghshsh', 'Service', 'shgfsghhsfhgfshshsfghgfsn n sfgnsfngsngfs ns nfs sf gfs nfsgn', '2021-08-20 16:38:13', '2021-08-20 16:38:13'),
(3, 'Vikas Nagar', 'vikas@gmail.com', 'Sector 63, Noida', 'dsfbdfbfdgb', 'shssh', 'sfghshsh', 'Service', 'shgfsghhsfhgfshshsfghgfsn n sfgnsfngsngfs ns nfs sf gfs nfsgn', '2021-08-20 16:38:28', '2021-08-20 16:38:28'),
(4, 'Vikas Nagar', 'vikas@gmail.com', 'Sector 63, Noida', 'dfbhgfngfnghngh', 'mhj,mhj,hj,', 'kj,kj,kj', 'Repair', 'kj,kj,kj,kj,', '2021-08-20 17:06:19', '2021-08-20 17:06:19'),
(5, 'Karl Hughes', 'karl@dmcconsultancy.com', 'Cuirt Nua, Court\r\nHollywoodrath', 'Kubota', 'K008-3', '123456', 'Service', 'TEST', '2021-10-28 17:29:36', '2021-10-28 17:29:36'),
(6, 'Karl Hughes', 'karl@dmcconsultancy.com', 'Cuirt Nua, Court\r\nHollywoodrath', 'Kubota', 'K008-3', 'TEST', 'Service', 'TEST', '2021-11-02 21:09:09', '2021-11-02 21:09:09'),
(7, 'Karl Hughes', 'karl@dmcconsultancy.com', 'Cuirt Nua, Court\r\nHollywoodrath', 'Kubota', 'K008-3', 'TEST', 'Service', 'TEST', '2021-11-02 21:17:14', '2021-11-02 21:17:14'),
(8, 'Karl Hughes', 'karl@dmcconsultancy.com', 'Cuirt Nua, Court\r\nHollywoodrath', 'Kubota', 'K008-3', 'TEST', 'Repair', 'TEST', '2021-11-08 19:12:57', '2021-11-08 19:12:57'),
(9, 'Test', 'test@gmail.com', '10 Housing Board Colony radhaganj ,Dewas', 'My Code not Working', 'My Code not Working', 'My Code not Working', 'Service', 'My Code not Working', '2021-11-08 20:08:37', '2021-11-08 20:08:37'),
(10, 'ajay', 'ajjukanojiya@152gmail.com', 'sukla hotal', 'cdfds', 's7', '2131', 'Service', 'dsdsa', '2021-11-08 21:28:13', '2021-11-08 21:28:13'),
(11, 'Test', 'test@gmail.com', '10 Housing Board Colony radhaganj ,Dewas', 'My Code not Working', 'My Code not Working', 'My Code not Working', 'Service', 'stripe/eception/invalidrequestexception amount must convert to at least 50 cents. ₹ converts to approximently € 0.06', '2021-11-09 12:17:29', '2021-11-09 12:17:29'),
(12, 'ajay', 'ajjukanojiya@152gmail.com', 'sukla hotal', 'cdfds', 's7', '2131', 'Service', 'xc', '2021-11-10 12:32:16', '2021-11-10 12:32:16'),
(13, 'ajay', 'ajjukanojiya@152gmail.com', 'sukla hotal', 'cdfds', 's6', '2131', 'Repair', 'cvvcvcv', '2021-11-10 12:34:21', '2021-11-10 12:34:21'),
(14, 'ajay', 'ajjukanojiya@152gmail.com', 'sukla hotal', 'cdfds', 's7', '2131', 'Repair', 'xcxzc', '2021-11-10 12:50:46', '2021-11-10 12:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `service_history`
--

CREATE TABLE `service_history` (
  `id` int(11) NOT NULL,
  `product_id` varchar(111) NOT NULL,
  `filters` varchar(200) DEFAULT NULL,
  `meshes` varchar(200) DEFAULT NULL,
  `options` varchar(200) DEFAULT NULL,
  `extras` varchar(200) DEFAULT NULL,
  `engine` varchar(255) DEFAULT NULL,
  `warranty` varchar(255) DEFAULT NULL,
  `engine_warranty` varchar(255) DEFAULT NULL,
  `tier` varchar(255) DEFAULT NULL,
  `machine_registration` varchar(255) DEFAULT NULL,
  `insurance` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `service_history`
--

INSERT INTO `service_history` (`id`, `product_id`, `filters`, `meshes`, `options`, `extras`, `engine`, `warranty`, `engine_warranty`, `tier`, `machine_registration`, `insurance`, `created_at`, `updated_at`) VALUES
(1, '1', 'filt', 'fdgd', 'gdfg', 'extr', 'gdd', 'gdgd', 'gh', 'hh', 'hhgg', 'insuup', '2023-04-24 15:57:09', '2023-04-24 15:57:09');

-- --------------------------------------------------------

--
-- Table structure for table `site_comments`
--

CREATE TABLE `site_comments` (
  `id` int(11) NOT NULL,
  `site_visits_id` int(11) NOT NULL,
  `comment_by` int(11) NOT NULL,
  `comment` text NOT NULL,
  `is_read` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_comments`
--

INSERT INTO `site_comments` (`id`, `site_visits_id`, `comment_by`, `comment`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'fggh', 1, '2023-04-25 11:54:35', '2023-04-25 11:54:35');

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
  `lead_source` text DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_visits`
--

INSERT INTO `site_visits` (`id`, `location`, `customer_id`, `user_id`, `date`, `telephone`, `phone`, `email`, `contact`, `lead_source`, `category`, `model`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'testeeee', 1, 122, NULL, '1234567890', '12345678909', 'lalit1@gmail.com', 'test', NULL, 'jaw', 'impact', 'test', '2023-04-25 08:02:41', '2023-04-26 05:19:36'),
(3, 'Dublin', 1, 116, '2023-04-26', '0851201708', NULL, 'hugheskarl@hotmail.com', 'Joe Bloggs', NULL, 'Airvac', 'AV52', 'Needs 5 by June', '2023-04-26 14:14:00', '2023-04-26 14:14:00'),
(4, 'Location', 3, 116, NULL, '0851201708', '+353 85 120 1708', 'karljordanhughes@gmail.com', 'Danielle', 'fb', 'Airvac', 'AV52', 'Danielle', '2023-04-26 14:32:12', '2023-04-26 16:19:35'),
(5, 'rrurur', 1, 122, NULL, '1234567890', '12345678909', 'lalit@gmail.com', '22345', 'fb', 'bd', 'ttt', 'fg', '2023-04-26 15:47:28', '2023-04-26 16:19:19'),
(6, 'Dublin', 2, 122, '2023-04-27', '1234567890', '1234567890', 'lttest@gmail.com', 'apitest', 'instagram', 'Jaw', 'impact', 'hellotest', '2023-04-28 05:05:29', '2023-04-28 05:05:29'),
(7, 'Kildare', 11, 116, NULL, '1234567890', '12345678909', 'testtt@gmail.com', '22345444444', 'instagram', 'teddd', '10570', 'fb', '2023-04-28 05:12:02', '2023-04-28 05:12:13'),
(8, 'Meath', 1, 116, '2023-05-09', '1234567890', '12345678909', 'lalitgraffersid21@gmail.com', '22345', 'instagram', 'xsds', '789', 'jg', '2023-05-09 00:41:46', '2023-05-09 00:41:46');

-- --------------------------------------------------------

--
-- Table structure for table `spec_additionals`
--

CREATE TABLE `spec_additionals` (
  `id` int(11) NOT NULL,
  `machine_order_number` varchar(111) DEFAULT NULL,
  `custom_paint` text DEFAULT NULL,
  `extra_vacuum_heads` text DEFAULT NULL,
  `extra_clamps` text DEFAULT NULL,
  `extra_standard_hose` text DEFAULT NULL,
  `heavy_duty` text DEFAULT NULL,
  `impeller` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `spec_additionals`
--

INSERT INTO `spec_additionals` (`id`, `machine_order_number`, `custom_paint`, `extra_vacuum_heads`, `extra_clamps`, `extra_standard_hose`, `heavy_duty`, `impeller`, `created_at`, `updated_at`) VALUES
(1, '23_1_1', NULL, '1', '2', '22', NULL, NULL, '2023-05-08 11:34:47', '2023-05-08 11:34:47'),
(2, '23_1_2', NULL, NULL, NULL, NULL, '3', NULL, '2023-05-08 13:13:55', '2023-05-08 13:13:55'),
(4, '23_3_1', '6', '2 weeks', 'TBC', '4 weeks', '£350+vat', '£550+vat', '2023-05-11 10:24:22', '2023-05-11 10:24:22');

-- --------------------------------------------------------

--
-- Table structure for table `spec_sheets`
--

CREATE TABLE `spec_sheets` (
  `id` int(11) NOT NULL,
  `machine_order_number` varchar(111) NOT NULL,
  `mandatory` text DEFAULT 'AV52 BASE MACHINE	',
  `optional_extras` text DEFAULT NULL,
  `additional_iteams` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `spec_sheets`
--

INSERT INTO `spec_sheets` (`id`, `machine_order_number`, `mandatory`, `optional_extras`, `additional_iteams`, `created_at`, `updated_at`) VALUES
(1, '23_1_1', 'AV52 BASE MACHINE', 'Vacuum Head/Heavy Duty Hose', '', '2023-05-08 11:52:36', '2023-05-08 11:52:36'),
(2, '23_1_2', 'AV52 BASE MACHINE', 'Standard Duty Hose', '', '2023-05-08 13:13:55', '2023-05-08 13:13:55'),
(5, '23_3_1', 'AV52 BASE MACHINE', 'Heavy Duty Hose/Vacuum Head/Spare Impeller/Standard Duty Hose/Clamps x 3', NULL, '2023-05-11 10:24:22', '2023-05-11 10:24:22');

-- --------------------------------------------------------

--
-- Table structure for table `statements`
--

CREATE TABLE `statements` (
  `id` int(11) NOT NULL,
  `signed` varchar(255) NOT NULL,
  `hire_orders_id` int(11) DEFAULT NULL,
  `print_name` varchar(255) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` text NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `designation`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Frank Smyth', 'Managing Director', NULL, '1628857701.jpeg', 1, '2021-08-13 16:58:21', '2021-08-13 16:58:21'),
(4, 'Ken Walsh', 'Sales', 'Phone - 087 787 8327\r\nEmail - ken@fjsplant.ie', '1628857781.jpeg', 1, '2021-08-13 16:59:41', '2021-08-13 16:59:41'),
(5, 'Keiran Delany', 'Sales', 'Phone - 087 168 7751\r\nEmail - keiran@fjsplant.ie', '1628857860.jpeg', 1, '2021-08-13 17:01:00', '2021-08-13 17:01:00');

-- --------------------------------------------------------

--
-- Table structure for table `trade_images`
--

CREATE TABLE `trade_images` (
  `id` int(11) NOT NULL,
  `trade_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trade_ins`
--

CREATE TABLE `trade_ins` (
  `id` int(11) NOT NULL,
  `quote_id` int(11) NOT NULL,
  `sales_orders_id` int(55) DEFAULT 0,
  `product_id` int(11) NOT NULL,
  `old_product_id` int(11) NOT NULL,
  `make` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `hours` varchar(255) NOT NULL,
  `price` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(200) DEFAULT NULL COMMENT 'admin,sub_admin,user',
  `account_type` varchar(100) DEFAULT NULL COMMENT 'Office,Service,Account',
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `status` varchar(111) NOT NULL DEFAULT '1',
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL,
  `device_id` varchar(255) DEFAULT NULL,
  `fcm_token` varchar(255) DEFAULT NULL,
  `is_deleted` varchar(111) DEFAULT NULL,
  `last_login` varchar(111) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `account_type`, `name`, `email`, `mobile`, `password`, `remember_token`, `status`, `lat`, `lng`, `device_id`, `fcm_token`, `is_deleted`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, 'admin', 'admin@gmail.com', NULL, '$2a$10$zqXt4g8pifRGXnkjrLrb0OrG7FOfjiYKaPXUahYeYpx0WIexOle.G', 'CmYn7SmHkig83E7yW28NH3Yr1eUFyvyI6C1VWeyNxr7CuW0vg41x1uYRCCNV', '1', NULL, NULL, 'iPhone12,1', 'cbdiu1bIjEdFktz_n2XVTD:APA91bFjcSleBw_5Vgt6w4LHMQH809424sBZu7Ujx396mck-2q-OgxG_mmCER5P5NautUurqv8R7oGmfeUSK7PnCUfYf22x-kjTzIGtrRL_Cn2cAwJytcXqpVAR-0emz0QakhedmxOeq', 'N', '2023-05-17 05:46:15', '2021-01-18 03:37:04', '2023-05-17 00:16:15'),
(116, 'user', NULL, 'Karl Hughes', 'karl@dmcconsultancy.com', '+353877187092', '$2y$10$OWR.lFTmMSu9dViOdSR/9.ZSibaxaAGtCELgDPm3WoiZes0Q8FrLa', NULL, '1', NULL, NULL, 'iPhone13,2', 'cG1uSAqJPUJtiob1gWtrsp:APA91bHfpkR-1d5Ptdtqighc9x3XxPClReUaz3x6JyfZ55W-r68tDbLMAOYT9dhGePqrLo4kA4gTW4pLIEMsRB5CDnsPfy85kNZIOGGXFVYuyDmo9ucMi5bUMBGmclEEilK-ssG5ytp0', NULL, '2023-04-04 15:28:12', '2021-07-12 13:44:02', '2023-04-04 15:28:12'),
(122, 'user', NULL, 'Danielle', 'danielle@dmcconsultancy.com', '0871323956', '$2y$10$fEwQ3noSVSshM0SAVayZDOubmabRQNi4LDz2H6UV3mj.oEGoc2506', NULL, '1', NULL, NULL, 'iPhone15,2', 'd2a_ya44aUBhsWncMdYBWZ:APA91bEjMMll7WIbfMBuexwCqwrBNuh8QAGr6JVRVxtvTIh6apWWNG2qTtwxTOdjknhX9qNFl_TnL4Vv_UeVQyoMh_gV3NsZYThFDyZJ2Os2tD-mSr1B_ujfeAGPkLwGiPP0UnbF5TZV', NULL, '2023-04-04 14:44:10', '2021-09-08 17:58:47', '2023-04-04 14:44:10'),
(163, 'sub_admin', 'Service', 'service@gmail.com', 'service@gmail.com', NULL, '$2y$10$18JmVtNmUEMMxcmuBXG7ZOpGDDPp/99PPErBguUufih7vX0avQjwK', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2022-12-16 08:45:52', '2022-12-05 14:52:39', '2022-12-16 15:45:52'),
(165, 'sub_admin', 'Sales', 'Salesadmin', 'sales@gmail.com', NULL, '$2y$10$ko2P/5onyY0Zf6NLEFk8zeJZxQ7t9qfDqF0dcYUuBUs2KduZ45rRK', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2022-12-16 09:26:22', '2022-12-06 13:48:08', '2022-12-16 16:26:22'),
(166, 'user', NULL, 'Niamh', 'niamh@dmcconsultancy.com', '0873930524', '$2y$10$PBF1WZ81RMNr8nXoXw8d2eMhuh1N.XZU5p7.v7OSmhP5QUhiVwaCu', NULL, '1', NULL, NULL, 'iPhone13,2', 'cG1uSAqJPUJtiob1gWtrsp:APA91bHfpkR-1d5Ptdtqighc9x3XxPClReUaz3x6JyfZ55W-r68tDbLMAOYT9dhGePqrLo4kA4gTW4pLIEMsRB5CDnsPfy85kNZIOGGXFVYuyDmo9ucMi5bUMBGmclEEilK-ssG5ytp0', NULL, '2023-04-03 13:27:13', '2023-01-31 13:34:59', '2023-04-03 13:27:13'),
(167, 'user', NULL, 'lalit', 'lalit212@gmail.com', '1234567890', '$2y$10$NT0hmGp03iIwwBGZ0DHhbOUzWc8XUAUcvwNGFW1O.5unOmj9Pkapy', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2023-04-26 05:50:14', '2023-04-26 05:49:58', '2023-04-26 05:50:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_permissions`
--
ALTER TABLE `admin_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealers`
--
ALTER TABLE `dealers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hires`
--
ALTER TABLE `hires`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hire_images`
--
ALTER TABLE `hire_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hire_info`
--
ALTER TABLE `hire_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hire_orders`
--
ALTER TABLE `hire_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `lead_comments`
--
ALTER TABLE `lead_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indexes for table `productions`
--
ALTER TABLE `productions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_extra_info`
--
ALTER TABLE `product_extra_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quote_products`
--
ALTER TABLE `quote_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_orders`
--
ALTER TABLE `sales_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_history`
--
ALTER TABLE `service_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_comments`
--
ALTER TABLE `site_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_visits`
--
ALTER TABLE `site_visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `spec_additionals`
--
ALTER TABLE `spec_additionals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spec_sheets`
--
ALTER TABLE `spec_sheets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statements`
--
ALTER TABLE `statements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trade_images`
--
ALTER TABLE `trade_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trade_ins`
--
ALTER TABLE `trade_ins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actions`
--
ALTER TABLE `actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `admin_permissions`
--
ALTER TABLE `admin_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `dealers`
--
ALTER TABLE `dealers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hires`
--
ALTER TABLE `hires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hire_images`
--
ALTER TABLE `hire_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hire_info`
--
ALTER TABLE `hire_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hire_orders`
--
ALTER TABLE `hire_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lead_comments`
--
ALTER TABLE `lead_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1044;

--
-- AUTO_INCREMENT for table `productions`
--
ALTER TABLE `productions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_extra_info`
--
ALTER TABLE `product_extra_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `quote_products`
--
ALTER TABLE `quote_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `sales_orders`
--
ALTER TABLE `sales_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `service_history`
--
ALTER TABLE `service_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `site_comments`
--
ALTER TABLE `site_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `site_visits`
--
ALTER TABLE `site_visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `spec_additionals`
--
ALTER TABLE `spec_additionals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `spec_sheets`
--
ALTER TABLE `spec_sheets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `statements`
--
ALTER TABLE `statements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `trade_images`
--
ALTER TABLE `trade_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trade_ins`
--
ALTER TABLE `trade_ins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
