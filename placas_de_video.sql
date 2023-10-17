-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-10-2023 a las 22:24:32
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
-- Base de datos: `placas_de_video`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_placa`
--

CREATE TABLE `categoria_placa` (
  `Marca_ID` varchar(255) DEFAULT NULL,
  `Producto_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `ID` int(11) NOT NULL,
  `Marca` varchar(255) NOT NULL,
  `Modelo` varchar(255) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `Precio` decimal(10,2) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria_placa`
--
ALTER TABLE `categoria_placa`
  ADD KEY `Marca_ID` (`Marca_ID`),
  ADD KEY `Producto_ID` (`Producto_ID`);

--
-- Indices de la tabla `especificacion`
--
ALTER TABLE `especificacion`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Producto_ID` (`Producto_ID`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Marca` (`Marca`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoria_placa`
--
ALTER TABLE `categoria_placa`
  ADD CONSTRAINT `categoria_placa_ibfk_1` FOREIGN KEY (`Marca_ID`) REFERENCES `producto` (`Marca`),
  ADD CONSTRAINT `categoria_placa_ibfk_2` FOREIGN KEY (`Producto_ID`) REFERENCES `producto` (`ID`);

--
-- Volcado de datos para inicializar la db
--

INSERT INTO `usuarios` (`ID`, `Username`, `Password`) VALUES
(1, 'webadmin', 'admin');


INSERT INTO `categoria_placa` (`Marca_ID`) VALUES ('Nvidia');

INSERT INTO `categoria_placa` (`Marca_ID`) VALUES ('AMD');

INSERT INTO `producto` (`ID`, `Marca`,`Modelo`,`Descripcion`,`Precio`) VALUES ('','Nvidia','RTX 3080','Placa de video Gigabyte NVIDIA RTX 3080 de de 12GB de Memoria','300');

INSERT INTO `producto` (`ID`, `Marca`,`Modelo`,`Descripcion`,`Precio`) VALUES ('','AMD','6700XT','Placa de video Zotac 6700XT de 12GB de Memoria','250');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
