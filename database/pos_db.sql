-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2026 at 06:10 PM
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
(6, 'clark_llamoso24', '$2y$10$Wq/JDzQNLvJd.A/0JPhz4uVk34jmyWPPv1GebU0UyQXilOTG5OO1q', 'Clark Jacob P. Llamoso', 'demo@example.com', '0000-00-00 00:00:00', '1791545869_6fb04c66025f4679121d.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
