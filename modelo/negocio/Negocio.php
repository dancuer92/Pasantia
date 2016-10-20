<?php

header("Content-Type: text/html;charset=utf-8");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../modelo/dao/Formato_dao.php';
require_once '../modelo/dto/Formato_dto.php';
require_once '../modelo/dao/Usuario_dao.php';
require_once '../modelo/dto/Usuario_dto.php';
require_once '../modelo/dao/Informacion_dao.php';
require_once '../modelo/dto/Informacion_dto.php';

class Negocio {

    private $formato;
    private $usuario;
    private $info;

    public function __construct() {
        $this->formato = new Formato_dao();
        $this->usuario = new Usuario_dao();
        $this->info = new Informacion_dao();
    }

    /**
     * método para iniciar sesión de usuario
     * @param type $nombre
     * @param type $password
     * @return type
     */
    public function iniciar_sesion($nombre, $password) {
        //realiza la consulta por el código y la contraseña
        $usuario = $this->usuario->iniciar_sesion($nombre, $password);
        if ($usuario->codigo_usuario == '' || $usuario->codigo_usuario == null) {
            return (-1);
        }

        //Validación usuario activo
        else if ($usuario->estado_usuario == 'activo') {
            //Zona horaria y fecha actual
            date_default_timezone_set('America/Bogota');
            $fechaSistema = strtotime(date('Y/m/d H:i:s', time()));
            //Se toma la fecha de caducidad
            $fc = strtotime($usuario->caducidad_usuario);
            if ($fechaSistema < $fc) {
                //crea variables de sesión
                $_SESSION['nombre'] = $usuario->nombre_usuario;
                $_SESSION['codigo'] = $usuario->codigo_usuario;
                $_SESSION['estado'] = $usuario->estado_usuario;
                $_SESSION['tipo'] = $usuario->tipo_usuario;
                $_SESSION['ultimoAcceso'] = $fechaSistema;
                return 1;
            } else {
                return 2;
            }
        } else {
            return 0;
        }
    }

    /**
     * Método que envía los datos a la calse controladora de usuario para registrar un usuario
     * retorna un mensaje de respuesta si es exitosa la operación
     * @param type $codigo
     * @param type $nombre
     * @param type $apellido
     * @param type $cedula
     * @param type $password
     * @param type $correo
     * @param type $cargo
     * @param type $departamento
     * @param type $telefono
     * @param type $rol_usuario
     * @param type $estado
     * @return string
     */
    public function registrar_usuario($codigo, $nombre, $apellido, $cedula, $password, $correo, $cargo, $departamento, $telefono, $rol_usuario, $estado) {
        //Zona horaria y fecha actual
        date_default_timezone_set('America/Bogota');
        $fechaSistema = strtotime(date('Y/m/d H:i:s', time()));
        $fechaCaducidad = date('Y-m-d H:i:s', strtotime('+3 months', $fechaSistema));
        //Método para realizar el registro de un usuario en la clase que conecta a la BD
        $usuario = $this->usuario->registrar($codigo, $nombre, $apellido, $cedula, $password, $correo, $cargo, $departamento, $telefono, $rol_usuario, $estado, $fechaCaducidad);
        //Se valida el resultado de la operación y se retorna el mensaje de respuesta.
        if (!is_null($usuario)) {
            return 'Usuario registrado con éxito';
        } else {
            return 'El usuario no ha sido registrado en el sistema';
        }
    }

    /**
     * Buscar un usuario por un criterio de busqueda, retorna una lista de usuarios o un valor nulo si no existe ninguno
     * @param type $consultaBusqueda
     * @param type $opc
     * @param type $formato
     * @return type
     */
    public function buscar_usuario($consultaBusqueda, $opc, $formato) {
        $usuarios = array();
        //Consulta los usuarios a la BD
        $usuarios = $this->usuario->buscar($consultaBusqueda, $opc, $formato);
        //Valida si existe al menos uno.
        if (count($usuarios) == 0) {
            $usuarios = null;
        } else {
            return $usuarios;
        }
    }

    /**
     * Método que permite modificar algun dato del usuario.
     * retorna true, si la acción se completó en la BD
     * @param String $clave campo a actualizar en la BD
     * @param String $valor nuevo valor del campo en la BD
     * @param String $cod código del usuario en la BD
     * @return boolean true si la operació se realiza correctamente
     */
    public function editar_usuario($clave, $valor, $cod) {
        //realizar la modificación enla BD
        $mensaje = $this->usuario->editar($clave, $valor, $cod);
        return $mensaje;
    }

    /**
     * Método para buscar la información básica del usuario para buscar sesión
     * Retorna los datos en un JSON o null si no existe.
     * @param type $codigo
     * @return type
     */
    public function cargar_usuario($codigo) {
        //consulta el usuario
        $usuario = $this->usuario->cargar($codigo);
        //validar si no es null
        if (!is_null($usuario)) {
            return $usuario->toJSON();
        } else {
            return null;
        }
    }

    /**
     * Método para cambiar la contraseña de usuario
     * retorna un mensaje.
     * @param type $newPass
     * @param type $prevPass
     * @param type $cod
     * @return string
     */
    public function cambiar_password_usuario($newPass, $prevPass, $cod) {
        //Cambiar la contraseña
        $bandera = $this->usuario->cambiar($newPass, $prevPass, $cod);
        $msj = "";
        //convertir el valor que retorna la operación en la clase usuario DAO
        switch ($bandera) {
            case "0":
                $msj = 'La contraseña no ha sido actualizada, por favor vuelva a intetarlo';
                break;
            case "1":
                $msj = 'La contraseña ha sido actualizada';
                break;
            case "2":
                $msj = 'La contraseña anterior no coincide en la base de datos';
                break;
        }
        return $msj;
    }

    /**
     * Método que carga los formatos según el tipo de usuario
     * retorna un JSON desde la BD.
     * @param type $formato
     * @param type $tipo
     * @param type $codigo
     * @return type
     */
    public function cargarFormatos($formato, $tipo, $codigo) {
        //consulta a la base de datos
        $formatos = $this->formato->cargarFormatos($formato, $tipo, $codigo);
        //retorna null si no existe o no tiene formatos asignados
        if (!is_null($formatos)) {
            return $formatos;
        } else {
            return null;
        }
    }

    /**
     * Método que registra un nuevo formato en la BD
     * @param type $codigo
     * @param type $nombre
     * @param type $procedimiento
     * @param type $director
     * @param type $frecuencia
     * @param type $tipo
     * @param type $version
     * @param type $html
     * @return string
     */
    public function guardarFormato($codigo, $nombre, $procedimiento, $director, $frecuencia, $tipo, $version, $html) {
        //Método que registra el formato en la BD
        $formato = $this->formato->guardarFormato($codigo, $nombre, $procedimiento, $director, $frecuencia, $tipo, $version, $html);
//        echo $formato;
        //Se valida que crea la tabla de información del formato en la BD si el registro previo es exitoso.
        if (!is_null($formato)) {
            $this->formato->crearTablaInfo($codigo);
            return 'Formato registrado con éxito';
        } else {
            return 'El formato no ha sido registrado en el sistema porque fue registrado anteriormente';
        }
    }

    /**
     * Método que permite asignar un formato a un usuario de tipo supervisor u operario del sistema
     * recibe el código del usuario y el código del formato y retorna un mensaje de respuesta de la operación
     * @param type $usuario
     * @param type $formato
     * @return string
     */
    public function asignarFormato($usuario, $formato) {
        $bandera = $this->formato->asignarDesasignarFormato($usuario, $formato, 1);
        if ($bandera > 0) {
            return 'El formato ' . $formato . ' ha sido asignado a ' . $usuario;
        } else {
            return 'El formato ha sido asignado anteriormente';
        }
    }

    /**
     * Método que permite desasignar un formato a un usuario de tipo supervisor u operario del sistema
     * recibe el código del usuario y el código del formato y retorna un mensaje de respuesta de la operación
     * @param type $usuario
     * @param type $formato
     * @return string
     */
    public function desasignarFormato($usuario, $formato) {
        $bandera = $this->formato->asignarDesasignarFormato($usuario, $formato, 0);
        if ($bandera > 0) {
            return 'El formato ' . $formato . ' ha sido desasignado de ' . $usuario;
        } else {
            return 'El usuario no tiene dicho formato asignado';
        }
    }

    /**
     * método que permite visualizar el formato
     * recibe el código del formato y adicionalmente el tipo y el código de usuario para restringir la carga de cualquier formato restingido por el sistema.
     * retorna el formato representado en un formulario html
     * @param type $formato
     * @param type $tipo
     * @param type $codigo
     * @return type
     */
    public function visualizarFormato($formato, $tipo, $codigo) {
        $html = '';
        //Se consulta el formato
        $formatos = $this->formato->cargarFormatos($formato, $tipo, $codigo);

        if (!is_null($formatos)) {
            foreach ($formatos as $formato) {
                //se carga el codigo html almacenado en la base de datos y guardado en un JSON durante la consulta
                $array = json_decode($formato, true);
                //Se convierte en una cadena el código html 
                $html = $array['codigo_html'];
            }
            return $html;
        } else {
            return null;
        }
    }

    /**
     * Método que permite ver el formato de acuerdo a una versión dada del mismo
     * recibe el código del formato y la versión del formato
     * retorna el código html del formato
     * @param type $formato
     * @param type $version
     * @return type
     */
    public function verVersionFormato($formato, $version) {
        //Se realiza la consulta a la BD
        $html = $this->formato->verVersionFormato($formato, $version);
        return $html;
    }

    /**
     * Método que sirve para modificar el formato 
     * Se reciben entre otros detalles, código de usuario, código de formato, el detalle del cambio y el mismo html del formato.
     * @param type $usuario
     * @param type $formato
     * @param type $detalle
     * @param type $html
     * @return string
     */
    public function modificarFormato($usuario, $formato, $detalle, $html) {
        //Se buscan los días permitidos para realizar una modificación a un registro.
        $buscar_modificacion = $this->formato->buscar_modificacion($formato);
        //Se busca la última versión del formato
        $version = $this->buscarVersion($formato);

        if ($buscar_modificacion <= 1) {
            //Se realiza la modificaión en la BD y se almacena a respuesta.
            $flag = $this->formato->modificarFormato($usuario, $formato, $detalle, $version, $html);
            echo $flag;
            //Se retorna el mensaje de la operación.
            if ($flag > 0) {
                return 'El formato ha sido modificado';
            } else {
                return 'El formato no ha podido ser modificado';
            }
        } else {
            return 'El formato ya fue modificado el día de hoy, pruebe mañana nuevamente.';
        }
    }

    //Método que realiza la busqueda de la última versión del formato.
    public function buscarVersion($formato) {
        $version = '';
        //Se busca el formato
        $formatos = $this->formato->buscar_formato($formato);
        //Si el resultado de la busqueda es diferente a cero
        if (count($formatos) !== 0) {
            foreach ($formatos as $formato) {
                //se decodifica el JSON que trae el resultado de la búsqueda
                $array = json_decode($formato, true);
                //Se aumenta el consecutivo de la versión
                $v = explode(' ', $array["version"]);
                $version = $v[0] . ' ' . ($v[1] + 1);
            }
        }
        //se retorna la versión nueva de la modificación al formato
        return $version;
    }

    /**
     * Método que consulta todas las versiones de un formato
     * recibe el código del formato
     * retorna todas las versiones del formato en un JSON
     * @param type $formato
     * @return type
     */
    public function historialFormato($formato) {
        return $this->formato->historialFormato($formato);
    }

    /**
     * Método para diligenciar un formato por parte de un supervisor o de un operario,
     * recibe la fecha del sistema, el usuario qeu lo diligencia, el código del formato, la información y las observaciones que se hacen en el momento de registrar.
     * retorna un mensaje de la operación realizada
     * @param type $fechaFormato
     * @param type $usuario
     * @param type $formato
     * @param type $info
     * @param type $observaciones
     * @return string
     */
    public function diligenciarFormato($fechaFormato, $usuario, $formato, $info, $observaciones, $camposClave) {
        $msj = '';
        //Se valida la información ingresada
        $info2 = $this->validarInformacion($info);
        //se verifica que la información corresponda al estandar
        if (is_null($info2)) {
            return 'Por favor ingrese los datos correspondientes al formato';
        }
        //se verifica la fecha del formato nuevamente en caso de que la recibida sea vacía
        if ($fechaFormato == '---') {
            //Zona horaria
            date_default_timezone_set('America/Bogota');
            //fecha actual
            $fechaFormato = date('Y/m/d', time());
//            echo date('Y/m/d H:i:s', time());
        }

        //Se guarda la información en la BD
        $informacion = $this->info->guardarInfo($fechaFormato, $usuario, $formato, $info2, $observaciones, $camposClave);
        //se valida la ejecución de la consulta para retornar el mensaje
        if (!is_null($informacion)) {
            $msj = 'Información registrada con éxito';
        } else {
            $msj = 'Favor revisar la información de los campos clave';
        }
        return $msj;
    }

    /**
     * Método para validar y comprimir la información registrada en el sistema
     * recibe la información de la vista y retorna una cadena con la información compresa
     * @param type $info2
     * @return string
     */
    public function validarInformacion($info2) {
        //Decodifica cualquier cifrado tipo %## en la cadena dada. Los símbolos ('+') son decodificados como el caracter espacio.
        $info = urldecode($info2);
        //Separa la cadena por & y se almacena en un array
        $arr = explode('&', $info);
        $msj = '';
        //se recorre el arreglo de la cadena separada
        foreach ($arr as $var) {
            //se separa cada elemento por el = de tal forma que se crea un arreglo de dos posiciones que serán la clave y el valor
            $arreglo2 = explode('=', $var);
            //Si el valor es vacío no se almacena como información en la base de datos
            if ($arreglo2[1] !== '') {
                //Se almacena en una cadena con la nueva información de clave y valor (diferente de vacío)
                $msj.=$var . '&';
            }
        }
        return $msj;
    }

    /**
     * Método para mostrar un listado de registros de un formato
     * recibe el código del formato y retorna un arreglo con los registros.
     * @param type $formato
     * @return type
     */
    public function mostrarRegistrosFormato($formato) {
        $informacion = array();
        //Método que ejecuta la consulta en la base de datos
        $informacion = $this->info->mostrarInfo($formato);
        //Se valida la información obtenida de la consulta
        if (count($informacion) == 0) {
            $informacion = null;
        } else {
            return $informacion;
        }
        return $informacion;
    }

    /**
     * Método para ver los datos de un registro de un formato 
     * retorna una cadena con la información
     * @param type $formato
     * @param type $fecha
     * @return type
     */
    public function verDatos($formato, $fecha) {
        $json = $this->info->verDatos($formato, $fecha);
        return $json;
    }

    /**
     * Método para modificar un registro del formato
     * recibe la fecha de modificación, el usuario que lo modifica, el código del formato, la nueva información, las observaciones y el tipo de usuario que lo modifica
     * retorna un mensaje de confirmación de la operación
     * @param type $fechaFormato
     * @param type $usuario
     * @param type $formato
     * @param type $info
     * @param string $observaciones
     * @param type $tipo
     * @return string
     */
    public function modificarRegistroFormato($fechaFormato, $usuario, $formato, $info, $observaciones, $camposClave, $tipo) {

        //Se buscan los días máximo de modificación del formato
        $f = (int) $this->formato->buscarDiasModificacion($formato);

        //Zona horaria y fecha actual
        date_default_timezone_set('America/Bogota');
        $fechaSistema = date('Y/m/d H:i:s', time());

        //Se toma la fecha actual
        $ff = new DateTime($fechaFormato);
        $fs = new DateTime($fechaSistema);

//        echo $ff->format('Y/m/d H:i:s');
//        echo $fs->format('Y/m/d H:i:s');
//        Se toma la idferencia entre la fecha actual y la fecha del día de registro de la información
        $diferencia = $ff->diff($fs);
        $d = $diferencia->format('%h');
//        echo $info;
        //Se compara si la diferencia es menor al máximo de días permitidos para la modificación
        if ($d <= $f) {
            //Se busca el registro por la fecha en el sistema y retorna el usuario y el estado del registro
            $reg = $this->info->buscarRegistro($formato, $fechaFormato);
            //Se separa los datos obtenidos
            $u = explode('-', $reg);
            $estado = (int) $u[1];
            $user = $u[0];
            $obs = $u[2];

            //Se valida y se comprime la nueva información
            $info2 = $this->validarInformacion($info);
//            echo $info2;
            //Se guarda la observación de la modificación
            $obs.=' El registro ha sido modificado por el usuario ' . $usuario . '. ' . $observaciones;

            //Se valida si el usuario es supervisor para sobrescribir el registro y si está dentro del rango de días permitidos para su modificación
//            if ($tipo === 'supervisor' && $estado < 5) { // linea hecha para que funcione con un usuario operario y un usuario supervisor. se elimina el condicional siguiente
            if ($estado < 4) {
                //Se modifica el registro
                $flag = $this->info->modificarRegistroFormato($fechaFormato, $usuario, $formato, $info2, $obs, $camposClave);
//                return 'El registro ha sido modificado'; //se retorna el mensaje de éxito
                //se valida que el registro haya sido modificado
                if ($flag > 0) {
                    return 'El registro ha sido modificado';
                }
            } else {
                return 'el formato no puede ser modificado.<br>El registro ya fue modificado anteriormente';



//                //Si el usuario no es supervisor, se valida si es el mismo usuario encargado del primer registro y que esté dentro del rango de días permitidos
////                if ($usuario === $user && $estado < 2) { // linea hecha para que funcione con un usuario operario y un usuario supervisor
//                if ($usuario === $user && $estado < 5) {
//                    //Se modifica el registro
//                    $flag = $this->info->modificarRegistroFormato($fechaFormato, $usuario, $formato, $info2, $observaciones);
//                    //Se valida la operación de modificación
//                    if ($flag > 0) {
//                        return 'El registro ha sido modificado';
//                    }
//                } else {
//                    //si la operación no se cumple es por lo siguiente
//                    if ($usuario !== $user) {
//                        return 'el formato no puede ser modificado.<br>No puede modificar el formato porque usted no lo ha diligenciado inicialmente';
//                    }
//                    if ($estado >= 5) {
//                        return 'el formato no puede ser modificado.<br>El registro ya fue modificado anteriormente';
//                    }
//                }
            }
        } else {
            return "el formato no puede ser modificado.<br>Se ha excedido la fecha límite del formato.";
        }
    }

    /**
     * Método para mostrar los datos dentro de un renago de fechas que permiten analizar la trazabilidad posteriormente
     * Recibe una fecha de inicio y una fecha de finalización
     * retorna una cadena con los datos dentro de esas fechas
     * @param type $formato
     * @param type $clave
     * @param type $inicio
     * @param type $fin
     * @return string
     */
    public function trazabilidadFormato($formato, $clave, $inicio, $fin) {
        $informacion = array();
        //COnsulta a la BD
        $informacion = $this->info->mostrarInfoFechas($formato, $inicio, $fin);
        //Validación de la información retornada
        if ($informacion === '') {
            return 'No existen registros en ese rango de fechas';
        } else {
            return $informacion;
        }
    }

    /**
     * metodo que permite cargar la plantilla con los datos de un registro para visualizarlos en la pantalla.
     * inicialmente el metodo se encarga de cargar la plantilla y despues de adjuntar los datos en una cadena separada por ###
     * @param type $formato
     * @param type $fecha
     * @param type $tipo
     * @param type $codigo
     * @return type
     */
    public function visualizarRegistro($formato, $fecha, $tipo, $codigo) {
        //Cargar el codigo html del formato
        $html = $this->visualizarFormato($formato, $tipo, $codigo);
        //cargar los datos del registro del formato
        $datos = $this->verDatos($formato, $fecha);
        //Se retorna un registro o un mensaje sin el registro encontrado.
        if (count($datos) == 0) {
            $info = '<strong> No existe el registro con la fecha ' . $fecha . ' </Strong>';
        } else {
            foreach ($datos as $info2) {
                echo $info2;
            }
        }
        //concatenacion de los datos y la plantilla
        $mensaje=$info2.'###'.$html;
        return ($mensaje);
    }
    
    /**
     * 
     * @param type $formato
     * @param type $clave
     * @param type $valor
     */
    public function modificarDatosFormato($formato,$clave,$valor){       
        $rename=true;
        if($clave=='cod_formato'){
            $rename=$this->info->cambiarNombreTablaInfo($formato,$valor);            
            if(!$rename){
                return 'Error actualizando la tabla de información del formato';
            }
        }
        if($rename){
            $exec=  $this->formato->modificarDatosFormato($formato,$clave,$valor);
            if($exec){
                return 'Dato actualizado correctamente';
            }
        }
        return 'El dato no ha podido ser actualizado';        
        
    }

}
