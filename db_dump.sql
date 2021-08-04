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
/*Table structure for table `opportunities_sales_stage` */

DROP TABLE IF EXISTS `opportunities_sales_stage`;

CREATE TABLE `opportunities_sales_stage` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `opp_id` int(11) NOT NULL,
  `ss_id` int(11) NOT NULL,
  `weak` tinyint(4) DEFAULT NULL,
  `normal` tinyint(4) DEFAULT NULL,
  `strong` tinyint(4) DEFAULT NULL,
  `progress` tinyint(4) DEFAULT NULL COMMENT '1: Not Started, 2: In Progress, 3: Completed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `opportunities_settings` */

DROP TABLE IF EXISTS `opportunities_settings`;

CREATE TABLE `opportunities_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `o_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '''input-fields'',''sales-stage''',
  `o_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `o_value1` tinyint(4) DEFAULT NULL COMMENT 'show/hide strength indicator for sales stage',
  `o_value2` tinyint(4) DEFAULT NULL COMMENT 'show/hide stage progress',
  `o_value3` tinyint(4) DEFAULT NULL COMMENT 'order for sales stage',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
