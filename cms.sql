# Host: localhost  (Version: 5.7.17)
# Date: 2019-03-03 13:48:40
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "cms_level"
#

DROP TABLE IF EXISTS `cms_level`;
CREATE TABLE `cms_level` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `level` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '编号',
  `level_name` varchar(20) NOT NULL DEFAULT '' COMMENT '名称',
  `leve_info` varchar(255) DEFAULT '' COMMENT '说明',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='等级';

#
# Data for table "cms_level"
#

/*!40000 ALTER TABLE `cms_level` DISABLE KEYS */;
INSERT INTO `cms_level` VALUES (1,1,'后台游客',''),(2,2,'会员专员',''),(3,3,'评论专员',''),(4,4,'发帖专员',''),(5,5,'普通管理员',''),(6,6,'超级管理员','');
/*!40000 ALTER TABLE `cms_level` ENABLE KEYS */;

#
# Structure for table "cms_manage"
#

DROP TABLE IF EXISTS `cms_manage`;
CREATE TABLE `cms_manage` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `admin_user` varchar(20) NOT NULL DEFAULT '' COMMENT '用户名',
  `admin_pass` char(40) NOT NULL DEFAULT '' COMMENT '密码',
  `level` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '等级',
  `login_count` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '登录次数',
  `last_ip` varchar(20) NOT NULL DEFAULT '000.000.000.000' COMMENT '登录IP',
  `last_time` datetime DEFAULT NULL COMMENT '登录时间',
  `reg_time` datetime DEFAULT NULL COMMENT '注册时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='管理员';

#
# Data for table "cms_manage"
#

/*!40000 ALTER TABLE `cms_manage` DISABLE KEYS */;
INSERT INTO `cms_manage` VALUES (1,'admin','7c4a8d09ca3762af61e59520943dc26494f8941b',6,0,'000.000.000.000',NULL,'2019-03-03 13:48:13'),(2,'user','7c4a8d09ca3762af61e59520943dc26494f8941b',5,0,'000.000.000.000',NULL,'2019-03-03 13:48:22');
/*!40000 ALTER TABLE `cms_manage` ENABLE KEYS */;
