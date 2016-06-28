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
        $mensaje = '';

        //redirecciona el inicio de sesión
        if ($usuario->estado_usuario == 'activo') {
            $mensaje = ('location: ../vista/index.php');
        } else {
            $mensaje = ('location: ../index.php');
        }

        // crea variables de sesión
        $_SESSION['nombre'] = $usuario->nombre_usuario;
        $_SESSION['codigo'] = $usuario->codigo_usuario;
        $_SESSION['estado'] = $usuario->estado_usuario;
        $_SESSION['tipo'] = $usuario->tipo_usuario;
//        echo $_SERVER['HTTP_HOST'];
        return $mensaje;
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
        //Método para realizar el registro de un usuario en la clase que conecta a la BD
        $usuario = $this->usuario->registrar($codigo, $nombre, $apellido, $cedula, $password, $correo, $cargo, $departamento, $telefono, $rol_usuario, $estado);
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
     * @param type $clave
     * @param type $valor
     * @param type $cod
     * @return type
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
     * 
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

    public function desasignarFormato($usuario, $formato) {
        $bandera = $this->formato->asignarDesasignarFormato($usuario, $formato, 0);
        if ($bandera > 0) {
            return 'El formato ' . $formato . ' ha sido desasignado de ' . $usuario;
        } else {
            return 'El usuario no tiene dicho formato asignado';
        }
    }

    public function visualizarFormato($formato, $tipo, $codigo) {
        $html = '';
        $formatos = $this->formato->cargarFormatos($formato, $tipo, $codigo);

        if (!is_null($formatos)) {
            foreach ($formatos as $formato) {
                $array = json_decode($formato, true);
                $html = $array['codigo_html'];
            }
            return $html;
        } else {
            return null;
        }
    }

    public function verVersionFormato($formato, $version) {
        $html = $this->formato->verVersionFormato($formato, $version);
        return $html;
    }

    public function modificarFormato($usuario, $formato, $detalle, $html) {
        $buscar_modificacion = $this->formato->buscar_modificacion($formato);
        $version = $this->buscarVersion($formato);

        if ($buscar_modificacion <= 1) {
            $flag = $this->formato->modificarFormato($usuario, $formato, $detalle, $version, $html);
            echo $flag;
            if ($flag > 0) {
                return 'El formato ha sido modificado';
            } else {
                return 'El formato no ha podido ser modificado';
            }
        } else {
            return 'El formato ya fue modificado el día de hoy, pruebe mañana nuevamente.';
        }
    }

    public function buscarVersion($formato) {
        $version = '';
        $formatos = $this->formato->buscar_formato($formato);
        if (count($formatos) !== 0) {
            foreach ($formatos as $formato) {
                $array = json_decode($formato, true);
                $v = explode(' ', $array["version"]);
                $version = $v[0] . ' ' . ($v[1] + 1);
            }
        }
        return $version;
    }

    public function historialFormato($formato) {
        return $this->formato->historialFormato($formato);
    }

    public function diligenciarFormato($fechaFormato, $usuario, $formato, $info, $observaciones) {
        $msj = '';
        $info2 = $this->validarInformacion($info);
        if (is_null($info2)) {
            return 'Por favor ingrese los datos correspondientes al formato';
        }
        if ($fechaFormato == '---') {
            date_default_timezone_set('America/Bogota');
            $fechaFormato = date('Y/m/d', time());
//            echo date('Y/m/d H:i:s', time());
        }

        $informacion = $this->info->guardarInfo($fechaFormato, $usuario, $formato, $info2, $observaciones);
        if (!is_null($informacion)) {
            $msj = 'Información registrada con éxito';
        } else {
            $msj = 'La información no ha sido registrada en el sistema';
        }
        return $msj;
    }

    public function validarInformacion($info2) {
        $info = urldecode($info2);
        $arr = explode('&', $info);
        $msj = '';
        foreach ($arr as $var) {
            $arreglo2 = explode('=', $var);
            if ($arreglo2[1] !== '') {
                $msj.=$var . '&';
            }
        }
        return $msj;
    }

    public function mostrarRegistrosFormato($formato) {
        $informacion = array();
        $informacion = $this->info->mostrarInfo($formato);
        if (count($informacion) == 0) {
            $informacion = null;
        } else {
            return $informacion;
        }
        return $informacion;
    }

    public function verDatos($formato, $fecha) {
        $json = $this->info->verDatos($formato, $fecha);
        return $json;
    }

    public function modificarRegistroFormato($fechaFormato, $usuario, $formato, $info, $observaciones, $tipo) {

        $f = (int) $this->formato->buscarDiasModificacion($formato);

        date_default_timezone_set('America/Bogota');
        $fechaSistema = date('Y/m/d H:i:s', time());

        $ff = new DateTime($fechaFormato);
        $fs = new DateTime($fechaSistema);

//        echo $ff->format('Y/m/d H:i:s');
//        echo $fs->format('Y/m/d H:i:s');

        $diferencia = $ff->diff($fs);
        $d = $diferencia->format('%d');
//        echo $info;


        if ($d <= $f) {
            $reg = $this->info->buscarRegistro($formato, $fechaFormato);
            $u = explode('-', $reg);
            $estado = (int) $u[1];
            $user = $u[0];

            $info2 = $this->validarInformacion($info);
//            echo $info2;
            $observaciones.=' El registro ha sido mofificado por el usuario ' . $usuario;

            if ($tipo === 'supervisor' && $estado < 2) {
                $flag = $this->info->modificarRegistroFormato($fechaFormato, $usuario, $formato, $info2, $observaciones);
                if ($flag > 0) {
                    return 'El registro ha sido modificado';
                }
            } else {
                if ($usuario === $user && $estado < 2) {
                    $flag = $this->info->modificarRegistroFormato($fechaFormato, $usuario, $formato, $info2, $observaciones);
                    if ($flag > 0) {
                        return 'El registro ha sido modificado';
                    }
                    echo 'Aqui va el codigo de modificar registro por el operario';
                } else {
                    if ($usuario !== $user) {
                        echo 'No puede modificar el formato porque usted no lo ha diligenciado inicialmente';
                    }
                    if ($estado !== 0) {
                        echo 'El registro ya fue modificado';
                    }
                }
            }
        } else {
            echo "el formato no puede ser modificado.<br>Se ha excedido la fecha límite del formato.";
        }
    }

    public function trazabilidadFormato($formato, $clave, $inicio, $fin) {
        $informacion = array();
        $informacion = $this->info->mostrarInfoFechas($formato, $inicio, $fin);
        if ($informacion ==='') {
            return 'No existen registros en ese rango de fechas';
        } else {
            return $informacion;
        }
    }

}
