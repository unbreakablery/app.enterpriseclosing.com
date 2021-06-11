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
/*Table structure for table `opportunities_meddpicc` */

DROP TABLE IF EXISTS `opportunities_meddpicc`;

CREATE TABLE `opportunities_meddpicc` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `opp_id` int(11) NOT NULL,
  `metrics` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metrics_score` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `economic_buyer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `economic_buyer_score` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `decision_criteria` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `decision_criteria_score` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `decision_process` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `decision_process_score` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `paper_process` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paper_process_score` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `identified_pain` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identified_pain_score` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `champion_coach` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `champion_coach_score` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `competition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `competition_score` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `meddpicc_score` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
