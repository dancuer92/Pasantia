-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-04-2016 a las 01:09:53
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
  `cod_formato` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(30) CHARACTER SET latin1 NOT NULL,
  `observaciones` text CHARACTER SET latin1 NOT NULL,
  `procedimiento` varchar(30) CHARACTER SET latin1 NOT NULL,
  `jefe_procedimiento` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `descripcion_contenido` varchar(30) CHARACTER SET latin1 NOT NULL,
  `frecuencia_uso` varchar(30) CHARACTER SET latin1 NOT NULL,
  `codigo_html` text COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `formato`
--

INSERT INTO `formato` (`cod_formato`, `nombre`, `observaciones`, `procedimiento`, `jefe_procedimiento`, `descripcion_contenido`, `frecuencia_uso`, `codigo_html`) VALUES
('RMO-1100', 'Cargue materia prima', 'Version 8', 'PreparaciÃ³n pasta', 'Felix Garcia', 'tabla', 'Turnos', '<table id="encabezado" style="width:100%;text-align: center" class="ui-sortable-handle">\n                    <tbody><tr>\n                    <td><h2> Nombre: Cargue materia prima</h2></td>\n                    <td><h2> Codigo: RMO-1100 </h2></td>                    \n                    <td><img class="img-responsive" src="../util/images/corporativo/logo_ceramica.png" alt="CerÃ¡mica Italia"></td>\n                    </tr>\n                </tbody></table>\n            <div class="formato form-group ui-state-default ui-sortable-handle"><label>Fecha </label><input id="fecha_" type="text" length="30" disabled=""></div><div class="formato form-group ui-state-default"><label>Operario</label><input id="operario" type="text" length="30" disabled=""></div><div class="formato ui-state-default"><label>Tipo de cargue</label> <br><input id="tipo_de_cargue-0" type="checkbox" name="tipo_de_cargue-0" value="Gres" disabled=""><p>Gres</p><input id="tipo_de_cargue-1" type="checkbox" name="tipo_de_cargue-1" value="Ensayo" disabled=""><p>Ensayo</p></div><div class="formato ui-state-default"><label>Turno</label><br><input type="radio" id="turno-0" name="radio" value="6 a.m. - 2 p.m." disabled=""><p>6 a.m. - 2 p.m.</p> <input type="radio" id="turno-1" name="radio" value="2 p.m. - 8 p.m." disabled=""><p>2 p.m. - 8 p.m.</p><input type="radio" id="turno-2" name="radio" value="8 p.m. - 6 a.m." disabled=""><p>8 p.m. - 6 a.m.</p></div><div class="formato  form-group ui-state-default"><label>Tolva No.</label><input id="tolva_no." type="number" length="15" disabled=""></div><div class="formato  form-group ui-state-default"><label>NÃºmero de cargue</label><input id="nÃºmero_de_cargue" type="number" length="15" disabled=""></div><div class="formato ui-state-default" style="width:100%;"><label>Tabla de materiales</label></div><div class="formato ui-state-default"><table id="tabla" name="tabla"><thead><tr><th><label>Titulo 1</label></th><th><p>Nueva columna</p></th><th><p>Nueva columna</p></th><th><p>Nueva columna</p></th><th><p>Nueva columna</p></th></tr></thead><tbody><tr><td><p>Untitled </p><input id="Untitled" type="text" disabled=""></td><td><p>Untitled </p><input id="Untitled" type="text" disabled=""></td><td><p>Untitled </p><input id="Untitled" type="text" disabled=""></td><td><p>Untitled </p><input id="Untitled" type="text" disabled=""></td><td><p>Untitled </p><input id="Untitled" type="text" disabled=""></td></tr><tr><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td><td><p>Untitled </p><input id="Untitled" type="text" disabled=""></td><td><p>Untitled </p><input id="Untitled" type="text" disabled=""></td><td><p>Untitled </p><input id="Untitled" type="text" disabled=""></td><td><p>Untitled </p><input id="Untitled" type="text" disabled=""></td></tr><tr><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td></tr><tr><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td></tr><tr><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td></tr><tr><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td></tr><tr><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td></tr><tr><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td><td><p>Untitled </p><p><input id="Untitled" type="text" disabled=""></p></td></tr></tbody></table></div><div class="formato ui-state-default"><label>Observaciones</label><textarea id="observaciones" type="text" disabled="" name="observaciones" style="margin: 0px; width: 619px; height: 67px;"></textarea></div><div class="formato form-group ui-state-default"><label>Consecutivo</label><input id="consecutivo" type="text" length="30" disabled=""></div><div class="formato form-group ui-state-default isSelected"><label>Firma del cargador</label><input id="firma_del_cargador" type="text" length="30" disabled=""></div><div class="formato ui-state-default" style="width:100%;"><label>Naturaleza del cambio: 00.718.784</label></div>');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_modificacion_formato`
--

CREATE TABLE `historial_modificacion_formato` (
  `id_formato` int(11) NOT NULL,
  `id_modificaciones` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_modificacion` date NOT NULL,
  `observaciones` text COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_usuario_formato`
--

CREATE TABLE `historial_usuario_formato` (
  `id` int(11) NOT NULL,
  `id_usuario` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `id_formato` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `accion` varchar(30) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `historial_usuario_formato`
--

INSERT INTO `historial_usuario_formato` (`id`, `id_usuario`, `id_formato`, `fecha`, `accion`) VALUES
(1, 'super', 'RMO-1100', '2016-04-08 22:54:39', 'asignado'),
(2, 'super', 'RMO-1100', '2016-04-08 23:02:32', 'desasignado'),
(3, 'super', 'RMO-1100', '2016-04-08 23:02:41', 'asignado'),
(4, 'super', 'RMO-1100', '2016-04-08 23:04:09', 'desasignado'),
(5, 'super', 'RMO-1100', '2016-04-08 23:06:55', 'asignado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipo` int(1) NOT NULL,
  `descripcion_tipo` varchar(30) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo`, `descripcion_tipo`) VALUES
(0, 'operario'),
(1, 'administrador'),
(2, 'asistente'),
(3, 'supervisor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `codigo_usuario` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `nombre_usuario` varchar(30) CHARACTER SET latin1 NOT NULL,
  `apellido_usuario` varchar(30) CHARACTER SET latin1 NOT NULL,
  `cedula_usuario` varchar(15) CHARACTER SET latin1 NOT NULL,
  `password_usuario` varchar(50) CHARACTER SET latin1 NOT NULL,
  `correo_usuario` varchar(50) CHARACTER SET latin1 NOT NULL,
  `cargo_usuario` varchar(50) CHARACTER SET latin1 NOT NULL,
  `departamento_usuario` varchar(30) CHARACTER SET latin1 NOT NULL,
  `telefono_usuario` varchar(20) CHARACTER SET latin1 NOT NULL,
  `rol_usuario` int(1) NOT NULL,
  `estado_usuario` tinyint(1) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`codigo_usuario`, `nombre_usuario`, `apellido_usuario`, `cedula_usuario`, `password_usuario`, `correo_usuario`, `cargo_usuario`, `departamento_usuario`, `telefono_usuario`, `rol_usuario`, `estado_usuario`, `fecha_registro`) VALUES
('admin', 'Dani', 'Cuervo', '1090', 'admin', 'admin@cisa.com', 'administrador TI', 'TI', '119', 1, 1, '2016-04-07 16:02:22'),
('asis', 'asis_name', 'asis_last', '369', 'asis', 'asis@cisa.com', 'asistente TI', 'TI', '119', 2, 1, '2016-04-07 16:44:59'),
('oper', 'oper_name', 'oper_last', '147', 'oper', 'oper@cisa.com', 'operario TI', 'TI', '119', 0, 1, '2016-04-07 16:45:17'),
('super', 'super_name', 'super_last', '258', 'super', 'super@cisa.com', 'supervisor TI', 'TI', '119', 3, 1, '2016-04-07 16:45:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_formato`
--

CREATE TABLE `usuario_formato` (
  `id_usuario` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `id_formato` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `fecha_accion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `accion` varchar(30) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuario_formato`
--

INSERT INTO `usuario_formato` (`id_usuario`, `id_formato`, `fecha_accion`, `accion`) VALUES
('oper', 'RMO-1100', '2016-04-08 22:54:30', 'asignado'),
('super', 'RMO-1100', '2016-04-08 23:08:52', 'desasignado');

--
-- Disparadores `usuario_formato`
--
DELIMITER $$
CREATE TRIGGER `historial_cambios` AFTER UPDATE ON `usuario_formato` FOR EACH ROW INSERT INTO  `historial_usuario_formato` (`id_usuario`,`id_formato`,`fecha`,`accion`)
VALUES (OLD.id_usuario, OLD.id_formato, OLD.fecha_accion, OLD.accion)
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `formato`
--
ALTER TABLE `formato`
  ADD PRIMARY KEY (`cod_formato`);

--
-- Indices de la tabla `historial_usuario_formato`
--
ALTER TABLE `historial_usuario_formato`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`id_usuario`),
  ADD KEY `formato` (`id_formato`) USING BTREE;

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codigo_usuario`) USING BTREE,
  ADD UNIQUE KEY `cedula_usuario` (`cedula_usuario`),
  ADD KEY `rol_usuario` (`rol_usuario`);

--
-- Indices de la tabla `usuario_formato`
--
ALTER TABLE `usuario_formato`
  ADD PRIMARY KEY (`id_usuario`,`id_formato`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_formato` (`id_formato`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `historial_usuario_formato`
--
ALTER TABLE `historial_usuario_formato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id_tipo` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol_usuario`) REFERENCES `tipo_usuario` (`id_tipo`);

--
-- Filtros para la tabla `usuario_formato`
--
ALTER TABLE `usuario_formato`
  ADD CONSTRAINT `usuario_formato_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`codigo_usuario`),
  ADD CONSTRAINT `usuario_formato_ibfk_2` FOREIGN KEY (`id_formato`) REFERENCES `formato` (`cod_formato`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
