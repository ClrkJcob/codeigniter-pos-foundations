-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2026 at 07:23 PM
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
-- Database: `pos_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `full_name`, `email`, `phone`, `created_at`) VALUES
(1, 'Juan Dela Cruz', 'juan@example.com', '09171234567', '2026-10-09 16:22:52'),
(2, 'Maria Santos', 'maria@example.com', '09181234567', '2026-10-09 16:22:52'),
(3, 'Carlos Reyes', 'carlos@example.com', '09191234567', '2026-10-09 16:22:52'),
(4, 'Angela Garcia', 'angela@example.com', '09201234567', '2026-10-09 16:22:52'),
(5, 'Mark Flores', 'mark@example.com', '09211234567', '2026-10-09 16:22:52'),
(6, 'Clark Jacob P. Llamoso', 'clarkllamoso@yahoo.com', 'optional', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `stock_quantity`, `image`, `created_at`) VALUES
(1, 'USB Keyboard', 650.00, 20, '1791564202_10f3e6748217fb22d16f.png', '2026-10-10 00:23:15'),
(2, 'Wireless Mouse', 450.00, 15, '1791564138_337bf04e711d2abd6023.png', '2026-10-10 00:23:15'),
(3, '27-inch Monitor', 8500.00, 8, '1791564073_f295335bcb24bf5687ea.png', '2026-10-10 00:23:15'),
(4, 'Laptop Stand', 300.00, 10, '1791563984_a140f84e738df29675b6.png', '2026-10-10 00:23:15'),
(5, 'USB-C Cable', 250.00, 30, '1791563971_c54aea88c658c7b244d5.png', '2026-10-10 00:23:15'),
(6, 'Mouse Pad', 350.00, 2, '1791563932_2495c5bf61ffc45d7b73.png', '2026-10-09 16:38:13');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `sold_by` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `product_id`, `customer_id`, `sold_by`, `quantity`, `total_price`, `created_at`) VALUES
(1, 6, 6, 1, 1, 350.00, '2026-10-09 16:51:37');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `task_date` date NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `status`, `task_date`, `created_at`) VALUES
(1, 'Review customer accounts', 'pending', '2026-10-09', '2026-10-09 23:54:13'),
(2, 'Check inventory levels', 'pending', '2026-10-09', '2026-10-09 23:54:13'),
(3, 'Prepare daily sales report', 'completed', '2026-10-09', '2026-10-09 23:54:13'),
(4, 'Follow up with supplier', 'pending', '2026-10-08', '2026-10-09 23:54:13'),
(5, 'Update product prices', 'completed', '2026-10-08', '2026-10-09 23:54:13'),
(6, 'Plan weekend promotion', 'pending', '2026-10-10', '2026-10-09 23:54:13'),
(7, 'Backup database', 'pending', '2026-10-10', '2026-10-09 23:54:13'),
(8, 'Review staff schedule', 'completed', '2026-10-10', '2026-10-09 23:54:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL DEFAULT 'demo@example.com',
  `created_at` datetime NOT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `full_name`, `email`, `created_at`, `avatar`) VALUES
(1, 'admin01', '$2y$10$Wq/JDzQNLvJd.A/0JPhz4uVk34jmyWPPv1GebU0UyQXilOTG5OO1q', 'Admin User', 'demo@example.com', '2026-10-09 16:22:53', NULL),
(2, 'cashier01', '$2y$10$Wq/JDzQNLvJd.A/0JPhz4uVk34jmyWPPv1GebU0UyQXilOTG5OO1q', 'Liza Cruz', 'demo@example.com', '2026-10-09 16:22:53', NULL),
(3, 'cashier02', '$2y$10$Wq/JDzQNLvJd.A/0JPhz4uVk34jmyWPPv1GebU0UyQXilOTG5OO1q', 'Pedro Santos', 'demo@example.com', '2026-10-09 16:22:53', NULL),
(4, 'manager01', '$2y$10$Wq/JDzQNLvJd.A/0JPhz4uVk34jmyWPPv1GebU0UyQXilOTG5OO1q', 'Ana Reyes', 'demo@example.com', '2026-10-09 16:22:53', NULL),
(5, 'staff01', '$2y$10$Wq/JDzQNLvJd.A/0JPhz4uVk34jmyWPPv1GebU0UyQXilOTG5OO1q', 'Kevin Garcia', 'demo@example.com', '2026-10-09 16:22:53', NULL),
(6, 'clark_llamoso24', '$2y$10$Wq/JDzQNLvJd.A/0JPhz4uVk34jmyWPPv1GebU0UyQXilOTG5OO1q', 'Clark Jacob P. Llamoso', 'demo@example.com', '0000-00-00 00:00:00', '1791545869_6fb04c66025f4679121d.png'),
(7, 'staff_test_2026', '$2y$10$TlK29SxO.AzlEL1IwzpqKOCJoFJcbxJdorKyKNxwmzCxU56qkrDgK', 'Test Staff', 'demo@example.com', '2026-10-09 17:02:27', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sales_product` (`product_id`),
  ADD KEY `fk_sales_customer` (`customer_id`),
  ADD KEY `fk_sales_user` (`sold_by`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
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
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `fk_sales_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_sales_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_sales_user` FOREIGN KEY (`sold_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
