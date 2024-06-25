-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-06-2024 a las 23:37:34
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdflores_v1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `flor`
--

CREATE TABLE `flor` (
  `idFlor` int(11) NOT NULL,
  `nombreFlor` varchar(25) NOT NULL,
  `cantidadCosecha` int(11) NOT NULL,
  `costo` int(11) NOT NULL,
  `idTipo` int(11) NOT NULL,
  `fechaProduccion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `flor`
--

INSERT INTO `flor` (`idFlor`, `nombreFlor`, `cantidadCosecha`, `costo`, `idTipo`, `fechaProduccion`) VALUES
(1, 'rosas', 100, 11, 1, '2024-06-04'),
(2, 'rosas', 234234, 222, 1, '2024-06-06'),
(3, 'sdfg', 233, 3, 1, '2024-06-11'),
(4, 'hortencia', 22200, 100, 2, '2024-06-05'),
(5, 'captu rojo', 200, 100, 3, '2024-06-19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `idTipo` int(11) NOT NULL,
  `nombreTipo` varchar(25) NOT NULL,
  `clima` varchar(25) NOT NULL,
  `observacion` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`idTipo`, `nombreTipo`, `clima`, `observacion`) VALUES
(1, 'rosas', 'arido', 'sin obs'),
(2, 'Hortensias', 'tropical', 'sin obs'),
(3, 'Captus', 'arido', 'no sobrepasar el agua');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `flor`
--
ALTER TABLE `flor`
  ADD PRIMARY KEY (`idFlor`),
  ADD KEY `FkTipo` (`idTipo`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`idTipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `flor`
--
ALTER TABLE `flor`
  MODIFY `idFlor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `idTipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `flor`
--
ALTER TABLE `flor`
  ADD CONSTRAINT `flor_ibfk_1` FOREIGN KEY (`idTipo`) REFERENCES `tipo` (`idTipo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
