# Host: localhost  (Version 5.5.5-10.1.16-MariaDB)
# Date: 2017-09-12 23:47:44
# Generator: MySQL-Front 5.4  (Build 1.40)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "area_head"
#

DROP TABLE IF EXISTS `area_head`;
CREATE TABLE `area_head` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `idnumber` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Data for table "area_head"
#

INSERT INTO `area_head` VALUES (1,'12-0002-001','BSIT'),(2,'12-0002-002','BSBA'),(3,'12345','BSIT');

#
# Structure for table "denied_reason"
#

DROP TABLE IF EXISTS `denied_reason`;
CREATE TABLE `denied_reason` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_id` int(11) DEFAULT NULL,
  `reason` text,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

#
# Data for table "denied_reason"
#

INSERT INTO `denied_reason` VALUES (1,21,'dfgfdgfd'),(2,9,'ahahahahha'),(8,13,'conflict on proctor');

#
# Structure for table "exam"
#

DROP TABLE IF EXISTS `exam`;
CREATE TABLE `exam` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_code` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time_from` time DEFAULT NULL,
  `time_to` time DEFAULT NULL,
  `room` varchar(50) DEFAULT NULL,
  `proctor` varchar(100) DEFAULT NULL,
  `mentor` varchar(100) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `sy` varchar(100) DEFAULT NULL,
  `sem` varchar(100) DEFAULT NULL,
  `term` varchar(100) DEFAULT NULL,
  `is_approved` int(1) DEFAULT '0',
  `is_general` int(1) DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for table "exam"
#

INSERT INTO `exam` VALUES (1,'ITS 402','2017-09-12','07:30:00','09:30:00','A2-2','12-0004-001','12-0004-001','BSBA1-A','2017-2018','First Semester','Prelim',0,0),(5,'ITS 402','2017-09-12','09:30:00','11:30:00','A2-2','12-0005-003','12-0004-001','BSBA1-A','2017-2018','First Semester','Prelim',0,0),(6,'ITS 402','2017-09-12','07:30:00','09:30:00','c2-1','12-0005-003','12-0004-001','BSBA1-A','2017-2018','First Semester','Prelim',0,0);

#
# Structure for table "exam_tmp"
#

DROP TABLE IF EXISTS `exam_tmp`;
CREATE TABLE `exam_tmp` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_code` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time_from` time DEFAULT NULL,
  `time_to` time DEFAULT NULL,
  `room` varchar(255) DEFAULT NULL,
  `proctor` varchar(255) DEFAULT NULL,
  `mentor` varchar(255) DEFAULT NULL,
  `course` varchar(255) DEFAULT NULL,
  `sy` varchar(255) DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `term` varchar(255) DEFAULT NULL,
  `is_approved` int(1) DEFAULT '0',
  `is_general` int(1) DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "exam_tmp"
#


#
# Structure for table "my_subjects"
#

DROP TABLE IF EXISTS `my_subjects`;
CREATE TABLE `my_subjects` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `idnumber` varchar(100) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `sched` varchar(255) DEFAULT NULL,
  `facultyId` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Data for table "my_subjects"
#

INSERT INTO `my_subjects` VALUES (1,'12-0001-001','PHIL 101','7:30:00','MWF','12-0004-001'),(2,'12-0000-002','PHIL 101','7:30:00','TTH','12-0004-001'),(3,'12-0001-001','BANK 701','7:30:00','MWF','12-0004-002'),(4,NULL,'',NULL,NULL,NULL);

#
# Structure for table "room"
#

DROP TABLE IF EXISTS `room`;
CREATE TABLE `room` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `room` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

#
# Data for table "room"
#

INSERT INTO `room` VALUES (1,'c2-1'),(2,'c2-2'),(3,'c2-3'),(4,'c2-4'),(5,'c2-5'),(6,'c2-6'),(7,'c2-7'),(8,'c2-8'),(9,'c2-9'),(10,'complab-a'),(11,'complab-b'),(12,'complab-c'),(13,'A2-1'),(14,'A2-2');

#
# Structure for table "settings"
#

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `sy` varchar(255) DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `term` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Data for table "settings"
#

INSERT INTO `settings` VALUES (1,'2017-2018','First Semester','Prelim');

#
# Structure for table "student"
#

DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `idnumber` varchar(255) DEFAULT NULL,
  `course` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `section` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for table "student"
#

INSERT INTO `student` VALUES (1,'12-0001-001','BSIT','1','A'),(2,'12-0001-002','BSIT','4','A');

#
# Structure for table "subject"
#

DROP TABLE IF EXISTS `subject`;
CREATE TABLE `subject` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

#
# Data for table "subject"
#

INSERT INTO `subject` VALUES (1,'ENGL 101','ENGLISH'),(2,'ACCTG 300','ACCOUNTING'),(3,'PHIL 101','PHILOSOPHY'),(4,'SSCI 100','SOCIOLOGY'),(5,'PE 101','PHYSICAL EDUCATION'),(6,'POLSCI 100','POLITICAL SCIENCE'),(7,'BIOSCI 100','BIOLOGICAL SCIENCE'),(8,'NTSCI 101','NATIONAL SCIENCE'),(9,'ITS 101','PROGRAMMING'),(10,'ITS 201','DATABASE'),(11,'ITS 402','CAPSTONE PROJECT');

#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `idnumber` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `auth` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

#
# Data for table "user"
#

INSERT INTO `user` VALUES (2,'admin','827ccb0eea8a706c4c34a16891f84e7b','Digong','Duterte','Admin'),(3,'12-0000-001','827ccb0eea8a706c4c34a16891f84e7b','Sharon','Cuneta','Admin'),(4,'12-0000-002','4f5f3c2adbcc8752f1e2e4b81ea188c4','Gabby','Conception','Admin'),(5,'12-0001-001','827ccb0eea8a706c4c34a16891f84e7b','Kim','Chu','Student'),(6,'12-0001-002','827ccb0eea8a706c4c34a16891f84e7b','Gerald','Anderson','Student'),(7,'12-0002-001','827ccb0eea8a706c4c34a16891f84e7b','Liza','Soberano','Area Head'),(8,'12-0002-002','827ccb0eea8a706c4c34a16891f84e7b','Enrique','Gil','Area Head'),(9,'12-0003-001','827ccb0eea8a706c4c34a16891f84e7b','Daniel','Padilla','VPAA'),(10,'12-0003-002','4f5f3c2adbcc8752f1e2e4b81ea188c4','Kathryn','Bernardo','VPAA'),(11,'12-0004-001','827ccb0eea8a706c4c34a16891f84e7b','Coco','Martin','Faculty'),(12,'12-0004-002','4f5f3c2adbcc8752f1e2e4b81ea188c4','Vice','Ganda','Faculty'),(13,'12345','4f5f3c2adbcc8752f1e2e4b81ea188c4','arvin','regalado','Area Head'),(14,'12-0005-001','827ccb0eea8a706c4c34a16891f84e7b','Jude','Bayer','Faculty'),(15,'12-0005-003','4f5f3c2adbcc8752f1e2e4b81ea188c4','Xander','Ford','Faculty');
