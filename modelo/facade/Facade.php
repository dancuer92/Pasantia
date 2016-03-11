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
        session_start();
        $msj = $this->negocio->iniciar_sesion($nombre, $apellido);
        return $msj;
    }   
    

    public function cargarFormatos($formato) {
        $json = $this->negocio->cargarFormatos($formato);
//        echo $json.'Facade';
        return $json;
    }

}
