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

    public function __construct() {
        $this->mysqli = new Conexion();
    }

    function cargarFormatos($ref_formato) {
        $mensaje = "";
        $formato = new Formato_dto();

        $sql = "SELECT `cod_formato`, `nombre`, `observaciones`, `procedimiento`, `jefe_procedimiento`, `descripcion_contenido`, `frecuencia_uso` "
                . "FROM `formato` "
                . "WHERE `cod_formato` COLLATE latin1_spanish_ci LIKE '%$ref_formato%'  OR `nombre` COLLATE latin1_spanish_ci LIKE '%$ref_formato%' LIMIT 1;";


        if (!$sentencia = $this->mysqli->prepare($sql)) {
            $mensaje.= $this->mysqli->error;
        }

        if ($sentencia->execute()) {
            $sentencia->bind_result($cod_formato, $nombre, $observaciones, $procedimiento, $jefe_procedimiento, $descripcion_contenido, $frecuencia_uso);
            while ($sentencia->fetch()) {
                $formato->crear($cod_formato, $nombre, $observaciones, $procedimiento, $jefe_procedimiento, $descripcion_contenido, $frecuencia_uso);
            }
        } 
        $sentencia->close();
        $this->mysqli->close();
//        echo $formato->toJSON().'DAO';
        return $formato;
    }

}
