-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-10-2023 a las 20:42:11
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
-- Base de datos: `concesionaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autos`
--

CREATE TABLE `autos` (
  `id` int(11) NOT NULL,
  `marca` varchar(30) DEFAULT NULL,
  `modelo` varchar(30) DEFAULT NULL,
  `anio` int(4) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `PrecioVenta` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `autos`
--

INSERT INTO `autos` (`id`, `marca`, `modelo`, `anio`, `color`, `PrecioVenta`) VALUES
(2, 'Toyota', 'Camry', 2020, 'Plateado', 19000),
(3, 'Volkswagen', 'Golf', 2019, 'Rojo', 15000),
(4, 'Volkswagen', 'Jetta', 2022, 'Negro', 20000),
(5, 'Renault', 'Clio', 2018, 'Azul', 12000),
(6, 'Renault', 'Megane', 2020, 'Gris', 14000),
(7, 'Ford', 'Focus', 2021, 'Rojo', 16000),
(8, 'Ford', 'Fiesta', 2019, 'Verde', 13000),
(9, 'Chevrolet', 'Cruze', 2022, 'Gris', 17000),
(10, 'Chevrolet', 'Malibu', 2021, 'Negro', 19000),
(11, 'Toyota', 'Corolla', 2021, 'Blanco', 18000),
(12, 'Toyota', 'Corolla', 2021, 'Blanco', 18000),
(13, 'Toyota', 'Corolla', 2021, 'Blanco', 18000);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autos`
--
ALTER TABLE `autos`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
