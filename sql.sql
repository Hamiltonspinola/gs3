-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.32-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando estrutura para tabela gs3.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reference` (`reference`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela gs3.product: ~13 rows (aproximadamente)
DELETE FROM `product`;
INSERT INTO `product` (`id`, `name`, `reference`, `price`) VALUES
	(1, 'Leite em pó', 'REFLP150620241443', 7.99),
	(2, 'Nescau', 'REFN150620241443REFLP150620241444', 17.99),
	(3, 'Produto 1', 'REF001', 10),
	(4, 'Produto 2', 'REF002', 20),
	(5, 'Produto 3', 'REF003', 30),
	(6, 'Produto 4', 'REF004', 40),
	(7, 'Produto 5', 'REF005', 50),
	(8, 'Produto 6', 'REF006', 60),
	(9, 'Produto 7', 'REF007', 70),
	(10, 'Produto 8', 'REF008', 80),
	(11, 'Produto 9', 'REF009', 90),
	(12, 'Produto 10', 'REF0010', 100),
	(13, 'Produto 11', 'REF0011', 110);

-- Copiando estrutura para tabela gs3.product_historic
CREATE TABLE IF NOT EXISTS `product_historic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `start_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK___product` (`product_id`),
  CONSTRAINT `FK___product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela gs3.product_historic: ~0 rows (aproximadamente)
DELETE FROM `product_historic`;

-- Copiando estrutura para tabela gs3.product_sale
CREATE TABLE IF NOT EXISTS `product_sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id`),
  KEY `FK__sale__product_sale` (`sale_id`),
  KEY `FK___product_product_sale` (`product_id`),
  CONSTRAINT `FK___product_product_sale` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK__sale__product_sale` FOREIGN KEY (`sale_id`) REFERENCES `sale` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela gs3.product_sale: ~0 rows (aproximadamente)
DELETE FROM `product_sale`;

-- Copiando estrutura para tabela gs3.product_supplier
CREATE TABLE IF NOT EXISTS `product_supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__product` (`product_id`),
  KEY `FK__supplier` (`supplier_id`),
  CONSTRAINT `FK__product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__supplier` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela gs3.product_supplier: ~10 rows (aproximadamente)
DELETE FROM `product_supplier`;
INSERT INTO `product_supplier` (`id`, `product_id`, `supplier_id`) VALUES
	(1, 1, 1),
	(2, 2, 2),
	(3, 3, 3),
	(4, 5, 4),
	(5, 6, 1),
	(6, 7, 2),
	(7, 8, 3),
	(8, 9, 4),
	(9, 10, 1),
	(10, 11, 2);

-- Copiando estrutura para tabela gs3.sale
CREATE TABLE IF NOT EXISTS `sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `delivery` date NOT NULL,
  `address` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela gs3.sale: ~0 rows (aproximadamente)
DELETE FROM `sale`;

-- Copiando estrutura para tabela gs3.supplier
CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela gs3.supplier: ~4 rows (aproximadamente)
DELETE FROM `supplier`;
INSERT INTO `supplier` (`id`, `name`) VALUES
	(1, 'Nestlé'),
	(2, 'Sadia'),
	(3, 'Perdigão'),
	(4, 'Colgate');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
