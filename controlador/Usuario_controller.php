<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
require_once '../modelo/facade/Facade.php';

$opcion = $_POST['opcion'];

$Usuario_controller = new Usuario_controller();

if ($opcion == "registrar_usuario") {
    $codigo = (int) $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $cedula = $_POST['numDoc'];
    $password = $_POST['pass'];
    $correo = $_POST['correo'];
    $cargo = $_POST['cargo'];
    $departamento = $_POST['departamento'];
    $telefono = $_POST['telefono'];
    $rol_usuario = (int) $_POST['rol'];
    $estado = (int) $_POST['estado'];
    $Usuario_controller->registrar_usuario($codigo, $nombre, $apellido, $cedula, $password, $correo, $cargo, $departamento, $telefono, $rol_usuario, $estado);
}

if ($opcion == "buscar") {
    $consultaBusqueda = $_POST['valorBusqueda'];
    $Usuario_controller->buscar_usuario($consultaBusqueda);
}


class Usuario_controller {

    private $facade;

    public function __construct() {
        $this->facade = new Facade();
    }

    public function registrar_usuario($codigo, $nombre, $apellido, $cedula, $password, $correo, $cargo, $departamento, $telefono, $rol_usuario, $estado) {
        $msj = $this->facade->registrar_usuario($codigo, $nombre, $apellido, $cedula, $password, $correo, $cargo, $departamento, $telefono, $rol_usuario, $estado);
        echo $msj;
    }
    
    public function buscar_usuario($consultaBusqueda){
        $msj =  $this->facade->buscar_usuario($consultaBusqueda);
        echo $msj;
    }

    

}
?>



