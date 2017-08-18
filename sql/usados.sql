/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : usados

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-08-18 18:25:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admin_permiso`
-- ----------------------------
DROP TABLE IF EXISTS `admin_permiso`;
CREATE TABLE `admin_permiso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(145) DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_permiso
-- ----------------------------
INSERT INTO `admin_permiso` VALUES ('1', 'Administrador', '1');
INSERT INTO `admin_permiso` VALUES ('2', 'Editor', '1');
INSERT INTO `admin_permiso` VALUES ('3', 'Redactor', '1');

-- ----------------------------
-- Table structure for `admin_usuario`
-- ----------------------------
DROP TABLE IF EXISTS `admin_usuario`;
CREATE TABLE `admin_usuario` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(145) DEFAULT NULL,
  `email` varchar(145) DEFAULT NULL,
  `password` varchar(145) DEFAULT NULL,
  `imagen` varchar(145) DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_usuario
-- ----------------------------
INSERT INTO `admin_usuario` VALUES ('1', 'Raúl Ramírez', 'raul.ramirez@garden.com.py', '4530ad981d5c02d9cb0456c360fae460803922f556c56022e1dc0187c16ced50', null, '1');

-- ----------------------------
-- Table structure for `admin_usuario_permiso`
-- ----------------------------
DROP TABLE IF EXISTS `admin_usuario_permiso`;
CREATE TABLE `admin_usuario_permiso` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) unsigned NOT NULL,
  `id_permiso` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_usuario_permiso
-- ----------------------------
INSERT INTO `admin_usuario_permiso` VALUES ('1', '1', '1');

-- ----------------------------
-- Table structure for `combustible`
-- ----------------------------
DROP TABLE IF EXISTS `combustible`;
CREATE TABLE `combustible` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(120) NOT NULL,
  `estado` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of combustible
-- ----------------------------
INSERT INTO `combustible` VALUES ('1', 'Nafta', '1');
INSERT INTO `combustible` VALUES ('2', '0km', '1');
INSERT INTO `combustible` VALUES ('3', 'Flex', '1');

-- ----------------------------
-- Table structure for `condicion`
-- ----------------------------
DROP TABLE IF EXISTS `condicion`;
CREATE TABLE `condicion` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(120) DEFAULT NULL,
  `estado` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of condicion
-- ----------------------------
INSERT INTO `condicion` VALUES ('1', 'Usado', '1');
INSERT INTO `condicion` VALUES ('2', '0km', '1');

-- ----------------------------
-- Table structure for `estado`
-- ----------------------------
DROP TABLE IF EXISTS `estado`;
CREATE TABLE `estado` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(120) NOT NULL,
  `estado` int(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of estado
-- ----------------------------
INSERT INTO `estado` VALUES ('1', 'Mostrar', '1');
INSERT INTO `estado` VALUES ('2', 'Ocultar', '1');
INSERT INTO `estado` VALUES ('3', 'Vendido', '0');

-- ----------------------------
-- Table structure for `marca`
-- ----------------------------
DROP TABLE IF EXISTS `marca`;
CREATE TABLE `marca` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(120) NOT NULL,
  `imagen` varchar(120) DEFAULT NULL,
  `url` varchar(120) DEFAULT NULL,
  `garden` int(1) DEFAULT '0',
  `estado` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of marca
-- ----------------------------
INSERT INTO `marca` VALUES ('1', 'Alfa Romeo', null, '', '0', '1');
INSERT INTO `marca` VALUES ('2', 'Alpine', null, null, '0', '1');
INSERT INTO `marca` VALUES ('3', 'Aston Martin', null, null, '0', '1');
INSERT INTO `marca` VALUES ('4', 'Audi', null, null, '0', '1');
INSERT INTO `marca` VALUES ('5', 'Bentley', null, null, '0', '1');
INSERT INTO `marca` VALUES ('6', 'BMW', null, null, '0', '1');
INSERT INTO `marca` VALUES ('7', 'Citroen', null, null, '0', '1');
INSERT INTO `marca` VALUES ('8', 'Dacia', null, null, '0', '1');
INSERT INTO `marca` VALUES ('9', 'DS', null, null, '0', '1');
INSERT INTO `marca` VALUES ('10', 'Fiat', null, null, '0', '1');
INSERT INTO `marca` VALUES ('11', 'Ford', null, null, '0', '1');
INSERT INTO `marca` VALUES ('12', 'Honda', null, null, '0', '1');
INSERT INTO `marca` VALUES ('13', 'Hyundai', null, null, '0', '1');
INSERT INTO `marca` VALUES ('14', 'Infiniti', null, null, '0', '1');
INSERT INTO `marca` VALUES ('15', 'Jaguar', null, null, '0', '1');
INSERT INTO `marca` VALUES ('16', 'Jeep', 'jeep.jpg', 'http://www.jeep.com.py/', '1', '1');
INSERT INTO `marca` VALUES ('17', 'Kia', 'kia.jpg', 'http://www.kia.com.py/', '1', '1');
INSERT INTO `marca` VALUES ('18', 'Lancia', null, null, '0', '1');
INSERT INTO `marca` VALUES ('19', 'Land Rover', null, null, '0', '1');
INSERT INTO `marca` VALUES ('20', 'Lexus', null, null, '0', '1');
INSERT INTO `marca` VALUES ('21', 'Lotus', null, null, '0', '1');
INSERT INTO `marca` VALUES ('22', 'Maserati', null, null, '0', '1');
INSERT INTO `marca` VALUES ('23', 'Mazda', 'mazda.jpg', 'http://www.garden.com.py/', '1', '1');
INSERT INTO `marca` VALUES ('24', 'McLaren', null, null, '0', '1');
INSERT INTO `marca` VALUES ('25', 'Mercedes-Benz', null, null, '0', '1');
INSERT INTO `marca` VALUES ('26', 'MINI', 'mini.jpg', 'http://www.mini.com.py/', '1', '1');
INSERT INTO `marca` VALUES ('27', 'Mitsubishi', null, null, '0', '1');
INSERT INTO `marca` VALUES ('28', 'Nissan', 'nissan2.jpg', 'http://nissan.com.py/', '1', '1');
INSERT INTO `marca` VALUES ('29', 'Opel', null, null, '0', '1');
INSERT INTO `marca` VALUES ('30', 'Pagani', null, null, '0', '1');
INSERT INTO `marca` VALUES ('31', 'Peugot', null, null, '0', '1');
INSERT INTO `marca` VALUES ('32', 'Porsche', null, null, '0', '1');
INSERT INTO `marca` VALUES ('33', 'Renault', null, null, '0', '1');
INSERT INTO `marca` VALUES ('34', 'Rolls-Royce', null, null, '0', '1');
INSERT INTO `marca` VALUES ('35', 'Seat', null, null, '0', '1');
INSERT INTO `marca` VALUES ('36', 'Skoda', null, null, '0', '1');
INSERT INTO `marca` VALUES ('37', 'Smart', null, null, '0', '1');
INSERT INTO `marca` VALUES ('38', 'SsangYong', null, null, '0', '1');
INSERT INTO `marca` VALUES ('39', 'Subaru', null, null, '0', '1');
INSERT INTO `marca` VALUES ('40', 'Suzuki', null, null, '0', '1');
INSERT INTO `marca` VALUES ('41', 'Tesla Motors', null, null, '0', '1');
INSERT INTO `marca` VALUES ('42', 'Toyota', null, null, '0', '1');
INSERT INTO `marca` VALUES ('43', 'Volkswagen', null, null, '0', '1');
INSERT INTO `marca` VALUES ('44', 'Volvo', null, null, '0', '1');
INSERT INTO `marca` VALUES ('45', 'Chevrolet', 'chevrolet.jpg', 'http://www.tema.com.py/', '1', '1');
INSERT INTO `marca` VALUES ('46', 'Dodge', 'dodge.jpg', 'http://www.dodge.com.py/', '1', '1');
INSERT INTO `marca` VALUES ('47', 'RAM', 'ram.jpg', 'http://www.ramtrucks.com.py/', '1', '1');
INSERT INTO `marca` VALUES ('48', 'Chrysler', 'chrysler.jpg', 'http://www.chrysler.com.py/', '1', '1');
INSERT INTO `marca` VALUES ('49', 'ZNA', null, null, '0', '1');
INSERT INTO `marca` VALUES ('50', 'Chery', null, null, '0', '1');
INSERT INTO `marca` VALUES ('51', 'Haima', null, null, '0', '1');
INSERT INTO `marca` VALUES ('52', 'Faw', null, null, '0', '1');
INSERT INTO `marca` VALUES ('53', 'Zotye', null, null, '0', '1');
INSERT INTO `marca` VALUES ('54', 'Changan', null, null, '0', '1');
INSERT INTO `marca` VALUES ('55', 'Jac', null, null, '0', '1');
INSERT INTO `marca` VALUES ('56', 'Lifan', null, null, '0', '1');
INSERT INTO `marca` VALUES ('57', 'BYD', null, null, '0', '1');
INSERT INTO `marca` VALUES ('58', 'Geely', null, null, '0', '1');
INSERT INTO `marca` VALUES ('59', 'Great Wall', null, null, '0', '1');
INSERT INTO `marca` VALUES ('60', 'Brilliance', null, null, '0', '1');
INSERT INTO `marca` VALUES ('61', 'Daihatsu', null, null, '0', '1');
INSERT INTO `marca` VALUES ('62', 'BWM Motorrad', 'bmw.jpg', 'http://www.bmw-motorrad.com.py/', '1', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of modelo
-- ----------------------------
INSERT INTO `modelo` VALUES ('1', '17', 'Picanto', '1');
INSERT INTO `modelo` VALUES ('2', '17', 'Rio', '1');
INSERT INTO `modelo` VALUES ('3', '17', 'Cerato', '1');
INSERT INTO `modelo` VALUES ('4', '17', 'Optima', '1');
INSERT INTO `modelo` VALUES ('5', '17', 'Cadenza', '1');
INSERT INTO `modelo` VALUES ('6', '17', 'Quoris', '1');
INSERT INTO `modelo` VALUES ('7', '17', 'Carens', '1');
INSERT INTO `modelo` VALUES ('8', '17', 'Grand Carnival', '1');
INSERT INTO `modelo` VALUES ('9', '17', 'Soul', '1');
INSERT INTO `modelo` VALUES ('10', '17', 'All-New Sportage', '1');
INSERT INTO `modelo` VALUES ('11', '17', 'Sportage', '1');
INSERT INTO `modelo` VALUES ('12', '17', 'Carnival', '1');
INSERT INTO `modelo` VALUES ('13', '17', 'Sorento', '1');
INSERT INTO `modelo` VALUES ('14', '17', 'K2700', '1');
INSERT INTO `modelo` VALUES ('15', '45', 'Onix', '1');
INSERT INTO `modelo` VALUES ('16', '45', 'Prisma', '1');
INSERT INTO `modelo` VALUES ('17', '45', 'Cruze', '1');
INSERT INTO `modelo` VALUES ('18', '45', 'Tracker', '1');
INSERT INTO `modelo` VALUES ('19', '45', 'S10', '1');
INSERT INTO `modelo` VALUES ('20', '45', 'N300 Max', '1');
INSERT INTO `modelo` VALUES ('21', '45', 'Montana', '1');
INSERT INTO `modelo` VALUES ('22', '45', 'N300 Pickup', '1');
INSERT INTO `modelo` VALUES ('23', '26', 'MINI 3 Puertas', '1');
INSERT INTO `modelo` VALUES ('24', '26', 'MINI 5 Puertas', '1');
INSERT INTO `modelo` VALUES ('25', '26', 'MINI Cabrio', '1');
INSERT INTO `modelo` VALUES ('26', '26', 'MINI Clubman', '1');
INSERT INTO `modelo` VALUES ('27', '26', 'MINI Countryman', '1');
INSERT INTO `modelo` VALUES ('28', '26', 'MINI John Cooper Works', '1');
INSERT INTO `modelo` VALUES ('29', '47', '2500', '1');
INSERT INTO `modelo` VALUES ('30', '46', 'Durango', '1');
INSERT INTO `modelo` VALUES ('31', '46', 'Journey', '1');
INSERT INTO `modelo` VALUES ('32', '46', 'Challenger', '1');
INSERT INTO `modelo` VALUES ('33', '16', 'Compass', '1');
INSERT INTO `modelo` VALUES ('34', '16', 'Renegade', '1');
INSERT INTO `modelo` VALUES ('35', '16', 'Wrangler', '1');
INSERT INTO `modelo` VALUES ('36', '16', 'Cherokee', '1');
INSERT INTO `modelo` VALUES ('37', '16', 'Grand Cherokee', '1');
INSERT INTO `modelo` VALUES ('38', '23', 'BT-50', '1');
INSERT INTO `modelo` VALUES ('39', '23', 'Mazda 3', '1');
INSERT INTO `modelo` VALUES ('40', '17', 'Mohave', '1');
INSERT INTO `modelo` VALUES ('41', '45', 'Sonic', '1');
INSERT INTO `modelo` VALUES ('42', '40', 'Grand Vitara', '1');
INSERT INTO `modelo` VALUES ('43', '45', 'Spin', '1');

-- ----------------------------
-- Table structure for `sede`
-- ----------------------------
DROP TABLE IF EXISTS `sede`;
CREATE TABLE `sede` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(80) NOT NULL,
  `ciudad` varchar(60) NOT NULL,
  `telefono` varchar(60) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `latitud` varchar(80) DEFAULT NULL,
  `longitud` varchar(80) DEFAULT NULL,
  `horario_atencion` text,
  `principal` int(1) unsigned DEFAULT '0',
  `estado` int(1) unsigned DEFAULT '1',
  `direccion` varchar(180) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sede
-- ----------------------------
INSERT INTO `sede` VALUES ('1', 'Garden Usados', 'Asunción', '(+595 21) 237 7111', null, '-25.307289', '-57.584465', '<p>Lunes a Viernes : 8:00 - 18:00<br>\r\nSabados : 8:00 - 12:00</p>', '1', '1', 'Rca. Argentina esq. Alfredo Seiferheld');
INSERT INTO `sede` VALUES ('2', 'Garden Usados TEMA', 'Asunción', '(+595 21) 237 7101', null, '-25.333121', '-57.591019', '<p>Lunes a Viernes : 8:00 - 18:00<br>\r\nSabados : 8:00 - 12:00</p>', '0', '1', 'Avda. Fernando de la Mora casi Ybapuru');
INSERT INTO `sede` VALUES ('3', 'Garden Usados', 'Ciudad del Este', '(+595 21) 237 6909', null, '-25.307289', '-57.584465', '<p>Lunes a Viernes : 8:00 - 18:00<br>\r\nSabados : 8:00 - 12:00</p>', '0', '1', 'Avda. San Blas esq. Arguello Km. 2,5');
INSERT INTO `sede` VALUES ('4', 'Garden Usados', 'Coronel Oviedo', ' (+595 521) 201 250', null, '-25.465909', '-56.450459', '<p>Lunes a Viernes : 8:00 - 18:00<br>\r\nSabados : 8:00 - 12:00</p>', '0', '1', 'Ruta 2 Mcal. Estigarribia (Rotonda)');

-- ----------------------------
-- Table structure for `tipo_traccion`
-- ----------------------------
DROP TABLE IF EXISTS `tipo_traccion`;
CREATE TABLE `tipo_traccion` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(120) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tipo_traccion
-- ----------------------------
INSERT INTO `tipo_traccion` VALUES ('1', 'Tracción Delantera', '1');
INSERT INTO `tipo_traccion` VALUES ('2', 'Tracción Trasera', '1');
INSERT INTO `tipo_traccion` VALUES ('3', 'AWD', '1');
INSERT INTO `tipo_traccion` VALUES ('4', '4WD', '1');
INSERT INTO `tipo_traccion` VALUES ('5', '4X4', '1');

-- ----------------------------
-- Table structure for `tipo_vehiculo`
-- ----------------------------
DROP TABLE IF EXISTS `tipo_vehiculo`;
CREATE TABLE `tipo_vehiculo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(120) NOT NULL,
  `img` varchar(45) DEFAULT NULL,
  `img_hover` varchar(45) DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tipo_vehiculo
-- ----------------------------
INSERT INTO `tipo_vehiculo` VALUES ('1', 'Sedan', 'sedan.png', 'sedan_hover.png', '1');
INSERT INTO `tipo_vehiculo` VALUES ('2', 'Crossover', 'crossover.png', 'crossover_hover.png', '1');
INSERT INTO `tipo_vehiculo` VALUES ('3', 'SUV', 'suv.png', 'suv_hover.png', '1');
INSERT INTO `tipo_vehiculo` VALUES ('4', 'Comercial', 'comercial.png', 'comercial_hover.png', '1');
INSERT INTO `tipo_vehiculo` VALUES ('5', 'Coupe', 'coupe.png', 'coupe_hover.png', '1');
INSERT INTO `tipo_vehiculo` VALUES ('6', 'Cabriolet', 'cabriolet.png', 'cabriolet_hover.png', '1');
INSERT INTO `tipo_vehiculo` VALUES ('7', 'Familiar', 'familiar.png', 'familiar_hover.png', '1');
INSERT INTO `tipo_vehiculo` VALUES ('8', 'Hatchback', 'hatchback.png', 'hatchback_hover.png', '1');
INSERT INTO `tipo_vehiculo` VALUES ('9', 'Minivan', 'minivan.png', 'minivan_hover.png', '1');
INSERT INTO `tipo_vehiculo` VALUES ('10', 'Pick-up', 'pickup.png', 'pickup_hover.png', '1');
INSERT INTO `tipo_vehiculo` VALUES ('11', 'Combi', null, null, '0');
INSERT INTO `tipo_vehiculo` VALUES ('12', 'Compacto', 'compacto.png', 'compacto_hover.png', '1');

-- ----------------------------
-- Table structure for `vehiculo`
-- ----------------------------
DROP TABLE IF EXISTS `vehiculo`;
CREATE TABLE `vehiculo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_estado` int(11) unsigned NOT NULL,
  `id_marca` int(11) unsigned DEFAULT NULL,
  `id_combustible` int(11) unsigned NOT NULL,
  `id_condicion` int(11) unsigned NOT NULL,
  `id_tipo_vehiculo` int(11) unsigned NOT NULL,
  `id_tipo_traccion` int(11) unsigned NOT NULL,
  `id_sede` int(11) unsigned DEFAULT NULL,
  `codigo` varchar(120) DEFAULT NULL,
  `modelo` varchar(120) DEFAULT NULL,
  `version` varchar(120) DEFAULT NULL,
  `ano` varchar(120) DEFAULT NULL,
  `color` varchar(120) DEFAULT NULL,
  `transmision` varchar(120) DEFAULT NULL,
  `motor` varchar(120) DEFAULT NULL,
  `precio` decimal(7,2) DEFAULT NULL,
  `cuotas` varchar(120) DEFAULT NULL,
  `adicionales` text,
  `kilometraje` int(7) DEFAULT NULL,
  `cantidad_pasajeros` int(2) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_id_estado_vehiculo` (`id_estado`),
  KEY `fk_id_combustible_vehiculo` (`id_combustible`),
  KEY `fk_id_condicion_vehiculo` (`id_condicion`),
  KEY `fk_id_tipo_vehiculo_vehiculo` (`id_tipo_vehiculo`),
  KEY `fk_id_tipo_traccion_veiculo` (`id_tipo_traccion`),
  KEY `fk_id_sede_vehiculo` (`id_sede`),
  CONSTRAINT `fk_id_combustible_vehiculo` FOREIGN KEY (`id_combustible`) REFERENCES `combustible` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_id_condicion_vehiculo` FOREIGN KEY (`id_condicion`) REFERENCES `condicion` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_id_estado_vehiculo` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_id_sede_vehiculo` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_id_tipo_traccion_veiculo` FOREIGN KEY (`id_tipo_traccion`) REFERENCES `tipo_traccion` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_id_tipo_vehiculo_vehiculo` FOREIGN KEY (`id_tipo_vehiculo`) REFERENCES `tipo_vehiculo` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vehiculo
-- ----------------------------
INSERT INTO `vehiculo` VALUES ('1', '1', '17', '3', '1', '12', '1', '1', '235748', 'Picano', null, '2012', 'Celeste', 'Automática', '1.0', '8000.00', 'Hasta 48 Cuotas', null, null, '5', '2016-07-24 08:43:34', '1');
INSERT INTO `vehiculo` VALUES ('2', '1', '45', '3', '1', '8', '1', '3', '566930', 'Sonic', 'LT', '2013', 'Plata', 'Mecánica 6 Vel.', '1.6', '18900.00', 'Hasta 48 Cuotas', null, null, '5', '2016-07-25 08:43:34', '1');
INSERT INTO `vehiculo` VALUES ('3', '1', '26', '1', '2', '12', '1', '3', '83378', 'MINI Countryman', 'ONE', '2011', 'Plata', 'Mecánica 6 Vel.', '1.6', '19900.00', 'Hasta 48 Cuotas', null, null, '5', '2016-07-25 08:43:34', '1');
INSERT INTO `vehiculo` VALUES ('4', '1', '17', '1', '1', '1', '1', '3', '249824', 'Rio', null, '2013', 'Azul', 'Automática', '1.4', '15600.00', 'Hasta 48 Cuotas', null, null, '5', '2016-07-25 08:43:34', '1');
INSERT INTO `vehiculo` VALUES ('5', '1', '17', '1', '1', '12', '1', '3', '974886', 'Picanto', 'LX', '2011', 'Blanco', 'Mecánica 5 Vel.', '1.1', '7000.00', 'Hasta 48 Cuotas', null, null, '5', '2016-07-26 08:43:34', '1');
INSERT INTO `vehiculo` VALUES ('6', '1', '47', '2', '1', '10', '5', '3', '5099949', '2500', 'Laramie', '2011', 'Negro', 'Automática', '6.7', '39500.00', 'Hasta 48 Cuotas', null, null, '5', '2016-07-26 08:43:34', '1');
INSERT INTO `vehiculo` VALUES ('7', '1', '45', '2', '1', '10', '5', '3', '166203', 'S10', 'C/S', '2004', 'Plata', 'Mecánica 5 Vel.', '2.8 Turbo', '15500.00', 'Hasta 48 Cuotas', null, null, '3', '2016-07-26 08:43:34', '1');
INSERT INTO `vehiculo` VALUES ('8', '1', '23', '2', '1', '10', '5', '3', '884052', 'BT-50', 'D/C', '2011', 'Plata', 'Mecánica 5 Vel.', '2.5', '19900.00', 'Hasta 48 Cuotas', null, null, '5', '2016-07-26 08:43:34', '1');
INSERT INTO `vehiculo` VALUES ('9', '1', '16', '1', '2', '3', '5', '3', '520145', 'Grand Cherokee', 'LIMITED', '2011', 'Plata', 'Automática', '3.6', '39000.00', 'Hasta 48 Cuotas', null, null, '5', '2016-07-26 08:43:34', '1');
INSERT INTO `vehiculo` VALUES ('10', '1', '40', '1', '2', '3', '5', '3', '601003', 'Grand Vitara', '3P', '2011', 'Plata', 'Mecánica 5 Vel.', '1.6', '16500.00', 'Hasta 48 Cuotas', null, null, '2', '2016-07-26 08:43:34', '1');
INSERT INTO `vehiculo` VALUES ('11', '1', '45', '3', '1', '7', '1', '3', '268719', 'Spin', 'LT', '2013', 'Gris Rusk', 'Mecánica 5 Vel.', '1.8', '17000.00', 'Hasta 48 Cuotas', null, null, '7', '2016-07-26 08:43:34', '1');
INSERT INTO `vehiculo` VALUES ('12', '1', '17', '2', '1', '3', '5', '3', '874323', 'Sorento', 'EX Full', '2009', 'Beige', 'Mecánica 5 Vel.', '2.5', '19000.00', 'Hasta 48 Cuotas', null, null, '5', '2016-07-26 08:43:34', '1');

-- ----------------------------
-- Table structure for `vehiculo_img`
-- ----------------------------
DROP TABLE IF EXISTS `vehiculo_img`;
CREATE TABLE `vehiculo_img` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_vehiculo` int(11) unsigned NOT NULL,
  `imagen` varchar(140) NOT NULL,
  `principal` int(1) unsigned NOT NULL DEFAULT '0',
  `estado` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vehiculo_img
-- ----------------------------
INSERT INTO `vehiculo_img` VALUES ('1', '1', '1_picanto_1.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('2', '1', '1_picanto_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('3', '1', '1_picanto_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('4', '1', '1_picanto_4.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('5', '2', '2_sonic_lt_1.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('6', '2', '2_sonic_lt_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('7', '2', '2_sonic_lt_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('8', '2', '2_sonic_lt_4.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('9', '3', '3_mini_countryman_1.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('10', '3', '3_mini_countryman_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('11', '3', '3_mini_countryman_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('12', '3', '3_mini_countryman_4.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('13', '4', '4_rio_sedan_1.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('14', '4', '4_rio_sedan_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('15', '4', '4_rio_sedan_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('16', '4', '4_rio_sedan_4.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('17', '5', '5_picanto_1.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('18', '5', '5_picanto_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('19', '5', '5_picanto_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('20', '5', '5_picanto_4.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('21', '6', '6_ram_laramie_1.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('22', '6', '6_ram_laramie_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('23', '6', '6_ram_laramie_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('24', '6', '6_ram_laramie_4.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('25', '7', '7_s10_1.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('26', '7', '7_s10_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('27', '7', '7_s10_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('28', '7', '7_s10_4.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('29', '8', '8_mazda_bt_50_1.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('30', '8', '8_mazda_bt_50_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('31', '8', '8_mazda_bt_50_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('32', '8', '8_mazda_bt_50_4.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('33', '9', '9_gran_cherokee_1.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('34', '9', '9_gran_cherokee_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('35', '9', '9_gran_cherokee_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('36', '9', '9_gran_cherokee_4.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('37', '10', '10_gran_vitara_3p_1.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('38', '10', '10_gran_vitara_3p_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('39', '10', '10_gran_vitara_3p_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('40', '10', '10_gran_vitara_3p_4.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('41', '11', '11_spin_1.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('42', '11', '11_spin_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('43', '11', '11_spin_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('44', '11', '11_spin_4.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('45', '12', '12_sorento_ex_1.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('46', '12', '12_sorento_ex_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('47', '12', '12_sorento_ex_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('48', '12', '12_sorento_ex_4.jpg', '0', '1');
