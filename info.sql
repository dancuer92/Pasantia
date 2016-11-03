-- CREATE TABLE `info_test2` (
--     `id` int(11) NOT NULL,
--     `fecha_registro_sistema` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
--     `fecha_formato_diligenciado` date NOT NULL,
--     `usuario` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
--     `estado` tinyint(4) NOT NULL,
--     `informacion` text COLLATE utf8_spanish_ci NOT NULL,
--     `observaciones` text COLLATE utf8_spanish_ci NULL,
--     `campos_clave` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
--     `fechas_modificaciones` text COLLATE utf8_spanish_ci NULL,
--     `usuarios_modificaciones` text COLLATE utf8_spanish_ci NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- 
-- ALTER TABLE `info_test2`
--     ADD PRIMARY KEY (`id`),
--     ADD UNIQUE (`campos_clave`),
--     MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;



--Rename table info_tabla_nueva to info_test

-- alter table infp_test rename as info_nuevo_nombre;


--UPDATE `info_test` info SET `campos_clave`= concat('fecha_registro=',info.fecha_registro_sistema) WHERE `campos_clave`=''




-- ALTER TABLE `pasantia`.`info_ctrl-atm35-40` 
-- ADD `campos_clave` VARCHAR(255) NOT NULL AFTER `observaciones`, 
-- ADD `fechas_modificaciones` TEXT NULL AFTER `campos_clave`, 
-- ADD `usuarios_modificaciones` TEXT NULL AFTER `fechas_modificaciones`;
-- UPDATE `pasantia`.`info_ctrl-atm35-40` info SET `campos_clave`= concat('fecha_registro=',info.fecha_registro_sistema) WHERE `campos_clave`='';
-- ALTER TABLE `pasantia`.`info_ctrl-atm35-40` 
-- ADD UNIQUE (`campos_clave`);


-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2016 a las 22:04:40
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.23

-- SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
-- SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pasantia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_informacion`
--



-- CREATE TABLE `pasantia`.`usuario_informacion` (
--   `id_usuario` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
--   `id_formato` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
--   `id_registro` TIMESTAMP CURRENT TIMESTAMP NOT NULL,
--   `campos_digitados` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- 
-- --
-- -- Índices para tablas volcadas
-- --
-- 
-- --
-- -- Indices de la tabla `usuario_informacion`
-- --
-- ALTER TABLE `pasantia`.`usuario_informacion`
--   ADD PRIMARY KEY (`id_usuario`,`id_formato`,`id_registro`),
--   ADD KEY `id_formato` (`id_formato`),
--   ADD KEY `id_usuario` (`id_usuario`);
-- 
-- --
-- -- Restricciones para tablas volcadas
-- --
-- 
-- --
-- -- Filtros para la tabla `usuario_informacion`
-- --
-- ALTER TABLE `pasantia`.`usuario_informacion`
--   ADD CONSTRAINT `usuario_informacion_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`codigo_usuario`),
--   ADD CONSTRAINT `usuario_informacion_ibfk_2` FOREIGN KEY (`id_formato`) REFERENCES `formato` (`cod_formato`);
-- 
-- /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
-- /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
-- /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
