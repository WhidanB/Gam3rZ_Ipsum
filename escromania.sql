-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 06, 2023 at 02:27 PM
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
  `cat_name` varchar(255) NOT NULL,
  `cat_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`, `cat_photo`) VALUES
(3, 'RPG', './assets/zelda.jpg'),
(4, 'FPS', './assets/fps.jpg'),
(5, 'MMO', './assets/mmo.jpg'),
(6, 'Strategie', './assets/strategie.jpg'),
(7, 'Simulation', './assets/simulation.jpg'),
(8, 'Survival Horror', './assets/survivalhorror.jpg');

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
  `game_cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`game_id`, `game_name`, `game_date`, `game_desc`, `game_photo`, `cate_name`, `added`, `user_name`, `game_cover`) VALUES
(2, 'Final Fantasy XV', '2016-11-29', 'Anciennement nommé Final Fantasy XIII Versus, Final Fantasy XV est un J-RPG de la célèbre série Final Fantasy. Le joueur y incarne Noctis, héritier du roi, accompagné de ses amis, dans un monde moderne, sombre, et fantastique.', '', 'RPG', '2031-06-01', 'Whidan', './assets/FF_XV_cover_art.jpg'),
(17, 'Call of Duty : Modern Warfare II (2022)', '2022-10-28', 'Version reboot de l\'emblématique jeu de tir à la première personne sorti en 2009, Call of Duty Modern Warfare 2 offre une expérience multi et solo ayant pour but de raviver la flamme de son illustre prédécesseur. Le jeu bénéficie de nouveaux graphismes et d\'une refonte complète. Il devrait être le début d\'une nouvelle ère pour la licence.', './uploads/45733db00c4caa4e6e7c5d0c174d663c.png', 'FPS', '2023-06-05', 'Whidan', './uploads/3cf95084eabfffa83195b3f8e4470538.jpg'),
(18, 'The Legend of Zelda : Tears of the Kingdom', '2023-05-12', 'The Legend of Zelda : Tears of the Kingdom est la suite du jeu d\'action/aventure Breath of the Wild de Nintendo de 2017. Le titre avait été pensé pour que le joueur puisse aller où il veut dès le début, s\'éloignant de la linéarité habituelle de la série.', './uploads/43232510a18b840a2a34399baddf993b.png', 'RPG', '2023-06-05', 'Whidan', './uploads/26b48991653d760e4cf7f1874b2acf6b.jpg'),
(19, 'Dead Island 2', '2023-04-21', 'Dead Island 2 est un FPS, suite directe du premier volet. Plusieurs mois après les événements qui se sont déroulés à Banoi, les Etats-Unis se voient obligés de mettre la Californie en quarantaine. Désormais zone interdite, \"l\'Etat doré\" est devenu un paradis sanglant pour ceux qui ont refusé de quitter leur maison, et un terrain de chasse rêvé pour les renégats qui cherchent l’aventure, la gloire et un nouveau départ.', './uploads/16bed97a3249cfbba274e8c9028c29d5.jpg', 'FPS', '2023-06-05', 'Whidan', './uploads/b0848bc2e05138588e95d5c430e81b8e.jpg'),
(20, 'World of Warcraft : DragonFlight', '2023-11-29', 'World of Warcraft : Dragonflight est l\'extension faisant suite à Shadowlands et marque le retour en Azeroth. La Grande Fracture a provoqué l\'apparition des îles aux dragons, déclenchant un nouveau conflit. Pour la première fois depuis six ans, World of Warcraft va recevoir une treizième classe jouable qui sera appelée Évocateurs. Les joueurs souhaitant jouer cette classe devront obligatoirement créer un Dracthyr, une race de dragons ayant grandi sur l’île.', './uploads/bde1351a2ccd240b34dec3b1b72f693d.jpg', 'MMO', '2023-06-05', 'Whidan', './uploads/177c44a6970ed783de871d1eb78b8fd8.jpg'),
(21, 'Final Fantasy XIV : Endwalker', '2021-12-07', 'Final Fantasy XIV : Endwalker est la quatrième extension du jeu éponyme. Il s\'agit d\'un MMORPG (jeu de rôle massivement multijoueur) ancré dans l\'univers des Final Fantasy. Dans Endwalker, il est possible de voyager à travers l\'île de Thavnair, Garlemald et même la Lune. Deux nouvelles classes font leur apparition : le sage (soigneur) et le faucheur (DPS de mêlée). La race des hommes Viéras est également disponible.', './uploads/b9b45e6a4c677e45bf45050e3318bf38.jpg', 'MMO', '2023-06-05', 'Whidan', './uploads/5f38e66b2dd10fa360c32b2a8b804f3e.jpg'),
(22, 'Age of Empires IV', '2021-10-28', 'Age of Empires IV est un jeu de stratégie qui appartient à la célèbre saga de stratégie. Il vous sera possible de prendre part à des batailles historiques avec des armées possédant leurs propres caractéristiques.', './uploads/0436a80a795cd8f2e18578a37d2b69ae.jpg', 'Strategie', '2023-06-05', 'Whidan', './uploads/2c55622d415650307f48187faffa3b9d.jpg'),
(23, 'Total War : Warhammer III', '2022-02-17', 'Total War : Warhammer III est le dernier volet de la trilogie du jeu de guerre stratégique. En plus des races des précédents opus, deux nouvelles races seront disponibles ainsi que les quatre factions du Chaos.', './uploads/2d625272948b57833566f184f35ab709.jpg', 'Strategie', '2023-06-05', 'Whidan', './uploads/9e71a58e031df5b8182270b5ffe8d86f.jpg'),
(24, 'F1 22', '2022-07-01', 'F1 2022 est une simulation automobile développée par Codemasters et labellisée EA Sports. Comme le veut la tradition, il s\'agit d\'un jeu sous franchise Formula One officielle, permettant cette fois-ci de s\'immiscer dans la compétition avec les nouvelles règles du championnat, de nouvelles voitures hybrides et un week-end de course entièrement repensé.', './uploads/7fce2ed3f34139dd96fb559e0fc17713.jpg', 'Simulation', '2023-06-05', 'Whidan', './uploads/bfd8d928c48cd2e2fbbbfa2815be512c.jpg'),
(25, 'Farming Simulator 22', '2021-11-22', 'Ce nouvel opus de la série de simulation fermière s\'installe dans la lignée de ses prédécesseurs, avec quelques nouveautés. De nouvelles cartes, de nouvelles plantations, de nouvelles machines et de nouvelles marques y sont disponibles pour mieux développer votre ferme, que ce soit seul ou à plusieurs.', './uploads/16adf736d5bfaa6186d1561346e3c951.jpg', 'Simulation', '2023-06-05', 'Whidan', './uploads/1563337b26e42425ae11b11f9cdfc1a3.jpg'),
(26, 'Resident Evil 4 (2023)', '2023-03-24', 'Leon Kennedy revient avec le remake de Resident Evil 4. Ce survival-horror proposera une aventure totalement repensée et modernisée, à l\'instar de ce qui a été fait avec Resident Evil 2 et Resident Evil 3. Un mode spécial en VR est prévu pour fonctionner avec le PSVR2.', './uploads/4bd8799a424b0d3fe6ed46fdb6b9338a.jpg', 'Survival Horror', '2023-06-05', 'Whidan', './uploads/fdcf76d007f728e42b0a6ff46b4af265.jpg'),
(27, 'The Callisto Protocol', '2022-12-02', 'The Callisto Protocol est fortement inspiré par Dead Space et propose de se retrouver sur Callisto une des lunes de la géante gazeuse Jupiter. Le héros se retrouve dans l\'espace et doit se débarrasser de créatures effrayantes en évitant les morts très sanglantes.', './uploads/6092a7122f3c79edd73fd71f2199b471.jpg', 'Survival Horror', '2023-06-05', 'Whidan', './uploads/f6cf28252717b79086271577ad6b7609.jpeg');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `game_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
