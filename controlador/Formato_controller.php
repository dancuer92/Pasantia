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
if($option=='diligenciarFormato'){
    $formato= $_POST['formato'];
    $formato_controller->diligenciarFormato($formato);
}

class Formato_controller {

    private $facade;

    public function __construct() {
        $this->facade = new Facade();
    }

    public function cargarFormatos($formato) {
        $mensaje = '';

        $formatos = $this->facade->cargarFormatos($formato);
//        echo $json.'controller';
        if (count($formatos) == 0) {
            $mensaje = '<strong> El formato consultado no existe </Strong>';
        } else {

            foreach ($formatos as $format) {
                $array = json_decode($format, true);
                $cod=$array["cod_formato"];
                $nombre=$array["nombre"];
                $observaciones=$array["observaciones"];
                $procedimiento=$array["procedimiento"];
                $jefe=$array["jefe_procedimiento"];
                $tipo=$array["descripcion"];
                $frecuencia=$array["frecuencia"];
                $html=$array["codigo_html"];
                

                $mensaje .= '<li class="collection-item avatar">
                            <i class="large material-icons left grey-text text-lighten-1 tooltipped" data-position="bottom" data-delay="50" data-tooltip="VER">description</i>
                            <p><strong>' . $cod . '</strong></p>
                            <p>' . $nombre . '</p>
                            <p>' . $observaciones . '</p>
                            <p>' . $procedimiento . '</p>
                            <p>' . $jefe . '</p>
                                
                            <form id="opciones" method="post">';


//                $mensaje.='<tr>
//                            <td>' . $array["cod_formato"] . '</td>
//                            <td>' . $array["nombre"] . '</td>
//                            <td>' . $array["observaciones"] . '</td>
//                            <td>' . $array["procedimiento"] . '</td>                        
//                            <td>' . $array["jefe_procedimiento"] . '</td>                        
//                            <td>
//                                <a class="hoverable colorTexto tooltipped" data-position="top" data-delay="50" data-tooltip="Diligenciar" href="#Diligenciar"> <i class="material-icons">keyboard</i></a>';
                if ($_SESSION['tipo'] == 'admin') {
                    $mensaje.='<input type="hidden" id="ref_formato" name="ref_formato" value="'.$cod.'" />'
                            . '<a class="btn-floating red hoverable tooltipped" data-position="top" data-delay="50" data-tooltip="Diligenciar" onclick="diligenciarFormato(&' . $cod . '&)"> <i class="material-icons">keyboard</i></a>'
                            . '<a class="btn-floating red hoverable tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Asignar" onclick="asignarFormato(&' . $cod . '&);"><i class="material-icons">input</i></a>'
                            . '<a class="btn-floating red hoverable tooltipped" data-position="top" data-delay="50" data-tooltip="Modificar" onclick="modificarFormato(&'.$cod.'&)" ><i class="material-icons">edit</i></a>';
                } else {
                    $mensaje.='<a class="btn-floating red hoverable tooltipped" data-position="top" data-delay="50" data-tooltip="Diligenciar" href="#Diligenciar"> <i class="material-icons">keyboard</i></a>';
                }
                $mensaje.='</form></li>';
            }
            $mensaje = str_replace("&", "'", $mensaje);
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
    
    public function diligenciarFormato($formato){
        $mensaje='';
        $mensaje= $this->facade->diligenciarFormato($formato);
        echo $mensaje;
    }

}
?>

