-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server versie:                10.4.24-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Versie:              12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Databasestructuur van random_meuk wordt geschreven
CREATE DATABASE IF NOT EXISTS `random_meuk` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `random_meuk`;

-- Structuur van  tabel random_meuk.store wordt geschreven
CREATE TABLE IF NOT EXISTS `store` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `img` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

-- Dumpen data van tabel random_meuk.store: ~3 rows (ongeveer)
REPLACE INTO `store` (`id`, `name`, `price`, `img`) VALUES
	(14, 'Schroevendraaier', '10', 'IMG-64275c04195ce1.25075450.png'),
	(15, 'Yamaha R6', '25000', 'IMG-64275c1ab7c913.93440604.png'),
	(16, 'BMW I8', '65000', 'IMG-64275c25889622.69683180.png');

-- Structuur van  tabel random_meuk.users wordt geschreven
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firtsname` varchar(100) NOT NULL DEFAULT '0',
  `lastname` varchar(100) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL DEFAULT '0',
  `password` varchar(100) NOT NULL DEFAULT '0',
  `is_admin` binary(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Dumpen data van tabel random_meuk.users: ~0 rows (ongeveer)
REPLACE INTO `users` (`id`, `firtsname`, `lastname`, `email`, `password`, `is_admin`) VALUES
	(5, 'Julian', 'Berle', 'berlejulian@gmail.com', '$2y$10$huRhYJRW4TB/TemnGUh1tuXtHLLJzGJUoc1e9X6xQc3CetWEtAjlS', _binary 0x31),
	(10, 'Henkj', 'Jansenq', '12@12.nl', '$2y$10$ShxRo41mzrBBalgGMqSRae5eVMO.RYK9OhdP7fg0vunAiQlo2DgO.', _binary 0x30);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
