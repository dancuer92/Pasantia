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

    public function iniciar_sesion($nombre, $password) {
        $msj = $this->negocio->iniciar_sesion($nombre, $password);
        return $msj;
    }

    public function registrar_usuario($codigo, $nombre, $apellido, $cedula, $password, $correo, $cargo, $departamento, $telefono, $rol_usuario, $estado) {
        $msj = $this->negocio->registrar_usuario($codigo, $nombre, $apellido, $cedula, $password, $correo, $cargo, $departamento, $telefono, $rol_usuario, $estado);
        return $msj;
    }

    public function buscar_usuario($consultaBusqueda,$opc) {
        $usuarios = $this->negocio->buscar_usuario($consultaBusqueda,$opc);
        return $usuarios;
    }

    public function editar_usuario($clave, $valor, $cod) {
        $msj = $this->negocio->editar_usuario($clave, $valor, $cod);
        return $msj;
    }

    public function cargar_usuario($codigo) {
        $json = $this->negocio->cargar_usuario($codigo);
        return $json;
    }

    public function cambiar_password_usuario($newPass, $prevPass, $cod) {
        $msj = $this->negocio->cambiar_password_usuario($newPass, $prevPass, $cod);
        return $msj;
    }

    public function cargarFormatos($formato) {
        $formatos = $this->negocio->cargarFormatos($formato);
        return $formatos;
    }
    
    public function guardarFormato($codigo, $nombre, $procedimiento, $director, $frecuencia, $tipo, $descripcion, $html){
        $formato= $this->negocio->guardarFormato($codigo, $nombre, $procedimiento, $director, $frecuencia, $tipo, $descripcion, $html);
        return $formato;
    }

    public function asignarFormato($usuario, $formato) {
        $msj= $this->negocio->asignarFormato($usuario, $formato);
        return $msj;
    }
    
    public function desasignarFormato($usuario, $formato) {
        $msj= $this->negocio->desasignarFormato($usuario, $formato);
        return $msj;
    }
    
    public function diligenciarFormato($formato) {
        $msj= $this->negocio->diligenciarFormato($formato);
        return $msj;
    }

}
