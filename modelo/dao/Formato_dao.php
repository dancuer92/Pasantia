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
        $this->formato=new Formato_dto();
    }

    function cargarFormatos($ref_formato) {
        $mensaje = "";
        $formatos= array();

//        $sql = "SELECT `cod_formato`, `nombre`, `observaciones`, `procedimiento`, `jefe_procedimiento`, `descripcion_contenido`, `frecuencia_uso` "
//                . "FROM `formato` ";
        $sql = "SELECT `cod_formato`, `nombre`, `observaciones`, `procedimiento`, `jefe_procedimiento`, `descripcion_contenido`, `frecuencia_uso` "
                . "FROM `formato` "
                . "WHERE `cod_formato` COLLATE latin1_spanish_ci LIKE '%$ref_formato%'  OR `nombre` COLLATE latin1_spanish_ci LIKE '%$ref_formato%';";


        if (!$sentencia = $this->mysqli->prepare($sql)) {
            $mensaje.= $this->mysqli->error;
        }

        if ($sentencia->execute()) {
            $sentencia->bind_result($cod_formato, $nombre, $observaciones, $procedimiento, $jefe_procedimiento, $descripcion_contenido, $frecuencia_uso);
            while ($sentencia->fetch()) {
                $this->formato->crear($cod_formato, $nombre, $observaciones, $procedimiento, $jefe_procedimiento, $descripcion_contenido, $frecuencia_uso);
                $formatos[]=  $this->formato->toJSON();
            }
        } 
        $sentencia->close();
        $this->mysqli->close();
//        echo $formato->toJSON().'DAO';
        return $formatos;
    }

}
