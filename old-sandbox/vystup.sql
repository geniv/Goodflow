-- MySQL dump 10.13  Distrib 5.5.35, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: trainz-cz
-- ------------------------------------------------------
-- Server version	5.5.35-0ubuntu0.13.10.2-log

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
-- Table structure for table `downloads`
--

DROP TABLE IF EXISTS `downloads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `downloads` (
  `iddownload` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iduser` int(10) unsigned DEFAULT NULL,
  `author` varchar(45) DEFAULT NULL,
  `rewrite` varchar(120) NOT NULL,
  `iddownload_category` int(10) unsigned NOT NULL,
  `picture` varchar(200) NOT NULL,
  `polygons` int(10) unsigned DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'potvrzeny',
  `visible` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'viditelny',
  `added` datetime NOT NULL,
  `edited` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`iddownload`),
  KEY `fk_iddownload_category_idx` (`iddownload_category`),
  KEY `fk_iduser_idx` (`iduser`),
  CONSTRAINT `fk_downloads_downloads_category` FOREIGN KEY (`iddownload_category`) REFERENCES `downloads_category` (`iddownload_category`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_downloads_users` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8 COMMENT='download objektu';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `downloads`
--

LOCK TABLES `downloads` WRITE;
/*!40000 ALTER TABLE `downloads` DISABLE KEYS */;
INSERT INTO `downloads` VALUES (9,1,NULL,'9-ghgkhj',70,'a24fec578ed8c40d02925589777c29415284e5fbdf28b.png',NULL,1,1,'2013-09-21 01:00:46',NULL,NULL),(10,1,NULL,'10-sfdhgjkl',70,'def0b714c55d434ad3ef9d2205cc8c4e523d8738321f7.jpg',0,1,1,'2013-09-21 13:47:04',NULL,NULL),(11,1,NULL,'11-asgdfgvhj',70,'b86a4c8c9b499b0a535e67d769bb42e4523d8748b529b.jpg',0,1,1,'2013-09-21 13:47:20',NULL,NULL),(12,1,NULL,'12-dsadfhjklu',70,'c9da61119e3a78b245bde79189fde5e5523d87616fcca.jpg',0,1,1,'2013-09-21 13:47:45',NULL,NULL),(13,1,NULL,'13-ddfghj',70,'c86dc3ad596e8ff709b4839dccb5554a523d87705af88.jpg',0,1,1,'2013-09-21 13:48:00',NULL,NULL),(14,1,NULL,'14-dfgjkhlujkjlhk',70,'8a44dfb8b64101b2f67b0bad702a3978523d8782a751d.jpg',0,1,1,'2013-09-21 13:48:19',NULL,NULL),(15,1,NULL,'15-sfdfghgljkhghfg',70,'de5d3fb39fe9cdaf333514e78c63c4de523d879e43ef8.jpg',0,1,1,'2013-09-21 13:48:46',NULL,NULL),(16,1,NULL,'16-dsfr',70,'4261ebfc381b8afbea4db29c7138a31f523d88734a6a1.jpg',0,1,1,'2013-09-21 13:52:19',NULL,'2013-10-13 12:42:35'),(18,0,'fugess','18-dfgfdgds',70,'b2f535587956c8f187c2b77b0ce23f01523d88bf6d282.jpg',0,1,1,'2013-09-21 13:53:35',NULL,NULL),(19,NULL,'dsfd gs','19-mega-giga',74,'588029e06e03e8cc3fb54bdd784a75715284ff1e658e9.jpg',NULL,1,1,'2013-09-24 11:20:48',NULL,NULL),(35,NULL,'dfsgh s','35-gsdfgdsfg-1',74,'75e07d09033cd311a3c3e73a98f41d55528e99d096f1e.jpg',NULL,1,1,'2013-09-24 11:36:46',NULL,NULL),(38,NULL,'gsdfgdsfg','38-gsdfgdsfg-2',74,'f4f6ff15e9ee9e94ec66d5ad1ff5d66c528e99c133937.jpg',NULL,1,1,'2013-09-24 11:38:24',NULL,NULL),(39,0,'gsdfgdsfg','39-gsdfgdsfg-3',70,'844f3f5f4016379f6a83cd25f1fbc12652415f082aba5.jpg',0,1,0,'2013-09-24 11:44:40',NULL,NULL),(41,2,NULL,'41-gsdfgdsfg-4',70,'f801a778037e7bfdae5589d11a317780524160c84d8d6.jpg',0,1,0,'2013-09-24 11:52:08',NULL,'2013-10-13 12:42:27'),(44,2,NULL,'44-gsdfgdsfg-5',70,'2f3f40fcb49a78fc4ca423ac3c90ea3a5284e708a6c1b.png',NULL,1,1,'2013-09-21 13:53:04','2013-11-14 16:06:49',NULL),(45,0,'gfdsgdf','45-fsgsggfgsdfg',70,'1ca0d079478a3a3526f606f7c7a4b240524423dd9d579.png',0,1,0,'2013-09-26 14:09:01',NULL,NULL),(46,0,'sdfgtf','46-dfgfdsgdf',70,'f801a778037e7bfdae5589d11a3177805244244f7ff9c.jpg',0,1,0,'2013-09-26 14:10:55',NULL,NULL),(47,0,'dsfdsfdsfdsf','47-sdfsd',70,'966f56c4c8833a369e0791e3f90904cc52442654a5383.png',0,1,1,'2013-09-26 14:19:33',NULL,'2013-10-13 12:42:18'),(48,NULL,'test','48-test',72,'d134ea5f25969d132908f5e2052693ee526503c3c7f28.png',NULL,1,1,'2013-09-28 18:50:38',NULL,NULL),(49,2,NULL,'49-sadsa',72,'a24fec578ed8c40d02925589777c2941526503694fb0c.png',NULL,1,1,'2013-09-28 19:01:21',NULL,NULL),(50,0,'Fugess (Martin)','50-ids-pracovni-bunka',90,'f39944630fb69011158d80912b7a8ab452470d408482d.jpg',0,1,1,'2013-09-28 19:09:20',NULL,NULL),(51,2,NULL,'51-ghghghgh',72,'fa5c875ede9bcddba9dff61698f378f7526503847cd14.jpg',NULL,1,1,'2013-09-28 19:20:16',NULL,NULL),(62,0,'dfdfsdf','62-dsfdsf',70,'325fd12d46a755062ca617b62efd5aff524b56e8bce27.jpg',0,1,0,'2013-10-02 01:12:41',NULL,NULL),(63,0,'vbvcbvb','63-vb',70,'46a120b9be1147b401d763bbe04d63b1524b58b240b3e.png',0,1,0,'2013-10-02 01:20:18',NULL,'2013-10-13 12:42:08'),(64,0,'frantik','64-dfdsf',70,'8947c0cae0c98455fa5e941ce0b2998e524b5926c2426.jpg',0,1,0,'2013-10-02 01:22:14',NULL,NULL),(78,0,'donkey (lazarus)','78-fiiiiiiiiiiiiha',70,'f2e3304a9b588104cf2627685988d4f7524bdc18321db.jpg',0,1,0,'2013-10-02 10:40:56',NULL,NULL),(80,2,NULL,'80-dsf-fdg-dfsdfsdf',70,'3a423064db3c5cfc6cee4925adaf2f615284e6e30ae7f.png',NULL,1,1,'2013-10-02 11:44:35','2013-11-14 16:06:11',NULL),(81,0,'test','81-sdsad',90,'f4f6ff15e9ee9e94ec66d5ad1ff5d66c52482884597c9.jpg',0,1,1,'2013-09-29 15:17:56','2013-10-02 11:48:47',NULL),(82,1,NULL,'82-test1',70,'9b7ad7ac067087be29e8106c546fb599525aa27a31b8b.png',0,1,1,'2013-10-12 20:32:04',NULL,NULL),(83,2,NULL,'83-test2',70,'174f39d7c102cabba85531b87041e472527fde9f22334.jpg',NULL,1,1,'2013-10-12 20:33:13',NULL,NULL),(89,2,NULL,'89-r-e-t',72,'325fd12d46a755062ca617b62efd5aff5261b89340ec5.jpg',225,1,1,'2013-09-28 19:32:40','2013-10-25 13:46:14',NULL),(91,43,NULL,'91-sdgfs-dfdfdsf',71,'cda829956444da61473fb688429b70f25283e9934250f.png',1,1,1,'2013-09-29 17:16:30','2013-11-14 16:46:14',NULL);
/*!40000 ALTER TABLE `downloads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `downloads_category`
--

DROP TABLE IF EXISTS `downloads_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `downloads_category` (
  `iddownload_category` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent` int(10) unsigned DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT '0',
  `rewrite` varchar(50) NOT NULL,
  `rank` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'rucni razeni',
  PRIMARY KEY (`iddownload_category`),
  UNIQUE KEY `rewrite_UNIQUE` (`rewrite`),
  KEY `fk_iddownload_category_idx` (`parent`),
  CONSTRAINT `fk_downloads_category_downloads_category` FOREIGN KEY (`parent`) REFERENCES `downloads_category` (`iddownload_category`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8 COMMENT='category pro downloads';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `downloads_category`
--

LOCK TABLES `downloads_category` WRITE;
/*!40000 ALTER TABLE `downloads_category` DISABLE KEYS */;
INSERT INTO `downloads_category` VALUES (70,NULL,0,'okoli',0),(71,NULL,1,'nadrazi',1),(72,70,1,'budovy-aaa',0),(74,91,4,'nadrazni-budovy',0),(75,74,2,'test',3),(76,71,1,'sfgsdgssdfs',1),(77,74,2,'dsgdgd',0),(78,74,2,'adsaf',2),(79,NULL,0,'gdfjghfj',2),(81,74,5,'dsgdgd1',1),(83,NULL,0,'dsgdgd2',4),(85,NULL,0,'dsgdgd3',3),(90,72,2,'sdsdsad-fd123',0),(91,90,3,'fdg-dgdf-predposledni',0),(92,76,2,'sasas456',0),(93,92,3,'dffdfdfdf789',0),(94,93,4,'yxcvb7563-posledni',0),(95,74,0,'nad-nadrazni-budovy',4);
/*!40000 ALTER TABLE `downloads_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `downloads_has_trainz_cdp`
--

DROP TABLE IF EXISTS `downloads_has_trainz_cdp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `downloads_has_trainz_cdp` (
  `iddownload` int(10) unsigned NOT NULL,
  `idtrainz_cdp` int(10) unsigned NOT NULL,
  PRIMARY KEY (`iddownload`,`idtrainz_cdp`),
  KEY `fk_trainz_cdp_has_downloads_downloads1_idx` (`iddownload`),
  KEY `fk_trainz_cdp_has_downloads_trainz_cdp1_idx` (`idtrainz_cdp`),
  CONSTRAINT `fk_trainz_cdp_has_downloads_downloads` FOREIGN KEY (`iddownload`) REFERENCES `downloads` (`iddownload`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_trainz_cdp_has_downloads_trainz_cdp` FOREIGN KEY (`idtrainz_cdp`) REFERENCES `trainz_cdp` (`idtrainz_cdp`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='downloads vaze trainz cdp';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `downloads_has_trainz_cdp`
--

LOCK TABLES `downloads_has_trainz_cdp` WRITE;
/*!40000 ALTER TABLE `downloads_has_trainz_cdp` DISABLE KEYS */;
INSERT INTO `downloads_has_trainz_cdp` VALUES (9,185),(10,9),(11,10),(12,11),(13,12),(14,13),(15,14),(16,15),(18,29),(19,192),(35,19),(38,20),(39,32),(41,33),(44,187),(45,24),(46,31),(47,28),(47,47),(48,145),(48,146),(48,147),(48,148),(48,149),(48,150),(48,151),(48,152),(48,153),(48,154),(48,155),(48,156),(48,157),(48,158),(48,159),(48,160),(48,161),(48,162),(48,163),(48,164),(49,116),(50,39),(51,117),(51,167),(51,168),(62,57),(62,58),(62,59),(63,60),(64,61),(64,62),(78,69),(80,186),(81,72),(82,101),(83,74),(89,177),(89,178),(89,179),(89,180),(89,181),(91,191);
/*!40000 ALTER TABLE `downloads_has_trainz_cdp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `downloads_has_trainz_kuid`
--

DROP TABLE IF EXISTS `downloads_has_trainz_kuid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `downloads_has_trainz_kuid` (
  `iddownload` int(10) unsigned NOT NULL,
  `idtrainz_kuid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`iddownload`,`idtrainz_kuid`),
  KEY `fk_downloads_has_trainz_kuid_trainz_kuid1_idx` (`idtrainz_kuid`),
  KEY `fk_downloads_has_trainz_kuid_downloads1_idx` (`iddownload`),
  CONSTRAINT `fk_downloads_has_trainz_kuid_downloads` FOREIGN KEY (`iddownload`) REFERENCES `downloads` (`iddownload`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_downloads_has_trainz_kuid_trainz_kuid` FOREIGN KEY (`idtrainz_kuid`) REFERENCES `trainz_kuids` (`idtrainz_kuid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='downloads vaze externi kuidy';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `downloads_has_trainz_kuid`
--

LOCK TABLES `downloads_has_trainz_kuid` WRITE;
/*!40000 ALTER TABLE `downloads_has_trainz_kuid` DISABLE KEYS */;
INSERT INTO `downloads_has_trainz_kuid` VALUES (78,456),(89,489),(89,1123),(80,1229),(89,1233),(91,1236),(91,1456),(89,1597),(89,1601),(83,1611),(83,1612),(83,1613),(83,1614),(83,1615),(83,1616),(83,1617),(83,1618),(83,1619),(83,1620),(83,1621),(83,1622),(83,1623),(83,1624),(83,1625),(83,1626),(83,1627),(83,1628),(83,1629),(83,1630),(83,1631),(83,1632),(83,1633),(83,1634);
/*!40000 ALTER TABLE `downloads_has_trainz_kuid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `languages` (
  `idlanguage` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(5) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`idlanguage`),
  UNIQUE KEY `code_UNIQUE` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='prekladove jazyky';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (1,'cs','CZ'),(2,'en','EN'),(3,'de','DE');
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages_has_downloads`
--

DROP TABLE IF EXISTS `languages_has_downloads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `languages_has_downloads` (
  `idlanguage` int(10) unsigned NOT NULL,
  `iddownload` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'duplicitu kontrolovat programove',
  `description` text NOT NULL,
  PRIMARY KEY (`idlanguage`,`iddownload`),
  KEY `fk_downloads_has_languages_languages1_idx` (`idlanguage`),
  KEY `fk_downloads_has_languages_downloads1_idx` (`iddownload`),
  CONSTRAINT `fk_downloads_has_languages_downloads` FOREIGN KEY (`iddownload`) REFERENCES `downloads` (`iddownload`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_downloads_has_languages_languages` FOREIGN KEY (`idlanguage`) REFERENCES `languages` (`idlanguage`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='preklad downloads';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages_has_downloads`
--

LOCK TABLES `languages_has_downloads` WRITE;
/*!40000 ALTER TABLE `languages_has_downloads` DISABLE KEYS */;
INSERT INTO `languages_has_downloads` VALUES (1,9,'ghgkhj','<p>fghfggs</p>'),(1,10,'sfdhgjkl','<p>fgdzzuil</p>'),(1,11,'asgdfgvhj','<p>dfsfhhljl</p>'),(1,12,'dsadfhjklů§','<p>&sect;ůlůkjhkjfds</p>'),(1,13,'DDFGHJ','<p>&sect;ŮLKJHGFDSA</p>'),(1,14,'dfgjkhlůjkjlhk','<p>jghfgdfdgfhgh</p>'),(1,15,'sfdfghgljkhghfg','<p>dsddfghkgjfhdg</p>'),(1,16,'dsfr','<p>gdfgfdg</p>'),(1,18,'dfgfdgds','<p>gsdfdsfsd</p>'),(1,19,'mega giga','<p>sdsad</p>'),(1,35,'gsdfgdsfg 1','<p>fd fds dsf</p>'),(1,38,'gsdfgdsfg 2','<p>gsdfgdsfg</p>'),(1,39,'gsdfgdsfg 3','<p>gsdfgdsfg</p>'),(1,41,'gsdfgdsfg 4','<p>gsdfgdsfg</p>'),(1,44,'gsdfgdsfg 5','<p>gsdfgdsfg</p>'),(1,45,'fsgsggfgsdfg','<p>fgfdg</p>'),(1,46,'dfgfdsgdf','<p>dfgdfg</p>'),(1,47,'sdfsd','<p>fsdfdsfsdf</p>'),(1,48,'test','<p>test</p>'),(1,49,'sadsa','<p>dsad</p>'),(1,50,'IDS pracovní buňka','<p>Jednoduch&aacute; plechov&aacute; pracovn&iacute; buňa firmy IDS - Inžen&yacute;rsk&eacute; a dopravn&iacute; stavby Olomouc a.s.</p>'),(1,51,'ghghghgh','<p>Překlad origin&aacute;ln&iacute;ho n&aacute;vodu ke kolej&iacute;m v&scaron;ech druhů průmyslu od Larse Ljungberga. T&yacute;k&aacute; se v&yacute;lučně kolej&iacute; BI2 (LARS2). D&iacute;ky patř&iacute; Larsovi (zn&aacute;memu taky jako LLJ) z <a href=\"http://www.trainzproroutes.org/tprdownloads/\">TrainzProroutes</a> za svolen&iacute; k překladu a um&iacute;stěn&iacute; na na&scaron;em serveru.</p>'),(1,62,'dsfdsf','<p>fdfdsf</p>'),(1,63,'vb','<p>cbvcb</p>'),(1,64,'dfdsf','<p>dfdsf</p>'),(1,78,'fiiiiiiiiiiiiha','<p>ffffiiiiihhhhhhhaaaaaa</p>'),(1,80,'dsf fdg dfsdfsdf','<p>fdsfsdf</p>'),(1,81,'sdsad','<p>asdsad</p>'),(1,82,'test1','<p>test1</p>'),(1,83,'test2','<p>test2</p>'),(1,89,'r\"e\'t','<p>jedn&aacute; se o l&iacute;tac&iacute; sl&eacute;pku</p>\r\n<p>s obrazkem \"snajprujici\" holky</p>\r\n<p>a dal&scaron;i f&iacute;čury</p>'),(1,91,'sdgfs dfdfdsf','<p>pon&iacute;k z steam punku</p>'),(2,9,'ghgkhj','<p>fghfggs</p>'),(2,10,'sfdhgjkl - en','<p>fgdzzuil</p>'),(2,11,'asgdfgvhj - en','<p>dfsfhhljl</p>'),(2,12,'dsadfhjklů§ - en','<p>&sect;ůlůkjhkjfds</p>'),(2,13,'DDFGHJ - en','<p>&sect;ŮLKJHGFDSA</p>'),(2,14,'dfgjkhlůjkjlhk - en','<p>jghfgdfdgfhgh</p>'),(2,15,'sfdfghgljkhghfg - en','<p>dsddfghkgjfhdg</p>'),(2,16,'dsfr - en','<p>gdfgfdg</p>'),(2,18,'dfgfdgds - en','<p>gsdfdsfsd</p>'),(2,19,'gsdfgdsfg','<p>dssd</p>'),(2,35,'gsdfgdsfg','<p>df dsf dsf</p>'),(2,38,'gsdfgdsfg','<p>gsdfgdsfg</p>'),(2,39,'gsdfgdsfg','<p>gsdfgdsfg</p>'),(2,41,'gsdfgdsfg 4 - en','<p>gsdfgdsfg</p>'),(2,44,'ddgdgsd - en','<p>fsfsdf</p>'),(2,45,'fdsgsfdgsfdg','<p>fgfdg</p>'),(2,46,'fdg','<p>fdsgfdgdsfg</p>'),(2,47,'dfsdfsdf','<p>sdfdsfsdf</p>'),(2,48,'test','<p>test</p>'),(2,49,'sadsad','<p>sadasdsad</p>'),(2,50,'dfsgdfsg','<p>The first section describes how to build a studio in GMAX objects into Trainz.</p>\r\n<p>We ask you to respect copyright and use of the tutorial including its attachments, only the private tuition. It is not permitted to use the tutorial, including its attachments, if only part of the presented publicly as part of the work of another author.</p>\r\n<p>Translation and Editing: Miop<br />Expert consultation: StelerP, BaldXX</p>'),(2,51,'ghghg','<p>hdghdfgh</p>'),(2,62,'dsfdsf','<p>fdsfdsf</p>'),(2,63,'bvbcv','<p>vbvcb</p>'),(2,64,'fdsf','<p>sdfd</p>'),(2,78,'gfhfd','<p>hgfhg</p>'),(2,80,'dsf fdg dfsdfsdf - en','<p>fdsfsdf</p>'),(2,81,'dsdasd','<p>sadsad</p>'),(2,82,'test1','<p>test1</p>'),(2,83,'test2','<p>test2</p>'),(2,89,'ret\'ew\"rtwer','<p>twertwert</p>'),(2,91,'sdgfs dfdfdsf','<p>d dfd dsdfsdfdsf</p>'),(3,9,'ghgkhj','<p>fghfggs</p>'),(3,10,'sfdhgjkl - de','<p>fgdzzuil</p>'),(3,11,'asgdfgvhj - de','<p>dfsfhhljl</p>'),(3,12,'dsadfhjklů§ - de','<p>&sect;ůlůkjhkjfds</p>'),(3,13,'DDFGHJ - de','<p>&sect;ŮLKJHGFDSA</p>'),(3,14,'dfgjkhlůjkjlhk - de','<p>jghfgdfdgfhgh</p>'),(3,15,'sfdfghgljkhghfg - de','<p>dsddfghkgjfhdg</p>'),(3,16,'dsfr - de','<p>gdfgfdg</p>'),(3,18,'dfgfdgds - de','<p>gsdfdsfsd</p>'),(3,19,'gsdfgdsfg','<p>ds sd sd</p>'),(3,35,'gsdfgdsfg','<p>dsf sdf</p>'),(3,38,'gsdfgdsfg','<p>gsdfgdsfg</p>'),(3,39,'gsdfgdsfg','<p>gsdfgdsfg</p>'),(3,41,'gsdfgdsfg 4 - de','<p>gsdfgdsfg</p>'),(3,44,'ddgdgsd - de','<p>fsfsdf</p>'),(3,45,'fdgsdfg','<p>fdgdfg</p>'),(3,46,'fdgfd','<p>g fsdg fsdgfdg</p>'),(3,47,'sdfdsfds','<p>fdsfsdfsdf</p>'),(3,48,'test','<p>test</p>'),(3,49,'sads','<p>adsad</p>'),(3,50,'gfdsgfsd','<p>Einfache Metallbearbeitung Buna Firma IDS - Ingenieur-und Baustellenverkehr wie Olomouc</p>'),(3,51,'ghhghgh','<p>ghghf</p>'),(3,62,'dsf','<p>dsfdf</p>'),(3,63,'vbcv','<p>bvcbcvb</p>'),(3,64,'dfdsf','<p>dfdf</p>'),(3,78,'gfhf','<p>hfhgh</p>'),(3,80,'dsf fdg dfsdfsdf - de','<p>fdsfsdf</p>'),(3,81,'sds','<p>dsdsd</p>'),(3,82,'test1','<p>test1</p>'),(3,83,'test2','<p>test2</p>'),(3,89,'ret\'we\"r','<p>twert</p>'),(3,91,'sdgfs dfdfdsf','<p>d dfd dsdfsdfdsf</p>');
/*!40000 ALTER TABLE `languages_has_downloads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages_has_downloads_category`
--

DROP TABLE IF EXISTS `languages_has_downloads_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `languages_has_downloads_category` (
  `idlanguage` int(10) unsigned NOT NULL,
  `iddownload_category` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idlanguage`,`iddownload_category`),
  KEY `fk_languages_has_downloads_category_downloads_category_idx` (`iddownload_category`),
  KEY `fk_languages_has_downloads_category_languages_idx` (`idlanguage`),
  CONSTRAINT `fk_languages_has_downloads_category_downloads_category` FOREIGN KEY (`iddownload_category`) REFERENCES `downloads_category` (`iddownload_category`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_languages_has_downloads_category_languages` FOREIGN KEY (`idlanguage`) REFERENCES `languages` (`idlanguage`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='preklad download category';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages_has_downloads_category`
--

LOCK TABLES `languages_has_downloads_category` WRITE;
/*!40000 ALTER TABLE `languages_has_downloads_category` DISABLE KEYS */;
INSERT INTO `languages_has_downloads_category` VALUES (1,70,'okoli',NULL),(1,71,'nádraží',NULL),(1,72,'budovy aaa',NULL),(1,74,'nadrazni budovy',NULL),(1,75,'test',NULL),(1,76,'sfgsdgssdfs',NULL),(1,77,'dsgdgd',NULL),(1,78,'adsaf',NULL),(1,79,'gdfjghfj',NULL),(1,81,'dsgdgd1',NULL),(1,83,'dsgdgd2',NULL),(1,85,'dsgdgd3',NULL),(1,90,'sdsdsad fd123',NULL),(1,91,'fdg dgdf predposledni',NULL),(1,92,'sasas456',NULL),(1,93,'dffdfdfdf789',NULL),(1,94,'yxcvb7563 POSLEDNI!',NULL),(1,95,'nad nadrazni budovy',NULL),(2,70,'dsdsd',NULL),(2,71,'sdf sdf sdf',NULL),(2,72,'fgs fdg',NULL),(2,74,'dfdf ',NULL),(2,75,'test',NULL),(2,76,'dsfsdaf',NULL),(2,77,'sdfsasa',NULL),(2,78,'dsfdsf',NULL),(2,79,'dsfsdf',NULL),(2,81,'dsgdgd',NULL),(2,83,'dsgdgd',NULL),(2,85,'dsgdgd',NULL),(2,90,'dsf fdhg',NULL),(2,91,'dsdad123',NULL),(2,92,'fdg fdg',NULL),(2,93,'fds dfdsf',NULL),(2,94,'sdfds',NULL),(2,95,'fsd fsdg',NULL),(3,70,'sadsadasd',NULL),(3,71,'uztiůpighf',NULL),(3,72,'fdh rze',NULL),(3,74,'dsf sdfsdf',NULL),(3,75,'test',NULL),(3,76,'asdsad',NULL),(3,77,'sadsad',NULL),(3,78,'sadsa',NULL),(3,79,'fsdgf',NULL),(3,81,'dsgdgd',NULL),(3,83,'dsgdgd',NULL),(3,85,'dsgdgd',NULL),(3,90,'hgfhf ddg',NULL),(3,91,'dfds545',NULL),(3,92,'gf stdhfd',NULL),(3,93,'dsf dsfdsf',NULL),(3,94,'df dsf',NULL),(3,95,'fdgfdg fdhg',NULL);
/*!40000 ALTER TABLE `languages_has_downloads_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages_has_links_category`
--

DROP TABLE IF EXISTS `languages_has_links_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `languages_has_links_category` (
  `idlanguage` int(10) unsigned NOT NULL,
  `idlink_category` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`idlanguage`,`idlink_category`),
  KEY `fk_languages_has_links_category_links_category1_idx` (`idlink_category`),
  KEY `fk_languages_has_links_category_languages1_idx` (`idlanguage`),
  CONSTRAINT `fk_languages_has_links_category_languages` FOREIGN KEY (`idlanguage`) REFERENCES `languages` (`idlanguage`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_languages_has_links_category_links_category` FOREIGN KEY (`idlink_category`) REFERENCES `links_category` (`idlink_category`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='preklad links category';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages_has_links_category`
--

LOCK TABLES `languages_has_links_category` WRITE;
/*!40000 ALTER TABLE `languages_has_links_category` DISABLE KEYS */;
INSERT INTO `languages_has_links_category` VALUES (1,1,'České stránky'),(1,2,'Zahraniční stránky'),(2,1,'Czech site'),(2,2,'Foreign sites'),(3,1,'Tschechischen Standort'),(3,2,'Ausländische Webseiten');
/*!40000 ALTER TABLE `languages_has_links_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages_has_news`
--

DROP TABLE IF EXISTS `languages_has_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `languages_has_news` (
  `idlanguage` int(10) unsigned NOT NULL,
  `idnews` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`idlanguage`,`idnews`),
  KEY `fk_languages_has_news_news1_idx` (`idnews`),
  KEY `fk_languages_has_news_languages1_idx` (`idlanguage`),
  CONSTRAINT `fk_languages_has_news_languages` FOREIGN KEY (`idlanguage`) REFERENCES `languages` (`idlanguage`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_languages_has_news_news` FOREIGN KEY (`idnews`) REFERENCES `news` (`idnews`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='preklad news';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages_has_news`
--

LOCK TABLES `languages_has_news` WRITE;
/*!40000 ALTER TABLE `languages_has_news` DISABLE KEYS */;
INSERT INTO `languages_has_news` VALUES (1,1,'test','<p>test</p>\r\n<p>test</p>\r\n<p>teest</p>\r\n<p>test</p>'),(1,9,'fgfdg','<p>gfdgfdgfd</p>'),(2,1,'test','<p>test</p>'),(2,9,'fdgfdg','<p>gfdgfdsgfds</p>'),(3,1,'test','<p>test</p>'),(3,9,'fdgfdsg','<p>fdsgfdgdfsg</p>');
/*!40000 ALTER TABLE `languages_has_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lastlogins`
--

DROP TABLE IF EXISTS `lastlogins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lastlogins` (
  `idlastlogin` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iduser` int(10) unsigned NOT NULL,
  `ip` varchar(50) NOT NULL COMMENT 'ip adresa',
  `agent` varchar(300) NOT NULL COMMENT 'user agent',
  `screen` varchar(150) NOT NULL COMMENT 'screen objekt',
  `from_web` tinyint(1) NOT NULL,
  `added` datetime NOT NULL,
  PRIMARY KEY (`idlastlogin`),
  KEY `fk_iduser_idx` (`iduser`),
  CONSTRAINT `fk_lastlogins_users` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='logovani prihlasovani';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lastlogins`
--

LOCK TABLES `lastlogins` WRITE;
/*!40000 ALTER TABLE `lastlogins` DISABLE KEYS */;
/*!40000 ALTER TABLE `lastlogins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `links`
--

DROP TABLE IF EXISTS `links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `links` (
  `idlink` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idlink_category` int(10) unsigned NOT NULL,
  `iduser` int(10) unsigned DEFAULT NULL COMMENT 'autor linku',
  `name` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `picture` varchar(200) DEFAULT NULL,
  `rank` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`idlink`),
  UNIQUE KEY `url_UNIQUE` (`url`),
  KEY `fk_idlink_category_idx` (`idlink_category`),
  KEY `fk_iduser_idx` (`iduser`),
  CONSTRAINT `fk_links_links_category` FOREIGN KEY (`idlink_category`) REFERENCES `links_category` (`idlink_category`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_links_users` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='odkazy';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `links`
--

LOCK TABLES `links` WRITE;
/*!40000 ALTER TABLE `links` DISABLE KEYS */;
INSERT INTO `links` VALUES (1,1,2,'c2','http://www.gfdesign.cz','7361c92e946df885337c3dbfec19f331523df91b2c9c3.jpg',2),(2,1,2,'c1','http://www.jakpsatweb.cz/','325fd12d46a755062ca617b62efd5aff523df9f17d169.jpg',0),(4,2,2,'zahr2','http://www.jakpsatweb1.cz/','90ffa31684f413eae5f884a1ccd58c2f523dfa14418a1.jpg',1),(5,2,2,'dsfdhgsfgsdg','http://www.gfdesig1n.cz/','f4f6ff15e9ee9e94ec66d5ad1ff5d66c523dfb234ae67.jpg',0),(7,1,2,'c3','http://www.jakpsatweb11.cz/','',1);
/*!40000 ALTER TABLE `links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `links_category`
--

DROP TABLE IF EXISTS `links_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `links_category` (
  `idlink_category` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idlink_category`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='kategorie odkazu';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `links_category`
--

LOCK TABLES `links_category` WRITE;
/*!40000 ALTER TABLE `links_category` DISABLE KEYS */;
INSERT INTO `links_category` VALUES (1),(2);
/*!40000 ALTER TABLE `links_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `idnews` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iduser` int(10) unsigned NOT NULL,
  `idnews_icon` int(10) unsigned NOT NULL,
  `added` datetime NOT NULL,
  `edited` datetime DEFAULT NULL,
  PRIMARY KEY (`idnews`),
  KEY `fk_iduser_idx` (`iduser`),
  KEY `fk_idnews_icon_idx` (`idnews_icon`),
  CONSTRAINT `fk_news_news_icons` FOREIGN KEY (`idnews_icon`) REFERENCES `news_icons` (`idnews_icon`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_news_users` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='novinky';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,1,4,'2013-09-21 13:27:34','2013-09-21 13:30:33'),(9,2,7,'2013-09-21 18:50:49','2013-09-21 19:12:22');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news_icons`
--

DROP TABLE IF EXISTS `news_icons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news_icons` (
  `idnews_icon` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `path` varchar(50) NOT NULL,
  PRIMARY KEY (`idnews_icon`),
  UNIQUE KEY `name_UNIQUE` (`path`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='ikonky novinek';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news_icons`
--

LOCK TABLES `news_icons` WRITE;
/*!40000 ALTER TABLE `news_icons` DISABLE KEYS */;
INSERT INTO `news_icons` VALUES (1,'ikona_novinky_1','ikona_novinky_1.png'),(2,'ikona_novinky_2','ikona_novinky_2.png'),(3,'ikona_novinky_3','ikona_novinky_3.png'),(4,'ikona_novinky_4','ikona_novinky_4.png'),(5,'ikona_novinky_5','ikona_novinky_5.png'),(6,'ikona_novinky_6','ikona_novinky_6.png'),(7,'ikona_novinky_7','ikona_novinky_7.png'),(8,'ikona_novinky_8','ikona_novinky_8.png'),(9,'ikona_novinky_9','ikona_novinky_9.png'),(10,'ikona_novinky_10','ikona_novinky_10.png'),(11,'ikona_novinky_11','ikona_novinky_11.png'),(12,'ikona_novinky_12','ikona_novinky_12.png'),(13,'ikona_novinky_13','ikona_novinky_13.png'),(14,'ikona_novinky_14','ikona_novinky_14.png'),(15,'ikona_novinky_15','ikona_novinky_15.png'),(16,'ikona_novinky_16','ikona_novinky_16.png');
/*!40000 ALTER TABLE `news_icons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `idnotification` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_id` int(10) unsigned DEFAULT NULL COMMENT 'od koho',
  `to_id` int(10) unsigned DEFAULT NULL COMMENT 'pro koho',
  `handled_id` int(10) unsigned DEFAULT NULL COMMENT 'vyrizeno kym',
  `type` enum('registration','download','slideshow','message') NOT NULL COMMENT 'typ notifikce',
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `added` datetime NOT NULL COMMENT 'pridano kdy',
  `deleted` datetime DEFAULT NULL COMMENT 'vyrizeno kdy',
  `state` tinyint(1) DEFAULT NULL,
  `state_id` int(10) unsigned DEFAULT NULL COMMENT 'id noveho, add',
  `state_old_id` int(10) unsigned DEFAULT NULL COMMENT 'id stareho, edit',
  `state_msg` text,
  `ip` varchar(50) DEFAULT NULL,
  `agent` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`idnotification`),
  KEY `fk_from_idx` (`from_id`),
  KEY `fk_to_idx` (`to_id`),
  KEY `fk_handled_id_idx` (`handled_id`),
  CONSTRAINT `fk_notifications_from` FOREIGN KEY (`from_id`) REFERENCES `users` (`iduser`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `fk_notifications_handled` FOREIGN KEY (`handled_id`) REFERENCES `users` (`iduser`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `fk_notifications_to` FOREIGN KEY (`to_id`) REFERENCES `users` (`iduser`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='admin <--> user';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `idrole` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`idrole`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COMMENT='role uzivatelu (skupiny opravneni)';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (25,'down admin'),(26,'hlavni admin'),(24,'hlavní down administrátor'),(2,'Super administrátor'),(1,'Uživatel');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shoutboards`
--

DROP TABLE IF EXISTS `shoutboards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shoutboards` (
  `idshoutboard` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iduser` int(10) unsigned NOT NULL,
  `message` text NOT NULL,
  `added` datetime NOT NULL,
  PRIMARY KEY (`idshoutboard`),
  KEY `fk_iduser_idx` (`iduser`),
  CONSTRAINT `fk_shoutboards_users` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='admin <--> admin';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shoutboards`
--

LOCK TABLES `shoutboards` WRITE;
/*!40000 ALTER TABLE `shoutboards` DISABLE KEYS */;
/*!40000 ALTER TABLE `shoutboards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slideshows`
--

DROP TABLE IF EXISTS `slideshows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slideshows` (
  `idslideshow` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iduser` int(10) unsigned DEFAULT NULL,
  `author` varchar(45) DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'potvrzeny',
  `visible` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'viditelny',
  `path` varchar(200) NOT NULL,
  `description` varchar(100) NOT NULL,
  `added` datetime NOT NULL,
  `edited` datetime DEFAULT NULL,
  PRIMARY KEY (`idslideshow`),
  KEY `fk_iduser_idx` (`iduser`),
  CONSTRAINT `fk_slideshows_users` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='slidovaci obrazky';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slideshows`
--

LOCK TABLES `slideshows` WRITE;
/*!40000 ALTER TABLE `slideshows` DISABLE KEYS */;
INSERT INTO `slideshows` VALUES (1,2,NULL,1,1,'a4a7ca6535abe8be19bdae377bf5b493526edc0710575.jpg','toto je ec \"huangaria pico\"','2013-10-28 22:50:33',NULL),(2,43,NULL,1,1,'a23e8e7b5fad06a95d824b5fec7493c252bdf3c0d2789.png','a tady trocha kodu,...','2013-12-27 22:40:47',NULL),(3,2,NULL,1,1,'835aae0c51b408b3049f60bb4fe4c6be52bdf42edb4c1.jpg','p1','2013-12-27 22:42:20',NULL),(4,NULL,'neznama',1,0,'5abc94fec1792fd9f0641e2ef9d8dc1252bdf4dcdbfcd.jpg','ty oci :D','2013-12-27 22:45:46',NULL);
/*!40000 ALTER TABLE `slideshows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trainz_cdp`
--

DROP TABLE IF EXISTS `trainz_cdp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trainz_cdp` (
  `idtrainz_cdp` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `path` varchar(200) NOT NULL,
  `counter` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'pocitadlo',
  `rank` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'rucni razeni',
  PRIMARY KEY (`idtrainz_cdp`)
) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=utf8 COMMENT='fyzicke CDP soubory';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trainz_cdp`
--

LOCK TABLES `trainz_cdp` WRITE;
/*!40000 ALTER TABLE `trainz_cdp` DISABLE KEYS */;
INSERT INTO `trainz_cdp` VALUES (9,'im001960.jpg','def0b714c55d434ad3ef9d2205cc8c4e523d873882a66.jpg',0,0),(10,'im001901.jpg','b86a4c8c9b499b0a535e67d769bb42e4523d8748bb579.jpg',0,0),(11,'im001969.jpg','c9da61119e3a78b245bde79189fde5e5523d87618303a.jpg',0,0),(12,'im001995.jpg','c86dc3ad596e8ff709b4839dccb5554a523d8770703ab.jpg',0,0),(13,'im002021.jpg','8a44dfb8b64101b2f67b0bad702a3978523d878304b34.jpg',0,0),(14,'im002064.jpg','de5d3fb39fe9cdaf333514e78c63c4de523d879e614fc.jpg',0,0),(15,'6.jpg','9c600ddfe50984c5e605123cd35110bc523d8873f1e0d.jpg',0,0),(19,'BGL4u-eCQAA5yNe.png','46a120b9be1147b401d763bbe04d63b152415d2e07eb3.png',0,0),(20,'BMW-X3-2-0d-zerlegt-Einzelteile-729x486-d5cb1038ddcfef9f.jpg','d5cb1038ddcfef9f09a4732c8b1ed6bc52415d90081b6.jpg',0,0),(24,'deep_thought.png','1ca0d079478a3a3526f606f7c7a4b240524423ddbe771.png',0,0),(28,'Android threads.pdf','dcc5251fca20fd7c0a7b39f02e765e2b52442bc1d696a.pdf',1,0),(29,'06deter.pdf','2c552f4639390ea7548b0210f48d705452443a9185d79.pdf',0,0),(31,'Android threads.pdf','dcc5251fca20fd7c0a7b39f02e765e2b524460ea68eb3.pdf',0,0),(32,'brozek.pdf','adf83f61744e9e5e10c12c5c6a869d505244610a2391a.pdf',0,0),(33,'Animace 10 - FMEA.pps','9b34e64e7e3d8a4cfdbe7e8c306104115244639853a8e.pps',0,0),(39,'AK19.jpg','325fd12d46a755062ca617b62efd5aff52470d40ba82b.jpg',2,0),(47,'AK19.jpg','325fd12d46a755062ca617b62efd5aff524b529750ee8.jpg',0,0),(57,'AK19.jpg','325fd12d46a755062ca617b62efd5aff524b56e911afc.jpg',0,0),(58,'deep_thought.png','1ca0d079478a3a3526f606f7c7a4b240524b56e911f09.png',0,0),(59,'524673482_1db57946c6_z.jpg','081628881f11614b30515f89b80ebae7524b5843a2bd1.jpg',0,0),(60,'BGL4u-eCQAA5yNe.png','46a120b9be1147b401d763bbe04d63b1524b58b26438e.png',0,0),(61,'AK19.jpg','325fd12d46a755062ca617b62efd5aff524b5926d60fd.jpg',0,0),(62,'Daft_minion.jpg','f801a778037e7bfdae5589d11a317780524b5926d6537.jpg',0,0),(69,'1006273_587597237950285_1751619818_n.jpg','f2e3304a9b588104cf2627685988d4f7524bdc1841857.jpg',0,0),(72,'60909214_b4a00aaee8_z.jpg','f4f6ff15e9ee9e94ec66d5ad1ff5d66c524828848f07d.jpg',1,0),(74,'no-objekt-img.jpg','7cfa789403b24ab9e6d9a7c71e898a7a525995e9d5789.jpg',2,0),(101,'05matice2.pdf','13c3bdb20350a12c1215c318ba46cb33525acef4ea490.pdf',0,0),(116,'jquery-ui-1.9.2.custom.zip','dbb5455c35d5135ec8122599b340673552650369da0ff.zip',1,0),(117,'beech.jpg','fa5c875ede9bcddba9dff61698f378f752650384be77a.jpg',1,0),(145,'49d0cf514a3a3.jpg','4347e526a85bb8f67e32f9ced89df59952666bdab7a9e.jpg',0,0),(146,'49d0cf514a3a3.jpg','4347e526a85bb8f67e32f9ced89df59952666bdac2534.jpg',0,0),(147,'49d0cf514a3a3.jpg','4347e526a85bb8f67e32f9ced89df59952666bdac7ade.jpg',0,0),(148,'49d0cf514a3a3.jpg','4347e526a85bb8f67e32f9ced89df59952666bdac7fdd.jpg',0,0),(149,'49d0cf514a3a3.jpg','4347e526a85bb8f67e32f9ced89df59952666bdac84c7.jpg',0,0),(150,'49d0cf514a3a3.jpg','4347e526a85bb8f67e32f9ced89df59952666bdac8a5c.jpg',0,0),(151,'49d0cf514a3a3.jpg','4347e526a85bb8f67e32f9ced89df59952666bdac908f.jpg',0,0),(152,'49d0cf514a3a3.jpg','4347e526a85bb8f67e32f9ced89df59952666bdac95ff.jpg',0,0),(153,'49d0cf514a3a3.jpg','4347e526a85bb8f67e32f9ced89df59952666bdaca38e.jpg',0,0),(154,'49d0cf514a3a3.jpg','4347e526a85bb8f67e32f9ced89df59952666bdacae12.jpg',0,0),(155,'49d0cf514a3a3.jpg','4347e526a85bb8f67e32f9ced89df59952666bdacb3c6.jpg',0,0),(156,'49d0cf514a3a3.jpg','4347e526a85bb8f67e32f9ced89df59952666bdacca53.jpg',0,0),(157,'49d0cf514a3a3.jpg','4347e526a85bb8f67e32f9ced89df59952666bdaccf3c.jpg',0,0),(158,'49d0cf514a3a3.jpg','4347e526a85bb8f67e32f9ced89df59952666bdacd3ea.jpg',0,0),(159,'49d0cf514a3a3.jpg','4347e526a85bb8f67e32f9ced89df59952666bdacd87a.jpg',0,0),(160,'49d0cf514a3a3.jpg','4347e526a85bb8f67e32f9ced89df59952666bdacdddc.jpg',0,0),(161,'49d0cf514a3a3.jpg','4347e526a85bb8f67e32f9ced89df59952666bdacf9f0.jpg',0,0),(162,'49d0cf514a3a3.jpg','4347e526a85bb8f67e32f9ced89df59952666bdacfef1.jpg',0,0),(163,'49d0cf514a3a3.jpg','4347e526a85bb8f67e32f9ced89df59952666bdad04a5.jpg',0,0),(164,'49d0cf514a3a3.jpg','4347e526a85bb8f67e32f9ced89df59952666bdad0abb.jpg',0,0),(167,'BGL4u-eCQAA5yNe.png','46a120b9be1147b401d763bbe04d63b15266ca204d9f8.png',1,0),(168,'BMW-X3-2-0d-zerlegt-Einzelteile-729x486-d5cb1038ddcfef9f.jpg','d5cb1038ddcfef9f09a4732c8b1ed6bc5266ca7a993c9.jpg',1,0),(177,'AK19.jpg','325fd12d46a755062ca617b62efd5aff52653c050aeb0.jpg',5,0),(178,'cool_bodypainting____.jpg','d2ac4a56f1a99cf5ed0d8eea0f0d1eb452653c050ba7d.jpg',5,0),(179,'BGL4u-eCQAA5yNe.png','46a120b9be1147b401d763bbe04d63b152656da8420da.png',5,0),(180,'49d0cf514a3a3.jpg','4347e526a85bb8f67e32f9ced89df59952668de653e25.jpg',1,0),(181,'testuji mez\'ery aščěš.txt','d9beb698b708559c4db30d0bc2308a4f526a5a06bb822.txt',2,0),(185,'bgl4u-ecqaa5yne.png','46a120b9be1147b401d763bbe04d63b15284e5fc8fdd8.png',0,0),(186,'char_68288.jpg','90ffa31684f413eae5f884a1ccd58c2f524beb0370aa1.jpg',0,0),(187,'a2a7.jpg','b2f535587956c8f187c2b77b0ce23f01523d88a045fc2.jpg',0,0),(191,'pracesestringem.cxx','9546bb09f5874e5b43cdfa92df04f6b35284e2c5de740.cxx',2,0),(192,'chrome_vs_firefox.jpg','588029e06e03e8cc3fb54bdd784a75715284ff1eccf53.jpg',1,0);
/*!40000 ALTER TABLE `trainz_cdp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trainz_cdp_has_trainz_kuids`
--

DROP TABLE IF EXISTS `trainz_cdp_has_trainz_kuids`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trainz_cdp_has_trainz_kuids` (
  `idtrainz_kuid` int(10) unsigned NOT NULL,
  `idtrainz_cdp` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idtrainz_kuid`,`idtrainz_cdp`),
  KEY `fk_trainz_cdp_has_trainz_kuids_trainz_kuids1_idx` (`idtrainz_kuid`),
  KEY `fk_trainz_cdp_has_trainz_kuids_trainz_cdp1_idx` (`idtrainz_cdp`),
  CONSTRAINT `fk_trainz_cdp_has_trainz_kuids_trainz_cdp` FOREIGN KEY (`idtrainz_cdp`) REFERENCES `trainz_cdp` (`idtrainz_cdp`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_trainz_cdp_has_trainz_kuids_trainz_kuids` FOREIGN KEY (`idtrainz_kuid`) REFERENCES `trainz_kuids` (`idtrainz_kuid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='trainz cdp vaze kuids';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trainz_cdp_has_trainz_kuids`
--

LOCK TABLES `trainz_cdp_has_trainz_kuids` WRITE;
/*!40000 ALTER TABLE `trainz_cdp_has_trainz_kuids` DISABLE KEYS */;
INSERT INTO `trainz_cdp_has_trainz_kuids` VALUES (159,72),(457,69),(466,186),(478,192),(479,192),(480,192),(493,192),(500,192),(501,192),(502,192),(503,192),(505,192),(506,192),(507,192),(508,192),(510,192),(511,192),(512,192),(513,192),(514,192),(515,192),(516,192),(517,192),(518,192),(519,192),(530,192),(741,60),(852,62),(992,192),(1028,192),(1029,192),(1030,192),(1031,192),(1032,192),(1033,192),(1034,192),(1035,192),(1036,192),(1037,192),(1038,192),(1039,192),(1040,192),(1041,192),(1042,192),(1043,192),(1044,192),(1045,192),(1046,192),(1047,192),(1048,192),(1049,192),(1050,192),(1051,192),(1052,192),(1053,192),(1054,192),(1055,192),(1056,192),(1059,192),(1060,192),(1068,192),(1069,192),(1070,192),(1077,192),(1088,192),(1090,192),(1096,192),(1097,192),(1098,192),(1099,192),(1100,192),(1101,192),(1102,192),(1103,192),(1104,192),(1105,192),(1123,186),(1124,186),(1143,192),(1144,192),(1146,192),(1147,192),(1148,192),(1149,192),(1150,192),(1569,58),(1595,145),(1596,145),(1597,39),(1597,47),(1598,117),(1599,117),(1599,179),(1600,47),(1600,57),(1600,168),(1600,191),(1602,186),(1603,101),(1604,101),(1605,101),(1606,101),(1607,101),(1608,101),(1609,101),(1610,101),(1611,101),(1612,101),(1613,101),(1614,101),(1615,101),(1616,101),(1617,101),(1618,101),(1619,101),(1620,101),(1621,101),(1622,101),(1623,101),(1624,101),(1625,101),(1626,101),(1627,101),(1628,101),(1629,101),(1630,101),(1631,101),(1632,101),(1633,101),(1634,101),(1635,101),(1636,101),(1637,101),(1638,101),(1639,101),(1640,101),(1641,101),(1642,101),(1643,101),(1644,101),(1645,101),(1646,101),(1647,101),(1648,101),(1649,101),(1650,101),(1651,101),(1652,101),(1653,101),(1654,101),(1655,101),(1656,101),(1657,101),(1658,101),(1659,101),(1660,101),(1661,101),(1662,101),(1663,101),(1664,101),(1665,101),(1666,101),(1667,101),(1668,101),(1669,101),(1670,101),(1671,101),(1672,101),(1673,101),(1674,101),(1675,101),(1676,101),(1677,101),(1678,101),(1679,101),(1680,101),(1681,101),(1682,101),(1683,101),(1684,101),(1685,101),(1686,101),(1687,101),(1688,101),(1689,101),(1690,101),(1691,101),(1692,101),(1693,101),(1694,101),(1695,101),(1696,101),(1697,101),(1698,101),(1699,101),(1700,101),(1701,101),(1702,101),(1703,101),(1704,101),(1705,101),(1706,101),(1707,101),(1708,101),(1709,101),(1710,101),(1711,101),(1712,101),(1713,101),(1714,101),(1715,177),(1715,179),(1716,177),(1717,178);
/*!40000 ALTER TABLE `trainz_cdp_has_trainz_kuids` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trainz_cdp_has_trainz_versions`
--

DROP TABLE IF EXISTS `trainz_cdp_has_trainz_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trainz_cdp_has_trainz_versions` (
  `idtrainz_cdp` int(10) unsigned NOT NULL,
  `idtrainz_version` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idtrainz_cdp`,`idtrainz_version`),
  KEY `fk_trainz_cdp_has_trainz_versions_trainz_versions1_idx` (`idtrainz_version`),
  KEY `fk_trainz_cdp_has_trainz_versions_trainz_cdp1_idx` (`idtrainz_cdp`),
  CONSTRAINT `fk_trainz_cdp_has_trainz_versions_trainz_cdp` FOREIGN KEY (`idtrainz_cdp`) REFERENCES `trainz_cdp` (`idtrainz_cdp`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_trainz_cdp_has_trainz_versions_trainz_versions` FOREIGN KEY (`idtrainz_version`) REFERENCES `trainz_versions` (`idtrainz_version`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='cdp vaze trainz versions';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trainz_cdp_has_trainz_versions`
--

LOCK TABLES `trainz_cdp_has_trainz_versions` WRITE;
/*!40000 ALTER TABLE `trainz_cdp_has_trainz_versions` DISABLE KEYS */;
INSERT INTO `trainz_cdp_has_trainz_versions` VALUES (191,1),(192,1),(28,2),(177,2),(192,2),(177,3),(178,3),(179,3),(186,3),(192,3),(47,4),(57,4),(72,4),(117,4),(178,4),(186,4),(28,5),(179,5);
/*!40000 ALTER TABLE `trainz_cdp_has_trainz_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trainz_kuids`
--

DROP TABLE IF EXISTS `trainz_kuids`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trainz_kuids` (
  `idtrainz_kuid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kuid` varchar(30) NOT NULL,
  `name` varchar(100) DEFAULT NULL COMMENT 'pridrizeny cdp nazev',
  `url` varchar(100) DEFAULT NULL,
  `idtrainz_cdp` int(10) unsigned DEFAULT NULL COMMENT 'pridruzeny cdp',
  PRIMARY KEY (`idtrainz_kuid`),
  UNIQUE KEY `kuid_UNIQUE` (`kuid`),
  KEY `fk_idtrainz_cdp_idx` (`idtrainz_cdp`),
  CONSTRAINT `fk_trainz_kuids_trainz_cdp` FOREIGN KEY (`idtrainz_cdp`) REFERENCES `trainz_cdp` (`idtrainz_cdp`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1719 DEFAULT CHARSET=utf8 COMMENT='kuidy';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trainz_kuids`
--

LOCK TABLES `trainz_kuids` WRITE;
/*!40000 ALTER TABLE `trainz_kuids` DISABLE KEYS */;
INSERT INTO `trainz_kuids` VALUES (7,'171841:17003','gsdfgdsfg',NULL,0),(8,'171841:17000','gsdfgdsfg',NULL,0),(9,'171841:17001','gsdfgdsfg',NULL,0),(10,'171841:17002','gsdfgdsfg',NULL,0),(11,'171841:17010','gsdfgdsfg',NULL,0),(12,'171841:17011','gsdfgdsfg',NULL,0),(13,'171841:18030','gsdfgdsfg',NULL,0),(14,'171841:18026','gsdfgdsfg',NULL,0),(15,'171841:18025','gsdfgdsfg',NULL,0),(16,'171841:18020','gsdfgdsfg',NULL,0),(17,'171841:18021','gsdfgdsfg',NULL,0),(18,'147484:28803','gsdfgdsfg',NULL,0),(19,'147484:37260','gsdfgdsfg',NULL,0),(20,'147484:37684','gsdfgdsfg',NULL,0),(21,'147484:28006','gsdfgdsfg',NULL,0),(22,'147484:37592','gsdfgdsfg',NULL,0),(23,'147484:37594','gsdfgdsfg',NULL,0),(24,'147484:37682','gsdfgdsfg',NULL,0),(25,'147484:37593','gsdfgdsfg',NULL,0),(26,'147484:37683','gsdfgdsfg',NULL,0),(27,'147484:37676','gsdfgdsfg',NULL,0),(28,'147484:37675','gsdfgdsfg',NULL,0),(29,'147484:37679','gsdfgdsfg',NULL,0),(30,'147484:37678','gsdfgdsfg',NULL,0),(31,'147484:37681','gsdfgdsfg',NULL,0),(32,'147484:37680','gsdfgdsfg',NULL,0),(33,'147484:37102','gsdfgdsfg',NULL,0),(34,'147484:37103','gsdfgdsfg',NULL,0),(35,'147484:37104','gsdfgdsfg',NULL,0),(36,'147484:37101','gsdfgdsfg',NULL,0),(37,'147484:37105','gsdfgdsfg',NULL,0),(38,'147484:37090','gsdfgdsfg',NULL,0),(39,'147484:37091','gsdfgdsfg',NULL,0),(40,'147484:37094','gsdfgdsfg',NULL,0),(41,'147484:37095','gsdfgdsfg',NULL,0),(42,'147484:37092','gsdfgdsfg',NULL,0),(43,'147484:37097','gsdfgdsfg',NULL,0),(44,'147484:37093','gsdfgdsfg',NULL,0),(45,'147484:37096','gsdfgdsfg',NULL,0),(46,'147484:37840','gsdfgdsfg',NULL,0),(47,'147484:37841','gsdfgdsfg',NULL,0),(48,'147484:37842','gsdfgdsfg',NULL,0),(49,'147484:37843','gsdfgdsfg',NULL,0),(50,'147484:37848','gsdfgdsfg',NULL,0),(51,'147484:37844','gsdfgdsfg',NULL,0),(52,'147484:37845','gsdfgdsfg',NULL,0),(53,'147484:37846','gsdfgdsfg',NULL,0),(54,'147484:37847','gsdfgdsfg',NULL,0),(55,'147484:37856','gsdfgdsfg',NULL,0),(56,'147484:37858','gsdfgdsfg',NULL,0),(57,'147484:28439','gsdfgdsfg',NULL,0),(58,'147484:28447','gsdfgdsfg',NULL,0),(59,'147484:28446','gsdfgdsfg',NULL,0),(60,'147484:37855','gsdfgdsfg',NULL,0),(61,'147484:37859','gsdfgdsfg',NULL,0),(62,'147484:37857','gsdfgdsfg',NULL,0),(63,'147484:37837','gsdfgdsfg',NULL,0),(64,'147484:37838','gsdfgdsfg',NULL,0),(65,'147484:37839','gsdfgdsfg',NULL,0),(66,'147484:37602','gsdfgdsfg',NULL,0),(67,'147484:23401','gsdfgdsfg',NULL,0),(68,'147484:23400','gsdfgdsfg',NULL,0),(69,'147484:23003','gsdfgdsfg',NULL,0),(70,'147484:37840:9','gsdfgdsfg',NULL,0),(71,'147484:37841:9','gsdfgdsfg',NULL,0),(72,'147484:37842:9','gsdfgdsfg',NULL,0),(73,'147484:37843:9','gsdfgdsfg',NULL,0),(74,'147484:37848:9','gsdfgdsfg',NULL,0),(75,'147484:37844:9','gsdfgdsfg',NULL,0),(76,'147484:37845:9','gsdfgdsfg',NULL,0),(77,'147484:37846:9','gsdfgdsfg',NULL,0),(78,'147484:37847:9','gsdfgdsfg',NULL,0),(79,'147484:37856:9','gsdfgdsfg',NULL,0),(80,'147484:37858:9','gsdfgdsfg',NULL,0),(81,'147484:28439:9','gsdfgdsfg',NULL,0),(82,'147484:28447:9','gsdfgdsfg',NULL,0),(83,'147484:28446:9','gsdfgdsfg',NULL,0),(84,'147484:37855:9','gsdfgdsfg',NULL,0),(85,'147484:37837:9','gsdfgdsfg',NULL,0),(86,'147484:37838:9','gsdfgdsfg',NULL,0),(87,'147484:37839:9','gsdfgdsfg',NULL,0),(88,'147484:37859:9','gsdfgdsfg',NULL,0),(89,'147484:37857:9','gsdfgdsfg',NULL,0),(90,'147484:37602:9','gsdfgdsfg',NULL,0),(91,'147484:23401:9','gsdfgdsfg',NULL,0),(92,'147484:23400:9','gsdfgdsfg',NULL,0),(93,'147484:23003:9','gsdfgdsfg',NULL,0),(94,'147484:37248','gsdfgdsfg',NULL,0),(95,'147484:37249','gsdfgdsfg',NULL,0),(96,'147484:37250','gsdfgdsfg',NULL,0),(97,'147484:37258','gsdfgdsfg',NULL,0),(98,'147484:37251','gsdfgdsfg',NULL,0),(99,'147484:23111','gsdfgdsfg',NULL,0),(100,'147484:37276','gsdfgdsfg',NULL,0),(101,'147484:23112','gsdfgdsfg',NULL,0),(102,'147484:23113','gsdfgdsfg',NULL,0),(103,'147484:37277','gsdfgdsfg',NULL,0),(104,'147484:23114','gsdfgdsfg',NULL,0),(105,'147484:37278','gsdfgdsfg',NULL,0),(106,'147484:23116','gsdfgdsfg',NULL,0),(107,'147484:37279','gsdfgdsfg',NULL,0),(108,'147484:23115','gsdfgdsfg',NULL,0),(109,'147484:37252','gsdfgdsfg',NULL,0),(110,'147484:37253','gsdfgdsfg',NULL,0),(111,'147484:37254','gsdfgdsfg',NULL,0),(112,'147484:37255','gsdfgdsfg',NULL,0),(113,'147484:37243','gsdfgdsfg',NULL,0),(114,'147484:37241','gsdfgdsfg',NULL,0),(115,'147484:37256','gsdfgdsfg',NULL,0),(116,'147484:37247','gsdfgdsfg',NULL,0),(117,'147484:37245','gsdfgdsfg',NULL,0),(118,'147484:37244','gsdfgdsfg',NULL,0),(119,'147484:37259','gsdfgdsfg',NULL,0),(120,'147484:37246','gsdfgdsfg',NULL,0),(121,'147484:37239','gsdfgdsfg',NULL,0),(122,'147484:37242','gsdfgdsfg',NULL,0),(123,'147484:37240','gsdfgdsfg',NULL,0),(124,'147484:37238','gsdfgdsfg',NULL,0),(125,'147484:37236','gsdfgdsfg',NULL,0),(126,'147484:37237','gsdfgdsfg',NULL,0),(127,'147484:37235','gsdfgdsfg',NULL,0),(128,'147484:37234','gsdfgdsfg',NULL,0),(129,'147484:37233','gsdfgdsfg',NULL,0),(130,'147484:37232','gsdfgdsfg',NULL,0),(131,'147484:23001','gsdfgdsfg',NULL,0),(132,'147484:37282','gsdfgdsfg',NULL,0),(133,'147484:37268','gsdfgdsfg',NULL,0),(134,'147484:37267','gsdfgdsfg',NULL,0),(135,'147484:37261','gsdfgdsfg',NULL,0),(136,'147484:23102','gsdfgdsfg',NULL,0),(137,'147484:37286','gsdfgdsfg',NULL,0),(138,'147484:23101','gsdfgdsfg',NULL,0),(139,'147484:23104','gsdfgdsfg',NULL,0),(140,'147484:37285','gsdfgdsfg',NULL,0),(141,'147484:23103','gsdfgdsfg',NULL,0),(142,'147484:37280','gsdfgdsfg',NULL,0),(143,'147484:23105','gsdfgdsfg',NULL,0),(144,'147484:37281','gsdfgdsfg',NULL,0),(145,'147484:23106','gsdfgdsfg',NULL,0),(146,'147484:37262','gsdfgdsfg',NULL,0),(147,'147484:37263','gsdfgdsfg',NULL,0),(148,'147484:37264','gsdfgdsfg',NULL,0),(149,'147484:37265','gsdfgdsfg',NULL,0),(150,'147484:37273','gsdfgdsfg',NULL,0),(151,'147484:37275','gsdfgdsfg',NULL,0),(152,'147484:37266','gsdfgdsfg',NULL,0),(153,'147484:37287','gsdfgdsfg',NULL,0),(154,'147484:37271','gsdfgdsfg',NULL,0),(155,'147484:37269','gsdfgdsfg',NULL,0),(156,'147484:37272','gsdfgdsfg',NULL,0),(157,'147484:37274','gsdfgdsfg',NULL,0),(158,'147484:37369','gsdfgdsfg',NULL,0),(159,'147484:37360','gsdfgdsfg',NULL,0),(160,'147484:37361','gsdfgdsfg',NULL,0),(161,'147484:37368','gsdfgdsfg',NULL,0),(162,'147484:37367','gsdfgdsfg',NULL,0),(163,'147484:37366','gsdfgdsfg',NULL,0),(164,'147484:37362','gsdfgdsfg',NULL,0),(165,'147484:37363','gsdfgdsfg',NULL,0),(166,'147484:37364','gsdfgdsfg',NULL,0),(167,'147484:37365','gsdfgdsfg',NULL,0),(168,'202816:60010','gsdfgdsfg',NULL,0),(169,'202816:39036','gsdfgdsfg',NULL,0),(170,'202816:60007','gsdfgdsfg',NULL,0),(171,'202816:60008','gsdfgdsfg',NULL,0),(172,'202816:60009','gsdfgdsfg',NULL,0),(173,'202816:60015','gsdfgdsfg',NULL,0),(174,'202816:60016','gsdfgdsfg',NULL,0),(175,'202816:60017','gsdfgdsfg',NULL,0),(176,'202816:60019','gsdfgdsfg',NULL,0),(177,'202816:60020','gsdfgdsfg',NULL,0),(178,'202816:60021','gsdfgdsfg',NULL,0),(179,'202816:60022','gsdfgdsfg',NULL,0),(180,'202816:60023','gsdfgdsfg',NULL,0),(181,'202816:60024','gsdfgdsfg',NULL,0),(182,'202816:60025','gsdfgdsfg',NULL,0),(183,'202816:60026','gsdfgdsfg',NULL,0),(184,'202816:60027','gsdfgdsfg',NULL,0),(185,'202816:60029','gsdfgdsfg',NULL,0),(186,'202816:60028','gsdfgdsfg',NULL,0),(187,'202816:60018','gsdfgdsfg',NULL,0),(188,'221520:27039','gsdfgdsfg',NULL,0),(189,'221520:26050','gsdfgdsfg',NULL,0),(190,'221520:26051','gsdfgdsfg',NULL,0),(191,'163221:26002','gsdfgdsfg',NULL,0),(192,'163221:25932','gsdfgdsfg',NULL,0),(193,'326489:26735','gsdfgdsfg',NULL,0),(194,'326489:26736','gsdfgdsfg',NULL,0),(195,'326489:26729','gsdfgdsfg',NULL,0),(196,'326489:26728','gsdfgdsfg',NULL,0),(197,'305226:1040','gsdfgdsfg',NULL,0),(198,'305226:1044','gsdfgdsfg',NULL,0),(199,'221520:27009','gsdfgdsfg',NULL,0),(200,'145747:22122','gsdfgdsfg',NULL,0),(201,'145747:22121','gsdfgdsfg',NULL,0),(202,'145747:22130','gsdfgdsfg',NULL,0),(203,'145747:22129','gsdfgdsfg',NULL,0),(204,'145747:22123','gsdfgdsfg',NULL,0),(205,'145747:22131','gsdfgdsfg',NULL,0),(206,'145747:22132','gsdfgdsfg',NULL,0),(207,'145747:22133','gsdfgdsfg',NULL,0),(208,'145747:22134','gsdfgdsfg',NULL,0),(209,'145747:22117','gsdfgdsfg',NULL,0),(210,'145747:22116','gsdfgdsfg',NULL,0),(211,'145747:22119','gsdfgdsfg',NULL,0),(212,'145747:22118','gsdfgdsfg',NULL,0),(213,'145747:22104','gsdfgdsfg',NULL,0),(214,'145747:22105','gsdfgdsfg',NULL,0),(215,'145747:22106','gsdfgdsfg',NULL,0),(216,'145747:22107','gsdfgdsfg',NULL,0),(217,'145747:22158','gsdfgdsfg',NULL,0),(218,'145747:22157','gsdfgdsfg',NULL,0),(219,'145747:22125','gsdfgdsfg',NULL,0),(220,'145747:22126','gsdfgdsfg',NULL,0),(221,'145747:22128','gsdfgdsfg',NULL,0),(222,'145747:22127','gsdfgdsfg',NULL,0),(223,'221520:27010','gsdfgdsfg',NULL,0),(224,'98738:34001','gsdfgdsfg',NULL,0),(225,'98738:34002','gsdfgdsfg',NULL,0),(226,'221520:27035','gsdfgdsfg',NULL,0),(227,'286240:25044','gsdfgdsfg',NULL,0),(228,'136753:60000','gsdfgdsfg',NULL,0),(229,'221520:21001:1','gsdfgdsfg',NULL,0),(230,'221520:21002:1','gsdfgdsfg',NULL,0),(231,'221520:21003:1','gsdfgdsfg',NULL,0),(232,'221520:21004:1','gsdfgdsfg',NULL,0),(233,'351513:25001','gsdfgdsfg',NULL,0),(234,'171893:240007','gsdfgdsfg',NULL,0),(235,'240563:28004','gsdfgdsfg',NULL,0),(236,'208822:25010','gsdfgdsfg',NULL,0),(237,'221520:27043','gsdfgdsfg',NULL,0),(238,'208822:25015','gsdfgdsfg',NULL,0),(239,'208822:25017','gsdfgdsfg',NULL,0),(240,'217990:28050','gsdfgdsfg',NULL,0),(241,'240563:28002','gsdfgdsfg',NULL,0),(242,'171893:240006','gsdfgdsfg',NULL,0),(243,'240563:28001','gsdfgdsfg',NULL,0),(244,'110164:28005','gsdfgdsfg',NULL,0),(245,'147360:37001','gsdfgdsfg',NULL,0),(246,'110164:28006','gsdfgdsfg',NULL,0),(247,'217990:28066','gsdfgdsfg',NULL,0),(248,'81871:28006','gsdfgdsfg',NULL,0),(249,'77641:44001','gsdfgdsfg',NULL,0),(250,'77641:44002','gsdfgdsfg',NULL,0),(251,'286240:25130','gsdfgdsfg',NULL,0),(252,'286240:25122','gsdfgdsfg',NULL,0),(253,'286240:25061','gsdfgdsfg',NULL,0),(254,'286240:25062','gsdfgdsfg',NULL,0),(255,'286240:25063','gsdfgdsfg',NULL,0),(256,'286240:25064','gsdfgdsfg',NULL,0),(257,'110164:39000','gsdfgdsfg',NULL,0),(258,'221520:27011','gsdfgdsfg',NULL,0),(259,'221520:27012','gsdfgdsfg',NULL,0),(260,'240563:38000','gsdfgdsfg',NULL,0),(261,'286240:25111','gsdfgdsfg',NULL,0),(262,'286240:25132','gsdfgdsfg',NULL,0),(263,'286240:25121','gsdfgdsfg',NULL,0),(264,'110164:39002','gsdfgdsfg',NULL,0),(265,'286240:25001','gsdfgdsfg',NULL,0),(266,'286240:25119','gsdfgdsfg',NULL,0),(267,'286240:25120','gsdfgdsfg',NULL,0),(268,'374335:25004','gsdfgdsfg',NULL,0),(269,'374335:25005','gsdfgdsfg',NULL,0),(270,'286240:25013','gsdfgdsfg',NULL,0),(271,'326489:39000','gsdfgdsfg',NULL,0),(272,'286240:25006','gsdfgdsfg',NULL,0),(273,'286240:25128','gsdfgdsfg',NULL,0),(274,'136753:28025','gsdfgdsfg',NULL,0),(275,'136753:28026','gsdfgdsfg',NULL,0),(276,'136753:28033','gsdfgdsfg',NULL,0),(277,'136753:28034','gsdfgdsfg',NULL,0),(278,'136753:28035','gsdfgdsfg',NULL,0),(279,'136753:28036','gsdfgdsfg',NULL,0),(280,'136753:28037','gsdfgdsfg',NULL,0),(281,'136753:28038','gsdfgdsfg',NULL,0),(282,'136753:28027','gsdfgdsfg',NULL,0),(283,'136753:28028','gsdfgdsfg',NULL,0),(284,'136753:28029','gsdfgdsfg',NULL,0),(285,'136753:28030','gsdfgdsfg',NULL,0),(286,'136753:28031','gsdfgdsfg',NULL,0),(287,'136753:28032','gsdfgdsfg',NULL,0),(288,'176028:21706','gsdfgdsfg',NULL,0),(289,'240563:60200','gsdfgdsfg',NULL,0),(290,'98738:34003','gsdfgdsfg',NULL,0),(291,'91431:28006','gsdfgdsfg',NULL,0),(292,'147198:27012','gsdfgdsfg',NULL,0),(293,'325204:28003','gsdfgdsfg',NULL,0),(294,'147484:37551','gsdfgdsfg',NULL,0),(295,'147484:37550','gsdfgdsfg',NULL,0),(296,'147484:38520','gsdfgdsfg',NULL,0),(297,'147484:38521','gsdfgdsfg',NULL,0),(298,'147484:38522','gsdfgdsfg',NULL,0),(299,'147484:38523','gsdfgdsfg',NULL,0),(300,'147484:38524','gsdfgdsfg',NULL,0),(301,'147484:38525','gsdfgdsfg',NULL,0),(302,'147484:23051','gsdfgdsfg',NULL,0),(303,'147484:23050','gsdfgdsfg',NULL,0),(304,'147484:23048','gsdfgdsfg',NULL,0),(305,'147484:23049','gsdfgdsfg',NULL,0),(306,'357470:3029','gsdfgdsfg',NULL,0),(307,'357470:2014','gsdfgdsfg',NULL,0),(308,'357470:2018','gsdfgdsfg',NULL,0),(309,'357470:3003','gsdfgdsfg',NULL,0),(310,'357470:1016','gsdfgdsfg',NULL,0),(311,'357470:1001','gsdfgdsfg',NULL,0),(312,'357470:1008','gsdfgdsfg',NULL,0),(313,'357470:3013','gsdfgdsfg',NULL,0),(314,'357470:3022','gsdfgdsfg',NULL,0),(315,'357470:2012','gsdfgdsfg',NULL,0),(316,'357470:2021','gsdfgdsfg',NULL,0),(317,'357470:3032','gsdfgdsfg',NULL,0),(318,'357470:3001','gsdfgdsfg',NULL,0),(319,'357470:3012','gsdfgdsfg',NULL,0),(320,'357470:3023','gsdfgdsfg',NULL,0),(321,'357470:2016','gsdfgdsfg',NULL,0),(322,'357470:1015','gsdfgdsfg',NULL,0),(323,'357470:1002','gsdfgdsfg',NULL,0),(324,'357470:2029','gsdfgdsfg',NULL,0),(325,'357470:3010','gsdfgdsfg',NULL,0),(326,'357470:3025','gsdfgdsfg',NULL,0),(327,'357470:2013','gsdfgdsfg',NULL,0),(328,'357470:2019','gsdfgdsfg',NULL,0),(329,'357470:2006','gsdfgdsfg',NULL,0),(330,'357470:2027','gsdfgdsfg',NULL,0),(331,'357470:1007','gsdfgdsfg',NULL,0),(332,'357470:3005','gsdfgdsfg',NULL,0),(333,'357470:3030','gsdfgdsfg',NULL,0),(334,'357470:2023','gsdfgdsfg',NULL,0),(335,'357470:3016','gsdfgdsfg',NULL,0),(336,'357470:3019','gsdfgdsfg',NULL,0),(337,'357470:2017','gsdfgdsfg',NULL,0),(338,'357470:2020','gsdfgdsfg',NULL,0),(339,'357470:3018','gsdfgdsfg',NULL,0),(340,'357470:2003','gsdfgdsfg',NULL,0),(341,'357470:2031','gsdfgdsfg',NULL,0),(342,'357470:2004','gsdfgdsfg',NULL,0),(343,'357470:2030','gsdfgdsfg',NULL,0),(344,'357470:1017','gsdfgdsfg',NULL,0),(345,'357470:1003','gsdfgdsfg',NULL,0),(346,'357470:2010','gsdfgdsfg',NULL,0),(347,'357470:1012','gsdfgdsfg',NULL,0),(348,'357470:1005','gsdfgdsfg',NULL,0),(349,'357470:3011','gsdfgdsfg',NULL,0),(350,'357470:3024','gsdfgdsfg',NULL,0),(351,'357470:1006','gsdfgdsfg',NULL,0),(352,'357470:3015','gsdfgdsfg',NULL,0),(353,'357470:3020','gsdfgdsfg',NULL,0),(354,'357470:1014','gsdfgdsfg',NULL,0),(355,'357470:2011','gsdfgdsfg',NULL,0),(356,'357470:2022','gsdfgdsfg',NULL,0),(357,'357470:2009','gsdfgdsfg',NULL,0),(358,'357470:2005','gsdfgdsfg',NULL,0),(359,'357470:2028','gsdfgdsfg',NULL,0),(360,'357470:3002','gsdfgdsfg',NULL,0),(361,'357470:3007','gsdfgdsfg',NULL,0),(362,'357470:3028','gsdfgdsfg',NULL,0),(363,'357470:3008','gsdfgdsfg',NULL,0),(364,'357470:3027','gsdfgdsfg',NULL,0),(365,'357470:2007','gsdfgdsfg',NULL,0),(366,'357470:2026','gsdfgdsfg',NULL,0),(367,'357470:3004','gsdfgdsfg',NULL,0),(368,'357470:3031','gsdfgdsfg',NULL,0),(369,'357470:1011','gsdfgdsfg',NULL,0),(370,'357470:2008','gsdfgdsfg',NULL,0),(371,'357470:2025','gsdfgdsfg',NULL,0),(372,'357470:1004','gsdfgdsfg',NULL,0),(373,'357470:1013','gsdfgdsfg',NULL,0),(374,'357470:2032','gsdfgdsfg',NULL,0),(375,'357470:1010','gsdfgdsfg',NULL,0),(376,'357470:3017','gsdfgdsfg',NULL,0),(377,'357470:3014','gsdfgdsfg',NULL,0),(378,'357470:3021','gsdfgdsfg',NULL,0),(379,'357470:3009','gsdfgdsfg',NULL,0),(380,'357470:3026','gsdfgdsfg',NULL,0),(381,'357470:2015','gsdfgdsfg',NULL,0),(382,'357470:1009','gsdfgdsfg',NULL,0),(383,'357470:2002','gsdfgdsfg',NULL,0),(384,'357470:2001','gsdfgdsfg',NULL,0),(385,'217990:37004','gsdfgdsfg',NULL,0),(386,'202816:950070','gsdfgdsfg',NULL,0),(387,'257731:6200','gsdfgdsfg',NULL,0),(388,'257731:6201','gsdfgdsfg',NULL,0),(389,'413032:2501','gsdfgdsfg',NULL,0),(390,'176028:21717','gsdfgdsfg',NULL,0),(391,'240563:28042','gsdfgdsfg',NULL,0),(392,'240563:28043','gsdfgdsfg',NULL,0),(393,'240563:28044','gsdfgdsfg',NULL,0),(394,'240563:28045','gsdfgdsfg',NULL,0),(395,'240563:28046','gsdfgdsfg',NULL,0),(396,'147484:37600','gsdfgdsfg',NULL,0),(397,'147484:37601','gsdfgdsfg',NULL,0),(398,'147484:28071','gsdfgdsfg',NULL,0),(399,'147484:28072','gsdfgdsfg',NULL,0),(400,'147484:28050','gsdfgdsfg',NULL,0),(401,'373547:37001','gsdfgdsfg',NULL,0),(402,'202816:950032','gsdfgdsfg',NULL,0),(403,'202816:950004','gsdfgdsfg',NULL,0),(404,'202816:950003','gsdfgdsfg',NULL,0),(405,'286240:21011','gsdfgdsfg',NULL,0),(406,'286240:21012','gsdfgdsfg',NULL,0),(407,'77641:37067','gsdfgdsfg',NULL,0),(408,'77641:37069','gsdfgdsfg',NULL,0),(409,'77641:37072','gsdfgdsfg',NULL,0),(410,'77641:37073','gsdfgdsfg',NULL,0),(411,'145747:22170','gsdfgdsfg',NULL,0),(412,'145747:22092','gsdfgdsfg',NULL,0),(413,'145747:22090','gsdfgdsfg',NULL,0),(414,'145747:22062','gsdfgdsfg',NULL,0),(415,'145747:27055','gsdfgdsfg',NULL,0),(416,'145747:27062','gsdfgdsfg',NULL,0),(417,'145747:27090','gsdfgdsfg',NULL,0),(418,'145747:27046','gsdfgdsfg',NULL,0),(419,'145747:27049','gsdfgdsfg',NULL,0),(420,'145747:27050','gsdfgdsfg',NULL,0),(421,'145747:27051','gsdfgdsfg',NULL,0),(422,'145747:27052','gsdfgdsfg',NULL,0),(423,'145747:27053','gsdfgdsfg',NULL,0),(424,'145747:27054','gsdfgdsfg',NULL,0),(425,'145747:22086','gsdfgdsfg',NULL,0),(426,'145747:22056','gsdfgdsfg',NULL,0),(427,'145747:22120','gsdfgdsfg',NULL,0),(428,'145747:22061','gsdfgdsfg',NULL,0),(429,'145747:22063','gsdfgdsfg',NULL,0),(430,'145747:22065','gsdfgdsfg',NULL,0),(431,'145747:27071','gsdfgdsfg',NULL,0),(432,'145747:27072','gsdfgdsfg',NULL,0),(433,'145747:27063','gsdfgdsfg',NULL,0),(434,'145747:22064','gsdfgdsfg',NULL,0),(435,'145747:22058','gsdfgdsfg',NULL,0),(436,'145747:22059','gsdfgdsfg',NULL,0),(437,'77641:37066','gsdfgdsfg',NULL,0),(438,'77641:37068','gsdfgdsfg',NULL,0),(439,'77641:37070','gsdfgdsfg',NULL,0),(440,'77641:37071','gsdfgdsfg',NULL,0),(441,'145747:37001','gsdfgdsfg',NULL,0),(442,'145747:22168','gsdfgdsfg',NULL,0),(443,'202816:39012','gsdfgdsfg',NULL,0),(444,'202816:39011','gsdfgdsfg',NULL,0),(445,'202816:39014','gsdfgdsfg',NULL,0),(446,'459958:10586','gsdfgdsfg',NULL,0),(447,'459958:10587','gsdfgdsfg',NULL,0),(448,'98666:37011:1','gsdfgdsfg',NULL,0),(449,'98666:37021:1','gsdfgdsfg',NULL,0),(450,'98666:37001:1','gsdfgdsfg',NULL,0),(451,'98666:37012:1','gsdfgdsfg',NULL,0),(452,'98666:37022:1','gsdfgdsfg',NULL,0),(453,'98666:37002:1','gsdfgdsfg',NULL,0),(454,'98666:37013:1','gsdfgdsfg',NULL,0),(455,'98666:37023:1','gsdfgdsfg',NULL,0),(456,'98666:37003:1','gsdfgdsfg',NULL,0),(457,'98666:37014:1','gsdfgdsfg',NULL,0),(458,'98666:37024:1','gsdfgdsfg',NULL,0),(459,'98666:37004:1','gsdfgdsfg',NULL,0),(460,'98666:37015:1','gsdfgdsfg',NULL,0),(461,'98666:37025:1','gsdfgdsfg',NULL,0),(462,'98666:37005:1','gsdfgdsfg',NULL,0),(463,'98666:37016:1','gsdfgdsfg',NULL,0),(464,'98666:37026:1','gsdfgdsfg',NULL,0),(465,'98666:37006:1','gsdfgdsfg',NULL,0),(466,'98666:37017:1','gsdfgdsfg',NULL,0),(467,'98666:37027:1','gsdfgdsfg',NULL,0),(468,'98666:37007:1','gsdfgdsfg',NULL,0),(469,'98666:37018:1','gsdfgdsfg',NULL,0),(470,'98666:37028:1','gsdfgdsfg',NULL,0),(471,'98666:37008:1','gsdfgdsfg',NULL,0),(472,'98666:37019:1','gsdfgdsfg',NULL,0),(473,'98666:37029:1','gsdfgdsfg',NULL,0),(474,'98666:37009:1','gsdfgdsfg',NULL,0),(475,'98666:37020:1','gsdfgdsfg',NULL,0),(476,'98666:37030:1','gsdfgdsfg',NULL,0),(477,'98666:37010:1','gsdfgdsfg',NULL,0),(478,'77641:37030:1','gsdfgdsfg',NULL,0),(479,'77641:37031:1','gsdfgdsfg',NULL,0),(480,'77641:37032:1','gsdfgdsfg',NULL,0),(481,'208822:25022','gsdfgdsfg',NULL,0),(482,'67865:25100','gsdfgdsfg',NULL,0),(483,'67865:25101','gsdfgdsfg',NULL,0),(484,'67865:25102','gsdfgdsfg',NULL,0),(485,'67865:25103','gsdfgdsfg',NULL,0),(486,'67865:37902','gsdfgdsfg',NULL,0),(487,'67865:37900','gsdfgdsfg',NULL,0),(488,'67865:37903','gsdfgdsfg',NULL,0),(489,'67865:37904','gsdfgdsfg',NULL,0),(490,'67865:37905','gsdfgdsfg',NULL,0),(491,'67865:37906','gsdfgdsfg',NULL,0),(492,'67865:37901','gsdfgdsfg',NULL,0),(493,'77641:37033:1','gsdfgdsfg',NULL,0),(494,'77641:37078:1','gsdfgdsfg',NULL,0),(495,'77641:37079:1','gsdfgdsfg',NULL,0),(496,'77641:37042:1','gsdfgdsfg',NULL,0),(497,'77641:37080:1','gsdfgdsfg',NULL,0),(498,'208822:25023','gsdfgdsfg',NULL,0),(499,'373547:27003','gsdfgdsfg',NULL,0),(500,'77641:37030','gsdfgdsfg',NULL,0),(501,'77641:37031','gsdfgdsfg',NULL,0),(502,'77641:37032','gsdfgdsfg',NULL,0),(503,'77641:37033','gsdfgdsfg',NULL,0),(504,'77641:37042','gsdfgdsfg',NULL,0),(505,'77641:37026','gsdfgdsfg',NULL,0),(506,'77641:37028','gsdfgdsfg',NULL,0),(507,'77641:37027','gsdfgdsfg',NULL,0),(508,'77641:37029','gsdfgdsfg',NULL,0),(509,'208822:25008','gsdfgdsfg',NULL,0),(510,'77641:37020','gsdfgdsfg',NULL,0),(511,'77641:37021','gsdfgdsfg',NULL,0),(512,'77641:37022','gsdfgdsfg',NULL,0),(513,'77641:37023','gsdfgdsfg',NULL,0),(514,'77641:37024','gsdfgdsfg',NULL,0),(515,'77641:37025','gsdfgdsfg',NULL,0),(516,'77641:37034:1','gsdfgdsfg',NULL,0),(517,'77641:37035:1','gsdfgdsfg',NULL,0),(518,'77641:37036:1','gsdfgdsfg',NULL,0),(519,'77641:37037:1','gsdfgdsfg',NULL,0),(520,'202816:950596','gsdfgdsfg',NULL,0),(521,'202816:950590','gsdfgdsfg',NULL,0),(522,'202816:950591','gsdfgdsfg',NULL,0),(523,'208822:25020','gsdfgdsfg',NULL,0),(524,'326489:37018','gsdfgdsfg',NULL,0),(525,'77641:37088','gsdfgdsfg',NULL,0),(526,'77641:37091','gsdfgdsfg',NULL,0),(527,'77641:37089','gsdfgdsfg',NULL,0),(528,'77641:37092','gsdfgdsfg',NULL,0),(529,'77641:37090','gsdfgdsfg',NULL,0),(530,'77641:37038','gsdfgdsfg',NULL,0),(531,'77641:37039','gsdfgdsfg',NULL,0),(532,'286240:21013','gsdfgdsfg',NULL,0),(533,'286240:21023','gsdfgdsfg',NULL,0),(534,'286240:21024','gsdfgdsfg',NULL,0),(535,'286240:21025','gsdfgdsfg',NULL,0),(536,'286240:21026','gsdfgdsfg',NULL,0),(537,'286240:21027','gsdfgdsfg',NULL,0),(538,'286240:21028','gsdfgdsfg',NULL,0),(539,'286240:21029','gsdfgdsfg',NULL,0),(540,'286240:21030','gsdfgdsfg',NULL,0),(541,'286240:21031','gsdfgdsfg',NULL,0),(542,'286240:21032','gsdfgdsfg',NULL,0),(543,'286240:21033','gsdfgdsfg',NULL,0),(544,'286240:21034','gsdfgdsfg',NULL,0),(545,'286240:21014','gsdfgdsfg',NULL,0),(546,'286240:21035','gsdfgdsfg',NULL,0),(547,'286240:21036','gsdfgdsfg',NULL,0),(548,'286240:21015','gsdfgdsfg',NULL,0),(549,'286240:21016','gsdfgdsfg',NULL,0),(550,'286240:21017','gsdfgdsfg',NULL,0),(551,'286240:21018','gsdfgdsfg',NULL,0),(552,'286240:21019','gsdfgdsfg',NULL,0),(553,'286240:21020','gsdfgdsfg',NULL,0),(554,'286240:21021','gsdfgdsfg',NULL,0),(555,'286240:21022','gsdfgdsfg',NULL,0),(556,'77641:37043','gsdfgdsfg',NULL,0),(557,'77641:37044','gsdfgdsfg',NULL,0),(558,'77641:37045','gsdfgdsfg',NULL,0),(559,'77641:37046','gsdfgdsfg',NULL,0),(560,'77641:37047','gsdfgdsfg',NULL,0),(561,'77641:37048','gsdfgdsfg',NULL,0),(562,'459958:10292','gsdfgdsfg',NULL,0),(563,'459958:10293','gsdfgdsfg',NULL,0),(564,'147484:21023','gsdfgdsfg',NULL,0),(565,'147484:21027','gsdfgdsfg',NULL,0),(566,'147484:21026','gsdfgdsfg',NULL,0),(567,'147484:21025','gsdfgdsfg',NULL,0),(568,'147484:21028','gsdfgdsfg',NULL,0),(569,'147484:21029','gsdfgdsfg',NULL,0),(570,'147484:21030','gsdfgdsfg',NULL,0),(571,'147484:21031','gsdfgdsfg',NULL,0),(572,'147484:21032','gsdfgdsfg',NULL,0),(573,'147484:21033','gsdfgdsfg',NULL,0),(574,'147484:21034','gsdfgdsfg',NULL,0),(575,'147484:21035','gsdfgdsfg',NULL,0),(576,'147484:21023:6','gsdfgdsfg',NULL,0),(577,'147484:21027:6','gsdfgdsfg',NULL,0),(578,'147484:21026:6','gsdfgdsfg',NULL,0),(579,'147484:21025:6','gsdfgdsfg',NULL,0),(580,'147484:21028:6','gsdfgdsfg',NULL,0),(581,'147484:21029:6','gsdfgdsfg',NULL,0),(582,'147484:21030:6','gsdfgdsfg',NULL,0),(583,'147484:21031:6','gsdfgdsfg',NULL,0),(584,'147484:21032:6','gsdfgdsfg',NULL,0),(585,'147484:21033:6','gsdfgdsfg',NULL,0),(586,'147484:21034:6','gsdfgdsfg',NULL,0),(587,'147484:21035:6','gsdfgdsfg',NULL,0),(588,'147484:21023:10','gsdfgdsfg',NULL,0),(589,'147484:21027:10','gsdfgdsfg',NULL,0),(590,'147484:21026:10','gsdfgdsfg',NULL,0),(591,'147484:21025:10','gsdfgdsfg',NULL,0),(592,'147484:21028:10','gsdfgdsfg',NULL,0),(593,'147484:21029:10','gsdfgdsfg',NULL,0),(594,'147484:21030:10','gsdfgdsfg',NULL,0),(595,'147484:21031:10','gsdfgdsfg',NULL,0),(596,'147484:21032:10','gsdfgdsfg',NULL,0),(597,'147484:21033:10','gsdfgdsfg',NULL,0),(598,'147484:21034:10','gsdfgdsfg',NULL,0),(599,'147484:21035:10','gsdfgdsfg',NULL,0),(600,'89096:37617','gsdfgdsfg',NULL,0),(601,'71619:21080','gsdfgdsfg',NULL,0),(602,'71619:21081','gsdfgdsfg',NULL,0),(603,'71619:21082','gsdfgdsfg',NULL,0),(604,'71619:21083','gsdfgdsfg',NULL,0),(605,'71619:21084','gsdfgdsfg',NULL,0),(606,'71619:21085','gsdfgdsfg',NULL,0),(607,'71619:21086','gsdfgdsfg',NULL,0),(608,'145747:21002','gsdfgdsfg',NULL,0),(609,'145747:21003','gsdfgdsfg',NULL,0),(610,'145747:21000','gsdfgdsfg',NULL,0),(611,'145747:21001','gsdfgdsfg',NULL,0),(612,'286240:21001','gsdfgdsfg',NULL,0),(613,'286240:21002','gsdfgdsfg',NULL,0),(614,'286240:21003','gsdfgdsfg',NULL,0),(615,'286240:21004','gsdfgdsfg',NULL,0),(616,'286240:21005','gsdfgdsfg',NULL,0),(617,'147484:21101','gsdfgdsfg',NULL,0),(618,'147484:21102','gsdfgdsfg',NULL,0),(619,'147484:21103','gsdfgdsfg',NULL,0),(620,'147484:21104','gsdfgdsfg',NULL,0),(621,'147484:21105','gsdfgdsfg',NULL,0),(622,'147484:21106','gsdfgdsfg',NULL,0),(623,'147484:21107','gsdfgdsfg',NULL,0),(624,'147484:21101:10','gsdfgdsfg',NULL,0),(625,'147484:21102:10','gsdfgdsfg',NULL,0),(626,'147484:21103:10','gsdfgdsfg',NULL,0),(627,'147484:21104:10','gsdfgdsfg',NULL,0),(628,'147484:21105:10','gsdfgdsfg',NULL,0),(629,'147484:21106:10','gsdfgdsfg',NULL,0),(630,'147484:21107:10','gsdfgdsfg',NULL,0),(631,'208822:25021','gsdfgdsfg',NULL,0),(632,'208822:25016','gsdfgdsfg',NULL,0),(633,'208822:25012','gsdfgdsfg',NULL,0),(634,'208822:25011','gsdfgdsfg',NULL,0),(635,'208822:25009','gsdfgdsfg',NULL,0),(636,'217990:28061','gsdfgdsfg',NULL,0),(637,'217990:28060','gsdfgdsfg',NULL,0),(638,'459958:10578','gsdfgdsfg',NULL,0),(639,'459958:10580','gsdfgdsfg',NULL,0),(640,'459958:10581','gsdfgdsfg',NULL,0),(641,'459958:10582','gsdfgdsfg',NULL,0),(642,'77641:37040','gsdfgdsfg',NULL,0),(643,'77641:37041','gsdfgdsfg',NULL,0),(644,'459958:10577','gsdfgdsfg',NULL,0),(645,'459958:10585','gsdfgdsfg',NULL,0),(646,'217990:37202','gsdfgdsfg',NULL,0),(647,'217990:37205','gsdfgdsfg',NULL,0),(648,'217990:37206','gsdfgdsfg',NULL,0),(649,'234631:1042','gsdfgdsfg',NULL,0),(650,'217990:25066','gsdfgdsfg',NULL,0),(651,'240563:28005','gsdfgdsfg',NULL,0),(652,'176028:21718','gsdfgdsfg',NULL,0),(653,'237211:50501','gsdfgdsfg',NULL,0),(654,'237211:50502','gsdfgdsfg',NULL,0),(655,'91431:28002','gsdfgdsfg',NULL,0),(656,'91431:28003','gsdfgdsfg',NULL,0),(657,'176028:21714','gsdfgdsfg',NULL,0),(658,'176028:21715','gsdfgdsfg',NULL,0),(659,'240563:28012','gsdfgdsfg',NULL,0),(660,'670841:61636784','gsdfgdsfg',NULL,0),(661,'376721:1701','gsdfgdsfg',NULL,0),(662,'202816:28013','gsdfgdsfg',NULL,0),(663,'240563:28009','gsdfgdsfg',NULL,0),(664,'240563:28010','gsdfgdsfg',NULL,0),(665,'202816:28012','gsdfgdsfg',NULL,0),(666,'91431:28005','gsdfgdsfg',NULL,0),(667,'91431:28007','gsdfgdsfg',NULL,0),(668,'91431:28008','gsdfgdsfg',NULL,0),(669,'91431:28009','gsdfgdsfg',NULL,0),(670,'77641:23080','gsdfgdsfg',NULL,0),(671,'77641:23096','gsdfgdsfg',NULL,0),(672,'77641:23081','gsdfgdsfg',NULL,0),(673,'77641:23097','gsdfgdsfg',NULL,0),(674,'77641:23082','gsdfgdsfg',NULL,0),(675,'77641:23098','gsdfgdsfg',NULL,0),(676,'77641:23079','gsdfgdsfg',NULL,0),(677,'77641:23078','gsdfgdsfg',NULL,0),(678,'77641:23023','gsdfgdsfg',NULL,0),(679,'77641:23025','gsdfgdsfg',NULL,0),(680,'77641:23022','gsdfgdsfg',NULL,0),(681,'77641:23024','gsdfgdsfg',NULL,0),(682,'77641:23027','gsdfgdsfg',NULL,0),(683,'147484:28060','gsdfgdsfg',NULL,0),(684,'147484:28061','gsdfgdsfg',NULL,0),(685,'147484:28062','gsdfgdsfg',NULL,0),(686,'147484:28063','gsdfgdsfg',NULL,0),(687,'147484:28064','gsdfgdsfg',NULL,0),(688,'147484:28065','gsdfgdsfg',NULL,0),(689,'147484:28066','gsdfgdsfg',NULL,0),(690,'176028:28041','gsdfgdsfg',NULL,0),(691,'176028:28042','gsdfgdsfg',NULL,0),(692,'93699:28050','gsdfgdsfg',NULL,0),(693,'217990:25103','gsdfgdsfg',NULL,0),(694,'217990:25102','gsdfgdsfg',NULL,0),(695,'167075:28000','gsdfgdsfg',NULL,0),(696,'240563:28006','gsdfgdsfg',NULL,0),(697,'240563:28040','gsdfgdsfg',NULL,0),(698,'240563:28007','gsdfgdsfg',NULL,0),(699,'240563:28041','gsdfgdsfg',NULL,0),(700,'221520:27038','gsdfgdsfg',NULL,0),(701,'217990:25105','gsdfgdsfg',NULL,0),(702,'240563:28015','gsdfgdsfg',NULL,0),(703,'221520:28002','gsdfgdsfg',NULL,0),(704,'351081:191','gsdfgdsfg',NULL,0),(705,'351081:152','gsdfgdsfg',NULL,0),(706,'147198:27014','gsdfgdsfg',NULL,0),(707,'202816:28016','gsdfgdsfg',NULL,0),(708,'202816:28017','gsdfgdsfg',NULL,0),(709,'147198:27007','gsdfgdsfg',NULL,0),(710,'147198:27008','gsdfgdsfg',NULL,0),(711,'147198:27009','gsdfgdsfg',NULL,0),(712,'147360:28010','gsdfgdsfg',NULL,0),(713,'147360:28011','gsdfgdsfg',NULL,0),(714,'110164:28000','gsdfgdsfg',NULL,0),(715,'147360:28020','gsdfgdsfg',NULL,0),(716,'110164:28001','gsdfgdsfg',NULL,0),(717,'110164:28002','gsdfgdsfg',NULL,0),(718,'110164:28003','gsdfgdsfg',NULL,0),(719,'136753:25016','gsdfgdsfg',NULL,0),(720,'136753:25017','gsdfgdsfg',NULL,0),(721,'136753:25018','gsdfgdsfg',NULL,0),(722,'136753:25019','gsdfgdsfg',NULL,0),(723,'202816:60011','gsdfgdsfg',NULL,0),(724,'81871:28009','gsdfgdsfg',NULL,0),(725,'158332:37003','gsdfgdsfg',NULL,0),(726,'77641:23145','gsdfgdsfg',NULL,0),(727,'326489:26764','gsdfgdsfg',NULL,0),(728,'326489:26741','gsdfgdsfg',NULL,0),(729,'326489:26740','gsdfgdsfg',NULL,0),(730,'326489:26739','gsdfgdsfg',NULL,0),(731,'77641:23130','gsdfgdsfg',NULL,0),(732,'77641:23131','gsdfgdsfg',NULL,0),(733,'98666:23123','gsdfgdsfg',NULL,0),(734,'98666:23126','gsdfgdsfg',NULL,0),(735,'98666:23222','gsdfgdsfg',NULL,0),(736,'98666:23223','gsdfgdsfg',NULL,0),(737,'98666:23119','gsdfgdsfg',NULL,0),(738,'98666:23104','gsdfgdsfg',NULL,0),(739,'98666:23103','gsdfgdsfg',NULL,0),(740,'98666:23221','gsdfgdsfg',NULL,0),(741,'98666:23129','vb',NULL,60),(742,'98666:23186','gsdfgdsfg',NULL,0),(743,'98666:23130','gsdfgdsfg',NULL,0),(744,'98666:23166','gsdfgdsfg',NULL,0),(745,'98666:23206','gsdfgdsfg',NULL,0),(746,'98666:23208','gsdfgdsfg',NULL,0),(747,'98666:23210','gsdfgdsfg',NULL,0),(748,'98666:23176','gsdfgdsfg',NULL,0),(749,'98666:23177','gsdfgdsfg',NULL,0),(750,'98666:23168','gsdfgdsfg',NULL,0),(751,'98666:23170','gsdfgdsfg',NULL,0),(752,'98666:23172','gsdfgdsfg',NULL,0),(753,'98666:23105','gsdfgdsfg',NULL,0),(754,'98666:23106','gsdfgdsfg',NULL,0),(755,'98666:23217','gsdfgdsfg',NULL,0),(756,'98666:23218','gsdfgdsfg',NULL,0),(757,'98666:23219','gsdfgdsfg',NULL,0),(758,'98666:23220','gsdfgdsfg',NULL,0),(759,'98666:23189','gsdfgdsfg',NULL,0),(760,'98666:23127','gsdfgdsfg',NULL,0),(761,'98666:23133','gsdfgdsfg',NULL,0),(762,'98666:23131','gsdfgdsfg',NULL,0),(763,'98666:23139','gsdfgdsfg',NULL,0),(764,'98666:23138','gsdfgdsfg',NULL,0),(765,'98666:23140','gsdfgdsfg',NULL,0),(766,'98666:23108','gsdfgdsfg',NULL,0),(767,'98666:23135','gsdfgdsfg',NULL,0),(768,'98666:23109','gsdfgdsfg',NULL,0),(769,'98666:23114','gsdfgdsfg',NULL,0),(770,'98666:23115','gsdfgdsfg',NULL,0),(771,'98666:23134','gsdfgdsfg',NULL,0),(772,'98666:23188','gsdfgdsfg',NULL,0),(773,'98666:23163','gsdfgdsfg',NULL,0),(774,'98666:23164','gsdfgdsfg',NULL,0),(775,'98666:23165','gsdfgdsfg',NULL,0),(776,'98666:23112','gsdfgdsfg',NULL,0),(777,'98666:23124','gsdfgdsfg',NULL,0),(778,'98666:23125','gsdfgdsfg',NULL,0),(779,'98666:23213','gsdfgdsfg',NULL,0),(780,'98666:23214','gsdfgdsfg',NULL,0),(781,'98666:23178','gsdfgdsfg',NULL,0),(782,'98666:23107','gsdfgdsfg',NULL,0),(783,'98666:23118','gsdfgdsfg',NULL,0),(784,'98666:23122','gsdfgdsfg',NULL,0),(785,'98666:23227','gsdfgdsfg',NULL,0),(786,'98666:23211','gsdfgdsfg',NULL,0),(787,'98666:23226','gsdfgdsfg',NULL,0),(788,'98666:23193','gsdfgdsfg',NULL,0),(789,'98666:23194','gsdfgdsfg',NULL,0),(790,'98666:23195','gsdfgdsfg',NULL,0),(791,'98666:23202','gsdfgdsfg',NULL,0),(792,'98666:23201','gsdfgdsfg',NULL,0),(793,'98666:23200','gsdfgdsfg',NULL,0),(794,'98666:23190','gsdfgdsfg',NULL,0),(795,'98666:23192','gsdfgdsfg',NULL,0),(796,'98666:23191','gsdfgdsfg',NULL,0),(797,'98666:23196','gsdfgdsfg',NULL,0),(798,'98666:23197','gsdfgdsfg',NULL,0),(799,'98666:23199','gsdfgdsfg',NULL,0),(800,'98666:23198','gsdfgdsfg',NULL,0),(801,'98666:23116','gsdfgdsfg',NULL,0),(802,'98666:23212','gsdfgdsfg',NULL,0),(803,'98666:23215','gsdfgdsfg',NULL,0),(804,'98666:23216','gsdfgdsfg',NULL,0),(805,'98666:23203','gsdfgdsfg',NULL,0),(806,'98666:23204','gsdfgdsfg',NULL,0),(807,'98666:23205','gsdfgdsfg',NULL,0),(808,'98666:23207','gsdfgdsfg',NULL,0),(809,'98666:23209','gsdfgdsfg',NULL,0),(810,'98666:23224','gsdfgdsfg',NULL,0),(811,'98666:23225','gsdfgdsfg',NULL,0),(812,'98666:23117','gsdfgdsfg',NULL,0),(813,'98666:23132','gsdfgdsfg',NULL,0),(814,'98666:23128','gsdfgdsfg',NULL,0),(815,'98666:23174','gsdfgdsfg',NULL,0),(816,'98666:23173','gsdfgdsfg',NULL,0),(817,'98666:23169','gsdfgdsfg',NULL,0),(818,'98666:23157','gsdfgdsfg',NULL,0),(819,'98666:23161','gsdfgdsfg',NULL,0),(820,'98666:23158','gsdfgdsfg',NULL,0),(821,'98666:23162','gsdfgdsfg',NULL,0),(822,'98666:23159','gsdfgdsfg',NULL,0),(823,'98666:23160','gsdfgdsfg',NULL,0),(824,'98666:23144','gsdfgdsfg',NULL,0),(825,'98666:23145','gsdfgdsfg',NULL,0),(826,'98666:23142','gsdfgdsfg',NULL,0),(827,'98666:23143','gsdfgdsfg',NULL,0),(828,'98666:23155','gsdfgdsfg',NULL,0),(829,'98666:23148','gsdfgdsfg',NULL,0),(830,'98666:23185','gsdfgdsfg',NULL,0),(831,'98666:23151','gsdfgdsfg',NULL,0),(832,'98666:23150','gsdfgdsfg',NULL,0),(833,'98666:23187','gsdfgdsfg',NULL,0),(834,'98666:23152','gsdfgdsfg',NULL,0),(835,'98666:23153','gsdfgdsfg',NULL,0),(836,'98666:23149','gsdfgdsfg',NULL,0),(837,'98666:23156','gsdfgdsfg',NULL,0),(838,'98666:23154','gsdfgdsfg',NULL,0),(839,'98666:23184','gsdfgdsfg',NULL,0),(840,'98666:23171','gsdfgdsfg',NULL,0),(841,'98666:23175','gsdfgdsfg',NULL,0),(842,'98666:23167','gsdfgdsfg',NULL,0),(843,'98666:23181','gsdfgdsfg',NULL,0),(844,'98666:23182','gsdfgdsfg',NULL,0),(845,'98666:23183','gsdfgdsfg',NULL,0),(846,'98666:23141','gsdfgdsfg',NULL,0),(847,'98666:23147','gsdfgdsfg',NULL,0),(848,'98666:23146','gsdfgdsfg',NULL,0),(849,'98666:23179','gsdfgdsfg',NULL,0),(850,'98666:23180','gsdfgdsfg',NULL,0),(851,'98666:23102','gsdfgdsfg',NULL,0),(852,'98666:23101','gsdfgdsfg',NULL,0),(853,'98666:23136','gsdfgdsfg',NULL,0),(854,'98666:23137','gsdfgdsfg',NULL,0),(855,'98666:23113','gsdfgdsfg',NULL,0),(856,'98666:23110','gsdfgdsfg',NULL,0),(857,'98666:23111','gsdfgdsfg',NULL,0),(858,'98666:23121','gsdfgdsfg',NULL,0),(859,'98666:23120','gsdfgdsfg',NULL,0),(860,'257731:20001','gsdfgdsfg',NULL,0),(861,'98666:23264','gsdfgdsfg',NULL,0),(862,'98666:23253','gsdfgdsfg',NULL,0),(863,'98666:23273','gsdfgdsfg',NULL,0),(864,'98666:23274','gsdfgdsfg',NULL,0),(865,'98666:23240','gsdfgdsfg',NULL,0),(866,'98666:23241','gsdfgdsfg',NULL,0),(867,'98666:23275','gsdfgdsfg',NULL,0),(868,'98666:23276','gsdfgdsfg',NULL,0),(869,'98666:23228','gsdfgdsfg',NULL,0),(870,'98666:23229','gsdfgdsfg',NULL,0),(871,'98666:23260','gsdfgdsfg',NULL,0),(872,'98666:23265','gsdfgdsfg',NULL,0),(873,'98666:23230','gsdfgdsfg',NULL,0),(874,'98666:23271','gsdfgdsfg',NULL,0),(875,'98666:23272','gsdfgdsfg',NULL,0),(876,'98666:23250','gsdfgdsfg',NULL,0),(877,'98666:23258','gsdfgdsfg',NULL,0),(878,'98666:23269','gsdfgdsfg',NULL,0),(879,'98666:23270','gsdfgdsfg',NULL,0),(880,'98666:23263','gsdfgdsfg',NULL,0),(881,'98666:23243','gsdfgdsfg',NULL,0),(882,'98666:23256','gsdfgdsfg',NULL,0),(883,'98666:23249','gsdfgdsfg',NULL,0),(884,'98666:23238','gsdfgdsfg',NULL,0),(885,'98666:23239','gsdfgdsfg',NULL,0),(886,'98666:23251','gsdfgdsfg',NULL,0),(887,'98666:23235','gsdfgdsfg',NULL,0),(888,'98666:23234','gsdfgdsfg',NULL,0),(889,'98666:23236','gsdfgdsfg',NULL,0),(890,'98666:23252','gsdfgdsfg',NULL,0),(891,'98666:23266','gsdfgdsfg',NULL,0),(892,'98666:23259','gsdfgdsfg',NULL,0),(893,'98666:23231','gsdfgdsfg',NULL,0),(894,'98666:23233','gsdfgdsfg',NULL,0),(895,'98666:23232','gsdfgdsfg',NULL,0),(896,'98666:23245','gsdfgdsfg',NULL,0),(897,'98666:23262','gsdfgdsfg',NULL,0),(898,'98666:23261','gsdfgdsfg',NULL,0),(899,'98666:23255','gsdfgdsfg',NULL,0),(900,'98666:23254','gsdfgdsfg',NULL,0),(901,'98666:23267','gsdfgdsfg',NULL,0),(902,'98666:23268','gsdfgdsfg',NULL,0),(903,'98666:23242','gsdfgdsfg',NULL,0),(904,'98666:23257','gsdfgdsfg',NULL,0),(905,'98666:23246','gsdfgdsfg',NULL,0),(906,'98666:23248','gsdfgdsfg',NULL,0),(907,'98666:23247','gsdfgdsfg',NULL,0),(908,'98666:23237','gsdfgdsfg',NULL,0),(909,'98666:23244','gsdfgdsfg',NULL,0),(910,'98666:23277','gsdfgdsfg',NULL,0),(911,'98666:23278','gsdfgdsfg',NULL,0),(912,'98666:23279','gsdfgdsfg',NULL,0),(913,'98666:23280','gsdfgdsfg',NULL,0),(914,'98666:23281','gsdfgdsfg',NULL,0),(915,'98666:23309','gsdfgdsfg',NULL,0),(916,'98666:23310','gsdfgdsfg',NULL,0),(917,'98666:23282','gsdfgdsfg',NULL,0),(918,'98666:23283','gsdfgdsfg',NULL,0),(919,'98666:23286','gsdfgdsfg',NULL,0),(920,'98666:23287','gsdfgdsfg',NULL,0),(921,'98666:23288','gsdfgdsfg',NULL,0),(922,'98666:23289','gsdfgdsfg',NULL,0),(923,'98666:23290','gsdfgdsfg',NULL,0),(924,'98666:23291','gsdfgdsfg',NULL,0),(925,'98666:23292','gsdfgdsfg',NULL,0),(926,'98666:23293','gsdfgdsfg',NULL,0),(927,'98666:23294','gsdfgdsfg',NULL,0),(928,'98666:23295','gsdfgdsfg',NULL,0),(929,'98666:23304','gsdfgdsfg',NULL,0),(930,'98666:23296','gsdfgdsfg',NULL,0),(931,'98666:23297','gsdfgdsfg',NULL,0),(932,'98666:23298','gsdfgdsfg',NULL,0),(933,'98666:23299','gsdfgdsfg',NULL,0),(934,'98666:23300','gsdfgdsfg',NULL,0),(935,'98666:23301','gsdfgdsfg',NULL,0),(936,'98666:23302','gsdfgdsfg',NULL,0),(937,'98666:23303','gsdfgdsfg',NULL,0),(938,'98666:23305','gsdfgdsfg',NULL,0),(939,'98666:23306','gsdfgdsfg',NULL,0),(940,'98666:23312','gsdfgdsfg',NULL,0),(941,'98666:23313','gsdfgdsfg',NULL,0),(942,'98666:23314','gsdfgdsfg',NULL,0),(943,'98666:23315','gsdfgdsfg',NULL,0),(944,'98666:23316','gsdfgdsfg',NULL,0),(945,'98666:23317','gsdfgdsfg',NULL,0),(946,'98666:23318','gsdfgdsfg',NULL,0),(947,'98666:23319','gsdfgdsfg',NULL,0),(948,'98666:23320','gsdfgdsfg',NULL,0),(949,'98666:23284','gsdfgdsfg',NULL,0),(950,'98666:23285','gsdfgdsfg',NULL,0),(951,'98666:23307','gsdfgdsfg',NULL,0),(952,'98666:23308','gsdfgdsfg',NULL,0),(953,'98666:23311','gsdfgdsfg',NULL,0),(954,'110164:28004','gsdfgdsfg',NULL,0),(955,'176028:21710','gsdfgdsfg',NULL,0),(956,'81871:28000','gsdfgdsfg',NULL,0),(957,'240563:28008','gsdfgdsfg',NULL,0),(958,'217990:28068','gsdfgdsfg',NULL,0),(959,'217990:28062','gsdfgdsfg',NULL,0),(960,'81871:28008','gsdfgdsfg',NULL,0),(961,'307212:25112','gsdfgdsfg',NULL,0),(962,'240563:28000','gsdfgdsfg',NULL,0),(963,'217990:25104','gsdfgdsfg',NULL,0),(964,'217990:25075','gsdfgdsfg',NULL,0),(965,'217990:25074','gsdfgdsfg',NULL,0),(966,'91431:28001','gsdfgdsfg',NULL,0),(967,'77641:69003:1','gsdfgdsfg',NULL,0),(968,'77641:23122:2','gsdfgdsfg',NULL,0),(969,'147360:37005','gsdfgdsfg',NULL,0),(970,'147360:37006','gsdfgdsfg',NULL,0),(971,'217990:28006','gsdfgdsfg',NULL,0),(972,'81871:28007','gsdfgdsfg',NULL,0),(973,'217990:28063','gsdfgdsfg',NULL,0),(974,'221520:27042','gsdfgdsfg',NULL,0),(975,'176028:21713','gsdfgdsfg',NULL,0),(976,'329887:39000','gsdfgdsfg',NULL,0),(977,'348682:28014','gsdfgdsfg',NULL,0),(978,'171893:240004','gsdfgdsfg',NULL,0),(979,'91431:28004','gsdfgdsfg',NULL,0),(980,'85701:37026','gsdfgdsfg',NULL,0),(981,'85701:37000','gsdfgdsfg',NULL,0),(982,'85701:37001','gsdfgdsfg',NULL,0),(983,'85701:37002','gsdfgdsfg',NULL,0),(984,'85701:37003','gsdfgdsfg',NULL,0),(985,'85701:37004','gsdfgdsfg',NULL,0),(986,'85701:37005','gsdfgdsfg',NULL,0),(987,'85701:37006','gsdfgdsfg',NULL,0),(988,'85701:37007','gsdfgdsfg',NULL,0),(989,'85701:37008','gsdfgdsfg',NULL,0),(990,'85701:37009','gsdfgdsfg',NULL,0),(991,'85701:37010','gsdfgdsfg',NULL,0),(992,'49869:26003:1','gsdfgdsfg',NULL,0),(993,'110192:29031','gsdfgdsfg',NULL,0),(994,'110192:29032','gsdfgdsfg',NULL,0),(995,'110192:29033','gsdfgdsfg',NULL,0),(996,'110192:29036','gsdfgdsfg',NULL,0),(997,'110192:29038','gsdfgdsfg',NULL,0),(998,'110192:29039','gsdfgdsfg',NULL,0),(999,'110192:29034','gsdfgdsfg',NULL,0),(1000,'110192:29035','gsdfgdsfg',NULL,0),(1001,'110192:29037','gsdfgdsfg',NULL,0),(1002,'110192:29044','gsdfgdsfg',NULL,0),(1003,'110192:29045','gsdfgdsfg',NULL,0),(1004,'110192:29047','gsdfgdsfg',NULL,0),(1005,'110192:29021','gsdfgdsfg',NULL,0),(1006,'110192:29022','gsdfgdsfg',NULL,0),(1007,'110192:29023','gsdfgdsfg',NULL,0),(1008,'110192:29024','gsdfgdsfg',NULL,0),(1009,'110192:29025','gsdfgdsfg',NULL,0),(1010,'110192:29026','gsdfgdsfg',NULL,0),(1011,'85701:26000','gsdfgdsfg',NULL,0),(1012,'85701:24033','gsdfgdsfg',NULL,0),(1013,'85701:24031','gsdfgdsfg',NULL,0),(1014,'85701:24032','gsdfgdsfg',NULL,0),(1015,'110192:24005','gsdfgdsfg',NULL,0),(1016,'110192:37005','gsdfgdsfg',NULL,0),(1017,'110192:26001','gsdfgdsfg',NULL,0),(1018,'110192:26002','gsdfgdsfg',NULL,0),(1019,'110192:26004','gsdfgdsfg',NULL,0),(1020,'110192:26005','gsdfgdsfg',NULL,0),(1021,'110192:35001','gsdfgdsfg',NULL,0),(1022,'110192:26011','gsdfgdsfg',NULL,0),(1023,'110192:26013','gsdfgdsfg',NULL,0),(1024,'85701:24018','gsdfgdsfg',NULL,0),(1025,'85701:24019','gsdfgdsfg',NULL,0),(1026,'85701:24020','gsdfgdsfg',NULL,0),(1027,'85701:24021','gsdfgdsfg',NULL,0),(1028,'49869:28150','gsdfgdsfg',NULL,0),(1029,'49869:28151','gsdfgdsfg',NULL,0),(1030,'49869:28152','gsdfgdsfg',NULL,0),(1031,'49869:28153','gsdfgdsfg',NULL,0),(1032,'49869:28154','gsdfgdsfg',NULL,0),(1033,'49869:28155','gsdfgdsfg',NULL,0),(1034,'49869:28156','gsdfgdsfg',NULL,0),(1035,'49869:28157','gsdfgdsfg',NULL,0),(1036,'49869:28158','gsdfgdsfg',NULL,0),(1037,'49869:28159','gsdfgdsfg',NULL,0),(1038,'49869:28160','gsdfgdsfg',NULL,0),(1039,'49869:28161','gsdfgdsfg',NULL,0),(1040,'49869:28162','gsdfgdsfg',NULL,0),(1041,'49869:28163','gsdfgdsfg',NULL,0),(1042,'49869:28164','gsdfgdsfg',NULL,0),(1043,'49869:28165','gsdfgdsfg',NULL,0),(1044,'49869:28166','gsdfgdsfg',NULL,0),(1045,'49869:28167','gsdfgdsfg',NULL,0),(1046,'49869:28168','gsdfgdsfg',NULL,0),(1047,'49869:28169','gsdfgdsfg',NULL,0),(1048,'49869:28174','gsdfgdsfg',NULL,0),(1049,'49869:28175','gsdfgdsfg',NULL,0),(1050,'49869:28170','gsdfgdsfg',NULL,0),(1051,'49869:28171','gsdfgdsfg',NULL,0),(1052,'49869:28172','gsdfgdsfg',NULL,0),(1053,'49869:28173','gsdfgdsfg',NULL,0),(1054,'49869:28175:1','gsdfgdsfg',NULL,0),(1055,'49869:28176','gsdfgdsfg',NULL,0),(1056,'49869:28177','gsdfgdsfg',NULL,0),(1057,'49869:28178:1','gsdfgdsfg',NULL,0),(1058,'49869:28179:1','gsdfgdsfg',NULL,0),(1059,'61599:10100:1','mega giga',NULL,192),(1060,'49869:28101','gsdfgdsfg',NULL,0),(1061,'81871:28028','gsdfgdsfg',NULL,0),(1062,'81871:28029','gsdfgdsfg',NULL,0),(1063,'81871:28031','gsdfgdsfg',NULL,0),(1064,'81871:28026','gsdfgdsfg',NULL,0),(1065,'81871:28027','gsdfgdsfg',NULL,0),(1066,'85701:21005','gsdfgdsfg',NULL,0),(1067,'85701:26013','gsdfgdsfg',NULL,0),(1068,'49869:24000','gsdfgdsfg',NULL,0),(1069,'49869:28014','gsdfgdsfg',NULL,0),(1070,'49869:28015','gsdfgdsfg',NULL,0),(1071,'49869:60000','gsdfgdsfg',NULL,0),(1072,'81871:28021','gsdfgdsfg',NULL,0),(1073,'81871:28022','gsdfgdsfg',NULL,0),(1074,'81871:28023','gsdfgdsfg',NULL,0),(1075,'81871:28024','gsdfgdsfg',NULL,0),(1076,'81871:28025','gsdfgdsfg',NULL,0),(1077,'49869:28011','gsdfgdsfg',NULL,0),(1078,'85701:26001','gsdfgdsfg',NULL,0),(1079,'85701:26002','gsdfgdsfg',NULL,0),(1080,'85701:26003','gsdfgdsfg',NULL,0),(1081,'85701:26004','gsdfgdsfg',NULL,0),(1082,'85701:26005','gsdfgdsfg',NULL,0),(1083,'85701:26006','gsdfgdsfg',NULL,0),(1084,'85701:26007','gsdfgdsfg',NULL,0),(1085,'85701:26008','gsdfgdsfg',NULL,0),(1086,'85701:26009','gsdfgdsfg',NULL,0),(1087,'85701:26010','gsdfgdsfg',NULL,0),(1088,'49869:28012','gsdfgdsfg',NULL,0),(1089,'81871:28020','gsdfgdsfg',NULL,0),(1090,'49869:28010','gsdfgdsfg',NULL,0),(1091,'85701:24016','gsdfgdsfg',NULL,0),(1092,'85701:24017','gsdfgdsfg',NULL,0),(1093,'110192:28003','gsdfgdsfg',NULL,0),(1094,'77641:24103','gsdfgdsfg',NULL,0),(1095,'77641:24105','gsdfgdsfg',NULL,0),(1096,'77641:24108','gsdfgdsfg',NULL,0),(1097,'77641:24128','gsdfgdsfg',NULL,0),(1098,'77641:24270','gsdfgdsfg',NULL,0),(1099,'77641:24271','gsdfgdsfg',NULL,0),(1100,'77641:24281','gsdfgdsfg',NULL,0),(1101,'77641:37010','gsdfgdsfg',NULL,0),(1102,'77641:37014','gsdfgdsfg',NULL,0),(1103,'77641:37015','gsdfgdsfg',NULL,0),(1104,'77641:37017','gsdfgdsfg',NULL,0),(1105,'77641:37019','gsdfgdsfg',NULL,0),(1106,'85701:1051','gsdfgdsfg',NULL,0),(1107,'85701:1053','gsdfgdsfg',NULL,0),(1108,'85701:23000','gsdfgdsfg',NULL,0),(1109,'85701:23001','gsdfgdsfg',NULL,0),(1110,'85701:23002','gsdfgdsfg',NULL,0),(1111,'85701:23003','gsdfgdsfg',NULL,0),(1112,'85701:23004','gsdfgdsfg',NULL,0),(1113,'85701:23005','gsdfgdsfg',NULL,0),(1114,'85701:23006','gsdfgdsfg',NULL,0),(1115,'85701:23007','gsdfgdsfg',NULL,0),(1116,'85701:23008','gsdfgdsfg',NULL,0),(1117,'85701:23009','gsdfgdsfg',NULL,0),(1118,'85701:23010','gsdfgdsfg',NULL,0),(1119,'85701:23011','gsdfgdsfg',NULL,0),(1120,'85701:23012','gsdfgdsfg',NULL,0),(1121,'85701:23013','gsdfgdsfg',NULL,0),(1122,'85701:23014','gsdfgdsfg',NULL,0),(1123,'85701:23015','gsdfgdsfg',NULL,0),(1124,'85701:24000','gsdfgdsfg',NULL,0),(1125,'85701:24010','gsdfgdsfg',NULL,0),(1126,'85701:24011','gsdfgdsfg',NULL,0),(1127,'85701:24012','gsdfgdsfg',NULL,0),(1128,'85701:24013','gsdfgdsfg',NULL,0),(1129,'85701:24014','gsdfgdsfg',NULL,0),(1130,'85701:24015','gsdfgdsfg',NULL,0),(1131,'85701:24029','gsdfgdsfg',NULL,0),(1132,'85701:24160','gsdfgdsfg',NULL,0),(1133,'85701:24161','gsdfgdsfg',NULL,0),(1134,'85701:28011','gsdfgdsfg',NULL,0),(1135,'85701:28012','gsdfgdsfg',NULL,0),(1136,'85701:28013','gsdfgdsfg',NULL,0),(1137,'85701:37011','gsdfgdsfg',NULL,0),(1138,'85701:37012','gsdfgdsfg',NULL,0),(1139,'85701:38105','gsdfgdsfg',NULL,0),(1140,'85701:38201','gsdfgdsfg',NULL,0),(1141,'85701:61000','gsdfgdsfg',NULL,0),(1142,'111684:60002','gsdfgdsfg',NULL,0),(1143,'49869:28134','gsdfgdsfg',NULL,0),(1144,'49869:28135','gsdfgdsfg',NULL,0),(1145,'85701:24163','gsdfgdsfg',NULL,0),(1146,'49869:28136:1','gsdfgdsfg',NULL,0),(1147,'49869:28131','gsdfgdsfg',NULL,0),(1148,'49869:28133','gsdfgdsfg',NULL,0),(1149,'49869:28130','gsdfgdsfg',NULL,0),(1150,'49869:28132','gsdfgdsfg',NULL,0),(1151,'85701:110020','gsdfgdsfg',NULL,0),(1152,'77641:38000','gsdfgdsfg',NULL,0),(1153,'85701:21001','gsdfgdsfg',NULL,0),(1154,'85701:21002','gsdfgdsfg',NULL,0),(1155,'85701:110006','gsdfgdsfg',NULL,0),(1156,'85701:110007','gsdfgdsfg',NULL,0),(1157,'81871:21002','gsdfgdsfg',NULL,0),(1158,'81871:21003','gsdfgdsfg',NULL,0),(1159,'81871:23020','gsdfgdsfg',NULL,0),(1160,'81871:23021','gsdfgdsfg',NULL,0),(1161,'81871:23023','gsdfgdsfg',NULL,0),(1162,'81871:23024','gsdfgdsfg',NULL,0),(1163,'81871:23025','gsdfgdsfg',NULL,0),(1164,'81871:23026','gsdfgdsfg',NULL,0),(1165,'81871:37002','gsdfgdsfg',NULL,0),(1166,'81871:37003','gsdfgdsfg',NULL,0),(1167,'85701:24176','gsdfgdsfg',NULL,0),(1168,'85701:24177','gsdfgdsfg',NULL,0),(1169,'85701:90000','gsdfgdsfg',NULL,0),(1170,'85701:90001','gsdfgdsfg',NULL,0),(1171,'85701:21003','gsdfgdsfg',NULL,0),(1172,'85701:110005','gsdfgdsfg',NULL,0),(1173,'85701:110010','gsdfgdsfg',NULL,0),(1174,'85701:110011','gsdfgdsfg',NULL,0),(1175,'85701:110013','gsdfgdsfg',NULL,0),(1176,'85701:110015','gsdfgdsfg',NULL,0),(1177,'85701:110016','gsdfgdsfg',NULL,0),(1178,'85701:38007','gsdfgdsfg',NULL,0),(1179,'85701:38008','gsdfgdsfg',NULL,0),(1180,'85701:38009','gsdfgdsfg',NULL,0),(1181,'85701:38010','gsdfgdsfg',NULL,0),(1182,'85701:38003','gsdfgdsfg',NULL,0),(1183,'85701:38004','gsdfgdsfg',NULL,0),(1184,'85701:110012','gsdfgdsfg',NULL,0),(1185,'85701:110014','gsdfgdsfg',NULL,0),(1186,'85701:38005','gsdfgdsfg',NULL,0),(1187,'85701:38006','gsdfgdsfg',NULL,0),(1188,'81871:37100','gsdfgdsfg',NULL,0),(1189,'81871:37103','gsdfgdsfg',NULL,0),(1190,'85701:24175','gsdfgdsfg',NULL,0),(1191,'85701:110027','gsdfgdsfg',NULL,0),(1192,'81871:23100','gsdfgdsfg',NULL,0),(1193,'81871:37101','gsdfgdsfg',NULL,0),(1194,'81871:37102','gsdfgdsfg',NULL,0),(1195,'85701:24173','gsdfgdsfg',NULL,0),(1196,'85701:110025','gsdfgdsfg',NULL,0),(1197,'85701:110026','gsdfgdsfg',NULL,0),(1198,'85701:24162','gsdfgdsfg',NULL,0),(1199,'85701:24164','gsdfgdsfg',NULL,0),(1200,'85701:24165','gsdfgdsfg',NULL,0),(1201,'85701:37013','gsdfgdsfg',NULL,0),(1202,'85701:37014','gsdfgdsfg',NULL,0),(1203,'85701:37015','gsdfgdsfg',NULL,0),(1204,'85701:37016','gsdfgdsfg',NULL,0),(1205,'85701:37017','gsdfgdsfg',NULL,0),(1206,'85701:37018','gsdfgdsfg',NULL,0),(1207,'85701:37019','gsdfgdsfg',NULL,0),(1208,'85701:37020','gsdfgdsfg',NULL,0),(1209,'85701:37021','gsdfgdsfg',NULL,0),(1210,'85701:37022','gsdfgdsfg',NULL,0),(1211,'85701:37023','gsdfgdsfg',NULL,0),(1212,'85701:37024','gsdfgdsfg',NULL,0),(1213,'85701:110021','gsdfgdsfg',NULL,0),(1214,'85701:110024','gsdfgdsfg',NULL,0),(1215,'85701:558814','gsdfgdsfg',NULL,0),(1216,'85701:23102','gsdfgdsfg',NULL,0),(1217,'85701:23104','gsdfgdsfg',NULL,0),(1218,'85701:23105','gsdfgdsfg',NULL,0),(1219,'85701:23113','gsdfgdsfg',NULL,0),(1220,'85701:23114','gsdfgdsfg',NULL,0),(1221,'85701:23115','gsdfgdsfg',NULL,0),(1222,'85701:23116','gsdfgdsfg',NULL,0),(1223,'85701:23117','gsdfgdsfg',NULL,0),(1224,'85701:23118','gsdfgdsfg',NULL,0),(1225,'85701:23202','gsdfgdsfg',NULL,0),(1226,'85701:23203','gsdfgdsfg',NULL,0),(1227,'85701:23204','gsdfgdsfg',NULL,0),(1228,'85701:23205','gsdfgdsfg',NULL,0),(1229,'85701:23206','gsdfgdsfg','http://www.auran.com/TRS2004/DLS_downloadasset.php?DownloadID=27565',0),(1230,'85701:23207','gsdfgdsfg',NULL,0),(1231,'85701:23208','gsdfgdsfg',NULL,0),(1232,'85701:23209','gsdfgdsfg',NULL,0),(1233,'85701:23210','gsdfgdsfg',NULL,0),(1234,'85701:23211','gsdfgdsfg',NULL,0),(1235,'85701:23212','gsdfgdsfg',NULL,0),(1236,'85701:23213','gsdfgdsfg',NULL,0),(1237,'85701:23214','gsdfgdsfg',NULL,0),(1238,'85701:23215','gsdfgdsfg',NULL,0),(1239,'85701:23216','gsdfgdsfg',NULL,0),(1240,'85701:23217','gsdfgdsfg',NULL,0),(1241,'85701:23218','gsdfgdsfg',NULL,0),(1242,'85701:23219','gsdfgdsfg',NULL,0),(1243,'85701:23220','gsdfgdsfg',NULL,0),(1244,'85701:23221','gsdfgdsfg',NULL,0),(1245,'85701:23222','gsdfgdsfg',NULL,0),(1246,'85701:23223','gsdfgdsfg',NULL,0),(1247,'85701:23224','gsdfgdsfg',NULL,0),(1248,'85701:23225','gsdfgdsfg',NULL,0),(1249,'85701:23226','gsdfgdsfg',NULL,0),(1250,'85701:23227','gsdfgdsfg',NULL,0),(1251,'85701:23228','gsdfgdsfg',NULL,0),(1252,'85701:23229','gsdfgdsfg',NULL,0),(1253,'85701:23230','gsdfgdsfg',NULL,0),(1254,'85701:23231','gsdfgdsfg',NULL,0),(1255,'85701:23232','gsdfgdsfg',NULL,0),(1256,'85701:23233','gsdfgdsfg',NULL,0),(1257,'85701:23234','gsdfgdsfg',NULL,0),(1258,'85701:23235','gsdfgdsfg',NULL,0),(1259,'85701:23236','gsdfgdsfg',NULL,0),(1260,'85701:23237','gsdfgdsfg',NULL,0),(1261,'85701:23238','gsdfgdsfg',NULL,0),(1262,'85701:23239','gsdfgdsfg',NULL,0),(1263,'85701:23240','gsdfgdsfg',NULL,0),(1264,'85701:23241','gsdfgdsfg',NULL,0),(1265,'85701:23242','gsdfgdsfg',NULL,0),(1266,'85701:23243','gsdfgdsfg',NULL,0),(1267,'85701:23244','gsdfgdsfg',NULL,0),(1268,'85701:23245','gsdfgdsfg',NULL,0),(1269,'85701:23246','gsdfgdsfg',NULL,0),(1270,'85701:23247','gsdfgdsfg',NULL,0),(1271,'85701:23248','gsdfgdsfg',NULL,0),(1272,'85701:23249','gsdfgdsfg',NULL,0),(1273,'85701:23250','gsdfgdsfg',NULL,0),(1274,'85701:23251','gsdfgdsfg',NULL,0),(1275,'85701:23252','gsdfgdsfg',NULL,0),(1276,'85701:23253','gsdfgdsfg',NULL,0),(1277,'85701:23254','gsdfgdsfg',NULL,0),(1278,'85701:23255','gsdfgdsfg',NULL,0),(1279,'85701:23258','gsdfgdsfg',NULL,0),(1280,'85701:23259','gsdfgdsfg',NULL,0),(1281,'85701:23260','gsdfgdsfg',NULL,0),(1282,'85701:23261','gsdfgdsfg',NULL,0),(1283,'85701:23262','gsdfgdsfg',NULL,0),(1284,'85701:23263','gsdfgdsfg',NULL,0),(1285,'85701:23264','gsdfgdsfg',NULL,0),(1286,'85701:23265','gsdfgdsfg',NULL,0),(1287,'85701:23268','gsdfgdsfg',NULL,0),(1288,'85701:23269','gsdfgdsfg',NULL,0),(1289,'85701:23270','gsdfgdsfg',NULL,0),(1290,'85701:23271','gsdfgdsfg',NULL,0),(1291,'85701:23272','gsdfgdsfg',NULL,0),(1292,'85701:23273','gsdfgdsfg',NULL,0),(1293,'85701:23274','gsdfgdsfg',NULL,0),(1294,'85701:23275','gsdfgdsfg',NULL,0),(1295,'85701:23276','gsdfgdsfg',NULL,0),(1296,'85701:23277','gsdfgdsfg',NULL,0),(1297,'85701:23278','gsdfgdsfg',NULL,0),(1298,'85701:23279','gsdfgdsfg',NULL,0),(1299,'85701:23280','gsdfgdsfg',NULL,0),(1300,'85701:23281','gsdfgdsfg',NULL,0),(1301,'85701:23282','gsdfgdsfg',NULL,0),(1302,'85701:23283','gsdfgdsfg',NULL,0),(1303,'85701:23284','gsdfgdsfg',NULL,0),(1304,'85701:23285','gsdfgdsfg',NULL,0),(1305,'85701:23286','gsdfgdsfg',NULL,0),(1306,'85701:23287','gsdfgdsfg',NULL,0),(1307,'85701:23288','gsdfgdsfg',NULL,0),(1308,'85701:23289','gsdfgdsfg',NULL,0),(1309,'85701:23290','gsdfgdsfg',NULL,0),(1310,'85701:23291','gsdfgdsfg',NULL,0),(1311,'85701:23292','gsdfgdsfg',NULL,0),(1312,'85701:23293','gsdfgdsfg',NULL,0),(1313,'85701:23294','gsdfgdsfg',NULL,0),(1314,'85701:23295','gsdfgdsfg',NULL,0),(1315,'85701:23296','gsdfgdsfg',NULL,0),(1316,'85701:23297','gsdfgdsfg',NULL,0),(1317,'85701:23298','gsdfgdsfg',NULL,0),(1318,'85701:23299','gsdfgdsfg',NULL,0),(1319,'85701:23300','gsdfgdsfg',NULL,0),(1320,'85701:23301','gsdfgdsfg',NULL,0),(1321,'85701:23302','gsdfgdsfg',NULL,0),(1322,'85701:23303','gsdfgdsfg',NULL,0),(1323,'85701:23304','gsdfgdsfg',NULL,0),(1324,'85701:23305','gsdfgdsfg',NULL,0),(1325,'85701:23306','gsdfgdsfg',NULL,0),(1326,'85701:23307','gsdfgdsfg',NULL,0),(1327,'85701:23308','gsdfgdsfg',NULL,0),(1328,'85701:23309','gsdfgdsfg',NULL,0),(1329,'85701:23310','gsdfgdsfg',NULL,0),(1330,'85701:23311','gsdfgdsfg',NULL,0),(1331,'85701:23312','gsdfgdsfg',NULL,0),(1332,'85701:23313','gsdfgdsfg',NULL,0),(1333,'85701:23314','gsdfgdsfg',NULL,0),(1334,'85701:23315','gsdfgdsfg',NULL,0),(1335,'85701:23316','gsdfgdsfg',NULL,0),(1336,'85701:23317','gsdfgdsfg',NULL,0),(1337,'85701:23318','gsdfgdsfg',NULL,0),(1338,'85701:23319','gsdfgdsfg',NULL,0),(1339,'85701:23320','gsdfgdsfg',NULL,0),(1340,'85701:23321','gsdfgdsfg',NULL,0),(1341,'85701:23322','gsdfgdsfg',NULL,0),(1342,'85701:23323','gsdfgdsfg',NULL,0),(1343,'85701:23324','gsdfgdsfg',NULL,0),(1344,'85701:23325','gsdfgdsfg',NULL,0),(1345,'85701:23326','gsdfgdsfg',NULL,0),(1346,'85701:23327','gsdfgdsfg',NULL,0),(1347,'85701:23328','gsdfgdsfg',NULL,0),(1348,'85701:23329','gsdfgdsfg',NULL,0),(1349,'85701:23330','gsdfgdsfg',NULL,0),(1350,'85701:23331','gsdfgdsfg',NULL,0),(1351,'85701:23332','gsdfgdsfg',NULL,0),(1352,'85701:23333','gsdfgdsfg',NULL,0),(1353,'85701:23334','gsdfgdsfg',NULL,0),(1354,'85701:24141','gsdfgdsfg',NULL,0),(1355,'85701:24147','gsdfgdsfg',NULL,0),(1356,'85701:24148','gsdfgdsfg',NULL,0),(1357,'85701:24157','gsdfgdsfg',NULL,0),(1358,'85701:24158','gsdfgdsfg',NULL,0),(1359,'85701:24166','gsdfgdsfg',NULL,0),(1360,'85701:24174','gsdfgdsfg',NULL,0),(1361,'85701:24091','gsdfgdsfg',NULL,0),(1362,'85701:24050','gsdfgdsfg',NULL,0),(1363,'85701:24118','gsdfgdsfg',NULL,0),(1364,'85701:24119','gsdfgdsfg',NULL,0),(1365,'85701:24120','gsdfgdsfg',NULL,0),(1366,'85701:24121','gsdfgdsfg',NULL,0),(1367,'85701:24122','gsdfgdsfg',NULL,0),(1368,'85701:24133','gsdfgdsfg',NULL,0),(1369,'85701:24134','gsdfgdsfg',NULL,0),(1370,'85701:24135','gsdfgdsfg',NULL,0),(1371,'85701:24136','gsdfgdsfg',NULL,0),(1372,'85701:24137','gsdfgdsfg',NULL,0),(1373,'85701:24138','gsdfgdsfg',NULL,0),(1374,'85701:24139','gsdfgdsfg',NULL,0),(1375,'85701:24140','gsdfgdsfg',NULL,0),(1376,'85701:24153','gsdfgdsfg',NULL,0),(1377,'85701:24154','gsdfgdsfg',NULL,0),(1378,'85701:24155','gsdfgdsfg',NULL,0),(1379,'85701:24156','gsdfgdsfg',NULL,0),(1380,'85701:24149','gsdfgdsfg',NULL,0),(1381,'85701:24150','gsdfgdsfg',NULL,0),(1382,'85701:24151','gsdfgdsfg',NULL,0),(1383,'85701:24152','gsdfgdsfg',NULL,0),(1384,'85701:24114','gsdfgdsfg',NULL,0),(1385,'85701:24115','gsdfgdsfg',NULL,0),(1386,'85701:24116','gsdfgdsfg',NULL,0),(1387,'85701:24117','gsdfgdsfg',NULL,0),(1388,'85701:24123','gsdfgdsfg',NULL,0),(1389,'85701:24124','gsdfgdsfg',NULL,0),(1390,'85701:24125','gsdfgdsfg',NULL,0),(1391,'85701:24126','gsdfgdsfg',NULL,0),(1392,'85701:24127','gsdfgdsfg',NULL,0),(1393,'85701:24128','gsdfgdsfg',NULL,0),(1394,'85701:24129','gsdfgdsfg',NULL,0),(1395,'85701:24130','gsdfgdsfg',NULL,0),(1396,'85701:24131','gsdfgdsfg',NULL,0),(1397,'85701:24132','gsdfgdsfg',NULL,0),(1398,'85701:24168','gsdfgdsfg',NULL,0),(1399,'85701:24169','gsdfgdsfg',NULL,0),(1400,'85701:24170','gsdfgdsfg',NULL,0),(1401,'85701:24171','gsdfgdsfg',NULL,0),(1402,'85701:24172','gsdfgdsfg',NULL,0),(1403,'85701:23103','gsdfgdsfg',NULL,0),(1404,'85701:24144','gsdfgdsfg',NULL,0),(1405,'85701:24145','gsdfgdsfg',NULL,0),(1406,'85701:24143','gsdfgdsfg',NULL,0),(1407,'85701:24146','gsdfgdsfg',NULL,0),(1408,'85701:24001','gsdfgdsfg',NULL,0),(1409,'85701:24002','gsdfgdsfg',NULL,0),(1410,'85701:24003','gsdfgdsfg',NULL,0),(1411,'85701:24004','gsdfgdsfg',NULL,0),(1412,'85701:24052','gsdfgdsfg',NULL,0),(1413,'85701:24053','gsdfgdsfg',NULL,0),(1414,'85701:24054','gsdfgdsfg',NULL,0),(1415,'85701:24055','gsdfgdsfg',NULL,0),(1416,'85701:24056','gsdfgdsfg',NULL,0),(1417,'85701:24057','gsdfgdsfg',NULL,0),(1418,'85701:24058','gsdfgdsfg',NULL,0),(1419,'85701:24059','gsdfgdsfg',NULL,0),(1420,'85701:24060','gsdfgdsfg',NULL,0),(1421,'85701:24061','gsdfgdsfg',NULL,0),(1422,'85701:24062','gsdfgdsfg',NULL,0),(1423,'85701:24079','gsdfgdsfg',NULL,0),(1424,'85701:24080','gsdfgdsfg',NULL,0),(1425,'110192:24201','gsdfgdsfg',NULL,0),(1426,'110192:24202','gsdfgdsfg',NULL,0),(1427,'110192:24203','gsdfgdsfg',NULL,0),(1428,'110192:15097','gsdfgdsfg',NULL,0),(1429,'110192:15098','gsdfgdsfg',NULL,0),(1430,'110192:50097','gsdfgdsfg',NULL,0),(1431,'110192:354','gsdfgdsfg',NULL,0),(1432,'110192:50354','gsdfgdsfg',NULL,0),(1433,'110192:50355','gsdfgdsfg',NULL,0),(1434,'110192:50356','gsdfgdsfg',NULL,0),(1435,'110192:51354','gsdfgdsfg',NULL,0),(1436,'110192:55354','gsdfgdsfg',NULL,0),(1437,'85701:853','gsdfgdsfg',NULL,0),(1438,'85701:8531','gsdfgdsfg',NULL,0),(1439,'85701:50021','gsdfgdsfg',NULL,0),(1440,'85701:51853','gsdfgdsfg',NULL,0),(1441,'85701:54001','gsdfgdsfg',NULL,0),(1442,'110192:55334','gsdfgdsfg',NULL,0),(1443,'110192:3341','gsdfgdsfg',NULL,0),(1444,'110192:50334','gsdfgdsfg',NULL,0),(1445,'110192:51334','gsdfgdsfg',NULL,0),(1446,'85701:10062','gsdfgdsfg',NULL,0),(1447,'85701:50020','gsdfgdsfg',NULL,0),(1448,'85701:10061','gsdfgdsfg',NULL,0),(1449,'85701:50018','gsdfgdsfg',NULL,0),(1450,'85701:10026','gsdfgdsfg',NULL,0),(1451,'85701:10027','gsdfgdsfg',NULL,0),(1452,'85701:10028','gsdfgdsfg',NULL,0),(1453,'85701:10029','gsdfgdsfg',NULL,0),(1454,'85701:10030','gsdfgdsfg',NULL,0),(1455,'85701:10033','gsdfgdsfg',NULL,0),(1456,'85701:10038','mega giga',NULL,192),(1457,'85701:10041','gsdfgdsfg',NULL,0),(1458,'85701:10055','gsdfgdsfg',NULL,0),(1459,'85701:10063','gsdfgdsfg',NULL,0),(1460,'85701:10034','gsdfgdsfg',NULL,0),(1461,'85701:10035','gsdfgdsfg',NULL,0),(1462,'85701:10036','gsdfgdsfg',NULL,0),(1463,'85701:10039','gsdfgdsfg',NULL,0),(1464,'85701:10042','gsdfgdsfg',NULL,0),(1465,'85701:10056','gsdfgdsfg',NULL,0),(1466,'136753:37001','gsdfgdsfg',NULL,0),(1467,'136753:37002','gsdfgdsfg',NULL,0),(1468,'136753:37003','gsdfgdsfg',NULL,0),(1469,'136753:37014','gsdfgdsfg',NULL,0),(1470,'81871:28002','gsdfgdsfg',NULL,0),(1471,'136753:37013','gsdfgdsfg',NULL,0),(1472,'136753:37020','gsdfgdsfg',NULL,0),(1473,'136753:37011','gsdfgdsfg',NULL,0),(1474,'136753:25098','gsdfgdsfg',NULL,0),(1475,'136753:25097','gsdfgdsfg',NULL,0),(1476,'136753:25096','gsdfgdsfg',NULL,0),(1477,'136753:37042','gsdfgdsfg',NULL,0),(1478,'136753:37039','gsdfgdsfg',NULL,0),(1479,'136753:37021','gsdfgdsfg',NULL,0),(1480,'136753:37023','gsdfgdsfg',NULL,0),(1481,'136753:25094','gsdfgdsfg',NULL,0),(1482,'136753:25095','gsdfgdsfg',NULL,0),(1483,'136753:37024','gsdfgdsfg',NULL,0),(1484,'136753:37025','gsdfgdsfg',NULL,0),(1485,'136753:37038','gsdfgdsfg',NULL,0),(1486,'136753:13021','gsdfgdsfg',NULL,0),(1487,'136753:37015','gsdfgdsfg',NULL,0),(1488,'136753:37012','gsdfgdsfg',NULL,0),(1489,'136753:37016','gsdfgdsfg',NULL,0),(1490,'136753:37017','gsdfgdsfg',NULL,0),(1491,'136753:37018','gsdfgdsfg',NULL,0),(1492,'136753:37026','gsdfgdsfg',NULL,0),(1493,'147484:37817','gsdfgdsfg',NULL,0),(1494,'147484:37818','gsdfgdsfg',NULL,0),(1495,'147484:37819','gsdfgdsfg',NULL,0),(1496,'147484:37820','gsdfgdsfg',NULL,0),(1497,'147484:37817:9','gsdfgdsfg',NULL,0),(1498,'147484:37818:9','gsdfgdsfg',NULL,0),(1499,'147484:37820:9','gsdfgdsfg',NULL,0),(1500,'147484:37819:9','gsdfgdsfg',NULL,0),(1501,'147484:37824','gsdfgdsfg',NULL,0),(1502,'147484:37835','gsdfgdsfg',NULL,0),(1503,'147484:37823','gsdfgdsfg',NULL,0),(1504,'147484:37836','gsdfgdsfg',NULL,0),(1505,'147484:37834','gsdfgdsfg',NULL,0),(1506,'147484:28445','gsdfgdsfg',NULL,0),(1507,'147484:37826','gsdfgdsfg',NULL,0),(1508,'147484:37832','gsdfgdsfg',NULL,0),(1509,'147484:37828','gsdfgdsfg',NULL,0),(1510,'147484:37829','gsdfgdsfg',NULL,0),(1511,'147484:37827','gsdfgdsfg',NULL,0),(1512,'147484:37833','gsdfgdsfg',NULL,0),(1513,'147484:37831','gsdfgdsfg',NULL,0),(1514,'147484:37830','gsdfgdsfg',NULL,0),(1515,'147484:37824:9','gsdfgdsfg',NULL,0),(1516,'147484:37835:9','gsdfgdsfg',NULL,0),(1517,'147484:37823:9','gsdfgdsfg',NULL,0),(1518,'147484:37836:9','gsdfgdsfg',NULL,0),(1519,'147484:37834:9','gsdfgdsfg',NULL,0),(1520,'147484:28445:9','gsdfgdsfg',NULL,0),(1521,'147484:37826:9','gsdfgdsfg',NULL,0),(1522,'147484:37832:9','gsdfgdsfg',NULL,0),(1523,'147484:37828:9','gsdfgdsfg',NULL,0),(1524,'147484:37829:9','gsdfgdsfg',NULL,0),(1525,'147484:37827:9','gsdfgdsfg',NULL,0),(1526,'147484:37833:9','gsdfgdsfg',NULL,0),(1527,'147484:37831:9','gsdfgdsfg',NULL,0),(1528,'147484:37830:9','gsdfgdsfg',NULL,0),(1529,'147484:37850','gsdfgdsfg',NULL,0),(1530,'147484:37853','gsdfgdsfg',NULL,0),(1531,'147484:37849','gsdfgdsfg',NULL,0),(1532,'147484:37852','gsdfgdsfg',NULL,0),(1533,'147484:37851','gsdfgdsfg',NULL,0),(1534,'147484:37854','gsdfgdsfg',NULL,0),(1535,'147484:37881','gsdfgdsfg',NULL,0),(1536,'147484:37882','gsdfgdsfg',NULL,0),(1537,'147484:37883','gsdfgdsfg',NULL,0),(1538,'147484:37884','gsdfgdsfg',NULL,0),(1539,'147484:37885','gsdfgdsfg',NULL,0),(1540,'147484:28453','gsdfgdsfg',NULL,0),(1541,'147484:37877','gsdfgdsfg',NULL,0),(1542,'147484:37886','gsdfgdsfg',NULL,0),(1543,'147484:37878','gsdfgdsfg',NULL,0),(1544,'147484:37850:9','gsdfgdsfg',NULL,0),(1545,'147484:37853:9','gsdfgdsfg',NULL,0),(1546,'147484:37849:9','gsdfgdsfg',NULL,0),(1547,'147484:37852:9','gsdfgdsfg',NULL,0),(1548,'147484:37851:9','gsdfgdsfg',NULL,0),(1549,'147484:37854:9','gsdfgdsfg',NULL,0),(1550,'147484:37881:9','gsdfgdsfg',NULL,0),(1551,'147484:37882:9','gsdfgdsfg',NULL,0),(1552,'147484:37883:9','gsdfgdsfg',NULL,0),(1553,'147484:37884:9','gsdfgdsfg',NULL,0),(1554,'147484:37885:9','gsdfgdsfg',NULL,0),(1555,'147484:28453:9','gsdfgdsfg',NULL,0),(1556,'147484:37877:9','gsdfgdsfg',NULL,0),(1557,'147484:37886:9','gsdfgdsfg',NULL,0),(1558,'147484:37878:9','gsdfgdsfg',NULL,0),(1559,'147484:37801','gsdfgdsfg',NULL,0),(1560,'147484:37803','gsdfgdsfg',NULL,0),(1561,'147484:37804','gsdfgdsfg',NULL,0),(1562,'147484:37802','gsdfgdsfg',NULL,0),(1563,'147484:37806','gsdfgdsfg',NULL,0),(1564,'147484:37805','gsdfgdsfg',NULL,0),(1565,'147484:37813','gsdfgdsfg',NULL,0),(1566,'147484:37815','gsdfgdsfg',NULL,0),(1567,'147484:37807','gsdfgdsfg',NULL,0),(1568,'147484:37808','gsdfgdsfg',NULL,0),(1569,'147484:37809','gsdfgdsfg',NULL,0),(1570,'147484:37810','gsdfgdsfg',NULL,0),(1571,'147484:37811','gsdfgdsfg',NULL,0),(1572,'147484:37812','gsdfgdsfg',NULL,0),(1573,'147484:37814','gsdfgdsfg',NULL,0),(1574,'147484:37816','gsdfgdsfg',NULL,0),(1575,'147484:28444','gsdfgdsfg',NULL,0),(1576,'147484:28443','gsdfgdsfg',NULL,0),(1577,'147484:37801:9','gsdfgdsfg',NULL,0),(1578,'147484:37803:9','gsdfgdsfg',NULL,0),(1579,'147484:37804:9','gsdfgdsfg',NULL,0),(1580,'147484:37802:9','gsdfgdsfg',NULL,0),(1581,'147484:37806:9','gsdfgdsfg',NULL,0),(1582,'147484:37805:9','gsdfgdsfg',NULL,0),(1583,'147484:37813:9','gsdfgdsfg',NULL,0),(1584,'147484:37815:9','gsdfgdsfg',NULL,0),(1585,'147484:37807:9','gsdfgdsfg',NULL,0),(1586,'147484:37808:9','gsdfgdsfg',NULL,0),(1587,'147484:37809:9','gsdfgdsfg',NULL,0),(1588,'147484:37810:9','gsdfgdsfg',NULL,0),(1589,'147484:37811:9','gsdfgdsfg',NULL,0),(1590,'147484:37812:9','gsdfgdsfg',NULL,0),(1591,'147484:37814:9','gsdfgdsfg',NULL,0),(1592,'147484:37816:9','gsdfgdsfg',NULL,0),(1593,'147484:28444:9','gsdfgdsfg',NULL,0),(1594,'147484:28443:9','gsdfgdsfg',NULL,0),(1595,'123123:123123','test',NULL,145),(1596,'321321:321321','test',NULL,0),(1597,'123:321','sfgsdfgf',NULL,39),(1598,'325:145','ghghghgh',NULL,117),(1599,'147:789','r\"e\'t',NULL,177),(1600,'123:654','sdgfs dfdfdsf',NULL,191),(1601,'123:963','sdfsd',NULL,28),(1602,'123:987','dsf fdg dfsdfsdf',NULL,0),(1603,'147484:29001:10','test1',NULL,0),(1604,'147484:29002:10','test1',NULL,0),(1605,'147484:29003:10','test1',NULL,0),(1606,'147484:29007:10','test1',NULL,0),(1607,'147484:29008:10','test1',NULL,0),(1608,'147484:29010:10','test1',NULL,0),(1609,'147484:29011:10','test1',NULL,0),(1610,'147484:29012:10','test1',NULL,0),(1611,'147484:29020:10','test1',NULL,0),(1612,'147484:29021:10','test1',NULL,0),(1613,'147484:29022:10','test1',NULL,0),(1614,'147484:29024:10','test1',NULL,0),(1615,'147484:29026:10','test1',NULL,0),(1616,'147484:29028:10','test1',NULL,0),(1617,'147484:29029:10','test1',NULL,0),(1618,'147484:29050:10','test1',NULL,0),(1619,'147484:29051:10','test1',NULL,0),(1620,'147484:29052:10','test1',NULL,0),(1621,'147484:29053:10','test1',NULL,0),(1622,'147484:29054:10','test1',NULL,0),(1623,'147484:29055:10','test1',NULL,0),(1624,'147484:29056:10','test1',NULL,0),(1625,'147484:29057:10','test1',NULL,0),(1626,'147484:29058:10','test1',NULL,0),(1627,'147484:29059:10','test1',NULL,0),(1628,'147484:29060:10','test1',NULL,0),(1629,'147484:29061:10','test1',NULL,0),(1630,'147484:29065:10','test1',NULL,0),(1631,'147484:29067:10','test1',NULL,0),(1632,'147484:29080:10','test1',NULL,0),(1633,'147484:29081:10','test1',NULL,0),(1634,'147484:29082:10','test1',NULL,0),(1635,'147484:29083:10','test1',NULL,0),(1636,'147484:29084:10','test1',NULL,0),(1637,'147484:29085:10','test1',NULL,0),(1638,'147484:29100:10','test1',NULL,0),(1639,'147484:29101:10','test1',NULL,0),(1640,'147484:29102:10','test1',NULL,0),(1641,'147484:29103:10','test1',NULL,0),(1642,'147484:29104:10','test1',NULL,0),(1643,'147484:29105:10','test1',NULL,0),(1644,'147484:29106:10','test1',NULL,0),(1645,'147484:29107:10','test1',NULL,0),(1646,'147484:29108:10','test1',NULL,0),(1647,'147484:29109:10','test1',NULL,0),(1648,'147484:29110:10','test1',NULL,0),(1649,'147484:29112:10','test1',NULL,0),(1650,'147484:29220:10','test1',NULL,0),(1651,'147484:29221:10','test1',NULL,0),(1652,'147484:29222:10','test1',NULL,0),(1653,'147484:29223:10','test1',NULL,0),(1654,'147484:29224:10','test1',NULL,0),(1655,'147484:29225:10','test1',NULL,0),(1656,'147484:29262:10','test1',NULL,0),(1657,'147484:29263:10','test1',NULL,0),(1658,'147484:29264:10','test1',NULL,0),(1659,'147484:29301:10','test1',NULL,0),(1660,'147484:29302:10','test1',NULL,0),(1661,'147484:29303:10','test1',NULL,0),(1662,'147484:29304:10','test1',NULL,0),(1663,'147484:29314:10','test1',NULL,0),(1664,'147484:29315:10','test1',NULL,0),(1665,'147484:29316:10','test1',NULL,0),(1666,'147484:29317:10','test1',NULL,0),(1667,'147484:29391:10','test1',NULL,0),(1668,'147484:29392:10','test1',NULL,0),(1669,'147484:29393:10','test1',NULL,0),(1670,'147484:29394:10','test1',NULL,0),(1671,'147484:29401:10','test1',NULL,0),(1672,'147484:29402:10','test1',NULL,0),(1673,'147484:29403:10','test1',NULL,0),(1674,'147484:29404:10','test1',NULL,0),(1675,'147484:29405:10','test1',NULL,0),(1676,'147484:29501:10','test1',NULL,0),(1677,'147484:29502:10','test1',NULL,0),(1678,'147484:29503:10','test1',NULL,0),(1679,'147484:29504:10','test1',NULL,0),(1680,'147484:29531:10','test1',NULL,0),(1681,'147484:29532:10','test1',NULL,0),(1682,'147484:29533:10','test1',NULL,0),(1683,'147484:29534:10','test1',NULL,0),(1684,'147484:29601:10','test1',NULL,0),(1685,'147484:29602:10','test1',NULL,0),(1686,'147484:29603:10','test1',NULL,0),(1687,'147484:29604:10','test1',NULL,0),(1688,'147484:29605:10','test1',NULL,0),(1689,'147484:29701:10','test1',NULL,0),(1690,'147484:29702:10','test1',NULL,0),(1691,'147484:29703:10','test1',NULL,0),(1692,'147484:29704:10','test1',NULL,0),(1693,'147484:29705:10','test1',NULL,0),(1694,'147484:29706:10','test1',NULL,0),(1695,'147484:29707:10','test1',NULL,0),(1696,'147484:29761:10','test1',NULL,0),(1697,'147484:29762:10','test1',NULL,0),(1698,'147484:29763:10','test1',NULL,0),(1699,'147484:29764:10','test1',NULL,0),(1700,'147484:29765:10','test1',NULL,0),(1701,'147484:29766:10','test1',NULL,0),(1702,'147484:29767:10','test1',NULL,0),(1703,'147484:29768:10','test1',NULL,0),(1704,'147484:29769:10','test1',NULL,0),(1705,'147484:29770:10','test1',NULL,0),(1706,'147484:29771:10','test1',NULL,0),(1707,'147484:29772:10','test1',NULL,101),(1708,'147484:29773:10','test1',NULL,0),(1709,'147484:29774:10','test1',NULL,101),(1710,'147484:29775:10','test1',NULL,101),(1711,'147484:29776:10','test1',NULL,101),(1712,'147484:29777:10','test1',NULL,101),(1713,'147484:29778:10','test1',NULL,0),(1714,'147484:80000:10','test1',NULL,101),(1715,'61599:10100','ret',NULL,179),(1716,'147:791','ret',NULL,177),(1717,'147:792','ret',NULL,178),(1718,'77:999','r\"e\'t',NULL,177);
/*!40000 ALTER TABLE `trainz_kuids` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trainz_versions`
--

DROP TABLE IF EXISTS `trainz_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trainz_versions` (
  `idtrainz_version` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `rank` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'rucni razeni',
  PRIMARY KEY (`idtrainz_version`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='verze trainzu';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trainz_versions`
--

LOCK TABLES `trainz_versions` WRITE;
/*!40000 ALTER TABLE `trainz_versions` DISABLE KEYS */;
INSERT INTO `trainz_versions` VALUES (1,'TRS2012',2),(2,'TSR11111.SP',1),(3,'TRS2006',0),(4,'UTiiSii',3),(5,'TRS2010',3);
/*!40000 ALTER TABLE `trainz_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `iduser` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(45) NOT NULL,
  `hash` varchar(100) NOT NULL,
  `idrole` int(10) unsigned NOT NULL,
  `alias` varchar(50) DEFAULT NULL COMMENT 'jmeny alias',
  `avatar` varchar(200) DEFAULT NULL COMMENT 'obrazek',
  `kuid` int(10) unsigned DEFAULT NULL COMMENT 'UID autora',
  `email` varchar(100) NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'potvrzeny uzivatel',
  `confirmed_email` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'potvrzeny email',
  `added` datetime NOT NULL,
  `edited` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`iduser`),
  UNIQUE KEY `login_UNIQUE` (`login`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_idrole_idx` (`idrole`),
  CONSTRAINT `fk_users_roles` FOREIGN KEY (`idrole`) REFERENCES `roles` (`idrole`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COMMENT='uzivatele';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Fugess','2fe68c9dc0b75ceb0642d79c4b1acdfd46ebcc9eaa9fc236c2cc4fd1c4c91cc5a3933b453962b43d',2,'Martin[cze]','d46e9a822c669c71d00e588fe9880299523b677988a8e.png',0,'martin.fugess@gmail.com',1,1,'2013-08-11 14:12:11','2013-09-19 23:07:05',NULL),(2,'geniv','499a6450c2637e5061843c3c49c521f11e9332bbb665a22faad7b681a9edae0c2160e594b800f2b2',2,'darebák','c0d73816751a8f482b87541648d04ebe5261b92802497.jpg',92033,'geniv.radek@gmail.com',1,1,'2013-08-11 14:12:12','2013-10-19 00:41:44',NULL),(43,'pokus','63d06cbce9c8faf54ae59b5433be1319e88558725f39a8fd80595272a0a1b6fa6e7114ca1012dd06',24,NULL,'f801a778037e7bfdae5589d11a3177805261b9363a7b8.jpg',0,'email@email.cz',1,1,'2013-09-20 22:18:52','2013-10-19 00:41:58',NULL);
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

-- Dump completed on 2014-03-26 22:36:10
