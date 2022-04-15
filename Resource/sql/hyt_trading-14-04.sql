-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-04-2022 a las 03:46:15
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hyt_trading`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `categorias_id` int(11) NOT NULL,
  `categorias_nombre` varchar(50) NOT NULL,
  `categorias_color` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`categorias_id`, `categorias_nombre`, `categorias_color`) VALUES
(1, 'Automotriz', '#00FFFF'),
(2, 'Herramientas de medición', '#FF00FF'),
(3, 'Limpieza', '#FFFF00'),
(4, 'Construcción', '#FF8000'),
(5, 'Herramientas de golpe', '#00FF00'),
(6, 'Jardineria', '#7cbb48'),
(7, 'Esmaltes', '#e1bbdd'),
(10, 'Cerrajería', '#ff00ff');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente-proveedor`
--

CREATE TABLE `cliente-proveedor` (
  `cp_id` int(11) NOT NULL,
  `cp_tipodocum` enum('RUC','DNI','SIN DOCUMENTO') NOT NULL,
  `cp_numdocum` int(11) NOT NULL,
  `cp_nombrelegal` varchar(200) NOT NULL,
  `cp_direccion` varchar(200) NOT NULL,
  `cp_tipo` enum('CLIENTE','PROVEEDOR','CLIENTE/PROVEEDOR') NOT NULL,
  `cp_telefono` int(9) NOT NULL,
  `cp_correo` varchar(200) NOT NULL,
  `cp_datosadicionales` varchar(200) NOT NULL,
  `cp_fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `productos_id` int(11) NOT NULL,
  `productos_codigo` varchar(25) NOT NULL,
  `productos_nombre` varchar(200) NOT NULL,
  `productos_marca` varchar(50) NOT NULL,
  `productos_preccompra` float(10,2) NOT NULL,
  `productos_ganancia` float(10,2) NOT NULL,
  `productos_precventa` float(10,2) NOT NULL,
  `productos_cantidad` int(11) NOT NULL,
  `productos_imagen` varchar(255) NOT NULL,
  `productos_fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `productos_idcategorias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`productos_id`, `productos_codigo`, `productos_nombre`, `productos_marca`, `productos_preccompra`, `productos_ganancia`, `productos_precventa`, `productos_cantidad`, `productos_imagen`, `productos_fecha`, `productos_idcategorias`) VALUES
(1, 'HM-64564', 'CINTA MÉTRICA PROFESSIONAL 8 MTS', 'IRWIN', 45.90, 0.00, 55.90, 15, '', '2022-04-07 02:24:34', 2),
(2, 'HM-30680', 'CINTA MÉTRICA GLOBAL PLUS 3 MTS 1/2 PULG', 'STANLEY HERRAMIENTA MANUAL', 48.00, 0.00, 58.00, 10, '', '2022-04-07 02:26:30', 2),
(3, 'AU-78023', 'JUEGO EXTRACTOR DE TORNILLOS STANLEY', 'STANLEY HERRAMIENTA MANUAL', 26.50, 0.00, 35.90, 9, '', '2022-04-07 02:33:19', 1),
(5, 'AT-534388', 'prueba1', 'EINHELL', 14.80, 26.80, 26.80, 8, '', '2022-04-08 02:23:51', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('caja','logistica','admin') NOT NULL,
  `photo` varchar(300) NOT NULL,
  `estado` int(11) NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `agregado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `fullname`, `email`, `role`, `photo`, `estado`, `ultimo_login`, `agregado`) VALUES
(88, 'admin', '$2y$10$MJD414C1powe7UvzDNb3geLIbMOXa9cyps/RmkrQ4tbAkYLJppprm', 'Administrador  ', 'admin@gmail.com', 'admin', '', 1, '2022-04-14 17:45:22', '2022-04-15 01:02:58'),
(90, 'ana', '$2a$07$asxx54ahjppf45sd87a5auLd2AxYsA/2BbmGKNk2kMChC3oj7V0Ca', 'Ana Gonzales', 'anaG43@gmail.com', 'caja', 'image/caja/userana.png', 0, '2022-04-06 15:34:16', '2022-04-06 18:14:02'),
(91, 'marcos', '$2y$10$0aOmd1LTFHtBLCEtDrJgy.xxs7FArnOlzHXLrviwP85LWS.XbxsNO', 'Marcos Serrano Quispe', 'marcos@gmail.com', 'caja', 'image/user/marcosuser.png', 1, '2022-04-06 19:39:29', '2022-04-07 00:39:29'),
(92, 'moises', '$2y$10$yLXa3Ah0rIEM.7H2QsgzXO3qsx.DQ88yQHc3L8qnLe.yHUb7g41gy', 'moises ventura', 'moises@gmail.com', 'admin', '', 1, '2022-04-07 18:05:37', '2022-04-07 23:05:37'),
(93, 'moises ventura', '$2y$10$KAS7/jD1lut89qCdeqRmMezwL5MCBGeAvAghj7sj.Sg5n9P8wy4zG', 'moises ventura', '1@gmail.com', 'logistica', '', 0, '0000-00-00 00:00:00', '2022-04-06 19:52:39'),
(94, 'paolo coronado', '$2y$10$ignHl0mlH8m3H148zvScGuu3pg3VVRCpKR3I45eAcWHTyZZqvgZte', 'paolo coronado', 'dsada@gmail.com', 'caja', '', 1, '0000-00-00 00:00:00', '2022-04-06 20:07:06'),
(95, 'maria guevara', '$2y$10$4mufNgbDWfNUGZBqpMvv0eLC3c8DT3EP4hInEJuH6Gx2ja02rlo.e', 'maria guevara', 'maria@gmail.com', 'caja', '', 1, '0000-00-00 00:00:00', '2022-04-06 21:37:13');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categorias_id`);

--
-- Indices de la tabla `cliente-proveedor`
--
ALTER TABLE `cliente-proveedor`
  ADD PRIMARY KEY (`cp_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`productos_id`),
  ADD KEY `productos_idcategorias` (`productos_idcategorias`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categorias_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `cliente-proveedor`
--
ALTER TABLE `cliente-proveedor`
  MODIFY `cp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `productos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`productos_idcategorias`) REFERENCES `categorias` (`categorias_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
