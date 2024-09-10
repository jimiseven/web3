-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-09-2024 a las 17:01:52
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
-- Base de datos: `webcampeonato`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `id` bigint(20) NOT NULL,
  `codEquipo` varchar(255) NOT NULL,
  `nombreEquipo` varchar(255) NOT NULL,
  `fechaCreacion` date NOT NULL,
  `color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`id`, `codEquipo`, `nombreEquipo`, `fechaCreacion`, `color`) VALUES
(1, 'E001', 'Tigres', '2020-01-15', 'Azul'),
(2, 'E002', 'Leones', '2019-03-22', 'Rojo'),
(3, 'E003', 'Águilas', '2021-07-10', 'Verde');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugador`
--

CREATE TABLE `jugador` (
  `id` bigint(20) NOT NULL,
  `cod_j` varchar(255) NOT NULL,
  `ci` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `paterno` varchar(255) NOT NULL,
  `materno` varchar(255) NOT NULL,
  `fechaNac` date NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `codEquipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `jugador`
--

INSERT INTO `jugador` (`id`, `cod_j`, `ci`, `nombre`, `paterno`, `materno`, `fechaNac`, `sexo`, `codEquipo`) VALUES
(1, 'J001', '12345678', 'Juan', 'Pérez', 'Gómez', '1995-05-20', 'M', 'E001'),
(2, 'J002', '87654321', 'María', 'López', 'Fernández', '1998-11-15', 'F', 'E002'),
(3, 'J003', '11223344', 'Carlos', 'Sánchez', 'Martínez', '2000-02-10', 'M', 'E003');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posiciones`
--

CREATE TABLE `posiciones` (
  `id` bigint(20) NOT NULL,
  `nombrePosicion` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `posiciones`
--

INSERT INTO `posiciones` (`id`, `nombrePosicion`, `descripcion`) VALUES
(1, 'Portero', 'Defiende la portería'),
(2, 'Defensa', 'Protege la zona defensiva'),
(3, 'Delantero', 'Ataca y busca anotar goles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_pos_ju`
--

CREATE TABLE `rel_pos_ju` (
  `id` bigint(20) NOT NULL,
  `jugador_id` bigint(20) NOT NULL,
  `posicion_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rel_pos_ju`
--

INSERT INTO `rel_pos_ju` (`id`, `jugador_id`, `posicion_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codEquipo` (`codEquipo`);

--
-- Indices de la tabla `jugador`
--
ALTER TABLE `jugador`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cod_j` (`cod_j`),
  ADD UNIQUE KEY `ci` (`ci`),
  ADD KEY `codEquipo` (`codEquipo`);

--
-- Indices de la tabla `posiciones`
--
ALTER TABLE `posiciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rel_pos_ju`
--
ALTER TABLE `rel_pos_ju`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jugador_id` (`jugador_id`),
  ADD KEY `posicion_id` (`posicion_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `jugador`
--
ALTER TABLE `jugador`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `posiciones`
--
ALTER TABLE `posiciones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `rel_pos_ju`
--
ALTER TABLE `rel_pos_ju`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `jugador`
--
ALTER TABLE `jugador`
  ADD CONSTRAINT `jugador_ibfk_1` FOREIGN KEY (`codEquipo`) REFERENCES `equipo` (`codEquipo`);

--
-- Filtros para la tabla `rel_pos_ju`
--
ALTER TABLE `rel_pos_ju`
  ADD CONSTRAINT `rel_pos_ju_ibfk_1` FOREIGN KEY (`jugador_id`) REFERENCES `jugador` (`id`),
  ADD CONSTRAINT `rel_pos_ju_ibfk_2` FOREIGN KEY (`posicion_id`) REFERENCES `posiciones` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
