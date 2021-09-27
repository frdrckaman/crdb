-- MySQL dump 10.13  Distrib 8.0.26, for Linux (x86_64)
--
-- Host: localhost    Database: crdb
-- ------------------------------------------------------
-- Server version	8.0.26-0ubuntu0.20.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `crdb`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `crdb` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `crdb`;

--
-- Table structure for table `subscribers`
--

DROP TABLE IF EXISTS `subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscribers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `birthdate` varchar(12) DEFAULT NULL,
  `address` text,
  `phone_number` varchar(16) DEFAULT NULL,
  `email_address` varchar(80) DEFAULT NULL,
  `service_type` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `agent_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscribers`
--

LOCK TABLES `subscribers` WRITE;
/*!40000 ALTER TABLE `subscribers` DISABLE KEYS */;
INSERT INTO `subscribers` VALUES (1,'Fredrick Aman','2001-01-01','Sinza','0718652222','frdrckdeveloper@gmail.com',1,1,1),(2,'Fredrick Aman','2001-01-01','Sinza','0718652227','frdrck@gmail.com',2,0,1),(3,'Fredrick Aman','2001-01-01','Sinza','0718652224','aman@gmail.com',3,0,10);
/*!40000 ALTER TABLE `subscribers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `agent_code` varchar(12) DEFAULT NULL,
  `username` varchar(12) DEFAULT NULL,
  `comm_amount` varchar(14) DEFAULT NULL,
  `comm_acc` varchar(24) DEFAULT NULL,
  `acc_type` int DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `create_on` varchar(12) DEFAULT NULL,
  `last_login` varchar(20) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `power` int DEFAULT NULL,
  `phone_number` varchar(24) DEFAULT NULL,
  `email_address` varchar(80) DEFAULT NULL,
  `accessLevel` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `count` int DEFAULT NULL,
  `pswd` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Fredrick','FRD01','frdrck','1',NULL,NULL,'e7f1fd79b3ff57748a0dd77c00644a5dce7e744253e927009d813b7b25b450d8','jqbd1o9d3yzgfmssf25p9c332lmkabp2','2020-08-24','2021-09-27 12:05:56',1,1,NULL,'frdrckaman@gmail.com',1,1,0,1),(10,'Fredrick Aman','AM01','faman','1000','12345678',2,'1f432a43af482ace7167d849785485689ba2dff003e33f1df34a96a26f5e14fd','zhrmdr2g91oyzyh61koo5yxcnzk5p7ge','2021-09-27','2021-09-27 11:59:04',1,0,'0718652220','frdrckdeveloper@gmail.com',0,1,0,1);
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

-- Dump completed on 2021-09-27 12:27:19
