-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: localhost	Database: kuntzece_project_management
-- ------------------------------------------------------
-- Server version 	8.0.34-0ubuntu0.20.04.1
-- Date: Wed, 06 Sep 2023 21:15:36 +0000

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40101 SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Project`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Project` (
  `project_id` tinyint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `user_id` smallint unsigned NOT NULL,
  PRIMARY KEY (`project_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `Project_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Project`
--

LOCK TABLES `Project` WRITE;
/*!40000 ALTER TABLE `Project` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `Project` VALUES (1,'example project',1),(3,'3s project',11),(4,'4s Project',12),(5,'5s Project',13),(6,'6s Project',14);
/*!40000 ALTER TABLE `Project` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `Project` with 5 row(s)
--

--
-- Table structure for table `Status`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Status` (
  `status_id` tinyint unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Status`
--

LOCK TABLES `Status` WRITE;
/*!40000 ALTER TABLE `Status` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `Status` VALUES (0,'ongoing'),(1,'priority'),(2,'working on');
/*!40000 ALTER TABLE `Status` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `Status` with 3 row(s)
--

--
-- Table structure for table `Task`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Task` (
  `task_id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `task` varchar(100) NOT NULL,
  `is_done` tinyint(1) NOT NULL DEFAULT '0',
  `status_id` tinyint unsigned DEFAULT '0',
  `project_id` tinyint unsigned NOT NULL,
  PRIMARY KEY (`task_id`),
  KEY `status_id` (`status_id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `Task_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `Status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Task_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `Project` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Task`
--

LOCK TABLES `Task` WRITE;
/*!40000 ALTER TABLE `Task` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `Task` VALUES (11,'make bank',1,1,1),(12,'Conduct market research',1,1,1),(13,'Design user interface',0,1,1),(14,'Test application functionality',0,1,1),(15,'Write project documentation',1,1,1),(16,'Review and finalize budget',0,1,1),(17,'Prepare project presentation',1,1,1),(18,'Conduct team training',1,1,1),(19,'Implement marketing strategy',0,1,1),(20,'Evaluate project risks',0,1,1),(53,'write english essay ',1,1,1),(54,'language techniques',1,2,1),(56,'aaa',1,0,1),(57,'',0,1,1),(58,'',1,0,1),(59,'wa',0,0,1),(60,'',0,0,1),(61,'aaaa',0,0,1),(62,'aaa',0,0,1),(63,'',0,0,1),(64,'blahhh',0,0,1),(65,'rfdfdfdf',0,0,6);
/*!40000 ALTER TABLE `Task` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `Task` with 22 row(s)
--

--
-- Table structure for table `User`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `user_id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(256) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `User` VALUES (1,'admin','$2y$10$NIOc2SXlLKarZsK9eXLRROaKjeNgq.Fcqgb8xnLT8i1T93CqA0utu'),(2,'wah','wah'),(9,'1','$2y$10$L.SrlbmdfiJfQAjgtF8.rORMHyhhXq6hLfHOiPevM9LbMLKmy1rxS'),(10,'2','$2y$10$kf7bq6ArjgmtTX7ylcOV1uGhjgMKxYj8Y3pOrbydPP6lwoOK00WvS'),(11,'3','$2y$10$fI9cIAnwHPIngGBl.CHrYeMgNFaddkOr1KPHmDMQDPmgqzwgbBvR6'),(12,'4','$2y$10$oZAhUdgYiTN4JGMX.vCMCeIu0/WAp86Gsc6RXWllMmNYwGo1mDFyi'),(13,'5','$2y$10$5OezRIn2m3F1.kHrklz6ru9HqKseRK.JwvkD4cbdCd88V0TygKhmu'),(14,'6','$2y$10$pThov7NsNKkkPlznKVpOEOxPhHm9J/9xfRIBLBFxzrOmbpvmdQgVG');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `User` with 8 row(s)
--

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET AUTOCOMMIT=@OLD_AUTOCOMMIT */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on: Wed, 06 Sep 2023 21:15:36 +0000
