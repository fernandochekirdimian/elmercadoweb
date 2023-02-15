-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-02-2023 a las 04:12:24
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mercado`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avisos`
--

CREATE TABLE `avisos` (
  `id` int(11) NOT NULL,
  `referencia` varchar(10) DEFAULT NULL,
  `titulo` varchar(50) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `fecha_publicacion` date DEFAULT NULL,
  `publicado` int(11) DEFAULT NULL,
  `en_pagprin` int(11) DEFAULT NULL,
  `forma_pago` varchar(200) DEFAULT NULL,
  `precio` varchar(20) DEFAULT NULL,
  `subrubros_id` int(11) DEFAULT NULL,
  `clientes_id` int(11) NOT NULL,
  `rubros_id` int(11) NOT NULL,
  `forma_cobro` int(11) NOT NULL,
  `costo` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `domicilio` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `passwd` text NOT NULL,
  `provincia` varchar(100) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `codigo_postal` varchar(5) DEFAULT NULL,
  `mostrar_mail` int(11) DEFAULT NULL,
  `mostrar_telefono` int(11) DEFAULT NULL,
  `mostrar_celular` int(11) DEFAULT NULL,
  `mostrar_domicilio` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_cobro`
--

CREATE TABLE `datos_cobro` (
  `id` int(11) NOT NULL,
  `domicilio` int(11) DEFAULT NULL,
  `horario` int(11) DEFAULT NULL,
  `avisos_id` int(11) NOT NULL,
  `clientes_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_avisos`
--

CREATE TABLE `imagenes_avisos` (
  `id` int(11) NOT NULL,
  `url` varchar(256) NOT NULL,
  `avisos_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubros`
--

CREATE TABLE `rubros` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `costo` decimal(3,2) DEFAULT NULL,
  `costo_pp` decimal(3,2) DEFAULT NULL,
  `costo_envio` decimal(3,2) DEFAULT NULL,
  `costo_domicilio` decimal(3,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `rubros`
--

INSERT INTO `rubros` (`id`, `descripcion`, `costo`, `costo_pp`, `costo_envio`, `costo_domicilio`) VALUES
(1, 'Automotores', '6.00', '5.00', '1.00', '2.00'),
(2, 'Construccion', '4.00', '5.00', '1.00', '2.00'),
(3, 'Hogar', '3.00', '5.00', '1.00', '2.00'),
(4, 'Informatica', '3.00', '5.00', '1.00', '2.00'),
(5, 'Telefonia y Comunicaciones', '3.00', '5.00', '1.00', '2.00'),
(6, 'Inmuebles', '9.00', '5.00', '1.00', '2.00'),
(7, 'Indumentaria', '3.00', '5.00', '1.00', '2.00'),
(10, 'Instrumentos Musicales', '3.00', '5.00', '1.00', '2.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subrubros`
--

CREATE TABLE `subrubros` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `rubros_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `subrubros`
--

INSERT INTO `subrubros` (`id`, `descripcion`, `rubros_id`) VALUES
(3, 'Autos', 1),
(8, 'Motos', 1),
(20, 'Materiales', 2),
(21, 'Electricidad e Iluminacion', 2),
(25, 'Frio/Calor', 3),
(26, 'Amoblamientos', 3),
(28, 'Blanco Hogar', 3),
(35, 'Electrodomesticos', 3),
(36, 'Frio/Calor', 3),
(37, 'Amoblamientos', 3),
(38, 'Seguridad', 3),
(43, 'Hardware', 4),
(46, 'Celulares', 5),
(47, 'Telefonos', 5),
(48, 'Fax', 5),
(49, 'Otros', 5),
(50, 'Alquiler de Casas', 6),
(51, 'Alquiler de Dptos', 6),
(57, 'Ventas de Casas', 6),
(58, 'Ventas de Departamentos', 6),
(64, 'Ventas de Negocios', 6);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `avisos`
--
ALTER TABLE `avisos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_avisos_subrubros1` (`subrubros_id`),
  ADD KEY `fk_avisos_clientes1` (`clientes_id`),
  ADD KEY `fk_avisos_rubros1` (`rubros_id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datos_cobro`
--
ALTER TABLE `datos_cobro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_datos_cobro_avisos1` (`avisos_id`),
  ADD KEY `fk_datos_cobro_clientes1` (`clientes_id`);

--
-- Indices de la tabla `imagenes_avisos`
--
ALTER TABLE `imagenes_avisos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_imagenes_avisos_avisos1` (`avisos_id`);

--
-- Indices de la tabla `rubros`
--
ALTER TABLE `rubros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `subrubros`
--
ALTER TABLE `subrubros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_subrubros_rubros` (`rubros_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `avisos`
--
ALTER TABLE `avisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `datos_cobro`
--
ALTER TABLE `datos_cobro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagenes_avisos`
--
ALTER TABLE `imagenes_avisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rubros`
--
ALTER TABLE `rubros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `subrubros`
--
ALTER TABLE `subrubros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
