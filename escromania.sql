-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 01, 2023 at 11:04 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `escromania`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`) VALUES
(3, 'RPG'),
(4, 'FPS'),
(5, 'MMO'),
(6, 'Strategie'),
(7, 'Simulation'),
(8, 'Survival Horror');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `game_id` int NOT NULL,
  `game_name` varchar(255) NOT NULL,
  `game_date` date NOT NULL,
  `game_desc` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `game_photo` varchar(255) NOT NULL,
  `cate_name` enum('RPG','FPS','MMO','Strategie','Simulation','Survival Horror') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `added` date NOT NULL,
  `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `game_cover` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`game_id`, `game_name`, `game_date`, `game_desc`, `game_photo`, `cate_name`, `added`, `user_name`, `game_cover`) VALUES
(2, 'Final Fantasy', '2023-05-18', 'lorem', 'www.lorem.com', 'RPG', '2031-05-23', 'Whidan', ''),
(4, 'GTA', '2023-05-17', 'rfgergser', 'tgrthdrhrd', 'RPG', '2031-05-23', 'Whidan', ''),
(6, 'LoL', '2023-05-18', 'rfgergser', 'aezferfe', 'Strategie', '2023-05-31', 'Whidan', ''),
(7, 'WoW', '2004-05-18', 'jeu de chômeur', '984166451', 'MMO', '2023-05-31', 'Whidan', ''),
(11, 'Fortnite', '2023-05-10', 'tour eiffel', 'tgrtgr', 'FPS', '2023-05-31', 'AntoniS', ''),
(12, 'Eve Online', '2023-05-08', 'Piou piou piou to win', 'avion', 'MMO', '2023-05-31', 'AntoniS', ''),
(13, 'Fire Emblem', '2023-05-10', 'des épées', '4353', 'RPG', '2023-05-31', 'Zboubi', ''),
(14, 'Dead Space', '2023-05-15', 'I\'m in space', '8767853', 'Survival Horror', '2023-05-31', 'Zboubi', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_mail` varchar(255) NOT NULL,
  `pass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_role` enum('user','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_mail`, `pass`, `user_role`) VALUES
(5, 'Whidan', 'x@y.z', '$argon2id$v=19$m=65536,t=4,p=1$QWJ4Tmhma0tER3AuaXFPcA$eimAq9H8rPdXpT7wc29qWzizmiADd3eeMEKIB8KsOTg', 'admin'),
(6, 'AntoniS', 'y@x.z', '$argon2id$v=19$m=65536,t=4,p=1$ZEpMaUtFUUxyckNtend3Tg$amh3SV1ldasty4w4xxUv6UOQ+zFO2WwvzemsmvZWCf8', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`game_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `game_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
