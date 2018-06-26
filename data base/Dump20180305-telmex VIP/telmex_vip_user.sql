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
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `k_id_user` int(11) NOT NULL AUTO_INCREMENT,
  `n_code_user` varchar(5) DEFAULT NULL,
  `n_name_user` varchar(150) NOT NULL,
  `n_last_name_user` varchar(150) NOT NULL,
  `n_username_user` varchar(100) NOT NULL,
  `n_mail_user` varchar(100) DEFAULT NULL,
  `i_phone_user` int(11) DEFAULT NULL,
  `i_cellphone_user` int(11) DEFAULT NULL,
  `n_password` varchar(30) DEFAULT NULL,
  `n_role_user` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`k_id_user`),
  UNIQUE KEY `n_code_user` (`n_code_user`),
  FULLTEXT KEY `n_name_user` (`n_name_user`,`n_last_name_user`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'ADM','administracion','administracion','administracion',NULL,NULL,NULL,'abc123','administrador'),(2,'CLARO','claro','claro','claro',NULL,NULL,NULL,'abc123','claro'),(3,'ING','ingeniero','ingeniero','ingeniero',NULL,NULL,NULL,'abc123','ingeniero'),(4,NULL,'Luis','Contreras','lcontreras',NULL,NULL,NULL,'abc123','ingeniero'),(5,NULL,'Cristian Alexander','Castillo','cacastillo',NULL,NULL,NULL,'abc123','ingeniero'),(6,NULL,'Marisol Jimenez','Hernandez','mjhernandez',NULL,NULL,NULL,'abc123','ingeniero'),(7,NULL,'Karen Alejandra','Ruiz Montoya','karuizm',NULL,NULL,NULL,'abc123','ingeniero'),(8,NULL,'Paula','Gomez','pgomez',NULL,NULL,NULL,'abc123','ingeniero'),(9,NULL,'Jonnathan Rodriguez','Chapeton','jrchapeton',NULL,NULL,NULL,'abc123','ingeniero'),(10,NULL,'Jisset','Suarez','jsuarez',NULL,NULL,NULL,'abc123','ingeniero'),(11,NULL,'Ana Karina','Buitrago','akbuitrago',NULL,NULL,NULL,'abc123','ingeniero'),(12,NULL,'Alexander Giovanny','Franco','agfranco',NULL,NULL,NULL,'abc123','ingeniero'),(13,NULL,'Harold Alberto','Gomez Rodriguez','hagomezr',NULL,NULL,NULL,'abc123','ingeniero'),(14,NULL,'Maria Carolina','Camacho','mccamacho',NULL,NULL,NULL,'abc123','ingeniero'),(15,NULL,'Melani','Viveros','mviveros',NULL,NULL,NULL,'abc123','ingeniero'),(16,NULL,'Fabio Nelson','Betancourt Bejara','fnbetancourtb',NULL,NULL,NULL,'abc123','ingeniero'),(17,NULL,'Edward Mauricio','Gonzales','emgonzales',NULL,NULL,NULL,'abc123','ingeniero'),(18,NULL,'Laura','Arenas','larenas',NULL,NULL,NULL,'abc123','ingeniero'),(19,NULL,'Angelica','Suarez','asuarez',NULL,NULL,NULL,'abc123','ingeniero'),(20,NULL,'Carol Milena','Guayazan Cardenas','cmguayazanc',NULL,NULL,NULL,'abc123','ingeniero');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
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
