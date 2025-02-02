-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               11.4.4-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for wine_db
CREATE DATABASE IF NOT EXISTS `wine_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `wine_db`;

-- Dumping structure for table wine_db.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `adm_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `code` varchar(222) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`adm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wine_db.admin: ~2 rows (approximately)
INSERT INTO `admin` (`adm_id`, `username`, `password`, `email`, `code`, `date`) VALUES
	(1, 'ccbd', '0d89ec971a7bcfe26d68c177a9d53334', 'admin@gmail.com', '', '2023-02-22 07:18:13'),
	(3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin1@example.com', NULL, '2025-01-31 17:05:38');

-- Dumping structure for table wine_db.remark
CREATE TABLE IF NOT EXISTS `remark` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `frm_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `remark` longtext NOT NULL,
  `remarkDate` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wine_db.remark: ~4 rows (approximately)
INSERT INTO `remark` (`id`, `frm_id`, `status`, `remark`, `remarkDate`) VALUES
	(16, 23, 'in process', '.', '2025-01-24 12:04:31'),
	(17, 29, 'in process', 'Este in curs de livrare', '2025-02-02 09:39:11'),
	(18, 30, 'in process', 'Este in curs de livrare', '2025-02-02 09:39:31'),
	(19, 31, 'in process', 'Este in curs de livrare', '2025-02-02 09:39:57');

-- Dumping structure for table wine_db.services
CREATE TABLE IF NOT EXISTS `services` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `title` varchar(222) NOT NULL,
  `image` text DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wine_db.services: ~3 rows (approximately)
INSERT INTO `services` (`service_id`, `c_id`, `title`, `image`, `date`) VALUES
	(2, 1, 'Produse de Vinuri', '679e30593e9d1.jpg', '2025-02-01 14:31:53'),
	(3, 4, 'Servicii Alimentare', '679e312640c80.jpg', '2025-02-01 14:35:18'),
	(4, 5, 'Servicii Turistice', '679e321ece781.jpg', '2025-02-01 14:39:26');

-- Dumping structure for table wine_db.service_cat
CREATE TABLE IF NOT EXISTS `service_cat` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`c_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wine_db.service_cat: ~3 rows (approximately)
INSERT INTO `service_cat` (`c_id`, `c_name`, `date`) VALUES
	(1, 'Vinuri', '2025-01-28 17:31:49'),
	(4, 'Alimentare', '2025-02-02 12:08:56'),
	(5, 'Turism', '2025-02-01 15:52:18');

-- Dumping structure for table wine_db.tourism
CREATE TABLE IF NOT EXISTS `tourism` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `slogan` varchar(500) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `img` text DEFAULT NULL,
  `pers_count` int(11) DEFAULT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wine_db.tourism: ~1 rows (approximately)
INSERT INTO `tourism` (`t_id`, `service_id`, `title`, `slogan`, `price`, `img`, `pers_count`) VALUES
	(1, 4, 'Degustare', 'Oferim oportunitatea de a veni în compania de prieteni şi de a degusta vinurile produse de noi. La o grupă de mai mult de 8 persoane, -8% din preţ.', 2000, '679f37c03fcf4.jpg', 12);

-- Dumping structure for table wine_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(222) NOT NULL,
  `f_name` varchar(222) NOT NULL,
  `l_name` varchar(222) NOT NULL,
  `email` varchar(222) DEFAULT NULL,
  `phone` varchar(222) DEFAULT NULL,
  `password` varchar(222) NOT NULL,
  `address` mediumtext NOT NULL,
  `order_count` int(11) DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wine_db.users: ~1 rows (approximately)
INSERT INTO `users` (`u_id`, `username`, `f_name`, `l_name`, `email`, `phone`, `password`, `address`, `order_count`, `status`, `date`) VALUES
	(9, 'test', 'testt', 'testt', 'test@gmail.com', '373787878777', '8287458823facb8ff918dbfabcd22ccb', 'Cahul, Cahul', 0, 1, '2025-02-02 11:43:15');

-- Dumping structure for table wine_db.users_orders
CREATE TABLE IF NOT EXISTS `users_orders` (
  `o_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `title` varchar(222) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` varchar(222) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`o_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wine_db.users_orders: ~2 rows (approximately)
INSERT INTO `users_orders` (`o_id`, `u_id`, `title`, `quantity`, `price`, `status`, `date`) VALUES
	(53, 9, 'Merlott', 1, 20.00, NULL, '2025-02-02 11:42:40'),
	(54, 9, 'Cabernet Sauvignon', 1, 25.00, NULL, '2025-02-02 11:42:40');

-- Dumping structure for table wine_db.wines
CREATE TABLE IF NOT EXISTS `wines` (
  `w_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `title` varchar(222) DEFAULT NULL,
  `slogan` varchar(222) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `img` text DEFAULT NULL,
  PRIMARY KEY (`w_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wine_db.wines: ~2 rows (approximately)
INSERT INTO `wines` (`w_id`, `service_id`, `title`, `slogan`, `year`, `price`, `img`) VALUES
	(2, 2, 'Merlott', 'Un vin rotund, cu taninuri fine și arome de cireșe și prune.', NULL, 20, '67992678a42b7.jpg'),
	(3, 2, 'Cabernet Sauvignon', 'Un vin clasic, cu note de coacăze și un postgust persistent.', NULL, 25, '679b8ed1da30d.jpg');

-- Dumping structure for table wine_db.wine_category
CREATE TABLE IF NOT EXISTS `wine_category` (
  `wcat_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`wcat_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wine_db.wine_category: ~4 rows (approximately)
INSERT INTO `wine_category` (`wcat_id`, `c_name`, `date`) VALUES
	(1, 'Roșu', '2025-01-28 16:33:14'),
	(2, 'Alb', '2025-01-28 16:33:57'),
	(3, 'Rose', '2025-01-28 16:34:00'),
	(4, 'Spumant', '2025-01-28 16:34:09');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
