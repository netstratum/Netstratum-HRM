-- MySQL dump 10.13  Distrib 5.6.24, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: netstratum_hrm
-- ------------------------------------------------------
-- Server version	5.6.24-0ubuntu2

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
-- Table structure for table `ajax_chat_bans`
--

DROP TABLE IF EXISTS `ajax_chat_bans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ajax_chat_bans` (
  `userID` int(11) NOT NULL,
  `userName` varchar(64) COLLATE utf8_bin NOT NULL,
  `dateTime` datetime NOT NULL,
  `ip` varbinary(16) NOT NULL,
  PRIMARY KEY (`userID`),
  KEY `userName` (`userName`),
  KEY `dateTime` (`dateTime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ajax_chat_bans`
--

LOCK TABLES `ajax_chat_bans` WRITE;
/*!40000 ALTER TABLE `ajax_chat_bans` DISABLE KEYS */;
/*!40000 ALTER TABLE `ajax_chat_bans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ajax_chat_invitations`
--

DROP TABLE IF EXISTS `ajax_chat_invitations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ajax_chat_invitations` (
  `userID` int(11) NOT NULL,
  `channel` int(11) NOT NULL,
  `dateTime` datetime NOT NULL,
  PRIMARY KEY (`userID`,`channel`),
  KEY `dateTime` (`dateTime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ajax_chat_invitations`
--

LOCK TABLES `ajax_chat_invitations` WRITE;
/*!40000 ALTER TABLE `ajax_chat_invitations` DISABLE KEYS */;
/*!40000 ALTER TABLE `ajax_chat_invitations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ajax_chat_messages`
--

DROP TABLE IF EXISTS `ajax_chat_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ajax_chat_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `userName` varchar(64) COLLATE utf8_bin NOT NULL,
  `userRole` int(1) NOT NULL,
  `channel` int(11) NOT NULL,
  `dateTime` datetime NOT NULL,
  `ip` varbinary(16) NOT NULL,
  `text` text COLLATE utf8_bin,
  PRIMARY KEY (`id`),
  KEY `message_condition` (`id`,`channel`,`dateTime`),
  KEY `dateTime` (`dateTime`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ajax_chat_messages`
--



--
-- Table structure for table `ajax_chat_online`
--

DROP TABLE IF EXISTS `ajax_chat_online`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ajax_chat_online` (
  `userID` int(11) NOT NULL,
  `userName` varchar(64) COLLATE utf8_bin NOT NULL,
  `userRole` int(1) NOT NULL,
  `channel` int(11) NOT NULL,
  `dateTime` datetime NOT NULL,
  `ip` varbinary(16) NOT NULL,
  PRIMARY KEY (`userID`),
  KEY `userName` (`userName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ajax_chat_online`
--

LOCK TABLES `ajax_chat_online` WRITE;
/*!40000 ALTER TABLE `ajax_chat_online` DISABLE KEYS */;
INSERT INTO `ajax_chat_online` VALUES (457853025,'',0,0,'2019-01-22 06:46:14','*k��');
/*!40000 ALTER TABLE `ajax_chat_online` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=243 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'US','United States'),(2,'CA','Canada'),(3,'AF','Afghanistan'),(4,'AL','Albania'),(5,'DZ','Algeria'),(6,'DS','American Samoa'),(7,'AD','Andorra'),(8,'AO','Angola'),(9,'AI','Anguilla'),(10,'AQ','Antarctica'),(11,'AG','Antigua and/or Barbuda'),(12,'AR','Argentina'),(13,'AM','Armenia'),(14,'AW','Aruba'),(15,'AU','Australia'),(16,'AT','Austria'),(17,'AZ','Azerbaijan'),(18,'BS','Bahamas'),(19,'BH','Bahrain'),(20,'BD','Bangladesh'),(21,'BB','Barbados'),(22,'BY','Belarus'),(23,'BE','Belgium'),(24,'BZ','Belize'),(25,'BJ','Benin'),(26,'BM','Bermuda'),(27,'BT','Bhutan'),(28,'BO','Bolivia'),(29,'BA','Bosnia and Herzegovina'),(30,'BW','Botswana'),(31,'BV','Bouvet Island'),(32,'BR','Brazil'),(33,'IO','British lndian Ocean Territory'),(34,'BN','Brunei Darussalam'),(35,'BG','Bulgaria'),(36,'BF','Burkina Faso'),(37,'BI','Burundi'),(38,'KH','Cambodia'),(39,'CM','Cameroon'),(40,'CV','Cape Verde'),(41,'KY','Cayman Islands'),(42,'CF','Central African Republic'),(43,'TD','Chad'),(44,'CL','Chile'),(45,'CN','China'),(46,'CX','Christmas Island'),(47,'CC','Cocos (Keeling) Islands'),(48,'CO','Colombia'),(49,'KM','Comoros'),(50,'CG','Congo'),(51,'CK','Cook Islands'),(52,'CR','Costa Rica'),(53,'HR','Croatia (Hrvatska)'),(54,'CU','Cuba'),(55,'CY','Cyprus'),(56,'CZ','Czech Republic'),(57,'DK','Denmark'),(58,'DJ','Djibouti'),(59,'DM','Dominica'),(60,'DO','Dominican Republic'),(61,'TP','East Timor'),(62,'EC','Ecuador'),(63,'EG','Egypt'),(64,'SV','El Salvador'),(65,'GQ','Equatorial Guinea'),(66,'ER','Eritrea'),(67,'EE','Estonia'),(68,'ET','Ethiopia'),(69,'FK','Falkland Islands (Malvinas)'),(70,'FO','Faroe Islands'),(71,'FJ','Fiji'),(72,'FI','Finland'),(73,'FR','France'),(74,'FX','France, Metropolitan'),(75,'GF','French Guiana'),(76,'PF','French Polynesia'),(77,'TF','French Southern Territories'),(78,'GA','Gabon'),(79,'GM','Gambia'),(80,'GE','Georgia'),(81,'DE','Germany'),(82,'GH','Ghana'),(83,'GI','Gibraltar'),(84,'GR','Greece'),(85,'GL','Greenland'),(86,'GD','Grenada'),(87,'GP','Guadeloupe'),(88,'GU','Guam'),(89,'GT','Guatemala'),(90,'GN','Guinea'),(91,'GW','Guinea-Bissau'),(92,'GY','Guyana'),(93,'HT','Haiti'),(94,'HM','Heard and Mc Donald Islands'),(95,'HN','Honduras'),(96,'HK','Hong Kong'),(97,'HU','Hungary'),(98,'IS','Iceland'),(99,'IN','India'),(100,'ID','Indonesia'),(101,'IR','Iran (Islamic Republic of)'),(102,'IQ','Iraq'),(103,'IE','Ireland'),(104,'IL','Israel'),(105,'IT','Italy'),(106,'CI','Ivory Coast'),(107,'JM','Jamaica'),(108,'JP','Japan'),(109,'JO','Jordan'),(110,'KZ','Kazakhstan'),(111,'KE','Kenya'),(112,'KI','Kiribati'),(113,'KP','Korea, Democratic People\'s Republic of'),(114,'KR','Korea, Republic of'),(115,'XK','Kosovo'),(116,'KW','Kuwait'),(117,'KG','Kyrgyzstan'),(118,'LA','Lao People\'s Democratic Republic'),(119,'LV','Latvia'),(120,'LB','Lebanon'),(121,'LS','Lesotho'),(122,'LR','Liberia'),(123,'LY','Libyan Arab Jamahiriya'),(124,'LI','Liechtenstein'),(125,'LT','Lithuania'),(126,'LU','Luxembourg'),(127,'MO','Macau'),(128,'MK','Macedonia'),(129,'MG','Madagascar'),(130,'MW','Malawi'),(131,'MY','Malaysia'),(132,'MV','Maldives'),(133,'ML','Mali'),(134,'MT','Malta'),(135,'MH','Marshall Islands'),(136,'MQ','Martinique'),(137,'MR','Mauritania'),(138,'MU','Mauritius'),(139,'TY','Mayotte'),(140,'MX','Mexico'),(141,'FM','Micronesia, Federated States of'),(142,'MD','Moldova, Republic of'),(143,'MC','Monaco'),(144,'MN','Mongolia'),(145,'ME','Montenegro'),(146,'MS','Montserrat'),(147,'MA','Morocco'),(148,'MZ','Mozambique'),(149,'MM','Myanmar'),(150,'NA','Namibia'),(151,'NR','Nauru'),(152,'NP','Nepal'),(153,'NL','Netherlands'),(154,'AN','Netherlands Antilles'),(155,'NC','New Caledonia'),(156,'NZ','New Zealand'),(157,'NI','Nicaragua'),(158,'NE','Niger'),(159,'NG','Nigeria'),(160,'NU','Niue'),(161,'NF','Norfork Island'),(162,'MP','Northern Mariana Islands'),(163,'NO','Norway'),(164,'OM','Oman'),(165,'PK','Pakistan'),(166,'PW','Palau'),(167,'PA','Panama'),(168,'PG','Papua New Guinea'),(169,'PY','Paraguay'),(170,'PE','Peru'),(171,'PH','Philippines'),(172,'PN','Pitcairn'),(173,'PL','Poland'),(174,'PT','Portugal'),(175,'PR','Puerto Rico'),(176,'QA','Qatar'),(177,'RE','Reunion'),(178,'RO','Romania'),(179,'RU','Russian Federation'),(180,'RW','Rwanda'),(181,'KN','Saint Kitts and Nevis'),(182,'LC','Saint Lucia'),(183,'VC','Saint Vincent and the Grenadines'),(184,'WS','Samoa'),(185,'SM','San Marino'),(186,'ST','Sao Tome and Principe'),(187,'SA','Saudi Arabia'),(188,'SN','Senegal'),(189,'RS','Serbia'),(190,'SC','Seychelles'),(191,'SL','Sierra Leone'),(192,'SG','Singapore'),(193,'SK','Slovakia'),(194,'SI','Slovenia'),(195,'SB','Solomon Islands'),(196,'SO','Somalia'),(197,'ZA','South Africa'),(198,'GS','South Georgia South Sandwich Islands'),(199,'ES','Spain'),(200,'LK','Sri Lanka'),(201,'SH','St. Helena'),(202,'PM','St. Pierre and Miquelon'),(203,'SD','Sudan'),(204,'SR','Suriname'),(205,'SJ','Svalbarn and Jan Mayen Islands'),(206,'SZ','Swaziland'),(207,'SE','Sweden'),(208,'CH','Switzerland'),(209,'SY','Syrian Arab Republic'),(210,'TW','Taiwan'),(211,'TJ','Tajikistan'),(212,'TZ','Tanzania, United Republic of'),(213,'TH','Thailand'),(214,'TG','Togo'),(215,'TK','Tokelau'),(216,'TO','Tonga'),(217,'TT','Trinidad and Tobago'),(218,'TN','Tunisia'),(219,'TR','Turkey'),(220,'TM','Turkmenistan'),(221,'TC','Turks and Caicos Islands'),(222,'TV','Tuvalu'),(223,'UG','Uganda'),(224,'UA','Ukraine'),(225,'AE','United Arab Emirates'),(226,'GB','United Kingdom'),(227,'UM','United States minor outlying islands'),(228,'UY','Uruguay'),(229,'UZ','Uzbekistan'),(230,'VU','Vanuatu'),(231,'VA','Vatican City State'),(232,'VE','Venezuela'),(233,'VN','Vietnam'),(234,'VG','Virgin Islands (British)'),(235,'VI','Virgin Islands (U.S.)'),(236,'WF','Wallis and Futuna Islands'),(237,'EH','Western Sahara'),(238,'YE','Yemen'),(239,'YU','Yugoslavia'),(240,'ZR','Zaire'),(241,'ZM','Zambia'),(242,'ZW','Zimbabwe');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_company`
--

DROP TABLE IF EXISTS `hrm_company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(200) NOT NULL,
  `company_email` varchar(200) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `place` varchar(200) NOT NULL,
  `country` varchar(100) NOT NULL,
  `postalcode` varchar(50) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `company_type` enum('super_admin','reseller','client') NOT NULL,
  `active` enum('Y','N') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `id_3` (`id`),
  KEY `company_name` (`company_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_company`
--


--
-- Table structure for table `hrm_config`
--

DROP TABLE IF EXISTS `hrm_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_config` (
  `key` varchar(200) NOT NULL,
  `value` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_config`
--

LOCK TABLES `hrm_config` WRITE;
/*!40000 ALTER TABLE `hrm_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_countries`
--

DROP TABLE IF EXISTS `hrm_countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=240 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_countries`
--

LOCK TABLES `hrm_countries` WRITE;
/*!40000 ALTER TABLE `hrm_countries` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_current_job`
--

DROP TABLE IF EXISTS `hrm_current_job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_current_job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_number` int(11) NOT NULL,
  `job_title` varchar(200) NOT NULL,
  `job_status` varchar(200) NOT NULL,
  `job_category` varchar(200) NOT NULL,
  `join_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_current_job`
--


--
-- Table structure for table `hrm_dependent`
--

DROP TABLE IF EXISTS `hrm_dependent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_dependent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_number` int(11) NOT NULL,
  `dependent_name` varchar(300) NOT NULL,
  `dependent_relation` varchar(250) NOT NULL,
  `dependent_dob` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_dependent`
--

--
-- Table structure for table `hrm_doc_view`
--

DROP TABLE IF EXISTS `hrm_doc_view`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_doc_view` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `doc_id` bigint(20) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `active` enum('Y','N','','') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2484 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_doc_view`
--

--
-- Table structure for table `hrm_docs`
--

DROP TABLE IF EXISTS `hrm_docs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_docs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `created_by` int(11) NOT NULL,
  `folder_name` varchar(200) NOT NULL,
  `file_name` varchar(200) NOT NULL,
  `active` enum('Y','N','','') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2339 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_docs`
--

--
-- Table structure for table `hrm_emp_basicsalary`
--

DROP TABLE IF EXISTS `hrm_emp_basicsalary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_emp_basicsalary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_number` int(7) NOT NULL DEFAULT '0',
  `sal_grd_code` int(11) DEFAULT NULL,
  `currency_id` varchar(6) NOT NULL DEFAULT '',
  `ebsal_basic_salary` varchar(100) DEFAULT NULL,
  `payperiod_code` varchar(13) DEFAULT NULL,
  `salary_component` varchar(100) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sal_grd_code` (`sal_grd_code`),
  KEY `currency_id` (`currency_id`),
  KEY `emp_number` (`emp_number`),
  KEY `payperiod_code` (`payperiod_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_emp_basicsalary`
--

LOCK TABLES `hrm_emp_basicsalary` WRITE;
/*!40000 ALTER TABLE `hrm_emp_basicsalary` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_emp_basicsalary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_emp_children`
--

DROP TABLE IF EXISTS `hrm_emp_children`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_emp_children` (
  `emp_number` int(7) NOT NULL DEFAULT '0',
  `ec_seqno` decimal(2,0) NOT NULL DEFAULT '0',
  `ec_name` varchar(100) DEFAULT '',
  `ec_date_of_birth` date DEFAULT NULL,
  PRIMARY KEY (`emp_number`,`ec_seqno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_emp_children`
--

LOCK TABLES `hrm_emp_children` WRITE;
/*!40000 ALTER TABLE `hrm_emp_children` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_emp_children` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_emp_emergency_contacts`
--

DROP TABLE IF EXISTS `hrm_emp_emergency_contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_emp_emergency_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_number` int(11) NOT NULL,
  `eec_seqno` decimal(11,0) NOT NULL,
  `eec_name` varchar(100) NOT NULL,
  `eec_address` text NOT NULL,
  `eec_city` varchar(200) NOT NULL,
  `eec_state` varchar(200) NOT NULL,
  `eec_pincode` varchar(20) NOT NULL,
  `eec_country` varchar(200) NOT NULL,
  `eec_relationship` varchar(100) DEFAULT '',
  `eec_home_no` varchar(100) DEFAULT '',
  `eec_mobile_no` varchar(100) DEFAULT '',
  `eec_office_no` varchar(100) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_emp_emergency_contacts`
--

--
-- Table structure for table `hrm_emp_history_of_ealier_pos`
--

DROP TABLE IF EXISTS `hrm_emp_history_of_ealier_pos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_emp_history_of_ealier_pos` (
  `emp_number` int(7) NOT NULL DEFAULT '0',
  `emp_seqno` decimal(2,0) NOT NULL DEFAULT '0',
  `ehoep_job_title` varchar(100) DEFAULT '',
  `ehoep_years` varchar(100) DEFAULT '',
  PRIMARY KEY (`emp_number`,`emp_seqno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_emp_history_of_ealier_pos`
--

LOCK TABLES `hrm_emp_history_of_ealier_pos` WRITE;
/*!40000 ALTER TABLE `hrm_emp_history_of_ealier_pos` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_emp_history_of_ealier_pos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_employee`
--

DROP TABLE IF EXISTS `hrm_employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_employee` (
  `emp_number` int(7) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(50) DEFAULT NULL,
  `emp_lastname` varchar(250) NOT NULL DEFAULT '',
  `emp_firstname` varchar(250) NOT NULL DEFAULT '',
  `emp_middle_name` varchar(250) NOT NULL DEFAULT '',
  `emp_nick_name` varchar(100) DEFAULT '',
  `emp_primary_address` text NOT NULL,
  `emp_primary_city` varchar(200) NOT NULL,
  `emp_primary_state` varchar(200) NOT NULL,
  `emp_primary_country` varchar(200) NOT NULL,
  `emp_primary_pincode` int(11) NOT NULL,
  `emp_permanent_address` text NOT NULL,
  `emp_permanent_city` varchar(200) NOT NULL,
  `emp_permanent_state` varchar(200) NOT NULL,
  `emp_permanent_country` varchar(200) NOT NULL,
  `emp_permanent_pincode` int(11) NOT NULL,
  `emp_gender` enum('M','F') DEFAULT NULL,
  `emp_dob` date NOT NULL,
  `emp_marital_status` varchar(20) DEFAULT NULL,
  `emp_dri_lice_num` varchar(100) DEFAULT '',
  `emp_status` enum('Y','N') DEFAULT 'Y',
  `job_title_code` int(7) DEFAULT NULL,
  `emp_home_phone` int(11) NOT NULL,
  `emp_mobile` int(11) NOT NULL,
  `joined_date` date DEFAULT NULL,
  `emp_additional_notes` text NOT NULL,
  `emp_deleted` enum('Y','N') NOT NULL DEFAULT 'N',
  `google_push_id` text NOT NULL,
  `apple_push_id` text NOT NULL,
  PRIMARY KEY (`emp_number`),
  UNIQUE KEY `emp_number` (`emp_number`),
  KEY `job_title_code` (`job_title_code`),
  KEY `emp_status` (`emp_status`)
) ENGINE=InnoDB AUTO_INCREMENT=149 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_employee`
--

--
-- Table structure for table `hrm_employee_leave`
--

DROP TABLE IF EXISTS `hrm_employee_leave`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_employee_leave` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_number` int(11) NOT NULL,
  `leave_type` int(11) NOT NULL,
  `leave_number` decimal(10,2) NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `year` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1943 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_employee_leave`
--

--
-- Table structure for table `hrm_hardware`
--

DROP TABLE IF EXISTS `hrm_hardware`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_hardware` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resource_name` varchar(50) NOT NULL,
  `make` varchar(25) NOT NULL,
  `serial_no` varchar(50) DEFAULT NULL,
  `model` varchar(25) NOT NULL,
  `remarks` text NOT NULL,
  `modification_date` datetime NOT NULL,
  `vendor_details` text NOT NULL,
  `warranty` date NOT NULL,
  `purchase_date` date NOT NULL,
  `delete` enum('0','1') DEFAULT '0',
  `macaddress1` varchar(250) DEFAULT NULL,
  `macaddress2` varchar(250) DEFAULT NULL,
  `macaddress3` varchar(250) DEFAULT NULL,
  `macaddress4` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_hardware`
--

--
-- Table structure for table `hrm_holidays`
--

DROP TABLE IF EXISTS `hrm_holidays`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_holidays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `holiday_date` datetime NOT NULL,
  `holiday_type` enum('holiday','optional') NOT NULL DEFAULT 'holiday',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

DROP TABLE IF EXISTS `hrm_job_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_job_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_category` varchar(300) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_job_category`
--

LOCK TABLES `hrm_job_category` WRITE;
/*!40000 ALTER TABLE `hrm_job_category` DISABLE KEYS */;
INSERT INTO `hrm_job_category` VALUES (1,'Officials & Managers','active'),(2,'Broadview Team','active'),(3,'Web Team','active'),(4,'Others','active'),(5,'Cingo Team','active'),(6,'Operations','');
/*!40000 ALTER TABLE `hrm_job_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_job_title`
--

DROP TABLE IF EXISTS `hrm_job_title`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_job_title` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_title` varchar(250) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_job_title`
--

LOCK TABLES `hrm_job_title` WRITE;
/*!40000 ALTER TABLE `hrm_job_title` DISABLE KEYS */;
INSERT INTO `hrm_job_title` VALUES (1,'Senior Developer','active'),(2,'Junior Developer','active'),(3,'Trainee','active'),(4,'Others','active'),(5,'QA','active'),(6,'Software Engineer','active'),(7,'HR',''),(8,'Network Administrator','');
/*!40000 ALTER TABLE `hrm_job_title` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_language`
--

DROP TABLE IF EXISTS `hrm_language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_language` (
  `emp_number` int(7) NOT NULL DEFAULT '0',
  `lang_id` int(11) NOT NULL,
  `fluency` smallint(6) NOT NULL DEFAULT '0',
  `competency` smallint(6) DEFAULT '0',
  `comments` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`emp_number`,`lang_id`,`fluency`),
  KEY `lang_id` (`lang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_language`
--

LOCK TABLES `hrm_language` WRITE;
/*!40000 ALTER TABLE `hrm_language` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_language` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_leave`
--

DROP TABLE IF EXISTS `hrm_leave`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_leave` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `emp_number` int(11) NOT NULL,
  `emp_leave_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_type` enum('fullday','halfday_morning','halfday_evening','custom') NOT NULL DEFAULT 'fullday',
  `end_type` enum('fullday','halfday_morning','halfday_evening','custom') NOT NULL DEFAULT 'fullday',
  `leave_days` decimal(10,2) NOT NULL DEFAULT '0.00',
  `apply_date` datetime NOT NULL,
  `createdby` varchar(200) NOT NULL,
  `approved_by` int(11) NOT NULL,
  `leave_comments` text NOT NULL,
  `remarks` text NOT NULL,
  `approval` enum('approve','reject','pending','cancel') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2861 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

DROP TABLE IF EXISTS `hrm_leave_approval`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_leave_approval` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `hrm_leave_id` bigint(20) NOT NULL,
  `remarks` text NOT NULL,
  `supervisor_id` int(11) NOT NULL,
  `approval` enum('pending','reject','approve','') NOT NULL DEFAULT 'pending',
  `approval_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2042 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hrm_leave_days`
--

DROP TABLE IF EXISTS `hrm_leave_days`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_leave_days` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_number` int(11) NOT NULL,
  `week_days` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=318 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_leave_days`
--

--
-- Table structure for table `hrm_leave_time`
--

DROP TABLE IF EXISTS `hrm_leave_time`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_leave_time` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hrm_leave_id` int(11) NOT NULL,
  `start_day_time` varchar(50) NOT NULL,
  `end_day_time` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2915 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_leave_time`
--

--
-- Table structure for table `hrm_leave_types`
--

DROP TABLE IF EXISTS `hrm_leave_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_leave_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `leave_max_no` decimal(10,2) NOT NULL,
  `emp_appliable` enum('Y','N') NOT NULL DEFAULT 'Y',
  `probation_period` int(11) NOT NULL,
  `custom_leave_type` enum('Y','N') NOT NULL DEFAULT 'N',
  `expiry_date` datetime NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `year` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_leave_types`
--

LOCK TABLES `hrm_leave_types` WRITE;
/*!40000 ALTER TABLE `hrm_leave_types` DISABLE KEYS */;
INSERT INTO `hrm_leave_types` VALUES (1,'Casual Leave (CL)',6.00,'Y',6,'N','0000-00-00 00:00:00','Y',''),(2,'Sick Leave (SL)',6.00,'Y',2,'N','0000-00-00 00:00:00','Y',''),(3,'Privileged Leave (PL)',12.00,'Y',2,'N','0000-00-00 00:00:00','Y',''),(4,'Maternity Leave (ML)',5.00,'N',1,'N','0000-00-00 00:00:00','Y',''),(5,'Festival Leave',2.00,'Y',0,'N','0000-00-00 00:00:00','Y',''),(6,'Paternity Leave',5.00,'N',4,'N','1970-01-01 00:00:00','Y',''),(7,'Compassionate Leave',5.00,'N',1,'N','0000-00-00 00:00:00','Y',''),(8,'Loss of Pay (LoP)',0.00,'N',0,'N','0000-00-00 00:00:00','Y',''),(9,'Compensatory Leave',5.00,'Y',20,'Y','2015-01-03 00:00:00','Y','2015');
/*!40000 ALTER TABLE `hrm_leave_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_locations`
--

DROP TABLE IF EXISTS `hrm_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_locations` (
  `emp_number` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  PRIMARY KEY (`emp_number`,`location_id`),
  KEY `location_id` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_locations`
--

LOCK TABLES `hrm_locations` WRITE;
/*!40000 ALTER TABLE `hrm_locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_login_history`
--

DROP TABLE IF EXISTS `hrm_login_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_login_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `login_time` datetime NOT NULL,
  `ip_address` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6733 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_login_history`
--

--
-- Table structure for table `hrm_mail`
--

DROP TABLE IF EXISTS `hrm_mail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_address` varchar(50) NOT NULL,
  `mail_bcc` varchar(50) NOT NULL,
  `template_name` varchar(100) NOT NULL,
  `display_name` varchar(100) NOT NULL,
  `mail_content` text NOT NULL,
  `dynamic_variable` mediumtext NOT NULL,
  `subject` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_mail`
--

LOCK TABLES `hrm_mail` WRITE;
/*!40000 ALTER TABLE `hrm_mail` DISABLE KEYS */;
INSERT INTO `hrm_mail` VALUES (1,'hr@netstratum.com','jineed@netstratum.com','registration_mail','Registration Mail','<p>Dear #_FIRSTNAME_# #_LASTNAME_#,<br />\n<br />\nYour HRM account is now active. Please find your login information below.<br />\nUsername : &nbsp;#_USERNAME_#<br />\nPassword : &nbsp;#_PASSWORD_#<br />\n<br />\nPlease feel free to change your password after your first login.<br />\n<br />\nThanks,<br />\nNetstratum HR.</p>\n','#_FIRSTNAME_#~Employee First Name|#_LASTNAME_#~Employee Last Name|#_USERNAME_#~Employee User Name|#_PASSWORD_#~Employee Password','Your Netstratum HRM account is now active.'),(2,'hr@netstratum.com','','forgot_password','Forgot Password','<p>Dear #_FIRSTNAME_#,</p>\n\n<p>This is in response with your recent request on Netstratum HRM</p>\n\n<p>Your new password is : #_PASSWORD_#</p>\n\n<p>Thanks,</p>\n\n<p>HR Admin,</p>\n\n<p>Netstratum.</p>\n','#_FIRSTNAME_#~Employee First Name|#_USERNAME_#~Employee User Name|#_PASSWORD_#~Employee Password','Your Account Recovery Information'),(4,'hr@netstratum.com','','leave_request_admin_confirm','Apply Leave to admin,hr,supervisors','<p>Hi,</p>\n\n<p>#_FIRSTNAME_# requested for #_LEAVE_TYPE_#&nbsp;&nbsp;on&nbsp;#_LEAVE_DATE_# for&nbsp;#_DAYS_# day(s).</p>\n\n<p>Leave Reason- #_REASON_#</p>\n\n<p>&nbsp;Please login to HRM to approve / reject this request.</p>\n\n<p>Thanks,</p>\n\n<p>Netstratum HR</p>\n','#_FIRSTNAME_#~Employee First Name|#_LASTNAME_#~Employee Last Name|#_LEAVE_DATE_#~Leave Date|#_DAYS_#~Days|#_LEAVE_TYPE_#~Leave Type|#_EMPLOYEE_EMAIL_#~Employee Email|#_REASON_#~Reason | Employee Leave Request','Employee Leave Request'),(5,'hr@netstratum.com','jineed@netstratum.com','leave_assign','Assign Leave to Employee','<p>Dear #_FIRSTNAME_#,&nbsp;</p>\n\n<p>New #_LEAVE_TYPE_# category has been added to you.</p>\n\n<p>Thanks,</p>\n\n<p>Netstratum HR</p>\n','#_FIRSTNAME_#~Employee First Name|#_EXPIRE_DATE_#~Leave Expiration Date|#_DAYS_#~Days|#_LEAVE_TYPE_#~Leave Category|#_EMPLOYEE_EMAIL_#~Employee Email','New Leave Category Added'),(8,'hr@netstratum.com','','leave_cancel_admin','Cancel Leave Confirmation to Admin,Hr,Supervisors','<p>Dear Team,</p>\n\n<p>This is to inform you that&nbsp;#_FIRSTNAME_#&nbsp;cancelled his leave request.</p>\n\n<p>Thanks,<br />\nNetstratum HR</p>\n','#_FIRSTNAME_#~Employee First Name|#_LEAVE_DATE_#~Leave Date|#_DAYS_#~Days|#_LEAVE_TYPE_#~Leave Type|#_EMPLOYEE_EMAIL_#~Employee Email|#_REASON_#~Reason','Employee Leave Cancelled.'),(9,'hr@netstratum.com','','leave_reject','Leave Reject to Employee','<p>Dear #_FIRSTNAME_#,</p>\n\n<p>This is to inform you that your request for&nbsp;#_LEAVE_TYPE_# has been rejected.</p>\n\n<p>Thanks,</p>\n\n<p>Netstratum HR</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n','#_FIRSTNAME_#~Employee First Name|#_LEAVE_DATE_#~Leave Date|#_DAYS_#~Days|#_LEAVE_TYPE_#~Leave Type|#_EMPLOYEE_EMAIL_#~Employee Email|#_REMARKS_#~Remarks','Leave Status'),(11,'admin@netstratum.com','','leave_reject_super','Leave Reject Status to HR/Admin','<p>#_FIRSTNAME_#&#39;s Leave Rejected</p>\n','#_FIRSTNAME_#~Employee First Name|#_LEAVE_DATE_#~Leave Date|#_DAYS_#~Days|#_LEAVE_TYPE_#~Leave Type|#_EMPLOYEE_EMAIL_#~Employee Email|#_REMARKS_#~Remarks','Employee Leave Rejected'),(13,'hr@netstratum.com','','leave_approve','Leave Approval Mail for Employee','<p>Dear&nbsp;#_FIRSTNAME_#,</p>\n\n<p>Your request for #_LEAVE_TYPE_# leave&nbsp; on&nbsp;#_LEAVE_DATE_# has been approved.</p>\n\n<p>Thanks,</p>\n\n<p>Netstratum HR.</p>\n\n<p>&nbsp;</p>\n','#_FIRSTNAME_#~Employee First Name|#_LEAVE_DATE_#~Leave Date|#_DAYS_#~Days|#_LEAVE_TYPE_#~Leave Type|#_EMPLOYEE_EMAIL_#~Employee Email|#_REMARKS_#~Remarks','Leave Approved'),(14,'admin@netstratum.com','','resource_assign','Resource Assigned','<p>The Resource item #_RESOURCE_NAME_# assigned to #_NAME_#</p>','#_NAME_#~Employee Name|#_RESOURCE_NAME_#~Resource Name','Resource Assigned'),(15,'','','resource assign_employee','','','',''),(16,'admin@netstratum.com','','resource_assign_return','Resource Returned','<p>The Resource item #_RESOURCE_NAME_# returned from #_NAME_#</p>','#_NAME_#~Employee Name|#_RESOURCE_NAME_#~Resource Name','Resource Returned'),(17,'admin@netstratum.com','','resource_added','New Resource Added','<p>The Resource item #_RESOURCE_NAME_# added.</p>','#_RESOURCE_NAME_#~Resource Name','New Resource Added'),(18,'admin@netstratum.com','','resource_removed',' Resource Removed','<p>The Resource item #_RESOURCE_NAME_# removed from system.</p>','#_RESOURCE_NAME_#~Resource Name','Resource Removed'),(19,'admin@netstratum.com','','reward_redeemed','Reward Redeemed','<p>#_EMP_NAME_# has redeemed #_TOTAL_POINTS_# on #_DATE_#.</p>','','Reward Redeemed');
/*!40000 ALTER TABLE `hrm_mail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_menu_item`
--

DROP TABLE IF EXISTS `hrm_menu_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_menu_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_type` enum('top','leave','profile') NOT NULL DEFAULT 'top',
  `menu_title` varchar(250) NOT NULL,
  `role_id` varchar(50) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `order_hint` int(11) NOT NULL,
  `url_extras` varchar(200) NOT NULL,
  `children` enum('Y','N') NOT NULL DEFAULT 'N',
  `mobile` enum('Y','N') NOT NULL DEFAULT 'Y',
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_menu_item`
--

LOCK TABLES `hrm_menu_item` WRITE;
/*!40000 ALTER TABLE `hrm_menu_item` DISABLE KEYS */;
INSERT INTO `hrm_menu_item` VALUES (1,'top','Admin','1,2',0,1,'#','Y','Y',1),(2,'top','Manage Users','1,2',1,1,'index.php?r=Manageuser/Manage','N','Y',1),(3,'top','Add Users','1,2',1,2,'index.php?r=Manageuser/View','N','N',1),(4,'top','Employee Leave','1,2',0,2,'#','Y','Y',1),(5,'top','Manage Employee Leave','1,2',4,1,'index.php?r=Leave/Userleave','Y','Y',1),(6,'top','Manage Profile','3,4,5,6,7',0,0,'index.php?r=Manageuser/View','Y','Y',1),(7,'top','Manage Leave','3,4,5,6,7',0,0,'#','Y','Y',1),(8,'profile','Profile','1,2',0,1,'#profile','N','Y',1),(9,'profile','Emergency Contact','1,2',0,2,'#econtact','N','Y',1),(10,'profile','Dependency','1,2',0,3,'#dependent','N','Y',1),(11,'profile','Job','1,2',0,4,'#job','N','Y',1),(12,'profile','Report To','1,2',0,5,'#report','N','Y',1),(13,'profile','Profile','3,4,5,6,7',0,1,'#profile','N','Y',1),(14,'profile','Emergency Contact','3,4,5,6,7',0,2,'#econtact','N','Y',1),(15,'profile','Dependency','3,4,5,6,7',0,3,'#dependent','N','Y',1),(16,'profile','Job','3,4,5,6,7',0,4,'#job','N','N',1),(17,'profile','Report To','3,4,5,6,7',0,5,'#report','N','Y',1),(18,'leave','My Leave Status','2,3,4,5,6,7',0,1,'#myleave','N','Y',1),(19,'leave','Apply Leave','2,3,4,5,6,7',0,2,'#reqleave','N','Y',1),(20,'leave','Subordinate Leave Status','3,4,5,6,7',0,3,'#lreport','N','Y',1),(22,'leave','Assign Leave','1,2',0,5,'#assignleave','N','Y',1),(23,'leave','Leave Types','1,2',0,6,'#leavetypes','N','Y',1),(24,'leave','Custom Leave','1,2',0,7,'#otherleave','N','Y',1),(25,'top','Leave Calendar','1,2',4,2,'index.php?r=Holiday/HolidayForm','N','N',1),(26,'top','Manage Leave','3,4,5,6,7',7,1,'index.php?r=Leave/Userleave','Y','Y',1),(27,'top','Leave Calendar','3,4,5,6,7',7,2,'index.php?r=Holiday/HolidayForm','N','Y',1),(28,'leave','Manage Holiday','1,2',0,8,'#holiday','N','Y',1),(29,'top','My Leave Balance','3,4,5,6,7',7,3,'index.php?r=Leave/Showmyleavebalance','N','Y',1),(30,'top','Manage Emails','1,2',0,3,'index.php?r=Manageuser/Mail','N','Y',1),(31,'top','Manage Leave Balance','1,2',4,3,'index.php?r=Leave/Showleavebalance','N','Y',1),(32,'leave','Employee Leave Status','1,2',0,3,'#lreport','N','Y',1),(33,'top','Email','1,2,3,4,5,6,7',0,7,'index.php?r=Roundcubemail/Officemail','N','Y',1),(34,'top','Manage Project','3,4,5,6,7',0,8,'#','Y','Y',1),(35,'top','Manage Timesheet','3,4,5,6,7',34,9,'index.php?r=Timesheet/Addtimesheet','N','Y',1),(36,'top','My Timesheet Report','3,4,5,6,7',34,11,'index.php?r=Timesheet/Showmyreport','N','Y',1),(37,'top','Timesheet Reports','3,4,5,6,7',34,10,'index.php?r=Timesheet/Superreport','N','Y',1),(38,'top','Manage Project','3,4,5,6,7',34,8,'index.php?r=Timesheet/Addproject','N','Y',1),(39,'top','Notifier','1,2',0,13,'index.php?r=Manageuser/Notifier','N','Y',1),(40,'top','Manage Documents','1,2',0,1,'index.php?r=Doc/DocList','N','N',1),(41,'top','View Documents','3,4,5,6,7',0,1,'index.php?r=Doc/DocList','N','N',1),(42,'top','Asset Management','1,4',0,10,'index.php?r=Resource/EmpResource','N','N',1);
/*!40000 ALTER TABLE `hrm_menu_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_module`
--

DROP TABLE IF EXISTS `hrm_module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_module`
--

LOCK TABLES `hrm_module` WRITE;
/*!40000 ALTER TABLE `hrm_module` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_notification`
--

DROP TABLE IF EXISTS `hrm_notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `added_date` datetime NOT NULL,
  `desknotice` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_notification`
--

LOCK TABLES `hrm_notification` WRITE;
/*!40000 ALTER TABLE `hrm_notification` DISABLE KEYS */;
INSERT INTO `hrm_notification` VALUES (5,0,'Planned Maintenance on 10th June 2015. You may experience trouble accessing HRM.','2015-06-08 05:43:33','N'),(6,0,'Netstratum HRM android app is now available on Google Play.','2015-07-20 12:01:00','N'),(7,3,'Test message from ADMIN','2016-04-27 03:05:35','N'),(8,3,'testing again','2016-04-27 03:06:40','N');
/*!40000 ALTER TABLE `hrm_notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_peer_recognition`
--

DROP TABLE IF EXISTS `hrm_peer_recognition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_peer_recognition` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `emp_number` int(11) unsigned NOT NULL,
  `peer_id` int(10) unsigned NOT NULL,
  `recognized_for` text NOT NULL,
  `message` text NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_peer_recognition`
--

LOCK TABLES `hrm_peer_recognition` WRITE;
/*!40000 ALTER TABLE `hrm_peer_recognition` DISABLE KEYS */;
INSERT INTO `hrm_peer_recognition` VALUES (6,70,71,'test peer title','test peer msg','2019-01-10 06:48:43'),(7,70,71,'Test message','Test Message','2019-01-10 06:54:53'),(8,70,71,'test peer title','test peer msg','2019-01-10 07:17:01');
/*!40000 ALTER TABLE `hrm_peer_recognition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_project_tasks`
--

DROP TABLE IF EXISTS `hrm_project_tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_project_tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `taskname` varchar(300) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `createdby` int(11) NOT NULL,
  `created_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

DROP TABLE IF EXISTS `hrm_projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(300) NOT NULL,
  `status` enum('progress','completed','initial') NOT NULL DEFAULT 'initial',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `createdby` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `hrm_report_to`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_report_to` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_number` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` enum('supervisor','subordinate') NOT NULL,
  `leave_approval` enum('Y','N') NOT NULL DEFAULT 'N',
  `order_no` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=177 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_report_to`
--

--
-- Table structure for table `hrm_resource_assign`
--

DROP TABLE IF EXISTS `hrm_resource_assign`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_resource_assign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_slno` varchar(20) NOT NULL,
  `emp_number` int(11) NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `resource_id` bigint(20) NOT NULL,
  `resource_type` enum('h','s','','') NOT NULL DEFAULT 'h',
  `assign_date` datetime NOT NULL,
  `return_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_resource_assign`
--

--
-- Table structure for table `hrm_reward_points`
--

DROP TABLE IF EXISTS `hrm_reward_points`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_reward_points` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `emp_number` int(10) unsigned NOT NULL,
  `supervisor_id` int(11) NOT NULL,
  `reward_points` smallint(6) NOT NULL,
  `recognized_for` text NOT NULL,
  `message` text NOT NULL,
  `updated_date` datetime NOT NULL,
  `redeem` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_reward_points`
--

LOCK TABLES `hrm_reward_points` WRITE;
/*!40000 ALTER TABLE `hrm_reward_points` DISABLE KEYS */;
INSERT INTO `hrm_reward_points` VALUES (17,69,70,250,'test title','test msg','2019-01-10 06:43:50','Y');
/*!40000 ALTER TABLE `hrm_reward_points` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_reward_taken`
--

DROP TABLE IF EXISTS `hrm_reward_taken`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_reward_taken` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `emp_number` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_reward_taken`
--

LOCK TABLES `hrm_reward_taken` WRITE;
/*!40000 ALTER TABLE `hrm_reward_taken` DISABLE KEYS */;
INSERT INTO `hrm_reward_taken` VALUES (2,69,250,'2019-01-10 07:09:29');
/*!40000 ALTER TABLE `hrm_reward_taken` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_roundcube_mail`
--

DROP TABLE IF EXISTS `hrm_roundcube_mail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_roundcube_mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_number` int(11) NOT NULL,
  `username` varchar(300) NOT NULL,
  `mail_password` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_roundcube_mail`
--

--
-- Table structure for table `hrm_screen`
--

DROP TABLE IF EXISTS `hrm_screen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_screen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `module_id` int(11) NOT NULL,
  `action_url` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_screen`
--

LOCK TABLES `hrm_screen` WRITE;
/*!40000 ALTER TABLE `hrm_screen` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_screen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_skills`
--

DROP TABLE IF EXISTS `hrm_skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `skill_name` varchar(200) NOT NULL,
  `active` enum('Y','N') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_skills`
--

LOCK TABLES `hrm_skills` WRITE;
/*!40000 ALTER TABLE `hrm_skills` DISABLE KEYS */;
INSERT INTO `hrm_skills` VALUES (1,'Erlang','Y');
/*!40000 ALTER TABLE `hrm_skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_software`
--

DROP TABLE IF EXISTS `hrm_software`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_software` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resource_name` varchar(50) NOT NULL,
  `make` varchar(50) NOT NULL,
  `serial_no` varchar(50) DEFAULT NULL,
  `model` varchar(50) NOT NULL,
  `remarks` text NOT NULL,
  `modification_date` datetime NOT NULL,
  `vendor_details` text NOT NULL,
  `warranty` date NOT NULL,
  `purchase_date` date NOT NULL,
  `delete` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_software`
--

LOCK TABLES `hrm_software` WRITE;
/*!40000 ALTER TABLE `hrm_software` DISABLE KEYS */;
INSERT INTO `hrm_software` VALUES (1,'Windows','Microsoft','921387402982','Vista','','2016-04-27 03:03:54','Shop name','2017-10-28','2016-04-28','0');
/*!40000 ALTER TABLE `hrm_software` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_task_hours`
--

DROP TABLE IF EXISTS `hrm_task_hours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_task_hours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_number` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `task_date` date NOT NULL,
  `task_hour` float(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=895 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_task_hours`
--


DROP TABLE IF EXISTS `hrm_user_education`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_user_education` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `education_name` varchar(200) NOT NULL,
  `active` enum('Y','N') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_user_education`
--

LOCK TABLES `hrm_user_education` WRITE;
/*!40000 ALTER TABLE `hrm_user_education` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_user_education` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_user_master`
--

DROP TABLE IF EXISTS `hrm_user_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_user_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role_id` int(11) NOT NULL,
  `emp_number` int(11) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_password` varchar(300) NOT NULL,
  `status` enum('Y','N') NOT NULL,
  `date_entered` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_user_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `mobile_number` varchar(30) NOT NULL,
  `emp_deleted` enum('Y','N') NOT NULL DEFAULT 'N',
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_user_master`
--

--
-- Table structure for table `hrm_user_role`
--

DROP TABLE IF EXISTS `hrm_user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `display_name` varchar(100) NOT NULL,
  `is_assignable` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_user_role`
--

LOCK TABLES `hrm_user_role` WRITE;
/*!40000 ALTER TABLE `hrm_user_role` DISABLE KEYS */;
INSERT INTO `hrm_user_role` VALUES (1,'user_admin','Administrator','1'),(2,'user_hr','HR Manager','1'),(3,'user_employee','Employee','1'),(4,'asset_manager','Asset Manager','1'),(5,'accountant','Accountant','1');
/*!40000 ALTER TABLE `hrm_user_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_user_skills`
--

DROP TABLE IF EXISTS `hrm_user_skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_user_skills` (
  `emp_number` int(7) NOT NULL DEFAULT '0',
  `skill_id` int(11) NOT NULL,
  `years_of_exp` decimal(2,0) DEFAULT NULL,
  `comments` text NOT NULL,
  KEY `emp_number` (`emp_number`),
  KEY `skill_id` (`skill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_user_skills`
--

LOCK TABLES `hrm_user_skills` WRITE;
/*!40000 ALTER TABLE `hrm_user_skills` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_user_skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_work_experience`
--

DROP TABLE IF EXISTS `hrm_work_experience`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_work_experience` (
  `emp_number` int(7) NOT NULL DEFAULT '0',
  `exp_seqno` decimal(10,0) NOT NULL DEFAULT '0',
  `exp_employer` varchar(100) DEFAULT NULL,
  `exp_jobtitle` varchar(120) DEFAULT NULL,
  `exp_from_date` datetime DEFAULT NULL,
  `exp_to_date` datetime DEFAULT NULL,
  `exp_comments` varchar(200) DEFAULT NULL,
  `exp_internal` int(1) DEFAULT NULL,
  PRIMARY KEY (`emp_number`,`exp_seqno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_work_experience`
--

LOCK TABLES `hrm_work_experience` WRITE;
/*!40000 ALTER TABLE `hrm_work_experience` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_work_experience` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `state_list`
--

DROP TABLE IF EXISTS `state_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `state_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `state` varchar(50) NOT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=88 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `state_list`
--

LOCK TABLES `state_list` WRITE;
/*!40000 ALTER TABLE `state_list` DISABLE KEYS */;
INSERT INTO `state_list` VALUES (1,'ANDAMAN AND NICOBAR ISLANDS',99),(2,'ANDHRA PRADESH',99),(3,'ARUNACHAL PRADESH',99),(4,'ASSAM',99),(5,'BIHAR',99),(6,'CHATTISGARH',99),(7,'CHANDIGARH',99),(8,'DAMAN AND DIU',99),(9,'DELHI',99),(10,'DADRA AND NAGAR HAVELI',99),(11,'GOA',99),(12,'GUJARAT',99),(13,'HIMACHAL PRADESH',99),(14,'HARYANA',99),(15,'JAMMU AND KASHMIR',99),(16,'JHARKHAND',99),(17,'KERALA',99),(18,'KARNATAKA',99),(19,'LAKSHADWEEP',99),(20,'MEGHALAYA',99),(21,'MAHARASHTRA',99),(22,'MANIPUR',99),(23,'MADHYA PRADESH',99),(24,'MIZORAM',99),(25,'NAGALAND',99),(26,'ORISSA',99),(27,'PUNJAB',99),(28,'PONDICHERRY',99),(29,'RAJASTHAN',99),(30,'SIKKIM',99),(31,'TELANGANA',99),(32,'TAMIL NADU',99),(33,'TRIPURA',99),(34,'UTTARAKHAND',99),(35,'UTTAR PRADESH',99),(36,'WEST BENGAL',99),(37,'Alaska',1),(38,'Alabama',1),(39,'Arkansas',1),(40,'Arizona',1),(41,'California',1),(42,'Colorado',1),(43,'Connecticut',1),(44,'District of Columbia',1),(45,'Delaware',1),(46,'Florida',1),(47,'Georgia',1),(48,'Hawaii',1),(49,'Iowa',1),(50,'Idaho',1),(51,'Illinois',1),(52,'Indiana',1),(53,'Kansas',1),(54,'Kentucky',1),(55,'Louisiana',1),(56,'Massachusetts',1),(57,'Maryland',1),(58,'Maine',1),(59,'Michigan',1),(60,'Minnesota',1),(61,'Missouri',1),(62,'Mississippi',1),(63,'Montana',1),(64,'North Carolina',1),(65,'North Dakota',1),(66,'Nebraska',1),(67,'New Hampshire',1),(68,'New Jersey',1),(69,'New Mexico',1),(70,'Nevada',1),(71,'New York',1),(72,'Ohio',1),(73,'Oklahoma',1),(74,'Oregon',1),(75,'Pennsylvania',1),(76,'Rhode Island',1),(77,'South Carolina',1),(78,'South Dakota',1),(79,'Tennessee',1),(80,'Texas',1),(81,'Utah',1),(82,'Virginia',1),(83,'Vermont',1),(84,'Washington',1),(85,'Wisconsin',1),(86,'West Virginia',1),(87,'Wyoming',1);
/*!40000 ALTER TABLE `state_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tree_data`
--

DROP TABLE IF EXISTS `tree_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tree_data` (
  `id` int(10) unsigned NOT NULL,
  `nm` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tree_data`
--

LOCK TABLES `tree_data` WRITE;
/*!40000 ALTER TABLE `tree_data` DISABLE KEYS */;
INSERT INTO `tree_data` VALUES (1,'Home'),(14,'2015'),(15,'payslip_taxsheet'),(16,'jun'),(18,'aug'),(19,'oct'),(20,'Chaitanya'),(21,'nov'),(22,'dec'),(23,'2016'),(24,'payslip_taxsheet'),(25,'jan'),(26,'feb'),(27,'mar'),(28,'apr'),(29,'may'),(30,'jun'),(31,'jul'),(32,'aug'),(33,'sep'),(34,'oct'),(35,'nov'),(36,'dec'),(37,'2017'),(38,'payslip_taxsheet'),(39,'jan'),(40,'feb'),(41,'mar'),(42,'apr'),(43,'may'),(44,'jun'),(45,'jul'),(46,'aug'),(47,'sep'),(48,'oct'),(49,'nov'),(50,'dec'),(51,'2018'),(52,'payslip_taxsheet'),(53,'jan'),(54,'2018'),(55,'payslip_taxsheet'),(56,'jan'),(57,'feb'),(58,'mar'),(61,'apr'),(64,'may'),(65,'jun'),(66,'jul'),(67,'aug'),(68,'sep'),(69,'oct'),(70,'nov'),(71,'dec');
/*!40000 ALTER TABLE `tree_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tree_struct`
--

DROP TABLE IF EXISTS `tree_struct`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tree_struct` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lft` int(10) unsigned NOT NULL,
  `rgt` int(10) unsigned NOT NULL,
  `lvl` int(10) unsigned NOT NULL,
  `pid` int(10) unsigned NOT NULL,
  `pos` int(10) unsigned NOT NULL,
  `employee_ids` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tree_struct`
--


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-01-22  7:04:09
