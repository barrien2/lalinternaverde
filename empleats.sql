-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-12-2019 a las 17:43:16
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `empleats`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insignies`
--

CREATE TABLE `insignies` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `puntuacio` int(11) NOT NULL,
  `limit_insignies` int(11) NOT NULL,
  `imatge` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `insignies`
--

INSERT INTO `insignies` (`id`, `nom`, `puntuacio`, `limit_insignies`, `imatge`) VALUES
(3, 'fogkz', 7, 9, ''),
(6, 'aisudosu', 500, 2, ''),
(7, 'siomesi', 50, 5, ''),
(10, 'peachepe', 70, 8, ''),
(12, 'lol', 2, 9, ''),
(13, 'giuarda', 8, 8, 'guardatio.png'),
(14, 'prova inici', 100000, 10, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rols`
--

CREATE TABLE `rols` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `valor` int(11) NOT NULL,
  `descripcio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rols`
--

INSERT INTO `rols` (`id`, `nom`, `valor`, `descripcio`) VALUES
(1, 'Consultor', 1, 'Només permisos de lectura'),
(2, 'Editor', 2, 'Permisos de consultar y modificar'),
(3, 'Administrador', 3, 'Tots els permisos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `treballadors`
--

CREATE TABLE `treballadors` (
  `id` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `cognom` varchar(40) NOT NULL,
  `edat` tinyint(3) UNSIGNED NOT NULL,
  `antiguitat` tinyint(3) UNSIGNED NOT NULL,
  `data_naixement` date DEFAULT NULL,
  `usuari` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `treballadors`
--

INSERT INTO `treballadors` (`id`, `id_rol`, `nom`, `cognom`, `edat`, `antiguitat`, `data_naixement`, `usuari`, `password`) VALUES
(282, 3, 'Xavi', 'Barriendosss', 0, 5, '1999-04-02', 'pere', '$2y$10$6MqW/pdJjR0wCnlSTgf5FO.uq7YC0VKv7CCFN1Kcu9v8VDy9KZXze'),
(284, 1, 'Xasfdgsvi', 'Barriendos', 0, 5, '1999-04-02', NULL, NULL),
(285, 1, 'Pesdfgre', 'Linares', 0, 2, '2000-12-29', NULL, NULL),
(286, 1, 'Xasfdgraevi', 'Barraregiendos', 0, 5, '1999-04-02', NULL, NULL),
(287, 3, 'Pere', 'Linares', 0, 5, '1999-04-02', 'pere13', '$2y$10$m6VmZ39d5D/1k8KVSgfaWOwPfTrvDFz7TN7Pim9BbaVkKCcuup9AS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `treballadors_insignies`
--

CREATE TABLE `treballadors_insignies` (
  `id` int(11) NOT NULL,
  `id_insignia` int(11) NOT NULL,
  `id_treballador` int(11) NOT NULL,
  `data_otorgat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `treballadors_insignies`
--

INSERT INTO `treballadors_insignies` (`id`, `id_insignia`, `id_treballador`, `data_otorgat`) VALUES
(11, 14, 287, '2019-12-05 15:47:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `insignies`
--
ALTER TABLE `insignies`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rols`
--
ALTER TABLE `rols`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `treballadors`
--
ALTER TABLE `treballadors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `treballador_unic` (`nom`,`cognom`),
  ADD UNIQUE KEY `usuari` (`usuari`),
  ADD KEY `treb_rol_fk` (`id_rol`);

--
-- Indices de la tabla `treballadors_insignies`
--
ALTER TABLE `treballadors_insignies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `treballador_insignia_unic` (`id_insignia`,`id_treballador`),
  ADD KEY `trebinsignia_treballador_fk` (`id_treballador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `insignies`
--
ALTER TABLE `insignies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `rols`
--
ALTER TABLE `rols`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `treballadors`
--
ALTER TABLE `treballadors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=288;

--
-- AUTO_INCREMENT de la tabla `treballadors_insignies`
--
ALTER TABLE `treballadors_insignies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `treballadors`
--
ALTER TABLE `treballadors`
  ADD CONSTRAINT `treb_rol_fk` FOREIGN KEY (`id_rol`) REFERENCES `rols` (`id`);

--
-- Filtros para la tabla `treballadors_insignies`
--
ALTER TABLE `treballadors_insignies`
  ADD CONSTRAINT `trebinsignia_insignia_fk` FOREIGN KEY (`id_insignia`) REFERENCES `insignies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trebinsignia_treballador_fk` FOREIGN KEY (`id_treballador`) REFERENCES `treballadors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
