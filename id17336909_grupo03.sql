-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 02-08-2021 a las 23:54:19
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id17336909_grupo03`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carga`
--

CREATE TABLE `carga` (
  `id_carga` int(11) NOT NULL,
  `peso` decimal(10,2) UNSIGNED ZEROFILL NOT NULL,
  `peligrosa` bit(1) NOT NULL,
  `id_tipo_peligro` int(11) DEFAULT NULL,
  `refrigerada` bit(1) NOT NULL,
  `temperatura` int(11) DEFAULT NULL,
  `id_tipo_carga` int(11) NOT NULL,
  `id_viaje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `carga`
--

INSERT INTO `carga` (`id_carga`, `peso`, `peligrosa`, `id_tipo_peligro`, `refrigerada`, `temperatura`, `id_tipo_carga`, `id_viaje`) VALUES
(1, 00001000.00, b'0', 1, b'1', 2, 4, 1),
(2, 00000132.00, b'1', 5, b'0', 0, 3, 2),
(3, 00000132.00, b'0', 5, b'1', -3, 3, 5),
(4, 00000198.00, b'0', 1, b'0', 0, 4, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carga_combustible`
--

CREATE TABLE `carga_combustible` (
  `id_carga_combustible` int(11) NOT NULL,
  `lugar` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `importe` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `carga_combustible`
--

INSERT INTO `carga_combustible` (`id_carga_combustible`, `lugar`, `cantidad`, `importe`) VALUES
(1, 'Ruta 5', 100.00, 1500.00),
(2, 'Shell estacion 12', 100.00, 15000.00),
(3, 'San Justo', 60.00, 880.00),
(4, 'Santa Teresita', 100.00, 3050.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chofer`
--

CREATE TABLE `chofer` (
  `id_chofer` int(11) NOT NULL,
  `numero_licencia` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `id_tipo_licencia` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `chofer`
--

INSERT INTO `chofer` (`id_chofer`, `numero_licencia`, `id_tipo_licencia`, `id_usuario`) VALUES
(1, '56124674', 2, 2),
(2, '564161', 1, 1),
(3, '188801', 2, 8),
(4, '664770', 1, 9),
(5, '998841', 2, 10),
(6, '6655412', 2, 11),
(7, '2988915', 1, 12),
(9, '1554887', 1, 13),
(11, '41517567', 1, 14),
(14, '891918', 1, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cuit` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `denominacion` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `contacto1` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contacto2` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `email`, `cuit`, `telefono`, `direccion`, `denominacion`, `contacto1`, `contacto2`) VALUES
(1, 'ypf@contacto.com', '146514412', '4658-4478', 'Rivadavia 1232', 'YPF', '1145221447', '1547114562'),
(2, 'laserenisima@gmail.com', '14401245685', '46517788', 'Triunvirato 1337', 'La Serenisima', '1551014474', '1526233598'),
(3, 'quilmes@gmail.com', '151784789', '44998899', 'Juan B Justo 5800', 'Cervezeria Quilmes', '1144775842', '1545678256'),
(4, 'molinosrdlp@gmail.com', '96812814', '44556987', 'Espinares 145', 'Molinos Rio De La Plata', '1544736652', '1599884575'),
(5, 'marolio@gmail.com', '984415452', '45698744', 'Igna 10030', 'Marolio', '1544122589', '11447321144'),
(6, 'heladeriagrido@gmail.com', '24385541264', '44434157', 'Av de mayo 11423', 'Heladeria Grido', '1144587412', '158896665');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desvio`
--

CREATE TABLE `desvio` (
  `id_desvio` int(11) NOT NULL,
  `razon` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tiempo` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `desvio`
--

INSERT INTO `desvio` (`id_desvio`, `razon`, `tiempo`) VALUES
(1, 'Construccion en la ruta', '02:00:00'),
(2, 'Ruta rota', '00:10:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_factura` int(11) NOT NULL,
  `numero_factura` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_facturacion` date NOT NULL,
  `fecha_pago` date DEFAULT NULL,
  `id_viaje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id_factura`, `numero_factura`, `fecha_facturacion`, `fecha_pago`, `id_viaje`) VALUES
(1, NULL, '2021-08-02', NULL, 1),
(2, NULL, '2021-08-02', NULL, 2),
(3, NULL, '2021-08-02', NULL, 5),
(4, NULL, '2021-08-02', NULL, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id_marca`, `nombre`) VALUES
(2, 'IVECO'),
(3, 'SCANIA'),
(4, 'M.BENZ'),
(10000, 'No especificado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo`
--

CREATE TABLE `modelo` (
  `id_modelo` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `id_marca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `modelo`
--

INSERT INTO `modelo` (`id_modelo`, `nombre`, `id_marca`) VALUES
(2, 'Cursor', 2),
(3, 'G310', 3),
(4, 'G410', 3),
(5, 'G460', 3),
(6, 'Actros 1846', 4),
(10000, 'No especificado', 10000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posicion`
--

CREATE TABLE `posicion` (
  `id_posicion` int(11) NOT NULL,
  `latitud` decimal(10,8) NOT NULL,
  `longitud` decimal(11,8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `posicion`
--

INSERT INTO `posicion` (`id_posicion`, `latitud`, `longitud`) VALUES
(1, -34.66680340, -58.58868030),
(2, -30.66680340, -50.58868030),
(3, 4.66680340, -58.58868030),
(4, 50.66680340, -58.58868030),
(5, -30.66680340, -58.58868030);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proforma`
--

CREATE TABLE `proforma` (
  `id_proforma` int(11) NOT NULL,
  `fecha_carga_proforma` date NOT NULL,
  `id_viaje` int(11) NOT NULL,
  `viatico_estimado` int(11) NOT NULL,
  `peaje_y_pesaje_estimado` int(11) NOT NULL,
  `extras_estimado` int(11) DEFAULT NULL,
  `hazard_estimado` int(11) DEFAULT NULL,
  `reefer_estimado` int(11) DEFAULT NULL,
  `fee_estimado` int(11) NOT NULL,
  `viatico_real` int(11) DEFAULT NULL,
  `peaje_y_pesaje_real` int(11) DEFAULT NULL,
  `extras_real` int(11) DEFAULT NULL,
  `hazard_real` int(11) DEFAULT NULL,
  `reefer_real` int(11) DEFAULT NULL,
  `fee_real` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `proforma`
--

INSERT INTO `proforma` (`id_proforma`, `fecha_carga_proforma`, `id_viaje`, `viatico_estimado`, `peaje_y_pesaje_estimado`, `extras_estimado`, `hazard_estimado`, `reefer_estimado`, `fee_estimado`, `viatico_real`, `peaje_y_pesaje_real`, `extras_real`, `hazard_real`, `reefer_real`, `fee_real`) VALUES
(1, '2021-08-02', 1, 1000, 6541, 1500, 1300, 1000, 2000, 940, 200, 500, NULL, NULL, NULL),
(2, '2021-08-02', 2, 200, 300, 400, 500, 600, 700, 17000, 50, NULL, 500, NULL, 60),
(3, '2021-08-02', 5, 200, 300, 400, 500, 600, 700, NULL, 265, 500, 100, 5000, NULL),
(4, '2021-08-02', 6, 600, 500, 800, 1000, 2000, 3005, 3550, 450, NULL, NULL, NULL, 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `remolque`
--

CREATE TABLE `remolque` (
  `id_remolque` int(11) NOT NULL,
  `id_tipo_remolque` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `remolque`
--

INSERT INTO `remolque` (`id_remolque`, `id_tipo_remolque`) VALUES
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(133, 1),
(134, 1),
(135, 1),
(136, 1),
(137, 1),
(138, 1),
(139, 1),
(140, 1),
(141, 1),
(151, 1),
(109, 2),
(110, 2),
(111, 2),
(112, 2),
(114, 3),
(115, 3),
(116, 3),
(117, 3),
(118, 3),
(119, 3),
(120, 3),
(121, 3),
(122, 4),
(123, 4),
(124, 4),
(125, 4),
(126, 4),
(127, 4),
(128, 4),
(129, 4),
(130, 4),
(131, 4),
(132, 4),
(142, 5),
(143, 5),
(144, 5),
(145, 5),
(146, 5),
(147, 5),
(148, 5),
(149, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre`, `descripcion`) VALUES
(1, 'Administrador', 'AdminDesc'),
(2, 'Supervisor', 'SupervisorDesc'),
(3, 'Encargado de Taller', 'EncargadoTallerDesc'),
(4, 'Chofer', 'ChoferDesc'),
(5, 'Mecanico', 'MecanicoDesc');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `service`
--

CREATE TABLE `service` (
  `id_service` int(11) NOT NULL,
  `fecha_service` date NOT NULL,
  `detalle` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `costo` decimal(10,2) UNSIGNED NOT NULL,
  `kilometraje_actual_unidad` int(10) UNSIGNED NOT NULL,
  `interno` bit(1) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_unidad_de_transporte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `service`
--

INSERT INTO `service` (`id_service`, `fecha_service`, `detalle`, `costo`, `kilometraje_actual_unidad`, `interno`, `id_usuario`, `id_unidad_de_transporte`) VALUES
(1, '2021-08-02', 'Cambio de bujia', 6010.00, 1300, b'1', 5, 17),
(2, '2021-07-28', 'Arreglo de espejos', 3900.00, 1040, b'0', NULL, 13),
(3, '2021-07-23', 'Cambio de aceite', 15000.00, 50005, b'1', 5, 23),
(4, '2020-12-12', 'Ajuste de direccion', 36000.00, 18110, b'0', NULL, 12),
(5, '2021-03-06', 'Arreglo de suspension', 10000.00, 28300, b'0', NULL, 9),
(6, '2021-09-09', 'Cambio de puertas', 50000.00, 19780, b'0', NULL, 14),
(7, '2019-05-15', 'Mano de pintura', 20190.00, 16005, b'1', 6, 150),
(8, '2021-11-06', 'Reemplazo de vidrio, puerta izquierda', 6500.00, 60700, b'1', 7, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_carga`
--

CREATE TABLE `tipo_carga` (
  `id_tipo_carga` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_carga`
--

INSERT INTO `tipo_carga` (`id_tipo_carga`, `nombre`, `descripcion`) VALUES
(1, 'Granel', 'Granel'),
(2, 'Liquida', 'Liquida'),
(3, '20\'\'', '20 Toneladas'),
(4, '40\'\'', '40 Toneladas'),
(5, 'Jaula', 'jaula'),
(6, 'CarCarrier', 'CarCarrier');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_licencia`
--

CREATE TABLE `tipo_licencia` (
  `id_tipo_licencia` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_licencia`
--

INSERT INTO `tipo_licencia` (`id_tipo_licencia`, `nombre`, `descripcion`) VALUES
(1, 'C', 'Camiones sin acoplado ni semiacoplado'),
(2, 'E.1', 'Camiones articulados, con acoplado o semiacoplado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_peligro`
--

CREATE TABLE `tipo_peligro` (
  `id_tipo_peligro` int(11) NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_peligro`
--

INSERT INTO `tipo_peligro` (`id_tipo_peligro`, `descripcion`) VALUES
(1, 'Clase 1.1'),
(2, 'Clase 1.2'),
(3, 'Clase 1.3'),
(4, 'Clase 1.4'),
(5, 'Clase 1.5'),
(6, 'Clase 1.6'),
(7, 'Clase 2.1'),
(8, 'Clase 2.2'),
(9, 'Clase 2.3'),
(10, 'Clase 3'),
(11, 'Clase 4.1'),
(12, 'Clase 4.2'),
(13, 'Clase 4.3'),
(14, 'Clase 5.1'),
(15, 'Clase 5.2'),
(16, 'Clase 6.1'),
(17, 'Clase 6.2'),
(18, 'Clase 7'),
(19, 'Clase 8'),
(20, 'Clase 9');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_remolque`
--

CREATE TABLE `tipo_remolque` (
  `id_tipo_remolque` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `peso_maximo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_remolque`
--

INSERT INTO `tipo_remolque` (`id_tipo_remolque`, `nombre`, `peso_maximo`) VALUES
(1, 'Araña', 100000),
(2, 'Jaula', 150000),
(3, 'Tanque', 15000),
(4, 'Granel', 30000),
(5, 'CarCarrier', 200000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_vehiculo`
--

CREATE TABLE `tipo_vehiculo` (
  `id_tipo_vehiculo` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_vehiculo`
--

INSERT INTO `tipo_vehiculo` (`id_tipo_vehiculo`, `nombre`) VALUES
(1, 'Camion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_de_transporte`
--

CREATE TABLE `unidad_de_transporte` (
  `id_unidad_de_transporte` int(11) NOT NULL,
  `patente` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `posicion_actual` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Sin posicion actual',
  `anio_fabricacion` smallint(6) NOT NULL DEFAULT 0,
  `numero_chasis` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `id_marca` int(11) NOT NULL DEFAULT 10000,
  `id_modelo` int(11) NOT NULL DEFAULT 10000,
  `activo` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `unidad_de_transporte`
--

INSERT INTO `unidad_de_transporte` (`id_unidad_de_transporte`, `patente`, `posicion_actual`, `anio_fabricacion`, `numero_chasis`, `id_marca`, `id_modelo`, `activo`) VALUES
(2, 'AA123CD', 'Sin posicion actual', 95, 'L53879558', 2, 2, 1),
(3, 'AA124DC', 'Sin posicion actual', 92, 'R69904367', 2, 2, 1),
(4, 'AD200XS', 'Sin posicion actual', 95, 'R57193968', 2, 2, 0),
(5, 'AA211ZX', 'Sin posicion actual', 98, 'N82836641', 2, 2, 1),
(6, 'AC452WE', 'Sin posicion actual', 96, 'R28204636', 2, 2, 1),
(7, 'AA233SS', 'Sin posicion actual', 91, 'K26139668', 2, 2, 0),
(8, 'AB900QW', 'Sin posicion actual', 92, 'F44301415', 2, 2, 1),
(9, 'AC342WW', 'Sin posicion actual', 95, 'D44260023', 2, 2, 1),
(10, 'AA150QW', 'Sin posicion actual', 97, 'I82039512', 3, 3, 1),
(11, 'AB198QZ', 'Sin posicion actual', 96, 'V18389741', 3, 4, 1),
(12, 'AC246QD', 'Sin posicion actual', 95, 'O62500687', 3, 5, 1),
(13, 'AD294QW', 'Sin posicion actual', 93, 'T27510702', 3, 3, 1),
(14, 'AA342QZ', 'Sin posicion actual', 99, 'C72582865', 3, 4, 1),
(15, 'AB390QD', 'http://www.google.com/maps/place/-33.6668034,-58.588680', 95, 'Z32041290', 3, 5, 1),
(16, 'AC438QW', 'Sin posicion actual', 91, 'W54712451', 3, 3, 1),
(17, 'AD486QZ', 'Sin posicion actual', 94, 'L56284263', 3, 4, 1),
(18, 'AA534QD', 'Sin posicion actual', 90, 'A21357689', 3, 5, 1),
(19, 'AB582QW', 'http://www.google.com/maps/place/-35.6668034,-58.5886803', 96, 'V17800122', 4, 6, 1),
(20, 'AC630QZ', 'http://www.google.com/maps/place/-32.6668034,-58.5886803', 95, 'G88648319', 4, 6, 1),
(21, 'AD678QD', 'http://www.google.com/maps/place/-36.6668034,-58.5886803', 90, 'C23849041', 4, 6, 1),
(22, 'AA726QW', 'Sin posicion actual', 94, 'C54650513', 4, 6, 1),
(23, 'AB774QZ', 'Sin posicion actual', 93, 'J46753468', 4, 6, 1),
(24, 'AC822QD', 'Sin posicion actual', 95, 'J60916748', 4, 6, 1),
(25, 'AD870QW', 'Sin posicion actual', 97, 'M30207594', 4, 6, 1),
(26, 'AA918QZ', 'Sin posicion actual', 90, 'C31256965', 4, 6, 1),
(27, 'AB966QD', 'Sin posicion actual', 93, 'B32632699', 4, 6, 1),
(28, 'AC989QW', 'Sin posicion actual', 90, 'F64092078', 4, 6, 1),
(100, 'AA100AS', 'Sin posicion actual', 0, '585822', 10000, 10000, 1),
(101, 'AC125AD', 'Sin posicion actual', 0, '605737', 10000, 10000, 1),
(102, 'AB135AG', 'Sin posicion actual', 0, '705687', 10000, 10000, 1),
(103, 'AD166AS', 'Sin posicion actual', 0, '815082', 10000, 10000, 1),
(104, 'AA189AD', 'Sin posicion actual', 0, '775167', 10000, 10000, 0),
(105, 'AC208AG', 'Sin posicion actual', 0, '642287', 10000, 10000, 1),
(106, 'AB230AS', 'Sin posicion actual', 0, '678666', 10000, 10000, 0),
(107, 'AD252AD', 'Sin posicion actual', 0, '758967', 10000, 10000, 1),
(108, 'AA274AG', 'Sin posicion actual', 0, '498515', 10000, 10000, 1),
(109, 'AC296AS', 'Sin posicion actual', 0, '882174', 10000, 10000, 1),
(110, 'AB318AD', 'Sin posicion actual', 0, '595287', 10000, 10000, 1),
(111, 'AD340AG', 'Sin posicion actual', 0, '549916', 10000, 10000, 1),
(112, 'AA362AS', 'Sin posicion actual', 0, '831768', 10000, 10000, 1),
(113, 'AC383AD', 'Sin posicion actual', 0, '535330', 10000, 10000, 1),
(114, 'AB405AG', 'Sin posicion actual', 0, '583419', 10000, 10000, 1),
(115, 'AD427AS', 'Sin posicion actual', 0, '703673', 10000, 10000, 1),
(116, 'AA449AD', 'Sin posicion actual', 0, '884654', 10000, 10000, 1),
(117, 'AC471AG', 'Sin posicion actual', 0, '510019', 10000, 10000, 1),
(118, 'AB493AS', 'Sin posicion actual', 0, '595948', 10000, 10000, 1),
(119, 'AD515AD', 'Sin posicion actual', 0, '704640', 10000, 10000, 1),
(120, 'AA537AG', 'Sin posicion actual', 0, '752105', 10000, 10000, 1),
(121, 'AC559AS', 'Sin posicion actual', 0, '554550', 10000, 10000, 1),
(122, 'AB581AD', 'Sin posicion actual', 0, '761560', 10000, 10000, 1),
(123, 'AD602AG', 'Sin posicion actual', 0, '555608', 10000, 10000, 1),
(124, 'AA624AS', 'Sin posicion actual', 0, '852157', 10000, 10000, 1),
(125, 'AC646AD', 'Sin posicion actual', 0, '710797', 10000, 10000, 1),
(126, 'AB668AG', 'Sin posicion actual', 0, '815072', 10000, 10000, 1),
(127, 'AD690AS', 'Sin posicion actual', 0, '495851', 10000, 10000, 1),
(128, 'AA712AD', 'Sin posicion actual', 0, '468708', 10000, 10000, 1),
(129, 'AC734AG', 'Sin posicion actual', 0, '661897', 10000, 10000, 1),
(130, 'AB756AS', 'Sin posicion actual', 0, '616372', 10000, 10000, 1),
(131, 'AD778AD', 'Sin posicion actual', 0, '873758', 10000, 10000, 1),
(132, 'AA800AG', 'Sin posicion actual', 0, '820810', 10000, 10000, 1),
(133, 'AC821AS', 'Sin posicion actual', 0, '731202', 10000, 10000, 1),
(134, 'AB843AD', 'Sin posicion actual', 0, '670323', 10000, 10000, 1),
(135, 'AD865AG', 'Sin posicion actual', 0, '747642', 10000, 10000, 1),
(136, 'AA887AS', 'http://www.google.com/maps/place/-32.6668034,-58.5886803', 0, '777450', 10000, 10000, 1),
(137, 'AC909AD', 'Sin posicion actual', 0, '485098', 10000, 10000, 1),
(138, 'AB931AG', 'Sin posicion actual', 0, '806730', 10000, 10000, 1),
(139, 'AD953AS', 'http://www.google.com/maps/place/-30.6668034,-58.5886803', 0, '729910', 10000, 10000, 1),
(140, 'AA975AD', 'Sin posicion actual', 0, '726457', 10000, 10000, 1),
(141, 'AC997AG', 'Sin posicion actual', 0, '730861', 10000, 10000, 1),
(142, 'AD100AZ', 'Sin posicion actual', 0, '730027', 10000, 10000, 1),
(143, 'AD100AQ', 'Sin posicion actual', 0, '730502', 10000, 10000, 1),
(144, 'AD100ER', 'Sin posicion actual', 0, '730978', 10000, 10000, 1),
(145, 'AD101EF', 'Sin posicion actual', 0, '731453', 10000, 10000, 1),
(146, 'AD102HG', 'Sin posicion actual', 0, '731929', 10000, 10000, 1),
(147, 'AD103LO', 'Sin posicion actual', 0, '732404', 10000, 10000, 1),
(148, 'AD104WE', 'Sin posicion actual', 0, '732880', 10000, 10000, 1),
(149, 'AD105ZP', 'Sin posicion actual', 0, '733355', 10000, 10000, 1),
(150, '133737', 'Sin posicion actual', 82, '24828', 3, 6, 1),
(151, 'TE1337ST', 'http://www.google.com/maps/place/-34.6668034,-58.5886803', 2002, '154614', 10000, 10000, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `dni` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `fecha_alta` date NOT NULL,
  `activado` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `email`, `password`, `nombre`, `apellido`, `dni`, `birthdate`, `fecha_alta`, `activado`) VALUES
(1, 'admin', 'nope', 'SA', 'Admin', '1234567', '1960-11-11', '2020-11-17', b'1'),
(2, 'gastonperez@gmail.com', '289dc4c3a387cb9cb6b6378d24d011ca', 'Gaston', 'Perez', '40123123', '1990-05-05', '2021-07-30', b'1'),
(3, 'franciscovegas@gmail.com', 'a248206a7117cb798a3141232e46db70', 'Francisco', 'Vegas', '36554887', '1980-08-11', '2021-08-02', b'1'),
(4, 'marialopez@gmail.com', 'd9416cda755244a7dbdbe2dcebf29004', 'Maria', 'Lopez', '37177447', '1990-02-09', '2021-08-02', b'1'),
(5, 'landonorris@gmail.com', '70359745179294d8b9c0463d3760dbc5', 'Lando', 'Norris', '40154778', '1995-07-06', '2021-08-02', b'1'),
(6, 'maxverst@gmail.com', 'b20d78ff235a5f157d638c0923dc5795', 'Max', 'Verst', '40551778', '1995-09-01', '2021-08-02', b'1'),
(7, 'lucianarodriguez@gmail.com', '7413c35e28b9312e000fc0a19884a39c', 'Luciana', 'Rodriguez', '378144710', '1990-12-15', '2021-08-02', b'1'),
(8, 'mariogimenez@gmail.com', 'b3d5d486d2106a48bfe1f63c8e7f2e4e', 'Mario', 'Gimenez', '38145411', '1983-05-05', '2021-08-02', b'1'),
(9, 'luismingo@gmail.com', '15292eb3f3149ed824199754c7f65569', 'Luis', 'Mingo', '15887446', '1968-11-13', '2021-08-02', b'1'),
(10, 'gabrielasuarez@gmail.com', 'd381dbd6a4052b4f40f9383f9b739942', 'Gabriela', 'Suarez', '30091178', '1978-08-08', '2021-08-02', b'1'),
(11, 'rodrigoelizald@gmail.com', 'a116cc6f10e6a1b454b19d41d693e19d', 'Rodrigo', 'Elizald', '36558747', '1980-04-29', '2021-08-02', b'1'),
(12, 'juanperez@gmail.com', '54e8a1106eeb36711ecb8c94598bcc70', 'Juan', 'Perez', '16998947', '1965-05-21', '2021-08-02', b'1'),
(13, 'mariorodriguez@gmail.com', '74d5ed326755654a3d30bb8e754830d2', 'Mario', 'Rodriguez', '38552114', '1983-03-06', '2021-08-02', b'1'),
(14, 'pablomartinez@gmail.com', 'a38b6fa3071d2f1198889438b91d70d9', 'Pablo', 'Martinez', '35669845', '1979-11-11', '2021-08-02', b'1'),
(15, 'melanienuñez@gmail.com', 'bec00ca16d91ead16ac8c1c05de1c345', 'Melanie', 'Nuñez', '36147852', '1980-01-05', '2021-08-02', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_rol`
--

CREATE TABLE `usuario_rol` (
  `id_usuario` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario_rol`
--

INSERT INTO `usuario_rol` (`id_usuario`, `id_rol`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(2, 4),
(3, 3),
(4, 2),
(5, 5),
(6, 5),
(7, 5),
(8, 4),
(9, 4),
(10, 4),
(11, 4),
(12, 4),
(13, 4),
(14, 4),
(15, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `id_vehiculo` int(11) NOT NULL,
  `numero_motor` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `kilometraje` decimal(10,2) NOT NULL,
  `id_tipo_vehiculo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`id_vehiculo`, `numero_motor`, `kilometraje`, `id_tipo_vehiculo`) VALUES
(2, '53879558', 6000.00, 1),
(3, '69904367', 62000.00, 1),
(4, '57193968', 64000.00, 1),
(5, '82836641', 16000.00, 1),
(6, '28204636', 56000.00, 1),
(7, '26139668', 6000.00, 1),
(8, '44301415', 46000.00, 1),
(9, '44260023', 16000.00, 1),
(10, '82039512', 26000.00, 1),
(11, '18389741', 36000.00, 1),
(12, '62500687', 46000.00, 1),
(13, '27510702', 56000.00, 1),
(14, '72582865', 66000.00, 1),
(15, '32041290', 86000.00, 1),
(16, '54712451', 9000.00, 1),
(17, '56284263', 2000.00, 1),
(18, '21357689', 36000.00, 1),
(19, '17800122', 64000.00, 1),
(20, '88648319', 65000.00, 1),
(21, '23849041', 60030.00, 1),
(22, '54650513', 60300.00, 1),
(23, '46753468', 60100.00, 1),
(24, '60916748', 60100.00, 1),
(25, '30207594', 60500.00, 1),
(26, '31256965', 60200.00, 1),
(27, '32632699', 66000.00, 1),
(28, '64092078', 67000.00, 1),
(150, '1337', 27825.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viaje`
--

CREATE TABLE `viaje` (
  `id_viaje` int(11) NOT NULL,
  `consumo_combustible_previsto` decimal(10,2) NOT NULL,
  `consumo_combustible_real` decimal(10,2) UNSIGNED ZEROFILL DEFAULT NULL,
  `kilometros_previstos` decimal(10,2) NOT NULL,
  `kilometros_reales` decimal(10,2) UNSIGNED ZEROFILL DEFAULT NULL,
  `origen` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `destino` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_salida_estimada` datetime NOT NULL,
  `fecha_salida` datetime DEFAULT NULL,
  `fecha_llegada_estimada` datetime NOT NULL,
  `fecha_llegada` datetime DEFAULT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `viaje`
--

INSERT INTO `viaje` (`id_viaje`, `consumo_combustible_previsto`, `consumo_combustible_real`, `kilometros_previstos`, `kilometros_reales`, `origen`, `destino`, `fecha_salida_estimada`, `fecha_salida`, `fecha_llegada_estimada`, `fecha_llegada`, `id_cliente`) VALUES
(1, 1200.00, 00002065.00, 1000.00, 00001500.00, 'Buenos Aires', 'Cordoba Capital', '2021-08-02 16:16:00', '2020-08-06 19:00:00', '2021-08-04 20:00:00', '2020-08-07 10:00:00', 1),
(2, 2000.00, 00000200.00, 2000.00, NULL, 'Santa Rosa', 'Tierra del Fuego', '2021-01-05 16:00:00', NULL, '2021-01-10 15:00:00', NULL, 5),
(3, 700.00, 00002000.00, 900.00, 00000850.00, 'La Plata', 'Miramar', '2021-05-05 16:00:00', '2021-08-19 19:02:00', '2021-05-06 13:00:00', '2021-08-19 19:00:00', 2),
(4, 300.00, NULL, 155.00, NULL, 'CABA', 'Zona Sur', '2020-01-06 19:00:00', NULL, '2020-01-08 20:01:00', NULL, 6),
(5, 200.00, NULL, 300.00, NULL, 'San Luis', 'San Juan', '2021-08-06 10:00:00', NULL, '2021-08-10 00:15:00', NULL, 4),
(6, 500.00, 00000100.00, 600.00, NULL, 'La Pampa', 'CABA', '2020-05-01 03:30:00', NULL, '2020-05-03 10:00:00', NULL, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viaje_carga_combustible`
--

CREATE TABLE `viaje_carga_combustible` (
  `id_viaje` int(11) NOT NULL,
  `id_carga_combustible` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `viaje_carga_combustible`
--

INSERT INTO `viaje_carga_combustible` (`id_viaje`, `id_carga_combustible`) VALUES
(1, 3),
(2, 1),
(2, 2),
(6, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viaje_chofer`
--

CREATE TABLE `viaje_chofer` (
  `id_viaje` int(11) NOT NULL,
  `id_chofer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `viaje_chofer`
--

INSERT INTO `viaje_chofer` (`id_viaje`, `id_chofer`) VALUES
(1, 1),
(2, 9),
(3, 7),
(4, 3),
(5, 7),
(6, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viaje_desvio`
--

CREATE TABLE `viaje_desvio` (
  `id_viaje` int(11) NOT NULL,
  `id_desvio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `viaje_desvio`
--

INSERT INTO `viaje_desvio` (`id_viaje`, `id_desvio`) VALUES
(2, 1),
(6, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viaje_posicion`
--

CREATE TABLE `viaje_posicion` (
  `id_viaje` int(11) NOT NULL,
  `id_posicion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `viaje_posicion`
--

INSERT INTO `viaje_posicion` (`id_viaje`, `id_posicion`) VALUES
(1, 5),
(2, 1),
(2, 3),
(5, 2),
(6, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viaje_unidad_de_transporte`
--

CREATE TABLE `viaje_unidad_de_transporte` (
  `id_viaje` int(11) NOT NULL,
  `id_unidad_de_transporte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `viaje_unidad_de_transporte`
--

INSERT INTO `viaje_unidad_de_transporte` (`id_viaje`, `id_unidad_de_transporte`) VALUES
(1, 15),
(1, 139),
(2, 20),
(2, 136),
(3, 17),
(3, 140),
(4, 21),
(4, 110),
(5, 19),
(5, 151),
(6, 21),
(6, 151);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carga`
--
ALTER TABLE `carga`
  ADD PRIMARY KEY (`id_carga`),
  ADD KEY `id_tipo_carga_INDEX` (`id_tipo_carga`),
  ADD KEY `id_viaje_INDEX` (`id_viaje`),
  ADD KEY `id_tipo_peligro_INDEX` (`id_viaje`),
  ADD KEY `tipo_peligro_FK` (`id_tipo_peligro`);

--
-- Indices de la tabla `carga_combustible`
--
ALTER TABLE `carga_combustible`
  ADD PRIMARY KEY (`id_carga_combustible`);

--
-- Indices de la tabla `chofer`
--
ALTER TABLE `chofer`
  ADD PRIMARY KEY (`id_chofer`),
  ADD UNIQUE KEY `license_number_UNIQUE` (`numero_licencia`),
  ADD KEY `id_tipo_licencia_INDEX` (`id_tipo_licencia`),
  ADD KEY `usuario_chofer_FK` (`id_usuario`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `cuit_UNIQUE` (`cuit`);

--
-- Indices de la tabla `desvio`
--
ALTER TABLE `desvio`
  ADD PRIMARY KEY (`id_desvio`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `id_viaje_INDEX` (`id_viaje`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD PRIMARY KEY (`id_modelo`),
  ADD KEY `id_marca_INDEX` (`id_marca`);

--
-- Indices de la tabla `posicion`
--
ALTER TABLE `posicion`
  ADD PRIMARY KEY (`id_posicion`);

--
-- Indices de la tabla `proforma`
--
ALTER TABLE `proforma`
  ADD PRIMARY KEY (`id_proforma`),
  ADD KEY `id_viaje_INDEX` (`id_viaje`);

--
-- Indices de la tabla `remolque`
--
ALTER TABLE `remolque`
  ADD PRIMARY KEY (`id_remolque`),
  ADD KEY `id_tipo_remolque_INDEX` (`id_tipo_remolque`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id_service`),
  ADD KEY `id_usuario_INDEX` (`id_usuario`),
  ADD KEY `id_unidad_de_transporte_INDEX` (`id_unidad_de_transporte`);

--
-- Indices de la tabla `tipo_carga`
--
ALTER TABLE `tipo_carga`
  ADD PRIMARY KEY (`id_tipo_carga`);

--
-- Indices de la tabla `tipo_licencia`
--
ALTER TABLE `tipo_licencia`
  ADD PRIMARY KEY (`id_tipo_licencia`);

--
-- Indices de la tabla `tipo_peligro`
--
ALTER TABLE `tipo_peligro`
  ADD PRIMARY KEY (`id_tipo_peligro`);

--
-- Indices de la tabla `tipo_remolque`
--
ALTER TABLE `tipo_remolque`
  ADD PRIMARY KEY (`id_tipo_remolque`);

--
-- Indices de la tabla `tipo_vehiculo`
--
ALTER TABLE `tipo_vehiculo`
  ADD PRIMARY KEY (`id_tipo_vehiculo`);

--
-- Indices de la tabla `unidad_de_transporte`
--
ALTER TABLE `unidad_de_transporte`
  ADD PRIMARY KEY (`id_unidad_de_transporte`),
  ADD UNIQUE KEY `patente_UNIQUE` (`patente`),
  ADD UNIQUE KEY `numero_chasis_UNIQUE` (`numero_chasis`),
  ADD KEY `id_marca_INDEX` (`id_marca`),
  ADD KEY `id_modelo_INDEX` (`id_modelo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `dni_UNIQUE` (`dni`);

--
-- Indices de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD PRIMARY KEY (`id_usuario`,`id_rol`),
  ADD KEY `rol_FK_idx` (`id_rol`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`id_vehiculo`),
  ADD UNIQUE KEY `numero_motor_UNIQUE` (`numero_motor`),
  ADD KEY `id_tipo_vehiculo_INDEX` (`id_tipo_vehiculo`),
  ADD KEY `unidad_de_transporte_FK_idx` (`id_vehiculo`);

--
-- Indices de la tabla `viaje`
--
ALTER TABLE `viaje`
  ADD PRIMARY KEY (`id_viaje`),
  ADD KEY `id_cliente_INDEX` (`id_cliente`);

--
-- Indices de la tabla `viaje_carga_combustible`
--
ALTER TABLE `viaje_carga_combustible`
  ADD PRIMARY KEY (`id_viaje`,`id_carga_combustible`),
  ADD KEY `carga_combustible_FK_idx` (`id_carga_combustible`);

--
-- Indices de la tabla `viaje_chofer`
--
ALTER TABLE `viaje_chofer`
  ADD PRIMARY KEY (`id_viaje`,`id_chofer`),
  ADD KEY `chofer_FK_idx` (`id_chofer`);

--
-- Indices de la tabla `viaje_desvio`
--
ALTER TABLE `viaje_desvio`
  ADD PRIMARY KEY (`id_viaje`,`id_desvio`),
  ADD KEY `desvio_FK_idx` (`id_desvio`);

--
-- Indices de la tabla `viaje_posicion`
--
ALTER TABLE `viaje_posicion`
  ADD PRIMARY KEY (`id_viaje`,`id_posicion`),
  ADD KEY `posicion_FK_idx` (`id_posicion`);

--
-- Indices de la tabla `viaje_unidad_de_transporte`
--
ALTER TABLE `viaje_unidad_de_transporte`
  ADD PRIMARY KEY (`id_viaje`,`id_unidad_de_transporte`),
  ADD KEY `id_unidad_de_transporte_idx` (`id_unidad_de_transporte`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carga`
--
ALTER TABLE `carga`
  MODIFY `id_carga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `carga_combustible`
--
ALTER TABLE `carga_combustible`
  MODIFY `id_carga_combustible` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `chofer`
--
ALTER TABLE `chofer`
  MODIFY `id_chofer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `desvio`
--
ALTER TABLE `desvio`
  MODIFY `id_desvio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `posicion`
--
ALTER TABLE `posicion`
  MODIFY `id_posicion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `proforma`
--
ALTER TABLE `proforma`
  MODIFY `id_proforma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `remolque`
--
ALTER TABLE `remolque`
  MODIFY `id_remolque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `service`
--
ALTER TABLE `service`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tipo_carga`
--
ALTER TABLE `tipo_carga`
  MODIFY `id_tipo_carga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipo_licencia`
--
ALTER TABLE `tipo_licencia`
  MODIFY `id_tipo_licencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_peligro`
--
ALTER TABLE `tipo_peligro`
  MODIFY `id_tipo_peligro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `tipo_remolque`
--
ALTER TABLE `tipo_remolque`
  MODIFY `id_tipo_remolque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo_vehiculo`
--
ALTER TABLE `tipo_vehiculo`
  MODIFY `id_tipo_vehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `unidad_de_transporte`
--
ALTER TABLE `unidad_de_transporte`
  MODIFY `id_unidad_de_transporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `viaje`
--
ALTER TABLE `viaje`
  MODIFY `id_viaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carga`
--
ALTER TABLE `carga`
  ADD CONSTRAINT `tipo_carga_FK` FOREIGN KEY (`id_tipo_carga`) REFERENCES `tipo_carga` (`id_tipo_carga`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tipo_peligro_FK` FOREIGN KEY (`id_tipo_peligro`) REFERENCES `tipo_peligro` (`id_tipo_peligro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `viaje_carga_FK` FOREIGN KEY (`id_viaje`) REFERENCES `viaje` (`id_viaje`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `chofer`
--
ALTER TABLE `chofer`
  ADD CONSTRAINT `tipo_licencia_FK` FOREIGN KEY (`id_tipo_licencia`) REFERENCES `tipo_licencia` (`id_tipo_licencia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_chofer_FK` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `viaje_factura_FK` FOREIGN KEY (`id_viaje`) REFERENCES `viaje` (`id_viaje`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD CONSTRAINT `marca_FK` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `proforma`
--
ALTER TABLE `proforma`
  ADD CONSTRAINT `viaje_FK` FOREIGN KEY (`id_viaje`) REFERENCES `viaje` (`id_viaje`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `remolque`
--
ALTER TABLE `remolque`
  ADD CONSTRAINT `tipo_remolque_FK` FOREIGN KEY (`id_tipo_remolque`) REFERENCES `tipo_remolque` (`id_tipo_remolque`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `unidad_de_transporte_remolque_FK` FOREIGN KEY (`id_remolque`) REFERENCES `unidad_de_transporte` (`id_unidad_de_transporte`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `unidad_de_transporte_FK` FOREIGN KEY (`id_unidad_de_transporte`) REFERENCES `unidad_de_transporte` (`id_unidad_de_transporte`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_service_FK` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `unidad_de_transporte`
--
ALTER TABLE `unidad_de_transporte`
  ADD CONSTRAINT `marca_transporte_FK` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `modelo_transporte_FK` FOREIGN KEY (`id_modelo`) REFERENCES `modelo` (`id_modelo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD CONSTRAINT `rol_FK` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_rol_FK` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD CONSTRAINT `tipo_vehiculo_FK` FOREIGN KEY (`id_tipo_vehiculo`) REFERENCES `tipo_vehiculo` (`id_tipo_vehiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `unidad_de_transporte_vehiculo_FK` FOREIGN KEY (`id_vehiculo`) REFERENCES `unidad_de_transporte` (`id_unidad_de_transporte`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `viaje`
--
ALTER TABLE `viaje`
  ADD CONSTRAINT `id_cliente_FK` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `viaje_carga_combustible`
--
ALTER TABLE `viaje_carga_combustible`
  ADD CONSTRAINT `carga_combustible_FK` FOREIGN KEY (`id_carga_combustible`) REFERENCES `carga_combustible` (`id_carga_combustible`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `viaje_carga_combustible_FK` FOREIGN KEY (`id_viaje`) REFERENCES `viaje` (`id_viaje`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `viaje_chofer`
--
ALTER TABLE `viaje_chofer`
  ADD CONSTRAINT `chofer_FK` FOREIGN KEY (`id_chofer`) REFERENCES `chofer` (`id_chofer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `viaje_chofer_FK` FOREIGN KEY (`id_viaje`) REFERENCES `viaje` (`id_viaje`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `viaje_desvio`
--
ALTER TABLE `viaje_desvio`
  ADD CONSTRAINT `desvio_FK` FOREIGN KEY (`id_desvio`) REFERENCES `desvio` (`id_desvio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `viaje_desvio_FK` FOREIGN KEY (`id_viaje`) REFERENCES `viaje` (`id_viaje`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `viaje_posicion`
--
ALTER TABLE `viaje_posicion`
  ADD CONSTRAINT `posicion_FK` FOREIGN KEY (`id_posicion`) REFERENCES `posicion` (`id_posicion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `viaje_posicion_FK` FOREIGN KEY (`id_viaje`) REFERENCES `viaje` (`id_viaje`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `viaje_unidad_de_transporte`
--
ALTER TABLE `viaje_unidad_de_transporte`
  ADD CONSTRAINT `unidad_de_transporte_viaje_FK` FOREIGN KEY (`id_unidad_de_transporte`) REFERENCES `unidad_de_transporte` (`id_unidad_de_transporte`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `viaje_transporte_FK` FOREIGN KEY (`id_viaje`) REFERENCES `viaje` (`id_viaje`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
