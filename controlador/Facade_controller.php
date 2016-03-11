<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
require_once '../modelo/facade/Facade.php';

$option = $_POST['opcion'];
$codigo_formato = $_POST['cod_formato'];

$facade_controller = new Facade_controller();

if ($option = 'cargarFormatos') {
    $facade_controller->cargarFormatos($codigo_formato);
}

class Facade_controller {

    private $facade;

    public function __construct() {
        $this->facade = new Facade();
    }

    public function cargarFormatos($formato) {

        $json = $this->facade->cargarFormatos($formato);
//        echo $json.'controller';
        if ($json == null) {
            $mensaje = '<strong> El formato consultado no existe </Strong>';
        } else {

            $array = json_decode($json,true);

            $mensaje = '<div class="card" onclick="set(&'.$array["cod_formato"].'&)">
                    <div class="card-content">
                        <p><strong>Código: </strong>' . $array["cod_formato"]. '</p>
                        <p><strong>Nombre: </strong>' . $array["nombre"] . '</p>
                        <p><strong>Observaciones: </strong>' . $array["observaciones"] . '</p>
                        <p><strong>Procedimiento: </strong>' . $array["procedimiento"] . '</p>                        
                        <p><strong>Jefe Procedimiento: </strong>' . $array["jefe_procedimiento"] . '</p>
                        <p><strong>Descripción: </strong>' . $array["descripcion"] . '</p>              
                        <p><strong>Frecuencia: </strong>' . $array["frecuencia"] . '</p></div></div>';
        }
        echo $mensaje =  str_replace("&", "'", $mensaje);
    }

}
?>

