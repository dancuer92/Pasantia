<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../modelo/dao/Formato_dao.php';
require_once '../modelo/dto/Formato_dto.php';
require_once '../modelo/dao/Usuario_dao.php';
require_once '../modelo/dto/Usuario_dto.php';

class Negocio {

    private $formato;
    private $usuario;

    public function __construct() {
        $this->formato = new Formato_dao();
        $this->usuario = new Usuario_dao();
    }

    public function iniciar_sesion($nombre, $apellido) {
        $usuario = $this->usuario->iniciar_sesion($nombre, $apellido);
        $mensaje = '';

        if ($usuario->tipo_usuario == 'admin' && $usuario->estado_usuario == 'activo') {
            $mensaje = ('location: ../vista/administrador.php');
        } else if ($usuario->tipo_usuario == 'operator' && $usuario->estado_usuario == 'activo') {
            $mensaje = ('location: ../vista/operario.php');
        } else {
            $mensaje = ('location: ../index.php');
        }

        $_SESSION['nombre'] = $usuario->nombre_usuario;
        $_SESSION['codigo'] = $usuario->codigo_usuario;
        $_SESSION['estado'] = $usuario->estado_usuario;
        $_SESSION['tipo'] = $usuario->tipo_usuario;
        return $mensaje;
    }

    public function registrar_usuario($codigo, $nombre, $apellido, $cedula, $password, $correo, $cargo, $departamento, $telefono, $rol_usuario, $estado) {
        $usuario = $this->usuario->registrar($codigo, $nombre, $apellido, $cedula, $password, $correo, $cargo, $departamento, $telefono, $rol_usuario, $estado);
        if (!is_null($usuario)) {
            return 'Usuario registrado con éxito';
        } else {
            return 'El usuario no ha sido registrado en el sistema';
        }
    }

    public function buscar_usuario($consultaBusqueda) {
        $mensaje='';
        $usuarios=array();
        $usuarios = $this->usuario->buscar($consultaBusqueda);  
        
        if(count($usuarios)==0){
            $mensaje = "<p>No hay ningún usuario con ese criterio de búsqueda</p>";
        }
        else {
            $mensaje = '<div class="row"> ';
            
//            $mensaje='hay: '.count($usuarios);
        }
        return $mensaje;

    }
        function cargarFormatos($codigo_formato) {
            $msj = '<p>codigo formato: ' . $codigo_formato . '</p>';
            $formato = $this->formato->cargarFormatos($codigo_formato);
            //        echo $formato->toJSON() . 'Negocio';

            if ($formato->getCod_formato() != '') {
                return $formato->toJSON();
            } else {
                return null;
            }
        }

    }
    