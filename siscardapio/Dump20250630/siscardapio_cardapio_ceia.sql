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
-- Table structure for table `cardapio_ceia`
--

DROP TABLE IF EXISTS `cardapio_ceia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cardapio_ceia` (
  `id_cardapio` int(11) NOT NULL AUTO_INCREMENT,
  `data_cardapio` date NOT NULL,
  `id_ceia` int(11) DEFAULT NULL,
  `id_complemento_ceia` int(11) DEFAULT NULL,
  `id_agente_fiscal` int(11) DEFAULT NULL,
  `id_nutricionista` int(11) DEFAULT NULL,
  `id_gestor_munic` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cardapio`),
  KEY `id_ceia` (`id_ceia`),
  KEY `id_complemento_ceia` (`id_complemento_ceia`),
  KEY `fk_ceia_agente_fiscal` (`id_agente_fiscal`),
  KEY `fk_ceia_nutricionista` (`id_nutricionista`),
  KEY `fk_ceia_gestor_munic` (`id_gestor_munic`),
  CONSTRAINT `cardapio_ceia_ibfk_1` FOREIGN KEY (`id_ceia`) REFERENCES `ceia` (`id_ceia`),
  CONSTRAINT `cardapio_ceia_ibfk_2` FOREIGN KEY (`id_complemento_ceia`) REFERENCES `complemento_ceia` (`id_complemento_ceia`),
  CONSTRAINT `fk_ceia_agente_fiscal` FOREIGN KEY (`id_agente_fiscal`) REFERENCES `agentes_fiscais` (`id_agente_fiscal`),
  CONSTRAINT `fk_ceia_gestor_munic` FOREIGN KEY (`id_gestor_munic`) REFERENCES `gestores_munic` (`id_gestor_munic`),
  CONSTRAINT `fk_ceia_nutricionista` FOREIGN KEY (`id_nutricionista`) REFERENCES `nutricionistas` (`id_nutricionista`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cardapio_ceia`
--

LOCK TABLES `cardapio_ceia` WRITE;
/*!40000 ALTER TABLE `cardapio_ceia` DISABLE KEYS */;
INSERT INTO `cardapio_ceia` VALUES (9,'2025-05-22',2,2,NULL,NULL,NULL),(10,'2025-06-05',2,2,NULL,NULL,NULL);
/*!40000 ALTER TABLE `cardapio_ceia` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-30 10:21:11
