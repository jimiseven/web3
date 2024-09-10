-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-09-2024 a las 23:35:42
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
(3, 'E003', 'Águilas', '2021-07-10', 'Verde'),
(4, 'E004', 'Bolívar', '1925-04-12', 'Celeste'),
(5, 'E005', 'The Strongest', '1908-04-08', 'Amarillo y Negro'),
(6, 'E006', 'Wilstermann', '1949-11-24', 'Rojo'),
(7, 'E007', 'Oriente Petrolero', '1955-11-05', 'Verde'),
(8, 'E008', 'Blooming', '1946-05-01', 'Celeste'),
(9, 'E009', 'Always Ready', '1933-04-13', 'Rojo y Blanco'),
(10, 'E010', 'Real Potosí', '1986-10-20', 'Morado'),
(11, 'E011', 'Nacional Potosí', '1942-03-08', 'Rojo y Blanco'),
(12, 'E012', 'San José', '1942-03-19', 'Blanco y Azul'),
(13, 'E013', 'Guabirá', '1962-04-14', 'Rojo'),
(14, 'asdf', 'VerdeMoreno', '1998-10-21', 'verde con negrosd');

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
(3, 'J003', '11223344', 'Carlos', 'Sánchez', 'Martínez', '2000-02-10', 'M', 'E003'),
(14, 'J005', '76543210', 'Carlos', 'Gutiérrez', 'Condori', '1993-03-22', 'M', 'E005'),
(15, 'J006', '65432109', 'Luis', 'Cruz', 'Choque', '1998-07-10', 'M', 'E006'),
(16, 'J007', '54321098', 'Miguel', 'Arias', 'Quispe', '1997-05-09', 'M', 'E007'),
(17, 'J008', '43210987', 'Roberto', 'Salinas', 'Huanca', '1999-11-02', 'M', 'E008'),
(18, 'J009', '32109876', 'David', 'Rojas', 'Calle', '1994-08-18', 'M', 'E009'),
(19, 'J010', '21098765', 'Jorge', 'Flores', 'Apaza', '1996-06-11', 'M', 'E010'),
(20, 'J011', '10987654', 'Marco', 'Sánchez', 'Yucra', '1992-09-30', 'M', 'E011'),
(21, 'J012', '98765432', 'Fernando', 'Vargas', 'Aruquipa', '1990-04-21', 'M', 'E012'),
(22, 'J013', '87654320', 'Ramiro', 'Suarez', 'Canaviri', '1997-12-14', 'M', 'E013'),
(23, '2shbd2', '5423823u', 'Gino', 'Torrico', 'Peredo', '2001-09-05', 'M', 'E001'),
(24, 'sdfasd', '234', 'name', 'name', 'name', '2022-09-07', 'M', 'E013');

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
(3, 'Delantero', 'Ataca y busca anotar goles'),
(4, 'Portero', 'Encargado de defender la portería'),
(5, 'Defensa Central', 'Posicionado en el centro de la defensa, su tarea principal es evitar goles'),
(6, 'Lateral Derecho', 'Defiende el costado derecho y apoya en ataque por la banda'),
(7, 'Lateral Izquierdo', 'Defiende el costado izquierdo y apoya en ataque por la banda'),
(8, 'Mediocentro', 'Organiza el juego en el centro del campo y conecta defensa con ataque'),
(9, 'Volante Ofensivo', 'Mediocampista que se encarga de generar jugadas de ataque'),
(10, 'Extremo Derecho', 'Ataca por la banda derecha y se encarga de desbordar y centrar'),
(11, 'Extremo Izquierdo', 'Ataca por la banda izquierda y se encarga de desbordar y centrar'),
(12, 'Delantero Centro', 'Principal objetivo es marcar goles, juega en el centro del ataque'),
(13, 'Mediapunta', 'Juega entre el mediocampo y el ataque, creando oportunidades de gol'),
(14, 'Adelante ', 'Adelante prub'),
(15, 'suplente a1', 'primer suplente a entrar'),
(16, 'atras', 'sin');

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
(3, 3, 3),
(4, 1, 2),
(5, 17, 6),
(6, 17, 6),
(7, 1, 5),
(8, 18, 15),
(9, 16, 5),
(10, 17, 15),
(11, 14, 12),
(12, 16, 15),
(13, 3, 4),
(14, 14, 7),
(15, 3, 4),
(16, 14, 14);

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `jugador`
--
ALTER TABLE `jugador`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `posiciones`
--
ALTER TABLE `posiciones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `rel_pos_ju`
--
ALTER TABLE `rel_pos_ju`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
