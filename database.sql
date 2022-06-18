-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2022 at 10:33 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hcmg`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `Cart_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_purchase`
--

CREATE TABLE `log_purchase` (
  `Purchase_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `log_purchase`
--

INSERT INTO `log_purchase` (`Purchase_id`, `User_id`, `Time`) VALUES
(12, 24, '2022-06-16 19:37:47'),
(13, 24, '2022-06-16 19:48:43');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_id` int(11) NOT NULL,
  `Name` text COLLATE utf8_unicode_ci NOT NULL,
  `Description` text COLLATE utf8_unicode_ci NOT NULL,
  `Type` text COLLATE utf8_unicode_ci NOT NULL,
  `Produce_studio` text COLLATE utf8_unicode_ci NOT NULL,
  `Price` int(11) NOT NULL,
  `Background_image` text COLLATE utf8_unicode_ci NOT NULL,
  `Square_image` text COLLATE utf8_unicode_ci NOT NULL,
  `Small_image1` text COLLATE utf8_unicode_ci NOT NULL,
  `Small_image2` text COLLATE utf8_unicode_ci NOT NULL,
  `Small_image3` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_id`, `Name`, `Description`, `Type`, `Produce_studio`, `Price`, `Background_image`, `Square_image`, `Small_image1`, `Small_image2`, `Small_image3`) VALUES
(1, 'ELDEN RING\r\n', 'is a newly released action role-playing blockbuster, developed by FromSoftware and published by Bandai Namco Entertainment. The game is a collaboration between Dark Souls director Hidetaka Miyazaki and novelist George RR Martin - the \"father\" of Game of Thrones.', 'Hành động\r\n', 'FromSoftware\r\n', 999, 'dummy/game10.jpg\r\n', 'dummy/game1s.jpg\r\n', 'dummy/game11.jpg\r\n', 'dummy/game12.jpg\r\n', 'dummy/game13.jpg\r\n'),
(2, 'God of War\r\n', 'After taking revenge on the Olympians years ago, Kratos now lives a new life in the realm of Norse gods and monsters. It is in this harsh and unforgiving world that father and son must fight to survive at all costs.', 'Hành động\r\n', 'Santa Monica Studio\r\n', 499, 'dummy/game20.jpg\r\n', 'dummy/game2s.jpg\r\n', 'dummy/game21.jpg\r\n', 'dummy/game22.jpg\r\n', 'dummy/game23.jpg\r\n'),
(3, 'Final Fantasy VII Remake Intergrade\r\n', 'Set in the chaotic cyberpunk metropolis of Midgar, the player controls a horde of mercenaries Cloud Strife. He joins forces with AVALANCHE, a group of rebel fighters who are trying to stop the super-powerful corporation Shinra from using the planet\'s life essence as a source of energy. The game combines real-time action with strategy and role-playing elements.', 'nhập vai hành động\r\n', 'Square Enix\r\n', 299, 'dummy/game30.jpg\r\n', 'dummy/game3s.jpg\r\n', 'dummy/game31.jpg\r\n', 'dummy/game32.jpg\r\n', 'dummy/game33.jpg\r\n'),
(4, 'Halo Infinite\r\n', 'continues the plot of season 5, with most of the time focusing on the main character Master Chief. In the game, Master Chief will work with AI The Weapon to find out what happened to Cortana after Halo 5: Guardians. Players will set out to explore the Zeta Halo belt and battle across the galaxy against enemies of various alien races.', 'nhập vai hành động\r\n', '343 Industries\r\n', 699, 'dummy/game40.jpg\r\n', 'dummy/game4s.jpg\r\n', 'dummy/game41.jpg\r\n', 'dummy/game42.jpg\r\n', 'dummy/game43.jpg\r\n'),
(5, 'Ghostwire: Tokyo', 'The duo must use their supernatural skills to uncover the mystery related to the sudden disappearance of most of Tokyo\'s population, while repelling evil spirits attacking the city. The game was originally oriented as a sequel to The Evil Within, before becoming a separate project under the production direction of Ikumi Nakamura, a \"veteran\" of the two The Evil Within games.', 'Hành động', 'Tango Gameworks', 899, 'dummy/game50.jpg', 'dummy/game5s.jpg', 'dummy/game51.jpg', 'dummy/game52.jpg', 'dummy/game53.jpg'),
(6, 'ELEX II', 'is the successor to the open-world role-playing blockbuster ELEX. Once again, Jax must rally the free individuals of the sci-fi world of Magalan to fight a new threat called the Skyanides, who want to rule the planet forever.', 'Nhập vai - RPG', 'Piranha Bytes', 349, 'dummy/game60.jpg', 'dummy/game6s.jpg', 'dummy/game61.jpg', 'dummy/game62.jpg', 'dummy/game63.jpg'),
(7, 'Starsand', 'While running a marathon in the desert, suddenly you encounter a storm, which is then swallowed by a wall of yellow sand. You seek shelter for the night at an ancient temple in the desert. When you wake up the next morning, you feel like something is wrong. The storm dissipates and the sky is clear, but around you is an endless \"ocean\" of sand. You must find a way to survive until a rescuer finds you. Hope is the life force, at least until you find out the truth about this place.', 'Mô phỏng', 'Tunnel Vision Studio', 979, 'dummy/game70.jpg', 'dummy/game7s.jpg', 'dummy/game71.jpg', 'dummy/game72.jpg', 'dummy/game73.jpg'),
(8, 'Internet Cafe Simulator 2\r\n', 'Like any career simulation game, especially a business game, you have to attract more customers every day of the week. On rainy days or bad weather, the number of visitors will gradually decrease. That\'s when a smart strategy is needed to attract customers to the shop despite objective external conditions.', 'Chiến thuật Mô phỏng\r\n', 'Cheesecake Dev\r\n', 59, 'dummy/game80.jpg', 'dummy/game8s.jpg', 'dummy/game81.jpg', 'dummy/game82.jpg', 'dummy/game83.jpg'),
(9, 'Pantropy', 'is an action, sci-fi game on the PC platform. Players will start the game in areas outside the island and must delve into enemy territory to obtain the highest value loot and ores. In the center of the map, where the most loot and ores are stored is also where many players appear. Therefore, this is also a place where constant skirmishes and large-scale battles between groups of players occur. The game has a unique biome, a wide range of weapons, and a highly customizable base. Whether you build your base above or below ground, or stay alert for enemy factions will come to you at any moment.', 'Hành động', 'Brain Stone GmbH', 759, 'dummy/game90.jpg', 'dummy/game9s.jpg', 'dummy/game91.jpg', 'dummy/game92.jpg', 'dummy/game93.jpg'),
(10, 'No Man\'s Sky', 'By collecting and reporting data about the planets in the game, you will receive \"bonus\" that can be used to shop, upgrade your equipment (don\'t forget to \"upgrade\" your spaceship). mine too!). In addition, you can also participate in trading activities, exchange resources, materials, and items to \"earn more\". A large pocket of money will always be a great insurance for you, wherever you are.', 'Phiêu lưu', 'Hello Games', 499, 'dummy/game100.jpg', 'dummy/game10s.jpg', 'dummy/game101.jpg', 'dummy/game102.jpg', 'dummy/game103.jpg'),
(11, 'Far Cry 6', 'Set in Yara, a fictional island in the Caribbean. As the dictator of Yara, Anton Castillo and his son Diego intend to restore the place to its glory days by any means. Their oppressive rule sparked a revolution. In the game, the player takes on the role of a local Yara resident named Dani Rojas, a freedom fighter guerrilla soldier who is trying to overthrow Castillo and his regime. You can choose Dani\'s gender at the start of the game.', 'Phiêu lưu', 'Ubisoft', 499, 'dummy/game110.jpg', 'dummy/game11s.jpg', 'dummy/game111.jpg', 'dummy/game112.jpg', 'dummy/game113.jpg'),
(12, 'The Sims 4: Deluxe Edition', 'On the occasion of Vietnam\'s National Day (September 2) -_-, EA Games suddenly announced the appearance of a descendent version that is highly anticipated by fans of the simulation game series, which is The Sims 4 after a long time. Many times delayed by the \"milking\" expansions of The Sims 3. With its 4th return, The Sims continues to give fans a game to fall in love with, and to remember.', 'Mô phỏng', 'Maxis', 349, 'dummy/game120.jpg', 'dummy/game12s.jpg', 'dummy/game121.jpg', 'dummy/game122.jpg', 'dummy/game123.jpg'),
(13, 'My Time at Sandrock', 'You play as a fledgling builder who accepts a job offer in Sandrock City. With skills and a reliable toolkit, you\'ll have to gather resources, craft machines, repair your workshop into a giant production machine, and save your town from the brink of economic devastation. as well as some unexpected troubles.', 'Nhập vai - RPG', 'Pathea Games', 699, 'dummy/game130.jpg', 'dummy/game13s.jpg', 'dummy/game131.jpg', 'dummy/game132.jpg', 'dummy/game133.jpg'),
(14, 'The Iron Oath', 'is a new product from the creators of Carto and Wildfire. As the leader of a group of mercenaries in the harsh kingdom of Caelum, players will focus on hiring new recruits, managing all operations, and undertaking a series of dangerous quests to survive, grow and build a reputation. voice for his force.', 'Nhập vai - RPG', 'Curious Panda Games', 899, 'dummy/game140.jpg', 'dummy/game14s.jpg', 'dummy/game141.jpg', 'dummy/game142.jpg', 'dummy/game143.jpg'),
(15, 'Jurassic World Evolution 2', 'Jurassic World Evolution II features a new campaign, a series of additional features and even new dinosaurs, all creating a realistic wildlife park, extremely attractive to players. Part 2 also adds many new options for you to create your own dinosaur park. In short, this is a bigger and more realistic dinosaur park builder version than before.', 'Mô phỏng', 'Frontier Developments', 999, 'dummy/game150.jpg', 'dummy/game15s.jpg', 'dummy/game151.jpg', 'dummy/game152.jpg', 'dummy/game153.jpg'),
(16, 'Bus Simulator 21', 'The most complete and improved bus driving game in the series of the same name. In this game, you will be able to drive a variety of buses of popular brands such as Alexander Dennis, BYD, Grande West and Blue Bird besides familiar brands such as Mercedes-Benz, Setra, IVECO BUS... First the drivers have a chance to conquer the city traffic challenge on the cockpit of the double decker bus and the electric bus.', 'Mô phỏng', 'stillalive studios', 349, 'dummy/game160.jpg', 'dummy/game16s.jpg', 'dummy/game161.jpg', 'dummy/game162.jpg', 'dummy/game163.jpg'),
(17, 'TOGETHER BnB', 'You will play the main character James whose brother owns a hotel called BnB. James is forced to take over BnB since his brother mysteriously disappeared. Besides finding his brother through various clues, as deputy manager, James must also support BnB\'s beautiful tenants, satisfy their every need and help them achieve their goals. his spending. Through the development of the plot, you will gradually build affection and trust with the tenant girls, but crises will also gradually arise.', 'Nhập vai - RPG', 'AURORA Games', 699, 'dummy/game170.jpg', 'dummy/game17s.jpg', 'dummy/game171.jpg', 'dummy/game172.jpg', 'dummy/game173.jpg'),
(18, 'Alien Shooter 2 - New Era', 'About 50 years have passed since the beginning of the Alien Invasion, the planet is slowly turning into a desert. The few survivors huddle in colonies and hide in abandoned cities and subways. Trade caravans with provisions and other necessities ply between the settlements. But their path is not always safe…', 'Nhập vai - RPG', 'Sigma Team Inc', 349, 'dummy/game180.jpg', 'dummy/game18s.jpg', 'dummy/game181.jpg', 'dummy/game182.jpg', 'dummy/game183.jpg'),
(19, 'Nigel\'s Journey : A Working Day', 'Nigel is a former French special forces soldier. When he returned home after combats, he decided to leave the army and find an ordinary job in an office. One day, an army of terrorists invaded his workplace. Nigel had therefore to resume service to teach these bastards a lesson and find a way out.', 'Hành động', 'Maestro Creations', 299, 'dummy/game190.jpg', 'dummy/game19s.jpg', 'dummy/game191.jpg', 'dummy/game192.jpg', 'dummy/game193.jpg'),
(20, 'Lost Wing', 'Pilot a super fast ship through brutal environments, and try to top the leaderboards! Featuring numerous challenges, ships, enemies and traps, Lost Wing is a shot of pure unadulterated adrenaline.  combines shooting and flying at super high speed . Race through a huge variety of tracks, dodging and shooting everything in your way, if you reach the end goal, destroy the boss for a massive points bonus.', 'Đua xe', 'BoxFrog Games', 299, 'dummy/game200.jpg', 'dummy/game20s.jpg', 'dummy/game201.jpg', 'dummy/game202.jpg', 'dummy/game203.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_id` int(11) NOT NULL,
  `User_name` text COLLATE utf8_unicode_ci NOT NULL,
  `User_password` text COLLATE utf8_unicode_ci NOT NULL,
  `is_Admin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_id`, `User_name`, `User_password`, `is_Admin`) VALUES
(1, '!a_admin', '0668734bda92da2f4217bd0a10c206d2', 1),
(2, 'Demo003', 'f812bc76df23b7d2d88cb770c4113052', 0),
(3, 'Demo04', '68b6b7cb3ad6c83b32049de4f306370a', 0),
(4, 'demoAdmin', '25fc499d707c8c947cca7b70b7877738', 1),
(24, 'Demo01', '0668734bda92da2f4217bd0a10c206d2', 0),
(31, 'Demo02', 'ba39563020ca779a657c97ab8301b39f', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_library`
--

CREATE TABLE `user_library` (
  `Library_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`Cart_id`),
  ADD KEY `Cart_Product_id` (`Product_id`),
  ADD KEY `Cart_User_id` (`User_id`);

--
-- Indexes for table `log_purchase`
--
ALTER TABLE `log_purchase`
  ADD PRIMARY KEY (`Purchase_id`),
  ADD KEY `Purchase_User_id` (`User_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_id`);

--
-- Indexes for table `user_library`
--
ALTER TABLE `user_library`
  ADD PRIMARY KEY (`Library_id`),
  ADD KEY `Lib_prod_id` (`Product_id`),
  ADD KEY `Lib_user_id` (`User_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `Cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `log_purchase`
--
ALTER TABLE `log_purchase`
  MODIFY `Purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user_library`
--
ALTER TABLE `user_library`
  MODIFY `Library_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `Cart_Product_id` FOREIGN KEY (`Product_id`) REFERENCES `product` (`Product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Cart_User_id` FOREIGN KEY (`User_id`) REFERENCES `user` (`User_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `log_purchase`
--
ALTER TABLE `log_purchase`
  ADD CONSTRAINT `Purchase_User_id` FOREIGN KEY (`User_id`) REFERENCES `user` (`User_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_library`
--
ALTER TABLE `user_library`
  ADD CONSTRAINT `Lib_prod_id` FOREIGN KEY (`Product_id`) REFERENCES `product` (`Product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Lib_user_id` FOREIGN KEY (`User_id`) REFERENCES `user` (`User_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
