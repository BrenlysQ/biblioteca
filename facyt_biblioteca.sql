-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 15, 2016 at 12:55 PM
-- Server version: 10.0.27-MariaDB-0ubuntu0.16.04.1
-- PHP Version: 5.6.27-1+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `facyt`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
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
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nombre`, `apellido`, `cedula`, `usuario`, `contrasena`, `estatus`) VALUES
(6, 'Leosbeth', 'Gómez', '22003186', 'lgomez7', 'kakashi2636313', 'ACTIVO'),
(8, 'Luis', 'Pérez', '25425087', 'lapv1992', 'charmed', 'ACTIVO'),
(9, 'Jesus Miguel', 'Figueroa', '16288667', 'miguj', '231206jr', 'ACTIVO');

-- --------------------------------------------------------

--
-- Table structure for table `carreras`
--

CREATE TABLE `carreras` (
  `nombre` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `carreras`
--

INSERT INTO `carreras` (`nombre`) VALUES
('Computación'),
('Matemática'),
('Física'),
('Biología'),
('Química');

-- --------------------------------------------------------

--
-- Table structure for table `libro`
--

CREATE TABLE `libro` (
  `id` int(1) NOT NULL,
  `titulo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `isbm` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `autor` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `id_adm` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `libro`
--

INSERT INTO `libro` (`id`, `titulo`, `isbm`, `autor`, `id_adm`) VALUES
(6, 'The Girl On The Train', '1234-4567-5432-5345', 'Paula Hawkins', 8),
(7, 'Q&A', '1234-4567-5432-5345', 'Vivikas Swarup', 8),
(8, 'Harry Potter & The Half-Blood Prince', '8633-5457-9754-3442', 'J.K Rowling', 8),
(9, 'El Hombre Equivocado', '1234-7654-3456-9182', 'John Katzenbach', 8);

-- --------------------------------------------------------

--
-- Table structure for table `prestamo`
--

CREATE TABLE `prestamo` (
  `id` int(1) NOT NULL,
  `inicio` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `final` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `id_libro` int(1) NOT NULL,
  `id_usuario` int(1) NOT NULL,
  `id_adm` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `prestamo`
--

INSERT INTO `prestamo` (`id`, `inicio`, `final`, `id_libro`, `id_usuario`, `id_adm`) VALUES
(2, '10/11/2016', '16/11/2016', 6, 25, 8),
(3, '22/11/2016', '24/11/2016', 7, 25, 8),
(4, '08/12/2016', '09/11/2016', 8, 24, 8),
(5, '09/11/2016', '12/11/2016', 6, 24, 8);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
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
  `id_adm` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `cedula`, `telefono`, `correo`, `carrera`, `registro`, `estatus`, `id_adm`) VALUES
(24, 'Jean Manuel', 'Figueroa', '22003186', '04123409830', 'jeanmanuelfigueroa@gmail.com', 'Química', '2016-11-07', 'DESACTIVADO', 6),
(25, 'Sia', 'Fuller', '18452363', '04144415939', 'sia.fuller@icloud.com', 'Computación', '2016-11-11', 'ACTIVO', 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_adm` (`id_adm`),
  ADD KEY `id_adm_2` (`id_adm`);

--
-- Indexes for table `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_adm` (`id_adm`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_libro` (`id_libro`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_adm` (`id_adm`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `libro`
--
ALTER TABLE `libro`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `libro`
--
ALTER TABLE `libro`
  ADD CONSTRAINT `libro_ibfk_1` FOREIGN KEY (`id_adm`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `prestamo_ibfk_1` FOREIGN KEY (`id_adm`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prestamo_ibfk_2` FOREIGN KEY (`id_libro`) REFERENCES `libro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prestamo_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_adm`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
