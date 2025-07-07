-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: siscardapio
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `avaliacao_cafe`
--

DROP TABLE IF EXISTS `avaliacao_cafe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `avaliacao_cafe` (
  `id_avaliacao` int(11) NOT NULL AUTO_INCREMENT,
  `id_cardapio` int(11) NOT NULL,
  `id_questao` int(11) NOT NULL,
  `nota_avaliacao` tinyint(4) DEFAULT NULL CHECK (`nota_avaliacao` between 1 and 4),
  `data_avaliacao` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id_avaliacao`),
  KEY `id_cardapio` (`id_cardapio`),
  KEY `id_questao` (`id_questao`),
  CONSTRAINT `avaliacao_cafe_ibfk_1` FOREIGN KEY (`id_cardapio`) REFERENCES `cardapio_cafe` (`id_cardapio`),
  CONSTRAINT `avaliacao_cafe_ibfk_2` FOREIGN KEY (`id_questao`) REFERENCES `questoes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avaliacao_cafe`
--

LOCK TABLES `avaliacao_cafe` WRITE;
/*!40000 ALTER TABLE `avaliacao_cafe` DISABLE KEYS */;
INSERT INTO `avaliacao_cafe` VALUES (2,6,8,3,'2025-05-19 00:00:00'),(3,6,8,3,'2025-05-19 00:00:00'),(4,6,8,3,'2025-05-19 00:00:00'),(5,6,8,3,'2025-05-19 00:00:00'),(6,6,8,3,'2025-05-19 00:00:00'),(7,6,8,3,'2025-05-19 00:00:00'),(8,6,8,2,'2025-05-19 00:00:00'),(9,6,8,1,'2025-05-19 00:00:00'),(10,6,9,3,'2025-05-19 00:00:00'),(11,6,8,4,'2025-05-19 00:00:00'),(12,6,8,1,'2025-05-19 00:00:00'),(13,6,8,2,'2025-05-19 00:00:00'),(14,6,8,3,'2025-05-19 00:00:00'),(15,6,8,4,'2025-05-19 00:00:00'),(16,6,9,1,'2025-05-19 00:00:00'),(17,6,9,2,'2025-05-19 00:00:00'),(18,6,9,3,'2025-05-19 00:00:00'),(19,6,9,4,'2025-05-19 00:00:00'),(20,7,8,4,'2025-05-22 00:00:00'),(21,7,8,4,'2025-05-22 00:00:00'),(22,7,9,4,'2025-05-22 00:00:00'),(23,7,8,4,'2025-05-22 00:00:00'),(24,7,8,4,'2025-05-22 00:00:00'),(25,7,9,4,'2025-05-22 00:00:00');
/*!40000 ALTER TABLE `avaliacao_cafe` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-22 20:02:23
