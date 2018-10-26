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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table be_emp_admin.be_emp_db
CREATE TABLE IF NOT EXISTS `be_emp_db` (
  `ed_id` int(30) NOT NULL AUTO_INCREMENT,
  `ed_emp_id` varchar(50) NOT NULL,
  `ed_emp_name` varchar(250) NOT NULL,
  `ed_emp_pass` varchar(250) NOT NULL,
  `ed_emp_email` varchar(100) NOT NULL,
  `ed_emp_desig` varchar(100) DEFAULT NULL,
  `ed_emp_grade` varchar(100) DEFAULT NULL,
  `ed_emp_div` varchar(50) DEFAULT NULL,
  `ed_emp_team` varchar(100) DEFAULT NULL,
  `ed_emp_section` varchar(100) DEFAULT NULL,
  `ed_emp_leader` varchar(250) DEFAULT NULL,
  `ed_emp_type` enum('student','teacher','none') NOT NULL DEFAULT 'none',
  `ed_emp_dob` date DEFAULT NULL,
  `ed_emp_doj` date DEFAULT NULL,
  `ed_emp_add_on` datetime NOT NULL,
  `ed_emp_add_by` int(30) NOT NULL,
  `ed_emp_lup_on` datetime DEFAULT NULL,
  `ed_emp_lup_by` int(30) DEFAULT NULL,
  `ed_emp_pas_rt_on` datetime DEFAULT NULL,
  `ed_emp_pas_tr_by` int(30) DEFAULT NULL,
  `ed_emp_st` enum('0','1') NOT NULL DEFAULT '1',
  `ed_emp_add_from` enum('single','bulk') NOT NULL DEFAULT 'single',
  `ed_emp_deac_on` datetime NOT NULL,
  `ed_emp_deac_by` int(30) NOT NULL,
  PRIMARY KEY (`ed_id`),
  UNIQUE KEY `ed_id` (`ed_id`),
  UNIQUE KEY `ed_emp_id` (`ed_emp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table be_emp_admin.be_emp_qstn_templ
CREATE TABLE IF NOT EXISTS `be_emp_qstn_templ` (
  `qt_id` int(11) NOT NULL AUTO_INCREMENT,
  `qt_name` varchar(250) DEFAULT NULL,
  `qt_templ_to` enum('student','teacher') DEFAULT NULL,
  `qt_desc` text,
  `qt_add_on` datetime DEFAULT NULL,
  `qt_add_by` int(11) DEFAULT NULL,
  `qt_updt_on` datetime DEFAULT NULL,
  `qt_updt_by` int(11) DEFAULT NULL,
  `qt_status` enum('0','1') DEFAULT '1',
  PRIMARY KEY (`qt_id`),
  UNIQUE KEY `qt_id` (`qt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table be_emp_admin.be_emp_questions
CREATE TABLE IF NOT EXISTS `be_emp_questions` (
  `eq_id` int(30) NOT NULL AUTO_INCREMENT,
  `eq_question` text,
  `eq_templ_id` int(50) DEFAULT NULL,
  `eq_answer_type` enum('text','radio','check') DEFAULT NULL,
  `eq_added_by` int(11) DEFAULT NULL,
  `eq_add_on` datetime DEFAULT NULL,
  `eq_update_by` int(11) DEFAULT NULL,
  `eq_update_on` datetime DEFAULT NULL,
  `eq_del_by` int(11) DEFAULT NULL,
  `eq_del_on` datetime DEFAULT NULL,
  `eq_status` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`eq_id`),
  UNIQUE KEY `eq_id` (`eq_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table be_emp_admin.be_emp_questn_option
CREATE TABLE IF NOT EXISTS `be_emp_questn_option` (
  `eqo_id` int(11) NOT NULL AUTO_INCREMENT,
  `eqo_option` text,
  `eqo_option_question` int(11) DEFAULT NULL,
  `eqo_option_st` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`eqo_id`),
  UNIQUE KEY `eqo_id` (`eqo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table be_emp_admin.be_qstn_answer
CREATE TABLE IF NOT EXISTS `be_qstn_answer` (
  `qa_id` int(11) NOT NULL AUTO_INCREMENT,
  `qa_emp_id` int(50) NOT NULL,
  `qa_templ_id` int(50) NOT NULL,
  `qa_ans_for_user` int(30) NOT NULL,
  `qa_emp_ans` text NOT NULL,
  `qa_edit_access` enum('0','1') NOT NULL DEFAULT '0',
  `qa_add_on` datetime DEFAULT NULL,
  `qa_updt_on` datetime DEFAULT NULL,
  `qa_status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`qa_id`),
  UNIQUE KEY `qa_id` (`qa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table be_emp_admin.keys
CREATE TABLE IF NOT EXISTS `keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table be_emp_admin.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
