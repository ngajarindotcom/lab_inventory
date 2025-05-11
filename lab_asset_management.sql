-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2025 at 05:19 PM
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
-- Database: `lab_asset_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(2, 'Modal', '', '2025-05-11 20:49:53', '2025-05-11 20:49:53'),
(3, 'Tidak Modal', '', '2025-05-11 20:50:00', '2025-05-11 20:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `item_type_id` int(11) NOT NULL,
  `power_type_id` int(11) DEFAULT NULL,
  `item_kind_id` int(11) DEFAULT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `specification` text DEFAULT NULL,
  `unit_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `note` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `code`, `name`, `category_id`, `item_type_id`, `power_type_id`, `item_kind_id`, `brand`, `specification`, `unit_id`, `stock`, `note`, `created_at`, `updated_at`) VALUES
(1, 'BRG-644587', 'Gelas Ukur', 2, 1, 2, 3, 'Cosmos', '5 Liter', 1, 7, 'lokasi di lemari A1', '2025-05-11 20:55:25', '2025-05-11 22:12:21');

-- --------------------------------------------------------

--
-- Table structure for table `item_in`
--

CREATE TABLE `item_in` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` date NOT NULL,
  `note` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_in`
--

INSERT INTO `item_in` (`id`, `item_id`, `quantity`, `date`, `note`, `created_by`, `created_at`, `updated_at`) VALUES
(2, 1, 3, '2025-05-11', 'pembelian gelas ukur', 1, '2025-05-11 21:27:13', '2025-05-11 21:27:13');

-- --------------------------------------------------------

--
-- Table structure for table `item_kinds`
--

CREATE TABLE `item_kinds` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_kinds`
--

INSERT INTO `item_kinds` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Chemical', '', '2025-05-11 20:52:15', '2025-05-11 20:52:15'),
(2, 'Besi', '', '2025-05-11 20:52:31', '2025-05-11 20:52:31'),
(3, 'Plastik', '', '2025-05-11 20:52:37', '2025-05-11 20:52:37');

-- --------------------------------------------------------

--
-- Table structure for table `item_out`
--

CREATE TABLE `item_out` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` date NOT NULL,
  `recipient` varchar(100) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_out`
--

INSERT INTO `item_out` (`id`, `item_id`, `quantity`, `date`, `recipient`, `note`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-05-11', 'Syarif', 'Pecah', 1, '2025-05-11 21:57:31', '2025-05-11 21:57:31');

-- --------------------------------------------------------

--
-- Table structure for table `item_types`
--

CREATE TABLE `item_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_types`
--

INSERT INTO `item_types` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Alat', '', '2025-05-11 20:50:12', '2025-05-11 20:50:12'),
(2, 'Bahan Pakai', '', '2025-05-11 20:50:46', '2025-05-11 20:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `power_types`
--

CREATE TABLE `power_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `power_types`
--

INSERT INTO `power_types` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Listrik', '', '2025-05-11 20:51:41', '2025-05-11 20:51:41'),
(2, 'Tanpa Daya', '', '2025-05-11 20:51:51', '2025-05-11 20:51:51'),
(3, 'Baterai', '', '2025-05-11 20:51:56', '2025-05-11 20:51:56');

-- --------------------------------------------------------

--
-- Table structure for table `stock_opnames`
--

CREATE TABLE `stock_opnames` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `stock_system` int(11) NOT NULL,
  `stock_actual` int(11) NOT NULL,
  `difference` int(11) NOT NULL,
  `date` date NOT NULL,
  `note` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_opnames`
--

INSERT INTO `stock_opnames` (`id`, `item_id`, `stock_system`, `stock_actual`, `difference`, `date`, `note`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 7, 0, '2025-05-11', 'sama', 1, '2025-05-11 22:12:21', '2025-05-11 22:12:21');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `symbol` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `symbol`, `created_at`, `updated_at`) VALUES
(1, 'Buah', 'Pcs', '2025-05-11 20:53:14', '2025-05-11 20:53:14'),
(2, 'Kilogram', 'Kg', '2025-05-11 20:53:24', '2025-05-11 20:53:24'),
(3, 'Unit', 'Unit', '2025-05-11 20:53:36', '2025-05-11 20:53:36'),
(4, 'Liter', 'Ltr', '2025-05-11 20:53:48', '2025-05-11 20:53:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('admin','manager','staff') NOT NULL DEFAULT 'staff',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `email`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'admin@lab.com', 'admin', '2025-05-11 20:35:21', '2025-05-11 20:35:21'),
(2, 'syarif', '$2y$10$cg9/KaKqz5H9fLm0n.kNV.AfzamXTXtNXlcMFMHki1o4OfdLummIy', 'Ahmad Syarif', 'syarif@gmail.com', 'staff', '2025-05-11 20:36:20', '2025-05-11 20:44:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `item_type_id` (`item_type_id`),
  ADD KEY `power_type_id` (`power_type_id`),
  ADD KEY `item_kind_id` (`item_kind_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `item_in`
--
ALTER TABLE `item_in`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `item_kinds`
--
ALTER TABLE `item_kinds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_out`
--
ALTER TABLE `item_out`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `item_types`
--
ALTER TABLE `item_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `power_types`
--
ALTER TABLE `power_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_opnames`
--
ALTER TABLE `stock_opnames`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item_in`
--
ALTER TABLE `item_in`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item_kinds`
--
ALTER TABLE `item_kinds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `item_out`
--
ALTER TABLE `item_out`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item_types`
--
ALTER TABLE `item_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `power_types`
--
ALTER TABLE `power_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock_opnames`
--
ALTER TABLE `stock_opnames`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `items_ibfk_2` FOREIGN KEY (`item_type_id`) REFERENCES `item_types` (`id`),
  ADD CONSTRAINT `items_ibfk_3` FOREIGN KEY (`power_type_id`) REFERENCES `power_types` (`id`),
  ADD CONSTRAINT `items_ibfk_4` FOREIGN KEY (`item_kind_id`) REFERENCES `item_kinds` (`id`),
  ADD CONSTRAINT `items_ibfk_5` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`);

--
-- Constraints for table `item_in`
--
ALTER TABLE `item_in`
  ADD CONSTRAINT `item_in_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `item_in_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `item_out`
--
ALTER TABLE `item_out`
  ADD CONSTRAINT `item_out_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `item_out_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `stock_opnames`
--
ALTER TABLE `stock_opnames`
  ADD CONSTRAINT `stock_opnames_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `stock_opnames_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
