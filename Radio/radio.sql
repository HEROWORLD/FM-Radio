/*
Navicat MySQL Data Transfer

Source Server         : jixia_radio_cn
Source Server Version : 50561
Source Host           : 118.24.115.142:3306
Source Database       : radio

Target Server Type    : MYSQL
Target Server Version : 50561
File Encoding         : 65001

Date: 2018-09-03 17:51:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for collection
-- ----------------------------
DROP TABLE IF EXISTS `collection`;
CREATE TABLE `collection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `audio_id` int(11) NOT NULL COMMENT '音频ID',
  `status` int(11) NOT NULL DEFAULT '1',
  `update_time` int(11) DEFAULT '0',
  `create_time` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for radio
-- ----------------------------
DROP TABLE IF EXISTS `radio`;
CREATE TABLE `radio` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `wxurl` varchar(200) NOT NULL COMMENT '微信公众号链接',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态（0：删除，1：上线）',
  `theme_id` int(11) NOT NULL COMMENT '主题id：1:100天碎碎念，2：音乐阳光房 3：城市新民谣',
  `img_url` varchar(128) NOT NULL COMMENT '图像url',
  `play_number` int(11) DEFAULT '0' COMMENT '播放量',
  `release_date` int(11) DEFAULT NULL COMMENT '发布日期，不是后台自动更新的日期',
  `collection_number` int(11) DEFAULT '0' COMMENT '赞赏数量',
  `comment_number` int(11) DEFAULT '0' COMMENT '评论数量',
  `share_number` int(11) DEFAULT '0' COMMENT '分享数量',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for theme
-- ----------------------------
DROP TABLE IF EXISTS `theme`;
CREATE TABLE `theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '分类名称',
  `description` varchar(255) DEFAULT '无' COMMENT '描述',
  `top_img_url` varchar(255) NOT NULL COMMENT '头图地址',
  `update_time` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(50) NOT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `extend` varchar(255) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL COMMENT '注册时间',
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `openid` (`openid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
