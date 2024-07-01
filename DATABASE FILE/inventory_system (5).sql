-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2024 at 03:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `category_id` int(11) NOT NULL,
  `cat_name` varchar(255) DEFAULT NULL,
  `cat_description` varchar(255) DEFAULT NULL,
  `cat_encodedby` varchar(255) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`category_id`, `cat_name`, `cat_description`, `cat_encodedby`, `date_created`) VALUES
(9, 'New Arrival Dress', 'None', '', '2024-06-01 12:23:11'),
(10, 'New Arrival', 'None', '', '2024-06-01 12:23:28'),
(11, 'Plus Size', 'None', '', '2024-06-01 12:23:37'),
(12, 'Dresses', 'None', '', '2024-06-01 12:23:45'),
(13, 'Skirts', 'None', '', '2024-06-01 12:23:56'),
(14, 'Tops', 'None', '', '2024-06-01 12:24:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company`
--

CREATE TABLE `tbl_company` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_company`
--

INSERT INTO `tbl_company` (`company_id`, `company_name`, `description`, `date_created`) VALUES
(8, 'Totoy ', 'Pants', '2024-05-24 13:23:49'),
(9, 'DOONA', 'Dress, Pants', '2024-05-28 09:16:23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `invoice_id` int(11) NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `product` varchar(255) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `encoded_By` varchar(255) DEFAULT NULL,
  `total_amount` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `discount_price` varchar(255) DEFAULT NULL,
  `tendered` varchar(255) DEFAULT NULL,
  `change` varchar(255) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_itemrawmaterial`
--

CREATE TABLE `tbl_itemrawmaterial` (
  `itermrawmaterial_id` int(11) NOT NULL,
  `productset_id` int(11) DEFAULT NULL,
  `material_name` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `encoded_by` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_itemrawmaterial`
--

INSERT INTO `tbl_itemrawmaterial` (`itermrawmaterial_id`, `productset_id`, `material_name`, `amount`, `encoded_by`, `date_created`) VALUES
(1, 1, '4000', '3000', 'junil toledo', '2022-10-27 00:00:00'),
(2, 2, 'gold mantika', '500', 'junil toledo', '2022-10-27 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_marketplace`
--

CREATE TABLE `tbl_marketplace` (
  `id` int(11) NOT NULL,
  `apiUrl` varchar(255) NOT NULL,
  `apiKey` varchar(25) NOT NULL,
  `apiUsername` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `feed` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `item_code` varchar(255) DEFAULT NULL,
  `product_img` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `varient` varchar(255) DEFAULT NULL,
  `unit_value` varchar(255) DEFAULT NULL,
  `units_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `net_price` varchar(255) DEFAULT NULL,
  `production_cost` varchar(255) DEFAULT NULL,
  `markup_percent` varchar(255) DEFAULT NULL,
  `markup_price` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `discount_price` varchar(255) DEFAULT NULL,
  `sales_price` varchar(255) DEFAULT NULL,
  `reorder_level` varchar(255) DEFAULT NULL,
  `stock_quantity` int(11) DEFAULT NULL,
  `expired_date` varchar(255) DEFAULT NULL,
  `encoded_by` varchar(255) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `item_code`, `product_img`, `full_name`, `varient`, `unit_value`, `units_id`, `category_id`, `net_price`, `production_cost`, `markup_percent`, `markup_price`, `discount`, `discount_price`, `sales_price`, `reorder_level`, `stock_quantity`, `expired_date`, `encoded_by`, `date_created`) VALUES
(13, '', '', 'Ralph Ace Peñaflor', NULL, NULL, 10, 9, NULL, NULL, NULL, NULL, NULL, NULL, '123', NULL, 1, NULL, '', '2024-06-01 14:23:22'),
(15, '', '', 'Amanda Domdom', NULL, NULL, 4, 10, NULL, NULL, NULL, NULL, NULL, NULL, '680', NULL, 5, NULL, '', '2024-06-01 14:23:48'),
(16, '', '', 'Harlene', NULL, NULL, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, '123', NULL, 12, NULL, '', '2024-06-01 14:24:01'),
(18, '', '', 'Harlene', NULL, NULL, 12, 10, NULL, NULL, NULL, NULL, NULL, NULL, '680', NULL, 12, NULL, '', '2024-06-01 23:56:30'),
(20, '', '', 'Patrice Marico Cajigal', NULL, NULL, 14, 10, NULL, NULL, NULL, NULL, NULL, NULL, '850', NULL, 20, NULL, '', '2024-06-02 00:04:27'),
(21, '', '', 'Divine Trixy Seles', NULL, NULL, 11, 13, NULL, NULL, NULL, NULL, NULL, NULL, '123', NULL, 123, NULL, '', '2024-06-02 00:18:55'),
(23, '', '', 'Divine Trixy Seles', NULL, NULL, 14, 14, NULL, NULL, NULL, NULL, NULL, NULL, '680', NULL, 0, NULL, '', '2024-06-02 12:44:25'),
(24, '', '', 'Harlene', NULL, NULL, 13, 11, NULL, NULL, NULL, NULL, NULL, NULL, '123', NULL, 1, NULL, '', '2024-06-02 13:19:46'),
(25, '', 'C:\\fakepath\\catto.jpg', 'Catto', NULL, NULL, 12, 13, NULL, NULL, NULL, NULL, NULL, NULL, '12', NULL, 1, NULL, '', '2024-06-02 14:24:00'),
(26, '', 'C:\\fakepath\\catto.jpg', 'Catto', NULL, NULL, 10, 11, NULL, NULL, NULL, NULL, NULL, NULL, '12', NULL, 1, NULL, '', '2024-06-02 14:26:00'),
(27, '', 'C:\\fakepath\\catto.jpg', 'Harlene', NULL, NULL, 10, 14, NULL, NULL, NULL, NULL, NULL, NULL, '449', NULL, 1, NULL, '', '2024-06-02 14:28:09'),
(28, '', 'C:\\fakepath\\catto.jpg', 'Test', NULL, NULL, 5, 12, NULL, NULL, NULL, NULL, NULL, NULL, '123', NULL, 12, NULL, '', '2024-06-02 14:30:32'),
(29, '', 'catto.jpg', 'Test', NULL, NULL, 8, 12, NULL, NULL, NULL, NULL, NULL, NULL, '123', NULL, 12, NULL, '', '2024-06-02 14:32:28'),
(30, '', 'catto.jpg', 'Harlene', NULL, NULL, 7, 12, NULL, NULL, NULL, NULL, NULL, NULL, '123', NULL, 1, NULL, '', '2024-06-02 14:56:08'),
(32, '', 'catto.jpg', 'Patrice Marico Cajigal', NULL, NULL, 8, 12, NULL, NULL, NULL, NULL, NULL, NULL, '122', NULL, 1, NULL, '', '2024-06-02 15:05:49'),
(33, '', 'catto.jpg', 'test12345', NULL, NULL, 12, 12, NULL, NULL, NULL, NULL, NULL, NULL, '12', NULL, 1, NULL, '', '2024-06-02 15:06:26'),
(34, '', 'catto.jpg', 'AAAAA', NULL, NULL, 10, 12, NULL, NULL, NULL, NULL, NULL, NULL, '123', NULL, 12, NULL, '', '2024-06-02 15:07:56'),
(35, '', 'catto.jpg', 'TEST564', NULL, NULL, 8, 12, NULL, NULL, NULL, NULL, NULL, NULL, '12', NULL, 1, NULL, '', '2024-06-02 15:27:01'),
(36, '', 'catto.jpg', 'david', NULL, NULL, 10, 12, NULL, NULL, NULL, NULL, NULL, NULL, '123', NULL, 12, NULL, '', '2024-06-02 15:32:07'),
(37, '', 'catto.jpg', 'CATTO', NULL, NULL, 8, 12, NULL, NULL, NULL, NULL, NULL, NULL, '850', NULL, 23, NULL, '', '2024-06-02 15:35:22'),
(46, NULL, '665c2f0fe07085.82693666.jpg', 'why isnt id displaying', NULL, NULL, 10, 12, NULL, NULL, NULL, NULL, NULL, NULL, '123', NULL, 12, NULL, NULL, '2024-06-02 16:36:31'),
(47, NULL, '665c9aac154c60.57523620.jpg', 'Harlene', NULL, NULL, 8, 14, NULL, NULL, NULL, NULL, NULL, NULL, '123', NULL, 12, NULL, NULL, '2024-06-03 00:15:40'),
(48, NULL, '665c9af0bdc3c3.36857203.jpg', 'Harlene', NULL, NULL, 10, 12, NULL, NULL, NULL, NULL, NULL, NULL, '123', NULL, 5, NULL, NULL, '2024-06-03 00:16:48'),
(50, NULL, '665d500dd90c33.87356370.jpg', 'Harlene', NULL, NULL, 8, 9, NULL, NULL, NULL, NULL, NULL, NULL, '680', NULL, 1, NULL, NULL, '2024-06-03 13:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productset`
--

CREATE TABLE `tbl_productset` (
  `productset_id` int(11) NOT NULL,
  `set_code` varchar(255) DEFAULT NULL,
  `set_name` varchar(255) DEFAULT NULL,
  `total_amount` varchar(255) DEFAULT NULL,
  `set_onhand` varchar(255) DEFAULT NULL,
  `encoded_by` varchar(255) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_productset`
--

INSERT INTO `tbl_productset` (`productset_id`, `set_code`, `set_name`, `total_amount`, `set_onhand`, `encoded_by`, `date_created`) VALUES
(1, '000541', 'mang tomas', '400', 'set on hand', 'junil toledo', '2022-10-27 00:00:00'),
(2, '000322', 'mantika', '600', '1 big bottle', 'junil toledo', '2022-10-27 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales`
--

CREATE TABLE `tbl_sales` (
  `sales_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sale_quantity` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `recorded_by` varchar(255) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_units`
--

CREATE TABLE `tbl_units` (
  `units_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `encoded_by` varchar(255) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_units`
--

INSERT INTO `tbl_units` (`units_id`, `name`, `description`, `encoded_by`, `date_created`) VALUES
(5, 'White', '', '', '2024-05-28 08:52:43'),
(7, 'Old Rose', '', NULL, '2024-05-28 08:58:14'),
(8, 'Cream Grey', NULL, NULL, '2024-05-28 09:01:17'),
(10, 'Apple Green', NULL, NULL, '2024-05-28 10:38:36'),
(11, 'Choco ', NULL, NULL, '2024-05-28 10:38:51'),
(12, 'Mustard', NULL, NULL, '2024-05-28 10:38:56'),
(13, 'Khaki Nude', NULL, NULL, '2024-05-28 10:39:02'),
(14, 'Navy Blue', NULL, NULL, '2024-05-28 10:39:09'),
(15, 'Blue Violet', NULL, NULL, '2024-05-28 10:39:15'),
(16, 'Pink', NULL, NULL, '2024-05-28 10:39:23'),
(17, 'Brown', NULL, NULL, '2024-05-28 10:39:28'),
(18, 'Peach', NULL, NULL, '2024-05-28 10:39:36'),
(19, 'Sage Green', NULL, NULL, '2024-05-28 10:39:41'),
(20, 'Purple', NULL, NULL, '2024-05-28 10:39:52'),
(21, 'Tangerine', NULL, NULL, '2024-05-28 10:39:58'),
(22, 'Nude', NULL, NULL, '2024-05-28 10:40:09'),
(23, 'Rust', NULL, NULL, '2024-05-28 10:40:14'),
(24, 'Yellow', NULL, NULL, '2024-05-28 10:40:27'),
(25, 'Blue Pink', NULL, NULL, '2024-05-28 10:40:44'),
(26, 'Emerald Green', NULL, NULL, '2024-05-28 10:40:52'),
(27, 'Maroon', NULL, NULL, '2024-05-28 10:40:59'),
(28, 'Black Pink', NULL, NULL, '2024-05-28 10:41:17'),
(29, 'Teal Green', NULL, NULL, '2024-05-28 10:41:25'),
(30, 'Army Green', NULL, NULL, '2024-05-28 10:41:31'),
(31, 'Nude Pink', NULL, NULL, '2024-05-28 10:41:42'),
(32, 'White Pink', NULL, NULL, '2024-05-28 10:41:52'),
(33, 'Blue', NULL, NULL, '2024-05-28 10:42:04'),
(34, 'Cream', NULL, NULL, '2024-05-28 10:42:16'),
(35, 'D&G PRINT 8', NULL, NULL, '2024-05-28 10:42:27'),
(36, 'D&G PRINT 7', NULL, NULL, '2024-05-28 10:42:48'),
(37, 'D&G PRINT 6', NULL, NULL, '2024-05-28 10:43:04'),
(38, 'D&G PRINT 5', NULL, NULL, '2024-05-28 10:43:14'),
(39, 'D&G PRINT 10', NULL, NULL, '2024-05-28 10:43:21'),
(40, 'D&G PRINT 9', NULL, NULL, '2024-05-28 10:43:28'),
(41, 'D&G PRINT 4', NULL, NULL, '2024-05-28 10:43:37'),
(42, 'D&G PRINT 3', NULL, NULL, '2024-05-28 10:43:45'),
(43, 'D&G PRINT 2', NULL, NULL, '2024-05-28 10:43:53'),
(44, 'D&G PRINT 1', NULL, NULL, '2024-05-28 10:43:59'),
(45, 'Printed', NULL, NULL, '2024-05-28 10:44:17'),
(46, 'Vintage', NULL, NULL, '2024-05-28 10:44:23'),
(47, 'Red', NULL, NULL, '2024-05-28 10:44:37'),
(48, 'Maroon Pink', NULL, NULL, '2024-05-28 10:44:52'),
(49, 'Red Yellow', NULL, NULL, '2024-05-28 10:45:04'),
(50, 'Red Printed', NULL, NULL, '2024-05-28 10:45:18'),
(51, 'Teal Pink', NULL, NULL, '2024-05-28 10:45:34'),
(52, 'Yellow Pink', NULL, NULL, '2024-05-28 10:45:59'),
(53, 'Caramel', NULL, NULL, '2024-05-28 10:46:26'),
(54, 'Mauve', NULL, NULL, '2024-05-28 10:46:45'),
(55, 'Tangerine', NULL, NULL, '2024-05-28 10:46:55'),
(56, 'Khaki', NULL, NULL, '2024-05-28 10:47:04'),
(57, 'Mocha', NULL, NULL, '2024-05-28 10:47:11'),
(58, 'Navy', NULL, NULL, '2024-05-28 10:47:19'),
(59, 'Pusha Pink', NULL, NULL, '2024-05-28 10:47:26'),
(60, 'Royal Blue', NULL, NULL, '2024-05-28 10:47:36'),
(61, 'Olive Green', NULL, NULL, '2024-05-28 10:47:44'),
(63, 'Pink Red', NULL, NULL, '2024-05-28 10:48:08'),
(64, 'Printed Brown', NULL, NULL, '2024-05-28 10:48:25'),
(65, 'Printed White', NULL, NULL, '2024-05-28 10:48:34'),
(66, 'Printed Black', NULL, NULL, '2024-05-28 10:48:47'),
(67, 'Olive', NULL, NULL, '2024-05-28 10:56:46'),
(68, 'Lavender', NULL, NULL, '2024-05-28 10:57:32'),
(69, 'D&G1', NULL, NULL, '2024-05-28 10:58:23'),
(70, 'D&G2', NULL, NULL, '2024-05-28 10:58:28'),
(72, 'D&G4', NULL, NULL, '2024-05-28 10:58:37'),
(73, 'D&G5', NULL, NULL, '2024-05-28 10:58:42'),
(74, 'D&G6', NULL, NULL, '2024-05-28 10:58:47'),
(75, 'D&G7', NULL, NULL, '2024-05-28 10:58:59'),
(76, 'D&G8', NULL, NULL, '2024-05-28 10:59:04'),
(77, 'D&G9', NULL, NULL, '2024-05-28 10:59:08'),
(78, 'D&G10', NULL, NULL, '2024-05-28 10:59:13'),
(79, 'D&G11', NULL, NULL, '2024-05-28 10:59:18'),
(80, 'D&G12', NULL, NULL, '2024-05-28 10:59:23'),
(81, 'D&G13', NULL, NULL, '2024-05-28 10:59:28'),
(82, 'D&G14', NULL, NULL, '2024-05-28 10:59:33'),
(83, 'D&G15', NULL, NULL, '2024-05-28 10:59:38'),
(84, 'Black', NULL, NULL, '2024-05-29 00:07:38'),
(85, 'Black Green', NULL, NULL, '2024-05-29 00:18:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `f_name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `usertype` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `f_name`, `username`, `password`, `usertype`, `contact`, `address`) VALUES
(3, 'Harlene', 'haruwin', '$2y$10$AZcFqcFXwY3YIoxSLpY0wOyRM2C1A6CQxKSoAaAlLIKVp/bF68YZW', 'Admin', '09654756891', 'Tondo, Manila'),
(4, 'Patrice Marico Cajigal', 'pat', '$2y$10$usIB1TmP3nB9vsZ2eoSbIux8rlvJfW71ZbvTQ9ECQ5wUJBlY08CFK', 'Guest', '09619651875', 'Manila');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_company`
--
ALTER TABLE `tbl_company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `tbl_itemrawmaterial`
--
ALTER TABLE `tbl_itemrawmaterial`
  ADD PRIMARY KEY (`itermrawmaterial_id`);

--
-- Indexes for table `tbl_marketplace`
--
ALTER TABLE `tbl_marketplace`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_productset`
--
ALTER TABLE `tbl_productset`
  ADD PRIMARY KEY (`productset_id`);

--
-- Indexes for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `tbl_units`
--
ALTER TABLE `tbl_units`
  ADD PRIMARY KEY (`units_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_company`
--
ALTER TABLE `tbl_company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_itemrawmaterial`
--
ALTER TABLE `tbl_itemrawmaterial`
  MODIFY `itermrawmaterial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_marketplace`
--
ALTER TABLE `tbl_marketplace`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tbl_productset`
--
ALTER TABLE `tbl_productset`
  MODIFY `productset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_units`
--
ALTER TABLE `tbl_units`
  MODIFY `units_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
