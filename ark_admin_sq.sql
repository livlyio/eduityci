/*
SQLyog Enterprise - MySQL GUI v7.15 
MySQL - 5.5.32 : Database - ark_admin_db
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


USE `eduity_data`;

/*Table structure for table `ci_sessions` */

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_unicode_ci,
  `data` text COLLATE utf8_unicode_ci,
  `alias` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ci_sessions` */

insert  into `ci_sessions`(`session_id`,`ip_address`,`user_agent`,`last_activity`,`user_data`) values ('26944504bce20812c42ec1d1605e6b63','127.0.0.1','Mozilla/5.0 (Windows NT 5.1; rv:25.0) Gecko/20100101 Firefox/25.0',1384099851,'a:6:{s:9:\"user_data\";s:0:\"\";s:2:\"id\";s:1:\"1\";s:8:\"username\";s:8:\"abhishek\";s:5:\"email\";s:22:\"abhishek@devzone.co.in\";s:14:\"is_admin_login\";b:1;s:9:\"user_type\";s:2:\"SA\";}');

/*Table structure for table `tbl_admin_users` */

DROP TABLE IF EXISTS `tbl_admin_users`;

CREATE TABLE `tbl_admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `block` tinyint(4) NOT NULL DEFAULT '0',
  `user_type` enum('SA','A') DEFAULT 'SA' COMMENT 'SA: Super Admin,A: Admin',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_admin_users` */

insert  into `tbl_admin_users`(`id`,`username`,`email`,`password`,`block`,`user_type`) values (1,'demo','abhishek@devzone.co.in','7e466fc01a0c7932e96a4a925b11b06a',0,'SA');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(60) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `signup_date` datetime DEFAULT NULL,
  `phone_mobile` varchar(50) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `address_street` varchar(150) DEFAULT NULL,
  `address_city` varchar(100) DEFAULT NULL,
  `address_state` varchar(100) DEFAULT NULL,
  `address_country` varchar(100) DEFAULT NULL,
  `address_postalcode` varchar(20) DEFAULT NULL,
  `deleted` enum('Y','N') DEFAULT 'N',
  `user_status` enum('A','B') DEFAULT 'A' COMMENT 'A: Active; B: Blocked',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=649 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
