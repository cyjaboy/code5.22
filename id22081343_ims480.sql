-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 22, 2024 at 02:37 PM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id22081343_ims480`
--

-- --------------------------------------------------------

--
-- Table structure for table `arrival`
--

CREATE TABLE `arrival` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `unit` int(11) NOT NULL,
  `unit price` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `des` varchar(100) NOT NULL,
  `unit` int(100) NOT NULL,
  `unitprice` int(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `arrived_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `des`, `unit`, `unitprice`, `created_at`, `arrived_at`) VALUES
(5, 'laptop', 'laptop', 0, 50000, '2024-04-29 08:22:52', '2024-04-29 08:22:52'),
(6, 'tape', 'packaging', 5, 500, '2024-05-02 03:44:26', '2024-05-02 03:44:26'),
(7, 'cellphone', 'oppo v15', 200, 4500, '2024-05-02 03:56:46', '2024-05-02 03:56:46'),
(8, 'electric fan ', 'stand fan', 200, 650, '2024-05-02 04:02:37', '2024-05-02 04:02:37'),
(9, 'electric fan 2', 'stand fan', 200, 650, '2024-05-02 04:03:31', '2024-05-02 04:03:31'),
(10, 'mouse', 'gaming mouse', 100, 200, '2024-05-02 00:00:00', '2024-05-10 00:00:00'),
(11, 'softbroom', 'for sanitation and maintenance', 500, 30, '2024-05-02 06:50:57', '2024-05-02 06:50:57'),
(12, 'sample', 'sample', 100, 100, '2024-05-12 23:21:13', '2024-05-12 23:21:13'),
(13, 'sample 3', '', 200, 300, '2024-05-13 00:25:44', '2024-05-13 00:25:44'),
(14, 'sample 4', 'pc', 100, 20, '2024-05-13 00:31:29', '2024-05-13 00:31:29'),
(15, 'sample 5', 'pcs', 200, 20, '2024-05-13 00:34:15', '2024-05-13 00:34:15'),
(16, 'sample 6', 'sample 6', 150, 20, '2024-05-13 00:42:39', '2024-05-13 00:42:39'),
(17, 'acer laptop', 'intel core i5', 100, 23500, '2024-05-21 04:26:02', '2024-05-21 04:26:02');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `des` varchar(100) NOT NULL,
  `um` varchar(25) NOT NULL,
  `unit` int(100) NOT NULL,
  `unitprice` int(100) NOT NULL,
  `ref` varchar(25) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `name`, `des`, `um`, `unit`, `unitprice`, `ref`, `created_at`) VALUES
(1, 'start', 'good', '', 45, 123, '', '2022-09-08 12:12:17'),
(2, 'demo1', 'aaaa', '', 15, 123, '', '2022-09-08 12:16:47'),
(3, 'Laptop', 'DepEd', '', 100, 43900, '', '2024-04-22 05:42:25'),
(4, 'epson printer', 'deped procured ', '', 2456, 389, '', '2024-04-23 02:42:56'),
(5, 'katy botes', 'deped procured ', '', 2147483647, 1, '', '2024-04-23 04:01:49'),
(6, 'sample 1', 'sample 1', '', 100, 2, '', '2024-04-23 04:07:33'),
(7, 'Printer', 'deped procured ', '', 25, 18600, '', '2024-04-23 08:03:20'),
(8, 'TV', 'LGU procured', '', 10, 15000, '', '2024-04-23 08:03:42'),
(9, 'T-shirt', 'LGU procured', '', 500, 300, '', '2024-04-23 08:04:00'),
(10, 'Asus laptop', 'ryzen 5', '', 12, 18000, '', '2024-04-23 08:09:36'),
(11, 'sample', 'sample', '', 45, 548, '', '2024-04-23 08:19:15'),
(12, 'asd', 'asd', '', 123, 123, '', '2024-04-23 08:21:53'),
(13, '3', '3', '', 3, 3, '', '2024-04-28 09:27:46'),
(14, 'bag', 'deped bag', '', 400, 389, '', '2024-04-28 10:42:43'),
(15, 'laptop', 'laptop', '', 200, 50000, '', '2024-04-29 08:22:52'),
(16, 'electric fan 2', 'stand fan', '', 200, 650, '', '2024-05-02 04:03:31'),
(17, 'mouse', 'gaming mouse', '', 200, 200, '', '2024-05-02 04:13:19'),
(18, 'softbroom', 'for sanitation and maintenance', '', 500, 30, '', '2024-05-02 06:50:57'),
(19, 'sample', 'sample', '', 100, 100, 'sample', '2024-05-12 23:21:13'),
(20, 'sample 3', '', '', 200, 300, 'STARBRIGHT', '2024-05-13 00:25:44'),
(21, 'sample 4', 'pc', '', 100, 20, 'STARBRIGHT', '2024-05-13 00:31:29'),
(22, 'sample 5', 'pcs', '', 200, 20, 'STARBRIGHT', '2024-05-13 00:34:15'),
(23, 'sample 6', 'sample 6', 'pcs', 150, 20, 'STARBRIGHT', '2024-05-13 00:42:39'),
(24, 'acer laptop', 'intel core i5', 'pc', 100, 23500, '123491', '2024-05-21 04:26:02');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sellunit` int(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `office` varchar(25) NOT NULL,
  `totalprice` int(100) NOT NULL,
  `productid` int(100) NOT NULL,
  `refr` varchar(25) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `name`, `sellunit`, `description`, `office`, `totalprice`, `productid`, `refr`, `created_at`) VALUES
(28, 'bag', 200, '', '', 77800, 4, '', '2024-04-28 11:21:56.396459'),
(29, 'bag', 150, '', '', 58350, 4, '', '2024-04-29 07:08:20.501031'),
(30, 'laptop', 100, 'release to cid', '', 5000000, 5, '', '2024-04-29 08:36:23.915752'),
(31, 'laptop', 50, '', '', 2500000, 5, '', '2024-04-29 13:50:45.130493'),
(32, 'laptop', 25, '', '', 1250000, 5, '', '2024-05-01 14:01:19.617560'),
(33, 'laptop', 10, 'release to asd', '', 500000, 5, '', '2024-05-02 03:46:17.257895'),
(34, 'laptop', 5, 'to cid', '', 250000, 5, '', '2024-05-02 06:49:18.036210'),
(35, 'laptop', 5, 'cash', '', 250000, 5, '', '2024-05-03 07:14:07.058226'),
(36, 'laptop', 5, 'release to admin office', '', 250000, 5, 'RIS No. 2023-03-089', '2024-05-12 23:28:36.474027');

-- --------------------------------------------------------

--
-- Table structure for table `stockcard`
--

CREATE TABLE `stockcard` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `scdes` varchar(25) NOT NULL,
  `um` varchar(25) NOT NULL,
  `date` date DEFAULT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `rq` int(11) DEFAULT NULL,
  `iq` int(11) DEFAULT NULL,
  `io` varchar(255) DEFAULT NULL,
  `balance` int(11) DEFAULT NULL,
  `number_of_days` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userlevel` int(100) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `userlevel`, `email`) VALUES
(6, 'cyrusview', '$2y$10$D887PgGvx/qCQ0UeDayTGecNGUKrFHU/DuWBnb.gPj2o/18Xrhk62', 1, 'cyrus.gallano6@gmail.com'),
(7, 'cyrusadd', '$2y$10$6r1DVHrtU9W0Ka1g7tFBeuJ4yLZHHDsKIAwuxdBTdmeG9GDxWH9ZW', 2, 'cyrus.gallano6@gmail.com'),
(8, 'cyrusadmin', '$2y$10$uy/1D9WZ7O2G2X2tWKoNX.BOk1aOix74Zbfu8gDV0gyJvcUbAwMZ2', 3, 'cyrus.gallano6@gmail.com'),
(9, 'hvaadmin', '$2y$10$S./m9c7.2WEI9G1xMOeMuudKrOldLwOk.d3onK.4pkHvslg5I1IJG', 3, 'hva@gmail.com'),
(10, 'hvaadmin', '$2y$10$ElHaL6j8s5N460f5NyUhI.AiYPpWjh7w8GbP2Bb/BPLx32wYZUwg2', 3, 'hva@gmail.com'),
(11, 'hvaview', '$2y$10$bxf74rh7nBuoEGeqss1YkOsXbkxLD2ysYQqDjJYEMh95wbOoBmvgG', 1, 'hva@gmail.com'),
(12, 'hvaadder', '$2y$10$/Jlnp9sstje2XQz6gQDGk.7QhtyPMkKqxlTviYa6tNiJK4NMelWS2', 2, 'hva@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arrival`
--
ALTER TABLE `arrival`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stockcard`
--
ALTER TABLE `stockcard`
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
-- AUTO_INCREMENT for table `arrival`
--
ALTER TABLE `arrival`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `stockcard`
--
ALTER TABLE `stockcard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
