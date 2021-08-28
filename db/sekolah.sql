/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 10.4.11-MariaDB : Database - sekolah
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sekolah` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `sekolah`;

/*Table structure for table `siswa` */

CREATE TABLE `siswa` (
  `nis` varchar(30) NOT NULL,
  `namasiswa` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`nis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `siswa` */

insert  into `siswa`(`nis`,`namasiswa`) values ('2021080100001','Eko'),('2021080100002','Sandy'),('2021080100003','Danang');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
