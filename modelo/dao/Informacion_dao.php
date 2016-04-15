<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



require_once '../modelo/dto/Informacion_dto.php';
require_once '../controlador/conexion/Conexion.php';

class Informacion_dao {

    private $mysqli;
    private $info;

    public function __construct() {
        $this->mysqli = new Conexion();
        $this->info = new Informacion_dto();
    }

    public function guardarInfo($usuario, $formato, $info) {
        $mensaje = '';
        $estado = 0;
        $sql = 'INSERT INTO `info_' . $formato . '`(`id`,`fecha`,`usuario`, `estado`, `informacion`) '
                . 'VALUES (NULL,CURRENT_TIMESTAMP,?,?,?)';

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            $mensaje.=$this->mysqli->error;
        }

        if (!$sentencia->bind_param("sis", $usuario, $estado, $info)) {
            echo $this->mysqli->error;
        }

        if ($sentencia->execute()) {
            $this->info->crear('', $usuario, $estado, $info);
        } else {
            $this->info = null;
        }
        $sentencia->close();
        $this->mysqli->close();
        return $this->info;
    }

    public function mostrarInfo($formato) {
        $mensaje = '';
        $informacion = array();
        $sql = "SELECT `fecha`, `usuario`, `estado`, `informacion` FROM `info_$formato` ;";

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            $mensaje.=$this->mysqli->error;
        }

        if ($sentencia->execute()) {
            $sentencia->bind_result($fecha, $usuario, $estado, $info);
            while ($sentencia->fetch()) {
                $this->info->crear($fecha, $usuario, $estado, $info);
                $informacion[] = $this->info->toJSON();
            }            
        }
        
        $sentencia->close();
        $this->mysqli->close();
        return $informacion;
    }

}
