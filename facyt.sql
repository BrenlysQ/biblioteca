-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 24-11-2016 a las 03:19:34
-- Versión del servidor: 5.7.11
-- Versión de PHP: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `facyt`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int(1) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `cedula` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `contrasena` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `estatus` varchar(225) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `nombre`, `apellido`, `cedula`, `usuario`, `contrasena`, `estatus`) VALUES
(6, 'Leosbeth', 'Gómez', '22003186', 'lgomez7', 'kakashi2636313', 'ACTIVO'),
(8, 'Luis', 'Pérez', '25425087', 'lapv1992', 'charmed', 'ACTIVO'),
(9, 'Jesus Miguel', 'Figueroa', '16288667', 'miguj', '231206jr', 'ACTIVO'),
(10, 'Leonardo', 'Gómez', '20003186', 'lgomez2', 'asd', 'ACTIVO'),
(11, 'asd', 'asd', '123', 'asd', 'asd', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `nombre` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`nombre`) VALUES
('Computación'),
('Matemática'),
('Física'),
('Biología'),
('Química');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `id` int(1) NOT NULL,
  `titulo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `isbm` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `autor` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `prestado` int(11) NOT NULL,
  `id_adm` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`id`, `titulo`, `isbm`, `autor`, `prestado`, `id_adm`) VALUES
(8, 'Harry Potter & The Half-Blood Prince', '8', 'J.K Rowling', 2, 8),
(9, 'El Hombre Equivocado', '1', 'John Katzenbach', 1, 8),
(11, 'ITACHI', '2', 'ITACHI', 0, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `id` int(1) NOT NULL,
  `inicio` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `final` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `id_libro` int(1) NOT NULL,
  `id_usuario` int(1) NOT NULL,
  `id_adm` int(1) NOT NULL,
  `estatus` varchar(225) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `prestamo`
--

INSERT INTO `prestamo` (`id`, `inicio`, `final`, `id_libro`, `id_usuario`, `id_adm`, `estatus`) VALUES
(6, '09-11-2016', '10-11-2016', 8, 24, 10, 'COMPLETADO'),
(19, '01-11-2016', '30-11-2016', 8, 27, 10, 'COMPLETADO'),
(20, '01-11-2016', '30-11-2016', 8, 24, 10, 'COMPLETADO'),
(21, '01-11-2016', '30-11-2016', 9, 24, 10, 'COMPLETADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(1) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `cedula` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `carrera` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `registro` date NOT NULL,
  `estatus` varchar(225) COLLATE utf8_spanish2_ci NOT NULL,
  `prestamos` int(11) NOT NULL,
  `id_adm` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `cedula`, `telefono`, `correo`, `carrera`, `registro`, `estatus`, `prestamos`, `id_adm`) VALUES
(24, 'Jean Manuel', 'Figueroa', '22003186', '04123409830', 'jeanmanuelfigueroa@gmail.com', 'Computación', '2016-11-07', 'DESACTIVADO', 2, 6),
(25, 'Sia', 'Fuller', '18452363', '04144415939', 'sia.fuller@icloud.com', 'Computación', '2016-11-11', 'ACTIVO', 0, 8),
(27, 'Leonardo', 'Gómez', '25425087', '04123409830', 'leonan.1994@hotmail.com', 'Física', '2016-11-23', 'ACTIVO', 1, 10);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_adm` (`id_adm`),
  ADD KEY `id_adm_2` (`id_adm`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_adm` (`id_adm`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_libro` (`id_libro`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_adm` (`id_adm`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `libro`
--
ALTER TABLE `libro`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libro`
--
ALTER TABLE `libro`
  ADD CONSTRAINT `libro_ibfk_1` FOREIGN KEY (`id_adm`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `prestamo_ibfk_1` FOREIGN KEY (`id_adm`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prestamo_ibfk_2` FOREIGN KEY (`id_libro`) REFERENCES `libro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prestamo_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_adm`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;