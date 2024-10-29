-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-10-2024 a las 20:02:46
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `campeonato`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `codEquipo` int(11) NOT NULL,
  `nombreEquipo` varchar(50) NOT NULL,
  `fechaCreacion` date NOT NULL,
  `color` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`codEquipo`, `nombreEquipo`, `fechaCreacion`, `color`) VALUES
(1, 'Aurora ', '2000-11-22', 'celeste con blanco'),
(2, 'Strongest', '1998-12-12', 'amarillo'),
(3, 'Bolivar', '1980-08-14', 'celeste'),
(4, 'Wilsterman', '1983-06-07', 'rojo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugador`
--

CREATE TABLE `jugador` (
  `cod_j` int(11) NOT NULL,
  `ci` int(10) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `paterno` varchar(30) NOT NULL,
  `materno` varchar(30) NOT NULL,
  `fechaNac` date NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `codEquipo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `jugador`
--

INSERT INTO `jugador` (`cod_j`, `ci`, `nombre`, `paterno`, `materno`, `fechaNac`, `sexo`, `codEquipo`) VALUES
(1, 1123, 'Pedro', 'Teran', 'Pereira', '2000-08-21', 'm', 1),
(2, 147, 'jose', 'juarez', 'jaillita', '2024-09-13', 'M', 3),
(3, 8963, 'Alicia', 'arnez', 'Arce', '2024-09-05', 'F', 1),
(6, 987654, 'Peter', 'Maldonado', 'Caceres', '2024-08-28', 'M', 3),
(7, 989898, 'Luisa', 'Lima', 'Lima', '2024-08-27', 'F', 3),
(8, 989898, 'Luis', 'Lujan', 'Lima', '2024-08-27', 'M', 3),
(9, 666666, 'Anaita', 'Arce', 'Avila', '2024-08-26', 'F', 3),
(10, 666666, 'Ana', 'Arce', 'Avila', '2024-08-26', 'F', 3),
(11, 666667, 'Aniceto', 'Arce', 'Avila', '2024-08-26', 'F', 3),
(12, 852369, 'lorito Real', 'loro', 'lara', '2024-08-26', 'M', 1),
(13, 1111111, 'Juan', 'Jaramillo', 'Jaimes', '2024-08-26', 'M', 2),
(14, 852963, 'Norman', 'Nina', 'Nogales', '2024-09-30', 'M', 2),
(15, 852963, 'Nicolas', 'Nina', 'Nava', '2024-09-30', 'M', 2),
(16, 7852145, 'Filemon', 'Flores', 'Fuentes', '2024-09-30', 'M', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posicion`
--

CREATE TABLE `posicion` (
  `cod_pos` int(11) NOT NULL,
  `nombre_pos` varchar(30) NOT NULL,
  `descripcion_pos` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `posicion`
--

INSERT INTO `posicion` (`cod_pos`, `nombre_pos`, `descripcion_pos`) VALUES
(1, 'delantero', 'Posicion de ataque y consolida los goles'),
(2, 'arquero', 'encargado de cuidar el arco, que no ingrese el balon'),
(3, 'centro', 'juega en la parte central'),
(4, 'defensa', 'Juega defendiendo el arco');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_ju_po`
--

CREATE TABLE `rel_ju_po` (
  `cod_ju_po` int(11) NOT NULL,
  `cod_juga` int(11) NOT NULL,
  `cod_posi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rel_ju_po`
--

INSERT INTO `rel_ju_po` (`cod_ju_po`, `cod_juga`, `cod_posi`) VALUES
(13, 12, 1),
(15, 12, 3),
(16, 12, 4),
(18, 13, 2),
(19, 13, 3),
(20, 2, 1),
(21, 2, 2),
(22, 14, 1),
(23, 14, 2),
(24, 15, 1),
(25, 15, 2),
(26, 7, 3),
(27, 7, 4),
(28, 16, 1),
(29, 16, 2),
(30, 6, 1),
(31, 6, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`codEquipo`);

--
-- Indices de la tabla `jugador`
--
ALTER TABLE `jugador`
  ADD PRIMARY KEY (`cod_j`),
  ADD KEY `codEquipo` (`codEquipo`);

--
-- Indices de la tabla `posicion`
--
ALTER TABLE `posicion`
  ADD PRIMARY KEY (`cod_pos`);

--
-- Indices de la tabla `rel_ju_po`
--
ALTER TABLE `rel_ju_po`
  ADD PRIMARY KEY (`cod_ju_po`),
  ADD KEY `cod_juga` (`cod_juga`),
  ADD KEY `rel_ju_po_ibfk_2` (`cod_posi`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `codEquipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `jugador`
--
ALTER TABLE `jugador`
  MODIFY `cod_j` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `posicion`
--
ALTER TABLE `posicion`
  MODIFY `cod_pos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `rel_ju_po`
--
ALTER TABLE `rel_ju_po`
  MODIFY `cod_ju_po` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `jugador`
--
ALTER TABLE `jugador`
  ADD CONSTRAINT `jugador_ibfk_1` FOREIGN KEY (`codEquipo`) REFERENCES `equipo` (`codEquipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rel_ju_po`
--
ALTER TABLE `rel_ju_po`
  ADD CONSTRAINT `rel_ju_po_ibfk_1` FOREIGN KEY (`cod_juga`) REFERENCES `jugador` (`cod_j`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rel_ju_po_ibfk_2` FOREIGN KEY (`cod_posi`) REFERENCES `posicion` (`cod_pos`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
