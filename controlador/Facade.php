<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
require_once '../modelo/Negocio.php';

$option=$_POST['opcion'];
$codigo_formato=$_POST['cod_formato'];

$facade=new Facade($codigo_formato);

if($option='cargarFormatos'){
    $facade->cargarFormatos($codigo_formato);
}

class Facade{
    private $negocio;
    
    public function __construct() {
        $this->negocio= new Negocio();
    }

    public function cargarFormatos($formato){
        $this->negocio->cargarFormatos($formato);
    }
}

?>

