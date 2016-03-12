<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../modelo/negocio/Negocio.php';

class Facade {

    private $negocio;

    public function __construct() {
        $this->negocio = new Negocio();
    }

    public function iniciar_sesion($nombre, $apellido) {
        $msj = $this->negocio->iniciar_sesion($nombre, $apellido);
        return $msj;
    }

    public function registrar_usuario($codigo, $nombre, $apellido, $cedula, $password, $correo, $cargo, $departamento, $telefono, $rol_usuario, $estado) {
        $msj = $this->negocio->registrar_usuario($codigo, $nombre, $apellido, $cedula, $password, $correo, $cargo, $departamento, $telefono, $rol_usuario, $estado);
        return $msj;
    }

    public function buscar_usuario($consultaBusqueda) {
        $msj = $this->negocio->buscar_usuario($consultaBusqueda);
        return $msj;
    }

    public function cargarFormatos($formato) {
        $json = $this->negocio->cargarFormatos($formato);
//        echo $json.'Facade';
        return $json;
    }

}
