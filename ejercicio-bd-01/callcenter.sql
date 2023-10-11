-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-10-2023 a las 04:55:45
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
-- Base de datos: `callcenter`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agentes`
--

CREATE TABLE `agentes` (
  `ageCodigo` int(6) DEFAULT NULL,
  `ageNombre` varchar(30) DEFAULT NULL,
  `ageCantidadAtendida` int(10) DEFAULT NULL,
  `ageCantidadRecibida` int(10) DEFAULT NULL,
  `ageActivo` enum('1','0') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `agentes`
--

INSERT INTO `agentes` (`ageCodigo`, `ageNombre`, `ageCantidadAtendida`, `ageCantidadRecibida`, `ageActivo`) VALUES
(123456, 'Lucas', 4, 3, '1'),
(234567, 'Mario', 3, 2, '1'),
(345678, 'Joel', 0, 0, ''),
(456789, 'Marce', 0, 0, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrantes`
--

CREATE TABLE `entrantes` (
  `entId` int(6) DEFAULT NULL,
  `entOrigen` varchar(15) DEFAULT NULL,
  `entDestino` int(6) DEFAULT NULL,
  `entDuracion` int(10) DEFAULT NULL,
  `ageCodigo` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `entrantes`
--

INSERT INTO `entrantes` (`entId`, `entOrigen`, `entDestino`, `entDuracion`, `ageCodigo`) VALUES
(1, '3411114435', 333333, 860, 123456),
(2, '3411114421', 444333, 86, 123456),
(3, '3411114435', 333333, 860, 123456),
(4, '3411114435', 333333, 860, 123456),
(5, '3411114435', 333333, 860, 234567),
(4, '3411114435', 333333, 860, 234567),
(4, '3411114435', 333333, 860, 234567);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salientes`
--

CREATE TABLE `salientes` (
  `salID` int(6) DEFAULT NULL,
  `salOrigen` int(6) DEFAULT NULL,
  `salDestino` varchar(15) DEFAULT NULL,
  `salDuracion` int(10) DEFAULT NULL,
  `ageCodigo` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `salientes`
--

INSERT INTO `salientes` (`salID`, `salOrigen`, `salDestino`, `salDuracion`, `ageCodigo`) VALUES
(1, 333333, '3415554442', 233, 123456),
(2, 2147483647, '333333', 860, 123456),
(3, 2147483647, '333333', 860, 123456),
(4, 2147483647, '333333', 860, 234567),
(4, 2147483647, '333333', 860, 234567);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
