<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Usuario {

    var $codigo_usuario;
    var $nombre_usuario;
    var $apellido_usuario;
    var $cedula_usuario;
    var $password_usuario;
    var $correo_usuario;
    var $cargo_usuario;
    var $departamento_usuario;
    var $telefono_usuario;
    var $tipo_usuario;
    var $estado_usuario;

    

    function crear($datos) {

        $this->codigo_usuario = $datos['codigo_usuario'];
        $this->nombre_usuario = $datos['nombre_usuario'];
        $this->apellido_usuario= $datos['apellido_usuario'];
        $this->cedula_usuario = $datos['cedula_usuario'];
        $this->password_usuario = $datos['password_usuario'];
        $this->correo_usuario = $datos['correo_usuario'];
        $this->cargo_usuario = $datos['cargo_usuario'];
        $this->departamento_usuario = $datos['departamento_usuario'];
        $this->telefono_usuario = $datos['telefono_usuario'];

        if ($datos['tipo_usuario'] == 1) {
            $this->tipo_usuario = 'administrador';
        }

        if ($datos['tipo_usuario'] == 0) {
            $this->tipo_usuario = 'operario';
        }

        if ($datos['estado_usuario'] == 1) {
            $this->estado_usuario = 'activo';
        }

        if ($datos['estado_usuario'] == 0) {
            $this->estado_usuario = 'inactivo';
        }
    }

}
