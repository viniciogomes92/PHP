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
-- Table structure for table `cardapio_jantar`
--

DROP TABLE IF EXISTS `cardapio_jantar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cardapio_jantar` (
  `id_cardapio` int(11) NOT NULL AUTO_INCREMENT,
  `data_cardapio` date NOT NULL,
  `id_entrada` int(11) DEFAULT NULL,
  `id_prato_principal` int(11) DEFAULT NULL,
  `id_guarnicao` int(11) DEFAULT NULL,
  `id_acompanhamento` int(11) DEFAULT NULL,
  `id_sobremesa` int(11) DEFAULT NULL,
  `id_agente_fiscal` int(11) DEFAULT NULL,
  `id_nutricionista` int(11) DEFAULT NULL,
  `id_gestor_munic` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cardapio`),
  KEY `id_entrada` (`id_entrada`),
  KEY `id_prato_principal` (`id_prato_principal`),
  KEY `id_guarnicao` (`id_guarnicao`),
  KEY `id_acompanhamento` (`id_acompanhamento`),
  KEY `id_sobremesa` (`id_sobremesa`),
  KEY `fk_jantar_agente_fiscal` (`id_agente_fiscal`),
  KEY `fk_jantar_nutricionista` (`id_nutricionista`),
  KEY `fk_jantar_gestor_munic` (`id_gestor_munic`),
  CONSTRAINT `cardapio_jantar_ibfk_1` FOREIGN KEY (`id_entrada`) REFERENCES `entrada` (`id_entrada`),
  CONSTRAINT `cardapio_jantar_ibfk_2` FOREIGN KEY (`id_prato_principal`) REFERENCES `prato_principal` (`id_prato_principal`),
  CONSTRAINT `cardapio_jantar_ibfk_3` FOREIGN KEY (`id_guarnicao`) REFERENCES `guarnicao` (`id_guarnicao`),
  CONSTRAINT `cardapio_jantar_ibfk_4` FOREIGN KEY (`id_acompanhamento`) REFERENCES `acompanhamento` (`id_acompanhamento`),
  CONSTRAINT `cardapio_jantar_ibfk_5` FOREIGN KEY (`id_sobremesa`) REFERENCES `sobremesa` (`id_sobremesa`),
  CONSTRAINT `fk_jantar_agente_fiscal` FOREIGN KEY (`id_agente_fiscal`) REFERENCES `agentes_fiscais` (`id_agente_fiscal`),
  CONSTRAINT `fk_jantar_gestor_munic` FOREIGN KEY (`id_gestor_munic`) REFERENCES `gestores_munic` (`id_gestor_munic`),
  CONSTRAINT `fk_jantar_nutricionista` FOREIGN KEY (`id_nutricionista`) REFERENCES `nutricionistas` (`id_nutricionista`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cardapio_jantar`
--

LOCK TABLES `cardapio_jantar` WRITE;
/*!40000 ALTER TABLE `cardapio_jantar` DISABLE KEYS */;
INSERT INTO `cardapio_jantar` VALUES (1,'2025-05-06',6,8,6,2,2,2,1,1),(2,'2025-05-14',6,8,3,2,5,2,1,1),(3,'2025-05-19',5,9,3,2,6,2,1,1),(4,'2025-05-22',3,6,3,2,5,2,1,1),(5,'2025-05-23',8,9,6,2,3,2,1,1),(6,'2025-06-05',4,7,1,2,5,NULL,NULL,NULL);
/*!40000 ALTER TABLE `cardapio_jantar` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-30 10:21:10
