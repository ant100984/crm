/*
SQLyog Ultimate v11.5 (64 bit)
MySQL - 5.6.14 : Database - crm
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `appointments` */

DROP TABLE IF EXISTS `appointments`;

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `alert` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `appointments` */

insert  into `appointments`(`id`,`user_id`,`subject`,`message`,`start_date`,`end_date`,`location`,`alert`) values (1,1,'test s.','test message','2014-10-30 17:12:33','2014-10-31 18:12:38','',NULL),(2,1,'test s.','test message','2014-10-31 17:14:53','2014-11-01 17:15:01',NULL,NULL),(7,1,'test','test','2014-11-12 08:45:00','2014-11-12 10:45:00','casa','1h'),(8,2,'test','test','2014-11-12 11:00:00','2014-11-12 11:00:00','casa',''),(9,1,'test','test','2014-11-13 07:15:00','2014-11-13 07:15:00','casa','');

/*Table structure for table `appointments_remarks` */

DROP TABLE IF EXISTS `appointments_remarks`;

CREATE TABLE `appointments_remarks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appointment_id` int(11) DEFAULT NULL,
  `notes` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `appointments_remarks` */

insert  into `appointments_remarks`(`id`,`appointment_id`,`notes`) values (3,7,'testb'),(5,7,'testv'),(6,7,'Today we have been going through explaining how...Today we have been going through explaining how...Today we have been going through explaining how...Today we have been going through explaining how...');

/*Table structure for table `attachments` */

DROP TABLE IF EXISTS `attachments`;

CREATE TABLE `attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attachment_name` varchar(255) DEFAULT NULL,
  `attachment_path` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `attachments` */

insert  into `attachments`(`id`,`attachment_name`,`attachment_path`,`user_id`) values (6,'ComplianceAssist_Integration_Guide_V1.5_.pdf','attachments/ComplianceAssist_Integration_Guide_V1.5_.pdf',1),(7,'bg.jpg','attachments/bg.jpg',2);

/*Table structure for table `duration_type` */

DROP TABLE IF EXISTS `duration_type`;

CREATE TABLE `duration_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(3) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `duration_type` */

insert  into `duration_type`(`id`,`code`,`description`) values (1,'M','Month'),(2,'D','Day'),(3,'Y','Year');

/*Table structure for table `groups` */

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `groups` */

insert  into `groups`(`id`,`group_name`) values (8,'Group A'),(9,'Group B'),(11,'Group C');

/*Table structure for table `messages` */

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `messagetext` text,
  `sender` int(11) DEFAULT NULL,
  `receiver` int(11) DEFAULT NULL,
  `datesent` datetime DEFAULT NULL,
  `dateread` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `messages` */

insert  into `messages`(`id`,`messagetext`,`sender`,`receiver`,`datesent`,`dateread`) values (1,'asdasdasd',2,1,'2014-10-22 17:19:04','2014-11-13 04:54:24'),(2,'test',1,2,'2014-11-11 02:03:38',NULL),(3,'Welcome',1,3,'2014-11-12 15:40:44',NULL),(4,'',1,3,'2014-11-12 15:41:27',NULL),(5,'Hello',1,3,'2014-11-12 15:44:35',NULL),(6,'Are you there?',1,3,'2014-11-12 15:47:26',NULL),(7,'asdasd',1,3,'2014-11-12 15:47:42',NULL),(8,'i am waiting for your feedback',1,2,'2014-11-12 22:48:32',NULL),(9,'asdasd',1,2,'2014-11-12 22:52:06',NULL),(10,'asdasf d sdsdgsg fddfhdfhdfhh asdasf d sdsdgsg fddfhdfhdfhh asdasf d sdsdgsg fddfhdfhdfhh asdasf d sdsdgsg fddfhdfhdfhh asdasf d sdsdgsg fddfhdfhdfhh asdasf d sdsdgsg fddfhdfhdfhh ',2,1,'2014-11-12 15:56:55','2014-11-13 04:54:24'),(11,'giesucri',1,2,'2014-11-12 22:57:57',NULL),(12,'Are you there?',1,3,'2014-11-12 23:04:57',NULL),(13,'how are you',1,3,'2014-11-12 23:05:08',NULL),(14,'ddd',1,3,'2014-11-12 23:05:13',NULL),(15,'asdasdasda',1,3,'2014-11-12 23:05:20',NULL),(16,'asdasdasda',1,3,'2014-11-12 23:40:41',NULL),(17,'asddasd',1,2,'2014-11-12 23:41:18',NULL),(18,'asdasd',1,2,'2014-11-12 23:41:22',NULL),(19,'asdasdas',1,2,'2014-11-12 23:41:25',NULL);

/*Table structure for table `newsletter_customer` */

DROP TABLE IF EXISTS `newsletter_customer`;

CREATE TABLE `newsletter_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newsletter` int(11) DEFAULT NULL,
  `customer` int(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `dtmsent` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `newsletter_customer` */

/*Table structure for table `newsletter_templates` */

DROP TABLE IF EXISTS `newsletter_templates`;

CREATE TABLE `newsletter_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `body` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `newsletter_templates` */

insert  into `newsletter_templates`(`id`,`title`,`body`) values (1,'Special Offer','231123123123');

/*Table structure for table `newsletters` */

DROP TABLE IF EXISTS `newsletters`;

CREATE TABLE `newsletters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_id` int(11) DEFAULT NULL,
  `body` text,
  `dtmsent` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `newsletters` */

/*Table structure for table `policies` */

DROP TABLE IF EXISTS `policies`;

CREATE TABLE `policies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `reminder` varchar(3) DEFAULT NULL,
  `status` varchar(3) DEFAULT NULL,
  `notes` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `policies` */

insert  into `policies`(`id`,`user_id`,`description`,`date`,`reminder`,`status`,`notes`) values (2,1,'Ppp','2014-11-01','MTY','PD','zzzzzzzz');

/*Table structure for table `policies_reminder` */

DROP TABLE IF EXISTS `policies_reminder`;

CREATE TABLE `policies_reminder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(3) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `duration_entity` int(11) DEFAULT NULL,
  `duration_type` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `policies_reminder` */

insert  into `policies_reminder`(`id`,`code`,`description`,`duration_entity`,`duration_type`) values (1,'MTY','Monthly',1,'M'),(2,'QTY','Quarterly',3,'M');

/*Table structure for table `policies_status` */

DROP TABLE IF EXISTS `policies_status`;

CREATE TABLE `policies_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(3) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `policies_status` */

insert  into `policies_status`(`id`,`code`,`description`) values (1,'PD','Paid'),(2,'UPD','Unpaid');

/*Table structure for table `tmp_newsletter_attachments` */

DROP TABLE IF EXISTS `tmp_newsletter_attachments`;

CREATE TABLE `tmp_newsletter_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newsletter_id` int(11) DEFAULT NULL,
  `filepath` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tmp_newsletter_attachments` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `dateofbirth` date DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `smoker` varchar(1) DEFAULT 'N',
  `homeaddress` varchar(255) DEFAULT NULL,
  `businessaddress` varchar(255) DEFAULT NULL,
  `nric` varchar(255) DEFAULT NULL,
  `notes` text,
  `group` int(11) DEFAULT NULL,
  `profilephoto` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `enabled` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`type`,`firstname`,`lastname`,`dateofbirth`,`gender`,`occupation`,`smoker`,`homeaddress`,`businessaddress`,`nric`,`notes`,`group`,`profilephoto`,`phone`,`email`,`username`,`password`,`lastlogin`,`enabled`) values (1,'crmuser','System','',NULL,'','','N','','','','',NULL,'attachments/avatar.png',NULL,NULL,'admin',NULL,NULL,1),(2,'customer','pippo','pippo','1979-06-04','M','Developer','Y','bbbbb','bbbbb','12345','aaa',9,'attachments/avatar2.png',NULL,'aaaaa',NULL,NULL,NULL,1),(3,'customer','Antonio','Esposito','1979-06-04','M','Developer','N','I Trv. Giulio Cesare 11','Via Roma 236','123','asdasd',8,'attachments/avatar.png',NULL,'esp.antonio@gmail.com','aesposito','','2014-11-03 12:40:09',1),(4,'customer','Antonio','Esposito','1979-06-04','M','Developer','N','I Trv. Giulio Cesare 11','Via Roma 236','123','asdasd',8,'attachments/avatar.png',NULL,'esp.antonio@gmail.com','aesposito','','2014-11-03 12:40:09',1),(5,'customer','Antonio','Esposito','1979-06-04','M','Developer','N','I Trv. Giulio Cesare 11','Via Roma 236','123','asdasd',8,'attachments/avatar.png',NULL,'esp.antonio@gmail.com','aesposito','','2014-11-03 12:40:09',1),(6,'customer','Antonio','Esposito','1979-06-04','M','Developer','N','I Trv. Giulio Cesare 11','Via Roma 236','123','asdasd',8,'attachments/avatar.png',NULL,'esp.antonio@gmail.com','aesposito','','2014-11-03 12:40:09',1),(7,'customer','Antonio','Esposito','1979-06-04','M','Developer','N','I Trv. Giulio Cesare 11','Via Roma 236','123','asdasd',8,'attachments/avatar.png',NULL,'esp.antonio@gmail.com','aesposito','','2014-11-03 12:40:09',1),(8,'customer','Antonio','Esposito','1979-06-04','M','Developer','N','I Trv. Giulio Cesare 11','Via Roma 236','123','asdasd',8,'attachments/avatar.png',NULL,'esp.antonio@gmail.com','aesposito','','2014-11-03 12:40:09',1),(9,'customer','Antonio','Esposito','1979-06-04','M','Developer','N','I Trv. Giulio Cesare 11','Via Roma 236','123','asdasd',8,'attachments/avatar.png',NULL,'esp.antonio@gmail.com','aesposito','','2014-11-03 12:40:09',1),(10,'customer','Antonio','Esposito','1979-06-04','M','Developer','N','I Trv. Giulio Cesare 11','Via Roma 236','123','asdasd',8,'attachments/avatar.png',NULL,'esp.antonio@gmail.com','aesposito','','2014-11-03 12:40:09',1),(11,'customer','Antonio','Esposito','1979-06-04','M','Developer','N','I Trv. Giulio Cesare 11','Via Roma 236','123','asdasd',8,'attachments/avatar.png',NULL,'esp.antonio@gmail.com','aesposito','','2014-11-03 12:40:09',1),(12,'customer','Antonio','Esposito','1979-06-04','M','Developer','N','I Trv. Giulio Cesare 11','Via Roma 236','123','asdasd',8,'attachments/avatar.png',NULL,'esp.antonio@gmail.com','aesposito','','2014-11-03 12:40:09',1),(13,'customer','Antonio','Esposito','1979-06-04','M','Developer','N','I Trv. Giulio Cesare 11','Via Roma 236','123','asdasd',8,'attachments/avatar.png',NULL,'esp.antonio@gmail.com','aesposito','','2014-11-03 12:40:09',1),(14,'customer','Antonio','Esposito','1979-06-04','M','Developer','N','I Trv. Giulio Cesare 11','Via Roma 236','123','asdasd',8,'attachments/avatar.png',NULL,'esp.antonio@gmail.com','aesposito','','2014-11-03 12:40:09',1),(15,'customer','Antonio','Esposito','1979-06-04','M','Developer','N','I Trv. Giulio Cesare 11','Via Roma 236','123','asdasd',8,'attachments/avatar.png',NULL,'esp.antonio@gmail.com','aesposito','','2014-11-03 12:40:09',1),(16,'customer','Antonio','Esposito','1979-06-04','M','Developer','N','I Trv. Giulio Cesare 11','Via Roma 236','123','asdasd',8,'attachments/avatar.png',NULL,'esp.antonio@gmail.com','aesposito','','2014-11-03 12:40:09',1),(17,'customer','Antonio','Esposito','1979-06-04','M','Developer','N','I Trv. Giulio Cesare 11','Via Roma 236','123','asdasd',8,'attachments/avatar.png',NULL,'esp.antonio@gmail.com','aesposito','','2014-11-03 12:40:09',1),(18,'customer','Antonio','Esposito','1979-06-04','M','Developer','N','I Trv. Giulio Cesare 11','Via Roma 236','123','asdasd',8,'attachments/avatar.png',NULL,'esp.antonio@gmail.com','aesposito','','2014-11-03 12:40:09',1),(19,'customer','Antonio','Esposito','1979-06-04','M','Developer','N','I Trv. Giulio Cesare 11','Via Roma 236','123','asdasd',8,'attachments/avatar.png',NULL,'esp.antonio@gmail.com','aesposito','','2014-11-03 12:40:09',1),(20,'customer','Antonio','Esposito','1979-06-04','M','Developer','N','I Trv. Giulio Cesare 11','Via Roma 236','123','asdasd',8,'attachments/avatar.png',NULL,'esp.antonio@gmail.com','aesposito','','2014-11-03 12:40:09',1),(21,'customer','Antonio','Esposito','1979-06-04','M','Developer','N','I Trv. Giulio Cesare 11','Via Roma 236','123','asdasd',8,'attachments/avatar.png',NULL,'esp.antonio@gmail.com','aesposito','','2014-11-03 12:40:09',1),(22,'customer','Antonio','Esposito','1979-06-04','M','Developer','N','I Trv. Giulio Cesare 11','Via Roma 236','123','asdasd',8,'attachments/avatar.png',NULL,'esp.antonio@gmail.com','aesposito','','2014-11-03 12:40:09',1),(23,'customer','Antonio','Esposito','1979-06-04','M','Developer','N','I Trv. Giulio Cesare 11','Via Roma 236','123','asdasd',8,'attachments/avatar.png',NULL,'esp.antonio@gmail.com','aesposito','','2014-11-03 12:40:09',1),(24,'customer','Antonio','Esposito','1979-06-04','M','Developer','N','I Trv. Giulio Cesare 11','Via Roma 236','123','asdasd',8,'attachments/avatar.png',NULL,'esp.antonio@gmail.com','aesposito','','2014-11-03 12:40:09',1),(25,'customer','Antonio','Esposito','1979-06-04','M','Developer','N','I Trv. Giulio Cesare 11','Via Roma 236','123','asdasd',8,'attachments/avatar.png',NULL,'esp.antonio@gmail.com','aesposito','','2014-11-03 12:40:09',1),(26,'customer','Antonio','Esposito','1979-06-04','M','Developer','N','I Trv. Giulio Cesare 11','Via Roma 236','123','asdasd',8,'attachments/avatar.png',NULL,'esp.antonio@gmail.com','aesposito','','2014-11-03 12:40:09',1),(27,'customer','Antonio','Esposito','1979-06-04','M','Developer','N','I Trv. Giulio Cesare 11','Via Roma 236','123','asdasd',8,'attachments/avatar.png',NULL,'esp.antonio@gmail.com','aesposito','','2014-11-03 12:40:09',1),(28,'customer','Antonio','Esposito','1979-06-04','M','Developer','N','I Trv. Giulio Cesare 11','Via Roma 236','123','asdasd',8,'attachments/avatar.png',NULL,'esp.antonio@gmail.com','aesposito','','2014-11-03 12:40:09',1),(29,'customer','Antonio','Esposito','1979-06-04','M','Developer','N','I Trv. Giulio Cesare 11','Via Roma 236','123','asdasd',8,'attachments/avatar.png',NULL,'esp.antonio@gmail.com','aesposito','','2014-11-03 12:40:09',1),(30,'customer','Antonio','Esposito','1979-06-04','M','Developer','N','I Trv. Giulio Cesare 11','Via Roma 236','123','asdasd',8,'attachments/avatar.png',NULL,'esp.antonio@gmail.com','aesposito','','2014-11-03 12:40:09',1),(31,'customer','Antonio','Esposito','1979-06-04','M','Developer','N','I Trv. Giulio Cesare 11','Via Roma 236','123','asdasd',8,'attachments/avatar.png',NULL,'esp.antonio@gmail.com','aesposito','','2014-11-03 12:40:09',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
