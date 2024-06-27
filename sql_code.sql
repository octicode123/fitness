-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 27, 2024 at 11:23 AM
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
  `country` varchar(20) NOT NULL CHECK (octet_length(`country`) > 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `nutrition`
--

CREATE TABLE `nutrition` (
  `id_nutrition` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `nutrition_food`
--

CREATE TABLE `nutrition_food` (
  `id_food` int(11) NOT NULL CHECK (`id_food` > 0),
  `id_nutrition` int(11) NOT NULL,
  `food_name` varchar(255) NOT NULL CHECK (octet_length(`food_name`) < 255),
  `weight` decimal(10,0) NOT NULL CHECK (`weight` >= 0),
  `kcal` decimal(10,0) NOT NULL CHECK (`kcal` >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `nutrition_training_program`
--

CREATE TABLE `nutrition_training_program` (
  `id_training` int(11) NOT NULL,
  `id_nutrition` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id_subscription` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `coach_id` int(11) DEFAULT NULL,
  `status` enum('pending','accepted','cancelled') DEFAULT NULL,
  `sub_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `training_program`
--

CREATE TABLE `training_program` (
  `id_training` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL CHECK (octet_length(`title`) > 0),
  `created_at` datetime NOT NULL,
  `duration` time NOT NULL CHECK (`duration` > '00:00:00')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `registration_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `user_info`
--
DELIMITER $$
CREATE TRIGGER `before_insert_user_info` BEFORE INSERT ON `user_info` FOR EACH ROW BEGIN
    IF NEW.registration_date > NOW() THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Registration date cannot be in the future';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `weight_track`
--

CREATE TABLE `weight_track` (
  `id_track` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `weight` decimal(10,0) NOT NULL CHECK (`weight` > 0),
  `img` varchar(255) DEFAULT NULL CHECK (char_length(`img`) <= 255),
  `track_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Indexes for table `exercice_training_program`
--
ALTER TABLE `exercice_training_program`
  ADD KEY `id_training` (`id_training`),
  ADD KEY `id_exercice` (`id_exercice`);

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`id_exercise`);

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
  ADD KEY `id_training` (`id_training`),
  ADD KEY `id_nutrition` (`id_nutrition`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id_subscription`);

--
-- Indexes for table `training_program`
--
ALTER TABLE `training_program`
  ADD PRIMARY KEY (`id_training`),
  ADD KEY `coach_id` (`coach_id`);

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
  ADD PRIMARY KEY (`id_track`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coach_account`
--
ALTER TABLE `coach_account`
  MODIFY `coach_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `id_exercise` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nutrition`
--
ALTER TABLE `nutrition`
  MODIFY `id_nutrition` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id_subscription` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `training_program`
--
ALTER TABLE `training_program`
  MODIFY `id_training` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `info_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `weight_track`
--
ALTER TABLE `weight_track`
  MODIFY `id_track` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coach_account`
--
ALTER TABLE `coach_account`
  ADD CONSTRAINT `coach_account_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `exercice_training_program`
--
ALTER TABLE `exercice_training_program`
  ADD CONSTRAINT `exercice_training_program_ibfk_1` FOREIGN KEY (`id_training`) REFERENCES `training_program` (`id_training`) ON DELETE CASCADE,
  ADD CONSTRAINT `exercice_training_program_ibfk_2` FOREIGN KEY (`id_exercice`) REFERENCES `exercises` (`id_exercise`);

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
-- Constraints for table `training_program`
--
ALTER TABLE `training_program`
  ADD CONSTRAINT `training_program_ibfk_1` FOREIGN KEY (`coach_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
