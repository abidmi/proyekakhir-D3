/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.7.9 : Database - r_central
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`r_central` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `r_central`;

/*Table structure for table `cgi2g_cj` */

DROP TABLE IF EXISTS `cgi2g_cj`;

CREATE TABLE `cgi2g_cj` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `BSC` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SITE_ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `CELL` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `cgi2g_cj` */

insert  into `cgi2g_cj`(`id`,`BSC`,`SITE_ID`,`CELL`) values (1,'BBRB1','2310\r\n','23101\r\n'),(2,'BBRB1','2320','23102'),(3,'DVSG675','1234','5678'),(4,'BBRB1','5678','1234'),(5,'BBRB2','4221','67552'),(6,'BBRB2','6742','7865');

/*Table structure for table `cgi3g_cj` */

DROP TABLE IF EXISTS `cgi3g_cj`;

CREATE TABLE `cgi3g_cj` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `RNC` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SITE_ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UTRANCELL` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `cgi3g_cj` */

insert  into `cgi3g_cj`(`id`,`RNC`,`SITE_ID`,`UTRANCELL`) values (1,'RNBRB01','3531208G\r\n','352SM3G130651\r\n');

/*Table structure for table `cluster_bicc_cj` */

DROP TABLE IF EXISTS `cluster_bicc_cj`;

CREATE TABLE `cluster_bicc_cj` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `POC_NAME` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `cluster_bicc_cj` */

insert  into `cluster_bicc_cj`(`id`,`POC_NAME`) values (1,'Kudus'),(2,'Semarang'),(3,'Kendal');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`migration`,`batch`) values ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2016_02_28_231005_create_remarks_table',1),('2016_02_28_231014_create_sites_table',1),('2016_02_28_231028_create_antenas_table',1),('2016_02_29_032402_create_c_g_i2_g__c_js_table',1),('2016_02_29_032418_create_c_g_i3_g__c_js_table',1),('2016_03_01_045646_create_c_l_u_s_t_e_r__b_i_c_c__c_js_table',2);

/*Table structure for table `optimcj_antenas` */

DROP TABLE IF EXISTS `optimcj_antenas`;

CREATE TABLE `optimcj_antenas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bscrnc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `siteid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cell` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mech` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `elec` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tot` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dir` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `height` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bw` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `optimcj_antenas` */

insert  into `optimcj_antenas`(`id`,`bscrnc`,`siteid`,`cell`,`mech`,`elec`,`tot`,`dir`,`height`,`bw`,`type`,`created_at`,`updated_at`) values (1,'BBRB1','2310','23101','35310','510-11-35310-10442','510.11.35310.10442','SM5','RNKBM01','C1-SMG2','ERICSSON','0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'BBRB2','2310','23102','35310','510-11-35310-10443','510.11.35310.10443','SM5','RNKBM01','C1-SMG2','ERICSSON','0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,'BBRB3','2310','23103','35310','510-11-35310-10451','510.11.35310.10451','SM5','RNKBM01','C1-SMG2','ERICSSON','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*Table structure for table `optimcj_remarks` */

DROP TABLE IF EXISTS `optimcj_remarks`;

CREATE TABLE `optimcj_remarks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bscrnc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cell` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `area` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kpi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_ex` date NOT NULL,
  `date_close` date NOT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `update_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `optimcj_remarks` */

insert  into `optimcj_remarks`(`id`,`bscrnc`,`cell`,`area`,`kpi`,`kategori`,`date_ex`,`date_close`,`remark`,`status`,`created_by`,`update_by`,`created_at`,`updated_at`) values (13,'DVSG675','23102','Kudus','Test KPI','CAPACITY','2016-06-01','0000-00-00','Test KPI','On Progress','Admin Web','','2016-05-31 14:39:11','2016-05-31 14:39:11'),(14,'RNBRB01','352SM3G130651','Semarang','Test KPI','CORE','2016-05-05','0000-00-00','','On Progress','Admin Web','','2016-05-31 14:41:28','2016-05-31 14:41:28'),(15,'BBRB2','67552','Kendal','Test KPI','COVERAGE','2016-06-28','0000-00-00','','On Progress','Admin Web','','2016-05-31 14:41:51','2016-05-31 14:41:51'),(16,'BBRB1','23102','Kudus','Test KPI','HARDWARE/INSTALLATION/ALARM','2016-05-31','0000-00-00','','On Progress','Admin Web','','2016-05-31 14:42:17','2016-05-31 14:42:17'),(17,'DVSG675','67552','Kudus','Test KPI','TRANSMISSION','2016-05-30','0000-00-00','','On Progress','Admin Web','','2016-05-31 14:42:40','2016-05-31 14:42:40'),(18,'RNBRB01','5678','Kudus','','CAPACITY','2016-05-03','1970-01-01','','On Progress','Admin Web','Admin Web','2016-05-31 14:43:08','2016-05-31 15:04:35'),(19,'BBRB2','5678','Kudus','','CAPACITY','2016-05-23','2016-05-03','','On Progress','Admin Web','','2016-05-31 14:43:08','2016-05-31 14:43:08'),(20,'RNBRB01','352SM3G130651','Semarang','Test KPI','CORE','2016-05-15','2016-05-25','','On Progress','Admin Web','','2016-05-31 14:41:28','2016-05-31 14:41:28'),(21,'RNBRB01','352SM3G130651','Semarang','Test KPI','CORE','2016-05-07','2016-05-31','','On Progress','Admin Web','','2016-05-31 14:41:28','2016-05-31 14:41:28'),(22,'RNBRB01','352SM3G130651','Semarang','Test KPI','CORE','2016-05-27','2016-05-31','','On Progress','Admin Web','','2016-05-31 14:41:28','2016-05-31 14:41:28'),(23,'RNBRB01','352SM3G130651','Semarang','Test KPI','CORE','2016-05-19','2016-05-25','','On Progress','Admin Web','','2016-05-31 14:41:28','2016-05-31 14:41:28'),(24,'RNBRB01','352SM3G130651','Semarang','Test KPI','CORE','2016-05-29','2016-05-25','','On Progress','Admin Web','','2016-05-31 14:41:28','2016-05-31 14:41:28'),(25,'DVSG675','1234','Kudus','','CAPACITY','2016-05-25','2016-05-03','','On Progress','Admin Web','Admin Web','2016-05-31 14:43:08','2016-05-31 15:04:05'),(26,'RNBRB01','352SM3G130651','Semarang','Test KPI','COVERAGE','2016-05-29','2016-05-25','','On Progress','Admin Web','','2016-05-31 14:41:28','2016-05-31 14:41:28'),(27,'RNBRB01','352SM3G130651','Semarang','Test KPI','COVERAGE','2016-05-27','2016-05-25','','On Progress','Admin Web','','2016-05-31 14:41:28','2016-05-31 14:41:28'),(28,'DVSG675','67552','Kudus','Test KPI','TRANSMISSION','2016-05-31','2016-05-21','','On Progress','Admin Web','','2016-05-31 14:42:40','2016-05-31 14:42:40');

/*Table structure for table `optimcj_sites` */

DROP TABLE IF EXISTS `optimcj_sites`;

CREATE TABLE `optimcj_sites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bscrnc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `siteid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sitename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `celltype` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mbc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `collsite` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `optimcj_sites` */

insert  into `optimcj_sites`(`id`,`bscrnc`,`siteid`,`sitename`,`longitude`,`latitude`,`celltype`,`mbc`,`collsite`,`created_at`,`updated_at`) values (1,'BBRB2','2310','2310_HUTBREBES','110.533','-7.3167777777778','Macro','20150520','20150520','0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'BBRB3','2310','2310_HUTBREBES','110.533','-7.3167777777778','Macro','20150520','20150520','0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,'BBRB4','2310','2310_HUTBREBES','110.36944444444','-7.2744166666667','Macro','20150520','20150520','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*Table structure for table `optimcj_users` */

DROP TABLE IF EXISTS `optimcj_users`;

CREATE TABLE `optimcj_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `optimcj_users_username_unique` (`username`),
  UNIQUE KEY `optimcj_users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `optimcj_users` */

insert  into `optimcj_users`(`id`,`name`,`username`,`email`,`password`,`role`,`remember_token`,`created_at`,`updated_at`) values (1,'Abid Muhamad Ismi','abidmi','abid@abid.com','$2y$10$bDKARUlU16klEwri6pNqrODYXNdxx0SfvcZmwQmXimKkSvCqZjEQC','user','AWxzGo5VusavuN1PpBAf348w1nuVYzCFJPaJ1gYNVZvSyTH5weHhCgNxXfui','2016-03-16 01:27:58','2016-05-29 05:32:38'),(2,'Admin Web','admin','admin@admin.com','$2y$10$xWvCbu0rahSNLjlrL/f7E.k9FQ2Aj/7KdXbvsve27Sr55qY3gKmAG','admin','NTncUnsm5hH0c6hsQwVlL84FGYFqdswBUS1MCBjkyJ05LCt3qYKA8sHIf35F','2016-03-16 01:30:15','2016-06-04 13:39:23'),(3,'Bekicot Ubur 2','bekicot2','bekicot2@gmail.com','$2y$10$2jhzHFu1Por.vG9CynlPGOnXRWJQg7inIDniRnQuvbZ4H.qvN2SGq','admin','GQRn18PpspaMdUK3kdSElSGSpzgxrBYRGd5smPgIysIFRXRMwH8RDJzWFGSN','2016-05-29 04:51:24','2016-05-29 05:28:48');

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `password_resets` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
