<?php
//header("Content-Type: text/html;charset=utf-8");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../modelo/negocio/Negocio.php';

/**
 * Esta clase tiene todos sus métodos decoradores que a su vez tienen función en la clase negocio, 
 * es una capa de transición entre vista y modelo del sistema.
 */
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

    public function buscar_usuario($consultaBusqueda,$opc,$formato) {
        $usuarios = $this->negocio->buscar_usuario($consultaBusqueda,$opc,$formato);
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

    public function cargarFormatos($formato,$tipo,$codigo) {
        $formatos = $this->negocio->cargarFormatos($formato,$tipo,$codigo);
        return $formatos;
    }
    
    public function guardarFormato($codigo, $nombre, $procedimiento, $director, $frecuencia, $tipo, $version, $html){
        $formato= $this->negocio->guardarFormato($codigo, $nombre, $procedimiento, $director, $frecuencia, $tipo, $version, $html);
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
    
    public function visualizarFormato($formato,$tipo,$codigo) {
        $msj= $this->negocio->visualizarFormato($formato,$tipo,$codigo);
        return $msj;
    }

    public function modificarFormato($usuario, $formato, $detalle, $html) {
        $msj= $this->negocio->modificarFormato($usuario, $formato, $detalle, $html);
        return $msj;
    }
    
    public function historialFormato($formato) {
        $msj= $this->negocio->historialFormato($formato);
        return $msj;
    }
    
    public function diligenciarFormato($fechaFormato, $usuario, $formato, $info,$observaciones){
        $msj=$this->negocio->diligenciarFormato($fechaFormato, $usuario, $formato, $info,$observaciones);
        return $msj;
    }
    
    public function mostrarRegistrosFormato($formato) {
        $msj=  $this->negocio->mostrarRegistrosFormato($formato);
        return $msj;
    }
    
    public function verDatos($formato,$fecha){
        $msj=  $this->negocio->verDatos($formato,$fecha);
        return $msj;
    }
    
    public function modificarRegistroFormato($fechaFormato, $usuario, $formato, $info,$observaciones, $tipo){
        $msj=$this->negocio->modificarRegistroFormato($fechaFormato, $usuario, $formato, $info,$observaciones, $tipo);
        return $msj;
    }
    
    public function verVersionFormato($formato, $version){
        $msj=$this->negocio->verVersionFormato($formato, $version);
        return $msj;
    }
    
    public function trazabilidadFormato($formato, $clave, $inicio, $fin){
        $msj=$this->negocio->trazabilidadFormato($formato, $clave, $inicio, $fin);
        return $msj;
    }

}
