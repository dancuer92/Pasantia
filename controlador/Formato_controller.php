<?php

//header("Content-Type: text/html;charset=utf-8");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Controlador de formato que requiere la clase Facade y permite entre otras cosas cargar, guardar asignar desasignar visualizar
 * modificar, ver historial, diligenciar, mostrar registros, ver datos, modificar registro, ver versiones y analizar un formato.
 */
session_start();
require_once '../modelo/facade/Facade.php';

// selección de la opción enviada por el método post
$option = $_POST['opcion'];
// Creación de una nueva clase formato controlador
$formato_controller = new Formato_controller();


/**
 * El controlador se encarga de ejecutar una función correspondiente sobre un formato.
 */
switch ($option) {
    case 'cargarFormatos':
        $formato = $_POST['formato'];
        $tipo = $_SESSION['tipo'];
        $codigo = $_SESSION['codigo'];
        $formato_controller->cargarFormatos($formato, $tipo, $codigo);
        break;
    case 'guardarFormato':
        $codigo = $_POST['codigoF'];
        $nombre = $_POST['nombreF'];
        $procedimiento = $_POST['procedimientoF'];
        $director = $_POST['directorF'];
        $frecuencia = $_POST['frecuenciaF'];
        $tipo = $_POST['tipoF'];
        $version = $_POST['versionF'];
        $html = $_POST['codigoHTML'];
        $formato_controller->guardarFormato($codigo, $nombre, $procedimiento, $director, $frecuencia, $tipo, $version, $html);
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
        $tipo = $_SESSION['tipo'];
        $codigo = $_SESSION['codigo'];
        $formato_controller->visualizarFormato($formato, $tipo, $codigo);
        break;
    case 'modificarFormato':
        $usuario = $_SESSION['codigo'];
        $formato = $_POST['formato'];
        $detalle = $_POST['detalle'];
        $html = $_POST['html'];
        $formato_controller->modificarFormato($usuario, $formato, $detalle, $html);
        break;
    case 'historialFormato':
        $formato = $_POST['formato'];
        $formato_controller->historialFormato($formato);
        break;
    case 'diligenciarFormato':
        $formato = $_POST['formato'];
        $fechaFormato = $_POST['fechaFormato'];
        $observaciones = $_POST['observaciones'];
        $info = $_POST['info'];
        $usuario = $_SESSION['codigo'];
        $formato_controller->diligenciarFormato($fechaFormato, $usuario, $formato, $info, $observaciones);
        break;
    case 'mostrarRegistrosFormato':
        $formato = $_POST['formato'];
        $formato_controller->mostrarRegistrosFormato($formato);
        break;
    case 'verDatos':
        $formato = $_POST['formato'];
        $fecha = $_POST['fecha'];
        $formato_controller->verDatos($formato, $fecha);
        break;
    case 'modificarRegistroFormato':
        $formato = $_POST['formato'];
        $fechaFormato = $_POST['fechaFormato'];
        $observaciones = $_POST['observaciones'];
        $info = $_POST['info'];
        $usuario = $_SESSION['codigo'];
        $formato_controller->modificarRegistroFormato($fechaFormato, $usuario, $formato, $info, $observaciones);
        break;
    case 'verVersionFormato':
        $formato = $_POST['formato'];
        $version = $_POST['version'];
        $formato_controller->verVersionFormato($formato, $version);
        break;
    case 'trazabilidadFormato':
        $formato = $_POST['formato'];
        $clave = $_POST['clave'];
        $inicio = $_POST['inicio'];
        $fin = $_POST['fin'];
        $formato_controller->trazabilidadFormato($formato, $clave, $inicio, $fin);
        break;
}

/**
 * Clase formato_controller
 */
class Formato_controller {

    //Invocación de la clase facade que permite realizar la conexión con el modelo del sistema.
    private $facade;

    /**
     * Constructor vacío del formato
     */
    public function __construct() {
        $this->facade = new Facade();
    }

    /**
     * Método que permite cargar los formatos para un usuario. Permite retornar a la vista un código en lenguaje html
     * permite buscar por una clave del del formato.
     * Dependiendiendo del tipo de usuario el sistema cargará los formatos correspondientes a dicho usuario.
     * Según el código de usuario permite trabajar ciertos formatos.
     * @param type $formato 
     * @param type $tipo
     * @param type $codigo
     */
    public function cargarFormatos($formato, $tipo, $codigo) {
        $mensaje = '';

        //Método de conexíon con el modelo, trae la respuesta de la base de datos.
        $formatos = $this->facade->cargarFormatos($formato, $tipo, $codigo);
//        echo $json.'controller';
        //Si la respuesta de la base de datos es igual a cero no se muestran formatos
        if (count($formatos) == 0) {
            $mensaje = '<strong> El formato consultado no existe </Strong>';
        } else {
            // Se recorre el JSON de formatos para representarlos y organizarlos en la página html
            foreach ($formatos as $format) {
                //Conversión a un arreglo
                $array = json_decode($format, true);
                $cod = $array["cod_formato"];
                $nombre = $array["nombre"];
                $version = $array["version"];
                $procedimiento = $array["procedimiento"];
                $jefe = $array["jefe_procedimiento"];
                $tipo = $array["descripcion"];


                //método que permite representar los botones de acción según el tipo de usuario
                $mensaje .= $this->cargarBotones($cod, $nombre, $version, $procedimiento, $jefe);
            }
            $mensaje = str_replace("&", "'", $mensaje);
        }
        //Retorno un html a incluir en la página
        echo $mensaje;
    }

    /**
     * Método que carga las opciones según el tipo de usuario del sistema para realizar funcionalidades sobre los formatos.
     * las variables representan información del fotmato. el método retorna codificacioón html de la página.
     * @param type $cod
     * @param type $nombre
     * @param type $version
     * @param type $procedimiento
     * @param type $jefe
     * @return string
     */
    public function cargarBotones($cod, $nombre, $version, $procedimiento, $jefe) {
        $mensaje = '<li class="collection-item avatar">
                            <div class="col l2 m3 s12 hide-on-small-only">
                                <a class="grey-text text-lighten-1 tooltipped " data-position="bottom" data-delay="50" data-tooltip="VER" onclick="visualizarFormato(&' . $cod . '&)"><i class="large material-icons">description</i></a>
                            </div>
                            <div class="col l10 m9 s12">
                                <p><strong>' . $cod . '</strong></p>
                                <p>' . $nombre . '</p>
                                <p>' . $version . '</p>
                                <p>' . $procedimiento . '</p>
                                <p>' . $jefe . '</p>
                            </div>';

        //se valida el tipo de usuario y se escogen las opciones que el usuario tendrá
        switch ($_SESSION['tipo']) {
            case 'administrador':
                $mensaje.='<a class="btn-floating red hoverable tooltipped modal-trigger right" data-position="top" data-delay="50" data-tooltip="Desasignar" onclick="desasignarFormato(&' . $cod . '&)" ><i class="material-icons">visibility_off</i></a>'
                        . '<a class="btn-floating red hoverable tooltipped modal-trigger right" data-position="top" data-delay="50" data-tooltip="Asignar" onclick="asignarFormato(&' . $cod . '&);"><i class="material-icons">input</i></a>';
                break;
            case 'asistente':
                $mensaje.='<a class="btn-floating red hoverable tooltipped right" data-position="top" data-delay="50" data-tooltip="Historial de versiones" onclick="historialFormato(&' . $cod . '&)" ><i class="material-icons">history</i></a>'
                        . '<a class="btn-floating red hoverable tooltipped right" data-position="top" data-delay="50" data-tooltip="Modificar" onclick="modificarFormato(&' . $cod . '&)" ><i class="material-icons">edit</i></a>';
                break;
            case 'supervisor':
                $mensaje.='<a class="btn-floating red hoverable tooltipped right" data-position="top" data-delay="50" data-tooltip="Analizar trazabilidad" onclick="analizarFormato(&' . $cod . '&)" ><i class="material-icons">timeline</i></a>'
                        . '<a class="btn-floating red hoverable tooltipped right" data-position="top" data-delay="50" data-tooltip="Mostrar registros" onclick="mostrarRegistrosFormato(&' . $cod . '&)" ><i class="material-icons">find_in_page</i></a>'
                        . '<a class="btn-floating red hoverable tooltipped right" data-position="top" data-delay="50" data-tooltip="Diligenciar" onclick="diligenciarFormato(&' . $cod . '&)" ><i class="material-icons">keyboard</i></a>';
                break;
            case 'operario':
                $mensaje.='<a class="btn-floating red hoverable tooltipped right" data-position="top" data-delay="50" data-tooltip="Mostrar registros" onclick="mostrarRegistrosFormato(&' . $cod . '&)" > <i class="material-icons">find_in_page</i></a>'
                        . '<a class="btn-floating red hoverable tooltipped right" data-position="top" data-delay="50" data-tooltip="Diligenciar" onclick="diligenciarFormato(&' . $cod . '&)" > <i class="material-icons">keyboard</i></a>';
        }

        $mensaje.='</li>';
        //Retorna la página html
        return $mensaje;
    }

    /**
     * Método que permite guardar el registro de un nuevo formato en el sistema.
     * Recibe información sobre el formato.
     * @param type $codigo
     * @param type $nombre
     * @param type $procedimiento
     * @param type $director
     * @param type $frecuencia
     * @param type $tipo
     * @param type $version
     * @param type $html
     */
    public function guardarFormato($codigo, $nombre, $procedimiento, $director, $frecuencia, $tipo, $version, $html) {
        $mensaje = '';
        //Método de enlace a la base de datos
        $mensaje = $this->facade->guardarFormato($codigo, $nombre, $procedimiento, $director, $frecuencia, $tipo, $version, $html);
        //Retorna el mensaje de respuesta de la base de datos.
        echo $mensaje;
    }

    /**
     * Método que recibe el identificador de un formato y de un usuario para establecer una relación entre usuario y formato.
     * retorna un mensaje de respuesta de la operación realizada
     * @param type $usuario
     * @param type $formato
     */
    public function asignarFormato($usuario, $formato) {
        $mensaje = '';
        //método que retorna una mensaje de la base de datos.
        $mensaje = $this->facade->asignarFormato($usuario, $formato);
        echo $mensaje;
    }

    /**
     * Método que cambia de estado la relación de un usuario con un formato.
     * recibe el código del usuario y el código del formato.
     * retorna un mensaje de confirmación de la base de datos.
     * @param type $usuario
     * @param type $formato
     */
    public function desasignarFormato($usuario, $formato) {
        $mensaje = '';
        //método que retorna una mensaje de la base de datos.
        $mensaje = $this->facade->desasignarFormato($usuario, $formato);
        echo $mensaje;
    }

    /**
     * Método que permite visualizar un formato como un formulario plantilla
     * recibe el código del formato, el código y el tipo de usuario de un usuario para buscar el formato solicitado.
     * @param type $formato
     * @param type $tipo
     * @param type $codigo
     */
    public function visualizarFormato($formato, $tipo, $codigo) {
        $mensaje = '';
        //Retorna el contenido del formato o un mensaje de error de la base de datos.
        $mensaje = $this->facade->visualizarFormato($formato, $tipo, $codigo);
        echo $mensaje;
    }

    /**
     * Método que permite modificar un formato existente en el sistema,
     * recibe información del formato que se modifica, el contenido nuevo, la descripción de la modificación y el usuario que se encarga del cambio.
     * @param type $usuario
     * @param type $formato
     * @param type $detalle
     * @param type $html
     */
    public function modificarFormato($usuario, $formato, $detalle, $html) {
        $mensaje = '';
        //Método que se encarga de realizar la operación en la BD.
        $mensaje = $this->facade->modificarFormato($usuario, $formato, $detalle, $html);
        echo $mensaje;
    }

    /**
     * Método que permite visualizar un listado de los cambios realizados en el formato.
     * Recibe el código del formato y retorna una tabla html con los cambios realizados al formato.
     * @param type $formato
     */
    public function historialFormato($formato) {
        $mensaje = '';
        //Retorna el listado de los formatos en formato JSON
        $historial = $this->facade->historialFormato($formato);
        
        //Si el archivo no tiene elementos el sistema lanza su respuesta
        if (count($historial) == 0) {
            $mensaje = '<strong> El formato no tiene historial de modificaciones </Strong>';
        } else {
            
            //Se recorre cada elemento y se convierte a código html
            foreach ($historial as $historia) {
                $array = json_decode($historia, true);
                $fecha = $array["fecha_modificacion"];
                $detalle = $array["detalle_modificacion"];
                $usuario = $array["id_usuario"];
                $version = $array["version_formato"];

                //Carga el código html para represnetar la versión
                $mensaje .= $this->cargarFilas($formato, $fecha, $detalle, $usuario, $version);
            }
            $mensaje = str_replace("&", "'", $mensaje);
        }
        //retorna el código html
        echo $mensaje;
    }

    /**
     * Método para convertir una versióbn en una fila codificada en html,
     * recibe los datos del cambio que se le realió al formato
     * @param type $formato
     * @param type $fecha
     * @param type $detalle
     * @param type $usuario
     * @param type $version
     * @return string
     */
    public function cargarFilas($formato, $fecha, $detalle, $usuario, $version) {
        $mensaje = '<tr>'
                . '<td>' . $fecha . '</td>'
                . '<td>' . $detalle . '</td>'
                . '<td>' . $usuario . '</td>'
                . '<td>' . $version . '</td>'
                . '<td>'
                . '<a class="hoverable" onclick="verVersion(&' . $formato . '&,&' . $version . '&)"> Ver</a>'
                . '</td>'
                . '</tr>';
        return $mensaje;
    }

    /**
     * Método para guardar la información de un formato diligenciado por un usuario.
     * Se almacena la fecha del sistema, la fecha según el formato, el usuario, la información del formato y las observaciones
     * @param type $fechaFormato
     * @param type $usuario
     * @param type $formato
     * @param type $info
     * @param type $observaciones
     */
    public function diligenciarFormato($fechaFormato, $usuario, $formato, $info, $observaciones) {
        $mensaje = '';
        //Guardar el diligenciamiento de un formato
        $mensaje = $this->facade->diligenciarFormato($fechaFormato, $usuario, $formato, $info, $observaciones);
        echo $mensaje;
    }

    /**
     * Método que permite mostrar la lista de los registros del formato
     * Recibe el código del formato que es consultado inicialmente.
     * @param type $formato
     */
    public function mostrarRegistrosFormato($formato) {
        $mensaje = '';
        //Carga los registros del formato de la base de datos.
        $informacion = $this->facade->mostrarRegistrosFormato($formato);

        //Condicional que valida el contenido de los registros dfel formato.
        if (count($informacion) == 0) {
            $mensaje = '<strong> El formato no posee registros de datos </Strong>';
        } else {

            //Se recorren todos los resultados para representarlos individualmente
            foreach ($informacion as $info) {
                $array = json_decode($info, true);
                $fecha = $array["fecha_sistema"];
                $fechaFormato = $array["fecha_formato"];
                $usuario = $array["usuario"];
                $estado = $array["estado"];
                $observaciones = $array["observaciones"];

                // permite esquematizar los resultados en una tabla html
                $mensaje .= $this->listar($fecha, $fechaFormato, $usuario, $estado, $observaciones);
            }
            $mensaje = str_replace("&", "'", $mensaje);
        }
        //se retornan todas las filas, cada una representa un registro del formato.
        echo $mensaje;
    }

    /**
     * Método que permite listar todos los reqistros 
     * recibe los datos individuales de un registro y permite insertar un enlace para ver el registro
     * @param type $fecha
     * @param type $fechaFormato
     * @param type $usuario
     * @param type $estado
     * @param type $observaciones
     * @return string
     */
    public function listar($fecha, $fechaFormato, $usuario, $estado, $observaciones) {
        $mensaje = '<tr>'
                . '<td>' . $fecha . '</td>'
                . '<td>' . $usuario . '</td>'
                . '<td>' . $fechaFormato . '</td>'
                . '<td>' . $estado . '</td>'
                . '<td>' . $observaciones . '</td>'
                . '<td>'
                . '<a class="hoverable" onclick="verDatos(&' . $fecha . '&)"> Ver</a>'
                . '</td>'
                . '</tr>';
        return $mensaje;
    }

    /**
     * Permite ver un registro de un formato según la fecha de ingreso al sistema.
     * @param type $formato
     * @param type $fecha
     */
    public function verDatos($formato, $fecha) {
        $info = '';
        //Busqueda de un solo registro en el sistema
        $informacion = $this->facade->verDatos($formato, $fecha);

        //Se retorna un registro o un mensaje sin el registro encontrado.
        if (count($informacion) == 0) {
            $info = '<strong> No existe el registro con la fecha ' . $fecha . ' </Strong>';
        } else {
            foreach ($informacion as $info2) {
                echo $info2;
            }
        }
    }

    /**
     * Método que permite guardar la modificación de un registro de un formato
     * @param type $fechaFormato
     * @param type $usuario
     * @param type $formato
     * @param type $info
     * @param type $observaciones
     */
    public function modificarRegistroFormato($fechaFormato, $usuario, $formato, $info, $observaciones) {
        $tipo = $_SESSION['tipo'];
        //Guarda la información nueva en el sistema
        $mensaje = $this->facade->modificarRegistroFormato($fechaFormato, $usuario, $formato, $info, $observaciones, $tipo);
        echo $mensaje;
    }

    /**
     * Método que permite visualizar una versión anterior de un formato en el sistema.
     * @param type $formato
     * @param type $version
     */
    public function verVersionFormato($formato, $version) {
        //carga el contenido de una versión anterior del formato
        $mensaje = $this->facade->verVersionFormato($formato, $version);
        echo $mensaje;
    }

    /**
     * Método que permite tomar los datos anteriores de un formato en el sistema para realizar un análisis.
     * @param type $formato
     * @param type $clave
     * @param type $inicio
     * @param type $fin
     */
    public function trazabilidadFormato($formato, $clave, $inicio, $fin) {
        //Carga los datos de un formato según un rango de fechas.
        $arreglo = $this->facade->trazabilidadFormato($formato, $clave, $inicio, $fin);
        echo $arreglo;
    }

}
?>

