/*
Navicat MySQL Data Transfer

Source Server         : one
Source Server Version : 50553
Source Host           : 10.50.0.158:3306
Source Database       : one

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-12-02 19:09:34
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `one_admin`
-- ----------------------------
DROP TABLE IF EXISTS `one_admin`;
CREATE TABLE `one_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(120) DEFAULT NULL COMMENT '管理员名',
  `password` char(32) DEFAULT NULL COMMENT '管理员密码',
  `sex` enum('保密','女','男') NOT NULL DEFAULT '保密' COMMENT '管理员性别',
  `moble` char(11) NOT NULL COMMENT '管理员手机号',
  `email` varchar(70) NOT NULL COMMENT '邮箱',
  `grade` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '权限',
  `detail` text COMMENT '备注',
  `add_time` int(10) unsigned DEFAULT NULL,
  `login_time` int(10) unsigned DEFAULT NULL,
  `login_num` int(10) unsigned NOT NULL DEFAULT '0',
  `login_ip` varchar(15) DEFAULT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态 1激活 2禁用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of one_admin
-- ----------------------------
INSERT INTO `one_admin` VALUES ('1', '阿伟', '4297f44b13955235245b2497399d7a93', '保密', '13373954509', '578448743@qq.com', '3', '最帅的一个', '1571012936', '1574134980', '57', '127.0.0.1', '1');
INSERT INTO `one_admin` VALUES ('2', 'cpc', '202cb962ac59075b964b07152d234b70', '保密', '', '', '1', null, null, '1573611656', '41', '127.0.0.1', '1');
INSERT INTO `one_admin` VALUES ('3', 'zdy', '202cb962ac59075b964b07152d234b70', '男', '', '', '1', null, null, '1574057543', '49', '127.0.0.1', '1');
INSERT INTO `one_admin` VALUES ('4', 'sxy', '202cb962ac59075b964b07152d234b70', '保密', '111111', '', '1', null, null, '1575188856', '61', '127.0.0.1', '1');
INSERT INTO `one_admin` VALUES ('6', 'asd', 'a8f5f167f44f4964e6c998dee827110c', '男', '13373954509', 'zhangsan-001@gmail.com', '1', 'asdasdasd', '1571122936', null, '0', null, '1');
INSERT INTO `one_admin` VALUES ('8', '薇薇', '202cb962ac59075b964b07152d234b70', '女', '13373954509', '578448743@qq.com', '2', '123123', '1571128819', null, '0', null, '1');
INSERT INTO `one_admin` VALUES ('31', 'aasdd', '4297f44b13955235245b2497399d7a93', '保密', '13373954512', '57843218743@qq.com', '1', '112312', '1573115313', null, '0', null, '1');
INSERT INTO `one_admin` VALUES ('27', 'awsla', '202cb962ac59075b964b07152d234b70', '女', '13373954508', '578448744@qq.com', '2', '123123123', '1571199649', '1571645830', '4', '127.0.0.1', '1');
INSERT INTO `one_admin` VALUES ('32', 'afews', '4297f44b13955235245b2497399d7a93', '男', '13373954231', '578432148743@qq.com', '1', '123123', '1573115334', null, '0', null, '2');

-- ----------------------------
-- Table structure for `one_admin_logs`
-- ----------------------------
DROP TABLE IF EXISTS `one_admin_logs`;
CREATE TABLE `one_admin_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(10) unsigned NOT NULL COMMENT '管理员表id',
  `ad_name` varchar(20) NOT NULL COMMENT '管理员名',
  `login_time` int(10) unsigned NOT NULL COMMENT '管理员每次登陆时间',
  `login_ip` varchar(25) NOT NULL COMMENT '管理员每次登录ip',
  `active` tinyint(3) unsigned NOT NULL COMMENT '每次登录状态',
  `created_at` int(20) unsigned DEFAULT NULL,
  `updated_at` int(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=136 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of one_admin_logs
-- ----------------------------
INSERT INTO `one_admin_logs` VALUES ('4', '27', 'awsl', '1571638719', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('3', '1', '阿伟', '1571638641', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('5', '27', 'awsl', '1571645830', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('6', '1', '阿伟', '1571716411', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('7', '4', 'sxy', '1571723567', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('8', '4', 'sxy', '1571744319', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('9', '3', 'zdy', '1571791586', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('10', '1', '阿伟', '1571791992', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('11', '4', 'sxy', '1571793821', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('12', '2', 'cpc', '1571812026', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('13', '2', 'cpc', '1571819184', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('14', '4', 'sxy', '1571830983', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('15', '2', 'cpc', '1571833506', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('16', '3', 'zdy', '1571878197', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('17', '4', 'sxy', '1571880853', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('18', '4', 'sxy', '1571885278', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('19', '3', 'zdy', '1571888393', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('20', '3', 'zdy', '1571896551', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('21', '2', 'cpc', '1571903797', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('22', '1', '阿伟', '1571905003', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('23', '2', 'cpc', '1571905578', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('24', '3', 'zdy', '1572137186', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('25', '4', 'sxy', '1572141178', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('26', '3', 'zdy', '1572223481', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('27', '4', 'sxy', '1572231558', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('28', '3', 'zdy', '1572241966', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('29', '4', 'sxy', '1572249134', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('30', '4', 'sxy', '1572261828', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('31', '4', 'sxy', '1572310367', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('32', '3', 'zdy', '1572310425', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('33', '1', '阿伟', '1572317287', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('34', '2', 'cpc', '1572328485', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('35', '1', '阿伟', '1572341349', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('36', '1', '阿伟', '1572349172', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('37', '4', 'sxy', '1572397249', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('38', '3', 'zdy', '1572401138', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('39', '4', 'sxy', '1572401211', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('40', '2', 'cpc', '1572401328', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('41', '3', 'zdy', '1572416671', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('42', '4', 'sxy', '1572417022', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('43', '1', '阿伟', '1572484235', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('44', '4', 'sxy', '1572492701', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('45', '4', 'sxy', '1572494269', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('46', '3', 'zdy', '1572509785', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('47', '1', '阿伟', '1572828375', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('48', '4', 'sxy', '1572829269', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('49', '2', 'cpc', '1572857665', '10.50.0.158', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('50', '3', 'zdy', '1572857902', '10.50.0.158', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('51', '4', 'sxy', '1572858051', '10.50.0.158', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('52', '1', '阿伟', '1572858259', '10.50.0.158', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('53', '2', 'cpc', '1572918154', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('54', '4', 'sxy', '1572918605', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('55', '3', 'zdy', '1572923133', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('56', '3', 'zdy', '1572938728', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('57', '1', '阿伟', '1572943119', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('58', '1', '阿伟', '1573002532', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('59', '2', 'cpc', '1573002752', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('60', '4', 'sxy', '1573004441', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('61', '4', 'sxy', '1573020703', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('62', '3', 'zdy', '1573027234', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('63', '3', 'zdy', '1573094536', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('64', '4', 'sxy', '1573096407', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('65', '4', 'sxy', '1573097433', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('66', '1', '阿伟', '1573098631', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('67', '1', '阿伟', '1573108223', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('68', '2', 'cpc', '1573113281', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('69', '2', 'cpc', '1573115932', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('70', '2', 'cpc', '1573347476', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('71', '2', 'cpc', '1573347477', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('72', '1', '阿伟', '1573347493', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('73', '2', 'cpc', '1573347596', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('74', '4', 'sxy', '1573347724', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('75', '3', 'zdy', '1573348235', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('76', '4', 'sxy', '1573368920', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('77', '1', '阿伟', '1573375091', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('78', '2', 'cpc', '1573432896', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('79', '4', 'sxy', '1573434503', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('80', '4', 'sxy', '1573434843', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('81', '3', 'zdy', '1573435746', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('82', '1', '阿伟', '1573443870', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('83', '4', 'sxy', '1573445696', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('84', '2', 'cpc', '1573455131', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('85', '1', '阿伟', '1573455429', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('86', '2', 'cpc', '1573456319', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('87', '4', 'sxy', '1573457213', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('88', '4', 'sxy', '1573468913', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('89', '2', 'cpc', '1573469696', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('90', '3', 'zdy', '1573470213', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('91', '1', '阿伟', '1573470794', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('92', '2', 'cpc', '1573471086', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('93', '1', '阿伟', '1573471980', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('94', '2', 'cpc', '1573520141', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('95', '3', 'zdy', '1573520324', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('96', '1', '阿伟', '1573521645', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('97', '4', 'sxy', '1573522221', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('98', '3', 'zdy', '1573530053', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('99', '4', 'sxy', '1573531120', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('100', '1', '阿伟', '1573538093', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('101', '4', 'sxy', '1573555912', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('102', '2', 'cpc', '1573556223', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('103', '3', 'zdy', '1573556334', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('104', '2', 'cpc', '1573611656', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('105', '4', 'sxy', '1573618771', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('106', '4', 'sxy', '1573633091', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('107', '4', 'sxy', '1573695525', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('108', '4', 'sxy', '1573697082', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('109', '4', 'sxy', '1573698208', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('110', '4', 'sxy', '1574038251', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('111', '3', 'zdy', '1574038948', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('112', '3', 'zdy', '1574039206', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('113', '4', 'sxy', '1574057092', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('114', '3', 'zdy', '1574057430', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('115', '3', 'zdy', '1574057443', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('116', '3', 'zdy', '1574057459', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('117', '3', 'zdy', '1574057485', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('118', '3', 'zdy', '1574057513', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('119', '3', 'zdy', '1574057524', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('120', '3', 'zdy', '1574057543', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('121', '1', '阿伟', '1574063537', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('122', '4', 'sxy', '1574127940', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('123', '1', '阿伟', '1574134980', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('124', '4', 'sxy', '1574143273', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('125', '4', 'sxy', '1574153309', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('126', '4', 'sxy', '1574214141', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('127', '4', 'sxy', '1574561983', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('128', '4', 'sxy', '1574564067', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('129', '4', 'sxy', '1574757046', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('130', '4', 'sxy', '1574757052', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('131', '4', 'sxy', '1574834983', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('132', '4', 'sxy', '1574924637', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('133', '4', 'sxy', '1574924647', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('134', '4', 'sxy', '1574924666', '127.0.0.1', '1', null, null);
INSERT INTO `one_admin_logs` VALUES ('135', '4', 'sxy', '1575188856', '127.0.0.1', '1', null, null);

-- ----------------------------
-- Table structure for `one_admin_permission_role`
-- ----------------------------
DROP TABLE IF EXISTS `one_admin_permission_role`;
CREATE TABLE `one_admin_permission_role` (
  `permission_id` int(10) unsigned NOT NULL COMMENT '权限表id',
  `role_id` int(10) unsigned NOT NULL COMMENT '角色表id',
  PRIMARY KEY (`permission_id`,`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of one_admin_permission_role
-- ----------------------------

-- ----------------------------
-- Table structure for `one_admin_premissions`
-- ----------------------------
DROP TABLE IF EXISTS `one_admin_premissions`;
CREATE TABLE `one_admin_premissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '无限分类 权限id',
  `name` varchar(249) NOT NULL COMMENT '路由别名',
  `display_name` varchar(249) NOT NULL COMMENT '功能名字',
  `description` varchar(249) DEFAULT NULL COMMENT '描述',
  `pid` tinyint(2) unsigned NOT NULL COMMENT '顶级分类',
  `path` tinyint(10) unsigned NOT NULL COMMENT '下级分类',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of one_admin_premissions
-- ----------------------------

-- ----------------------------
-- Table structure for `one_admin_roles`
-- ----------------------------
DROP TABLE IF EXISTS `one_admin_roles`;
CREATE TABLE `one_admin_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员角色表id',
  `name` varchar(249) NOT NULL COMMENT '管理员姓名',
  `dispaly_name` varchar(249) NOT NULL COMMENT '角色名',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of one_admin_roles
-- ----------------------------

-- ----------------------------
-- Table structure for `one_admin_role_user`
-- ----------------------------
DROP TABLE IF EXISTS `one_admin_role_user`;
CREATE TABLE `one_admin_role_user` (
  `admin_id` int(10) unsigned NOT NULL COMMENT '管理员表id',
  `role_id` int(10) unsigned NOT NULL COMMENT '角色表id',
  PRIMARY KEY (`admin_id`,`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of one_admin_role_user
-- ----------------------------

-- ----------------------------
-- Table structure for `one_advertis`
-- ----------------------------
DROP TABLE IF EXISTS `one_advertis`;
CREATE TABLE `one_advertis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `advertisP_name` varchar(30) NOT NULL COMMENT '广告名称',
  `advertis_num` int(10) unsigned DEFAULT NULL,
  `image` varchar(300) NOT NULL COMMENT '广告图片',
  `height` int(10) unsigned DEFAULT NULL,
  `width` int(10) unsigned DEFAULT NULL,
  `href` varchar(200) DEFAULT NULL COMMENT '链接',
  `add_time` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1显示2不显示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of one_advertis
-- ----------------------------
INSERT INTO `one_advertis` VALUES ('2', '点菜区详情图', '12', '', null, null, null, null, '1');
INSERT INTO `one_advertis` VALUES ('1', '首页轮换图', null, '', null, null, null, null, '1');
INSERT INTO `one_advertis` VALUES ('3', '', null, '', null, null, null, null, '2');

-- ----------------------------
-- Table structure for `one_advertis_list`
-- ----------------------------
DROP TABLE IF EXISTS `one_advertis_list`;
CREATE TABLE `one_advertis_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '广告ID',
  `ap_id` int(10) NOT NULL,
  `advertis_name` varchar(50) NOT NULL COMMENT '广告名称',
  `image` varchar(255) DEFAULT NULL COMMENT '广告图片',
  `start_time` int(20) DEFAULT NULL COMMENT '开始时间',
  `end_time` int(20) DEFAULT NULL COMMENT '结束时间',
  `active` int(10) unsigned NOT NULL DEFAULT '2' COMMENT '1为激活 2为禁用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of one_advertis_list
-- ----------------------------
INSERT INTO `one_advertis_list` VALUES ('1', '1', '', null, null, null, '2');
INSERT INTO `one_advertis_list` VALUES ('2', '1', '', null, null, null, '2');
INSERT INTO `one_advertis_list` VALUES ('3', '2', '', null, null, null, '2');
INSERT INTO `one_advertis_list` VALUES ('4', '2', '', null, null, null, '2');
INSERT INTO `one_advertis_list` VALUES ('5', '3', '', null, null, null, '2');
INSERT INTO `one_advertis_list` VALUES ('6', '3', '', null, null, null, '2');

-- ----------------------------
-- Table structure for `one_article`
-- ----------------------------
DROP TABLE IF EXISTS `one_article`;
CREATE TABLE `one_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章id',
  `mid` int(30) unsigned NOT NULL COMMENT '文章分类',
  `title` text NOT NULL COMMENT '文章标题',
  `details` text COMMENT '文章简介',
  `content` text COMMENT '文章内容',
  `add_time` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `active` char(255) NOT NULL DEFAULT '1' COMMENT '1显示 2未显示',
  PRIMARY KEY (`id`,`mid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of one_article
-- ----------------------------
INSERT INTO `one_article` VALUES ('2', '1', '支付方式', '这是关于我们关于支付方法的相关介绍', '在本站购买外卖  您可以选择支付宝、微信、银付联和到付现金。', null, '1');
INSERT INTO `one_article` VALUES ('3', '0', 'asdas', null, 'asdasdasdasdasdasda', null, '1');

-- ----------------------------
-- Table structure for `one_article_sort`
-- ----------------------------
DROP TABLE IF EXISTS `one_article_sort`;
CREATE TABLE `one_article_sort` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned DEFAULT NULL,
  `article_name` varchar(50) NOT NULL COMMENT '名称',
  `path` varchar(100) NOT NULL COMMENT '从最高级分类到自己的ID',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1激活 2  禁用',
  `dateil` varchar(200) DEFAULT NULL COMMENT '介绍',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of one_article_sort
-- ----------------------------
INSERT INTO `one_article_sort` VALUES ('1', '0', '配送支付', '1', '1', '这是我们关于支付和配送的相关解释文章');
INSERT INTO `one_article_sort` VALUES ('2', '0', '关于我们', '2', '1', '这是关于我们网站工作方面的相关解释文章');
INSERT INTO `one_article_sort` VALUES ('3', '0', '帮助中心', '3', '1', '这是关于疑难的相关解释文章');
INSERT INTO `one_article_sort` VALUES ('4', '1', '支付方式', '1,4', '1', '这个是关于支付方面的相关解释文章');

-- ----------------------------
-- Table structure for `one_cart`
-- ----------------------------
DROP TABLE IF EXISTS `one_cart`;
CREATE TABLE `one_cart` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '购物车id',
  `mid` int(10) unsigned NOT NULL COMMENT '用户id',
  `uid` int(10) unsigned DEFAULT NULL COMMENT '菜单id',
  `buynum` smallint(5) unsigned DEFAULT '0' COMMENT '购买数量',
  `active` tinyint(1) unsigned DEFAULT '1' COMMENT '订单状态1勾选2未勾选',
  `add_time` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of one_cart
-- ----------------------------
INSERT INTO `one_cart` VALUES ('11', '6', '83', '1', '1', '1572334719');
INSERT INTO `one_cart` VALUES ('12', '6', '84', '2', '1', '1572397805');
INSERT INTO `one_cart` VALUES ('37', '8', '83', '1', '1', '1572858464');
INSERT INTO `one_cart` VALUES ('38', '8', '84', '1', '1', '1572858977');
INSERT INTO `one_cart` VALUES ('71', '7', '84', '123', '1', '1574075361');
INSERT INTO `one_cart` VALUES ('72', '10', '0', '5', '1', '1574325674');
INSERT INTO `one_cart` VALUES ('73', '10', '83', '22', '1', '1574559000');
INSERT INTO `one_cart` VALUES ('74', '10', '84', '1', '1', '1574566958');
INSERT INTO `one_cart` VALUES ('75', '5', '84', '2', '1', '1574841279');
INSERT INTO `one_cart` VALUES ('76', '5', '80', '1', '1', '1574855185');

-- ----------------------------
-- Table structure for `one_category`
-- ----------------------------
DROP TABLE IF EXISTS `one_category`;
CREATE TABLE `one_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '菜品分类id',
  `cate_name` varchar(60) DEFAULT NULL COMMENT '菜品分类名',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父分类id',
  `path` varchar(100) DEFAULT NULL COMMENT '从最高级分类到自己的ID',
  `active` tinyint(1) unsigned DEFAULT '1' COMMENT '状态 1激活 2禁用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of one_category
-- ----------------------------
INSERT INTO `one_category` VALUES ('1', '主食', '0', '1', '1');
INSERT INTO `one_category` VALUES ('2', '米', '1', '1,2', '2');
INSERT INTO `one_category` VALUES ('3', '面食', '1', '1,3', '1');
INSERT INTO `one_category` VALUES ('20', '馒头', '3', '1,3,20', '1');
INSERT INTO `one_category` VALUES ('25', '素菜', '0', '25', '1');
INSERT INTO `one_category` VALUES ('32', '66666', '0', '25,32', '1');
INSERT INTO `one_category` VALUES ('33', '3333444', '0', '25,32,33', '1');
INSERT INTO `one_category` VALUES ('34', 'aaaaa', '0', '34', '1');
INSERT INTO `one_category` VALUES ('35', 'bbbbb', '34', '34,35', '1');
INSERT INTO `one_category` VALUES ('36', 'asdadsa', '0', '36', '1');
INSERT INTO `one_category` VALUES ('37', 'ffff', '36', '36,37', '1');
INSERT INTO `one_category` VALUES ('38', 'zzzz', '37', '36,37,38', '1');
INSERT INTO `one_category` VALUES ('39', '2132', '0', '39', '1');
INSERT INTO `one_category` VALUES ('40', '炒面', '3', '1,3,40', '1');
INSERT INTO `one_category` VALUES ('41', '汤面', '3', '1,3,41', '1');
INSERT INTO `one_category` VALUES ('42', '拌面', '3', '1,3,42', '1');
INSERT INTO `one_category` VALUES ('43', '米饭', '2', '1,2,43', '1');
INSERT INTO `one_category` VALUES ('44', '炒米', '2', '1,2,44', '1');

-- ----------------------------
-- Table structure for `one_collection`
-- ----------------------------
DROP TABLE IF EXISTS `one_collection`;
CREATE TABLE `one_collection` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '店铺收藏表id',
  `mid` int(10) unsigned NOT NULL COMMENT '用户表id',
  `sid` int(10) unsigned NOT NULL COMMENT '店铺表id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of one_collection
-- ----------------------------
INSERT INTO `one_collection` VALUES ('89', '5', '1');

-- ----------------------------
-- Table structure for `one_feedback`
-- ----------------------------
DROP TABLE IF EXISTS `one_feedback`;
CREATE TABLE `one_feedback` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT COMMENT '意见表id',
  `mid` int(12) unsigned NOT NULL COMMENT '用户表id  session_id',
  `content` varchar(400) NOT NULL COMMENT '意见内容',
  `add_time` int(12) unsigned NOT NULL,
  `active` tinyint(3) unsigned NOT NULL DEFAULT '2' COMMENT '状态 1:已浏览 2:未浏览',
  `type` enum('投诉','其它','建议') NOT NULL DEFAULT '其它',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of one_feedback
-- ----------------------------
INSERT INTO `one_feedback` VALUES ('1', '5', '“第二届中国无锡水蜜桃开摘节”同时开幕，为期三个月的蜜桃季全面启动。值此京东“618品质狂欢节”之际，中国特产无锡馆限量上线618份8只装精品水蜜桃，61.8元全国包邮限时抢购。为了保证水蜜桃从枝头到达您的手中依旧鲜甜如初，京东采用递送升级服务，从下单到包装全程冷链运输。', '1571716411', '1', '投诉');
INSERT INTO `one_feedback` VALUES ('2', '5', '“第二届中国无锡水蜜桃开摘节”同时开幕，为期三个月的蜜桃季全面启动。值此京东“618品质狂欢节”之际，中国特产无锡馆限量上线618份8只装精品水蜜桃，61.8元全国包邮限时抢购。为了保证水蜜桃从枝头到达您的手中依旧鲜甜如初，京东采用递送升级服务，从下单到包装全程冷链运输。', '1571716411', '2', '建议');

-- ----------------------------
-- Table structure for `one_grade`
-- ----------------------------
DROP TABLE IF EXISTS `one_grade`;
CREATE TABLE `one_grade` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `grade_name` varchar(20) NOT NULL COMMENT '会员等级名称',
  `score` int(10) unsigned NOT NULL COMMENT '对应等级所需的积分',
  `detail` varchar(600) DEFAULT NULL COMMENT '详细描述',
  `member_num` mediumint(8) unsigned DEFAULT NULL COMMENT '对应会员等级人数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of one_grade
-- ----------------------------
INSERT INTO `one_grade` VALUES ('3', '荣耀黄金', '8000', '3333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333', '1');
INSERT INTO `one_grade` VALUES ('4', '英勇青铜', '1000', '33333213132132131', '2');
INSERT INTO `one_grade` VALUES ('5', '不屈白银', '4000', '123213213131', '0');
INSERT INTO `one_grade` VALUES ('7', '华贵铂金', '10000', '213123131', '2');
INSERT INTO `one_grade` VALUES ('8', '璀璨钻石', '30000', '21321321', '1');
INSERT INTO `one_grade` VALUES ('9', '超凡大师', '60000', '12313213131', '0');
INSERT INTO `one_grade` VALUES ('10', '最强王者', '100000', '231313131', '1');
INSERT INTO `one_grade` VALUES ('11', '普通会员', '0', '<strike>sadasda<span style=\"line-height:1.5;\">asdsadasdsadsaasads adadadasdasdasdasdasdasdsaaaaaa aaaaaaaaaaaa<s></s></span></strike>', '2');

-- ----------------------------
-- Table structure for `one_guestbook`
-- ----------------------------
DROP TABLE IF EXISTS `one_guestbook`;
CREATE TABLE `one_guestbook` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT COMMENT '留言表id',
  `sid` int(10) unsigned NOT NULL COMMENT '店铺表---sid',
  `mid` int(10) unsigned NOT NULL COMMENT '会员表---mid',
  `content` varchar(400) NOT NULL COMMENT '留言内容',
  `add_time` int(12) unsigned NOT NULL COMMENT '留言发布时间',
  `active` tinyint(3) unsigned NOT NULL DEFAULT '2' COMMENT '状态 1:已浏览 2:未浏览',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of one_guestbook
-- ----------------------------
INSERT INTO `one_guestbook` VALUES ('19', '272', '5', '哒哒哒哒哒哒多多多多多多', '1573524860', '2');
INSERT INTO `one_guestbook` VALUES ('15', '272', '5', 'wwwwwwwwwwwwwwwwwww', '1573524617', '2');
INSERT INTO `one_guestbook` VALUES ('11', '270', '5', '符神鼎飞丹砂', '1573031028', '1');
INSERT INTO `one_guestbook` VALUES ('12', '270', '7', '123123213', '1573031063', '2');
INSERT INTO `one_guestbook` VALUES ('13', '271', '7', 'xian\n详细信息化搜看美国开出voil海伦凯勒看了看', '1573040929', '2');

-- ----------------------------
-- Table structure for `one_guestbook_reply`
-- ----------------------------
DROP TABLE IF EXISTS `one_guestbook_reply`;
CREATE TABLE `one_guestbook_reply` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT COMMENT '回复表id',
  `Gid` int(12) unsigned NOT NULL COMMENT '留言表id',
  `reply` varchar(400) DEFAULT NULL COMMENT '回复',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of one_guestbook_reply
-- ----------------------------
INSERT INTO `one_guestbook_reply` VALUES ('3', '15', '11');
INSERT INTO `one_guestbook_reply` VALUES ('4', '19', '1111111111111111111111');
INSERT INTO `one_guestbook_reply` VALUES ('5', '13', 'ilkjlkdflkadflk');
INSERT INTO `one_guestbook_reply` VALUES ('6', '11', 'dfas');

-- ----------------------------
-- Table structure for `one_logs`
-- ----------------------------
DROP TABLE IF EXISTS `one_logs`;
CREATE TABLE `one_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '日志id',
  `mid` int(10) unsigned NOT NULL COMMENT '登录用户',
  `user_grade` int(10) unsigned NOT NULL COMMENT '用户等级',
  `operate_datelis` text NOT NULL COMMENT '操作详情',
  `operate_time` int(10) unsigned DEFAULT NULL COMMENT '操作时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of one_logs
-- ----------------------------

-- ----------------------------
-- Table structure for `one_member`
-- ----------------------------
DROP TABLE IF EXISTS `one_member`;
CREATE TABLE `one_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `username` varchar(20) DEFAULT NULL COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '用户密码',
  `avatar` varchar(40) DEFAULT NULL COMMENT '用户头像',
  `avatar_dir` varchar(40) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL COMMENT '邮箱',
  `mobile` char(11) DEFAULT NULL COMMENT '用户手机号码',
  `score` int(10) unsigned DEFAULT '0' COMMENT '个人积分',
  `grade` int(10) unsigned DEFAULT '0' COMMENT '会员等级 1-1~100 普通2-101~500 铜牌3-501~5000银牌  5001以上  金牌',
  `add_time` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1为激活 2为禁用',
  `money` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT '钱',
  `openid` varchar(100) DEFAULT NULL COMMENT 'sqq登录的openid',
  `new_login` int(10) unsigned DEFAULT NULL COMMENT '最新登录时间',
  `old_login` int(10) unsigned DEFAULT NULL COMMENT '上次登陆时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of one_member
-- ----------------------------
INSERT INTO `one_member` VALUES ('1', 'zs', '', null, null, null, '15252763823', '111', '999', '0', '2', null, null, null, null);
INSERT INTO `one_member` VALUES ('2', 'aaa', '', null, null, null, null, '31232131', '1200', '10000000', '1', null, null, null, null);
INSERT INTO `one_member` VALUES ('3', 'Jack', '', null, null, null, null, '4294967295', '3999', '145646548', '1', null, null, null, null);
INSERT INTO `one_member` VALUES ('4', 'rose', '', null, null, null, null, '312321321', '8100', '1234567898', '1', null, null, null, null);
INSERT INTO `one_member` VALUES ('5', '阿伟1', '202cb962ac59075b964b07152d234b70', 'ce4b83014fbe852b023e8e809fba4a2e.jpg', 'upload/2019-11-11/', '578448743@qq.com', '13373954509', '0', '12727', '1571723567', '1', '1000', null, '1574211255', '1574153778');
INSERT INTO `one_member` VALUES ('6', 'awsl', '36f17c3939ac3e7b2fc9396fa8e953ea', null, null, '578448743@qq.com', '13373954509', '2131231331', '29999', '1572167530', '1', '1000', null, '1572510031', '1572509998');
INSERT INTO `one_member` VALUES ('7', 'cpc', '202cb962ac59075b964b07152d234b70', '2da0bb6bf1c1353417bba400d95c6087.gif', 'upload/2019-11-11/', null, '15236430711', '0', '35831', '1572262990', '1', '1000', null, '1574214601', '1574214584');
INSERT INTO `one_member` VALUES ('8', 'andy', '81dc9bdb52d04dc20036dbd8313ed055', null, null, null, '15237150303', '1', '33333333', '1572858406', '1', '1000', null, null, null);
INSERT INTO `one_member` VALUES ('9', 'CHENG', '4297f44b13955235245b2497399d7a93', null, null, null, '', '795', '795', '1573354131', '1', '1000', null, null, null);
INSERT INTO `one_member` VALUES ('10', 'cpcp', '202cb962ac59075b964b07152d234b70', null, null, null, '15236430715', '0', '0', null, '1', null, null, null, null);

-- ----------------------------
-- Table structure for `one_member_msg`
-- ----------------------------
DROP TABLE IF EXISTS `one_member_msg`;
CREATE TABLE `one_member_msg` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '收货信息id',
  `mid` int(10) unsigned NOT NULL COMMENT '用户id',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '收货人昵称',
  `mobile` char(11) NOT NULL COMMENT '收货人手机号',
  `site` varchar(150) NOT NULL DEFAULT '' COMMENT '街道地址',
  `location` varchar(100) NOT NULL DEFAULT '' COMMENT '收货人所在的市，区，镇',
  `active` tinyint(1) unsigned DEFAULT '2' COMMENT '收货地址 1为默认 2非默认',
  `Postcode` int(6) unsigned DEFAULT NULL COMMENT '邮编',
  `update_time` int(10) unsigned DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of one_member_msg
-- ----------------------------
INSERT INTO `one_member_msg` VALUES ('1', '1', '3', '4', '12', '6', '2', null, null);
INSERT INTO `one_member_msg` VALUES ('2', '6', '4', '5', '6', '7', '2', null, null);
INSERT INTO `one_member_msg` VALUES ('3', '7', '地球第一帅', '13233558888', '地球村', '13号', '2', null, null);
INSERT INTO `one_member_msg` VALUES ('4', '6', '5', '6', '7', ' 321', '2', null, null);
INSERT INTO `one_member_msg` VALUES ('5', '5', '阿伟', '13373954509', '陇海西路', '河南省-郑州市-中原区', '2', '727444', '1574930065');
INSERT INTO `one_member_msg` VALUES ('6', '6', '4', '4', '4', '4', '2', null, null);
INSERT INTO `one_member_msg` VALUES ('7', '6', '32', '32', '23', '23', '2', null, null);
INSERT INTO `one_member_msg` VALUES ('17', '7', 'zdy', '15631310222', '马寨', '河南省-郑州市-中原区', '2', '123123', null);
INSERT INTO `one_member_msg` VALUES ('18', '7', 'zdy', '15236455555', '城关街', '河南省-信阳市-市、县级市、县', '2', '465345', null);
INSERT INTO `one_member_msg` VALUES ('19', '7', 'zdy', '15444444455', '马寨', '河南省-郑州市-管城回族区', '2', '555555', null);
INSERT INTO `one_member_msg` VALUES ('22', '5', '请', '13373954509', '123', '河南省-郑州市-中原区', '2', '123123', '1574930065');
INSERT INTO `one_member_msg` VALUES ('23', '9', 'zdy', '15236431452', '寨村后冲组', '河南省-信阳市-城关镇', '2', '465345', null);
INSERT INTO `one_member_msg` VALUES ('24', '9', 'zdy', '15236436542', '几号放假g', '河南省-信阳市-市、县级市、县', '2', '654212', null);
INSERT INTO `one_member_msg` VALUES ('25', '7', 'zdy', '15236430715', '后冲组', '河南省-信阳市-市、县级市、县', '2', '465345', null);
INSERT INTO `one_member_msg` VALUES ('26', '7', 'zdy', '13646464644', '镇攻击力科技理发店库记', '河南省-郑州市-上街区', '2', '645555', null);
INSERT INTO `one_member_msg` VALUES ('27', '7', 'zdy', '13646464644', '镇攻击力科技理发店库记', '河南省-郑州市-上街区', '2', '645555', null);
INSERT INTO `one_member_msg` VALUES ('28', '7', 'zdy', '19565654646', '后空间方宇杰后方可', '河南省-郑州市-中原区', '2', '333333', null);
INSERT INTO `one_member_msg` VALUES ('29', '7', '地沟油', '15236430715', '河南省信阳市商城县双椿铺镇陈寨村后冲组\n河南省信阳市商城县双椿铺镇陈寨村后冲组', '河南省-信阳市-市、县级市、县', '2', '465345', null);
INSERT INTO `one_member_msg` VALUES ('30', '7', '地沟油', '15236430715', '河南省信阳市商城县双椿铺镇陈寨村后冲组\n河南省信阳市商城县双椿铺镇陈寨村后冲组', '河南省-信阳市-市、县级市、县', '2', '465345', null);
INSERT INTO `one_member_msg` VALUES ('31', '7', 'abcdefg', '15236430715', '河南省信阳市商城县双椿铺镇陈寨村后冲组\n河南省信阳市商城县双椿铺镇陈寨村后冲组', '河南省-信阳市-市、县级市、县', '2', '465345', null);
INSERT INTO `one_member_msg` VALUES ('32', '7', 'abcdefg', '15236430715', '河南省信阳市商城县双椿铺镇陈寨村后冲组\n河南省信阳市商城县双椿铺镇陈寨村后冲组', '河南省-信阳市-市、县级市、县', '2', '465345', null);
INSERT INTO `one_member_msg` VALUES ('33', '7', '1231', '15236430715', '河南省信阳市商城县双椿铺镇陈寨村后冲组\n河南省信阳市商城县双椿铺镇陈寨村后冲组', '河南省-信阳市-市、县级市、县', '2', '465345', null);
INSERT INTO `one_member_msg` VALUES ('34', '7', '', '15236430715', '河南省信阳市商城县双椿铺镇陈寨村后冲组\n河南省信阳市商城县双椿铺镇陈寨村后冲组', '河南省-信阳市-市、县级市、县', '2', '465345', null);
INSERT INTO `one_member_msg` VALUES ('35', '7', '', '15236430715', '河南省信阳市商城县双椿铺镇陈寨村后冲组\n河南省信阳市商城县双椿铺镇陈寨村后冲组', '河南省-信阳市-市、县级市、县', '2', '465345', null);
INSERT INTO `one_member_msg` VALUES ('36', '7', 'sadf', '15236430715', 'adf f', '河南省-信阳市-市、县级市、县', '2', '465345', null);
INSERT INTO `one_member_msg` VALUES ('37', '7', '地沟油', '15236430715', '河南省信阳', '河南省-信阳市-市、县级市、县', '2', '465345', null);
INSERT INTO `one_member_msg` VALUES ('38', '7', '地沟油', '15236430715', '寨村后冲组', '河南省-信阳市-市、县级市、县', '2', '465345', null);
INSERT INTO `one_member_msg` VALUES ('39', '7', '', '15236430715', '城县双椿铺镇陈寨', '河南省-信阳市-市、县级市、县', '2', '465345', null);
INSERT INTO `one_member_msg` VALUES ('40', '7', 'zdy', '15236430715', 'asdfjl kgoas', '河南省-信阳市-市、县级市、县', '2', '111111', null);
INSERT INTO `one_member_msg` VALUES ('72', '5', 'zs', '17803903618', '郑州科技学院', '河南省-郑州市-中原区', '1', null, '1574930065');

-- ----------------------------
-- Table structure for `one_menu`
-- ----------------------------
DROP TABLE IF EXISTS `one_menu`;
CREATE TABLE `one_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '菜单id',
  `menu_name` varchar(90) NOT NULL COMMENT '菜名',
  `key_words` varchar(90) DEFAULT NULL COMMENT '搜索关键字',
  `cid` int(10) unsigned NOT NULL COMMENT '菜品分类ID',
  `sid` int(10) unsigned NOT NULL COMMENT '店铺id',
  `image_dir` varchar(40) DEFAULT NULL COMMENT '商品主图存放目录',
  `image` varchar(40) DEFAULT NULL COMMENT '商品主图文件名',
  `or_price` smallint(5) unsigned DEFAULT '0' COMMENT '原价',
  `price` smallint(5) unsigned DEFAULT '0' COMMENT '现价',
  `salde_num` int(10) unsigned DEFAULT '0' COMMENT '销量',
  `eval_num` int(10) unsigned DEFAULT '0' COMMENT '评价数量',
  `update_time` int(10) unsigned DEFAULT NULL COMMENT '更新时间',
  `add_time` int(10) unsigned DEFAULT NULL COMMENT '上架时间',
  `detail` varchar(450) DEFAULT NULL COMMENT '菜品详情',
  `active` tinyint(1) unsigned DEFAULT '1' COMMENT '商品状态1上架2下架',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=74132 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of one_menu
-- ----------------------------
INSERT INTO `one_menu` VALUES ('2', '阿斯蒂芬', null, '20', '270', 'upload/2019-11-07/', 'ddb7660d5b9c5ad84ba1a68bd55f4120.gif', '123', '400', '123', '45', '1574039023', '1429967295', '<s>dasdaasdsa</s>', '1');
INSERT INTO `one_menu` VALUES ('83', '蒂芬', '6666', '20', '1', 'upload/2019-10-24/', '66dae7eee10ca4dfee418df2baa424dc.gif', '666', '6666', '23148', '456', '1574039061', null, '66646', '1');
INSERT INTO `one_menu` VALUES ('84', '231', '213', '20', '270', 'upload/2019-10-24/', 'c182b9d8cc54d756cae7e3446f654bba.gif', '213', '123', '327', '444', '1574039023', null, 'https://img13.360buyimg.com/cms/jfs/t1/62964/9/10083/667577/5d7b1c64Ee24aac51/efc8083197de5b21.jpg\"', '1');
INSERT INTO `one_menu` VALUES ('79', '5555', null, '20', '270', 'upload/2019-10-30/', '3db58f2cb29fc0437a174d743eb19996.jpg', '132', '312', '12', '132', '1574039023', null, '32111大盛世嫡妃', '1');
INSERT INTO `one_menu` VALUES ('80', '444', null, '20', '1', 'upload/2019-10-30/', '3db58f2cb29fc0437a174d743eb19996.jpg', '444', '444', '45', '0', '1574039061', null, '23123131231', '1');
INSERT INTO `one_menu` VALUES ('3', 'fdasf', '11', '20', '1', 'upload/2019-10-30/', '3db58f2cb29fc0437a174d743eb19996.jpg', '213', '354', '0', '0', '1574039061', '1429967295', '1429967295', '1');
INSERT INTO `one_menu` VALUES ('82', '444', null, '20', '12', 'upload/2019-10-30/', '3db58f2cb29fc0437a174d743eb19996.jpg', '444', '444', '0', '0', null, null, '23123131231', '2');
INSERT INTO `one_menu` VALUES ('1', 'jhfsd', null, '20', '274', 'upload/2019-10-30/', '3db58f2cb29fc0437a174d743eb19996.jpg', '111', '123', '0', '0', '1574216961', '1429967295', '1429967295', '2');
INSERT INTO `one_menu` VALUES ('86', '一条鱼', '鱼', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '16', '456', '2', '0', '1574039023', '1572854197', '123123', '1');
INSERT INTO `one_menu` VALUES ('0', '酸辣土豆丝', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('89', '酸辣土豆丝', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('90', '酸辣回锅肉', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('91', '酸辣鱼', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('92', '酸辣火锅', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('93', '炒米', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('94', '老干妈炒米', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('95', '酸辣土豆丝', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('96', '鱼火锅', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('97', '鸡蛋炒米', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('98', '香肠炒米', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('99', '酸辣土豆丝', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('100', '快乐热狗', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('101', '酸辣土豆丝', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('102', '烧鸡', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('103', '咖啡liupai6', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('104', '酸辣土豆丝', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('105', '烧鱼', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('106', '酸辣土豆丝', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('74', '酸辣土豆丝', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('1087', '土豆片', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('1096', '土豆饼', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('110', '酸辣土豆丝', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('88', '回锅肉', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('112', '火锅', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('787', '酸辣土豆丝', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('114', '酸辣土豆丝', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('11578', '罗布丝', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('11668', '酸辣土豆丝4', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('1174', '酸辣土豆丝3', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('7', '酸辣土豆丝2', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('119', '酸辣土豆丝1', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('75', '虎皮鸡蛋', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('121', '大师傅特制', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('78', '酸辣土豆丝', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('123', '秘籍炒菜', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('7563', '鸡蛋', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('234', '豆卷', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('126', '炒河粉', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('567', '酸辣土豆丝132', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('128', '四份豆芽', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('1221', '牛肉火锅', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('74130', '火锅调料单买', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('865', '炒刀削', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('457', '水豆腐333', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('133', '牛排', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('785', '鸡排', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('874', '汤面', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('13645', '酸烧豆腐', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('343', '酸辣土豆丝', '土豆，炒菜', '20', '270', 'upload/2019-11-04/', '132bee85b37fdc3505ce8c166eaf4263.jpg', '12', '9', '10', '5', '1574039023', '1572854197', '精选土豆，小心切丝，大火爆炒', '1');
INSERT INTO `one_menu` VALUES ('74131', '红烧猪蹄', '猪蹄，红烧，猪', '44', '270', 'upload/2019-11-27/', 'd6114dfbbd1ac9b3723a7406a8a66b29.jpg', '40', '29', '0', '0', null, '1574854444', '美味又好吃，富含胶原蛋白，美容养颜绝佳食品', '1');

-- ----------------------------
-- Table structure for `one_menu_comment`
-- ----------------------------
DROP TABLE IF EXISTS `one_menu_comment`;
CREATE TABLE `one_menu_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '评论id',
  `oid` int(10) unsigned NOT NULL COMMENT '订单id',
  `uid` int(10) unsigned NOT NULL COMMENT '订单商品id',
  `sid` int(10) unsigned DEFAULT NULL COMMENT '店铺id',
  `mid` int(10) unsigned NOT NULL COMMENT '用户id',
  `add_time` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `detail` text COMMENT '评论详情',
  `fenshu` float(2,1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of one_menu_comment
-- ----------------------------
INSERT INTO `one_menu_comment` VALUES ('19', '120', '83', null, '5', '1574239847', 'ccccccccccccccccc', '4.5');
INSERT INTO `one_menu_comment` VALUES ('6', '16', '84', null, '5', '1574162570', '我我我我我我', '3.0');
INSERT INTO `one_menu_comment` VALUES ('11', '6', '84', null, '5', '1574162946', '啊啊啊啊啊啊', '3.0');
INSERT INTO `one_menu_comment` VALUES ('3', '15', '3', '270', '5', '1574231984', '456465654645654', '3.5');
INSERT INTO `one_menu_comment` VALUES ('7', '18', '83', null, '5', '1574162825', '呜呜呜呜呜呜呜撒大声地撒多撒大所多撒多撒大所多撒多撒多撒多撒大所多撒大所大所大所大所', '3.0');
INSERT INTO `one_menu_comment` VALUES ('10', '13', '84', null, '5', '1574162917', '的点点滴滴', '3.5');

-- ----------------------------
-- Table structure for `one_menu_comment_reply`
-- ----------------------------
DROP TABLE IF EXISTS `one_menu_comment_reply`;
CREATE TABLE `one_menu_comment_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '回复id',
  `mc_id` int(10) unsigned NOT NULL COMMENT '评论id',
  `mid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id   0为店铺',
  `reply` varchar(600) DEFAULT NULL COMMENT '回复内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of one_menu_comment_reply
-- ----------------------------
INSERT INTO `one_menu_comment_reply` VALUES ('1', '1', '2', '3333');
INSERT INTO `one_menu_comment_reply` VALUES ('2', '2', '3', '444');
INSERT INTO `one_menu_comment_reply` VALUES ('3', '7', '5', '44444444发生发发发顺丰萨法司法所发发敖德萨多撒多撒多撒多撒多撒多撒多撒大所大所多撒多撒');
INSERT INTO `one_menu_comment_reply` VALUES ('4', '3', '5', '这是一个坑');
INSERT INTO `one_menu_comment_reply` VALUES ('5', '19', '5', '这是一个大坑');

-- ----------------------------
-- Table structure for `one_menu_image`
-- ----------------------------
DROP TABLE IF EXISTS `one_menu_image`;
CREATE TABLE `one_menu_image` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '图片id',
  `uid` int(10) unsigned NOT NULL COMMENT '对应菜品id',
  `image` varchar(40) DEFAULT NULL COMMENT '副图文件名',
  `image_dir` varchar(40) DEFAULT NULL COMMENT '副图存放目录',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of one_menu_image
-- ----------------------------
INSERT INTO `one_menu_image` VALUES ('1', '1', 'd6b8960f8ba32c34e958a3859c7af1ee5.jpg', 'upload/2019-10-22/');
INSERT INTO `one_menu_image` VALUES ('2', '1', '3a079173c8177d456031bfa3b68ef940gif1.gif', 'upload/2019-10-22/');
INSERT INTO `one_menu_image` VALUES ('3', '78', 'ef3c79da12b25160d13835848ca7c10a.jpg', 'upload/2019-10-23/');
INSERT INTO `one_menu_image` VALUES ('4', '79', '0e1d2299ce9b6db0a236f594d1de1379.gif', 'upload/2019-10-23/');
INSERT INTO `one_menu_image` VALUES ('5', '79', '2dd12e87c7b4cc24cfe71c50b0ba2111.jpg', 'upload/2019-10-23/');
INSERT INTO `one_menu_image` VALUES ('6', '78', '4738cd411533702e69eb1c2584286a28.gif', 'upload/2019-10-23/');
INSERT INTO `one_menu_image` VALUES ('7', '78', '25aac81a0fd83ed47c8af20c258d45fe.gif', 'upload/2019-10-23/');
INSERT INTO `one_menu_image` VALUES ('8', '78', '49ef578a9be31e9ad50f11c2182071a7.gif', 'upload/2019-10-23/');
INSERT INTO `one_menu_image` VALUES ('9', '78', '3862c83703b65ad229dc44681a913603.gif', 'upload/2019-10-23/');
INSERT INTO `one_menu_image` VALUES ('10', '81', '810985f1cff6bef719f4ff0f61ced077.gif', 'upload/2019-10-23/');
INSERT INTO `one_menu_image` VALUES ('11', '83', 'e4c7e71cc514cfa24f2bef6a93751a4f.jpg', 'upload/2019-10-24/');
INSERT INTO `one_menu_image` VALUES ('12', '83', '967c11210854bab8454029e0dedd8ce6.gif', 'upload/2019-10-24/');
INSERT INTO `one_menu_image` VALUES ('13', '84', '690c2de91d765b5f23ac43ca85e7bded.jpg', 'upload/2019-10-24/');
INSERT INTO `one_menu_image` VALUES ('14', '2', 'a68d35043345ce173cb56a8a4f18701c.gif', 'upload/2019-11-07/');
INSERT INTO `one_menu_image` VALUES ('15', '2', '100614b2140ca133ce51f2caf1b8da2c.gif', 'upload/2019-11-07/');

-- ----------------------------
-- Table structure for `one_orders`
-- ----------------------------
DROP TABLE IF EXISTS `one_orders`;
CREATE TABLE `one_orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单id',
  `mid` int(10) unsigned NOT NULL COMMENT '用户id',
  `orders_num` varchar(20) DEFAULT NULL COMMENT '订单编号',
  `orders_price` int(10) unsigned DEFAULT NULL COMMENT '订单去红包后的金额',
  `orders_red` varchar(20) DEFAULT '0,0' COMMENT '订单红包',
  `msg_id` int(10) unsigned DEFAULT NULL COMMENT '订单对应的用户的地址',
  `add_time` int(10) unsigned DEFAULT NULL COMMENT '订单生成时间',
  `active` tinyint(1) unsigned DEFAULT '1' COMMENT '订单状态1未付款2已付款3已发货4已签收5已评论6已取消7已退款',
  `detail` varchar(150) DEFAULT NULL COMMENT '订单详情',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of one_orders
-- ----------------------------
INSERT INTO `one_orders` VALUES ('1', '2', '10', '231', '0,0', '2', '111111', '1', '231');
INSERT INTO `one_orders` VALUES ('2', '2', '1', '333', '0,0', '2', '42949645', '4', '213');
INSERT INTO `one_orders` VALUES ('3', '6', '11', '666', '0,0', '2', '1572857795', '3', '123');
INSERT INTO `one_orders` VALUES ('6', '5', '20191030101318937594', '6666', '0,0', '5', '1572401598', '5', null);
INSERT INTO `one_orders` VALUES ('13', '5', '20191030102909568473', '123', '0,0', '2', '1572402549', '5', null);
INSERT INTO `one_orders` VALUES ('15', '5', '20191030102927854988', '6666', '0,0', '2', '1572402567', '5', null);
INSERT INTO `one_orders` VALUES ('16', '5', '20191030103132301910', '123', '0,0', '5', '1572402692', '6', '666666');
INSERT INTO `one_orders` VALUES ('18', '5', '20191030103200851969', '6666', '0,0', '2', '1572402720', '5', null);
INSERT INTO `one_orders` VALUES ('19', '7', '20191030103435237134', '123', '0,0', '2', '1572402875', '3', null);
INSERT INTO `one_orders` VALUES ('21', '7', '20191030103852367646', '6666', '0,0', '2', '1572403132', '2', null);
INSERT INTO `one_orders` VALUES ('22', '7', '20191030103921522318', '6666', '0,0', '2', '1572403161', '2', null);
INSERT INTO `one_orders` VALUES ('24', '7', '20191030104152564334', '6666', '0,0', '2', '1572403312', '2', null);
INSERT INTO `one_orders` VALUES ('25', '7', '20191030104458273115', '123', '0,0', '1', '1572403498', '3', null);
INSERT INTO `one_orders` VALUES ('26', '7', '20191030104554937129', '123', '0,0', '1', '1572403554', '3', null);
INSERT INTO `one_orders` VALUES ('27', '7', '20191030105116983572', '6789', '0,0', '2', '1572403876', '3', null);
INSERT INTO `one_orders` VALUES ('29', '7', '20191030105318549144', '6666', '0,0', '2', '1572403998', '1', null);
INSERT INTO `one_orders` VALUES ('31', '7', '20191030105429899560', '123', '0,0', '2', '1572404069', '1', null);
INSERT INTO `one_orders` VALUES ('33', '7', '20191030110300495931', '19998', '0,0', '3', '1572404580', '1', null);
INSERT INTO `one_orders` VALUES ('34', '7', '20191030110353783164', '6666', '0,0', '3', '1572404633', '1', null);
INSERT INTO `one_orders` VALUES ('36', '7', '20191030110515715184', '6666', '0,0', '3', '1572404715', '1', null);
INSERT INTO `one_orders` VALUES ('37', '7', '20191030110834578246', '123', '0,0', '3', '1572404914', '1', null);
INSERT INTO `one_orders` VALUES ('38', '7', '20191104165635957401', '10541', '0,0', '3', '1572857795', '1', null);
INSERT INTO `one_orders` VALUES ('39', '7', '20191105110332308545', '1476', '0,0', '3', '1572923012', '1', null);
INSERT INTO `one_orders` VALUES ('41', '7', '20191105160159101590', '123', '0,0', '3', '1572940919', '1', null);
INSERT INTO `one_orders` VALUES ('44', '7', '20191105190253558703', '123', '0,0', '3', '1572951773', '3', null);
INSERT INTO `one_orders` VALUES ('47', '7', '20191105202629158326', '5667', '0,0', '2', '1572956789', '2', null);
INSERT INTO `one_orders` VALUES ('48', '7', '20191106090005915777', '192', '0,0', '2', '1573002005', '3', null);
INSERT INTO `one_orders` VALUES ('49', '7', '20191106090711179714', '6658', '0,0', '3', '1573002431', '2', null);
INSERT INTO `one_orders` VALUES ('52', '5', '20191106171739661751', '6642', '1,24', '2', '1573357569', '4', null);
INSERT INTO `one_orders` VALUES ('60', '7', '20191106173008875850', '6658', '1,8', '2', '1573032608', '2', null);
INSERT INTO `one_orders` VALUES ('62', '7', '20191106173140670876', '6666', '0,0', '2', '1573032700', '2', null);
INSERT INTO `one_orders` VALUES ('63', '7', '20191106173242469513', '123', '0,0', '3', '1573032762', '3', null);
INSERT INTO `one_orders` VALUES ('78', '9', '20191110114609692914', '1296', '0,0', null, '1573357569', '5', null);
INSERT INTO `one_orders` VALUES ('79', '9', '20191110114652996843', '6666', '0,0', '2', '1573357612', '5', null);
INSERT INTO `one_orders` VALUES ('80', '7', '20191111085318816052', '801', '1,24', '20', '1573433598', '7', '777777777');
INSERT INTO `one_orders` VALUES ('81', '7', '20191111090532402910', '368', '1,32', '18', '1573434332', '1', null);
INSERT INTO `one_orders` VALUES ('82', '7', '20191111092104552254', '2583', '1,32', '3', '1573435264', '4', null);
INSERT INTO `one_orders` VALUES ('90', '7', '20191111102952418752', '13332', '0,0', '18', '1573439392', '4', null);
INSERT INTO `one_orders` VALUES ('96', '7', '20191111113440491647', '456', '0,0', '18', '1573443280', '1', null);
INSERT INTO `one_orders` VALUES ('98', '7', '20191111113854781730', '123', '0,0', '18', '1573443534', '1', null);
INSERT INTO `one_orders` VALUES ('102', '7', '20191111113959260355', '444', '0,0', '18', '1573443599', '6', null);
INSERT INTO `one_orders` VALUES ('107', '7', '20191111150125443879', '444', '0,0', '18', '1573455685', '1', null);
INSERT INTO `one_orders` VALUES ('110', '7', '20191111185621632641', '448', '2,8', '26', '1573469781', '1', null);
INSERT INTO `one_orders` VALUES ('114', '7', '20191111190049718683', '6666', '0,0', '18', '1573470049', '1', null);
INSERT INTO `one_orders` VALUES ('118', '5', '20191119185705264528', '13332', '0,0', '5', '1574161025', '4', null);
INSERT INTO `one_orders` VALUES ('119', '5', '20191119193345701572', '123', '0,0', '5', '1574163225', '3', null);
INSERT INTO `one_orders` VALUES ('120', '5', '20191119193404839980', '6666', '0,0', '5', '1574163244', '5', null);
INSERT INTO `one_orders` VALUES ('121', '5', '20191119193415179279', '6666', '0,0', '5', '1574163255', '1', null);

-- ----------------------------
-- Table structure for `one_orders_menu`
-- ----------------------------
DROP TABLE IF EXISTS `one_orders_menu`;
CREATE TABLE `one_orders_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单菜品id',
  `oid` int(10) unsigned NOT NULL COMMENT '订单id',
  `uid` int(10) unsigned NOT NULL COMMENT '菜品ID',
  `num` smallint(5) unsigned DEFAULT '0' COMMENT '订购数量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of one_orders_menu
-- ----------------------------
INSERT INTO `one_orders_menu` VALUES ('3', '1', '82', '112');
INSERT INTO `one_orders_menu` VALUES ('4', '2', '84', '11');
INSERT INTO `one_orders_menu` VALUES ('5', '3', '2', '213');
INSERT INTO `one_orders_menu` VALUES ('6', '5', '2', '11');
INSERT INTO `one_orders_menu` VALUES ('7', '5', '83', '17');
INSERT INTO `one_orders_menu` VALUES ('9', '6', '84', '32');
INSERT INTO `one_orders_menu` VALUES ('11', '13', '84', '1');
INSERT INTO `one_orders_menu` VALUES ('12', '15', '83', '1');
INSERT INTO `one_orders_menu` VALUES ('13', '16', '84', '1');
INSERT INTO `one_orders_menu` VALUES ('14', '18', '83', '1');
INSERT INTO `one_orders_menu` VALUES ('15', '19', '84', '1');
INSERT INTO `one_orders_menu` VALUES ('17', '22', '83', '1');
INSERT INTO `one_orders_menu` VALUES ('18', '24', '83', '1');
INSERT INTO `one_orders_menu` VALUES ('19', '25', '84', '1');
INSERT INTO `one_orders_menu` VALUES ('20', '26', '84', '1');
INSERT INTO `one_orders_menu` VALUES ('21', '27', '84', '1');
INSERT INTO `one_orders_menu` VALUES ('22', '27', '83', '1');
INSERT INTO `one_orders_menu` VALUES ('23', '29', '83', '1');
INSERT INTO `one_orders_menu` VALUES ('24', '31', '84', '1');
INSERT INTO `one_orders_menu` VALUES ('26', '33', '83', '3');
INSERT INTO `one_orders_menu` VALUES ('27', '34', '83', '1');
INSERT INTO `one_orders_menu` VALUES ('28', '36', '83', '1');
INSERT INTO `one_orders_menu` VALUES ('29', '37', '84', '1');
INSERT INTO `one_orders_menu` VALUES ('30', '38', '84', '25');
INSERT INTO `one_orders_menu` VALUES ('31', '38', '2', '2');
INSERT INTO `one_orders_menu` VALUES ('32', '38', '83', '1');
INSERT INTO `one_orders_menu` VALUES ('33', '39', '84', '12');
INSERT INTO `one_orders_menu` VALUES ('34', '41', '84', '1');
INSERT INTO `one_orders_menu` VALUES ('35', '44', '84', '1');
INSERT INTO `one_orders_menu` VALUES ('37', '47', '83', '1');
INSERT INTO `one_orders_menu` VALUES ('38', '48', '84', '2');
INSERT INTO `one_orders_menu` VALUES ('39', '49', '83', '1');
INSERT INTO `one_orders_menu` VALUES ('41', '52', '83', '1');
INSERT INTO `one_orders_menu` VALUES ('48', '60', '83', '1');
INSERT INTO `one_orders_menu` VALUES ('49', '62', '83', '1');
INSERT INTO `one_orders_menu` VALUES ('50', '63', '84', '1');
INSERT INTO `one_orders_menu` VALUES ('77', '78', '87', '6');
INSERT INTO `one_orders_menu` VALUES ('78', '78', '84', '10');
INSERT INTO `one_orders_menu` VALUES ('79', '79', '83', '1');
INSERT INTO `one_orders_menu` VALUES ('80', '80', '84', '3');
INSERT INTO `one_orders_menu` VALUES ('81', '80', '86', '1');
INSERT INTO `one_orders_menu` VALUES ('82', '81', '2', '1');
INSERT INTO `one_orders_menu` VALUES ('83', '82', '2', '5');
INSERT INTO `one_orders_menu` VALUES ('84', '82', '84', '5');
INSERT INTO `one_orders_menu` VALUES ('92', '90', '83', '2');
INSERT INTO `one_orders_menu` VALUES ('93', '96', '86', '1');
INSERT INTO `one_orders_menu` VALUES ('94', '98', '84', '1');
INSERT INTO `one_orders_menu` VALUES ('95', '102', '80', '1');
INSERT INTO `one_orders_menu` VALUES ('96', '107', '80', '1');
INSERT INTO `one_orders_menu` VALUES ('97', '110', '86', '1');
INSERT INTO `one_orders_menu` VALUES ('98', '114', '83', '1');
INSERT INTO `one_orders_menu` VALUES ('99', '117', '84', '4');
INSERT INTO `one_orders_menu` VALUES ('100', '118', '83', '2');
INSERT INTO `one_orders_menu` VALUES ('101', '119', '84', '1');
INSERT INTO `one_orders_menu` VALUES ('102', '120', '83', '1');
INSERT INTO `one_orders_menu` VALUES ('103', '121', '83', '1');

-- ----------------------------
-- Table structure for `one_redpacket`
-- ----------------------------
DROP TABLE IF EXISTS `one_redpacket`;
CREATE TABLE `one_redpacket` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mid` int(10) unsigned DEFAULT NULL COMMENT '红包持有人id',
  `value` float(5,2) unsigned DEFAULT NULL COMMENT '红包价值',
  `type` tinyint(1) unsigned DEFAULT NULL COMMENT '红包类型1为无门楷2为满减',
  `add_time` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `end_time` int(10) unsigned DEFAULT NULL COMMENT '过期时间',
  `active` tinyint(1) unsigned DEFAULT '1' COMMENT '红包状态 1为未使用2为已使用3为已过期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of one_redpacket
-- ----------------------------
INSERT INTO `one_redpacket` VALUES ('29', '7', '8.00', '1', '1572855441', '1573460241', '3');
INSERT INTO `one_redpacket` VALUES ('30', '7', '8.00', '1', '1572855452', '1573460252', '3');
INSERT INTO `one_redpacket` VALUES ('31', '7', '8.00', '1', '1572856600', '1573461400', '3');
INSERT INTO `one_redpacket` VALUES ('32', '7', '999.00', '1', '1572856739', '1573461539', '2');
INSERT INTO `one_redpacket` VALUES ('33', '7', '8.00', '1', '1572856903', '1573461703', '3');
INSERT INTO `one_redpacket` VALUES ('34', '7', '8.00', '1', '1572857075', '1573461875', '3');
INSERT INTO `one_redpacket` VALUES ('35', '7', '8.00', '1', '1572857981', '1573462781', '3');
INSERT INTO `one_redpacket` VALUES ('36', '8', '8.00', '1', '1572858561', '1573463361', '3');
INSERT INTO `one_redpacket` VALUES ('37', '7', '8.00', '1', '1572916317', '1573521117', '3');
INSERT INTO `one_redpacket` VALUES ('38', '7', '8.00', '1', '1572916399', '1573521199', '3');
INSERT INTO `one_redpacket` VALUES ('39', '7', '8.00', '1', '1572916447', '1573521247', '3');
INSERT INTO `one_redpacket` VALUES ('40', '7', '8.00', '1', '1572916487', '1573521287', '2');
INSERT INTO `one_redpacket` VALUES ('41', '7', '8.00', '1', '1572916512', '1573521312', '3');
INSERT INTO `one_redpacket` VALUES ('42', '7', '8.00', '1', '1572916628', '1573521428', '3');
INSERT INTO `one_redpacket` VALUES ('43', '7', '8.00', '1', '1572916717', '1573521517', '2');
INSERT INTO `one_redpacket` VALUES ('44', '7', '8.00', '2', '1572917641', '1573522441', '3');
INSERT INTO `one_redpacket` VALUES ('45', '7', '8.00', '2', '1572917641', '1573522441', '2');
INSERT INTO `one_redpacket` VALUES ('46', '7', '8.00', '1', '1572918516', '1573523316', '2');
INSERT INTO `one_redpacket` VALUES ('47', '7', '8.00', '1', '1572918546', '1573523346', '3');
INSERT INTO `one_redpacket` VALUES ('48', '5', '32.00', '2', '1572954803', '1573559603', '3');
INSERT INTO `one_redpacket` VALUES ('49', '5', '32.00', '2', '1572954803', '1573559603', '3');
INSERT INTO `one_redpacket` VALUES ('50', '5', '32.00', '2', '1572954803', '1573559603', '3');
INSERT INTO `one_redpacket` VALUES ('51', '5', '32.00', '2', '1572954803', '1573559603', '3');
INSERT INTO `one_redpacket` VALUES ('52', '7', '24.00', '1', '1573002569', '1573607369', '3');
INSERT INTO `one_redpacket` VALUES ('53', '7', '24.00', '1', '1573002569', '1573607369', '3');
INSERT INTO `one_redpacket` VALUES ('54', '7', '24.00', '1', '1573002569', '1573607369', '2');
INSERT INTO `one_redpacket` VALUES ('55', '7', '24.00', '1', '1573002569', '1573607369', '2');
INSERT INTO `one_redpacket` VALUES ('56', '7', '24.00', '1', '1573002569', '1573607369', '3');
INSERT INTO `one_redpacket` VALUES ('57', '7', '8.00', '1', '1573024271', '1573629071', '3');
INSERT INTO `one_redpacket` VALUES ('58', '7', '32.00', '1', '1573434129', '1574038929', '2');
INSERT INTO `one_redpacket` VALUES ('59', '7', '32.00', '1', '1573434129', '1574038929', '3');
INSERT INTO `one_redpacket` VALUES ('60', '7', '32.00', '1', '1573434129', '1574038929', '3');
INSERT INTO `one_redpacket` VALUES ('61', '7', '32.00', '1', '1573434129', '1574038929', '3');
INSERT INTO `one_redpacket` VALUES ('62', '7', '32.00', '1', '1573434129', '1574038929', '3');
INSERT INTO `one_redpacket` VALUES ('63', '7', '32.00', '1', '1573434129', '1574038929', '3');
INSERT INTO `one_redpacket` VALUES ('64', '7', '32.00', '1', '1573434129', '1574038929', '3');
INSERT INTO `one_redpacket` VALUES ('65', '7', '32.00', '1', '1573434129', '1574038929', '3');
INSERT INTO `one_redpacket` VALUES ('66', '7', '32.00', '1', '1573434129', '1574038929', '3');
INSERT INTO `one_redpacket` VALUES ('67', '7', '32.00', '1', '1573434129', '1574038929', '3');
INSERT INTO `one_redpacket` VALUES ('68', '7', '32.00', '1', '1573434130', '1574038930', '3');
INSERT INTO `one_redpacket` VALUES ('69', '7', '32.00', '1', '1573434130', '1574038930', '3');
INSERT INTO `one_redpacket` VALUES ('70', '7', '32.00', '1', '1573434130', '1574038930', '3');
INSERT INTO `one_redpacket` VALUES ('71', '7', '32.00', '1', '1573434130', '1574038930', '3');
INSERT INTO `one_redpacket` VALUES ('72', '7', '32.00', '1', '1573434130', '1574038930', '3');
INSERT INTO `one_redpacket` VALUES ('73', '7', '32.00', '1', '1573434130', '1574038930', '3');
INSERT INTO `one_redpacket` VALUES ('74', '7', '32.00', '1', '1573434130', '1574038930', '3');
INSERT INTO `one_redpacket` VALUES ('75', '7', '32.00', '1', '1573434130', '1574038930', '3');
INSERT INTO `one_redpacket` VALUES ('76', '5', '32.00', '1', '1573434130', '1574038930', '2');
INSERT INTO `one_redpacket` VALUES ('77', '5', '32.00', '1', '1573434130', '1574038930', '3');
INSERT INTO `one_redpacket` VALUES ('78', '5', '8.00', '1', '1573472312', '1574077112', '3');
INSERT INTO `one_redpacket` VALUES ('79', '5', '8.00', '1', '1573472312', '1574077112', '3');
INSERT INTO `one_redpacket` VALUES ('81', '5', '8.00', '1', '1574234727', '1574839527', '1');
INSERT INTO `one_redpacket` VALUES ('82', '5', '8.00', '1', '1574234756', '1574839556', '1');
INSERT INTO `one_redpacket` VALUES ('83', '5', '8.00', '1', '1574234767', '1574839567', '1');
INSERT INTO `one_redpacket` VALUES ('84', '5', '8.00', '1', '1574234785', '1574839585', '1');
INSERT INTO `one_redpacket` VALUES ('85', '5', '8.00', '1', '1574234794', '1574839594', '1');
INSERT INTO `one_redpacket` VALUES ('86', '5', '8.00', '1', '1574234869', '1574839669', '1');
INSERT INTO `one_redpacket` VALUES ('87', '5', '8.00', '1', '1574234880', '1574839680', '1');
INSERT INTO `one_redpacket` VALUES ('88', '5', '8.00', '1', '1574235002', '1574839802', '1');
INSERT INTO `one_redpacket` VALUES ('89', '5', '8.00', '1', '1574235037', '1574839837', '1');
INSERT INTO `one_redpacket` VALUES ('90', '5', '8.00', '1', '1574235037', '1574839837', '1');
INSERT INTO `one_redpacket` VALUES ('91', '5', '8.00', '1', '1574235053', '1574839853', '1');
INSERT INTO `one_redpacket` VALUES ('92', '5', '8.00', '1', '1574235066', '1574839866', '1');
INSERT INTO `one_redpacket` VALUES ('93', '5', '24.00', '2', '1574235096', '1574839896', '1');
INSERT INTO `one_redpacket` VALUES ('94', '5', '8.00', '1', '1574235375', '1574840175', '1');
INSERT INTO `one_redpacket` VALUES ('95', '5', '16.00', '2', '1574235393', '1574840193', '1');

-- ----------------------------
-- Table structure for `one_shop`
-- ----------------------------
DROP TABLE IF EXISTS `one_shop`;
CREATE TABLE `one_shop` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '店铺id',
  `sm_id` int(10) unsigned NOT NULL COMMENT '商家持有人id',
  `shop_name` varchar(60) NOT NULL COMMENT '店铺名',
  `logo` varchar(200) DEFAULT NULL COMMENT '店铺logo',
  `grade` float(2,1) unsigned NOT NULL DEFAULT '0.0' COMMENT '店铺评分',
  `site` varchar(150) NOT NULL DEFAULT '' COMMENT '店铺地址',
  `shop_mobile` char(11) NOT NULL COMMENT '店铺电话',
  `avg_price` smallint(5) unsigned DEFAULT '0' COMMENT '平均消费',
  `add_time` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '3' COMMENT '店铺状态1工作2打烊 3未审核 4禁用',
  `detail` text COMMENT '店铺简介',
  `audit_name` varchar(10) NOT NULL COMMENT '申请人姓名',
  `audit_mobile` char(11) NOT NULL COMMENT '申请人电话',
  `e_mail` char(30) DEFAULT NULL COMMENT '电子邮箱',
  `Id_number` char(18) NOT NULL COMMENT '身份证号',
  `image` varchar(200) DEFAULT NULL COMMENT '图片',
  `num_Z` int(10) unsigned DEFAULT NULL COMMENT '收藏总数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=276 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of one_shop
-- ----------------------------
INSERT INTO `one_shop` VALUES ('1', '0', 'test1', '/upload/2019-11-12/190_9dfb14368b900d981365e72a607164a9.jpg', '1.2', '河南省郑州市二七区马寨镇郑州科技学院', '18737146682', '0', '1572493383', '3', '工具店铺1', 'sxy', '18737146682', 'chenpingchao@qq.com', '11111111111111111', '/upload/2019-11-12/350_3a201ab02b4fa294ef85a7693568a704.jpg', '1');
INSERT INTO `one_shop` VALUES ('2', '0', 'test2', '/upload/2019-11-12/190_9dfb14368b900d981365e72a607164a9.jpg', '0.0', '河南省郑州市二七区马寨镇郑州科技学院', '18737146682', '0', '1572493383', '3', '工具店铺2', 'sxy', '18737146682', 'chenpingchao@qq.com', '22222222222222222', '/upload/2019-11-12/350_3a201ab02b4fa294ef85a7693568a704.jpg', '1');
INSERT INTO `one_shop` VALUES ('3', '0', 'test3', '/upload/2019-11-12/190_9dfb14368b900d981365e72a607164a9.jpg', '0.0', '河南省郑州市二七区马寨镇郑州科技学院', '18737146682', '0', '1572493383', '3', '工具店铺3', 'sxy', '18737146682', 'chenpingchao@qq.com', '33333333333333333', '/upload/2019-11-12/350_3a201ab02b4fa294ef85a7693568a704.jpg', '1');
INSERT INTO `one_shop` VALUES ('34', '0', 'test34', '/upload/2019-11-12/190_9dfb14368b900d981365e72a607164a9.jpg', '3.5', '河南省郑州市二七区马寨镇郑州科技学院', '18737146682', '0', '1572493383', '2', '工具店铺34', 'sxy', '18737146682', 'chenpingchao@qq.com', '44444444444444444', '/upload/2019-11-12/350_3a201ab02b4fa294ef85a7693568a704.jpg', '1');
INSERT INTO `one_shop` VALUES ('270', '5', '海洋餐馆', '/upload/2019-10-31/190_f45763c3e7279f816df65575655f68a4.jpg', '3.6', '河南省郑州市中原区马寨镇郑州科技学院', '15464646412', '32', '1572493383', '1', 'sdadwsd', '黑心商人', '17898989898', 'chenpingchao@qq.com', '111111111111111111', '/upload/2019-11-12/350_3a201ab02b4fa294ef85a7693568a704.jpg', '3');
INSERT INTO `one_shop` VALUES ('271', '5', '火锅调料', '/upload/2019-11-06/190_cf3c07d0b0807ee3e74a327fcf0a21f5.jpg', '4.6', '河南省信阳市市、县级市、县马寨镇郑州科技学院', '13645656664', '0', '1573005771', '1', '重庆火锅，你值得拥有', '地沟油', '13642042110', 'chenpingchao@qq.com', '111111111111111111', '/upload/2019-11-12/350_3a201ab02b4fa294ef85a7693568a704.jpg', '1');
INSERT INTO `one_shop` VALUES ('272', '7', '火锅调料', '/upload/2019-11-10/190_11e75029a12cfc99807d31b7236f3978.jpg', '2.7', '河南省郑州市中原区马寨镇郑州科技许愿', '15342354245', '0', '1573358707', '1', '反馈结果结核杆菌擐甲挥戈', '地沟油', '15264646464', 'chenpingchao@qq.com', '111111111111111112', '/upload/2019-11-12/350_3a201ab02b4fa294ef85a7693568a704.jpg', '1');
INSERT INTO `one_shop` VALUES ('273', '7', '火锅调料', '/upload/2019-11-10/190_d3edf61556fc1212b5122d1fff2dc157.jpg', '0.0', '河南省郑州市中原区马寨镇郑州科技许愿', '15342354241', '0', '1573366923', '1', '地沟油产出', '地沟油', '17514656322', 'chenpingchao@qq.com', '111111111111111111', '/upload/2019-11-12/350_3a201ab02b4fa294ef85a7693568a704.jpg', '1');
INSERT INTO `one_shop` VALUES ('274', '5', '海洋餐馆2号', '/upload/2019-11-12/190_9dfb14368b900d981365e72a607164a9.jpg', '0.0', '河南省郑州市中原区马寨', '15236430715', '0', '1573519721', '1', 'safda&amp;nbsp;', '三聚氰胺', '18645495465', 'chenpingchao@qq.com', '111111111111111111', '/upload/2019-11-12/350_3a201ab02b4fa294ef85a7693568a704.jpg', '1');
INSERT INTO `one_shop` VALUES ('275', '5', '海洋餐馆3号分店', '/upload/2019-11-12/190_f841016b73b3bb29be72bfbc53911d7e.jpg', '0.0', '河南省郑州市中原区马寨', '18654465454', '0', '1573519977', '1', '士大夫', '苏丹红', '13655646545', 'chenpingchao@qq.com', '222222222222222222', '/upload/2019-11-12/350_3a201ab02b4fa294ef85a7693568a704.jpg', '1');

-- ----------------------------
-- Table structure for `one_shop_member`
-- ----------------------------
DROP TABLE IF EXISTS `one_shop_member`;
CREATE TABLE `one_shop_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商家用户id',
  `shop_member_name` varchar(30) NOT NULL COMMENT '商家持有人昵称',
  `password` char(32) NOT NULL COMMENT '登录密码',
  `mobile` char(11) DEFAULT NULL COMMENT '手机号',
  `active` tinyint(1) unsigned DEFAULT '1' COMMENT '1为激活 2为禁用',
  `add_time` int(10) unsigned DEFAULT NULL COMMENT '注册时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of one_shop_member
-- ----------------------------
INSERT INTO `one_shop_member` VALUES ('7', '全文强群', '4297f44b13955235245b2497399d7a93', '15236430715', '1', '1573357982');
INSERT INTO `one_shop_member` VALUES ('5', 'zdy', '123123', '15233332333', '1', '1572229213');

-- ----------------------------
-- Table structure for `one_system`
-- ----------------------------
DROP TABLE IF EXISTS `one_system`;
CREATE TABLE `one_system` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '系统管理id',
  `system_section` varchar(10) NOT NULL COMMENT '系统管理项目',
  `grade` int(10) unsigned NOT NULL COMMENT '重要等级',
  `explain` text NOT NULL COMMENT '解释说明',
  `add_time` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1为激活 2为禁用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of one_system
-- ----------------------------
