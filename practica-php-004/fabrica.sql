-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-10-2023 a las 00:15:32
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
-- Base de datos: `fabrica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `nombre` varchar(30) DEFAULT NULL,
  `documento` varchar(8) DEFAULT NULL,
  `estadoCivil` varchar(15) DEFAULT NULL,
  `hijos` int(11) DEFAULT NULL,
  `numEmpleado` int(11) NOT NULL,
  `valorHora` float DEFAULT NULL,
  `actualizado` enum('SI','NO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`nombre`, `documento`, `estadoCivil`, `hijos`, `numEmpleado`, `valorHora`, `actualizado`) VALUES
('Juan Pérez', '12345678', 'Casado', 2, 1, 10, 'SI'),
('María García', '98765432', 'Soltero', 0, 2, 12.5, 'SI'),
('Carlos López', '56789012', 'Casado', 1, 3, 11, 'SI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajo`
--

CREATE TABLE `trabajo` (
  `numEmpleado` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `horas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `trabajo`
--

INSERT INTO `trabajo` (`numEmpleado`, `fecha`, `horas`) VALUES
(1, '2023-10-10', 8),
(1, '2023-10-11', 7),
(2, '2023-10-10', 6),
(3, '2023-10-10', 8),
(3, '2023-10-11', 7);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`numEmpleado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
