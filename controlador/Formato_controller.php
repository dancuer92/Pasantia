<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
require_once '../modelo/facade/Facade.php';

$option = $_POST['opcion'];
$formato_controller = new Formato_controller();

if ($option == 'cargarFormatos') {
    $formato = $_POST['formato'];
    $formato_controller->cargarFormatos($formato);
}
if ($option == 'guardarFormato') {
    $codigo = $_POST['codigoF'];
    $nombre = $_POST['nombreF'];
    $procedimiento = $_POST['procedimientoF'];
    $director = $_POST['directorF'];
    $frecuencia = $_POST['frecuenciaF'];
    $tipo = $_POST['tipoF'];
    $descripcion = $_POST['descripcionF'];
    $html = $_POST['codigoHTML'];
    $formato_controller->guardarFormato($codigo, $nombre, $procedimiento, $director, $frecuencia, $tipo, $descripcion, $html);
}
if($option=='asignarFormato'){
    $usuario= $_POST['usuario'];
    $formato= $_POST['formato'];
    $formato_controller->asignarFormato($usuario,$formato);
}

class Formato_controller {

    private $facade;

    public function __construct() {
        $this->facade = new Facade();
    }

    public function cargarFormatos($formato) {
        $mensaje2 = '';

        $formatos = $this->facade->cargarFormatos($formato);
//        echo $json.'controller';
        if (count($formatos) == 0) {
            $mensaje = '<strong> El formato consultado no existe </Strong>';
        } else {

            foreach ($formatos as $format) {

                $array = json_decode($format, true);

                $mensaje2 .= '<li class="collection-item avatar">
                            <i class="large material-icons left grey-text">description</i>
                            <p><strong>' . $array["cod_formato"] . '</strong></p>
                            <p>' . $array["nombre"] . '</p>
                            <p>' . $array["observaciones"] . '</p>
                            <p>' . $array["procedimiento"] . '</p>
                            <p>' . $array["jefe_procedimiento"] . '</p>';


//                $mensaje.='<tr>
//                            <td>' . $array["cod_formato"] . '</td>
//                            <td>' . $array["nombre"] . '</td>
//                            <td>' . $array["observaciones"] . '</td>
//                            <td>' . $array["procedimiento"] . '</td>                        
//                            <td>' . $array["jefe_procedimiento"] . '</td>                        
//                            <td>
//                                <a class="hoverable colorTexto tooltipped" data-position="top" data-delay="50" data-tooltip="Diligenciar" href="#Diligenciar"> <i class="material-icons">keyboard</i></a>';
                if ($_SESSION['tipo'] == 'admin') {
                    $mensaje2.='<a class="hoverable colorTexto tooltipped" data-position="top" data-delay="50" data-tooltip="Diligenciar" href="#Diligenciar"> <i class="material-icons">keyboard</i></a>'
                            . '<a class="hoverable colorTexto tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Asignar " onclick="asignarFormato(' . $array["cod_formato"] . ');"><i class="material-icons">input</i></a>'
                            . '<a class="hoverable colorTexto tooltipped" data-position="top" data-delay="50" data-tooltip="Modificar" href="#Modificar"><i class="material-icons">edit</i></a>';
                } else {
                    $mensaje2.='<a class="hoverable colorTexto tooltipped" data-position="top" data-delay="50" data-tooltip="Diligenciar" href="#Diligenciar"> <i class="material-icons">keyboard</i></a>';
                }
                $mensaje2.='</li>';
            }
            $mensaje = str_replace("&", "'", $mensaje2);
        }
        echo $mensaje;
    }

    public function guardarFormato($codigo, $nombre, $procedimiento, $director, $frecuencia, $tipo, $descripcion, $html) {
        $mensaje = '';
        $mensaje = $this->facade->guardarFormato($codigo, $nombre, $procedimiento, $director, $frecuencia, $tipo, $descripcion, $html);
        echo $mensaje;
    }

    public function asignarFormato($usuario, $formato) {
        $mensaje='';
        $mensaje= $this->facade->asignarFormato($usuario, $formato);
        echo $mensaje;
    }

}
?>

