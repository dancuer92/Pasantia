<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once('./conexion/Conexion.php');
require_once '../modelo/facade/Facade.php';

$nombre = $_POST['nombre']; //TOMAMOS usuario DE TEXTO FORMULARIO
$apellido = $_POST['apellido']; //TOMAMOS password.

$sesion_controller=new Sesion_controller();
$sesion_controller->iniciar_sesion($nombre, $apellido);

class Sesion_controller{
    private $facade;
    
    public function __construct() {
        $this->facade=new Facade();
    }
    
    public function iniciar_sesion($nombre,$apellido){
        $msj= $this->facade->iniciar_sesion($nombre, $apellido);
        header($msj);
    }
    
    
}