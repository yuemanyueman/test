/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : huiyuan

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-04-10 14:08:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for hy_member
-- ----------------------------
DROP TABLE IF EXISTS `hy_member`;
CREATE TABLE `hy_member` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `phone` char(11) NOT NULL,
  `integral` varchar(255) NOT NULL COMMENT '积分',
  `t_integral` varchar(50) NOT NULL COMMENT '总积分',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hy_member
-- ----------------------------
INSERT INTO `hy_member` VALUES ('1', 'yueman', '15201044307', '1,2,3', '6', '1523258186', '1523258186');
INSERT INTO `hy_member` VALUES ('2', 'taiyab', '18519773728', '111,3,3333', '3447', '1523258257', '1523258257');
INSERT INTO `hy_member` VALUES ('3', 'xiaomengmeng', '15614238229', '2222,90,3443,3,1', '5759', '1523338055', '1523340136');
INSERT INTO `hy_member` VALUES ('4', 'skkjsiijd', '13578945620', '22222,2222111,5555,9999,1113333,4444', '3377664', '1523340254', '1523340328');
