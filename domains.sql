/*
 Navicat Premium Data Transfer

 Source Server         : APP1
 Source Server Type    : MariaDB
 Source Server Version : 100515 (10.5.15-MariaDB-0ubuntu0.21.10.1)
 Source Host           : app1.csicxt.com:8806
 Source Schema         : tc_videntium_com

 Target Server Type    : MariaDB
 Target Server Version : 100515 (10.5.15-MariaDB-0ubuntu0.21.10.1)
 File Encoding         : 65001

 Date: 06/02/2023 21:08:22
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for domains
-- ----------------------------
DROP TABLE IF EXISTS `domains`;
CREATE TABLE `domains` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domain` varchar(255) DEFAULT NULL,
  `reg_ad` varchar(255) DEFAULT NULL,
  `reg_email` varchar(255) DEFAULT NULL,
  `reg_phone` varchar(255) DEFAULT NULL,
  `reg_adres` varchar(255) DEFAULT NULL,
  `domain_expire` varchar(255) DEFAULT NULL,
  `dt_add` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of domains
-- ----------------------------
BEGIN;
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
