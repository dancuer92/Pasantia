<?php
//header("Content-Type: text/html;charset=utf-8");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Formato_dto {

    private $cod_formato;
    private $nombre;
    private $observaciones;
    private $procedimiento;
    private $jefe_procedimiento;
    private $descripcion;
    private $frecuencia;
    private $html;

    public function __construct() {
        
    }

    public function getCod_formato() {
        return $this->cod_formato;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getObservaciones() {
        return $this->observaciones;
    }

    public function getProcedimiento() {
        return $this->procedimiento;
    }

    public function getJefe_procedimiento() {
        return $this->jefe_procedimiento;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getFrecuencia() {
        return $this->frecuencia;
    }
    
    public function getHtml() {
        return $this->html;
    }
    
    public function setCod_formato($codigo) {
        $this->cod_formato=$codigo;
    }

    public function setNombre($nombre) {
        $this->nombre=$nombre;
    }
    
    public function setObservaciones($observaciones) {
        $this->observaciones=$observaciones;
    }

    public function setProcedimiento($procedimiento) {
        $this->procedimiento=$procedimiento;
    }

    public function setJefe_procedimiento($jefe) {
        $this->jefe_procedimiento=$jefe;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion=$descripcion;
    }

    public function setFrecuencia($frecuencia) {
        $this->frecuencia=$frecuencia;
    }
    
    public function setHtml($html) {
        $this->html=$html;
    }

    public function crear($cod_formato, $nombre, $observaciones, $procedimiento, $jefe_procedimiento, $descripcion_contenido, $frecuencia_uso,$html) {
        $this->cod_formato = $cod_formato;
        $this->nombre = $nombre;
        $this->observaciones = $observaciones;
        $this->procedimiento = $procedimiento;
        $this->jefe_procedimiento = $jefe_procedimiento;
        $this->descripcion = $descripcion_contenido;
        $this->frecuencia = $frecuencia_uso;
        $this->html=$html;
    }

    public function toJSON() {        
        $arr = array("cod_formato"=>$this->cod_formato,
                "nombre"=>$this->nombre, 
                "observaciones"=> $this->observaciones, 
                "procedimiento"=>$this->procedimiento ,
                "jefe_procedimiento"=>$this->jefe_procedimiento ,
                "descripcion"=>$this->descripcion ,
                "frecuencia"=>$this->frecuencia ,
                "codigo_html"=>$this->html );
        
        $json=  json_encode($arr);
        return $json;
    }

}
