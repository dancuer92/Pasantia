<?php

//header("Content-Type: text/html;charset=utf-8");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../modelo/dto/Formato_dto.php';
require_once '../controlador/conexion/Conexion.php';

/**
 * Clase Formato DAO encarada de las conexiones a la base de datos cuando se trabaja sobre los formatos.
 * Las consultas a la Base de Datos se realizan con consultas parametrizadas utilizando MySqli
 */
class Formato_dao {

    private $mysqli;
    private $formato;

    /**
     * Constructor vacío
     */
    public function __construct() {
        $this->mysqli = new Conexion();
        mysqli_set_charset($this->mysqli, 'utf8');
        $this->formato = new Formato_dto();
    }

    /**
     * Consulta para cargar los formatos
     * @param type $ref_formato
     * @param type $tipo
     * @param type $codigo
     * @return type
     */
    function cargarFormatos($ref_formato, $tipo, $codigo) {
        $mensaje = "";
        $sql = '';
        $formatos = array();
        if ($tipo == 'administrador' || $tipo == 'asistente') {
            $sql = "SELECT `cod_formato`, `nombre`, `version`, `procedimiento`, `jefe_procedimiento`, `descripcion_contenido`, `frecuencia_uso`, `codigo_html`"
                    . "FROM `formato` "
                    . "WHERE `cod_formato` COLLATE utf8_spanish_ci LIKE '%$ref_formato%'  OR `nombre` COLLATE utf8_spanish_ci LIKE '%$ref_formato%';";
        } else {
            $sql = "SELECT f.cod_formato, f.nombre, f.version, f.procedimiento, f.jefe_procedimiento, f.descripcion_contenido, f.frecuencia_uso, f.codigo_html 
                    FROM formato f, usuario_formato uf
                    WHERE f.cod_formato = uf.id_formato AND uf.id_usuario='" . $codigo . "' AND uf.accion='asignado' 
                    AND (f.cod_formato COLLATE utf8_spanish_ci LIKE '%$ref_formato%'  OR f.nombre COLLATE utf8_spanish_ci LIKE '%$ref_formato%')";
        }

//        $sql = "SELECT `cod_formato`, `nombre`, `observaciones`, `procedimiento`, `jefe_procedimiento`, `descripcion_contenido`, `frecuencia_uso` "
//                . "FROM `formato` ";


        if (!$sentencia = $this->mysqli->prepare($sql)) {
//            echo $this->mysqli->error;
            $mensaje.= $this->mysqli->error;
        }

        if ($sentencia->execute()) {
            $sentencia->bind_result($cod_formato, $nombre, $version, $procedimiento, $jefe_procedimiento, $descripcion_contenido, $frecuencia_uso, $codigo_html);
            while ($sentencia->fetch()) {
                $this->formato->crear($cod_formato, $nombre, $version, $procedimiento, $jefe_procedimiento, $descripcion_contenido, $frecuencia_uso, $codigo_html);
                $formatos[] = $this->formato->toJSON();
            }
        }
        $sentencia->close();
        $this->mysqli->close();
        return $formatos;
    }

    /**
     * Método que guarda un nuevo formato en el sistema
     * @param type $codigo
     * @param type $nombre
     * @param type $procedimiento
     * @param type $director
     * @param type $frecuencia
     * @param type $tipo
     * @param type $version
     * @param type $html
     * @return type
     */
    function guardarFormato($codigo, $nombre, $procedimiento, $director, $frecuencia, $tipo, $version, $html) {
        $mensaje = '';
        $sql = 'INSERT INTO `formato`(`cod_formato`, `nombre`, `version`, `procedimiento`, `jefe_procedimiento`, `descripcion_contenido`, `frecuencia_uso`, `codigo_html`) VALUES (?,?,?,?,?,?,?,?);';
        if (!$sentencia = $this->mysqli->prepare($sql)) {
            $mensaje.=$this->mysqli->error;
        }

        if (!$sentencia->bind_param("ssssssss", $codigo, $nombre, $version, $procedimiento, $director, $tipo, $frecuencia, $html)) {
            echo $this->mysqli->error;
        }

        if ($sentencia->execute()) {
            $this->formato->crear($codigo, $nombre, $version, $procedimiento, $director, $tipo, $frecuencia, $html);
        } else {
//            echo $sentencia->error;
            $this->formato = null;
        }
        $sentencia->close();
//        $this->mysqli->close();
        return $this->formato;
    }

    /**
     * Método que crea un tabla en la base de datos por cada formato en la base de datos.
     * @param type $formato
     * @return string
     */
    public function crearTablaInfo($formato) {
        $mensaje = '';
        $formato = strtolower($formato);
        $sql = "CREATE TABLE `info_$formato` (
                    `id` int(11) NOT NULL,
                    `fecha_registro_sistema` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    `fecha_formato_diligenciado` date NOT NULL,
                    `usuario` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
                    `estado` tinyint(4) NOT NULL,
                    `informacion` text COLLATE utf8_spanish_ci NOT NULL,
                    `observaciones` text COLLATE utf8_spanish_ci,
                    `campos_clave` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
                    `fechas_modificaciones` text COLLATE utf8_spanish_ci NULL,
                    `usuarios_modificaciones` text COLLATE utf8_spanish_ci NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

                ALTER TABLE `info_$formato`
                    ADD PRIMARY KEY (`id`),
                    ADD UNIQUE (`campos_clave`),
                    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
//        echo $sql;
        if (!$this->mysqli->multi_query($sql)) {
            $this->mysqli->error;
        }

        $this->mysqli->close();
        return $mensaje;
    }

    /**
     * Método que permite asignar o desasignar el formato a un usuario
     * @param type $usuario
     * @param type $formato
     * @param type $opc
     * @return int
     */
    public function asignarDesasignarFormato($usuario, $formato, $opc) {
        $sql = '';
        $filas = 0;
        if ($opc === 1) {
            $sql = "INSERT INTO `usuario_formato`(`id_usuario`, `id_formato`, `accion`) "
                    . "VALUES (?,?,'asignado') ON DUPLICATE KEY UPDATE `accion`='asignado';";
        } else {
            $sql = "UPDATE `usuario_formato` SET `accion`='desasignado' "
                    . "WHERE `id_usuario`=? AND `id_formato`=? AND `accion`='asignado';";
        }

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            echo $this->mysqli->error;
        }

//        $fecha= date('Y/m/d', time());
//        $accion='asignado';
        if (!$sentencia->bind_param("ss", $usuario, $formato)) {
            echo $this->mysqli->error;
        }
        if ($sentencia->execute()) {
            $filas = $sentencia->affected_rows;
        } else {
            $filas = 0;
        }
        $sentencia->close();
        $this->mysqli->close();
        return $filas;
    }

    /**
     * Método que permite modificar un formato existente en la BD
     * @param type $usuario
     * @param type $formato
     * @param type $detalle
     * @param type $version
     * @param type $html
     * @return type
     */
    public function modificarFormato($usuario, $formato, $detalle, $version, $html) {
        $sql = "INSERT INTO `modificaciones_formato`(`id_usuario`, `id_formato`, `detalle_modificacion`, `version_formato`, `html`) "
                . " VALUES (?,?,?,?,?);";
        $filas = 0;

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            echo $this->mysqli->error;
        }

        if (!$sentencia->bind_param("sssss", $usuario, $formato, $detalle, $version, $html)) {
            echo $this->mysqli->error;
        }

        if ($sentencia->execute()) {
            $filas = $sentencia->affected_rows;
        }

        $sentencia->close();
        $this->mysqli->close();
        return $filas;
    }

    /**
     * Método que permite buscar las modificaciones de un formato
     * @param type $formato
     * @return type
     */
    public function buscar_modificacion($formato) {
        $fecha = date('Y-m-d', time());
//        $json=array();
        $json = 0;
        $sql = "SELECT `fecha_modificacion`, `id_usuario`, `id_formato` FROM `modificaciones_formato` WHERE `fecha_modificacion` LIKE '%$fecha%' AND `id_formato`=?;";

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            echo $this->mysqli->error;
        }

        if (!$sentencia->bind_param("s", $formato)) {
            echo $this->mysqli->error;
        }

        if ($sentencia->execute()) {
            $sentencia->store_result();
            $json = $sentencia->affected_rows;
        }

        return $json;
    }

    /**
     * Buscar el formato a través del código
     * @param type $formato
     * @return type
     */
    public function buscar_formato($formato) {
        $formatos = array();
        $sql = "SELECT `cod_formato`, `nombre`, `version`, `procedimiento`, `jefe_procedimiento`,"
                . " `descripcion_contenido`, `frecuencia_uso`, `codigo_html` FROM `formato` WHERE cod_formato=?";

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            echo $this->mysqli->error;
        }

        if (!$sentencia->bind_param("s", $formato)) {
            echo $this->mysqli->error;
        }

        if ($sentencia->execute()) {
            $sentencia->bind_result($cod_formato, $nombre, $version, $procedimiento, $jefe_procedimiento, $descripcion_contenido, $frecuencia_uso, $codigo_html);
            while ($sentencia->fetch()) {
                $this->formato->crear($cod_formato, $nombre, $version, $procedimiento, $jefe_procedimiento, $descripcion_contenido, $frecuencia_uso, $codigo_html);
                $formatos[] = $this->formato->toJSON();
            }
        }
        $sentencia->close();
//        $this->mysqli->close();
        return $formatos;
    }

    /**
     * Método que retorna el historial de modificaciones del formato
     * @param type $formato
     * @return type
     */
    public function historialFormato($formato) {
        $sql = "SELECT `fecha_modificacion`,`detalle_modificacion`,`id_usuario`,`version_formato` "
                . "FROM `modificaciones_formato` WHERE id_formato=?;";

        $json = array();

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            echo $this->mysqli->error;
        }

        if (!$sentencia->bind_param("s", $formato)) {
            echo $this->mysqli->error;
        }
        if ($sentencia->execute()) {
            $sentencia->bind_result($fecha_modificacion, $detalle_modificacion, $id_usuario, $version);
            while ($sentencia->fetch()) {
                $arr = array("fecha_modificacion" => $fecha_modificacion,
                    "detalle_modificacion" => $detalle_modificacion,
                    "id_usuario" => $id_usuario,
                    "version_formato" => $version);

                $json [] = json_encode($arr);
            }
        }
        $sentencia->close();
        $this->mysqli->close();
        return $json;
    }

    /**
     * Busca los días permitidos de un formato para la modificación de un registro del mismo
     * @param type $formato
     * @return int
     */
    public function buscarDiasModificacion($formato) {
        $dias = 0;
        $sql = "SELECT fre.`tiempo_modificacion` FROM `frecuencia_formato` fre, `formato`f "
                . "WHERE f.`cod_formato`=? AND f.`frecuencia_uso`=fre.`id`";

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            echo $this->mysqli->error;
        }

        if (!$sentencia->bind_param("s", $formato)) {
            echo $this->mysqli->error;
        }

        if ($sentencia->execute()) {
            $sentencia->bind_result($dias);
            while ($sentencia->fetch()) {
                return $dias;
            }
        }
        $sentencia->close();
        $this->mysqli->close();
        return $dias;
    }

    /**
     * método que permite ver el contenido de una version anterior del formato
     * @param type $formato
     * @param type $version
     * @return type
     */
    public function verVersionformato($formato, $version) {
        $html = '';
        $sql = "SELECT `html` FROM `modificaciones_formato` WHERE `id_formato`=? AND `version_formato`=?";

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            echo $this->mysqli->error;
        }

        if (!$sentencia->bind_param("ss", $formato, $version)) {
            echo $this->mysqli->error;
        }

        if ($sentencia->execute()) {
            $sentencia->bind_result($codigo_html);
            while ($sentencia->fetch()) {
                $html = $codigo_html;
            }
        }
        $sentencia->close();
        $this->mysqli->close();
        return $html;
    }

    public function modificarDatosFormato($formato, $clave, $valor) {
        $sql = "UPDATE formato f SET f." . $clave . "=? WHERE f.cod_formato=? ;";

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            $mensaje.= $this->mysqli->error;
        }
        if (!$sentencia->bind_param("ss", $valor, $formato)) {
            $mensaje.= $this->mysqli->error;
        }
        $mensaje = $sentencia->execute();
        $sentencia->close();
        $this->mysqli->close();
        return $mensaje;
    }

}
