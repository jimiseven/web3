-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-07-2024 a las 18:34:28
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
-- Base de datos: `bdcarnes_v1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carnes`
--

CREATE TABLE `carnes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `costo` decimal(10,2) NOT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `fecha_produccion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carnes`
--

INSERT INTO `carnes` (`id`, `nombre`, `cantidad`, `costo`, `id_tipo`, `fecha_produccion`) VALUES
(1, 'Bistec', 100, '5.99', 1, '2023-07-01'),
(2, 'Corte de pescuezo', 50, '4.50', 2, '2023-06-15'),
(3, 'Pecho', 200, '3.75', 3, '2023-07-10'),
(4, 'pollerita', 150, '1550.00', 1, '2024-07-17'),
(5, 'Paleta magra', 150, '1500.00', 4, '2024-07-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informes`
--

CREATE TABLE `informes` (
  `id` int(11) NOT NULL,
  `id_carne` int(11) DEFAULT NULL,
  `descripcion` text NOT NULL,
  `fecha_informe` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `informes`
--

INSERT INTO `informes` (`id`, `id_carne`, `descripcion`, `fecha_informe`) VALUES
(1, 1, 'Carne de res de alta calidad', '2023-07-02'),
(2, 2, 'Cerdo con un buen marmoleo', '2023-06-16'),
(3, 3, 'Pollo fresco y jugoso', '2023-07-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_de_carnes`
--

CREATE TABLE `tipos_de_carnes` (
  `id` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipos_de_carnes`
--

INSERT INTO `tipos_de_carnes` (`id`, `tipo`) VALUES
(1, 'Carrillada'),
(2, 'Corte de pescuezo'),
(3, 'Pecho'),
(4, 'Paleta');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carnes`
--
ALTER TABLE `carnes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo` (`id_tipo`);

--
-- Indices de la tabla `informes`
--
ALTER TABLE `informes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_carne` (`id_carne`);

--
-- Indices de la tabla `tipos_de_carnes`
--
ALTER TABLE `tipos_de_carnes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carnes`
--
ALTER TABLE `carnes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `informes`
--
ALTER TABLE `informes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipos_de_carnes`
--
ALTER TABLE `tipos_de_carnes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carnes`
--
ALTER TABLE `carnes`
  ADD CONSTRAINT `carnes_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipos_de_carnes` (`id`);

--
-- Filtros para la tabla `informes`
--
ALTER TABLE `informes`
  ADD CONSTRAINT `informes_ibfk_1` FOREIGN KEY (`id_carne`) REFERENCES `carnes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
