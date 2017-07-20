-- MySQL dump 10.16  Distrib 10.1.25-MariaDB, for osx10.6 (i386)
--
-- Host: localhost    Database: lpb
-- ------------------------------------------------------
-- Server version	10.1.25-MariaDB

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
-- Current Database: `lpb`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `lpb` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `lpb`;

--
-- Table structure for table `district`
--

DROP TABLE IF EXISTS `district`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `district` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_lao` varchar(255) NOT NULL,
  `name_eng` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_lao_UNIQUE` (`name_lao`),
  UNIQUE KEY `name_eng_UNIQUE` (`name_eng`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `district`
--

LOCK TABLES `district` WRITE;
/*!40000 ALTER TABLE `district` DISABLE KEYS */;
INSERT INTO `district` VALUES (1,'ຫຼວງພະບາງ','Luangprabang'),(2,'ນໍ້າບາກ','Nam Bak');
/*!40000 ALTER TABLE `district` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `language` varchar(16) NOT NULL,
  `translation` text,
  PRIMARY KEY (`id`,`language`),
  KEY `idx_message_language` (`language`),
  CONSTRAINT `fk_message_source_message` FOREIGN KEY (`id`) REFERENCES `source_message` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (1,'la-LA','ຜູ້ໃຊ້'),(2,'la-LA','ເພີ່ມ'),(3,'la-LA',NULL),(4,'la-LA',NULL),(5,'la-LA',NULL),(6,'la-LA',NULL),(7,'la-LA',NULL),(8,'la-LA',NULL),(9,'la-LA',NULL),(10,'la-LA',NULL),(11,'la-LA',NULL),(12,'la-LA','ສະຖານທີ່'),(13,'la-LA',NULL),(14,'la-LA',NULL),(15,'la-LA',NULL),(16,'la-LA',NULL),(17,'la-LA',NULL),(21,'la-LA',NULL),(22,'la-LA',NULL),(23,'la-LA',NULL),(24,'la-LA',NULL),(25,'la-LA',NULL),(26,'la-LA',NULL),(27,'la-LA',NULL),(28,'la-LA',NULL),(29,'la-LA',NULL),(30,'la-LA',NULL),(31,'la-LA',NULL),(32,'la-LA',NULL),(33,'la-LA',NULL),(34,'la-LA',NULL),(35,'la-LA',NULL),(36,'la-LA',NULL),(37,'la-LA',NULL),(38,'la-LA',NULL),(39,'la-LA',NULL),(40,'la-LA',NULL),(41,'la-LA',NULL),(42,'la-LA',NULL),(43,'la-LA',NULL),(44,'la-LA',NULL),(45,'la-LA',NULL),(46,'la-LA',NULL),(47,'la-LA',NULL),(48,'la-LA',NULL),(49,'la-LA',NULL),(50,'la-LA',NULL),(51,'la-LA',NULL),(52,'la-LA',NULL),(53,'la-LA',NULL),(56,'la-LA',NULL),(57,'la-LA',NULL),(58,'la-LA',NULL),(59,'la-LA',NULL);
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photo`
--

DROP TABLE IF EXISTS `photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `place_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_photo_place1_idx` (`place_id`),
  CONSTRAINT `fk_photo_place1` FOREIGN KEY (`place_id`) REFERENCES `place` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photo`
--

LOCK TABLES `photo` WRITE;
/*!40000 ALTER TABLE `photo` DISABLE KEYS */;
INSERT INTO `photo` VALUES (1,'201707121546117845.jpg',7),(3,'201707121546112678.jpg',7);
/*!40000 ALTER TABLE `photo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `place`
--

DROP TABLE IF EXISTS `place`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `place` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_lao` varchar(255) NOT NULL,
  `name_eng` varchar(255) NOT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lon` varchar(255) DEFAULT NULL,
  `village_lao` varchar(255) DEFAULT NULL,
  `village_eng` varchar(255) DEFAULT NULL,
  `description_lao` text,
  `description_eng` text,
  `district_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logo` varchar(255) DEFAULT NULL,
  `status` enum('Draft','Show','Deleted') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_lao_UNIQUE` (`name_lao`),
  UNIQUE KEY `name_eng_UNIQUE` (`name_eng`),
  KEY `fk_place_district_idx` (`district_id`),
  KEY `fk_place_user1_idx` (`user_id`),
  CONSTRAINT `fk_place_district` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_place_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `place`
--

LOCK TABLES `place` WRITE;
/*!40000 ALTER TABLE `place` DISABLE KEYS */;
INSERT INTO `place` VALUES (7,'sagsg','asgsdgdsg','19.922358302239935','102.17422485351562','sgasgasg','sagasgdsg','<p><strong>gdsfgdfhdfh</strong></p>\r\n','<p><strong>gdsfgdfhdfh</strong></p>\r\n',1,1,'2017-07-10 19:15:32','20170710191532404.jpg','Draft');
/*!40000 ALTER TABLE `place` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `source_message`
--

DROP TABLE IF EXISTS `source_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `source_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`id`),
  KEY `idx_source_message_category` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `source_message`
--

LOCK TABLES `source_message` WRITE;
/*!40000 ALTER TABLE `source_message` DISABLE KEYS */;
INSERT INTO `source_message` VALUES (1,'app','Users'),(2,'app','Add'),(3,'app','ID'),(4,'app','Username'),(5,'app','Password'),(6,'app','First Name'),(7,'app','Last Name'),(8,'app','Phone No'),(9,'app','Status'),(10,'app','Role'),(11,'app','SELECT'),(12,'app','Place'),(13,'app','District'),(14,'app','User'),(15,'app','Translation'),(16,'app','Change Password'),(17,'app','Logout'),(18,'app','Login'),(19,'app','Language'),(20,'app','Please fill out the following fields to login'),(21,'app','Places'),(22,'app','Create Place'),(23,'app','Name Lao'),(24,'app','Name Eng'),(25,'app','Lat'),(26,'app','Lon'),(27,'app','Village Lao'),(28,'app','Village Eng'),(29,'app','Description Lao'),(30,'app','Description Eng'),(31,'app','District ID'),(32,'app','User ID'),(33,'app','Last Update'),(34,'app','Logo'),(35,'app','Districts'),(36,'app','Lao Name'),(37,'app','English Name'),(38,'app','Update'),(39,'app','Delete'),(40,'app','Are you sure you want to delete this item?'),(41,'app','Update {modelClass}: '),(42,'app','Create District'),(43,'app','Save'),(44,'app','Add Place'),(45,'app','Category'),(46,'app','Message'),(47,'app','Add User'),(48,'app','Current Password'),(49,'app','New Password'),(50,'app','Confirm Password'),(51,'app','Currenct Password is Incorrect'),(52,'app','Success'),(53,'app','Draft'),(54,'app','Photo'),(55,'app','asgsdgdsg\'s Photo'),(56,'app','Add Photos'),(57,'app','Current Photos'),(58,'app','Add New Photos'),(59,'app','Sync Firebase');
/*!40000 ALTER TABLE `source_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL,
  `role` enum('Admin','User') DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'adsavin','c490ee40e572081363e09260fa9e6763d0fd6091','Adsavin','THEPPHAKAN','22224071','Active','Admin'),(2,'somvang','c490ee40e572081363e09260fa9e6763d0fd6091','Somvang','Phanthavong','12412414','Active','Admin');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'lpb'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-20 22:47:07
