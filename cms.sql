/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 50717
 Source Host           : localhost:3306
 Source Schema         : cms

 Target Server Type    : MySQL
 Target Server Version : 50717
 File Encoding         : 65001

 Date: 15/12/2019 13:12:34
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

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
INSERT INTO `cms_manage` VALUES (1, 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', 6, 0, '', NULL, NULL);
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
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '导航表' ROW_FORMAT = Dynamic;

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

SET FOREIGN_KEY_CHECKS = 1;
