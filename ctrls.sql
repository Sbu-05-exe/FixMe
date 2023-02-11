-- MySQL dump 10.13  Distrib 8.0.20, for Win64 (x86_64)
--
-- Host: localhost    Database: ctrls
-- ------------------------------------------------------
-- Server version	8.0.20

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
-- Table structure for table `devices`
--

DROP TABLE IF EXISTS `devices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `devices` (
  `deviceID` int NOT NULL AUTO_INCREMENT,
  `userID` int DEFAULT NULL,
  `name` varchar(30) NOT NULL,
  `brand` varchar(30) NOT NULL,
  `model` varchar(30) NOT NULL,
  `category` enum('desktop','laptop','tablet') NOT NULL,
  `image` varchar(255) DEFAULT '../../images/devices/loebster.jpg',
  `deleted` varchar(255) DEFAULT 'no',
  PRIMARY KEY (`deviceID`),
  KEY `userID` (`userID`),
  CONSTRAINT `devices_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devices`
--

LOCK TABLES `devices` WRITE;
/*!40000 ALTER TABLE `devices` DISABLE KEYS */;
INSERT INTO `devices` VALUES (6,1000000004,'Paddington','Apple','Ipad Pro','tablet','../../images/devices/61XZQXFQeVL._AC_SL1500_.jpg1665045722.jpg','no'),(11,1000000004,'Catthew','Dell','Dell XPS','laptop','../../images/devices/Crop800x600.jpg1665045769.jpg','no'),(30,1000000036,'Adele','Dell','Dell XPS','laptop','../../images/devices/1665042346.','no'),(31,1000000025,'Chandler','Xiaomi','','tablet','../../images/devices/pms_1647849448.31929017.png1665044247.png','no'),(33,1000000025,'My laptop','HP','','laptop','../../images/devices/s-l640.jpg1665044527.jpg','no'),(34,1000000036,'Dicks Laptop','Asus','rogstrixg17','laptop','loebster.jpg','no'),(35,1000000001,'nick','Apple','2','tablet','loebster.jpg','yes'),(36,1000000035,'My Personal Laptop','Lenovo','Legion 15','laptop','../../images/devices/csm__MG_3512_b10bc87ad6.jpg1665062601.jpg','no'),(38,1000000038,'Peaches','Apple','Mac','desktop','../../images/devices/20220529_152359.jpg1665066006.jpg','no'),(41,1000000001,'myPC','Apple','Macbook Air','laptop','../../images/devices/asus_tuf.jpg1665070504.jpg','yes'),(44,1000000001,'myipad','Apple','1','laptop','../../images/devices/defaultImage.jpg','yes'),(45,1000000001,'myIpad','Apple','Ipad Air','laptop','../../images/devices/defaultImage.jpg','yes'),(49,1000000001,'Jude','Dell','Dell XPS','laptop','loebster.jpg','yes'),(50,1000000032,'MyPC','Lenovo','Z88','laptop','loebster.jpg','no'),(51,1000000001,'newPC','Asus','X515','laptop','loebster.jpg','yes'),(52,1000000001,'James','Acer','rtz765','laptop','loebster.jpg','yes'),(53,1000000001,'Matthew','Dell','K412','laptop','loebster.jpg','yes'),(54,1000000001,'newDevice','Asus','X515','laptop','loebster.jpg','yes'),(55,1000000001,'Apple','Android','X11','tablet','loebster.jpg','yes'),(56,1000000001,'Bing','Lenovo','Rt142','laptop','loebster.jpg','no'),(57,1000000001,'MyPC','Acer','Swift 5','laptop','loebster.jpg','no'),(58,1000000031,'device1','Apple','Ipad Air','tablet','loebster.jpg','no'),(59,1000000031,'device2','Apple','Ipad Pro','tablet','loebster.jpg','no'),(60,1000000031,'device3','Lenovo','CXV415','tablet','loebster.jpg','no'),(61,1000000031,'device4','Asus','bloop','laptop','loebster.jpg','no'),(62,1000000031,'device5','Acer','kdgf','laptop','loebster.jpg','no'),(63,1000000031,'device6','Dell','q12','laptop','loebster.jpg','no'),(64,1000000031,'device7','Asus','w43','laptop','loebster.jpg','no'),(65,1000000031,'Codge','Dell','Optiplex','desktop','loebster.jpg','no'),(66,1000000004,'myIpad','Ipad','2','tablet','loebster.jpg','yes'),(67,1000000031,'James','Acer','rtz123','laptop','loebster.jpg','no'),(68,1000000004,'John','Lenovo','XzR 654','laptop','loebster.jpg','yes'),(69,1000000031,'newLaptop','Dell','XPS 15','laptop','loebster.jpg','no'),(70,1000000004,'newPc','Acer','XT 286','laptop','loebster.jpg','yes'),(71,1000000031,'MyIpad','Apple','Ipad','tablet','loebster.jpg','no'),(72,1000000031,'MyLaptop','Acer','Aspire 5','laptop','loebster.jpg','yes'),(73,1000000004,'Jonothan','Asus','X515','laptop','undraw_monitor_iqpq.png','yes'),(74,1000000045,'apple','android ','A26','tablet','undraw_monitor_iqpq.png','no'),(75,1000000045,'android','Apple','MacBook AIr','laptop','../../images/devices/images.jpg1665129207.jpg','no'),(76,1000000045,'samsung','huawei','asus','desktop','undraw_monitor_iqpq.png','no'),(77,1000000001,'mypc','Dell','X11','laptop','undraw_monitor_iqpq.png','yes'),(78,1000000058,'My Macbook','Apple','m2 Macboook air','laptop','../../images/devices/macbook-air-midnight-select-20220606.jpg1665519846.jpg','no'),(79,1000000001,'heather','Acer','Rtx 897','laptop','undraw_monitor_iqpq.png','no'),(80,1000000061,'MyLaptop','Apple','MacBook Air','laptop','../../images/devices/asus_tuf.jpg1665142396.jpg','no'),(81,1000000061,'Buzzy','Apple','Ipad','tablet','undraw_monitor_iqpq.png','no'),(82,1000000058,'My iPad','Apple','iPad Air (5th Gen)','tablet','../../images/devices/ipad-air-select-wifi-spacegray-202203.jpg1665519618.jpg','no'),(83,1000000058,'My iMac','Apple','Mac Studio m1 ultra','desktop','../../images/devices/studio-display-og-202203.jpg1665519788.jpg','no'),(84,1000000063,'blueberry','Apple','Macbook air','desktop','../../images/devices/undraw_Programmer_re_owql.png1665145270.png','yes'),(85,1000000063,'orange','Apple','air','laptop','undraw_monitor_iqpq.png','no'),(86,1000000058,'My Old Macbook','Apple','MacBook AIr','laptop','../../images/devices/macbook_air_m1.png1665519751.png','no'),(87,1000000059,'My Computer','IBM','XT 286','desktop','undraw_monitor_iqpq.png','no'),(88,1000000058,'Squidgy','Apple','macbook','laptop','undraw_monitor_iqpq.png','no'),(89,1000000062,'Jen','','','laptop','undraw_monitor_iqpq.png','yes'),(91,1000000062,'My Laptop','Apple','M2 Macbook Air','laptop','undraw_monitor_iqpq.png','yes'),(92,1000000062,'F14','Apple','TomCat','laptop','undraw_monitor_iqpq.png','no');
/*!40000 ALTER TABLE `devices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobgroup`
--

DROP TABLE IF EXISTS `jobgroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobgroup` (
  `repairJobID` int NOT NULL,
  `TechnicianID` int NOT NULL,
  `notes` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`repairJobID`,`TechnicianID`),
  KEY `TechnicianID` (`TechnicianID`),
  CONSTRAINT `jobgroup_ibfk_1` FOREIGN KEY (`repairJobID`) REFERENCES `repairjobs` (`repairJobID`),
  CONSTRAINT `jobgroup_ibfk_2` FOREIGN KEY (`TechnicianID`) REFERENCES `technician` (`TechnicianID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobgroup`
--

LOCK TABLES `jobgroup` WRITE;
/*!40000 ALTER TABLE `jobgroup` DISABLE KEYS */;
INSERT INTO `jobgroup` VALUES (1,13,NULL),(11,14,NULL),(12,8,NULL),(13,6,NULL),(14,7,NULL),(17,6,NULL),(17,9,NULL),(17,13,NULL),(18,12,NULL),(19,8,NULL),(19,9,NULL),(20,7,NULL),(21,7,NULL),(22,8,NULL),(23,9,NULL),(24,15,NULL),(25,12,NULL),(26,15,NULL),(27,14,NULL),(28,12,NULL),(29,13,NULL),(30,7,NULL),(30,14,NULL),(30,15,NULL),(31,8,NULL),(32,15,NULL),(50,12,NULL),(51,9,NULL),(52,10,NULL),(53,6,NULL),(54,6,NULL),(55,10,NULL),(56,10,NULL),(57,13,NULL),(58,10,NULL),(62,10,NULL);
/*!40000 ALTER TABLE `jobgroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `notificationdate` datetime NOT NULL,
  `repairJobId` int NOT NULL,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `repairJobID` FOREIGN KEY (`id`) REFERENCES `repairjobs` (`repairJobID`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,'2022-10-07 10:18:03',1,'assigned'),(11,'2022-10-07 11:05:44',49,'queued'),(12,'2022-10-07 12:44:47',24,'queued'),(13,'2022-10-07 12:49:09',50,'assigned'),(14,'2022-10-07 13:37:17',51,'queued'),(17,'2022-10-11 20:26:13',55,'queued'),(18,'2022-10-11 20:27:21',57,'assigned'),(19,'2022-10-11 21:14:08',22,'ordered part'),(20,'2022-10-12 09:54:25',55,'assigned'),(21,'2022-10-12 09:55:20',55,'repaired'),(22,'2022-10-12 10:11:41',58,'queued'),(23,'2022-10-12 10:11:54',58,'assigned'),(24,'2022-10-12 14:44:09',59,'queued'),(25,'2022-10-12 16:17:07',60,'queued'),(26,'2022-10-12 16:19:25',61,'queued'),(27,'2022-10-12 16:20:12',61,'assigned'),(28,'2022-10-12 16:32:44',56,'assigned'),(29,'2022-10-12 16:34:29',58,'ordered part'),(30,'2022-10-12 17:30:32',62,'queued'),(31,'2022-10-12 17:31:03',62,'assigned'),(32,'2022-10-12 17:31:52',62,'ordered part');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parts`
--

DROP TABLE IF EXISTS `parts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `parts` (
  `PartID` int NOT NULL AUTO_INCREMENT,
  `Price` decimal(10,2) DEFAULT NULL,
  `Name` varchar(30) DEFAULT NULL,
  `repairJobID` int DEFAULT NULL,
  `type` enum('Adhesive pads','Adhesive','Battery','Button','Cable','Case Component','Display Component','Fan','Graphic card','Hard Drive','Headphone Jack','Lamp','LCD Board','Magsafe Board','Microphone','Motherboard','Port','Power Adapter','Power Supply','RAM','Screen','Screen Protector','Screw','Sensor','Speaker','Trackpad','Wireless Board') DEFAULT NULL,
  PRIMARY KEY (`PartID`),
  KEY `repairJobID` (`repairJobID`),
  CONSTRAINT `parts_ibfk_1` FOREIGN KEY (`repairJobID`) REFERENCES `repairjobs` (`repairJobID`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parts`
--

LOCK TABLES `parts` WRITE;
/*!40000 ALTER TABLE `parts` DISABLE KEYS */;
INSERT INTO `parts` VALUES (1,1800.00,'Graphics Card',1,'Adhesive'),(2,2000.00,'New Screen',13,'Adhesive'),(3,1500.00,'RAM',13,'Wireless Board'),(4,3000.00,'CPU',21,'Battery'),(5,1200.00,'RAM',14,'Trackpad'),(6,300.00,'cookies',22,'Cable'),(7,80.00,'juice',23,'Adhesive'),(8,300.00,'juice ',20,'Wireless Board'),(9,300.00,'juice',20,'Adhesive'),(10,300.00,'jucie',20,'Battery'),(11,12.00,'cookies',20,'Trackpad'),(12,12.00,'cookies',20,'Adhesive'),(13,3454.00,'cookies',20,'Adhesive'),(14,400.00,'asdf',30,'Battery'),(15,200.00,'asfd',27,'Battery'),(16,150.00,'asdf',11,'Port'),(17,1500.00,'asdas',20,'Motherboard'),(18,1200.00,'Nvidia',31,'LCD Board'),(19,1200.00,'Nvidia',52,'Graphic card'),(20,1200.00,'nvidia',54,'Graphic card'),(21,800.00,'power supply',52,'Power Supply'),(22,1200.00,'Nvidia',58,'Graphic card'),(23,1200.00,'Nvidia',62,'Graphic card');
/*!40000 ALTER TABLE `parts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repairjobs`
--

DROP TABLE IF EXISTS `repairjobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `repairjobs` (
  `repairJobID` int NOT NULL AUTO_INCREMENT,
  `userID` int NOT NULL,
  `deviceID` int NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `difficulty` enum('easy','medium','hard') NOT NULL DEFAULT 'easy',
  `status` enum('queued','assigned','inspected','repaired','ordered part','done','paid') NOT NULL,
  `etc` int NOT NULL,
  `date` datetime DEFAULT NULL,
  `inspectionFee` decimal(10,2) DEFAULT NULL,
  `repairFee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `needsparts` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`repairJobID`),
  KEY `userID` (`userID`),
  KEY `deviceID` (`deviceID`),
  CONSTRAINT `repairjobs_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  CONSTRAINT `repairjobs_ibfk_2` FOREIGN KEY (`deviceID`) REFERENCES `devices` (`deviceID`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repairjobs`
--

LOCK TABLES `repairjobs` WRITE;
/*!40000 ALTER TABLE `repairjobs` DISABLE KEYS */;
INSERT INTO `repairjobs` VALUES (1,1000000004,6,'Not Enough Marmalade','hard','assigned',10,'2022-02-06 15:35:01',100.00,450.00,1),(11,1000000004,11,'rachel drove it wrong','easy','ordered part',1,'2022-03-06 15:35:06',100.00,500.00,1),(12,1000000004,11,'Caught on fire','easy','assigned',1,'2022-04-06 15:35:09',100.00,0.00,0),(13,1000000004,11,'Caught on fire','easy','assigned',1,'2022-10-06 15:35:11',100.00,250.00,1),(14,1000000004,11,'Caught on fire','easy','ordered part',1,'2022-08-06 15:35:30',100.00,300.00,1),(17,1000000036,30,'stopped singing','medium','assigned',7,'2022-10-06 09:58:32',100.00,0.00,0),(18,1000000036,34,'It got smashed on the side, broken screen','easy','assigned',5,'2022-10-06 01:46:41',100.00,0.00,0),(19,1000000001,44,'missing keys','easy','assigned',1,'2022-10-06 07:20:39',100.00,0.00,0),(20,1000000001,49,'broken screen','easy','paid',1,'2022-10-06 07:23:25',100.00,250.00,1),(21,1000000001,51,'Cracked screen','easy','ordered part',1,'2022-10-06 07:40:39',100.00,500.00,0),(22,1000000001,52,'broken screen','easy','ordered part',1,'2022-10-06 07:47:34',100.00,150.00,1),(23,1000000001,56,'Wifi not working','easy','inspected',4,'2022-10-06 08:05:52',100.00,100.00,1),(24,1000000031,58,'its broken','easy','assigned',4,'2022-10-07 12:50:17',100.00,0.00,0),(25,1000000031,58,'keyboard stuck on j','easy','assigned',1,'2022-09-01 01:01:01',100.00,0.00,0),(26,1000000031,59,'smoking','easy','assigned',1,'2022-09-01 01:01:01',100.00,0.00,0),(27,1000000031,60,'screen isyellow','easy','ordered part',1,'2022-08-01 01:01:01',100.00,200.00,1),(28,1000000031,61,'jammed','easy','assigned',1,'2022-07-01 01:01:01',100.00,0.00,0),(29,1000000031,62,'will not turn on','medium','assigned',1,'2022-07-01 01:01:01',100.00,0.00,0),(30,1000000031,63,'fans are not working','hard','ordered part',1,'2022-07-01 01:01:01',100.00,250.00,1),(31,1000000045,75,'keeps turning off','medium','ordered part',6,'2022-10-07 09:54:48',100.00,800.00,1),(32,1000000045,74,'no power','hard','assigned',10,'2022-10-07 09:58:35',100.00,0.00,0),(50,1000000031,64,'It is making funny noises','easy','assigned',1,'2022-10-07 12:44:47',100.00,0.00,0),(51,1000000001,79,'Screen smasheds','easy','assigned',1,'2022-10-07 01:37:17',100.00,0.00,0),(52,1000000058,83,'will not turn on\r\n','medium','paid',6,'2022-10-07 01:42:34',100.00,450.00,1),(53,1000000058,78,'will not turn ons\r\n','medium','assigned',4,'2022-10-07 01:44:02',100.00,0.00,0),(54,1000000063,85,'screen broken','easy','ordered part',3,'2022-10-07 02:24:09',100.00,140.00,1),(55,1000000058,86,'food in all the ports','easy','repaired',15,'2022-10-11 10:46:10',100.00,0.00,0),(56,1000000031,67,'It makes noise','easy','assigned',1,'2022-10-11 01:43:09',100.00,0.00,0),(57,1000000058,82,'Cracked screen','hard','assigned',10,'2022-10-11 08:26:13',100.00,0.00,0),(58,1000000058,88,'not charging','easy','ordered part',12,'2022-10-12 10:11:41',100.00,450.00,1),(59,1000000031,69,'no power and cracked screen','hard','queued',15,'2022-10-12 02:44:09',100.00,0.00,0),(62,1000000062,92,'Hit by a missile','easy','ordered part',1,'2022-10-12 05:30:32',100.00,450.00,1);
/*!40000 ALTER TABLE `repairjobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `technician`
--

DROP TABLE IF EXISTS `technician`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `technician` (
  `TechnicianID` int NOT NULL AUTO_INCREMENT,
  `Salary` decimal(10,2) DEFAULT NULL,
  `Picture` varchar(30) DEFAULT NULL,
  `userID` int DEFAULT NULL,
  `Experience` enum('junior','intermediate','senior') DEFAULT NULL,
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  PRIMARY KEY (`TechnicianID`),
  KEY `userID` (`userID`),
  CONSTRAINT `technician_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `technician`
--

LOCK TABLES `technician` WRITE;
/*!40000 ALTER TABLE `technician` DISABLE KEYS */;
INSERT INTO `technician` VALUES (6,25000.00,'',1000000021,'senior','2022-10-01',NULL),(7,30000.00,'',1000000022,'senior','2022-10-01',NULL),(8,20000.00,'',1000000023,'intermediate','2022-10-01',NULL),(9,20000.00,'',1000000024,'intermediate','2022-10-01',NULL),(10,12000.00,'',1000000032,'junior','2022-10-01',NULL),(12,3000.00,'',1000000035,'junior','2022-10-01',NULL),(13,17000.00,'',1000000042,'intermediate','2022-10-06',NULL),(14,13000.00,'',1000000043,'junior','2022-10-06',NULL),(15,11000.00,'',1000000044,'junior','2022-10-06',NULL);
/*!40000 ALTER TABLE `technician` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `userID` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(30) DEFAULT NULL,
  `lastName` varchar(30) DEFAULT NULL,
  `userName` varchar(30) NOT NULL,
  `password` varchar(45) NOT NULL,
  `userType` enum('user','technician','admin') NOT NULL,
  `email` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=1000000065 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1000000000,'John','Smith','jSmith','pa55word','user',NULL),(1000000001,'Andrew','Codner','Ands','506da6907f960f50cad09ca45512519f91515237','user','totallyawesomeands@gmail.com'),(1000000003,'John','Smith','jsmith','pass','user','jsmith@gmail.com'),(1000000004,'Sibu','Dlamini','Sbu_05','psych','user','sibu@gmail.com'),(1000000021,'Jack Jack','Attack','jjA','lasereyes','technician','incredibles@themovie.com'),(1000000022,'Sterling','Archer','Dutchess','ef14370c1a9f51d4a2951a008392e30613b63228','technician','Woohoo@isis.com'),(1000000023,'Rod','Kimble','hotRod','letsparty','technician','ImSorryaboutthewindow@unscripted.movie'),(1000000024,'Nicholas','Angel','sgtAngle','Yaarp','technician','cornetto@trilogy.co.uk'),(1000000025,'Siyavuya','Mathonsi','regular_siya','bangchun','user','siya@later.com'),(1000000031,'Jenna','Skinner','skinnycodfish','hahalol','user','jenna@tech.com'),(1000000032,'Jenna','Smith','JaSmith','506da6907f960f50cad09ca45512519f91515237','technician','jsmith@fixme.com'),(1000000035,'Sibusiso','Dlamini','ohmydays','psych05','technician','ohmy@days.com'),(1000000036,'Marlin','Fish','jellyman','7c4a8d09ca3762af61e59520943dc26494f8941b','user','justkeepswimming@ocean.com'),(1000000038,'admin','admin','admin','506da6907f960f50cad09ca45512519f91515237','admin','Nan'),(1000000040,'Uviwe','Jumba','notthatguy','boomboom','user','yesweare@60percent.com'),(1000000041,'Angus','Bough','Colin','veryreal','user','sidekick@jenglish.co.uk'),(1000000042,'Johnny','English','Eflat','qwerty','technician','joeng@silly.co.uk'),(1000000043,'Bartleby','Gaines','JohnnyRamone','asdfgh','technician','BG@SouthHarmon.com'),(1000000044,'Pamela','Poovy','Pam','zxcvbn','technician','pam@isis.com'),(1000000045,'Marvin','The Martian','AlienToon','hahalol','user','dontknow@maybelater.com'),(1000000046,'Lana','Kane','L_Kane','hacker','user','test@badinput.com'),(1000000047,'John','McClane','bad_cop','123456','user','diehard@movie.com'),(1000000052,'Eric','Forman','Grace','beepbeep','user','wilmer@why.com'),(1000000053,'Wilmer','Watson','Wilmer24','beepbeep','user','w@why.com'),(1000000055,'Helen','Napier','Maeffin','425af12a0743502b322e93a015bcf868e324d56a','user','Maeffin@wrenchview.com'),(1000000056,'Sibusiso','Dlamini','Sibu_005','1fd901ac580e8b3e726076c7f2fc579228c4930b','user','sibu@needafix.com'),(1000000057,'Theresa','Gelbman','Tree','d0205a977b970d4bd9c68dba671a883754b1fde1','user','Ithappened@again.movie'),(1000000058,'Sibusiso','Dlamini','Sbu_25','506da6907f960f50cad09ca45512519f91515237','user','sibu@isstressed.com'),(1000000059,'Chris','Upfold','Chris_05','506da6907f960f50cad09ca45512519f91515237','user','chris@upfold.com'),(1000000060,'Mike','Enslin','M_Enslin','506da6907f960f50cad09ca45512519f91515237','user','scary@1408.movie'),(1000000061,'Nick','Harper','nickH','506da6907f960f50cad09ca45512519f91515237','user','oldestson@myfamily.co.uk'),(1000000062,'Tom','Kazansky','Iceman','506da6907f960f50cad09ca45512519f91515237','user','winner@topgun.com'),(1000000063,'Chris','Upfold','chris_upfold01','506da6907f960f50cad09ca45512519f91515237','user','chris@brokemylaptop.com'),(1000000064,'Jenna','Skinner','J_Skinner','506da6907f960f50cad09ca45512519f91515237','user','jenna@brokenlaptop.com');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-29 14:34:20
