-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: telmex_vip
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tipo_ot_hija`
--

DROP TABLE IF EXISTS `tipo_ot_hija`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_ot_hija` (
  `k_id_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `n_name_tipo` varchar(100) NOT NULL,
  `i_referencia` int(11) DEFAULT NULL,
  PRIMARY KEY (`k_id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_ot_hija`
--

LOCK TABLES `tipo_ot_hija` WRITE;
/*!40000 ALTER TABLE `tipo_ot_hija` DISABLE KEYS */;
INSERT INTO `tipo_ot_hija` VALUES (1,'Kickoff - NCV',NULL),(2,'Obra Civil (VOC)-NCV',NULL),(3,'Configuración-NCV',NULL),(4,'Tendido Interno',NULL),(5,'Seg. Condiciones Cliente-NCV',NULL),(6,'Gestion Permisos-NCV',NULL),(7,'Tendido Externo-NCV',NULL),(8,'Instalación UM Terceros',NULL),(9,'Equipos-NCV',NULL),(10,'Entrega de Servicio Ins',NULL),(11,'Actividad Previa Ins',NULL),(12,'Escalamiento Interno',NULL),(13,'KickOff',1),(14,'KickOff Novedades',1),(15,'Obra Civil (VOC)',2),(16,'Obra Civil PC-NCV',2),(17,'Obra Civil Pymes',2),(18,'Configuración',3),(19,'Configuración Internet',3),(20,'Configuración Internet-NCV',3),(21,'Configuración RAS',3),(22,'Configuración Servicio(Fibra)',3),(23,'Confirmación Cliente Pymes',3),(24,'EOC y Tendido',4),(25,'EOC y Tendido NCV',4),(26,'Seg. Cond. Cliente',5),(27,'Seg. Cond. Cliente-NCV',5),(28,'Gestion Permisos',6),(29,'Gestion Permisos CT',6),(30,'Gestión Permisos Pymes',6),(31,'Diseño y empalmeria',7),(32,'Diseño y empalmeria-NCVl',7),(33,'Reservados',9),(34,'Equipos...',9),(35,'Escalamiento Core IP',12),(36,'Escalamiento Core Telefonía',12),(37,'Habilitación END',12),(38,'Habilitación Final',12);
/*!40000 ALTER TABLE `tipo_ot_hija` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-05 10:24:17
