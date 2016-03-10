<?php

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

    public function crear($datos) {
        $this->cod_formato = $datos[0];
        $this->nombre = $datos[1];
        $this->observaciones = $datos[2];
        $this->procedimiento = $datos[3];
        $this->jefe_procedimiento = $datos[4];
        $this->descripcion = $datos[5];
        $this->frecuencia = $datos[6];
    }

    public function toString() {
        $msj = '{"codigo_formato": "' . $this->cod_formato . '", '
                . '"nombre": ' . $this->nombre . '",'
                . '"observaciones": ' . $this->observaciones . '",'
                . '"procedimiento": ' . $this->procedimiento . '",'
                . '"jefe_procedimiento": ' . $this->jefe_procedimiento . '",'
                . '"descripcion": ' . $this->descripcion . '",'
                . '"frecuencia": ' . $this->frecuencia . '"}';
        return $msj;
    }

}
