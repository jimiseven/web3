-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-06-2024 a las 01:54:56
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
-- Base de datos: `floreria2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `floreria`
--

CREATE TABLE `floreria` (
  `idFloreria` int(11) NOT NULL,
  `nombreFloreria` varchar(50) NOT NULL,
  `telefono` int(11) NOT NULL,
  `cuidad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidoflores`
--

CREATE TABLE `pedidoflores` (
  `idFlor` int(11) NOT NULL,
  `nombreFlor` varchar(50) NOT NULL,
  `temporada` varchar(50) NOT NULL,
  `tamañoPedido` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `idFloreria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idProveedor` int(11) NOT NULL,
  `nombreProveedor` varchar(50) NOT NULL,
  `telefono` int(11) NOT NULL,
  `especialidad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `floreria`
--
ALTER TABLE `floreria`
  ADD PRIMARY KEY (`idFloreria`);

--
-- Indices de la tabla `pedidoflores`
--
ALTER TABLE `pedidoflores`
  ADD PRIMARY KEY (`idFlor`),
  ADD KEY `FkProveedor` (`idProveedor`),
  ADD KEY `FkFloreria` (`idFloreria`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idProveedor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `floreria`
--
ALTER TABLE `floreria`
  MODIFY `idFloreria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidoflores`
--
ALTER TABLE `pedidoflores`
  ADD CONSTRAINT `pedidoflores_ibfk_1` FOREIGN KEY (`idFloreria`) REFERENCES `floreria` (`idFloreria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidoflores_ibfk_2` FOREIGN KEY (`idProveedor`) REFERENCES `proveedor` (`idProveedor`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
