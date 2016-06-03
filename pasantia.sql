-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2016 a las 18:54:11
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
  `cod_formato` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `version` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `procedimiento` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `jefe_procedimiento` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion_contenido` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `frecuencia_uso` int(11) NOT NULL,
  `codigo_html` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `formato`
--

INSERT INTO `formato` (`cod_formato`, `nombre`, `version`, `procedimiento`, `jefe_procedimiento`, `descripcion_contenido`, `frecuencia_uso`, `codigo_html`) VALUES
('RES-1710', 'Orden de producción esmaltes', 'Versión 3', 'Preparación esmaltes', 'Victor González', 'Tabla', 2, '\n        <table id="encabezado" class="ui-sortable-handle">\n            <tbody><tr>\n                <td><h3> Nombre: Orden de producción esmaltes</h3></td>\n                <td><h3> Código: RES-1710 </h3></td>                    \n                <td><img class="img-responsive" src="../util/images/corporativo/logo_ceramica.png" alt="Cerámica Italia"></td>\n            </tr>\n        </tbody></table>\n    <div class="formato form-group ui-state-default ui-sortable-handle" id="element-0"><label>Orden de producción<p class="requerido">*</p></label><input id="orden_de_produccion" name="orden_de_produccion" type="text" length="30" pattern="[a-zA-zñÑáÁéÉíÍóÓúÚüÜ\\s]{1,30}" title="Digite sólo letras" disabled="" required=""></div><div class="formato ui-state-default ui-sortable-handle" id="element-1"><label>Turno</label><br><input type="radio" id="turno-0" name="turno" value="6-2" disabled=""><p>6-2</p> <input type="radio" id="turno-1" name="turno" value="2-10" disabled=""><p>2-10</p><input type="radio" id="turno-2" name="turno" value="10-6" disabled=""><p>10-6</p></div><div class="formato form-group ui-state-default" id="element-2"><label>Fecha<p class="requerido">*</p></label><input id="fecharegistro" name="fecharegistro" type="date" min="2015-05-27" max="2017-05-27" disabled="" required=""></div><div class="formato form-group ui-state-default" id="element-3"><label>Operador<p class="requerido">*</p></label><input id="operador" name="operador" type="text" length="30" pattern="[a-zA-zñÑáÁéÉíÍóÓúÚüÜ\\s]{1,30}" title="Digite sólo letras" disabled="" required=""></div><div class="formato form-group ui-state-default" id="element-4"><label>Producto<p class="requerido">*</p></label><input id="producto" name="producto" type="text" length="30" pattern="[a-zA-zñÑáÁéÉíÍóÓúÚüÜ\\s]{1,30}" title="Digite sólo letras" disabled="" required=""></div><div class="formato  form-group ui-state-default" id="element-5"><label>Altura libre molino</label><input id="altura_libre_molino" name="altura_libre_molino" type="number" length="15" step="any" disabled="" min="0"></div><div class="formato ui-state-default" id="element-6"><label>Revestimiento molino</label><br><input type="radio" id="revestimiento_molino-0" name="revestimiento_molino" value="Bien" disabled=""><p>Bien</p> <input type="radio" id="revestimiento_molino-1" name="revestimiento_molino" value="Mal" disabled=""><p>Mal</p></div><div class="formato ui-state-default" id="element-7"><label>Lavado molino</label><br><input type="radio" id="lavado_molino-0" name="lavado_molino" value="Si" disabled=""><p>Si</p> <input type="radio" id="lavado_molino-1" name="lavado_molino" value="No" disabled=""><p>No</p></div><div class="formato  form-group ui-state-default" id="element-8"><label>Tiempo molienda</label><input id="tiempo_molienda" name="tiempo_molienda" type="number" length="15" step="any" disabled="" min="0"></div><div class="formato form-group ui-state-default" id="element-9"><label>Hora inicio</label><input id="horaregistro" name="horaregistro" type="time" disabled=""></div><div class="formato form-group ui-state-default" id="element-10"><label>Hora parada</label><input id="horaregistro" name="horaregistro" type="time" disabled=""></div><div class="formato ui-state-default" id="element-11"><label>Molino No.</label><br><input type="radio" id="molino_no-0" name="molino_no" value="1" disabled=""><p>1</p> <input type="radio" id="molino_no-1" name="molino_no" value="2" disabled=""><p>2</p><input type="radio" id="molino_no-2" name="molino_no" value="3" disabled=""><p>3</p><input type="radio" id="molino_no-3" name="molino_no" value="4" disabled=""><p>4</p><input type="radio" id="molino_no-4" name="molino_no" value="5" disabled=""><p>5</p><input type="radio" id="molino_no-5" name="molino_no" value="6" disabled=""><p>6</p><input type="radio" id="molino_no-6" name="molino_no" value="7" disabled=""><p>7</p><input type="radio" id="molino_no-7" name="molino_no" value="8" disabled=""><p>8</p><input type="radio" id="molino_no-8" name="molino_no" value="9" disabled=""><p>9</p></div><div class="ui-state-default formato" id="element-12"><label>Título de la tabla</label><table id="tabla"><thead><tr><td class=""><p>Componentes</p></td><td class=""><p>Ref.</p></td><td class=""><p>Kg a cargar</p></td><td class=""><p>Kg. cargados</p></td><td class=""><p>Lote</p></td></tr></thead><tbody><tr><td class=""><p>Aluminia</p></td><td><input id="tabla_0" name="tabla_0" type="text" disabled=""></td><td><input id="tabla_1" name="tabla_1" type="text" disabled=""></td><td><input id="tabla_2" name="tabla_2" type="text" disabled=""></td><td><input id="tabla_3" name="tabla_3" type="text" disabled=""></td></tr><tr><td class=""><p>Corindon</p></td><td><input id="tabla_4" name="tabla_4" type="text" disabled=""></td><td><input id="tabla_5" name="tabla_5" type="text" disabled=""></td><td><input id="tabla_6" name="tabla_6" type="text" disabled=""></td><td><input id="tabla_7" name="tabla_7" type="text" disabled=""></td></tr><tr><td class=""><p>Arcilla arcabuco</p></td><td><input id="tabla_8" name="tabla_8" type="text" disabled=""></td><td><input id="tabla_9" name="tabla_9" type="text" disabled=""></td><td><input id="tabla_10" name="tabla_10" type="text" disabled=""></td><td><input id="tabla_11" name="tabla_11" type="text" disabled=""></td></tr><tr><td class=""><p>Feldespato (piedra roja)</p></td><td><input id="tabla_12" name="tabla_12" type="text" disabled=""></td><td><input id="tabla_13" name="tabla_13" type="text" disabled=""></td><td><input id="tabla_14" name="tabla_14" type="text" disabled=""></td><td><input id="tabla_15" name="tabla_15" type="text" disabled=""></td></tr><tr><td class=""><p>Arena blanca</p></td><td><input id="tabla_16" name="tabla_16" type="text" disabled=""></td><td><input id="tabla_17" name="tabla_17" type="text" disabled=""></td><td><input id="tabla_18" name="tabla_18" type="text" disabled=""></td><td><input id="tabla_19" name="tabla_19" type="text" disabled=""></td></tr><tr><td class=""><p>Oxido de zinc</p></td><td><input id="tabla_20" name="tabla_20" type="text" disabled=""></td><td><input id="tabla_21" name="tabla_21" type="text" disabled=""></td><td><input id="tabla_22" name="tabla_22" type="text" disabled=""></td><td><input id="tabla_23" name="tabla_23" type="text" disabled=""></td></tr><tr><td class=""><p>Ultrox</p></td><td><input id="tabla_24" name="tabla_24" type="text" disabled=""></td><td><input id="tabla_25" name="tabla_25" type="text" disabled=""></td><td><input id="tabla_26" name="tabla_26" type="text" disabled=""></td><td><input id="tabla_27" name="tabla_27" type="text" disabled=""></td></tr><tr><td class=""><p>Frita</p></td><td><input id="tabla_28" name="tabla_28" type="text" disabled=""></td><td><input id="tabla_29" name="tabla_29" type="text" disabled=""></td><td><input id="tabla_30" name="tabla_30" type="text" disabled=""></td><td><input id="tabla_31" name="tabla_31" type="text" disabled=""></td></tr><tr><td class=""><p>Compuesto</p></td><td><input id="tabla_32" name="tabla_32" type="text" disabled=""></td><td><input id="tabla_33" name="tabla_33" type="text" disabled=""></td><td><input id="tabla_34" name="tabla_34" type="text" disabled=""></td><td><input id="tabla_35" name="tabla_35" type="text" disabled=""></td></tr><tr><td class=""><p>Bentonita</p></td><td><input id="tabla_36" name="tabla_36" type="text" disabled=""></td><td><input id="tabla_37" name="tabla_37" type="text" disabled=""></td><td><input id="tabla_38" name="tabla_38" type="text" disabled=""></td><td><input id="tabla_39" name="tabla_39" type="text" disabled=""></td></tr><tr><td class=""><p>Caolin</p></td><td><input id="tabla_40" name="tabla_40" type="text" disabled=""></td><td><input id="tabla_41" name="tabla_41" type="text" disabled=""></td><td><input id="tabla_42" name="tabla_42" type="text" disabled=""></td><td><input id="tabla_43" name="tabla_43" type="text" disabled=""></td></tr><tr><td class=""><p>Frinal</p></td><td><input id="tabla_44" name="tabla_44" type="text" disabled=""></td><td><input id="tabla_45" name="tabla_45" type="text" disabled=""></td><td><input id="tabla_46" name="tabla_46" type="text" disabled=""></td><td><input id="tabla_47" name="tabla_47" type="text" disabled=""></td></tr><tr><td class=""><p>Caliza</p></td><td><input id="tabla_48" name="tabla_48" type="text" disabled=""></td><td><input id="tabla_49" name="tabla_49" type="text" disabled=""></td><td><input id="tabla_50" name="tabla_50" type="text" disabled=""></td><td><input id="tabla_51" name="tabla_51" type="text" disabled=""></td></tr><tr><td class=""><p>Wollastonita</p></td><td><input id="tabla_52" name="tabla_52" type="text" disabled=""></td><td><input id="tabla_53" name="tabla_53" type="text" disabled=""></td><td><input id="tabla_54" name="tabla_54" type="text" disabled=""></td><td><input id="tabla_55" name="tabla_55" type="text" disabled=""></td></tr><tr><td class=""><p>CMC</p></td><td><input id="tabla_56" name="tabla_56" type="text" disabled=""></td><td><input id="tabla_57" name="tabla_57" type="text" disabled=""></td><td><input id="tabla_58" name="tabla_58" type="text" disabled=""></td><td><input id="tabla_59" name="tabla_59" type="text" disabled=""></td></tr><tr><td class=""><p>TPF</p></td><td><input id="tabla_60" name="tabla_60" type="text" disabled=""></td><td><input id="tabla_61" name="tabla_61" type="text" disabled=""></td><td><input id="tabla_62" name="tabla_62" type="text" disabled=""></td><td><input id="tabla_63" name="tabla_63" type="text" disabled=""></td></tr><tr><td class=""><p>Agua</p></td><td><input id="tabla_64" name="tabla_64" type="text" disabled=""></td><td><input id="tabla_65" name="tabla_65" type="text" disabled=""></td><td><input id="tabla_66" name="tabla_66" type="text" disabled=""></td><td><input id="tabla_67" name="tabla_67" type="text" disabled=""></td></tr><tr><td class=""><p>Bolsas de alumina</p></td><td><input id="tabla_68" name="tabla_68" type="text" disabled=""></td><td><input id="tabla_69" name="tabla_69" type="text" disabled=""></td><td><input id="tabla_70" name="tabla_70" type="text" disabled=""></td><td><input id="tabla_71" name="tabla_71" type="text" disabled=""></td></tr><tr><td><input id="tabla_72" name="tabla_72" type="text" disabled=""></td><td><input id="tabla_73" name="tabla_73" type="text" disabled=""></td><td><input id="tabla_74" name="tabla_74" type="text" disabled=""></td><td><input id="tabla_75" name="tabla_75" type="text" disabled=""></td><td><input id="tabla_76" name="tabla_76" type="text" disabled=""></td></tr><tr><td><input id="tabla_77" name="tabla_77" type="text" disabled=""></td><td><input id="tabla_78" name="tabla_78" type="text" disabled=""></td><td><input id="tabla_79" name="tabla_79" type="text" disabled=""></td><td><input id="tabla_80" name="tabla_80" type="text" disabled=""></td><td><input id="tabla_81" name="tabla_81" type="text" disabled=""></td></tr></tbody></table></div><div class="formato ui-state-default" id="element-13"><label>Observaciones</label><textarea id="observaciones" name="observaciones" type="text" disabled="" style="margin: 0px; width: 161px; height: 53px;"></textarea></div><div class="formato ui-state-default" style="width:100%;" id="element-14"><label>Datos de ajuste</label></div><div class="formato form-group ui-state-default" id="element-15"><label>Fecha</label><input id="fecharegistro" name="fecharegistro" type="date" min="2015-05-27" max="2017-05-27" disabled=""></div><div class="formato form-group ui-state-default" id="element-16"><label>Operador ajuste</label><input id="operador_ajuste" name="operador_ajuste" type="text" length="30" pattern="[a-zA-zñÑáÁéÉíÍóÓúÚüÜ\\s]{1,30}" title="Digite sólo letras" disabled=""></div><div class="formato ui-state-default" id="element-17"><label>Turno ajuste</label><br><input type="radio" id="turno_ajuste-0" name="turno_ajuste" value="6-2" disabled=""><p>6-2</p> <input type="radio" id="turno_ajuste-1" name="turno_ajuste" value="2-10" disabled=""><p>2-10</p><input type="radio" id="turno_ajuste-2" name="turno_ajuste" value="10-6" disabled=""><p>10-6</p></div><div class="formato form-group ui-state-default" id="element-18"><label>Quien toma condiciones</label><input id="quien_toma_condiciones" name="quien_toma_condiciones" type="text" length="30" pattern="[a-zA-zñÑáÁéÉíÍóÓúÚüÜ\\s]{1,30}" title="Digite sólo letras" disabled=""></div><div class="formato form-group ui-state-default" id="element-19"><label>Hora ajuste</label><input id="horaregistro" name="horaregistro" type="time" disabled=""></div><div class="ui-state-default formato" id="element-20"><label>Condiciones de ajuste</label><table id="condiciones_de_ajuste"><thead><tr><td class=""><p>Parámetros</p></td><td class=""><p>Objetivo</p></td><td class=""><p>Quedó</p></td></tr></thead><tbody><tr><td class=""><p>Densidad (gr/100 c.c.)</p></td><td><input id="condiciones_de_ajuste_0" name="condiciones_de_ajuste_0" type="text" disabled=""></td><td><input id="condiciones_de_ajuste_1" name="condiciones_de_ajuste_1" type="text" disabled=""></td></tr><tr><td class=""><p>Viscocidad (seg)</p></td><td><input id="condiciones_de_ajuste_2" name="condiciones_de_ajuste_2" type="text" disabled=""></td><td><input id="condiciones_de_ajuste_3" name="condiciones_de_ajuste_3" type="text" disabled=""></td></tr><tr><td class=""><p>Residuo (malla 325)</p></td><td><input id="condiciones_de_ajuste_4" name="condiciones_de_ajuste_4" type="text" disabled=""></td><td><input id="condiciones_de_ajuste_5" name="condiciones_de_ajuste_5" type="text" disabled=""></td></tr></tbody></table></div><div class="ui-state-default formato" id="element-21"><label>Aditivos del ajuste</label><table id="aditivos_del_ajuste"><thead><tr><td class=""><p>Componente</p></td><td class=""><p>Total</p></td></tr></thead><tbody><tr><td class=""><p>C.M.C. (Kg)</p></td><td><input id="aditivos_del_ajuste_0" name="aditivos_del_ajuste_0" type="text" disabled=""></td></tr><tr><td class=""><p>T.P.F. (Kg)</p></td><td><input id="aditivos_del_ajuste_1" name="aditivos_del_ajuste_1" type="text" disabled=""></td></tr><tr><td class=""><p>Bentonita (kg)</p></td><td><input id="aditivos_del_ajuste_2" name="aditivos_del_ajuste_2" type="text" disabled=""></td></tr><tr><td class=""><p>Agua (lt)</p></td><td><input id="aditivos_del_ajuste_3" name="aditivos_del_ajuste_3" type="text" disabled=""></td></tr><tr><td class=""><p>Molienda (min)</p></td><td><input id="aditivos_del_ajuste_4" name="aditivos_del_ajuste_4" type="text" disabled=""></td></tr><tr><td><input id="aditivos_del_ajuste_5" name="aditivos_del_ajuste_5" type="text" disabled=""></td><td><input id="aditivos_del_ajuste_6" name="aditivos_del_ajuste_6" type="text" disabled=""></td></tr></tbody></table></div><div class="formato ui-state-default" id="element-22"><label>Observaciones</label><textarea id="observaciones" name="observaciones" type="text" disabled="" style="margin: 0px; height: 75px; width: 300px;"></textarea></div><div class="formato ui-state-default isSelected" style="width: 100%;" id="element-23"><label>Naturaleza del cambio. Actualizar documentos SGC 00.940.056</label></div>'),
('RMO-1100', 'Cargue de materia prima', 'Versión 8', 'Preparación pasta', 'Fabián Ríos', 'Tabla', 2, '\n        <table id="encabezado" class="ui-sortable-handle">\n            <tbody><tr>\n                <td><h3> Nombre: Cargue de materia prima</h3></td>\n                <td><h3> Código: RMO-1100 </h3></td>                    \n                <td><img class="img-responsive" src="../util/images/corporativo/logo_ceramica.png" alt="Cerámica Italia"></td>\n            </tr>\n        </tbody></table>\n    <div class="formato form-group ui-state-default ui-sortable-handle" id="element-0"><label>Fecha</label><input id="fecharegistro" name="fecharegistro" type="date" min="2015-05-26" max="2017-05-26" disabled=""></div><div class="formato ui-state-default ui-sortable-handle" id="element-1"><label>Tipo de cargue</label><br><input type="radio" id="tipo_de_cargue-0" name="tipo_de_cargue" value="Gres" disabled=""><p>Gres</p> <input type="radio" id="tipo_de_cargue-1" name="tipo_de_cargue" value="Ensayo" disabled=""><p>Ensayo</p></div><div class="formato ui-state-default ui-sortable-handle" id="element-2"><label>Turno</label><br><input type="radio" id="turno-0" name="turno" value="6-2" disabled=""><p>6-2</p> <input type="radio" id="turno-1" name="turno" value="2-10" disabled=""><p>2-10</p><input type="radio" id="turno-2" name="turno" value="10-6" disabled=""><p>10-6</p></div><div class="formato form-group ui-state-default ui-sortable-handle" id="element-3"><label>Operario</label><input id="operario" name="operario" type="text" length="30" pattern="[a-zA-zñÑáÁéÉíÍóÓúÚ \\s]{1,30}" title="Digite sólo letras" disabled=""></div><div class="formato  form-group ui-state-default ui-sortable-handle" id="element-4"><label>No. Cargue</label><input id="no_cargue" name="no_cargue" type="number" length="15" step="any" disabled=""></div><div class="formato  form-group ui-state-default ui-sortable-handle" id="element-5"><label>Tolva No.</label><input id="tolva_no" name="tolva_no" type="number" length="15" step="any" disabled=""></div><div class="formato ui-state-default ui-sortable-handle" style="width:100%;" id="element-6"><label></label></div><div class="ui-state-default formato isSelected ui-sortable-handle" id="element-7"><label>Materiales</label><table id="materiales"><thead><tr><td class=""><p>Materia Prima</p></td><td class=""><p>%</p></td><td class=""><p>Cantidad a cargar</p></td><td class=""><p>Cantidad de cargue</p></td><td class=""><p>Lote aprobado</p></td></tr></thead><tbody><tr><td><input id="materiales_0" name="materiales_0" type="text" length="30" disabled=""></td><td><input id="materiales_1" name="materiales_1" type="text" disabled=""></td><td><input id="materiales_2" name="materiales_2" type="text" disabled=""></td><td><input id="materiales_3" name="materiales_3" type="text" disabled=""></td><td><input id="materiales_4" name="materiales_4" type="text" disabled=""></td></tr><tr><td><input id="materiales_5" name="materiales_5" type="text" disabled=""></td><td><input id="materiales_6" name="materiales_6" type="text" disabled=""></td><td><input id="materiales_7" name="materiales_7" type="text" disabled=""></td><td><input id="materiales_8" name="materiales_8" type="text" disabled=""></td><td><input id="materiales_9" name="materiales_9" type="text" disabled=""></td></tr><tr><td><input id="materiales_10" name="materiales_10" type="text" disabled=""></td><td><input id="materiales_11" name="materiales_11" type="text" disabled=""></td><td><input id="materiales_12" name="materiales_12" type="text" disabled=""></td><td><input id="materiales_13" name="materiales_13" type="text" disabled=""></td><td><input id="materiales_14" name="materiales_14" type="text" disabled=""></td></tr><tr><td><input id="materiales_15" name="materiales_15" type="text" disabled=""></td><td><input id="materiales_16" name="materiales_16" type="text" disabled=""></td><td><input id="materiales_17" name="materiales_17" type="text" disabled=""></td><td><input id="materiales_18" name="materiales_18" type="text" disabled=""></td><td><input id="materiales_19" name="materiales_19" type="text" disabled=""></td></tr></tbody></table></div><div class="formato ui-state-default ui-sortable-handle" id="element-8"><label>Observaciones</label><textarea id="observaciones" name="observaciones" type="text" disabled="" style="margin: 0px; width: 708px; height: 60px;"></textarea></div><div class="formato form-group ui-state-default ui-sortable-handle" id="element-9"><label>Consecutivo</label><input id="consecutivo" name="consecutivo" type="text" length="30" pattern="[a-zA-zñÑáÁéÉíÍóÓúÚ \\s]{1,30}" title="Digite sólo letras" disabled=""></div><div class="formato ui-state-default ui-sortable-handle" style="width: 100%;" id="element-10"><label>Versión 8. Naturaleza del cambio 00.718.784</label></div>\n\n\n\n'),
('Test', 'prueba', 'Versión 4', 'prueba', 'prueba', 'todo', 2, '\n        <table id="encabezado" class="ui-sortable-handle">\n            <tbody><tr>\n                <td><h3> Nombre: prueba</h3></td>\n                <td><h3> Código: Test </h3></td>                    \n                <td><img class="img-responsive" src="../util/images/corporativo/logo_ceramica.png" alt="Cerámica Italia"></td>\n            </tr>\n        </tbody></table>\n    <div class="formato form-group ui-state-default ui-sortable-handle" id="element-0"><label>Fecha<p class="requerido">*</p></label><input id="fecharegistro" name="fecharegistro" type="date" min="2015-05-24" max="2017-05-24" disabled="" required=""></div><div class="formato form-group ui-state-default ui-sortable-handle" id="element-1"><label>Nombre<p class="requerido">*</p></label><input id="nombre" name="nombre" type="text" length="30" pattern="[a-zA-zñÑáÁéÉíÍóÓúÚ \\s]{1,30}" title="Digite sólo letras" disabled="" required=""></div><div class="formato  form-group ui-state-default ui-sortable-handle" id="element-2"><label>Edad<p class="requerido">*</p></label><input id="edad" name="edad" type="number" length="15" step="any" disabled="" value="0" required=""></div><div class="formato ui-state-default ui-sortable-handle" id="element-3"><label>Bienes</label> <br id="bienes" name="bienes"><input id="bienes-0" type="checkbox" name="bienes-0" value="Casa" disabled=""><p>Casa</p><input id="bienes-1" type="checkbox" name="bienes-1" value="Carro" disabled=""><p>Carro</p><input id="bienes-2" type="checkbox" name="bienes-2" value="Moto" disabled=""><p>Moto</p><input id="bienes-3" type="checkbox" name="bienes-3" value="Estudio" disabled=""><p>Estudio</p></div><div class="formato ui-state-default ui-sortable-handle isSelected" id="element-4"><label>Estado civil</label><br id="estado_civil" name="estado_civil"><input type="radio" id="estado_civil-0" name="estado_civil" value="Soltero" disabled=""><p>Soltero</p> <input type="radio" id="estado_civil-1" name="estado_civil" value="Casado" disabled=""><p>Casado</p></div><div class="formato ui-state-default ui-sortable-handle" id="element-8"><label>Lista</label><select id="lista" name="lista"><option value="Opc 1" selected="">Opc 1</option><option value="Opc 2">Opc 2</option><option value="Opc 3">Opc 3</option></select></div><div class="ui-state-default formato ui-sortable-handle" id="element-5"><label>Materias</label><table id="materias" name="materias"><thead><tr><td class=""><p>Materias</p></td><td class=""><p>Primer previo</p></td><td class=""><p>Segundo previo</p></td><td class=""><p>Tercer previo</p></td><td class=""><p>Examen</p></td></tr></thead><tbody><tr><td class=""><p>Programación</p></td><td class=""><input id="materias_0" name="materias_0" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_1" name="materias_1" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_2" name="materias_2" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_3" name="materias_3" type="number" disabled="" step="any" max="5" min="0"></td></tr><tr><td class=""><p>Redes</p></td><td class=""><input id="materias_4" name="materias_4" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_5" name="materias_5" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_6" name="materias_6" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_7" name="materias_7" type="number" disabled="" step="any" max="5" min="0"></td></tr><tr><td class=""><p>Software</p></td><td class=""><input id="materias_8" name="materias_8" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_9" name="materias_9" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_10" name="materias_10" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_11" name="materias_11" type="number" disabled="" step="any" max="5" min="0"></td></tr></tbody></table></div><div class="formato ui-state-default ui-sortable-handle" style="width:100%;" id="element-6"><label></label></div><div class="formato ui-state-default ui-sortable-handle" id="element-7"><label>Observaciones</label><textarea id="observaciones" name="observaciones" type="text" disabled="" style="margin: 0px; width: 387px; height: 54px;"></textarea></div>\n\n\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `frecuencia_formato`
--

CREATE TABLE `frecuencia_formato` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `dias_modificacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `frecuencia_formato`
--

INSERT INTO `frecuencia_formato` (`id`, `descripcion`, `dias_modificacion`) VALUES
(1, 'hora', 1),
(2, 'turno', 1),
(3, 'turno administración', 2),
(4, 'diario', 2),
(5, 'semanal', 8),
(6, 'ocasional', 8),
(7, 'libre', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_usuario_formato`
--

CREATE TABLE `historial_usuario_formato` (
  `id` int(11) NOT NULL,
  `id_usuario` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_formato` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `accion` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `historial_usuario_formato`
--

INSERT INTO `historial_usuario_formato` (`id`, `id_usuario`, `id_formato`, `fecha`, `accion`) VALUES
(26, 'super', 'RMO-1100', '2016-05-12 14:43:06', 'desasignado'),
(27, 'super', 'Test', '2016-05-24 16:49:41', 'asignado'),
(28, 'super', 'Test', '2016-05-25 14:50:42', 'desasignado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `info_res-1710`
--

CREATE TABLE `info_res-1710` (
  `id` int(11) NOT NULL,
  `fecha_registro_sistema` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_formato_diligenciado` date NOT NULL,
  `usuario` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `informacion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `observaciones` text CHARACTER SET utf8 COLLATE utf8_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `info_rmo-1100`
--

CREATE TABLE `info_rmo-1100` (
  `id` int(11) NOT NULL,
  `fecha_registro_sistema` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_formato_diligenciado` date NOT NULL,
  `usuario` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `informacion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `observaciones` text CHARACTER SET utf8 COLLATE utf8_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `info_rmo-1100`
--

INSERT INTO `info_rmo-1100` (`id`, `fecha_registro_sistema`, `fecha_formato_diligenciado`, `usuario`, `estado`, `informacion`, `observaciones`) VALUES
(2, '2016-05-26 16:32:41', '2016-05-26', 'super', 1, 'fecharegistro=2016-05-26&tipo_de_cargue=Gres&turno=6-2&operario=William&materiales_0=Arena&materiales_1=200&materiales_2=465&materiales_3=500+20&materiales_4=525&', ' El registro ha sido mofificado por el usuario super');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `info_test`
--

CREATE TABLE `info_test` (
  `id` int(11) NOT NULL,
  `fecha_registro_sistema` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_formato_diligenciado` date NOT NULL,
  `usuario` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `informacion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `observaciones` text CHARACTER SET utf8 COLLATE utf8_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `info_test`
--

INSERT INTO `info_test` (`id`, `fecha_registro_sistema`, `fecha_formato_diligenciado`, `usuario`, `estado`, `informacion`, `observaciones`) VALUES
(6, '2016-05-25 16:23:32', '2016-05-25', 'super', 1, 'fecharegistro=2016-05-25&nombre=Daniel&edad=23&bienes-0=Casa&bienes-1=Carro&estado_civil=Casado&lista=Opc 1&materias_0=0.2&materias_1=5.0&materias_2=0.4&materias_3=4.1&', ' El registro ha sido mofificado por el usuario super'),
(7, '2016-05-25 16:27:06', '2016-05-25', 'super', 1, 'fecharegistro=2016-05-25&nombre=Daniel&edad=23&bienes-2=Moto&bienes-3=Estudio&estado_civil=Casado&lista=Opc 1&materias_0=0.2&materias_1=5.0&materias_2=0.4&materias_3=4.1&materias_4=3.5&materias_5=4.5&materias_6=2.3&materias_7=4.2&', ' El registro ha sido mofificado por el usuario super'),
(8, '2016-05-25 16:35:50', '2016-05-25', 'super', 1, 'fecharegistro=2016-05-25&nombre=Daniel; funciona . aja% eso tambien&edad=26&bienes-0=Casa&bienes-2=Moto&estado_civil=Soltero&lista=Opc 1&materias_0=1.2&materias_1=3.2&materias_2=2.2&materias_3=5.0&observaciones=Esto es una prueba de punto y coma; si funciona despues sigue el procentaje % si funciona creo que ya funciona XD.&', 'Esto es una prueba de punto y coma; si funciona despues sigue el procentaje % si funciona creo que ya funciona XD. El registro ha sido mofificado por el usuario super'),
(9, '2016-05-26 20:52:02', '2016-05-26', 'super', 1, 'fecharegistro=2016-05-26&nombre=Daniel%funciona&edad=23&bienes-0=Casa&bienes-1=Carro&bienes-2=Moto&bienes-3=Estudio&estado_civil=Soltero&lista=Opc 2&materias_0=1&materias_1=1&materias_2=1&materias_3=1&materias_4=1&materias_5=1&materias_6=1&materias_7=1&materias_8=1&materias_9=1&materias_10=1&materias_11=1&observaciones=Funciona&', 'Funciona El registro ha sido mofificado por el usuario super');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modificaciones_formato`
--

CREATE TABLE `modificaciones_formato` (
  `fecha_modificacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_formato` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `detalle_modificacion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `version_formato` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `html` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `modificaciones_formato`
--

INSERT INTO `modificaciones_formato` (`fecha_modificacion`, `id_usuario`, `id_formato`, `detalle_modificacion`, `version_formato`, `html`) VALUES
('2016-05-24 16:46:26', 'asis', 'Test', 'Primera modificación de prueba.', 'Versión 2', '\n        <table id="encabezado" class="ui-sortable-handle">\n            <tbody><tr>\n                <td><h3> Nombre: prueba</h3></td>\n                <td><h3> Código: Test </h3></td>                    \n                <td><img class="img-responsive" src="../util/images/corporativo/logo_ceramica.png" alt="Cerámica Italia"></td>\n            </tr>\n        </tbody></table>\n    <div class="formato form-group ui-state-default" id="element-0"><label>Fecha<p class="requerido">*</p></label><input id="fecharegistro" name="fecharegistro" type="date" min="2015-05-24" max="2017-05-24" disabled="" required=""></div><div class="formato form-group ui-state-default" id="element-1"><label>Nombre<p class="requerido">*</p></label><input id="nombre" name="nombre" type="text" length="30" pattern="[a-zA-zñÑáÁéÉíÍóÓúÚ \\s]{1,30}" title="Digite sólo letras" disabled="" required=""></div><div class="formato  form-group ui-state-default" id="element-2"><label>Edad<p class="requerido">*</p></label><input id="edad" name="edad" type="number" length="15" step="any" disabled="" value="0" required=""></div><div class="formato ui-state-default" id="element-3"><label>Título de casillas de verificación</label> <br><input id="Untitled-0" type="checkbox" name="Untitled-0" value="Casa" disabled=""><p>Casa</p><input id="Untitled-1" type="checkbox" name="Untitled-1" value="Carro" disabled=""><p>Carro</p><input id="Untitled-2" type="checkbox" name="Untitled-2" value="Moto" disabled=""><p>Moto</p><input id="Untitled-3" type="checkbox" name="Untitled-3" value="Estudio" disabled=""><p>Estudio</p></div><div class="formato ui-state-default" id="element-4"><label>Título de opciones</label><br><input type="radio" id="Untitled-0" name="radio" value="Soltero" disabled=""><p>Soltero</p> <input type="radio" id="Untitled-1" name="radio" value="Casado" disabled=""><p>Casado</p></div><div class="ui-state-default formato" id="element-5"><label>Materias</label><table id="materias" name="materias"><thead><tr><td class=""><p>Materias</p></td><td class=""><p>Primer previo</p></td><td class=""><p>Segundo previo</p></td><td class=""><p>Tercer previo</p></td><td class=""><p>Examen</p></td></tr></thead><tbody><tr><td class=""><p>Programación</p></td><td class=""><input id="materias_0" name="materias_0" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_1" name="materias_1" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_2" name="materias_2" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_3" name="materias_3" type="number" disabled="" step="any" max="5" min="0"></td></tr><tr><td class=""><p>Redes</p></td><td class=""><input id="materias_4" name="materias_4" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_5" name="materias_5" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_6" name="materias_6" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_7" name="materias_7" type="number" disabled="" step="any" max="5" min="0"></td></tr><tr><td class=""><p>Software</p></td><td class=""><input id="materias_8" name="materias_8" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_9" name="materias_9" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_10" name="materias_10" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_11" name="materias_11" type="number" disabled="" step="any" max="5" min="0"></td></tr></tbody></table></div><div class="formato ui-state-default" style="width:100%;" id="element-6"><label></label></div><div class="formato ui-state-default isSelected" id="element-8"><label>Observaciones</label><textarea id="observaciones" name="observaciones" type="text" disabled="" style="margin: 0px; width: 387px; height: 54px;"></textarea></div>\n'),
('2016-05-24 16:48:30', 'asis', 'Test', 'Modificación formato de prueba', 'Versión 3', '\n        <table id="encabezado" class="ui-sortable-handle">\n            <tbody><tr>\n                <td><h3> Nombre: prueba</h3></td>\n                <td><h3> Código: Test </h3></td>                    \n                <td><img class="img-responsive" src="../util/images/corporativo/logo_ceramica.png" alt="Cerámica Italia"></td>\n            </tr>\n        </tbody></table>\n    <div class="formato form-group ui-state-default ui-sortable-handle" id="element-0"><label>Fecha<p class="requerido">*</p></label><input id="fecharegistro" name="fecharegistro" type="date" min="2015-05-24" max="2017-05-24" disabled="" required=""></div><div class="formato form-group ui-state-default ui-sortable-handle" id="element-1"><label>Nombre<p class="requerido">*</p></label><input id="nombre" name="nombre" type="text" length="30" pattern="[a-zA-zñÑáÁéÉíÍóÓúÚ \\s]{1,30}" title="Digite sólo letras" disabled="" required=""></div><div class="formato  form-group ui-state-default ui-sortable-handle" id="element-2"><label>Edad<p class="requerido">*</p></label><input id="edad" name="edad" type="number" length="15" step="any" disabled="" value="0" required=""></div><div class="formato ui-state-default ui-sortable-handle isSelected" id="element-3"><label>Bienes</label> <br id="bienes" name="bienes"><input id="Untitled-0" type="checkbox" name="Untitled-0" value="Casa" disabled=""><p>Casa</p><input id="Untitled-1" type="checkbox" name="Untitled-1" value="Carro" disabled=""><p>Carro</p><input id="Untitled-2" type="checkbox" name="Untitled-2" value="Moto" disabled=""><p>Moto</p><input id="Untitled-3" type="checkbox" name="Untitled-3" value="Estudio" disabled=""><p>Estudio</p></div><div class="formato ui-state-default ui-sortable-handle" id="element-4"><label>Estado civil</label><br id="estado_civil" name="estado_civil"><input type="radio" id="Untitled-0" name="radio" value="Soltero" disabled=""><p>Soltero</p> <input type="radio" id="Untitled-1" name="radio" value="Casado" disabled=""><p>Casado</p></div><div class="ui-state-default formato ui-sortable-handle" id="element-5"><label>Materias</label><table id="materias" name="materias"><thead><tr><td class=""><p>Materias</p></td><td class=""><p>Primer previo</p></td><td class=""><p>Segundo previo</p></td><td class=""><p>Tercer previo</p></td><td class=""><p>Examen</p></td></tr></thead><tbody><tr><td class=""><p>Programación</p></td><td class=""><input id="materias_0" name="materias_0" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_1" name="materias_1" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_2" name="materias_2" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_3" name="materias_3" type="number" disabled="" step="any" max="5" min="0"></td></tr><tr><td class=""><p>Redes</p></td><td class=""><input id="materias_4" name="materias_4" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_5" name="materias_5" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_6" name="materias_6" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_7" name="materias_7" type="number" disabled="" step="any" max="5" min="0"></td></tr><tr><td class=""><p>Software</p></td><td class=""><input id="materias_8" name="materias_8" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_9" name="materias_9" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_10" name="materias_10" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_11" name="materias_11" type="number" disabled="" step="any" max="5" min="0"></td></tr></tbody></table></div><div class="formato ui-state-default ui-sortable-handle" style="width:100%;" id="element-6"><label></label></div><div class="formato ui-state-default ui-sortable-handle" id="element-8"><label>Observaciones</label><textarea id="observaciones" name="observaciones" type="text" disabled="" style="margin: 0px; width: 387px; height: 54px;"></textarea></div>\n\n'),
('2016-05-26 19:10:09', 'asis', 'RMO-1100', 'Naturaleza del cambio 00.718.784', 'Versión 6', '\n        <table id="encabezado" class="ui-sortable-handle">\n            <tbody><tr>\n                <td><h3> Nombre: Cargue de materia prima</h3></td>\n                <td><h3> Código: RMO-1100 </h3></td>                    \n                <td><img class="img-responsive" src="../util/images/corporativo/logo_ceramica.png" alt="Cerámica Italia"></td>\n            </tr>\n        </tbody></table>\n    <div class="formato form-group ui-state-default ui-sortable-handle" id="element-0"><label>Fecha</label><input id="fecharegistro" name="fecharegistro" type="date" min="2015-05-26" max="2017-05-26" disabled=""></div><div class="formato ui-state-default ui-sortable-handle" id="element-1"><label>Tipo de cargue</label><br><input type="radio" id="tipo_de_cargue-0" name="tipo_de_cargue" value="Gres" disabled=""><p>Gres</p> <input type="radio" id="tipo_de_cargue-1" name="tipo_de_cargue" value="Ensayo" disabled=""><p>Ensayo</p></div><div class="formato ui-state-default ui-sortable-handle" id="element-2"><label>Turno</label><br><input type="radio" id="turno-0" name="turno" value="6-2" disabled=""><p>6-2</p> <input type="radio" id="turno-1" name="turno" value="2-10" disabled=""><p>2-10</p><input type="radio" id="turno-2" name="turno" value="10-6" disabled=""><p>10-6</p></div><div class="formato form-group ui-state-default ui-sortable-handle" id="element-3"><label>Operario</label><input id="operario" name="operario" type="text" length="30" pattern="[a-zA-zñÑáÁéÉíÍóÓúÚ \\s]{1,30}" title="Digite sólo letras" disabled=""></div><div class="formato  form-group ui-state-default ui-sortable-handle" id="element-4"><label>No. Cargue</label><input id="no_cargue" name="no_cargue" type="number" length="15" step="any" disabled=""></div><div class="formato  form-group ui-state-default ui-sortable-handle" id="element-5"><label>Tolva No.</label><input id="tolva_no" name="tolva_no" type="number" length="15" step="any" disabled=""></div><div class="formato ui-state-default ui-sortable-handle" style="width:100%;" id="element-6"><label></label></div><div class="ui-state-default formato isSelected ui-sortable-handle" id="element-7"><label>Materiales</label><table id="materiales"><thead><tr><td class=""><p>Materia Prima</p></td><td class=""><p>%</p></td><td class=""><p>Cantidad a cargar</p></td><td class=""><p>Cantidad de cargue</p></td><td class=""><p>Lote aprobado</p></td></tr></thead><tbody><tr><td><input id="materiales_0" name="materiales_0" type="text" length="30" disabled=""></td><td><input id="materiales_1" name="materiales_1" type="text" disabled=""></td><td><input id="materiales_2" name="materiales_2" type="text" disabled=""></td><td><input id="materiales_3" name="materiales_3" type="text" disabled=""></td><td><input id="materiales_4" name="materiales_4" type="text" disabled=""></td></tr><tr><td><input id="materiales_5" name="materiales_5" type="text" disabled=""></td><td><input id="materiales_6" name="materiales_6" type="text" disabled=""></td><td><input id="materiales_7" name="materiales_7" type="text" disabled=""></td><td><input id="materiales_8" name="materiales_8" type="text" disabled=""></td><td><input id="materiales_9" name="materiales_9" type="text" disabled=""></td></tr><tr><td><input id="materiales_10" name="materiales_10" type="text" disabled=""></td><td><input id="materiales_11" name="materiales_11" type="text" disabled=""></td><td><input id="materiales_12" name="materiales_12" type="text" disabled=""></td><td><input id="materiales_13" name="materiales_13" type="text" disabled=""></td><td><input id="materiales_14" name="materiales_14" type="text" disabled=""></td></tr><tr><td><input id="materiales_15" name="materiales_15" type="text" disabled=""></td><td><input id="materiales_16" name="materiales_16" type="text" disabled=""></td><td><input id="materiales_17" name="materiales_17" type="text" disabled=""></td><td><input id="materiales_18" name="materiales_18" type="text" disabled=""></td><td><input id="materiales_19" name="materiales_19" type="text" disabled=""></td></tr></tbody></table></div><div class="formato ui-state-default ui-sortable-handle" id="element-8"><label>Observaciones</label><textarea id="observaciones" name="observaciones" type="text" disabled="" style="margin: 0px; width: 708px; height: 60px;"></textarea></div><div class="formato form-group ui-state-default ui-sortable-handle" id="element-9"><label>Consecutivo</label><input id="consecutivo" name="consecutivo" type="text" length="30" pattern="[a-zA-zñÑáÁéÉíÍóÓúÚ \\s]{1,30}" title="Digite sólo letras" disabled=""></div><div class="formato ui-state-default ui-sortable-handle" style="width: 100%;" id="element-10"><label>Versión 8. Naturaleza del cambio 00.718.784</label></div>\n\n'),
('2016-05-26 19:52:10', 'asis', 'RMO-1100', 'Naturaleza del cambio 00.718.784', 'Versión 7', '\n        <table id="encabezado" class="ui-sortable-handle">\n            <tbody><tr>\n                <td><h3> Nombre: Cargue de materia prima</h3></td>\n                <td><h3> Código: RMO-1100 </h3></td>                    \n                <td><img class="img-responsive" src="../util/images/corporativo/logo_ceramica.png" alt="Cerámica Italia"></td>\n            </tr>\n        </tbody></table>\n    <div class="formato form-group ui-state-default ui-sortable-handle" id="element-0"><label>Fecha</label><input id="fecharegistro" name="fecharegistro" type="date" min="2015-05-26" max="2017-05-26" disabled=""></div><div class="formato ui-state-default ui-sortable-handle" id="element-1"><label>Tipo de cargue</label><br><input type="radio" id="tipo_de_cargue-0" name="tipo_de_cargue" value="Gres" disabled=""><p>Gres</p> <input type="radio" id="tipo_de_cargue-1" name="tipo_de_cargue" value="Ensayo" disabled=""><p>Ensayo</p></div><div class="formato ui-state-default ui-sortable-handle" id="element-2"><label>Turno</label><br><input type="radio" id="turno-0" name="turno" value="6-2" disabled=""><p>6-2</p> <input type="radio" id="turno-1" name="turno" value="2-10" disabled=""><p>2-10</p><input type="radio" id="turno-2" name="turno" value="10-6" disabled=""><p>10-6</p></div><div class="formato form-group ui-state-default ui-sortable-handle" id="element-3"><label>Operario</label><input id="operario" name="operario" type="text" length="30" pattern="[a-zA-zñÑáÁéÉíÍóÓúÚ \\s]{1,30}" title="Digite sólo letras" disabled=""></div><div class="formato  form-group ui-state-default ui-sortable-handle" id="element-4"><label>No. Cargue</label><input id="no_cargue" name="no_cargue" type="number" length="15" step="any" disabled=""></div><div class="formato  form-group ui-state-default ui-sortable-handle" id="element-5"><label>Tolva No.</label><input id="tolva_no" name="tolva_no" type="number" length="15" step="any" disabled=""></div><div class="formato ui-state-default ui-sortable-handle" style="width:100%;" id="element-6"><label></label></div><div class="ui-state-default formato isSelected ui-sortable-handle" id="element-7"><label>Materiales</label><table id="materiales"><thead><tr><td class=""><p>Materia Prima</p></td><td class=""><p>%</p></td><td class=""><p>Cantidad a cargar</p></td><td class=""><p>Cantidad de cargue</p></td><td class=""><p>Lote aprobado</p></td></tr></thead><tbody><tr><td><input id="materiales_0" name="materiales_0" type="text" length="30" disabled=""></td><td><input id="materiales_1" name="materiales_1" type="text" disabled=""></td><td><input id="materiales_2" name="materiales_2" type="text" disabled=""></td><td><input id="materiales_3" name="materiales_3" type="text" disabled=""></td><td><input id="materiales_4" name="materiales_4" type="text" disabled=""></td></tr><tr><td><input id="materiales_5" name="materiales_5" type="text" disabled=""></td><td><input id="materiales_6" name="materiales_6" type="text" disabled=""></td><td><input id="materiales_7" name="materiales_7" type="text" disabled=""></td><td><input id="materiales_8" name="materiales_8" type="text" disabled=""></td><td><input id="materiales_9" name="materiales_9" type="text" disabled=""></td></tr><tr><td><input id="materiales_10" name="materiales_10" type="text" disabled=""></td><td><input id="materiales_11" name="materiales_11" type="text" disabled=""></td><td><input id="materiales_12" name="materiales_12" type="text" disabled=""></td><td><input id="materiales_13" name="materiales_13" type="text" disabled=""></td><td><input id="materiales_14" name="materiales_14" type="text" disabled=""></td></tr><tr><td><input id="materiales_15" name="materiales_15" type="text" disabled=""></td><td><input id="materiales_16" name="materiales_16" type="text" disabled=""></td><td><input id="materiales_17" name="materiales_17" type="text" disabled=""></td><td><input id="materiales_18" name="materiales_18" type="text" disabled=""></td><td><input id="materiales_19" name="materiales_19" type="text" disabled=""></td></tr></tbody></table></div><div class="formato ui-state-default ui-sortable-handle" id="element-8"><label>Observaciones</label><textarea id="observaciones" name="observaciones" type="text" disabled="" style="margin: 0px; width: 708px; height: 60px;"></textarea></div><div class="formato form-group ui-state-default ui-sortable-handle" id="element-9"><label>Consecutivo</label><input id="consecutivo" name="consecutivo" type="text" length="30" pattern="[a-zA-zñÑáÁéÉíÍóÓúÚ \\s]{1,30}" title="Digite sólo letras" disabled=""></div><div class="formato ui-state-default ui-sortable-handle" style="width: 100%;" id="element-10"><label>Versión 8. Naturaleza del cambio 00.718.784</label></div>\n\n\n\n'),
('2016-05-26 20:33:25', 'asis', 'Test', 'Inclusión de una lista', 'Versión 4', '\n        <table id="encabezado" class="ui-sortable-handle">\n            <tbody><tr>\n                <td><h3> Nombre: prueba</h3></td>\n                <td><h3> Código: Test </h3></td>                    \n                <td><img class="img-responsive" src="../util/images/corporativo/logo_ceramica.png" alt="Cerámica Italia"></td>\n            </tr>\n        </tbody></table>\n    <div class="formato form-group ui-state-default ui-sortable-handle" id="element-0"><label>Fecha<p class="requerido">*</p></label><input id="fecharegistro" name="fecharegistro" type="date" min="2015-05-24" max="2017-05-24" disabled="" required=""></div><div class="formato form-group ui-state-default ui-sortable-handle" id="element-1"><label>Nombre<p class="requerido">*</p></label><input id="nombre" name="nombre" type="text" length="30" pattern="[a-zA-zñÑáÁéÉíÍóÓúÚ \\s]{1,30}" title="Digite sólo letras" disabled="" required=""></div><div class="formato  form-group ui-state-default ui-sortable-handle" id="element-2"><label>Edad<p class="requerido">*</p></label><input id="edad" name="edad" type="number" length="15" step="any" disabled="" value="0" required=""></div><div class="formato ui-state-default ui-sortable-handle" id="element-3"><label>Bienes</label> <br id="bienes" name="bienes"><input id="bienes-0" type="checkbox" name="bienes-0" value="Casa" disabled=""><p>Casa</p><input id="bienes-1" type="checkbox" name="bienes-1" value="Carro" disabled=""><p>Carro</p><input id="bienes-2" type="checkbox" name="bienes-2" value="Moto" disabled=""><p>Moto</p><input id="bienes-3" type="checkbox" name="bienes-3" value="Estudio" disabled=""><p>Estudio</p></div><div class="formato ui-state-default ui-sortable-handle isSelected" id="element-4"><label>Estado civil</label><br id="estado_civil" name="estado_civil"><input type="radio" id="estado_civil-0" name="estado_civil" value="Soltero" disabled=""><p>Soltero</p> <input type="radio" id="estado_civil-1" name="estado_civil" value="Casado" disabled=""><p>Casado</p></div><div class="formato ui-state-default ui-sortable-handle" id="element-8"><label>Lista</label><select id="lista" name="lista"><option value="Opc 1" selected="">Opc 1</option><option value="Opc 2">Opc 2</option><option value="Opc 3">Opc 3</option></select></div><div class="ui-state-default formato ui-sortable-handle" id="element-5"><label>Materias</label><table id="materias" name="materias"><thead><tr><td class=""><p>Materias</p></td><td class=""><p>Primer previo</p></td><td class=""><p>Segundo previo</p></td><td class=""><p>Tercer previo</p></td><td class=""><p>Examen</p></td></tr></thead><tbody><tr><td class=""><p>Programación</p></td><td class=""><input id="materias_0" name="materias_0" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_1" name="materias_1" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_2" name="materias_2" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_3" name="materias_3" type="number" disabled="" step="any" max="5" min="0"></td></tr><tr><td class=""><p>Redes</p></td><td class=""><input id="materias_4" name="materias_4" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_5" name="materias_5" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_6" name="materias_6" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_7" name="materias_7" type="number" disabled="" step="any" max="5" min="0"></td></tr><tr><td class=""><p>Software</p></td><td class=""><input id="materias_8" name="materias_8" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_9" name="materias_9" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_10" name="materias_10" type="number" disabled="" step="any" max="5" min="0"></td><td class=""><input id="materias_11" name="materias_11" type="number" disabled="" step="any" max="5" min="0"></td></tr></tbody></table></div><div class="formato ui-state-default ui-sortable-handle" style="width:100%;" id="element-6"><label></label></div><div class="formato ui-state-default ui-sortable-handle" id="element-7"><label>Observaciones</label><textarea id="observaciones" name="observaciones" type="text" disabled="" style="margin: 0px; width: 387px; height: 54px;"></textarea></div>\n\n\n');

--
-- Disparadores `modificaciones_formato`
--
DELIMITER $$
CREATE TRIGGER `actualizacion_formato` AFTER INSERT ON `modificaciones_formato` FOR EACH ROW UPDATE `formato` SET `version`=new.version_formato,`codigo_html`=new.html WHERE  `cod_formato`=new.id_formato
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipo` int(1) NOT NULL,
  `descripcion_tipo` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `codigo_usuario` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre_usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellido_usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cedula_usuario` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password_usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `correo_usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cargo_usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `departamento_usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `telefono_usuario` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `rol_usuario` int(1) NOT NULL,
  `estado_usuario` tinyint(1) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`codigo_usuario`, `nombre_usuario`, `apellido_usuario`, `cedula_usuario`, `password_usuario`, `correo_usuario`, `cargo_usuario`, `departamento_usuario`, `telefono_usuario`, `rol_usuario`, `estado_usuario`, `fecha_registro`) VALUES
('admin', 'piformatica', 'pasante', '123456789', 'admin', 'admin@cisa.com', 'administrador TI', 'TI', '119', 1, 1, '2016-05-27 16:53:33'),
('asis', 'asis_name', 'asis_last', '369', 'asis', 'asis@cisa.com', 'asistente TI', 'TI', '119', 2, 1, '2016-04-11 19:25:57'),
('oper', 'oper_name', 'oper_last', '147', 'oper', 'oper@cisa.com', 'operario TI', 'TI', '119', 0, 1, '2016-05-26 21:35:13'),
('super', 'super_name', 'super_last', '2334', 'super', 'das@cisa.com', 'supervisor TI', ' TI', '119', 3, 1, '2016-05-27 16:39:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_formato`
--

CREATE TABLE `usuario_formato` (
  `id_usuario` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_formato` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha_accion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `accion` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario_formato`
--

INSERT INTO `usuario_formato` (`id_usuario`, `id_formato`, `fecha_accion`, `accion`) VALUES
('super', 'RMO-1100', '2016-05-26 15:54:47', 'asignado'),
('super', 'Test', '2016-05-25 14:50:50', 'asignado');

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
  ADD PRIMARY KEY (`cod_formato`),
  ADD KEY `frecuencia_uso` (`frecuencia_uso`);

--
-- Indices de la tabla `frecuencia_formato`
--
ALTER TABLE `frecuencia_formato`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial_usuario_formato`
--
ALTER TABLE `historial_usuario_formato`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`id_usuario`),
  ADD KEY `formato` (`id_formato`) USING BTREE;

--
-- Indices de la tabla `info_res-1710`
--
ALTER TABLE `info_res-1710`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `info_rmo-1100`
--
ALTER TABLE `info_rmo-1100`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `info_test`
--
ALTER TABLE `info_test`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modificaciones_formato`
--
ALTER TABLE `modificaciones_formato`
  ADD PRIMARY KEY (`fecha_modificacion`,`id_usuario`,`id_formato`),
  ADD KEY `id_formato` (`id_formato`),
  ADD KEY `id_usuario` (`id_usuario`) USING BTREE;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `info_res-1710`
--
ALTER TABLE `info_res-1710`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `info_rmo-1100`
--
ALTER TABLE `info_rmo-1100`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `info_test`
--
ALTER TABLE `info_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id_tipo` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `formato`
--
ALTER TABLE `formato`
  ADD CONSTRAINT `formato_ibfk_1` FOREIGN KEY (`frecuencia_uso`) REFERENCES `frecuencia_formato` (`id`);

--
-- Filtros para la tabla `modificaciones_formato`
--
ALTER TABLE `modificaciones_formato`
  ADD CONSTRAINT `modificaciones_formato_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`codigo_usuario`),
  ADD CONSTRAINT `modificaciones_formato_ibfk_2` FOREIGN KEY (`id_formato`) REFERENCES `formato` (`cod_formato`);

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
