-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: 10.200.192.240    Database: siscardapio
-- ------------------------------------------------------
-- Server version	5.5.5-10.11.13-MariaDB

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
-- Table structure for table `cardapio_cafe`
--

DROP TABLE IF EXISTS `cardapio_cafe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cardapio_cafe` (
  `id_cardapio` int(11) NOT NULL AUTO_INCREMENT,
  `data_cardapio` date NOT NULL,
  `id_cafe` int(11) NOT NULL,
  `id_complemento` int(11) NOT NULL,
  `id_agente_fiscal` int(11) DEFAULT NULL,
  `id_nutricionista` int(11) DEFAULT NULL,
  `id_gestor_munic` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cardapio`),
  UNIQUE KEY `data_cardapio` (`data_cardapio`,`id_cafe`,`id_complemento`),
  KEY `id_cafe` (`id_cafe`),
  KEY `id_complemento` (`id_complemento`),
  KEY `fk_cafe_agente_fiscal` (`id_agente_fiscal`),
  KEY `fk_cafe_nutricionista` (`id_nutricionista`),
  KEY `fk_cafe_gestor_munic` (`id_gestor_munic`),
  CONSTRAINT `cardapio_cafe_ibfk_1` FOREIGN KEY (`id_cafe`) REFERENCES `cafe` (`id_cafe`),
  CONSTRAINT `cardapio_cafe_ibfk_2` FOREIGN KEY (`id_complemento`) REFERENCES `complemento` (`id_complemento`),
  CONSTRAINT `fk_cafe_agente_fiscal` FOREIGN KEY (`id_agente_fiscal`) REFERENCES `agentes_fiscais` (`id_agente_fiscal`),
  CONSTRAINT `fk_cafe_gestor_munic` FOREIGN KEY (`id_gestor_munic`) REFERENCES `gestores_munic` (`id_gestor_munic`),
  CONSTRAINT `fk_cafe_nutricionista` FOREIGN KEY (`id_nutricionista`) REFERENCES `nutricionistas` (`id_nutricionista`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cardapio_cafe`
--

LOCK TABLES `cardapio_cafe` WRITE;
/*!40000 ALTER TABLE `cardapio_cafe` DISABLE KEYS */;
INSERT INTO `cardapio_cafe` VALUES (2,'2025-05-05',1,1,2,1,1),(3,'2025-04-21',1,1,2,1,1),(4,'2025-05-06',1,1,2,1,1),(5,'2025-05-14',1,2,2,1,1),(6,'2025-05-19',1,4,2,1,1),(7,'2025-05-22',1,3,2,1,1),(8,'2025-05-23',1,4,2,1,1);
/*!40000 ALTER TABLE `cardapio_cafe` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-30 10:21:09
