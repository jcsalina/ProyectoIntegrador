-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.1.53-community-log - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para proyectoministerio
CREATE DATABASE IF NOT EXISTS `proyectoministerio` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `proyectoministerio`;

-- Volcando estructura para tabla proyectoministerio.agendamiento
CREATE TABLE IF NOT EXISTS `agendamiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) NOT NULL,
  `fecha_cita` timestamp NULL DEFAULT NULL,
  `estado` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `paciente_id` (`paciente_id`),
  CONSTRAINT `paciente_persona_agendamiento
` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyectoministerio.agendamiento: ~45 rows (aproximadamente)
/*!40000 ALTER TABLE `agendamiento` DISABLE KEYS */;
REPLACE INTO `agendamiento` (`id`, `paciente_id`, `fecha_cita`, `estado`) VALUES
	(1, 1, '2018-12-12 00:00:00', 'Agendada'),
	(2, 1, '2018-12-20 10:40:00', 'Pendiente'),
	(3, 1, '2019-02-27 00:00:00', 'Agendada'),
	(4, 4, '2019-02-28 00:00:00', 'Agendada'),
	(5, 3, '2019-02-23 00:00:00', 'Agendada'),
	(6, 1, '2019-01-31 00:00:00', 'Agendada'),
	(7, 4, '2019-02-25 00:00:00', 'Agendada'),
	(8, 4, '2019-02-27 00:00:00', 'Agendada'),
	(9, 3, '2019-02-28 00:00:00', 'Agendada'),
	(10, 4, '2019-02-27 00:00:00', 'Agendada'),
	(11, 4, '2019-02-27 00:00:00', 'Agendada'),
	(12, 4, '2019-02-27 00:00:00', 'Agendada'),
	(13, 4, '2019-02-27 00:00:00', 'Agendada'),
	(14, 4, '2019-02-27 00:00:00', 'Agendada'),
	(15, 4, '2019-02-27 00:00:00', 'Agendada'),
	(16, 4, '2019-02-27 00:00:00', 'Agendada'),
	(17, 4, '2019-02-27 00:00:00', 'Agendada'),
	(18, 3, '2019-02-27 00:00:00', 'Agendada'),
	(19, 4, '2019-02-27 00:00:00', 'Agendada'),
	(21, 2, '2019-01-30 00:00:00', 'Agendada'),
	(22, 2, '2019-03-28 00:00:00', 'Agendada'),
	(23, 4, '2019-02-28 00:00:00', 'Agendada'),
	(24, 4, '2019-02-28 00:00:00', 'Agendada'),
	(25, 4, '2019-02-27 00:00:00', 'Agendada'),
	(26, 3, '2019-02-27 00:00:00', 'Agendada'),
	(27, 4, '2019-02-28 00:00:00', 'Agendada'),
	(28, 4, '2019-02-28 00:00:00', 'Agendada'),
	(29, 4, '2019-02-28 00:00:00', 'Agendada'),
	(30, 4, '2019-02-28 00:00:00', 'Agendada'),
	(31, 4, '2019-02-28 00:00:00', 'Agendada'),
	(32, 4, '2019-02-28 00:00:00', 'Agendada'),
	(33, 3, '2019-02-28 00:00:00', 'Agendada'),
	(34, 4, '2019-02-28 00:00:00', 'Agendada'),
	(35, 4, '2019-02-28 00:00:00', 'Agendada'),
	(36, 4, '2019-02-28 00:00:00', 'Agendada'),
	(37, 4, '2019-02-28 00:00:00', 'Agendada'),
	(38, 3, '2019-02-28 00:00:00', 'Agendada'),
	(39, 3, '2019-02-28 00:00:00', 'Agendada'),
	(40, 4, '2019-03-01 00:00:00', 'Agendada'),
	(41, 4, '2019-03-01 00:00:00', 'Agendada'),
	(42, 4, '2019-03-01 00:00:00', 'Agendada'),
	(43, 1, '2019-03-02 00:00:00', 'Agendada'),
	(44, 5, '2019-03-02 00:00:00', 'Agendada'),
	(45, 4, '2019-03-02 00:00:00', 'Agendada'),
	(46, 2, '2019-03-02 00:00:00', 'Agendada');
/*!40000 ALTER TABLE `agendamiento` ENABLE KEYS */;

-- Volcando estructura para tabla proyectoministerio.campana
CREATE TABLE IF NOT EXISTS `campana` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `edad` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyectoministerio.campana: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `campana` DISABLE KEYS */;
REPLACE INTO `campana` (`id`, `nombre`, `fecha_inicio`, `fecha_fin`, `edad`, `estado`) VALUES
	(2, 'Influenza', '2019-01-18', '2019-01-31', 1, 1),
	(3, 'Fiebre', '2019-01-01', '2019-01-31', 2, 1),
	(4, 'fiebre abrial', '2019-01-01', '2019-02-28', 12, 1),
	(5, 'HN', '2019-01-26', '2019-04-27', 120, 1),
	(6, 'abcd', '2019-01-02', '2019-01-24', 2, 1);
/*!40000 ALTER TABLE `campana` ENABLE KEYS */;

-- Volcando estructura para tabla proyectoministerio.captacion
CREATE TABLE IF NOT EXISTS `captacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyectoministerio.captacion: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `captacion` DISABLE KEYS */;
REPLACE INTO `captacion` (`id`, `nombre`) VALUES
	(1, 'Temporal'),
	(2, 'Tardio');
/*!40000 ALTER TABLE `captacion` ENABLE KEYS */;

-- Volcando estructura para tabla proyectoministerio.cargo
CREATE TABLE IF NOT EXISTS `cargo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyectoministerio.cargo: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `cargo` DISABLE KEYS */;
REPLACE INTO `cargo` (`id`, `nombre`) VALUES
	(1, 'Administrador'),
	(2, 'Enfermera');
/*!40000 ALTER TABLE `cargo` ENABLE KEYS */;

-- Volcando estructura para tabla proyectoministerio.control
CREATE TABLE IF NOT EXISTS `control` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) NOT NULL,
  `BCG` date DEFAULT NULL,
  `HBO` date DEFAULT NULL,
  `rotavirus1` date DEFAULT NULL,
  `rotavirus2` date DEFAULT NULL,
  `pentavalente1` date DEFAULT NULL,
  `pentavalente2` date DEFAULT NULL,
  `pentavalente3` date DEFAULT NULL,
  `poliomielitis1` date DEFAULT NULL,
  `poliomielitis2` date DEFAULT NULL,
  `poliomielitis3` date DEFAULT NULL,
  `neumococo1` date DEFAULT NULL,
  `neumococo2` date DEFAULT NULL,
  `neumococo3` date DEFAULT NULL,
  `SR` date DEFAULT NULL,
  `SRP` date DEFAULT NULL,
  `varicela` date DEFAULT NULL,
  `FA` date DEFAULT NULL,
  `OPV` date DEFAULT NULL,
  `Influenza` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `paciente_id` (`paciente_id`),
  CONSTRAINT `paciente_id` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyectoministerio.control: ~28 rows (aproximadamente)
/*!40000 ALTER TABLE `control` DISABLE KEYS */;
REPLACE INTO `control` (`id`, `paciente_id`, `BCG`, `HBO`, `rotavirus1`, `rotavirus2`, `pentavalente1`, `pentavalente2`, `pentavalente3`, `poliomielitis1`, `poliomielitis2`, `poliomielitis3`, `neumococo1`, `neumococo2`, `neumococo3`, `SR`, `SRP`, `varicela`, `FA`, `OPV`, `Influenza`) VALUES
	(1, 1, NULL, NULL, NULL, '2019-01-30', '2019-01-30', '2019-01-30', '2019-01-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 2, '2019-01-30', '2019-01-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-30', '2019-01-30', NULL, '2019-01-30', '2019-01-30', '2019-01-30'),
	(5, 3, '2019-01-02', '2019-01-15', NULL, NULL, NULL, NULL, NULL, '2019-01-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(6, 4, '2019-01-29', '2019-01-30', '2019-01-02', NULL, '2019-01-15', NULL, '2019-01-28', NULL, '2019-01-29', NULL, '2019-01-29', NULL, NULL, '2019-01-30', '2019-01-30', NULL, '2019-01-30', '2019-01-30', '2019-01-30'),
	(7, 5, '2017-04-04', NULL, '2017-11-27', '2018-02-08', '2017-11-27', '2018-02-08', '2018-04-26', '2017-11-27', '2018-02-08', '2018-04-26', '2017-11-27', '2018-02-08', '2018-04-26', NULL, '2018-11-05', '2019-01-30', '2018-11-05', NULL, NULL),
	(8, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(9, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(10, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(11, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(12, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(13, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(14, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(15, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(16, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(17, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(18, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(19, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(20, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(21, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(22, 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(23, 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(24, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(25, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(26, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(27, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(28, 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(29, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(30, 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `control` ENABLE KEYS */;

-- Volcando estructura para tabla proyectoministerio.controlcampana
CREATE TABLE IF NOT EXISTS `controlcampana` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) NOT NULL,
  `campana_id` int(11) NOT NULL,
  `fecha_suministro` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `controlcampana_paciente_id` (`paciente_id`),
  KEY `controlcampana_campana_id` (`campana_id`),
  CONSTRAINT `controlcampana_campana_id` FOREIGN KEY (`campana_id`) REFERENCES `campana` (`id`),
  CONSTRAINT `controlcampana_paciente_id` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyectoministerio.controlcampana: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `controlcampana` DISABLE KEYS */;
REPLACE INTO `controlcampana` (`id`, `paciente_id`, `campana_id`, `fecha_suministro`) VALUES
	(1, 3, 2, '2019-01-11');
/*!40000 ALTER TABLE `controlcampana` ENABLE KEYS */;

-- Volcando estructura para tabla proyectoministerio.empleado
CREATE TABLE IF NOT EXISTS `empleado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula_persona` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(30) NOT NULL,
  `estado` varchar(30) NOT NULL DEFAULT '1',
  `cargo_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cargo_id` (`cargo_id`),
  KEY `cedula_persona_empleado` (`cedula_persona`),
  CONSTRAINT `cargo_id` FOREIGN KEY (`cargo_id`) REFERENCES `cargo` (`id`),
  CONSTRAINT `cedula_persona_empleado` FOREIGN KEY (`cedula_persona`) REFERENCES `persona` (`cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyectoministerio.empleado: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
REPLACE INTO `empleado` (`id`, `cedula_persona`, `usuario`, `clave`, `estado`, `cargo_id`) VALUES
	(1, '0803106509', 'pcmacias', 'pcmacias123', '0', 2),
	(2, '0925048598', 'caalmoli', 'caalmoli123', '1', 1),
	(3, '0930442447', 'jimdgonz', 'jimdgonz123', '1', 2),
	(4, '1600470437', 'msanchez', 'marcelo123', '1', 1),
	(5, '1234567890', 'piguave', 'qwertyuiop', '1', 2),
	(11, '1600222437', 'ftrabubu', 'ftrabubu123', '1', 1),
	(12, '1293454394', 'jpastor', 'jpastor1233', '1', 2),
	(13, '0953338910', 'kejova17', '0953338910', '1', 1);
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;

-- Volcando estructura para tabla proyectoministerio.etnia
CREATE TABLE IF NOT EXISTS `etnia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyectoministerio.etnia: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `etnia` DISABLE KEYS */;
REPLACE INTO `etnia` (`id`, `nombre`) VALUES
	(1, 'Indigena'),
	(2, 'Afro'),
	(3, 'Negro'),
	(4, 'Mulato/a'),
	(5, 'Montubio/a'),
	(6, 'Mestizo/a'),
	(7, 'Blanco/a'),
	(8, 'Otro');
/*!40000 ALTER TABLE `etnia` ENABLE KEYS */;

-- Volcando estructura para tabla proyectoministerio.historial
CREATE TABLE IF NOT EXISTS `historial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) NOT NULL,
  `empleado_id` int(11) NOT NULL,
  `fecha` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `paciente_id` (`paciente_id`),
  KEY `empleado_id` (`empleado_id`),
  CONSTRAINT `empleado_id_historial` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`),
  CONSTRAINT `paciente_id_historial` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyectoministerio.historial: ~103 rows (aproximadamente)
/*!40000 ALTER TABLE `historial` DISABLE KEYS */;
REPLACE INTO `historial` (`id`, `paciente_id`, `empleado_id`, `fecha`) VALUES
	(1, 3, 4, '2019-01-21 11:40:54'),
	(2, 3, 4, '2019-01-21 11:59:02'),
	(3, 3, 4, '2019-01-21 12:07:09'),
	(4, 3, 4, '2019-01-21 12:07:18'),
	(5, 3, 4, '2019-01-21 12:07:26'),
	(6, 3, 4, '2019-01-21 12:09:30'),
	(7, 3, 4, '2019-01-21 12:09:40'),
	(8, 3, 4, '2019-01-21 12:11:50'),
	(9, 3, 4, '2019-01-21 12:13:33'),
	(10, 3, 4, '2019-01-21 12:15:29'),
	(11, 3, 4, '2019-01-21 12:16:29'),
	(12, 3, 4, '2019-01-21 12:16:35'),
	(13, 3, 4, '2019-01-21 12:28:18'),
	(14, 3, 4, '2019-01-21 12:30:02'),
	(15, 3, 4, '2019-01-21 12:33:35'),
	(16, 3, 4, '2019-01-21 12:39:14'),
	(17, 3, 4, '2019-01-21 12:39:14'),
	(18, 3, 4, '2019-01-21 12:41:55'),
	(19, 3, 4, '2019-01-21 12:41:55'),
	(20, 3, 2, '2019-01-21 15:40:38'),
	(21, 3, 2, '2019-01-21 15:40:38'),
	(22, 3, 2, '2019-01-21 16:14:18'),
	(23, 3, 2, '2019-01-21 16:14:18'),
	(24, 1, 2, '2019-01-21 20:38:11'),
	(25, 1, 2, '2019-01-21 20:38:11'),
	(26, 4, 2, '2019-01-23 05:25:29'),
	(27, 4, 2, '2019-01-23 05:25:29'),
	(28, 3, 2, '2019-01-23 16:09:52'),
	(29, 3, 2, '2019-01-23 16:09:52'),
	(30, 4, 2, '2019-01-25 23:28:11'),
	(31, 4, 2, '2019-01-25 23:28:11'),
	(32, 4, 2, '2019-01-27 05:09:28'),
	(33, 4, 2, '2019-01-27 05:09:28'),
	(34, 3, 2, '2019-01-28 05:02:10'),
	(35, 3, 2, '2019-01-28 05:02:10'),
	(36, 4, 2, '2019-01-28 05:24:51'),
	(37, 4, 2, '2019-01-28 05:24:51'),
	(38, 4, 2, '2019-01-28 05:27:36'),
	(39, 4, 2, '2019-01-28 05:27:36'),
	(40, 4, 2, '2019-01-28 05:40:42'),
	(41, 4, 2, '2019-01-28 05:40:42'),
	(42, 4, 2, '2019-01-28 05:47:13'),
	(43, 4, 2, '2019-01-28 05:47:13'),
	(44, 4, 2, '2019-01-28 05:55:15'),
	(45, 4, 2, '2019-01-28 05:55:15'),
	(46, 4, 2, '2019-01-28 05:57:40'),
	(47, 4, 2, '2019-01-28 05:57:40'),
	(48, 4, 2, '2019-01-28 06:03:36'),
	(49, 4, 2, '2019-01-28 06:03:36'),
	(50, 4, 2, '2019-01-28 06:08:34'),
	(51, 4, 2, '2019-01-28 06:08:34'),
	(52, 3, 2, '2019-01-28 06:10:53'),
	(53, 3, 2, '2019-01-28 06:10:53'),
	(54, 4, 2, '2019-01-28 06:11:53'),
	(55, 4, 2, '2019-01-28 06:11:53'),
	(56, 4, 2, '2019-01-28 06:40:02'),
	(57, 4, 2, '2019-01-28 06:40:02'),
	(58, 4, 2, '2019-01-28 06:43:54'),
	(59, 4, 2, '2019-01-28 06:43:54'),
	(60, 4, 2, '2019-01-28 06:49:22'),
	(61, 4, 2, '2019-01-28 06:49:22'),
	(62, 3, 2, '2019-01-28 06:51:48'),
	(63, 3, 2, '2019-01-28 06:51:48'),
	(64, 4, 2, '2019-01-29 04:30:11'),
	(65, 4, 2, '2019-01-29 04:30:11'),
	(66, 4, 2, '2019-01-29 04:34:37'),
	(67, 4, 2, '2019-01-29 04:34:37'),
	(68, 4, 2, '2019-01-29 04:34:56'),
	(69, 4, 2, '2019-01-29 04:34:56'),
	(70, 4, 2, '2019-01-29 04:36:45'),
	(71, 4, 2, '2019-01-29 04:36:45'),
	(72, 4, 2, '2019-01-29 04:39:20'),
	(73, 4, 2, '2019-01-29 04:39:20'),
	(74, 4, 2, '2019-01-29 04:40:40'),
	(75, 4, 2, '2019-01-29 04:40:40'),
	(76, 3, 2, '2019-01-29 04:41:42'),
	(77, 3, 2, '2019-01-29 04:41:42'),
	(78, 4, 2, '2019-01-29 05:08:02'),
	(79, 4, 2, '2019-01-29 05:08:02'),
	(80, 4, 2, '2019-01-29 05:41:08'),
	(81, 4, 2, '2019-01-29 05:41:08'),
	(82, 4, 2, '2019-01-29 05:41:27'),
	(83, 4, 2, '2019-01-29 05:41:27'),
	(84, 4, 2, '2019-01-29 05:43:50'),
	(85, 4, 2, '2019-01-29 05:43:50'),
	(86, 3, 2, '2019-01-29 05:44:35'),
	(87, 3, 2, '2019-01-29 05:44:35'),
	(88, 3, 2, '2019-01-29 05:45:56'),
	(89, 3, 2, '2019-01-29 05:45:56'),
	(90, 4, 2, '2019-01-30 16:23:48'),
	(91, 4, 2, '2019-01-30 16:23:48'),
	(92, 4, 13, '2019-01-30 20:24:53'),
	(93, 4, 13, '2019-01-30 20:24:53'),
	(94, 4, 13, '2019-01-30 20:36:13'),
	(95, 4, 13, '2019-01-30 20:36:13'),
	(96, 1, 13, '2019-01-31 16:28:46'),
	(97, 1, 13, '2019-01-31 16:28:46'),
	(98, 5, 13, '2019-01-31 17:47:32'),
	(99, 5, 13, '2019-01-31 17:47:32'),
	(100, 4, 2, '2019-01-31 23:52:43'),
	(101, 4, 2, '2019-01-31 23:52:43'),
	(102, 2, 2, '2019-01-31 23:54:35'),
	(103, 2, 2, '2019-01-31 23:54:35');
/*!40000 ALTER TABLE `historial` ENABLE KEYS */;

-- Volcando estructura para tabla proyectoministerio.insumo
CREATE TABLE IF NOT EXISTS `insumo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(255) NOT NULL,
  `calibre` varchar(11) NOT NULL,
  `estado` varchar(30) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyectoministerio.insumo: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `insumo` DISABLE KEYS */;
REPLACE INTO `insumo` (`id`, `nombre`, `calibre`, `estado`) VALUES
	(9, 'Jeringa', '25', '1'),
	(10, 'Jeringa', '23 g x 1 ml', '1'),
	(13, 'jeringa', '23', '1'),
	(14, 'llllll', '123', '1'),
	(15, 'jeringa', '12345', '1');
/*!40000 ALTER TABLE `insumo` ENABLE KEYS */;

-- Volcando estructura para tabla proyectoministerio.nacionalidad
CREATE TABLE IF NOT EXISTS `nacionalidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyectoministerio.nacionalidad: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `nacionalidad` DISABLE KEYS */;
REPLACE INTO `nacionalidad` (`id`, `nombre`) VALUES
	(1, 'Ecuatoriano'),
	(2, 'Colombiano'),
	(3, 'Peruano'),
	(4, 'Cubano'),
	(5, 'Venezolano'),
	(6, 'Otro');
/*!40000 ALTER TABLE `nacionalidad` ENABLE KEYS */;

-- Volcando estructura para tabla proyectoministerio.paciente
CREATE TABLE IF NOT EXISTS `paciente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula_persona` varchar(50) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `sexo_id` int(11) NOT NULL,
  `cedula_padre` varchar(50) DEFAULT NULL,
  `nombre_padre` varchar(50) DEFAULT NULL,
  `cedula_madre` varchar(11) NOT NULL,
  `nombre_madre` varchar(50) NOT NULL,
  `etnia_id` int(11) NOT NULL,
  `nacionalidad_id` int(11) NOT NULL,
  `captacion_id` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `pertenencia_distrito` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_captacion` (`captacion_id`),
  KEY `id_sexo` (`sexo_id`),
  KEY `id_etnia` (`etnia_id`),
  KEY `id_nacionalidad` (`nacionalidad_id`),
  KEY `cedula_paciente` (`cedula_persona`),
  CONSTRAINT `captacion_id` FOREIGN KEY (`captacion_id`) REFERENCES `captacion` (`id`),
  CONSTRAINT `cedula_persona_paciente` FOREIGN KEY (`cedula_persona`) REFERENCES `persona` (`cedula`),
  CONSTRAINT `etnia_id` FOREIGN KEY (`etnia_id`) REFERENCES `etnia` (`id`),
  CONSTRAINT `nacionalidad_id` FOREIGN KEY (`nacionalidad_id`) REFERENCES `nacionalidad` (`id`),
  CONSTRAINT `sexo_id` FOREIGN KEY (`sexo_id`) REFERENCES `sexo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyectoministerio.paciente: ~28 rows (aproximadamente)
/*!40000 ALTER TABLE `paciente` DISABLE KEYS */;
REPLACE INTO `paciente` (`id`, `cedula_persona`, `fecha_nacimiento`, `sexo_id`, `cedula_padre`, `nombre_padre`, `cedula_madre`, `nombre_madre`, `etnia_id`, `nacionalidad_id`, `captacion_id`, `estado`, `pertenencia_distrito`) VALUES
	(1, '0803106509', '2018-12-26', 2, '0299848567', 'Marco', '0923453232', 'Patricia', 1, 2, 1, '1', 2),
	(2, '0177327281', '1991-01-03', 1, '0459338292', 'Andres', '0739493812', 'Julia', 2, 4, 2, '1', 2),
	(3, '0185739911', '2015-01-03', 2, '0324285739', 'Francisco', '0924927131', 'Fatima', 3, 6, 1, '1', 2),
	(4, '0918164047', '2018-12-01', 1, '', '', '0992444668', 'Lucia', 4, 5, 1, '1', 2),
	(5, '0961914314', '2017-09-27', 2, '', '', '09191922236', 'Nicole Zurita', 5, 1, 1, '', 1),
	(6, '0962005070', '2017-11-09', 1, '', '', '0952492148', 'Luisa Mariduena', 6, 1, 1, '', 1),
	(7, '0962010880', '2017-11-11', 2, '', '', '0951515493', 'Demera Kelly', 7, 1, 1, '', 1),
	(8, '0962134771', '2018-01-08', 1, '', '', '1204987307', 'Sanchez Nathali', 8, 1, 1, '', 1),
	(9, '0962015319', '2017-11-23', 1, '', 'Bryan Palacios', '0927403436', 'Evelyn Vera', 6, 1, 1, '', 1),
	(10, '0952033452', '2017-11-21', 2, '', '', '0923715387', 'Maria Pamila', 6, 1, 1, '', 1),
	(11, '0962161659', '2018-01-13', 2, '', '', '0927210872', 'Barahona Kathiuska', 6, 1, 1, '', 1),
	(12, '0962035556', '2017-11-21', 1, '', '', '0928325836', 'Carra Carbo', 6, 1, 1, '', 1),
	(13, '0962041430', '2017-11-25', 2, '', '', '0927249987', 'Asuncion Pin Diana', 6, 1, 1, '', 1),
	(14, '0962024550', '2018-10-10', 2, '', '', '0930086988', 'Anzulez Maria', 6, 1, 1, '', 1),
	(15, '0962047155', '2017-11-28', 2, '', '', '9999999999', 'Maria Holguin', 6, 1, 1, '', 1),
	(16, '0962007373', '2017-11-09', 2, '', '', '9999999999', 'Procel Maria', 6, 1, 1, '', 1),
	(17, '0962210803', '2018-02-08', 2, '', '', '0917981524', 'Cajamarca Josefina', 6, 1, 1, '', 1),
	(18, '0962080727', '2017-12-11', 2, '', '', '1317068706', 'Maria Vera', 6, 1, 1, '', 1),
	(19, '0962099628', '2017-12-19', 1, '', '', '0928101674', 'Elizabeth Dominguez', 6, 1, 1, '', 1),
	(20, '0962163754', '2018-01-19', 2, '', '', '0940634751', 'Mera Sandy', 4, 1, 1, '', 1),
	(21, '0962094389', '2017-12-19', 1, '', '', '9999999999', 'Lopez Mirian', 6, 1, 1, '', 1),
	(22, '0962105243', '2017-12-24', 2, '', '', '0952114536', 'Chele Lesly', 6, 1, 1, '', 1),
	(23, '0933004905', '2017-12-02', 1, '', '', '9999999999', 'Katherine Vasquez', 6, 1, 1, '', 1),
	(24, '0933005175', '2017-12-25', 2, '', '', '0923793384', 'Karen Robles', 6, 1, 1, '', 1),
	(25, '0962243762', '2018-02-24', 2, '', '', '9999999999', 'Goya Nury', 6, 1, 1, '', 1),
	(26, '0962081121', '2017-12-13', 2, '', '', '0908158883', 'Constante', 6, 1, 1, '', 1),
	(27, '0962114831', '2019-12-27', 2, '', '', '0950749424', 'Guaman Libia', 6, 1, 1, '', 1),
	(28, '0962120283', '2017-12-31', 2, '', '', '1303681496', 'Chong Adriana', 6, 1, 1, '', 1);
/*!40000 ALTER TABLE `paciente` ENABLE KEYS */;

-- Volcando estructura para tabla proyectoministerio.persona
CREATE TABLE IF NOT EXISTS `persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(50) NOT NULL,
  `nombre` char(255) NOT NULL,
  `apellido` char(255) NOT NULL,
  `correo` char(255) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cedula` (`cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyectoministerio.persona: ~36 rows (aproximadamente)
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
REPLACE INTO `persona` (`id`, `cedula`, `nombre`, `apellido`, `correo`, `direccion`, `telefono`) VALUES
	(1, '0803106509', 'Patricia', 'Macias', 'patmac_19@hotmail.com', 'Via a la Costa Km 5 1/2', '0990058425'),
	(2, '0925048598', 'Carlos', 'Molina', 'carlos.molina@hotmail.com', 'Trinitaria', '0987865463'),
	(3, '0930442447', 'Jimmy', 'Gonzales', 'jimdgonz@hotmail.com', '26 y Febres Cordero', '042461915'),
	(4, '0930673645', 'Daniel', 'Torres', 'saul.torres@hotmail', 'D y la 26', '0992194333'),
	(5, '1600470437', 'Marcelo', 'Sanchez', 'msanchez@@maill.com', 'Urdesa Central', '0984347576'),
	(6, '1234567890', 'Juan', 'Piguave', 'jpiguave@maill.com', 'Vernaza', '0925436676'),
	(7, '1600222437', 'Frank', 'Trabubu', 'ftbb@maill.com', 'Kennedy Norte', '0984334567'),
	(10, '0177327281', 'Mario', 'Sanders', 'msanders@mail.com', 'Alborada V Etapa', '0984534504'),
	(11, '0185739911', 'Julia', 'Lajas', 'jlajas@mail.com', 'Samanes 1', '0982948298'),
	(12, '1293454394', 'Juan', 'Pastor', 'jpastor@mail.com', 'Urdenor', '0934323454'),
	(13, '0918164047', 'Jordy', 'Lago', 'jlago@outlook.es', 'alborada', '0995706313'),
	(14, '0953338910', 'keyla', 'Guzman', 'keylaagm_12@hotmail.com', 'sedalana', '0986618437'),
	(15, '0961914314', 'Azul Alejandra', 'Moncayo Zurita', '', 'Martha de Roldos mz 605 v 11', '043083951'),
	(16, '0962005070', 'Leopoldo', 'Pilozo Mariduena', '', 'Martha Roldos Mz 417 V 6', '0996610527'),
	(17, '0962010880', 'Bianka Isabel', 'Vera Demera', '', 'Coop 1 de Mayo Mz 506 V1', '0969978674'),
	(18, '0962134771', 'Luis Andres', 'Onate Sanchez', '', 'Martha de Roldos mz 204 v 6', '0950190516'),
	(19, '0962015319', 'Thiago Mathias', 'Palacios Vera', '', 'Coop. 26 de febrero MZ 232 SL3', '0969500010'),
	(20, '0952033452', 'Danna Raphaella', 'Bustamante Panila', '', 'Coop Madrigar Mz 6 v !3', '0989606386'),
	(21, '0962161659', 'Ariana Rafaela', 'Balladares Barahona', '', 'Coop Madrigar Mz 5 v 2', '0994932505'),
	(22, '0962035556', 'Dylan Sebastian', 'Cedeno Carbo', '', 'Martha Roldos Mz 118 V 9', '0987283681'),
	(23, '0962041430', 'Noelia Michelle', 'Vera Asuncion', '', 'Martha de Roldos mz 701 v 14', '0960777824'),
	(24, '0962024550', 'Ailyn Danasha', 'Gonzabay Arzulez', '', 'Coop Madrigar Mz 241 v 8', '0988826266'),
	(25, '0962047155', 'Mazli Kiara', 'Bonoso Holguin', '', 'Copp Hijos del suelo mz 207 s 14', '042935270'),
	(26, '0962007373', 'Valentina', 'Villamar Procel', '', 'Martha de Roldos mz 112 v 8', '0995735638'),
	(27, '0962210803', 'Domenica Brigite', 'Bonozo Cajamarca', '', 'Martha de Roldos mz 501 v 3', '0939064308'),
	(28, '0962080727', 'Sarai Isabel', 'Busto Vera', '', 'Cdla Adriana mz 3 solar 18', '0998594231'),
	(29, '0962099628', 'Mathias Ruben', 'Baque Dominguez', '', 'Martha Roldos Mz 702 V 1', '0996846312'),
	(30, '0962163754', 'Danna Saori', 'Choez Mera', '', 'Cdla Santa Adriana Mz 11 V 1', '0991586723'),
	(31, '0962094389', 'Dereck Benjamin', 'Ponce Lopez', '', 'Mapasingue Copp hijos de suelo mz 256 s 16', '0991508298'),
	(32, '0962105243', 'Elisa Kataleya', 'Robles Chele', '', 'Coop Las rocas mz 469 s 9', '0997947319'),
	(33, '0933004905', 'Santiago Jesus', 'Jimenez Vasquez', '', 'Mapasingue Mz 246 v 8', '0986459564'),
	(34, '0933005175', 'Dannia Paulete', 'Mendieta Robles', '', 'Las Rocas mz 490 v4', '0987687152'),
	(35, '0962243762', 'Nurely Franchesca', 'Machuca Goya', '', 'Coop 26 de Febrero mz 318 s 1', '0983655247'),
	(36, '0962081121', 'Isabel Sofia', 'Rivas Constante', '', 'Coop 26 de Febrero mz 250 s 5', '0978701661'),
	(37, '0962114831', 'Cristhell Analy', 'Quishpi Guaman', '', 'Martha de Roldos mz 601 v 8', '0091426161'),
	(38, '0962120283', 'Guaman Chong', 'Leila Magdalena', '', 'Coop Las Rocas', '0939477025');
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;

-- Volcando estructura para tabla proyectoministerio.sexo
CREATE TABLE IF NOT EXISTS `sexo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyectoministerio.sexo: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `sexo` DISABLE KEYS */;
REPLACE INTO `sexo` (`id`, `nombre`) VALUES
	(1, 'Masculino'),
	(2, 'Fenenino');
/*!40000 ALTER TABLE `sexo` ENABLE KEYS */;

-- Volcando estructura para tabla proyectoministerio.stockinsumo
CREATE TABLE IF NOT EXISTS `stockinsumo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lote` int(11) NOT NULL,
  `cantidad` varchar(200) NOT NULL,
  `fecha_ingreso` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_expiracion` timestamp NULL DEFAULT NULL,
  `id_insumo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_insumo` (`id_insumo`),
  CONSTRAINT `id_insumo` FOREIGN KEY (`id_insumo`) REFERENCES `insumo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyectoministerio.stockinsumo: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `stockinsumo` DISABLE KEYS */;
REPLACE INTO `stockinsumo` (`id`, `lote`, `cantidad`, `fecha_ingreso`, `fecha_expiracion`, `id_insumo`) VALUES
	(1, 2, '30', '2019-01-02 00:00:00', '2019-03-18 00:00:00', 9),
	(2, 54321, '20', '2019-02-08 00:00:00', '2019-03-02 00:00:00', 10),
	(3, 12345, '25', '2019-01-05 00:00:00', '2019-01-25 00:00:00', 13),
	(4, 12345, '15', '2019-01-01 00:00:00', '2019-01-31 00:00:00', 15);
/*!40000 ALTER TABLE `stockinsumo` ENABLE KEYS */;

-- Volcando estructura para tabla proyectoministerio.stockvacuna
CREATE TABLE IF NOT EXISTS `stockvacuna` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lote` int(11) NOT NULL,
  `cantidad` varchar(200) NOT NULL,
  `fecha_ingreso` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_expiracion` timestamp NULL DEFAULT NULL,
  `id_vacuna` int(11) NOT NULL,
  `dosis` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_vacuna` (`id_vacuna`),
  CONSTRAINT `id_vacuna` FOREIGN KEY (`id_vacuna`) REFERENCES `vacuna` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyectoministerio.stockvacuna: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `stockvacuna` DISABLE KEYS */;
REPLACE INTO `stockvacuna` (`id`, `lote`, `cantidad`, `fecha_ingreso`, `fecha_expiracion`, `id_vacuna`, `dosis`) VALUES
	(1, 300, '20', '2019-01-05 00:00:00', '2019-04-12 00:00:00', 8, 34);
/*!40000 ALTER TABLE `stockvacuna` ENABLE KEYS */;

-- Volcando estructura para tabla proyectoministerio.vacuna
CREATE TABLE IF NOT EXISTS `vacuna` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(255) NOT NULL,
  `tipo` char(255) NOT NULL,
  `estado` varchar(30) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyectoministerio.vacuna: ~15 rows (aproximadamente)
/*!40000 ALTER TABLE `vacuna` DISABLE KEYS */;
REPLACE INTO `vacuna` (`id`, `nombre`, `tipo`, `estado`) VALUES
	(1, 'Influenza', 'INTRAMUSCULAR', '1'),
	(2, 'SRP', 'SUBCUTANEA', '1'),
	(3, 'HBO', 'INTRAMUSCULAR', '1'),
	(4, 'Rotavirus', 'VIA ORAL', '1'),
	(5, 'Pentavalente', 'INTRAMUSCULAR', '1'),
	(6, 'Poliomielitis', 'INTRADERMICA', '1'),
	(7, 'Poliomielitis 3', 'VIA ORAL', '1'),
	(8, 'BCG', 'INTRADERMICA', '1'),
	(9, 'Neumococo', 'INTRAMUSCULAR', '1'),
	(10, 'SR', 'SUBCUTANEA', '1'),
	(11, 'Varicela', 'SUBCUTANEA', '1'),
	(12, 'FA', 'SUBCUTANEA', '1'),
	(13, 'OPV', 'VIA ORAL', '1'),
	(14, 'DPT', 'INTRAMUSCULAR', '1'),
	(27, 'Michael', 'ssss', '1');
/*!40000 ALTER TABLE `vacuna` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
