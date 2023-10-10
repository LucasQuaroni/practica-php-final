-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-10-2023 a las 01:55:59
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
-- Base de datos: `telefonia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consumos`
--

CREATE TABLE `consumos` (
  `numlin` int(11) DEFAULT NULL,
  `feccon` date DEFAULT NULL,
  `cancon` float DEFAULT NULL,
  `concon` enum('D','T') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `consumos`
--

INSERT INTO `consumos` (`numlin`, `feccon`, `cancon`, `concon`) VALUES
(234, '2023-10-10', 345, 'D'),
(234, '2023-10-10', 345, 'T'),
(234, '2023-10-10', 342.4, 'T'),
(456, '2023-10-10', 3451, 'D'),
(456, '2023-10-10', 34325, 'D'),
(123, '2023-10-10', 4500.85, 'D');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titulares`
--

CREATE TABLE `titulares` (
  `doctit` varchar(8) DEFAULT NULL,
  `nomtit` varchar(30) DEFAULT NULL,
  `demas` varchar(50) DEFAULT NULL,
  `numlin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `titulares`
--

INSERT INTO `titulares` (`doctit`, `nomtit`, `demas`, `numlin`) VALUES
('44765283', 'Lucas Quaroni', 'Desarrollador de software, rosarino', 123),
('44232238', 'Marcelo Benitez', 'Jugador de basquet', 234),
('44452085', 'Mateo Bodini', 'Jugador profesional de Fortnite', 456);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `consumos`
--
ALTER TABLE `consumos`
  ADD KEY `numlin` (`numlin`);

--
-- Indices de la tabla `titulares`
--
ALTER TABLE `titulares`
  ADD PRIMARY KEY (`numlin`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `consumos`
--
ALTER TABLE `consumos`
  ADD CONSTRAINT `consumos_ibfk_1` FOREIGN KEY (`numlin`) REFERENCES `titulares` (`numlin`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
