/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.4.17-MariaDB : Database - enterpriseclosing
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `actions` */

DROP TABLE IF EXISTS `actions`;

CREATE TABLE `actions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `actions` */

LOCK TABLES `actions` WRITE;

insert  into `actions`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'Add','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(2,'Approve','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(3,'Call','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(4,'Change','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(5,'Close','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(6,'Create','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(7,'Decline','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(8,'Do','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(9,'Email','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(10,'Get','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(11,'Plan','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(12,'Request','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(13,'Research','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(14,'Review','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(15,'Schedule','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(16,'Send','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(17,'Share','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(18,'Update','2021-05-20 04:44:34','2021-05-20 04:44:34');

UNLOCK TABLES;

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `failed_jobs` */

LOCK TABLES `failed_jobs` WRITE;

UNLOCK TABLES;

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `migrations` */

LOCK TABLES `migrations` WRITE;

UNLOCK TABLES;

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `password_resets` */

LOCK TABLES `password_resets` WRITE;

UNLOCK TABLES;

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `section_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `settings` */

LOCK TABLES `settings` WRITE;

UNLOCK TABLES;

/*Table structure for table `steps` */

DROP TABLE IF EXISTS `steps`;

CREATE TABLE `steps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

/*Data for the table `steps` */

LOCK TABLES `steps` WRITE;

insert  into `steps`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'Account','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(2,'Agreement','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(3,'Business Case','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(4,'Calendar Invite','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(5,'Case Study','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(6,'Closed Won Emails','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(7,'Custom Video','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(8,'Demo','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(9,'Dollar Value (CRM)','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(10,'EBR','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(11,'Exec Intro','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(12,'Fee Presentation','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(13,'Forecast (CRM)','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(14,'Invoice','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(15,'ITS Docs','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(16,'Message','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(17,'MEDDPICC (CRM)','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(18,'Meeting','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(19,'MSA','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(20,'NDA','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(21,'Next Steps (CRM)','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(22,'Person / Attendees','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(23,'PoC','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(24,'PoV','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(25,'PR','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(26,'Project','2021-05-20 04:44:35','2021-05-20 04:44:35'),
(27,'Red Flags (CRM)','2021-05-20 04:44:35','2021-05-20 04:44:35'),
(28,'Security Docs','2021-05-20 04:44:35','2021-05-20 04:44:35'),
(29,'Slides','2021-05-20 04:44:35','2021-05-20 04:44:35'),
(30,'SoE','2021-05-20 04:44:35','2021-05-20 04:44:35'),
(31,'Stage (CRM)','2021-05-20 04:44:35','2021-05-20 04:44:35'),
(32,'VE Report','2021-05-20 04:44:35','2021-05-20 04:44:35'),
(33,'Video','2021-05-20 04:44:35','2021-05-20 04:44:35'),
(34,'What\'s Changed (CRM)','2021-05-20 04:44:35','2021-05-20 04:44:35'),
(35,'White Paper','2021-05-20 04:44:35','2021-05-20 04:44:35');

UNLOCK TABLES;

/*Table structure for table `suggest_settings` */

DROP TABLE IF EXISTS `suggest_settings`;

CREATE TABLE `suggest_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `step_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suggest_step_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `suggest_settings` */

LOCK TABLES `suggest_settings` WRITE;

UNLOCK TABLES;

/*Table structure for table `tasks` */

DROP TABLE IF EXISTS `tasks`;

CREATE TABLE `tasks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `action` int(11) NOT NULL,
  `step` int(11) NOT NULL,
  `person_account` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opportunity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` enum('1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '3',
  `by_date` date DEFAULT NULL,
  `completed_at` date DEFAULT NULL,
  `status` enum('0','1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tasks` */

LOCK TABLES `tasks` WRITE;

UNLOCK TABLES;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('0','1','2') NOT NULL DEFAULT '2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `users` */

LOCK TABLES `users` WRITE;

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
