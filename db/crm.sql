/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.13 : Database - crm
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`crm` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `crm`;

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
  `alerted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `appointments` */

/*Table structure for table `appointments_remarks` */

DROP TABLE IF EXISTS `appointments_remarks`;

CREATE TABLE `appointments_remarks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appointment_id` int(11) DEFAULT NULL,
  `notes` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `appointments_remarks` */

/*Table structure for table `attachments` */

DROP TABLE IF EXISTS `attachments`;

CREATE TABLE `attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attachment_name` varchar(255) DEFAULT NULL,
  `attachment_path` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `attachments` */

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `groups` */

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `messages` */

/*Table structure for table `newsletter_attachments` */

DROP TABLE IF EXISTS `newsletter_attachments`;

CREATE TABLE `newsletter_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newsletter_id` int(11) DEFAULT NULL,
  `filepath` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `newsletter_attachments` */

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `newsletter_templates` */

/*Table structure for table `newsletters` */

DROP TABLE IF EXISTS `newsletters`;

CREATE TABLE `newsletters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_id` int(11) DEFAULT NULL,
  `body` text,
  `status` varchar(10) DEFAULT NULL,
  `dtmcreated` datetime DEFAULT NULL,
  `usercreated` int(11) DEFAULT NULL,
  `dtmsent` datetime DEFAULT NULL,
  `usersent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `newsletters` */

/*Table structure for table `permission_type` */

DROP TABLE IF EXISTS `permission_type`;

CREATE TABLE `permission_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_code` varchar(255) DEFAULT NULL,
  `permission_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `permission_type` */

insert  into `permission_type`(`id`,`permission_code`,`permission_name`) values (1,'manage_newsletters','Manage Newsletters'),(2,'manage_customers','Manage Customers'),(3,'manage_crmusers','Manage CRM Users'),(4,'manage_appointments','Manage Appointments'),(5,'manage_messages','Manage Messages');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `policies` */

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

insert  into `policies_reminder`(`id`,`code`,`description`,`duration_entity`,`duration_type`) values (1,'MTY','Monthly',1,'M'),(2,'QTY','Quarterly',4,'M');

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

/*Table structure for table `user_permissions` */

DROP TABLE IF EXISTS `user_permissions`;

CREATE TABLE `user_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) DEFAULT NULL,
  `permission` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `user_permissions` */

insert  into `user_permissions`(`id`,`user`,`permission`) values (7,1,'manage_newsletters'),(8,1,'manage_customers'),(9,1,'manage_messages'),(10,1,'manage_crmusers'),(11,1,'manage_appointments');

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
  `isAdmin` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`type`,`firstname`,`lastname`,`dateofbirth`,`gender`,`occupation`,`smoker`,`homeaddress`,`businessaddress`,`nric`,`notes`,`group`,`profilephoto`,`phone`,`email`,`username`,`password`,`lastlogin`,`enabled`,`isAdmin`) values (1,'crmuser','Admin','System',NULL,'','','N','','','','',NULL,'attachments/avatar.png',NULL,NULL,'admin','21232f297a57a5a743894a0e4a801fc3',NULL,1,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
