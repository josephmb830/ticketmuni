-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-04-2018 a las 06:46:03
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `php_phpexcel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `id` int(11) NOT NULL,
  `nombres` varchar(250) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `asunto` varchar(220) DEFAULT NULL,
  `mensajes` text,
  `fcreacion` datetime DEFAULT NULL,
  `fmodificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`id`, `nombres`, `email`, `asunto`, `mensajes`, `fcreacion`, `fmodificacion`) VALUES
(1, 'Mario', 'admin25@mimailes.com', 'Examen 01', 'Mi resultado 01', '2018-04-24 21:03:00', NULL),
(2, 'Mario', 'admin25@mimailes.com', 'Examen 02', 'Mi resultado 02', '2018-04-24 21:20:07', NULL),
(3, 'Mario', 'admin25@hotmail.com', 'Examen 03', 'Mi resultado 03', '2018-04-24 21:37:52', NULL),
(4, 'Mario Giron', 'admin25@mimailes.com', 'Examen 04', 'Mi resultado 04 del parcial', '2018-04-24 12:24:27', NULL),
(5, 'Mario Giron', 'admin25@mimailes.com', 'Examen 05', 'Mi resultado 05 del parcial', '2018-04-24 12:26:35', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
