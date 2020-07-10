/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : guahao

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-09-14 16:44:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for gh_record
-- ----------------------------
DROP TABLE IF EXISTS `gh_record`;
CREATE TABLE `gh_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` smallint(6) NOT NULL,
  `name` varchar(20) NOT NULL,
  `gender` smallint(1) NOT NULL,
  `age` smallint(3) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `note` varchar(255) NOT NULL,
  `date` varchar(10) NOT NULL,
  `addtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of gh_record
-- ----------------------------
INSERT INTO `gh_record` VALUES ('1', '3', '武则天', '0', '103', '15689565423', '全身皮肤美容', '2018-08-05', '1535444583');
INSERT INTO `gh_record` VALUES ('2', '1', 'leevast.cn', '1', '11', '13066455537', '11', '2018-08-02', '1535444583');
INSERT INTO `gh_record` VALUES ('3', '2', 'leevast.cn', '1', '11', '13066455537', '22', '2018-08-02', '1535444984');
INSERT INTO `gh_record` VALUES ('4', '1', 'leevast.cn', '1', '11', '13066455537', '11', '2018-08-02', '1535445647');
INSERT INTO `gh_record` VALUES ('6', '1', 'leevast.cn', '1', '11', '13066455537', '2', '2018-08-02', '1535697220');
INSERT INTO `gh_record` VALUES ('7', '1', 'leevast.cn', '1', '11', '13066455537', 'p', '2018-08-08', '1535697451');
INSERT INTO `gh_record` VALUES ('8', '1', 'leevast.cn', '1', '11', '13066455537', 'p', '2018-08-08', '1535697461');
INSERT INTO `gh_record` VALUES ('10', '1', 'leevast.cn', '1', '11', '13066455537', '11', '2018-08-02', '1536725065');
INSERT INTO `gh_record` VALUES ('12', '2', 'leevast', '1', '11', '13066455537', 'pp', '2018-08-02', '1536736159');

-- ----------------------------
-- Table structure for gh_room
-- ----------------------------
DROP TABLE IF EXISTS `gh_room`;
CREATE TABLE `gh_room` (
  `id` smallint(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `description` varchar(255) NOT NULL,
  `addtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of gh_room
-- ----------------------------
INSERT INTO `gh_room` VALUES ('1', '头发移植', '毛发移植中心', '1308558121');
INSERT INTO `gh_room` VALUES ('2', '疤痕修复', '疤痕修复中心', '1308563021');
INSERT INTO `gh_room` VALUES ('3', '皮肤美容', '皮肤美容中心', '1309249689');
INSERT INTO `gh_room` VALUES ('4', '内科', '内科中心', '1534921827');

-- ----------------------------
-- Table structure for gh_user
-- ----------------------------
DROP TABLE IF EXISTS `gh_user`;
CREATE TABLE `gh_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `truename` varchar(10) NOT NULL,
  `password` varchar(32) NOT NULL,
  `range` smallint(1) NOT NULL DEFAULT '1',
  `status` smallint(1) NOT NULL DEFAULT '1',
  `mail` varchar(60) NOT NULL,
  `lasttime` int(11) NOT NULL,
  `register_ip` varchar(15) NOT NULL,
  `addtime` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of gh_user
-- ----------------------------
INSERT INTO `gh_user` VALUES ('2', 'admin', '超级管理员', 'e10adc3949ba59abbe56e057f20f883e', '9', '1', '123@qq.com', '1536913445', '127.0.0.1', '1306745393');
INSERT INTO `gh_user` VALUES ('4', 'root', 'LH', 'e10adc3949ba59abbe56e057f20f883e', '1', '1', '', '1536752245', '::1', '1535526236');
