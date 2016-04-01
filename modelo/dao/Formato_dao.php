<?php

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
        $this->formato = new Formato_dto();
    }

    function cargarFormatos($ref_formato) {
        $mensaje = "";
        $sql = '';
        $formatos = array();
        if ($_SESSION['tipo'] == 'admin') {
            $sql = "SELECT `cod_formato`, `nombre`, `observaciones`, `procedimiento`, `jefe_procedimiento`, `descripcion_contenido`, `frecuencia_uso`, `codigo_html`"
                    . "FROM `formato` "
                    . "WHERE `cod_formato` COLLATE latin1_spanish_ci LIKE '%$ref_formato%'  OR `nombre` COLLATE latin1_spanish_ci LIKE '%$ref_formato%';";
        } else {
            $sql = "SELECT f.cod_formato, f.nombre, f.observaciones, f.procedimiento, f.jefe_procedimiento, f.descripcion_contenido, f.frecuencia_uso, f.codigo_html 
                    FROM formato f, usuario_formato uf
                    WHERE f.cod_formato = uf.id_formato AND uf.id_usuario=".$_SESSION['codigo']." AND (f.cod_formato COLLATE latin1_spanish_ci LIKE '%$ref_formato%'  OR f.nombre COLLATE latin1_spanish_ci LIKE '%$ref_formato%')";
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

    public function asignarFormato($usuario, $formato) {

        $sql = 'INSERT INTO `usuario_formato`(`id_usuario`, `id_formato`, `fecha_asignacion`, `estado`) VALUES (?,?,?,?)';
        if (!$sentencia = $this->mysqli->prepare($sql)) {
            echo $this->mysqli->error;
        }

        $fecha = date('Y/m/d', time());
        $estado = 1;

        if (!$sentencia->bind_param("sssi", $usuario, $formato, $fecha, $estado)) {
            echo $this->mysqli->error;
        }
        if ($sentencia->execute()) {
            return true;
        } else {
            return false;
        }
        $sentencia->close();
        $this->mysqli->close();
    }

}
