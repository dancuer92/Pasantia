-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-03-2016 a las 17:37:14
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pasantia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato`
--

CREATE TABLE `formato` (
  `cod_formato` int(11) NOT NULL,
  `nombre` varchar(30) CHARACTER SET latin1 NOT NULL,
  `observaciones` text CHARACTER SET latin1 NOT NULL,
  `procedimiento` varchar(30) CHARACTER SET latin1 NOT NULL,
  `jefe_procedimiento` int(11) NOT NULL,
  `descripcion_contenido` varchar(30) CHARACTER SET latin1 NOT NULL,
  `frecuencia_uso` varchar(30) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `formato`
--

INSERT INTO `formato` (`cod_formato`, `nombre`, `observaciones`, `procedimiento`, `jefe_procedimiento`, `descripcion_contenido`, `frecuencia_uso`) VALUES
(9876, 'Prueba', 'Actualizado en el sistema de gestion de la calidad de ceramica italia sa', 'prueba 1', 1234, 'input text', 'diario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_modificacion_formato`
--

CREATE TABLE `historial_modificacion_formato` (
  `id_formato` int(11) NOT NULL,
  `id_modificaciones` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_modificacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `codigo_usuario` int(10) NOT NULL,
  `nombre_usuario` varchar(30) CHARACTER SET latin1 NOT NULL,
  `apellido_usuario` varchar(30) CHARACTER SET latin1 NOT NULL,
  `cedula_usuario` varchar(15) CHARACTER SET latin1 NOT NULL,
  `password_usuario` varchar(50) CHARACTER SET latin1 NOT NULL,
  `correo_usuario` varchar(50) CHARACTER SET latin1 NOT NULL,
  `cargo_usuario` varchar(50) CHARACTER SET latin1 NOT NULL,
  `departamento_usuario` varchar(30) CHARACTER SET latin1 NOT NULL,
  `telefono_usuario` varchar(20) CHARACTER SET latin1 NOT NULL,
  `rol_usuario` tinyint(1) NOT NULL,
  `estado_usuario` tinyint(1) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`codigo_usuario`, `nombre_usuario`, `apellido_usuario`, `cedula_usuario`, `password_usuario`, `correo_usuario`, `cargo_usuario`, `departamento_usuario`, `telefono_usuario`, `rol_usuario`, `estado_usuario`, `fecha_registro`) VALUES
(1090, 'dani', 'cuervo', '1090', 'asdf', 'da@asd.c', 'pasante', 'ti', '199', 1, 1, '2016-03-12 15:06:00'),
(1234, 'admin', 'admin', '1090', '0000', 'admin@cisa.com', 'dirti', ' ti planta', '336', 1, 1, '2016-03-10 19:55:56'),
(3210, 'oper', 'oper', '9874', '1234', 'oper@cisa.com', 'operario', 'ti', '119', 0, 1, '2016-03-05 15:37:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_formato`
--

CREATE TABLE `usuario_formato` (
  `id_usuario` int(11) NOT NULL,
  `id_formato` int(11) NOT NULL,
  `fecha_asignacion` date NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `formato`
--
ALTER TABLE `formato`
  ADD PRIMARY KEY (`cod_formato`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codigo_usuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
