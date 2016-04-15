<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Informacion_dto {

    var $fecha;
    var $usuario;
    var $estado;
    var $informacion;

    public function __construct() {
        
    }    

    function getFecha() {
        return $this->fecha;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getEstado() {
        return $this->estado;
    }

    function getInformacion() {
        return $this->informacion;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setInformacion($info) {
        $this->informacion = $info;
    }

    function crear($fecha, $usuario, $estado, $info) {
        $this->fecha = $fecha;
        $this->usuario = $usuario;
        $this->estado = $estado;
        $this->informacion = $info;
    }

    public function toJSON() {

        $arr = array(
            "fecha" => $this->fecha,
            "usuario" => $this->usuario,
            "estado" => $this->estado,
            "informacion" => $this->informacion);
        $json = json_encode($arr);
        return $json;
    }

}
