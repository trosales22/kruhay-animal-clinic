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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) DEFAULT NULL,
  `schedule_date` varchar(255) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `products` (`id`, `name`, `short_desc`, `long_desc`, `file_name`, `amount`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 'Product #1', 'Product #1 Desc', 'Product #1 Desc', '1663170207_9920.jpeg', '200.00', '50', '2022-09-14 23:43:27', NULL),
(2, 'Product #2', 'Product #2 Desc', 'Product #2 Desc', '1663208782_8580.jpeg', '200.00', '200', '2022-09-15 10:26:22', NULL);

INSERT INTO `users` (`user_id`, `username`, `first_name`, `last_name`, `email`, `contact_number`, `password`, `is_active`, `role_type`, `address`, `created_at`) VALUES
(1, 'admin', 'Admin', 'Admin', 'admin.kruhayclinic@gmail.com', '09999999999', '$2y$10$vxxd8xOgEyqQUoKw0BtB1eJ461VqWVxn1q4daZiFhmmS/JZrPi.7m', '1', 'SUPER_ADMIN', NULL, '2019-07-20 10:38:15'),
(3, NULL, 'Tristan', 'Rosales', 'tristanrosales0@gmail.com', '09675281187', '$2y$10$WqhR6I6qC0Yxt9XTMyEK0eOKdOyv5VN7XzscPYQzfkVPkbIQt49eW', '1', 'CLIENT', '', '2022-09-18 23:01:10');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;