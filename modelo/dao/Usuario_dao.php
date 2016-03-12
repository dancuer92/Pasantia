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
    private $usuario;

    public function __construct() {
        $this->mysqli = new Conexion();
        $this->usuario = new Usuario_dto();
    }

    public function iniciar_sesion($nombre, $apellido) {
        $usuario = new Usuario_dto();

        $sql = "SELECT usuario.nombre_usuario, usuario.apellido_usuario , usuario.codigo_usuario, 
            usuario.rol_usuario, usuario.estado_usuario
            FROM usuario WHERE usuario.nombre_usuario=? AND usuario.apellido_usuario =?";

        //PREPARAMOS EL PROCEDIMIENTO
        if (!$sentencia = $this->mysqli->prepare($sql)) {
            echo $this->mysqli->error;
        }

        //LE PASAMOS LOS PARAMETROS; "SS" SIGNIFICA QUE SON STRINGS
        if (!$sentencia->bind_param("ss", $nombre, $apellido)) {
            echo $this->mysqli->error;
        }

        //EJECUTAMOS LA CONSULTA
        if (!$sentencia->execute()) {
            print $this->mysqli->error;
            die("Fallo en la ejecucion");
        }
        if ($sentencia->execute()) {
            $sentencia->bind_result($nombre_usuario, $apellido_usuario, $codigo_usuario, $rol_usuario, $estado_usuario);
            while ($sentencia->fetch()) {
                $usuario->sesion($nombre_usuario, $apellido_usuario, $codigo_usuario, $rol_usuario, $estado_usuario);
            }
        }
        $sentencia->close();
        $this->mysqli->close();
//        echo $formato->toJSON().'DAO';
        return $usuario;
    }

    public function registrar($codigo, $nombre, $apellido, $cedula, $password, $correo, $cargo, $departamento, $telefono, $rol_usuario, $estado) {

        $mensaje = '';
        $sql = "INSERT INTO `usuario`(`codigo_usuario`, `nombre_usuario`, `apellido_usuario`, `cedula_usuario`, "
                . "`password_usuario`, `correo_usuario`, `cargo_usuario`, `departamento_usuario`, `telefono_usuario`, "
                . "`rol_usuario`, `estado_usuario`) "
                . "VALUES (?,?,?,?,?,?,?,?,?,?,?);";

        //PREPARAMOS EL PROCEDIMIENTO
        if (!$sentencia = $this->mysqli->prepare($sql)) {
            echo $this->mysqli->error;
        }

        //LE PASAMOS LOS PARAMETROS; "SS" SIGNIFICA QUE SON STRINGS
        if (!$sentencia->bind_param("issssssssii", $codigo, $nombre, $apellido, $cedula, $password, $correo, $cargo, $departamento, $telefono, $rol_usuario, $estado)) {
            echo $this->mysqli->error;
        }

        //EJECUTAMOS LA CONSULTA
        if ($sentencia->execute()) {
            $this->usuario->registrar($codigo, $nombre, $apellido, $cedula, $password, $correo, $cargo, $departamento, $telefono, $rol_usuario, $estado);
        } else {
            $this->usuario = NULL;
        }
        $sentencia->close();
        $this->mysqli->close();
        return $this->usuario;
    }

    public function buscar($consultaBusqueda) {
        $usuarios = array();
        $sql = "SELECT u.codigo_usuario, u.nombre_usuario, u.apellido_usuario, u.correo_usuario, u.cargo_usuario, "
                . "u.departamento_usuario, u.telefono_usuario, u.rol_usuario, u.estado_usuario, u.fecha_registro "
                . "FROM usuario u WHERE u.codigo_usuario COLLATE latin1_swedish_ci LIKE '%$consultaBusqueda%' "
                . "OR u.nombre_usuario COLLATE latin1_swedish_ci LIKE '%$consultaBusqueda%' "
                . "OR u.apellido_usuario COLLATE latin1_swedish_ci LIKE '%$consultaBusqueda%' "
                . "OR concat(u.nombre_usuario,' ',u.apellido_usuario) COLLATE latin1_swedish_ci LIKE '%$consultaBusqueda%' "
                . "LIMIT 6;";

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            echo $this->mysqli->error;
        }

        if ($sentencia->execute()) {
            $sentencia->bind_result($codigo_usuario, $nombre_usuario, $apellido_usuario, $correo_usuario, $cargo_usuario, $departamento_usuario, $telefono_usuario, $rol_usuario, $estado_usuario, $fecha_registro);
            while ($sentencia->fetch()) {
                $usuario=$this->usuario->registrar($codigo_usuario, $nombre_usuario, $apellido_usuario, '', '', $correo_usuario, $cargo_usuario, $departamento_usuario, $telefono_usuario, $rol_usuario, $estado_usuario);
                $usuarios[]=$usuario;
            }
        }
        $sentencia->close();
        $this->mysqli->close();
//        echo $formato->toJSON().'DAO';
        return $usuarios;
    }

}
