-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-10-2023 a las 14:05:25
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `calculo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `herramientas`
--

CREATE TABLE `herramientas` (
  `HerCod` int(11) NOT NULL,
  `HerDes` varchar(30) DEFAULT NULL,
  `HerSto` int(11) DEFAULT NULL,
  `HerObs` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `herramientas`
--

INSERT INTO `herramientas` (`HerCod`, `HerDes`, `HerSto`, `HerObs`) VALUES
(2050, 'Tenazas Grandes', 65, 'Tenazas grandes color negro'),
(4278, 'Pinzas Versalles', 13, 'Pinzas provenientes de versalles'),
(5874, 'Llaves de Tubo', 25, 'Llaves de tubo de una pulgada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `MovFec` datetime DEFAULT NULL,
  `HerCod` int(11) DEFAULT NULL,
  `MovCod` enum('1','0') DEFAULT NULL,
  `MovPer` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`MovFec`, `HerCod`, `MovCod`, `MovPer`) VALUES
('2023-10-05 00:00:00', 2050, '1', 'Lucas'),
('2023-10-03 00:00:00', 5874, '1', 'Marvo'),
('2023-10-03 00:00:00', 5874, '1', 'Marvo'),
('2023-10-01 00:00:00', 4278, '1', 'Gustavo'),
('2023-10-01 00:00:00', 4278, '1', 'Gustavo'),
('2023-10-01 00:00:00', 4278, '', 'Gustavo'),
('2023-10-02 00:00:00', 2050, '1', 'Kimetsu'),
('2023-10-02 00:00:00', 2050, '1', 'Kimetsu'),
('2023-10-02 00:00:00', 2050, '', 'Kimetsu'),
('2023-10-02 00:00:00', 2050, '', 'Kimetsu'),
('2023-10-06 00:00:00', 2050, '1', 'Lucas'),
('2023-10-01 00:00:00', 2050, '1', 'Mario'),
('2023-10-01 00:00:00', 2050, '1', 'Mario'),
('2023-10-01 00:00:00', 2050, '', 'Mario'),
('2023-10-01 00:00:00', 2050, '', 'Mario'),
('2023-10-01 00:00:00', 2050, '', 'Mario'),
('2023-10-01 00:00:00', 2050, '', 'Mario'),
('2023-10-01 00:00:00', 2050, '', 'Mario'),
('2023-10-01 00:00:00', 2050, '1', 'Mario'),
('2023-10-01 00:00:00', 2050, '1', 'Mario'),
('2023-10-01 00:00:00', 2050, '', 'Mario'),
('2023-10-01 00:00:00', 4278, '', 'Mario'),
('2023-10-01 00:00:00', 2050, '1', 'Mario'),
('2023-10-01 00:00:00', 4278, '1', 'Mario'),
('2023-10-01 00:00:00', 5874, '1', 'Mario'),
('2023-10-01 00:00:00', 5874, '', 'Mario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `herramientas`
--
ALTER TABLE `herramientas`
  ADD PRIMARY KEY (`HerCod`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD KEY `HerCod` (`HerCod`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `herramientas`
--
ALTER TABLE `herramientas`
  MODIFY `HerCod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5875;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_ibfk_1` FOREIGN KEY (`HerCod`) REFERENCES `herramientas` (`HerCod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
