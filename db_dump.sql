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
  `is_other` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `actions` */

LOCK TABLES `actions` WRITE;

insert  into `actions`(`id`,`name`,`is_other`,`created_at`,`updated_at`) values 
(1,'Add','0','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(2,'Approve','0','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(3,'Call','0','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(4,'Change','0','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(5,'Close','0','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(6,'Create','0','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(7,'Decline','0','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(8,'Do','0','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(9,'Email','0','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(10,'Get','0','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(11,'Plan','0','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(12,'Request','0','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(13,'Research','0','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(14,'Review','0','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(15,'Schedule','0','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(16,'Send','0','2021-05-20 04:44:33','2021-05-20 04:44:33'),
(17,'Share','0','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(18,'Update','0','2021-05-20 04:44:34','2021-05-20 04:44:34');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `migrations` */

LOCK TABLES `migrations` WRITE;

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2021_05_12_224353_create_tasks_table',1),
(5,'2021_05_13_211814_create_settings_table',1),
(6,'2021_05_20_042003_create_actions_table',1),
(7,'2021_05_20_042017_create_steps_table',1),
(8,'2021_05_24_042757_create_suggest_settings_table',1),
(10,'2021_05_29_023353_create_outbound_main_table',2),
(11,'2021_05_29_023952_create_outbound_persons_table',2);

UNLOCK TABLES;

/*Table structure for table `outbound_main` */

DROP TABLE IF EXISTS `outbound_main`;

CREATE TABLE `outbound_main` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annual_report` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pr_articles` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `org_hooks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_nuggets` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `outbound_main` */

LOCK TABLES `outbound_main` WRITE;

UNLOCK TABLES;

/*Table structure for table `outbound_persons` */

DROP TABLE IF EXISTS `outbound_persons`;

CREATE TABLE `outbound_persons` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `o_id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calls` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `result` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `li_connected` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Not Sent',
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `li_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `outbound_persons` */

LOCK TABLES `outbound_persons` WRITE;

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
  `is_other` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

/*Data for the table `steps` */

LOCK TABLES `steps` WRITE;

insert  into `steps`(`id`,`name`,`is_other`,`created_at`,`updated_at`) values 
(1,'Account','0','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(2,'Agreement','0','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(3,'Business Case','0','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(4,'Calendar Invite','0','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(5,'Case Study','0','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(6,'Closed Won Emails','0','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(7,'Custom Video','0','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(8,'Demo','0','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(9,'Dollar Value (CRM)','0','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(10,'EBR','0','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(11,'Exec Intro','0','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(12,'Fee Presentation','0','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(13,'Forecast (CRM)','0','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(14,'Invoice','0','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(15,'ITS Docs','0','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(16,'Message','0','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(17,'MEDDPICC (CRM)','0','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(18,'Meeting','0','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(19,'MSA','0','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(20,'NDA','0','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(21,'Next Steps (CRM)','0','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(22,'Person / Attendees','0','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(23,'PoC','0','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(24,'PoV','0','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(25,'PR','0','2021-05-20 04:44:34','2021-05-20 04:44:34'),
(26,'Project','0','2021-05-20 04:44:35','2021-05-20 04:44:35'),
(27,'Red Flags (CRM)','0','2021-05-20 04:44:35','2021-05-20 04:44:35'),
(28,'Security Docs','0','2021-05-20 04:44:35','2021-05-20 04:44:35'),
(29,'Slides','0','2021-05-20 04:44:35','2021-05-20 04:44:35'),
(30,'SoE','0','2021-05-20 04:44:35','2021-05-20 04:44:35'),
(31,'Stage (CRM)','0','2021-05-20 04:44:35','2021-05-20 04:44:35'),
(32,'VE Report','0','2021-05-20 04:44:35','2021-05-20 04:44:35'),
(33,'Video','0','2021-05-20 04:44:35','2021-05-20 04:44:35'),
(34,'What\'s Changed (CRM)','0','2021-05-20 04:44:35','2021-05-20 04:44:35'),
(35,'White Paper','0','2021-05-20 04:44:35','2021-05-20 04:44:35');

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
