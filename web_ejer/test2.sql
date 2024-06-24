-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-06-2024 a las 23:33:26
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
-- Base de datos: `test2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `floreria`
--

CREATE TABLE `floreria` (
  `cod_floreria` int(11) NOT NULL,
  `nombreFloreria` varchar(100) NOT NULL,
  `fechaCreacion` date NOT NULL,
  `colorPuerta` varchar(100) NOT NULL,
  `eslogan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `floreria`
--

INSERT INTO `floreria` (`cod_floreria`, `nombreFloreria`, `fechaCreacion`, `colorPuerta`, `eslogan`) VALUES
(1, 'Floria Torrico', '2024-06-12', 'Verde', 'La vida es mejor con flores'),
(2, 'Floreria Mons', '2023-12-11', 'Rojo', 'Flor para otra flor'),
(3, 'Floralma', '2024-06-20', 'Verde', 'Vida es natural'),
(4, 'Floralma2', '2024-06-20', 'Verde', 'Vida es natural'),
(5, 'Floralma3', '2024-06-20', 'Verde', 'Vida es natural'),
(8, 'Floralma4', '2024-06-20', 'Verde', 'Vida es natural'),
(9, 'Jardin Blanco', '2022-06-29', 'Roja', 'Una vida sin flores no es vida');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `floreria`
--
ALTER TABLE `floreria`
  ADD PRIMARY KEY (`cod_floreria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `floreria`
--
ALTER TABLE `floreria`
  MODIFY `cod_floreria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
