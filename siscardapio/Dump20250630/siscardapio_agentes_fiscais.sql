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
-- Table structure for table `agentes_fiscais`
--

DROP TABLE IF EXISTS `agentes_fiscais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agentes_fiscais` (
  `id_agente_fiscal` int(11) NOT NULL AUTO_INCREMENT,
  `nip_agente_fiscal` varchar(45) NOT NULL,
  `posto_graduacao` varchar(50) NOT NULL,
  `corpo_quadro` varchar(45) NOT NULL,
  `esp` varchar(45) DEFAULT NULL,
  `nome_guerra` varchar(50) NOT NULL,
  `nome_agente_fiscal` varchar(100) NOT NULL,
  `email_agente_fiscal` varchar(100) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'A',
  `data_criacao` datetime NOT NULL,
  PRIMARY KEY (`id_agente_fiscal`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agentes_fiscais`
--

LOCK TABLES `agentes_fiscais` WRITE;
/*!40000 ALTER TABLE `agentes_fiscais` DISABLE KEYS */;
INSERT INTO `agentes_fiscais` VALUES (2,'13131770','3SG','CAP/QATP','PD','Silva Gomes','Vinício da Silva Gomes','vinicio.gomes@marinha.mil.br','I','2025-06-03 00:00:00'),(3,'11111111','3SG','','','Teste','Teste de Oliveira Teste','teste@teste.com','I','2025-06-03 00:00:00'),(4,'22222222','1T','','','Teste 2','Teste 2 de Oliveira Teste','teste@teste.com','I','2025-06-03 00:00:00'),(6,'55555555','CF','IM','','Teste','Teste de Oliveira Teste','teste@teste.com','A','2025-06-04 00:00:00');
/*!40000 ALTER TABLE `agentes_fiscais` ENABLE KEYS */;
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
