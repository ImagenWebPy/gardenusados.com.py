/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : usados

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-07-21 09:22:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `combustible`
-- ----------------------------
DROP TABLE IF EXISTS `combustible`;
CREATE TABLE `combustible` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(120) NOT NULL,
  `estado` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of combustible
-- ----------------------------

-- ----------------------------
-- Table structure for `condicion`
-- ----------------------------
DROP TABLE IF EXISTS `condicion`;
CREATE TABLE `condicion` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(120) DEFAULT NULL,
  `estado` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of condicion
-- ----------------------------

-- ----------------------------
-- Table structure for `estado`
-- ----------------------------
DROP TABLE IF EXISTS `estado`;
CREATE TABLE `estado` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of estado
-- ----------------------------

-- ----------------------------
-- Table structure for `marca`
-- ----------------------------
DROP TABLE IF EXISTS `marca`;
CREATE TABLE `marca` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(120) NOT NULL,
  `imagen` varchar(120) DEFAULT NULL,
  `url` varchar(120) DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of marca
-- ----------------------------
INSERT INTO `marca` VALUES ('1', 'Alfa Romeo', null, null, '1');
INSERT INTO `marca` VALUES ('2', 'Alpine', null, null, '1');
INSERT INTO `marca` VALUES ('3', 'Aston Martin', null, null, '1');
INSERT INTO `marca` VALUES ('4', 'Audi', null, null, '1');
INSERT INTO `marca` VALUES ('5', 'Bentley', null, null, '1');
INSERT INTO `marca` VALUES ('6', 'BMW', null, null, '1');
INSERT INTO `marca` VALUES ('7', 'Citroen', null, null, '1');
INSERT INTO `marca` VALUES ('8', 'Dacia', null, null, '1');
INSERT INTO `marca` VALUES ('9', 'DS', null, null, '1');
INSERT INTO `marca` VALUES ('10', 'Fiat', null, null, '1');
INSERT INTO `marca` VALUES ('11', 'Ford', null, null, '1');
INSERT INTO `marca` VALUES ('12', 'Honda', null, null, '1');
INSERT INTO `marca` VALUES ('13', 'Hyundai', null, null, '1');
INSERT INTO `marca` VALUES ('14', 'Infiniti', null, null, '1');
INSERT INTO `marca` VALUES ('15', 'Jaguar', null, null, '1');
INSERT INTO `marca` VALUES ('16', 'Jeep', null, null, '1');
INSERT INTO `marca` VALUES ('17', 'Kia', null, null, '1');
INSERT INTO `marca` VALUES ('18', 'Lancia', null, null, '1');
INSERT INTO `marca` VALUES ('19', 'Land Rover', null, null, '1');
INSERT INTO `marca` VALUES ('20', 'Lexus', null, null, '1');
INSERT INTO `marca` VALUES ('21', 'Lotus', null, null, '1');
INSERT INTO `marca` VALUES ('22', 'Maserati', null, null, '1');
INSERT INTO `marca` VALUES ('23', 'Mazda', null, null, '1');
INSERT INTO `marca` VALUES ('24', 'McLaren', null, null, '1');
INSERT INTO `marca` VALUES ('25', 'Mercedes-Benz', null, null, '1');
INSERT INTO `marca` VALUES ('26', 'MINI', null, null, '1');
INSERT INTO `marca` VALUES ('27', 'Mitsubishi', null, null, '1');
INSERT INTO `marca` VALUES ('28', 'Nissan', null, null, '1');
INSERT INTO `marca` VALUES ('29', 'Opel', null, null, '1');
INSERT INTO `marca` VALUES ('30', 'Pagani', null, null, '1');
INSERT INTO `marca` VALUES ('31', 'Peugot', null, null, '1');
INSERT INTO `marca` VALUES ('32', 'Porsche', null, null, '1');
INSERT INTO `marca` VALUES ('33', 'Renault', null, null, '1');
INSERT INTO `marca` VALUES ('34', 'Rolls-Royce', null, null, '1');
INSERT INTO `marca` VALUES ('35', 'Seat', null, null, '1');
INSERT INTO `marca` VALUES ('36', 'Skoda', null, null, '1');
INSERT INTO `marca` VALUES ('37', 'Smart', null, null, '1');
INSERT INTO `marca` VALUES ('38', 'SsangYong', null, null, '1');
INSERT INTO `marca` VALUES ('39', 'Subaru', null, null, '1');
INSERT INTO `marca` VALUES ('40', 'Suzuki', null, null, '1');
INSERT INTO `marca` VALUES ('41', 'Tesla Motors', null, null, '1');
INSERT INTO `marca` VALUES ('42', 'Toyota', null, null, '1');
INSERT INTO `marca` VALUES ('43', 'Volkswagen', null, null, '1');
INSERT INTO `marca` VALUES ('44', 'Volvo', null, null, '1');
INSERT INTO `marca` VALUES ('45', 'Chevrolet', null, null, '1');
INSERT INTO `marca` VALUES ('46', 'Dodge', null, null, '1');
INSERT INTO `marca` VALUES ('47', 'RAM', null, null, '1');
INSERT INTO `marca` VALUES ('48', 'Chrysler', null, null, '1');
INSERT INTO `marca` VALUES ('49', 'ZNA', null, null, '1');
INSERT INTO `marca` VALUES ('50', 'Chery', null, null, '1');
INSERT INTO `marca` VALUES ('51', 'Haima', null, null, '1');
INSERT INTO `marca` VALUES ('52', 'Faw', null, null, '1');
INSERT INTO `marca` VALUES ('53', 'Zotye', null, null, '1');
INSERT INTO `marca` VALUES ('54', 'Changan', null, null, '1');
INSERT INTO `marca` VALUES ('55', 'Jac', null, null, '1');
INSERT INTO `marca` VALUES ('56', 'Lifan', null, null, '1');
INSERT INTO `marca` VALUES ('57', 'BYD', null, null, '1');
INSERT INTO `marca` VALUES ('58', 'Geely', null, null, '1');
INSERT INTO `marca` VALUES ('59', 'Great Wall', null, null, '1');
INSERT INTO `marca` VALUES ('60', 'Brilliance', null, null, '1');
INSERT INTO `marca` VALUES ('61', 'Daihatsu', null, null, '1');

-- ----------------------------
-- Table structure for `modelo`
-- ----------------------------
DROP TABLE IF EXISTS `modelo`;
CREATE TABLE `modelo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_marca` int(11) unsigned NOT NULL,
  `descripcion` varchar(120) DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_id_marca_m` (`id_marca`),
  CONSTRAINT `fk_id_marca_m` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of modelo
-- ----------------------------

-- ----------------------------
-- Table structure for `tipo_vehiculo`
-- ----------------------------
DROP TABLE IF EXISTS `tipo_vehiculo`;
CREATE TABLE `tipo_vehiculo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(120) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tipo_vehiculo
-- ----------------------------

-- ----------------------------
-- Table structure for `vehiculo`
-- ----------------------------
DROP TABLE IF EXISTS `vehiculo`;
CREATE TABLE `vehiculo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_modelo` int(11) unsigned NOT NULL,
  `id_estado` int(11) unsigned NOT NULL,
  `id_combustible` int(11) unsigned NOT NULL,
  `id_condicion` int(11) unsigned NOT NULL,
  `id_tipo_vehiculo` int(11) unsigned NOT NULL,
  `codigo` varchar(120) DEFAULT NULL,
  `ano` varchar(120) DEFAULT NULL,
  `color` varchar(120) DEFAULT NULL,
  `transmision` varchar(120) DEFAULT NULL,
  `motor` varchar(120) DEFAULT NULL,
  `precio` varchar(120) DEFAULT NULL,
  `cuotas` varchar(120) DEFAULT NULL,
  `adicionales` varchar(120) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_modelo_vehiculo` (`id_modelo`),
  KEY `fk_id_estado_vehiculo` (`id_estado`),
  KEY `fk_id_combustible_vehiculo` (`id_combustible`),
  KEY `fk_id_condicion_vehiculo` (`id_condicion`),
  KEY `fk_id_tipo_vehiculo_vehiculo` (`id_tipo_vehiculo`),
  CONSTRAINT `fk_id_combustible_vehiculo` FOREIGN KEY (`id_combustible`) REFERENCES `combustible` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_id_condicion_vehiculo` FOREIGN KEY (`id_condicion`) REFERENCES `condicion` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_id_estado_vehiculo` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_id_modelo_vehiculo` FOREIGN KEY (`id_modelo`) REFERENCES `modelo` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_id_tipo_vehiculo_vehiculo` FOREIGN KEY (`id_tipo_vehiculo`) REFERENCES `tipo_vehiculo` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vehiculo
-- ----------------------------
