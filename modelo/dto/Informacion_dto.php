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
    var $campos_clave;
    var $fechas_modificaciones;
    var $usuarios_modificaciones;

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
    
    function getCampos_clave() {
        return $this->campos_clave;
    }
    
    function getFechas_modificaciones() {
        return $this->fechas_modificaciones;
    }
    
    function getUsuarios_modificaciones() {
        return $this->usuarios_modificaciones;
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
    
    function setObservaciones($obs) {
        $this->observaciones = $obs;
    }
    
    function setCampos_clave($campos) {
        $this->campos_clave = $campos;
    }
    
    function setFechas_modificaciones($fechas_modificaciones) {
        $this->fechas_modificaciones = $fechas_modificaciones;
    }
    
    function setUsuarios_modificaciones($usuarios_modifiaciones) {
        $this->usuarios_modificaciones = $usuarios_modifiaciones;
    }

    function crear($fecha_sistema, $fecha_formato, $usuario, $estado, $info, $observaciones, $campos_clave, $fechas_modificaciones, $usuarios_modificaciones) {
        $this->fecha_sistema = $fecha_sistema;
        $this->fecha_formato = $fecha_formato;
        $this->usuario = $usuario;
        $this->estado = $estado;
        $this->informacion = $info;
        $this->observaciones = $observaciones;
        $this->campos_clave = $campos_clave;
        $this->fechas_modificaciones = $fechas_modificaciones;
        $this->usuarios_modificaciones = $usuarios_modificaciones;
    }

    public function toJSON() {
        if($this->estado==0){
            $this->estado='Guardado';
        }
        else if(($this->estado<4)){
            $this->estado='Modificado';
        }
        else{
            $this->estado='Cerrado';
        }

        $arr = array(
            "fecha_sistema" => $this->fecha_sistema,
            "fecha_formato" => $this->fecha_formato,
            "usuario" => $this->usuario,
            "estado" => $this->estado,
            "informacion" => $this->informacion,
            "observaciones" => $this->observaciones,
            "campos_clave" => $this->campos_clave,
            "fechas_modificaciones" => $this->fechas_modificaciones,
            "usuarios_modificaciones" => $this->usuarios_modificaciones);
        $json = json_encode($arr);
        return $json;
    }

}
