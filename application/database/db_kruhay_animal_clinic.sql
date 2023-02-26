-- -------------------------------------------------------------
-- TablePlus 4.8.2(436)
--
-- https://tableplus.com/
--
-- Database: db_kruhay_animal_clinic
-- Generation Time: 2022-09-26 07:58:50.0630
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `short_desc` text,
  `long_desc` text,
  `file_name` varchar(500) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `quantity` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_created_at_updated_at_index` (`created_at`,`updated_at`) USING BTREE,
  KEY `products_name_index` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `short_desc` text,
  `long_desc` text,
  `amount` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `services_created_at_updated_at_index` (`created_at`,`updated_at`) USING BTREE,
  KEY `services_name_index` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) DEFAULT NULL,
  `schedule_date` varchar(255) DEFAULT NULL,
  `schedule_time` varchar(255) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `payment_method` varchar(100) DEFAULT NULL,
  `service_type` varchar(255) DEFAULT NULL,
  `address` text,
  `payment_id` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reservations_user_id_index` (`user_id`) USING BTREE,
  KEY `reservations_status_index` (`status`) USING BTREE,
  KEY `reservations_created_at_updated_at_index` (`created_at`,`updated_at`) USING BTREE,
  KEY `reservations_service_type_index` (`service_type`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(45) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `is_active` varchar(50) DEFAULT NULL,
  `role_type` varchar(100) DEFAULT NULL,
  `address` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `users_is_active_index` (`is_active`) USING BTREE,
  KEY `users_role_type_index` (`role_type`) USING BTREE,
  KEY `users_created_at_index` (`created_at`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `feedbacks`;
CREATE TABLE `feedbacks` ( 
  `id` int(11) NOT NULL AUTO_INCREMENT , 
  `name` VARCHAR(255) NOT NULL, 
  `mobile_number` VARCHAR(255) NOT NULL, 
  `email` VARCHAR(255) NOT NULL, 
  `subject` VARCHAR(255) NOT NULL, 
  `message` LONGTEXT NOT NULL, 
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (`id`)) ENGINE = InnoDB;

INSERT INTO `users` (`user_id`, `username`, `first_name`, `last_name`, `email`, `contact_number`, `password`, `is_active`, `role_type`, `address`, `created_at`) VALUES
(1, 'admin', 'Admin', 'Admin', 'admin.kruhayclinic@gmail.com', '09999999999', '$2y$10$vxxd8xOgEyqQUoKw0BtB1eJ461VqWVxn1q4daZiFhmmS/JZrPi.7m', '1', 'SUPER_ADMIN', NULL, '2019-07-20 10:38:15');

INSERT INTO `services` (`id`, `name`, `short_desc`, `long_desc`, `amount`, `created_at`, `updated_at`) VALUES
(1, 'Grooming', 'Grooming', '', '400.00', '2023-01-09 22:16:52', NULL),
(2, '24hrs on Emergency Cases', '24hrs on Emergency Cases', '', '400.00', '2023-01-09 22:19:21', NULL),
(3, 'Vaccination', 'Vaccination', '', '400.00', '2023-01-09 22:20:18', NULL),
(4, 'Laboratory', 'Laboratory', '', '400.00', '2023-01-09 22:20:37', NULL),
(5, 'Diagnosis', 'Diagnosis', '', '400.00', '2023-01-09 22:20:57', NULL),
(6, 'Confinement', 'Confinement', '', '400.00', '2023-01-09 22:21:15', NULL),
(7, 'Boarding', 'Boarding', '', '400.00', '2023-01-09 22:21:30', NULL),
(8, 'Heartworm Shots', 'Heartworm Shots', '', '400.00', '2023-01-09 22:23:58', NULL),
(9, 'Castration/Spaying', 'Castration/Spaying', '', '400.00', '2023-01-09 22:24:30', NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;