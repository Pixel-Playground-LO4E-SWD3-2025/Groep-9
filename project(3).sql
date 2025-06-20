-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2025 at 04:14 PM
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
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `highscores`
--

CREATE TABLE `highscores` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `game_name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `highscores`
--

INSERT INTO `highscores` (`id`, `user_id`, `game_name`, `username`, `score`) VALUES
(8, 8, 'test', 'henk', 2414),
(15, 8, 'race game 2025', 'henk', 0),
(16, 8, 'game', 'henk', 2000),
(17, 7, 'blockRunner', 'jan', 1081),
(18, 8, 'the sims', '5 dagen', -2147483647),
(19, 8, 'korea sim', 'lol', 672345876),
(20, 8, 'sim', 'fvnhjhbu', 5647587),
(21, 8, 'test', 'mag iets zijn', 1234680),
(22, 8, 'test', 'zsch', 763),
(23, 8, 'test', 'dfbj', 382),
(24, 8, 'test', 'shfj', 489),
(25, 8, 'test', 'eokr', 281),
(26, NULL, 'test', 'anoniem', 2000),
(27, NULL, 'blockRunner', 'anoniem', 1078),
(28, 7, 'tick-tack-toe', 'jan', 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'testuser', 'test123@mail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2025-05-20 17:19:06'),
(2, 'Kees', 'KeesFabio@hotmail.com', 'Fabio.1988', '2025-05-20 18:55:48'),
(3, 'test', 'test@gmail.com', '1234', '2025-06-18 15:34:12'),
(7, 'jan', 'janpietes@gmail.com', '$2y$10$rFzVTU.krO0cThXK3H/vCuzTrXDQQkId0dwv7ekcr08CH9N2XXCPy', '2025-06-18 18:32:39'),
(8, 'henk', 'henkbart@gmail.com', '$2y$10$HYJMFyihVBRA5M60D83dVOWhCPrHwWm3hIZys5OcMfmny7/qUGSZe', '2025-06-18 18:43:14'),
(9, 'bart', 'bart@gmail.com', '1234', '2025-06-19 15:40:00'),
(10, '1', '1@gmail.com', '$2y$10$07vfAsgiWH/Vq51AN4ffwuSonRbXvF4/7ir4i2xhzFXcxWwtZLSNa', '2025-06-20 11:21:08');

-- --------------------------------------------------------

--
-- Table structure for table `vrienden`
--

CREATE TABLE `vrienden` (
  `gebruiker_id` int(255) NOT NULL,
  `vrienden_id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `accepted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vrienden`
--

INSERT INTO `vrienden` (`gebruiker_id`, `vrienden_id`, `username`, `accepted`) VALUES
(7, 8, 'jan', 1),
(7, 9, 'jan', 0),
(7, 1, 'jan', 0),
(7, 10, 'jan', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `highscores`
--
ALTER TABLE `highscores`
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
-- AUTO_INCREMENT for table `highscores`
--
ALTER TABLE `highscores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
