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
-- Table structure for table `estado_ot`
--

DROP TABLE IF EXISTS `estado_ot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado_ot` (
  `k_id_estado_ot` int(11) NOT NULL AUTO_INCREMENT,
  `k_id_tipo` int(11) DEFAULT NULL,
  `n_name_estado_ot` varchar(100) NOT NULL,
  PRIMARY KEY (`k_id_estado_ot`),
  KEY `fk_estado_tipo_ot` (`k_id_tipo`),
  CONSTRAINT `fk_estado_tipo_ot` FOREIGN KEY (`k_id_tipo`) REFERENCES `tipo_ot_hija` (`k_id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_ot`
--

LOCK TABLES `estado_ot` WRITE;
/*!40000 ALTER TABLE `estado_ot` DISABLE KEYS */;
INSERT INTO `estado_ot` VALUES (1,1,'Generada'),(2,1,'Cancelada'),(3,1,'Cerrada'),(4,2,'Generada'),(5,2,'Gestión VOC'),(6,2,'OBRA CIVIL Gestión SIAO'),(7,2,'OBRA CIVIL Cotización'),(8,2,'OBRA CIVIL Envío Cot'),(9,2,'OBRA CIVIL Aprobación Cliente'),(10,2,'OBRA CIVIL Devolución'),(11,2,'OBRA CIVIL Factibit'),(12,2,'Cancelada'),(13,2,'Cerrada'),(14,3,'CONF.Ing de Detalle/plan Técnico'),(15,3,'PSR'),(16,3,'CONF.Configuración de Servicios'),(17,3,'Cancelada'),(18,3,'Cerrada'),(19,4,'INST.PLANTA Gestión SIAO'),(20,4,'INST.PLANTA Tendido Interno OC'),(21,4,'INST.PLANTA Envío Instalación'),(22,4,'Cancelada'),(23,4,'Cerrada'),(24,5,'Generada'),(25,5,'Pendiente Cliente'),(26,5,'Problema Ejecu. OC'),(27,5,'Problema VOC'),(28,5,'Terminada'),(29,5,'Cancelada'),(30,5,'Cerrada'),(31,6,'Generada'),(32,6,'En ejecución'),(33,6,'Terminada'),(34,6,'Cancelada'),(35,6,'Cerrada'),(36,7,'Gestión SIAO'),(37,7,'INST.PLANTA Replanteo'),(38,7,'Apto.Arriendo Infraestr'),(39,7,'INST.PLANTA Ruta'),(40,7,'Terminada'),(41,7,'Cancelada'),(42,7,'Cerrada'),(43,8,'Instalación Terceros GP'),(44,8,'Instalación Terceros Tend Externo'),(45,8,'Instalación Terceros Envió Instalación'),(46,8,'Terminada'),(47,8,'Cancelada'),(48,8,'Cerrada'),(49,9,'EQUIPOS Solicitud'),(50,9,'EQUIPOS Gestión SIAO'),(51,9,'Reserva Equ.Estándar'),(52,9,'Reserva Equ.No Estándar'),(53,9,'Gest.Comp.Estándar'),(54,9,'Gest.Comp.No-Estándar'),(55,9,'Asignación-Legalización.Eq'),(56,9,'EQUIPOS.Verificar Equipos'),(57,9,'EQUIPOS.Salida Equipos'),(58,9,'Cancelada'),(59,9,'Cerrada'),(60,10,'Visita.Cliente Gestión'),(61,10,'Visita.Cliente Planeación y Asignación'),(62,10,'Gestion Permisos'),(63,10,'Visita.Cliente Ejecución Contratista'),(64,10,'Entrega.Cliente'),(65,10,'Cancelada'),(66,10,'Cerrada'),(67,11,'Visita.Cliente Gestión'),(68,11,'Visita.Cliente Planeación y Asignación'),(69,11,'Gestión Permisos'),(70,11,'Visita.Cliente Ejecución Contratista'),(71,11,'Entrega Cliente'),(72,11,'Cancelada'),(73,11,'Cerrada');
/*!40000 ALTER TABLE `estado_ot` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-05 10:24:15
