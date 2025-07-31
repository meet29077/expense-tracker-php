-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2025 at 12:31 PM
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
-- Database: `expenses_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `category` varchar(50) NOT NULL,
  `expense_date` date NOT NULL,
  `date` date NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `user_id`, `title`, `amount`, `category`, `expense_date`, `date`, `description`, `created_at`) VALUES
(1, 3, 'Grocery', 2500.00, 'Shopping', '0000-00-00', '2025-07-26', '', '2025-07-26 08:44:56'),
(2, 3, 'Food', 100.00, 'Food', '0000-00-00', '2025-07-22', '', '2025-07-26 08:45:33'),
(3, 4, 'Grocery', 2000.00, 'Shopping', '0000-00-00', '2025-07-02', '', '2025-07-26 08:58:06'),
(4, 4, 'Samosa', 100.00, 'Food', '0000-00-00', '2025-07-03', '', '2025-07-26 08:58:37'),
(5, 4, 'Cloths', 300.00, 'Shopping', '0000-00-00', '2025-07-11', '', '2025-07-26 08:59:23'),
(6, 4, 'Vadapav', 50.00, 'Food', '0000-00-00', '2025-07-15', '', '2025-07-26 08:59:59'),
(7, 4, 'Kullu Manali', 20000.00, 'Travel', '0000-00-00', '2025-07-20', '', '2025-07-26 09:00:29'),
(8, 4, 'Gas bill', 2000.00, 'Bills', '0000-00-00', '2025-07-23', '', '2025-07-26 09:01:01'),
(12, 5, 'Car', 1000000.00, 'Shopping', '0000-00-00', '2025-07-09', '', '2025-07-26 09:25:51'),
(13, 5, 'cloths', 5000.00, 'Shopping', '0000-00-00', '2025-07-17', '', '2025-07-26 09:26:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'meet2907', 'meet@gmail.com', '$2y$10$h1Jecktiz2vib1Pr4RhhZu4SSAusSeLCLIA8MR0Wvn5ANs64GwTEe', '2025-07-22 12:37:38'),
(2, 'meet2908', 'meet08@gmail.com', '$2y$10$eirvsf3qDC2fd766O/3dM.ERkfsFEGYnstkP7VZdBu79vtFKb.Gka', '2025-07-22 12:46:55'),
(3, 'meet2909', 'meet09@gmail.com', '$2y$10$nQFuAp4tHzxCE1cY6F0IaODA/ujf7b5JMIpokUeYB2byyWxo7cUhW', '2025-07-26 08:04:48'),
(4, 'dhara2811', 'dhara2811@gmail.com', '$2y$10$M9Is.Ve1/MWmn8qsreJL.uRG6zDngk4QjtW9byPaSxgrdA1TKf6hO', '2025-07-26 08:56:32'),
(5, 'meet', 'meet1234@gmail.com', '$2y$10$yc5y9Eb.2Ed0yn8Jwt.JGeRYQb.TEPWHfsGeeVHxAt83T5B8pADY6', '2025-07-26 09:23:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
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
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
