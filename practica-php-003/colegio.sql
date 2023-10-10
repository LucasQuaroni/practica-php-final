-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-10-2023 a las 04:36:10
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
-- Base de datos: `colegio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `AluLegajo` int(11) NOT NULL,
  `AluNombre` varchar(30) DEFAULT NULL,
  `AluOtrosDatos` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`AluLegajo`, `AluNombre`, `AluOtrosDatos`) VALUES
(1, 'Juan Pérez', 'Fecha de Nacimiento: 1999-05-15'),
(2, 'María López', 'Fecha de Nacimiento: 2000-03-20'),
(3, 'Carlos González', 'Fecha de Nacimiento: 2001-09-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturas`
--

CREATE TABLE `asignaturas` (
  `AsiNombre` varchar(20) DEFAULT NULL,
  `AsiAsignatura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asignaturas`
--

INSERT INTO `asignaturas` (`AsiNombre`, `AsiAsignatura`) VALUES
('Matemáticas', 1),
('Historia', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `DocNombre` varchar(30) DEFAULT NULL,
  `DocDocente` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`DocNombre`, `DocDocente`) VALUES
('Juan Pérez', '44444444'),
('María López', '55555555');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examenes`
--

CREATE TABLE `examenes` (
  `ExaFecha` date DEFAULT NULL,
  `AluLegajo` int(11) DEFAULT NULL,
  `DocDocente` varchar(8) DEFAULT NULL,
  `ExaNota` float DEFAULT NULL,
  `AsiAsignatura` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `examenes`
--

INSERT INTO `examenes` (`ExaFecha`, `AluLegajo`, `DocDocente`, `ExaNota`, `AsiAsignatura`) VALUES
('2023-01-15', 1, '44444444', 8.5, 1),
('2023-02-20', 1, '55555555', 7, 2),
('2023-03-10', 2, '44444444', 6.5, 1),
('2023-04-15', 2, '55555555', 8, 2),
('2023-05-20', 3, '44444444', 7.5, 1),
('2023-06-10', 3, '55555555', 9, 2),
('2023-10-10', 2, '44444444', 9, 2),
('2023-10-10', 2, '44444444', 4, 2),
('2023-10-10', 2, '44444444', 4, 2),
('2023-10-10', 2, '44444444', 7, 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
