/*
Navicat MySQL Data Transfer

Source Server         : AWS
Source Server Version : 50556
Source Host           : 34.209.83.134:3306
Source Database       : usados

Target Server Type    : MYSQL
Target Server Version : 50556
File Encoding         : 65001

Date: 2017-09-20 16:19:17
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_usuario
-- ----------------------------
INSERT INTO `admin_usuario` VALUES ('1', 'Raúl Ramírez', 'raul.ramirez@garden.com.py', '4530ad981d5c02d9cb0456c360fae460803922f556c56022e1dc0187c16ced50', null, '1');
INSERT INTO `admin_usuario` VALUES ('2', 'Usados', 'usados.asu@garden.com.py', '4530ad981d5c02d9cb0456c360fae460803922f556c56022e1dc0187c16ced50', null, '1');
INSERT INTO `admin_usuario` VALUES ('3', 'Humberto', 'humbertoq-@hotmail.com', '4530ad981d5c02d9cb0456c360fae460803922f556c56022e1dc0187c16ced50', null, '1');

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
INSERT INTO `combustible` VALUES ('2', 'Diesel', '1');
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
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

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
  `id_marca` int(11) unsigned NOT NULL,
  `id_combustible` int(11) unsigned NOT NULL,
  `id_condicion` int(11) unsigned NOT NULL,
  `id_tipo_vehiculo` int(11) unsigned NOT NULL,
  `id_tipo_traccion` int(11) unsigned NOT NULL,
  `id_sede` int(11) unsigned NOT NULL,
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
  KEY `fk_id_combustible_vehiculo` (`id_combustible`),
  KEY `fk_id_condicion_vehiculo` (`id_condicion`),
  KEY `fk_id_tipo_vehiculo_vehiculo` (`id_tipo_vehiculo`),
  KEY `fk_id_tipo_traccion_veiculo` (`id_tipo_traccion`),
  KEY `fk_id_sede_vehiculo` (`id_sede`),
  CONSTRAINT `fk_id_combustible_vehiculo` FOREIGN KEY (`id_combustible`) REFERENCES `combustible` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_id_condicion_vehiculo` FOREIGN KEY (`id_condicion`) REFERENCES `condicion` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_id_sede_vehiculo` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_id_tipo_traccion_veiculo` FOREIGN KEY (`id_tipo_traccion`) REFERENCES `tipo_traccion` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_id_tipo_vehiculo_vehiculo` FOREIGN KEY (`id_tipo_vehiculo`) REFERENCES `tipo_vehiculo` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vehiculo
-- ----------------------------
INSERT INTO `vehiculo` VALUES ('1', '17', '3', '1', '12', '1', '1', '235748', 'Picano', null, '2012', 'Celeste', 'Automática', '1.0', '8000.00', 'Hasta 48 Cuotas', null, null, '5', '2016-07-24 08:43:34', '1');
INSERT INTO `vehiculo` VALUES ('2', '45', '3', '1', '8', '1', '3', '566930', 'Sonic', 'LT', '2013', 'Plata', 'Mecánica 6 Vel.', '1.6', '18900.00', 'Hasta 48 Cuotas', null, null, '5', '2016-07-25 08:43:34', '1');
INSERT INTO `vehiculo` VALUES ('3', '26', '1', '1', '12', '1', '3', '83378', 'MINI Countryman', 'ONE', '2011', 'Plata', 'Mecánica 6 Vel.', '1.6', '19900.00', 'Hasta 48 Cuotas', null, null, '5', '2016-07-25 08:43:34', '1');
INSERT INTO `vehiculo` VALUES ('4', '17', '1', '1', '1', '1', '3', '249824', 'Rio', null, '2013', 'Azul', 'Automática', '1.4', '15600.00', 'Hasta 48 Cuotas', null, null, '5', '2016-07-25 08:43:34', '1');
INSERT INTO `vehiculo` VALUES ('5', '17', '1', '1', '12', '1', '3', '974886', 'Picanto', 'LX', '2011', 'Blanco', 'Mecánica 5 Vel.', '1.1', '7000.00', 'Hasta 48 Cuotas', null, null, '5', '2016-07-26 08:43:34', '1');
INSERT INTO `vehiculo` VALUES ('6', '47', '2', '1', '10', '5', '3', '5099949', '2500', 'Laramie', '2011', 'Negro', 'Automática', '6.7', '39500.00', 'Hasta 48 Cuotas', null, null, '5', '2016-07-26 08:43:34', '1');
INSERT INTO `vehiculo` VALUES ('7', '45', '2', '1', '10', '5', '3', '166203', 'S10', 'C/S', '2004', 'Plata', 'Mecánica 5 Vel.', '2.8 Turbo', '15500.00', 'Hasta 48 Cuotas', null, null, '3', '2016-07-26 08:43:34', '1');
INSERT INTO `vehiculo` VALUES ('8', '23', '2', '1', '10', '5', '3', '884052', 'BT-50', 'D/C', '2011', 'Plata', 'Mecánica 5 Vel.', '2.5', '19900.00', 'Hasta 48 Cuotas', null, null, '5', '2016-07-26 08:43:34', '1');
INSERT INTO `vehiculo` VALUES ('9', '16', '1', '1', '3', '5', '3', '520145', 'Grand Cherokee', 'LIMITED', '2011', 'Plata', 'Automática', '3.6', '39000.00', 'Hasta 48 Cuotas', null, null, '5', '2016-07-26 08:43:34', '1');
INSERT INTO `vehiculo` VALUES ('10', '40', '1', '1', '3', '5', '3', '601003', 'Grand Vitara', '3P', '2011', 'Plata', 'Mecánica 5 Vel.', '1.6', '16500.00', 'Hasta 48 Cuotas', null, null, '2', '2016-07-26 08:43:34', '1');
INSERT INTO `vehiculo` VALUES ('11', '45', '3', '1', '7', '1', '3', '268719', 'Spin', 'LT', '2013', 'Gris Rusk', 'Mecánica 5 Vel.', '1.8', '17000.00', 'Hasta 48 Cuotas', null, null, '7', '2016-07-26 08:43:34', '1');
INSERT INTO `vehiculo` VALUES ('12', '17', '2', '1', '3', '5', '3', '874323', 'Sorento', 'EX Full', '2009', 'Beige', 'Mecánica 5 Vel.', '2.5', '19000.00', 'Hasta 48 Cuotas', null, null, '5', '2016-07-26 08:43:34', '1');
INSERT INTO `vehiculo` VALUES ('22', '10', '1', '1', '7', '1', '1', 'U00716', 'Palio', 'Adventure', '2006', 'Blanco', 'Mecánica', '1.8CC', '7500.00', 'Hasta 60 cuotas', null, null, null, '2017-08-22 17:26:42', '1');
INSERT INTO `vehiculo` VALUES ('23', '16', '2', '1', '3', '5', '1', 'U01288', 'Grand Cherokee', 'Limited', '2012', 'Blanco', 'Automática', '3.0CC', '57000.00', 'Hasta 60 Cuotas', null, null, null, '2017-08-22 17:52:33', '1');
INSERT INTO `vehiculo` VALUES ('24', '16', '3', '1', '3', '5', '1', 'U01521', 'Grand Cherokee', 'Limited', '2012', 'Negro', 'Automática', '3.6CC', '40000.00', 'Hasta 60 Cuotas', null, null, null, '2017-08-22 17:56:42', '1');
INSERT INTO `vehiculo` VALUES ('25', '16', '3', '1', '3', '5', '1', 'U01402', 'Grand Cherokee', 'Limited', '2012', 'Plata', 'Automática', '3.6CC', '39000.00', 'Hasta 60 Cuotas', null, null, null, '2017-08-22 18:08:28', '1');
INSERT INTO `vehiculo` VALUES ('26', '17', '2', '1', '7', '1', '1', 'U01504', 'Carnival', 'EX', '2012', 'Blanco', 'Automática', '2.9CC', '27000.00', 'Hasta 48 Cuotas', null, null, null, '2017-08-23 09:01:04', '1');
INSERT INTO `vehiculo` VALUES ('27', '17', '2', '1', '7', '1', '1', 'U01452', 'Carnival', 'EX', '2009', 'Negro', 'Automática', '2.9CC', '17000.00', 'Hasta 48 Cuotas', null, null, null, '2017-08-23 09:05:57', '1');
INSERT INTO `vehiculo` VALUES ('28', '17', '1', '1', '1', '1', '1', 'U01348', 'Optima', 'EX', '2014', 'Plata', 'Automática', '2.4', '25000.00', 'Hasta 60 Cuotas', null, null, null, '2017-08-23 09:13:18', '1');
INSERT INTO `vehiculo` VALUES ('29', '26', '1', '1', '12', '1', '1', 'U01479', 'Clubman', 'Cooper S', '2013', 'Rojo / Techo Negro', 'Automática', '1.6CC', '39000.00', 'Hasta 60 Cuotas', null, null, null, '2017-08-23 09:19:16', '1');
INSERT INTO `vehiculo` VALUES ('30', '26', '1', '1', '12', '5', '1', 'U01481', 'Countryman', 'Cooper S', '2011', 'Gris Oscuro', 'Automática', '1.6CC', '24800.00', 'Hasta 60 cuotas', null, null, null, '2017-08-23 09:23:07', '1');
INSERT INTO `vehiculo` VALUES ('31', '26', '1', '1', '12', '1', '1', 'U01125', 'Hatch', 'Cooper S', '2012', 'Negro', 'Automática', '1.6CC', '35000.00', 'Hasta 60 Cuotas', null, null, null, '2017-08-23 09:26:29', '1');
INSERT INTO `vehiculo` VALUES ('32', '26', '1', '1', '12', '5', '1', 'U01534', 'Countryman', 'Cooper S', '2014', 'Blanco / Techo Negro', 'Automática', '1.6CC', '43000.00', 'Hasta 60 Cuotas', null, null, null, '2017-08-23 09:29:43', '1');
INSERT INTO `vehiculo` VALUES ('33', '26', '1', '1', '12', '1', '1', 'U00996', 'Hatch', 'Cooper', '2011', 'Beige', 'Mecánica', '1.6CC', '23000.00', 'Hasta 60 Cuotas', null, null, null, '2017-08-23 09:33:19', '1');
INSERT INTO `vehiculo` VALUES ('34', '28', '1', '1', '3', '1', '1', 'U00595', 'Murano', null, '2008', 'Plata', 'Automática', '3.5CC', '22000.00', 'Hasta 60 Cuotas', null, null, null, '2017-08-23 09:36:24', '1');
INSERT INTO `vehiculo` VALUES ('35', '45', '3', '1', '8', '1', '3', '132524', 'Agile', 'LTZ', '2012', 'Plata', 'Mecánica', '1.4', '10500.00', 'Hasta 48 meses', null, null, null, '2017-08-23 09:39:31', '1');
INSERT INTO `vehiculo` VALUES ('36', '17', '1', '1', '1', '1', '3', '040073', 'Rio', 'Sedan', '2012', 'Gris Oscuro', 'Automática', '1.4', '15500.00', 'Hasta 48 Meses', null, null, null, '2017-08-23 09:42:57', '1');
INSERT INTO `vehiculo` VALUES ('37', '33', '3', '1', '1', '1', '3', '563405', 'Symbol', 'Sedan', '2011', 'Rojo', 'Mecánica', '1.6', '10000.00', 'Hasta 48 meses', null, null, null, '2017-08-23 09:46:10', '1');
INSERT INTO `vehiculo` VALUES ('38', '45', '1', '1', '1', '1', '3', '155981', 'New Corsa', null, '2007', 'Blanco', 'Mecánica', '1.8', '8000.00', 'Hasta 36 meses', null, null, null, '2017-08-23 09:48:56', '1');
INSERT INTO `vehiculo` VALUES ('39', '45', '2', '1', '3', '5', '3', '017427', 'Captiva', 'LTZ', '2012', 'Beige', 'Automática', '2.2', '34000.00', 'Hasta 48 meses', null, null, null, '2017-08-23 09:52:05', '1');
INSERT INTO `vehiculo` VALUES ('40', '17', '2', '1', '3', '5', '3', '046442', 'Mohave', 'EX A/T', '2009', 'Blanco', 'Automática', '3.0', '26000.00', 'Hasta 48 meses', null, null, null, '2017-08-23 09:58:57', '1');
INSERT INTO `vehiculo` VALUES ('41', '4', '1', '1', '3', '1', '3', '069205', 'Q5', 'FSI', '2011', 'Negro', 'Automática', '3.2', '41500.00', 'Hasta 48 meses', null, null, null, '2017-08-23 10:16:14', '1');
INSERT INTO `vehiculo` VALUES ('42', '49', '2', '1', '10', '5', '3', '000029', 'QD32T', 'D/C', '2013', 'Azul', 'Mecánica de 5 Vel.', '3.2', '17500.00', 'Hasta 48 meses', null, null, null, '2017-08-23 11:00:35', '1');
INSERT INTO `vehiculo` VALUES ('43', '46', '1', '1', '3', '3', '1', 'U01920', 'Durango', 'LIMITED', '2014', 'Bordó', 'Automática', '3.6L V6', '39000.00', 'Hasta 60 Cuotas', null, '37995', null, '2017-09-20 11:36:10', '1');
INSERT INTO `vehiculo` VALUES ('44', '46', '1', '1', '3', '1', '1', 'U02123', 'Durango', 'SXT', '2013', 'Grafito', 'Automática', '3.6L V6', '27000.00', 'Hasta 60 Cuotas', null, '57293', null, '2017-09-20 11:49:55', '1');
INSERT INTO `vehiculo` VALUES ('45', '16', '1', '1', '3', '4', '1', 'U02144', 'WRANGLER', 'Rubicon', '2016', 'Plata', 'Automática', '3.6', '49000.00', 'Hasta 60 Cuotas', null, '10986', null, '2017-09-20 11:54:36', '1');
INSERT INTO `vehiculo` VALUES ('46', '6', '2', '1', '3', '5', '1', 'U02053', 'X5', 'XDRIVE', '2011', 'Azul', 'Automática', '3.0 TDI', '45000.00', 'Hasta 60 Cuotas', null, '116385', null, '2017-09-20 14:12:41', '1');
INSERT INTO `vehiculo` VALUES ('47', '43', '2', '1', '3', '5', '1', 'U01753', 'TOUAREG', 'DSL', '2009', 'Verde', 'Automática', '3.0', '33000.00', 'Hasta 60 cuotas', null, '83582', null, '2017-09-20 14:26:17', '1');
INSERT INTO `vehiculo` VALUES ('48', '38', '2', '1', '10', '5', '1', 'U01957', 'KYRON', 'DSL', '2008', 'Negro', 'Automática', '2.0', '11500.00', 'Hasta 60 Cuotas', null, '88215', null, '2017-09-20 14:38:22', '1');
INSERT INTO `vehiculo` VALUES ('49', '16', '3', '1', '3', '1', '1', 'U02111', 'Renegade', 'LONGITUDE', '2016', 'Negro', 'Automática', 'FWD 1.8', '30000.00', 'Hasta 60 Cuotas', null, null, null, '2017-09-20 14:42:34', '1');
INSERT INTO `vehiculo` VALUES ('50', '28', '1', '1', '3', '1', '1', 'U02143', 'X-TRAIL', null, '2012', 'Blanco', 'Automática', '', '18000.00', 'Hasta 60 Cuotas', null, '72847', null, '2017-09-20 14:48:41', '1');
INSERT INTO `vehiculo` VALUES ('51', '11', '2', '1', '10', '5', '1', 'U01880', 'F-250', 'DSL D/C', '2011', 'PLATA', 'Mecánica', '3.9', '27000.00', 'Hasta 60 Cuotas', null, '94964', null, '2017-09-20 14:57:13', '1');
INSERT INTO `vehiculo` VALUES ('52', '23', '2', '1', '10', '5', '1', 'U02041', 'BT-50', 'D/C FULL', '2011', 'Plata', 'Mecánica', '', '21500.00', 'Hasta 60 Cuotas', null, '134096', null, '2017-09-20 15:05:25', '1');
INSERT INTO `vehiculo` VALUES ('53', '46', '1', '1', '7', '1', '1', 'U02172', 'Journey', 'SE', '2014', 'AZUL OSCURO', 'Automática', '2.4', '38000.00', 'Hasta 60 Cuotas', null, '37063', null, '2017-09-20 15:09:48', '1');
INSERT INTO `vehiculo` VALUES ('54', '26', '1', '1', '8', '1', '1', 'U01899', 'HATCH 3DOOR', 'COOPER', '2012', 'Chocolate', 'Automática', '', '17000.00', 'Hasta 60 Cuotas', null, '28523', null, '2017-09-20 15:22:52', '1');
INSERT INTO `vehiculo` VALUES ('55', '26', '1', '1', '8', '1', '1', 'U02124', 'HATCH 3DOOR', 'COOPER', '2013', 'BLANCO', 'Automática', '', '17000.00', 'Hasta 60 Cuotas', null, '8484', null, '2017-09-20 15:42:47', '1');
INSERT INTO `vehiculo` VALUES ('56', '26', '1', '1', '8', '3', '1', 'U01196', 'COUNTRYMAN', 'COOPER S ALL4', '2013', 'Plata', 'Automática', '', '40000.00', 'Hasta 60 Cuotas', null, '11000', null, '2017-09-20 15:52:59', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=265 DEFAULT CHARSET=utf8;

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
INSERT INTO `vehiculo_img` VALUES ('68', '22', '22_palioadventure.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('69', '22', '22_palioadventure_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('70', '22', '22_palioadventure_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('71', '22', '22_palioadventure_4.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('72', '23', '23_jeep_cherokee.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('73', '23', '23_jeep_cherokee_1.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('74', '23', '23_jeep_cherokee_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('75', '23', '23_jeep_cherokee_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('76', '24', '24_jeep_cherokee_negra.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('77', '24', '24_jeep_cherokee_negra_1.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('78', '24', '24_jeep_cherokee_negra_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('79', '24', '24_jeep_cherokee_negra_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('80', '25', '25_jeep_cherokee_gris_1.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('81', '25', '25_jeep_cherokee_gris_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('82', '25', '25_jeep_cherokee_gris_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('83', '25', '25_jeep_cherokee_gris_4.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('84', '26', '26_carnival2012.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('85', '26', '26_carnival2012_1.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('86', '26', '26_carnival2012_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('87', '26', '26_carnival2012_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('88', '27', '27_carnival2009.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('89', '27', '27_carnival2009_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('90', '27', '27_carnival2009_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('91', '27', '27_carnival2009_4.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('92', '28', '28_optima-ex-2014.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('93', '28', '28_optima-ex-2014_1.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('94', '28', '28_optima-ex-2014_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('95', '28', '28_optima-ex-2014_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('96', '29', '29_mini-clubman-coopers_2013.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('97', '29', '29_mini-clubman-coopers_2013_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('98', '29', '29_mini-clubman-coopers_2013_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('99', '29', '29_mini-clubman-coopers_2013_4.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('100', '30', '30_mini_countryman_2011.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('101', '30', '30_mini_countryman_2011_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('102', '30', '30_mini_countryman_2011_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('103', '30', '30_mini_countryman_2011_4.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('104', '31', '31_mini_hatch_2012.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('105', '31', '31_mini_hatch_2012_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('106', '31', '31_mini_hatch_2012_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('107', '31', '31_mini_hatch_2012_4.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('108', '32', '32_mini_countryman_2014.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('109', '32', '32_mini_countryman_2014_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('110', '32', '32_mini_countryman_2014_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('111', '32', '32_mini_countryman_2014_4.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('112', '33', '33_mini_hatch_beige_2011.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('113', '33', '33_mini_hatch_beige_2011_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('114', '33', '33_mini_hatch_beige_2011_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('115', '33', '33_mini_hatch_beige_2011_4.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('116', '34', '34_nissan_murano_2008.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('117', '34', '34_nissan_murano_2008_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('118', '34', '34_nissan_murano_2008_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('119', '34', '34_nissan_murano_2008_4.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('120', '35', '35_chevrolet-agile_2012.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('121', '35', '35_chevrolet-agile_2012_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('122', '35', '35_chevrolet-agile_2012_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('123', '35', '35_chevrolet-agile_2012_4.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('124', '36', '36_kia-rio-sedan_2012.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('125', '36', '36_kia-rio-sedan_2012_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('126', '36', '36_kia-rio-sedan_2012_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('127', '36', '36_kia-rio-sedan_2012_4.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('128', '37', '37_reunalt_symbol_2011.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('129', '37', '37_reunalt_symbol_2011_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('130', '37', '37_reunalt_symbol_2011_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('131', '37', '37_reunalt_symbol_2011_4.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('132', '38', '38_chevrolet_new_corsa_2007.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('133', '38', '38_chevrolet_new_corsa_2007_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('134', '38', '38_chevrolet_new_corsa_2007_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('135', '38', '38_chevrolet_new_corsa_2007_4.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('136', '39', '39_chevrolet-captiva_2012.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('137', '39', '39_chevrolet-captiva_2012_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('138', '39', '39_chevrolet-captiva_2012_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('139', '39', '39_chevrolet-captiva_2012_4.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('140', '40', '40_kia-mohave-2009.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('141', '40', '40_kia-mohave-2009_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('142', '40', '40_kia-mohave-2009_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('143', '40', '40_kia-mohave-2009_4.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('144', '41', '41_audi-q5-fsi_2011.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('145', '41', '41_audi-q5-fsi_2011_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('146', '41', '41_audi-q5-fsi_2011_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('147', '41', '41_audi-q5-fsi_2011_4.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('148', '42', '42_zna-qd32t.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('149', '42', '42_zna-qd32t_2.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('150', '42', '42_zna-qd32t_3.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('151', '42', '42_zna-qd32t_4.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('167', '43', '43_IMG_6493.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('168', '43', '43_IMG_6494.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('169', '43', '43_IMG_6492.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('170', '43', '43_IMG_6491.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('171', '43', '43_IMG_6490.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('172', '44', '44_IMG_6495.JPG', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('173', '44', '44_IMG_6496.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('174', '44', '44_IMG_6497.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('175', '44', '44_IMG_6499.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('176', '44', '44_IMG_6500.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('177', '44', '44_IMG_6501.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('178', '45', '45_IMG_6398.JPG', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('179', '45', '45_IMG_6399.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('180', '45', '45_IMG_6400.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('181', '45', '45_IMG_6401.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('182', '45', '45_IMG_6402.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('183', '45', '45_IMG_6403.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('184', '45', '45_IMG_6405.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('185', '45', '45_IMG_6406.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('186', '45', '45_IMG_6407.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('187', '45', '45_IMG_6408.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('188', '45', '45_IMG_6409.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('190', '45', '45_IMG_6411.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('191', '46', '46_IMG_6412.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('192', '46', '46_IMG_6417.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('193', '46', '46_IMG_6418.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('194', '46', '46_IMG_6420.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('195', '46', '46_IMG_6421.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('196', '46', '46_IMG_6422.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('197', '46', '46_IMG_6413.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('198', '46', '46_IMG_6414.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('199', '46', '46_IMG_6415.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('200', '47', '47_IMG_6423.JPG', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('201', '47', '47_IMG_6425.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('202', '47', '47_IMG_6426.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('203', '47', '47_IMG_6427.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('204', '47', '47_IMG_6428.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('205', '47', '47_IMG_6430.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('206', '47', '47_IMG_6432.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('207', '48', '48_IMG_6433.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('208', '48', '48_IMG_6434.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('209', '48', '48_IMG_6435.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('210', '48', '48_IMG_6436.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('211', '48', '48_IMG_6439.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('212', '48', '48_IMG_6438.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('213', '48', '48_IMG_6441.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('214', '48', '48_IMG_6437.jpg', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('215', '49', '49_IMG_6442.JPG', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('216', '49', '49_IMG_6443.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('217', '49', '49_IMG_6444.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('218', '49', '49_IMG_6446.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('219', '49', '49_IMG_6447.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('220', '49', '49_IMG_6450.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('221', '49', '49_IMG_6451.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('222', '49', '49_IMG_6453.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('223', '49', '49_IMG_6454.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('224', '49', '49_IMG_6455.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('225', '50', '50_IMG_6456.JPG', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('226', '50', '50_IMG_6457.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('227', '50', '50_IMG_6458.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('228', '50', '50_IMG_6460.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('229', '51', '51_IMG_6467.JPG', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('230', '51', '51_IMG_6468.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('231', '51', '51_IMG_6469.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('232', '51', '51_IMG_6470.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('233', '51', '51_IMG_6471.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('234', '52', '52_IMG_6472.JPG', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('235', '52', '52_IMG_6473.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('236', '52', '52_IMG_6474.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('237', '52', '52_IMG_6475.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('238', '52', '52_IMG_6477.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('239', '53', '53_IMG_6483.JPG', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('240', '53', '53_IMG_6484.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('241', '53', '53_IMG_6485.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('242', '53', '53_IMG_6486.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('243', '53', '53_IMG_6487.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('244', '53', '53_IMG_6489.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('245', '54', '54_IMG_6502.JPG', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('246', '54', '54_IMG_6503.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('247', '54', '54_IMG_6504.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('248', '54', '54_IMG_6505.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('249', '54', '54_IMG_6506.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('250', '54', '54_IMG_6507.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('251', '55', '55_IMG_6509.JPG', '1', '1');
INSERT INTO `vehiculo_img` VALUES ('252', '55', '55_IMG_6510.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('253', '55', '55_IMG_6511.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('254', '55', '55_IMG_6512.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('255', '55', '55_IMG_6515.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('256', '55', '55_IMG_6516.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('257', '55', '55_IMG_6517.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('258', '56', '56_IMG_6518.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('259', '56', '56_IMG_6519.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('260', '56', '56_IMG_6520.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('261', '56', '56_IMG_6521.JPG', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('262', '56', '56_IMG_6522.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('263', '56', '56_IMG_6523.jpg', '0', '1');
INSERT INTO `vehiculo_img` VALUES ('264', '56', '56_IMG_6524.jpg', '1', '1');
