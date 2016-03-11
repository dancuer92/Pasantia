<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../modelo/dto/Usuario_dto.php';
require_once '../controlador/conexion/Conexion.php';

class Usuario_dao {

    private $mysqli;

    public function __construct() {
        $this->mysqli = new Conexion();
    }

    public function iniciar_sesion($nombre, $apellido) {
        $usuario = new Usuario_dto();

        $sql = "SELECT usuario.nombre_usuario, usuario.apellido_usuario , usuario.codigo_usuario, 
            usuario.rol_usuario, usuario.estado_usuario
            FROM usuario WHERE usuario.nombre_usuario=? AND usuario.apellido_usuario =?";

        //PREPARAMOS EL PROCEDIMIENTO
        if (!$sentencia = $this->mysqli->prepare($sql)) {
            print $this->mysqli->error;
        }

        //LE PASAMOS LOS PARAMETROS; "SS" SIGNIFICA QUE SON STRINGS
        if (!$sentencia->bind_param("ss", $nombre, $apellido)) {
            print $this->mysqli->error;
        }

        //EJECUTAMOS LA CONSULTA
        if (!$sentencia->execute()) {
            print $this->mysqli->error;
            die("Fallo en la ejecucion");
        }
        if ($sentencia->execute()) {
            $sentencia->bind_result($nombre_usuario, $apellido_usuario, $codigo_usuario, $rol_usuario, $estado_usuario);
            while ($sentencia->fetch()) {
                $usuario->crear($nombre_usuario, $apellido_usuario, $codigo_usuario, $rol_usuario, $estado_usuario);
            }
        }
        $sentencia->close();
        $this->mysqli->close();
//        echo $formato->toJSON().'DAO';
        return $usuario;
    }

}
