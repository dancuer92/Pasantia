<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Usuario_dto {

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

    public function __construct() {
        
    }
    
    function getCodigo_usuario() {
        return $this->codigo_usuario;
    }

    function getNombre_usuario() {
        return $this->nombre_usuario;
    }

    function getApellido_usuario() {
        return $this->apellido_usuario;
    }

    function getCedula_usuario() {
        return $this->cedula_usuario;
    }

    function getPassword_usuario() {
        return $this->password_usuario;
    }

    function getCorreo_usuario() {
        return $this->correo_usuario;
    }

    function getCargo_usuario() {
        return $this->cargo_usuario;
    }

    function getDepartamento_usuario() {
        return $this->departamento_usuario;
    }

    function getTelefono_usuario() {
        return $this->telefono_usuario;
    }

    function getTipo_usuario() {
        return $this->tipo_usuario;
    }

    function getEstado_usuario() {
        return $this->estado_usuario;
    }

    function setCodigo_usuario($codigo_usuario) {
        $this->codigo_usuario = $codigo_usuario;
    }

    function setNombre_usuario($nombre_usuario) {
        $this->nombre_usuario = $nombre_usuario;
    }

    function setApellido_usuario($apellido_usuario) {
        $this->apellido_usuario = $apellido_usuario;
    }

    function setCedula_usuario($cedula_usuario) {
        $this->cedula_usuario = $cedula_usuario;
    }

    function setPassword_usuario($password_usuario) {
        $this->password_usuario = $password_usuario;
    }

    function setCorreo_usuario($correo_usuario) {
        $this->correo_usuario = $correo_usuario;
    }

    function setCargo_usuario($cargo_usuario) {
        $this->cargo_usuario = $cargo_usuario;
    }

    function setDepartamento_usuario($departamento_usuario) {
        $this->departamento_usuario = $departamento_usuario;
    }

    function setTelefono_usuario($telefono_usuario) {
        $this->telefono_usuario = $telefono_usuario;
    }

    function setTipo_usuario($tipo_usuario) {
        $this->tipo_usuario = $tipo_usuario;
    }

    function setEstado_usuario($estado_usuario) {
        $this->estado_usuario = $estado_usuario;
    }
    
    public function registrar($codigo, $nombre, $apellido, $cedula, $password, $correo, $cargo, $departamento, $telefono, $rol_usuario, $estado) {

        $this->codigo_usuario = $codigo;
        $this->nombre_usuario = $nombre;
        $this->apellido_usuario = $apellido;
        $this->cedula_usuario=$cedula;
        $this->password_usuario=$password;
        $this->correo_usuario=$correo;
        $this->cargo_usuario=$cargo;
        $this->departamento_usuario=$departamento;
        $this->telefono_usuario=$telefono;
        $this->tipo_usuario = $this->crearTipo($rol_usuario);        
        $this->estado_usuario = $this->crearEstado($estado); 
    }

    
    public function sesion($nombre_usuario, $apellido_usuario, $codigo_usuario, $rol_usuario, $estado_usuario) {

        $this->codigo_usuario = $codigo_usuario;
        $this->nombre_usuario = $nombre_usuario;
        $this->apellido_usuario = $apellido_usuario;        
        $this->tipo_usuario = $this->crearTipo($rol_usuario);        
        $this->estado_usuario = $this->crearEstado($estado_usuario); 
    }
    
    public function crearTipo($rol_usuario){
        if ($rol_usuario == 1) {
            return 'admin';
        }

        if ($rol_usuario == 0) {
            return 'operator';
        }
    }
    
    public function crearEstado($estado_usuario){
        if ($estado_usuario == 1) {
            return 'activo';
        }
        if ($estado_usuario == 0) {
            return 'inactivo';
        }
    }

}
