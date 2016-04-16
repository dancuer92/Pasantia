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

switch ($option) {
    case 'cargarFormatos':
        $formato = $_POST['formato'];
        $formato_controller->cargarFormatos($formato);
        break;
    case 'guardarFormato':
        $codigo = $_POST['codigoF'];
        $nombre = $_POST['nombreF'];
        $procedimiento = $_POST['procedimientoF'];
        $director = $_POST['directorF'];
        $frecuencia = $_POST['frecuenciaF'];
        $tipo = $_POST['tipoF'];
        $descripcion = $_POST['descripcionF'];
        $html = $_POST['codigoHTML'];
        $formato_controller->guardarFormato($codigo, $nombre, $procedimiento, $director, $frecuencia, $tipo, $descripcion, $html);
        break;
    case 'asignarFormato':
        $usuario = $_POST['usuario'];
        $formato = $_POST['formato'];
        $formato_controller->asignarFormato($usuario, $formato);
        break;
    case 'desasignarFormato':
        $usuario = $_POST['usuario'];
        $formato = $_POST['formato'];
        $formato_controller->desasignarFormato($usuario, $formato);
        break;
    case 'visualizarFormato':
        $formato = $_POST['formato'];
        $formato_controller->visualizarFormato($formato);
        break;
    case 'modificarFormato':
        $usuario = $_SESSION['codigo'];
        $formato = $_POST['formato'];
        $detalle = $_POST['detalle'];
        $observaciones = $_POST['observaciones'];
        $html = $_POST['html'];
        $formato_controller->modificarFormato($usuario, $formato, $detalle, $observaciones, $html);
        break;
    case 'historialFormato':
        $formato = $_POST['formato'];
        $formato_controller->historialFormato($formato);
        break;
    case 'diligenciarFormato':
        $formato = $_POST['formato'];
        $info = $_POST['info'];
        $usuario = $_SESSION['codigo'];
        $formato_controller->diligenciarFormato($usuario, $formato, $info);
        break;
    case 'mostrarRegistrosFormato':
        $formato = $_POST['formato'];
        $formato_controller->mostrarRegistrosFormato($formato);
        break;
    case 'verDatos':
        $formato=$_POST['formato'];
        $fecha=$_POST['fecha'];
        $formato_controller->verDatos($formato,$fecha);
        break;
    
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
                $cod = $array["cod_formato"];
                $nombre = $array["nombre"];
                $observaciones = $array["observaciones"];
                $procedimiento = $array["procedimiento"];
                $jefe = $array["jefe_procedimiento"];
                $tipo = $array["descripcion"];
                $frecuencia = $array["frecuencia"];
                $html = $array["codigo_html"];

                $mensaje .= $this->cargarBotones($cod, $nombre, $observaciones, $procedimiento, $jefe);
            }
            $mensaje = str_replace("&", "'", $mensaje);
        }
        echo $mensaje;
    }

    public function cargarBotones($cod, $nombre, $observaciones, $procedimiento, $jefe) {
        $mensaje = '<li class="collection-item avatar">
                            <i class="large material-icons left grey-text text-lighten-1 tooltipped" data-position="bottom" data-delay="50" data-tooltip="VER">description</i>
                            <p><strong>' . $cod . '</strong></p>
                            <p>' . $nombre . '</p>
                            <p>' . $observaciones . '</p>
                            <p>' . $procedimiento . '</p>
                            <p>' . $jefe . '</p>';
        switch ($_SESSION['tipo']) {
            case 'administrador':
                $mensaje.='<a class="btn-floating red hoverable tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Asignar" onclick="asignarFormato(&' . $cod . '&);"><i class="material-icons">input</i></a>'
                        . '<a class="btn-floating red hoverable tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Desasignar" onclick="desasignarFormato(&' . $cod . '&)" ><i class="material-icons">visibility_off</i></a>';
                break;
            case 'asistente':
                $mensaje.='<a class="btn-floating red hoverable tooltipped" data-position="top" data-delay="50" data-tooltip="Modificar" onclick="modificarFormato(&' . $cod . '&)" ><i class="material-icons">edit</i></a>'
                        . '<a class="btn-floating red hoverable tooltipped" data-position="top" data-delay="50" data-tooltip="Historial de versiones" onclick="historialFormato(&' . $cod . '&)" ><i class="material-icons">history</i></a>';
                break;
            case 'supervisor':
                $mensaje.='<a class="btn-floating red hoverable tooltipped" data-position="top" data-delay="50" data-tooltip="Diligenciar" onclick="diligenciarFormato(&' . $cod . '&)" ><i class="material-icons">keyboard</i></a>'
                        . '<a class="btn-floating red hoverable tooltipped" data-position="top" data-delay="50" data-tooltip="Mostrar registros" onclick="mostrarRegistrosFormato(&' . $cod . '&)" ><i class="material-icons">find_in_page</i></a>'
                        . '<a class="btn-floating red hoverable tooltipped" data-position="top" data-delay="50" data-tooltip="Analizar trazabilidad" onclick="analizarFormato(&' . $cod . '&)" ><i class="material-icons">timeline</i></a>';
                break;
            case 'operario':
                $mensaje.='<a class="btn-floating red hoverable tooltipped" data-position="top" data-delay="50" data-tooltip="Diligenciar" onclick="diligenciarFormato(&' . $cod . '&)" > <i class="material-icons">keyboard</i></a>'
                        . '<a class="btn-floating red hoverable tooltipped" data-position="top" data-delay="50" data-tooltip="Mostrar registros" onclick="mostrarRegistrosFormato(&' . $cod . '&)" > <i class="material-icons">find_in_page</i></a>';
        }

        $mensaje.='</li>';
        return $mensaje;
    }

    public function guardarFormato($codigo, $nombre, $procedimiento, $director, $frecuencia, $tipo, $descripcion, $html) {
        $mensaje = '';
        $mensaje = $this->facade->guardarFormato($codigo, $nombre, $procedimiento, $director, $frecuencia, $tipo, $descripcion, $html);
        echo $mensaje;
    }

    public function asignarFormato($usuario, $formato) {
        $mensaje = '';
        $mensaje = $this->facade->asignarFormato($usuario, $formato);
        echo $mensaje;
    }

    public function desasignarFormato($usuario, $formato) {
        $mensaje = '';
        $mensaje = $this->facade->desasignarFormato($usuario, $formato);
        echo $mensaje;
    }

    public function visualizarFormato($formato) {
        $mensaje = '';
        $mensaje = $this->facade->visualizarFormato($formato);
        echo $mensaje;
    }

    public function modificarFormato($usuario, $formato, $detalle, $observaciones, $html) {
        $mensaje = '';
        $mensaje = $this->facade->modificarFormato($usuario, $formato, $detalle, $observaciones, $html);
        echo $mensaje;
    }

    public function historialFormato($formato) {
        $mensaje = '';
        $historial = $this->facade->historialFormato($formato);
        if (count($historial) == 0) {
            $mensaje = '<strong> El formato no tiene historial de modificaciones </Strong>';
        } else {

            foreach ($historial as $historia) {
                $array = json_decode($historia, true);
                $fecha = $array["fecha_modificacion"];
                $detalle = $array["detalle_modificacion"];
                $usuario = $array["id_usuario"];
                $observaciones = $array["observaciones"];

                $mensaje .= $this->cargarFilas($fecha, $detalle, $usuario, $observaciones);
            }
            $mensaje = str_replace("&", "'", $mensaje);
        }
        echo $mensaje;
    }

    public function cargarFilas($fecha, $detalle, $usuario, $observaciones) {
        $mensaje = '<tr>'
                . '<td>' . $fecha . '</td>'
                . '<td>' . $detalle . '</td>'
                . '<td>' . $usuario . '</td>'
                . '<td>' . $observaciones . '</td>'
                . '<td>'
                . '<a class="hoverable" href="#visualizar"> Ver</a>'
                . '</td>'
                . '</tr>';
        return $mensaje;
    }

    public function diligenciarFormato($usuario, $formato, $info) {
        $mensaje = '';
        $mensaje = $this->facade->diligenciarFormato($usuario, $formato, $info);
        echo $mensaje;
    }

    public function mostrarRegistrosFormato($formato) {
        $mensaje = '';
        $informacion = $this->facade->mostrarRegistrosFormato($formato);

        if (count($informacion) == 0) {
            $mensaje = '<strong> El formato no posee registros de datos </Strong>';
        } else {

            foreach ($informacion as $info) {
                $array = json_decode($info, true);
                $fecha = $array["fecha"];
                $usuario = $array["usuario"];
                $estado = $array["estado"];
                $datos = $array["informacion"];

                $mensaje .= $this->listar($fecha, $usuario, $estado);
            }
            $mensaje = str_replace("&", "'", $mensaje);
        }
        echo $mensaje;
    }

    public function listar($fecha, $usuario, $estado) {
        $mensaje = '<tr>'
                . '<td>' . $fecha . '</td>'
                . '<td>' . $usuario . '</td>'
                . '<td>' . $estado . '</td>'
                . '<td>'
                . '<a class="hoverable" onclick="verDatos(&' . $fecha . '&)"> Ver</a>'
                . '</td>'
                . '</tr>';
        return $mensaje;
    }
    
    public function verDatos($formato,$fecha){
        $mensaje = '';
        $informacion = $this->facade->verDatos($formato, $fecha);

        if (count($informacion) == 0) {
            $mensaje = '<strong> No existe el registro con la fecha '.$fecha.' </Strong>';
        } else {
            foreach ($informacion as $info) {   
                echo $info;                
            }
        }
        
    }

}
?>

