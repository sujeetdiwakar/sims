-- MySQL dump 10.16  Distrib 10.1.16-MariaDB, for Linux (i686)
--
-- Host: localhost    Database: sims
-- ------------------------------------------------------
-- Server version	10.1.16-MariaDB

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
-- Table structure for table `ajax_categories`
--

DROP TABLE IF EXISTS `ajax_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ajax_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(50) NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ajax_categories`
--

LOCK TABLES `ajax_categories` WRITE;
/*!40000 ALTER TABLE `ajax_categories` DISABLE KEYS */;
INSERT INTO `ajax_categories` VALUES (1,'Tutorials',0),(2,'Demos',0),(3,'Entertainment',0),(4,'Real Estate',0),(5,'Web Development',0),(6,'Browsers',0),(7,'Laptop',0),(8,'PHP',1),(9,'jQuery',1),(10,'AJAX',1),(11,'CodeIgniter',1),(12,'PHP demos',2),(13,'jQuery demos',2),(14,'Film',3),(15,'Music',3),(16,'Commercial',4),(17,'Home',4),(18,'CSS',5),(19,'PHP',5),(20,'FireFox',6),(21,'Internet Explorer',6),(22,'Safari',6),(23,'Opera',6),(24,'IBM',7),(25,'Sony',7),(26,'Dell',7),(27,'HP ',7),(28,'Version 4',8),(29,'Version 5',8),(30,'jQuery Tutorials',9),(31,'jQuery Demos',9),(32,'Codeigniter 1.7',11),(33,'Codeigniter 2.0',11),(34,'Good Demos',12),(35,'Average Demos',12),(36,'Good Demos',13),(37,'Old',28),(38,'New',29),(39,'Good',30),(40,'Bad',31),(41,'Old',32),(42,'New',33),(43,'game',0),(44,'Crickete',43),(45,'Footbal',43),(46,'India',44),(47,'Pakistan',44),(48,'Dhoni',46),(49,'Rahul',46),(50,'Samsung',0),(67,'domo demo',0),(66,'WORDPRESS',0),(65,'OOPS PHP',0),(64,'OOPS PHP',0),(63,'sm',0),(62,'',0),(61,'',0),(68,'demo1',0),(69,'php7',1),(70,'VERSION7',1),(71,'VERSION8',0),(72,'VR8',0),(73,'sd',0),(74,'sachchida nand',0),(75,'Sunil Kr',74),(76,'Sujeet Kumar',74),(77,'Subham',75),(78,'sweta',75),(79,'NOKIA',0),(80,'SMART PHONE',79),(81,'TAB',79),(82,'TAB#4',81),(83,'TAB#N7',81);
/*!40000 ALTER TABLE `ajax_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Graduation',1,0),(2,'Part1',1,1),(3,'Part2',1,1),(4,'Primary Education',1,0),(5,'STD 1',1,4),(6,'STD 2',1,4),(7,'cash memo',1,5);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `self_informations`
--

DROP TABLE IF EXISTS `self_informations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `self_informations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(250) NOT NULL,
  `cat_id` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `value` varchar(250) NOT NULL,
  `image` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `self_informations`
--

LOCK TABLES `self_informations` WRITE;
/*!40000 ALTER TABLE `self_informations` DISABLE KEYS */;
INSERT INTO `self_informations` VALUES (1,'1','2','Marksheet part1','340','sc.jpg'),(2,'1','3','Marksheet part 2','440','headphone.jpg'),(3,'1','5','cetificate','2343','headphone.jpg'),(4,'1','7','january fee','250',''),(5,'1','7','february fee','250','');
/*!40000 ALTER TABLE `self_informations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_registration`
--

DROP TABLE IF EXISTS `user_registration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` text NOT NULL,
  `full_name` varchar(250) NOT NULL,
  `mobile` varchar(250) NOT NULL,
  `address` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_registration`
--

LOCK TABLES `user_registration` WRITE;
/*!40000 ALTER TABLE `user_registration` DISABLE KEYS */;
INSERT INTO `user_registration` VALUES (1,'Sujeet_Diwakar','www.sujeetdiwakar@gmail.com','*40EA63B632DDB6C45449E8A7A4EAFC68F1AAD1FD','Sujeet Kumar','9006815320','Vill:-Mishrauli'),(3,'Sujeet_Diwakarkr','sujeetdiwakar1@gmail.com','*B50329B425934B18B6F84F8F4880D7D388E7BF19','','',''),(4,'sumit_kumar','sumit@gmail.com','*2EF2A652BCA4C918BC2C50D02FA59720ED500EF4','','',''),(5,'seraj','seraj@gmail.com','*A5BF80B01A424D755BB3D357FBF882C08D731661','md seraj uddin','',''),(6,'sp','sp@gmail.com','*4C378C2C1D1760966F3654527C7BBACCA2A064F4','','','');
/*!40000 ALTER TABLE `user_registration` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-28  8:13:55
