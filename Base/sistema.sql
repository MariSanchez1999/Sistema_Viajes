-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-07-2023 a las 06:10:55
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciones`
--

CREATE TABLE `asignaciones` (
  `id` int(11) NOT NULL,
  `id_colaborador` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `distancia` float NOT NULL,
  `tarifa` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asignaciones`
--

INSERT INTO `asignaciones` (`id`, `id_colaborador`, `id_sucursal`, `distancia`, `tarifa`) VALUES
(8, 1, 1, 2, 100),
(9, 2, 1, 5, 90),
(10, 3, 3, 8, 40),
(11, 4, 1, 9, 89),
(12, 3, 1, 3, 20),
(13, 1, 2, 8, 30),
(14, 4, 3, 6.9, 23),
(15, 2, 4, 67, 55),
(16, 2, 2, 4, 29),
(17, 2, 5, 20, 50),
(18, 4, 5, 10, 20),
(19, 4, 6, 10, 20),
(20, 5, 1, 20, 50),
(21, 6, 1, 12, 60),
(22, 7, 2, 12, 40),
(23, 5, 3, 10, 50),
(24, 7, 1, 4, 40),
(25, 7, 7, 12, 50),
(26, 6, 4, 2, 40),
(27, 5, 6, 2, 5),
(28, 7, 8, 1, 30),
(29, 7, 6, 50, 20),
(30, 6, 6, 50, 40),
(31, 16, 4, 10, 40),
(32, 17, 5, 3, 40),
(33, 6, 5, 10, 30),
(34, 11, 7, 20, 30),
(35, 12, 8, 5, 18),
(36, 14, 8, 20, 40),
(37, 16, 1, 3, 23),
(38, 14, 2, 5, 24),
(39, 18, 9, 10, 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `direccion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `dni`, `nombre`, `telefono`, `direccion`) VALUES
(5, '080119997766', 'Octavio Paz', '97121980', 'Kennedy'),
(6, '011019809988', 'Gabriela Mistral', '88888888', 'Villanueva'),
(7, '080219678889', 'Mario Vargas', '12345598', 'Hato'),
(8, '081019924455', 'Patricia Flores', '77999900', 'Villanueva'),
(9, '080119877788', 'Ernesto Sabato', '88778809', 'Res. El Bosque'),
(10, '012019789988', 'Antony Caceres', '88776655', 'La Travesia'),
(11, '017919978877', 'Isabel Allende', '887655777', 'Bella Oriente'),
(12, '081919928887', 'Trinidad Sosa', '88763636', 'Comayaguela'),
(13, '080119798877', 'Ruben Dario', '89988866', 'La Union'),
(14, '0801199188754', 'Gabriel Garcia', '98078799', 'Macondo'),
(15, '080219678887', 'Pablo Neruda', '87766799', 'El Chile'),
(16, '080219878838', 'Frida Kahlo', '98876678', 'La Rosa'),
(17, '089119789987', 'Juana de Arco', '89866789', 'Francia'),
(18, '080219678885', 'Robert Deniro', '77999777', 'Prados Uni.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleviajes`
--

CREATE TABLE `detalleviajes` (
  `id` int(11) NOT NULL,
  `id_viaje` int(11) NOT NULL,
  `id_colaborador` int(11) NOT NULL,
  `distancia` float NOT NULL,
  `tarifa` float NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalleviajes`
--

INSERT INTO `detalleviajes` (`id`, `id_viaje`, `id_colaborador`, `distancia`, `tarifa`, `fecha`) VALUES
(12, 9, 5, 2, 10, '2023-07-03 03:35:13'),
(13, 9, 6, 50, 2000, '2023-07-03 03:35:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_permisos`
--

CREATE TABLE `detalle_permisos` (
  `id` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_permisos`
--

INSERT INTO `detalle_permisos` (`id`, `id_rol`, `id_permiso`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 1, 13),
(14, 1, 14),
(15, 1, 15),
(16, 1, 16),
(17, 1, 17),
(18, 1, 18),
(447, 1, 32),
(452, 3, 18),
(455, 2, 14),
(456, 2, 18),
(458, 5, 14),
(459, 5, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `permiso` varchar(200) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `permiso`, `descripcion`) VALUES
(2, 'Usuarios', 'Usuarios'),
(3, 'Roles', 'Roles'),
(4, 'Sucursales', 'Sucursal'),
(5, 'Ver_Clientes', 'Ver Clientes'),
(6, 'Crear_Cliente', 'Gestionar Clientes'),
(13, 'Ver_transportista', 'Ver transportista'),
(14, 'Crear_transportista', 'Gestionar transportista'),
(18, 'Historial_Viajes', 'Historial Viajes'),
(32, 'Crear_viaje', 'crear viaje');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`, `estado`) VALUES
(1, 'Gerente Tienda', 1),
(2, 'Vendedor', 1),
(3, 'Bodega', 1),
(4, 'Supervisor', 1),
(5, 'Cajera', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `id` int(11) NOT NULL,
  `sucursal` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`id`, `sucursal`, `direccion`, `estado`) VALUES
(1, 'Siman Teg #1', 'Toncontin', 0),
(2, 'Siman Teg #2', 'Blvd. Morazan', 0),
(3, 'Siman Teg #3', 'Comayaguela', 0),
(4, 'Siman Teg #4', '', 0),
(5, 'Siman Teg #5', 'Kennedy', 0),
(6, 'Siman Teg #6', 'Villas del sol', 0),
(7, 'Siman Teg #7', 'Miraflores', 0),
(8, 'Siman Teg #8', 'Quezada', 0),
(9, 'Siman Teg #9', 'Centro America Oeste', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temp_viajes`
--

CREATE TABLE `temp_viajes` (
  `id` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `id_colaborador` int(11) NOT NULL,
  `distancia` float NOT NULL,
  `tarifa` float NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transportista`
--

CREATE TABLE `transportista` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `telefono` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `transportista`
--

INSERT INTO `transportista` (`id`, `nombre`, `telefono`) VALUES
(1, 'Francisco Galo', '97121986'),
(2, 'Eduardo Figueroa', '97161988'),
(3, 'Josue Ramos', '97121988'),
(4, 'Marco Ayala', '97121988'),
(5, 'Isaac Murillo', '90989900'),
(6, 'Juan', '8888'),
(7, 'Ricardo Gomez', '8787568');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `nombre`, `clave`, `id_rol`) VALUES
(2, 'dilia', 'Dilia Sanchez', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 1),
(46, 'admin', 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 1),
(47, 'tobias', 'Tobias L', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 3),
(48, 'ana', 'Ana Lopez', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajes`
--

CREATE TABLE `viajes` (
  `id` int(11) NOT NULL,
  `id_transportista` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `distancia_total` float NOT NULL,
  `tarifa_total` float NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `viajes`
--

INSERT INTO `viajes` (`id`, `id_transportista`, `id_sucursal`, `distancia_total`, `tarifa_total`, `id_usuario`, `fecha`) VALUES
(9, 1, 6, 52, 2010, 46, '2023-07-03 03:35:13');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_COLABORADOR` (`id_colaborador`),
  ADD KEY `id_sucursal` (`id_sucursal`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalleviajes`
--
ALTER TABLE `detalleviajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_viaje` (`id_viaje`,`id_colaborador`),
  ADD KEY `id_colaborador` (`id_colaborador`);

--
-- Indices de la tabla `detalle_permisos`
--
ALTER TABLE `detalle_permisos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `temp_viajes`
--
ALTER TABLE `temp_viajes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transportista`
--
ALTER TABLE `transportista`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viajes`
--
ALTER TABLE `viajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_transportista` (`id_transportista`),
  ADD KEY `id_sucursal` (`id_sucursal`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `detalleviajes`
--
ALTER TABLE `detalleviajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `detalle_permisos`
--
ALTER TABLE `detalle_permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=460;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `temp_viajes`
--
ALTER TABLE `temp_viajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT de la tabla `transportista`
--
ALTER TABLE `transportista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `viajes`
--
ALTER TABLE `viajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD CONSTRAINT `asignaciones_ibfk_1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalleviajes`
--
ALTER TABLE `detalleviajes`
  ADD CONSTRAINT `detalleviajes_ibfk_1` FOREIGN KEY (`id_viaje`) REFERENCES `viajes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalleviajes_ibfk_2` FOREIGN KEY (`id_colaborador`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `viajes`
--
ALTER TABLE `viajes`
  ADD CONSTRAINT `viajes_ibfk_1` FOREIGN KEY (`id_transportista`) REFERENCES `transportista` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `viajes_ibfk_2` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `viajes_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
