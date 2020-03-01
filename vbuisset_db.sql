-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: vbuisset_db
-- ------------------------------------------------------
-- Server version	5.7.24

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
-- Table structure for table `clicked_link`
--

DROP TABLE IF EXISTS `clicked_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clicked_link` (
  `iduniversity_link_clicked` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `link` varchar(150) NOT NULL,
  PRIMARY KEY (`iduniversity_link_clicked`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clicked_link`
--
-- ORDER BY:  `iduniversity_link_clicked`

LOCK TABLES `clicked_link` WRITE;
/*!40000 ALTER TABLE `clicked_link` DISABLE KEYS */;
INSERT INTO `clicked_link` VALUES (4,'2020-03-01','http://www.utt.fr/'),(5,'2020-03-01','http://www.u-bourgogne.fr/'),(6,'2020-03-01','http://www.u-bourgogne.fr/'),(7,'2020-03-01','http://www.univ-nantes.fr/'),(29,'2020-03-01','https://www.sorbonne-universite.fr/');
/*!40000 ALTER TABLE `clicked_link` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `request`
--

DROP TABLE IF EXISTS `request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `request` (
  `idRequest` int(11) NOT NULL AUTO_INCREMENT,
  `time` date DEFAULT NULL,
  `navigator` varchar(200) NOT NULL,
  `fromUrl` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idRequest`)
) ENGINE=InnoDB AUTO_INCREMENT=392 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request`
--
-- ORDER BY:  `idRequest`

LOCK TABLES `request` WRITE;
/*!40000 ALTER TABLE `request` DISABLE KEYS */;
INSERT INTO `request` VALUES (143,'2020-02-29','','http://localhost/search.php'),(153,'2020-02-29','','http://localhost/search.php?domaine=Informatique&diplome=&loc=%C3%8Ele-de-France&years='),(206,'2020-02-29','','http://localhost/search.php?years=4%C3%A8me+ann%C3%A9e'),(207,'2020-02-29','','http://localhost/index.php'),(208,'2020-02-29','','http://localhost/index.php'),(209,'2020-02-29','','http://localhost/index.php'),(210,'2020-02-29','','http://localhost/index.php'),(211,'2020-02-29','',''),(212,'2020-02-29','',''),(213,'2020-02-29','','http://localhost/index.php'),(214,'2020-02-29','','http://localhost/search.php'),(215,'2020-02-29','','http://localhost/index.php'),(216,'2020-02-29','','http://localhost/index.php'),(217,'2020-03-01','',''),(218,'2020-03-01','',''),(219,'2020-03-01','','http://localhost/'),(220,'2020-03-01','','http://localhost/admin.php'),(221,'2020-03-01','','http://localhost/search.php'),(222,'2020-03-01','','http://localhost/search.php?domaine=Pharmacie&diplome=Capacit%C3%A9+en+droit&loc=Hauts-de-France&years=2%C3%A8me+ann%C3%A9e'),(223,'2020-03-01','','http://localhost/search.php?domaine=Pharmacie&diplome=Capacit%C3%A9+en+droit&loc=Hauts-de-France&years=2%C3%A8me+ann%C3%A9e'),(281,'2020-03-01','',''),(282,'2020-03-01','','http://localhost/search.php'),(283,'2020-03-01','','http://localhost/search.php?domaine=&diplome=&loc=&years='),(284,'2020-03-01','','http://localhost/index.php'),(285,'2020-03-01','','http://localhost/index.php'),(286,'2020-03-01','','http://localhost/index.php'),(287,'2020-03-01','','http://localhost/index.php'),(288,'2020-03-01','','http://localhost/index.php'),(303,'2020-03-01','','http://localhost/search.php?domaine=M%C3%A9canique%2C+g%C3%A9nie+m%C3%A9canique&diplome=Formations+d%27ing%C3%A9nieurs&loc=%C3%8Ele-de-France&years=3%C3%A8me+ann%C3%A9e'),(304,'2020-03-01','','http://localhost/search.php?domaine=M%C3%A9canique%2C+g%C3%A9nie+m%C3%A9canique&diplome=Formations+d%27ing%C3%A9nieurs&loc=%C3%8Ele-de-France&years='),(305,'2020-03-01','','http://localhost/search.php?domaine=&diplome=Formations+d%27ing%C3%A9nieurs&loc=%C3%8Ele-de-France&years='),(306,'2020-03-01','','http://localhost/search.php?domaine=M%C3%A9canique%2C+g%C3%A9nie+m%C3%A9canique&diplome=Formations+d%27ing%C3%A9nieurs&loc=%C3%8Ele-de-France&years='),(307,'2020-03-01','','http://localhost/search.php?domaine=&diplome=Formations+d%27ing%C3%A9nieurs&loc=%C3%8Ele-de-France&years='),(308,'2020-03-01','','http://localhost/search.php?domaine=&diplome=Formations+d%27ing%C3%A9nieurs&loc=%C3%8Ele-de-France&years='),(309,'2020-03-01','','http://localhost/search.php?domaine=&diplome=Formations+d%27ing%C3%A9nieurs&loc=%C3%8Ele-de-France&years='),(310,'2020-03-01','','http://localhost/search.php?domaine=&diplome=Formations+d%27ing%C3%A9nieurs&loc=%C3%8Ele-de-France&years='),(311,'2020-03-01','','http://localhost/search.php?domaine=&diplome=Formations+d%27ing%C3%A9nieurs&loc=%C3%8Ele-de-France&years='),(312,'2020-03-01','','http://localhost/search.php?domaine=&diplome=Formations+d%27ing%C3%A9nieurs&loc=%C3%8Ele-de-France&years='),(313,'2020-03-01','','http://localhost/search.php?domaine=&diplome=Formations+d%27ing%C3%A9nieurs&loc=%C3%8Ele-de-France&years='),(314,'2020-03-01','','http://localhost/search.php?domaine=&diplome=Formations+d%27ing%C3%A9nieurs&loc=%C3%8Ele-de-France&years='),(315,'2020-03-01','',''),(316,'2020-03-01','','http://localhost/search.php?domaine=&diplome=Formations+d%27ing%C3%A9nieurs&loc=%C3%8Ele-de-France&years='),(322,'2020-03-01','',''),(323,'2020-03-01','','http://localhost/search.php?domaine=&diplome=Master+enseignement&loc=%C3%8Ele-de-France&years='),(324,'2020-03-01','','http://localhost/search.php?domaine=&diplome=Master+enseignement&loc=%C3%8Ele-de-France&years='),(325,'2020-03-01','','http://localhost/search.php?domaine=&diplome=Master+enseignement&loc=%C3%8Ele-de-France&years='),(326,'2020-03-01','','http://localhost/search.php?domaine=&diplome=Master+enseignement&loc=%C3%8Ele-de-France&years='),(327,'2020-03-01','','http://localhost/search.php?domaine=&diplome=Master+enseignement&loc=%C3%8Ele-de-France&years='),(328,'2020-03-01','',''),(329,'2020-03-01','','http://localhost/search.php?domaine=&diplome=Master+enseignement&loc=%C3%8Ele-de-France&years='),(330,'2020-03-01','','http://localhost/search.php?domaine=&diplome=&loc=%C3%8Ele-de-France&years='),(331,'2020-03-01','','http://localhost/search.php?domaine=&diplome=Master+enseignement&loc=%C3%8Ele-de-France&years='),(332,'2020-03-01','','http://localhost/search.php?domaine=&diplome=Master+enseignement&loc=%C3%8Ele-de-France&years='),(333,'2020-03-01','','http://localhost/search.php?domaine=&diplome=Master+enseignement&loc=%C3%8Ele-de-France&years='),(334,'2020-03-01','','http://localhost/search.php?domaine=&diplome=&loc=%C3%8Ele-de-France&years='),(335,'2020-03-01','','http://localhost/search.php?domaine=&diplome=&loc=%C3%8Ele-de-France&years='),(336,'2020-03-01','',''),(337,'2020-03-01','','http://localhost/search.php?domaine=&diplome=&loc=%C3%8Ele-de-France&years='),(342,'2020-03-01','','http://localhost/search.php?&diplome=&loc=%C3%8Ele-de-France&years=&rows=50'),(343,'2020-03-01','',''),(344,'2020-03-01','','http://localhost/search.php?diplome=&loc=%C3%8Ele-de-France&years=&rows=50&rows=200'),(345,'2020-03-01','',''),(346,'2020-03-01','','http://localhost/search.php?diplome=&loc=%C3%8Ele-de-France&years=&rows=200'),(347,'2020-03-01','','http://localhost/search.php?domaine=Pharmacie&diplome=Licence&loc=%C3%8Ele-de-France&years='),(348,'2020-03-01','','http://localhost/search.php?domaine=&diplome=Master+enseignement&loc=%C3%8Ele-de-France&years='),(349,'2020-03-01','','http://localhost/admin.php'),(350,'2020-03-01','','http://localhost/index.php'),(351,'2020-03-01','','http://localhost/search.php?years=6%C3%A8me+ann%C3%A9e'),(352,'2020-03-01','','http://localhost/search.php?domaine=&diplome=&loc=&years=5%C3%A8me+ann%C3%A9e'),(353,'2020-03-01','','http://localhost/search.php?domaine=&diplome=&loc=&years=7%C3%A8me+ann%C3%A9e+et+plus'),(354,'2020-03-01','','http://localhost/search.php?domaine=&diplome=&loc=&years=7%C3%A8me+ann%C3%A9e+et+plus&rows=200'),(355,'2020-03-01','',''),(356,'2020-03-01','','http://localhost/search.php?domaine=&diplome=&loc=&years=1%C3%A8me+ann%C3%A9e+et+plus&rows=200'),(357,'2020-03-01','','http://localhost/search.php?domaine=&diplome=&loc=&years=1%C3%A8me+ann%C3%A9e'),(358,'2020-03-01','','http://localhost/search.php?domaine=&diplome=&loc=&years=1%C3%A8re+ann%C3%A9e'),(359,'2020-03-01','','http://localhost/search.php?domaine=&diplome=&loc=&years=1%C3%A8re+ann%C3%A9e'),(360,'2020-03-01','','http://localhost/search.php?domaine=&diplome=&loc=&years=1%C3%A8re+ann%C3%A9e'),(361,'2020-03-01','','http://localhost/search.php?domaine=&diplome=&loc=&years=1%C3%A8re+ann%C3%A9e'),(362,'2020-03-01','','http://localhost/search.php?domaine=&diplome=&loc=&years=1%C3%A8re+ann%C3%A9e'),(363,'2020-03-01','',''),(364,'2020-03-01','','http://localhost/search.php?domaine=&diplome=&loc=&years=1%C3%A8re+ann%C3%A9e&rows=201'),(365,'2020-03-01','',''),(366,'2020-03-01','','http://localhost/admin.php'),(367,'2020-03-01','','http://localhost/search.php?domaine=&diplome=&loc=&years=1%C3%A8re+ann%C3%A9e'),(368,'2020-03-01','',''),(369,'2020-03-01','',''),(370,'2020-03-01','',''),(371,'2020-03-01','',''),(372,'2020-03-01','',''),(373,'2020-03-01','',''),(374,'2020-03-01','',''),(375,'2020-03-01','',''),(376,'2020-03-01','',''),(377,'2020-03-01','',''),(378,'2020-03-01','',''),(379,'2020-03-01','',''),(380,'2020-03-01','','http://localhost/search.php?domaine=&diplome=&loc=&years=1%C3%A8re+ann%C3%A9e&rows=1'),(381,'2020-03-01','',''),(382,'2020-03-01','',''),(383,'2020-03-01','','http://localhost/search.php?domaine=&diplome=&loc=&years=1%C3%A8re+ann%C3%A9e&rows=20'),(384,'2020-03-01','','http://localhost/index.php'),(385,'2020-03-01','','http://localhost/index.php'),(386,'2020-03-01','',''),(387,'2020-03-01','','http://localhost/search.php?domaine=&diplome=&loc=&years=1%C3%A8re+ann%C3%A9e&rows=1'),(388,'2020-03-01','','http://localhost/search.php?domaine=&diplome=&loc=&years=1%C3%A8re+ann%C3%A9e&rows=1'),(389,'2020-03-01','','http://localhost/search.php?domaine=&diplome=&loc=&years=1%C3%A8re+ann%C3%A9e&rows=1'),(390,'2020-03-01','','http://localhost/search.php?domaine=&diplome=&loc=&years=1%C3%A8re+ann%C3%A9e&rows=1'),(391,'2020-03-01','','http://localhost/index.php');
/*!40000 ALTER TABLE `request` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;


--
-- Table structure for table `parameter`
--

DROP TABLE IF EXISTS `parameter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `parameter` (
  `idParameter` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  `value` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `Request_idRequest` int(11) NOT NULL,
  PRIMARY KEY (`idParameter`,`Request_idRequest`),
  KEY `fk_Parameter_Request_idx` (`Request_idRequest`),
  CONSTRAINT `fk_Parameter_Request` FOREIGN KEY (`Request_idRequest`) REFERENCES `request` (`idRequest`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=325 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parameter`
--
-- ORDER BY:  `idParameter`,`Request_idRequest`

LOCK TABLES `parameter` WRITE;
/*!40000 ALTER TABLE `parameter` DISABLE KEYS */;
INSERT INTO `parameter` VALUES (39,'GET','Informatique','domaine',143),(41,'GET','Île-de-France','loc',143),(67,'GET','Informatique','domaine',153),(68,'GET','Diplôme universitaire de technologie','diplome',153),(69,'GET','Île-de-France','loc',153),(161,'GET','Pharmacie','domaine',221),(162,'GET','Capacité en droit','diplome',221),(163,'GET','Hauts-de-France','loc',221),(164,'GET','2ème année','years',221),(165,'GET','Pharmacie','domaine',222),(166,'GET','Capacité en droit','diplome',222),(167,'GET','Hauts-de-France','loc',222),(168,'GET','2ème année','years',222),(169,'GET','Chimie','domaine',223),(170,'GET','Doctorat','diplome',223),(171,'GET','Hauts-de-France','loc',223),(172,'GET','2ème année','years',223),(173,'GET','4ème année','years',284),(174,'GET','4ème année','years',285),(175,'GET','4ème année','years',286),(176,'GET','4ème année','years',287),(177,'GET','4ème année','years',288),(190,'GET','Mécanique, génie mécanique','domaine',303),(191,'GET','Mécanique, génie mécanique','domaine',305),(192,'GET','Master enseignement','diplome',307),(193,'GET','Île-de-France','loc',307),(194,'GET','Master enseignement','diplome',308),(195,'GET','Île-de-France','loc',308),(196,'GET','Master enseignement','diplome',309),(197,'GET','Île-de-France','loc',309),(198,'GET','Master enseignement','diplome',310),(199,'GET','Île-de-France','loc',310),(200,'GET','Master enseignement','diplome',311),(201,'GET','Île-de-France','loc',311),(202,'GET','Master enseignement','diplome',312),(203,'GET','Île-de-France','loc',312),(204,'GET','Master enseignement','diplome',313),(205,'GET','Île-de-France','loc',313),(206,'GET','Master enseignement','diplome',314),(207,'GET','Île-de-France','loc',314),(208,'GET','Master enseignement','diplome',315),(209,'GET','Île-de-France','loc',315),(210,'GET','Master enseignement','diplome',316),(211,'GET','Île-de-France','loc',316),(220,'GET','Master enseignement','diplome',322),(221,'GET','Île-de-France','loc',322),(222,'GET','Île-de-France','loc',323),(223,'GET','Île-de-France','loc',324),(224,'GET','Île-de-France','loc',325),(225,'GET','Île-de-France','loc',326),(226,'GET','Île-de-France','loc',327),(228,'GET','Île-de-France','loc',329),(229,'GET','Master enseignement','diplome',330),(230,'GET','Île-de-France','loc',330),(231,'GET','Île-de-France','loc',331),(232,'GET','Île-de-France','loc',332),(233,'GET','Île-de-France','loc',333),(234,'GET','Île-de-France','loc',334),(235,'GET','30000','rows',334),(236,'GET','Île-de-France','loc',335),(237,'GET','30000','rows',335),(238,'GET','Île-de-France','loc',336),(239,'GET','3000','rows',336),(240,'GET','Île-de-France','loc',337),(241,'GET','30000','rows',337),(250,'GET','Île-de-France','loc',342),(251,'GET','500','rows',342),(252,'GET','Île-de-France','loc',343),(253,'GET','200','rows',343),(254,'GET','Île-de-France','loc',344),(255,'GET','500','rows',344),(256,'GET','Île-de-France','loc',345),(257,'GET','200','rows',345),(258,'GET','Pharmacie','domaine',346),(259,'GET','Licence','diplome',346),(260,'GET','Île-de-France','loc',346),(261,'GET','Arts','domaine',347),(262,'GET','Licence','diplome',347),(263,'GET','Île-de-France','loc',347),(264,'GET','Île-de-France','loc',348),(265,'GET','6ème année','years',350),(266,'GET','5ème année','years',351),(267,'GET','7ème année et plus','years',352),(268,'GET','7ème année et plus','years',353),(269,'GET','200','rows',353),(270,'GET','7ème année et plus','years',354),(271,'GET','1ème année et plus','years',355),(272,'GET','200','rows',355),(273,'GET','1ème année','years',356),(274,'GET','1ère année','years',357),(275,'GET','1ère année','years',358),(276,'GET','200','rows',358),(277,'GET','1ère année','years',359),(278,'GET','200','rows',359),(279,'GET','1ère année','years',360),(280,'GET','200','rows',360),(281,'GET','1ère année','years',361),(282,'GET','200','rows',361),(283,'GET','1ère année','years',362),(284,'GET','200','rows',362),(285,'GET','1ère année','years',363),(286,'GET','201','rows',363),(287,'GET','1ère année','years',364),(288,'GET','200','rows',364),(289,'GET','1ère année','years',365),(290,'GET','200','rows',365),(291,'GET','1ère année','years',367),(292,'GET','200','rows',367),(293,'GET','1ère année','years',368),(294,'GET','1','rows',368),(295,'GET','1ère année','years',369),(296,'GET','1','rows',369),(297,'GET','1ère année','years',370),(298,'GET','1','rows',370),(299,'GET','1ère année','years',371),(300,'GET','1','rows',371),(301,'GET','1ère année','years',372),(302,'GET','1','rows',372),(303,'GET','1ère année','years',373),(304,'GET','1','rows',373),(305,'GET','1ère année','years',374),(306,'GET','1','rows',374),(307,'GET','1ère année','years',375),(308,'GET','1','rows',375),(309,'GET','1ère année','years',376),(310,'GET','1','rows',376),(311,'GET','1ère année','years',377),(312,'GET','1','rows',377),(313,'GET','1ère année','years',378),(314,'GET','1','rows',378),(315,'GET','1ère année','years',379),(316,'GET','1','rows',379),(317,'GET','1ère année','years',380),(318,'GET','200','rows',380),(319,'GET','1ère année','years',381),(320,'GET','20','rows',381),(321,'GET','1ère année','years',382),(322,'GET','20','rows',382),(323,'GET','4ème année','years',385),(324,'GET','6ème année','years',391);
/*!40000 ALTER TABLE `parameter` ENABLE KEYS */;
UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-03-01 22:37:56
