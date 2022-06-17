-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2022 at 11:15 AM
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
(1, 'Elden Ring', 'Là bom tấn nhập vai hành động vừa ra mắt, được phát triển bởi FromSoftware và do Bandai Namco Entertainment phát hành. Trò chơi là sự hợp tác giữa đạo diễn Hidetaka Miyazaki của Dark Souls và tiểu thuyết gia George RR Martin - “cha đẻ” của Trò chơi vương quyền.\r\n', 'Hành động\r\n', 'FromSoftware\r\n', 999, 'dummy/game10.jpg', 'dummy/game1s.jpg', 'dummy/game11.jpg', 'dummy/game12.jpg', 'dummy/game13.jpg'),
(2, 'God of War\r\n', 'Sau cuộc trả thù các vị thần trên đỉnh Olympus nhiều năm trước, Kratos giờ đây sống 1 cuộc đời mới trong vương quốc của các vị thần Bắc Âu và quái vật. Chính trong thế giới khắc nghiệt và không khoan nhượng này, cha con anh phải chiến đấu để sinh tồn bằng mọi giá.\r\n', 'Hành động\r\n', 'Santa Monica Studio\r\n', 499, 'dummy/game20.jpg', 'dummy/game2s.jpg', 'dummy/game21.jpg', 'dummy/game22.jpg', 'dummy/game23.jpg'),
(3, 'Final Fantasy VII Remake Intergrade\r\n', 'Lấy bối cảnh là đô thị cyberpunk loạn lạc ở Midgar, người chơi điều khiển đám lính đánh thuê Cloud Strife. Anh tham gia vào lực lượng AVALANCHE, một nhóm các chiến binh khởi nghĩa đang cố gắng ngăn chặn tập đoàn siêu lớn mạnh Shinra sử dụng tinh chất sự sống của hành tinh làm nguồn năng lượng. Trò chơi kết hợp hành động thời gian thực với các yếu tố chiến lược và nhập vai.\r\n', 'nhập vai hành động\r\n', 'Square Enix\r\n', 299, 'dummy/game30.jpg', 'dummy/game3s.jpg', 'dummy/game31.jpg', 'dummy/game32.jpg', 'dummy/game33.jpg'),
(4, 'Halo Infinite\r\n', 'Tiếp nối cốt truyện của phần 5, với hầu hết thời lượng tập trung vào nhân vật chính Master Chief. Trong game, Master Chief sẽ làm việc với AI The Weapon để tìm hiểu chuyện gì đã xảy ra với Cortana sau Halo 5: Guardians. Người chơi sẽ lên đường khám phá vành đai Zeta Halo và chiến đấu xuyên ngân hà chống lại kẻ thù gồm nhiều chủng loài người ngoài hành tinh khác nhau.\r\n', 'Nhập vai, Hành động\r\n', '343 Industries\r\n', 699, 'dummy/game40.jpg', 'dummy/game4s.jpg', 'dummy/game41.jpg', 'dummy/game42.jpg', 'dummy/game43.jpg');

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
-- Dumping data for table `user_library`
--

INSERT INTO `user_library` (`Library_id`, `User_id`, `Product_id`) VALUES
(22, 24, 1),
(23, 24, 4),
(24, 24, 3);

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
  MODIFY `Product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
