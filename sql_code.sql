-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 28, 2024 at 04:34 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitness`
--

-- --------------------------------------------------------

--
-- Table structure for table `coach_account`
--

CREATE TABLE `coach_account` (
  `coach_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(20) NOT NULL CHECK (octet_length(`full_name`) > 0),
  `about_me` varchar(255) NOT NULL,
  `phone` varchar(13) NOT NULL CHECK (octet_length(`phone`) >= 10 and octet_length(`phone`) <= 13),
  `domain` varchar(50) NOT NULL CHECK (octet_length(`domain`) > 0),
  `city` varchar(20) NOT NULL CHECK (octet_length(`city`) > 0),
  `state` varchar(20) NOT NULL CHECK (octet_length(`state`) > 0),
  `zipcode` varchar(20) NOT NULL CHECK (octet_length(`zipcode`) > 0 and octet_length(`zipcode`) <= 10),
  `country` varchar(20) NOT NULL CHECK (octet_length(`country`) > 0),
  `picture` varchar(50) DEFAULT NULL CHECK (octet_length(`picture`) < 50)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coach_account`
--

INSERT INTO `coach_account` (`coach_id`, `user_id`, `full_name`, `about_me`, `phone`, `domain`, `city`, `state`, `zipcode`, `country`, `picture`) VALUES
(1, 1, 'Amine Ait Bella', 'Hello my name is amine ', '0772525374', 'Bodybuilding', 'Agadir', 'souss', '83350', 'Morocco', '634425667d4c72a4538.png');

-- --------------------------------------------------------

--
-- Table structure for table `coach_price`
--

CREATE TABLE `coach_price` (
  `id_price` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coach_price`
--

INSERT INTO `coach_price` (`id_price`, `coach_id`, `price`, `update_date`) VALUES
(1, 1, '1000.00', '2024-06-27 13:57:03');

-- --------------------------------------------------------

--
-- Table structure for table `exercice_training_program`
--

CREATE TABLE `exercice_training_program` (
  `id_training` int(11) NOT NULL,
  `id_exercice` int(11) NOT NULL,
  `sets` int(11) NOT NULL CHECK (`sets` > 0),
  `reps` int(11) NOT NULL CHECK (`reps` > 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exercice_training_program`
--

INSERT INTO `exercice_training_program` (`id_training`, `id_exercice`, `sets`, `reps`) VALUES
(11, 1, 4, 12),
(11, 2, 4, 12),
(12, 1, 4, 12),
(12, 2, 4, 12),
(14, 1, 3, 3),
(15, 1, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE `exercises` (
  `id_exercise` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL CHECK (char_length(`title`) < 100),
  `description` varchar(255) NOT NULL CHECK (char_length(`description`) < 255),
  `target_muscle` varchar(20) NOT NULL CHECK (char_length(`target_muscle`) < 20),
  `yt_video` varchar(100) NOT NULL CHECK (char_length(`yt_video`) < 255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`id_exercise`, `coach_id`, `title`, `description`, `target_muscle`, `yt_video`) VALUES
(1, 1, 'chest', 'this is an exercice make sure that you are in a good postion', 'upper chest', 'https://www.youtube.com/shorts/oRkrwIrAleI'),
(2, 1, 'Traps exercice', 'this is an exercice make sure that you are in a good postion', 'traps', 'https://www.youtube.com/watch?v=IcSZ1bsk0XE');

-- --------------------------------------------------------

--
-- Table structure for table `nutrition`
--

CREATE TABLE `nutrition` (
  `id_nutrition` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nutrition`
--

INSERT INTO `nutrition` (`id_nutrition`, `coach_id`, `created_at`) VALUES
(10, 1, '2024-06-28 11:57:49'),
(11, 1, '2024-06-28 11:57:49'),
(12, 1, '2024-06-28 12:10:13'),
(13, 1, '2024-06-28 12:11:04');

-- --------------------------------------------------------

--
-- Table structure for table `nutrition_food`
--

CREATE TABLE `nutrition_food` (
  `id_food` int(11) NOT NULL,
  `id_nutrition` int(11) NOT NULL,
  `food_name` varchar(255) NOT NULL CHECK (octet_length(`food_name`) < 255),
  `weight` decimal(10,0) NOT NULL CHECK (`weight` >= 0),
  `kcal` decimal(10,0) NOT NULL CHECK (`kcal` >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nutrition_food`
--

INSERT INTO `nutrition_food` (`id_food`, `id_nutrition`, `food_name`, `weight`, `kcal`) VALUES
(9, 10, 'potatos', '100', '300'),
(10, 10, 'bread', '100', '300'),
(11, 11, 'oats', '100', '375'),
(12, 11, 'chicken', '200', '120'),
(13, 12, 'potatos', '2', '2'),
(14, 13, 'potatos', '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `nutrition_training_program`
--

CREATE TABLE `nutrition_training_program` (
  `id_train_prog` int(11) NOT NULL,
  `id_training` int(11) NOT NULL,
  `id_nutrition` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nutrition_training_program`
--

INSERT INTO `nutrition_training_program` (`id_train_prog`, `id_training`, `id_nutrition`) VALUES
(8, 14, 12),
(9, 15, 13);

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id_subscription` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `coach_id` int(11) DEFAULT NULL,
  `status` enum('pending','accepted','cancelled','end') DEFAULT NULL,
  `sub_date` datetime DEFAULT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id_subscription`, `user_id`, `coach_id`, `status`, `sub_date`, `price`) VALUES
(1, 5, 1, 'accepted', '2024-06-27 12:57:30', '1000.00');

-- --------------------------------------------------------

--
-- Table structure for table `training_program`
--

CREATE TABLE `training_program` (
  `id_training` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL CHECK (octet_length(`title`) > 0),
  `day_of_week` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `training_program`
--

INSERT INTO `training_program` (`id_training`, `coach_id`, `user_id`, `title`, `day_of_week`, `created_at`, `duration`) VALUES
(11, 1, 5, 'push', 'Monday', '2024-06-28 11:52:29', 60),
(12, 1, 5, 'push', 'Monday', '2024-06-28 11:54:51', 60),
(14, 1, 5, 'push-pull-leg', 'Tuesday', '2024-06-28 12:10:13', 60),
(15, 1, 5, 'leg', 'Wednesday', '2024-06-28 12:11:04', 60);

--
-- Triggers `training_program`
--
DELIMITER $$
CREATE TRIGGER `before_insert_training` BEFORE INSERT ON `training_program` FOR EACH ROW BEGIN
    IF NEW.created_at > NOW() THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'creation date cannot be in the future';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL CHECK (octet_length(`email`) > 0),
  `password` varchar(255) NOT NULL CHECK (octet_length(`password`) >= 8),
  `type` enum('coach','admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `type`) VALUES
(1, 'aitbellaamine11@gmail.com', '$2y$10$gmdFeB43UChPGyGh9EsPMOW2o9YF5c4Q914Os6rEhoy/DDJqniTV2', 'coach'),
(5, 'aitbellaamine111@gmail.com', '$2y$10$gmdFeB43UChPGyGh9EsPMOW2o9YF5c4Q914Os6rEhoy/DDJqniTV2', 'user'),
(7, 'aitbellaamine@gmail.com', '$2y$10$v/enRntkkJ8Ct5zYkr5rpuSYcWOIis4z7bt3hlYK23e1wMQ5SCl1q', 'user'),
(8, 'aitbellaamineKO@gmail.com', '$2y$10$4Qx73Bwf1Sdic9JSA9yGAug4cg5p1sswupEo0BdmeW2C74ToC1iQC', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `info_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(20) NOT NULL CHECK (octet_length(`full_name`) > 0),
  `birthday` date NOT NULL,
  `phone` varchar(13) NOT NULL CHECK (octet_length(`phone`) >= 10 and octet_length(`phone`) <= 13),
  `weight` decimal(10,0) NOT NULL CHECK (`weight` > 0),
  `height` decimal(10,0) NOT NULL CHECK (`height` > 0),
  `registration_date` datetime NOT NULL,
  `picture` varchar(100) DEFAULT NULL CHECK (octet_length(`picture`) < 100)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`info_id`, `user_id`, `full_name`, `birthday`, `phone`, `weight`, `height`, `registration_date`, `picture`) VALUES
(1, 5, 'Alan doe', '2002-02-14', '0754656765', '90', '185', '2024-06-27 13:56:00', NULL),
(2, 7, 'LANA JEAN', '2002-02-18', '0764535465', '100', '190', '2024-06-28 13:51:52', NULL),
(3, 8, 'SEAT LEON', '2002-02-18', '0764535465', '70', '170', '2024-06-28 13:54:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `weight_track`
--

CREATE TABLE `weight_track` (
  `id_track` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `weight` decimal(10,0) NOT NULL CHECK (`weight` > 0),
  `img` varchar(255) DEFAULT NULL CHECK (char_length(`img`) <= 255),
  `track_date` datetime NOT NULL,
  `id_subscription` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `weight_track`
--

INSERT INTO `weight_track` (`id_track`, `user_id`, `weight`, `img`, `track_date`, `id_subscription`) VALUES
(1, 5, '89', 'tr.jpg', '2024-06-27 20:17:04', 1),
(2, 5, '89', 'tr1.jpg', '2024-07-06 20:17:04', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coach_account`
--
ALTER TABLE `coach_account`
  ADD PRIMARY KEY (`coach_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `coach_price`
--
ALTER TABLE `coach_price`
  ADD PRIMARY KEY (`id_price`),
  ADD KEY `fk_coach_price_coach_id` (`coach_id`);

--
-- Indexes for table `exercice_training_program`
--
ALTER TABLE `exercice_training_program`
  ADD KEY `id_training` (`id_training`),
  ADD KEY `id_exercice` (`id_exercice`);

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`id_exercise`),
  ADD KEY `fk_ex_coach` (`coach_id`);

--
-- Indexes for table `nutrition`
--
ALTER TABLE `nutrition`
  ADD PRIMARY KEY (`id_nutrition`),
  ADD KEY `coach_id` (`coach_id`);

--
-- Indexes for table `nutrition_food`
--
ALTER TABLE `nutrition_food`
  ADD PRIMARY KEY (`id_food`),
  ADD KEY `id_nutrition` (`id_nutrition`);

--
-- Indexes for table `nutrition_training_program`
--
ALTER TABLE `nutrition_training_program`
  ADD PRIMARY KEY (`id_train_prog`),
  ADD KEY `id_training` (`id_training`),
  ADD KEY `id_nutrition` (`id_nutrition`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id_subscription`),
  ADD KEY `fk_sub_user` (`user_id`),
  ADD KEY `fk_sub_coach` (`coach_id`);

--
-- Indexes for table `training_program`
--
ALTER TABLE `training_program`
  ADD PRIMARY KEY (`id_training`),
  ADD KEY `coach_id` (`coach_id`),
  ADD KEY `fk_user_prog_training` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`info_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `weight_track`
--
ALTER TABLE `weight_track`
  ADD PRIMARY KEY (`id_track`),
  ADD KEY `fk_weight_user` (`user_id`),
  ADD KEY `fk_weight_sub` (`id_subscription`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coach_account`
--
ALTER TABLE `coach_account`
  MODIFY `coach_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coach_price`
--
ALTER TABLE `coach_price`
  MODIFY `id_price` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `id_exercise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nutrition`
--
ALTER TABLE `nutrition`
  MODIFY `id_nutrition` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `nutrition_food`
--
ALTER TABLE `nutrition_food`
  MODIFY `id_food` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `nutrition_training_program`
--
ALTER TABLE `nutrition_training_program`
  MODIFY `id_train_prog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id_subscription` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `training_program`
--
ALTER TABLE `training_program`
  MODIFY `id_training` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `weight_track`
--
ALTER TABLE `weight_track`
  MODIFY `id_track` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coach_account`
--
ALTER TABLE `coach_account`
  ADD CONSTRAINT `coach_account_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `coach_price`
--
ALTER TABLE `coach_price`
  ADD CONSTRAINT `fk_coach_price_coach_id` FOREIGN KEY (`coach_id`) REFERENCES `coach_account` (`coach_id`);

--
-- Constraints for table `exercice_training_program`
--
ALTER TABLE `exercice_training_program`
  ADD CONSTRAINT `exercice_training_program_ibfk_1` FOREIGN KEY (`id_training`) REFERENCES `training_program` (`id_training`) ON DELETE CASCADE,
  ADD CONSTRAINT `exercice_training_program_ibfk_2` FOREIGN KEY (`id_exercice`) REFERENCES `exercises` (`id_exercise`);

--
-- Constraints for table `exercises`
--
ALTER TABLE `exercises`
  ADD CONSTRAINT `fk_ex_coach` FOREIGN KEY (`coach_id`) REFERENCES `coach_account` (`coach_id`) ON DELETE CASCADE;

--
-- Constraints for table `nutrition`
--
ALTER TABLE `nutrition`
  ADD CONSTRAINT `nutrition_ibfk_1` FOREIGN KEY (`coach_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `nutrition_food`
--
ALTER TABLE `nutrition_food`
  ADD CONSTRAINT `nutrition_food_ibfk_1` FOREIGN KEY (`id_nutrition`) REFERENCES `nutrition` (`id_nutrition`) ON DELETE CASCADE;

--
-- Constraints for table `nutrition_training_program`
--
ALTER TABLE `nutrition_training_program`
  ADD CONSTRAINT `nutrition_training_program_ibfk_1` FOREIGN KEY (`id_training`) REFERENCES `training_program` (`id_training`) ON DELETE CASCADE,
  ADD CONSTRAINT `nutrition_training_program_ibfk_2` FOREIGN KEY (`id_nutrition`) REFERENCES `nutrition` (`id_nutrition`);

--
-- Constraints for table `subscription`
--
ALTER TABLE `subscription`
  ADD CONSTRAINT `fk_sub_coach` FOREIGN KEY (`coach_id`) REFERENCES `coach_account` (`coach_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_sub_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `training_program`
--
ALTER TABLE `training_program`
  ADD CONSTRAINT `fk_user_prog_training` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `training_program_ibfk_1` FOREIGN KEY (`coach_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `weight_track`
--
ALTER TABLE `weight_track`
  ADD CONSTRAINT `fk_weight_sub` FOREIGN KEY (`id_subscription`) REFERENCES `subscription` (`id_subscription`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_weight_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
