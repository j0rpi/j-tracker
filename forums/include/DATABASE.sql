/*
SQLyog Trial v12.3.1 (64 bit)
MySQL - 10.1.16-MariaDB : Database - jtracker
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`jtracker` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `jtracker`;

/*Table structure for table `comments` */

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` text CHARACTER SET latin1,
  `text` text CHARACTER SET latin1,
  `user` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `time` text CHARACTER SET latin1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `comments` */

insert  into `comments`(`id`,`text`,`user`,`time`) values 
('1','While we\'re at it. Here\'s an example comment! :) Please note that comments also can be removed just as easy as you can delete torrents from the database.','J-Tracker','[Test Comment]');

/*Table structure for table `friends` */

DROP TABLE IF EXISTS `friends`;

CREATE TABLE `friends` (
  `user` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blocked` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `friendid` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `friends` */

insert  into `friends`(`user`,`blocked`,`friendid`) values 
('Administrator','No','TestUser');

/*Table structure for table `pms` */

DROP TABLE IF EXISTS `pms`;

CREATE TABLE `pms` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reciever` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unread` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pms` */

/*Table structure for table `torrents` */

DROP TABLE IF EXISTS `torrents`;

CREATE TABLE `torrents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat` varchar(255) DEFAULT NULL,
  `uploader` varchar(255) DEFAULT NULL,
  `description` text,
  `link` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `date` tinytext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

/*Data for the table `torrents` */

insert  into `torrents`(`id`,`cat`,`uploader`,`description`,`link`,`title`,`date`) values 
(1,'None','J-Tracker','======================\r\n      j-tracker\r\n======================\r\n\r\nSeeing this torrent means that the \r\ninstallation was successfull. \r\n\r\nYou may delete this torrent manually\r\nby removing the row in the database.\r\n\r\n\r\nThis torrent let\'s you download latest\r\nUbuntu 14.10 64bit ISO. Just for a simple\r\nshowcase for how stuff is working! :)\r\n\r\nHappy sharing! :)','torrents/ubuntu-14.10-desktop-amd64.iso.torrent','J-Tracker Installed Successfully!','[Test Torrent]');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_avatar` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_level` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_pgp` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
