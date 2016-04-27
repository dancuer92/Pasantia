<?php
//header("Content-Type: text/html;charset=utf-8");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Informacion_dto {

    var $fecha_sistema;
    var $fecha_formato;
    var $usuario;
    var $estado;
    var $informacion;
    var $observaciones;

    public function __construct() {
        
    }    

    function getFecha_sistema() {
        return $this->fecha_sistema;
    }

    function getFecha_formato() {
        return $this->fecha_formato;
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
    
    function getObservaciones() {
        return $this->observaciones;
    }

    function setFecha_sistema($fecha) {
        $this->fecha_sistema = $fecha;
    }
    
    function setFecha_formato($fecha) {
        $this->fecha_formato = $fecha;
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

    function crear($fecha_sistema, $fecha_formato, $usuario, $estado, $info, $observaciones) {
        $this->fecha_sistema = $fecha_sistema;
        $this->fecha_formato = $fecha_formato;
        $this->usuario = $usuario;
        $this->estado = $estado;
        $this->informacion = $info;
        $this->observaciones = $observaciones;
    }

    public function toJSON() {

        $arr = array(
            "fecha_sistema" => $this->fecha_sistema,
            "fecha_formato" => $this->fecha_formato,
            "usuario" => $this->usuario,
            "estado" => $this->estado,
            "informacion" => $this->informacion,
            "observaciones" => $this->observaciones);
        $json = json_encode($arr);
        return $json;
    }

}
