/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : cms

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 04/06/2020 00:42:32
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cms_comment
-- ----------------------------
DROP TABLE IF EXISTS `cms_comment`;
CREATE TABLE `cms_comment`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '评论者',
  `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '内容',
  `state` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态',
  `manner` tinyint(1) NULL DEFAULT NULL COMMENT '态度',
  `cid` int(11) NULL DEFAULT NULL COMMENT '内容ID',
  `date` datetime(0) NULL DEFAULT NULL COMMENT '时间',
  `sustain` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '支持率',
  `oppose` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '反对率',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cms_comment
-- ----------------------------
INSERT INTO `cms_comment` VALUES (1, '游客', 'dfsafa', 1, 0, 7, '2020-06-01 18:44:33', 0, 0);
INSERT INTO `cms_comment` VALUES (2, '游客', '111', 1, 1, 6, '2020-06-02 12:28:21', 1, 0);
INSERT INTO `cms_comment` VALUES (3, '游客', '111', 1, 1, 6, '2020-06-02 12:30:27', 0, 0);
INSERT INTO `cms_comment` VALUES (4, 'admin', 'dsadssd', 1, -1, 6, '2020-06-02 12:31:11', 0, 0);
INSERT INTO `cms_comment` VALUES (5, 'admin', '111', 1, 1, 6, '2020-06-02 12:33:28', 0, 1);
INSERT INTO `cms_comment` VALUES (7, 'admin', 'fdsa', 0, 0, 6, '2020-06-02 13:38:10', 4, 4);

-- ----------------------------
-- Table structure for cms_content
-- ----------------------------
DROP TABLE IF EXISTS `cms_content`;
CREATE TABLE `cms_content`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '标题',
  `nav` int(11) UNSIGNED NULL DEFAULT NULL COMMENT '栏目ID',
  `attr` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '属性',
  `tag` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '标签',
  `keyword` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '关键字',
  `thumbnail` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '缩略图',
  `source` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '文章来源',
  `author` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '作者',
  `info` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '内容摘要',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '详细内容',
  `commend` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '允许评论，禁止评论',
  `count` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '浏览次数',
  `gold` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '消费金币',
  `sort` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序',
  `readlimit` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '阅读权限',
  `color` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '颜色',
  `date` datetime(0) NULL DEFAULT NULL COMMENT '发布时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '内容表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cms_content
-- ----------------------------
INSERT INTO `cms_content` VALUES (1, '网友还在吃瓜，懂事的编辑教你们保护手机的秘密网友还在吃瓜，懂事的编辑教你们保护手机的秘密', 12, '头条', '编辑,手机,密码', '手机,密码,网友', '/uploads/20200503/20200503023701765.png', '太平洋', 'admin', '瓜模式。不过，在很多网友还在专心吃瓜的时候，懂事的男生（或者女生）已经开始在删聊天记录了。毕竟，这一切都起源于翻了手机里的聊天记录我们就不讨论「在一段感情中应不应该把手机里的内容向自己的另一半公开」这个问题了，毕竟我们是手机频道又不是情感频道。但是，我们可以教大家怎么保护好手机里的秘密不被发现啊', '<p>\r\n	瓜模式。不过，在很多网友还在专心吃瓜的时候，懂事的男生（或者女生）已经开始在删聊天记录了。毕竟，这一切都起源于翻了手机里的聊天记录我们就不讨论「在一段感情中应不应该把手机里的内容向自己的另一半公开」这个问题了，毕竟我们是手机频道又不是情感频道。但是，我们可以教大家怎么保护好手机里的秘密不被发现啊瓜模式。不过，在很多网友还在专心吃瓜的时候，懂事的男生（或者女生）已经开始在删聊天记录了。毕竟，这一切都起源于翻了手机里的聊天记录我们就不讨论「在一段感情中应不应该把手机里的内容向自己的另一半公开」这个问题了，毕竟我们是手机频道又不是情感频道。但是，我们可以教大家怎么保护好手机里的秘密不被发现啊</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	瓜模式。不过，在很多网友还在专心吃瓜的时候，懂事的男生（或者女生）已经开始在删聊天记录了。毕竟，这一切都起源于翻了手机里的聊天记录我们就不讨论「在一段感情中应不应该把手机里的内容向自己的另一半公开」这个问题了，毕竟我们是手机频道又不是情感频道。但是，我们可以教大家怎么保护好手机里的秘密不被发现啊</p>\r\n<p>\r\n	瓜模式。不过，在很多网友还在专心吃瓜的时候，懂事的男生（或者女生）已经开始在删聊天记录了。毕竟，这一切都起源于翻了手机里的聊天记录我们就不讨论「在一段感情中应不应该把手机里的内容向自己的另一半公开」这个问题了，毕竟我们是手机频道又不是情感频道。但是，我们可以教大家怎么保护好手机里的秘密不被发现啊</p>\r\n', 1, 413, 0, 0, 1, '', '2020-05-03 02:13:57');
INSERT INTO `cms_content` VALUES (3, '第三节课就安静安静而u萨迪的发发大水发啊', 13, '无属性', '打发', ' s', '', ' dsa', 'admin', 'da', '<p>\r\n	fsad</p>\r\n', 1, 114, 0, 0, 1, '', '2020-05-03 18:12:39');
INSERT INTO `cms_content` VALUES (4, '哈哈哈哈多撒发哈啊哈单号啊好发 ', 13, '头条', '1', '1', '/uploads/20200504/20200504134529267.gif', '1', 'admin', '1', '<p>\r\n	1</p>\r\n', 0, 1014, 1, 4, 3, 'blue', '2020-05-04 13:45:44');
INSERT INTO `cms_content` VALUES (5, '手动阀加金额的撒骄傲家电家具 的看法骄傲', 13, '无', '1', '1', '', '1', 'admin', '1', '<p>\r\n	1d</p>\r\n', 1, 114, 0, 0, 0, '', '2020-05-04 13:46:11');
INSERT INTO `cms_content` VALUES (6, '的萨克京东卡删繁就简额呵呵呵呵呵哈', 12, '无', '', '', '', '', 'admin', '', '<p>\r\n	sss</p>\r\n', 1, 269, 0, 0, 0, '', '2020-05-04 14:06:18');
INSERT INTO `cms_content` VALUES (7, '打扫房间安科技的拉近了哈萨克的豪华', 13, '推荐', '4', '4', '', '4', '4', '4', '<p>\r\n	4</p>\r\n', 0, 27, 4, 3, 3, 'orange', '2020-05-04 14:08:49');
INSERT INTO `cms_content` VALUES (8, '你好你好你好你好你好你好你好你好你好你好你好你好你好', 12, '头条,推荐', 'ss', '1111', '/uploads/20200603/20200603172358950.gif', '1111', 'admin', '你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好阿', '<p>\r\n	你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好阿你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好阿你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好阿你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好阿你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好阿你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好阿你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好阿</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好阿你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好阿你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好，你好你好你好你好你好你好你好你好你好你好你好你好你好阿</p>\r\n', 1, 123, 0, 0, 0, '', '2020-06-03 17:24:05');
INSERT INTO `cms_content` VALUES (9, '反对就看手机奥卡福健身卡京东方三口', 13, '头条,推荐', '', '', '', '', 'admin', '', '<p>\r\n	谁说的</p>\r\n', 1, 100, 0, 0, 0, '', '2020-06-03 22:38:20');

-- ----------------------------
-- Table structure for cms_level
-- ----------------------------
DROP TABLE IF EXISTS `cms_level`;
CREATE TABLE `cms_level`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `level_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '名称',
  `level_info` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '说明',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '等级表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cms_level
-- ----------------------------
INSERT INTO `cms_level` VALUES (1, '后台游客', '仅有访问后台权限');
INSERT INTO `cms_level` VALUES (2, '会员专员', '仅有管理会员权限');
INSERT INTO `cms_level` VALUES (3, '评论专员', '仅有评论权限');
INSERT INTO `cms_level` VALUES (4, '发帖专员', '仅有发帖权限');
INSERT INTO `cms_level` VALUES (5, '普通管理员', '暂无描述');
INSERT INTO `cms_level` VALUES (6, '超级管理员', '暂无描述');

-- ----------------------------
-- Table structure for cms_manage
-- ----------------------------
DROP TABLE IF EXISTS `cms_manage`;
CREATE TABLE `cms_manage`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_user` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `admin_pass` char(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '密码',
  `level` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '等级',
  `login_count` mediumint(8) UNSIGNED NOT NULL DEFAULT 0 COMMENT '登录次数',
  `last_ip` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '登录IP',
  `last_time` datetime(0) NULL DEFAULT NULL COMMENT '登录时间',
  `reg_time` datetime(0) NULL DEFAULT NULL COMMENT '注册时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '管理员表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cms_manage
-- ----------------------------
INSERT INTO `cms_manage` VALUES (1, 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', 6, 19, '127.0.0.1', '2020-06-03 17:23:29', NULL);
INSERT INTO `cms_manage` VALUES (2, 'user', '7c4a8d09ca3762af61e59520943dc26494f8941b', 5, 0, '', NULL, NULL);
INSERT INTO `cms_manage` VALUES (3, 'guest', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 0, '', NULL, NULL);

-- ----------------------------
-- Table structure for cms_nav
-- ----------------------------
DROP TABLE IF EXISTS `cms_nav`;
CREATE TABLE `cms_nav`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nav_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '导航名',
  `nav_info` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '导航说明',
  `pid` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '父ID',
  `sort` int(11) UNSIGNED NULL DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '导航表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cms_nav
-- ----------------------------
INSERT INTO `cms_nav` VALUES (1, '军事动态', NULL, 0, NULL);
INSERT INTO `cms_nav` VALUES (2, '八卦娱乐', NULL, 0, NULL);
INSERT INTO `cms_nav` VALUES (3, '时尚女人', NULL, 0, NULL);
INSERT INTO `cms_nav` VALUES (4, '科技频道', NULL, 0, NULL);
INSERT INTO `cms_nav` VALUES (5, '智能手机', NULL, 0, NULL);
INSERT INTO `cms_nav` VALUES (6, '美容护发', NULL, 0, NULL);
INSERT INTO `cms_nav` VALUES (7, '热门汽车', NULL, 0, NULL);
INSERT INTO `cms_nav` VALUES (8, '房产家居', NULL, 0, NULL);
INSERT INTO `cms_nav` VALUES (9, '读书教育', NULL, 0, NULL);
INSERT INTO `cms_nav` VALUES (10, '房产家居', NULL, 0, NULL);
INSERT INTO `cms_nav` VALUES (11, '股票基金', NULL, 0, NULL);
INSERT INTO `cms_nav` VALUES (12, '越南军事', '', 1, 12);
INSERT INTO `cms_nav` VALUES (13, 'test', 'dfsa', 2, 13);

-- ----------------------------
-- Table structure for cms_user
-- ----------------------------
DROP TABLE IF EXISTS `cms_user`;
CREATE TABLE `cms_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '用户名',
  `pass` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '密码',
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '电子邮箱',
  `question` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '提问',
  `answer` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '回答',
  `state` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态',
  `date` datetime(0) NULL DEFAULT NULL COMMENT '时间',
  `face` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '头像',
  `time` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '最近登录时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cms_user
-- ----------------------------
INSERT INTO `cms_user` VALUES (1, 'sasda', '53d6b91f1234818f3087368b3898e29fed59c86e', 'ss', '', 's', 1, '2020-05-29 14:07:43', '01.gif', NULL);
INSERT INTO `cms_user` VALUES (3, 'sfdadsa', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'ss@a.com', '', '', 1, '2020-05-29 14:22:51', '03.gif', NULL);
INSERT INTO `cms_user` VALUES (4, 'dadsd', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'd@s.com', '', '', 1, '2020-05-29 14:26:54', '04.gif', NULL);
INSERT INTO `cms_user` VALUES (5, 'dsaaf', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'sd@qq.com', '', '', 1, '2020-05-29 14:54:53', '05.gif', NULL);
INSERT INTO `cms_user` VALUES (6, 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1dsa@q.com', '', '', 1, '2020-05-29 15:11:58', '06.gif', '1591072263');
INSERT INTO `cms_user` VALUES (7, '黑骑一户', '7c4a8d09ca3762af61e59520943dc26494f8941b', 's@qq.com', '', '', 1, '2020-05-29 15:26:02', '07.gif', NULL);
INSERT INTO `cms_user` VALUES (8, 'admins', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'sd@qq.com', '', '', 1, '2020-05-29 16:50:40', '08.gif', NULL);
INSERT INTO `cms_user` VALUES (9, 'dsad', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'sda@qw.com', '', '', 1, '2020-05-29 16:53:24', '09.gif', NULL);
INSERT INTO `cms_user` VALUES (10, 'sss', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123@ww.com', '', '', 1, '2020-05-30 12:39:36', '10.gif', '1590813576');
INSERT INTO `cms_user` VALUES (11, 'dfsa', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'ss@qq.com', '', '', 1, '2020-06-01 15:50:36', '01.gif', '');
INSERT INTO `cms_user` VALUES (12, 'fads', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'd@q.com', '', '', 1, '2020-06-01 15:51:51', '01.gif', '');
INSERT INTO `cms_user` VALUES (13, 'dfsasss', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a', 'monster@nata.com', '您配偶的性别？', '女', 5, '2020-06-01 15:58:11', '21.gif', '');

SET FOREIGN_KEY_CHECKS = 1;
