# Host: localhost  (Version 5.5.5-10.1.16-MariaDB)
# Date: 2017-08-12 14:51:54
# Generator: MySQL-Front 6.0  (Build 1.159)


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

INSERT INTO `area_head` VALUES (1,'a11111','BSIT'),(2,'a11111','BSIT'),(3,'a1','BSBA');

#
# Structure for table "comment"
#

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `user` varchar(20) DEFAULT NULL,
  `content` text,
  `create_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "comment"
#


#
# Structure for table "denied_reason"
#

DROP TABLE IF EXISTS `denied_reason`;
CREATE TABLE `denied_reason` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_id` int(11) DEFAULT NULL,
  `reason` text,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "denied_reason"
#


#
# Structure for table "exam"
#

DROP TABLE IF EXISTS `exam`;
CREATE TABLE `exam` (
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

#
# Data for table "exam"
#

INSERT INTO `exam` VALUES (1,'eng101','2017-08-01','07:30:00','21:30:00','c3-6','v2','v2','BSBA1-A','2016-2017','First Semester','Prelim',1,0),(2,'eng102','2017-08-01','07:30:00','21:30:00','c2-1','v1','v2','BSBA1-A','2016-2017','First Semester','Prelim',1,0),(5,'eng107','2017-08-01','18:00:00','20:00:00','c3-6','v2','v2','BSBA1-A','2016-2017','First Semester','Prelim',0,0),(6,'eng107','2017-08-02','07:30:00','21:30:00','c3-6','v2','v2','BSBA1-A','2016-2017','First Semester','Prelim',1,0),(7,'eng107','2017-08-02','07:30:00','21:30:00','c3-6','v2','v2','BSBA1-A','2016-2017','First Semester','Prelim',-1,0),(8,'eng107','2017-08-02','07:30:00','21:30:00','c3-6','v2','v2','BSBA1-A','2016-2017','First Semester','Prelim',0,0),(9,'eng101','0000-00-00','07:30:00','21:30:00','c3-6','v2','v2','BSBA1-A','2016-2017','First Semester','Prelim',1,1),(10,'eng107','2017-08-30','07:30:00','21:30:00','c3-6','v2','v2','BSBA1-A','2016-2017','First Semester','Prelim',1,0);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

#
# Data for table "my_subjects"
#

INSERT INTO `my_subjects` VALUES (3,'s11111','eng104',NULL,NULL,NULL),(4,'s11111','eng106',NULL,NULL,NULL),(5,'s101','eng101',NULL,NULL,NULL),(6,'s101','eng102',NULL,NULL,NULL);

#
# Structure for table "room"
#

DROP TABLE IF EXISTS `room`;
CREATE TABLE `room` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `room` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

#
# Data for table "room"
#

INSERT INTO `room` VALUES (1,'c2-1'),(2,'c2-2'),(3,'c2-3'),(4,'c3-1'),(5,'c3-2'),(6,'c3-3'),(7,'c3-4'),(8,'c3-5'),(9,'c3-6');

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

INSERT INTO `settings` VALUES (1,'2016-2017','First Semester','Prelim');

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

INSERT INTO `student` VALUES (1,'s11111','BSIT','1','A'),(2,'s101','BSBA','1','A');

#
# Structure for table "subject"
#

DROP TABLE IF EXISTS `subject`;
CREATE TABLE `subject` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

#
# Data for table "subject"
#

INSERT INTO `subject` VALUES (1,'eng101','English 1'),(2,'eng102','English 2'),(3,'eng103','English 3'),(4,'eng104','English 4'),(5,'eng105','English 5'),(6,'eng106','English 6'),(7,'eng107','English 7');

#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `idnumber` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `auth` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

#
# Data for table "user"
#

INSERT INTO `user` VALUES (1,'admin1','827ccb0eea8a706c4c34a16891f84e7b','Digong','Duterte','Admin'),(11,'admin','4f5f3c2adbcc8752f1e2e4b81ea188c4','admin','admin','Admin'),(12,'101010','827ccb0eea8a706c4c34a16891f84e7b','deeb','bian','Admin'),(13,'123456','827ccb0eea8a706c4c34a16891f84e7b','hello','world','VPAA'),(14,'v1','827ccb0eea8a706c4c34a16891f84e7b','v1','v1','Faculty'),(15,'v2','4f5f3c2adbcc8752f1e2e4b81ea188c4','v2','v2','Faculty'),(16,'s101','827ccb0eea8a706c4c34a16891f84e7b','s','101','Student'),(17,'a1','827ccb0eea8a706c4c34a16891f84e7b','a1','a1','Area Head');
