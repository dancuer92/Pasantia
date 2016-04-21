<?php

//header("Content-Type: text/html;charset=utf-8");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../modelo/dto/Formato_dto.php';
require_once '../controlador/conexion/Conexion.php';

class Formato_dao {

    private $mysqli;
    private $formato;

    public function __construct() {
        $this->mysqli = new Conexion();
        mysqli_set_charset($this->mysqli, 'utf8');
        $this->formato = new Formato_dto();
    }

    function cargarFormatos($ref_formato, $tipo, $codigo) {
        $mensaje = "";
        $sql = '';
        $formatos = array();
        if ($tipo == 'administrador' || $tipo == 'asistente') {
            $sql = "SELECT `cod_formato`, `nombre`, `observaciones`, `procedimiento`, `jefe_procedimiento`, `descripcion_contenido`, `frecuencia_uso`, `codigo_html`"
                    . "FROM `formato` "
                    . "WHERE `cod_formato` COLLATE utf8_spanish_ci LIKE '%$ref_formato%'  OR `nombre` COLLATE utf8_spanish_ci LIKE '%$ref_formato%';";
        } else {
            $sql = "SELECT f.cod_formato, f.nombre, f.observaciones, f.procedimiento, f.jefe_procedimiento, f.descripcion_contenido, f.frecuencia_uso, f.codigo_html 
                    FROM formato f, usuario_formato uf
                    WHERE f.cod_formato = uf.id_formato AND uf.id_usuario='" . $codigo . "' AND uf.accion='asignado' 
                    AND (f.cod_formato COLLATE utf8_spanish_ci LIKE '%$ref_formato%'  OR f.nombre COLLATE utf8_spanish_ci LIKE '%$ref_formato%')";
        }

//        $sql = "SELECT `cod_formato`, `nombre`, `observaciones`, `procedimiento`, `jefe_procedimiento`, `descripcion_contenido`, `frecuencia_uso` "
//                . "FROM `formato` ";


        if (!$sentencia = $this->mysqli->prepare($sql)) {
            echo $this->mysqli->error;
            $mensaje.= $this->mysqli->error;
        }

        if ($sentencia->execute()) {
            $sentencia->bind_result($cod_formato, $nombre, $observaciones, $procedimiento, $jefe_procedimiento, $descripcion_contenido, $frecuencia_uso, $codigo_html);
            while ($sentencia->fetch()) {
                $this->formato->crear($cod_formato, $nombre, $observaciones, $procedimiento, $jefe_procedimiento, $descripcion_contenido, $frecuencia_uso, $codigo_html);
                $formatos[] = $this->formato->toJSON();
            }
        }
        $sentencia->close();
        $this->mysqli->close();
        return $formatos;
    }

    function guardarFormato($codigo, $nombre, $procedimiento, $director, $frecuencia, $tipo, $descripcion, $html) {
        $mensaje = '';
        $sql = 'INSERT INTO `formato`(`cod_formato`, `nombre`, `observaciones`, `procedimiento`, `jefe_procedimiento`, `descripcion_contenido`, `frecuencia_uso`, `codigo_html`) VALUES (?,?,?,?,?,?,?,?);';
        if (!$sentencia = $this->mysqli->prepare($sql)) {
            $mensaje.=$this->mysqli->error;
        }

        if (!$sentencia->bind_param("ssssssss", $codigo, $nombre, $descripcion, $procedimiento, $director, $tipo, $frecuencia, $html)) {
            echo $this->mysqli->error;
        }

        if ($sentencia->execute()) {
            $this->formato->crear($codigo, $nombre, $descripcion, $procedimiento, $director, $tipo, $frecuencia, $html);
        } else {
            $this->formato = null;
        }
        $sentencia->close();
        $this->mysqli->close();
        return $this->formato;
    }

    public function crearTablaInfo($formato) {
        $mensaje = '';
        $formato = strtolower($formato);
        $sql = "CREATE TABLE `info_$formato` (
                    `id` int(11) NOT NULL,
                    `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    `usuario` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
                    `estado` tinyint(4) NOT NULL,
                    `informacion` text COLLATE utf8_spanish_ci NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

                ALTER TABLE `info_$formato`
                    ADD PRIMARY KEY (`id`),
                    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
//        echo $sql;
        if (!$this->mysqli->multi_query($sql)) {
            $this->mysqli->error;
        }

        $this->mysqli->close();
        return $mensaje;
    }

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

    public function modificarFormato($usuario, $formato, $detalle, $observaciones, $html) {
        $sql = "INSERT INTO `modificaciones_formato`(`id_usuario`, `id_formato`, `detalle_modificacion`, `observaciones_formato`, `html`) VALUES (?,?,?,?,?);";
        $filas = 0;

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            echo $this->mysqli->error;
        }

        if (!$sentencia->bind_param("sssss", $usuario, $formato, $detalle, $observaciones, $html)) {
            echo $this->mysqli->error;
        }

        if ($sentencia->execute()) {
            $filas = $sentencia->affected_rows;
        }

        $sentencia->close();
        $this->mysqli->close();
        return $filas;
    }

    public function buscar_modificacion($formato) {
        $fecha = date('Y-m-d', time());
//        $json=array();
        $json = 0;
        $sql = "SELECT `fecha_modificacion`, `id_usuario`, `id_formato` FROM `modificaciones_formato` 
            WHERE `fecha_modificacion` LIKE '%$fecha%' AND `id_formato`=?;";

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            echo $this->mysqli->error;
        }

        if (!$sentencia->bind_param("s", $formato)) {
            echo $this->mysqli->error;
        }

        if ($sentencia->execute()) {
//            echo $sql;
            $sentencia->store_result();
            $json = $sentencia->affected_rows;
//            echo $json;
//            $sentencia->bind_result($fecha_modificacion, $id_usuario, $id_formato);
//            while ($sentencia->fetch()) {
//                $arr = array("fecha_modificacion" => $fecha_modificacion,
//                    "id_usuario" => $id_usuario,
//                    "id_formato" => $id_formato);
//                $json []= json_encode($arr);
//            }            
        }
//        $sentencia->close();
//        $this->mysqli->close();
        return $json;
    }

    public function historialFormato($formato) {
        $sql = "SELECT `fecha_modificacion`,`detalle_modificacion`,`id_usuario`,`observaciones_formato` "
                . "FROM `modificaciones_formato` WHERE id_formato=?;";

        $json = array();

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            echo $this->mysqli->error;
        }

        if (!$sentencia->bind_param("s", $formato)) {
            echo $this->mysqli->error;
        }
        if ($sentencia->execute()) {
            $sentencia->bind_result($fecha_modificacion, $detalle_modificacion, $id_usuario, $observaciones);
            while ($sentencia->fetch()) {
                $arr = array("fecha_modificacion" => $fecha_modificacion,
                    "detalle_modificacion" => $detalle_modificacion,
                    "id_usuario" => $id_usuario,
                    "observaciones" => $observaciones);

                $json [] = json_encode($arr);
            }
        }
        $sentencia->close();
        $this->mysqli->close();
        return $json;
    }

}
