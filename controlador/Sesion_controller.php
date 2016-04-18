<?php
//header("Content-Type: text/html;charset=utf-8");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once('./conexion/Conexion.php');
require_once '../modelo/facade/Facade.php';

$nombre = $_POST['nombre']; //TOMAMOS usuario DE TEXTO FORMULARIO
$password = $_POST['password']; //TOMAMOS password.

$sesion_controller=new Sesion_controller();
$sesion_controller->iniciar_sesion($nombre, $password);

class Sesion_controller{
    private $facade;
    
    public function __construct() {
        $this->facade=new Facade();
    }
    
    public function iniciar_sesion($nombre,$password){
        $msj= $this->facade->iniciar_sesion($nombre, $password);
        header($msj);
    }
    
    
}