-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.35-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for be_emp_admin
CREATE DATABASE IF NOT EXISTS `be_emp_admin` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `be_emp_admin`;

-- Dumping structure for table be_emp_admin.be_emp_aduser
CREATE TABLE IF NOT EXISTS `be_emp_aduser` (
  `ea_id` int(30) NOT NULL AUTO_INCREMENT,
  `ea_emp_id` varchar(50) NOT NULL,
  `ea_name` varchar(100) NOT NULL,
  `ea_password` varchar(255) NOT NULL,
  `ea_email` varchar(50) NOT NULL,
  `ea_designation` varchar(100) DEFAULT NULL,
  `ea_role` enum('1','2') NOT NULL DEFAULT '2' COMMENT '1 - super admin, 2 - admin',
  `ea_added_on` datetime NOT NULL,
  `ea_last_updated` datetime NOT NULL,
  `ea_pass_reset` datetime NOT NULL,
  `ea_deac_on` datetime NOT NULL,
  `ea_user_st` enum('1','0') NOT NULL DEFAULT '1' COMMENT '1-active,0-inactive',
  PRIMARY KEY (`ea_id`),
  UNIQUE KEY `ea_id` (`ea_id`),
  UNIQUE KEY `ea_emp_id` (`ea_emp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table be_emp_admin.be_emp_db
CREATE TABLE IF NOT EXISTS `be_emp_db` (
  `ed_id` int(30) NOT NULL AUTO_INCREMENT,
  `ed_emp_id` varchar(50) NOT NULL,
  `ed_emp_name` varchar(250) NOT NULL,
  `ed_emp_pass` varchar(250) NOT NULL,
  `ed_emp_email` varchar(100) NOT NULL,
  `ed_emp_desig` varchar(100) DEFAULT NULL,
  `ed_emp_div` varchar(50) DEFAULT NULL,
  `ed_emp_team` varchar(100) DEFAULT NULL,
  `ed_emp_leader` varchar(250) DEFAULT NULL,
  `ed_emp_dob` date DEFAULT NULL,
  `ed_emp_doj` date DEFAULT NULL,
  `ed_emp_add_on` datetime NOT NULL,
  `ed_emp_add_by` int(30) NOT NULL,
  `ed_emp_lup_on` datetime DEFAULT NULL,
  `ed_emp_lup_by` int(30) DEFAULT NULL,
  `ed_emp_pas_rt_on` datetime DEFAULT NULL,
  `ed_emp_pas_tr_by` int(30) DEFAULT NULL,
  `ed_emp_st` enum('0','1') NOT NULL DEFAULT '1',
  `ed_emp_deac_on` datetime NOT NULL,
  `ed_emp_deac_by` int(30) NOT NULL,
  PRIMARY KEY (`ed_id`),
  UNIQUE KEY `ed_id` (`ed_id`),
  UNIQUE KEY `ed_emp_id` (`ed_emp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
