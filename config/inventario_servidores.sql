-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-10-2024 a las 22:48:52
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario_servidores`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aplicativo`
--

CREATE TABLE `aplicativo` (
  `id` int(11) NOT NULL,
  `nombre_sistema` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `publicador` varchar(255) DEFAULT NULL,
  `url_principal` varchar(255) DEFAULT NULL,
  `ambiente` varchar(255) DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `web` tinyint(1) DEFAULT NULL,
  `url_host` varchar(255) DEFAULT NULL,
  `id_servidor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `aplicativo`
--

INSERT INTO `aplicativo` (`id`, `nombre_sistema`, `area`, `publicador`, `url_principal`, `ambiente`, `comentario`, `web`, `url_host`, `id_servidor`) VALUES
(2, 'Sistema de Gestión', 'Administración', 'Departamento de IT', 'https://www.ejemplo.com', 'Producción', 'Sistema para gestión de inventario.', 1, 'https://host.ejemplo.com', 9),
(3, 'Sistema de Gestión', 'Administración', 'Departamento de IT', 'https://www.ejemplo.com', 'Producción', 'Sistema para gestión de inventario.', 1, 'https://host.ejemplo.com', 9),
(4, 'Sistema de Gestión', 'Administración', 'Departamento de IT', 'https://www.ejemplo.com', 'Producción', 'Sistema para gestión de inventario.', 1, 'https://host.ejemplo.com', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `nombre`, `email`, `telefono`) VALUES
(1, 'pordefecto', 'preterminado@ejemplo.ar', '+54 1155071300');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servidor`
--

CREATE TABLE `servidor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `ambiente` varchar(255) DEFAULT NULL,
  `ubicacion` varchar(255) DEFAULT NULL,
  `SO` varchar(255) DEFAULT NULL,
  `CPU` varchar(255) DEFAULT NULL,
  `RAM` int(11) DEFAULT NULL,
  `disco` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `id_vlan` int(11) DEFAULT NULL,
  `id_owner` int(11) DEFAULT NULL,
  `id_responsable` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servidor`
--

INSERT INTO `servidor` (`id`, `nombre`, `ambiente`, `ubicacion`, `SO`, `CPU`, `RAM`, `disco`, `ip`, `comentario`, `id_vlan`, `id_owner`, `id_responsable`) VALUES
(9, 'servidorNombre', 'desarollo', '982', 'win 2016', 'i3', 32, '10TB', '192.168.1.31', 'Esto es un comentario agradable', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vlan`
--

CREATE TABLE `vlan` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `numero_vlan` int(11) DEFAULT NULL,
  `comentario` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vlan`
--

INSERT INTO `vlan` (`id`, `nombre`, `numero_vlan`, `comentario`) VALUES
(1, 'nombre1', 1, 'test1'),
(2, 'nombre2', 2, 'test2'),
(3, 'nombre3', 3, 'test3');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aplicativo`
--
ALTER TABLE `aplicativo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_servidor` (`id_servidor`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servidor`
--
ALTER TABLE `servidor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_vlan` (`id_vlan`),
  ADD KEY `id_owner` (`id_owner`),
  ADD KEY `id_responsable` (`id_responsable`);

--
-- Indices de la tabla `vlan`
--
ALTER TABLE `vlan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aplicativo`
--
ALTER TABLE `aplicativo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `servidor`
--
ALTER TABLE `servidor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `vlan`
--
ALTER TABLE `vlan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aplicativo`
--
ALTER TABLE `aplicativo`
  ADD CONSTRAINT `aplicativo_ibfk_1` FOREIGN KEY (`id_servidor`) REFERENCES `servidor` (`id`);

--
-- Filtros para la tabla `servidor`
--
ALTER TABLE `servidor`
  ADD CONSTRAINT `servidor_ibfk_1` FOREIGN KEY (`id_vlan`) REFERENCES `vlan` (`id`),
  ADD CONSTRAINT `servidor_ibfk_2` FOREIGN KEY (`id_owner`) REFERENCES `persona` (`id`),
  ADD CONSTRAINT `servidor_ibfk_3` FOREIGN KEY (`id_responsable`) REFERENCES `persona` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
